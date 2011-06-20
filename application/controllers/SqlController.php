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
 * Sql Controller
 *
 * Controller to handle actions an SQLBrowser screen
 *
 * @package         MySQLDumper
 * @subpackage      Controllers
 */
class SqlController extends Zend_Controller_Action
{
    /**
     * Db-handle
     * @var Msd_Db
     */
    private $_db;

    /**
     * Init
     *
     * @return void
     */
    public function init()
    {
        $this->_db = Msd_Db::getAdapter();
    }

    /**
     * Show list of databases
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_forward('show.databases');
    }

    /**
     * Show list of databases
     *
     * @return void
     */
    public function showDatabasesAction()
    {
        $this->_helper->viewRenderer('databases/show-databases');
        $databases = $this->_db->getDatabases(true);
        $dbNames = $this->_db->getDatabaseNames();
        $dbActual = $this->view->config->get('dynamic.dbActual');
        //Fallback to first found db if actual db doesn't exist
        if (!in_array($dbActual, $dbNames)) {
            $dbActual = $dbNames[0];
        }
        $this->_setDynamicParams($dbActual);
        $this->view->dbInfos = $databases;
    }

    /**
     * Show list of all tables of selected database
     *
     * @return void
     */
    public function showTablesAction()
    {
        $this->_helper->viewRenderer('tables/show-tables');
        $pageNum = $this->_getParam('offset', 1);
        $itemCountPerPage = $this->view->config->get(
            'config.interface.recordsPerPage'
        );

        $dbActual = $this->_getParam(
            'database',
            $this->view->config->get('dynamic.dbActual')
        );
        if ($this->_getParam('dbName') !== null) {
            $dbActual = base64_decode($this->_getParam('dbName'));
        }
        $this->_db->selectDb($dbActual);
        $this->_setDynamicParams($dbActual);
        $paginatorAdapter = new Zend_Paginator_Adapter_Array(
            $this->_db->getTableStatus()
        );
        $paginator = new Zend_Paginator($paginatorAdapter);

        $paginator->setDefaultItemCountPerPage($itemCountPerPage);
        $paginator->setCurrentPageNumber($pageNum);

        $this->view->tables = $paginator;
        $this->view->page = $pageNum;
        $this->view->startEntry = $itemCountPerPage * ($pageNum - 1) + 1;
    }

    /**
     * Show data of selected table
     *
     * @return void
     */
    public function showTableDataAction()
    {
        $this->_getDynamicParams();
        $dbName = $this->view->config->get('dynamic.dbActual');
        $offset = (int)$this->_getParam('offset', 0);
        $limit = $this->view->config->get('config.interface.recordsPerPage');
        $this->_db->selectDb($dbName);
        $tableName = $this->view->config->get('dynamic.tableActual');
        try {
            $this->view->columns = $this->_db->getTableColumns($tableName);
            $tables = $this->_db->getTableStatus($tableName);
        } catch (Exception $e) {
            // selected table not found - fall back to first found table
            $tables = $this->_db->getTableStatus();
            if (isset($tables[0]['TABLE_NAME'])) {
                $tableName = $tables[0]['TABLE_NAME'];
                $this->view->columns = $this->_db->getTableColumns($tableName);
            } else {
                // the selected database has no tables
                $this->view->noTables = true;
                $tables = array();
                $tableName = '';
            }
        }
        $this->view->config->set('dynamic.tableActual', $tableName);
        if (!empty($tables)) {
            $query = sprintf(
                'SELECT SQL_CALC_FOUND_ROWS * FROM `%s` LIMIT %s, %s',
                $tableName,
                $offset,
                $limit
            );
            $this->view->data = $this->_db->query($query);
        }
        $this->view->table = $tableName;
        $this->view->tables = $tables;
        $this->view->database = $dbName;
        $this->view->offset = $offset;
        $this->render('tables/show-table-data');
    }

    /**
     * Create a new table for the selected database
     *
     * @return void
     */
    public function createTableAction()
    {
        $this->render('tables/create-table');
    }

    /**
     * Creates a new database
     *
     * @return void
     */
    public function createDatabaseAction()
    {
        $this->_helper->viewRenderer('databases/create-database');
        $collations = $this->_db->getCollations();
        $this->view->charsets = array_keys($collations);
        $this->view->collations = $collations;
        $this->view->defaultCollations = $this->_db->getDefaultCollations();
        $defaults = array(
            'dbName' => '',
            'dbCharset' => 'utf8',
            'dbCollation' => 'utf8_general_ci',
        );
        $newDbInfo = $this->_request->getParam('newDbInfo', $defaults);
        if ($this->_request->isPost()) {
            $errorInfo = array();
            try {
                $dbCreated = $this->_db->createDatabase(
                    $newDbInfo['dbName'],
                    $newDbInfo['dbCharset'],
                    $newDbInfo['dbCollation']
                );
                //db created - refresh db list for menu
                $this->view->config->set(
                    'dynamic.dbActual',
                    $newDbInfo['dbName']
                );
                $this->_refreshDbList('create.database');
            } catch (Msd_Exception $e) {
                $dbCreated = false;
                $errorInfo = array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                );
            }
            $this->view->dbCreated = $dbCreated;
            $this->view->errorInfo = $errorInfo;
        }
        $this->view->newDbInfo = $newDbInfo;
    }

    /**
     * Drops databases and set a result array for the view renderer.
     *
     * @return void
     */
    public function dropDatabaseAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->_request->isPost()) {
            $databases = $this->_request->getParam('dbNames', array());
            $databases = array_map('base64_decode', $databases);
            $databaseModel = new Application_Model_Databases($this->_db);
            $dropResults = $databaseModel->dropDatabases($databases);
            $this->view->actionResults = $dropResults;
            $this->view->executedAction = 'L_DELETE_DATABASE';
            $this->_refreshDbList();
        }
        $this->_forward('index', 'sql');
    }

    /**
     * Truncates (empties) a database.
     *
     * @return void
     */
    public function truncateDatabaseAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $databases = $this->_request->getParam('dbNames', array());
        $databases = array_map('base64_decode', $databases);
        if (!empty($databases)) {
            $databaseModel = new Application_Model_Databases($this->_db);
            $truncateResult = array();
            foreach ($databases as $database) {
                $res = $databaseModel->truncateDatabase($database);
                $truncateResult = array_merge($truncateResult, $res);
            }
            $this->view->actionResults = $truncateResult;
            $this->view->executedAction = 'L_SQL_EMPTYDB';
        }
        $this->_forward('index', 'sql');
    }

    /**
     * Optimize selected tables
     *
     * @return void
     */
    public function optimizeTablesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $tables = $this->_request->getParam('tables', array());
        $optimizeResults = array();
        $this->view->action = $this->view->lang->L_OPTIMIZE;
        $database = $this->view->config->get('dynamic.dbActual');
        $this->_db->selectDb($database);
        if ($this->_request->isPost() && !empty($tables)) {

            foreach ($tables as $tableName) {
                $optimizeResults[] = $this->_db->optimizeTable($tableName);
            }

            $this->view->actionResult = $optimizeResults;
        }
        $this->view->selectedTables = $tables;
        $this->_forward('show.tables', 'sql');
    }

    /**
     * Analyze selected tables
     *
     * @return void
     */
    public function analyzeTablesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $tables = $this->_request->getParam('tables', array());
        $analyzeResults = array();
        $this->view->action = $this->view->lang->L_ANALYZE;
        $database = $this->view->config->get('dynamic.dbActual');
        $this->_db->selectDb($database);
        if ($this->_request->isPost() && !empty($tables)) {

            foreach ($tables as $tableName) {
                $analyzeResults[] = $this->_db->analyzeTable($tableName);
            }

            $this->view->actionResult = $analyzeResults;
        }
        $this->view->selectedTables = $tables;
        $this->_forward('show.tables', 'sql');
    }

    /**
     * Check selected tables
     *
     * @return void
     */
    public function checkTablesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $tables = $this->_request->getParam('tables', array());
        $analyzeResults = array();
        $this->view->action = $this->view->lang->L_ANALYZE;
        $database = $this->view->config->get('dynamic.dbActual');
        $this->_db->selectDb($database);
        if ($this->_request->isPost() && !empty($tables)) {

            foreach ($tables as $tableName) {
                $analyzeResults[] = $this->_db->checkTable($tableName);
            }

            $this->view->actionResult = $analyzeResults;
        }
        $this->view->selectedTables = $tables;
        $this->_forward('show.tables', 'sql');
    }

    /**
     * Repair selected tables
     *
     * @return void
     */
    public function repairTablesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $tables = $this->_request->getParam('tables', array());
        $analyzeResults = array();
        $this->view->action = $this->view->lang->L_ANALYZE;
        $database = $this->view->config->get('dynamic.dbActual');
        $this->_db->selectDb($database);
        if ($this->_request->isPost() && !empty($tables)) {

            foreach ($tables as $tableName) {
                $analyzeResults[] = $this->_db->repairTable($tableName);
            }

            $this->view->actionResult = $analyzeResults;
        }
        $this->view->selectedTables = $tables;
        $this->_forward('show.tables', 'sql');
    }

    /**
     * Truncate selected tables
     *
     * @return void
     */
    public function emptyTablesAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $tables = $this->_request->getParam('tables', array());
        $truncateResults = array();
        $this->view->action = $this->view->lang->L_TRUNCATE;
        $database = $this->view->config->get('dynamic.dbActual');
        $this->_db->selectDb($database);
        if ($this->_request->isPost() && !empty($tables)) {

            foreach ($tables as $tableName) {
                $this->_db->truncateTable($tableName);
            }
            $this->view->actionResult = $truncateResults;
        }
        $this->view->selectedTables = $tables;
        $this->_forward('show.tables', 'sql');
    }

    /**
     * Show sqlbox and handel queries
     *
     * @return void
     */
    public function sqlboxAction()
    {
        $this->_helper->viewRenderer('sqlbox/sqlbox');
        $sqlboxModel = new Application_Model_Sqlbox();
        $this->view->tableSelectBox = $sqlboxModel->getTableSelectBox();
        $request = $this->getRequest();
        $config = $this->view->config;
        $query = '';
        if ($lastQuery = $config->get('dynamic.sqlboxQuery')) {
            $query = $lastQuery;
        }
        if ($request->isPost()) {
            $query = $request->getParam('sqltextarea', '');
            $config->set('dynamic.sqlboxQuery', $query);
            $query = trim($query);
            if ($query > '') {
                $this->_db->selectDb($config->get('dynamic.dbActual'));
                $sqlObject = new Msd_Sql_Object($query);
                $parser = new Msd_Sql_Parser($sqlObject, true);
                $parser->parse();
                if ($sqlObject->hasErrors()) {
                    $this->view->errorMessage = implode('<br />', $sqlObject->getErrors());
                }
                $statements = $parser->getParsedStatements();
                foreach ($statements as $statement) {
                    echo "<br>Extracted statement: ".$statement;
                    try {
                        $res = array(); // $this->_db->query($statement, Msd_Db::ARRAY_ASSOC);
                        $this->view->resultset = $res;
                    } catch (Exception $e) {
                        $this->view->errorMessage = $e->getMessage();
                    }
                }
            }
        }
        $this->_setDynamicParams();
        $this->view->boxcontent = $query;
    }

    /**
     * Reload database list after deleting or adding database(s)
     *
     * @return void
     */
    private function _refreshDbList()
    {
        $databases = $this->_db->getDatabaseNames();
        $this->view->config->set('dynamic.databases', $databases);
    }

    /**
     * Set actual database and table
     *
     * @param bool|string $dbActual    The actually selected database
     * @param string      $tableActual The actually selected table
     *
     * @return void
     */
    private function _setDynamicParams($dbActual = false, $tableActual = '')
    {
        if ($dbActual === false) {
            $dbActual = $this->view->config->get('dynamic.dbActual');
        }
        $this->view->config->set('dynamic.dbActual', $dbActual);
        $this->view->config->set('dynamic.tableActual', $tableActual);
    }

    /**
     * Get get/post params and set them to dynamic config
     *
     * @return void
     */
    private function _getDynamicParams()
    {
        $params = $this->_request->getParams();
        if (isset($params['dbName'])) {
            $dbName = base64_decode($params['dbName']);
            $this->view->config->set('dynamic.dbActual', $dbName);
        }

        if (isset($params['tableName'])) {
            $dbName = base64_decode($params['tableName']);
            $this->view->config->set('dynamic.tableActual', $dbName);
        }
    }
}

