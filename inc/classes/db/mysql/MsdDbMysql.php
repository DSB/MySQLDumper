<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      MsdDbFactory
 * @version         SVN: $rev: 1205 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * Capsules all database related actions.
 * Uses some magic getters to allow lazy connecting.
 *
 */
class MsdDbMysql extends MsdDbFactory
{
    /**
     * Get all known character sets of this SQL-Server.
     *
     * @return array
     */
    public function getCharsets()
    {
        if (isset($this->charsets)) return $this->charsets;
        if (false === $this->connectionHandle) $this->dbConnect();
        $result = $this->query('SHOW CHARACTER SET', self::ARRAY_ASSOC);
        $this->charsets = array();
        foreach ($result as $r) {
            $this->charsets[$r['Charset']] = $r;
        }
        @ksort($this->charsets);
        return $this->charsets;
    }
    /**
     *	Establish a connection to MySQL.
     *
     * Creates a connection to the database and stores the connection handle in
     * $this->connectionHandle.
     * If $select_database is set, the database is selected for further queries.
     * Returns true on success or false if connection couldn't be established.
     *
     *	@param string $select_database
     *	@param string $connectionCharset
     *
     * 	@return bool
     **/
    public function dbConnect($selectDatabase = false)
    {
        if (is_resource($this->connectionHandle)) return true;

        $connectionString = $this->server . ':' . $this->port;
        if ($this->socket > '') $connectionString .= ':' . $this->socket;
        if (false === $this->connectionHandle) {
            $this->connectionHandle = @mysql_connect(
                $connectionString,
                $this->user, $this->password
            );
            if (false === $this->connectionHandle) {
                return '(' . mysql_errno() . ') ' . mysql_error();
            }
        }
        $this->setConnectionCharset($this->connectionCharset);
        if (false === $selectDatabase && $this->dbSelected > '') {
            $selectDatabase = $this->dbSelected;
        }
        if ($selectDatabase) {
            try
            {
                $this->selectDb($selectDatabase, $this->connectionHandle);
                $this->dbSelected = $selectDatabase;
                return true;
            } catch (Exception $e) {
                $this->sqlError(
                    mysql_error($this->connectionHandle),
                    mysql_errno($this->connectionHandle)
                );
                return false;
            }
        }
        return true;
    }

    /**
     * Get version nr of sql server
     *
     * @return string
     */
    public function getServerInfo()
    {
        if (false === $this->connectionHandle) {
            $this->dbConnect();
        }
        $version = mysql_get_server_info($this->connectionHandle);
        return $version;
    }
    /**
     * Get version nr of sql client
     *
     * @return string
     */
    public function getClientInfo()
    {
        if (false === $this->connectionHandle) $this->dbConnect();
        $version = mysql_get_client_info();
        return $version;
    }

    /**
     * Set character set of the MySQL-connection.
     *
     * Trys to set  the connection charset and returns it.
     * Throw Exception on failure.
     *
     * @param string $charset
     * @throws Exception
     *
     * @return string
     */
    public function setConnectionCharset($charset = 'utf8')
    {
        if (false === $this->connectionHandle) $this->dbConnect();
        if (function_exists('mysql_set_charset')
            && @mysql_set_charset($charset, $this->connectionHandle)) {
            $this->connectionCharset = $charset;
            return $this->connectionCharset;
        } else {
            $this->query('SET NAMES \'' . $charset . '\'', self::SIMPLE);
            $this->connectionCharset = $charset;
            return $charset;
        }
    }

    /**
     * Get list of databases
     *
     * Gets list of all databases that the actual MySQL-User has access to
     * and saves it in $this->databases.
     * Returns true on success or false on error.
     *
     * @return array List of found database names
     */
    public function getDatabases()
    {
        if (false === $this->connectionHandle) $this->dbConnect();
        $this->databases = array();
        $databases = @mysql_list_dbs($this->connectionHandle);
        if (is_resource($databases)) {
            WHILE ($row = mysql_fetch_array($databases, MYSQL_ASSOC)) {
                $this->databases[] = $row['Database'];
            }
        } else {
            //mysql_list_dbs seems not to be allowed for this user
            // try to get list via "SHOW DATABASES"
            $res = $this->query('SHOW DATABASES', self::ARRAY_ASSOC);
            foreach ($res as $r) {
                $this->databases[] = $r['Database'];
            }
        }
        sort($this->databases);
        return $this->databases;
    }
    /**
     * Select the given database to use it as the target for following queries
     *
     * Returns true if selection was succesfull otherwise false.
     *
     * @throws Exception
     * @param string $database
     *
     * @return bool
     */
    public function selectDb($database)
    {
        if (!is_resource($this->connectionHandle)) {
            $this->dbConnect();
        }
        $res=@mysql_select_db($database, $this->connectionHandle);
        if ($res===false) {
                return mysql_error();
        } else {
            $this->dbSelected = $database;
            return true;
        }
    }

    /**
     * Get selected database
     *
     * @see inc/classes/db/MsdDbFactory#getSelectedDb()
     *
     * @return string
     */
    public function getSelectedDb()
    {
        return $this->dbSelected;
    }

    /**
     * Execute a query
     *
     * @param $query The query to execute
     * @param $kind  Type of result set
     *
     * @return array
     */
    public function query($query, $kind = self::ARRAY_OBJECT)
    {
        if (false === $this->connectionHandle) {
            $this->dbConnect();
        }
        $res = @mysql_query($query, $this->connectionHandle);
        if (false === $res) {
            $this->sqlError(
                mysql_error($this->connectionHandle),
                mysql_errno($this->connectionHandle)
            );
        }
        if ($kind === self::SIMPLE || is_bool($res)) {
            return $res;
        }
        $ret = array();
        if ($kind === self::ARRAY_OBJECT) {
            WHILE ($row = mysql_fetch_object($res)) {
                $ret[] = $row;
            }
        } elseif ($kind === self::ARRAY_NUMERIC) {
            WHILE ($row = mysql_fetch_array($res, MYSQL_NUM)) {
                $ret[] = $row;
            }
        } elseif ($kind === self::ARRAY_ASSOC) {
            WHILE ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
                $ret[] = $row;
            }
        }
        return $ret;
    }
    /**
     * Get table list of given database(s)
     *
     * Stores them in $this->tables[database]
     * When no database is given, all databases are scanned for tables.
     * Returns table list for selected or for all databases.
     *
     * @param string|array $database
     *
     * @return array
     */
    public function getTables($database = false)
    {
        if (false === $this->connectionHandle) $this->dbConnect();
        if (!isset($this->tables)) $this->tables = array();
        if ($database !== false) {
            //list tables of selected database
            if (is_array($database)) {
                $databases = $database;
            } else {
                $databases = array();
                $databases[0] = $database;
            }
        } else {
            //list tables for all databases
            $this->getDatabases();
            $databases = $this->databases;
        }
        // get tablenames inside each database
        foreach ($databases as $db) {
            $this->tables[$db] = array();
            $sql = 'SHOW TABLES FROM `' . $db . '`';
            $res = $this->query($sql, self::ARRAY_NUMERIC);
            foreach ($res as $val) {
                $this->tables[$db][] = $val[0];
            }
        }
        return is_string($database) ? $this->tables[$database] : $this->tables;
    }

    /**
     * Gets extended table information for one or all tables
     *
     * @param string $table
     * @param string $database
     *
     * @return array
     */
    public function getTableStatus($table = false, $database = false)
    {
        if ($database !== false && $database != $this->dbSelected) {
            $this->selectDb($database);
        } elseif (!$this->_mysqli instanceof mysqli) {
            $this->selectDb($this->dbSelected);
        }
        if (!isset($this->tableinfo)) {
            $this->tableinfo = array();
        }
        if (!isset($this->tableinfo[$this->dbSelected])) {
            $this->tableinfo[$this->dbSelected] = array();
        }
        $sql = 'SHOW TABLE STATUS';
        if ($table !== false) {
            $sql .= ' LIKE \'' . $table . '\'';
        }
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (is_array($res)) {
            foreach ($res as $r) {
                $tablename = $r['Name'];
                unset($r['Name']);
                $this->tableinfo[$this->dbSelected][$tablename] = $r;
            }
        } elseif ($res === false) {
            $this->sqlError(
                mysql_error($this->connectionHandle),
                mysql_errno($this->connectionHandle)
            );
        }
        if ($table !== false) {
            if (isset($this->tableinfo[$this->dbSelected][$table])) {
                return $this->tableinfo[$this->dbSelected][$table];
            }
        }
        return $this->tableinfo[$this->dbSelected];
    }

    /**
     * Returns the CREATE-Statement for the given table or false on error.
     *
     * @throws Exception
     * @param string $table
     * @param string $database
     *
     * @return string
     */
    public function getTableCreate($table, $database = false)
    {
        if (false === $database) $database = $this->dbSelected;
        if ($database != $this->dbSelected) {
            if (false === $this->selectDB($database)) {
                $this->sqlError(
                    mysql_error($this->connectionHandle),
                    mysql_errno($this->connectionHandle)
                );
            }
        }
        if (!is_resource($this->connectionHandle)) {
            $this->dbConnect($this->dbSelected);
        }
        $sql = 'SHOW CREATE TABLE `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (isset($res[0]['Create Table'])) {
            return $res[0]['Create Table'];
        } else {
            $this->sqlError(
                mysql_error($this->connectionHandle),
                mysql_errno($this->connectionHandle)
            );
        }
    }

    /**
     * Gets the full description of all columns of a table
     *
     * Saves it to $this->metaTables[$database][$table].
     *
     * @param string $table
     * @param string $database
     * @return array
     */
    public function getTableColumns($table, $database = false)
    {
        if (false === $database) $database = $this->dbSelected;
        if ($database != $this->dbSelected) {
            if (false === $this->selectDB($database)) {
                $this->sqlError(
                    mysql_error($this->connectionHandle),
                    mysql_errno($this->connectionHandle)
                );
            }
        }
        if (!is_resource($this->connectionHandle)) {
            $this->dbConnect($this->dbSelected);
        }
        $sql = 'SHOW FULL COLUMNS FROM `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (!isset($this->metaTables[$database])) {
            $this->metaTables[$database] = array();
        }
        if ($res) {
            $this->metaTables[$database][$table] = array();
            foreach ($res as $r) {
                $this->metaTables[$database][$table][$r['Field']] = $r;
            }
        }
        return $this->metaTables[$database][$table];
    }

    /**
     * Gets the number of affected rows for the last query
     *
     * @see inc/classes/db/MsdDbFactory#affectedRows()
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return mysql_affected_rows($this->connectionHandle);
    }

    /**
     * Escape a value to use it in a query
     *
     * @see inc/classes/db/MsdDbFactory#escape($val)
     * @param mixed $val The value to escape
     * @return mixed
     */
    public function escape($val)
    {
        return mysql_real_escape_string($val, $this->connectionHandle);
    }
    /**
     * Optimize a table. Returns true on success or MySQL-Error.
     *
     * @param string $table Name of table
     *
     * @return string|bool Returned optimize message or false on error
     */
    function optimizeTable($table)
    {
        $sql = 'OPTIMIZE TABLE `' . $this->dbSelected . '`.`' . $table . '`';
        $res = $this->query($sql, MsdDbFactory::ARRAY_ASSOC);
        if (isset($res[0]['Msg_text'])) {
            return $res[0];
        } else {
            return false;
        }
    }

}
