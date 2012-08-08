<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Registry
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Registry
 *
 * @package         MySQLDumper
 * @subpackage      Registry
 */
class Msd_Registry extends Zend_Registry
{
    /**
     * Key for the configuration filename. This is used inside the registry.
     *
     * @const string
     */
    const CONFIG_FILENAME_KEY = '_configFilename';

    /**
     * Key for the dynamic configuration. This is used inside the registry.
     *
     * @const string
     */
    const DYNAMIC_CONFIG_KEY = '_dynamic';

    /**
     * Key for the configuration. This is used inside the registry.
     *
     * @const string
     */
    const CONFIG_KEY = '_config';

    /**
     * Returns the config instance if it has been registered, returns null otherwise.
     *
     * @return Msd_Config|null
     */
    public static function getConfig()
    {
        if (self::isRegistered(self::CONFIG_KEY)) {
            return self::get(self::CONFIG_KEY);
        }

        return null;
    }

    /**
     * Register a Msd_Config instance.
     *
     * @static
     *
     * @param Msd_Config $config Configuration
     *
     * @return void
     */
    public static function setConfig(Msd_Config $config)
    {
        self::set(self::CONFIG_KEY . '', $config);
    }

    /**
     * Returns the dynamic config if it has been registered.
     *
     * @static
     *
     * @return Msd_Config_Dynamic|null
     */
    public static function getDynamicConfig()
    {
        if (self::isRegistered(self::DYNAMIC_CONFIG_KEY)) {
            return self::get(self::DYNAMIC_CONFIG_KEY);
        }

        return null;
    }

    /**
     * Registers the dynamic configuration.
     *
     * @static
     *
     * @param Msd_Config_Dynamic $config Dynamic configuration.
     *
     * @return void
     */
    public static function setDynamicConfig(Msd_Config_Dynamic $config)
    {
        self::set(self::DYNAMIC_CONFIG_KEY, $config);
    }

    /**
     * Returns the name of the current configuration file.
     *
     * @return string
     */
    public static function getConfigFilename()
    {
        if (self::isRegistered(self::CONFIG_FILENAME_KEY)) {
            return self::get(self::CONFIG_FILENAME_KEY);
        }
        return null;
    }

    /**
     * Sets the name of the current configuration file.
     *
     * @param string $configFilename Name of configuration file.
     *
     * @return void
     */
    public static function setConfigFilename($configFilename)
    {
        self::set(self::CONFIG_FILENAME_KEY, $configFilename);
    }
}
