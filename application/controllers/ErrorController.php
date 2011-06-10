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
 * Error Controller
 *
 * Handle unexpected errors and uncaught Exceptions
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class ErrorController extends Zend_Controller_Action
{
    /**
     * Handle error
     *
     * @return void
     */
    public function errorAction()
    {
        $this->_helper->layout->disableLayout();
        $errors = $this->_getParam('error_handler');
        if (is_object($errors)) {
            $exceptionTypes = array(
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE,
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER,
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
            if (in_array($errors->type, $exceptionTypes)) {
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found<br />'
                                       . $errors->exception->getMessage();
                $this->view->displayErrors = 1;
            } else {
                // application error
                $this->getResponse()->setHttpResponseCode(200);
                $this->view->message = 'Application error: '
                                       . $errors->exception->getMessage();
            }

            // conditionally display exceptions
            if ($this->getInvokeArg('displayExceptions') == true) {
                $this->view->exception = $errors->exception;
            }
            if (in_array(APPLICATION_ENV, array('development', 'testing'))) {
                $this->view->displayErrors = 1;
            }
            $this->view->request = $errors->request;
        }
    }
}

