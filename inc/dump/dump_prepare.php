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
// remove table selection from previous runs
if (isset($dump['sel_tbl'])) {
    unset($dump['sel_tbl']);
}
if (isset($_SESSION['dump']['sel_tbl'])) {
    unset($_SESSION['dump']['sel_tbl']);
}
//if we are not in mode expert -> reset hidden settings to safe defaults
if ($config['msd_mode'] == 0) {
    $config['replace_command'] = 0;
}

$tplDumpPrepare = new MSDTemplate();
$tplDumpPrepare->set_filenames(
    array('tplDumpPrepare' => 'tpl/dump/dump_prepare.tpl')
);
if ($config['msd_mode'] > 0) {
    $tplDumpPrepare->assign_block_vars('MODE_EXPERT', array());
}
// set charset-selectbox to standard-encoding of MySQL-Server as initial value
$dump['sel_dump_encoding'] = 'utf8';
$dump['dump_encoding'] = 'utf8';
$charsets=$dbo->getCharsets();
foreach ($charsets as $name=>$val) {
    $charsetsDescription[$name]=$name.' - '.$val['Description'];
}
// tables will be selected on next page, but we need a dummy val
// for prepareDumpProcess()
$dump['selected_tables'] = false;
$dbsToBackup = array();
// look up which databases need to be dumped
prepareDumpProcess();
$dbs = array_keys($dump['databases']);
$dbsToBackup = implode(', ', $dbs);

$cext = ($config['cron_extender'] == 0) ? 'pl' : 'cgi';
$scriptName = $_SERVER['SCRIPT_NAME'];
$serverName = $_SERVER['SERVER_NAME'];
$url = substr($scriptName, 0, strrpos($scriptName, '/') + 1);
if (substr($url, -1) != '/') $url .= '/';
if (substr($url, 0, 1) != '/') $url = '/' . $url;
$refdir = (substr($config['cron_execution_path'], 0, 1) == '/') ? '' : $url;
$scriptdir = $config['cron_execution_path'] . 'crondump.' . $cext;
$perlModultest = $config['cron_execution_path'] . "perltest.$cext";
$perlSimpletest = $config['cron_execution_path'] . "simpletest.$cext";
$scriptentry = myRealpath('./') . $config['paths']['config'];
$cronabsolute = myRealpath('./') . $scriptdir;
if (substr($config['cron_execution_path'], 0, 1) == '/') {
    $cronabsolute = $_SERVER['DOCUMENT_ROOT'] . $scriptdir;
}
$confabsolute = $config['config_file'];
$perlHttpCall = getServerProtocol() . $serverName . $refdir;
$perlHttpCall .= $config['cron_execution_path'] . 'crondump.' . $cext;
$perlHttpCall .= '?config=' . $confabsolute;
$perlCrontabCall = 'perl ' . $cronabsolute . ' -config=' . $confabsolute;
$perlCrontabCall .= ' -html_output=0';
$tplDumpPrepare->assign_vars(
    array(
        'SESSION_ID' => session_id(),
        'CONFIG_FILE' => $config['config_file'],
        'POSSIBLE_DUMP_ENCODINGS' =>
            Html::getOptionlist($charsetsDescription, 'utf8'),
        'DBS_TO_BACKUP' => $dbsToBackup,
        'TABLES_TOTAL' => $dump['tables_total'],
        'RECORDS_TOTAL' => String::formatNumber(intval($dump['records_total'])),
        'DATASIZE_TOTAL' => byteOutput($dump['datasize_total']),
        'NR_OF_DBS' => count($dump['databases']),
        'DUMP_COMMENT' => Html::replaceQuotes($dump['comment']),
        'PERL_TEST' => $perlSimpletest,
        'PERL_MODULTEST' => $perlModultest,
        'PERL_HTTP_CALL' => $perlHttpCall,
        'PERL_CRONTAB_CALL' => $perlCrontabCall,
        'PERL_ABSOLUTE_PATH_OF_CONFIGDIR' => $scriptentry,
        'TIMESTAMP' => time()
    )
);

if (count($dump['databases']) == 1 && $config['db_actual'] == $dbsToBackup) {
    $tplDumpPrepare->assign_block_vars('TABLESELECT', array());
}
if ($config['compression'] == 1) {
    $tplDumpPrepare->assign_block_vars('GZIP_ACTIVATED', array());
} else {
    $tplDumpPrepare->assign_block_vars('GZIP_NOT_ACTIVATED', array());
}

if ($config['multi_part'] == 1) {
    $tplDumpPrepare->assign_block_vars(
        'MULTIPART',
        array('SIZE' => byteOutput($config['multipart_groesse']))
    );
} else {
    $tplDumpPrepare->assign_block_vars('NO_MULTIPART', array());
}

if ($config['send_mail'] == 1) {
    $tplDumpPrepare->assign_block_vars(
        'SEND_MAIL',
        array('RECIPIENT' => $config['email']['recipient_address'])
    );
    $recipients = $config['email']['recipient_cc'];
    $recipientsCc = implodeSubarray($recipients, 'address');
    if ($recipientsCc > '') {
        $tplDumpPrepare->assign_block_vars(
            'SEND_MAIL.CC', array('EMAIL_ADRESS' => $recipientsCc)
        );
    }
    if ($config['email']['attach_backup'] == 1) {
        $bytes = $config['email_maxsize1'] * 1024;
        if ($config['email_maxsize2'] == 2) {
            $bytes = $bytes * 1024;
        }
        $tplDumpPrepare->assign_block_vars(
            'SEND_MAIL.ATTACH_BACKUP', array('SIZE' => byteOutput($bytes))
        );
    } else {
        $tplDumpPrepare->assign_block_vars(
            'SEND_MAIL.DONT_ATTACH_BACKUP', array()
        );
    }
} else {
    $tplDumpPrepare->assign_block_vars('NO_SEND_MAIL', array());
}

$i = 1;
foreach ($config['ftp'] as $ftp) {
    if ($ftp['transfer'] == 1) {
        $tplDumpPrepare->assign_block_vars(
            'FTP',
            array(
                'NR' => $i,
                'ROWCLASS' => $i % 2 ? 'dbrow1' : 'dbrow'
            )
        );

        $tplDumpPrepare->assign_block_vars(
            'FTP.CONNECTION',
            array(
                'SERVER' => $ftp['server'],
                'PORT' => $ftp['port'],
                'DIR' => $ftp['dir']
            )
        );
        $i++;
    }
}
