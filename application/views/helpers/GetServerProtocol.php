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
 * Get server protocol
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_GetServerProtocol extends Zend_View_Helper_Abstract
{
    /**
     * Get server protocol
     *
     * @return string
     */
    public function getServerProtocol()
    {
        if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
            return 'https://';
        } else {
            return 'http://';
        }
    }

}