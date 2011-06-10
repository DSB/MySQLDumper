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
 * Decorator for the beginning of a table row
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_LineStart extends Msd_Form_Decorator_Abstract
{
    /**
     * Render the element.
     * 
     * @param string $content HTML content so far
     * 
     * @return string HTML content after decorating
     */
    public function render($content)
    {
        $element = $this->getElement();
        if (! $element instanceof Zend_Form_Element) {
            return $content;
        }
        if (null === $element->getView()) {
            return $content;
        }
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $label = $this->buildLabel();
        $input = $this->buildInput();
        $output = '<tr><td>' . $label . '</td>' . '<td>' . $input;
        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}
