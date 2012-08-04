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
 * Index controller
 *
 * Controller to handle actions triggered on index screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class IndexController extends Msd_Controller_Action
{
    /**
     * Remember last controler
     * @var string
     */
    private $_lastController;

    /**
     * Remember last action
     * @var string
     */
    private $_lastAction;

    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        $request               = $this->getRequest();
        $this->_lastController = $request->getParam('lastController', 'index');
        $this->_lastAction     = $request->getParam('lastAction', 'index');
    }

    /**
     * Process index action
     *
     * @return void
     */
    public function indexAction()
    {
        $version = new Msd_Version();
        if (!$version->checkPhpVersion()) {
            $this->_forward(
                'badversion',
                'install',
                'default',
                array('message' => 'L_PHP_VERSION_TOO_OLD')
            );
        }

        try {
            $dbo  = Msd_Db::getAdapter();
            $data = Msd_File::getLatestBackupInfo();
            if (!empty($data)) {
                $statusline       = Msd_File_Dump::getStatusline($data['filename']);
                $data['filename'] = $statusline['dbname'];
            } else {
                $data['filename'] = '';
            }
            $data['mysqlServerVersion']     = $dbo->getServerInfo();
            $data['mysqlClientVersion']     = $dbo->getClientInfo();
            $data['serverMaxExecutionTime'] = (int)@get_cfg_var('max_execution_time');
            $this->view->assign($data);
            if ($this->view->dynamicConfig->getParam('dbActual', '') == '') {
                $dbNames = $dbo->getDatabaseNames();
                $this->view->dynamicConfig->setParam('dbActual', $dbNames[0]);
            }
        } catch (Exception $e) {
            $configNames = Msd_File::getConfigNames();
            if (count($configNames) == 0) {
                // no configuration file found - we need to install MSD
                $this->_redirect('/install/index');
            } else {
                // config found and loaded but we couldn't access MySQL
                // MySQL data seems to be invalid (changed user or server)
                // TODO give feedback to user and let him correct MySQL data
                $this->_redirect('/index/login');
            }
        }
        if (!$version->checkMysqlVersion()) {
            $this->_forward(
                'badversion',
                'install',
                'default',
                array('message' => 'L_MYSQL_VERSION_TOO_OLD')
            );
        }
        $this->view->version   = $version;
        $this->view->dbAdapter = get_class($dbo);
    }

    /**
     * Switch configuration file
     *
     * Load selected configuration and forward to last page
     *
     * @return void
     */
    public function switchconfigAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $request = $this->getRequest();
        $file    = base64_decode($request->getParam('selectedConfig'));
        $this->_config->load($file);
        $this->view->config->load($file);
        if ($this->_lastAction != 'switchconfig') { //prevent endless loop
            $this->_forward($this->_lastAction, $this->_lastController);
        }
    }

    /**
     * Select another database as actual db
     *
     * @return void
     */
    public function selectdbAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $request    = $this->getRequest();
        $selectedDb = base64_decode($request->getParam('selectedDb'));
        $this->view->dynamicConfig->setParam('dbActual', $selectedDb);
        if ($this->_lastAction != 'selectdb') { //prevent endless loop
            $redirectUrl = $this->view->url(
                array(
                    'controller' => $this->_lastController,
                    'action'     => $this->_lastAction,
                ),
                null,
                true
            );
            $this->_response->setRedirect($redirectUrl);
        }
    }

    /**
     * Refresh database list
     *
     * @return void
     */
    public function dbrefreshAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $dbo       = Msd_Db::getAdapter();
        $databases = $dbo->getDatabaseNames();
        $this->view->dynamicConfig->setParam('databases', $databases);
        $actualDb = $this->view->dynamicConfig->getParam('dbActual');
        if ($dbo->selectDb($actualDb) !== true) {
            //actual db is no longer available -> switch to first one
            $this->view->dynamicConfig->setParam('dbActual', $databases[0]);
        }
        if ($this->_lastAction != 'refreshdb') { //prevent endless loop
            $redirectUrl = $this->view->url(
                array(
                    'controller' => $this->_lastController,
                    'action'     => $this->_lastAction,
                ),
                null,
                true
            );
            $this->_response->setRedirect($redirectUrl);
        }
    }

    /**
     * Process phpinfo action
     *
     * @return void
     */
    public function phpinfoAction()
    {
        //nothing to process - just render view
    }

    /**
     * Redirect to url
     *
     * @param array $url
     *
     * @return void
     */
    private function _doRedirect(array $url = array())
    {
        $this->_response->setRedirect($this->view->url($url, null, true));
    }

    /**
     * Logout the user and redirect him to login page
     */
    public function logoutAction()
    {
        //un-Auth user
        $user = new Msd_User();
        $user->logout();
        if (PHP_SAPI != 'cli') {
            setcookie('msd_autologin', null, null, '/');
        }
        $this->_doRedirect(
            array(
                'controller' => 'index',
                'action'     => 'login'
            )
        );
    }

    /**
     * User login
     *
     * @return void
     */
    public function loginAction()
    {
        $form = new Application_Form_Login();
        if ($this->_request->isPost()) {
            $user     = new Msd_User();
            $postData = $this->_request->getParams();
            if ($form->isValid($postData)) {
                $autoLogin            = ($postData['autologin'] == 1) ? true : false;
                $loginResult          = $user->login(
                    $postData['user'],
                    $postData['pass'],
                    $autoLogin
                );
                $this->view->messages = $user->getAuthMessages();
                switch ($loginResult) {
                    case Msd_User::NO_USER_FILE:
                    case Msd_User::NO_VALID_USER:
                        // users.ini doesn't exist or doesn't have entries
                        $this->_doRedirect(
                            array(
                                'controller' => 'install',
                                'action'     => 'index'
                            )
                        );
                        break;
                    case Msd_User::UNKNOWN_IDENTITY:
                        // user is not listed in users.ini
                        break;
                    case Msd_User::SUCCESS:
                        $defaultDb = $this->view->config->getParam('dbuser.defaultDb'
                        );

                        // set actualDb to defaultDb
                        if ($defaultDb != '') {
                            $this->view->dynamicConfig->setParam('dbActual', $defaultDb);
                        }
                        $this->_doRedirect(
                            array(
                                'controller' => 'index',
                                'action'     => 'index'
                            )
                        );
                        return;
                        break;
                }
                // if we get here wrong credentials are given
                $this->view->popUpMessage()
                    ->addMessage(
                    'login-message',
                    'L_LOGIN',
                    $user->getAuthMessages(),
                    array(
                        'modal'       => true,
                        'dialogClass' => 'error'
                    )
                );
            }
        }
        $this->view->form = $form;
    }

    /**
     * Toggle menu state (shown or hidden) and save state to session.
     *
     * @return void
     */
    public function ajaxToggleMenuAction()
    {
        $menu = new Zend_Session_Namespace('menu');
        if (isset($menu->showMenu)) {
            $menu->showMenu = (int)$menu->showMenu;
        } else {
            $menu->showMenu = 0;
        }
        $menu->showMenu = $menu->showMenu == 1 ? 0 : 1;
        $this->_helper->layout()->disableLayout();
        $this->view->showMenu = $menu->showMenu;
    }

}
