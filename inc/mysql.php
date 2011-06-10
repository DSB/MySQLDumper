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

$sql_keywords = array(
    'ALTER',
    'AND',
    'ADD',
    'AUTO_INCREMENT',
    'BETWEEN',
    'BINARY',
    'BOTH',
    'BY',
    'BOOLEAN',
    'CHANGE',
    'CHARSET',
    'CHECK',
    'COLLATE',
    'COLUMNS',
    'COLUMN',
    'CROSS',
    'CREATE',
    'DATABASES',
    'DATABASE',
    'DATA',
    'DELAYED',
    'DESCRIBE',
    'DESC',
    'DISTINCT',
    'DELETE',
    'DROP',
    'DEFAULT',
    'ENCLOSED',
    'ENGINE',
    'ESCAPED',
    'EXISTS',
    'EXPLAIN',
    'FIELDS',
    'FIELD',
    'FLUSH',
    'FOR',
    'FOREIGN',
    'FUNCTION',
    'FROM',
    'GROUP',
    'GRANT',
    'HAVING',
    'IGNORE',
    'INDEX',
    'INFILE',
    'INSERT',
    'INNER',
    'INTO',
    'IDENTIFIED',
    'JOIN',
    'KEYS',
    'KILL',
    'KEY',
    'LEADING',
    'LIKE',
    'LIMIT',
    'LINES',
    'LOAD',
    'LOCAL',
    'LOCK',
    'LOW_PRIORITY',
    'LEFT',
    'LANGUAGE',
    'MEDIUMINT',
    'MODIFY',
    'MyISAM',
    'NATURAL',
    'NOT',
    'NULL',
    'NEXTVAL',
    'OPTIMIZE',
    'OPTION',
    'OPTIONALLY',
    'ORDER',
    'OUTFILE',
    'OR',
    'OUTER',
    'ON',
    'PROCEEDURE',
    'PROCEDURAL',
    'PRIMARY',
    'READ',
    'REFERENCES',
    'REGEXP',
    'RENAME',
    'REPLACE',
    'RETURN',
    'REVOKE',
    'RLIKE',
    'RIGHT',
    'SHOW',
    'SONAME',
    'STATUS',
    'STRAIGHT_JOIN',
    'SELECT',
    'SETVAL',
    'TABLES',
    'TEMINATED',
    'TO',
    'TRAILING',
    'TRUNCATE',
    'TABLE',
    'TEMPORARY',
    'TRIGGER',
    'TRUSTED',
    'UNIQUE',
    'UNLOCK',
    'USE',
    'USING',
    'UPDATE',
    'UNSIGNED',
    'VALUES',
    'VARIABLES',
    'VIEW',
    'WITH',
    'WRITE',
    'WHERE',
    'ZEROFILL',
    'XOR',
    'ALL',
    'ASC',
    'AS',
    'SET',
    'IN',
    'IS',
    'IF');

$mysql_SQLhasRecords = array(
    'SELECT',
    'SHOW',
    'EXPLAIN',
    'DESCRIBE',
    'DESC');

function GetMySQLVersion()
{
    global $dbo;
    $version=$dbo->getServerInfo();
    if (!defined('MSD_MYSQL_VERSION')) define('MSD_MYSQL_VERSION', $version);
    $versions = explode('.', $version);
    $new = false;
    if ($versions[0] == 4 && $versions[1] >= 1) $new = true;
    if ($versions[0] > 4) $new = true;
    if (!defined('MSD_NEW_VERSION')) define('MSD_NEW_VERSION', $new);
    return $version;
}


function SQLError($sql, $error, $return_output = false)
{
    //v(debug_backtrace());
    global $lang;

    $ret = '<div align="center"><table style="border:1px solid #ff0000" cellspacing="0">
<tr bgcolor="#ff0000"><td style="color:white;font-size:16px;"><strong>MySQL-ERROR</strong></td></tr>
<tr><td style="width:80%;overflow: auto;">' . $lang['L_SQL_ERROR2'] . '<br /><span style="color:red;">' . $error . '</span></td></tr>';
    if ($sql > '')
    {
        $ret .= '<tr><td width="600"><br />' . $lang['L_SQL_ERROR1'] . '<br />' . Highlight_SQL($sql) . '</td></tr>';
    }
    $ret .= '</table></div>';
    if ($return_output) return $ret;
    else echo $ret;
}

function Highlight_SQL($sql)
{
    global $sql_keywords;

    $end = '';
    $tickstart = false;
    if (function_exists("token_get_all")) $a = @token_get_all("<?$sql?>");
    else return $sql;
    foreach ($a as $token)
    {
        if (!is_array($token))
        {
            if ($token == '`') $tickstart = !$tickstart;
            $end .= $token;
        }
        else
        {
            if ($tickstart) $end .= $token[1];
            else
            {
                switch (token_name($token[0]))
                {
                    case "T_STRING":
                    case "T_AS":
                    case "T_FOR":

                        $end .= (in_array(strtoupper($token[1]), $sql_keywords)) ? "<span style=\"color:#990099;font-weight:bold;\">" . $token[1] . "</span>" : $token[1];
                        break;
                    case "T_IF":
                    case "T_LOGICAL_AND":
                    case "T_LOGICAL_OR":
                    case "T_LOGICAL_XOR":
                        $end .= (in_array(strtoupper($token[1]), $sql_keywords)) ? "<span style=\"color:#0000ff;font-weight:bold;\">" . $token[1] . "</span>" : $token[1];
                        break;
                    case "T_CLOSE_TAG":
                    case "T_OPEN_TAG":
                        break;
                    default:
                        $end .= $token[1];
                }
            }
        }
    }
    $end = preg_replace("/`(.*?)`/si", "<span style=\"color:red;\">`$1`</span>", $end);
    return $end;
}
