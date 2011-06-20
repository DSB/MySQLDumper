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
 * Class to represent sql data to be parsed.
 * Object is intended to be handled over to the parser classes so that they can work on it.
 *
 * @package         MySQLDumper
 * @subpackage      SQL-Parser
 */
class Msd_Sql_Object
{
    /**
     * Holds string data to be parsed.
     *
     * @var string
     */
    private $_data = '';

    /**
     * Holds a pointer to the actual examined part as offset.
     *
     * @var string
     */
    private $_pointer = 0;

    /**
     * Holds the parsing state.
     * This is set by the data examining methods of the parser and reflects the parser mode (select, insert, ...)
     *
     * @var string
     */
    private $_state = '';

    /**
     * Holds parsing errors.
     *
     * @var string
     */
    private $_errors = array();

    /**
     * Constructor
     *
     * @param null $sqlData SQl data to be parsed
     */
    public function __construct($sqlData = null)
    {
        $this->_data = $sqlData;
    }

    /**
     * Sets data of object
     *
     * @param string $sqlData The queries
     *
     * @return void
     */
    public function setData($sqlData = '')
    {
        $this->_data = $sqlData;
    }

    /**
     * Append data to already given data.
     *
     * @param string $sqlData The sql-string to be appended
     *
     * @return void
     */
    private function appendData($sqlData)
    {
        $this->_data .= $sqlData;
    }

    /**
     * Get the actual position of the pointer.
     *
     * @return int Pointer position
     */
    public function getPointer()
    {
        return $this->_pointer;
    }

    /**
     * Set the actual position of the pointer.
     *
     * @param int $position Position of pointer
     *
     * @return void
     */
    public function setPointer($position)
    {
        $this->_pointer = $position;
    }

    /**
     * Move pointer to the beginning of the next command.
     *
     * Skip all spaces and line-breaks until a character is found that might be the beginning
     * of a new sql command.
     *
     * @return int New pointer position
     */
    public function movePointerToNextCommand()
    {
        $pointer = $this->getPointer();
        $dataSize = strlen($this->_data);
        $skip = array(' ', "\n", "\r", "\t");
        if ($this->_state !== 'Comment') {
            $skip[] = "\n";
        }
        if (in_array($this->_data[$pointer], $skip)) {
            while ($pointer < $dataSize && in_array($this->_data[$pointer], $skip)) {
                $pointer++;
            }
        }
        $this->setPointer($pointer);
        if ($pointer >= $this->getLength()) {
            $pointer = false;
        }
        return $pointer;
    }
    /**
     * Move pointer forward by $positions positions.
     *
     * @param integer $positions Move pointer forward by $positions
     *
     * @return void
     */
    public function movePointerForward($positions)
    {
        $this->setPointer($this->getPointer() + $positions);
    }

    /**
     * Get data from actual pointer to given position.
     *
     * @param int  $endPosition End position of pointer
     * @param bool $movePointer Move pointer behind fetched data
     *
     * @return string Sql data from the pointer position to end or to the nr of chars to fetch
     */
    public function getData($endPosition, $movePointer = true)
    {
        $data = substr($this->_data, $this->_pointer, ($endPosition - $this->_pointer));
        if ($movePointer === true) {
            $this->setPointer($endPosition +1);
        }
        return $data;
    }

    /**
     * Get length of data string.
     *
     * @return int Length of data string
     */
    public function getLength()
    {
        return strlen($this->_data);
    }

    /**
     * Check if pointer has reached the end of the data string.
     *
     * @return bool
     */
    public function hasMoreToProcess()
    {
        if ($this->_pointer < $this->getLength()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set the parser state.
     *
     * @param string $state The parsing state we are actually in.
     *
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Find the next unescaped occurance of $match.
     *
     * Begins to search at the actual postion of the pointer.
     *
     * @param string $match          The string to find
     * @param bool   $includeMatch   Whether to add length of $match to position
     *
     * @return int
     */
    public function getPosition($match = ';', $includeMatch = true)
    {
        $pointer = $this->getPointer();
        $offset = $pointer;
        $notFound = true;
        $nextHit = false;
        $length = $this->getLength() - 1; // zero-based
        while ($notFound && $offset < $length) {
            $nextHit = strpos($this->_data, $match, $offset);
            //echo "<br>getPosition: Search for '".$match."' P: ".$offset."-> Hit at :".$nextHit;
            if ($nextHit === false) {
                // check special case for comments
                if ($this->getState() == 'Comment' && strpos($this->_data, "\n", $pointer) === false) {
                    // there is no next line - return statement "as is"
                    $this->setPointer($this->getLength());
                    return $this->getLength();
                }
                // we haven't found the correct end of the query - inform user
                $lang = Msd_Language::getInstance()->getTranslator();
                $msg = sprintf(
                    $lang->_('L_SQL_INCOMPLETE_STATEMENT_DETECTED'),
                    $this->getState(),
                    $match,
                    $this->getData(200)
                );
                $this->setError($msg);
                $this->setPointer($this->getLength());
                return false;
            }

            $data = $this->getData($nextHit, false);
            if (!$this->isEscaped($data)) {
                // hit was not escaped - we found the match
                $notFound = false;
                if ($includeMatch) {
                    $nextHit += strlen($match)-1;
                }
            } else {
                // keep on looking, this one was escaped
                $offset = $nextHit+1;
            }
        }
        return $nextHit;
    }

    /**
     * Get data up to the next new line
     *
     * @return string
     */
    public function getDataUntilNewLine()
    {

    }

    /**
     * Check if hit is escaped.
     *
     * @param string $string String to analyse
     *
     * @return bool
     */
    private function isEscaped($string)
    {
        $string = str_replace('\\\\', '', $string);
        $quotes = substr_count($string, '\'');
        $escapedQuotes = substr_count($string, '\\\'');
        if (($quotes - $escapedQuotes) % 2 == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Set an error message
     *
     * @param string $msg The error message
     *
     * @return void
     */
    public function setError($msg)
    {
        $this->_errors[] = $msg;
    }

    /**
     * Get error messages
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * Check if errors occurred.
     *
     * @return bool
     */
    public function hasErrors()
    {
        $ret = false;
        if (sizeof($this->_errors) > 0) {
            $ret = true;
        }
        return $ret;
    }

    /**
     * Get actual parsing state
     *
     * @return array
     */
    public function getState()
    {
        return $this->_state;
    }
}
