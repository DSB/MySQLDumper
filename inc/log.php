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

include ('./inc/define_icons.php');

$logType = (isset($_GET['log'])) ? $_GET['log'] : Log::PHP;
$revers = (isset($_GET['revers'])) ? $_GET['revers'] : 1;
$offset = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
$entriesShown = 25;

// define template
$tplLog = new MSDTemplate();
$tplLog->set_filenames(array('tplLog' => 'tpl/log/log.tpl'));

//Delete log
if (isset($_GET['delete_log'])) {
    $log->delete($logType);
    // switch back to standard log - other log file was deleted
    $logType = Log::PHP;
}

// get log filename to show
$lfile = $log->getLogfile($logType);

// if PHP-Log doesn't exists for any reason -> create it
if (!file_exists($lfile) && $logType == 0) $log->delete($config['files']['log'], true);

$loginfo = array();
$sum = $loginfo['log_size'] = $loginfo['perllog_size'] = 0;
$loginfo['perllogcomplete_size'] = 0;
$loginfo['errorlog_size'] = $loginfo['log_totalsize'] = 0;
if ($config['logcompression'] == 1) {
    $loginfo['log'] = $config['files']['log'] . ".gz";
    $loginfo['perllog'] = $config['files']['perllog'] . ".gz";
    $loginfo['perllogcomplete'] = $config['files']['perllogcomplete'] . ".gz";
    $loginfo['errorlog'] = $config['paths']['log'] . "error.log.gz";
} else {
    $loginfo['log'] = $config['files']['log'];
    $loginfo['perllog'] = $config['files']['perllog'];
    $loginfo['perllogcomplete'] = $config['files']['perllogcomplete'];
    $loginfo['errorlog'] = $config['paths']['log'] . "error.log";
}
$loginfo['log_size'] += @filesize($loginfo['log']);
$sum += $loginfo['log_size'];
$loginfo['perllog_size'] += @filesize($loginfo['perllog']);
$sum += $loginfo['perllog_size'];
$loginfo['perllogcomplete_size'] += @filesize($loginfo['perllogcomplete']);
$sum += $loginfo['perllogcomplete_size'];
$loginfo['errorlog_size'] += @filesize($loginfo['errorlog']);
$sum += $loginfo['errorlog_size'];
$loginfo['log_totalsize'] += $sum;

$tplLog->assign_vars(
    array(
        'ICON_VIEW' => $icon['view'],
        'ICON_OPEN_FILE' => $icon['open_file'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_ARROW_DOWN' => $icon['arrow_down'],
        'ICON_ARROW_UP' => $icon['arrow_up'],
        'ICON_SORT' => $revers == 0 ? $icon['arrow_up'] : $icon['arrow_down'],
        'SORT_ORDER' => $revers == 0 ? 1 : 0,
        'LOG' => str_replace($config['paths']['log'], '', $lfile))
);

$tplLog->assign_vars(
    array(
        'LOGPATH' => $config['paths']['log'],
        'PHPLOG' => str_replace($config['paths']['log'], '', $loginfo['log']),
        'PHPLOG_SIZE' => byteOutput($loginfo['log_size']))
);

if (@file_exists($loginfo['errorlog'])) {
    $outErrLog = str_replace($config['paths']['log'], '', $loginfo['errorlog']);
    $tplLog->assign_block_vars(
        'ERRORLOG', array(
            'ERRORLOG' => $outErrLog,
            'SIZE' => byteOutput($loginfo['errorlog_size']))
    );
} else {
    $tplLog->assign_vars(
        array('ERRORLOG_DISABLED' => Html::getDisabled(true, true))
    );
}

if (@file_exists($loginfo['perllog'])) {
    $perl = str_replace($config['paths']['log'], '', $loginfo['perllog']);
    $tplLog->assign_block_vars(
        'PERLLOG',
        array(
                'FILE_NAME' => $perl,
                'SIZE' => byteOutput($loginfo['perllog_size']))
    );
} else {
    $tplLog->assign_vars(
        array(
            'PERLLOG_DISABLED' => Html::getDisabled(true, true))
    );
}

if (@file_exists($loginfo['perllogcomplete'])) {
    $perlComplete = str_replace(
        $config['paths']['log'],
        '',
        $loginfo['perllogcomplete']
    );
    $tplLog->assign_block_vars(
        'PERLCOMPLETELOG',
        array(
            'FILE_NAME' => $perlComplete,
            'SIZE' => byteOutput($loginfo['perllogcomplete_size']))
    );
} else {
    $tplLog->assign_vars(
        array(
            'PERLCOMPLETELOG_DISABLED' => Html::getDisabled(true, true))
    );
}

$tplLog->assign_vars(
    array(
        'LOG_TYPE' => $logType,
        'LOGSIZE_TOTAL' => byteOutput($loginfo['log_totalsize']),
        'REVERS' => $revers)
);
unset($lfile);