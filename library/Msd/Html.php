<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Html
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */
/**
 * HTML-Helper Class
 *
 * Class has some static methods for building HTML-output
 *
 * @package         MySQLDumper
 * @subpackage      Html
 */
class Msd_Html
{
    /**
     * Escape quotes and/or slashes and double quotes.
     *
     * Used for escaping strings in JS-alerts and config-files.
     *
     * @param string  $string        String to escape
     * @param boolean $escapeSlashes Escape slashes and double quotes
     *
     * @return string Escaped string
     */
    public static function getJsQuote($string, $escapeSlashes = false)
    {
        if ($escapeSlashes) {
            $string = str_replace('/', '\/', $string);
            $string = str_replace('"', '\"', $string);
        }
        $string = str_replace("\n", '\n', $string);
        return str_replace("'", '\\\'', $string);
    }

    /**
     * Extract group prefixes from key names of array
     *
     * Returns a new array containing the different prefixes. Used for building
     * filter select boxes (e.g. sqlserver/show.variables).
     *
     * @param array $array Array to scan for prefixes
     *
     * @return array The array conatining the unique prefixes
     */
    public static function getPrefixArray($array)
    {
        $prefixes = array();
        $keys = array_keys($array);
        foreach ($keys as $k) {
            $pos = strpos($k, '_'); // find '_'
            if ($pos !== false) {
                $prefix = substr($k, 0, $pos);
                if (!in_array($prefix, $prefixes)) {
                    $prefixes[$prefix] = $prefix;
                }
            }
        }
        ksort($prefixes);
        return $prefixes;
    }

    /**
     * Build Html option string from array
     *
     * @param array   $array     Array['name'] = $val
     * @param string  $selected  Selected key
     * @param boolean $selectAll Show option to select all
     *
     * @return string Html option string
     */
    public static function getHtmlOptions($array, $selected, $selectAll = true)
    {
        $options = '';
        if ($selectAll) {
            $options = '<option value="">---</option>'."\n";
        }
        foreach ($array as $key => $val) {
            $options .='<option value="' . $key . '"';
            if ($key === $selected) {
                $options .=' selected="selected"';
            }
            $options .='>' . $val .'</option>'."\n";
        }
        return $options;
    }
}
