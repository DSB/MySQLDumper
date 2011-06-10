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
 * Install controller
 *
 * Controller to handle actions triggered on install process
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class InstallController extends Zend_Controller_Action
{
    /**
     * Init controller
     *
     * @return void
     */
    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('install');
        $this->version = new Msd_Version();
        $_SESSION['msd_install'] = true;
        if (
            $this->_request->getActionName() != 'badversion!' &&
            !$this->version->checkPhpVersion()
        ) {
            $this->_forward(
                'badversion',
                'install',
                'default',
                array(
                     'message' => 'L_PHP_VERSION_TOO_OLD'
                )
            );
        }
        $config = Msd_Configuration::getInstance('defaultConfig');
        $config->set('config.interface.theme', 'msd');
    }

    /**
     * Start installation process
     *
     * @return void
     */
    public function indexAction()
    {
        // delete cookie from further installation if present
        // to not import old values
        if (isset($_SESSION['msd_autologin'])) {
            setcookie('msd_autologin', null, null, '/');
            $_SESSION['msd_autologin'] = array();
        }
        Zend_Session_Namespace::resetSingleInstance('MySQLDumper');
        $config = Msd_Configuration::getInstance('defaultConfig', true);
        $lang = Msd_Language::getInstance();
        if ($this->_request->isPost()) {
            $language = $this->_getParam('language');
            $config->set('config.interface.language', $language);
            $config->set('dynamic.configFile', 'mysqldumper');
            $config->set('config.general.title', 'MySQLDumper');
            $config->saveConfigToSession();
            $_SESSION['msd_lang'] = $language;
            $redirectUrl = $this->view->url(array('controller' => 'install', 'action' => 'step2'), null, true);
            $this->_response->setRedirect($redirectUrl);
        }
        // set selected languge
        $language = $this->_getParam('language', 'en');
        $languages = $lang->getAvailableLanguages();

        // check user browser language
        $locale = new Zend_Locale();
        $browserLocale = array_keys($locale->getBrowser());

        // get default or last selected language
        if ($language === null) {
            if (isset($_SESSION['msd_lang'])) {
                $language = $_SESSION['msd_lang'];
            } else {
                foreach ($browserLocale as $localeCode) {
                    if (array_key_exists($localeCode, $languages)) {
                        $language = $localeCode;
                        break;
                    }
                }
            }
        }

        Msd_Language::getInstance()->loadLanguage($language);
        $this->view->language = $language;
        $this->view->stepInfo = array(
            'language' => $language,
            'stepInfo' => array(
                'number' => 1,
                'description' => $lang->getTranslator()
                                         ->_('L_SELECT_LANGUAGE')
                                 . ' (' . $language . ')'));
        $languagesStatus = array();
        foreach ($languages as $langId => $langName) {
            $languagesStatus[$langId] = array(
                'langName' => $langName,
                'installed' => file_exists(
                    APPLICATION_PATH . DS . 'language' .
                    DS . $langId . DS . 'lang.php'
                )
            );
        }
        $config->set('config.interface.language', $language);
        $this->view->languages = $languagesStatus;
        $this->view->lang = $lang;
    }

    /**
     * Step 2 - check directories
     *
     * Make sure work-directories exist and are writable.
     *
     * @return void
     */
    public function step2Action()
    {
        $lang = Msd_Language::getInstance();
        $config = Msd_Configuration::getInstance();
        $language = $config->get('config.interface.language');
        $this->view->stepInfo = array(
            'language' => $language,
            'firstStepOK' => true,
            'stepInfo' => array(
                'number' => 2,
                'description' => $lang->getTranslator()->_('L_CHECK_DIRS'),
            )
        );
        $creationStatus = array();
        $checkDirs = array(
            'work' => $config->get('paths.work'),
            'config' => $config->get('paths.config'),
            'log' => $config->get('paths.log'),
            'backup' => $config->get('paths.backup'),
            'iconpath' => $config->get('paths.iconpath')
        );

        foreach ($checkDirs as $checkDir) {
            clearstatcache();
            if (!is_dir($checkDir)) {
                @mkdir($checkDir, 0777);
            }
            clearstatcache();
            $checkExists = file_exists($checkDir);
            $checkWritable = Msd_File::isWritable($checkDir, 0777);
            $creationStatus[$checkDir] = array(
                'chmod' => Msd_File::getChmod($checkDir),
                'exists' => $checkExists,
                'writable' => $checkWritable,
            );
            $this->view->status = $creationStatus;
        }
        if (!in_array(false, $creationStatus)) {
            $config->set('dynamic.configFile', 'mysqldumper');
            $config->saveConfigToSession();
            $redirectUrl = $this->view->url(array('controller' => 'install', 'action' => 'step3'), null, true);
            $this->_response->setRedirect($redirectUrl);
        }
        $this->view->lang = $lang;
    }

    /**
     * Step 3 - Enter administrative user
     *
     * @return void
     */
    public function step3Action()
    {
        $lang = Msd_Language::getInstance();
        $config = Msd_Configuration::getInstance();
        $language = $config->get('config.interface.language');
        $form = new Application_Form_Install_User();
        $this->view->stepInfo = array(
            'language' => $language,
            'firstStepOK' => true,
            'secondStepOK' => true,
            'stepInfo' => array(
                'number' => 3,
                'description' => $lang->getTranslator()->_('L_AUTHENTICATE'),
            )
        );
        if ($this->_request->isPost()) {
            $postData = $this->_request->getParams();
            $form->getElement('pass_confirm')->getValidator('Identical')
                    ->setToken($postData['pass']);
            if ($form->isValid($postData)) {
                $ini = new Msd_Ini();
                $ini->set('name', $postData['user'], '0');
                $ini->set('pass', md5($postData['pass']), '0');
                $ini->save(APPLICATION_PATH . DS . 'configs' . DS . 'users.ini');
                $redirectUrl = $this->view->url(array('controller' => 'install', 'action' => 'step4'), null, true);
                $this->_response->setRedirect($redirectUrl);
            }
        }
        $this->view->form = $form;
        $this->view->lang = $lang;
    }

    /**
     * Step 4 - Enter database params
     *
     * @return void
     */
    public function step4Action()
    {
        $lang = Msd_Language::getInstance();
        $config = Msd_Configuration::getInstance();
        $language = $config->get('config.interface.language');
        $this->view->stepInfo = array(
            'language' => $language,
            'firstStepOK' => true,
            'secondStepOK' => true,
            'thirdStepOK' => true,
            'stepInfo' => array(
                'number' => 4,
                'description' => $lang->getTranslator()->_('L_DBPARAMETER'),
            )
        );

        if ($this->_request->isPost()) {
            $options = array(
                'host' => $this->_getParam('host'),
                'user' => $this->_getParam('user'),
                'pass' => $this->_getParam('pass'),
                'manual' => $this->_getParam('manual'),
                'port' => $this->_getParam('port'),
                'socket' => $this->_getParam('socket'),
            );
            $saveParam = $this->_getParam('save');
            $config->set('config.dbuser', $options);
            if ($saveParam !== null && $saveParam == 1) {
                $config->set('config.general.title', 'MySQLDumper');
                $config->set('config.dbuser.defaultDb', $this->_getParam('defaultDb'));
                $config->save('mysqldumper');
                unset($_SESSION['msd_lang']);
                unset($_SESSION['msd_install']);
                $redirectUrl = $this->view->url(array('controller' => 'index', 'action' => 'index', null, true));
                $this->_response->setRedirect($redirectUrl);
            } else {
                $dbAdapter = Msd_Db::getAdapter($options);
                try {
                    $this->view->databases = $dbAdapter->getDatabaseNames();
                    $this->view->success = true;
                    $config->set('config.dbuser', $options);
                    if (!$this->version->checkMysqlVersion()) {
                        $this->_forward(
                            'badversion',
                            'install',
                            'default',
                            array(
                                 'message' => 'L_MYSQL_VERSION_TOO_OLD'
                            )
                        );
                    }
                    $config->saveConfigToSession();
                } catch (Msd_Exception $e) {
                    $this->view->errorMessage = $e->getMessage();
                    $this->view->success = false;
                }
            }
        }
        $this->view->lang = $lang;
    }

    /**
     * Ajax action for loading language packs
     *
     * @return string Json response
     */
    public function ajaxAction()
    {
        Zend_Layout::getMvcInstance()->disableLayout();
        Zend_Controller_Front::getInstance()->setParam('noViewRenderer', true);
        $this->_response->setHeader('Content-Type', 'text/javascript');
        $language = $this->_request->getParam('lang');
        $lang = Msd_Language::getInstance();
        $version = new Msd_Version();
        $files = array(
            'lang' => ':language' . DS . 'lang.php',
            'flag' => ':language' . DS . 'flag.gif'
        );
        if ($language === null) {
            if (!isset($_SESSION['langlist'])) {
                $languages = $lang->getAvailableLanguages();
                $_SESSION['langlist'] = array_keys($languages);
            }
            rsort($_SESSION['langlist']);
            $language = array_pop($_SESSION['langlist']);
        }
        if ($language === null) {
            unset($_SESSION['langlist']);
            echo json_encode('done');
            return;
        }
        $update = new Msd_Update(
            APPLICATION_PATH . DS . 'configs' .
            DS . 'update.ini'
        );
        $update->setUpdateParam('language', $language);
        $update->setUpdateParam('version', $version->getMsdVersion());
        $updateResult = $update->doUpdate('language', $files);
        if (!($updateResult === true)) {
            switch ($updateResult['action']) {
                case 'connection':
                    $message = array('L_UPDATE_CONNECTION_FAILED',
                                     $updateResult['server']);
                    break;
                case 'saveresponse':
                    $message = array('L_UPDATE_ERROR_RESPONSE',
                                     $updateResult['status']);
                    break;
                case 'createfile':
                    $message = array('L_WRONG_RIGHTS',
                                     $updateResult['file'],
                                     '0777');
                    break;
                case 'getrequest':
                    $message = array('L_UPDATE_ERROR_RESPONSE',
                                     $updateResult['status']);
                    break;
                default:
                    $message = '';
            }

            if ($message !== '') {
                $this->view
                        ->popUpMessage()
                        ->addMessage(
                            'update-message',
                            'L_LOGIN',
                            $message,
                            array(
                                 'modal' => true,
                                 'dialogClass' => 'error'
                            )
                        );
                $updateResult['message'] = (string)$this->view->popUpMessage();
            }
        }

        echo json_encode(
            array(
                 'language' => $language,
                 'success' => ($updateResult === true) ? true : false,
                 'error' => ($updateResult === true) ? '' : $updateResult
            )
        );
    }

    /**
     * PHP or MySQL version requirements are not met.
     *
     * @return void
     */
    public function badversionAction()
    {
        $translator = Msd_Language::getInstance()->getTranslator();
        $messageId = $this->_request->get('message');
        $message = $translator->_($messageId);
        if ($messageId == 'L_PHP_VERSION_TOO_OLD') {
            $this->view->message = sprintf(
                $message,
                $this->version->getRequiredPhpVersion(),
                PHP_VERSION
            );
        } else {
            $dbObject = Msd_Db::getAdapter();
            $this->view->message = sprintf(
                $message,
                $dbObject->getServerInfo(),
                $this->version->getRequiredMysqlVersion()
            );
        }
    }
}
