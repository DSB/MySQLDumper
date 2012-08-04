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
 * Class to handle the configuration
 *
 * @throws Msd_Config_Exception
 * @package         MySQLDumper
 * @subpackage      Config
 */
class Msd_Config
{
    /**
     * The configuration itself.
     *
     * @var array
     */
    private $_config = null;

    /**
     * Instance of the IO-Handler.
     *
     * @var Msd_Config_IoHandler_Interface
     */
    private $_ioHandler = null;

    /**
     * Status for the automatic configuration saving on class destruction.
     * It's disabled by default.
     *
     * @var bool
     */
    private $_autosave = false;

    /**
     * Class constructor
     *
     * @param Msd_Config_IoHandler_Interface|string $ioHandler      Instance or name of the IO-Handler.
     * @param array                                 $handlerOptions Options for the IO-Handler.
     *
     * @throws Msd_Config_Exception
     */
    public function __construct($ioHandler, $handlerOptions = array())
    {
        if (is_string($ioHandler)) {
            $pluginLoader = new Zend_Loader_PluginLoader(
                array(
                    'Msd_Config_IoHandler_' => APPLICATION_PATH . '/../library/Msd/Config/IoHandler/',
                    'Module_Config_IoHandler_' => APPLICATION_PATH . '/../modules/library/Config/IoHandler/',
                )
            );

            $className = $pluginLoader->load($ioHandler);
            $ioHandler = new $className($handlerOptions);
        }
        if (!$ioHandler instanceof Msd_Config_IoHandler_Interface) {
            throw new Msd_Config_Exception(
                "Invalid IO-Handler specified; The IO-Handler must implement Msd_Config_IoHandler_Interface"
            );
        }
        $this->_ioHandler = $ioHandler;
    }

    /**
     * Loads the configuration from the IO-Handler.
     * The filename is used for static storage.
     *
     * @param string $configFilename Name of file on the static storage.
     *
     * @return void
     */
    public function load($configFilename)
    {
        $this->_config = $this->_ioHandler->load($configFilename);
    }

    /**
     * Saves the configuration for the next request.
     * The filename is used for static storage.
     *
     * @return bool
     */
    public function save()
    {
        return $this->_ioHandler->save($this->_config);
    }

    /**
     * Retrieves the value of a configuration parameter.
     *
     * @param string $paramName    Name of the configuration parameter.
     * @param mixed  $defaultValue Default value to return, if param isn't set.
     *
     * @return mixed
     */
    public function getParam($paramName, $defaultValue = null)
    {
        if (isset($this->_config[$paramName])) {
            return $this->_config[$paramName];
        }

        return $defaultValue;
    }

    /**
     * Sets a configuration parameter.
     * If auto-save is enabled the configuration is also saved.
     *
     * @param $paramName
     * @param $paramValue
     *
     * @return void
     */
    public function setParam($paramName, $paramValue)
    {
        $this->_config[$paramName] = $paramValue;
        if ($this->_autosave) {
            $this->save();
        }
    }

    /**
     * Class destructor.
     * If auto-save is enabled the configuration will be saved.
     */
    public function __destruct()
    {
        if ($this->_autosave) {
            $this->save();
        }
    }

    /**
     * Sets the whole configuration.
     * If auto-save is enabled the configuration is also saved.
     *
     * @param array $config New configuration.
     */
    public function setConfig($config)
    {
        $this->_config = (array) $config;
        if ($this->_autosave) {
            $this->save();
        }
    }

    /**
     * Returns the whole configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Enables automatic configuration saving.
     *
     * @return void
     */
    public function enableAutosave()
    {
        $this->_autosave = true;
    }

    /**
     * Disables automatic configuration saving.
     *
     * @return void
     */
    public function disableAutosave()
    {
        $this->_autosave = false;
    }

    /**
     * Returns the autosave status.
     *
     * @return bool
     */
    public function isAutosaveActive()
    {
        return $this->_autosave;
    }
}
