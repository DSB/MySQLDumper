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
 * Renders the SqlBrowser head naviagtion menu
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_SqlHeadNavi extends Zend_View_Helper_Abstract
{
    public function sqlHeadNavi()
    {
        $view = $this->view;
        return $view->render('sql/sql-head-navi.phtml');
    }

}
