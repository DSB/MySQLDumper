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
 * Object is intended to be handed over to the parser classes so that they can work on it.
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
     * Holdes a pointer to the actual examined part as offset.
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
        $skip = array(';', ' ', "\n", "\r");
        while ($pointer < $dataSize && in_array($this->_data[$pointer], $skip)) {
            $pointer++;
        }
        $this->setPointer($pointer);
        return $pointer;
    }

    /**
     * Get some characters of data.
     *
     * @param int $nrOfCharacters Number of characters to get
     *
     * @return string Sql data from the pointer position to end or to the nr of chars to fetch
     */
    public function getData($nrOfCharacters = null)
    {
        if ($nrOfCharacters > 0) {
            return substr($this->_data, $this->_pointer, $nrOfCharacters);
        } else {
            return substr($this->_data, $this->_pointer);
        }
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
     * @param string $match
     *
     * @return int
     */
    public function getPosition($match = ';')
    {
        $pointer = $this->getPointer();
        $offset = $pointer;
        $notFound = true;
        $length = $this->getLength()-1;
        while ($notFound && $offset < $length) {
            //echo "<br>Checking: ". substr($this->_data, $offset);
            $nextHit = strpos($this->_data, $match, $offset);
            //echo "<br>Next hit is :".intval($nextHit);
            if ($nextHit === false) {
                $nextHit = $this->getLength() - $pointer;
            }
            // now check if we found an escaped occurance
            $string = substr($this->_data, $pointer, $nextHit);
            $string=str_replace('\\\\','',trim($string));
            $quotes=substr_count($string,'\'');
            $escaped_quotes=substr_count($string,'\\\'');
            if (($quotes-$escaped_quotes) % 2 == 0) {
                // hit was not escaped - we found the match
                $notFound = false;
            } else {
                // keep on looking, this was escaped
                $offset = $pointer + $nextHit +1;
            }
        }
        return $nextHit;
    }
}
