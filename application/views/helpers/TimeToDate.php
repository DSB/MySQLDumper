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
 * Returns a formatted string from a w3c timestamp
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_TimeToDate extends Zend_View_Helper_Abstract
{
    /**
     * Get date by native w3c timestamp
     *
     * @param string $time
     *
     * @return string
     */
    public function timeToDate($time)
    {
        Zend_Date::setOptions(array('format_type' => 'php'));
        try {
            $date = new Zend_Date($time);
            return $date->toString("d.m.Y H:i:s");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}