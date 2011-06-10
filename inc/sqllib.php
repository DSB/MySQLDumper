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
//SQL-Library
/*
 Template
 if $sqllib[$i]['sql']=trenn, Then it is a Heading
 $sqllib[$i]['name']="";
 $sqllib[$i]['sql']="";
 $i++;
 */
$i = 0;
$sqllib = ARRAY();

$sqllib[$i]['name'] = $lang['L_SQLLIB_GENERALFUNCTIONS'];
$sqllib[$i]['sql'] = "trenn";
$i++;

$sqllib[$i]['name'] = $lang['L_SQLLIB_RESETAUTO'];
$sqllib[$i]['sql'] = "ALTER TABLE `table` AUTO_INCREMENT=1;";
$i++;

/********* phpBB-Boards *********************************/
$sqllib[$i]['name'] = "phpBB-" . $lang['L_SQLLIB_BOARDS'];
$sqllib[$i]['sql'] = "trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]['name'] = $lang['L_SQLLIB_DEACTIVATEBOARD'] . ' [phpBB]';
$sqllib[$i]['sql'] = "UPDATE `phpbb_config` set config_value=1 where config_name='board_disable'";
$i++;

$sqllib[$i]['name'] = $lang['L_SQLLIB_ACTIVATEBOARD'] . ' [phpBB]';
$sqllib[$i]['sql'] = "UPDATE `phpbb_config` set config_value=0 where config_name='board_disable'";
$i++;

// Bord de-/aktivieren


$sqllib[$i]['name'] = "vBulletin-" . $lang['L_SQLLIB_BOARDS'];
$sqllib[$i]['sql'] = "trenn";
$i++;

// Bord de-/aktivieren
$sqllib[$i]['name'] = $lang['L_SQLLIB_DEACTIVATEBOARD'] . ' [vBulletin]';
$sqllib[$i]['sql'] = "UPDATE forum SET options = options - 1 WHERE options & 1";
$i++;

$sqllib[$i]['name'] = $lang['L_SQLLIB_ACTIVATEBOARD'] . ' [vBulletin]';
$sqllib[$i]['sql'] = "UPDATE forum SET options = options + 1 WHERE NOT (options & 1)";
$i++;
