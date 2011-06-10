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
$fileName = (isset($_GET['filename'])) ? urldecode($_GET['filename']) : '';
if (isset($_POST['file'][0])) {
    $fileName = $_POST['file'][0];
}

$tplRestoreSelectTables = new MSDTemplate();
$tplRestoreSelectTables->set_filenames(
    array('tplRestoreSelectTables' => 'tpl/restore/selectTables.tpl')
);
//Get Header-Infos from file
$sline = readStatusline($fileName);
if ($sline['records'] == -1) {
    // not a backup of MySQLDumper
    $tplRestoreSelectTables->assign_block_vars('NO_MSD_BACKUP', array());
} else {
    // Get Tableinfo from file header
    $tabledata = getTableHeaderInfoFromBackup($fileName);
    for ($i = 0; $i < sizeof($tabledata); $i++) {
        $klasse = ($i % 2) ? 1 : '';
        $tplRestoreSelectTables->assign_block_vars(
            'ROW',
            array(
                'CLASS' => 'dbrow' . $klasse,
                'ID' => $i,
                'NR' => $i + 1,
                'TABLENAME' => $tabledata[$i]['name'],
                'RECORDS' => String::formatNumber($tabledata[$i]['records']),
                'SIZE' => byteOutput($tabledata[$i]['size']),
                'LAST_UPDATE' => $tabledata[$i]['update'],
                'TABLETYPE' => $tabledata[$i]['engine']
            )
        );
    }
}

$confirmRestore = $lang['L_FM_ALERTRESTORE1'] . ' `' . $config['db_actual']
    . '`  ' . $lang['L_FM_ALERTRESTORE2'] . ' ' . $fileName . ' '
    . $lang['L_FM_ALERTRESTORE3'];

$tplRestoreSelectTables->assign_vars(
    array(
        'PAGETITLE' => $lang['L_RESTORE'] . ' - ' . $lang['L_TABLESELECTION'],
        'DATABASE' => $config['db_actual'],
        'FILENAME' => $fileName,
        'ICON_OK' => $icon['ok'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_RESTORE' => $icon['restore'],
        'L_NO_MSD_BACKUP' => $lang['L_NOT_SUPPORTED'],
        'CONFIRM_RESTORE' => $confirmRestore
    )
);
