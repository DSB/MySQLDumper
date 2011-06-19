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
 * Interface definition for MySQL statement parsers.
 *
 * @package         MySQLDumper
 * @subpackage      SQL-Parser
 */
interface Msd_Sql_Parser_Interface
{
    /**
     * Parse the statement.
     *
     * @abstract
     *
     * @param Msd_Sql_Object $sqlObject MySQL statement object.
     *
     * @return void
     */
    public function parse(Msd_Sql_Object $sqlObject);
}