<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Sql
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Database management
 *
 * Model to manage the databases (CREATE, "TRUNCATE" and DROP).
 *
 * @package         MySQLDumper
 * @subpackage      Sqlbox
 */
class Application_Model_Databases
{
    /**
     * @var Msd_Db_MysqlCommon Connection to database.
     */
    private $_db = null;

    /**
     * @var string Name of the current database.
     */
    private $_dbName = '';

    /**
     * Class constructor.
     *
     * @param Msd_Db $db Database object
     */
    public function __construct(Msd_Db $db)
    {
        $this->_db = $db;
    }

    /**
     * Drops databases. The names are given in the argument.
     *
     * @param array|string $databaseNames
     *
     * @return array
     */
    public function dropDatabases($databaseNames)
    {
        if (is_string($databaseNames)) {
            $databaseNames = (array) $databaseNames;
        }
        $dropSql = 'DROP DATABASE `%s`;';
        $results = array();
        foreach ($databaseNames as $databaseName) {
            $errorInfo = array();
            $dropQuery = sprintf(
                $dropSql,
                $databaseName
            );
            try {
                $result = $this->_db->query(
                    $dropQuery,
                    Msd_Db::SIMPLE
                );
                if (!$result) {
                    $errorInfo = $this->_db->getLastError();
                }
            } catch (Msd_Exception $e) {
                $result = false;
                $errorInfo = array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                );
            }
            $results[$databaseName][] = array(
                'result' => $result,
                'query' => $dropQuery,
                'errorInfo' => $errorInfo,
            );
        }
        return $results;
    }

    /**
     * Gets the stored procedures. Returns an array in format
     * ROUTINE_NAME => ROUTINE_TYPE.
     *
     * @param string $dbName Name of the database
     *
     * @return array
     */
    private function _getStoredProcedures($dbName)
    {
        $routinesMeta = $this->_db->getStoredProcedures($dbName);
        $routines = array();
        foreach ($routinesMeta as $routine) {
            $routines[$routine['ROUTINE_NAME']] = $routine['ROUTINE_TYPE'];
        }
        return $routines;
    }

    /**
     * Tries to drop all stored routines.
     *
     * @param array $routines Array with the routine names.
     *
     * @return array
     */
    public function dropRoutines($routines)
    {
        $results = array();
        $dropSql = 'DROP %s `%s`.`%s`;';
        foreach ($routines as $routineName => $routineType) {
            $dropQuery = sprintf(
                $dropSql,
                $routineType,
                $this->_dbName,
                $routineName
            );
            $errorInfo = array();
            try {
                $result = $this->_db->query($dropQuery, Msd_Db::SIMPLE);
                if (!$result) {
                    $errorInfo = $this->_db->getLastError();
                }
            } catch (Msd_Exception $e) {
                $result = false;
                $errorInfo = array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                );
            }
            $results[$this->_dbName][] = array(
                'result' => $result,
                'query' => $dropQuery,
                'errorInfo' => $errorInfo,
            );
        }
        return $results;
    }

    /**
     * Tries to drop all views.
     *
     * @param array $views Array with the names of the views
     *
     * @return array
     */
    public function dropViews($views)
    {
        $results = array();
        $dropSql = 'DROP VIEW `%s`.`%s`;';
        foreach ($views as $view) {
            $dropQuery = sprintf($dropSql, $this->_dbName, $view);
            $errorInfo = array();
            try {
                $result = $this->_db->query($dropQuery, Msd_Db::SIMPLE);
                if (!$result) {
                    $errorInfo = $this->_db->getLastError();
                }
            } catch (Msd_Exception $e) {
                $result = false;
                $errorInfo = array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                );
            }
            $results[$this->_dbName][] = array(
                'result' => $result,
                'query' => $dropQuery,
                'errorInfo' => $errorInfo,
            );
        }
        return $results;
    }

    /**
     * Tries to drop all tables.
     *
     * @param array $tables Array with table names to drop
     * @return array
     */
    public function dropTables($tables)
    {
        $results = array();
        $dropSql = 'DROP TABLE `%s`.`%s`;';
        foreach ($tables as $table) {
            $errorInfo = array();
            $dropQuery = sprintf($dropSql, $this->_dbName, $table);
            try {
                $result = $this->_db->query($dropQuery, Msd_Db::SIMPLE);
                if (!$result) {
                    $errorInfo = $this->_db->getLastError();
                }
            } catch (Msd_Exception $e) {
                $result = false;
                $errorInfo = array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                );
            }
            $results[$this->_dbName][] = array(
                'result' => $result,
                'query' => $dropQuery,
                'errorInfo' => $errorInfo,
            );
        }
        return $results;
    }

    /**
     * Truncates a database. It drops all stored routines, views and tables
     * (in that order).
     *
     * @param string $databaseName Name of the database
     *
     * @return array
     */
    public function truncateDatabase($databaseName)
    {
        $this->_dbName = $databaseName;
        $routines = $this->_getStoredProcedures($databaseName);
        $procResults = $this->dropRoutines($routines);
        $views = $this->_db->getViews($databaseName);
        $viewsResults = $this->dropViews(array_keys($views));
        $tables = $this->_db->getTablesMeta($databaseName);
        $tablesResults = $this->dropTables(array_keys($tables));

        $results = array();
        if (array_key_exists($databaseName, $procResults)) {
            foreach ($procResults[$databaseName] as $procResult) {
                $results[$databaseName][] = $procResult;
            }
        }
        if (array_key_exists($databaseName, $viewsResults)) {
            foreach ($viewsResults[$databaseName] as $viewsResult) {
                $results[$databaseName][] = $viewsResult;
            }
        }
        if (array_key_exists($databaseName, $tablesResults)) {
            foreach ($tablesResults[$databaseName] as $tablesResult) {
                $results[$databaseName][] = $tablesResult;
            }
        }
        return $results;
    }

}
