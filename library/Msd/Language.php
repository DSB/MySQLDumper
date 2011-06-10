<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Language
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Language class implemented as singleton
 *
 * Handles translation of language variables.
 *
 * @package         MySQLDumper
 * @subpackage      Language
 */
class Msd_Language
{
    /**
     * Instance
     *
     * @var Msd_Configuration
     */
    private static $_instance = NULL;

    /**
     * Translator
     *
     * @var Zend_Translate
     */
    private $_translate = NULL;

    /**
     * Base directory for language files
     *
     * @var string
     */
    private $_baseLanguageDir = null;

    /**
     * Constructor gets the configuration params
     *
     * @return array
     */
    private function __construct ()
    {
        $config = Msd_Configuration::getInstance();
        $language = $config->get('config.interface.language');
        $this->loadLanguage($language);
    }

    /**
     * Load new language.
     *
     * @param string $language New language
     *
     * @return void
     */
    public function loadLanguage($language)
    {
        $this->_baseLanguageDir = APPLICATION_PATH . DS . 'language' . DS;
        $file = $this->_baseLanguageDir . $language . DS . 'lang.php';
        $translator = $this->getTranslator();
        if ($translator === null) {
            $translator = new Zend_Translate('array', $file, $language);
        } else {
            $translator->setAdapter(
                array(
                    'adapter' => 'array',
                    'content' => $file,
                    'locale' => $language
                )
            );
        }
        $this->setTranslator($translator);
        Zend_Registry::set('Zend_Translate', $translator);
    }
    /**
     * No cloning for singleton
     *
     * @return void
     */
    public function __clone()
    {
        throw new Msd_Exception('Cloning of Msd_Language is not allowed!');
    }

    /**
     * Magic getter to keep syntax in rest of script short
     *
     * @param mixed $var
     *
     * @return mixed
     */
    public function __get ($property)
    {
        $translated = $this->getTranslator()->_($property);
        if ($translated == $property && substr($property, 0, 2) == 'L_') {
            // no translation found -> remove prefix L_
            return substr($property, 2);
        }
        return $translated;
    }
    /**
     * Returns the single instance
     *
     * @return Msd_Language
     */
    public static function getInstance ()
    {
        if (NULL == self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Translate a Message from Zend_Validate.
     *
     * @param string $zendMessageId Message ID from Zend_Validate
     * @param string $messageText   Pre-translatet message
     *
     * @return string
     */
    public function translateZendId($zendMessageId, $messageText = '')
    {
        if (substr($zendMessageId, 0, 6) =='access' && $messageText > '') {
            // message is already translated by validator access
            return $messageText;
        }
        return $this->_translate->_(
            $this->_transformMessageId($zendMessageId)
        );
    }

    /**
     * Transforms a message ID in Zend_Validate format into Msd_Language format.
     *
     * @param string $zendMessageId Message ID from Zend_Validate
     *
     * @return string
     */
    private function _transformMessageId($zendMessageId)
    {
        $result = preg_replace('/([A-Z])/', '_${1}', $zendMessageId);
        $result = strtoupper($result);
        return 'L_ZEND_ID_' . $result;
    }

    /**
     * Get Translator
     *
     * @return Zend_Translate
     */
    public function getTranslator()
    {
        return $this->_translate;
    }

    /**
     * Set Translator
     *
     * @param Zend_Translate $translate
     *
     * @return void
     */
    public function setTranslator(Zend_Translate $translate)
    {
        $this->_translate = $translate;
    }

    /**
     * Retrieve a list of available languages.
     *
     * @return array
     */
    public function getAvailableLanguages()
    {
        $lang = array();
        include $this->_baseLanguageDir . 'lang_list.php';
        return $lang;
    }
}
