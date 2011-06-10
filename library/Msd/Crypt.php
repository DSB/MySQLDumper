<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Encryption
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Class for text en- and decryption.
 *
 * @package         MySQLDumper
 * @subpackage      Encryption
 */
class Msd_Crypt
{
    /**
     * Holds the encryption descriptor
     *
     * @var resource
     */
    private $_encDescriptor = null;

    /**
     * Holds the initialization vector
     *
     * @var resource
     */
    private $_initVector = null;

    /**
     * Holds the algorithm wichc is currently used.
     *
     * @var string
     */
    private $_algorithm = MCRYPT_TWOFISH;

    /**
     * Holds the current encryption key.
     *
     * @var string
     */
    private $_encryptionKey = null;

    /**
     * Instance of this class.
     *
     * @var Msd_Crypt
     */
    private static $_instance = null;

    /**
     * Identificator for encrypted text
     *
     * @var string
     */
    private $_cryptIdent = 'Z';

    /**
     * Class constructor
     *
     * @param string $cryptKey  Encryption key
     * @param string $algorithm Algorithm for encryption
     *
     * @return void
     */
    private function __construct($cryptKey = null, $algorithm = null)
    {
        if ($cryptKey === null) {
            $cryptKey = md5(time());
        }
        if ($algorithm === null) {
            $algorithm = $this->_algorithm;
        }
        $this->init($cryptKey, $algorithm);
    }

    /**
     * Get the instance of this class.
     *
     * @param string $cryptKey  Encryption key
     * @param string $algorithm Algorithm for encryption
     *
     * @return Msd_Crypt
     */
    public static function getInstance($cryptKey = null, $algorithm = null)
    {
        if (self::$_instance === null) {
            self::$_instance = new self($cryptKey, $algorithm);
        }

        return self::$_instance;
    }

    /**
     * Initializes the encryption descriptor.
     *
     * @param string $encryptionKey Key for encryption
     * @param string $algorithm     Algorithm for encryption
     *
     * @return void
     */
    public function init($encryptionKey = null, $algorithm = null)
    {
        if ($encryptionKey === null) {
            $encryptionKey = $this->_encryptionKey;
        }
        if ($algorithm === null) {
            $algorithm = $this->_algorithm;
        }
        if (!is_resource($this->_encDescriptor)) {
            $this->_encDescriptor = mcrypt_module_open(
                $algorithm,
                '',
                MCRYPT_MODE_ECB,
                ''
            );
            $vectorSize = mcrypt_enc_get_iv_size($this->_encDescriptor);
            $this->_initVector = mcrypt_create_iv($vectorSize, MCRYPT_RAND);
            $keySize = mcrypt_enc_get_key_size($this->_encDescriptor);
            $key = substr(md5($encryptionKey), 0, $keySize);

            mcrypt_generic_init(
                $this->_encDescriptor,
                $key,
                $this->_initVector
            );
            $this->_encryptionKey = $encryptionKey;
        }
    }

    /**
     * Uninitialize the encryption descriptor.
     *
     * @return void
     */
    public function deinit()
    {
        if (is_resource($this->_encDescriptor)) {
            mcrypt_generic_deinit($this->_encDescriptor);
        }
    }

    /**
     * Close the encryption descriptor
     *
     * @return void
     */
    public function close()
    {
        $this->deinit();
        if (is_resource($this->_encDescriptor)) {
            mcrypt_module_close($this->_encDescriptor);
        }
        $this->_encDescriptor = null;
    }

    /**
     * Decodes an base64 encoded string.
     *
     * @param string $encodedString base64 encoded string
     *
     * @return sting
     */
    private function _base64Decode($encodedString)
    {
        if (substr($encodedString, 0, 1) !== $this->_cryptIdent) {
            return $encodedString;
        }
        $encodedString = str_replace(
            array('.', '_', '-'),
            array('+', '/', '='),
            substr($encodedString, 1)
        );
        $decodedString = base64_decode($encodedString);
        return $decodedString;
    }

    /**
     * Encode a string into base64 notation.
     *
     * @param string $plainString Plaintext
     *
     * @return string
     */
    private function _base64Encode($plainString)
    {
        $encodedString = base64_encode($plainString);
        $encodedString = str_replace(
            array('+', '/', '='),
            array('.', '_', '-'),
            $encodedString
        );
        return $this->_cryptIdent . $encodedString;
    }

    /**
     * Decrypts a text.
     *
     * @param string $encryptedText Text to decrypt
     *
     * @return string
     */
    public function decrypt($encryptedText)
    {
        $encryptedText = $this->_base64Decode($encryptedText);
        if (!is_resource($this->_encDescriptor)) {
            $this->init($this->_encryptionKey);
        }
        $clearText = mdecrypt_generic(
            $this->_encDescriptor,
            $encryptedText
        );
        return trim($clearText);
    }

    /**
     * Encrypts a text
     *
     * @param string $clearText Text to encrypt
     *
     * @return string
     */
    public function encrypt($clearText)
    {
        if (!is_resource($this->_encDescriptor)) {
            $this->init();
        }
        $encryptedText = mcrypt_generic(
            $this->_encDescriptor,
            $clearText
        );
        return $this->_base64Encode($encryptedText);
    }

    /**
     * Class destructor
     *
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }
}

