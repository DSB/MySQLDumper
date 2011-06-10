<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Sql
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */

/**
 * Sql Parser Class
 *
 * @package         MySQLDumper
 * @subpackage      Sqlparser
 */
define('*', 'SQL_TOKEN');
class Msd_Sqlparser
{
    /**
     * @var array Array containing the parsed queries
     */
    private $_queries = array();

    /**
     * @var string Input text to analyse
     */
    private $_text = '';

    /**
     * @param string $text Text to be later parsed as sql
     */
    public function __construct($text = '')
    {
        $this->addText($text);
    }

    /**
     * Add text to internal text buffer
     *
     * @param  string $text The text to add
     * @return void
     */
    public function addText($text)
    {
        $this->_text .= $text;
    }

    /**
     * Parse added text as sql und split into queries
     *
     * @return void
     */
    public function parse()
    {
        //TODO implement parser
        return $this->_text;
        $i=1;
        $tokens = token_get_all('<?php '.$this->_text.'?>');
        unset($tokens[0]);
        unset($tokens[count($tokens)]);
        //unset($tokens[count($tokens)]);
        //unset($tokens[0]);
        foreach ($tokens as $token) {
           if (is_string($token)) {
               // simple 1-character token
               echo "<br>$i. $token";
           } else {
               // token array
               list($token, $text) = $token;
               echo "<br>$i. ". token_name($token)." => "
                    . htmlspecialchars($text);
           }
            $i++;
        }
    }
}
