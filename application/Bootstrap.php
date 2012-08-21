<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package MySQLDumper
 * @version SVN: $Rev$
 * @author  $Author$
 */
/**
 * Bootstrap class
 *
 * @package MySQLDumper
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
     * Anything else is set in configs/application.ini
     *
     * @return void
     */
    public function _initApplication()
    {
        Zend_Session::setOptions(array('strict' => true));
        Zend_Session::start();

        // check if server has magic quotes enabled and normalize params
        if ((function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc() == 1)) {
            $_POST = Bootstrap::stripSlashesDeep($_POST);
        }

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
        }
        $configFile    = $dynamicConfig->getParam('configFile', 'defaultConfig.ini');
        Msd_Registry::setConfigFilename($configFile);
        $config = new Msd_Config(
            'Default',
            array('directories' => array(
                    realpath(APPLICATION_PATH . '/../work/config'),
                    realpath(APPLICATION_PATH . '/configs')
                )
            )
        );
        $config->load($configFile);
        Msd_Registry::setConfig($config);
        Msd_Registry::setDynamicConfig($dynamicConfig);
    }

    /**
     * Un-quote a string or array
     *
     * @param string|array $value The value to strip
     *
     * @return string|array
     */
    public static function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array('Bootstrap', 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

}
