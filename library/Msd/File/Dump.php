<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      File
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */

/**
 * Dumpfile-Helper Class
 *
 * Class offers some methods for file handling
 * 
 * @package         MySQLDumper
 * @subpackage      File
 */
class Msd_File_Dump extends Msd_File
{
    /**
     * Get statusline information from backup file
     *
     * @throws Exception
     *
     * @param string $filename Name of file to read
     * 
     * @return array
     */
    public static function getStatusline($filename)
    {
        $config = Msd_Registry::getConfig();
        $path = $config->getParam('paths.backup'). '/';
        if (strtolower(substr($filename, -3)) == '.gz') {
            $fileHandle = gzopen($path . $filename, "r");
            if ($fileHandle === false) {
                throw new Exception('Can\'t open file '.$filename);
            }
            $statusLine = gzgets($fileHandle, 40960);
            gzclose($fileHandle);
        } else {
            $fileHandle=fopen($path . $filename, "r");
            if ($fileHandle === false) {
                throw new Exception('Can\'t open file '.$filename);
            }
            $statusLine = fgets($fileHandle, 5000);
            fclose($fileHandle);
        }
        return self::_explodeStatusline($statusLine);
    }

    /**
     * Get information from stausline string
     * 
     * @param string $line
     * 
     * @return array
     */
    private static function _explodeStatusline($line)
    {
        /*Construction of statusline (first line in backup file):
            -- Status : NrOfTables : nrOfRecords : Multipart : DatabaseName : 
            script : scriptversion : Comment : MySQLVersion : 
            Backupflags (unused): SQLBefore : SQLAfter : Charset : EXTINFO
        */
        $statusLine = array();
        $compare = substr($line, 0, 8);
        if ( $compare != '# Status' && $compare != '-- Statu') { 
            // not a backup of MySQLDumper
            return self::_getDefaultStatusline();
        } else {
            // extract informationen
            $flag = explode(':', $line);
            if (count($flag)<12) {
                // fill missing elements for backwards compatibility
                array_pop($flag);
                for ($i = count($flag) - 1; $i < 12; $i++) {
                    $flag[]='';
                }
            }
            $statusLine['tables'] = $flag[1];
            $statusLine['records'] = $flag[2];
            if ($flag[3] == '' || $flag[3] == 'MP_0') {
                $statusLine['part']= 'MP_0';
            } else {
                $statusLine['part'] = $flag[3];
            }
            $statusLine['dbname'] = $flag[4];
            $statusLine['script'] = $flag[5];
            $statusLine['scriptversion'] = $flag[6];
            $statusLine['comment'] = $flag[7];
            $statusLine['mysqlversion'] = $flag[8];
            $statusLine['flags'] = $flag[9];
            $statusLine['sqlbefore'] = $flag[10];
            $statusLine['sqlafter'] = $flag[11];
            if ( isset($flag[12]) && trim($flag[12])!='EXTINFO') {
                $statusLine['charset']=$flag[12];
            } else {
                $statusLine['charset']='?';
            }
        }
        return $statusLine;
    }

    /**
     * Get default statusline
     * 
     * @return array
     */
    private static function _getDefaultStatusline()
    {
        $statusLine['tables'] = -1;
        $statusLine['records'] = -1;
        $statusLine['part'] = 'MP_0';
        $statusLine['dbname'] = 'unknown';
        $statusLine['script'] = '';
        $statusLine['scriptversion'] = '';
        $statusLine['comment'] = '';
        $statusLine['mysqlversion'] = 'unknown';
        $statusLine['flags'] = '2222222';
        $statusLine['sqlbefore'] = '';
        $statusLine['sqlafter'] = '';
        $statusLine['charset'] = '?';
        return $statusLine;
    }
    
}
