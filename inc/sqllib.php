<?php
//SQL-Library

/*
Template
if $sqllib[$i]["sql"]=trenn, Then it is a Heading
$sqllib[$i]["name"]="";
$sqllib[$i]["sql"]="";
$i++;
*/
$i=0;

$sqllib[$i]["name"]=$lang["sqllib_generalfunctions"];
$sqllib[$i]["sql"]="trenn";
$i++;


$sqllib[$i]["name"]=$lang["sqllib_resetauto"];
$sqllib[$i]["sql"]="ALTER TABLE `table` AUTO_INCREMENT=1;";
$i++;

/********* phpBB-Boards *********************************/
$sqllib[$i]["name"]="phpBB-".$lang["sqllib_boards"];
$sqllib[$i]["sql"]="trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]["name"]=$lang["sqllib_deactivateboard"].' [phpBB]';
$sqllib[$i]["sql"]="UPDATE `phpbb_config` set config_value=1 where config_name='board_disable'";
$i++;

$sqllib[$i]["name"]=$lang["sqllib_activateboard"].' [phpBB]';
$sqllib[$i]["sql"]="UPDATE `phpbb_config` set config_value=0 where config_name='board_disable'";
$i++;

$sqllib[$i]["name"]="WBB-".$lang["sqllib_boards"];
$sqllib[$i]["sql"]="trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]["name"]=$lang["sqllib_boardoffline"].' [WBB]';
$sqllib[$i]["sql"]="UPDATE `bb1_options` set value=1 where varname='offline'";
$i++;

$sqllib[$i]["name"]=$lang["sqllib_boardonline"].' [WBB]';
$sqllib[$i]["sql"]="UPDATE `phpbb_config` set value=0 where varname='offline'";
$i++;

$sqllib[$i]["name"]="vBulletin-".$lang["sqllib_boards"];
$sqllib[$i]["sql"]="trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]["name"]=$lang["sqllib_deactivateboard"].' [vBulletin]';
$sqllib[$i]["sql"]="UPDATE forum SET options = options - 1 WHERE options & 1";
$i++;

$sqllib[$i]["name"]=$lang["sqllib_activateboard"].' [vBulletin]';
$sqllib[$i]["sql"]="UPDATE forum SET options = options + 1 WHERE NOT (options & 1)";
$i++;



?>
