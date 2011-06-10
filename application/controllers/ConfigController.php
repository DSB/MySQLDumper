<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Config Controller
 *
 * Controller to handle actions triggered on configuration screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class ConfigController extends Zend_Controller_Action
{
    /**
     * Active jQuery tab Id
     * @var string
     */
    private $_activeTab = 'tab_general';

    /**
     * Build the form on demand.
     *
     * @return void
     */
    private function _buildForm()
    {
        $form = new Zend_Form(
            array(
                 'disableLoadDefaultDecorators' => true,
            )
        );
        $form->addElementPrefixPath(
            'Msd_Form_Decorator',
            'Msd/Form/Decorator/',
            'decorator'
        );
        $form->addPrefixPath(
            'Msd_Form_Decorator',
            'Msd/Form/Decorator/',
            'decorator'
        );
        $form->setAction(
            $this->view->url(
                array(
                     'controller' => 'config',
                     'action' => 'index'
                )
            )
        );

        $langs = $this->view->lang->getAvailableLanguages();
        asort($langs);

        $formGeneral = $this->_getSubformIni('general');
        $elementTitle = $formGeneral->getElement('title');
        $elementTitle->setValue(
            $this->view->config->get('config.general.title')
        );

        $form->addSubForm($formGeneral, 'general');
        $form->addSubForm($this->_getPanelDatabases(), 'dbuser');
        $form->addSubForm($this->_getSubformIni('autodelete'), 'autodelete');
        $form->addSubForm(new Application_Form_Config_Email(), 'email');
        $form->addSubForm(new Application_Form_Config_Ftp(), 'ftp');
        $form->addSubForm($this->_getSubformIni('cronscript'), 'cronscript');

        $formInterface = $this->_getSubformIni('interface');
        $themeSelect = $formInterface->getElement('theme');
        $themeSelect->setMultiOptions(Msd_File::getThemeList());
        $langSelect = $formInterface->getElement('language');
        $langSelect->setMultiOptions($langs);
        $form->addSubForm($formInterface, 'interface');

        $form->clearDecorators();
        $translator = $this->view->lang->getTranslator();

        $saveIcon =  $this->view->getIcon('save', $translator->_('L_SAVE'));
        $form->addElement(
            'submit',
            'save',
            array(
                 'class' => 'Formbutton',
                 'helper' => 'formButton',
                 'content' => $saveIcon . ' ' . $translator->_('L_SAVE'),
                 'escape' => false,
                 'type' => 'submit',
                 'disableLoadDefaultDecorators' => true,
                 'decorators' => array(
                     'ViewHelper',
                     'Tooltip'
                 )
            )
        );
        $form->addDecorator('ConfigForm');
        $this->_setFormDefaultValues($form);
        $this->_setGroupVisibilities($form);
        $this->view->form = $form;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        if ($this->_request->isPost()) {
            // if language is changed, we need to refresh the config before
            // the form is rendered
            $postData = $this->_request->getParams();
            if (isset($postData['language'])) {
                $this->view->lang->loadLanguage($postData['language']);
            }
        }
        $this->_buildForm();
        $this->_activeTab = $this->_getParam('selectedTab', 'tab_general');
        if ($this->_request->isPost()) {
            $this->_validateForm();
        }
        $this->view->currentTab = $this->_activeTab;
    }

    /**
     * Get validation errors and look for first tab with errors to jump to
     *
     * @param array $messages Form error messages
     *
     * @return array Array with messages and first tab to show
     */
    private function _getFormErrors($messages)
    {
        $message = array();
        $firstTab = null;
        $form = $this->view->form;
        foreach ($messages as $tabKey => $tabMessage) {
            foreach ($tabMessage as $inputName => $inputMessage) {
                foreach ($inputMessage as $messageId => $messageText) {
                    if ($firstTab === null) {
                        $firstTab = 'tab_' . $tabKey;
                    }
                    $subForm = $form->getSubForm($tabKey);
                    $formElement = $subForm->getElement($inputName);
                    $elementClass = $formElement->getAttrib('class');
                    $elementClass .= ' ' . 'inputError';
                    $formElement->setAttrib('class', $elementClass);
                    $message[] = $formElement->getLabel() . ': ' .
                                 $this->view->lang->translateZendId(
                                     $messageId,
                                     $messageText
                                 );
                }
            }
        }
        $ret = array();
        $ret['messages'] = implode('<br />', $message);
        $ret['firstTab'] = $firstTab;
        return $ret;
    }

    /**
     * Get view values for configuration panel databases
     *
     * @return string
     */
    private function _getPanelDatabases()
    {
        $formDb = $this->_getSubformIni('dbuser');

        // get database names
        $dbAdapter = Msd_Db::getAdapter();
        $databases = $dbAdapter->getDatabaseNames();

        // fill select-options with database names
        $formDb->getElement('defaultDb')->addMultioptions(
            array_combine($databases, $databases)
        );

        return $formDb;
    }

    /**
     * Read ini file and create subform
     *
     * @param string $subform
     *
     * @return Zend_Form_SubForm
     */
    private function _getSubformIni($subform)
    {
        $subFormIni = new Zend_Config_Ini(
            APPLICATION_PATH . DS . 'forms' . DS . 'Config' . DS . $subform .
            '.ini'
        );
        $options = array('displayGroupPrefixPath' => $subform . '_');
        return new Zend_Form_SubForm($subFormIni, $options);
    }

    /**
     * Add a new Cc-Recipient to email form
     *
     * @return void
     */
    public function addRecipientCcAction()
    {
        $recipientsCc = $this->view->config->get('config.email.RecipientCc');
        if ($recipientsCc === null) {
            $recipientsCc = array();
        }
        $index = count($recipientsCc);
        $recipientsCc[$index]['Name'] = '';
        $recipientsCc[$index]['Address'] = '';
        $recipientsCc = array_values($recipientsCc);
        $this->view->config->set('config.email.RecipientCc', $recipientsCc);
        $this->_forward('index');
    }

    /**
     * Delete a Cc-Recipient entry
     *
     * @return void
     */
    public function deleteRecipientCcAction()
    {
        $recipientToDelete = (int)$this->_request->getPost('param');
        $recipientsCc = $this->view->config->get('config.email.RecipientCc');
        if (isset($recipientsCc[$recipientToDelete])) {
            unset($recipientsCc[$recipientToDelete]);
        }
        $this->view->config->set('config.email.RecipientCc', $recipientsCc);
        $this->_forward('index');
    }

    /**
     * Add a new Ftp-Connection
     *
     * @return void
     */
    public function addFtpConnectionAction()
    {
        $ftpConfig = $this->view->config->get('config.ftp');
        $index = 0;
        if (!empty($ftpConfig)) {
            $index = max(array_keys($ftpConfig)) + 1;
        }
        $default = $this->view->config->loadConfiguration(
            'defaultConfig',
            false
        );
        $default = $default->toArray();
        $ftpConfig[$index] = $default['ftp'][0];
        $this->view->config->set('config.ftp', $ftpConfig);
        $this->_forward('index');
    }

    /**
     * Delete Ftp-Connection
     *
     * @return void
     */
    public function deleteFtpConnectionAction()
    {
        $index = (int)$this->_request->getPost('param');
        $ftpConfig = $this->view->config->get('config.ftp');
        if (isset($ftpConfig[$index])) {
            unset($ftpConfig[$index]);
            sort($ftpConfig);
        }
        $this->view->config->set('config.ftp', $ftpConfig);
        $this->_forward('index');
    }

    /**
     * Set the default value of all sub forms to the configuration values
     *
     * @param Zend_Form $form
     *
     * @return void
     */
    private function _setFormDefaultValues($form)
    {
        $subForms = $form->getSubForms();
        foreach ($subForms as $subForm) {
            $group = $subForm->getName();
            $elements = array_keys($subForm->getElements());
            foreach ($elements as $element) {
                $element = str_replace($group . '_', '', $element);
                $element = str_replace('_', '.', $element);
                $value = $this->view->config->get(
                    'config.' .
                    $group . '.' .
                    $element
                );
                if ($value !== null) {
                    $subForm->setDefault($element, $value);
                }
            }
        }
    }

    /**
     * Validate the config form
     *
     * @return void
     */
    private function _validateForm()
    {
        $postData = $this->_request->getPost();
        $form = $this->view->form;
        $form->setDefaults($postData);
        if (isset($postData['save'])) {
            if (!$form->isValid($postData)) {
                $errors = $this->_getFormErrors($form->getMessages());
                if ($errors['messages'] != '') {
                    $this->view->popUpMessage()->addMessage(
                        'config-validate-error',
                        'L_ERROR',
                        $errors['messages'],
                        array(
                             'modal' => true
                        )
                    );
                    // jump to first tab with validation error
                    $this->_activeTab = $errors['firstTab'];
                }
            } else {
                $configData = $form->getValidValues($postData);
                $configValidator =
                        new Application_Model_Config_FormValidator($configData);
                $configValidator->validate($this->view);
            }
        }
    }

    /**
     * Set the default visibilities of the display groups inside of the form.
     * The visibilities depends on the current configuration.
     *
     * @param Zend_Form $form The whole form.
     *
     * @return void
     */
    private function _setGroupVisibilities(Zend_Form $form)
    {
        $visibilityMap = array(
            true => 'block',
            false => 'none',
        );
        $emailForm = $form->getSubForm('email');
        $sendmailConfig = $emailForm->getDisplayGroup('sendmailConfig');
        $smtpConfig = $emailForm->getDisplayGroup('smtpConfig');
        $sendmailVisibility = false;
        $smtpVisibility = false;
        switch ($this->view->config->get('config.email.Program')) {
            case 'sendmail':
                $sendmailVisibility = true;
                break;
            case 'smtp':
                $smtpVisibility = true;
                break;
        }
        $sendmailConfig->addAttribs(
            array(
                 'style' => 'display:'
                            . $visibilityMap[$sendmailVisibility] . ';',
            )
        );
        $smtpConfig->addAttribs(
            array(
                 'style' => 'display:' . $visibilityMap[$smtpVisibility] . ';',
            )
        );
    }
}
