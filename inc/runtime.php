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
define('MSD_VERSION', '1.25');
define('MSD_VERSION_SUFFIX', 'dev');
if (!defined('MSD_VERSION')) die('No direct access.');
@ini_set('display_errors', 'On');
// Output all errors - we want to know everything that could go wrong. ;)
error_reporting(E_ALL);
if (function_exists("date_default_timezone_set")) {
    date_default_timezone_set('Europe/Berlin');
}
define('MSD_OS', PHP_OS);
define('MSD_OS_EXT', @php_uname());
define('MULTIPART_FILESIZE_BUFFER', 10 * 1024);
$config = array();
$databases = array();
$tableInfos = array();
$lang = array();
if (!isset($_SESSION['config']) || isset($install)) {
    // set configuration default values if page is loaded the first time or
    // while installation is running
    // will be overwritten by saved values in configuration profile if present
    // this way we make double sure all values are defined
    if (isset($_SESSION['config'])) {
        $config = $_SESSION['config'];
    }
    $config['msd_mode'] = 0; // 0=easy, 1=expert
    $config['paths'] = array();
    $config['files'] = array();
    $config['paths']['root'] = myRealpath();
    define('MSD_PATH', $config['paths']['root']);
    $config['paths']['work'] = 'work/';
    $config['paths']['backup'] = $config['paths']['work'] . 'backup/';
    $config['paths']['log'] = $config['paths']['work'] . 'log/';
    $config['paths']['config'] = $config['paths']['work'] . 'config/';
    $config['paths']['perlexec'] = 'msd_cron/';
    $config['files']['log'] = $config['paths']['log'] . 'mysqldump.log';
    $config['files']['perllog'] = $config['paths']['log'] . 'mysqldump_perl.log';
    $config['files']['perllogcomplete'] =
        $config['paths']['log'] . 'mysqldump_perl.complete.log';
    $config['config_file'] = 'mysqldumper';
    $config['theme'] = 'msd';
    // gui related values
    // show server caption
    $config['interface_server_caption'] = 1;
    // show server caption in main frame
    $config['interface_server_caption_position'] = 0;
    //Height of the SQL-Box in SQLBrowser in pixel
    $config['interface_sqlboxsize'] = 70;
    // don't use compact view when showing data or tables
    $config['interface_table_compact'] = 0;
    // don't auto delete backup files automatically. User must turn on this
    $config['auto_delete'] = 0;
    $config['refresh_processlist'] = 3;
    $config['notification_position'] = 'mc';
    $config['resultsPerPage']=30;
    // Multipart
    $config['multi_part'] = 0;
    $config['multipartgroesse1'] = 1;
    $config['multipartgroesse2'] = 2;
    // set first ftp-connection
    $config['ftp'] = array();
    $config['ftp'][0]['server'] = '';
    $config['ftp'][0]['user'] = '';
    $config['ftp'][0]['transfer'] = 0;
    $config['ftp'][0]['timeout'] = 10;
    $config['ftp'][0]['mode'] = 0;
    $config['ftp'][0]['ssl'] = 0;
    $config['ftp'][0]['port'] = 21;
    $config['ftp'][0]['pass'] = '';
    $config['ftp'][0]['dir'] = '/';
    // e-mail
    $config['email'] = array();
    $config['email']['recipient_address'] = '';
    $config['email']['recipient_name'] = '';
    $config['email']['recipient_cc'] = array();
    $config['email']['recipient_cc'][0]['name'] = '';
    $config['email']['recipient_cc'][0]['address'] = '';

    $config['email']['sender_name'] = '';
    $config['email']['sender_address'] = '';
    $config['email']['attach_backup'] = 0;
    $config['send_mail'] = 0; // send an email?
    $config['use_mailer'] = 0; // use PHP mail()=0, use sendmail=1, use smtp 2
    $config['email_maxsize1'] = 3;
    $config['email_maxsize2'] = 2;
    $config['sendmail_call'] = @ini_get('sendmail_path');
    $config['smtp_server'] = 'localhost';
    $config['smtp_port'] = 25;
    $config['smtp_useauth'] = 0;
    $config['smtp_user'] = '';
    $config['smtp_pass'] = '';
    $config['smtp_usessl'] = 0;
    $config['smtp_pop3_server'] = '';
    $config['smtp_pop3_port'] = 110;

    // Perl related settings
    $config['cron_extender'] = 0;
    $config['cron_compression'] = 1;
    $config['cron_printout'] = 1;
    $config['cron_completelog'] = 1;
    $config['cron_comment'] = '';
    // log -> if zlib is disabled it will be turned off automatically later on
    $config['logcompression'] = 1; // compress log files
    $config['compression'] = 1; // compression of backup files is possible
    $config['log_maxsize1'] = 1;
    $config['log_maxsize2'] = 2;
    $config['log_maxsize'] = 1048576;
    $config['optimize_tables_beforedump'] = 1;
    $config['backup_using_updates'] = 0;
    $config['empty_db_before_restore'] = 0;
    $config['stop_with_error'] = 1; // Restore -> stop on errors and show them
    //Tuning-Corner -> values to process speed calculations
    $config['minspeed'] = 100;
    $config['maxspeed'] = 10000;
    $config['tuning_add'] = 1.1;
    $config['tuning_sub'] = 0.9;
    $config['time_buffer'] = 0.75;
    $config['perlspeed'] = 10000; // nr of records to be read at once
    //dynamic parameters - read from server configuration
    $config['safe_mode'] = get_cfg_var('safe_mode');
    $config['magic_quotes_gpc'] = get_magic_quotes_gpc();
    $config['disabled'] = get_cfg_var('disable_functions');
    $config['ob_gzhandler'] = false;
    @ini_set('magic_quotes_runtime', 0);
    $config['max_execution_time'] = get_cfg_var('max_execution_time');
    if ($config['max_execution_time'] <= 4) {
        // we didn't get the real value from the server - some deliver "-1"
         $config['max_execution_time'] = $config['max_execution_time'];
    }
    // we don't use more than 30 seconds to avoid brower timeouts
    if ($config['max_execution_time'] > 30) {
        $config['max_execution_time'] = 30;
    }
    $config['upload_max_filesize'] = get_cfg_var('upload_max_filesize');
    // value in Megabytes? If yes create output else leave output untouched
    if (strpos($config['upload_max_filesize'], 'M')) {
        $config['upload_max_filesize'] =
            trim(str_replace('M', '', $config['upload_max_filesize']));
        $config['upload_max_filesize'] *= 1024 * 1024; // re-calculate to Bytes
        // get a string ready to output
        $config['upload_max_filesize'] =
            byteOutput($config['upload_max_filesize']);
    }
    $config['phpextensions'] = implode(', ', get_loaded_extensions());
    // read ram size
    $m = trim(str_replace('M', '', @ini_get('memory_limit')));
    // fallback if ini_get doesn't work
    if (intval($m) == 0) {
        $m = trim(str_replace('M', '', get_cfg_var('memory_limit')));
    }
    $config['php_ram'] = $m;
    // always calculate memory limit
    // we don't trust the value delivered by server config if < 8
    if ($config['php_ram'] < 8) {
        $config['php_ram'] = 8;
    }
    // use maximum of 90% of the memory limit
    $config['memory_limit'] = round($config['php_ram'] * 1024 * 1024 * 0.9, 0);
    // server html compression check routine
    // detect if we can use output compression
    $config['ob_gzhandler'] = false;
    $check = array(NULL, false, '', 0, '0'); // Values to check
    if (in_array(
        preg_match('/ob_gzhandler|ini_get/i', $config['disabled']), $check
    ) && in_array(@ini_get('output_handler'), $check)
    && in_array(@ini_get('zlib.output_compression'), $check)
    && in_array(@ini_get('zlib.output_handler'), $check)) {
    }
    if (function_exists('apache_get_modules') && $config['ob_gzhandler'] == true
        && in_array('mod_deflate', @apache_get_modules())) {
            $config['ob_gzhandler'] = false;
    }
    //is zlib-compression possible?
    $extensions = explode(', ', $config['phpextensions']);
    $disabledExtensions = str_replace(' ', '', $config['disabled']);
    $disabledExtensions = explode(',', $disabledExtensions);
    $config['zlib'] = (in_array('zlib', $extensions)
        && (!in_array('gzopen', $disabledExtensions)
        || !in_array('gzwrite', $disabledExtensions)
        || !in_array('gzgets', $disabledExtensions)
        || !in_array('gzseek', $disabledExtensions)
        || !in_array('gztell', $disabledExtensions)));
    if (!$config['zlib']) {
        // we can't use compression -> turn it off
        $config['logcompression'] = 0;
        $config['compression'] = 0;
    }
    $config['homepage'] = 'http://mysqldumper.net';
}
if (isset($_SESSION['config'])) {
    $config = $_SESSION['config'];
}
if (isset($_SESSION['databases'])) {
    $databases = $_SESSION['databases'];
}
$config['files']['iconpath'] = './css/' . $config['theme'] . '/icons/';
// config-vars that mustn't be saved in configuration profile,
// because they should be get dynamically from the server
$configDontsave = Array(
    'homepage',
    'max_execution_time',
    'safe_mode',
    'magic_quotes_gpc',
    'disabled',
    'phpextensions',
    'php_ram',
    'zlib',
    'tuning_add',
    'tuning_sub',
    'time_buffer',
    'perlspeed',
    'cron_configurationfile',
    'dbconnection',
    'version',
    'config_file',
    'upload_max_filesize',
    'cron_samedb',
    'paths',
    'files',
    'ob_gzhandler');
