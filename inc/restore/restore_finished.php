<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: $
 * @author          $Author$
 * @lastmodified    $Date$
 */
// Restore is finished
include ('./inc/define_icons.php');
$restore = $_SESSION['restore'];
$tplRestoreFinished = new MSDTemplate();
$tplRestoreFinished->set_filenames(
    array('tplRestoreFinished' => 'tpl/restore/restore_finished.tpl')
);
$recordsInserted = String::formatNumber($restore['records_inserted']);
$recordsInserted = sprintf($lang['L_RECORDS_INSERTED'], $recordsInserted);
$tablesCreated = sprintf(
    $lang['L_RESTORE_COMPLETE'], $restore['table_ready']
);
$timeElapsed = getTimeFormat(time() - $restore['restore_start_time']);
$tplRestoreFinished->assign_vars(
    array(
        'SESSION_ID' => session_id(),
        'ICON_OPEN_FILE' => $icon['small']['open_file'],
        'ICON_EDIT' => $icon['small']['edit'],
        'ICON_VIEW' => $icon['small']['view'],
        'SESSION_ID' => session_id(),
        'BACKUPPATH' => $config['paths']['backup'],
        'PAGE_REFRESHS' => $restore['page_refreshs'],
        'TIME_ELAPSED' => $timeElapsed,
        'TABLES_CREATED' => $tablesCreated,
        'RECORDS_INSERTED' => $recordsInserted,
        'ICONPATH' => $config['files']['iconpath']
    )
);
if (count($_SESSION['log']['errors']) > 0) {
    $i = 1;
    $tplRestoreFinished->assign_block_vars('ERRORS', array());
    foreach ($_SESSION['log']['errors'] as $logError) {
        $timestamp = substr($logError, 0, 19);
        $message = substr($logError, 20);
        $tplRestoreFinished->assign_block_vars(
            'ERRORS.ERROR',
            array(
                'NR' => $i,
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'TIMESTAMP' => $timestamp,
                'MSG' => $message
            )
        );
        $i++;
    }
}
$i = 1;
foreach ($_SESSION['log']['actions'] as $logAction) {
    $timestamp = substr($logAction, 0, 19);
    $message = substr($logAction, 20);
    $tplRestoreFinished->assign_block_vars(
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

$i = 1;
if (count($_SESSION['log']['notices']) > 0) {
    $tplRestoreFinished->assign_block_vars('NOTICES', array());
    foreach ($_SESSION['log']['notices'] as $logAction) {
        $timestamp = substr($logAction, 0, 19);
        $message = substr($logAction, 20);
        $tplRestoreFinished->assign_block_vars(
            'NOTICES.NOTICE',
            array(
                'NR' => $i,
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'TIMESTAMP' => $timestamp,
                'NOTICE' => $message
            )
        );
        $i++;
    }
}

