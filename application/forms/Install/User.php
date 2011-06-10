<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Installation
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Create form to input Msd-User and password at istallation
 * 
 * @package         MySQLDumper
 * @subpackage      Installation
 */
class Application_Form_Install_User extends Zend_Form
{
    /**
     * Init form
     * 
     * @return void
     */
    public function init()
    {
        $translator = Msd_Language::getInstance()->getTranslator();
        $this->addPrefixPath(
            'Msd_Form_Decorator',
            'Msd/Form/Decorator/',
            'decorator'
        );
        $this->setDisableLoadDefaultDecorators(true);
        $this->setDecorators(array('FormElements'));
        $this->addElement(
            'text',
            'user',
            array(
                'class' => 'text',
                'rowclass' => 'row-even',
                'label' => $translator->_('L_USERNAME'),
                'required' => true,
                'decorators' => array('Default'),
            )
        );
        $this->addElement(
            'password',
            'pass',
            array(
                'class' => 'text',
                'rowclass' => 'row-odd',
                'label' => $translator->_('L_PASSWORD'),
                'required' => true,
                'decorators' => array('Default'),
            )
        );
        $identical = 
            new Zend_Validate_Identical($this->getElement('pass')->getValue());
        $this->addElement(
            'password',
            'pass_confirm',
            array(
                'class' => 'text',
                'rowclass' => 'row-even',
                'label' => $translator->_('L_PASSWORD_REPEAT'),
                'required' => true,
                'decorators' => array('Default'),
                'validators' => array(
                    $identical,
                ),
            )
        );
        $this->addElement(
            'text',
            'strength',
            array(
                'class' => 'text',
                'id' => 'scorebar',
                'disabled' => 'disabled',
                'rowclass' => 'row-odd',
                'label' => $translator->_('L_PASSWORD_STRENGTH'),
                'decorators' => array('Default')
            )
        );
        $this->addElement(
            'button',
            'send',
            array(
                'class' => 'Formbutton',
                'rowclass' => 'row-even',
                'type' => 'submit',
                'label' => '',
                'value' => '',
                'content' => $this->getView()->getIcon('save') . ' '
                    . $translator->_('L_SAVE'),
                'escape' => false,
                'decorators' => array('Default'),
            )
        );
    }
}
