<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Log
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Reader Class
 *
 * @package         MySQLDumper
 * @subpackage      Log
 */
class Msd_Log_Reader extends Msd_Log
{
    /**
     * Read a logfile and return content as array.
     *
     * If $revers is set to true the ordering of lines is reversed.
     *
     * @param parent::const $type    The type of logfile to read
     * @param boolean       $reverse Wether to place latest entries first
     *
     * @return array        Log data from file as array
     */
    public function read ($type = parent::PHP, $reverse = false)
    {
        $filename = parent::getFile($type);

        if (!is_readable($filename)) {
            $timestamp = Zend_Date::ISO_8601;
            $lang = Msd_Language::getInstance()->getTranslator();
            $msg = $timestamp . ' <span class="error">' .
                sprintf($lang->_('L_LOG_NOT_READABLE'), $filename) . '</span>';
            return array($msg);
        } else {
            $output = file($filename);
        }
        if ($reverse == 1) {
           $output = array_reverse($output);
        }

        return $output;
    }
}