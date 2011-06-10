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
 * Output human readable byte output
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_Filesize extends Zend_View_Helper_Abstract
{
    public $view;
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }


    /**
     * Output human readable filesize
     *
     * @param string $filename Filename to read size
     *
     * @return string
     */
    public function filesize($file)
    {
        $size = 0;
        if (is_readable($file)) {
            $size = filesize($file);
        }
        $size = $this->view->byteOutput($size);
        return $size;
    }

}
