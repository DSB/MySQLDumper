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

/**
 * Output human readable Byte-Values
 *
 * @param integer $bytes   Bytes to convert to human readable format
 * @param boolean $useHTML Decides whether explaining span-tags should surround
 *                         the returned string
 *
 * @return string human readable output
 */
function byteOutput($bytes, $useHTML = true)
{
    $precision = 2;
    if (!is_numeric($bytes) || $bytes < 0) {
        return false;
    }
    for ($level = 0; $bytes >= 1024; $level++) {
        $bytes /= 1024;
    }
    switch ($level)
    {
        case 0:
            $suffix = '<span class="explain" title="Bytes">B</span>';
            break;
        case 1:
            $suffix = '<span class="explain" title="KiloBytes">KB</span>';
            break;
        case 2:
            $suffix = '<span class="explain" title="MegaBytes">MB</span>';
            break;
        case 3:
            $suffix = '<span class="explain" title="GigaBytes">GB</span>';
            break;
        case 4:
            $suffix = '<span class="explain" title="TeraBytes">TB</span>';
            break;
        case 5:
            $suffix = '<span class="explain" title="PetaBytes">PB</span>';
            break;
        case 6:
            $suffix = '<span class="explain" title="ExaBytes">EB</span>';
            break;
        case 7:
            $suffix = '<span class="explain" title="YottaBytes">ZB</span>';
            break;

        default:
            $suffix = '';
            break;
    }
    if (!$useHTML) {
        $suffix = strip_tags($suffix);
    }
    $ret = sprintf("%01." . $precision . "f", round($bytes, $precision));
    return  $ret . ' ' . $suffix;
}

/**
 * Delete Multipart files
 *
 * @param string $dir    Directory to check
 * @param string $prefix Only check files with this prefix
 * @param string $suffix Only check files with this suffix
 *
 * @return array Array $file['filename']=true | false
 */
function deleteMultipartFiles($dir, $prefix = '', $suffix = '')
{
    $deleted = array();
    if (substr($dir, -1) != '/') {
        $dir .= '/';
    }
    if (is_dir($dir)) {
        $d = opendir($dir);
        while ($file = readdir($d)) {
            if (is_file($dir . $file)) {
                $del = false;
                if ($prefix > '' && substr($file, 0, strlen($prefix)) == $prefix) $del = true;
                if ($suffix > '' && substr($file, strlen($file) - strlen($suffix), strlen($suffix)) == $suffix) $del = true;
                if ($del)
                {
                    if (unlink($dir . $file)) $deleted[$file] = true;
                    else $deleted[$file] = false;
                }
            }
        }
        closedir($d);
        return $deleted;
    }
}

/**
 * Add a database to the global $databases-Array and set necessary indexes
 *
 * @param string $db_name Databaase-Name
 * @param string $praefix Table-Prefix
 * @param string $cbd     Command before Dump
 * @param string $cad     Command after Dump
 *
 * @return void
 */
function addDatabaseToConfig($db_name)
{
    global $databases;
    if (!isset($databases)) $databases = array();
    if (!isset($databases[$db_name])) $databases[$db_name] = array();
    if (!isset($databases[$db_name]['dump'])) $databases[$db_name]['dump'] = 0;
    if (!isset($databases[$db_name]['prefix'])) $databases[$db_name]['prefix'] = '';
    if (!isset($databases[$db_name]['command_before_dump'])) $databases[$db_name]['command_before_dump'] = '';
    if (!isset($databases[$db_name]['command_after_dump'])) $databases[$db_name]['command_after_dump'] = '';
}

/**
 * Check settings of language, config file, reloads list of databases and save result to configuration
 *
 * @return string String with checked and added databases
 */
function setDefaultConfig()
{
    global $config, $databases, $out, $lang, $dbo;

    // check language and fallback to englisch if language file is not readable
    $lang_file = './language/' . $config['language'] . '/lang.php';
    if (!file_exists($lang_file) || !is_readable($lang_file))
    {
        $config['language'] = 'en';
    }
    include ('./language/' . $config['language'] . '/lang.php');

    getConfig($config['config_file']); // falls back to config mysqldumper if something is wrong
    // get list of databases for this user
    $dbUser = $dbo->getDatabases();
    foreach ($dbUser as $db)
    {
        // new found db?  -> add it
        if (!isset($databases[$db])) $databases[$db] = array();
    }
    ksort($databases);
    foreach ($databases as $db_name => $val)
    {
        if ($dbo->selectDb($db_name, true))
        {
            addDatabaseToConfig($db_name);
            $out .= $lang['L_SAVING_DB_FORM'] . " " . $db_name . " " . $lang['L_ADDED'] . "\n";
        }
        else
        unset($databases[$db_name]);
    }
    saveConfig();
    return $out;
}

/**
 * Save actual configuration to file
 *
 * @return boolean
 */
function saveConfig()
{
    global $config, $databases, $configDontsave;

    $config['multipart_groesse'] = $config['multipartgroesse1'] * (($config['multipartgroesse2'] == 1) ? 1024 : 1024 * 1024);
    if (!isset($config['email_maxsize'])) $config['email_maxsize'] = $config['email_maxsize1'] * (($config['email_maxsize2'] == 1) ? 1024 : 1024 * 1024);
    if (!isset($config['cron_execution_path'])) $config['cron_execution_path'] = "msd_cron/";

    $config2 = $config;
    foreach ($config2 as $var => $val)
    {
        if (in_array($var, $configDontsave)) unset($config2[$var]);
    }

    $t = '$config=array_merge($config,unserialize(base64_decode(\'' . base64_encode(serialize($config2)) . "')));\r\n";
    if (isset($databases)) $t .= '$databases=array_merge($databases,unserialize(base64_decode(\'' . base64_encode(serialize($databases)) . "')));\r\n";

    $pars_all = '<?php' . "\n" . $t . "\n?>";

    $ret = true;
    $file = './' . $config['paths']['config'] . $config['config_file'] . '.php';
    if ($fp = @fopen($file, "wb"))
    {
        if (!fwrite($fp, $pars_all)) $ret = false;
        if (!fclose($fp)) $ret = false;
        @chmod($file, 0777);
    }
    else
    $ret = false;
    if ($ret)
    {
        $_SESSION['config'] = $config;
        $ret = writeCronScript();
    }
    return $ret;
}


/**
 * Build string of array according to Perl syntax (needed to save Perl configuration file)
 *
 * @param array  $arr   Array to build the string from
 * @param string $mode  0 for strings, 1 for int values
 *
 * @return string The converted Perl string
 */
function myImplode($arr, $mode = 0) // 0=String, 1=intval
{
    if (!is_array($arr)) return false;
    foreach ($arr as $key => $val)
    {
        if ($mode == 0) $arr[$key] = Html::escapeSpecialchars($val);
        else $arr[$key] = intval($val);
    }
    if ($mode == 0) $ret = '("' . implode('","', $arr) . '")';
    else $ret = '(' . implode(',', $arr) . ')';
    return $ret;
}

/**
 * Build and save the actual configuration file for Perl (used by crondump.pl)
 *
 * @return boolean true on success or false on failure
 */
function writeCronScript()
{
    global $config, $databases, $cron_db_array, $cron_dbpraefix_array, $cron_db_cbd_array, $cron_db_cad_array;
    if (!isset($config['email_maxsize'])) $config['email_maxsize'] = $config['email_maxsize1'] * (($config['email_maxsize2'] == 1) ? 1024 : 1024 * 1024);
    if (isset($config['db_actual'])) $cron_dbname = $config['db_actual'];
    else
    {
        //get first database name from database-array (this is the case at fresh installing)
        $dbs = array_keys($databases);
        $cron_dbname = $dbs[0];
    }
    // -2 = Multidump configuration
    // -3 = all databases - nothing to do
    // get standard values for all databases
    $cron_db_array = ''; //$databases['Name'];
    $cron_dbpraefix_array = ''; //$databases['praefix'];
    $cron_command_before_dump = ''; //$databases['command_before_dump'];
    $cron_command_after_dump = ''; //$databases['command_after_dump'];


    $cron_ftp_server = '';
    $cron_ftp_port = '';
    $cron_ftp_mode = '';
    $cron_ftp_user = '';
    $cron_ftp_pass = '';
    $cron_ftp_dir = '';
    $cron_ftp_timeout = '';
    $cron_ftp_ssl = '';
    $cron_ftp_transfer = '';

    //build db-arrays
    foreach ($databases as $k => $v)
    {
        //should we dump this database
        if (isset($databases[$k]['dump']) && $databases[$k]['dump'] === 1)
        {
            $cron_db_array[] .= $k;
            $cron_dbpraefix_array[] .= $databases[$k]['prefix'];
            $cron_command_before_dump[] .= $databases[$k]['command_before_dump'];
            $cron_command_after_dump[] .= $databases[$k]['command_after_dump'];
        }
    }

    //build ftp-arrays
    foreach ($config['ftp'] as $k => $v)
    {
        $cron_ftp_server[] .= $config['ftp'][$k]['server'];
        $cron_ftp_port[] .= $config['ftp'][$k]['port'];
        $cron_ftp_mode[] .= $config['ftp'][$k]['mode'];
        $cron_ftp_user[] .= $config['ftp'][$k]['user'];
        $cron_ftp_pass[] .= $config['ftp'][$k]['pass'];
        $cron_ftp_dir[] .= $config['ftp'][$k]['dir'];
        $cron_ftp_timeout[] .= $config['ftp'][$k]['timeout'];
        $cron_ftp_ssl[] .= $config['ftp'][$k]['ssl'];
        $cron_ftp_transfer[] .= $config['ftp'][$k]['transfer'];
    }

    $r = str_replace("\\\\", "/", $config['paths']['root']);
    $r = str_replace("@", "\@", $r);

    //built recipient_cc-arrays
    $recipients_cc = '';
    foreach ($config['email']['recipient_cc'] as $k => $v)
    {
        $recipients_cc .= '"' . $config['email']['recipient_cc'][$k]['name'] . '" <' . $config['email']['recipient_cc'][$k]['address'] . '>, ';
    }
    $recipients_cc = substr($recipients_cc, 0, -2);

    // auf manchen Server wird statt 0 ein leerer String gespeichert -> fuehrt zu einem Syntax-Fehler
    // hier die entsprechenden Ja/Nein-Variablen sicherheitshalber in intvalues aendern
    $int_array = array(
        'dbport',
        'cron_compression',
        'cron_printout',
        'multi_part',
        'multipart_groesse',
        'email_maxsize',
    //'auto_delete][activated',
    //'auto_delete][max_backup_files',
        'perlspeed',
        'optimize_tables_beforedump',
        'logcompression',
        'log_maxsize',
        'cron_completelog',
        'use_sendmail',
        'smtp_port',
        'smtp_useauth',
        'smtp_usessl');

    foreach ($int_array as $i)
    {
        if (is_array($i))
        {
            foreach ($i as $key => $val)
            {
                $int_array[$key] = intval($val);
            }
        }
        else
        {
            if (!isset($config[$i])) $config[$i] = 0;
            $config[$i] = intval($config[$i]);
        }
    }
    if ($config['dbport'] == 0) $config['dbport'] = 3306;

    $cronscript = "<?php\n#Vars - written at " . date("Y-m-d H:i") . "\n";
    $cronscript .= '$dbhost="' . $config['dbhost'] . '";' . "\n";
    $cronscript .= '$dbname="' . $cron_dbname . '";' . "\n";
    $cronscript .= '$dbuser="' . Html::escapeSpecialchars($config['dbuser']) . '";' . "\n";
    $cronscript .= '$dbpass="' . Html::escapeSpecialchars($config['dbpass']) . '";' . "\n";
    $cronscript .= '$dbport=' . $config['dbport'] . ';' . "\n";
    $cronscript .= '$dbsocket="' . Html::escapeSpecialchars($config['dbsocket']) . '";' . "\n";
    $cronscript .= '$compression=' . $config['cron_compression'] . ';' . "\n";
    $cronscript .= '$sendmail_call="' . Html::escapeSpecialchars($config['sendmail_call']) . '";' . "\n";
    $cronscript .= '$backup_path="' . $config['paths']['root'] . $config['paths']['backup'] . '";' . "\n";
    $cronscript .= '$cron_printout=' . $config['cron_printout'] . ';' . "\n";
    $cronscript .= '$cronmail=' . $config['send_mail'] . ';' . "\n";
    $cronscript .= '$cronmail_dump=' . $config['email']['attach_backup'] . ';' . "\n";
    $cronscript .= '$cronmailto="' . Html::escapeSpecialchars('"' . $config['email']['recipient_name'] . '" <' . $config['email']['recipient_address'] . '>') . '";' . "\n";
    $cronscript .= '$cronmailto_cc="' . Html::escapeSpecialchars($recipients_cc) . '";' . "\n";
    $cronscript .= '$cronmailfrom="' . Html::escapeSpecialchars('"' . $config['email']['sender_name'] . '" <' . $config['email']['sender_address'] . '>') . '";' . "\n";
    $cronscript .= '$cron_use_sendmail=' . $config['use_sendmail'] . ';' . "\n";
    $cronscript .= '$cron_smtp="' . Html::escapeSpecialchars($config['smtp_server']) . '";' . "\n";
    $cronscript .= '$smtp_port=' . $config['smtp_port'] . ';' . "\n";
    $cronscript .= '$smtp_useauth=' . $config['smtp_useauth'] . ';' . "\n";
    $cronscript .= '$smtp_usessl=' . $config['smtp_usessl'] . ';' . "\n";
    $cronscript .= '$smtp_user="' . $config['smtp_user'] . '";' . "\n";
    $cronscript .= '$smtp_pass="' . $config['smtp_pass'] . '";' . "\n";
    $cronscript .= '@cron_db_array=' . myImplode($cron_db_array) . ';' . "\n";
    $cronscript .= '@cron_dbpraefix_array=' . myImplode($cron_dbpraefix_array) . ';' . "\n";
    $cronscript .= '@cron_command_before_dump=' . myImplode($cron_command_before_dump) . ';' . "\n";
    $cronscript .= '@cron_command_after_dump=' . myImplode($cron_command_after_dump) . ';' . "\n";

    $cronscript .= '@ftp_server=' . myImplode($cron_ftp_server) . ';' . "\n";
    $cronscript .= '@ftp_port=' . myImplode($cron_ftp_port, 1) . ';' . "\n";
    $cronscript .= '@ftp_mode=' . myImplode($cron_ftp_mode, 1) . ';' . "\n";
    $cronscript .= '@ftp_user=' . myImplode($cron_ftp_user) . ';' . "\n";
    $cronscript .= '@ftp_pass=' . myImplode($cron_ftp_pass) . ';' . "\n";
    $cronscript .= '@ftp_dir=' . myImplode($cron_ftp_dir) . ';' . "\n";
    $cronscript .= '@ftp_timeout=' . myImplode($cron_ftp_timeout, 1) . ';' . "\n";
    $cronscript .= '@ftp_useSSL=' . myImplode($cron_ftp_ssl, 1) . ';' . "\n";
    $cronscript .= '@ftp_transfer=' . myImplode($cron_ftp_transfer, 1) . ';' . "\n";

    $cronscript .= '$mp=' . $config['multi_part'] . ';' . "\n";
    $cronscript .= '$multipart_groesse=' . $config['multipart_groesse'] . ';' . "\n";
    $cronscript .= '$email_maxsize=' . $config['email_maxsize'] . ';' . "\n";
    $cronscript .= '$auto_delete=' . $config['auto_delete']['activated'] . ';' . "\n";
    $cronscript .= '$max_backup_files=' . $config['auto_delete']['max_backup_files'] . ';' . "\n";
    $cronscript .= '$perlspeed=' . $config['perlspeed'] . ';' . "\n";
    $cronscript .= '$optimize_tables_beforedump=' . $config['optimize_tables_beforedump'] . ';' . "\n";
    $cronscript .= '$logcompression=' . $config['logcompression'] . ';' . "\n";

    //add .gz to logfiles?
    if ($config['logcompression'] === 1)
    {
        $cronscript .= '$logdatei="' . $config['paths']['root'] . $config['files']['perllog'] . '.gz";' . "\n";
        $cronscript .= '$completelogdatei="' . $config['paths']['root'] . $config['files']['perllogcomplete'] . '.gz";' . "\n";
    }
    else
    {
        $cronscript .= '$logdatei="' . $config['paths']['root'] . $config['files']['perllog'] . '";' . "\n";
        $cronscript .= '$completelogdatei="' . $config['paths']['root'] . $config['files']['perllogcomplete'] . '";' . "\n";
    }
    $cronscript .= '$log_maxsize=' . $config['log_maxsize'] . ';' . "\n";
    $cronscript .= '$complete_log=' . $config['cron_completelog'] . ';' . "\n";
    $cronscript .= '$cron_comment="' . Html::escapeSpecialchars(stripslashes($config['cron_comment'])) . '";' . "\n";
    $cronscript .= "?>";

    // Save config
    $ret = true;
    $sfile = './' . $config['paths']['config'] . $config['config_file'] . '.conf.php';
    if (file_exists($sfile)) @unlink($sfile);

    if ($fp = @fopen($sfile, "wb"))
    {
        if (!fwrite($fp, $cronscript)) $ret = false;
        if (!fclose($fp)) $ret = false;
        @chmod("$sfile", 0777);
    }
    else
    $ret = false;

    // if standard config was deleted -> restore it with the actual values
    if (!file_exists('./' . $config['paths']['config'] . "mysqldumper.conf.php"))
    {
        $sfile = './' . $config['paths']['config'] . 'mysqldumper.conf.php';
        if ($fp = fopen($sfile, "wb"))
        {
            if (!fwrite($fp, $cronscript)) $ret = false;
            if (!fclose($fp)) $ret = false;
            @chmod("$sfile", 0777);
        }
        else
        $ret = false;
    }
    return $ret;
}

/**
 * Collect log file information and return it as assoziative array
 *
 * @param boolean $logcompression Watch for compressed (true) or uncompressed files
 *
 * @return array Associative array with information
 */
function getLogFileInfo($logcompression)
{
    global $config;

    $l = Array();
    $sum = $s = $l['log_size'] = $l['perllog_size'] = $l['perllogcomplete_size'] = $l['errorlog_size'] = $l['log_totalsize'] = 0;
    if ($logcompression == 1)
    {
        $l['log'] = $config['files']['log'] . ".gz";
        $l['perllog'] = $config['files']['perllog'] . ".gz";
        $l['perllogcomplete'] = $config['files']['perllogcomplete'] . ".gz";
        $l['errorlog'] = $config['paths']['log'] . "error.log.gz";
    }
    else
    {
        $l['log'] = $config['files']['log'];
        $l['perllog'] = $config['files']['perllog'];
        $l['perllogcomplete'] = $config['files']['perllogcomplete'];
        $l['errorlog'] = $config['paths']['log'] . "error.log";
    }
    $l['log_size'] += @filesize($l['log']);
    $sum += $l['log_size'];
    $l['perllog_size'] += @filesize($l['perllog']);
    $sum += $l['perllog_size'];
    $l['perllogcomplete_size'] += @filesize($l['perllogcomplete']);
    $sum += $l['perllogcomplete_size'];
    $l['errorlog_size'] += @filesize($l['errorlog']);
    $sum += $l['errorlog_size'];
    $l['log_totalsize'] += $sum;

    return $l;
}

/**
 * Delete log file and recreates it.
 *
 * @return void
 */
function deleteLog()
{
    global $config;
    $log = date('d.m.Y H:i:s') . " Log created.\n";
    if (file_exists($config['files']['log'] . '.gz')) @unlink($config['files']['log'] . '.gz');
    if (file_exists($config['files']['log'] . '.gz')) @unlink($config['files']['log']);
    if ($config['logcompression'] == 1)
    {
        $fp = @gzopen($config['files']['log'] . '.gz', "wb");
        @gzwrite($fp, $log);
        @gzclose($fp);
        @chmod($config['files']['log'] . '.gz', 0777);
    }
    else
    {
        $fp = @fopen($config['files']['log'], "wb");
        @fwrite($fp, $log);
        @fclose($fp);
        @chmod($config['files']['log'], 0777);
    }
}

/**
 * Detect accessable databases for the current SQL-User in $config-array and returns output-string with all dbs
 * Additionally it adds all found databases in the global var $databases
 *
 * @param boolean $printout Wether to return the output string or not
 * @param string  $db       Optional name of a database to add manually
 *
 * @return string Output string containing all found dbs
 */
function searchDatabases($printout = 0, $db = '')
{
    global $config, $lang, $dbo, $databases;
    $databases = array();
    $ret = '';
    $db_list = $dbo->getDatabases();
    // add manual added db to array, but only if it was not detected before
    if ($db > '' && !in_array($db, $db_list)) $db_list[] = $db;
    // now check if we can select the db - if not, we can't access the database
    if (sizeof($db_list) > 0)
    {
        foreach ($db_list as $db)
        {
            $res = $dbo->selectDb($db, true);

            if ($res === true)
            {
                addDatabaseToConfig($db);
                if ($printout == 1) $ret .= Html::getOkMsg($lang['L_FOUND_DB'] . ' `' . $db);
            } elseif ($printout == 1) {
                $ret .= Html::getErrorMsg($lang['L_ERROR'].' : '.$res);
            }
        }
    }
    return $ret;
}

/**
 * realpath implementation working on any server
 *
 * @return $dir string The application path
 */
function myRealpath()
{
    $dir = dirname(__FILE__);
    $dir = str_replace('\\', '/', $dir);
    $dir = str_replace('//', '/', $dir);
    if (substr($dir, -14) == '/inc/functions') $dir = substr($dir, 0, -13);
    if (substr($dir, -1) != '/') $dir .= '/';
    return $dir;
}

/**
 * Remove tags recursivly from array or from string
 *
 * @param $value string | array Value/s to strip
 *
 * @return string|array Cleaned values
 */
function myStripTags($value)
{
    global $dont_strip;
    if (is_array($value))
    {
        foreach ($value as $key => $val)
        {
            if (!in_array($key, $dont_strip)) $ret[$key] = myStripTags($val);
            else $ret[$key] = $val;
        }
    }
    else
    $ret = trim(strip_tags($value));
    return $ret;
}

/**
 * First start output buffering then start SESSION
 * Reads configuration and main-language file lang.php and creates
 * Database-Object $dbo
 *
 * @param string $json        Return JSON-Encoded answer
 * @param string $send_header If set to false headers are completely skipped
 * @return void
 */
function obstart($json = false, $send_header = true)
{
    global $dbo, $config, $databases, $dump, $lang;
    if ($config['ob_gzhandler'])
    {
        if (!@ob_start("ob_gzhandler")) @ob_start();
    }

    // if default config file doesn't exists, it is a new installation -> redirect to installation
    if (!$json && !file_exists('./work/config/mysqldumper.php'))
    {
        header("location: install.php");
        die();
        exit();
    }

    session_name('MySQLDumper');
    $res = session_start();
    if (false === $res) die("Error starting session! Check server.");
    if (isset($_SESSION['config_file'])) $config['config_file'] = $_SESSION['config_file'];
    else $config['config_file'] = 'mysqldumper';
    if ($send_header)
    {
        header('Pragma: no-cache');
        header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
        header('Expires: -1'); // Datum in der Vergangenheit
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        if (!$json) header('Content-Type: text/html; charset=UTF-8');
        else header('Content-type: application/x-json');
    }
    // get config from configuration file if not set
    if (!isset($_SESSION['config'])) getConfig($config['config_file']);
    else
    {
        // otherwise get parameters from session
        $config = array_merge($config, $_SESSION['config']);
        if (isset($_SESSION['databases'])) $databases = $_SESSION['databases'];
        if (isset($_SESSION['dump'])) $dump = $_SESSION['dump'];
    }
    // special case -> configuration is set to a language that was deleted meanwhile
    if (!is_readable('./language/' . $config['language'] . '/lang.php')) $config['language'] = 'en';

    include ('./language/' . $config['language'] . '/lang.php');
    // create database object
    $dbo = MsdDbFactory::getAdapter($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbport'], $config['dbsocket']);
    if (!isset($_SESSION['databases'])) setDefaultConfig();
//echo $config['db_actual'];
//    die();
    if (isset($config['db_actual']) && $config['db_actual'] > '') $dbo->selectDb($config['db_actual']);
    else
    {
        if (!isset($databases)) {
            // no config loaded -> SetDefault-Values
            setDefaultConfig();
        }
        // get first DB-Name and set as actual db
        $dbNames = array_keys($databases);
        $config['db_actual'] = $dbNames[0];
        $dbo->selectDb($config['db_actual']);
    }
    //$_SESSION['config'] = $config;
    //$_SESSION['databases'] = $databases;
}

/**
 * Add end of body/html, end output buffering and output the buffer
 *
 * @param boolean $ajax
 * @return void
 */
function obend($ajax = false)
{
    global $config, $databases;
    $_SESSION['databases'] = $databases;
    $_SESSION['config'] = $config;
    if (!$ajax) {
        echo '</div>' . "\n\n" . '</body>' . "\n\n" . '</html>';
        // close HTML-page
    }
    @ob_end_flush();
}

/**
 * Extract unique prefixes from an array
 *
 * and return new array containing the different prefixes
 *
 * @param array   $array         Array to scan for prefixes
 * @param boolean $addNoneOption Wether to add a first entry '---'
 *
 * @return $prefix_array array The array conatining the unique prefixes
 */
function getPrefixArray($array, $addNoneOption = true)
{
    $prefixes = array();
    $keys = array_keys($array);
    foreach ($keys as $k) {
        $pos = strpos($k, '_'); // find '_'
        if ($pos !== false) {
            $prefix = substr($k, 0, $pos);
            if (!in_array($prefix, $prefixes)) {
                $prefixes[$prefix] = $prefix;
            }
        }
    }
    if ($addNoneOption) {
        $prefixes['-1'] = '---';
    }
    ksort($prefixes);
    return $prefixes;
}

/**
 * Implode the given keys of multidimensional array using the implode string
 *
 * @param array  $array         The array to implode
 * @param string $key           The values that should be imploded
 * @param string $implodeString The string to concatenate the values with
 *
 * @return string The impoloded valuies as string
 */
function implodeSubarray($array, $key, $implodeString = ', ')
{
    $ret = '';
    foreach ($array as $k => $v) {
        $ret .= $v[$key] . $implodeString;
    }
    if (strlen($ret) > 1) {
        $ret = substr($ret, 0, -(strlen($implodeString)));
    }
    return $ret;
}

