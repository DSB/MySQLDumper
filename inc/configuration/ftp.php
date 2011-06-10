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

if (!defined('MSD_VERSION')) {
    die('No direct access.');
}
// will hold connection result if ftp connection should be checked
$ftpConnectionCheck = array();
if (isset($_POST['save'])) {
    if (!is_array($config['ftp'])) {
        $config['ftp'] = array();
    }
    // add ftp connection
    if (!isset($_POST['ftp'])) {
        $_POST['ftp'] = array();
    }
    if (isset($_POST['ftp_add_new_connection'])) {
        $_POST['ftp'][count($_POST['ftp'])] = array();
    }

    foreach ($_POST['ftp'] as $key => $val) {
        // set default values if this connection is a new one
        if (!isset($config['ftp'][$key]) || !is_array($config['ftp'][$key])) {
            $config['ftp'][$key] = array();
        }
        if (!isset($config['ftp'][$key]['server'])) {
            $config['ftp'][$key]['server'] = '';
        }
        if (!isset($config['ftp'][$key]['transfer'])) {
            $config['ftp'][$key]['transfer'] = 0;
        }
        if (!isset($config['ftp'][$key]['timeout'])) {
            $config['ftp'][$key]['timeout'] = 10;
        }
        if (!isset($config['ftp'][$key]['ssl'])) {
            $config['ftp'][$key]['ssl'] = 0;
        }
        if (!isset($config['ftp'][$key]['mode'])) {
            $config['ftp'][$key]['mode'] = 0;
        }
        if (!isset($config['ftp'][$key]['port'])) {
            $config['ftp'][$key]['port'] = 21;
        }
        if (!isset($config['ftp'][$key]['user'])) {
            $config['ftp'][$key]['user'] = '';
        }
        if (!isset($config['ftp'][$key]['pass'])) {
            $config['ftp'][$key]['pass'] = '';
        }
        if (!isset($config['ftp'][$key]['dir'])) {
            $config['ftp'][$key]['dir'] = '/';
        }
        if (isset($val['transfer'])) {
            $config['ftp'][$key]['transfer'] = (int) $val['transfer'];
        }
        if (isset($val['server'])) {
            $config['ftp'][$key]['server'] = (string) $val['server'];
        }
        if (isset($val['timeout'])) {
            $config['ftp'][$key]['timeout'] = (int) $val['timeout'];
        }
        if (isset($val['ssl'])) {
            $config['ftp'][$key]['ssl'] = (int) $val['ssl'];
        }
        if (isset($val['mode'])) {
            $config['ftp'][$key]['mode'] = (int) $val['mode'];
        }
        if (isset($val['port'])) {
            $config['ftp'][$key]['port'] = (int) $val['port'];
        }
        if (isset($val['user'])) {
            $config['ftp'][$key]['user'] = (string) $val['user'];
        }
        if (isset($val['pass'])) {
            $config['ftp'][$key]['pass'] = (string) $val['pass'];
        }
        if (isset($val['dir'])) {
            $config['ftp'][$key]['dir'] = (string) $val['dir'];
        }
        if ($config['ftp'][$key]['dir'] == ''
            || (strlen($config['ftp'][$key]['dir']) > 1
            && substr($config['ftp'][$key]['dir'], -1) != '/')) {
                $config['ftp'][$key]['dir'] .= '/';
        }
        if (isset($_POST['ftp'][$key]['test'])) {
            $ftpConnectionCheck[$key] = testFTP($key);
            // don't save values - we just want to test the ftp connection data
            $saveConfig = false;
        }
    }
}

if (isset($_GET['del_ftp'])) {
    $index = intval($_GET['del_ftp']);
    if (isset($config['ftp'][$index])) {
        unset($config['ftp'][$index]);
    }
    sort($config['ftp']);
}

$tplConfigurationFtp = new MSDTemplate();
$tplConfigurationFtp->set_filenames(
    array('tplConfigurationFtp' => 'tpl/configuration/ftp.tpl')
);

$tplConfigurationFtp->assign_vars(
    array(
        'ICON_ADD' => $icon['plus'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_SAVE' => $icon['small']['save']
    )
);

foreach ($config['ftp'] as $key => $val) {
    // if ftp extension is not loaded -> disable ftp transfer
    if (!extension_loaded('ftp')) {
        $config['ftp'][$key]['transfer'] = 0;
    }

    $tplConfigurationFtp->assign_block_vars(
        'FTP',
        array(
            'NR' => $key + 1,
            'ID' => $key,
            'FTP_DISABLED' => Html::getDisabled(!extension_loaded("ftp"), true),
            'FTP_ENABLED_SELECTED' => Html::getChecked($val['transfer'], 1),
            'FTP_DISABLED_SELECTED' => Html::getChecked($val['transfer'], 0),
            'FTP_FIELDS_DISABLED' => Html::getDisabled($val['transfer'], 0),
            'FTP_TIMEOUT' => $val['timeout'],
            'FTP_PASSIVE_MODE_SELECTED' => Html::getChecked($val['mode'], 1),
            'FTP_SSL_DISABLED' =>
                Html::getDisabled(extension_loaded('openssl'), false),
            'FTP_SSL_ENABLED_SELECTED' => Html::getChecked($val['ssl'], 1),
            'FTP_SERVER' => $config['ftp'][$key]['server'],
            'FTP_PORT' => $val['port'],
            'FTP_USER' => Html::replaceQuotes($val['user']),
            'FTP_PASSWORD' => Html::replaceQuotes($val['pass']),
            'FTP_DIRECTORY' => $val['dir'],
            'FTP_CONFIRM_DELETE' =>
                Html::replaceQuotes($lang['L_FTP_CONFIRM_DELETE'])
        )
    );
    if (isset($ftpConnectionCheck[$key])) {
        $tplConfigurationFtp->assign_block_vars(
            'FTP.CHECK', array('RESULT' => $ftpConnectionCheck[$key])
        );
    }
}
