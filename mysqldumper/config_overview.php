<?php
// wenn neue Sprache angewählt wurde schon vor dem includen übernehmen
if (isset($_POST['save']) && $_POST['language']!=$_POST['lang_old'])
{
	$config['language']=$_POST['language'];
	$temp_lang=$config['language'];
	include_once('./inc/header.php'); // Normal prodecure (resets config[language])
	$config['language']=$temp_lang; // re-set language
	include('./language/lang_list.php'); // This re-initializes $lang[] and loads appropiate language files
}
else include_once('./inc/header.php'); // language not changed, go on as usual

include_once('./language/'.$config['language'].'/lang_help.php');
include_once('./language/'.$config['language'].'/lang_config_overview.php');
include_once('./language/'.$config['language'].'/lang_sql.php');
include_once('./inc/runtime.php');
include_once('./inc/functions_sql.php');

$config['theme']=(!isset($config['theme'])) ? 'msd' : $config['theme'];

$config['interface_server_caption']=(!isset($config['interface_server_caption'])) ? 0 : $config['interface_server_caption'];
$config['interface_server_caption_position']=(!isset($config['interface_server_caption_position'])) ? 0 : $config['interface_server_caption_position'];
$config['cron_smtp_port']=(!isset($config['cron_smtp_port'])) ? 25 : $config['cron_smtp_port'];
$config['interface_table_compact']=(isset($_POST['interface_table_compact'])) ? $_POST['interface_table_compact'] : $config['interface_table_compact'];

$msg='';
$sel=(isset($_POST['sel'])) ? $_POST['sel'] : 'db';
if (!isset($command)) $command=0;

$ftptested=-1;
if ( (isset($_POST['testFTP0'])) || (isset($_POST['testFTP1'])) || (isset($_POST['testFTP2'])))
{
	$config['ftp_transfer']=(isset($_POST['ftp_transfer'])) ? $_POST['ftp_transfer']:0;
	$config['ftp_connectionindex']=(isset($_POST['ftp_transferconn'])) ? $_POST['ftp_transferconn']:0;
	$config['ftp_timeout']=(isset($_POST['ftp_timeout'])) ? $_POST['ftp_timeout']:30;
	$config['ftp_useSSL']=(isset($_POST['ftp_useSSL'])) ? $_POST['ftp_useSSL'] : 0;
	$config['ftp_mode']=(isset($_POST['ftp_mode'])) ? 1 : 0;
	for($i=0;$i<3;$i++) {
		$checkFTP[$i]="";
		$config['ftp_server'][$i]=(isset($_POST['ftp_server'.$i])) ? $_POST['ftp_server'.$i]:'';
		$config['ftp_port'][$i]=(isset($_POST['ftp_port'.$i])) ? $_POST['ftp_port'.$i]:21;
		$config['ftp_user'][$i]=(isset($_POST['ftp_user'.$i])) ? $_POST['ftp_user'.$i]:'';
		$config['ftp_pass'][$i]=(isset($_POST['ftp_pass'.$i])) ? $_POST['ftp_pass'.$i]:'';
		$config['ftp_dir'][$i]=(isset($_POST['ftp_dir'.$i])) ? stripslashes($_POST['ftp_dir'.$i]):'/';
		if($config['ftp_dir'][$i]=="" || (strlen($config['ftp_dir'][$i])>1 && substr($config['ftp_dir'][$i],-1)!="/")) $config['ftp_dir'][$i].="/";
	}
}

$showVP=false;
$oldtheme=$config['theme'];
$oldscposition=$config['interface_server_caption_position'];
$checkFTP=Array("&nbsp;<br><br>&nbsp;<br>&nbsp;","&nbsp;<br><br>&nbsp;<br>&nbsp;","&nbsp;<br><br>&nbsp;<br>&nbsp;");
if(isset($_POST['testFTP0'])) {
	$checkFTP[0]='<div class="ssmall">'.$lang['testconnection'].' FTP-Connection 1<br><br>'.TesteFTP($_POST['ftp_server0'],$_POST['ftp_port0'],$_POST['ftp_user0'],$_POST['ftp_pass0'],$_POST['ftp_dir0']).'</div>';
	$ftptested=0;
}
if(isset($_POST['testFTP1'])) {
	$checkFTP[1]='<div class="ssmall">'.$lang['testconnection'].' FTP-Connection 2<br><br>'.TesteFTP($_POST['ftp_server1'],$_POST['ftp_port1'],$_POST['ftp_user1'],$_POST['ftp_pass1'],$_POST['ftp_dir1']).'</div>';
	$ftptested=1;
}
if(isset($_POST['testFTP2'])) {
	$checkFTP[2]='<div class="ssmall">'.$lang['testconnection'].' FTP-Connection 3<br><br>'.TesteFTP($_POST['ftp_server2'],$_POST['ftp_port2'],$_POST['ftp_user2'],$_POST['ftp_pass2'],$_POST['ftp_dir2']).'</div>';
	$ftptested=2;
}

if($ftptested>-1) {
	$ftp_server[$ftptested]=$_POST['ftp_server'.$ftptested];
	$ftp_port[$ftptested]=$_POST['ftp_port'.$ftptested];
	$ftp_user[$ftptested]=$_POST['ftp_user'.$ftptested];
	$ftp_pass[$ftptested]=$_POST['ftp_pass'.$ftptested];
	$ftp_dir[$ftptested]=stripslashes($_POST['ftp_dir'.$ftptested]);
	if($ftp_dir[$ftptested]=="" || (strlen($ftp_dir[$ftptested])>1 && substr($ftp_dir[$ftptested],-1)!="/")) $ftp_dir[$ftptested].="/";
}

echo MSDHeader();

if (isset($_POST['load']))
{
	$msg=SetDefault(true);
	$msg=nl2br($msg)."<br>". $lang['load_success']."<br>";
	echo '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
}

if (isset($_POST['save']))
{
	//Parameter auslesen

	$config['multi_dump']=(isset($_POST['MultiDBDump'])) ? $_POST['MultiDBDump'] : 0;
	$databases['db_actual_cronpraefix']=$_POST['dbcronpraefix'];
	$config['compression']=$_POST['compression'];
	$config['language']=$_POST['language'];
	$config['interface_server_caption']=$_POST['server_caption'];
	$config['interface_server_caption_position']=$_POST['server_caption_position'];
	$config['interface_sqlboxsize']=$_POST['sqlboxsize'];
	$config['theme']=$_POST['theme'];
	$config['interface_table_compact']=(isset($_POST['interface_table_compact'])) ? $_POST['interface_table_compact'] : 1;

	$config['email_recipient']=$_POST['email0'];
	$config['email_sender']=$_POST['email1'];
	$config['send_mail']=$_POST['send_mail'];
	$config['send_mail_dump']=$_POST['send_mail_dump'];

	$config['email_maxsize1']=$_POST['email_maxsize1']; if($config['email_maxsize1']=="") $config['email_maxsize1']=0;
	$config['email_maxsize2']=$_POST['email_maxsize2'];
	$config['email_maxsize']=$config['email_maxsize1']*(($config['email_maxsize2']==1) ? 1024 : 1024*1024);

	$config['backup_complete_inserts']=(isset($_POST['backup_complete_inserts'])) ? 1 : 0;
	$config['backup_extended_inserts']=(isset($_POST['backup_extended_inserts'])) ? 1 : 0;
	$config['backup_delayed_inserts']=(isset($_POST['backup_delayed_inserts'])) ? 1 : 0;
	$config['backup_ignore_inserts']=(isset($_POST['backup_ignore_inserts'])) ? 1 : 0;
	$config['backup_lock_tables']=(isset($_POST['backup_lock_tables'])) ? 1 : 0;
	$config['backup_downgrade']=(isset($_POST['backup_downgrade'])) ? 1 : 0;

	$config['memory_limit']=$_POST['memory_limit']; if($config['memory_limit']=="") $config['memory_limit']=0;
	$config['minspeed']=$_POST['minspeed']; if($config['minspeed']<50) $config['minspeed']=50;
	$config['maxspeed']=$_POST['maxspeed'];
	$config['stop_with_error']=$_POST['stop_with_error'];

	$config['multi_part']=$_POST['multi_part'];
	$config['multipartgroesse1']=$_POST['multipartgroesse1'];
	$config['multipartgroesse2']=$_POST['multipartgroesse2'];
	if($config['multipartgroesse1']<100 && $config['multipartgroesse2']==1)$config['multipartgroesse1']=100;

	$oldlogcompression=$config['logcompression'];
	$config['logcompression']=(isset($_POST['logcompression']) && $_POST['logcompression']==1) ? 1 : 0;
	$config['log_maxsize1']=$_POST['log_maxsize1']; if($config['log_maxsize1']=="") $config['log_maxsize1']=0;
	$config['log_maxsize2']=$_POST['log_maxsize2'];
	$config['log_maxsize']=$config['log_maxsize1']*(($config['log_maxsize2']==1) ? 1024 : 1024*1024);

	$config['auto_delete']=$_POST['auto_delete'];
	$config['del_files_after_days']=$_POST['del_files_after_days'];
	$config['max_backup_files']=$_POST['max_backup_files'];
	$config['max_backup_files_each']=$_POST['max_backup_files_each'];


	$config['empty_db_before_restore']=$_POST['empty_db_before_restore'];
	$config['optimize_tables_beforedump']=$_POST['optimize_tables'];
	$config['cron_samedb']=$_POST['cron_samedb'];


	$config['cron_extender']=$_POST['cron_extender'];
	// cron_select_savepath/
	if (!isset($_POST['cron_select_savepath'])) $_POST['cron_select_savepath']='mysqldumper';
	if(isset($_POST['cron_savepath_new']) && !empty($_POST['cron_savepath_new']))
		$config['cron_configurationfile']=$_POST['cron_savepath_new'].".conf.php";
	else
		$config['cron_configurationfile']=$_POST['cron_select_savepath'].".conf.php";


	$config['cron_execution_path']=$_POST['cron_execution_path'];
	if($config['cron_execution_path']=="")$config['cron_execution_path']="msd_cron/";
	if(strlen($config['cron_execution_path'])>1 && substr($config['cron_execution_path'],-1)!="/") $config['cron_execution_path'].="/";
	$config['cron_mail']=$_POST['cron_mail'];
	$config['cron_mail_dump']=$_POST['cron_mail_dump'];

	$config['cron_use_sendmail']=$_POST['cron_use_sendmail'];
	$config['cron_sendmail']=$_POST['cron_sendmail'];
	$config['cron_smtp']=$_POST['cron_smpt'];

	$config['cron_printout']=$_POST['cron_printout'];
	$config['cron_completelog']=$_POST['cron_completelog'];
	$config['cron_ftp']=$_POST['cron_ftp'];
	$config['cron_compression']=$_POST['cron_compression'];
	$config['cron_comletelog']=$_POST['cron_completelog'];

	$databases['multi']=Array();
	$databases['multi_praefix']=Array();
	$databases['multi_commandbeforedump']=Array();
	$databases['multi_commandafterdump']=Array();
	if (isset($databases['Name'][0]) && $databases['Name'][0]>'')
	{
		for($i=0;$i<count($databases['Name']);$i++)
		{
			$databases['praefix'][$i]=$_POST['dbpraefix_'.$i];
	      	$databases['command_before_dump'][$i]=(!isset($_POST['command_before_'.$i])) ? "" : $_POST['command_before_'.$i];
	      	$databases['command_after_dump'][$i]=(!isset($_POST['command_after_'.$i])) ? "" : $_POST['command_after_'.$i];
			if(isset($_POST['db_multidump_'.$i]) && $_POST['db_multidump_'.$i]=="db_multidump_$i")
			{
				$databases['multi'][]=$databases['Name'][$i];
				$databases['multi_praefix'][]=$databases['praefix'][$i];
				$databases['multi_commandbeforedump'][]=$databases['command_before_dump'][$i];
				$databases['multi_commandafterdump'][]=$databases['command_after_dump'][$i];
			}
		}
	}

	$databases['multisetting']=(count($databases['multi'])>0)?implode(";",$databases['multi']) : "";
	$databases['multisetting_praefix']=(count($databases['multi'])>0)?implode(";",$databases['multi_praefix']) : "";
	$databases['multisetting_commandbeforedump']=(count($databases['multi'])>0)?implode(";",$databases['multi_commandbeforedump']) : "";
	$databases['multisetting_commandafterdump']=(count($databases['multi'])>0)?implode(";",$databases['multi_commandafterdump']) : "";

	$databases['db_actual_cronindex']=$_POST['cron_dbindex'];
	if($config['cron_samedb']==0){
		$databases['db_actual_cronindex']=$databases['db_selected_index'];

	} elseif($databases['db_actual_cronindex']=="-2") {
		$cron_save_all_dbs=1;
		$datenbanken=count($databases['Name']);
		$cron_db_array=str_replace(";","|",$databases['multisetting']);
		$cron_dbpraefix_array=str_replace(";","|",$databases['multisetting_praefix']);
		$cron_db_cbd_array=str_replace(";","|",$databases['multisetting_commandbeforedump']);
		$cron_db_cad_array=str_replace(";","|",$databases['multisetting_commandafterdump']);

	} elseif ($databases['db_actual_cronindex']=="-3") {
		$cron_save_all_dbs=1;
		$cron_db_array=implode("|",$databases['Name']);
		$cron_dbpraefix_array=implode("|",$databases['praefix']);
		$cron_db_cbd_array=implode("|",$databases['command_before_dump']);
		$cron_db_cad_array=implode("|",$databases['command_after_dump']);

	}

	$config['ftp_transfer']=$_POST['ftp_transfer'];
	$config['ftp_connectionindex']=$_POST['ftp_transferconn'];
	$config['ftp_timeout']=$_POST['ftp_timeout'];
	$config['ftp_useSSL']=isset($_POST['ftp_useSSL']) ? $_POST['ftp_useSSL'] : 0;
	$config['ftp_mode']=isset($_POST['ftp_mode']) ? 1 : 0;

	for($i=0;$i<3;$i++) {
		$checkFTP[$i]="";
		$config['ftp_server'][$i]=$_POST['ftp_server'.$i];
		$config['ftp_port'][$i]=$_POST['ftp_port'.$i];
		$config['ftp_user'][$i]=$_POST['ftp_user'.$i];
		$config['ftp_pass'][$i]=$_POST['ftp_pass'.$i];
		$config['ftp_dir'][$i]=stripslashes($_POST['ftp_dir'.$i]);
		if($config['ftp_port'][$i]+0==0) $config['ftp_port'][$i]=21;
		if($config['ftp_dir'][$i]=="" || (strlen($config['ftp_dir'][$i])>1 && substr($config['ftp_dir'][$i],-1)!="/")) $config['ftp_dir'][$i].="/";
	}

	$config['bb_width']=$_POST['bb_width'];
	$config['bb_textcolor']=$_POST['bb_textcolor'];
	$config['sql_limit']=$_POST['sql_limit'];

	$config['connect_utf8']=isset($_POST['connect_utf8']) ?1:0;
	if($config['dbhost']!=$_POST['dbhost'] ||
		$config['dbuser']!=$_POST['dbuser'] ||
		$config['dbpass']!=$_POST['dbpass'] ||
		$config['dbport']!=$_POST['dbport'] ||
		$config['dbsocket']!=$_POST['dbsocket']) {
		//neue Verbindungsparameter

		$show_VP=true;

		//alte Parameter sichern
		$old['dbhost']=$config['dbhost'];
		$old['dbuser']=$config['dbuser'];
		$old['dbpass']=$config['dbpass'];
		$old['dbport']=$config['dbport'];
		$old['dbsocket']=$config['dbsocket'];

		//neu setzen
		$config['dbhost']=$_POST['dbhost'];
		$config['dbuser']=$_POST['dbuser'];
		$config['dbpass']=$_POST['dbpass'];
		$config['dbport']=$_POST['dbport'];
		$config['dbsocket']=$_POST['dbsocket'];
		if(MSD_mysql_connect())
		{
			// neue Vernindungsdaten wurden akzeptiert -> manuelle DB-Liste von anderem User löschen
			if (file_exists('./'.$config['files']['dbs_manual'])) @unlink('./'.$config['files']['dbs_manual']);
			unset($databases['Name']);
			SetDefault();
			$msg.= '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
		}
		else
		{
			//alte Werte holen
			$config['dbhost']=$old['dbhost'];
			$config['dbuser']=$old['dbuser'];
			$config['dbpass']=$old['dbpass'];
			$config['dbport']=$old['dbport'];
			$config['dbsocket']=$old['dbsocket'];
			$msg.='<p class="error">'.$lang['wrong_connectionpars'].'</p>';
		}

	}

	// Manuelles hinzufügen einer Datenbank
	if ($_POST['add_db_manual']>'')
	{
		$to_add=trim($_POST['add_db_manual']);
		$found=false;
		// Prüfen, ob die DB bereits in der Liste vorhanden ist
		if (isset($databases['Name'][0]))
		{
			foreach ($databases['Name'] as $existing_db)
			{
				if ($existing_db==$to_add) $found=true;
			}
		}
		if ($found) $add_db_message=sprintf($lang['db_in_list'],$to_add);
		else
		{
			if(MSD_mysql_connect())
			{
				$res=mysql_selectdb($to_add,$config['dbconnection']);
				if (!$res===false)
				{
					$dbs_manual=array();
					if (file_exists('./'.$config['files']['dbs_manual'])) $dbs_manual=file('./'.$config['files']['dbs_manual']);
					if (!in_array($to_add,$dbs_manual)) $dbs_manual[]=$to_add;
					$file_handle=fopen('./'.$config['files']['dbs_manual'],'a');
					if ($file_handle)
					{
						foreach ($dbs_manual as $f) { fwrite($file_handle,$f); }
						fclose($file_handle);
						@chmod('./'.$config['files']['dbs_manual'],0777);
						//Menü aktualisieren, damit die DB in dr Selectliste erscheint
						echo '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
					}
					else $add_db_message=sprintf($lang['db_manual_file_error'],$to_add);
				}
				else $add_db_message=sprintf($lang['db_manual_error'],$to_add);
				$showVP=true;
			}
		}
	}

	// und wegschreiben
	if (WriteParams(0)==true)
	{
		//neue Sprache? Dann Men&uuml; links auch aktualisieren
		if(	$_POST['lang_old']!=$config['language']
			|| $_POST['scaption_old']!=$config['interface_server_caption']
			|| $oldtheme!=$config['theme']
			|| $oldscposition!=$config['interface_server_caption_position'])
		{
			$msg.= '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
		}
		//Parameter laden
		include($config['files']['parameter']);
		if ($config['logcompression']!=$oldlogcompression) SwitchLogfileFormat();
		$msg.= '<p class="success">'.$lang['save_success'].'</p>';
	} else $msg.= '<p class="error">'.$lang['save_error'].'</p>';
}

ReadSQL();

?>
<script type="text/javascript">
function hide_pardivs() {
	document.getElementById("db").style.display = 'none';
	document.getElementById("global1").style.display = 'none';
	document.getElementById("global2").style.display = 'none';
	document.getElementById("global3").style.display = 'none';
	document.getElementById("transfer1").style.display = 'none';
	document.getElementById("transfer2").style.display = 'none';
	document.getElementById("cron").style.display = 'none';
	for(i=1;i<9;i++) {
		document.getElementById("command"+i).className  ='ConfigButton';
	}
}
function SwitchVP() {
	if(document.getElementById('VP').style.display=='none')
		document.getElementById('VP').style.display='block';
	else
		document.getElementById('VP').style.display='none'
}

function show_pardivs(lab) {
	hide_pardivs();
	switch(lab) {
		case "db":
			document.getElementById("db").style.display = 'block';
			document.getElementById("command1").className ='ConfigButtonSelected';
			break;
		case "global1":
			document.getElementById("global1").style.display = 'block';
			document.getElementById("command2").className ='ConfigButtonSelected';
			break;
		case "global2":
			document.getElementById("global3").style.display = 'block';
			document.getElementById("command3").className ='ConfigButtonSelected';
			break;
		case "global3":
			document.getElementById("global2").style.display = 'block';
			document.getElementById("command4").className ='ConfigButtonSelected';
			break;
		case "transfer1":
			document.getElementById("transfer1").style.display = 'block';
			document.getElementById("command5").className ='ConfigButtonSelected';
			break;
		case "transfer2":
			document.getElementById("transfer2").style.display = 'block';
			document.getElementById("command6").className ='ConfigButtonSelected';
			break;
		case "cron":
			document.getElementById("cron").style.display = 'block';
			document.getElementById("command7").className ='ConfigButtonSelected';
			break;
		case "all":
			document.getElementById("db").style.display = 'block';
			document.getElementById("global1").style.display = 'block';
			document.getElementById("global2").style.display = 'block';
			document.getElementById("global3").style.display = 'block';
			document.getElementById("transfer1").style.display = 'block';
			document.getElementById("transfer2").style.display = 'block';
			document.getElementById("cron").style.display = 'block';
			document.getElementById("command8").className ='ConfigButtonSelected';
			break;
		default:
			document.getElementById("db").style.display = 'block';
			document.getElementById("command1").className ='ConfigButtonSelected';
			break;
	}
	document.getElementById("sel").value=lab;
}
function WriteMem()
{
	document.getElementById("mlimit").value=<?php echo round($config['ram']*1024*1024*0.9,0);?>;
}
</script>
<?php

if(!isset($config['email_maxsize1']))$config['email_maxsize1']=0;
if(!isset($config['email_maxsize2']))$config['email_maxsize2']=1;
if(!isset($databases['multisetting'])) $databases['multisetting']="";
$databases['multi']=explode(";",$databases['multisetting']);

//Ausgabe-Teile
$aus['formstart']=headline($lang['config_headline']);
$aus['formstart'].='<form name="frm_config" method="POST" action="config_overview.php"><input type="hidden" name="sel" id="sel" value="db">'.$nl;
$aus['formstart'].='<div id="configleft">';
$aus['formstart'].='<input type="Button" id="command1" onclick="show_pardivs(\'db\');" value="'.$lang['dbs'].'" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command2" onclick="show_pardivs(\'global1\');" value="'.$lang['general'].'" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command3" onclick="show_pardivs(\'global2\');" value="'.$lang['config_interface'].'" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command4" onclick="show_pardivs(\'global3\');" value="'.$lang['config_autodelete'].'" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command5" onclick="show_pardivs(\'transfer1\');" value="Email" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command6" onclick="show_pardivs(\'transfer2\');" value="FTP" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command7" onclick="show_pardivs(\'cron\');" value="Cronscript" class="ConfigButton"><br>'.$nl;
$aus['formstart'].='<input type="Button" id="command8" onclick="show_pardivs(\'all\');" value="'.$lang['allpars'].'" class="ConfigButton"><br>'.$nl;

$aus['formstart'].='<input class="Formbutton" type="reset" name="reset" value="'.$lang['reset'].'"><br><input class="Formbutton" type="submit" name="save" value="'.$lang['save'].'"><br><br>'.$nl;
$aus['formstart'].='<input class="Formbutton" type="Submit" name="load" value="'.$lang['load'].'" onclick="if (!confirm(\''.$lang['config_askload'].'\')) return false;">'.$nl;
$aus['formstart'].='<input class="Formbutton" type="button" value="'.$lang['install'].'" onclick="parent.location.href=\'install.php\'">'.$nl;
$aus['formstart'].='</div><div id="configright">'.$msg.$nl;

// Zugangsdaten
$aus['db']='<div id="db"><fieldset><legend><b>'.$lang['connectionpars'].'</b></legend>'.$nl.$nl;
$aus['db'].='<div id="VP" style="display:none;"';
$aus['db'].='><table><tr><td>Host / User / Passwort:</td>';
$aus['db'].='<td><input class="text" type="text" name="dbhost" value="'.$config['dbhost'].'">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="text" name="dbuser" value="'.$config['dbuser'].'" size="20">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="password" name="dbpass" value="'.$config['dbpass'].'" size="20"></td></tr>';
$aus['db'].='<tr><td colspan="2"><strong>'.$lang['extendedpars'].'</strong></td></tr>';
$aus['db'].='<tr><td>Port / Socket:</td><td><input class="text" type="text" name="dbport" value="'.$config['dbport'].'">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="text" name="dbsocket" value="'.$config['dbsocket'].'"></td></tr>';

$aus['db'].='<tr><td>'.$lang['add_db_manually'].':</td>';
$aus['db'].='<td><input class="text" type="text" name="add_db_manual" value=""></td></tr>';

if(isset($add_db_message))
{
	$aus['db'].='<tr><td colspan="2" class="error">'.$add_db_message;
	$aus['db'].='</td></tr>';
}

$aus['db'].='<tr><td>'.$lang['connect_utf8'].'</td><td><input type="checkbox" class="checkbox" value="1" name="connect_utf8"'.(intval($config['connect_utf8'])==0?'':' checked="checked"').'></td></tr>';
$aus['db'].='</table></div><div><a class="small" href="#" onclick="SwitchVP();">'.$lang['fade_in_out'].'</a></div></fieldset><fieldset><legend><b>'.$lang['db_backuppars'].'</b></legend>';

$aus['db'].='<table class="bordersmall" style="border:0;width:98%;">';

//Wenn Datenbanken vorhanden sind
if (isset($databases['Name'][0]) && $databases['Name'][0]>'')
{
	if(count($databases['Name'])==1)
	{
		$databases['db_actual']=$databases['Name'][0];
		$aus['db'].='<tr><td>'.Help($lang['help_db'],"conf1").$lang['list_db'].'</td>';
		$aus['db'].='<td><strong>'.$databases['db_actual'].'</strong></td></tr>';
		$aus['db'].='<tr><td>'.Help($lang['help_praefix'],"conf2").$lang['praefix'].'</td><td><input type="text" class="text" name="dbpraefix_'.$databases['db_selected_index'].'" size="10" value="'.$databases['praefix'][$databases['db_selected_index']].'"></td></tr>';
		$aus['db'].= '<tr><td>'.Help($lang['help_commands'],"").'Command before Dump</td><td>'.ComboCommandDump(0,$databases['db_selected_index']).'</td></tr>';
		$aus['db'].= '<tr><td>'.Help($lang['help_commands'],"").'Command after Dump</td><td>'.ComboCommandDump(1,$databases['db_selected_index']).'</td>';
		$aus['db'].= '<td><a href="sql.php?context=1">'.$lang['sql_befehle'].'</a></td>';
		$aus['db'].= '</tr>';
	}
	else
	{
		$aus['db'].='<tr><td>'.Help($lang['help_db'],"conf1").$lang['list_db'].'</td><td><input type="checkbox" class="checkbox" name="MultiDBDump" value="1" '.(($config['multi_dump']==1) ? "CHECKED" : "").'>'.$lang['activate_multidump'].'</td>';
		$aus['db'].='<tr><td colspan="2"><table>';
		$aus['db'].='<tr class="thead"><th>'.$lang['db'].'</th><th>Multidump<br><span class="ssmall">(<a href="javascript:SelectMD(true,'.count($databases['Name']).')" class="small">'.$lang['all'].'</a>&nbsp;<a href="javascript:SelectMD(false,'.count($databases['Name']).')" class="small">'.$lang['none'].'</a>)</span></th>';
		$aus['db'].='<th>'.Help($lang['help_praefix'],"conf2").$lang['praefix'].'</th><th>'.Help($lang['help_commands'],"",11).'Command before Dump</th><th>'.Help($lang['help_commands'],"",11).'Command after Dump</th><th>'.$lang['sql_befehle'].'</th></tr>';

		//erst die aktuelle DB
		$aus['db'].= '<tr class="dbrowsel"><td><strong>'.$databases['db_actual'].'</strong></td>';
		$aus['db'].= '<td align="center"><input type="checkbox" class="checkbox" name="db_multidump_'.$databases['db_selected_index'].'" value="db_multidump_'.$databases['db_selected_index'].'" '.((in_array($databases['db_actual'],$databases['multi'])) ? "CHECKED" : "").'></td>';
		$aus['db'].= '<td><img src="images/blank.gif" width="40" height="1" alt=""><input type="text" class="text" name="dbpraefix_'.$databases['db_selected_index'].'" size="10" value="'.$databases['praefix'][$databases['db_selected_index']].'"></td>';
		$aus['db'].= '<td>'.ComboCommandDump(0,$databases['db_selected_index']).'</td><td>'.ComboCommandDump(1,$databases['db_selected_index']).'</td>';
		$aus['db'].= '<td><a href="sql.php?context=1">'.$lang['sql_befehle'].'</a></td>';
		$aus['db'].= '</tr>';

		$dbacombo=$dbbcombo="";$j=0;
		for($i=0;$i<count($databases['Name']);$i++)
		{
			if($i!=$databases['db_selected_index']) {
				$j++;
				$aus['db'].= '<tr class="'.(($i % 2)  ? 'dbrow' : 'dbrow1').'"><td>'.$databases['Name'][$i].'</td>';
				$aus['db'].= '<td align="center"><input type="checkbox" class="checkbox" name="db_multidump_'.$i.'" value="db_multidump_'.$i.'" '.((in_array($databases['Name'][$i],$databases['multi'])) ? "CHECKED" : "").'></td>';
				$aus['db'].= '<td><img src="images/blank.gif" width="40" height="1" alt=""><input type="text" class="text" name="dbpraefix_'.$i.'" size="10" value="'.$databases['praefix'][$i].'"></td><td>'.ComboCommandDump(0,$i).'</td><td>'.ComboCommandDump(1,$i).'</td>';
				$aus['db'].= '<td><a href="sql.php?context=1">'.$lang['sql_befehle'].'</a></td>';
				$aus['db'].= '</tr>';
			}
		}
	}
}
else $aus['db'].='<tr><td>'.$lang['no_db_found'].'</td></tr>';
$aus['db'].='</table></td></tr>';
$aus['db'].='</table></fieldset></div>';

// sonstige Einstellungen
$aus['global1']='<div id="global1"><fieldset><legend><b>'.$lang['general'].'</b></legend><table>';

$aus['global1'].='<tr><td>'.Help("","").'Logfiles:&nbsp;</td>';
$aus['global1'].='<td><input type="checkbox" class="checkbox" value="1" name="logcompression" '.(($config['zlib']) ? '' : 'disabled').(($config['logcompression']==1)?" checked":"").'>'.$lang['compressed'].'<br>';
$aus['global1'].=''.$lang['maxsize'].':&nbsp;&nbsp;<input type="text" class="text" name="log_maxsize1" size="3" maxlength="3" value="'.$config['log_maxsize1'].'">&nbsp;&nbsp;';
$aus['global1'].='<select name="log_maxsize2"><option value="1" '.(($config['log_maxsize2']==1) ? ' SELECTED' : '').'>Kilobytes</option>';
$aus['global1'].='<option value="2" '.(($config['log_maxsize2']==2) ? ' SELECTED' : '').'>Megabytes</option></select></td></tr>';

$aus['global1'].='<tr><td>'.Help($lang['help_memorylimit'],"").$lang['memory_limit'].':&nbsp;&nbsp;</td>';
$aus['global1'].='<td>';
$aus['global1'].='<input type="text" class="text" size="10" id="mlimit" name="memory_limit" maxlength="10" style="text-align:right;font-size:11px;" value="'.$config['memory_limit'].'"> Bytes&nbsp;&nbsp;&nbsp;<a href="#" onclick="WriteMem();" class="small">automatisch ermitteln</a>';
$aus['global1'].='</td></tr>';

$aus['global1'].='<tr><td>'.Help($lang['help_speed'],"").$lang['speed'].':&nbsp;</td>';
$aus['global1'].='<td><input type="text" class="text" size="6" name="minspeed" maxlength="6" style="text-align:right;" value="'.$config['minspeed'].'">&nbsp;'.$lang['to'].'&nbsp;<input type="text" class="text" size="6" name="maxspeed" maxlength="9" style="text-align:right;" value="'.$config['maxspeed'].'"></td></tr>';

$aus['global1'].='</table></fieldset><fieldset><legend><b>'.$lang['dump'].'</b></legend><table>';

$aus['global1'].='<tr><td>'.Help($lang['help_zip'],"conf3").$lang['gzip'].':&nbsp;</td>';
$aus['global1'].='<td><input type="radio" class="radio" value="1" name="compression" '.(($config['zlib']) ? '' : 'disabled').(($config['compression']==1)?" checked":"").'>'.$lang['activated'];
$aus['global1'].='<input type="radio" class="radio" value="0" name="compression" '.(($config['compression']==0)?" checked":"").'>'.$lang['not_activated'].'</td></tr>';
//Multipart-Backup -->
$aus['global1'].='<tr><td>'.Help($lang['help_multipart'],"").$lang['multi_part'].':&nbsp;</td><td>';
$aus['global1'].='<input type="radio" class="radio" value="1" name="multi_part" onclick="document.getElementById(\'mpg\').style.visibility=\'visible\';" '.(($config['multi_part']==1)?" checked":"").'>'.$lang['yes'];
$aus['global1'].='<input type="radio" class="radio" value="0" name="multi_part" onclick="document.getElementById(\'mpg\').style.visibility=\'hidden\';" '.(($config['multi_part']==0)?" checked":"").'>'.$lang['no'];
$aus['global1'].='</td></tr><tr><td>'.Help($lang['help_multipartgroesse'],"").$lang['multi_part_groesse'].':&nbsp;</td>';
$aus['global1'].='<td>&nbsp;<div id="mpg" style="visibility:'.(($config['multi_part']==0)?"hidden":"visible").';">';
$aus['global1'].='<input type="text" class="text" name="multipartgroesse1" size="3" maxlength="3" value="'.$config['multipartgroesse1'].'">&nbsp;&nbsp;';
$aus['global1'].='<select name="multipartgroesse2"><option value="1" '.(($config['multipartgroesse2']==1) ? 'SELECTED' : '').'>Kilobytes</option><option value="2" '.(($config['multipartgroesse2']==2) ? 'SELECTED' : '').'>Megabytes</option></select></div></td></tr>';
$aus['global1'].='<tr><td>'.Help($lang['help_optimize'],"").$lang['optimize'].':&nbsp;</td>';
$aus['global1'].='<td><input type="radio" class="radio" value="1" name="optimize_tables" '.(($config['optimize_tables_beforedump']==1)?" checked":"").'>'.$lang['activated'];
$aus['global1'].='<input type="radio" class="radio" value="0" name="optimize_tables" '.(($config['optimize_tables_beforedump']==0)?" checked":"").'>'.$lang['not_activated'].'</td></tr>';
$aus['global1'].='<tr><td>'.Help("","").$lang['backup_format'].':&nbsp;</td>';

$aus['global1'].='<td><input type="checkbox" class="checkbox" name="backup_complete_inserts" value="1" '.(($config['backup_complete_inserts']==1) ? "checked" : "").'>'.$lang['inserts_complete'].'<br>';
$aus['global1'].='<input type="checkbox" class="checkbox" name="backup_extended_inserts" value="1" '.(($config['backup_extended_inserts']==1) ? "checked" : "").'>'.$lang['inserts_extended'].'<br>';
$aus['global1'].='<input type="checkbox" class="checkbox" name="backup_delayed_inserts" value="1" '.(($config['backup_delayed_inserts']==1) ? "checked" : "").'>'.$lang['inserts_delayed'].'<br>';
$aus['global1'].='<input type="checkbox" class="checkbox" name="backup_ignore_inserts" value="1" '.(($config['backup_ignore_inserts']==1) ? "checked" : "").'>'.$lang['inserts_ignore'].'<br>';
$aus['global1'].='<input type="checkbox" class="checkbox" name="backup_lock_tables" value="1" '.(($config['backup_lock_tables']==1) ? "checked" : "").'>'.$lang['lock_tables'].'<br>';
$aus['global1'].='<input type="checkbox" class="checkbox" name="backup_downgrade" value="1" '.(($config['backup_downgrade']==1) ? "checked" : "").' '.((defined('MSD_MYSQL_VERSION') && !MSD_NEW_VERSION) ? "disabled" : "").'>'.$lang['downgrade'].'</td></tr>';


$aus['global1'].='</table></fieldset><fieldset><legend><b>'.$lang['restore'].'</b></legend><table>';
$aus['global1'].='<tr><td>'.Help($lang['help_empty_db_before_restore'],"conf4").$lang['empty_db_before_restore'].':&nbsp;</td><td>';
$aus['global1'].='<input type="radio" class="radio" value="1" name="empty_db_before_restore" '.(($config['empty_db_before_restore']==1)?" checked":"").'>'.$lang['yes'];
$aus['global1'].='<input type="radio" class="radio" value="0" name="empty_db_before_restore" '.(($config['empty_db_before_restore']==0)?" checked":"").'>'.$lang['no'];
$aus['global1'].='</td></tr>';


$aus['global1'].='<tr><td>'.Help("","").$lang['errorhandling_restore'].'</td><td>';
$aus['global1'].='<input type="radio" class="radio" name="stop_with_error" value="0" '.(($config['stop_with_error']==0)?" checked":"").'>'.$lang['ehrestore_continue'].'<br>';
$aus['global1'].='<input type="radio" class="radio" name="stop_with_error" value="1" '.(($config['stop_with_error']==1)?" checked":"").'>'.$lang['ehrestore_stop'];
$aus['global1'].='</td></tr></table></fieldset></div>';

//Interface -->
$aus['global3']='<div id="global3"><fieldset><legend><b>'.$lang['config_interface'].'</b></legend><table>';
$aus['global3'].='<tr><td>'.Help($lang['help_lang'],"conf11").$lang['language'].':&nbsp;</td>';
$aus['global3'].='<td><select name="language">'.GetLanguageCombo("op");
$aus['global3'].='</select>&nbsp;&nbsp;<a href="'.$languagepacks_ref.'" target="_blank">'.$lang['download_languages'].'</a><input type="hidden" name="lang_old" value="'.$config['language'].'"><input type="hidden" name="scaption_old" value="'.$config['interface_server_caption'].'"></td></tr>';

$aus['global3'].='<tr><td>'.Help($lang['help_servercaption'],"").$lang['servercaption'].':</td>';
$aus['global3'].='<td><input type="checkbox" class="checkbox" value="1" name="server_caption" '.(($config['interface_server_caption']==1)?" checked":"").'>'.$lang['activated'].'&nbsp;&nbsp;&nbsp;';
$aus['global3'].='<input type="radio" class="radio" name="server_caption_position" value="1" '.(($config['interface_server_caption_position']==1) ? "checked" : "").'>'.$lang['in_mainframe'].'&nbsp;&nbsp;<input type="radio" class="radio" name="server_caption_position" value="0" '.(($config['interface_server_caption_position']==0) ? "checked" : "").'>'.$lang['in_leftframe'].'';
$aus['global3'].='</td></tr>';
$aus['global3'].='<tr><td>'.Help("","").'Theme</td><td><select name="theme">'.GetThemes().'</select>&nbsp;&nbsp;<a href="'.$stylepacks_ref.'" target="_blank">'.$lang['download_styles'].'</a></td></tr>';

$aus['global3'].='</table></fieldset><fieldset><legend><b>'.$lang['sql_browser'].'</b></legend><table>';
$aus['global3'].='<tr><td>'.Help("","").$lang['sqlboxheight'].':&nbsp;</td>';
$aus['global3'].='<td><input type="text" class="text" name="sqlboxsize" value="'.$config['interface_sqlboxsize'].'" size="3" maxlength="3">&nbsp;pixel</td></tr>';
$aus['global3'].='<tr><td>'.Help("","").$lang['sqllimit'].':&nbsp;</td>';
$aus['global3'].='<td><input type="text" class="text" name="sql_limit" value="'.$config['sql_limit'].'" size="3" maxlength="3">&nbsp;</td></tr>';
$aus['global3'].='<tr><td>'.Help("","").$lang['bbparams'].':&nbsp;</td>';
$aus['global3'].='<td>';
$aus['global3'].='<table><tr><td>'.$lang['width'].':</td><td><input type="text" class="text" name="bb_width" value="'.$config['bb_width'].'" size="3" maxlength="3">&nbsp;pixel</td></tr>';
$aus['global3'].='<tr><td>'.$lang['bbtextcolor'].':&nbsp;</td>';
$aus['global3'].='<td><select name="bb_textcolor">
<option value="#000000" style="color :#000000;" '.(($config['bb_textcolor']=="#000000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#000066" style="color :#000066;" '.(($config['bb_textcolor']=="#000066" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#800000" style="color :#800000;" '.(($config['bb_textcolor']=="#800000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#990000" style="color :#990000;" '.(($config['bb_textcolor']=="#990000" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#006600" style="color :#006600;" '.(($config['bb_textcolor']=="#006600" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#996600" style="color :#996600;" '.(($config['bb_textcolor']=="#996600" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
<option value="#999999" style="color :#999999;" '.(($config['bb_textcolor']=="#999999" ? "selected" : "")).'>&nbsp;Textcolor&nbsp;</option>
</select></td></tr></table>';
$aus['global3'].='</td></tr><tr><td>'.Help("","").'SQL-Grid:&nbsp;</td>';
$aus['global3'].='<td><input type="radio" class="radio" name="interface_table_compact" value="0" '.(($config['interface_table_compact']==0) ? 'checked' : '').'>normal&nbsp;&nbsp;&nbsp;';
$aus['global3'].='<input type="radio" class="radio" name="interface_table_compact" value="1" '.(($config['interface_table_compact']==1) ? 'checked' : '').'>compact</td></tr>';

$aus['global3'].='</table></fieldset></div>';

//automatisches L&ouml;schen-->
$aus['global2']='<div id="global2"><fieldset><legend><b>'.$lang['config_autodelete'].'</b></legend><table>';
$aus['global2'].='<tr><td>'.Help($lang['help_ad1'],"conf8").$lang['autodelete'].':&nbsp;</td>';
$aus['global2'].='<td><input type="radio" class="radio" value="1" name="auto_delete" '.(($config['auto_delete']==1)?" checked":"").'>'.$lang['activated'];
$aus['global2'].='<input type="radio" class="radio" value="0" name="auto_delete" '.(($config['auto_delete']==0)?" checked":"").'>'.$lang['not_activated'];
$aus['global2'].='</td></tr><tr><td>'.Help($lang['help_ad2'],"conf9").$lang['age_of_files'].':&nbsp;</td>';
$aus['global2'].='<td><input type="text" class="text" size="3" name="del_files_after_days" value="'.$config['del_files_after_days'].'"></td>';
$aus['global2'].='</tr><tr><td>'.Help($lang['help_ad3'],"conf10").$lang['number_of_files_form'].':&nbsp;</td>';
$aus['global2'].='<td><input type="text" class="text" size="3" name="max_backup_files" value="'.$config['max_backup_files'].'">   ';
$aus['global2'].='<input type="radio" class="radio" value="0" name="max_backup_files_each" '.(($config['max_backup_files_each']==0)?" checked":"").'>'.$lang['max_backup_files_each1'].'   ';
$aus['global2'].='<input type="radio" class="radio" value="1" name="max_backup_files_each" '.(($config['max_backup_files_each']==1)?" checked":"").'>'.$lang['max_backup_files_each2'];
$aus['global2'].='</td></tr></table></fieldset></div>';


//Email-->
$aus['transfer1']='<div id="transfer1"><fieldset><legend><b>'.$lang['config_email'].'</b></legend><table>';
$aus['transfer1'].='<tr><td>'.Help($lang['help_mail1'],"conf5").$lang['send_mail_form'].':&nbsp;</td>';
$aus['transfer1'].='<td><input type="radio" class="radio" value="1" name="send_mail" '.(($config['send_mail']==1)?" checked":"").'>'.$lang['yes'];
$aus['transfer1'].='<input type="radio" class="radio" value="0" name="send_mail" '.(($config['send_mail']==0)?" checked":"").'>'.$lang['no'];
$aus['transfer1'].='</td></tr><tr><td>'.Help($lang['help_mail2'],"conf6").$lang['email_adress'].':&nbsp;</td><td><input type="text" class="text" name="email0" value="'.$config['email_recipient'].'" size="30"></td></tr>';
$aus['transfer1'].='<tr><td>'.Help($lang['help_mail3'],"conf7").$lang['email_subject'].':&nbsp;</td><td><input type="text" class="text" name="email1" value="'.$config['email_sender'].'" size="30"></td></tr>';
$aus['transfer1'].='<tr><td>'.Help($lang['help_mail5'],"").$lang['send_mail_dump'].':&nbsp;</td><td>';
$aus['transfer1'].='<input type="radio" class="radio" value="1" name="send_mail_dump" '.(($config['send_mail_dump']==1)?" checked":"").'>'.$lang['yes'];
$aus['transfer1'].='<input type="radio" class="radio" value="0" name="send_mail_dump"'.(($config['send_mail_dump']==0)?" checked":"").'>'.$lang['no'];
$aus['transfer1'].='</td></tr><tr><td>'.Help($lang['help_mail4'],"").$lang['email_maxsize'].':&nbsp;</td><td>';
$aus['transfer1'].='<input type="text" class="text" name="email_maxsize1" size="3" maxlength="3" value="'.$config['email_maxsize1'].'">&nbsp;&nbsp;';
$aus['transfer1'].='<select name="email_maxsize2"><option value="1" '.(($config['email_maxsize2']==1) ? ' SELECTED' : '').'>Kilobytes</option>';
$aus['transfer1'].='<option value="2" '.(($config['email_maxsize2']==2) ? ' SELECTED' : '').'>Megabytes</option></select></td></tr>';
$aus['transfer1'].='<tr><td>'.Help($lang['help_cronmailprg'],"").$lang['cron_mailprg'].':&nbsp;</td>';
$aus['transfer1'].='<td><table><tr><td><input type="radio" class="radio" name="cron_use_sendmail" value="1" '.(($config['cron_use_sendmail']==1)?" checked":"").'>sendmail</td><td><input type="text" class="text" size="30" name="cron_sendmail" value="'.$config['cron_sendmail'].'"></td></tr>';
$aus['transfer1'].='<tr><td><input type="radio" class="radio" name="cron_use_sendmail" value="0" '.(($config['cron_use_sendmail']==0)?" checked":"").'>SMPT</td><td><input type="text" class="text" size="30" name="cron_smpt" value="'.$config['cron_smtp'].'"></td></tr><tr><td>&nbsp;</td><td>SMTP-Port: <strong>'.$config['cron_smtp_port'].'</strong></td></tr>';
$aus['transfer1'].='</table></td></tr></table></fieldset></div>';

//FTP-->
$aus['transfer2']='<div id="transfer2"><fieldset><legend><b>'.$lang['config_ftp'].'</b></legend><table>';
$aus['transfer2'].='<tr><td>'.Help($lang['help_ftptransfer'],"").$lang['ftp_transfer'].':&nbsp;</td>';
$aus['transfer2'].='<td><input type="radio" class="radio" value="1" name="ftp_transfer" '.((!extension_loaded("ftp")) ? "disabled " : "").(($config['ftp_transfer']==1)?" checked":"").'>'.$lang['activated'];
$aus['transfer2'].=' <input type="radio" class="radio" value="0" name="ftp_transfer" '.(($config['ftp_transfer']==0)?" checked":"").'>'.$lang['not_activated'].'</td></tr>';
$aus['transfer2'].='<tr><td>'.Help($lang['useconnection'].":","").$lang['useconnection'].':&nbsp;</td><td>';
$aus['transfer2'].=' <input type="radio" class="radio" value="0" name="ftp_transferconn" '.(($config['ftp_connectionindex']==0)?" checked":"").'>FTP 1&nbsp;&nbsp;';
$aus['transfer2'].=' <input type="radio" class="radio" value="1" name="ftp_transferconn" '.(($config['ftp_connectionindex']==1)?" checked":"").'>FTP 2&nbsp;&nbsp;';
$aus['transfer2'].=' <input type="radio" class="radio" value="2" name="ftp_transferconn" '.(($config['ftp_connectionindex']==2)?" checked":"").'>FTP 3</td></tr>';

$aus['transfer2'].='<tr><td>'.Help($lang['help_ftptimeout'],"").$lang['ftp_timeout'].':&nbsp;</td>';
$aus['transfer2'].='<td><input type="text" class="text" size="10" name="ftp_timeout" maxlength="3" style="text-align:right;" value="'.$config['ftp_timeout'].'"> sec</td></tr>';

$aus['transfer2'].='<tr><td>'.Help($lang['help_ftp_mode'],"").$lang['ftp_choose_mode'].':&nbsp;</td>';
$aus['transfer2'].='<td><input type="checkbox" class="checkbox" name="ftp_mode" value="1" '.(($config['ftp_mode']==1) ? 'checked' : '').'>';
$aus['transfer2'].=$lang['ftp_passive'].'</td></tr><tr><td colspan="2">';

$aus['transfer2'].='<tr><td>'.Help($lang['help_ftpssl'],"").$lang['ftp_ssl'].':&nbsp;</td>';
$aus['transfer2'].='<td><input type="checkbox" class="checkbox" name="ftp_useSSL" value="1" '.(($config['ftp_useSSL']==1) ? 'checked' : '').' '.((!extension_loaded("openssl")) ? "disabled " : "").'>';
$aus['transfer2'].='<span '.((!extension_loaded("openssl")) ? 'style="color:#999999;"' : '').'>'.$lang['ftp_useSSL'].'</span></td></tr><tr><td colspan="2">';

//1
$aus['transfer2'].='<fieldset><legend><b>FTP-Connection 1</b></legend><table><tr><td><input type="submit" name="testFTP0" value="'.$lang['testconnection'].'" class="Formbutton"><br>'.$checkFTP[0].'</td><td><table>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpserver'],"conf14",12).$lang['ftp_server'].':&nbsp;</td><td><input class="text" type="text" size="30" name="ftp_server0" value="'.$config['ftp_server'][0].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpport'],"conf15",12).$lang['ftp_port'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_port0" value="'.$config['ftp_port'][0].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpuser'],"conf16",12).$lang['ftp_user'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_user0" value="'.$config['ftp_user'][0].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftppass'],"conf17",12).$lang['ftp_pass'].':&nbsp;</td><td class="small"><input class="text" type="password" size="30" name="ftp_pass0" value="'.$config['ftp_pass'][0].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpdir'],"conf18",12).$lang['ftp_dir'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_dir0" value="'.$config['ftp_dir'][0].'"></td></tr>';
$aus['transfer2'].='</table></td></tr></table></fieldset>';
//2
$aus['transfer2'].='<fieldset><legend><b>FTP-Connection 2</b></legend><table><tr><td><input type="submit" name="testFTP1" value="'.$lang['testconnection'].'" class="Formbutton"><br>'.$checkFTP[1].'</td><td><table>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpserver'],"conf14",12).$lang['ftp_server'].':&nbsp;</td><td><input class="text" type="text" size="30" name="ftp_server1" value="'.$config['ftp_server'][1].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpport'],"conf15",12).$lang['ftp_port'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_port1" value="'.$config['ftp_port'][1].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpuser'],"conf16",12).$lang['ftp_user'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_user1" value="'.$config['ftp_user'][1].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftppass'],"conf17",12).$lang['ftp_pass'].':&nbsp;</td><td class="small"><input class="text" type="password" size="30" name="ftp_pass1" value="'.$config['ftp_pass'][1].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpdir'],"conf18",12).$lang['ftp_dir'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_dir1" value="'.$config['ftp_dir'][1].'"></td></tr>';
$aus['transfer2'].='</table></td></tr></table></fieldset>';
//3
$aus['transfer2'].='<fieldset><legend><b>FTP-Connection 3</b></legend><table><tr><td><input type="submit" name="testFTP2" value="'.$lang['testconnection'].'" class="Formbutton"><br>'.$checkFTP[2].'</td><td><table>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpserver'],"conf14",12).$lang['ftp_server'].':&nbsp;</td><td><input class="text" type="text" size="30" name="ftp_server2" value="'.$config['ftp_server'][2].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpport'],"conf15",12).$lang['ftp_port'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_port2" value="'.$config['ftp_port'][2].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpuser'],"conf16",12).$lang['ftp_user'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_user2" value="'.$config['ftp_user'][2].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftppass'],"conf17",12).$lang['ftp_pass'].':&nbsp;</td><td class="small"><input class="text" type="password" size="30" name="ftp_pass2" value="'.$config['ftp_pass'][2].'"></td></tr>';
$aus['transfer2'].='<tr><td class="small">'.Help($lang['help_ftpdir'],"conf18",12).$lang['ftp_dir'].':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_dir2" value="'.$config['ftp_dir'][2].'"></td></tr>';
$aus['transfer2'].='</table></td></tr></table></fieldset></td></tr></table></fieldset></div>';


//Crondump
$aus['cron']='<div id="cron"><fieldset><legend><b>'.$lang['config_cronperl'].'</b></legend><table>';
$aus['cron'].='<tr><td>'.Help($lang['help_cronextender'],"").$lang['cron_extender'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="0" name="cron_extender" '.(($config['cron_extender']==0)?" checked":"").'>.pl';
$aus['cron'].='<input type="radio" class="radio" value="1" name="cron_extender" '.(($config['cron_extender']==1)?" checked":"").'>.cgi';
$aus['cron'].='</td></tr><tr><td>'.Help($lang['help_cronsavepath'],"").$lang['cron_savepath'].':&nbsp;</td>';

$aus['cron'].='<td><table><tr><td>'.$lang['existing'].':</td><td><select name="cron_select_savepath">'.GetPerlConfigs().'</select></td></tr>';
$aus['cron'].='<tr><td>'.$lang['new'].':</td><td><input class="text" type="text" size="18" name="cron_savepath_new" value="">&nbsp;.conf.php</td></tr></table></td>';

$aus['cron'].='</tr><tr><td>'.Help($lang['help_cronexecpath'],"").$lang['cron_execpath'].':&nbsp;</td>';
$aus['cron'].='<td><input type="text" class="text" size="30" name="cron_execution_path" value="'.$config['cron_execution_path'].'"></td>';
$aus['cron'].='</tr><tr><td>'.Help($lang['help_cronprintout'],"").$lang['cron_printout'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_printout" '.(($config['cron_printout']==1)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_printout" '.(($config['cron_printout']==0)?" checked":"").'>'.$lang['no'].'</td></tr>';
$aus['cron'].='<tr><td>'.Help($lang['help_croncompletelog'],"").$lang['cron_completelog'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_completelog" '.(($config['cron_completelog']==1)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_completelog" '.(($config['cron_completelog']==0)?" checked":"").'>'.$lang['no'].'</td></tr>';
$aus['cron'].='<tr><td>'.Help($lang['help_cronsamedb'],"conf13").$lang['cron_samedb'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="0" name="cron_samedb" onclick="document.getElementById(\'cdb\').style.visibility=\'hidden\';" '.(($config['cron_samedb']==0)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="1" name="cron_samedb" onclick="document.getElementById(\'cdb\').style.visibility=\'visible\';" '.(($config['cron_samedb']==1)?" checked":"").'>'.$lang['no'];
$aus['cron'].='</td></tr><tr><td>'.Help($lang['help_crondbindex'],"conf14").$lang['cron_crondbindex'].':&nbsp;</td>';
$aus['cron'].='<td><div id="cdb" style="visibility:'.(($config['cron_samedb']==0)?"hidden;":"visible;").'"><select name="cron_dbindex">';

if (isset($databases['Name'][0]) && $databases['Name'][0]>'')
{
	$datenbanken=count($databases['Name']);
	for($i=0;$i<$datenbanken;$i++)
	{
		$aus['cron'].='<option value="'.$i.'" ';
		if($i==$databases['db_actual_cronindex']) $aus['cron'].='SELECTED';
		$aus['cron'].='>'.$databases['Name'][$i]."</option>\n";
	}
}
else
{
	$databases['db_actual_cronindex']=0;
	$databases['db_actual_cronpraefix']='';
}

$aus['cron'].='<option value="-2" ';
if($databases['db_actual_cronindex']==-2) $aus['cron'].='SELECTED';
$aus['cron'].='>'.$lang['multidumpconf']."</option>\n";
$aus['cron'].='<option value="-3" ';
if($databases['db_actual_cronindex']==-3) $aus['cron'].='SELECTED';
$aus['cron'].='>'.$lang['multidumpall']."</option>\n";

$aus['cron'].='</select>&nbsp;&nbsp;<input type="text" class="text" name="dbcronpraefix" value="'.$databases['db_actual_cronpraefix'].'"></div></td></tr>';
$aus['cron'].='<tr><td>'.Help($lang['help_cronzip'],"").$lang['gzip'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_compression" '.(($config['cron_compression']==1)?" checked":"").'>'.$lang['activated'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_compression" '.(($config['cron_compression']==0)?" checked":"").'>'.$lang['not_activated'];
$aus['cron'].='</td></tr><tr><td>'.Help($lang['help_cronmail'],"").$lang['send_mail_form'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_mail" '.(($config['cron_mail']==1)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_mail" '.(($config['cron_mail']==0)?" checked":"").'>'.$lang['no'];
$aus['cron'].='</td></tr><tr><td>'.Help($lang['help_cronmail_dump'],"").$lang['send_mail_dump'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_mail_dump" '.(($config['cron_mail_dump']==1)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_mail_dump" '.(($config['cron_mail_dump']==0)?" checked":"").'>'.$lang['no'];
$aus['cron'].='</td></tr>';

$aus['cron'].='<tr><td>'.Help($lang['help_cronftp'],"").$lang['cron_ftp'].':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_ftp" '.(($config['cron_ftp']==1)?" checked":"").'>'.$lang['yes'];
$aus['cron'].='<input type="radio" class="radio" value="0" name="cron_ftp" '.(($config['cron_ftp']==0)?" checked":"").'>'.$lang['no'];
$aus['cron'].='</td></tr></table></fieldset></div>';

//Formular-Buttons -->
$aus['formende']='</div></form><br style="clear:both;">';

// AUSGABE
echo $aus['formstart'];
echo $aus['db'];
echo $aus['global1'];
echo $aus['global2'];
echo $aus['global3'];
echo $aus['transfer1'];
echo $aus['transfer2'];
echo $aus['cron'];

echo $aus['formende'];

echo '<script language="JavaScript" type="text/javascript">show_pardivs("'.$sel.'");';
// Wenn irgendetwas beim Wechsel eines Users nicht stimmt oder keine Db gefunden wurde oder eine DB nicht hinzugefügt
// werden konnte --> User mit der Nase drafu stoßen udn Verbindungsdaten einblenden
if ( ($showVP) || (!isset($databases['Name'])) || (isset($databases['name']) && count($databases['Name']==0))
	|| (isset($add_db_message)) ) echo 'SwitchVP();';
echo '</script>';

echo MSDFooter();



?>
