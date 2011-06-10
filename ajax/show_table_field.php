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
chdir('./../');
include ('./inc/classes/db/MsdDbFactory.php');
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
        'tpl_sqlbrowser_table_show_tabledata' =>
            './tpl/sqlbrowser/table/edit_field.tpl'
    )
);

/*
 * Fetch and check _GET variables
 */
$validModes = array('new');
$db = isset($_GET['db']) ? base64_decode($_GET['db']) : $config['db_actual'];
$tablename = isset($_GET['tablename']) ? base64_decode($_GET['tablename']) : '';
$fieldname = isset($_GET['fieldname']) ? base64_decode($_GET['fieldname']) : '';
$rowKey = isset($_GET['key']) ? base64_decode($_GET['key']) : '';
$mode = 'new';
if (isset($_GET['do']) && in_array($_GET['do'], $validModes)) {
    $mode = $_GET['do'];
}
$tableInfos = getExtendedFieldInfo($db, $tablename);

$tplSqlbrowserTableShowTabledataEntry->assign_vars(array('MODE' => $mode));

$row = array();
if ($mode == 'EDIT') {
    //TODO implement :)
}

$tplSqlbrowserTableShowTabledataEntry->assign_block_vars(
    'FOOTER_' . $mode, array()
);
$tplSqlbrowserTableShowTabledataEntry->pparse(
    'tpl_sqlbrowser_table_show_tabledata'
);
obend(true);
