<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package      MySQLDumper
 * @version      SVN: $rev: 1207 $
 * @author       $Author$
 * @lastmodified $Date$
 */

if (!defined('MSD_VERSION')) die('No direct access.');
$oldConfig = $config['config_file'];
if (isset($_GET['config'])) {
    $oldDatabases = $databases;
    $databases = array();
    if (isset($_POST['save'])) {
        unset($_POST['save']);
    }
    if (getConfig($_GET['config'])) {
        $config['config_file'] = $_GET['config'];
        $_SESSION['config_file'] = $_GET['config'];
        $oldConfig = $_GET['config'];
        $msg = '<p class="success">'
            . sprintf($lang['L_CONFIG_LOADED'], $config['config_file'])
            . '</p>';
    } else {
        getConfig($oldConfig);
        $databases = $oldDatabases;
        $msg = '<p class="error">'
            . sprintf(
                $lang['L_ERROR_LOADING_CONFIGFILE'],
                $config['config_file']
            ) . '</p>';
    }
}

if (isset($_GET['config_delete'])) {
    $deleteConfig = urldecode($_GET['config_delete']);
    if ($deleteConfig == $config['config_file']) {
        //actaul configuration was deleted, fall back to mysqldumper-conf
        $config['config_file'] = 'mysqldumper';
        $_SESSION['config_file'] = $config['config_file'];
        getConfig($config['config_file']);
    }
    $del = @unlink('./' . $config['paths']['config'] . $deleteConfig . '.php');
    if ($del) {
        // delete Perl config file
        $delFile = $config['paths']['config'] . $deleteConfig . '.conf.php';
        $del = @unlink('./' . $delFile);
    }
    if ($del === false) {
        $msg = '<p class="error">'
            . sprintf($lang['L_ERROR_DELETING_CONFIGFILE'], $deleteConfig)
            . '</p>';
    } else {
        $msg = '<p class="success">'
            . sprintf($lang['L_SUCCESS_DELETING_CONFIGFILE'], $deleteConfig)
            . '</p>';
    }
    $sel = 'configs';
}

$tplConfigurationConfigFiles = new MSDTemplate();
$tplConfigurationConfigFiles->set_filenames(
    array(
        'tplConfigurationConfigFiles' => 'tpl/configuration/configFiles.tpl'
    )
);
$tplConfigurationConfigFiles->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'ICON_SEARCH' => $icon['search'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_DELETE' => $icon['delete']
    )
);
$i = 0;
$configs = getConfigFilenames();
// iterate config files and print settings to screen
foreach ($configs as $c) {
    $i++;
    unset($databases);
    $databases = array();
    getConfig($c);
    $rowclass = ($i % 2) ? 'dbrow' : 'dbrow1';
    if ($oldConfig == $c) {
        $rowclass = 'dbrowsel'; // highlight active configuration
    }
    // Generate configuration output
    $outputstringMultisettings = '';
    $dbsToBackup = array();
    // look up which databases are set to be dumped
    prepareDumpProcess();
    $dbs = array_keys($dump['databases']);
    $dbsToBackup = implode(', ', $dbs);

    $tplConfigurationConfigFiles->assign_block_vars(
        'ROW',
        array(
            'ROWCLASS' => $rowclass,
            'NR' => $i,
            'CONFIG_ID' => sprintf("%03d", $i),
            'CONFIG_NAME' => $c,
            'CONFIG_NAME_URLENCODED' => urlencode($c),
            'DB_HOST' => $config['dbhost'],
            'DB_USER' => $config['dbuser'],
            'NR_OF_DATABASES' => sizeof($databases),
            'DBS_TO_BACKUP' => $dbsToBackup . '&nbsp;',
            'ATTACH_BACKUP' =>
                $config['email']['attach_backup'] == 1 ?
                    $lang['L_YES'] : $lang['L_NO']
        )
    );

    if (count($databases) > 0) {
        $a = 1;
        foreach ($databases as $dbName => $val) {
            $tplConfigurationConfigFiles->assign_block_vars(
                'ROW.LIST_DBS',
                array(
                    'ROWCLASS' => $a % 2 ? 'dbrow' : 'dbrow1',
                    'NR' => $a,
                    'DB_NAME_URLENCODED' => base64_encode($dbName),
                    'DB_NAME' => $dbName
                )
            );
            $a++;
        }
    }

    // is Multipart used?
    if ($config['multi_part'] == 1) {
        $tplConfigurationConfigFiles->assign_block_vars(
            'ROW.USE_MULTIPART',
            array(
                'MULTIPART_FILESIZE' =>
                    byteOutput($config['multipart_groesse'])
            )
        );
    }

    // send mail after backup?
    if ($config['send_mail'] == 1) {
        $recipientsCc = implodeSubarray(
            $config['email']['recipient_cc'],
            'address'
        );
        if ($config['email']['recipient_name'] > '') {
            $recipient = $config['email']['recipient_name'];
        } else {
            $recipient = $config['email']['recipient_address'];
        }
        $tplConfigurationConfigFiles->assign_block_vars(
            'ROW.SEND_EMAIL',
            array(
                'RECIPIENT' => $recipient,
                'RECIPIENT_CC' =>
                    $recipientsCc > '' ? $recipientsCc : $lang['L_NO']
            )
        );
        $bytes = $config['email_maxsize1'] * 1024;
        if ($config['email_maxsize2'] == 2) $bytes = $bytes * 1024;
        if ($config['email']['attach_backup'] == 1) {
                $tplConfigurationConfigFiles->assign_block_vars(
                    'ROW.SEND_EMAIL.EMAIL_MAX_SIZE',
                    array(
                        'SIZE' => byteOutput($bytes)
                    )
                );
        }
    }

    // FTP settings
    foreach ($config['ftp'] as $ftp) {
        if ($ftp['transfer'] > 0) {
            $ftpSettings = sprintf(
                    $lang['L_FTP_SEND_TO'], $ftp['server'], $ftp['dir']
            );
            $tplConfigurationConfigFiles->assign_block_vars(
                'ROW.SEND_FTP',
                array(
                    'FTP_SETTINGS' => Html::replaceQuotes($ftpSettings)
                )
            );
        }
    }

    // Show delete-button if it is not the standard config file
    if ($c != 'mysqldumper') {
        $confirmDelete = sprintf($lang['L_CONFIRM_CONFIGFILE_DELETE'], $c);
        $tplConfigurationConfigFiles->assign_block_vars(
            'ROW.DELETE_CONFIG',
            array(
                'CONFIRM_DELETE' => Html::getJsQuote($confirmDelete)
            )
        );
    }
}

unset($databases);
$databases = array();
$_SESSION['config_file'] = $oldConfig;
$config['config_file'] = $oldConfig;
// reload actual configuration
getConfig($oldConfig);
