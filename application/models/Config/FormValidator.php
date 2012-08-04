<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Config
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Config Validator
 *
 * Model to validate configuration values set in config form
 *
 * @package         MySQLDumper
 * @subpackage      Config
 */

class Application_Model_Config_FormValidator
{
    /**
     * Config data to validate
     * @var array
     */
    private $_configData = array();

    /**
     * Construct
     *
     * @param array $configData The data to validate
     */
    public function __construct($configData)
    {
        // unset values we only used for form handling
        unset(
            $configData['general']['selectedTab'],
            $configData['general']['param']
        );
        $this->_configData = $configData;
    }

    /**
     * Validate config data
     *
     * Checks database connection params.
     * If connection is successfull the values are saved to the config file.
     *
     * @param Zend_View $view The view of the form for adding messages
     */
    public function validate(Zend_View $view)
    {
        $saveConfig = false;
        $config = $view->config;
        $translator = Msd_Language::getInstance()->getTranslator();
        $db = Msd_Db::getAdapter($this->_configData['dbuser']);
        try {
            $db->getServerInfo();
            $saveConfig = true;
        } catch (Msd_Exception $e) {
            $msg = $translator->_('L_ERROR').' (' . $e->getCode().') ';
            $msg .= $e->getMessage();
            $view->popUpMessage()->addMessage(
                'db-access-error',
                'L_ERROR',
                $msg,
                array(
                    'modal' => true,
                    'dialogClass' => 'error',
                )
            );
        }

        if ($saveConfig) {
            $config->save(
                $view->dynamicConfig->getParam('configFile'),
                $this->_configData
            );
            $view->popUpMessage()->addMessage(
                'save-config',
                'L_NOTICE',
                array('L_SAVE_SUCCESS', $view->dynamicConfig->getParam('configFile')),
                array(
                    'modal' => true,
                    'dialogClass' => 'notice'
                )
            );
        }
    }
}
