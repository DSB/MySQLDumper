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

include ('./inc/functions/functions_sql.php');
include ('./inc/define_icons.php');
//get standard values from get and post
$db = $config['db_actual'];
if (isset($_GET['db'])) {
    $db = base64_decode($_GET['db']);
    if (!isset($databases[$db])) $db = $config['db_actual'];
}
$action = (isset($_GET['action'])) ? $_GET['action'] : 'list_databases';

include ('./inc/sqlbrowser/nav/topnav_general.php');

switch ($action)
{
    case 'list_databases':
        include ('./inc/sqlbrowser/db/list_databases.php');
        break;
    case 'list_tables':
        include ('./inc/sqlbrowser/table/list_tables.php');
        break;
    case 'edit_table':
        include ('./inc/sqlbrowser/table/edit_table.php');
        break;
    case 'edit_field':
        include ('./inc/sqlbrowser/table/edit_field.php');
        break;
    case 'show_tabledata':
        include ('./inc/sqlbrowser/table/show_tabledata.php');
        break;
    case 'new_db':
        include ('./inc/sqlbrowser/general/tools.php');
        break;
    case 'general_vars':
        include ('./inc/sqlbrowser/general/mysql_variables.php');
        break;
    case 'general_status':
        include ('./inc/sqlbrowser/general/status.php');
        break;
    case 'general_process':
        include ('./inc/sqlbrowser/general/process.php');
        break;
    case 'general_sqlbox_show_results':
    case 'general_sqlbox':
        include ('./inc/sqlbrowser/general/sqlbox.php');
        break;
}

if (isset($db)) $_SESSION['db_actual']=$db;

include ('./inc/sqlbrowser/general/footer.php');
