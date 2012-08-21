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
 * Sqlserver Controller
 *
 * Controller to handle actions an SQLBrowser screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class SqlServerController extends Msd_Controller_Action
{
    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        $this->db = Msd_Db::getAdapter();
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_forward('show.variables');
    }

    /**
     * Show list of MySQL Variables
     *
     * @return void
     */
    public function showVariablesAction()
    {
        $selectedGroup = $this->getRequest()->getParam('group', '');
        $variables = $this->db->getVariables();
        $groups = Msd_Html::getPrefixArray($variables);
        $this->view->groupOptions =
                Msd_Html::getHtmlOptions($groups, $selectedGroup);
        if ($selectedGroup > '') {
            foreach ($variables as $key => $val) {
                if (substr($key, 0, strlen($selectedGroup)) != $selectedGroup) {
                    unset($variables[$key]);
                }
            }
        }
        $this->view->variables = $variables;
    }

    /**
     * Show status values of MySQL-Server
     *
     * @return void
     */
    public function showStatusAction()
    {
        $selectedGroup = $this->getRequest()->getParam('group', '');
        $variables = $this->db->getGlobalStatus();
        $groups = Msd_Html::getPrefixArray($variables);
        $this->view->groupOptions =
                Msd_Html::getHtmlOptions($groups, $selectedGroup);
        if ($selectedGroup > '') {
            foreach ($variables as $key => $val) {
                if (substr($key, 0, strlen($selectedGroup)) != $selectedGroup) {
                    unset($variables[$key]);
                }
            }
        }
        $this->view->variables = $variables;
    }

    /**
     * Show process list
     *
     * @return void
     */
    public function showProcesslistAction()
    {
        $this->getProcesslistAction(false);
        $interval = $this->view->config->getParam('interface.refreshProcesslist');
        if ($interval < 2) {
            $interval = 2;
        }
        $this->view->interval = $interval;
    }

    /**
     * Render process list
     *
     * @param boolean $disableLayout Whether to disable the layout
     *
     * @return void
     */
    public function getProcesslistAction($disableLayout = true)
    {
        if ($disableLayout) {
            $this->_helper->layout()->disableLayout();
        }
        $processes = $this->db->query('SHOW PROCESSLIST', Msd_Db::ARRAY_ASSOC);
        $this->view->processes = $processes;
    }

    /**
     * Render process list
     *
     * @return void
     */
    public function killProcessAction()
    {
        $processId = $this->getRequest()->getParam('processId', 0);
        try {
            $this->db->query('KILL ' . $processId, Msd_Db::ARRAY_ASSOC);
        } catch (Msd_Exception $e) {
            //echo $e->getMessage().' '.$e->getCode();
            //TODO return message to client
        }
        $this->_forward('show.processlist');
    }

    /**
     * Show all known character sets
     *
     * @return void
     */
    public function showCharsetsAction()
    {
        $this->view->collations = $this->db->getCollations();
        $this->view->charsets = $this->db->getCharsets();
    }
}

