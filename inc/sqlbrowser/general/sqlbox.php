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

include ('./inc/functions/functions_restore.php');
$sql['sql_statements'] = '';
$queries = array();

$db = (!isset($_GET['db'])) ? $config['db_actual'] : base64_decode($_GET['db']);
if (isset($_GET['db'])) $config['db_actual'] = $db;
$tablename = '';
if (isset($_GET['tablename'])) {
    $tablename = base64_decode($_GET['tablename']);
}
if (isset($_POST['tablename'])) $tablename = base64_decode($_POST['tablename']);
if (isset($_POST['sqltextarea'])) {
    $sql['sql_statements'] = $_POST['sqltextarea'];
} else {
    if (isset($_SESSION['sql']['statements'])) {
        $sql['sql_statements'] = $_SESSION['sql']['statements'];
    }
}
$tdcompact = $config['interface_table_compact'];
if (isset($_GET['tdc'])) {
    $tdcompact = $_GET['tdc'];
}
if (isset($_POST['tableselect']) && $_POST['tableselect'] != '1') {
    $tablename = $_POST['tableselect'];
}
$dbo->selectDb($db);

//Start SQL-Box
$tplSqlbrowserSqlbox = new MSDTemplate();
$tplSqlbrowserSqlbox->set_filenames(
    array('tplSqlbrowserSqlbox' => 'tpl/sqlbrowser/sqlbox/sqlbox.tpl')
);

if (isset($_GET['readfile']) && $_GET['readfile'] == 1) {
    $tplSqlbrowserSqlbox->assign_block_vars(
        'SQLUPLOAD',
        array(
            'POSTTARGET' => $params,
            'LANG_OPENSQLFILE' => $lang['L_SQL_OPENFILE'],
            'LANG_OPENSQLFILE_BUTTON' => $lang['L_SQL_OPENFILE_BUTTON'],
            'LANG_SQL_MAXSIZE' => $lang['L_MAX_UPLOAD_SIZE'],
            'MAX_FILESIZE' => $config['upload_max_filesize']
        )
    );
}

if (isset($_POST['submit_openfile'])) {
    //open file
    if (!isset($_FILES['upfile']['name']) || empty($_FILES['upfile']['name'])) {
        $aus .= '<span class="error">' . $lang['L_FM_UPLOADFILEREQUEST'] . '</span>';
    } else {
        $fn = $_FILES['upfile']['tmp_name'];
        if (strtolower(substr($_FILES['upfile']['name'], -3)) == ".gz") {
            $readUserSqlfile = gzfile($fn);
        } else {
            $readUserSqlfile = file($fn);
        }
        $sqlLoaded = implode("", $readUserSqlfile);
    }
}

// Do we have SQL-Queries in User-SQLLib?
$sqlcombo = getSqlLibraryComboBox();
if ($sqlcombo > '') {
    $tplSqlbrowserSqlbox->assign_block_vars(
        'SQLCOMBO', array('SQL_COMBOBOX' => $sqlcombo)
    );
}
// create Table select box
$tables = $dbo->getTables($db);
$tableSelectBox = Html::getOptionlist($tables, false, $lang['L_TABLE'] . ' `%s`');

$tplSqlbrowserSqlbox->assign_vars(
    array(
        'LANG_SQL_WARNING' => $lang['L_SQL_WARNING'],
        'ICONPATH' => $config['files']['iconpath'],
        'ICON_PLUS' => $icon['plus'],
        'ICON_MINUS' => $icon['minus'],
        'MYSQL_REF' => 'http://dev.mysql.com/doc/',
        'BOXSIZE' => $config['interface_sqlboxsize'],
        'BOXCONTENT' => $sql['sql_statements'],
        'LANG_SQL_BEFEHLE' => $lang['L_SQL_COMMANDS'],
        'TABLE_COMBOBOX' => $tableSelectBox,
        'LANG_SQL_EXEC' => $lang['L_SQL_EXEC'],
        'LANG_RESET' => $lang['L_RESET'],
        'DB' => $db,
        'DB_ENCODED' => base64_encode($db),
        'ICON_SEARCH' => $icon['search'],
        'ICON_UPLOAD' => $icon['upload'],
        'ICON_ARROW_LEFT' => $icon['arrow_left'],
        'ICON_MYSQL_HELP' => $icon['mysql_help'],
        'ICON_CLOSE' => $icon['close'],
        'MYSQL_HELP' => $lang['L_TITLE_MYSQL_HELP'],
        'LANG_TOOLBOX' => $lang['L_TOOLS_TOOLBOX'],
        'LANG_TOOLS' => $lang['L_TOOLS'],
        'LANG_DB' => $lang['L_DB'],
        'LANG_TABLE' => $lang['L_TABLE'],
        'LANG_SQL_TABLEVIEW' => $lang['L_SQL_TABLEVIEW'],
        'LANG_BACK_TO_DB_OVERVIEW' => $lang['L_SQL_BACKDBOVERVIEW']
    )
);

if (isset($_POST['execsql']) || $action == 'general_sqlbox_show_results'
    || $sql['sql_statements'] > '') {
    include ('./inc/sqlbrowser/sqlbox/show_results.php');
}
$_SESSION['db'] = $db;
$_SESSION['tablename'] = $tablename;
$_SESSION['sql']['statements'] = $sql['sql_statements'];