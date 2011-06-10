<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1213 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
if (!defined('MSD_VERSION'))
    die('No direct access.');
/**
 * Build order array from string
 *
 * key1,type1|key2,type2| ...
 *
 * d= sort key as string descending
 * D= sort key as float ascending
 * a= sort key as string ascending
 * A= sort key as floatval ascending
 *
 * @param string $order
 * @return array order-array
 */
/**
 * Simple debug output for objects and arrays
 * @param mixed
 *
 * @return void
 */
    if (!function_exists('v')) {
function v($t)
{
    echo '<br />';
    if (is_array($t) || is_object($t)){
        echo '<pre style="font-size:12px;">';
        print_r($t);
        echo '</pre>';
    }else
        echo $t;
}
    }
/**
 * Detect server protocol
 *
 * @return string 'https://' || 'http://'
 */
function getServerProtocol()
{
    return (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
}
/**
 * Build order array from string 'col1,A|col2,d' for function arfosort
 *
 * @param string $order Orderstring
 *
 * @return array
 */
function get_orderarray($order)
{
    $order_arr = array();
    $orders = explode('|', $order);
    foreach ($orders as $o){
        $d = explode(',', $o);
        if (isset($d[0]) && isset($d[1]))
            $order_arr[] = array($d[0], $d[1]);
    }
    return $order_arr;
}
/**
 * Order multidimensial array
 *
 * @param array  $a  Array to sort
 * @param string $fl Order-string to define what keys should be sortet in what direction
 *
 * @return array Sorted array
 */
function arfsort($a, $fl)
{
    $GLOBALS['__ARFSORT_LIST__'] = $fl;
    usort($a, 'arfsort_func');
    return $a;
}
/**
 * Sort a multidimenional array no matter in which depth the key is
 *
 * @param array  $a Array to sort
 * @param string $b Sortstring containing keys and kind of sorting
 *
 * @return mixed
 */
function arfsort_func($a, $b)
{
    foreach ($GLOBALS['__ARFSORT_LIST__'] as $f){
        if (isset($b[$f[0]]) && isset($a[$f[0]])){
            switch ($f[1]){ // switch on ascending or descending value
                case 'd':
                    $strc = strcmp(strtolower($b[$f[0]]), strtolower($a[$f[0]]));
                    if ($strc != 0)
                        return $strc;
                    break;
                case 'a':
                    $strc = strcmp(strtolower($a[$f[0]]), strtolower($b[$f[0]]));
                    if ($strc != 0)
                        return $strc;
                    break;
                case 'D':
                    $strc = (floatval($b[$f[0]]) < floatval($a[$f[0]])) ? -1 : 1;
                    if ($b[$f[0]] != $a[$f[0]])
                        return $strc;
                    break;
                case 'A':
                    $strc = (floatval($b[$f[0]]) > floatval($a[$f[0]])) ? -1 : 1;
                    if ($b[$f[0]] != $a[$f[0]])
                        return $strc;
                    break;
            }
        }
    }
    return 0;
}
/**
 * Read table information about nr of records and more for given database name.
 * Return array with advsanced information.
 *
 * @param string $db    The database name to read info from
 * @param string $table If set, only information for this table is filled
 *
 * @return array
 */
function getTableInfo($db, $table = '')
{
    global $dbo, $config;
    $tableInfos=array();
    $res = $dbo->selectDb($db);
    if ($res){
        $query = 'SHOW TABLE STATUS FROM `' . $db . '`';
        if ($table > '') {
            $query .= ' LIKE \'' . $table . '\'';
        }
        $res = $dbo->query($query, MsdDbFactory::ARRAY_ASSOC);
        // init index if not set
        if (!isset($tableInfos[$db]))
            $tableInfos[$db] = array();
        if (!isset($tableInfos[$db]['tables']))
            $tableInfos[$db]['tables'] = array();
        $tableInfos[$db]['table_count'] = sizeof($res);
        $tableInfos[$db]['records_total'] = 0;
        $tableInfos[$db]['datasize_total'] = 0;
        $tableInfos[$db]['size_total'] = 0;
        if ($tableInfos[$db]['table_count'] > 0){
            for ($i = 0, $max = $tableInfos[$db]['table_count']; $i < $max; $i++){
                $row = $res[$i];
                $n = $row['Name'];
                if (!isset($tableInfos[$db]['tables'][$n]))
                    $tableInfos[$db]['tables'][$row['Name']] = array();
                if (isset($row['Type']))
                    $row['Engine'] = $row['Type'];
                $tableInfos[$db]['tables'][$n]['name'] = $row['Name'];
                $tableInfos[$db]['tables'][$n]['engine'] = $row['Engine'];
                $tableInfos[$db]['tables'][$n]['dump_structure'] = 1;
                $tableInfos[$db]['tables'][$n]['dump_records'] = 1;
                // if we have a VIEW or a table of Type MEMORY -> don't save records
                if (strtoupper($row['Comment']) == 'VIEW' || (isset($row['Engine']) && in_array(strtoupper($row['Engine']), array(
                    'MEMORY')))){
                    $tableInfos[$db]['tables'][$n]['dump_records'] = 0;
                }
                if (!isset($row['Update_time']))
                    $row['Update_time'] = '';
                $tableInfos[$db]['tables'][$n]['update_time'] = $row['Update_time'];
                $tableInfos[$db]['tables'][$n]['data_free'] = isset($row['Data_free']) ? $row['Data_free'] : 0;
                $tableInfos[$db]['tables'][$n]['collation'] = isset($row['Collation']) ? $row['Collation'] : '';
                $tableInfos[$db]['tables'][$n]['comment'] = isset($row['Comment']) ? $row['Comment'] : '';
                $tableInfos[$db]['tables'][$n]['auto_increment'] = isset($row['Auto_increment']) ? $row['Auto_increment'] : '';
                $tableInfos[$db]['tables'][$n]['records'] = (int) $row['Rows'];
                $tableInfos[$db]['tables'][$n]['data_length'] = (float) $row['Data_length'];
                $tableInfos[$db]['tables'][$n]['index_length'] = $row['Index_length'];
                $tableInfos[$db]['records_total'] += (int) $row['Rows'];
                $tableInfos[$db]['datasize_total'] += (float) $row['Data_length'];
                $tableInfos[$db]['size_total'] += (float) $row['Data_length'] + (float) $row['Index_length'];
            }
        }
    }
    return $tableInfos;
}
/**
 * Returns microtime of now as float value
 *
 * @return float microtime
 */
function getMicrotime()
{
    list ($usec, $sec) = explode(' ', microtime());
    return ((float) $usec + (float) $sec);
}
/**
 * Detect free diskspace
 *
 * @return string Space in human readable Bytes or message if not available
 */
function getFreeDiskSpace()
{
    global $lang;
    $dfs = @diskfreespace("../");
    return ($dfs) ? byteOutput($dfs) : $lang['L_NOTAVAIL'];
}
/**
 * Extract timestamp informations from a filename and return formatted string YYYY.MM.DD HH:MM
 *
 * @param string $s Filename as input 'dbname_2009_10_18_16_22_part1_sql-gz'
 *
 * @return string Formated timestamp YYYY.MM.DD HH:MM
 */
function getTimestampFromFilename($s)
{
    $i = strpos(strtolower($s), 'part');
    if ($i > 0)
        $s = substr($s, 0, $i - 1);
    $i = strpos(strtolower($s), 'crondump');
    if ($i > 0)
        $s = substr($s, 0, $i - 1);
    $i = strpos(strtolower($s), '.sql');
    if ($i > 0)
        $s = substr($s, 0, $i);
    $sp = explode('_', $s);
    $anz = count($sp) - 1;
    if (strtolower($sp[$anz]) == 'perl')
        $anz--;
    if ($anz > 4){
        return $sp[$anz - 2] . '.' . $sp[$anz - 3] . '.' . $sp[$anz - 4] . ' ' . $sp[$anz - 1] . ':' . $sp[$anz];
    }else{
        //no MySQLDumper file
        return '';
    }
}
/**
 * Writes errors or notices to the corresponding error log
 *
 * @param string $db    Affected database
 * @param string $sql   The executed query
 * @param string $error The error message to log
 * @param int    $art   The kind of error (0=error, 1=notice)
 *
 * @return void
 */
function writeToErrorLog($db = '', $sql = '', $error = '', $art = 1)
{
    global $config, $lang, $log;
    $sql = str_replace("\r", '', $sql);
    $sql = str_replace("\n\n", '<br>', $sql);
    $sql = str_replace("\n", '<br>', $sql);
    $sql = trim($sql);
    $error = str_replace("\r", '', $error);
    if ($art == 0) {
        $errormsg = $lang['L_ERROR'] . ': ' . $error;
    } else {
        $errormsg = $lang['L_NOTICE'] . ': ' . $error;
    }
    // append query if set
    if ($sql > '') {
        $errormsg .= '<br>SQL: ' . $sql;
    }
    $time = date('d.m.Y H:i:s') . ' ';
    if ($art == 0) {
        $_SESSION['log']['errors'][] = $time.$errormsg;
    } else {
        $_SESSION['log']['notices'][] = $time.$errormsg;
    }
    $log->write(Log::ERROR, $errormsg);
}
/**
 * Checks if the directories work, config, backup and log are writable
 * Returns concatenated string with warnings or empty string if every directory is writable
 *
 * @return string
 */
function checkDirectories()
{
    global $config, $lang;
    $warn = '';
    if (!is_writable($config['paths']['work']))
        $warn .= sprintf($lang['L_WRONG_RIGHTS'], $config['paths']['work'], '0777');
    if (!is_writable($config['paths']['config']))
        $warn .= sprintf($lang['L_WRONG_RIGHTS'], $config['paths']['config'], '0777');
    if (!is_writable($config['paths']['backup']))
        $warn .= sprintf($lang['L_WRONG_RIGHTS'], $config['paths']['backup'], '0777');
    if (!is_writable($config['paths']['log']))
        $warn .= sprintf($lang['L_WRONG_RIGHTS'], $config['paths']['log'], '0777');
    if ($warn != '')
        $warn = '<span class="warnung"><strong>' . $warn . '</strong></span>';
    return $warn;
}
/**
 * Deletes every table or view in a database
 *
 * @param string $dbn Databasename
 *
 * @return void
 */
function truncateDb($dbn)
{
    global $dbo;
    $t_sql = array();
    $dbo->query('SET FOREIGN_KEY_CHECKS=0', MsdDbFactory::SIMPLE);
    $res = $dbo->query('SHOW TABLE STATUS FROM `' . $dbn . '`', MsdDbFactory::ARRAY_ASSOC);
    foreach ($res as $row){
        if (substr(strtoupper($row['Comment']), 0, 4) == 'VIEW'){
            $t_sql[] = 'DROP VIEW `' . $dbn . '``' . $row['Name'] . '`';
        }else{
            $t_sql[] = 'DROP TABLE `' . $dbn . '`.`' . $row['Name'] . '`';
        }
    }
    if (sizeof($t_sql) > 0){
        for ($i = 0; $i < count($t_sql); $i++){
            try{
                $dbo->query($t_sql[$i]);
            }catch (Excption $e){
                //TODO create clean error handling depending on context
                writeToErrorLog($e->getMessage());
                die($e->getMessage());
            }
        }
    }
    $dbo->query('SET FOREIGN_KEY_CHECKS=1', MsdDbFactory::SIMPLE);
}
/**
 * Delete old backups from folder work/backup according to configuration
 *
 * @return string Outputstring with messages about deleted files
 */
function doAutoDelete()
{
    global $config, $lang, $out;
    $out = '';
    if ($config['auto_delete']['max_backup_files'] > 0){
        //Files einlesen
        $dh = opendir($config['paths']['backup']);
        $files = array();
        // Build assoc Array $db=>$timestamp=>$filenames
        if (!function_exists('ReadStatusline'))
            include ('./inc/functions/functions_files.php');
        while (false !== ($filename = readdir($dh))){
            if ($filename != '.' && $filename != '..' && !is_dir($config['paths']['backup'] . $filename)){
                $statusline = readStatusline($filename);
                if ($statusline['dbname'] != 'unknown'){
                    $dbName = $statusline['dbname'];
                    $datum = substr($filename, strlen($dbName) + 1);
                    $timestamp = substr($datum, 0, 16);
                    if (!isset($files[$dbName]))
                        $files[$dbName] = array();
                    if (!isset($files[$dbName][$timestamp]))
                        $files[$dbName][$timestamp] = array();
                    $files[$dbName][$timestamp][] = $filename;
                }
            }
        }
        $out = ''; // stores output messages
        // Backups per DB and Timestamp
        foreach ($files as $db => $val){
            if (sizeof($val) > $config['auto_delete']['max_backup_files']){
                $db_files = $val;
                krsort($db_files, SORT_STRING);
                //now latest backupfiles are on top -> delete all files with greater index
                $i = 0;
                foreach ($db_files as $timestamp => $filenames){
                    if ($i >= $config['auto_delete']['max_backup_files']){
                        // Backup too old -> delete files
                        foreach ($filenames as $f){
                            if ($out == '')
                                $out .= $lang['L_FM_AUTODEL1'] . '<br />';
                            if (@unlink('./' . $config['paths']['backup'] . $f)){
                                $out .= '<span class="success">' . sprintf($lang['L_DELETE_FILE_SUCCESS'], $f) . '</span><br />';
                            }else{
                                $out .= $lang['L_ERROR'] . ': <p class="error">' . sprintf($lang['L_DELETE_FILE_ERROR'], $f) . '</p><br />';
                            }
                        }
                    }
                    $i++;
                }
            }
        }
    }
    return $out;
}
/**
 * Analyzes the first line of a MSD-Backup. Expects it as string parameter.
 *
 * @param string $line The statusline from the backup to analyze
 *
 * @return array Extracted information as array
 */
function readStatusline($filename)
{
    global $config;
    /*AUFBAU der Statuszeile:
     -- Status:nr of tables:records:Multipart:Databasename:script:scriptversion:Comment:
     MySQL-Version:flags (unused):SQLCommandBeforeBackup:SQLCommandAfterBackup:Charset:EXTINFO
     */
    $gz = substr($filename, -3) == '.gz' ? true : false;
    $fh = $gz ? gzopen($config['paths']['backup'] . $filename, 'r') : fopen($config['paths']['backup'] . $filename, 'r');
    if (!$fh){
        v(debug_backtrace());
        die();
    }
    $line = $gz ? gzgets($fh) : fgets($fh);
    $gz ? gzclose($fh) : fclose($fh);
    $statusline = array();
    $line = removeBom($line);
    if ((substr($line, 0, 8) != "# Status" && substr($line, 0, 9) != "-- Status") || substr($line, 0, 10) == '-- StatusC'){
        //Fremdfile
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
    }else{
        // MySQLDumper-File - Informationen extrahieren
        $s = explode(':', $line);
        if (count($s) < 12){
            //fehlenden Elemente auffüllen
            $c = count($s);
            array_pop($s);
            for ($i = $c - 1; $i < 12; $i++){
                $s[] = '';
            }
        }
        $statusline['tables'] = $s[1];
        $statusline['records'] = $s[2];
        $statusline['part'] = ($s[3] == '' || $s[3] == 'MP_0') ? 'MP_0' : $s[3];
        $statusline['dbname'] = $s[4];
        $statusline['script'] = $s[5];
        $statusline['scriptversion'] = $s[6];
        $statusline['comment'] = $s[7];
        $statusline['mysqlversion'] = $s[8];
        if ((isset($s[12])) && trim($s[12]) != 'EXTINFO'){
            $statusline['charset'] = $s[12];
        }else{
            $statusline['charset'] = '?';
        }
    }
    return $statusline;
}
/**
 * Reads Head-Information about tables from MSD-Backup and returns it as array
 *
 * @param string $filename Filename of MSD-Backup to analyze
 *
 * @return array Detailed information about tables n MSD-Backup
 */
function getTableHeaderInfoFromBackup($filename)
{
    global $config;
    // Get Tableinfo from file header
    $tabledata = array();
    $i = 0;
    $gz = substr($filename, -3) == '.gz' ? true : false;
    $fh = $gz ? gzopen($config['paths']['backup'] . $filename, 'r') : fopen($config['paths']['backup'] . $filename, 'r');
    $eof = false;
    WHILE (!$eof){
        $line = $gz ? gzgets($fh, 40960) : fgets($fh, 40960);
        $line = trim($line);
        if (substr($line, 0, 9) == '-- TABLE|'){
            $d = explode('|', $line);
            $tabledata[$i]['name'] = $d[1];
            $tabledata[$i]['records'] = $d[2];
            $tabledata[$i]['size'] = $d[3];
            $tabledata[$i]['update'] = $d[4];
            $tabledata[$i]['engine'] = isset($d[5]) ? $d[5] : '';
            $i++;
        }elseif (substr($line, 0, 6) == '-- EOF')
            $eof = true; // End of Table-Info - >done
        elseif (substr(strtolower($line), 0, 6) == 'create')
            $eof = true; // we have found the first CREATE-Query -> done
    }
    $gz ? gzclose($fh) : fclose($fh);
    return $tabledata;
}
/**
 * Calculate next Multipart-Filename
 *
 * @param string $filename The filename to calculate the next name from
 *
 * @return string Filename of next Multipart-File
 */
function getNextPart($filename)
{
    $nf = explode('_', $filename);
    $i = array_search('part', $nf) + 1;
    $part = substr($nf[$i], 0, strpos($nf[$i], '.'));
    $ext = substr($nf[$i], strlen($part));
    $nf[$i] = ++$part . $ext;
    $filename = implode('_', $nf);
    return $filename;
}
/**
 * Formats seconds to human readable output
 *
 * @param integer $time Time in seconds
 *
 * @return string Time as human readable formatted string
 */
function getTimeFormat($time)
{
    global $lang;
    $d = floor($time / 86400);
    $h = floor(($time - $d * 86400) / 3600);
    $m = floor(($time - $d * 86400 - $h * 3600) / 60);
    $s = $time - $d * 86400 - $h * 3600 - $m * 60;
    $ret = sprintf('%02d', $s) . ' ' . ($s == 1 ? $lang['L_SECOND'] : $lang['L_SECONDS']);
    if ($m > 0){
        $ret = $m . ' ' . ($m == 1 ? $lang['L_MINUTE'] : $lang['L_MINUTES']) . ' ' . $ret;
    }
    if ($h > 0){
        $ret = $h . ' ' . ($h == 1 ? $lang['L_HOUR'] : $lang['L_HOURS']) . ' ' . $ret;
    }
    if ($d > 0){
        $ret = $d . ' ' . ($d == 1 ? $lang['L_DAY'] : $lang['L_DAYS']) . ' ' . $ret;
    }
    return $ret;
}
/**
 * Tests a ftp-connection and returns messages about uccess or failure
 *
 * @param integer $i The index of the connection profile to test
 *
 * @return array Array with messages
 */
function testFTP($i)
{
    global $lang, $config;
    if (!isset($config['ftp'][$i]['timeout']))
        $config['ftp'][$i]['timeout'][$i] = 30;
    $ret = array();
    if ($config['ftp'][$i]['port'] == '' || $config['ftp'][$i]['port'][$i] == 0)
        $config['ftp'][$i]['port'] = 21;
    $pass = -1;
    if (!extension_loaded("ftp")){
        $ret[] = '<span class="error">' . $lang['L_NOFTPPOSSIBLE'] . '</span>';
    }else
        $pass = 0;
    if ($pass == 0){
        if ($config['ftp'][$i]['server'] == '' || $config['ftp'][$i]['user'] == ''){
            $ret[] = '<span class="error">' . $lang['L_WRONGCONNECTIONPARS'] . '</span>';
        }else
            $pass = 1;
    }
    if ($pass == 1){
        if ($config['ftp'][$i]['ssl'] == 0)
            $conn_id = @ftp_connect($config['ftp'][$i]['server'], $config['ftp'][$i]['port'], $config['ftp'][$i]['timeout']);
        else
            $conn_id = @ftp_ssl_connect($config['ftp'][$i]['server'], $config['ftp'][$i]['port'], $config['ftp'][$i]['timeout']);
        if (is_resource($conn_id)){
            $ret[] = sprintf($lang['L_FTP_CONNECTION_SUCCESS'], $config['ftp'][$i]['server'], $config['ftp'][$i]['port']);
        }else
            $ret[] = sprintf($lang['L_FTP_CONNECTION_ERROR'], $config['ftp'][$i]['server'], $config['ftp'][$i]['port']);
        if ($conn_id){
            $login_result = @ftp_login($conn_id, $config['ftp'][$i]['user'], $config['ftp'][$i]['pass']);
            if ($login_result)
                $ret[] = sprintf($lang['L_FTP_LOGIN_SUCCESS'], $config['ftp'][$i]['user']);
            else
                $ret[] = sprintf($lang['L_FTP_LOGIN_ERROR'], $config['ftp'][$i]['user']);
        }
        if ($conn_id && $login_result){
            $pass = 2;
            if ($config['ftp'][$i]['mode'] == 1){
                if (ftp_pasv($conn_id, true))
                    $ret[] = $lang['L_FTP_PASV_SUCCESS'];
                else
                    $ret[] = $lang['L_FTP_PASV_ERROR'];
            }
        }
    }
    if ($pass == 2){
        $dirc = @ftp_chdir($conn_id, $config['ftp'][$i]['dir']);
        if (!$dirc){
            $ret[] = $lang['L_CHANGEDIR'] . ' \'' . $config['ftp'][$i]['dir'] . '\' -> <span class="error">' . $lang['L_CHANGEDIRERROR'] . '</span>';
        }else{
            $pass = 3;
            $ret[] = $lang['L_CHANGEDIR'] . ' \'' . $config['ftp'][$i]['dir'] . '\' -> <span class="success">' . $lang['L_OK'] . '</span>';
        }
        @ftp_close($conn_id);
    }
    if ($pass == 3)
        $ret[] = '<span class="success"><strong>' . $lang['L_FTP_OK'] . '</strong></span>';
    return implode('<br />', $ret);
}
/**
 * Returns list of configuration profiles as HTML-Optionlist
 *
 * @param string $selected_config The actual configuration to pre-select in option list
 *
 * @return string HTML-option-string
 */
function getConfigFilelist($selected_config)
{
    $configs = getConfigFilenames();
    $options = Html::getOptionlist($configs, $selected_config);
    return $options;
}
/**
 * Returns list of installed themes as HTML-Optionlist
 *
 * @return string HTML-option-string
 */
function getThemes()
{
    global $config;
    $themes = array();
    $dh = opendir($config['paths']['root'] . "css/");
    while (false !== ($filename = readdir($dh))){
        if ($filename != '.' && $filename != '..' && is_dir($config['paths']['root'] . 'css/' . $filename) && substr($filename, 0, 1) != '.' && substr($filename, 0, 1) != '_'){
            $themes[$filename] = $filename;
        }
    }
    @ksort($themes);
    $options = Html::getOptionlist($themes, $config['theme']);
    return $options;
}
/**
 * Detects all language-directories and builds HTML-Optionlist
 *
 * @return string HTML-option-string
 */
function getLanguageCombo()
{
    global $config, $lang;
    $default = $config['language'];
    $dh = opendir('./language/');
    $r = "";
    $lang_files = array();
    while (false !== ($filename = readdir($dh))){
        if ($filename != '.' && $filename != '.svn' && $filename != '..' && $filename != 'flags' && is_dir('./language/' . $filename)){
            if (isset($lang[$filename]))
                $lang_files[$lang[$filename]] = $filename;
        }
    }
    @ksort($lang_files);
    foreach ($lang_files as $filename){
        $style = 'background:url(language/flags/width25/' . $filename . '.gif) 4px;background-repeat:no-repeat;padding:2px 6px 2px 36px !important;';
        $r .= '<option value="' . $filename . '" style="' . $style . '"';
        $r .= Html::getSelected($filename, $default);
        $r .= '>' . $lang[$filename] . '</option>' . "\n";
    }
    return $r;
}
/**
 * Detects language subdirs and adds them to the global definition of $lang
 *
 * @return void
 */
function getLanguageArray()
{
    global $lang;
    $dh = opendir('./language/');
    if (isset($lang['languages']))
        unset($lang['languages']);
    $lang['languages'] = array();
    while (false !== ($filename = readdir($dh))){
        if ($filename != '.' && $filename != '.svn' && $filename != ".." && $filename != "flags" && is_dir('./language/' . $filename)){
            $lang['languages'][] = $filename;
        }
    }
}
/**
 * Sets database and tablenames into backticks
 *
 * @param string $s Querystring
 *
 * @return string Querystring with backticks
 */
function setBackticks($s)
{
    $klammerstart = $lastklammerstart = $end = 0;
    $inner_s_start = strpos($s, '(');
    $inner_s_end = strrpos($s, ')');
    $inner_s = substr($s, $inner_s_start + 1, $inner_s_end - (1 + $inner_s_start));
    $pieces = explode(',', $inner_s);
    for ($i = 0; $i < count($pieces); $i++){
        $r = trim($pieces[$i]);
        $klammerstart += substr_count($r, "(") - substr_count($r, ")");
        if ($i == count($pieces) - 1)
            $klammerstart += 1;
        if (substr(strtoupper($r), 0, 4) == "KEY " || substr(strtoupper($r), 0, 7) == "UNIQUE " || substr(strtoupper($r), 0, 12) == "PRIMARY KEY " || substr(strtoupper($r), 0, 13) == "FULLTEXT KEY "){
            //nur ein Key
            $end = 1;
        }else{
            if (substr($r, 0, 1) != '`' && substr($r, 0, 1) != '\'' && $klammerstart == 0 && $end == 0 && $lastklammerstart == 0){
                $pos = strpos($r, ' ');
                $r = '`' . substr($r, 0, $pos) . '`' . substr($r, $pos);
            }
        }
        $pieces[$i] = $r;
        $lastklammerstart = $klammerstart;
    }
    $back = substr($s, 0, $inner_s_start + 1) . implode(',', $pieces) . ');';
    return $back;
}
//
/**
 * Returns the index of the selected value in an array
 *
 * @param array  $arr      The Array to get the index from
 * @param string $selected The value to find the index for
 *
 * @return mixed Found Index or false
 */
function getIndexFromValue($arr, $selected)
{
    $ret = false; // return false if not found
    foreach ($arr as $key => $val){
        if (strtolower(substr($val, 0, strlen($selected))) == strtolower($selected)){
            $ret = $key;
            break;
        }
    }
    return $ret;
}
/**
 * Checks if config is readable and loads it
 * Expects only the name of the configuration (not the path or complete filename)
 *
 * Returns true on success or false on failure
 *
 * @param string  $file                Name of configuration without extension
 * @param boolean $redirect_to_install Decide if user should be redirected to installation if config doesn't exist
 *
 * @return boolean
 */
function getConfig($file = '', $redirect_to_install = true)
{
    global $config, $databases;
    if (!isset($_SESSION['config_file']))
        $_SESSION['config_file'] = 'mysqldumper';
    if ($file == '')
        $file = $_SESSION['config_file'];
    $ret = false;
    // protect from including external files
    $search = array(':', 'http', 'ftp', ' ', '/', '\\');
    $replace = array('', '', '', '', '', '');
    $file = str_replace($search, $replace, $file);
    clearstatcache();
    if ($redirect_to_install && !is_readable('./' . $config['paths']['config'] . $file . '.php') && $file == 'mysqldumper'){
        header('Location: install.php');
        exit();
    }
    if (!is_readable('./' . $config['paths']['config'] . $file . '.php'))
        $file = 'mysqldumper';
    if (is_readable('./' . $config['paths']['config'] . $file . '.php')){
        $databases = array(); // reset databaselist - will be read from config file
        $c = implode('', file('./' . $config['paths']['config'] . $file . '.php'));
        $c = str_replace('<?php', '', $c);
        eval($c);
        $config['config_file'] = $file;
        $_SESSION['config_file'] = $file;
        $_SESSION['config'] = $config; // $config is defined in read file
        $_SESSION['databases'] = $databases; // $databases is defined in read file
        $config['files']['iconpath'] = './css/' . $config['theme'] . '/icons/';
        $ret = true;
    }
    return $ret;
}
/**
 * Get all names of configuration files located in /work/config directory
 *
 * @return array
 */
function getConfigFilenames()
{
    global $config;
    $configs = array();
    $dh = opendir('./' . $config['paths']['config']);
    while (false !== ($filename = readdir($dh))){
        if (substr($filename, -4) == '.php' && substr($filename, -9) != '.conf.php' && $filename != 'dbs_manual.php'){
            $index = substr($filename, 0, -4);
            $configs[$index] = $index;
        }
    }
    @ksort($configs);
    return $configs;
}
/**
 * Loads data from an external source via HTTP-socket
 *
 * Loads data from an external source $url given as URL
 * and returns the content as a binary string or false on connection error
 *
 * @param string $url URL to fetch
 *
 * @return string file data or false
 */
function getFileDataFromURL($url)
{
    $url_parsed = parse_url($url);
    $data = false;
    $host = $url_parsed['host'];
    $port = isset($url_parsed['port']) ? intval($url_parsed['port']) : 80;
    if ($port == 0)
        $port = 80;
    $path = $url_parsed['path'];
    if (!isset($url_parsed['scheme']))
        $url_parsed['scheme'] = 'http';
    if (!isset($url_parsed['path']))
        $url_parsed['path'] = '/';
    if (isset($url_parsed['query']) && $url_parsed['query'] != '')
        $path .= '?' . $url_parsed['query'];
    $fp = @fsockopen($host, $port, $errno, $errstr, 10);
    if ($fp){
        $out = "GET $path HTTP/1.0\r\n";
        $out .= "Host: $host\r\n";
        $out .= 'Referer: ' . $url_parsed['scheme'] . '://' . $_SERVER['SERVER_NAME'] . $path . "\r\n";
        $out .= 'User-Agent: MySQLDumper ' . MSD_VERSION . "\r\n";
        $out .= "Connection: close\r\n\r\n";
        @fwrite($fp, $out);
        $body = false;
        $data = '';
        while (!feof($fp)){
            $s = fgets($fp, 1024);
            if ($body)
                $data .= $s;
            if ($s == "\r\n"){
                $body = true;
            }
        }
        fclose($fp);
    }
    return $data;
}
/**
 * Recursevely detects differences of multidimensional arrays
 * and returns a new array containing all differences. Indexes that exists in both arrays are skipped.
 * (e.g. used to detect differences between the complete SESSION['log'] and the built log of a page-call
 * in ajax-functions to only return the last changes to the client)
 *
 * @param array $array1 Array1
 * @param array $array2 Array2
 *
 * @return array Array with differences
 */
function getArrayDiffAssocRecursive($array1, $array2)
{
    foreach ($array1 as $key => $value){
        if (is_array($value)){
            if (!isset($array2[$key]))
                $difference[$key] = $value;
            elseif (!is_array($array2[$key]))
                $difference[$key] = $value;
            else{
                $new_diff = getArrayDiffAssocRecursive($value, $array2[$key]);
                if ($new_diff != FALSE)
                    $difference[$key] = $new_diff;
            }
        }elseif (!isset($array2[$key]) || $array2[$key] != $value)
            $difference[$key] = $value;
    }
    return !isset($difference) ? 0 : $difference;
}
/**
 * Gets value in associative array by indexnr
 *
 * @param array $array
 * @param mixed $index Index
 *
 * @return string
 */
function getValueFromIndex($array, $index)
{
    $array_keys = array_keys($array);
    if (isset($array_keys[$index]))
        return $array_keys[$index];
    else
        return false;
}
/**
 * Gets the next key in an associative array and returns it.
 * If it was the last key return false
 *
 * @param array  $array Array
 * @param string $key   current Index
 *
 * @return mixed
 */
function getNextKey($array, $key)
{
    $array_keys = array_keys($array);
    $array_flip = array_flip($array_keys);
    $index = $array_flip[$key];
    $index++;
    if ($index < sizeof($array_keys))
        return $array_keys[$index];
    else
        return false;
}
/**
 * Detect Byte Order Mark (BOM) and remove it if found
 *
 * @param string $str String
 *
 * @return string
 */
function removeBom($str)
{
    $bom = pack('CCC', 0xef, 0xbb, 0xbf);
    if (0 == strncmp($str, $bom, 3)){
        $str = substr($str, 3);
    }
    return $str;
}