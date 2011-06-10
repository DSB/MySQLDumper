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
     * @param string $filename Name of file to read
     * 
     * @param array
     */
    public static function getStatusline($filename)
    {
        $config = Msd_Configuration::getInstance();
        $path = $config->get('paths.backup'). DS;
        if (strtolower(substr($filename, -3)) == '.gz') {
            $fileHandle = gzopen($path . $filename, "r");
            if ($fileHandle === false) {
                throw new Exception('Can\'t open file '.$filename);
            }
            $statusline = gzgets($fileHandle, 40960);
            gzclose($fileHandle);
        } else {
            $fileHandle=fopen($path . $filename, "r");
            if ($fileHandle === false) {
                throw new Exception('Can\'t open file '.$filename);
            }
            $statusline = fgets($fileHandle, 5000);
            fclose($fileHandle);
        }
        return self::_explodeStatusline($statusline);
    }

    /**
     * Get information from stausline string
     * 
     * @param string $line
     * 
     * @return array
     */
    private function _explodeStatusline($line)
    {
        /*Construction of statusline (first line in backup file):
            -- Status : NrOfTables : nrOfRecords : Multipart : DatabaseName : 
            script : scriptversion : Comment : MySQLVersion : 
            Backupflags (unused): SQLBefore : SQLAfter : Charset : EXTINFO
        */
        $statusline = array();
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
            $statusline['tables'] = $flag[1];
            $statusline['records'] = $flag[2];
            if ($flag[3] == '' || $flag[3] == 'MP_0') {
                $statusline['part']= 'MP_0';
            } else {
                $statusline['part'] = $flag[3];
            }
            $statusline['dbname'] = $flag[4];
            $statusline['script'] = $flag[5];
            $statusline['scriptversion'] = $flag[6];
            $statusline['comment'] = $flag[7];
            $statusline['mysqlversion'] = $flag[8];
            $statusline['flags'] = $flag[9];
            $statusline['sqlbefore'] = $flag[10];
            $statusline['sqlafter'] = $flag[11];
            if ( isset($flag[12]) && trim($flag[12])!='EXTINFO') {
                $statusline['charset']=$flag[12];
            } else {
                $statusline['charset']='?';
            }
        }
        return $statusline;
    }

    /**
     * Get default statusline
     * 
     * @return array
     */
    private function _getDefaultStatusline()
    {
        $statusline['tables'] = -1;
        $statusline['records'] = -1;
        $statusline['part'] = 'MP_0';
        $statusline['dbname'] = 'unknown';
        $statusline['script'] = '';
        $statusline['scriptversion'] = '';
        $statusline['comment'] = '';
        $statusline['mysqlversion'] = 'unknown';
        $statusline['flags'] = '2222222';
        $statusline['sqlbefore'] = '';
        $statusline['sqlafter'] = '';
        $statusline['charset'] = '?';
        return $statusline;
    }
    
}
