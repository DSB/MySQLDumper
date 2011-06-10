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
// action is called, even if the checkbox "select tables" was not checked

// save selected values from the last site
$dump['comment'] = $_POST['comment'];
$dump['sel_dump_encoding'] = $_POST['sel_dump_encoding'];
$dump['dump_encoding'] = $dump['sel_dump_encoding'];
// we need to save this before the Ajax-Requests starts, so we are doing it here
// although it is done in dump.php
$_SESSION['dump'] = $dump;
// checks after first dump-prepare if we need to head over to table selection
// or if we can start the backup process
if (!isset($_POST['tableselect'])) {
    // nothing to select - start dump action
    $action = 'do_dump';
} else {
    // yes, we need to show the table-selection, but first save commetn and
    // encoding that was set before
    $tplDumpSelectTables = new MSDTemplate();
    $tplDumpSelectTables->set_filenames(
        array('tplDumpSelectTables' => 'tpl/dump/selectTables.tpl')
    );
    $dbo->selectDb($dump['db_actual']);
    $tables=$dbo->getTableStatus();
    $i=0;
    foreach ($tables as $tableName => $row) {
        $klasse = ($i % 2) ? 1 : '';
        $tableSize = byteOutput($row['Data_length'] + $row['Index_length']);
        $tableType = $row['Engine'];
        $nrOfRecords = String::formatNumber($row['Rows']);
        if (substr($row['Comment'], 0, 4) == 'VIEW' && $row['Engine'] == '') {
            $tableType = 'View';
            $tableSize = '-';
            $nrOfRecords = '-';
        }
        $tplDumpSelectTables->assign_block_vars(
            'ROW',
            array(
                'CLASS' => 'dbrow' . $klasse,
                'ID' => $i,
                'NR' => $i + 1,
                'TABLENAME' => $tableName,
                'TABLETYPE' => $tableType,
                'RECORDS' => $nrOfRecords,
                'SIZE' => $tableSize,
                'LAST_UPDATE' => $row['Update_time']
            )
        );
        $i++;
    }

    $tplDumpSelectTables->assign_vars(
        array(
            'PAGETITLE' => $lang['L_TABLESELECTION'],
            'SESSION_ID' => session_id(),
            'DATABASE' => $config['db_actual'],
            'ICON_OK' => $icon['ok'],
            'ICON_DELETE' => $icon['delete'],
            'ICON_DB' => $icon['db'],
            'L_NO_MSD_BACKUP' => $lang['L_NOT_SUPPORTED']
        )
    );
}
