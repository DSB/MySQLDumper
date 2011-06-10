<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Bootstrap class
 *
 * @package         MySQLDumper
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addHelper(
            new Msd_Action_Helper_AssignConfigAndLanguage()
        );
    }

    /**
     * Start session
     *
     * Anyhing else is set in configs/application.ini
     *
     * @return void
     */
    public function _initApplication()
    {
        Zend_Session::setOptions(array('strict' => true));
        Zend_Session::start();
    }

    /**
     *
     * Set Firebug_logger in registry
     *
     * @return void
     */
    public function _initFirbugLogger()
    {
        $writer = new Zend_Log_Writer_Firebug();
        $logger = new Zend_Log($writer);
        Zend_Registry::set('logger', $logger);
    }
}
