<?php
include("inc/header.php");
include("inc/functions_sql.php");
require("inc/runtime.php");
ReadSQL();


$dbrows= (count($databases["Name"])==1) ? 5 : 3;
$tablerows=Array($dbrows,11,5,8,9,13,50,9);
$config["interface_server_caption"]=(!isset($config["interface_server_caption"])) ? 0 : $config["interface_server_caption"];
$config["interface_server_captioncolor"]=(!isset($config["interface_server_captioncolor"])) ?"#ffffff" : $config["interface_server_captioncolor"];
$msg="";

$command=(isset($_GET["command"])) ? $_GET["command"] : 0 ;
if(isset($_POST["command1"])) $command=0;
if(isset($_POST["command2"])) $command=1;
if(isset($_POST["command3"])) $command=2;
if(isset($_POST["command4"])) $command=3;
if(isset($_POST["command5"])) $command=4;
if(isset($_POST["command6"])) $command=5;
if(isset($_POST["command7"])) $command=6;
if(isset($_POST["command8"])) $command=7;
if(isset($_POST["command9"])) $command=8;

$ftptested=-1;

$checkFTP=Array("","","");
if(isset($_POST["testFTP0"])) {
	$checkFTP[0]='<div class="smallgrey">'.$lang['test'].' FTP-Connection 1<br><br>'.TesteFTP($_POST["ftp_server0"],$_POST["ftp_port0"],$_POST["ftp_user0"],$_POST["ftp_pass0"],$_POST["ftp_dir0"]).'</div>';
	if($command<6) $command=4;
	$ftptested=0;
}
if(isset($_POST["testFTP1"])) {
	$checkFTP[1]='<div class="smallgrey">'.$lang['test'].' FTP-Connection 2<br><br>'.TesteFTP($_POST["ftp_server1"],$_POST["ftp_port1"],$_POST["ftp_user1"],$_POST["ftp_pass1"],$_POST["ftp_dir1"]).'</div>';
	if($command<6)$command=4;
	$ftptested=1;
}
if(isset($_POST["testFTP2"])) {
	$checkFTP[2]='<div class="smallgrey">'.$lang['test'].' FTP-Connection 3<br><br>'.TesteFTP($_POST["ftp_server2"],$_POST["ftp_port2"],$_POST["ftp_user2"],$_POST["ftp_pass2"],$_POST["ftp_dir2"]).'</div>';
	if($command<6)$command=4;
	$ftptested=2;
}

if($ftptested>-1) {
	$ftp_server[$ftptested]=$_POST["ftp_server$ftptested"];
	$ftp_port[$ftptested]=$_POST["ftp_port$ftptested"];
	$ftp_user[$ftptested]=$_POST["ftp_user$ftptested"];
	$ftp_pass[$ftptested]=$_POST["ftp_pass$ftptested"];
	$ftp_dir[$ftptested]=stripslashes($_POST["ftp_dir$ftptested"]);
	if($ftp_dir[$ftptested]=="" || (strlen($ftp_dir[$ftptested])>1 && substr($ftp_dir[$ftptested],-1)!="/")) $ftp_dir[$ftptested].="/";
}

if (isset($_POST["load"]))
{
	$msg=SetDefault();
	$msg=nl2br($msg)."<br>". $lang["load_success"]."<br>";
	echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
}

if (isset($_POST["save"]))
{ 
	//Parameter auslesen
	$config["multi_dump"]=(isset($_POST["MultiDBDump"])) ? $_POST["MultiDBDump"] : 0;
	$databases["db_actual_cronpraefix"]=$_POST["dbcronpraefix"];
	$config["compression"]=$_POST["compression"];
	$config["language"]=$_POST["language"];
	$config["interface_server_caption"]=$_POST["server_caption"];
	$config["interface_server_captioncolor"]=$_POST["server_captioncolor"];
	$config["interface_sqlboxsize"]=$_POST["sqlboxsize"];
	
	$config["email_recipient"]=$_POST["email0"]; 
	$config["email_sender"]=$_POST["email1"]; 
	$config["send_mail"]=$_POST["send_mail"];
	$config["send_mail_dump"]=$_POST["send_mail_dump"];
	
	$config["email_maxsize1"]=$_POST["email_maxsize1"]; if($config["email_maxsize1"]=="") $config["email_maxsize1"]=0;
	$config["email_maxsize2"]=$_POST["email_maxsize2"];
	$config["email_maxsize"]=$config["email_maxsize1"]*(($config["email_maxsize2"]==1) ? 1024 : 1024*1024);
	
	
	$config["memory_limit"]=$_POST["memory_limit"]; if($config["memory_limit"]=="") $config["memory_limit"]=0;
	$config["minspeed"]=$_POST["minspeed"]; if($config["minspeed"]<50) $config["minspeed"]=50;
	$config["maxspeed"]=$_POST["maxspeed"];
	
	
	$config["multi_part"]=$_POST["multi_part"];
	$config["multipartgroesse1"]=$_POST["multipartgroesse1"]; 
	$config["multipartgroesse2"]=$_POST["multipartgroesse2"];
	if($config["multipartgroesse1"]<100 && $config["multipartgroesse2"]==1)$config["multipartgroesse1"]=100;
	
	
	$config["auto_delete"]=$_POST["auto_delete"];
	$config["del_files_after_days"]=$_POST["del_files_after_days"];
	$config["max_backup_files"]=$_POST["max_backup_files"];
	$config["max_backup_files_each"]=$_POST["max_backup_files_each"];
	
	
	$config["empty_db_before_restore"]=$_POST["empty_db_before_restore"];
	$config["optimize_tables_beforedump"]=$_POST["optimize_tables"];
	$config["cron_samedb"]=$_POST["cron_samedb"];
	
	
	$config["cron_extender"]=$_POST["cron_extender"];
	// cron_select_savepath/
	if(isset($_POST["cron_savepath_new"]) && !empty($_POST["cron_savepath_new"]))
		$config["cron_configurationfile"]=$_POST["cron_savepath_new"].".conf";
	else 
		$config["cron_configurationfile"]=$_POST["cron_select_savepath"].".conf";
	
	
	$config["cron_execution_path"]=$_POST["cron_execution_path"];
	if($config["cron_execution_path"]=="")$config["cron_execution_path"]="msd_cron/";
	if(strlen($config["cron_execution_path"])>1 && substr($config["cron_execution_path"],-1)!="/") $config["cron_execution_path"].="/";
	$config["cron_mail"]=$_POST["cron_mail"];
	$config["cron_mail_dump"]=$_POST["cron_mail_dump"];
	
	$config["cron_use_sendmail"]=$_POST["cron_use_sendmail"];
	$config["cron_sendmail"]=$_POST["cron_sendmail"];
	$config["cron_smtp"]=$_POST["cron_smpt"];
	
	$config["cron_printout"]=$_POST["cron_printout"];
	$config["cron_ftp"]=$_POST["cron_ftp"];
	$config["cron_compression"]=$_POST["cron_compression"];
	
	$config["interface_browser_ie"]=$_POST["frames"];
	
	$databases["multi"]=Array();
	$databases["multi_praefix"]=Array();
	$databases["multi_commandbeforedump"]=Array();
	$databases["multi_commandafterdump"]=Array();
	for($i=0;$i<count($databases["Name"]);$i++) {
		$databases["praefix"][$i]=$_POST["dbpraefix_".$i];
		$databases["command_before_dump"][$i]=($config["magic_quotes_gpc"]==1) ? $_POST["command_before_".$i] : addslashes($_POST["command_before_".$i]);
		$databases["command_after_dump"][$i]=($config["magic_quotes_gpc"]==1) ? $_POST["command_after_".$i] : addslashes($_POST["command_after_".$i]);
		if(isset($_POST["db_multidump_$i"]) && $_POST["db_multidump_$i"]=="db_multidump_$i") {
			$databases["multi"][]=$databases["Name"][$i];
			$databases["multi_praefix"][]=$databases["praefix"][$i];
			$databases["multi_commandbeforedump"][]=$databases["command_before_dump"][$i];
			$databases["multi_commandafterdump"][]=$databases["command_after_dump"][$i];
		}
		
	}
	$databases["multisetting"]=(count($databases["multi"])>0)?implode(";",$databases["multi"]) : "";
	$databases["multisetting_praefix"]=(count($databases["multi"])>0)?implode(";",$databases["multi_praefix"]) : "";
	$databases["multisetting_commandbeforedump"]=(count($databases["multi"])>0)?implode(";",$databases["multi_commandbeforedump"]) : "";
	$databases["multisetting_commandafterdump"]=(count($databases["multi"])>0)?implode(";",$databases["multi_commandafterdump"]) : "";
	
	$databases["db_actual_cronindex"]=$_POST["cron_dbindex"];
	if($config["cron_samedb"]==0){
		$databases["db_actual_cronindex"]=$databases["db_selected_index"];
		
	} elseif($databases["db_actual_cronindex"]=="-2") {
		$cron_save_all_dbs=1;
		$datenbanken=count($databases["Name"]); 
		$cron_db_array=str_replace(";","|",$databases["multisetting"]);
		$cron_dbpraefix_array=str_replace(";","|",$databases["multisetting_praefix"]);
		$cron_db_cbd_array=str_replace(";","|",$databases["multisetting_commandbeforedump"]);
		$cron_db_cad_array=str_replace(";","|",$databases["multisetting_commandafterdump"]);
		
	} elseif ($databases["db_actual_cronindex"]=="-3") {
		$cron_save_all_dbs=1;
		$cron_db_array=implode("|",$databases["Name"]);
		$cron_dbpraefix_array=implode("|",$databases["praefix"]);
		$cron_db_cbd_array=implode("|",$databases["command_before_dump"]);
		$cron_db_cad_array=implode("|",$databases["command_after_dump"]);
		
	}
	
	$config["ftp_transfer"]=$_POST["ftp_transfer"];
	$config["ftp_connectionindex"]=$_POST["ftp_transferconn"];
	$config["ftp_timeout"]=$_POST["ftp_timeout"];
	$config["ftp_useSSL"]=isset($_POST["ftp_useSSL"]) ? $_POST["ftp_useSSL"] : 0;
	
	for($i=0;$i<3;$i++) {
		$checkFTP[$i]="";
		$config["ftp_server"][$i]=$_POST["ftp_server$i"];
		$config["ftp_port"][$i]=$_POST["ftp_port$i"];
		$config["ftp_user"][$i]=$_POST["ftp_user$i"];
		$config["ftp_pass"][$i]=$_POST["ftp_pass$i"];
		$config["ftp_dir"][$i]=stripslashes($_POST["ftp_dir$i"]);
		if($config["ftp_port"][$i]+0==0) $config["ftp_port"][$i]=21;
		if($config["ftp_dir"][$i]=="" || (strlen($config["ftp_dir"][$i])>1 && substr($config["ftp_dir"][$i],-1)!="/")) $config["ftp_dir"][$i].="/";
	}

	$config["bb_width"]=$_POST["bb_width"];
	$config["bb_textcolor"]=$_POST["bb_textcolor"];
	$config["sql_limit"]=$_POST["sql_limit"];
	
	// und wegschreiben
	if (WriteParams(0,$config,$databases)==true)
	{ 
		//neue Sprache? Dann Men&uuml; links auch aktualisieren
		if($_POST["lang_old"]!=$config["language"]) 
		{
			echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
		}
		//Parameter laden
		include($config["files"]["parameter"]);

		$msg.= $lang["save_success"];
	} else $msg.= $lang["save_error"];
}  

if(!isset($config["email_maxsize1"]))$config["email_maxsize1"]=0;
if(!isset($config["email_maxsize2"]))$config["email_maxsize2"]=1;
if(!isset($databases["multisetting"])) $databases["multisetting"]="";	
$databases["multi"]=explode(";",$databases["multisetting"]);

//$command_bd=explode("|",$config["command_beforedump"]);
//$command_ad=explode("|",$config["command_afterdump"]);


echo headline();

$aus=Array("formstart" =>"");
//Ausgabe-Teile
$aus["formstart"].='';
$aus["formstart"].='<h3>'.$lang["config_headline"].'</h3>'.$msg.'<form name="frm_config" method="POST" action="config_overview.php?command='.$command.'">';
$aus["formstart"].='<div align="center"><table border="1"><tr><td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">';
$aus["formstart"].='<input class="Menubutton" name="load" type="submit" value="'.$lang["load"].'"	onclick="if (!confirm(\''.$lang["config_askload"].'\')) return false;"></td>';
$aus["formstart"].='</tr></table></div><br>';
$aus["formstart"].='<table border="1" cellpadding="0" cellspacing="0" align="center" width="90%">';
$aus["formstart"].='<tr><td rowspan="'.$tablerows[$command].'" width="138" align="center" valign="top"><br>';
$aus["formstart"].='<input type="submit" name="command1" value="'.$lang['dbs'].'" style="width:130px;font-size:11px;'.(($command==0) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command2" value="'.$lang['general'].'" style="width:130px;font-size:11px;'.(($command==1) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command8" value="Interface" style="width:130px;font-size:11px;'.(($command==7) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command3" value="'.$lang['config_autodelete'].'" style="width:130px;font-size:11px;'.(($command==2) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command4" value="Email" style="width:130px;font-size:11px;'.(($command==3) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command5" value="FTP" style="width:130px;font-size:11px;'.(($command==4) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br>';
$aus["formstart"].='<input type="submit" name="command6" value="Cronscript" style="width:130px;font-size:11px;'.(($command==5) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><br><hr>';
$aus["formstart"].='<input type="submit" name="command7" value="'.$lang['allpars'].'" style="width:130px;font-size:11px;'.(($command==6) ?"background-color:#99ff99;":"background-color:#ffffcc;").'"><hr><br>';

$aus["formstart"].='<input class="Formbutton" type="reset" name="reset" value="'.$lang["reset"].'"><br><br><input class="Formbutton" type="submit" name="save" value="'.$lang["save"].'"></td>';	
// Zugangsdaten

$aus["db"]='<td colspan="2" class="hd">'.$lang["config_databases"].'</td></tr>';

if(count($databases["Name"])==1) {
	$aus["db"].='<tr><td valign="top">'.Help($lang["help_db"],"conf1").$lang["list_db"].'</td><td valign="top">';
	$aus["db"].='<strong>'.$databases["db_actual"].'</strong>'.(($config["dbonly"]!="") ? '<br><br><span class="smallgrey">dbonly='.$config["dbonly"].'</span>' : '').'</td></tr>';
	$aus["db"].='<tr><td>'.Help($lang["help_praefix"],"conf2").$lang["praefix"].'</td><td><input type="text" name="dbpraefix_'.$databases["db_selected_index"].'" size="10" value="'.$databases["praefix"][$databases["db_selected_index"]].'"></td></tr>';
	$aus["db"].= '<tr><td>'.Help($lang["help_commands"],"").'Command before Dump</td><td>'.ComboCommandDump(0,$databases["db_selected_index"]).'</td></tr>';
	$aus["db"].= '<tr><td>'.Help($lang["help_commands"],"").'Command after Dump</td><td>'.ComboCommandDump(1,$databases["db_selected_index"]).'</td></tr>';
	//if($command<6) $aus["db"].='<tr><td colspan="2"><br><br><br><br><br><br></td></tr>';
} else {
$aus["db"].='<tr><td valign="top">'.Help($lang["help_db"],"conf1").$lang["list_db"].'</td><td><input type="checkbox" name="MultiDBDump" value="1" '.(($config["multi_dump"]==1) ? "CHECKED" : "").'>'.$lang['activate_multidump'].'</td>';
$aus["db"].='<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">';
$aus["db"].='<tr><td class="hd2">'.$lang['db'].'</td><td class="hd2">&nbsp;</td><td class="hd2">Multidump<br>(<a href="javascript:SelectMD(true,'.count($databases["Name"]).')" class="small">'.$lang["all"].'</a>&nbsp;<a href="javascript:SelectMD(false,'.count($databases["Name"]).')" class="small">'.$lang["none"].'</a>)</td>';
$aus["db"].='<td class="hd2">'.Help($lang["help_praefix"],"conf2").$lang["praefix"].'</td><td class="hd2">'.Help($lang["help_commands"],"",11).'Command before Dump</td><td class="hd2">'.Help($lang["help_commands"],"",11).'Command after Dump</td></tr>';

//erst die aktuelle DB
$aus["db"].= '<tr class="hellblau"><td><strong>'.$databases["db_actual"].'</strong></td>';
$aus["db"].= '<td>&nbsp;</td><td align="center"><input type="checkbox" name="db_multidump_'.$databases["db_selected_index"].'" value="db_multidump_'.$databases["db_selected_index"].'" '.((in_array($databases["db_actual"],$databases["multi"])) ? "CHECKED" : "").'></td>';
$aus["db"].= '<td><img src="images/blank.gif" width="40" height="1" alt=""><input type="text" name="dbpraefix_'.$databases["db_selected_index"].'" size="10" value="'.$databases["praefix"][$databases["db_selected_index"]].'" style="font-size:10px;color:#3300cc;"></td>';
$aus["db"].= '<td>'.ComboCommandDump(0,$databases["db_selected_index"]).'</td><td>'.ComboCommandDump(1,$databases["db_selected_index"]).'</td></tr>';

$dbacombo=$dbbcombo="";$j=0;
for($i=0;$i<count($databases["Name"]);$i++) 
{ 
	//$dbbcombo.='<option value="'.$databases["Name"][$i].'" '.(($command_bd[0]==$databases["Name"][$i]) ? "selected" : "").'>'.$databases["Name"][$i].'</option>';
	//$dbacombo.='<option value="'.$databases["Name"][$i].'" '.(($command_ad[0]==$databases["Name"][$i]) ? "selected" : "").'>'.$databases["Name"][$i].'</option>';
	if($i!=$databases["db_selected_index"]) {
		$j++;
		
		$aus["db"].= '<tr bgcolor="'.(($j % 2)  ? 'white' : '#e1e1e1').'"><td>'.$databases["Name"][$i].'</td>'; 
		$aus["db"].= '<td>&nbsp;</td><td align="center"><input type="checkbox" name="db_multidump_'.$i.'" value="db_multidump_'.$i.'" '.((in_array($databases["Name"][$i],$databases["multi"])) ? "CHECKED" : "").'></td>';
		$aus["db"].= '<td><img src="images/blank.gif" width="40" height="1" alt=""><input type="text" name="dbpraefix_'.$i.'" size="10" value="'.$databases["praefix"][$i].'" style="font-size:10px;color:#3300cc;"></td><td>'.ComboCommandDump(0,$i).'</td><td>'.ComboCommandDump(1,$i).'</td></tr>';
	}
}

$aus["db"].='</select></table></td></tr>';
}

// <tr><td>'.Help($lang["help_praefix"],"conf2").$lang["praefix"].'&nbsp;</td><td><input type="text" name="dbpraefix" value="'.$databases["praefix"][$databases["db_selected_index"]].'"></td></tr>


// sonstige Einstellungen
$aus["global1"]='<tr><td colspan="2" class="hd">'.$lang["config_dumprestore"].'</td></tr>';
$aus["global1"].='<tr><td>'.Help($lang["help_zip"],"conf3").$lang["gzip"].':&nbsp;</td>';
$aus["global1"].='<td><input type="radio" value="1" name="compression" '.(($config["zlib"]) ? '' : 'disabled').(($config["compression"]==1)?" checked":"").'>'.$lang["activated"];
$aus["global1"].='<input type="radio" value="0" name="compression" '.(($config["compression"]==0)?" checked":"").'>'.$lang["not_activated"].'</td></tr>';
$aus["global1"].='<tr><td>'.Help($lang["help_memorylimit"],"").$lang["memory_limit"].':&nbsp;</td>';
$aus["global1"].='<td><input type="text" size="10" name="memory_limit" maxlength="10" style="text-align:right;" value="'.$config["memory_limit"].'"> Bytes</td></tr>';
$aus["global1"].='<tr><td>'.Help($lang["help_speed"],"").$lang["speed"].':&nbsp;</td>';
$aus["global1"].='<td><input type="text" size="6" name="minspeed" maxlength="6" style="text-align:right;" value="'.$config["minspeed"].'">&nbsp;'.$lang["to"].'&nbsp;<input type="text" size="6" name="maxspeed" maxlength="9" style="text-align:right;" value="'.$config["maxspeed"].'"></td></tr>';
//Multipart-Backup -->
$aus["global1"].='<tr><td>'.Help($lang["help_multipart"],"").$lang["multi_part"].':&nbsp;</td><td>';
$aus["global1"].='<input type="radio" value="1" name="multi_part" onclick="document.getElementById(\'mpg\').style.visibility=\'visible\';" '.(($config["multi_part"]==1)?" checked":"").'>'.$lang["yes"];
$aus["global1"].='<input type="radio" value="0" name="multi_part" onclick="document.getElementById(\'mpg\').style.visibility=\'hidden\';" '.(($config["multi_part"]==0)?" checked":"").'>'.$lang["no"];
$aus["global1"].='</td></tr><tr><td>'.Help($lang["help_multipartgroesse"],"").$lang["multi_part_groesse"].':&nbsp;</td>';
$aus["global1"].='<td>&nbsp;<div id="mpg" style="visibility:'.(($config["multi_part"]==0)?"hidden":"visible").';">';
$aus["global1"].='<input type="text" name="multipartgroesse1" size="3" maxlength="3" value="'.$config["multipartgroesse1"].'">&nbsp;&nbsp;';
$aus["global1"].='<select name="multipartgroesse2"><option value="1" '.(($config["multipartgroesse2"]==1) ? 'SELECTED' : '').';>Kilobytes</option><option value="2" '.(($config["multipartgroesse2"]==2) ? 'SELECTED' : '').'>Megabytes</option></select>';
$aus["global1"].='</div></td></tr><tr><td>'.Help($lang["help_empty_db_before_restore"],"conf4").$lang["empty_db_before_restore"].':&nbsp;</td><td>';
$aus["global1"].='<input type="radio" value="1" name="empty_db_before_restore" '.(($config["empty_db_before_restore"]==1)?" checked":"").'>'.$lang["yes"];
$aus["global1"].='<input type="radio" value="0" name="empty_db_before_restore" '.(($config["empty_db_before_restore"]==0)?" checked":"").'>'.$lang["no"];
$aus["global1"].='</td></tr>';

$aus["global1"].='<tr><td>'.Help($lang["help_optimize"],"").$lang['optimize'].':&nbsp;</td>';
$aus["global1"].='<td><input type="radio" value="1" name="optimize_tables" '.(($config["optimize_tables_beforedump"]==1)?" checked":"").'>'.$lang["activated"];
$aus["global1"].='<input type="radio" value="0" name="optimize_tables" '.(($config["optimize_tables_beforedump"]==0)?" checked":"").'>'.$lang["not_activated"].'</td></tr>';

//Interface -->		
$aus["global3"]='<tr><td colspan="2" class="hd">'.$lang["config_interface"].'</td></tr>';
$aus["global3"].='<tr><td>'.Help($lang["help_lang"],"conf11").$lang["language"].':&nbsp;</td>';
$aus["global3"].='<td><select name="language"><option value="de" '.(($config["language"]=="de")?" SELECTED":"").'>'.$lang["lang_de"].'</option>';
$aus["global3"].='<option value="en" '.(($config["language"]=="en")?" SELECTED":"").'>'.$lang["lang_en"].'</option>';
$aus["global3"].='</select><input type="hidden" name="lang_old" value="'.$config["language"].'"></td></tr>';
$aus["global3"].='<tr><td>'.Help($lang["help_browser"],"").'Browser:</td><td><input type="radio" value="0" name="frames" '.(($config["interface_browser_ie"]==0)?" checked":"").'>Internet Explorer<br><input type="radio" value="1" name="frames" '.(($config["interface_browser_ie"])?" checked":"").'>'.$lang['otherbrowser'].'</td></tr>';
$aus["global3"].='<tr><td>'.Help($lang["help_servercaption"],"").$lang['servercaption'].':</td><td><input type="checkbox" value="1" name="server_caption" '.(($config["interface_server_caption"]==1)?" checked":"").'>'.$lang['activated'].'&nbsp;&nbsp;&nbsp;';
$aus["global3"].='<select name="server_captioncolor">
<option value="#ffffff" style="background-color :#ffffff;color:'.buildComplement("#ffffff").';" '.(($config["interface_server_captioncolor"]=="#ffffff" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ffffcc" style="background-color :#ffffcc;color:'.buildComplement("#ffffcc").';" '.(($config["interface_server_captioncolor"]=="#ffffcc" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ffff99" style="background-color :#ffff99;color:'.buildComplement("#ffff99").';" '.(($config["interface_server_captioncolor"]=="#ffff99" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ccffff" style="background-color :#ccffff;color:'.buildComplement("#ccffff").';" '.(($config["interface_server_captioncolor"]=="#ccffff" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#0033ff" style="background-color :#0033ff;color:'.buildComplement("#0033ff").';" '.(($config["interface_server_captioncolor"]=="#0033ff" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ccffcc" style="background-color :#ccffcc;color:'.buildComplement("#ccffcc").';" '.(($config["interface_server_captioncolor"]=="#ccffcc" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#00ff00" style="background-color :#00ff00;color:'.buildComplement("#00ff00").';" '.(($config["interface_server_captioncolor"]=="#00ff00" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ff9966" style="background-color :#ff9966;color:'.buildComplement("#ff9966").';" '.(($config["interface_server_captioncolor"]=="#ff9966" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ff9933" style="background-color :#ff9933;color:'.buildComplement("#ff9933").';" '.(($config["interface_server_captioncolor"]=="#ff9933" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#ff3300" style="background-color :#ff3300;color:'.buildComplement("#ff3300").';" '.(($config["interface_server_captioncolor"]=="#ff3300" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#cccc99" style="background-color :#cccc99;color:'.buildComplement("#cccc99").';" '.(($config["interface_server_captioncolor"]=="#cccc99" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#669999" style="background-color :#669999;color:'.buildComplement("#669999").';" '.(($config["interface_server_captioncolor"]=="#669999" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#990000" style="background-color :#990000;color:'.buildComplement("#990000").';" '.(($config["interface_server_captioncolor"]=="#990000" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
<option value="#000000" style="background-color :#000000;color:'.buildComplement("#000000").';" '.(($config["interface_server_captioncolor"]=="#000000" ? "selected" : "")).'>&nbsp;Server&nbsp;</option>
</select></td></tr>';
$aus["global3"].='<tr><td colspan="2" class="hd">Mini-SQL</td></tr>';
$aus["global3"].='<tr><td>'.Help("","").$lang['sqlboxheight'].':&nbsp;</td>';
$aus["global3"].='<td><input type="text" name="sqlboxsize" value="'.$config["interface_sqlboxsize"].'" size="3" maxlength="3">&nbsp;pixel</td></tr>';
$aus["global3"].='<tr><td>'.Help("","").$lang['sqllimit'].':&nbsp;</td>';
$aus["global3"].='<td><input type="text" name="sql_limit" value="'.$config["sql_limit"].'" size="3" maxlength="3">&nbsp;</td></tr>';
$aus["global3"].='<tr><td>'.Help("","").$lang['bbparams'].':&nbsp;</td>';
$aus["global3"].='<td>';
$aus["global3"].='<table><tr><td>Breite:</td><td><input type="text" name="bb_width" value="'.$config["bb_width"].'" size="3" maxlength="3">&nbsp;pixel</td></tr>';
$aus["global3"].='<tr><td>'.$lang['bbtextcolor'].':&nbsp;</td>';
$aus["global3"].='<td><select name="bb_textcolor">
<option value="#000000" style="color :#000000;" '.(($config["bb_textcolor"]=="#000000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#000066" style="color :#000066;" '.(($config["bb_textcolor"]=="#000066" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#800000" style="color :#800000;" '.(($config["bb_textcolor"]=="#800000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#990000" style="color :#990000;" '.(($config["bb_textcolor"]=="#990000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#006600" style="color :#006600;" '.(($config["bb_textcolor"]=="#006600" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#996600" style="color :#996600;" '.(($config["bb_textcolor"]=="#996600" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#999999" style="color :#999999;" '.(($config["bb_textcolor"]=="#999999" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
</td></tr></table>';

$aus["global3"].='</td></tr>';
	
//automatisches L&ouml;schen-->
$aus["global2"]='<tr><td colspan="2" class="hd">'.$lang["config_autodelete"].'</td></tr>';
$aus["global2"].='<tr><td>'.Help($lang["help_ad1"],"conf8").$lang["autodelete"].':&nbsp;</td>';
$aus["global2"].='<td><input type="radio" value="1" name="auto_delete" '.(($config["auto_delete"]==1)?" checked":"").'>'.$lang["activated"];
$aus["global2"].='<input type="radio" value="0" name="auto_delete" '.(($config["auto_delete"]==0)?" checked":"").'>'.$lang["not_activated"];
$aus["global2"].='</td></tr><tr><td>'.Help($lang["help_ad2"],"conf9").$lang["age_of_files"].':&nbsp;</td>';
$aus["global2"].='<td><input type="text" size="3" name="del_files_after_days" value="'.$config["del_files_after_days"].'"></td>';
$aus["global2"].='</tr><tr><td>'.Help($lang["help_ad3"],"conf10").$lang["number_of_files_form"].':&nbsp;</td>';
$aus["global2"].='<td><table><tr><td><input type="text" size="3" name="max_backup_files" value="'.$config["max_backup_files"].'">';
$aus["global2"].='</td><td><input type="radio" value="0" name="max_backup_files_each" '.(($config["max_backup_files_each"]==0)?" checked":"").'>'.$lang["max_backup_files_each1"].'<br>';
$aus["global2"].='<input type="radio" value="1" name="max_backup_files_each" '.(($config["max_backup_files_each"]==1)?" checked":"").'>'.$lang["max_backup_files_each2"];
$aus["global2"].='</td></tr></table></td></tr>';


//Email-->
$aus["transfer1"]='<tr><td colspan="2" class="hd">'.$lang["config_email"].'</td></tr>';
$aus["transfer1"].='<tr><td>'.Help($lang["help_mail1"],"conf5").$lang["send_mail_form"].':&nbsp;</td>';
$aus["transfer1"].='<td><input type="radio" value="1" name="send_mail" '.(($config["send_mail"]==1)?" checked":"").'>'.$lang["yes"];
$aus["transfer1"].='<input type="radio" value="0" name="send_mail" '.(($config["send_mail"]==0)?" checked":"").'>'.$lang["no"];
$aus["transfer1"].='</td></tr><tr><td>'.Help($lang["help_mail2"],"conf6").$lang["email_adress"].':&nbsp;</td><td><input type="text" name="email0" value="'.$config["email_recipient"].'" size="30"></td></tr>';
$aus["transfer1"].='<tr><td>'.Help($lang["help_mail3"],"conf7").$lang["email_subject"].':&nbsp;</td><td><input type="text" name="email1" value="'.$config["email_sender"].'" size="30"></td></tr>';
$aus["transfer1"].='<tr><td>'.Help($lang["help_mail5"],"").$lang["send_mail_dump"].':&nbsp;</td><td>';
$aus["transfer1"].='<input type="radio" value="1" name="send_mail_dump" '.(($config["send_mail_dump"]==1)?" checked":"").'>'.$lang["yes"];
$aus["transfer1"].='<input type="radio" value="0" name="send_mail_dump"'.(($config["send_mail_dump"]==0)?" checked":"").'>'.$lang["no"];
$aus["transfer1"].='</td></tr><tr><td>'.Help($lang["help_mail4"],"").$lang["email_maxsize"].':&nbsp;</td><td>';
$aus["transfer1"].='<input type="text" name="email_maxsize1" size="3" maxlength="3" value="'.$config["email_maxsize1"].'">&nbsp;&nbsp;';
$aus["transfer1"].='<select name="email_maxsize2"><option value="1" '.(($config["email_maxsize2"]==1) ? ' SELECTED' : '').'>Kilobytes</option>';
$aus["transfer1"].='<option value="2" '.(($config["email_maxsize2"]==2) ? ' SELECTED' : '').'>Megabytes</option></select></td></tr>';
$aus["transfer1"].='<tr><td>'.Help($lang["help_cronmailprg"],"").$lang["cron_mailprg"].':&nbsp;</td>';
$aus["transfer1"].='<td><table><tr><td><input type="radio" name="cron_use_sendmail" value="1" '.(($config["cron_use_sendmail"]==1)?" checked":"").'>sendmail</td><td><input type="text" size="30" name="cron_sendmail" value="'.$config["cron_sendmail"].'"></td></tr>';
$aus["transfer1"].='<tr><td><input type="radio" name="cron_use_sendmail" value="0" '.(($config["cron_use_sendmail"]==0)?" checked":"").'>SMPT</td><td><input type="text" size="30" name="cron_smpt" value="'.$config["cron_smtp"].'"></td></tr><tr><td>&nbsp;</td><td>SMTP-Port: <strong>'.$config["cron_smtp_port"].'</strong></td></tr></table></td></tr>';
	
//FTP-->
$aus["transfer2"]='<tr><td colspan="2" class="hd">'.$lang["config_ftp"].'</td></tr>';
$aus["transfer2"].='<tr><td>'.Help($lang["help_ftptransfer"],"conf13").$lang["ftp_transfer"].':&nbsp;</td>';
$aus["transfer2"].='<td><input type="radio" value="1" name="ftp_transfer" '.((!extension_loaded("ftp")) ? "disabled " : "").(($config["ftp_transfer"]==1)?" checked":"").'>'.$lang["activated"];
$aus["transfer2"].=' <input type="radio" value="0" name="ftp_transfer" '.(($config["ftp_transfer"]==0)?" checked":"").'>'.$lang["not_activated"].'</td></tr>';
$aus["transfer2"].='<td>'.Help($lang['useconnection'].":","").$lang['useconnection'].':&nbsp;</td><td>';
$aus["transfer2"].=' <input type="radio" value="0" name="ftp_transferconn" '.(($config["ftp_connectionindex"]==0)?" checked":"").'>FTP 1&nbsp;&nbsp;';
$aus["transfer2"].=' <input type="radio" value="1" name="ftp_transferconn" '.(($config["ftp_connectionindex"]==1)?" checked":"").'>FTP 2&nbsp;&nbsp;';
$aus["transfer2"].=' <input type="radio" value="2" name="ftp_transferconn" '.(($config["ftp_connectionindex"]==2)?" checked":"").'>FTP 3</td></tr>';

$aus["transfer2"].='<tr><td>'.Help($lang["help_ftptimeout"],"").$lang["ftp_timeout"].':&nbsp;</td>';
$aus["transfer2"].='<td><input type="text" size="10" name="ftp_timeout" maxlength="3" style="text-align:right;" value="'.$config["ftp_timeout"].'"> sec</td></tr>';

$aus["transfer2"].='<tr><td>'.Help($lang["help_ftpssl"],"").$lang["ftp_ssl"].':&nbsp;</td>';
$aus["transfer2"].='<td><input type="checkbox" name="ftp_useSSL" value="1" '.(($config["ftp_useSSL"]==1) ? 'checked' : '').' '.((!extension_loaded("openssl")) ? "disabled " : "").'><span '.((!extension_loaded("openssl")) ? 'style="color:#999999;"' : '').'>'.$lang['ftp_useSSL'].'</span></td></tr>';

//1
$aus["transfer2"].='<tr><td valign="top"><strong>FTP-Connection 1</strong><br><input type="submit" name="testFTP0" value="'.$lang['testconnection'].'" style="width:130px;font-size:11px;background-color:#ffffcc;"><br>'.$checkFTP[0].'</td><td><table>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpserver"],"conf14",12).$lang["ftp_server"].':&nbsp;</td><td><input class="small" type="text" size="30" name="ftp_server0" value="'.$config["ftp_server"][0].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpport"],"conf15",12).$lang["ftp_port"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_port0" value="'.$config["ftp_port"][0].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpuser"],"conf16",12).$lang["ftp_user"].'&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_user0" value="'.$config["ftp_user"][0].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftppass"],"conf17",12).$lang["ftp_pass"].':&nbsp;</td><td class="small"><input class="small" type="password" size="30" name="ftp_pass0" value="'.$config["ftp_pass"][0].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpdir"],"conf18",12).$lang["ftp_dir"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_dir0" value="'.$config["ftp_dir"][0].'"></td></tr>';
$aus["transfer2"].='</table></td></tr>';
//2
$aus["transfer2"].='<tr><td valign="top"><strong>FTP-Connection 2</strong><br><input type="submit" name="testFTP1" value="'.$lang['testconnection'].'" style="width:130px;font-size:11px;background-color:#ffffcc;"><br>'.$checkFTP[1].'</td><td><table>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpserver"],"conf14",12).$lang["ftp_server"].':&nbsp;</td><td><input class="small" type="text" size="30" name="ftp_server1" value="'.$config["ftp_server"][1].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpport"],"conf15",12).$lang["ftp_port"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_port1" value="'.$config["ftp_port"][1].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpuser"],"conf16",12).$lang["ftp_user"].'&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_user1" value="'.$config["ftp_user"][1].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftppass"],"conf17",12).$lang["ftp_pass"].':&nbsp;</td><td class="small"><input class="small" type="password" size="30" name="ftp_pass1" value="'.$config["ftp_pass"][1].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpdir"],"conf18",12).$lang["ftp_dir"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_dir1" value="'.$config["ftp_dir"][1].'"></td></tr>';
$aus["transfer2"].='</table></td></tr>';
//3
$aus["transfer2"].='<tr><td valign="top"><strong>FTP-Connection 3</strong><br><input type="submit" name="testFTP2" value="'.$lang['testconnection'].'" style="width:130px;font-size:11px;background-color:#ffffcc;"><br>'.$checkFTP[2].'</td><td><table>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpserver"],"conf14",12).$lang["ftp_server"].':&nbsp;</td><td><input class="small" type="text" size="30" name="ftp_server2" value="'.$config["ftp_server"][2].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpport"],"conf15",12).$lang["ftp_port"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_port2" value="'.$config["ftp_port"][2].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpuser"],"conf16",12).$lang["ftp_user"].'&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_user2" value="'.$config["ftp_user"][2].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftppass"],"conf17",12).$lang["ftp_pass"].':&nbsp;</td><td class="small"><input class="small" type="password" size="30" name="ftp_pass2" value="'.$config["ftp_pass"][2].'"></td></tr>';
$aus["transfer2"].='<tr><td class="small">'.Help($lang["help_ftpdir"],"conf18",12).$lang["ftp_dir"].':&nbsp;</td><td class="small"><input class="small" type="text" size="30" name="ftp_dir2" value="'.$config["ftp_dir"][2].'"></td></tr>';
$aus["transfer2"].='</table></td></tr>';

	

//Crondump
$aus["cron"]='<tr><td colspan="2" class="hd">'.$lang["config_cronperl"].'</td></tr>';
//$aus["cron"].='<tr><td>'.Help($lang["help_cronperlpath"],"").$lang["cron_perlpath"].':&nbsp;</td>';
//$aus["cron"].='<td><input type="text" size="30" name="cron_perlpath" value="'.$config["cron_perlpath"].'"></td></tr>';
$aus["cron"].='<tr><td>'.Help($lang["help_cronextender"],"").$lang["cron_extender"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="0" name="cron_extender" '.(($config["cron_extender"]==0)?" checked":"").'>.pl';
$aus["cron"].='<input type="radio" value="1" name="cron_extender" '.(($config["cron_extender"]==1)?" checked":"").'>.cgi';
$aus["cron"].='</td></tr><tr><td>'.Help($lang["help_cronsavepath"],"").$lang["cron_savepath"].':&nbsp;</td>';

$aus["cron"].='<td><table><tr><td>'.$lang['existing'].':</td><td><select name="cron_select_savepath">'.GetPerlConfigs().'</select></td></tr>';
$aus["cron"].='<tr><td>'.$lang['new'].':</td><td><input type="text" size="18" name="cron_savepath_new" value="">&nbsp;.conf</td></tr></table></td>';

$aus["cron"].='</tr><tr><td>'.Help($lang["help_cronexecpath"],"").$lang["cron_execpath"].':&nbsp;</td>';
$aus["cron"].='<td><input type="text" size="30" name="cron_execution_path" value="'.$config["cron_execution_path"].'"></td>';
$aus["cron"].='</tr><tr><td>'.Help($lang["help_cronprintout"],"").$lang["cron_printout"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="1" name="cron_printout" '.(($config["cron_printout"]==1)?" checked":"").'>'.$lang["yes"];
$aus["cron"].='<input type="radio" value="0" name="cron_printout" '.(($config["cron_printout"]==0)?" checked":"").'>'.$lang["no"];
$aus["cron"].='</td></tr><tr><td>'.Help($lang["help_cronsamedb"],"conf13").$lang["cron_samedb"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="0" name="cron_samedb" onclick="document.getElementById(\'cdb\').style.visibility=\'hidden\';" '.(($config["cron_samedb"]==0)?" checked":"").'>'.$lang["yes"];
$aus["cron"].='<input type="radio" value="1" name="cron_samedb" onclick="document.getElementById(\'cdb\').style.visibility=\'visible\';" '.(($config["cron_samedb"]==1)?" checked":"").'>'.$lang["no"];
$aus["cron"].='</td></tr><tr><td>'.Help($lang["help_crondbindex"],"conf14").$lang["cron_crondbindex"].':&nbsp;</td>';
$aus["cron"].='<td><div id="cdb" style="visibility:'.(($config["cron_samedb"]==0)?"hidden;":"visible;").'"><select name="cron_dbindex">';
$datenbanken=count($databases["Name"]);
for($i=0;$i<$datenbanken;$i++)
{
	$aus["cron"].='<option value="'.$i.'" ';
	if($i==$databases["db_actual_cronindex"]) $aus["cron"].='SELECTED';
	$aus["cron"].='>'.$databases["Name"][$i]."</option>\n";
}
$aus["cron"].='<option value="-2" ';
if($databases["db_actual_cronindex"]==-2) $aus["cron"].='SELECTED';
$aus["cron"].='>'.$lang['multidumpconf']."</option>\n";
$aus["cron"].='<option value="-3" ';
if($databases["db_actual_cronindex"]==-3) $aus["cron"].='SELECTED';
$aus["cron"].='>'.$lang['multidumpall']."</option>\n";

$aus["cron"].='</select><br><input type="text" name="dbcronpraefix" value="'.$databases["db_actual_cronpraefix"].'"></div></td></tr>';
$aus["cron"].='<tr><td>'.Help($lang["help_cronzip"],"").$lang["gzip"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="1" name="cron_compression" '.(($config["cron_compression"]==1)?" checked":"").'>'.$lang["activated"];
$aus["cron"].='<input type="radio" value="0" name="cron_compression" '.(($config["cron_compression"]==0)?" checked":"").'>'.$lang["not_activated"];
$aus["cron"].='</td></tr><tr><td>'.Help($lang["help_cronmail"],"").$lang["send_mail_form"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="1" name="cron_mail" '.(($config["cron_mail"]==1)?" checked":"").'>'.$lang["yes"];
$aus["cron"].='<input type="radio" value="0" name="cron_mail" '.(($config["cron_mail"]==0)?" checked":"").'>'.$lang["no"];
$aus["cron"].='</td></tr><tr><td>'.Help($lang["help_cronmail_dump"],"").$lang["send_mail_dump"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="1" name="cron_mail_dump" '.(($config["cron_mail_dump"]==1)?" checked":"").'>'.$lang["yes"];
$aus["cron"].='<input type="radio" value="0" name="cron_mail_dump" '.(($config["cron_mail_dump"]==0)?" checked":"").'>'.$lang["no"];
$aus["cron"].='</td></tr>';

$aus["cron"].='<tr><td>'.Help($lang["help_cronftp"],"").$lang["cron_ftp"].':&nbsp;</td>';
$aus["cron"].='<td><input type="radio" value="1" name="cron_ftp" '.(($config["cron_ftp"]==1)?" checked":"").'>'.$lang["yes"];
$aus["cron"].='<input type="radio" value="0" name="cron_ftp" '.(($config["cron_ftp"]==0)?" checked":"").'>'.$lang["no"];
$aus["cron"].='</td></tr>';

	
	

//Formular-Buttons -->		
$aus["formende"]='</table>';



// AUSGABE
$display='none';
//$display='block';
//print_r($_POST);
//echo '<hr>';
echo $aus["formstart"];
$invisible="";
switch ($command) {
case 0:
	echo $aus["db"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global2"].$aus["global3"].$aus["transfer1"].$aus["transfer2"].$aus["cron"].'</table></div>';
	break;
case 1:
	echo $aus["global1"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["db"].$aus["global2"].$aus["global3"].$aus["transfer1"].$aus["transfer2"].$aus["cron"].'</table></div>';
	break;
case 2:
	echo $aus["global2"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global3"].$aus["db"].$aus["transfer1"].$aus["transfer2"].$aus["cron"].'</table></div>';
	break;
case 3:
	echo $aus["transfer1"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global2"].$aus["global3"].$aus["db"].$aus["transfer2"].$aus["cron"].'</table></div>';
	break;
case 4:
	echo $aus["transfer2"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global2"].$aus["global3"].$aus["transfer1"].$aus["db"].$aus["cron"].'</table></div>';
	break;
case 5:
	echo $aus["cron"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global2"].$aus["global3"].$aus["transfer1"].$aus["transfer2"].$aus["db"].'</table></div>';
	break;
case 6:
	echo $aus["db"].$aus["global1"].$aus["global2"].$aus["global3"].$aus["transfer1"].$aus["transfer2"].$aus["cron"]; 
	break;
case 7:
	echo $aus["global3"];
	$invisible='<div style="display:'.$display.'"><table>'.$aus["global1"].$aus["global2"].$aus["transfer1"].$aus["transfer2"].$aus["db"].$aus["cron"].'</table></div>';
	break;
}
echo $aus["formende"].$invisible.'</form>';

include("inc/footer.php");




?>