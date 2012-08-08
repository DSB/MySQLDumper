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
 * Capsules all database related actions.
 *
 * @package         MySQLDumper
 * @subpackage      Db
 */
class Msd_Db_Mysql extends Msd_Db_MysqlCommon
{
    /**
     * Mysql connection handle
     *
     * @var resource
     */
    protected $_connectionHandle = null;

    /**
     * Mysql result handle
     *
     * @var resource
     */
    protected $_resultHandle = null;

    /**
     *	Establish a connection to MySQL.
     *
     * Creates a connection to the database and stores the connection handle in
     * $this->_connectionHandle.
     * Returns true on success or false if connection couldn't be established.
     *
     * @throws Msd_Exception
     * 	@return bool
     **/
    protected function _dbConnect()
    {
        if (is_resource($this->_connectionHandle)) {
            return true;
        }
        if ($this->_port == 0) {
            $this->_port = 3306;
        }
        $connectionString = $this->_server . ':' . $this->_port;
        if ($this->_socket != '') {
            $connectionString .= ':' . $this->_socket;
        }
        $this->_connectionHandle = @mysql_connect(
            $connectionString,
            $this->_user, $this->_password
        );
        if (false === $this->_connectionHandle) {
            throw new Msd_Exception(mysql_error(), mysql_errno());
        }
        $this->setConnectionCharset();
        return true;
    }

    /**
     * Returns the connection handle if already established or creates one.
     *
     * @return resource The connection handle
     */
    private function _getHandle()
    {
        if (!is_resource($this->_connectionHandle)) {
            $this->_dbConnect();
        }
        return $this->_connectionHandle;
    }

    /**
     * Return version nr of MySql server.
     *
     * @return string Version number
     */
    public function getServerInfo()
    {
        return mysql_get_server_info($this->_getHandle());
    }

    /**
     * Get version nr of MySql client.
     *
     * @return string Version nr
     */
    public function getClientInfo()
    {
        return mysql_get_client_info();
    }

    /**
     * Sets the character set of the MySQL-connection.
     *
     * Trys to set the connection charset and returns it.
     *
     * @param string $charset The wanted charset of the connection
     *
     * @return string The set charset
     */
    public function setConnectionCharset($charset = 'utf8')
    {
        if (function_exists('mysql_set_charset')
            && @mysql_set_charset($charset, $this->_getHandle())) {
            $this->_connectionCharset = $charset;
            return $this->_connectionCharset;
        } else {
            $this->query('SET NAMES \'' . $charset . '\'', self::SIMPLE);
            $this->_connectionCharset = $charset;
            return $charset;
        }
    }

    /**
     * Select the given database to use it as the target for following queries
     *
     * Returns true if selection was succesfull otherwise false.
     *
     * @throws Msd_Exception
     * @param string $database The database to select
     *
     * @return bool
     */
    public function selectDb($database)
    {
        $res = @mysql_select_db($database, $this->_getHandle());
        if ($res === false) {
            throw new Msd_Exception(mysql_error(), mysql_errno());
        }
        $this->_dbSelected = $database;
        return true;
    }


    /**
     * Execute a query and set _resultHandle
     *
     * If $getRows is true all rows are fetched and returned.
     * If $getRows is false, query will be executed, but the result handle
     * is returned.
     *
     * @param string  $query   The query to execute
     * @param int     $kind    Type of result set
     * @param boolean $getRows Wether to fetch all rows and return them
     *
     * @return boolean|array
     */
    public function query($query, $kind = self::ARRAY_OBJECT, $getRows = true)
    {
        $this->_resultHandle = @mysql_query($query, $this->_getHandle());
        if (false === $this->_resultHandle) {
            $this->sqlError(
                mysql_error($this->_connectionHandle),
                mysql_errno($this->_connectionHandle)
            );
        }
        if ($kind === self::SIMPLE || is_bool($this->_resultHandle)) {
            return $this->_resultHandle;
        }

        // return result set?
        if ($getRows) {
            $ret = array();
            WHILE ($row = $this->getNextRow($kind)) {
                $ret[] = $row;
            }
            $this->_resultHandle = null;
            return $ret;
        }

        return true;
    }

    /**
     * Get next row from a result set that is returned by $this->query().
     *
     * Can be used to walk through result sets.
     *
     * @param int $kind
     *
     * @return array|object
     */
    public function getNextRow($kind)
    {
       switch ($kind)
       {
           case self::ARRAY_OBJECT:
               return mysql_fetch_object($this->_resultHandle);
               break;
           case self::ARRAY_NUMERIC:
               return mysql_fetch_array($this->_resultHandle, MYSQL_NUM);
               break;
           case self::ARRAY_ASSOC:
               return mysql_fetch_array($this->_resultHandle, MYSQL_ASSOC);
       }

        return false;
    }

    /**
     * Gets the number of affected rows for the last query.
     *
     * @see inc/classes/db/MsdDbFactory#affectedRows()
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return mysql_affected_rows($this->_getHandle());
    }

    /**
     * Escape a value with real_escape_string() to use it in a query.
     *
     * @see inc/classes/db/MsdDbFactory#escape($val)
     * @param mixed $val The value to escape
     * @return mixed
     */
    public function escape($val)
    {
        return mysql_real_escape_string($val, $this->_getHandle());
    }

    /**
     * Retrieves the last MySQL error.
     *
     * @return array
     */
    public function getLastError()
    {
        return array(
            'code' => mysql_errno($this->_getHandle()),
            'message' => mysql_error($this->_getHandle()),
        );
    }
}
