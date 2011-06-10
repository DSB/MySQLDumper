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
// start the magic
if (isset($_GET['filename']) || isset($_POST['filename'])) {
    // first call -> set defaults
    getConfig();
    $restore = $_SESSION['restore'];
    $restore['filename'] = '';
    if (isset($_POST['filename'])) {
         $restore['filename'] = urldecode($_POST['filename']);
    }
    if (isset($_GET['filename'])) {
        $restore['filename'] = urldecode($_GET['filename']);
    }
    $restore['compressed'] = 0;
    if (substr(strtolower($restore['filename']), -2) == 'gz') {
        $restore['compressed'] = 1;
    }
    $restore['dump_encoding'] = 'utf8';
    if (isset($_POST['sel_dump_encoding'])) {
        $restore['dump_encoding'] = $_POST['sel_dump_encoding'];
    }
    if (isset($_GET['dump_encoding'])) {
        $restore['dump_encoding'] = $_GET['dump_encoding'];
    }
    $restore['part'] = 0;
    // Read Statusline of file
    $sline = readStatusline($restore['filename']);
    // if it is a backup done by MSD we get the charset from the statusline
    if (isset($sline['charset']) && $sline['charset']!='?') {
        $restore['dump_encoding'] = $sline['charset'];
    }

    // init some values
    $restore['tables_total'] = $sline['tables'];
    $restore['records_total'] = $sline['records'];
    if ($sline['part'] != 'MP_0') $restore['part'] = 1;
    if ($config['empty_db_before_restore'] == 1) {
        truncateDb($config['db_actual']);
    }
    $restore['max_zeit'] = intval(
        $config['max_execution_time'] * $config['time_buffer']
    );
    $restore['restore_start_time'] = time();
    $restore['speed'] = $config['minspeed'];
    $restore['restore_start_time'] = time();
    $restore['fileEOF'] = false;
    $restore['actual_table'] = '';
    $restore['offset'] = 0;
    $restore['page_refreshs'] = 0;
    $restore['table_ready'] = 0;
    $restore['errors'] = 0;
    $restore['notices'] = 0;
    $restore['actual_fieldcount'] = 0;
    $restore['records_inserted'] = 0;
    $restore['records_inserted_table'] = array();
    $restore['extended_inserts'] = 0;
    $restore['extended_insert_flag'] = -1;
    $restore['last_parser_status'] = 0;
    $restore['EOB'] = false;
    $restore['fileEOF'] = false;
    $restore['file_progress_percent'] = 0;
    $restore['tables_to_restore'] = false; // restore complete file
    // Should we restore the complete file or are only some tables selected ?
    if (isset($_POST['sel_tbl'])) {
        $restore['tables_to_restore'] = $_POST['sel_tbl'];
        //correct the nr of tables and total records to restore
        $restore['tables_total'] = 0;
        $restore['records_total'] = 0;
        $tabledata = getTableHeaderInfoFromBackup($restore['filename']);
        foreach ($tabledata as $key => $val) {
            if (in_array($val['name'], $restore['tables_to_restore'])) {
                $restore['tables_total']++;
                $restore['records_total'] += $val['records'];
            }
        }
    }

    $_SESSION['config'] = $config;
    $_SESSION['databases'] = $databases;
    $_SESSION['restore'] = $restore;
    $logMsg = sprintf(
        $lang['L_START_RESTORE_DB_FILE'],
        $config['db_actual'],
        $restore['filename']
    );
    $log->write(Log::PHP, $logMsg);
} else {
    $config = $_SESSION['config'];
    $databases = $_SESSION['databases'];
    $restore = $_SESSION['restore'];
}

// tables to create
$tablesDone = 0;
if ($restore['table_ready'] > 0) {
    $tablesDone = $restore['table_ready'];
}
if ($restore['tables_total'] > 0) {
    $tablesToDo = $restore['tables_total'];
} else {
    $tablesToDo = $lang['L_UNKNOWN'];
}
if ($restore['tables_total'] > 0) {
    $tablesToCreate = sprintf(
        $lang['L_RESTORE_TABLES_COMPLETED'],
        $tablesDone,
        $tablesToDo
    );
} else {
    $tablesToCreate = sprintf(
        $lang['L_RESTORE_TABLES_COMPLETED0'], $tablesDone
    );
}

$tplRestore = new MSDTemplate();
$tplRestore->set_filenames(array('tplRestore' => 'tpl/restore/restore.tpl'));
$restoringDb = sprintf(
    $lang['L_RESTORE_DB'], $config['db_actual'], $config['dbhost']
);
$tplRestore->assign_vars(
    array(
        'SESSION_ID' => session_id(),
        'ICONPATH' => $config['files']['iconpath'],
        'ICON_PLUS' => $icon['plus'],
        'DB_ON_SERVER' => $restoringDb,
        'FILENAME' => $restore['filename'],
        'CHARSET' => $restore['dump_encoding'],
        'TABLES_TO_CREATE' => $tablesToCreate,
        'NOTIFICATION_POSITION' => $config['notification_position']
    )
);

if ($restore['part'] > 0) {
    $tplRestore->assign_block_vars(
        'MULTIPART',
        array('PART' => $restore['part'])
    );
}
$_SESSION['restore'] = $restore;
