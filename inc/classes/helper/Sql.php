<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Helper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * Sql-Helper Class
 *
 * Class offers some methods to wrap some common Sql-commands
 */
class Sql
{
    /**
     * Optimize a table and write returned message to log file.
     *
     * Returns true on success or MySQL-Error.
     *
     * @param MsdDbFactory $dbo   Database object
     * @param string       $table Name of table
     *
     * @return bool
     */
    public static function optimizeTable(MsdDbFactory $dbo, $table)
    {
        global $lang, $log;
        $res = $dbo->optimizeTable($table);
        if (false !== $res) {
            $success=array('status', 'info','warning','note');
            if (in_array($res['Msg_type'], $success)) {
                $logMsg = $lang['L_OPTIMIZE'].' `'.$dbo->dbSelected. '`.`';
                $logMsg .= $table.'`: '.$res['Msg_text'];
                $log->write(Log::PHP, $logMsg);
                return true;
            } else {
                $logMsg = sprintf($lang['L_OPTIMIZE_TABLE_ERR'], $table);
                writeToErrorLog($dbo->dbSelected, $logMsg, $res['msg_text'], 0);
                return false;
            }
        } else {
            $logMsg = sprintf($lang['L_OPTIMIZE_TABLE_ERR'], $table);
            writeToErrorLog($dbo->dbSelecte, $logMsg, $res['msg_text'], 0);
            return false;
        }
    }
    /**
     * Creates a INSERT INTO-string
     *
     * "INSERT INTO (`field1`,`field2`,..)"-Command for the given table
     * by looking up the meta-information. Table must exists.
     * Note: Only used when restoring a backup not from MySQLDumper containing
     * extended inserts.
     *
     * @param MsdDbFactory  Database object
     * @param string $table Name of table to analyze
     *
     * @return string $insert The name of the table extracted from the Query
     **/
    public static function getInsertSyntax(MsdDbFactory $dbo, $table)
    {
        $insert = '';
        $columns=$dbo->getTableColumns($table);
        $fields=array_keys($columns);
        $insert = 'INSERT INTO `' . $table . '` (`';
        $insert .=implode('`,`', $fields) . '`)';
        return $insert;
    }
    /**
     * Disables keys for given table
     *
     * @param MsdDbFactory $dbo   Database object
     * @param string       $table Name of table
     *
     * @return bool
     */
    public static function disableKeys(MsdDbFactory $dbo, $table)
    {
        $query = '/*!40000 ALTER TABLE `' . $table . '` DISABLE KEYS */';
        return $dbo->query($query, MsdDbFactory::SIMPLE);
    }
}
