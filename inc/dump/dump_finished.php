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
include ('./inc/define_icons.php');
$dump = $_SESSION['dump'];

$tplDumpFinished = new MSDTemplate();
$tplDumpFinished->set_filenames(
    array('tplDumpFinished' => 'tpl/dump/dump_finished.tpl')
);
$recordsTotal = String::formatNumber((int)$dump['records_total']);
$tablesTotal = $dump['tables_total'];
$msg = sprintf($lang['L_DUMP_ENDERGEBNIS'], $tablesTotal, $recordsTotal);
$tplDumpFinished->assign_vars(
    array(
        'ICON_OPEN_FILE' => $icon['small']['open_file'],
        'ICON_EDIT' => $icon['small']['edit'],
        'ICON_VIEW' => $icon['small']['view'],
        'SESSION_ID' => session_id(),
        'BACKUPPATH' => $config['paths']['backup'],
        'PAGE_REFRESHS' => $dump['page_refreshs'],
        'TIME_ELAPSED' => getTimeFormat(time() - $dump['dump_start_time']),
        'MSG' => $msg
    )
);

if (count($dump['databases']) > 1) {
    $msg = sprintf($lang['L_MULTIDUMP_FINISHED'], count($dump['databases']));
    $tplDumpFinished->assign_block_vars('MULTIDUMP', array('MSG' => $msg));
}
$i = 1;
foreach ($_SESSION['log']['files_created'] as $file) {
    $fileSize = @filesize($config['paths']['backup'] . $file);
    $tplDumpFinished->assign_block_vars(
        'FILE',
        array(
            'NR' => $i,
            'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
            'FILENAME' => $file,
            'FILENAME_URLENCODED' => urlencode($file),
            'FILESIZE' => byteOutput($fileSize)
        )
    );
    $i++;
}

$i = 1;
foreach ($_SESSION['log']['actions'] as $message) {
    $timestamp = substr($message, 0, 19);
    $message = substr($message, 20);
    $tplDumpFinished->assign_block_vars(
        'ACTION',
        array(
            'NR' => $i,
            'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
            'TIMESTAMP' => $timestamp,
            'ACTION' => $message
        )
    );
    $i++;
}

if (sizeof($_SESSION['log']['errors']) > 0) {
    $tplDumpFinished->assign_block_vars('ERROR', array());
    $i = 1;
    foreach ($_SESSION['log']['errors'] as $error) {
        $timestamp = substr($error, 0, 19);
        $error = substr($error, 20);
        $tplDumpFinished->assign_block_vars(
            'ERROR.ERRORMSG',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'TIMESTAMP' => $timestamp,
                'MSG' => $error
            )
        );
        $i++;
    }
}
