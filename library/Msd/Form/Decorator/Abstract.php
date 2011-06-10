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
 * Abstract decorator for form elements of Msd_Form
 *
 * @package         MySQLDumper
 * @subpackage      Form_Decorator
 */
abstract class Msd_Form_Decorator_Abstract extends Zend_Form_Decorator_Abstract
{
    /**
     * Build and translate the label of an element.
     *
     * @return string
     */
    public function buildLabel()
    {
        $element = $this->getElement();
        $label = $element->getLabel();
        if (empty($label)) {
            return '';
        }
        $translator = $element->getTranslator();
        if ($translator !== null) {
            $label = $translator->translate($label);
        }
        $attribs = $element->getAttribs();
        if (!isset($attribs['noColon']) || $attribs['noColon'] != true) {
            $label .= ':';
        }
        return $label;
    }

    /**
     * Build the HTML-Code of the element.
     *
     * @return string
     */
    public function buildInput()
    {
        $element = $this->getElement();
        $helper = $element->helper;
        $value = $element->getValue();
        $translator = $element->getTranslator();
        if ($translator !== null) {
            $value = $translator->translate($value);
        }
        $ret = $element->getView()->$helper(
            $element->getName(),
            $value,
            $this->_getCleanAttribs(),
            $element->options
        );
        return $ret;
    }

    /**
     * Build the error message, if there is any.
     *
     * @return string
     */
    public function buildErrors()
    {
        $lang = Msd_Language::getInstance();
        $element = $this->getElement();
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
        $html = '<ul>';
        foreach (array_keys($messages) as $messageId) {
            $html .= '<li>' . $lang->translateZendId($messageId) . '</li>';
        }
        $html .= '<ul>';
        return $html;
    }

    /**
     * Build the description.
     *
     * @return string
     */
    public function buildDescription()
    {
        $element = $this->getElement();
        $desc = $element->getDescription();
        return $desc;
    }

    /**
     * Clean up attributes we don't want to appear in Html code.
     *
     * @return array Array with allowed attributes
     */
    private function _getCleanAttribs()
    {
        $attribsToRemove = array(
            'noColon', 'helper', 'secondLabel' , 'rowclass'
        );
        $attribsOfElement = $this->getElement()->getAttribs();
        foreach ($attribsToRemove as $attrib) {
            if (isset($attribsOfElement[$attrib])) {
                unset($attribsOfElement[$attrib]);
            }
        }
        return $attribsOfElement;
    }
}
