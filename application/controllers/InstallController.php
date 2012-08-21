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
class InstallController extends Msd_Controller_Action
{
    /**
     * @var Msd_Config
     */
    public $config;
    /**
     * @var Msd_DynamicConfig
     */
    public $dynamicConfig;

    /**
     * @var Msd_Language
     */
    public $lang;

    /**
     * Init controller
     *
     * @return void
     */
    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('install');
        $this->version           = new Msd_Version();
        $_SESSION['msd_install'] = true;
        if ($this->_request->getActionName() != 'badversion!' && !$this->version->checkPhpVersion()) {
            $this->_forward(
                'badversion',
                'install',
                'default',
                array(
                    'message' => 'L_PHP_VERSION_TOO_OLD'
                )
            );
        }
        $this->_config->setParam('interface.theme', 'msd');
        $this->_config->setParam('paths.iconPath', 'css/msd/icons');
        $this->_config->setParam('configFile', 'mysqldumper.ini');
        $this->view->config = $this->_config;
        $lang               = isset($_SESSION['msd_lang']) ? $_SESSION['msd_lang'] : 'en';
        $translator         = Msd_Language::getInstance();
        $this->view->lang   = $translator->loadLanguage($lang);
    }

    /**
     * Start installation process
     *
     * @return void
     */
    public function indexAction()
    {
        // delete cookie from further installation if present to not import old values
        if (isset($_SESSION['msd_autologin'])) {
            setcookie('msd_autologin', null, null, '/');
            $_SESSION['msd_autologin'] = array();
        }
        Zend_Session_Namespace::resetSingleInstance('MySQLDumper');
        if ($this->_request->isPost()) {
            $language = $this->_getParam('language');
            $this->_config->setParam('interface.language', $language);
            $this->_config->setParam('general.title', 'MySQLDumper');
            $this->_config->setParam('configFile', 'mysqldumper.ini');
            $_SESSION['msd_lang'] = $language;
            $redirectUrl          = $this->view->url(array('controller' => 'install', 'action' => 'step2'), null, true);
            $this->_response->setRedirect($redirectUrl);
        }
        // set selected languge
        $language  = $this->_getParam('language', null);
        $languages = $this->_lang->getAvailableLanguages();

        // check user browser language
        $locale        = new Zend_Locale();
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
                'number'      => 1,
                'description' => $this->_lang->getTranslator()
                    ->_('L_SELECT_LANGUAGE')
                    . ' (' . $language . ')'));
        $languagesStatus      = array();
        foreach ($languages as $langId => $langName) {
            $languagesStatus[$langId] = array(
                'langName'  => $langName,
                'installed' => file_exists(
                    APPLICATION_PATH . '/language/' . $langId . '/lang.php'
                )
            );
        }
        $this->_config->setParam('interface.language', $language);
        $this->view->languages = $languagesStatus;
        $this->view->lang      = Msd_Language::getInstance();
        Msd_Registry::setConfig($this->_config);
        $this->view->config = Msd_Registry::getConfig();
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
        $language             = $this->_config->getParam('interface.language');
        $this->view->stepInfo = array(
            'language'    => $language,
            'firstStepOK' => true,
            'stepInfo'    => array(
                'number'      => 2,
                'description' => $this->_lang->getTranslator()->_('L_CHECK_DIRS'),
            )
        );
        $creationStatus       = array();
        $checkDirs            = array(
            'work'     => $this->_config->getParam('paths.work'),
            'config'   => $this->_config->getParam('paths.config'),
            'log'      => $this->_config->getParam('paths.log'),
            'backup'   => $this->_config->getParam('paths.backup'),
            'iconpath' => $this->_config->getParam('paths.iconPath')
        );

        foreach ($checkDirs as $checkDir) {
            clearstatcache();
            if (!is_dir($checkDir)) {
                @mkdir($checkDir, 0777);
            }
            clearstatcache();
            $checkExists               = file_exists($checkDir);
            $checkWritable             = Msd_File::isWritable($checkDir, 0777);
            $creationStatus[$checkDir] = array(
                'chmod'    => Msd_File::getChmod($checkDir),
                'exists'   => $checkExists,
                'writable' => $checkWritable,
            );
            $this->view->status        = $creationStatus;
        }
        if (!in_array(false, $creationStatus)) {
            $this->_config->setParam('configFile', 'mysqldumper');
            //$this->_config->save();
            $redirectUrl = $this->view->url(array('controller' => 'install', 'action' => 'step3'), null, true);
            $this->_response->setRedirect($redirectUrl);
        }
    }

    /**
     * Step 3 - Enter administrative user
     *
     * @return void
     */
    public function step3Action()
    {
        $language             = $this->_config->getParam('interface.language');
        $form                 = new Application_Form_Install_User();
        $this->view->stepInfo = array(
            'language'     => $language,
            'firstStepOK'  => true,
            'secondStepOK' => true,
            'stepInfo'     => array(
                'number'      => 3,
                'description' => $this->_lang->getTranslator()->_('L_AUTHENTICATE'),
            )
        );
        if ($this->_request->isPost()) {
            $postData = $this->_request->getParams();
            $form->getElement('pass_confirm')->getValidator('Identical')->setToken($postData['pass']);
            if ($form->isValid($postData)) {
                $ini = new Msd_Ini();
                $ini->set('name', $postData['user'], 'user');
                $ini->set('pass', md5($postData['pass']), 'user');
                $ini->saveFile(APPLICATION_PATH . '/configs/users.ini');
                $redirectUrl = $this->view->url(array('controller' => 'install', 'action' => 'step4'), null, true);
                $this->_response->setRedirect($redirectUrl);
            }
        }
        $this->view->form = $form;
        $this->view->lang = Msd_Language::getInstance();
    }

    /**
     * Step 4 - Enter database params
     *
     * @return void
     */
    public function step4Action()
    {
        $language             = $this->_config->getParam('interface.language');
        $this->view->stepInfo = array(
            'language'     => $language,
            'firstStepOK'  => true,
            'secondStepOK' => true,
            'thirdStepOK'  => true,
            'stepInfo'     => array(
                'number'      => 4,
                'description' => $this->_lang->getTranslator()->_('L_DBPARAMETER'),
            )
        );

        if ($this->_request->isPost()) {
            $options = array(
                'host'   => $this->_getParam('host'),
                'user'   => $this->_getParam('user'),
                'pass'   => $this->_getParam('pass'),
                'manual' => $this->_getParam('manual'),
                'port'   => $this->_getParam('port'),
                'socket' => $this->_getParam('socket'),
            );

            $dbAdapter = Msd_Db::getAdapter($options);
            try {
                $this->view->databases = $dbAdapter->getDatabaseNames();
                $this->view->success   = true;
                $this->_config->setParam('dbuser', $options);
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
            } catch (Msd_Exception $e) {
                $this->view->errorMessage = $e->getMessage();
                $this->view->success      = false;
                return;
            }

            $saveParam = $this->_getParam('save');
            $this->_config->setParam('dbuser', $options);
            if ($saveParam !== null && $saveParam == 1) {
                $this->_config->setParam('general.title', 'MySQLDumper');
                $this->_config->setParam('dbuser.defaultDb', $this->_getParam('defaultDb'));
                $this->_config->save('mysqldumper.ini');
                unset($_SESSION['msd_lang']);
                unset($_SESSION['msd_install']);
                $redirectUrl = $this->view->url(array('controller' => 'index', 'action' => 'index', null, true));
                $this->_response->setRedirect($redirectUrl);
            }
        }
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
        $version  = new Msd_Version();
        $files    = array(
            'lang' => ':language/lang.php',
            'flag' => ':language/flag.gif'
        );
        if ($language === null) {
            if (!isset($_SESSION['langlist'])) {
                $languages            = $this->_lang->getAvailableLanguages();
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
        $update = new Msd_Update(APPLICATION_PATH . '/configs/update.ini');
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
                        'modal'       => true,
                        'dialogClass' => 'error'
                    )
                );
                $updateResult['message'] = (string)$this->view->popUpMessage();
            }
        }

        echo json_encode(
            array(
                'language' => $language,
                'success'  => ($updateResult === true) ? true : false,
                'error'    => ($updateResult === true) ? '' : $updateResult
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
        $messageId  = $this->_request->get('message');
        $message    = $translator->_($messageId);
        if ($messageId == 'L_PHP_VERSION_TOO_OLD') {
            $this->view->message = sprintf(
                $message,
                $this->version->getRequiredPhpVersion(),
                PHP_VERSION
            );
        } else {
            $dbObject            = Msd_Db::getAdapter();
            $this->view->message = sprintf(
                $message,
                $dbObject->getServerInfo(),
                $this->version->getRequiredMysqlVersion()
            );
        }
    }
}
