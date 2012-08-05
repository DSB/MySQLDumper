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
 * Class for dynamic (session lifetime) configuration settings.
 *
 * @package         MySQLDumper
 * @subpackage      Config
 */
class Msd_Config_Dynamic
{
    /**
     * Instance of Zend_Session_Namespace for session storage.
     *
     * @var Zend_Session_Namespace
     */
    private $_namespace = null;

    /**
     * Class constructor.
     *
     * @param string $sessionNsName Name of the session namespace.
     *
     * @return Msd_Config_Dynamic
     */
    public function __construct($sessionNsName = 'Dynamic')
    {
        $this->_namespace = new Zend_Session_Namespace($sessionNsName, true);
        $this->getDynamicValues();
    }

    /**
     * Retrieves the value of a parameter.
     *
     * @param string $name    Name of the parameter.
     * @param mixed  $default Default value to return, if param isn't set.
     *
     * @return mixed
     */
    public function getParam($name, $default = null)
    {
        if (isset($this->_namespace->$name)) {
            return $this->_namespace->$name;
        }

        return $default;
    }

    /**
     * Sets a value for the given parameter.
     *
     * @param string $name  Name of the parameter.
     * @param mixed  $value Value for the parameter.
     *
     * @return void
     */
    public function setParam($name, $value)
    {
        $this->_namespace->$name = $value;
    }

    /**
     * Read dynamic PHP config values
     *
     * @return Zend_Config
     */
    public function getDynamicValues ()
    {
        $this->setParam('compression', self::_hasZlib());
        $this->setParam('phpExtensions', str_replace(',', ', ', implode(', ', get_loaded_extensions())));
        $phpRam = $this->_getPhpRam();
        $this->setParam('phpRam', $phpRam);
        $this->setParam('memoryLimit', round($phpRam * 1024 * 1024 * 0.9, 0));
        $this->setParam('sendmailCall', $this->_getConfigSetting('sendmail_path'));
        $this->setParam('safeMode', $this->_getConfigSetting('safe_mode', true));
        $this->setParam('magicQuotesGpc', get_magic_quotes_gpc());
        $disabledPhpFunctions = $this->_getConfigSetting('disable_functions');
        $this->setParam('disabledPhpFunctions', str_replace(',', ', ', $disabledPhpFunctions));
        $this->setParam('maxExecutionTime', $this->_getMaxExecutionTime());
        $this->setParam('uploadMaxFilesize', $this->_getUploadMaxFilesize());
    }

    /**
     * Read PHP's max_execution_time
     *
     * @return int
     */
    private function _getMaxExecutionTime()
    {
        $maxExecutionTime =
            $this->_getConfigSetting('max_execution_time', true);
        if ($maxExecutionTime <= 5) {
            // we didn't get the real value from the server - some deliver "-1"
            $maxExecutionTime = 30;
        } elseif ($maxExecutionTime > 30) {
            // we don't use more than 30 seconds to avoid brower timeouts
            $maxExecutionTime = 30;
        }
        return $maxExecutionTime;
    }

    /**
     * Get PHP's upload_max_filesize
     *
     * @return int
     */
    private function _getUploadMaxFilesize()
    {
        $uploadMaxFilesize = $this->_getConfigSetting('upload_max_filesize');
        // Is value in Megabytes? If yes create output
        if (strpos($uploadMaxFilesize, 'M')) {
            $uploadMaxFilesize = str_replace('M', '', $uploadMaxFilesize);
            $uploadMaxFilesize = trim($uploadMaxFilesize);
            // re-calculate to Bytes
            $uploadMaxFilesize *= 1024 * 1024;
        }
        return (int) $uploadMaxFilesize;;
    }

    /**
     * Get PHP's ram size
     *
     * @return integer The memory limit in MB
     */
    private function _getPhpRam()
    {
        $ram = $this->_getConfigSetting('memory_limit');
        // we don't trust the value delivered by server config if < 16
        if ($ram < 16) {
            $ram = 16;
        }
        return $ram;
    }

    /**
     * Detect if zlib is installed
     *
     * @return boolean
     */
    private function _hasZlib()
    {
        $zlib = false;
        $extensions = get_loaded_extensions();
        if (in_array('zlib', $extensions)) {
            $zlib = true;
        };
        return (boolean) $zlib;
    }

    /**
     * Returns a PHP-Setting from ini
     *
     * First try to read via ini_get(), then fall back to get_cfg_var()
     *
     * @param string  $varName     The name of the setting to read
     * @param bool    $returnAsInt Whether to return value as integer
     *
     * @return mixed
     */
    private function _getConfigSetting($varName, $returnAsInt = false)
    {
        $value = @ini_get($varName);

        // fallback if ini_get doesn't work
        if ($value == '' || $value === null) {
            $value = @get_cfg_var($varName);
        }

        if ($returnAsInt) {
            $value = (int) $value;
        }
        return $value;
    }

}
