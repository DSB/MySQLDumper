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
 * Interface for configuration IO-Handler.
 *
 * @package         MySQLDumper
 * @subpackage      Config_IoHandler
 */
interface Msd_Config_IoHandler_Interface
{
    /**
     * Class constructor
     *
     * @abstract
     *
     * @param array $handlerOptions
     *
     * @return Msd_Config_IoHandler_Interface
     */
    public function __construct($handlerOptions = array());

    /**
     * Loads and returns the configuration.
     *
     * @abstract
     *
     * @param string $configFilename
     *
     * @return array
     */
    public function load($configFilename);

    /**
     * Saves the configuration.
     *
     * @abstract
     *
     * @param array $config
     *
     * @return bool
     */
    public function save($config);
}
