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
$msg = '';
$showFilelist = true;
// call after selecting tables to restore
//-> save selection and head over to restore.php
if (isset($_POST['restore_tbl'])) {
    echo '<script type="text/javascript">'
        . 'location.href="index.php?p=restore&filename='
        . urlencode($_POST['filename']) . '";</script></body></html>';
    exit();
}

if (isset($_POST['restore'])) {
    if (isset($_POST['file'])) {
        if (isset($_POST['select_tables']) && $_POST['select_tables'] == 1) {
            // select tables to restore
            include ('./inc/restore/select_tables.php');
            $showFilelist = false;
        } else {
            $encodingFound = true;
            $file = $_POST['file'][0];
            $statusline = readStatusline($file);
            if (isset($_POST['sel_dump_encoding_restore'])) {
                // encoding of file was selected -> we can start
                $dumpEncoding = $_POST['sel_dump_encoding_restore'];
            } else {
                if (!isset($statusline['charset'])
                    || trim($statusline['charset']) == '?') {
                    // unknown encoding of a file not created by MySQLDumper
                    // -> ask user what encoding should be used
                    $charsets = $dbo->getCharsets();
                    foreach ($charsets as $name => $val) {
                        $charsetsDescription[$name] = $name . ' - '
                            . $val['Description'];
                    }

                    $tplRestoreSelectEncoding = new MSDTemplate();
                    $tplRestoreSelectEncoding->set_filenames(
                        array(
                            'tplRestoreSelectEncoding' =>
                            'tpl/restore/file_select_encoding.tpl'
                        )
                    );
                    $encSelect = Html::getOptionlist(
                        $charsetsDescription, 'utf8'
                    );

                    $tplRestoreSelectEncoding->assign_vars(
                        array(
                            'PAGETITLE' => $lang['L_FM_RESTORE'] . ': ' . $file,
                            'DATABASE' => $config['db_actual'],
                            'ENCODING_SELECT' => $encSelect,
                            'FILE_NAME' => $file
                        )
                    );
                    $encodingFound = false;
                } else {
                    // file was created by MySQLDumper ->
                    // get encoding from statusline
                    $dumpEncoding = $statusline['charset'];
                }
            }

            if ($encodingFound) {
                echo '<script type="text/javascript">'
                    .'location.href="index.php?p=restore&filename='
                    . urlencode($file) . '&dump_encoding='
                    . urlencode($dumpEncoding) . '";</script></body></html>';
                obend();
            }
        }
        $showFilelist = false;
    } else {
        $msg .= Html::getErrorMsg($lang['L_FM_NOFILE']);
    }
}
if ($showFilelist) {
    // Reset Session
    $_SESSION['restore'] = array();
    $restore = array();
    $tplRestorePrepare = new MSDTemplate();
    $tplRestorePrepare->set_filenames(
        array('tplRestorePrepare' => 'tpl/restore/restorePrepare.tpl')
    );

    $dbactualOutput = $dbactive;
    if ($dbactive == '~unknown') {
        $dbactualOutput = '<i>' . $lang['L_UNKNOWN'] . '</i>';
    }
    if ($dbactive == '~converted') {
        $dbactualOutput = '<i>' . $lang['L_CONVERTED_FILES'] . '</i>';
    }

    $pageTitle = sprintf($lang['L_FM_RESTORE_HEADER'], $config['db_actual']);
    $tplRestorePrepare->assign_vars(
        array(
            'SESSION_ID' => session_id(),
            'PAGETITLE' => $pageTitle,
            'DB_ACTUAL' => $config['db_actual'],
            'DB_ACTIVE' => $dbactualOutput,
        )
    );
    if ($msg > '') $tplRestorePrepare->assign_block_vars(
        'MESSAGE', array('TEXT' => Html::getJsQuote($msg, true))
    );

    // get info of all backup files
    $backups = getBackupfileInfo();

    if (!isset($backups['databases'][$dbactive])) {
        $tplRestorePrepare->assign_block_vars('NO_FILE_FOUND', array());
    }
    $i = 0;
    // show detailed file info of the selected database at top
    foreach ($backups['files'] as $backup) {
        if ($backup['db'] == $dbactive) {
            $compressed = '-';
            if (substr($backup['name'], -3) == '.gz') {
                $compressed = $icon['gz'];
            }
            $dbName = $backup['name'];
            if (!in_array($backup['db'], array('~unknown', '~converted'))) {
                $dbName = $backup['db'];
            }
            $scriptVersion = $lang['L_UNKNOWN'];
            if ($backup['script'] > '') {
                $scriptVersion = $backup['script'];
            }
            $comment ='&nbsp;';
            if ($backup['comment'] > '') {
                $comment = nl2br(wordwrap($backup['comment'], 50));
            }
            $nrOfTables = $lang['L_UNKNOWN'];
            if ($backup['tables'] > -1) {
                $nrOfTables = String::formatNumber($backup['tables']);
            }
            $nrOfRecords = $lang['L_UNKNOWN'];
            if ($backup['records'] > -1) {
                $nrOfRecords = String::formatNumber($backup['records']);
            }
            $fileCharset = $lang['L_UNKNOWN'];
            if ($backup['charset'] != '?') {
                $fileCharset = $backup['charset'];
            }
            $tplRestorePrepare->assign_block_vars(
                'FILE',
                array(
                    'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                    'FILE_INDEX' => $i,
                    'FILE_NAME' => $backup['name'],
                    'DB_NAME' => $dbName,
                    'DB_EXPAND_LINK' => $backup['db'],
                    'ICON_COMPRESSED' => $compressed,
                    'SCRIPT_VERSION' => $scriptVersion,
                    'COMMENT' => $comment,
                    'FILE_CREATION_DATE' => $backup['date'],
                    'NR_OF_TABLES' => $nrOfTables,
                    'NR_OF_RECORDS' => $nrOfRecords,
                    'FILESIZE' => byteOutput($backup['size']),
                    'FILE_CHARSET' => $fileCharset,
                    'NR_OF_MULTIPARTS' => $backup['multipart']
                )
            );

            if ($backup['multipart'] > 0) {
                $fileCount = $lang['L_FILES'];
                if ($backup['multipart'] == 1) {
                    $fileCount = $lang['L_FILE'];
                }
                $tplRestorePrepare->assign_block_vars(
                    'FILE.IS_MULTIPART', array('FILES' => $fileCount)
                );
            } else {
                $tplRestorePrepare->assign_block_vars(
                    'FILE.NO_MULTIPART', array()
                );
            }
            $i++;
        }
    }

    // list summary of other backup files grouped by databases
    ksort($backups['databases']);
    if (count($backups['databases']) > 0) {
        $i = 0;
        foreach ($backups['databases'] as $db => $info) {
            $rowclass = $i % 2 ? 'dbrow' : 'dbrow1';
            if ($db == $dbactive) $rowclass = 'dbrowsel';
            $dbNameOutput = $db;
            if ($db == '~unknown') {
                $dbNameOutput = '<i>' . $lang['L_NO_MSD_BACKUPFILE'] . '</i>';
            }
            if ($db == '~converted') {
                $dbNameOutput = '<i>' . $lang['L_CONVERTED_FILES'] . '</i>';
            }
            $nrOfBackups = '-';
            if (isset($info['backup_count'])) {
                $nrOfBackups = $info['backup_count'];
            }
            $latestBackup = '';
            if (isset($info['latest_backup_timestamp'])) {
                $latestBackup = $info['latest_backup_timestamp'];
            }
            $sumSize = 0;
            if (isset($info['backup_size_total'])) {
                $sumSize = byteOutput($info['backup_size_total']);
            }
            $tplRestorePrepare->assign_block_vars(
                'DB',
                array(
                    'ROWCLASS' => $rowclass,
                    'DB_NAME_LINK' => $db,
                    'DB_NAME' => $dbNameOutput,
                    'NR_OF_BACKUPS' => $nrOfBackups,
                    'LATEST_BACKUP' => $latestBackup,
                    'SUM_SIZE' => $sumSize
                )
            );
            $i++;
        }
    }

    $tplRestorePrepare->assign_vars(
        array(
            'ICON_VIEW' => $icon['view'],
            'ICON_RESTORE' => $icon['restore'],
            'SUM_SIZE' => byteOutput($backups['filesize_total']),
            'NOTIFICATION_POSITION' => $config['notification_position']
        )
    );

    $_SESSION['restore'] = $restore;
    $_SESSION['log'] = array();
    $_SESSION['log']['actions'] = array();
    $_SESSION['log']['errors'] = array();
    $_SESSION['log']['notices'] = array();
}

