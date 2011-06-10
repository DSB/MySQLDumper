<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1205 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

if (!defined('MSD_VERSION')) die('No direct access.');
/*
 * Fetch and check _GET variables
 */
$db = isset($_GET['db']) ? base64_decode($_GET['db']) : $config['db_actual'];
$tablename = isset($_GET['tablename']) ? base64_decode($_GET['tablename']) : '';
$dbo->selectDb($db);
$tableInfos=$dbo->getTableColumns($tablename, $db);

$tplSqlbrowserTableEditTable = new MSDTemplate();
$tplSqlbrowserTableEditTable->set_filenames(
    array(
        'tplSqlbrowserTableEditTable' => 'tpl/sqlbrowser/table/edit_table.tpl'
    )
);

$tplSqlbrowserTableEditTable->assign_vars(
    array(
        'DB' => $db,
        'TABLE' => $tablename
    )
);

$sumSize = 0;
$i = 0;
foreach ($tableInfos as $key => $tableInfo) {
    if ($key != 'primary_keys') {
        $type = $tableInfo['Type'];
        $typeTemp = array();

        // ENUM-/SET-Handling
        if (strpos($type, 'enum') !== false || strpos($type, 'set') !== false) {
            $toBeReplaced = array(
                'set(',
                'enum(',
                ')',
                '\'');
            $typeTemp = str_replace($toBeReplaced, '', $type);
            $typeTemp = explode(',', $typeTemp);
            sort($typeTemp);
            if (strpos($type, 'enum') !== false) {
                $type = 'enum';
            } else {
                $type = 'set';
            }
        }
        $tplSqlbrowserTableEditTable->assign_block_vars(
            'ROW',
            array(
                'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                'NR' => ($i + 1),
                'NAME' => $tableInfo['Field'],
                'TYPE' => $type,
                'NULL' => $tableInfo['Null']=='NO' ? $lang['L_NO']:$lang['L_YES'],
                'KEY' => $tableInfo['Key'],
                'DEFAULT' => $tableInfo['Default'],
                'EXTRA' => $tableInfo['Extra'],
                'SORTIERUNG' => $tableInfo['Collation']
            )
        );

        if (count($typeTemp) > 0) {
            $tplSqlbrowserTableEditTable->assign_block_vars(
                'ROW.ENUM_SET',
                array(
                    'SIZE' => count($typeTemp) < 5 ? count($typeTemp) : 5,
                    'ICON_BROWSE' => $icon['browse'],
                    'NR' => $i
                )
            );
            foreach ($typeTemp as $val) {
                $tplSqlbrowserTableEditTable->assign_block_vars(
                    'ROW.ENUM_SET.ENUM_SET_ELEMENT',
                    array('ELEMENT' => $val)
                );
            }
        }
        $i++;
    }
}

// Output list of tables of the selected database

$tplSqlbrowserTableEditTable->assign_vars(
    array(
        'DB_NAME_URLENCODED' => base64_encode($db),
        'TABLE_NAME_URLENCODED' => base64_encode($tablename),
        'ICON_VIEW' => $icon['view'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_OK' => $icon['ok'],
        'ICON_NOT_OK' => $icon['not_ok'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_UP' => $icon['arrow_up'],
        'ICON_DOWN' => $icon['arrow_down'],
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'],
        'ICON_CANCEL' => $icon['cancel'],
        'DB' => $db,
        'DB_ENCODED' => base64_encode($db),
        'TABLE_ENCODED' => base64_encode($tablename),
        'ICONPATH' => $config['files']['iconpath']
    )
);

