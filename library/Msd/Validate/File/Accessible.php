<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package    MySQLDumper
 * @subpackage Ini
 * @version    SVN: $Rev$
 * @author     $Author$
 */

require_once 'Zend/Validate/Abstract.php';
/**
 * Class to check the accessibility for files and directories.
 *
 * @package         MySQLDumper
 * @subpackage      Validate
 */
class Msd_Validate_File_Accessible extends Zend_Validate_Abstract
{
    /**
     * @const string Error constant, file/directory doesn't exists.
     */
    const NOT_EXISTS = 'accessNotExists';

    /**
     * @const string Error constant, file/directory isn't readable.
     */
    const NOT_READABLE = 'accessNotReadable';

    /**
     * @const string Error constant, file/directory isn't writable.
     */
    const NOT_WRITABLE = 'accessNotWritable';

    /**
     * @const string Error constant, file/directory isn't executable.
     */
    const NOT_EXECUTABLE = 'accessNotExecutable';

    /**
     * @const string Error constant, file/directory isn't a directory.
     */
    const NOT_A_DIRECTORY = 'accessNotADirectory';

    /**
     * @const string Error constant, file/directory isn't file.
     */
    const NOT_A_FILE = 'accessNotAFile';

    /**
     * @const string Error constant, file/directory isn't link.
     */
    const NOT_A_LINK = 'accessNotALink';

    /**
     * @const string Error constant, file/directory wasn't uploaded.
     */
    const NOT_UPLOADED = 'accessNotUploaded';

    /**
     * @var array Error message templates
     */
    protected $_messageTemplates = array();

    /**
     * @var array Options that determine which access types must checked.
     *
     * 'pathPrefix'  - Will be prepended to the filename in checking method.
     * 'accessTypes' - Access variants, that will be checked.
     */
    protected $_options = array(
        'pathPrefix' => '',
        'accessTypes' => array(
            'read' => false,
            'write' => false,
            'execute' => false,
            'dir' => false,
            'file' => false,
            'uploaded' => false,
        ),
    );


    /**
     * Class constructor. creates and initializes an instance of this validator.
     *
     * @param array $options Access checking options.
     *                       'pathPrefix' must be a string.
     *                       'accessTypes' could be an array, string or an
     *                           instance of Zend_config
     *                       @see self::$options
     * @return void
     */
    public function __construct($options = null)
    {
        ///get error messages from selected language
        $lang = Msd_Language::getInstance()->getTranslator();
        $this->_messageTemplates = array(
            self::NOT_EXISTS => $lang->_('L_ZEND_ID_ACCESS_NOT_EXISTS'),
            self::NOT_READABLE => $lang->_('L_ZEND_ID_ACCESS_NOT_READABLE'),
            self::NOT_WRITABLE => $lang->_('L_ZEND_ID_ACCESS_NOT_WRITABLE'),
            self::NOT_EXECUTABLE => $lang->_('L_ZEND_ID_ACCESS_NOT_EXECUTABLE'),
            self::NOT_A_FILE => $lang->_('L_ZEND_ID_ACCESS_NOT_A_FILE'),
            self::NOT_A_DIRECTORY =>
                $lang->_('L_ZEND_ID_ACCESS_NOT_A_DIRECTORY'),
            self::NOT_A_LINK => $lang->_('L_ZEND_ID_ACCESS_NOT_A_LINK'),
            self::NOT_UPLOADED => $lang->_('L_ZEND_ID_ACCESS_NOT_UPLOADED'),
        );
        if ($options !== null) {
            $this->setOptions($options);
        }
    }

    /**
     * Sets the options for validation.
     *
     * @throws Msd_Validate_Exception
     * @param array $options Options for the validation
     * @see self::$options
     * @return void
     */
    public function setOptions($options)
    {
        if (!is_array($options)) {
            include_once 'Msd/Validate/Exception.php';
            throw new Msd_Validate_Exception(
                'Options must be an array, string or instance '
                . 'of Zend_Config!'
            );
        }
        if (isset($options['accessTypes'])) {
            $accessTypes = array();
            if (is_array($options['accessTypes'])) {
                $accessTypes = $options['accessTypes'];
            } else if (is_string($options['accessTypes'])) {
                $accessTypes = explode(',', $options['accessTypes']);
            } else if ($options['accessTypes'] instanceof Zend_Config) {
                $accessTypes = $options['accessTypes']->toArray();
            } else {
                include_once 'Msd/Validate/Exception.php';
                throw new Msd_Validate_Exception(
                    'Access types must be an array, string or instance '
                    . 'of Zend_Config!'
                );
            }

            foreach ($accessTypes as $accessType) {
                if (isset($this->_options['accessTypes'][$accessType])) {
                    $this->_options['accessTypes'][$accessType] = true;
                }
            }
        }

        if (isset($options['pathPrefix'])) {
            $this->_options['pathPrefix'] = $options['pathPrefix'];
        }
    }

    /**
     * Returns the current options array.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Defiend by Zend_Validate_Interface
     *
     * Checks the accessibility of a file.
     *
     * @param  string $fileName Name of the file to be checked.
     * @return bool
     */
    public function isValid($fileName)
    {
        clearstatcache(true, $fileName);
        $this->_setValue($fileName);
        $fileName = $this->_options['pathPrefix'] . $fileName;
        $isValid = true;
        $accessTypes = $this->_options['accessTypes'];
        if (!file_exists($fileName)) {
            $this->_error(self::NOT_EXISTS);
            $isValid = false;
        }
        if ($accessTypes['read']) {
            if (!is_readable($fileName)) {
                $this->_throw($fileName, self::NOT_READABLE);
                $isValid = false;
            }
        }
        if ($accessTypes['write']) {
            if (!is_writable($fileName)) {
                $this->_throw($fileName, self::NOT_WRITABLE);
                $isValid = false;
            }
        }
        if ($accessTypes['execute']) {
            if (!is_executable($fileName)) {
                $this->_throw($fileName, self::NOT_EXECUTABLE);
                $isValid = false;
            }
        }
        if ($accessTypes['dir']) {
            if (!is_dir($fileName)) {
                $this->_throw($fileName, self::NOT_A_DIRECTORY);
                $isValid = false;
            }
        }
        if ($accessTypes['file']) {
            if (!is_file($fileName)) {
                $this->_throw($fileName, self::NOT_A_FILE);
                $isValid = false;
            }
        }
        if ($accessTypes['uploaded']) {
            if (!is_uploaded_file($fileName)) {
                $this->_throw($fileName, self::NOT_UPLOADED);
                $isValid = false;
            }
        }

        return $isValid;
    }

    /**
     * Throws an error of the given type
     *
     * @param  string $fileName  checked file which caused an error
     * @param  string $errorType Type of error
     * @return false
     */
    protected function _throw($fileName, $errorType)
    {
        if ($fileName !== null) {
            $this->_setValue($fileName);
        }

        $this->_error($errorType);
        return false;
    }

}
