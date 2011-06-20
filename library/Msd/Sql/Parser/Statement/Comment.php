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
 * Class to parse MySQL comments.
 * This enables you to analyze and modify MySQL queries, which the user has entered.
 *
 * @package         MySQLDumper
 * @subpackage      SQL-Parser
 */
class Msd_Sql_Parser_Statement_Comment implements Msd_Sql_Parser_Interface
{
    /**
     * Parse the statement.
     *
     * @param Msd_Sql_Object $sql MySQL comment.
     *
     * @return string
     */
    public function parse(Msd_Sql_Object $sql)
    {
        $sql->setState('Comment');
        $firstChars = $sql->getData($sql->getPointer() + 3, false);
        $includeMatch = true;
        $returnStatement = false;
        if (substr($firstChars, 0, 2) == '--' || substr($firstChars, 0, 1) == '#') {
            // one line comment -> match new line
            $match = "\n";
            $includeMatch = false;
        } else {
            if ($firstChars == '/*!') {
                // conditionial statement
                $match = '*/;';
                $returnStatement = true;
            } else {
                // multi line comment
                $match = '*/';
            }
        }
        $endOfStatement = $sql->getPosition($match, $includeMatch);
        $statement = $sql->getData($endOfStatement);
        if ($returnStatement === true) {
            return $statement;
        } else {
            return '';
        }
    }
}
