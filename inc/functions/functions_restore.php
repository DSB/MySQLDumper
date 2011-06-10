<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
if (!defined('MSD_VERSION')) die('No direct access.');
/**
 * Reads next lines from file and extracts a complete SQL-Command
 *
 * @return string $sql_command The complete Query
 */
function getQueryFromFile($showErrors = true)
{
    global $restore, $config, $databases, $lang, $dbo, $log;

    //Init
    $complete_sql = '';
    $sqlparser_status = 0;
    $query_found = false;

    //Parse
    WHILE (!$query_found && !$restore['fileEOF'] && !$restore['EOB'])
    {
        //get next line from file
        $zeile = ($restore['compressed']) ? gzgets($restore['filehandle']) : fgets($restore['filehandle']);
        // if we are at the beginning of a file look for BOM and remove it
        if ($restore['offset'] == 0) $zeile = removeBom($zeile);

        // what kind of command did we read from the file?
        if ($sqlparser_status == 0)
        {

            // build comparing line in uppercase
            $zeile2 = strtoupper(trim(substr($zeile, 0, 9)));
            // pre-build compare strings - so we need the CPU power only once :)
            $sub9 = substr($zeile2, 0, 9);
            $sub7 = substr($sub9, 0, 7);
            $sub6 = substr($sub7, 0, 6);
            $sub4 = substr($sub6, 0, 4);
            $sub3 = substr($sub4, 0, 3);
            $sub2 = substr($sub3, 0, 2);
            $sub1 = substr($sub2, 0, 1);

            if ($sub7 == 'INSERT ')
            {
                $sqlparser_status = 3;
                $restore['actual_table'] = getTablename($zeile, $restore['actual_table']);
            }
            elseif ($sub7 == 'REPLACE')
            {
                $sqlparser_status = 8;
                $restore['actual_table'] = getTablename($zeile, $restore['actual_table']);
            }

            // find statements ending with a colon
            elseif ($sub7 == 'LOCK TA') $sqlparser_status = 4;
            elseif ($sub6 == 'COMMIT') $sqlparser_status = 7;
            elseif (substr($sub6, 0, 5) == 'BEGIN') $sqlparser_status = 7;
            elseif ($sub9 == 'UNLOCK TA') $sqlparser_status = 4;
            elseif ($sub3 == 'SET') $sqlparser_status = 4;
            elseif ($sub6 == 'START ') $sqlparser_status = 4;
            elseif ($sub3 == '/*!') $sqlparser_status = 5; //MySQL-Condition oder Comment
            elseif ($sub9 == 'ALTER TAB') $sqlparser_status = 4; // Alter Table
            elseif ($sub9 == 'CREATE TA') $sqlparser_status = 2; //Create Table
            elseif ($sub9 == 'CREATE AL') $sqlparser_status = 2; //Create View
            elseif ($sub9 == 'CREATE IN') $sqlparser_status = 4; //Indexaction
            elseif ($sub7 == 'UPDATE ') $sqlparser_status = 4;
            elseif ($sub7 == 'SELECT ') $sqlparser_status = 4;

            // divide comment from condition
            elseif (($sqlparser_status != 5) && ($sub2 == '/*')) $sqlparser_status = 6;

            // delete actions
            elseif ($sub9 == 'DROP TABL') $sqlparser_status = 1;
            elseif ($sub9 == 'DROP VIEW') $sqlparser_status = 1;
            elseif ($sub7 == 'DELETE ') $sqlparser_status = 1;

            // commands that mustn't be executed
            elseif ($sub9 == 'CREATE DA ') $sqlparser_status = 7;
            elseif ($sub9 == 'DROP DATA ') $sqlparser_status = 7;
            elseif ($sub3 == 'USE') $sqlparser_status = 7;

            // end of a MySQLDumper-Dump reached?
            elseif ($sub6 == '-- EOB' || $sub4 == '# EO')
            {
                $restore['EOB'] = true;
                $restore['fileEOF'] = true;
                $zeile = '';
                $zeile2 = '';
                $query_found = true;
            }

            // Comment?
            elseif ($sub2 == '--' || $sub1 == '#')
            {
                $zeile = '';
                $zeile2 = '';
                $sqlparser_status = 0;
            }

            // continue extended Insert?
            if ($restore['extended_insert_flag'] == 1) $sqlparser_status = 3;
            if (($sqlparser_status == 0) && (trim($complete_sql) > '') && ($restore['extended_insert_flag'] == -1))
            {
                if ($showErrors)
                {
                    // unknown command -> output debug information
                    v($restore);
                    echo "<br />Sql: " . htmlspecialchars($complete_sql);
                    die('<br />' . $lang['L_UNKNOWN_SQLCOMMAND'] . ': ' . $zeile . '<br /><br />' . $complete_sql);
                }
                else
                return array(
                false,
                $complete_sql);
            }
        }

        $last_char = substr(rtrim($zeile), -1);
        // retain new lines - otherwise keywords are glued together
        // e.g. 'null' and on next line 'check' would necome 'nullcheck'
        $complete_sql .= $zeile . "\n";

        if ($sqlparser_status == 3 || $sqlparser_status == 8)
        {
            //INSERT or REPLACE
            if (isCompleteQuery($complete_sql))
            {
                $query_found = true;
                $complete_sql = trim($complete_sql);
                if (substr($complete_sql, -2) == '*/')
                {
                    $complete_sql = deleteInlineComments($complete_sql);
                }

                // end of extended insert found?
                if (substr($complete_sql, -2) == ');')
                {
                    $restore['extended_insert_flag'] = -1;
                }

                // if there is a ")," at end of line -> extended Insert-Modus -> set flag
                else
                if (substr($complete_sql, -2) == '),')
                {
                    // letztes Komme gegen Semikolon tauschen
                    $complete_sql = substr($complete_sql, 0, -1);
                    $restore['extended_inserts'] = 1;
                    $restore['extended_insert_flag'] = 1;
                }

                $compare = substr(strtoupper($complete_sql), 0, 7);
                if (($compare != 'INSERT ' && $compare != 'REPLACE'))
                {
                    // we do have extended inserts here -> prepend insert syntax
                    // if we don't have it because of a page refresh -> get it
                    if (!isset($restore['insert_syntax'])) {
                        $restore['insert_syntax'] = Sql::getInsertSyntax(
                            $dbo, $restore['actual_table']
                        );
                    }
                    $complete_sql = $restore['insert_syntax'] . ' VALUES ' . $complete_sql;
                }
                else
                {
                    // remember the INSERT syntax
                    $ipos = strpos(strtoupper($complete_sql), ' VALUES');
                    if (!$ipos === false) $restore['insert_syntax'] = substr($complete_sql, 0, $ipos);
                    else
                    {
                        if ($sqlparser_status == 3) $restore['insert_syntax'] = 'INSERT INTO `' . $restore['actual_table'] . '`';
                        else $restore['insert_syntax'] = 'REPLACE INTO `' . $restore['actual_table'] . '`';
                    }
                }
            }
        }

        else
        if ($sqlparser_status == 1)
        {
            // delete action
            if ($last_char == ';') $query_found = true;
            $restore['actual_table'] = getTablename($complete_sql);
        }

        else
        if ($sqlparser_status == 2)
        {
            // Create-command is finished if there is a colon at the end of line
            if ($last_char == ';')
            {
                $restore['speed'] = $config['minspeed'];
                // Restore this table?
                $do_it = true;
                if (is_array($restore['tables_to_restore']))
                {
                    $do_it = false;
                    if (in_array($restore['actual_table'], $restore['tables_to_restore']))
                    {
                        $do_it = true;
                    }
                    else
                    {
                        // if we do a partial restore with selected tables and we already inserted all
                        // of them and we now have a table we don't need to restore
                        // -> we did all we need to do! Check and finish the process in that case
                        // (we don't need to further walk through the file if all needed tables are done)
                        if ($restore['table_ready'] == $restore['tables_total'])
                        {
                            $sqlparser_status = 0;
                            $restore['EOB'] = true;
                        }
                    }
                }
                $tablename = getTablename($complete_sql);
                if ($do_it)
                {
                    $complete_sql = getCorrectedCreateCommand($complete_sql);
                    $restore['table_ready']++;
                }
                else
                $complete_sql = '';
                $restore['actual_table'] = $tablename;
                $query_found = true;
                $sqlparser_status = 0;
            }
        }

        // Index
        else
        if ($sqlparser_status == 4)
        {
            if ($last_char == ';')
            {
                $restore['speed'] = $config['minspeed'];
                $complete_sql = deleteInlineComments($complete_sql);
                $query_found = true;
            }
        }

        // Comment or condition
        else
        if ($sqlparser_status == 5)
        {
            $t = strrpos($zeile, '*/;');
            if (!$t === false)
            {
                $restore['speed'] = $config['minspeed'];
                $query_found = true;
            }
        }

        // multiline-comment
        else
        if ($sqlparser_status == 6)
        {
            $t = strrpos($zeile, '*/');

            if (!$t === false)
            {
                $complete_sql = '';
                $sqlparser_status = 0;
            }
        }

        // commands that mustn't be executet
        else
        if ($sqlparser_status == 7)
        {
            if ($last_char == ';')
            {
                $restore['speed'] = $config['minspeed'];
                $complete_sql = '';
                $sqlparser_status = 0;
            }
        }

        if (($restore['compressed']) && (gzeof($restore['filehandle']))) $restore['fileEOF'] = true;
        elseif ((!$restore['compressed']) && (feof($restore['filehandle']))) $restore['fileEOF'] = true;
    }
    // if special tables are selected for restoring, check if this query belongs to them
    if (is_array($restore['tables_to_restore']) && !(in_array($restore['actual_table'], $restore['tables_to_restore'])))
    {
        $complete_sql = '';
    }
    //detect if a table is finished and write log message
    if ($sqlparser_status != 3 && $sqlparser_status != 8 && in_array($restore['last_parser_status'], array(
    3,
    8)))
    {
        if (isset($restore['records_inserted_table'][$restore['actual_table']]))
        {
            $message = sprintf($lang['L_RESTORE_TABLE'], $restore['actual_table']) . ': ';
            $message .= sprintf($lang['L_RECORDS_INSERTED'], String::formatNumber($restore['records_inserted_table'][$restore['actual_table']]));
            $log->write(Log::PHP, $message);
        }
    }
    $restore['last_parser_status'] = $sqlparser_status;
    $complete_sql = trim($complete_sql);
    return $complete_sql;
}

/**
 * Checks SQL-Create-Query for VIEW-Syntax, substitutes the old DEFINER with the actual sql-user
 * and returns the corrected query.
 *
 * @param string $sql SQL-Create-Command
 * @return string
 **/
function getCorrectedCreateCommand($sql)
{
    global $config;
    if (strtoupper(substr($sql, 0, 16)) == 'CREATE ALGORITHM')
    {
        // It`s a VIEW. We need to substitute the original DEFINER with the actual MySQL-User
        $parts = explode(' ', $sql);
        for ($i = 0, $count = sizeof($parts); $i < $count; $i++)
        {
            if (strtoupper(substr($parts[$i], 0, 8)) == 'DEFINER=')
            {
                global $config;
                $parts[$i] = 'DEFINER=`' . $config['dbuser'] . '`@`' . $config['dbhost'] . '`';
                $sql = implode(' ', $parts);
                break;
            }
        }
    }
    return $sql;
}

/**
 * Deletes inline-comments from a SQL-String
 *
 * @param string $sql SQL-Command
 *
 * @return string $sql The cleaned SQL-String
 **/
function deleteInlineComments($sql)
{
    $array = array();
    preg_match_all("/(\/\*(.+)\*\/)/U", $sql, $array);
    if (is_array($array[0]))
    {
        $sql = trim(str_replace($array[0], '', $sql));
    }
    //If there is only a colon left, it was a condition -> clear all
    if ($sql == ';') $sql = '';
    return $sql;
}

/**
 * Extract the tablename from a query
 *
 * @param string $sql          SQL-Command
 * @param string $actual_table Tablename to look for if it is known
 * @return string The name of the table extracted from the Query
 **/

function getTablename($sql, $actual_table = '')
{
    $t = substr($sql, 0, 150); // shorten string, the tablename will be in the first 150 chars


    // if we find the actual table in the string we got it -> return t without any further parsing
    if (!false === stripos($t . '` ', $actual_table)) return $t;
    if (!false === stripos($t . ' ', $actual_table)) return $t;

    // remove all keywords until the tablename is in the front position
    $t = str_ireplace('DROP TABLE', '', $t);
    $t = str_ireplace('DROP VIEW', '', $t);
    $t = str_ireplace('CREATE TABLE', '', $t);
    $t = str_ireplace('INSERT INTO', '', $t);
    $t = str_ireplace('REPLACE INTO', '', $t);
    $t = str_ireplace('IF NOT EXISTS', '', $t);
    $t = str_ireplace('IF EXISTS', '', $t);
    if (substr(strtoupper($t), 0, 16) == 'CREATE ALGORITHM')
    {
        $pos = strpos($t, 'DEFINER VIEW ');
        $t = substr($t, $pos, strlen($t) - $pos);
    }
    $t = str_ireplace(';', ' ;', $t); // tricky -> insert space as delimiter
    $t = trim($t);

    // now we simply can search for the first space or `
    $delimiter = substr($t, 0, 1);
    if ($delimiter != '`') $delimiter = ' ';
    $found = false;
    $position = 1;
    WHILE (!$found)
    {
        if (substr($t, $position, 1) == $delimiter) $found = true;
        if ($position >= strlen($t)) $found = true;
        $position++;
    }
    $t = substr($t, 0, $position);
    $t = trim(str_replace('`', '', $t));
    return $t;
}

/**
 * Detect if a SQL-Command is complete
 *
 * @param string $sql String to interpret as sql
 * @return boolean
 **/
function isCompleteQuery($string)
{
    $string = str_replace('\\\\', '', trim($string)); // trim and remove escaped backslashes
    $string = trim($string);
    $quotes = substr_count($string, '\'');
    $escaped_quotes = substr_count($string, '\\\'');
    if (($quotes - $escaped_quotes) % 2 == 0)
    {
        $compare = substr($string, -2);
        if ($compare == '*/') $compare = substr(deleteInlineComments($string), -2);
        if ($compare == ');') return true;
        if ($compare == '),') return true;
    }
    return false;
}

