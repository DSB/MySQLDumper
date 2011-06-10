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
    if (isset($_POST['msd_mode'])) {
        $config['msd_mode'] = (int) $_POST['msd_mode'];
    }
    if (isset($_POST['compression'])) {
        $config['compression'] = (int) $_POST['compression'];
    }
    if (isset($_POST['minspeed'])) {
        $config['minspeed'] = (int) $_POST['minspeed'];
    }
    if ($config['minspeed'] < 50) $config['minspeed'] = 50;
    if (isset($_POST['maxspeed'])) {
        $config['maxspeed'] = (int) $_POST['maxspeed'];
    }
    if ($config['maxspeed'] < $config['minspeed']) {
        $config['maxspeed'] = $config['minspeed'] * 2;
    }
    if (isset($_POST['stop_with_error'])) {
        $config['stop_with_error'] = (int) $_POST['stop_with_error'];
    }
    if (isset($_POST['multi_part'])) {
        $config['multi_part'] = (int) $_POST['multi_part'];
    }
    if (isset($_POST['multipartgroesse1'])) {
        $config['multipartgroesse1'] =
            floatval(str_replace(',', '.', $_POST['multipartgroesse1']));
    }
    if (isset($_POST['multipartgroesse2'])) {
        $config['multipartgroesse2'] = (int) $_POST['multipartgroesse2'];
    }
    if ($config['multipartgroesse1'] < 100
        && $config['multipartgroesse2'] == 1) {
            $config['multipartgroesse1'] = 100;
    }
    if ($config['multipartgroesse1'] < 1 && $config['multipartgroesse2'] == 2) {
        $config['multipartgroesse1'] = 1;
    }
    // if compression changes -> delete old log file
    $oldlogcompression = $config['logcompression'];
    if (isset($_POST['logcompression'])) {
        $config['logcompression'] = $_POST['logcompression'];
    } else {
        $config['logcompression'] = 0;
    }
    // if zlib-extension is not installed de-activate compression
    // for log and dump file automatically
    if (!$config['zlib']) {
        $config['logcompression'] = 0;
        $config['compression'] = 0;
    }
    // max size of logfiles
    if (isset($_POST['log_maxsize1'])) {
        $config['log_maxsize1'] = (int) $_POST['log_maxsize1'];
    }
    if (isset($_POST['log_maxsize2'])) {
        $config['log_maxsize2'] = (int) $_POST['log_maxsize2'];
    }
    if ($config['log_maxsize1'] < 1) {
        $config['log_maxsize1'] = 1;
    }
    if ($config['log_maxsize1'] < 100 && $config['log_maxsize2'] == 1) {
        $config['log_maxsize1'] = 100;
    }
    if ($config['log_maxsize2'] == 1) {
        $config['log_maxsize'] = 1024 * $config['log_maxsize1']; // kB
    } else {
        $config['log_maxsize'] = 1024 * 1024 * $config['log_maxsize1']; // MB
    }
    if (isset($_POST['empty_db_before_restore'])) {
        $config['empty_db_before_restore'] =
            (int) $_POST['empty_db_before_restore'];
    }
    if (isset($_POST['optimize_tables'])) {
        $config['optimize_tables_beforedump'] = (int) $_POST['optimize_tables'];
    }
    //if we are not in mode expert -> reset hidden settings to safe defaults
    if ($config['msd_mode'] == 0) {
        $config['empty_db_before_restore'] = 0;
    }
}

$tplConfigurationGeneral = new MSDTemplate();
$tplConfigurationGeneral->set_filenames(
    array('tplConfigurationGeneral' => 'tpl/configuration/general.tpl')
);
if ($config['msd_mode'] > 0) {
    $tplConfigurationGeneral->assign_block_vars('MODE_EXPERT', array());
}
$logGz = !$config['zlib'] ? '' : Html::getChecked($config['logcompression'], 1);

$tplConfigurationGeneral->assign_vars(
    array(
        'ICON_SAVE' => $icon['small']['save'],
        'MSD_MODE_EASY_SELECTED' => Html::getChecked($config['msd_mode'], 0),
        'MSD_MODE_EXPERT_SELECTED' => Html::getChecked($config['msd_mode'], 1),
        'GZ_DISABLED' => Html::getDisabled($config['zlib'], 0),
        'LOG_GZ_SELECTED' => $logGz,
        'LOG_MAXSIZE1' => $config['log_maxsize1'],
        'LOG_UNIT_KB_SELECTED' => Html::getSelected($config['log_maxsize2'], 1),
        'LOG_UNIT_MB_SELECTED' => Html::getSelected($config['log_maxsize2'], 2),
        'PHP_MEMORY_LIMIT' => $config['memory_limit'],
        'MIN_SPEED' => $config['minspeed'],
        'MAX_SPEED' => $config['maxspeed'],
        'DUMP_GZ_ENABLED_SELECTED' =>
            Html::getChecked($config['compression'], 1),
        'DUMP_GZ_DISABLED_SELECTED' =>
            Html::getChecked($config['compression'], 0),
        'MULTIPART_ENABLED_SELECTED' =>
            Html::getChecked($config['multi_part'], 1),
        'MULTIPART_DISABLED_SELECTED' =>
            Html::getChecked($config['multi_part'], 0),
        'MULTIPART_FILE_SIZE' => $config['multipartgroesse1'],
        'MULTIPART_DISABLED' => Html::getDisabled($config['multi_part'], 0),
        'MULTIPART_FILE_SIZE_DISABLED' =>
            Html::getDisabled($config['multi_part'], 0),
        'MULTIPART_FILE_UNIT_KB_SELECTED' =>
            Html::getSelected($config['multipartgroesse2'], 1),
        'MULTIPART_FILE_UNIT_MB_SELECTED' =>
            Html::getSelected($config['multipartgroesse2'], 2),
        'OPTIMIZE_TABLES_ENABLED_SELECTED' =>
            Html::getChecked($config['optimize_tables_beforedump'], 1),
        'OPTIMIZE_TABLES_DISABLED_SELECTED' =>
            Html::getChecked($config['optimize_tables_beforedump'], 0),
        'TRUNCATE_DB_ENABLED_SELECTED' =>
            Html::getChecked($config['empty_db_before_restore'], 1),
        'TRUNCATE_DB_DISABLED_SELECTED' =>
            Html::getChecked($config['empty_db_before_restore'], 0),
        'STOP_ON_ERROR_ENABLED_SELECTED' =>
            Html::getChecked($config['stop_with_error'], 1),
        'STOP_ON_ERROR_DISABLED_SELECTED' =>
            Html::getChecked($config['stop_with_error'], 0)
    )
);

