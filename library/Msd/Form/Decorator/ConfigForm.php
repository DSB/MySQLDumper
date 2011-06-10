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
 * Decorator for main ConfigForm.
 * 
 * Fetches all sub forms, renders all sub elements and returns 
 * the complete form.
 * 
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
class Msd_Form_Decorator_ConfigForm extends Msd_Form_Decorator_Abstract
{
    /**
     * Render the form
     * 
     * @param string $content HTML content rendered so far
     * 
     * @return string HTML content after decorating the complete form
     */
    public function render($content)
    {
        $element = $this->getElement();
        $form = '';
        if (!empty($content)) {
            $form .= $content;
        } else {
            $subForms = $element->getSubForms();
            foreach (array_keys($subForms) as $subFormKey) {
                $form .= (string) $subForms[$subFormKey];
            }
            $subElements = $element->getElements();
            foreach (array_keys($subElements) as $subElementKey) {
                $form .= (string) $subElements[$subElementKey];
            }
        }
        return $form;
    }
}
