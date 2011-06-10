<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         $Rev$
 * @author          $Author$
 * @lastmodified    $Date$
 */

if (!defined('MSD_VERSION')) die('No direct access.');
$tablename = isset($_POST['tablename']) ? base64_decode($_POST['tablename']) : '';
if (isset($_GET['tablename'])) {
    $tablename = base64_decode($_GET['tablename']);
}
$dbo->selectDb($db);
$tableInfos = $dbo->getTableColumns($tablename);
if ($tablename == '') {
    $tablenames = array_keys($tableInfos[$db]['tables']);
    $tablename = $tablenames[0];
}
//v($_POST);
$tableInfos = $dbo->getTableColumns($tablename);
$sortByColumn = '';
if (isset($_POST['sort_by_column']) && isset($tableInfos[$sortByColumn])) {
    $sortByColumn = base64_decode($_POST['sort_by_column']);
}
$sortDirection = 'ASC';
if (isset($_POST['sort_direction'])) {
    $sortDirection = (string) $_POST['sort_direction'];
}
if (in_array($sortDirection, array('d', 'D'))) {
    $desc = 'DESC';
}
$maxEntries = $config['resultsPerPage'];
if (isset($_GET['limit_max_entries'])) {
    $maxEntries =(int) $_GET['limit_max_entries'];
}
$showAll = 0;
$limitStart = 0;
if (isset($_GET['limit_start']) && $_GET['limit_start'] > 0 && !$showAll) {
    $limitStart = $_GET['limit_start'];
}

$tplSqlbrowserTableShowTabledata = new MSDTemplate();
$tplSqlbrowserTableShowTabledata->set_filenames(
    array(
        'tplSqlbrowserTableShowTabledata' =>
            'tpl/sqlbrowser/table/show_tabledata.tpl'
    )
);

//TODO: Language_vars im Sprachlabor anlegen und hier entfernen.
$languageVars =
    array(
        'L_SQL_DATAOFTABLE' => 'Datensätze der Tabelle',
        'L_SQL_SHOW_NUM_ENTRIES' => 'Zeige Datensätze: ',
        'L_SHOW' => 'Zeige',
        'L_ENTRIES_PER_PAGE' => 'pro Seite (0 = alle anzeigen)',
        'L_STARTING_WITH' => 'beginnend mit Eintrag',
        'L_EDIT_ENTRY' => 'Eintrag editieren',
        'L_VIEW_ENTRY' => 'Eintrag anzeigen',
        'L_NEW_ENTRY' => 'Eintrag anlegen',
        'L_EXECUTED_QUERY' => 'Ausgeführte MySQL-Query:',
        'L_ROWS_AFFECTED' => 'Zeilen betroffen',
        'L_QUERY_FAILED' => 'Query fehlgeschlagen'
);
$tplSqlbrowserTableShowTabledata->assign_vars($languageVars);

if (isset($_POST['action'])) {
    processPostAction($tplSqlbrowserTableShowTabledata, $db, $tablename);
}
$query = "SELECT COUNT(*) as count FROM `$tablename`";
$res=$dbo->query($query, MsdDbFactory::ARRAY_ASSOC);
$numRecords=(int) $res[0];

if (isset($_GET['pager'])) {
    switch ($_GET['pager'])
    {
        case '<':
            $limitStart -= $maxEntries;
            break;
        case '<<':
            $limitStart = 0;
            break;
        case '>>':
            $limitStart = $showAll ? 0 : $numRecords - $maxEntries;
            break;
        case '>':
            $limitStart += $maxEntries;
            break;
    }
    $limitStart = min($numRecords - $maxEntries, $limitStart);
    $limitStart = max($limitStart, 0);
}

$templateVars =
    array(
        'DB_NAME' => $db,
        'TABLE_NAME' => $tablename,
        'DB_NAME_URLENCODED' => base64_encode($db),
        'TABLE_NAME_URLENCODED' => base64_encode($tablename),
        'ENTRY_COUNT' => $numRecords,
        'LIMIT_START' => $limitStart,
        'FIRST_ENTRY_NUM' => $limitStart + 1,
        'LAST_ENTRY_NUM' => $showAll ? $num["count"] : $limitStart + $maxEntries,
        'MAX_ENTRIES' => $maxEntries,
        'SORT_DIRECTION' => $sortDirection == 'ASC' ? 'd':'a',
        'SORT_BY_COLUMN' => $sortByColumn,
        'ICON_VIEW' => $icon['view'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_EDIT' => $icon['edit']
);
$tplSqlbrowserTableShowTabledata->assign_vars($templateVars);

/*
 * Build the Table-Header columns
 */
$field_infos = getExtendedFieldInfo($db, $tablename);
foreach ($field_infos as $field => $val) {
    $sD = '';
    if ($val['field'] == $sortByColumn) {
        $sD = $desc == 'DESC' ? $icon['arrow_down'] : $icon['arrow_up'];
    }
    $tplSqlbrowserTableShowTabledata->assign_block_vars(
        'COL_HEADER',
        array(
            'LABEL' => $val['field'],
            'NAME' => base64_encode($val['field']),
            'COMMENT' => $val['comment'],
            'SORT' => $sD
        )
    );
}

/*
 * Add the Datarows
 */
$query = "SELECT * FROM `$tablename`";
if ($sortByColumn>'') {
    $query .= ' ORDER BY `'.$sortByColumn.'` '.$sortDirection;
}
if ($limitStart>0) {
    $query .= " LIMIT $limitStart, $maxEntries";
}
$result = $dbo->query($query, MsdDbFactory::ARRAY_ASSOC);
$entryNum = $limitStart;
//echo $order;

//Daten holen:
$nr_of_fields = 0;
$i = 1;
foreach ($result as $row) {
    $nr_of_fields = sizeof($row);
    $tplSqlbrowserTableShowTabledata->assign_block_vars(
        'ROW',
        array(
            'NR' => $i,
            'RECORD_KEY_ENCODED' => base64_encode(getRecordIdentifier($db, $tablename, $row)),
            'ROW_CLASS' => $i % 2 ? 'dbrow' : 'dbrow1'
        )
    );
    foreach ($row as $val) {
        $tplSqlbrowserTableShowTabledata->assign_block_vars(
            'ROW.COL',
            array(
                'VAL' => htmlentities($val, ENT_COMPAT, 'utf-8'),
                'CLASS' => is_numeric($val) ? ' right' : ''
                )
        );
    }
    $i++;
}

$tplSqlbrowserTableShowTabledata->assign_vars(
    array('BUTTONBAR_COLSPAN' => $nr_of_fields + 3)
);

function processPostAction($tplSqlbrowserTableShowTabledata, $db, $tablename)
{
    global $dbo;
    $action = $_POST['action'];
    if (!in_array($action, array('edit', 'new'))) {
        return;
    }

    $fields = implode(', ', fetchSetFields($_POST, 'field_'));

    $sql = "INSERT INTO `$tablename` SET " . $fields . ";";
    if ($action == 'edit') {
        $sql = "UPDATE `$tablename` SET " . $fields . " WHERE "
            . base64_decode($_POST['key']) . ' LIMIT 1;';
    }
    $result = $dbo->query($sql,MsdDbFactory::SIMPLE);
    if (!$result) {
        $tplSqlbrowserTableShowTabledata->assign_block_vars(
            'MYSQL_ERROR',
            array(
                'QUERY' => htmlspecialchars($sql),
                'ERROR' => mysql_error()
            )
        );
        return;
    }
    $tplSqlbrowserTableShowTabledata->assign_block_vars(
        'POSTED_MYSQL_QUERY',
        array(
            'QUERY' => htmlspecialchars($sql),
            'ROWS_AFFECTED' => $dbo->getAffectedRows()
        )
    );
}

function fetchSetFields($arr, $prefix)
{
    global $dbo;
    $answer = array();
    foreach ($arr as $key => $value) {
        if (strpos($key, $prefix) === 0) {
            $field = base64_decode(substr($key, strlen($prefix)));
            $answer[] = "`$field` = \"" . $dbo->escape($value) . "\"";
        }
    }
    return $answer;
}

