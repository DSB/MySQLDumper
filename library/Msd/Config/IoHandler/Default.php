<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Config_IoHandler
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Class to handle input/output for configuration params.
 *
 * @package         MySQLDumper
 * @subpackage      Config_IoHandler
 */
class Msd_Config_IoHandler_Default implements Msd_Config_IoHandler_Interface
{
    /**
     * Array with directories, where config files are located.
     *
     * @var array
     */
    private $_configDirectories = array();

    /**
     * Handler for .ini files.
     *
     * @var Msd_Ini
     */
    private $_iniConfig = null;

    /**
     * Name of the .ini file, where the config is stored.
     *
     * @var string
     */
    private $_configFilename = null;

    /**
     * Configuration namespace in session.
     *
     * @var Zend_Session_Namespace
     */
    private $_sessionNamespace = null;

    /**
     * Class constructor
     *
     * @param array $handlerOptions
     *
     * @return Msd_Config_IoHandler_Default
     */
    public function __construct($handlerOptions = array())
    {
        if (isset($handlerOptions['directories'])) {
            $this->_configDirectories = (array) $handlerOptions['directories'];
        }

        // Create new namespace for session access.
        $this->_sessionNamespace = new Zend_Session_Namespace('config');
    }

    /**
     * Loads and returns a configuration from session or .ini file.
     * If the config is read from .ini file, it is also stored to session.
     *
     * @param string $configFilename Name of the .ini file, where the config is stored.
     *
     * @return array
     */
    public function load($configFilename)
    {
        // Retrieve config from session
        $config = (array) $this->_sessionNamespace->config;
        $this->_configFilename = $configFilename;

        // Check whether the configuration has been loaded.
        if (count($config) == 0) {

            // Search for the config file in the given directories.
            $this->_initIni($config);
            $config = $this->_iniConfig->getIniData();
            // Put configuration into session.
            $this->_sessionNamespace->config = $config;
        }

        return $config;
    }

    /**
     * Set configuration file name
     *
     * @param string $configFilename File name of configuration file (without path)
     */
    public function setConfigFilename($configFilename)
    {
        $this->_configFilename = $configFilename;
    }

    /**
     * Saves the configuration to session and .ini file.
     *
     * @param array $config Configuration to save.
     *
     * @throws Msd_Config_Exception
     *
     * @return bool
     */
    public function save($config)
    {
        if ($this->_iniConfig === null) {
            $this->_initIni($config);
        }

        // Save config to .ini file
        $this->_iniConfig->setIniData($config);

        // Save config to session
        $this->_sessionNamespace->config = $config;
        if (!isset($this->_configDirectories[0])) {
            throw new Msd_Config_Exception('No directory for saving the configuration set!');
        }
        $configDirectory = $this->_configDirectories[0];
        return $this->_iniConfig->saveFile($configDirectory . '/' . $this->_configFilename);
    }

    /**
     * Initializes the .ini file handler and sets the full filename of the .ini file.
     *
     * @param array $config Configuration as array
     *
     * @return void
     */
    private function _initIni($config)
    {
        foreach ($this->_configDirectories as $configDir) {
            $filename = rtrim($configDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->_configFilename;
            if (file_exists($filename)) {
                $this->_configFilename = basename($filename);
                $this->_iniConfig = new Msd_Ini($filename);
                return;
            }
        }
        $this->_iniConfig = new Msd_Ini();
        $this->_iniConfig->setIniData($config);
    }
}
