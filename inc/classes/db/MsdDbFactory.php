<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1212 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * DB-Factory
 *
 * @abstract
 */
abstract class MsdDbFactory
{
    const FORCE_MYSQL = false; // for debugging
    // define result set types
    const ARRAY_NUMERIC = 0;    // return resultset as numeric array
    const ARRAY_ASSOC = 1;      // return resultset as associative array
    const ARRAY_OBJECT = 2;     // return resultset as array of object
    const SIMPLE = 3;           // return result as boolean

    /**
     * Init database object
     *
     * @param string $server    SQL-Server
     * @param string $user      SQL-User used to authenticate at server
     * @param string $password  SQL-User-Password usued to authenticate
     * @param string $port      [optional] Port to use
     * @param string $socket    [optional] Socket to use (only for *nix)
     *
     * @return void
     */
    function __construct($server, $user, $password, $port = 3306, $socket ='')
    {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
        $this->socket = $socket;
        $this->connectionCharset = 'utf8';
        $this->connectionHandle = false;
        $this->dbSelected = '';
        $this->tables = array();
        $this->metaTables = array();
    }

    /**
     * Create database adapter
     *
     * @param string $server
     * @param string $user
     * @param string $password
     * @param string $port
     * @param string $socket
     *
     * @return MsdDbFactory
     */
    static function getAdapter($server, $user, $password, $port = 3306, $socket = '')
    {
        if (function_exists('mysqli_connect') && !self::FORCE_MYSQL) {
            include_once ('./inc/classes/db/mysqli/MsdDbMysqli.php');
            $db = new MsdDbMysqli($server, $user, $password, $port, $socket);
        } else {
            include_once ('./inc/classes/db/mysql/MsdDbMysql.php');
            $db = new MsdDbMysql($server, $user, $password, $port, $socket);
        }
        return $db;
    }

    /**
     *  Establish a connection to SQL-Server.
     *
     *  Doesn't need to be called directly because of lazy loading.
     *  Will be called automatically if any other method is called that
     *  needs a connection.
     *  Creates a connection to the database and stores the connection handle
     *  in $this->connection_handle.
     *  If $select_database is set, the database is selected for next queries.
     *  Returns true on success or false if connection couldn't be established.
     *
     *  @param string $select_database
     *  @param string $connection_charset
     *
     *  @return bool
     * */
    abstract public function dbConnect($selectDatabase = false);

    /**
     * Get selected database
     *
     * @return string
     */
    abstract public function getSelectedDb();

    /**
     * Get version nr of sql server
     *
     * @return string
     */
    abstract public function getServerInfo();

    /**
     * Get version nr of sql client
     *
     * @return string
     */
    abstract public function getClientInfo();

    /**
     * Get all known character sets of this SQL-Server.
     *
     * @return array
     */
    abstract public function getCharsets();
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
    abstract public function setConnectionCharset($charset = 'utf8');
    /**
     * Get list of databases
     *
     * Gets list of all databases that the actual SQL-Server-User has access to
     * and saves it in $this->databases.
     * Returns true on success or false on error.
     *
     * @return bool
     */
    abstract public function getDatabases();

    /**
     * Select the given database to use it as the target for following queries.
     *
     * Returns true if selection was succesfull otherwise false.
     *
     * @throws Exception
     * @param string  $database
     *
     * @return bool
     */
    abstract public function selectDb($database);

    /**
     * Execute a SQL-Server-Query
     *
     * @param $query The query to execute
     * @param $kind  Type of result set
     *
     * @return array
     */
    abstract public function query($query, $kind = self::ARRAY_OBJECT);

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
    abstract public function getTables($database = false);

    /**
     * Gets extended table information for one or all tables
     *
     * @param string $table
     * @param string $database
     *
     * @return array
     */
    abstract public function getTableStatus($table = false, $database = false);

    /**
     * Returns the CREATE Statement of a table.
     *
     * @throws Exception
     * @param string $table    Get CREATE-Statement for this table
     * @param string $database Database holding the table
     *
     * @return string Create statement
     */
    abstract public function getTableCreate($table, $database = false);

    /**
     * Gets the full description of all columns of a table
     *
     * Saves list to $this->metaTables[$database][$table].
     *
     * @param string $table    Table to read meta info from
     * @param string $database Database holding the table
     *
     * @return array
     */
    abstract public function getTableColumns($table, $database = false);

    /**
     * Gets the number of affected rows of the last query
     *
     * @return int
     */
    abstract function getAffectedRows();

    /**
     * Escape a value for inserting it in query
     *
     * @param string $val
     *
     * @return string
     */
    abstract function escape($val);

    /**
     * Optimize a table. Returns true on success or MySQL-Error.
     *
     * @param $table string Name of table
     *
     * @return string|bool Returned optimize message or false on error
     */
    abstract function optimizeTable($table);

    /**
     * Handles a SQL-Error
     *
     * @param string $errmsg
     * @param int    $errno
     * @throws MsdEception
     *
     * @return void
     */
    public function sqlError($errmsg, $errno)
    {
        throw new Exception($errmsg, $errno);
    }

}
