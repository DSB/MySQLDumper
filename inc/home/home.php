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
$sumFiles = $sumSize = 0;
$lastBu = Array();
if ($action == '') {
    $action = 'status';
}
include ('./inc/define_icons.php');

if (isset($_POST['htaccess']) || $action == 'schutz') {
    include ('./inc/home/protection_create.php');
} elseif ($action == 'edithtaccess') {
    include ('./inc/home/protection_edit.php');
} elseif ($action == 'deletehtaccess') {
    include ('./inc/home/protection_delete.php');
}

if ($action == 'status') {
    $htaExists = (file_exists('./.htaccess'));
    if (!defined('MSD_MYSQL_VERSION')) GetMySQLVersion();
    // find latest backup file
    $dh = opendir($config['paths']['backup']);
    while (false !== ($fileName = readdir($dh))) {
        if ($fileName != '.' && $fileName != '..'
            && !is_dir($config['paths']['backup'] . $fileName)) {
            $files[] = $fileName;
            $sumFiles++;
            $sumSize += filesize($config['paths']['backup'] . $fileName);
            $ft = filectime($config['paths']['backup'] . $fileName);
            if (!isset($lastBu[2]) || (isset($lastBu[2]) && $ft > $lastBu[2])) {
                $lastBu[0] = $fileName;
                $lastBu[1] = date("d.m.Y H:i", $ft);
                $lastBu[2] = $ft;
            }
        }
    }
    $directoryWarnings = checkDirectories();

    $tplHome = new MSDTemplate();
    $tplHome->set_filenames(array('tplHome' => 'tpl/home/home.tpl'));
    $tplHome->assign_vars(
        array(
            'ICON_EDIT' => $icon['edit'],
            'ICON_DELETE' => $icon['delete'],
            'ICON_SEARCH' => $icon['search'],
            'THEME' => $config['theme'],
            'MSD_VERSION' => MSD_VERSION . ' (' . MSD_VERSION_SUFFIX . ')',
            'OS' => MSD_OS,
            'OS_EXT' => MSD_OS_EXT,
            'MYSQL_VERSION' => MSD_MYSQL_VERSION,
            'MYSQL_CLIENT_VERSION' => $dbo->getClientInfo(),
            'PHP_VERSION' => PHP_VERSION,
            'MEMORY' => byteOutput($config['php_ram'] * 1024 * 1024),
            'MAX_EXECUTION_TIME' => intval(@get_cfg_var('max_execution_time')),
            'MAX_EXEC_USED_BY_MSD' => $config['max_execution_time'],
            'PHP_EXTENSIONS' => $config['phpextensions'],
            'SERVER_NAME' => $_SERVER['SERVER_NAME'],
            'MSD_PATH' => $config['paths']['root'],
            'DB' => $config['db_actual'],
            'NR_OF_BACKUP_FILES' => $sumFiles,
            'SIZE_BACKUPS' => byteOutput($sumSize),
            'FREE_DISKSPACE' => getFreeDiskSpace()
        )
    );
    if ($directoryWarnings > '') {
        $tplHome->assign_block_vars(
            'DIRECTORY_WARNINGS', array('MSG' => $directoryWarnings)
        );
    }

    if ($config['disabled'] > '') {
        $tplHome->assign_block_vars(
            'DISABLED_FUNCTIONS',
            array(
                'PHP_DISABLED_FUNCTIONS' =>
                    str_replace(',', ', ', $config['disabled'])
            )
        );
    }
    // Zlib is buggy from version 4.3.0 upto 4.3.2,
    // so lets check for these versions
    if (version_compare(PHP_VERSION, '4.3.0', '>=')
        && version_compare(PHP_VERSION, '4.3.2', '<=')) {
            $tplHome->assign_block_vars('ZLIBBUG', array());
    }
    if (!extension_loaded('ftp')) {
        $tplHome->assign_block_vars('NO_FTP', array());
    }
    if (!$config['zlib']) {
        $tplHome->assign_block_vars('NO_ZLIB', array());
    }
    if ($htaExists) {
        $tplHome->assign_block_vars('HTACCESS_EXISTS', array());
    } else {
        $tplHome->assign_block_vars('HTACCESS_DOESNT_EXISTS', array());
    }
    if ($sumFiles > 0 && isset($lastBu[1])) {
        $fileSize = @filesize($config['paths']['backup'] . $lastBu[0]);
        $tplHome->assign_block_vars(
            'LAST_BACKUP',
            array(
                'INFO' => $lastBu[1],
                'LINK' => $config['paths']['backup'] . urlencode($lastBu[0]),
                'NAME' => $lastBu[0],
                'SIZE' => byteOutput($fileSize)
        )
        );
    }
}