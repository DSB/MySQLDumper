<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package    MySQLDumper
 * @subpackage SQL-Parser
 * @version    SVN: $Rev$
 * @author     $Author$
 */

/**
 * Class to parse MySQL queries.
 * This enables you to analyze and modify MySQL queries, which the user has entered.
 *
 * @package         MySQLDumper
 * @subpackage      SQL-Browser
 */
class Msd_Sql_Parser implements Iterator
{
    /**
     * Parsed MySQL statements.
     *
     * @var array
     */
    private $_parsedStatements = array();

    /**
     * Holds the summary of the parsing process.
     * The summary contains the count of each statement in the query.
     *
     * @var array
     */
    private $_parsingSummary = array();

    /**
     * Whether to save debug output
     *
     * @var bool
     */
    private $_debug = false;

    /**
     * Debug output buffer
     *
     * @var string
     */
    private $_debugOutput = '';


    /**
     * Class constructor.
     * Creates a new instance of the MySQL parser and optionally assign the raw MySQL query.
     *
     * @param Msd_Sql_Object $sqlObject SQL-Object holding the data to be parsed
     * @param bool           $debug     If turned on, detection of queries is logged
     */
    public function __construct(Msd_Sql_Object $sqlObject, $debug = false)
    {
        $this->_sql = $sqlObject;
        $this->_debug = $debug;
    }

    /**
     * Parses a raw MySQL query.
     * This could include more than one MySQL statement.
     *
     * @throws Msd_Sql_Parser_Exception
     *
     * @return void
     */
    public function parse()
    {
        while ($this->_sql->hasMoreToProcess() && $this->_sql->movePointerToNextCommand() !== false) {
            // check for comments or conditional comments
            $commentCheck = $this->_sql->getData($this->_sql->getPointer() + 3, false);
            if (substr($commentCheck, 0, 2) == '--' || substr($commentCheck, 0, 2) == '/*') {
                $queryType = 'Comment';
            } else {
                // get first "word" of query to get the kind we have to process
                $endOfFirstWord = $this->_sql->getPosition(' ', false);
                $sqlQuery = $this->_sql->getData($endOfFirstWord, false);
                $queryType = strtolower($sqlQuery);
            }

            try {
                $foundStatement = $this->_parseStatement($this->_sql, ucfirst($queryType));
            } catch (Msd_Sql_Parser_Exception $e) {
                $this->_sql->setError($e->getMessage());
                // stop parsing by setting pointer to the end
                $this->_sql->setPointer($this->_sql->getLength() + 1);
            }

            if ($foundStatement > '') {
                $this->_parsedStatements[] = $foundStatement;
                // increment query type counter
                if (!isset($this->_parsingSummary[$queryType])) {
                    $this->_parsingSummary[$queryType] = 0;
                }
                $this->_parsingSummary[$queryType]++;
            }
        }
    }

    /**
     * Creates an instance of a statement parser class and invokes statement parsing.
     *
     * @throws Msd_Sql_Parser_Exception
     *
     * @param Msd_Sql_Object $sqlObject MySQL statement to parse
     * @param string         $statement Parser class to use
     *
     * @return array
     */
    private function _parseStatement(Msd_Sql_Object $sqlObject, $statement)
    {
        $statementPath = '/Msd/Sql/Parser/Statement/' . $statement;
        if (!file_exists(LIBRARY_PATH . $statementPath . '.php')) {
            throw new Msd_Sql_Parser_Exception("Unknown statement: '" . $statement . "'");
        }
        $statementClass = 'Msd_Sql_Parser_Statement_' . $statement;
        $parserObject = new $statementClass();
        return $parserObject->parse($sqlObject);
    }

    /**
     * Returns the array with the parsed statements.
     *
     * @return array
     */
    public function getParsedStatements()
    {
        return $this->_parsedStatements;
    }

    /**
     * Returns the parsing summary.
     *
     * @return array
     */
    public function getSummary()
    {
        return $this->_parsingSummary;
    }

    /**
     * Rewind (reset) the internal pointer position af the parsed statements array.
     *
     * @return mixed
     */
    public function rewind()
    {
        return reset($this->_parsedStatements);
    }

    /**
     * Return the current value af the parsed statements array.
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->_parsedStatements);
    }

    /**
     * Return the current key af the parsed statements array.
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->_parsedStatements);
    }

    /**
     * Move the internal pointer af the parsed statements array to the next position.
     *
     * @return mixed
     */
    public function next()
    {
        return next($this->_parsedStatements);
    }

    /**
     * Validates the internal pointer position af the parsed statements array.
     *
     * @return bool
     */
    public function valid()
    {
        return key($this->_parsedStatements) !== null;
    }

    /**
     * Get debug output buffer
     *
     * @return array
     */
    public function getDebugOutput()
    {
        return $this->_debugOutput;
    }
}
