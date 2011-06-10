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
 * Decorator for an element with two labels
 *
 * (label -> text input -> second label (unit)) or
 * (Label -> select box -> second label (unit)
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_DoubleLabel extends Msd_Form_Decorator_Abstract
{
    /**
     * Build the second label.
     *
     * @return string
     */
    public function buildSecondLabel()
    {
        $element = $this->getElement();
        $label = $element->getAttrib('secondLabel');
        if (empty($label)) {
            return '';
        }
        $translator = $element->getTranslator();
        if ($translator !== null) {
            $label = $translator->translate($label);
        }
        if ($element->isRequired()) {
            $label .= '*';
        }
        $label .= '';
        return '<label for="' . $element->getId() . '">' . $label . '</label>';
    }

    /**
     * Render the form element.
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
        $secondLabel = $this->buildSecondLabel();
        $input = $this->buildInput();

        $errorOutput = '';
        /*
        // error output is handled by validators
        $errors = $this->buildErrors();
        if ($errors != '') {
            $errorOutput = sprintf('<span class="error">%s</span>', $errors);
        }
        */

        $descOutput = '';
        $desc = $this->buildDescription();
        if ($desc != '') {
            $descOutput = sprintf('<span class="description">%s</span>', $desc);
        }

        $output = ' <tr>
                        <td>%s</td>
                        <td>%s %s' . $errorOutput . $descOutput .'</td>
                    </tr>';
        $output = sprintf($output, $label, $input, $secondLabel);
        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}
