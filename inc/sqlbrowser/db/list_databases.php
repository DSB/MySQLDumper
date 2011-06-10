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
$do = isset($_POST['do']) ? $_POST['do'] : '';
$dbs = isset($_POST['database']) ? $_POST['database'] : array();
// truncte 1 db
if (isset($_GET['truncate_db'])) {
    $do = 'db_truncate';
    $dbs = array(
    $_GET['truncate_db']);
}

// drop 1 db
if (isset($_GET['drop_db'])) {
    $do = 'db_delete';
    $dbs = array(
    $_GET['drop_db']);
}

if ($do > '' && sizeof($dbs) > 0) {
    $sql = array();
    $associatedDatabase = array();
    $tplSqlbrowserDbOperation = new MSDTemplate();
    $tplSqlbrowserDbOperation->set_filenames(
        array(
            'tplSqlbrowserDbOperation' => 'tpl/sqlbrowser/db/operation.tpl'
        )
    );

    $i = 0;
    foreach ($dbs as $database) {
        $database = base64_decode($database);
        // truncate all tables but keep database
        if ($do == 'db_truncate') {
            $actionOutput = $lang['L_CLEAR_DATABASE'];
            // clear table array to not delete other tables by accident
            unset($tableInfos);
            $tableInfos = getTableInfo($database);
            $sql[] = 'SET FOREIGN_KEY_CHECKS=0';
            $associatedDatabase[] = $database;
            foreach ($tableInfos[$database]['tables'] as $table => $val) {
                $query = $val['engine'] == 'VIEW' ? 'DROP VIEW ' : 'DROP TABLE ';
                $sql[] = sprintf($query . '`%s`.`%s`', $database, $table);
                $associatedDatabase[] = $database;
            }
            $sql[] = 'SET FOREIGN_KEY_CHECKS=1';
            $associatedDatabase[] = $database;
        }

        // delete complete database
        if ($do == 'db_delete') {
            $actionOutput = $lang['L_DELETE_DATABASE'];
            $sql[] = 'DROP DATABASE `' . $database . '`';
            $associatedDatabase[] = $database;
        }
    }

    $tplSqlbrowserDbOperation->assign_vars(
        array(
            'ACTION' => $actionOutput,
            'ICON_OK' => $icon['ok'],
            'ICON_NOTOK' => $icon['not_ok']
        )
    );

    //process all sql commands and output result to template
    foreach ($sql as $index => $query) {
        //$res = MSD_query($query, false);
        $res = $dbo->query($query, MsdDbFactory::SIMPLE);
        if (true === $res) {
            $tplSqlbrowserDbOperation->assign_block_vars(
                'ROW',
                array(
                    'ROWCLASS' => $index % 2 ? 'dbrow' : 'dbrow1',
                    'NR' => $index + 1,
                    'DBNAME' => $associatedDatabase[$index],
                    'ACTION' => $actionOutput,
                    'QUERY' => $query
                )
            );
        } else {
            $tplSqlbrowserDbOperation->assign_block_vars(
                'ERROR',
                array(
                    'ROWCLASS' => $index % 2 ? 'dbrow' : 'dbrow1',
                    'NR' => $index + 1,
                    'DBNAME' => $associatedDatabase[$index],
                    'ACTION' => $actionOutput,
                    'QUERY' => $query,
                    'ERROR' => mysql_error($config['dbconnection'])
                )
            );
        }
        $i++;
    }
    if ($do == 'db_delete') {
        setDefaultConfig();
    }
}

//list databases
$tplSqlbrowserDbListDatabases = new MSDTemplate();
$tplSqlbrowserDbListDatabases->set_filenames(
    array(
        'tplSqlbrowserDbListDatabases' => 'tpl/sqlbrowser/db/list_databases.tpl'
    )
);
$tplSqlbrowserDbListDatabases->assign_vars(
    array(
        'ICON_DB' => $icon['db'],
        'ICON_VIEW' => $icon['view'],
        'ICON_EDIT' => $icon['edit'],
        'ICON_DELETE' => $icon['delete'],
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'],
        'ICON_TRUNCATE' => $icon['truncate'],
        'CONFIRM_TRUNCATE_DATABASES' =>
            Html::getJsQuote($lang['L_CONFIRM_TRUNCATE_DATABASES'], true),
        'CONFIRM_DROP_DATABASES' =>
            Html::getJsQuote($lang['L_CONFIRM_DROP_DATABASES'], true)
    )
);

$i = 0;
foreach ($databases as $dbName => $val) {
    $rowclass = ($i % 2) ? 'dbrow' : 'dbrow1';
    if ($dbName == $config['db_actual']) {
        $rowclass = "dbrowsel";
    }
    //does the database exist?
    if (!$dbo->selectDb($dbName, true)) {
        // no -> show message "doesn't exist"
        $tplSqlbrowserDbListDatabases->assign_block_vars(
            'DB_NOT_FOUND',
            array(
                'ROWCLASS' => $rowclass,
                'NR' => ($i + 1),
                'DB_NAME' => $dbName,
                'DB_ID' => $i
            )
        );
        // if this happens the list is not accurate
        // -> reload db-list to remove deleted dbs
        setDefaultConfig();
    } else {
        // yes, db exists -> show nr of tables
        $tables=$dbo->getTableStatus();
        $numTables = (int) sizeof($tables);
        $tplSqlbrowserDbListDatabases->assign_block_vars(
            'ROW',
            array(
                'ROWCLASS' => $rowclass,
                'NR' => ($i + 1),
                'DB_NAME' => $dbName,
                'DATABASE_NAME_URLENCODED' => base64_encode($dbName),
                'DB_ID' => base64_encode($dbName),
                'TABLE_COUNT' => $numTables,
                'CONFIRM_DELETE' =>
                    Html::getJsQuote(sprintf($lang['L_ASKDBDELETE'], $dbName)),
                'CONFIRM_TRUNCATE' =>
                    Html::getJsQuote(sprintf($lang['L_ASKDBEMPTY'], $dbName))
            )
        );

        if ($numTables == 1) {
            $tplSqlbrowserDbListDatabases->assign_block_vars(
                'ROW.TABLE', array()
            );
        } else {
            $tplSqlbrowserDbListDatabases->assign_block_vars(
                'ROW.TABLES', array()
            );
        }
    }
    $i++;
}
