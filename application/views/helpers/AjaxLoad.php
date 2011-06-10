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
 * Load additional content via ajax
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_AjaxLoad extends Zend_View_Helper_Abstract
{

    /**
     * Call an ajax action from view
     *
     * Renders a view snippet which fires the ajax call. The response will
     * replace the innerHtml of the given DOM-Id.
     *
     * @param array $ajaxOptions Options for ajax call (Controller, Action,
     *                           Params to hand over to action)
     * @param array $viewOptions Options to be printed to screen (showThrobber)
     *
     * @return string
     */
    public function ajaxLoad($ajaxOptions, $viewOptions = null)
    {
        $viewRenderer = Zend_Controller_Action_HelperBroker::
                            getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        $view = $viewRenderer->view;
        $view->domId = str_replace('.', '-', uniqid('', true));
        foreach ($ajaxOptions as $key => $val) {
            $view->$key = $val;
        }
        $view->ajaxOptions = $ajaxOptions;
        $view->viewOptions = $viewOptions;
        return $view->render('helper/ajax-load.phtml');
    }

}

