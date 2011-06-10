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

//SQL-Library laden
include ('./inc/sqllib.php');

/**
 * Get sql-library as array.
 *
 * @return array
 */
function getSqlLibrary()
{
    global $SQL_ARRAY, $config;
    $sf = './' . $config['paths']['config'] . 'sql_statements';
    if (!is_file($sf)) {
        $fp = fopen($sf, "w+");
        fclose($fp);
        @chmod($sf, 0777);
    }
    if (count($SQL_ARRAY) == 0 && filesize($sf) > 0) {
        $SQL_ARRAY = file($sf);
    }
}

/**
 * Saves a new query to the Sql-Library
 *
 * @return void
 */
function saveQueryToSqlLibrary()
{
    global $SQL_ARRAY, $config;
    $sf = './' . $config['paths']['config'] . 'sql_statements';
    $str = "";
    for ($i = 0; $i < count($SQL_ARRAY); $i++)
    {
        $str .= $SQL_ARRAY[$i];
        if (substr($str, -1) != "\n" && $i != (count($SQL_ARRAY) - 1)) $str .= "\n";

    }
    if ($config['magic_quotes_gpc']) $str = stripslashes($str);
    $fp = fopen($sf, "wb");
    fwrite($fp, $str);
    fclose($fp);
}

/**
 * Gets the name of query nr $index from the Sql-Library.
 *
 * @param integer $index
 * @return string
 */
function getQueryNameFromSqlLibrary($index)
{
    global $SQL_ARRAY;
    $s = explode('|', $SQL_ARRAY[$index]);
    return $s[0];
}

/**
 * Gets the query nr $index from the Sql-Library.
 *
 * @param integer $index
 * @return string
 */
function getQueryFromSqlLibrary($index)
{
    global $SQL_ARRAY;
    if (!is_array($SQL_ARRAY)) getSqlLibrary();
    if (isset($SQL_ARRAY[$index]) && !empty($SQL_ARRAY[$index]))
    {
        $s = explode('|', $SQL_ARRAY[$index], 2);
        return (isset($s[1])) ? $s[1] : '';
    }
    else
    return '';
}

/**
 * Creates a html option list from the Sql-Library
 *
 * @return string
 */
function getSqlLibraryComboBox()
{
    global $SQL_ARRAY, $tablename;
    $s = '';
    if (count($SQL_ARRAY) > 0)
    {
        $s = "\n\n" . '<select class="SQLCombo" name="sqlcombo" onchange="this.form.sqltextarea.value=this.options[this.selectedIndex].value;">' . "\n";
        $s .= '<option value=""';
        $s .= Html::getSelected(true, true);
        $s .= '>---</option>' . "\n";
        for ($i = 0; $i < count($SQL_ARRAY); $i++)
        {
            $s .= '<option value="' . htmlspecialchars(stripslashes(getQueryFromSqlLibrary($i))) . '">' . getQueryNameFromSqlLibrary($i) . '</option>' . "\n";
        }
        $s .= '</select>' . "\n\n";
    }
    return $s;
}

/**
 * Detects if a query returns rows as result or just true or false
 * Used in SQLBrowser to decide wether a list of records must be shown
 *
 * @param $sql the query to discover
 * return bool
 **/
function queryReturnsRecords($sql)
{
    global $mysql_SQLhasRecords;
    $s = explode(' ', $sql);
    if (!is_array($s)) return false;
    return in_array(strtoupper($s[0]), $mysql_SQLhasRecords) ? true : false;
}

function splitSQLStatements2Array($sql)
{
    $z = 0;
    $sqlArr = array();
    $tmp = '';
    $sql = str_replace("\n", '', $sql);
    $l = strlen($sql);
    $inQuotes = false;
    for ($i = 0; $i < $l; $i++)
    {
        $tmp .= $sql[$i];
        if ($sql[$i] == "'" || $sql[$i] == '"') $inQuotes = !$inQuotes;
        if ($sql[$i] == ';' && $inQuotes == false)
        {
            $z++;
            $sqlArr[] = $tmp;
            $tmp = '';
        }
    }
    if (trim($tmp) != '') $sqlArr[] = $tmp;
    return $sqlArr;
}

/**
 * Build HTML-Selectbox from saved SQL-Commands
 *
 * @param string  $when  Before backup = 0, After Backup =1
 * @param integer $index Index of database
 * @return string HTML as string
 */
function getCommandDumpComboBox($when, $index, $db_name)
{
    global $SQL_ARRAY, $databases, $lang;
    if (count($SQL_ARRAY) == 0)
    {
        if ($when == 0) $r = '<input type="hidden" name="command_before_' . $index . '" value="" />';
        else $r = '<input type="hidden" name="command_after_' . $index . '" value="" />';
    }
    else
    {
        if ($when == 0)
        {
            $r = '<select class="SQLCombo select noleftmargin" name="command_before_' . $index . '" />';
            $csql = trim($databases[$db_name]['command_before_dump']);
        }
        else
        {
            $r = '<select class="SQLCombo select noleftmargin" name="command_after_' . $index . '" />';
            $csql = trim($databases[$db_name]['command_after_dump']);
        }

        $r .= '<option value=""' . Html::getSelected($csql, '') . ' />&nbsp;&nbsp;</option>' . "\n";
        for ($i = 0; $i < count($SQL_ARRAY); $i++)
        {
            $s = trim(getQueryFromSqlLibrary($i));
            $r .= '<option value="' . $i . '"';
            $r .= Html::getSelected($s, $csql);
            $r .= '>' . getQueryNameFromSqlLibrary($i) . '&nbsp;</option>' . "\n";
        }
        $r .= '</select>';
    }
    return $r;
}

/**
 * Extracts the target tablename from a query
 *
 * @param string $q The query
 * @return string
 */
function extractTablenameFromSQL($q)
{
    global $databases, $db, $dbid;
    $tablename = '';
    if (strlen($q) > 100) $q = substr($q, 0, 100);
    $p = trim($q);
    // if we get a list of tables - no current table is selected -> return ''
    if (strtoupper(substr($q, 0, 17)) == 'SHOW TABLE STATUS') return '';
    // check for SELECT-Statement to extract tablename after FROM
    if (strtoupper(substr($p, 0, 7)) == 'SELECT ')
    {
        $parts = array();
        $p = substr($p, strpos(strtoupper($p), 'FROM') + 5);
        $parts = explode(' ', $p);
        $p = $parts[0];
    }
    $suchen = array(

        'SHOW ',
        'SELECT',
        'DROP',
        'INSERT',
        'UPDATE',
        'DELETE',
        'CREATE',
        'TABLE',
        'STATUS',
        'FROM',
        '*');
    $ersetzen = array(

        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '');
    $cleaned = trim(str_ireplace($suchen, $ersetzen, $p));
    $tablename = $cleaned;
    if (strpos($cleaned, ' ')) $tablename = substr($cleaned, 0, strpos($cleaned, ' '));
    $tablename = str_replace('`', '', $tablename); // remove backticks
    // take care of db-name.tablename
    if (strpos($tablename, '.'))
    {
        $p = explode('.', $tablename);
        $config['db_actual'] = $p[0];
        if (isset($_GET['tablename'])) unset($_GET['tablename']);
        $tablename = $p[1];
    }
    return $tablename;
}

/**
 * Reads extened MySQL field information
 *
 * Reads extened field information for each field of a MySQL table
 * and fills an array like
 * array(
 *  [Fieldname][attribut]=value,
 *  ['primary_key']=keys
 * )
 *
 * @param $db Database
 * @param $table Table
 * @return array Field infos
 */
function getExtendedFieldInfo($db, $table)
{
    global $config, $dbo;
    $fields_infos = array();
    //$t = GetCreateTable($db, $table);
    $sqlf = "SHOW FULL FIELDS FROM `$db`.`$table`;";
    $res = $dbo->query($sqlf, MsdDbFactory::ARRAY_ASSOC);
    $num_fields = sizeof($res);
    $f = array(); //will hold all info
    for ($x = 0; $x < $num_fields; $x++)
    {
        $row = $res[$x]; //mysql_fetch_array($res, MYSQL_ASSOC);
        $i = $row['Field']; // define name of field as index of array
        //define field defaults - this way the index of the array is defined anyway
        $f[$i]['field'] = '';
        $f[$i]['collation'] = '';
        $f[$i]['comment'] = '';
        $f[$i]['type'] = '';
        $f[$i]['size'] = '';
        $f[$i]['attributes'] = '';
        $f[$i]['null'] = '';
        $f[$i]['default'] = '';
        $f[$i]['extra'] = '';
        $f[$i]['privileges'] = '';
        $f[$i]['key'] = $row['Key']; //array();


        if (isset($row['Collation'])) $f[$i]['collate'] = $row['Collation'];
        if (isset($row['COLLATE'])) $f[$i]['collate'] = $row['COLLATE']; // MySQL <4.1
        if (isset($row['Comment'])) $f[$i]['comment'] = $row['Comment'];
        if (isset($row['Type'])) $f[$i]['type'] = $row['Type'];
        if (isset($row['Field'])) $f[$i]['field'] = $row['Field'];
        $f[$i]['size'] = get_attribut_size_from_type($f[$i]['type']);
        // remove size from type for readability in output
        $f[$i]['type'] = str_replace('(' . $f[$i]['size'] . ')', '', $f[$i]['type']);
        // look for attributes, everthing behind the first space is an atribut
        $attributes = explode(' ', $f[$i]['type'], 2);
        if (isset($attributes[1]))
        {
            // we found attributes
            unset($attributes[0]); // delete type
            $f[$i]['attributes'] = trim(implode(' ', $attributes)); //merge all other attributes
            // remove attributes from type
            $f[$i]['type'] = trim(str_replace($f[$i]['attributes'], '', $f[$i]['type']));
        }
        if (isset($row['NULL'])) $f[$i]['null'] = $row['NULL'];
        if (isset($row['Null'])) $f[$i]['null'] = $row['Null'];
        if (isset($row['Default'])) $f[$i]['default'] = $row['Default'];
        if (isset($row['Extra'])) $f[$i]['extra'] = $row['Extra'];
        if (isset($row['Privileges'])) $f[$i]['privileges'] = $row['Privileges'];
        if (isset($row['privileges'])) $f[$i]['privileges'] = $row['privileges'];
    }

    return $f;
}

/**
 * Returns an unique Identifier for a record in a table
 *
 * @param string $db     Database
 * @param string $table  Table
 * @param array  &$record Complete records
 *
 * @return string Where-Condition to identify the record
 */
function getRecordIdentifier($db, $table, &$record)
{
    global $table_infos;
    $where = '';

    if (!isset($table_infos[$db]['tables'][$table]['keys']))
    {
        $table_infos = getTableInfo($db, $table);
        $keys = getKeys($db, $table);
        $table_infos[$db]['tables'][$table]['keys'] = $keys;
    }
    if (isset($table_infos[$db]['tables'][$table]['keys']['PRIMARY']))
    {
        // table has a primary key -> we can build the identifier by it
        foreach ($table_infos[$db]['tables'][$table]['keys']['PRIMARY'] as $column => $val)
        {
            $where .= $where > '' ? ' AND ' : '';
            $where .= '`' . $column . '` = \'' . $record[$column] . '\'';
        }
    }
    else
    {
        // shame on the table design -> no key given -> build key from all values of record
        foreach ($record as $column => $val)
        {
            $where .= $where > '' ? ' AND ' : '';
            $where .= '`' . $column . '` = \'' . $record[$column] . '\'';
        }
    }
    return $where;
}

/**
 * Get Keys from a table and store them in an ass. array $array[Key-Name][column_name]=$keys
 *
 * @param string $db
 * @param string $table
 *
 * @return array
 */
function getKeys($db, $table)
{
    global $dbo;
    $keys = array();
    $sql = 'SHOW KEYS FROM `' . $db . '`.`' . $table . '`';
    $res = $dbo->query($sql, MsdDbFactory::ARRAY_ASSOC);
    foreach ($res as $row)
    {
        $keys[$row['Key_name']][$row['Column_name']] = $row;
    }
    return $keys;
}

/**
 * Extracts the part in brackets in a string, e.g. int(11) => 11
 *
 * @param string $type
 * @return string
 */
function get_attribut_size_from_type($type)
{
    $size = '';
    $matches = array();
    $pattern = '/\((\d.*?)\)/msi';
    preg_match($pattern, $type, $matches);
    if (isset($matches[1])) $size = $matches[1];
    return $size;
}

