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
$expand = (isset($_GET['expand'])) ? $_GET['expand'] : -1;

// execute delete action if clicked
if (isset($_POST['delete']) || isset($_POST['deleteauto'])
    || isset($_POST['deleteall']) || isset($_POST['deleteallfilter'])) {
        include ('./inc/filemanagement/file_delete.php');
}

$tplFiles = new MSDTemplate();
$tplFiles->set_filenames(array('tplFiles' => 'tpl/filemanagement/files.tpl'));

$dbactualOutput = $dbactive;
// replace internal keys for backups of other programs and converted files
// with human readable output
if ($dbactive == '~unknown') {
    $dbactualOutput = '<i>' . $lang['L_UNKNOWN'] . '</i>';
}
if ($dbactive == '~converted') {
    $dbactualOutput = '<i>' . $lang['L_CONVERTED_FILES'] . '</i>';
}
$autoDelete = $lang['L_NOT_ACTIVATED'];
if ($config['auto_delete']['activated'] > 0) {
    $autoDelete = $lang['L_ACTIVATED'] . ' ('
        . $config['auto_delete']['max_backup_files'] . ' '
        . $lang['L_MAX_BACKUP_FILES_EACH2'] . ')';
}

$tplFiles->assign_vars(
    array(
        'BACKUP_PATH' => $config['paths']['backup'],
        'ICON_DOWNLOAD' => $icon['open_file'],
        'ICON_VIEW' => $icon['view'],
        'ICON_DELETE' => $icon['delete'],
        'DB_ACTUAL' => $dbactive,
        'DB_ACTUAL_OUTPUT' => $dbactualOutput,
        'UPLOAD_MAX_SIZE' => $config['upload_max_filesize'],
        'AUTODELETE_ENABLED' => $autoDelete,
        'NOTIFICATION_POSITION' => $config['notification_position']
    )
);

if ($msg > '') {
    $tplFiles->assign_block_vars(
        'MESSAGE', array('TEXT' => Html::getJsQuote($msg, true))
    );
}
$backups = getBackupfileInfo();
$i = 0;
if (!isset($backups['databases'][$dbactive])) {
    $tplFiles->assign_block_vars('NO_FILE_FOUND', array());
}
if ($dbactive != '~unknown' && $dbactive != '~converted') {
    $tplFiles->assign_block_vars('DELETE_FILTER', array());
}
// show detailed file info of the selected database at top
foreach ($backups['files'] as $backup) {
    if ($backup['db'] == $dbactive) {
        // get MySQL Version from which the backup was taken
        $mysqlVersion = '';
        if (isset($backup['mysqlversion'])) {
            $mysqlVersion = $backup['mysqlversion'];
        }
        // get grouping name of database
        $dbName = $backup['name'];
        if (!in_array($backup['db'], array('~unknown', '~converted'))) {
            $dbName = $backup['db'];
        }
        // with which MSD-Version was the backup made?
        $scriptVersion = $lang['L_UNKNOWN'];
        if ($backup['script'] > '') {
            $scriptVersion = $backup['script'];
        }
        // show Gzip-Icon?
        $compressed = substr($backup['name'], -3) == '.gz' ? $icon['gz'] : '-';
        // is a commetn given?
       $comment = '';
       if ($backup['comment'] > '') {
           $comment = nl2br(wordwrap($backup['comment'], 50));
       }
        // number of tables
        $nrOfTables =  $lang['L_UNKNOWN'];
        if ($backup['tables'] > -1) {
            $nrOfTables = String::formatNumber($backup['tables']);
        }
        // number of records
        $nrOfRecords =  $lang['L_UNKNOWN'];
        if ($backup['records'] > -1) {
            $nrOfRecords = String::formatNumber($backup['records']);
        }
        // charset of bakup file
        $charset =  $lang['L_UNKNOWN'];
        if ($backup['charset'] != '?') {
            $charset = $backup['charset'];
        }

        $tplFiles->assign_block_vars(
            'FILE',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'FILE_INDEX' => $i,
                // expand or unexpand multipart list on next click
                'FILE_EXPAND_INDEX' => $expand == $i ? -1 : $i,
                'FILE_NAME' => $backup['name'],
                'FILE_NAME_URLENCODED' => urlencode($backup['name']),
                'DB_NAME' => $dbName,
                'ICON_COMPRESSED' => $compressed,
                'SCRIPT_VERSION' => $scriptVersion,
                'COMMENT' => $comment,
                'FILE_CREATION_DATE' => $backup['date'],
                'NR_OF_TABLES' => $nrOfTables,
                'NR_OF_RECORDS' => $nrOfRecords,
                'FILESIZE' => byteOutput($backup['size']),
                'FILE_CHARSET' => $charset,
                'NR_OF_MULTIPARTS' => $backup['multipart'],
                'MYSQL_VERSION' => $mysqlVersion
            )
        );

        if ($backup['multipart'] > 0) {
            $mpFileHeadline = $lang['L_FILES'];
            if ($backup['multipart'] == 1) {
                $mpFileHeadline = $lang['L_FILE'];
            }
            $tplFiles->assign_block_vars(
                'FILE.IS_MULTIPART', array('FILES' => $mpFileHeadline)
            );
        } else {
            $tplFiles->assign_block_vars('FILE.NO_MULTIPART', array());
        }
        if ($backup['multipart'] > 0) {
            // show all files of a Multipart-backup
            $tplFiles->assign_block_vars(
                'FILE.EXPAND_MULTIPART',
                array(
                    'NR' => $i,
                    'ROWCLASS' => $i % 2 ? 'dbrow1' : 'dbrow'
                )
            );
            // expand multipartlist if click came from restore screen
            if ($expand == $i) {
                $tplFiles->assign_block_vars(
                    'EXPAND_MP_FILE', array('FILEINDEX' => $i)
                );
            }

            $partPosition = strrpos($backup['name'], 'part_');
            $fileBase = substr($backup['name'], 0, $partPosition) . 'part_';
            $fileExtension = '.sql';
            if (substr($backup['name'], -2) == 'gz') {
                $fileExtension = '.sql.gz';
            }
            for ($x = 0; $x < $backup['multipart']; $x++) {
                $fileName = $fileBase . ($x + 1) . $fileExtension;
                $fileSize = $lang['L_UNKNOWN'];
                $file = $config['paths']['backup'] . $fileName;
                if (!is_readable($file)) {
                    $fileName = $backup['name'];
                    $fileSize = byteOutput(@filesize($file));
                }
                $tplFiles->assign_block_vars(
                    'FILE.EXPAND_MULTIPART.MP_FILE',
                    array(
                        'ROWCLASS' => $x % 2 ? 'dbrow' : 'dbrow1',
                        'NR' => $x + 1,
                        'FILE_NAME' => $fileName,
                        'FILE_NAME_URLENCODED' => urlencode($fileName),
                        'FILE_SIZE' => $fileSize
                    )
                );
            }
        }
        $i++;
    }
}

//sort databases according to the databasenames ascending
ksort($backups['databases']);
// list summary of other backup files grouped by databases
if (count($backups['databases']) > 0) {
    $i = 0;
    foreach ($backups['databases'] as $db => $info) {
        $rowclass = $i % 2 ? 'dbrow' : 'dbrow1';
        if ($db == $dbactive) {
            $rowclass = 'dbrowsel';
        }
        $dbNameOutput = $db;
        if ($db == '~unknown') {
            $dbNameOutput = '<i>' . $lang['L_NO_MSD_BACKUPFILE'] . '</i>';
        }
        if ($db == '~converted') {
            $dbNameOutput = '<i>' . $lang['L_CONVERTED_FILES'] . '</i>';
        }

        $nrOfBackups = isset($info['backup_count']) ? $info['backup_count'] : 0;
        $latestBackup = '-';
        if (isset($info['latest_backup_timestamp'])) {
            $latestBackup = $info['latest_backup_timestamp'];
        }
        $fileSizeTotal = 0;
        if (isset($info['backup_size_total'])) {
            $fileSizeTotal = byteOutput($info['backup_size_total']);
        }

        $tplFiles->assign_block_vars(
            'DB',
            array(
                'ROWCLASS' => $rowclass,
                'DB_NAME_LINK' => $db,
                'DB_NAME' => $dbNameOutput,
                'NR_OF_BACKUPS' => $nrOfBackups,
                'LATEST_BACKUP' => $latestBackup,
                'SUM_SIZE' => $fileSizeTotal
            )
        );
        $i++;
    }
}

$tplFiles->assign_vars(
    array(
        'SUM_SIZE' => byteOutput($backups['filesize_total']),
        'FREESPACE_ON_SERVER' => getFreeDiskSpace()
    )
);
