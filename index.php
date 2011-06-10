<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1212 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/mysql.php');
include ('./inc/functions/functions_global.php');
include ('./lib/template.php');
include ('./inc/classes/db/MsdDbFactory.php');
include ('./inc/classes/helper/Html.php');
include ('./inc/classes/helper/String.php');
include ('./inc/classes/Log.php');
// needed to create ordered output of rendered templates
// Important: don't change the order!
$templateObjects = array(
    'tplGlobalHeader',
    'tplMenu',
    'tplConfigurationConfigMenu',
    'tplConfigurationAutodelete',
    'tplConfigurationConfigFiles',
    'tplConfigurationCronscript',
    'tplConfigurationDatabases',
    'tplConfigurationEmail',
    'tplConfigurationFtp',
    'tplConfigurationGeneral',
    'tplConfigurationInterface',
    'tplConfigurationFooter',
    'tplDoDump',
    'tplDumpFinished',
    'tplDumpPrepare',
    'tplDumpSelectTables',
    'tplFiles',
    'tplHome',
    'tplHomeProtectionCreate',
    'tplHomeProtectionEdit',
    'tplRestore',
    'tplRestoreFinished',
    'tplRestorePrepare',
    'tplRestoreSelectEncoding',
    'tplRestoreSelectTables',
    'tplSqlbrowserTopnav',
    'tplSqlbrowserDbOperation',
    'tplSqlbrowserDbListDatabases',
    'tplSqlbrowserTableEditTable',
    'tplSqlbrowserGeneralMysqlVariables',
    'tplSqlbrowserGeneralProcess',
    'tplSqlbrowserSqlbox',
    'tplSqlbrowserGeneralStatus',
    'tplSqlbrowserTableOperation',
    'tplSqlbrowserTableListTables',
    'tplSqlbrowserTableShowTabledata',
    'tplSqlbrowserTableShowTabledataEntry',
    'tplSqlbrowserSqlboxShowResults',
    'tplSqlbrowserSqlboxShowQueryResults',
    'tplSqlbrowserGeneralFooter',
    'tplLog');
// automatic stripslashes and trimming of $_POST and $_GET-Vars
if (0 == get_magic_quotes_gpc()) {
    $_POST = Html::stripslashesDeep($_POST);
    $_GET = Html::stripslashesDeep($_GET);
}
$_POST = Html::trimDeep($_POST);
$_GET = Html::trimDeep($_GET);
// get Page to include
$p = (isset($_GET['p'])) ? (string) $_GET['p'] : 'home';
if (isset($_POST['p'])) $p = (string) $_POST['p'];
$action = (isset($_GET['action'])) ? (string) $_GET['action'] : '';
if (isset($_POST['action'])) $action = (string) $_POST['action'];
$dbo = null;
$log = new Log();
if ($action != 'dl') { // don't send HTML-Header if download of file is started
    obstart();
    $tplGlobalHeader = new MSDTemplate();
    $tplGlobalHeader->set_filenames(
        array('tplGlobalHeader' => 'tpl/globalHeader.tpl')
    );
    $language = explode('_', $config['language'], 2);
    $language = $language[0];
    $tplGlobalHeader->assign_vars(
        array(
            'LANGUAGE' => $language,
            'MSD_VERSION' => MSD_VERSION,
            'THEME' => $config['theme'],
            'DIRECTION' => 'ltr')
    );
}
// in some cases (config changed, reload database list, etc.) the menu must be
// rendered before the content
// is handled to update parameters that are used
if (isset($_POST['selected_config']) || isset($_GET['config'])
    || isset($_GET['dbrefresh']) || isset($_POST['dbindex'])
    || isset($_GET['dbindex'])) {
    include ('./inc/menu.php');
}
switch ($p) {
    case 'dump':
        include ('./inc/dump.php');
        break;
    case 'restore':
        include ('./inc/restore.php');
        break;
    case 'files':
        include ('./inc/files.php');
        break;
    case 'sql':
        include ('./inc/sql.php');
        break;
    case 'home':
        include ('./inc/home/home.php');
        break;
    case 'config':
        include ('./inc/configuration.php');
        break;
    case 'log':
        include ('./inc/log.php');
        break;
    default:
        include ('./inc/home/home.php');
}
if ($action != 'dl') { // include menu if we didn't hand out a file
    include ('./inc/menu.php');
    //render prepared templates
    foreach ($templateObjects as $t) {
        if (isset(${$t}) && is_object(${$t})) {
            ${$t}->pparse($t);
        }
    }
unset($log);
    obend();
}
$_SESSION['config'] = $config;