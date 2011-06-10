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
 * Convert output to HTML
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_Out extends Zend_View_Helper_Abstract
{
    /**
     * Helper to convert common values to HTML output
     *
     * Escape values
     * Conditionally convert NULL values to "NULL" as string.
     * Conditionally surround value with a HTML tag.
     *
     * @param string  $value     The value that may be converted
     * @param boolean $ouputNull Whether to convert NULL values to string NULL
     * @param string  $decorator Decorate output with this HTML-Tag
     *
     * @return string HTML-Text ready to print to screen
     */
    public function out($value, $outputNull = false, $decorator = '')
    {
        $ret = $this->view->escape($value);
        if ($outputNull === true && is_null($value)) {
            $ret = 'NULL';
        }
        if ($decorator > '') {
            /*
             * '%1$s means: Use the same value as in the first appearance of
             * '%s' is used.
             */
            $ret = sprintf('<%s>'.$ret.'</%1$s>', $decorator);
        }
        return $ret;
    }

}
