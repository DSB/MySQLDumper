<?php
//SQL-Library
include_once('./language/'.$config['language'].'/lang_sql.php');

/*
Template
if $sqllib[$i]['sql']=trenn, Then it is a Heading
$sqllib[$i]['name']="";
$sqllib[$i]['sql']="";
$i++;
*/
$i=0;
$sqllib=ARRAY();

$sqllib[$i]['name']=$lang['sqllib_generalfunctions'];
$sqllib[$i]['sql']="trenn";
$i++;


$sqllib[$i]['name']=$lang['sqllib_resetauto'];
$sqllib[$i]['sql']="ALTER TABLE `table` AUTO_INCREMENT=1;";
$i++;

/********* phpBB-Boards *********************************/
$sqllib[$i]['name']="phpBB-".$lang['sqllib_boards'];
$sqllib[$i]['sql']="trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]['name']=$lang['sqllib_deactivateboard'].' [phpBB]';
$sqllib[$i]['sql']="UPDATE `phpbb_config` set config_value=1 where config_name='board_disable'";
$i++;

$sqllib[$i]['name']=$lang['sqllib_activateboard'].' [phpBB]';
$sqllib[$i]['sql']="UPDATE `phpbb_config` set config_value=0 where config_name='board_disable'";
$i++;

// Bord de-/aktivieren

$sqllib[$i]['name']="vBulletin-".$lang['sqllib_boards'];
$sqllib[$i]['sql']="trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]['name']=$lang['sqllib_deactivateboard'].' [vBulletin]';
$sqllib[$i]['sql']="UPDATE forum SET options = options - 1 WHERE options & 1";
$i++;

$sqllib[$i]['name']=$lang['sqllib_activateboard'].' [vBulletin]';
$sqllib[$i]['sql']="UPDATE forum SET options = options + 1 WHERE NOT (options & 1)";
$i++;



?>
