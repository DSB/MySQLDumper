<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package    MySQLDumper
 * @subpackage SQL-Browser
 * @version    SVN: $Rev: 1227 $
 * @author     $Author: DSB $
 */

require_once "Msd/Sql/Parser/Interface.php";
/**
 * Class to parse MySQL queries.
 * This enables you to analyze and modify MySQL queries, which the user has entered.
 *
 * @package         MySQLDumper
 * @subpackage      SQL-Browser
 */
class Msd_Sql_Parser
{
    /**
     * Saves the raw MySQL Query.
     *
     * @var string
     */
    private $_rawQuery = null;

    /**
     * Available MySQL statements, divided and sorted by their length.
     *
     * @var array
     */
    protected $_sqlStatements = array(
        2 => array(
            'do', 'xa'
        ),
        3 => array(
            'set', 'use'
        ),
        4 => array(
            'call', 'drop', 'help', 'kill', 'load', 'lock', 'show'
        ),
        5 => array(
            'alter', 'check', 'flush', 'grant', 'purge', 'reset', 'slave', 'start'
        ),
        6 => array(
            'backup', 'change', 'commit', 'create', 'delete', 'insert', 'rename', 'repair', 'revoke', 'select',
            'unlock', 'update'
        ),
        7 => array(
            'analyze', 'execute', 'handler', 'install', 'preload', 'prepare', 'release', 'replace', 'restore'
        ),
        8 => array(
            'checksum', 'describe', 'optimize', 'keycache', 'rollback', 'truncate'
        ),
        9 => array(
            'savepoint', 'uninstall'
        ),
        10 => array(
            'deallocate'
        ),
    );

    /**
     * MySQL comment types.
     *
     * @var array
     */
    protected $_sqlComments = array(
        '--' => "\n", '/*' => '*/'
    );

    /**
     * Class constructor.
     * Creates a new instance of the MySQL parser and optionally assign the raw MySQL query.
     *
     * @param string $sqlQuery Raw MySQL query to parse
     */
    public function __construct($sqlQuery = null)
    {
        if ($sqlQuery !== null) {
            $this->_rawQuery = $sqlQuery;
        }
    }

    /**
     * Parses a raw MySQL query.
     * This could include more than one MySQL statement.
     *
     * @throws Msd_Sql_Parser_Exception
     *
     * @param string $sqlQuery Raw MySQL query to parse
     *
     * @return void
     */
    public function parse($sqlQuery = null)
    {
        if ($sqlQuery === null) {
            if ($this->_rawQuery === null) {
                include_once 'Msd/Sql/Parser/Exception.php';
                throw new Msd_Sql_Parser_Exception('You must specify a MySQL query for parsing!');
            }

            $sqlQuery = $this->_rawQuery;
        }

        $sqlQuery = trim($sqlQuery);

        $statementCounter = 0;
        $startPos = 0;
        while ($startPos < strlen($sqlQuery)) {
            $statementCounter++;
            $firstSpace = strpos($sqlQuery, ' ', $startPos);
            $statement = trim(strtolower(substr($sqlQuery, $startPos, $firstSpace - $startPos)));
            $lengthCheck = strlen($statement);
            if ($lengthCheck == 0) {
                break;
            }
            if ($lengthCheck == 1 || $statement{1} == ';' || $statement{1} == "\n") {
                $startPos = $startPos + 1;
                continue;
            }
            $commentCheck = substr($statement, 0, 2);
            if (array_key_exists($commentCheck, $this->_sqlComments)) {
                $commentEnd = $this->_sqlComments[$commentCheck];
                $startPos = strpos($sqlQuery, $commentEnd, $startPos) + strlen($commentEnd);
                continue;
            }
            $statementLength = strlen($statement);
            if (!isset($this->_sqlStatements[$statementLength])) {
                die("$statement\n");
            }
            if (!in_array($statement, $this->_sqlStatements[$statementLength])) {
                include_once 'Msd/Sql/Parser/Exception.php';
                throw new Msd_Sql_Parser_Exception("Unknown MySQL statement is found: '$statement'");
            }
            $parserClass = 'Msd_Sql_Parser_Statement_' . ucwords($statement);
            $endPos = $this->_getStatementEndPos($sqlQuery, $startPos);
            $completeStatement = trim(substr($sqlQuery, $startPos, $endPos - $startPos));
            $startPos = $endPos + 1;

            $this->_parseStatement($completeStatement, $parserClass);
        }
    }

    /**
     * Searches the end of a MySQL statement and returns its position.
     *
     * @param string $sqlQuery The complete MySQL query
     * @param int    $startPos Index, where to start the search.
     *
     * @return int End position of the statement
     */
    private function _getStatementEndPos($sqlQuery, $startPos = 0)
    {
        $nextString = strpos($sqlQuery, "'", $startPos);
        $nextSemicolon = strpos($sqlQuery, ';', $startPos);
        if ($nextString === false) {
            if ($nextSemicolon === false) {
                return strlen($sqlQuery);
            }

           return $nextSemicolon;
        }

        while ($nextString < $nextSemicolon) {
            $nextString = strpos($sqlQuery, "'", $nextString + 1);
            $nextSemicolon = strpos($sqlQuery, ';', $nextString + 1);
            $nextString = strpos($sqlQuery, "'", $nextString + 1);
            if ($nextString === false) {
                break;
            }
        }

        return $nextSemicolon;
    }

    /**
     * Creates an instance of a statement parser class and invokes statement parsing.
     *
     * @param string $statement   MySQL statement to parse
     * @param string $parserClass Parser class to use
     *
     * @return void
     */
    private function _parseStatement($statement, $parserClass)
    {
        $classFilename = str_replace('_', '/', $parserClass) . '.php';
        include_once $classFilename;
        $parserObject = new $parserClass;

        if (!$parserObject instanceof Msd_Sql_Parser_Interface) {
            throw new Msd_Sql_Parser_Exception('The given parser class must implement Msd_Sql_Parser_Interface!');
        }

        $parserObject->parse($statement);
    }
}
