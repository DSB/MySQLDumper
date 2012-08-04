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
 * Helper for getting dynamic configuration values like phpRam etc.
 *
 * @package         MySQLDumper
 * @subpackage      Configuration
 */
class Msd_ConfigurationPhpValues
{
    /**
     * Read dynamic PHP config values
     *
     * @return Zend_Config
     */
    public static function getDynamicValues ()
    {
        $phpRam = self::_getPhpRam();
        $dynConfig = array(
            'sendmailCall' => self::_getConfigSetting('sendmail_path'),
            'safeMode' => self::_getConfigSetting('safe_mode', true),
            'magicQuotesGpc' => get_magic_quotes_gpc(),
            'disabledPhpFunctions' =>
                str_replace(
                    ',',
                    ', ',
                    self::_getConfigSetting('disable_functions')
                ),
            'maxExecutionTime' => self::_getMaxExecutionTime(),
            'uploadMaxFilesize' => self::_getUploadMaxFilesize(),
            'phpextensions' => implode(', ', get_loaded_extensions()),
            'phpRam' => $phpRam,
            'memoryLimit' => round($phpRam * 1024 * 1024 * 0.9, 0),
            'compression' => self::_hasZlib(),
        );
        return new Zend_Config($dynConfig, true);
    }

    /**
     * Read PHP's max_execution_time
     *
     * @return int
     */
    private static function _getMaxExecutionTime()
    {
        $maxExecutionTime =
            self::_getConfigSetting('max_execution_time', true);
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
    private static function _getUploadMaxFilesize()
    {
        $uploadMaxFilesize = self::_getConfigSetting('upload_max_filesize');
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
    private static function _getPhpRam()
    {
        $ram = self::_getConfigSetting('memory_limit');
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
    private static function _hasZlib()
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
