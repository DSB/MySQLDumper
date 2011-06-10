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

// language changed?
if (isset($_POST['save']) && isset($_POST['lang_old'])
    && $_POST['language'] != $_POST['lang_old']) {
    $config['language'] = $_POST['language'];
    $_SESSION['config']['language'] = $_POST['language'];
    include ('./language/' . $config['language'] . '/lang.php');
}
include ('./inc/functions/functions_sql.php');
include ('./inc/functions/functions_dump.php');
include ('./language/lang_list.php');
include ('./inc/define_icons.php');

if (!isset($msg)) {
    $msg = '';
}
$saveConfig = false;
$blendInConnectionParams = false;
$oldTheme = $config['theme'];
if (isset($_POST['save'])) {
    // $saveConfig will be set to false if fatal errors occur while validating
    $saveConfig = true;
}

include ('./inc/configuration/databases.php');
include ('./inc/configuration/general.php');
include ('./inc/configuration/interface.php');
include ('./inc/configuration/autodelete.php');
include ('./inc/configuration/email.php');
include ('./inc/configuration/ftp.php');
include ('./inc/configuration/cronscript.php');

// should a new configuration file be created?
if (isset($_GET['create_new_configfile'])) {
    $saveConfig = false;
    if ($_POST['new_configurationfile'] > '') {
        $tmpConfigfilename = utf8_decode(trim($_POST['new_configurationfile']));
        if (!preg_match("/^[a-z.-_]+$/i", $tmpConfigfilename, $matches)) {
            $msg = sprintf(
                $lang['L_ERROR_CONFIGFILE_NAME'],
                $_POST['new_configurationfile']
            );
            $msg = Html::getErrorMsg($msg);
        } else {
            $config['config_file'] = $_POST['new_configurationfile'];
            $config['cron_configurationfile'] = $_POST['new_configurationfile']
                . ".conf.php";
            $saveConfig = true;
        }

        if ($saveConfig) {
            if (saveConfig() == true) {
                $saveConfig = false;
                $msg = sprintf(
                    $lang['L_SUCCESS_CONFIGFILE_CREATED'],
                    $_POST['new_configurationfile']
                );
                $msg = Html::getOkMsg($msg);
            } else {
                $msg = Html::getErrorMsg($lang['L_SAVE_ERROR']);
                $saveConfig = false;
            }
        }
    } else {
        $msg = Html::getErrorMsg($lang['L_NO_NAME_GIVEN']);
    }
}

if ($saveConfig) {
    // validation was fine, we can write the values to the actual config file
    if (saveConfig() == true) {
        getConfig($config['config_file']);
        if ($config['logcompression'] != $oldlogcompression) {
            deleteLog();
        }
        $msg = sprintf($lang['L_SAVE_SUCCESS'], $config['config_file']);
        $msg = Html::getOkMsg($msg);
    } else {
        $msg = Html::getErrorMsg($lang['L_SAVE_ERROR']);
    }
}
include ('./inc/configuration/config_files.php');
include ('./inc/configuration/config_menu.php');
include ('./inc/configuration/footer.php');
