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
$checkit = (isset($_GET['checkit'])) ? base64_decode($_GET['checkit']) : '';
$repair = (isset($_GET['repair'])) ? base64_decode($_GET['repair']) : 0;
$tables = isset($_POST['table']) ? $_POST['table'] : array();
$sortColumn = isset($_POST['sort_by_column']) ? $_POST['sort_by_column'] : 'name';
$sortDirection = isset($_POST['sort_direction']) ? $_POST['sort_direction'] : 'a';
$dbo->selectDb($db);
$tableInfos = array();
// is there any operation to do?
if (isset($_POST['do']) && $_POST['do']>'' && sizeof($tables) > 0) {
    // which action should we perform?
    $queryResultType = MsdDbFactory::ARRAY_ASSOC;
    switch ($_POST['do'])
    {
        case 'analyze':
            $query = 'ANALYZE TABLE `%s`.`%s`';
            $actionOutput = $lang['L_ANALYZE'];
            break;
        case 'check':
            $query = 'CHECK TABLE `%s`.`%s`';
            $actionOutput = $lang['L_CHECK'];
            break;
        case 'repair':
            $query = 'REPAIR TABLE `%s`.`%s`';
            $actionOutput = $lang['L_REPAIR'];
            break;
        case 'drop':
            $query = 'DROP TABLE `%s`.`%s`';
            $actionOutput = $lang['L_DELETE'];
            $queryResultType = MsdDbFactory::SIMPLE;
            break;
        case 'truncate':
            $query = 'TRUNCATE TABLE `%s`.`%s`';
            $actionOutput = $lang['L_EMPTY'];
            $queryResultType = MsdDbFactory::SIMPLE;
            break;
        default:
            $query = 'OPTIMIZE TABLE `%s`.`%s`';
            $actionOutput = $lang['L_OPTIMIZE'];
            break;
    }

    $tplSqlbrowserTableOperation = new MSDTemplate();
    $tplSqlbrowserTableOperation->set_filenames(
        array(
            'tplSqlbrowserTableOperation' => 'tpl/sqlbrowser/table/operation.tpl'
        )
    );
    $tplSqlbrowserTableOperation->assign_vars(
        array(
            'ACTION' => $actionOutput,
            'ICON_DELETE' => $icon['delete'],
            'ICON_OK' => $icon['ok'],
            'ICON_NOTOK' => $icon['not_ok'],
        )
    );
    $i = 0;
    foreach ($tables as $table) {
        $table = base64_decode($table);
        $res = $dbo->query(sprintf($query, $db, $table), $queryResultType);
        if ($res) {
            if (!is_array($res)) {
                // simple action without result (delete, truncate, ..)
                $tplSqlbrowserTableOperation->assign_block_vars(
                    'ROW',
                    array(
                        'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                        'NR' => $i + 1,
                        'TABLENAME' => $table,
                        'ACTION' => $actionOutput,
                        'TYPE' => sprintf($query, $db, $table),
                        'MESSAGE' => ''
                    )
                );
            } else {
                $row = $res[0];
                // mainatining functions with result
                // (optimize, repair, analyze,..
                $msgType = isset($row['Msg_type']) ? $row['Msg_type'] : '';
                $msgTxt = isset($row['Msg_text']) ? $row['Msg_text'] : '';
                $tplSqlbrowserTableOperation->assign_block_vars(
                    'ROW',
                    array(
                        'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                        'NR' => $i + 1,
                        'TABLENAME' => $table,
                        'ACTION' => isset($row['Op']) ? $row['Op'] : '',
                        'TYPE' => $msgType,
                        'MESSAGE' => $msgTxt
                    )
                );
            }
        } else {
            // error
            $tplSqlbrowserTableOperation->assign_block_vars(
                'ERROR',
                array(
                    'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                    'NR' => $i + 1,
                    'TABLENAME' => $table,
                    'ERROR' => mysql_error(),
                    'QUERY' => sprintf($query, $db, $table)
                )
            );
        }
        $i++;
    }
}

// Output list of tables of the selected database
$tableInfos = getTableInfo($db);
// extract sorted one-dimensional array with infos we need
$orderArray = get_orderarray($sortColumn . ',' . $sortDirection . '|name,a');
$sortedTableInfos = arfsort($tableInfos[$db]['tables'], $orderArray);
$tplSqlbrowserTableListTables = new MSDTemplate();
$tplSqlbrowserTableListTables->set_filenames(
    array(
        'tplSqlbrowserTableListTables' => 'tpl/sqlbrowser/table/listTables.tpl'
    )
);
$numrows = $tableInfos[$db]['table_count'];
$up = $icon['arrow_up'];
$down = $icon['arrow_down'];
$sortName  = $sortColumn == 'name' ? ($sortDirection == 'd' ? $down : $up) : '';
$sD = $sortDirection;
$sC = $sortColumn;
$tplSqlbrowserTableListTables->assign_vars(
    array(
        'ICON_VIEW' => $icon['view'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_OK' => $icon['ok'],
        'ICON_NOT_OK' => $icon['not_ok'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_TRUNCATE' => $icon['truncate'],
        'ICON_UP' => $up,
        'ICON_DOWN' => $down,
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'],
        'ICON_CANCEL' => $icon['cancel'],
        'DB_NAME' => $db,
        'DB_NAME_URLENCODED' => base64_encode($db),
        'TABLE_COUNT' => String::formatNumber($numrows),
        'ICONPATH' => $config['files']['iconpath'],
        'SORT_BY_COLUMN' => $sC,
        'SORT_DIRECTION' => $sD,
        'SORT_NAME' => $sortName,
        'SORT_RECORDS' => $sC == 'records' ? ($sD == 'D' ? $down : $up) : '',
        'SORT_DATA_LENGTH' =>
            $sC == 'data_length' ? ($sD == 'D' ? $down : $up) : '',
        'SORT_INDEX_LENGTH' =>
            $sC == 'index_length' ? ($sD == 'D' ? $down : $up) : '',
        'SORT_AUTO_INCREMENT' =>
            $sC == 'auto_increment' ? ($sD == 'D' ? $down : $up) : '',
        'SORT_DATA_FREE' =>
            $sC == 'data_free' ? ($sD == 'D' ? $down : $up) : '',
        'SORT_UPDATE_TIME' =>
            $sC == 'update_time' ? ($sD == 'd' ? $down : $up) : '',
        'SORT_ENGINE' =>
            $sC == 'engine' ? ($sD == 'd' ? $down : $up) : '',
        'SORT_COLLATION' =>
            $sC == 'collation' ? ($sD == 'd' ? $down : $up) : '',
        'SORT_COMMENT' => $sC == 'comment' ? ($sD == 'd' ? $down : $up) : '',
        'CONFIRM_TRUNCATE_TABLES' =>
            Html::getJsQuote($lang['L_CONFIRM_TRUNCATE_TABLES']),
        'CONFIRM_DELETE_TABLES' =>
            Html::getJsQuote($lang['L_CONFIRM_DELETE_TABLES']),

    )
);

if ($numrows > 1) {
    $tplSqlbrowserTableListTables->assign_block_vars('MORE_TABLES', array());
} elseif ($numrows == 1) {
    $tplSqlbrowserTableListTables->assign_block_vars('1_TABLE', array());
} elseif ($numrows == 0) {
    $tplSqlbrowserTableListTables->assign_block_vars(
        'NO_TABLE',
        array(
            'HIDE' => ' style="display:none;"'
        )
    );
}
$lastUpdate = 0; // remember the latest update for sum-line
$i = 0;
foreach ($sortedTableInfos as $val) {
    if ($val['update_time'] > $lastUpdate) {
        $lastUpdate = $val['update_time'];
    }
    $updateTime = $val['update_time'] > '' ? $val['update_time'] : '&nbsp;';
    $autoIncrement = '-';
    if ((int) $val['auto_increment'] > 0) {
        $autoIncrement = String::formatNumber($val['auto_increment']);
    }
    $tplSqlbrowserTableListTables->assign_block_vars(
        'ROW',
        array(
            'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
            'NR' => ($i + 1),
            'TABLE_NAME' => $val['name'],
            'TABLE_NAME_URLENCODED' => base64_encode($val['name']),
            'RECORDS' => String::formatNumber($val['records']),
            'DATA_LENGTH' => byteOutput($val['data_length']),
            'INDEX_LENGTH' => byteOutput($val['index_length']),
            'LAST_UPDATE' => $updateTime,
            'ENGINE' => $val['engine'],
            'COLLATION' => $val['collation'],
            'COMMENT' => $val['comment'] > '' ? $val['comment'] : '',
            'AUTO_INCREMENT' => $autoIncrement
        )
    );
    // re-check table if it was checked before
    if (in_array(base64_encode($val['name']), $tables)) {
            $tplSqlbrowserTableListTables->assign_block_vars(
                'ROW.TABLE_CHECKED', array()
            );
    }

    // is table optimized?
    if (in_array($val['engine'], array('MyISAM', 'ARCHIVE'))) {
        if ($val['data_free'] == 0) {
            $tplSqlbrowserTableListTables->assign_block_vars(
                'ROW.OPTIMIZED', array()
            );
        } else {
            $tplSqlbrowserTableListTables->assign_block_vars(
                'ROW.NOT_OPTIMIZED',
                array('VALUE' => byteOutput($val['data_free']))
            );
        }
    }
    else // optimize is not supported for this engine
    $tplSqlbrowserTableListTables->assign_block_vars(
        'ROW.OPTIMIZE_NOT_SUPPORTED', array()
    );
    $i++;
}

// Output sum-line
$indexLen = $tableInfos[$db]['size_total'] - $tableInfos[$db]['datasize_total'];
$tplSqlbrowserTableListTables->assign_block_vars(
    'SUM',
    array(
        'RECORDS' => String::formatNumber($tableInfos[$db]['records_total']),
        'DATA_LENGTH' => byteOutput($tableInfos[$db]['datasize_total']),
        'INDEX_LENGTH' => byteOutput($indexLen),
        'LAST_UPDATE' => $lastUpdate
    )
);
