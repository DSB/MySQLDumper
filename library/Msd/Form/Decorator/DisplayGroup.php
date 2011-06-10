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
 * Decorator for display groups
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_DisplayGroup extends Msd_Form_Decorator_Abstract
{
    /**
     * Decorator for display groups.
     *
     * Walks through all sub elements and decorates them.
     *
     * @param string $content HTML content so far
     *
     * @return string HTML content after decorating all sub elements
     */
    public function render($content)
    {
        $element = $this->getElement();
        $legend = $element->getLegend();
        $translator = $element->getTranslator();
        $attributes = $element->getAttribs();
        if ($translator !== null) {
            $legend = $translator->translate($legend);
        }
        $sElements = '<fieldset';
        if (isset($attributes['class'])) {
            $sElements .= ' class="' . $attributes['class'] . '"';
        }
        if (isset($attributes['id'])) {
            $sElements .= ' id="' . $attributes['id'] . '"';
        }
        if (isset($attributes['style'])) {
            $sElements .= ' style="' . $attributes['style'] . '"';
        }
        $sElements .= '>';
        $sElements .= '<legend>' . $legend . '</legend>';
        $sElements .= '<table summary="">';
        $formElements = $element->getElements();
        foreach (array_keys($formElements) as $formElementKey) {
            $sElements .= (string) $formElements[$formElementKey];
        }
        $sElements .= '</table></fieldset>';

        $placement = $this->getPlacement();
        $separator = $this->getSeparator();
        switch ($placement) {
            case (self::PREPEND):
                return $sElements . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $sElements;
        }
    }
}
