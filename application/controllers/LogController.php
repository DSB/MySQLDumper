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
 * Log Controller
 *
 * Controller to handle actions triggered on log screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class LogController extends Msd_Controller_Action
{
    /**
     * Delete a log file
     *
     * @param string $logType
     *
     * @return void
     */
    public function deleteLogAction($logType)
    {
        $log = Msd_Log::getInstance();
        $log->delete($logType);
    }

    /**
     * Show log
     *
     * @return void
     */
    public function indexAction()
    {
        $logType = $this->_getParam('log', Msd_Log::PHP);
        $logger = new Msd_Log;
        $log = $logger->getFile($logType);
        $reverse = $this->_getParam('reverse', 1);
        $offset = $this->_getParam('offset', 0);
        $delete = $this->_getParam('delete');

        if ($delete != null) {
            $log->delete($logType);
            $this->_redirect('/log/index/log/' . $logType);
        }

        $sortIcon = $this->view->getIcon('ArrowDown', '', 16);
        if ($reverse == 0) {
            $sortIcon = $this->view->getIcon('ArrowUp', '', 16);
        }
        $this->view->sortIcon = $sortIcon;
        $this->view->log = $log;
        $this->view->assign(
            array(
                 'sortIcon' => $sortIcon,
                 'SORT_ORDER' => $reverse == 0 ? 1 : 0
            )
        );
        $this->view->offset = $offset;
        $this->view->log = $logger;
        $this->view->activeLog = $logType;
    }

    /**
     * Render log view and return as ajax response
     *
     * @return void
     */
    public function ajaxAction()
    {
        $logType = $this->_getParam('log', Msd_Log::PHP);
        $reverse = $this->_getParam('reverse', 0);
        $page = $this->_getParam('offset', 1);
        $entriesPerPage =
                $this->view->config->getParam('interface.recordsPerPage');
        $this->_helper->layout()->disableLayout();
        $logger = Msd_Log::getInstance();
        $lines = $logger->read($logType, $reverse);
        $pagination = $this->_getPaginator($lines, $page, $entriesPerPage);
        $this->view->log = $logType;
        $this->view->reverse = ($reverse == 1) ? 0 : 1;
        $this->view->page = $page;
        $this->view->entriesPerPage = $entriesPerPage;
        $this->view->logEntries = $pagination;
    }

    /**
     * Create Paginator
     *
     * @param array $lines
     * @param int   $offset
     *
     * @return Zend_Paginator
     */
    private function _getPaginator($lines, $offset, $entriesPerPage = 20)
    {
        $pagination = new Zend_Paginator(
            new Zend_Paginator_Adapter_Array($lines)
        );
        $pagination->setPageRange(20);
        $pagination->setCurrentPageNumber($offset)
                ->setDefaultItemCountPerPage($entriesPerPage);
        return $pagination;
    }
}

