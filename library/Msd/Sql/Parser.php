<?php

class Msd_Sql_Parser
{
    private $_rawQuery = null;

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

    protected $_sqlComments = array(
        '--' => "\n", '/*' => '*/'
    );

    public function __construct($sqlQuery = null)
    {
        if ($sqlQuery !== null) {
            $this->_rawQuery = $sqlQuery;
        }
    }

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
            $parserClass = 'Msd_Sql_Parser_' . ucwords($statement);
            $endPos = $this->_getStatementEndPos($sqlQuery, $startPos);
            $completeStatement = trim(substr($sqlQuery, $startPos, $endPos - $startPos));
            $startPos = $endPos + 1;
        }
    }

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
}
