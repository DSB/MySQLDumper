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
error_reporting(E_ALL);
chdir('./../');
include ('./inc/classes/db/MsdDbFactory.php');
include ('./inc/classes/helper/Html.php');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/mysql.php');
include ('./inc/functions/functions_global.php');
include ('./lib/template.php');
include ('./inc/functions/functions_restore.php');
include ('./lib/json.php');
obstart(true);
include ('./inc/functions/functions_sql.php');

$tplSqlbrowserTableShowTabledataEntry = new MSDTemplate();
$tplSqlbrowserTableShowTabledataEntry->set_filenames(
    array(
        'tplSqlbrowserTableShowTabledataEntry' =>
        './tpl/sqlbrowser/table/show_tabledata_entry.tpl'
    )
);

/*
 * Fetch and check _GET variables
 */
$validModes = array('VIEW', 'EDIT', 'NEW');
$db = isset($_GET['db']) ? base64_decode($_GET['db']) : $config['db_actual'];
$tablename = isset($_GET['tablename']) ? base64_decode($_GET['tablename']) : '';
$rowKey = isset($_GET['key']) ? base64_decode($_GET['key']) : '';
$mode = 'VIEW';
if (isset($_GET['do'])) {
    $mode =strtoupper((string) $_GET['do']);
}
if (!in_array($mode, $validModes)) {
    $mode = 'VIEW';
}
$tableInfos = getExtendedFieldInfo($db, $tablename);

$tplSqlbrowserTableShowTabledataEntry->assign_vars(
    array(
        'DB_NAME' => $db,
        'TABLE_NAME' => $tablename,
        'DB_NAME_URLENCODED' => base64_encode($db),
        'TABLE_NAME_URLENCODED' => base64_encode($tablename)
    )
);

$row = array();

if ($mode == 'VIEW' || $mode == 'EDIT') {
    $dbo->selectDb($db);
    $query = "SELECT * FROM `$tablename` WHERE $rowKey";
    $row = $dbo->query($query, MsdDbFactory::ARRAY_ASSOC);
    if (false === $row || !isset($row[0])) {
        //TODO clean error handling
        echo "<h2>Keine Datensätze gefunden!</h2>";
        obend(true);
        exit();
    } elseif (count($row) > 1) {
        // TODO clean error handling
        echo "<h2>Mehrere Datensätze gefunden!</h2>";
    }
    $row = $row[0];
} elseif ($mode == 'NEW') {
    foreach ($tableInfos as $key => $val) {
        if (isset($val['field'])) {
            $row[$val['field']] = '';
        }
    }
}

foreach ($row as $key => $value) {
    $keyComment = '';
    if (isset($tableInfos[$key]['comment'])) {
        $keyComment = $tableInfos[$key]['comment'];
    }
    $templateVars = array(
        'NAME' => htmlspecialchars($key),
        'KEY' => base64_encode($key),
        'KEY_COMMENT' => Html::getJsQuote($keyComment),
        'VALUE' => htmlspecialchars($value)
    );
    $tplSqlbrowserTableShowTabledataEntry->assign_block_vars(
        'FIELD_' . ($mode == 'VIEW' ? 'VIEW' : 'EDIT'), $templateVars
    );
}

$templateVars = array('RECORD_KEY' => base64_encode($rowKey));
$tplSqlbrowserTableShowTabledataEntry->assign_block_vars(
    'FOOTER_' . $mode, $templateVars
);
$tplSqlbrowserTableShowTabledataEntry->pparse(
    'tplSqlbrowserTableShowTabledataEntry'
);
obend(true);