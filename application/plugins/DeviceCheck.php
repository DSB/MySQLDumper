<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Plugins
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Check for mobile client and set the right paths and layout.
 *
 * @package         MySQLDumper_Plugins
 * @subpackage      MobileCheck
 */
class Application_Plugin_DeviceCheck extends Zend_Controller_Plugin_Abstract
{
    /**
     * Set view path to mobile if user agent string is a mobile one
     *
     * @param object
     * @see Zend_Controller_Plugin_Abstract::dispatchLoopStartup()
     * @return void
     */
    public function dispatchLoopStartup(
                Zend_Controller_Request_Abstract $request)
    {
        $userAgentString = $request->getHeader('user-agent');

        if (Zend_Http_UserAgent_Mobile::match($userAgentString, $_SERVER)) {
            //@todo make a layoutchanger class from this
            $this->_setMobileLayout();
        }

        return;
    }

    /**
     * Set new layout, new view path and helpers for mobile layout
     * @return void
     */
    protected function _setMobileLayout()
    {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV
        );
        $mvc = Zend_Layout::getMvcInstance();

        //Set Layout for mobile
        $mvc->setLayout('mobile');

        $view = new Zend_View();
        $view->setScriptPath(APPLICATION_PATH . '/views/mobile/scripts/');

        //Get all view helpers from application.ini and add them to new view
        foreach ($config->resources->view->helperPath as
                            $helperPrefix =>$helperPath) {
            $view->addHelperPath($helperPath, $helperPrefix);
        }

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'viewRenderer'
        );
        $viewRenderer->setView($view);
    }
}