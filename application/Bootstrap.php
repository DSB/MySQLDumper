<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Bootstrap class
 *
 * @package         MySQLDumper
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addHelper(
            new Msd_Action_Helper_AssignConfigAndLanguage()
        );
    }

    /**
     * Start session
     *
     * Anyhing else is set in configs/application.ini
     *
     * @return void
     */
    public function _initApplication()
    {
        Zend_Session::setOptions(array('strict' => true));
        Zend_Session::start();
    }

    /**
     * Initialize configuration.
     *
     * @return void
     */
    public function _initConfiguration()
    {
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        if ($dynamicConfig === null) {
            $dynamicConfig = new Msd_Config_Dynamic();
            Msd_Registry::setDynamicConfig($dynamicConfig);
        }

        $config = Msd_Registry::getConfig();
        if ($config === null) {
            $configFile = $dynamicConfig->getParam('configFile', 'defaultConfig.ini');
            $config     = new Msd_Config(
                'Default',
                array('directories' => APPLICATION_PATH . '/configs')
            );
            $config->load($configFile);
        }
        Msd_Registry::setConfig($config);
    }

    /**
     * Un-quote a string or array
     *
     * @param string|array $value The value to strip
     *
     * @return string|array
     */
    public static function stripslashes_deep($value)
    {
        $value = is_array($value) ? array_map('Bootstrap::stripslashes_deep', $value) : stripslashes($value);
        return $value;
    }


}
