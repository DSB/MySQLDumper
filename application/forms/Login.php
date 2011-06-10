<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Login
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Create login form
 *
 * @package         MySQLDumper
 * @subpackage      Login
 */
class Application_Form_Login extends Zend_Form
{
    /**
     * Init form and add all elements
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
                'label' => $translator->_('L_PASSWORD'),
                'required' => true,
                'decorators' => array('Default'),
            )
        );
        $this->addElement(
            'checkbox',
            'autologin',
            array(
                'class' => 'checkbox',
                'label' => $translator->_('L_LOGIN_AUTOLOGIN'),
                'decorators' => array('Default'),
            )
        );
        $this->addElement(
            'button',
            'send',
            array(
                'class' => 'Formbutton',
                'label' => '',
                'value' => $translator->_('L_LOGIN'),
                'decorators' => array('Default'),
                'content' =>
                    $this->getView()->getIcon('Key', '', 16) . ' ' .
                    $translator->_('L_LOGIN'),
                'escape' => false,
                'onclick' => '$(forms[0].submit());'
            )
        );

        $this->addElement(
            'submit',
            'dummySend',
            array(
                'class' => 'invisible',
                'label' => '',
                'decorators' => array('Default')
            )
        );

        $this->addDisplayGroupPrefixPath(
            'Msd_Form_Decorator',
            'Msd/Form/Decorator/'
        );
        $this->setDisplayGroupDecorators(array('DisplayGroup'));
        $this->addDisplayGroup(
            array('user', 'pass', 'autologin', 'dummySend', 'send'),
            'login',
            array(
                'disableLoadDefaultDecorators' => true,
                'decorators' => array('DisplayGroup'),
                'legend' => $translator->_('L_AUTHENTICATE')
            )
        );
    }
}
