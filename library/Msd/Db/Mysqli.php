<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Db
 * @version         SVN: $rev: 1208 $
 * @author          $Author$
 */
/**
 * Capsules all database related actions.
 *
 * @package         MySQLDumper
 * @subpackage      Db
 */
class Msd_Db_Mysqli extends Msd_Db_MysqlCommon
{
    /**
     * @var mysqli
     */
    private $_mysqli = null;

    /**
     * @var resource
     */
    private $_resultHandle = null;
    /**
     * Establish a connection to MySQL.
     *
     * Create a connection to MySQL and store the connection handle in
     * $this->connectionHandle.
     *
     * @return boolean
     **/
    protected function _dbConnect()
    {
        $errorReporting = error_reporting(0);
        if ($this->_port == 0) {
            $this->_port = 3306;
        }

        $this->_mysqli = new mysqli(
            $this->_server,
            $this->_user,
            $this->_password,
            $this->_dbSelected,
            $this->_port,
            $this->_socket
        );
        error_reporting($errorReporting);
        if ($this->_mysqli->connect_errno) {
            $error = $this->_mysqli->connect_error;
            $errno = $this->_mysqli->connect_errno;
            $this->_mysqli = null;
            throw new Msd_Exception($error, $errno);
        }
        $this->setConnectionCharset();
        return true;
    }

    /**
     * Returns the connection handle if already set or creates one.
     *
     * @return mysqli The instance of mysqli
     */
    private function _getHandle()
    {
        if (!$this->_mysqli instanceof mysqli) {
            $this->_dbConnect();
        }
        return $this->_mysqli;
    }

    /**
     * Returns the version nr of MySql server.
     *
     * @return string Version nr
     */
    public function getServerInfo()
    {
        return $this->_getHandle()->server_info;
    }

    /**
     * Return version nr of MySql client.
     *
     * @return string Version nr
     */
    public function getClientInfo()
    {
        return $this->_getHandle()->client_info;
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
        if (!@$this->_getHandle()->set_charset($charset)) {
            $this->sqlError(
                $charset . ' ' . $this->_mysqli->error,
                $this->_mysqli->errno
            );
        }
        $this->_connectionCharset = $this->_getHandle()->character_set_name();
        return $this->_connectionCharset;
    }

    /**
     * Select the given database to use it as the target for following queries.
     *
     * Returns true if selection was succesfull, otherwise false.
     *
     * @param string  $database Database to select
     *
     * @return boolean True on success
     */
    public function selectDb($database)
    {
        $res = @$this->_getHandle()->select_db($database);
        if ($res === false) {
            return $this->_getHandle()->error;
        } else {
            $this->_dbSelected = $database;
            return true;
        }
    }

    /**
     * Execute a query and set _resultHandle
     *
     * If $getRows is true all rows are fetched and returned.
     * If $getRows is false, query will be executed, but the result handle
     * is returned.
     *
     * @param string  $query   The query to execute
     * @param const   $kind    Type of result set
     * @param boolean $getRows Wether to fetch all rows and return them
     *
     * @return resource|array
     */
    public function query($query, $kind = self::ARRAY_OBJECT, $getRows = true)
    {
        try {
            $this->_resultHandle = $this->_getHandle()->query($query);

            if (false === $this->_resultHandle) {
                $this->sqlError(
                    $this->_getHandle()->error,
                    $this->_getHandle()->errno
                );
            }
            if (!$this->_resultHandle instanceof mysqli_result
                || $kind === self::SIMPLE) {
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
        } catch (Exception $e) {
            $this->sqlError(
                $this->_getHandle()->error,
                $this->_getHandle()->errno
            );
        }
    }

    /**
     * Get next row from a result set that is returned by $this->query().
     *
     * Can be used to walk through result sets.
     *
     * @param const $kind
     *
     * @return array|object
     */
    public function getNextRow($kind)
    {
       switch ($kind)
       {
           case self::ARRAY_ASSOC:
               return $this->_resultHandle->fetch_assoc();
           case self::ARRAY_OBJECT:
               return $this->_resultHandle->fetch_object();
               break;
           case self::ARRAY_NUMERIC:
               return $this->_resultHandle->fetch_array(MYSQLI_NUM);
               break;
       }
    }

    /**
     * Gets the number of affected rows for the last executed query.
     *
     * @see inc/classes/db/MsdDbFactory#affectedRows()
     * @return integer
     */
    public function getAffectedRows()
    {
        return $this->_getHandle()->affected_rows;
    }

    /**
     * Escape a value with real_escape_string() to use it in a query.
     *
     * @see inc/classes/db/MsdDbFactory#escape($val)
     * @param mixed $val The value to escape
     *
     * @return mixed
     */
    public function escape($val)
    {
        return $this->_getHandle()->real_escape_string($val);
    }
    /**
     * Retrieves the last MySQL error.
     *
     * @return array
     */
    public function getLastError()
    {
        return array(
            'code' => $this->_getHandle()->errno,
            'message' => $this->_getHandle()->error,
        );
    }
}
