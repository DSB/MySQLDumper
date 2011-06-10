<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Db
 * @version         SVN: $rev: 1205 $
 * @author          $Author$
 */

/**
 * Class offers some db related methods that are equal for Mysql and MySQLi.
 *
 * @package         MySQLDumper
 * @subpackage      Db
 */
abstract class Msd_Db_MysqlCommon extends Msd_Db
{
    /**
     * Get the list of table and view names of given database
     *
     * @param string $dbName Name of database
     *
     * @return array
     */
    public function getTables($dbName)
    {
        $tables = array();
        $sql = 'SHOW TABLES FROM `' . $dbName . '`';
        $res = $this->query($sql, self::ARRAY_NUMERIC);
        foreach ($res as $val) {
            $tables[] = $val[0];
        }
        return $tables;
    }

    /**
     * Get the list of tables of the given database. The result include tables
     * meta data.
     *
     * @param string $dbName Name of database
     *
     * @return array
     */
    public function getTablesMeta($dbName)
    {
        $tablesSql = 'SELECT * FROM `information_schema`.`TABLES` '
                     . 'WHERE `TABLE_SCHEMA` = \'' . $this->escape($dbName) . '\'';
        $rawTables = $this->query($tablesSql, self::ARRAY_ASSOC);
        $tables = array();
        foreach ($rawTables as $rawTable) {
            $tables[$rawTable['TABLE_NAME']] = $rawTable;
        }
        return $tables;
    }

    /**
     * Get information of databases
     *
     * Gets list and info of all databases that the actual MySQL-User can access
     * and saves it in $this->databases.
     *
     * @param bool $addViews If set nr of views and routines are added
     *
     * @return array
     */
    public function getDatabases($addViews = false)
    {
        $query = 'SELECT `is`.*, count(`t`.`TABLE_NAME`) `tables`'
                 . ' FROM `information_schema`.`SCHEMATA` `is`'
                 . ' LEFT JOIN `information_schema`.`TABLES` `t` '
                 . ' ON `t`.`TABLE_SCHEMA` = `is`.`SCHEMA_NAME`'
                 . ' GROUP BY `is`.`SCHEMA_NAME`'
                 . ' ORDER BY `is`.`SCHEMA_NAME` ASC';
        $res = $this->query($query, self::ARRAY_ASSOC, true);
        if ($addViews) {
            $views = $this->getNrOfViews();
            $routines = $this->getNrOfRoutines();
            $sizes = $this->getDatabaseSizes();
        }
        foreach ($res as $row) {
            $database = $row['SCHEMA_NAME'];
            if ($addViews) {
                $row['views'] = 0;
                $row['routines'] = 0;
                $row['size'] = 0;
                $row[$database] = 0;
                if (isset($sizes[$database])) {
                    $row['size'] = $sizes[$database];
                }
                // add views
                if (isset($views[$database])) {
                    $row['views'] = $views[$database];
                    $row['tables'] -= $views[$database];
                }
                // add routines
                if (isset($routines[$database])) {
                    $row['routines'] = $routines[$database];
                }
            }
            unset($row['SCHEMA_NAME']);
            $this->_databases[$database] = $row;
        }
        return $this->_databases;
    }

    /**
     * Return assoc array with the names of accessable databases
     *
     * @return array Assoc array with database names
     */
    public function getDatabaseNames()
    {
        if ($this->_databases == null) {
            $this->getDatabases();
        }
        return array_keys($this->_databases);
    }

    /**
     * Returns the actual selected database.
     *
     * @return string
     */
    public function getSelectedDb()
    {
        return $this->_dbSelected;
    }

    /**
     * Returns the CREATE Statement of a table.
     *
     * @param string $table
     *
     * @return string
     */
    public function getTableCreate($table)
    {
        $sql = 'SHOW CREATE TABLE `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        return $res[0]['Create Table'];
    }

    /**
     * Gets the full description of all columns of a table.
     *
     * Saves it to $this->metaTables[$database][$table].
     *
     * @param string $table
     *
     * @return array
     */
    public function getTableColumns($table)
    {
        $dbName = $this->getSelectedDb();
        $sql = 'SHOW FULL FIELDS FROM `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (!isset($this->_metaTables[$dbName])) {
            $this->_metaTables[$dbName] = array();
        }
        if (is_array($res)) {
            $this->_metaTables[$dbName][$table] = array();
            foreach ($res as $r) {
                $this->_metaTables[$dbName][$table][$r['Field']] = $r;
            }
        }
        return $this->_metaTables[$dbName][$table];
    }

    /**
     * Optimize given table.
     *
     * Returns false on error or Sql's Msg_text if query succeeds.
     *
     * @param string $table Name of table
     *
     * @return array
     */
    public function optimizeTable($table)
    {
        return $this->_executeMaintainAction('OPTIMIZE', $table);
    }

    /**
     * Analyze given table.
     *
     * Returns false on error or Sql's Msg_text if query succeeds.
     *
     * @param string $table Name of table
     *
     * @return array
     */
    public function analyzeTable($table)
    {
        return $this->_executeMaintainAction('ANALYZE', $table);
    }

    /**
     * Check given table.
     *
     * Returns false on error or Sql's Msg_text if query succeeds.
     *
     * @param string $table Name of table
     *
     * @return array
     */
    public function checkTable($table)
    {
        return $this->_executeMaintainAction('CHECK', $table);
    }

    /**
     * Repair given table.
     *
     * Returns false on error or Sql's Msg_text if query succeeds.
     *
     * @param string $table Name of table
     *
     * @return array
     */
    public function repairTable($table)
    {
        return $this->_executeMaintainAction('REPAIR', $table);
    }

    /**
     * Truncate a table (delete all records)
     *
     * @param string $table The tabel to truncate
     *
     * @return bool
     */
    public function truncateTable($table)
    {
        $sql = 'TRUNCATE `' . $this->escape($table) . '`';
        $res = $this->query($sql, self::SIMPLE);
        return $res;
    }

    /**
     * Execute maintaining action on a table (optimize, analyze, check, repair)
     *
     * @param string $action Action to perform
     *
     * @return array Result array conataining messages
     */
    private function _executeMaintainAction($action, $table)
    {
        $sql = $action . ' TABLE `' . $this->escape($table) . '`';
        try {
            $res = $this->query($sql, Msd_Db::ARRAY_ASSOC);
            if (isset($res[0]['Msg_text'])) {
                return $res[0];
            }
        } catch (Msd_Exception $e) {
            unset($e);
        }
        $ret = array('Table' => $table);
        return array_merge($ret, $this->getLastError());
    }

    /**
     * Get list of known charsets from MySQL-Server.
     *
     * @return array
     */
    public function getCharsets()
    {
        if (!empty($this->_charsets)) {
            return $this->_charsets;
        }
        $sql = 'SELECT * FROM `information_schema`.`CHARACTER_SETS` ORDER BY `CHARACTER_SET_NAME`';
        $result = $this->query($sql, self::ARRAY_ASSOC);
        $this->_charsets = array();
        foreach ($result as $res) {
            $this->_charsets[$res['CHARACTER_SET_NAME']] = $res;
        }
        return $this->_charsets;
    }

    /**
     * Gets extended table information for one or all tables.
     *
     * @param string | false $tableName
     * @param string | false $databaseName
     *
     * @return array
     */
    public function getTableStatus($tableName = false, $databaseName = false)
    {
        if ($databaseName === false) {
            $databaseName = $this->getSelectedDb();
        }
        $sql = "SELECT * FROM `information_schema`.`TABLES` WHERE "
               . "`TABLE_SCHEMA`='" . $this->escape($databaseName) . "'";
        if ($tableName !== false) {
            $sql .= " AND `TABLE_NAME` LIKE '" . $this->escape($tableName) . "'";
        }
        $res = $this->query($sql, self::ARRAY_ASSOC);
        return $res;
    }

    /**
     * Get variables of SQL-Server and return them as assoc array
     *
     * @return array
     */
    public function getVariables()
    {
        $ret = array();
        $variables = $this->query('SHOW VARIABLES', Msd_Db::ARRAY_ASSOC);
        foreach ($variables as $val) {
            $ret[$val['Variable_name']] = $val['Value'];
        }
        return $ret;
    }

    /**
     * Get global status variables of SQL-Server and return them as assoc array
     *
     * @return array
     */
    public function getGlobalStatus()
    {
        $ret = array();
        $variables = $this->query('SHOW GLOBAL STATUS', Msd_Db::ARRAY_ASSOC);
        foreach ($variables as $val) {
            $ret[$val['Variable_name']] = $val['Value'];
        }
        return $ret;
    }

    /**
     * Get the number of records of a table by query SELECT COUNT(*)
     *
     * @param string $tableName The name of the table
     * @param string $dbName    The name of the database
     *
     * @return integer The number of rows isnide table
     */
    public function getNrOfRowsBySelectCount($tableName, $dbName = null)
    {
        if ($dbName === null) {
            $dbName = $this->getSelectedDb();
        }
        ;
        $sql = 'SELECT COUNT(*) as `Rows` FROM `%s`.`%s`';
        $sql = sprintf($sql, $this->escape($dbName), $this->escape($tableName));
        $rows = $this->query($sql, Msd_Db::ARRAY_ASSOC);
        return (int)$rows[0]['Rows'];
    }

    /**
     * Retrieves the collations from information schema.
     *
     * @param string|null $charsetName Name of the charset
     *
     * @return array
     */
    public function getCollations($charsetName = null)
    {
        $where = "";
        if (!empty($charsetName)) {
            $where = "WHERE `CHARACTER_SET_NAME` = '" . $this->escape($charsetName) . "'";
        }
        $collationSql = "SELECT `CHARACTER_SET_NAME` `charset`, "
                        . "GROUP_CONCAT(`COLLATION_NAME` ORDER BY `COLLATION_NAME`) "
                        . "`collations` FROM `information_schema`."
                        . "`COLLATION_CHARACTER_SET_APPLICABILITY` GROUP BY "
                        . "`CHARACTER_SET_NAME` $where";
        $rawCollations = $this->query($collationSql, Msd_Db::ARRAY_ASSOC);
        $collations = array();
        foreach ($rawCollations as $charset) {
            $collations[$charset['charset']] = explode(
                ",",
                $charset['collations']
            );
        }

        return $collations;
    }

    /**
     * Retrieves the default collation for the charset or the given charset.
     *
     * @param string|null $charsetName Name of the charset
     *
     * @return array|string
     */
    public function getDefaultCollations($charsetName = null)
    {
        if (!empty($charsetName)) {
            $defaultCollationSql = 'SELECT `DEFAULT_COLLATE_NAME` FROM '
                                   . '`information_schema`.`CHARACTER_SETS` WHERE '
                                   . '`CHARACTER_SET_NAME` = \'' . $this->escape($charsetName)
                                   . '\'';
            $result = $this->query($defaultCollationSql, self::ARRAY_NUMERIC);
            $defaultCollation = $result[0][0];
        } else {
            $defaultCollationSql = 'SELECT `CHARACTER_SET_NAME` `charset`, '
                                   . '`DEFAULT_COLLATE_NAME` `collation` FROM '
                                   . '`information_schema`.`CHARACTER_SETS`';
            $result = $this->query($defaultCollationSql, self::ARRAY_ASSOC);
            $defaultCollation = array();
            foreach ($result as $row) {
                $defaultCollation[$row['charset']] = $row['collation'];
            }
        }
        return $defaultCollation;
    }

    /**
     * Gets the views of the given database.
     *
     * @param string $dbName Name of database
     *
     * @return array
     */
    public function getViews($dbName)
    {
        $sql = 'SELECT * FROM `information_schema`.`VIEWS` WHERE '
               . '`TABLE_SCHEMA` = \'' . $this->escape($dbName) . '\'';
        $rawViews = $this->query($sql, self::ARRAY_ASSOC);
        $views = array();
        foreach ($rawViews as $rawView) {
            $views[$rawView['TABLE_NAME']] = $rawView;
        }
        return $views;
    }

    /**
     * Get the number of views per database.
     *
     * @return array
     */
    public function getNrOfViews()
    {
        $sql = 'SELECT `TABLE_SCHEMA`, count(*) as `views` FROM '
               . '`information_schema`.`VIEWS` '
               . ' GROUP BY `TABLE_SCHEMA`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        $views = array();
        foreach ($res as $view) {
            $views[$view['TABLE_SCHEMA']] = $view['views'];
        }
        return $views;
    }

    /**
     * Get the number of routines (procedures and functions).
     *
     * @return array
     */
    public function getNrOfRoutines()
    {
        $sql = 'SELECT `ROUTINE_SCHEMA`, count(`ROUTINE_NAME`) as `routines`'
               . ' FROM `information_schema`.`ROUTINES` '
               . ' GROUP BY `ROUTINE_SCHEMA`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        $routines = array();
        foreach ($res as $routine) {
            $routines[$routine['ROUTINE_SCHEMA']] = $routine['routines'];
        }
        return $routines;
    }

    /**
     * Get the size of tabledata in bytes
     *
     * @return array
     */
    public function getDatabaseSizes()
    {
        $sql = 'SELECT `TABLE_SCHEMA`, sum(`DATA_LENGTH`) as `size`'
               . ' FROM `information_schema`.`TABLES` '
               . ' GROUP BY `TABLE_SCHEMA`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        $sizes = array();
        foreach ($res as $size) {
            $sizes[$size['TABLE_SCHEMA']] = $size['size'];
        }
        return $sizes;
    }

    /**
     * Gets the stored procedurs of the given database.
     *
     * @param string $dbName Name of database
     *
     * @return array
     */
    public function getStoredProcedures($dbName)
    {
        $routinesSql = 'SELECT * FROM `information_schema`.`ROUTINES` WHERE '
                       . '`ROUTINE_SCHEMA` = \'' . $this->escape($dbName) . '\'';
        $rawRoutines = $this->query($routinesSql, self::ARRAY_ASSOC);
        $routines = array();
        foreach ($rawRoutines as $rawRoutine) {
            $routines[$rawRoutine['ROUTINE_NAME']] = $rawRoutine;
        }
        return $routines;
    }

    /**
     * Creates a new database via building a MySQL statement and its execution.
     *
     * @param string $databaseName      Name of the new database
     * @param string $databaseCharset   Charackter set of the new database
     * @param string $databaseCollation Collation of the new database
     *
     * @return boolean
     */
    public function createDatabase(
        $databaseName,
        $databaseCharset = '',
        $databaseCollation = ''
    )
    {
        if ($databaseCharset != '') {
            $databaseCharset = "DEFAULT CHARSET "
                               . $this->escape($databaseCharset);
        }
        if ($databaseCollation != '') {
            $databaseCollation = "DEFAULT COLLATE "
                                 . $this->escape($databaseCollation);
        }
        $sql = "CREATE DATABASE `" . $databaseName
               . "` $databaseCharset $databaseCollation";
        $dbCreated = $this->query($sql, Msd_Db::SIMPLE);
        return $dbCreated;
    }
}
