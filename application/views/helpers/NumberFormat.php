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
 * Formats a number
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_NumberFormat extends Zend_View_Helper_Abstract
{
    /**
     * Format a number and return string ready to output
     *
     * @param float $nr        Number to format
     * @param int   $precision Precision defaults to 0
     *
     * @return string
     */
    public function numberFormat($number, $precision = 0)
    {
        $number = round($number, $precision);
        $ret = number_format($number, $precision, ',', '.');
        return $ret;
    }
}
