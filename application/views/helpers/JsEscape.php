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
 * Escape quotes in strings placed inside javascript alerts or confirms
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_JsEscape extends Zend_View_Helper_Abstract
{
    /**
     * Escape quotes
     *
     * @param string $text
     *
     * @return string
     */
    public function jsEscape($text)
    {
        return str_replace('\'', '\\\'', $text);
    }
}
