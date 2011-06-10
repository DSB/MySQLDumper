<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * String-Helper Class
 *
 * Class has some static methods to modify String-output
 */
class String
{
    /**
     * Format the given number to better readable number
     *
     * @param float|int $number    Number to format
     * @param int       $precision Selected format precision
     *
     * @return string Formatted number
     */
    public static function formatNumber($number, $precision = 0)
    {
        $formattedNumber = number_format(
            (float) $number,
            (int) $precision,
            ',',
            '.'
        );
        return $formattedNumber;
    }
}