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
 * Abstract decorator for form elements of Msd_Form
 *
 * @package         MySQLDumper
 * @subpackage      Registry
 */
class Msd_Registry extends Zend_Registry
{
    /**
     * Returns the config instance if it has been registered, returns null otherwise.
     *
     * @return Msd_Config|null
     */
    public static function getConfig()
    {
        if (self::isRegistered('_config')) {
            return self::get('_config');
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
        self::set('_config', $config);
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
        if (self::isRegistered('_dynamic')) {
            return self::get('_dynamic');
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
        self::set('_dynamic', $config);
    }
}
