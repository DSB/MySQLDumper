<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      MsdDbFactory
 * @version         SVN: $rev: 1208 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
/**
 * Capsules all database related actions.
 * Uses some magic getters to allow lazy connecting.
 *
 */
class MsdDbMysqli extends MsdDbFactory
{
    /**
     * @var resource
     */
    private $_mysqli = null;
    /**
     * Get known charsets of MySQL-Server
     *
     * @return array
     */
    public function getCharsets()
    {
        if (isset($this->charsets)) return $this->charsets;
        if (!$this->_mysqli instanceof mysqli) $this->dbConnect();
        $result = $this->query('SHOW CHARACTER SET', self::ARRAY_ASSOC);
        $this->charsets = array();
        foreach ($result as $r) {
            $this->charsets[$r['Charset']] = $r;
        }
        @ksort($this->charsets);
        return $this->charsets;
    }
    /**
     * Establish a connection to MySQL.
     *
     * Create a connection to MySQL and store the connection handle in
     * $this->connectionHandle.
     * If $select_database is set, the database is selected for further queries.
     * Returns true on success or false if connection couldn't be established.
     *
     * @param string $select_database
     * @param string $connectionCharset
     * @return boolean
     **/
    public function dbConnect($selectDatabase = false)
    {
        if ($this->_mysqli instanceof mysqli) {
            return true;
        }
        $this->_mysqli = @new mysqli(
            $this->server,
            $this->user,
            $this->password,
            $this->dbSelected,
            $this->port,
            $this->socket
        );
        if ($this->_mysqli->connect_errno) {
            $error = $this->_mysqli->connect_error;
            $errno = $this->_mysqli->connect_errno;
            $this->_mysqli = null;
            return '(' . $errno . ') ' . $error;
        }
        $this->setConnectionCharset($this->connectionCharset);
        if (false === $selectDatabase && $this->dbSelected > '') {
            $selectDatabase = $this->dbSelected;
        }
        if ($selectDatabase) {
            if ($this->selectDb($selectDatabase)) {
                $this->dbSelected = $selectDatabase;
                return true;
            } else {
                $this->sqlError(mysqli_error(mysqli_error(), mysqli_errno()));
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
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect();
        }
        return $this->_mysqli->server_info;
    }
    /**
     * Get version nr of sql client
     *
     * @return string
     */
    public function getClientInfo()
    {
        if (!$this->_mysqli instanceof mysqli) $this->dbConnect();
        return $this->_mysqli->client_info;
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
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect();
        }
        if (!@$this->_mysqli->set_charset($charset)) {
            $this->sqlError(
                $charset . ' ' . $this->_mysqli->error,
                $this->_mysqli->errno
            );
        }
        $this->connectionCharset = $this->_mysqli->character_set_name();
        return $this->connectionCharset;
    }
    /**
     * Get list of databases
     *
     * Gets list of all databases that the actual MySQL-User has access to
     * and saves it in $this->databases.
     * Returns true on success or false on error.
     *
     * @return boolean
     */
    public function getDatabases()
    {
        if (!$this->_mysqli instanceof mysqli) $this->dbConnect();
        $res = $this->query('SHOW DATABASES', self::ARRAY_ASSOC);
        $this->databases = array();
        foreach ($res as $r) {
            $this->databases[] = $r['Database'];
        }
        sort($this->databases);
        return $this->databases;
    }
    /**
     * Select the given database to use it as the target for following queries.
     *
     * Returns true if selection was succesfull otherwise false.
     *
     * @throws Exception
     * @param string  $database        Database to select
     *
     * @return boolean
     */
    public function selectDb($database)
    {
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect();
        }
        $res=@$this->_mysqli->select_db($database);
        if ($res===false) {
                return $this->_mysqli->error;
        } else {
            $this->dbSelected = $database;
            return true;
        }
    }
    /**
     * Get selected database
     *
     * @see inc/classes/db/MsdDbFactory#getSelectedDb()
     * @return string
     */
    public function getSelectedDb()
    {
        return $this->dbSelected;
    }
    /**
     * Execute a MySQL-Query
     *
     * @throws Exception
     * @param string $query The query to execute
     * @param const  $kind  Type of result set
     *
     * @return array
     */
    public function query($query, $kind = self::ARRAY_OBJECT)
    {
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect($this->dbSelected);
        }
        //echo "<br>Mysqli: executing query: " . $query;
        $result = $this->_mysqli->query($query);
        if (false === $result) {
            $this->sqlError($this->_mysqli->error, $this->_mysqli->errno);
        }
        if (!$result instanceof mysqli_result || $kind === self::SIMPLE) {
            return $result;
        }
        $ret = array();
        if ($kind === self::ARRAY_OBJECT) {
            WHILE ($row = $result->fetch_object()) {
                $ret[] = $row;
            }
        } elseif ($kind === self::ARRAY_NUMERIC) {
            WHILE ($row = $result->fetch_array(MYSQLI_NUM)) {
                $ret[] = $row;
            }
        } elseif ($kind === self::ARRAY_ASSOC) {
            WHILE ($row = $result->fetch_assoc()) {
                $ret[] = $row;
            }
        }
        if ($result instanceof mysqli) {
            $result->close();
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
     * @return array
     */
    public function getTables($database = false)
    {
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect($this->dbSelected);
        }
        if (!isset($this->tables)) {
            $this->tables = array();
        }
        if ($database !== false) {
            //only list tables of selected database
            if (is_array($database)) {
                $databases = $database;
            } else {
                $databases = array();
                $databases[0] = $database;
            }
        } else {
            //list tables for all databases
            $databases = $this->databases;
        }
        // get tablenames for each database
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
     * @return array
     */
    public function getTableStatus($table = false, $database = false)
    {
        if ($database !== false && $database != $this->dbSelected) {
            $this->selectDb($database);
        }
        if (!$this->_mysqli instanceof mysqli) {
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
            $this->sqlError($this->_mysqli->error, $this->_mysqli->errno);
        }
        if ($table !== false) {
            if (isset($this->tableinfo[$this->dbSelected][$table])) {
                return $this->tableinfo[$this->dbSelected][$table];
            }
        }
        return $this->tableinfo[$this->dbSelected];
    }
    /**
     * Returns the CREATE Statement of a table.
     *
     * @throws Exception
     * @param string  $table
     * @param string  $database
     *
     * @return string
     */
    public function getTableCreate($table, $database = false)
    {
        if (false === $database) {
            $database = $this->dbSelected;
        }
        if ($database != $this->dbSelected) {
            if (false === $this->selectDB($database)) {
                $this->sqlError($this->_mysqli->error, $this->_mysqli->errno);
            }
        }
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect($this->dbSelected);
        }
        $sql = 'SHOW CREATE TABLE `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (isset($res[0]['Create Table'])) {
            return $res[0]['Create Table'];
        } else {
            $this->sqlError($this->_mysqli->error, $this->_mysqli->errno);
        }
    }
    /**
     * Gets the full description of all columns of a table
     *
     * Saves it to $this->metaTables[$database][$table].
     *
     * @param string $table
     * @param string $database
     *
     * @return array
     */
    public function getTableColumns($table, $database = false)
    {
        if (!$this->_mysqli instanceof mysqli) {
            $this->dbConnect($this->dbSelected);
        }
        if (false === $database) {
            $database = $this->dbSelected;
        }
        if ($database != $this->dbSelected) {
            if (false === $this->selectDB($database)) {
                $this->sqlError($this->_mysqli->error, $this->_mysqli->errno);
            }
        }
        $sql = 'SHOW FULL FIELDS FROM `' . $table . '`';
        $res = $this->query($sql, self::ARRAY_ASSOC);
        if (!isset($this->metaTables[$database])) $this->metaTables[$database] = array();
        if (is_array($res)) {
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
     * @return integer
     */
    public function getAffectedRows()
    {
        return $this->_mysqli->affected_rows;
    }
    /**
     * Escape a value to use it in a query
     *
     * @see inc/classes/db/MsdDbFactory#escape($val)
     * @param mixed $val The value to escape
     *
     * @return mixed
     */
    public function escape($val)
    {
        return $this->_mysqli->real_escape_string($val);
    }
    /**
     * Optimize a table. Returns true on success or MySQL-Error.
     *
     * @param string $table Name of table
     *
     * @return boolean or string true on success or mysql_error() on failure
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
