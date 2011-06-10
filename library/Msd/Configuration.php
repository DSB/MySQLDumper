<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Configuration
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Configuration class implemented as singleton
 *
 * Handles getting and setting of configuration variables
 *
 * @package         MySQLDumper
 * @subpackage      Configuration
 */
class Msd_Configuration
{
    /**
     * Instance
     *
     * @var Msd_Configuration
     */
    private static $_instance = NULL;
    /**
     * Configuration params
     *
     * @var StdClass
     */
    private $_data = null;

    /**
     * Session to old values
     *
     * @var Zend_Session_Namespace
     */
    private $_session = null;

    /**
     * Constructor
     *
     * @param string $configName   The name of the configuration file to load.
     *                             If not set we will load the config from
     *                             session if present.
     * @param bool   $forceLoading Force loading of configuration from file
     */
    private function __construct($configName = '', $forceLoading = false)
    {
        $this->_session = new Zend_Session_Namespace('MySQLDumper');
        if ($forceLoading === false && isset($this->_session->dynamic->configFile)) {
            $this->loadConfigFromSession();
            return;
        }

        $this->_data = new stdClass;

        if ($configName == '') {
            $configName = 'defaultConfig';
        }
        $this->_data->dynamic = Msd_ConfigurationPhpValues::getDynamicValues();
        $this->_data->paths = $this->_loadUserDirectories();
        $this->loadConfiguration($configName);
        $this->set('dynamic.configFile', $configName);

        $defaultDb = $this->get('config.dbuser.defaultDb');
        if ($defaultDb != '') {
            $this->set('dynamic.dbActual', $defaultDb);
        }

        $this->saveConfigToSession();
    }

    /**
     * No cloning for singleton
     *
     * @return void
     */
    public function __clone()
    {
        throw new Msd_Exception('Cloning is not allowed');
    }

    /**
     * Returns the configuration instance
     *
     * @param string  $configName   The name of the configuration file to load.
     *                              If not set we will load the config from
     *                              session if present.
     * @param boolean $forceLoading If set the config will be read from file.
     *
     * @return Msd_Configuration
     */
    public static function getInstance($configName = '', $forceLoading = false)
    {
        if (null == self::$_instance) {
            self::$_instance = new self($configName, $forceLoading);
        }
        if ($forceLoading) {
            self::$_instance->loadConfiguration($configName, true);
        }
        return self::$_instance;
    }

    /**
     * Set a key to a val
     *
     * @param string $configPath Must begin with "config", "dynamic" or "paths"
     * @param string $val        The value to set
     *
     * @return Msd_Configuration
     */
    public function set($configPath, $val)
    {
        $args = explode('.', $configPath);
        if (!in_array($args[0], array('config', 'paths', 'dynamic'))) {
            $msg = 'Trying to set config value with illegal key. First key '
                   . 'must be "config", "paths" or "dynamic"';
            throw new Msd_Exception($msg);
        }
        switch (count($args)) {
            case 2:
                list($type, $var) = $args;
                $this->_data->$type->$var = $val;
                break;
            case 3:
                list($type, $section, $var) = $args;
                $this->_data->$type->$section->$var = $val;
                break;
            default:
                $backTrace = debug_backtrace(false);
                throw new Msd_Exception(
                    'Path couldn\'t be set!' . PHP_EOL . $configPath .
                    ' invoked from ' . $backTrace[0]['file'] . '[' .
                    $backTrace[0]['line'] . ']',
                    E_USER_NOTICE
                );
        }
        return $this;
    }

    /**
     * Get a config parameter
     *
     * If first part isn't config, paths or dynamic, we assume config is meant.
     *
     * @param string $key Path to get
     *
     * @return string|array
     */
    public function get($key)
    {
        $params = explode('.', $key);
        if (!in_array($params[0], array('config', 'paths', 'dynamic'))) {
            $msg = 'Trying to get config value with illegal key. First key '
                   . 'must be "config", "paths" or "dynamic"';
            throw new Msd_Exception($msg);
        }
        $values = $this->_data->$params[0];
        if (!is_array($values)) {
            $values = $this->_data->$params[0]->toArray();
        }
        if (sizeof($params) == 1) {
            return $values;
        }
        unset($params[0]);
        foreach ($params as $index) {
            if (isset($values[$index])) {
                $values = $values[$index];
            } else {
                $values = null;
                break;
            }
        }
        return $values;
    }

    /**
     * Save configurations to file
     *
     * @param string $fileName  Name of configuration without extension .ini
     * @param array  $configArray Data to save as array
     *
     * @return void
     */
    public function save($fileName = null, $configArray = null)
    {
        if ($fileName === null) {
            $fileName = $this->get('dynamic.configFile');
        }
        $fileName .= '.ini';
        // save branch config and skip groups "dynamic" and "paths"
        if ($configArray !== null) {
            $configData = new Zend_Config($configArray, true);
        } else {
            $configData = $this->_data->config;
        }
        $configWriter = new Zend_Config_Writer_Ini(
            array(
                 'filename' => $this->get('paths.config') . DS . $fileName,
                 'config' => $configData,
            )
        );
        $configWriter->write();
        $this->_data->config = $configData;
        $this->set('dynamic.configFile', basename($fileName, '.ini'));
        $this->saveConfigToSession();
    }

    /**
     * Save config to session
     *
     * @return void
     */
    public function saveConfigToSession()
    {
        $this->_session->unsetAll();
        $this->_session->config = $this->_data->config;
        $this->_session->dynamic = $this->_data->dynamic;
        $this->_session->paths = $this->_data->paths;
    }

    /**
     * Get config from session
     *
     * @return object
     */
    public function loadConfigFromSession()
    {
        if (isset($this->_session->config)) {
            $this->_data->config = $this->_session->config;
        }
        if (isset($this->_session->dynamic)) {
            $this->_data->dynamic = $this->_session->dynamic;
        }
        if (isset($this->_session->paths)) {
            $this->_data->paths = $this->_session->paths;
        }
    }

    /**
     * Load configuration file
     *
     * @param string  $configName  The configuration file to load
     * @param boolean $applyValues Whether to apply loaded values to config
     *
     * @return Zend_Config_ini Loaded configuration as Zend_Config_Ini
     */
    public function loadConfiguration($configName, $applyValues = true)
    {
        $this->_loadUserDirectories();
        if ($configName != 'defaultConfig') {
            $configName .= '.ini';
            $configPath = $this->get('paths.config');
            $configFile = $configPath . DS . $configName;
        } else {
            // special case - defaultConfig.ini is in application/configs
            $configFile = realpath(APPLICATION_PATH . DS . 'configs')
                          . DS . 'defaultConfig.ini';
        }
        if (!is_readable($configFile)) {
            throw new Msd_Exception(
                'Couldn\'t read configuration file ' . $configFile
            );
        }
        $options = array('allowModifications' => true);
        $config = new Zend_Config_Ini($configFile, null, $options);
        if (!$applyValues) {
            return $config;
        }
        $this->_data->config = null;
        $this->_data->config = $config;
        $this->set('dynamic.configFile', basename($configFile, '.ini'));
        $iconPath = 'css/' . $this->get('config.interface.theme') . '/icons';
        $this->set('paths.iconpath', $iconPath);
        $this->saveConfigToSession();
        return $config;
    }

    /**
     * Get user directories and save them to config
     *
     * @return Zend_Config Directories as object
     */
    private function _loadUserDirectories()
    {
        // set paths
        $workRoot = realpath(APPLICATION_PATH . DS . '..') . DS . 'work' . DS;
        $directories = array(
            'work' => $workRoot,
            'log' => $workRoot . 'log',
            'backup' => $workRoot . 'backup',
            'config' => $workRoot . 'config'
        );
        return new Zend_Config($directories, true);
    }

    /**
     * Return name of configuration
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->get('config.general.title');
    }

    /**
     * Reloads the configuration from the current ini file.
     *
     * @return void
     */
    public function reloadConfig()
    {
        $this->loadConfiguration($this->get('dynamic.configFile'));
    }
}
