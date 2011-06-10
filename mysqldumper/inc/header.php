<?php
include_once('./inc/functions.php');
include_once('./inc/mysql.php');

if (!defined('MSD_VERSION')) die('No direct access.');

if(!file_exists($config['files']['parameter'])) $error=TestWorkDir();
include('./'.$config['files']['parameter']);
include('./language/lang_list.php');
if (!isset($databases['db_selected_index'])) $databases['db_selected_index']=0;
SelectDB($databases['db_selected_index']);
$config['files']['iconpath']='css/'.$config['theme'].'/icons/';

session_name('MySQLDumper');
session_start();
$session_id=session_id();

//header('content-type: text/html; charset=utf-8');
if (isset($error)) echo $error;

?>
