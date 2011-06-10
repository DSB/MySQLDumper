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
 * Default decorator for form elements
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_Default extends Msd_Form_Decorator_Abstract
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
        $label = $this->buildLabel();
        $input = $this->buildInput();
        $errors = strip_tags($this->buildErrors());
        $desc = $this->buildDescription();
        $descOutput = '';
        if ($desc != '') {
            $descOutput = sprintf('<span class="description">%s</span>', $desc);
        }
        $attribs = $element->getAttribs();
        $output = '<tr>';
        $rowclass = '';
        if (isset($attribs['rowclass'])) {
            $rowclass = $attribs['rowclass'];
            $output = '<tr class="' . $rowclass . '">';
        }
        $output .= '    <td>%s</td>
                        <td>%s '. $descOutput . '</td>
                    </tr>';
        $output = sprintf($output, $label, $input);
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
