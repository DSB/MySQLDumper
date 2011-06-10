<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Dump
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */
/**
 * Dump Class
 *
 * Offers some methods to wrap some common SQL-commands
 *
 * @package         MySQLDumper
 * @subpackage      Dump
 */
class Msd_Dump
{
    /**
     * Constructor
     *
     * return void
     */
    public function __construct()
    {
        $this->dbsToBackup = array();
        $this->tableInfo = array();
        $this->recordsTotal = 0;
        $this->tablesTotal = 0;
        $this->datasizeTotal = 0;
        $this->dbActual = null;
        $this->sumTotal = $this->_initSum();
        $this->dbo = Msd_Db::getAdapter();
    }

    /**
     * Get databases to backup and calculate sum array
     *
     * @return void
     */
    function prepareDumpProcess()
    {
        $taskList = Msd_TaskManager::getInstance('backupTasks', true);
        $this->dbsToBackup = $this->_getDbsToBackup();
        $dbNames=array_keys($this->dbsToBackup);
        foreach ($dbNames as $dbName) {
            $sumInfo = $this->_getDatabaseSums($dbName);
            $this->_addDatabaseSums($sumInfo);
            $this->buildTaskList($dbName, $taskList);
        }
        // set db to be dumped first -> start index is needed
        $this->dbActual = $dbNames[0];
        //Debug::out($taskList->getTasks());
    }

    /**
     * Get list of databases that shold be dumped
     *
     * @return array
     */
    private function _getDbsToBackup()
    {
        $config = Msd_Configuration::getInstance();
        $databases = $config->get('dynamic.databases');
        // first check if any db is marked to be dumped
        $dbToDumpExists = false;
        if (!empty($databases)) {
            foreach ($databases as $dbName => $val) {
                $this->databases[$dbName] = array();
                if (isset($val['dump']) && $val['dump'] == 1) {
                    $this->dbsToBackup[$dbName] = $val;
                    $dbToDumpExists = true;
                }
            }
        }
        if (!$dbToDumpExists) {
            // no db selected for dump -> set actual db to be dumped
            $index = $config->get('dynamic.dbActual');
            $this->dbsToBackup[$index] = array();
            $this->dbsToBackup[$index]['dump'] = 1;
        }

        return $this->dbsToBackup;
    }

    /**
     * Get sum of tables, records and data size grouped by table type
     *
     * @param string $db The database to check
     *
     * @return void
     */
    private function _getDatabaseSums($dbName)
    {
        $this->dbo->selectDb($dbName);
        $metaInfo = $this->dbo->getTableStatus();
        $sum = array();
        foreach ($metaInfo as $index => $vals) {
            if ($vals['TABLE_TYPE'] == 'BASE TABLE') {
                $type = $vals['ENGINE'];
                if (!isset($sum[$type])) {
                    $sum[$type] = $this->_initSum();
                }
                $sum[$type]['tablesTotal']++;
                if (!in_array($type, array('VIEW', 'MEMORY'))) {
                    $sum[$type]['recordsTotal'] += $vals['TABLE_ROWS'];
                    $sum[$type]['datasizeTotal'] += $vals['DATA_LENGTH'];
                }
            }
        }
        if (!empty($sum)) {
            ksort($sum);
        }
        return $sum;
    }

    /**
     * Add sums of a database to the total sum array $this->sumTotal
     *
     * @param $sum Array containing the sum values for a database
     *
     * @return void
     */
    private function _addDatabaseSums($sum)
    {
        $types = array_keys($sum);
        foreach ($types as $type) {
            if (!isset($this->sumTotal['tables'][$type])) {
                $this->sumTotal['tables'][$type] = $this->_initSum();
            }
            $this->sumTotal['tables'][$type] =$this->_sumAdd(
                $this->sumTotal['tables'][$type], $sum[$type]
            );
            $this->sumTotal['tablesTotal'] += $sum[$type]['tablesTotal'];
            $this->sumTotal['recordsTotal'] += $sum[$type]['recordsTotal'];
            $this->sumTotal['datasizeTotal'] += $sum[$type]['datasizeTotal'];
        }
    }

    /**
     * Init a sum array
     *
     * @return array
     */
    private function _initSum()
    {
        $sum = array();
        $sum['tablesTotal'] = 0;
        $sum['recordsTotal'] = 0;
        $sum['datasizeTotal'] = 0;
        return $sum;
    }

    /**
     * Add a sum array
     *
     * @return array
     */
    private function _sumAdd($baseArr, $addArr)
    {
        $baseArr['tablesTotal'] += $addArr['tablesTotal'];
        $baseArr['recordsTotal'] += $addArr['recordsTotal'];
        $baseArr['datasizeTotal'] += $addArr['datasizeTotal'];
        return $baseArr;
    }

    /**
     * Add the task "get create table" for each table to the task list
     *
     * @param string          $dbName Name of database
     * @param Msd_TaskManager $tasks  TaskManager instance
     *
     * @return void
     */
    public function buildTaskList($dbName, Msd_TaskManager $taskList)
    {
        $tables = $this->dbo->getTableStatus(false, $dbName);
        foreach ($tables as $table) {
            // add create table
            $taskList->addTask(
                Msd_TaskManager::GET_CREATE_TABLE,
                array('db' => $dbName,
                      'table' => $table['TABLE_NAME']
                )
            );
            // add dump data
            if ($table['TABLE_TYPE'] === 'BASE TABLE') {
                $taskList->addTask(
                    Msd_TaskManager::BACKUP_TABLE_DATA,
                    array('db' => $dbName,
                          'table' => $table['TABLE_NAME']
                    )
                );
            }
            // add keys and indexes
            $taskList->addTask(
                Msd_TaskManager::GET_ALTER_TABLE_ADD_KEYS,
                array('db' => $dbName,
                      'table' => $table['TABLE_NAME']
                )
            );
        }
    }
}