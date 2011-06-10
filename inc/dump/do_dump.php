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

// first call of a new backup progress -> set start values
$dump = $_SESSION['dump'];
$dump['tables_total'] = 0;
$dump['records_total'] = 0;
$dump['tables_optimized'] = 0;
$dump['part'] = 1;
$dump['part_offset'] = 0;
$dump['errors'] = 0;
//-1 instead of 0 is needed for the execution of command before backup
$dump['table_offset'] = -1;
$dump['table_record_offset'] = 0;
$dump['filename_stamp'] = '';
$dump['speed'] = $config['minspeed'] > 0 ? $config['minspeed'] : 50;
$dump['max_zeit'] =
    (int) $config['max_execution_time'] * $config['time_buffer'];
$dump['dump_start_time'] = time();
$dump['countdata'] = 0;
$dump['table_offset_total'] = 0;
$dump['page_refreshs'] = 0;
// used as overall flag including e-mail and ftp-actions
$dump['backup_in_progress'] = 1;
// used to determine id databases still need to be dumped
$dump['backup_done'] = 0;
$dump['selected_tables'] = FALSE;
if (isset($_POST['sel_tbl'])) {
    $dump['selected_tables'] = $_POST['sel_tbl'];
}
// function was called in dump_prepare
// -- maybe get rid of this second call later on
prepareDumpProcess();
// last_db_actual is used to detect if db changed in multidump-mode
// -> set to first db
$dump['last_db_actual'] = $dump['db_actual'];

$_SESSION['config_file'] = $config['config_file'];
$_SESSION['dump'] = $dump;

$tplDoDump = new MSDTemplate();
$tplDoDump->set_filenames(array('tplDoDump' => 'tpl/dump/dump.tpl'));
$gzip = $config['compression'] == 1 ? $icon['gz'] : $lang['L_NOT_ACTIVATED'];
$tplDoDump->assign_vars(
    array(
        'ICONPATH' => $config['files']['iconpath'],
        'GZIP' => $gzip,
        'SESSION_ID' => session_id(),
        'NOTIFICATION_POSITION' => $config['notification_position']
    )
);

$sizeUnits = array(1, 1024, 1024 * 1024, 1024 * 10242 * 1024);
$size = $config['multipartgroesse1'] * $sizeUnits[$config['multipartgroesse2']];
if ($config['multi_part'] > 0) {
    $tplDoDump->assign_block_vars(
        'MULTIPART', array('SIZE' => byteOutput($size))
    );
}

$tplDoDump->assign_var('TABLES_TO_DUMP', $dump['tables_total']);

