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
 * Decorator for a complete sub form
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_SubForm extends Msd_Form_Decorator_Abstract
{
    /**
     * Render content
     *
     * @param string $content The HTML content rendered so far
     *
     * @return string The HTML content after decorating
     */
    public function render($content)
    {
        $element = $this->getElement();
        $htmlOutput = '<div id="tab_' . $element->getId() . '">';
        $headElement = $element->getElement('headElement');
        if ($headElement !== null) {
            $htmlOutput .='<table summary="">';
            $htmlOutput .= (string) $headElement;
            $htmlOutput .= '</table>' . "\n";
            $htmlOutput .= '<br/><br/>' . "\n";
        }
        $displayGroups = $element->getDisplayGroups();
        foreach (array_keys($displayGroups) as $displayGroupKey) {
            $htmlOutput .= (string) $displayGroups[$displayGroupKey];
        }
        $htmlOutput .= '</div>';

        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        switch ($placement) {
            case self::PREPEND:
                return $htmlOutput . $separator . $content;
            case self::APPEND:
            default:
                return $content . $separator . $htmlOutput;
        }

        return $htmlOutput;
    }
}
