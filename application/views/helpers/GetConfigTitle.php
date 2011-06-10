<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Get name of configuration
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_GetConfigTitle extends Zend_View_Helper_Abstract
{
    public function getConfigTitle($configName)
    {
        $config = Msd_Configuration::getInstance();
        $configData = $config->loadConfiguration($configName, false);
        return $configData->general->title;
    }
}
