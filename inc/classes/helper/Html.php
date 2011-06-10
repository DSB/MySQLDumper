<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * HTML-Helper Class
 *
 * Class has some static methods for building HTML-output
 */
class Html
{
    /**
     * Build HTML option list from array.
     *
     * @param array  $arr          Array $array[key]=value
     * @param string $selected     Selected key
     * @param string $valuePattern Pattern to format value output
     *
     * @return string HTML option list
     */
    public static function getOptionlist($arr, $selected, $valuePattern = false)
    {
        $r = '';
        foreach ($arr as $key => $val) {
            $r .= '<option value="' . $key . '"';
            $r .= Html::getSelected($key, $selected) . '>';
            if ($valuePattern) $r .= sprintf($valuePattern, $val);
            else $r .= $val;
            $r .= '</option>' . "\n";
        }
        return $r;
    }

    /**
     * Get HTML output for attribute "checked"
     *
     * @param string $val     The current value
     * @param string $checked The value for the element if it should be checked
     * @return string Html attribute "checked" or empty string
     */
    public static function getChecked($val, $checked)
    {
        return $val == $checked ? ' checked="checked"' : '';
    }

    /**
     * Get HTML output for attribute "disable"
     *
     * @param string $val      The current value
     * @param string $disabled The value for the element if disabled
     *
     * @return string Html attribute "disabled" or empty string
     */
    public static function getDisabled($val, $disabled)
    {
        return $val == $disabled ? ' disabled="disabled"' : '';
    }
    /**
     * Get HTML output for attribute "selected"
     *
     * @param string $val      The current value
     * @param string $selected The value for the element if selected
     *
     * @return string Html attribute "selected" or empty string
     */
    public static function getSelected($val, $selected)
    {
        return $val == $selected ? ' selected="selected"' : '';
    }

    /**
     * Convert HTML br's to new lines.
     *
     * @param string $str The string to convert
     * @return string Converted string
     */
    public static function br2nl($str)
    {
        $search = array('<br>', '<br />', '<br/>');
        $replace = array("\n", "\n", "\n");
        return str_replace($search, $replace, $str);
    }

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
     * Replace quotes with their Html entity.
     *
     * Used for outputing values in HTML attributes without breaking HTML
     *
     * @param string $string String with quotes
     *
     * @return string String with replaced quotes
     */
    public static function replaceQuotes($string)
    {
        $string = str_replace("\n", '\n', $string);
        return str_replace('"', '&quot;', $string);
    }

    /**
     * Escape special chars according to Perl syntax.
     *
     * @param string $text The string to escape
     *
     * @return string Escaped string
     */
    public static function escapeSpecialchars($string)
    {
        $search = array('@', '$', '\\\\', '"');
        $replace = array('\@', '\$', '\\', '\"');
        return str_replace($search, $replace, $string);
    }

    /**
     * Remove added slashes recursively.
     *
     * @param mixed $values Array or string to remove added slashes from
     *
     * @return mixed Array or String with recursively removed slashes
     */
    public static function stripslashesDeep($values)
    {
        if (is_array($values)) {
            $values = array_map('Html::stripslashesDeep', $values);
        } else {
            $values = stripslashes($values);
        }
        return $values;
    }

    /**
     * Remove whitespaces before and after string or array.
     *
     * @param mixed $values Array or string to remove whitespaces from
     *
     * @return mixed Recursively trimmed array or string
     */
    public static function trimDeep($values)
    {
        if (is_array($values)) {
            $values = array_map('Html::trimDeep', $values);
        } else {
            $values = trim($values);
        }
        return $values;
    }
    /**
     * Build HTML-Message-String for success messages
     *
     * @param string $text Message to print
     *
     * @return string Message surrounded by HTML-Container
     */
    public static function getOkMsg($text)
    {
        $html= sprintf('<span class="ok">%s</span>', $text);
        $html .= '<span style="float:right">';
        $html .= '<img src="./css/msd/icons/ok.gif" title="" alt="">';
        $html .= '</span><br />';
        return $html;
    }
    /**
     * Build HTML-Message-String for error messages
     *
     * @param string $text Message to print
     *
     * @return string Message surrounded by HTML-Container
     */
    public static function getErrorMsg($text)
    {
        $html= sprintf('<span class="error">%s</span>', $text);
        $html .= '<span style="float:right">';
        $html .= '<img src="./css/msd/icons/notok.gif" title="" alt="">';
        $html .= '</span><br />';
        return $html;
    }
    /**
     * Create IMG-Tag
     *
     * @param string $pic   Filename of picture
     * @param string $title Title for the picture (will alsobe used for alt-tag)
     *
     * @return string Built img-tag
     */
    public static function getIcon($pic, $title = '')
    {
        //TODO get value from a config class and get rid of global
        global $config;
        $img = '<img src="%s%s" alt="%s" title="%s" />';
        return sprintf($img, $config['files']['iconpath'], $pic, $title, $title);
    }
}
