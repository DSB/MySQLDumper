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
 * Get name of currently logged in user
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_GetUsername extends Zend_View_Helper_Abstract
{
    /**
     * Get name of currently logged in user
     *
     * @param string $time
     *
     * @return string
     */
    public function getUsername()
    {
        $auth =Zend_Auth::getInstance()->getIdentity();
        return $auth['name'];
    }
}