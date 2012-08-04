<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Renders the menu
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_Menu extends Zend_View_Helper_Abstract
{
    /**
     * Renders the menu
     *
     * @param Msd_Version $version Msd_Version object
     *
     * @return void
     */
    public function menu(Msd_Version $version)
    {
        $front = Zend_Controller_Front::getInstance();
        $request = $front->getRequest();
        if ($request->getActionName() == 'login') {
            // reset menu state. Maybe user logs in again and has blended out
            // the menu before.
            $this->_resetMenuState();
            //don't render menu when we show the login form
            return;
        }
        $view = $this->view;
        $view->databases = $this->_getDatabases();
        $view->showMenu = $this->_isMenuShown();
        $view->msdVersion = $version->getMsdVersion();
        $menu = $view->render('index/menu.phtml');
        return $menu;
    }

    /**
     * Get list of databases
     *
     * Returns the list of accessable databases for actual user. If no database
     * is selected, set first one as active and use it.
     *
     * @return array Numeric array with names of databases
     */
    private function _getDatabases()
    {
        $actualDb = $this->view->dynamicConfig->getParam('dbActual');
        $databases = $this->view->dynamicConfig->getParam('databases', array());
        $dbo = Msd_Db::getAdapter();
        if (empty($databases) || $dbo->selectDb($actualDb) !== true) {
            // couldn't connect to db - refresh db-list
            $databases = $dbo->getDatabaseNames();
            // if database was deleted or is not accessible by user
            // fallback to default db
            $defaultDb = $this->view->config->getParam('dbuser.defaultDb');
            if ($defaultDb != '') {
                $actualDb = $defaultDb;
                if ($dbo->selectDb($actualDb) !== true) {
                    // couldn't connect to default db - fallback to first found
                    $actualDb = $databases[0];
                    $dbo->selectDb($actualDb);
                }
            }
            $this->view->dynamicConfig->setParam('dbActual', $actualDb);
            $this->view->dynamicConfig->setParam('databases', $databases);
        }
        return $databases;
    }

    /**
     * Detect if menu must be shown or hidden.
     *
     * @return integer
     */
    private function _isMenuShown()
    {
        $menu = new Zend_Session_Namespace('menu');
        if (!isset($menu->showMenu)) {
            $menu->showMenu = 1;
        };
        return (int) $menu->showMenu;
    }

    /**
     * Set menu state to "show".
     *
     * Actual menu state is saved to session
     *
     * @return void
     */
    private function _resetMenuState()
    {
        $menu = new Zend_Session_Namespace('menu');
        $menu->showMenu = 1;
    }
}
