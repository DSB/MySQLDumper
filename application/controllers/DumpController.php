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
 * Dump Controller
 *
 * Controller to handle actions triggered on dump screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class DumpController extends Msd_Controller_Action
{
    /**
     * Show dump page
     *
     * @return void
     */
    public function indexAction()
    {
        $dump = new Msd_Dump();
        $dump->prepareDumpProcess();
        $this->view->dumpData                        = new StdClass();
        $this->view->dumpData->nrOfDatabasesToBackup = count($dump->dbsToBackup);
        $this->view->dumpData->databasesToBackup     = implode(', ', array_keys($dump->dbsToBackup));
        $this->view->dumpData->sumTotal              = $dump->sumTotal;
        //TODO get comment from config profile
        $this->view->dumpData->comment = '';
    }

    /**
     * Start dump action
     *
     * @return void
     */
    public function startDumpAction()
    {
        $taskList              = Msd_TaskManager::getInstance('backupTasks');
        $tasks                 = $taskList->getTasks();
        $this->view->sessionId = Zend_Session::getId();
    }

    /**
     * Do dump action
     *
     * @return void
     */
    public function doDumpAction()
    {
        Zend_Layout::getMvcInstance()->disableLayout();
        Zend_Controller_Front::getInstance()->setParam('noViewRenderer', true);
        $taskList = Msd_TaskManager::getInstance('backupTasks');
        $tasks    = $taskList->getTasks();
        $ret      = array(
            'backup_in_progress' => false,
            'config_file'        => $this->view->dynamicConfig->getParam('configFile')
        );
        echo json_encode($ret);
    }
}
