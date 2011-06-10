<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Decorator for table data between start and end of a table row
 * 
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_LineMiddle extends Msd_Form_Decorator_Abstract
{
    /**
     * Render element
     * 
     * @param string $content HTML content so far
     * 
     * @return string HTML content after decorating
     */
    public function render($content)
    {
        $label = $this->buildLabel();
        if ($label != '' ) {
            $label = ' ' . $label;
        }
        $output = $label . $this->buildInput() . ' ';
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}
