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

if (isset($_POST['save'])) {
    $config['cron_comment'] = $_POST['cron_comment'];
    if (isset($_POST['cron_extender'])) {
        $config['cron_extender'] = (int) $_POST['cron_extender'];
    }
    // cron_select_savepath/
    if (!isset($_POST['cron_select_savepath'])) {
        $_POST['cron_select_savepath'] = $config['config_file'];
    }
    $config['cron_execution_path'] = $_POST['cron_execution_path'];
    if ($config['cron_execution_path'] == '') {
        $config['cron_execution_path'] = 'msd_cron/';
    }
    if (strlen($config['cron_execution_path']) > 1
        && substr($config['cron_execution_path'], -1) != '/') {
            $config['cron_execution_path'] .= '/';
    }
    if (isset($_POST['cron_printout'])) {
        $config['cron_printout'] = (int) $_POST['cron_printout'];
    }
    if (isset($_POST['cron_completelog'])) {
        $config['cron_completelog'] = (int) $_POST['cron_completelog'];
    }
    if (isset($_POST['compression'])) {
        $config['cron_compression'] = (int) $_POST['compression'];
    }
    if (isset($_POST['cron_completelog'])) {
        $config['cron_completelog'] = (int) $_POST['cron_completelog'];
    }
}

$tplConfigurationCronscript = new MSDTemplate();
$tplConfigurationCronscript->set_filenames(
    array('tplConfigurationCronscript' => 'tpl/configuration/cronscript.tpl')
);

$tplConfigurationCronscript->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'EXTENSION_PL_SELECTED' =>
            Html::getChecked($config['cron_extender'], 0),
        'EXTENSION_CGI_SELECTED' =>
            Html::getChecked($config['cron_extender'], 1),
        'EXEC_PATH' => $config['cron_execution_path'],
        'CRON_PRINTOUT_ENABLED_SELECTED' =>
            Html::getChecked($config['cron_printout'], 1),
        'CRON_PRINTOUT_DISABLED_SELECTED' =>
            Html::getChecked($config['cron_printout'], 0),
        'CRON_COMPLETELOG_ENABLED_SELECTED' =>
            Html::getChecked($config['cron_completelog'], 1),
        'CRON_COMPLETELOG_DISABLED_SELECTED' =>
            Html::getChecked($config['cron_completelog'], 0),
        'CRON_COMMENT' =>
            htmlspecialchars($config['cron_comment'], ENT_COMPAT, 'UTF-8')
    )
);
