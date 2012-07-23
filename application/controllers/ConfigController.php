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
                    'action'     => 'index'
                )
            )
        );

        $langs = $this->view->lang->getAvailableLanguages();
        asort($langs);

        $formGeneral  = $this->_getSubformIni('general');
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
        $themeSelect   = $formInterface->getElement('theme');
        $themeSelect->setMultiOptions(Msd_File::getThemeList());
        $langSelect = $formInterface->getElement('language');
        $langSelect->setMultiOptions($langs);
        $form->addSubForm($formInterface, 'interface');

        $form->clearDecorators();
        $translator = $this->view->lang->getTranslator();

        $saveIcon = $this->view->getIcon('save', $translator->_('L_SAVE'));
        $form->addElement(
            'submit',
            'save',
            array(
                'class'                        => 'Formbutton',
                'helper'                       => 'formButton',
                'content'                      => $saveIcon . ' ' . $translator->_('L_SAVE'),
                'escape'                       => false,
                'type'                         => 'submit',
                'disableLoadDefaultDecorators' => true,
                'decorators'                   => array(
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
        $message  = array();
        $firstTab = null;
        $form     = $this->view->form;
        foreach ($messages as $tabKey => $tabMessage) {
            foreach ($tabMessage as $inputName => $inputMessage) {
                foreach ($inputMessage as $messageId => $messageText) {
                    if ($firstTab === null) {
                        $firstTab = 'tab_' . $tabKey;
                    }
                    $subForm      = $form->getSubForm($tabKey);
                    $formElement  = $subForm->getElement($inputName);
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
        $ret             = array();
        $ret['messages'] = implode('<br />', $message);
        $ret['firstTab'] = $firstTab;
        return $ret;
    }

    /**
     * Get view values for configuration panel databases
     *
     * @return Zend_Form_SubForm
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

        // set dynamic actual database if it's changed in the panel
        if ($this->_request->isPost()) {
            $actualDb = $this->view->config->get('dynamic.dbActual');
            if (isset($_POST['defaultDb']) && ($_POST['defaultDb'] != $actualDb)) {
                $this->view->config->set('dynamic.dbActual', $_POST['defaultDb']);
            }
        }

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
        $subFormIni = new Zend_Config_Ini(APPLICATION_PATH . '/forms/Config/' . $subform . '.ini');
        $options    = array('displayGroupPrefixPath' => $subform . '_');
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
        $index                           = count($recipientsCc);
        $recipientsCc[$index]['Name']    = '';
        $recipientsCc[$index]['Address'] = '';
        $recipientsCc                    = array_values($recipientsCc);
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
        $recipientsCc      = $this->view->config->get('config.email.RecipientCc');
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
        $index     = 0;
        if (!empty($ftpConfig)) {
            $index = max(array_keys($ftpConfig)) + 1;
        }
        $default           = $this->view->config->loadConfiguration(
            'defaultConfig',
            false
        );
        $default           = $default->toArray();
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
        $index     = (int)$this->_request->getPost('param');
        $ftpConfig = $this->view->config->get('config.ftp');
        if (count($ftpConfig) > 1) {
            if (isset($ftpConfig[$index])) {
                unset($ftpConfig[$index]);
                sort($ftpConfig);
            }
            $this->view->config->set('config.ftp', $ftpConfig);
        }
        $this->_forward('index');
    }

    /**
     * Test FTP-Connection
     *
     * @return void
     */
    public function testFtpConnectionAction()
    {
        $translator = $this->view->lang->getTranslator();

        if ($this->_request->isPost()) {

            $postData = $this->_request->getPost();
            $index    = (int)$this->_request->getPost('param');

            // fetch the required params
            $server    = $postData['ftp_' . $index . '_server'];
            $port      = $postData['ftp_' . $index . '_port'];
            $timeout   = $postData['ftp_' . $index . '_timeout'];
            $mode      = $postData['ftp_' . $index . '_passiveMode'];
            $ssl       = $postData['ftp_' . $index . '_ssl'];
            $user      = $postData['ftp_' . $index . '_user'];
            $password  = $postData['ftp_' . $index . '_pass'];
            $directory = $postData['ftp_' . $index . '_dir'];

            // Params for transferring a test file
            $name         = 'ftp_transfer_testfile.txt';
            $filename     = APPLICATION_PATH . '/forms/Config/ftp_transfertest/ftp_transfer_testfile.txt';
            $targetFolder = APPLICATION_PATH . '/forms/Config/ftp_transfertest/ftp_target/';
            $upload       = false;

            // try to connect via ssl to the ftp server
            if ($ssl == 'y' && function_exists('ftp_ssl_connect')) {
                $ftpStream = ftp_ssl_connect($server, $port, $timeout);
            } else {
                // otherwise try to connect to the ftp server normally
                $ftpStream = ftp_connect($server, $port, $timeout);
            }

            // got resource?
            if (!is_resource($ftpStream)) {
                $message = sprintf($translator->_('L_FTP_CONNECTION_ERROR'), $server, $port);

                // connection ok? let's try to login
            } else if (!ftp_login($ftpStream, $user, $password)) {
                $message = sprintf($translator->_('L_FTP_LOGIN_ERROR'), $user);

                // if passive mode is set turn it on
                if ($mode == 'y') {
                    ftp_pasv($ftpStream, true);
                }

                // login ok? let's set/change the ftp upload directory
            } else if (!ftp_chdir($ftpStream, $directory)) {
                $message = sprintf($translator->_('L_CHANGEDIRERROR'));
                // chmod target_folder if it's necessary
            } else if (file_exists($targetFolder) && substr(sprintf('%o', fileperms($targetFolder)), -4) < '0755') {
                ftp_chmod($ftpStream, 0755, $targetFolder);
                $message = '';
                // ftp directory exists and chmod ok? let's test the ftp transfer with a test file
            } else if (!ftp_put($ftpStream, $targetFolder . $name, $filename, FTP_ASCII)) {
                $message = sprintf($translator->_('L_FTP_FILE_TRANSFER_ERROR'), $name);

            } else {
                $upload  = true;
                $message = sprintf($translator->_('L_FTP_FILE_TRANSFER_SUCCESS'), $name)
                    . '<br /><br />' .
                    $translator->_('L_FTP_OK');

                // delete the test file after a successful transfer test
                if (file_exists($targetFolder . $name)) {
                    ftp_delete($ftpStream, $targetFolder . $name);
                }
            }

            // let's show the error messages
            if (!$upload && count($message) > 0) {
                $this->view->popUpMessage()->addMessage(
                    'config-validate-error',
                    'L_ERROR',
                    $message,
                    array(
                        'modal' => true
                    )
                );
                // or show the confirmation message
            } else if ($upload && count($message) > 0) {
                $this->view->popUpMessage()->addMessage(
                    'config-validate-message',
                    'L_NOTICE',
                    $message,
                    array(
                        'modal' => true
                    )
                );
            }

            // close ftp connection
            ftp_close($ftpStream);
        }
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
            $group    = $subForm->getName();
            $elements = array_keys($subForm->getElements());
            foreach ($elements as $element) {
                $element = str_replace($group . '_', '', $element);
                $element = str_replace('_', '.', $element);
                $value   = $this->view->config->get('config.' . $group . '.' . $element);
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
        $form     = $this->view->form;
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
                $configData      = $form->getValidValues($postData);
                $configData      = $this->_addNonConfigurableConfigParams($configData);
                $configValidator =
                    new Application_Model_Config_FormValidator($configData);
                $configValidator->validate($this->view);
            }
        }
    }

    /**
     * Add configuration params that are not configurable in gui but must be saved.
     *
     * @param array $configData The config array
     *
     * @return array
     */
    private function _addNonConfigurableConfigParams($configData)
    {
        $config                        = Msd_Configuration::getInstance();
        $configData['systemDatabases'] = $config->get('config.systemDatabases');
        return $configData;
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
        $visibilityMap      = array(
            true  => 'block',
            false => 'none',
        );
        $emailForm          = $form->getSubForm('email');
        $sendmailConfig     = $emailForm->getDisplayGroup('sendmailConfig');
        $smtpConfig         = $emailForm->getDisplayGroup('smtpConfig');
        $sendmailVisibility = false;
        $smtpVisibility     = false;
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
