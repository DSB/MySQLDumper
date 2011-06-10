<?php
error_reporting(E_ALL);
function print_save_button()
{
	global $lang;
	$t='<span style="float:right;padding-right:6px;"><input class="Formbutton" type="submit" name="save" value="' . $lang['save'] . '"></span>';
	return $t;
}

// wenn neue Sprache angewählt wurde schon vor dem includen übernehmen
if (isset($_POST['save']) && $_POST['language'] != $_POST['lang_old'])
{
	$config['language']=$_POST['language'];
	$temp_lang=$config['language'];
	include_once ( './inc/header.php' ); // Normal prodecure (resets config[language])
	$config['language']=$temp_lang; // re-set language
	include ( './language/lang_list.php' ); // This re-initializes $lang[] and loads appropiate language files
}
else
	include_once ( './inc/header.php' ); // language not changed, go on as usual

include_once ( './inc/runtime.php' );
include_once ( './inc/functions_sql.php' );
include_once ( './language/' . $config['language'] . '/lang_help.php' );
include_once ( './language/' . $config['language'] . '/lang_config_overview.php' );
include_once ( './language/' . $config['language'] . '/lang_sql.php' );

$msg='';
$sel=( isset($_POST['sel']) ) ? $_POST['sel'] : 'db';
if (isset($_GET['sel'])) $sel=$_GET['sel'];

$old_config_file=$config['config_file'];
if (isset($_GET['config']))
{
	unset($databases);
	$databases=array();
	if (isset($_POST['save'])) unset($_POST['save']);
	if (read_config($_GET['config']))
	{
		$config['config_file']=$_GET['config'];
		$_SESSION['config_file']=$config['config_file'];
		$msg="<strong>" . sprintf($lang['config_loaded'],$config['config_file']) . "</strong>";
		$msg.='<script type="text/javascript" language="javascript">parent.MySQL_Dumper_menu.location.href="menu.php?config=' . $config['config_file'] . '";</script>';
	}
	else
	{
		read_config($old_config_file);
		$msg='<p class="error">' . sprintf($lang['error_loading_configfile'],$config['config_file']) . '</p>';
	}
}

if (isset($_GET['config_delete']))
{
	$del_config=urldecode($_GET['config_delete']);
	if ($del_config == $config['config_file'])
	{
		//aktuell gewaehlte Konfiguration wurde geloescht
		$config['config_file']='mysqldumper';
		$_SESSION['config_file']=$config['config_file'];
		read_config($config['config_file']); // Standard laden
	}
	
	$del=@unlink($config['paths']['config'] . $del_config . '.php');
	if ($del) $del=@unlink($config['paths']['config'] . $del_config . '.conf.php');
	if ($del === false) $msg='<p class="error">' . sprintf($lang['error_deleting_configfile'],$del_config) . '</p>';
	else $msg='<p class="success">' . sprintf($lang['success_deleting_configfile'],$del_config) . '</p>' . '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php?config=' . $config['config_file'] . '";</script>'; //refresh menu-frame
	$sel='configs';
}

include_once ( './inc/define_icons.php' );

$config['files']['parameter']=$config['paths']['config'] . $config['config_file'] . '.php';
$config['theme']=( !isset($config['theme']) ) ? 'msd' : $config['theme'];
$config['cron_smtp_port']=( !isset($config['cron_smtp_port']) ) ? 25 : $config['cron_smtp_port'];

if (!isset($command)) $command=0;

$checkFTP=Array(
				
				"&nbsp;<br><br>&nbsp;<br>&nbsp;", 
				"&nbsp;<br><br>&nbsp;<br>&nbsp;", 
				"&nbsp;<br><br>&nbsp;<br>&nbsp;"
);
$checkFTP[$i]="";
$ftptested=-1;
if (( isset($_POST['testFTP0']) ) || ( isset($_POST['testFTP1']) ) || ( isset($_POST['testFTP2']) ))
{
	$config['ftp_transfer']=array();
	$config['ftp_timeout']=array();
	$config['ftp_mode']=array();
	$config['ftp_useSSL']=array();
	
	for ($i=0; $i < 3; $i++)
	{
		$config['ftp_transfer'][$i]=( isset($_POST['ftp_transfer'][$i]) ) ? $_POST['ftp_transfer'][$i] : 0;
		$config['ftp_timeout'][$i]=( isset($_POST['ftp_timeout'][$i]) ) ? $_POST['ftp_timeout'][$i] : 30;
		$config['ftp_useSSL'][$i]=( isset($_POST['ftp_useSSL'][$i]) ) ? $_POST['ftp_useSSL'][$i] : 0;
		$config['ftp_mode'][$i]=( isset($_POST['ftp_mode'][$i]) ) ? 1 : 0;
		$config['ftp_server'][$i]=( isset($_POST['ftp_server'][$i]) ) ? $_POST['ftp_server'][$i] : '';
		$config['ftp_port'][$i]=( isset($_POST['ftp_port'][$i]) ) ? $_POST['ftp_port'][$i] : 21;
		$config['ftp_user'][$i]=( isset($_POST['ftp_user'][$i]) ) ? $_POST['ftp_user'][$i] : '';
		$config['ftp_pass'][$i]=( isset($_POST['ftp_pass'][$i]) ) ? $_POST['ftp_pass'][$i] : '';
		$config['ftp_dir'][$i]=( isset($_POST['ftp_dir'][$i]) ) ? stripslashes($_POST['ftp_dir'][$i]) : '/';
		if ($config['ftp_dir'][$i] == "" || ( strlen($config['ftp_dir'][$i]) > 1 && substr($config['ftp_dir'][$i],-1) != "/" )) $config['ftp_dir'][$i].="/";
		if (isset($_POST['testFTP' . $i]))
		{
			$checkFTP[$i]='<div class="ssmall">' . $lang['testconnection'] . ' FTP-Connection ' . ( $i + 1 ) . '<br><br>' . TesteFTP($i) . '</div>';
			$ftptested=$i;
		}
	}
}

$showVP=false;
$oldtheme=$config['theme'];
$oldscposition=$config['interface_server_caption_position'];

if ($ftptested > -1)
{
	$ftp_server[$ftptested]=$_POST['ftp_server'][$ftptested];
	$ftp_port[$ftptested]=$_POST['ftp_port'][$ftptested];
	$ftp_user[$ftptested]=$_POST['ftp_user'][$ftptested];
	$ftp_pass[$ftptested]=$_POST['ftp_pass'][$ftptested];
	$ftp_dir_s='ftp_dir[' . $ftptested . ']';
	$f=$_POST['ftp_dir'];
	$ftp_dir[$ftptested]=stripslashes($f[$ftptested]);
	// Eingaben merken
	$config['ftp_transfer'][$ftptested]=( isset($_POST['ftp_transfer'][$ftptested]) ) ? $_POST['ftp_transfer'][$ftptested] : 0;
	$config['ftp_timeout'][$ftptested]=( isset($_POST['ftp_timeout'][$ftptested]) ) ? $_POST['ftp_timeout'][$ftptested] : 30;
	$config['ftp_useSSL'][$ftptested]=( isset($_POST['ftp_useSSL'][$ftptested]) ) ? $_POST['ftp_useSSL'][$ftptested] : 0;
	$config['ftp_mode'][$ftptested]=( isset($_POST['ftp_mode'][$ftptested]) ) ? 1 : 0;
	$config['ftp_server'][$ftptested]=$ftp_server[$ftptested];
	$config['ftp_port'][$ftptested]=$ftp_port[$ftptested];
	$config['ftp_user'][$ftptested]=$ftp_user[$ftptested];
	$config['ftp_pass'][$ftptested]=$ftp_pass[$ftptested];
	$config['ftp_dir'][$ftptested]=$ftp_dir[$ftptested];
	
	if ($ftp_dir[$ftptested] == "" || ( strlen($ftp_dir[$ftptested]) > 1 && substr($ftp_dir[$ftptested],-1) != "/" )) $ftp_dir[$ftptested].="/";
	WriteParams();
}

echo MSDHeader();

if (isset($_POST['load']))
{
	$msg=SetDefault(true);
	$msg=nl2br($msg) . "<br>" . $lang['load_success'] . "<br>";
	echo '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
}

if (isset($_POST['save']))
{
	$save_config=true;
	//Parameter auslesen
	$config['multi_dump']=( isset($_POST['MultiDBDump']) ) ? $_POST['MultiDBDump'] : 0;
	$config['compression']=$_POST['compression'];
	$config['language']=$_POST['language'];
	if (!isset($_POST['server_caption'])) $config['interface_server_caption']=0;
	else $config['interface_server_caption']=$_POST['server_caption'];
	$config['interface_server_caption_position']=isset($_POST['server_caption_position']) ? $_POST['server_caption_position'] : 0;
	$config['interface_sqlboxsize']=$_POST['sqlboxsize'];
	$config['theme']=$_POST['theme'];
	$config['interface_table_compact']=( isset($_POST['interface_table_compact']) ) ? $_POST['interface_table_compact'] : 1;
	
	$config['email_recipient']=$_POST['email0'];
	$config['email_recipient_cc']=$_POST['email_recipient_cc'];
	$config['email_sender']=$_POST['email1'];
	$config['send_mail']=$_POST['send_mail'];
	$config['send_mail_dump']=$_POST['send_mail_dump'];
	
	$config['email_maxsize1']=$_POST['email_maxsize1'];
	if ($config['email_maxsize1'] == "") $config['email_maxsize1']=0;
	$config['email_maxsize2']=$_POST['email_maxsize2'];
	$config['email_maxsize']=$config['email_maxsize1'] * ( ( $config['email_maxsize2'] == 1 ) ? 1024 : 1024 * 1024 );
	
	$config['memory_limit']=$_POST['memory_limit'];
	if ($config['memory_limit'] == "") $config['memory_limit']=0;
	$config['minspeed']=$_POST['minspeed'];
	if ($config['minspeed'] < 50) $config['minspeed']=50;
	$config['maxspeed']=$_POST['maxspeed'];
	if ($config['maxspeed'] < $config['minspeed']) $config['maxspeed']=$config['minspeed'] * 2;
	$config['stop_with_error']=$_POST['stop_with_error'];
	
	$config['multi_part']=$_POST['multi_part'];
	$config['multipartgroesse1']=isset($_POST['multipartgroesse1']) ? floatval(str_replace(',','.',$_POST['multipartgroesse1'])) : 0;
	$config['multipartgroesse2']=isset($_POST['multipartgroesse2']) ? intval($_POST['multipartgroesse2']) : 0;
	if ($config['multipartgroesse1'] < 100 && $config['multipartgroesse2'] == 1) $config['multipartgroesse1']=100;
	if ($config['multipartgroesse1'] < 1 && $config['multipartgroesse2'] == 2) $config['multipartgroesse1']=1;
	
	$oldlogcompression=$config['logcompression'];
	$config['logcompression']=( isset($_POST['logcompression']) && $_POST['logcompression'] == 1 ) ? 1 : 0;
	$config['log_maxsize1']=$_POST['log_maxsize1'];
	if ($config['log_maxsize1'] == "") $config['log_maxsize1']=0;
	$config['log_maxsize2']=$_POST['log_maxsize2'];
	$config['log_maxsize']=$config['log_maxsize1'] * ( ( $config['log_maxsize2'] == 1 ) ? 1024 : 1024 * 1024 );
	
	$config['auto_delete']=$_POST['auto_delete'];
	$config['max_backup_files']=$_POST['max_backup_files'];
	
	$config['empty_db_before_restore']=$_POST['empty_db_before_restore'];
	$config['optimize_tables_beforedump']=$_POST['optimize_tables'];
	$config['cron_dbindex']=$_POST['cron_dbindex'];
	$config['cron_comment']=$_POST['cron_comment'];
	
	$config['cron_extender']=$_POST['cron_extender'];
	// cron_select_savepath/
	if (!isset($_POST['cron_select_savepath'])) $_POST['cron_select_savepath']=$config['config_file'];
	if (isset($_POST['cron_savepath_new']) && !empty($_POST['cron_savepath_new']))
	{
		$tmp_configfilename=utf8_decode(trim($_POST['cron_savepath_new']));
		if (!preg_match("/^[a-z.-_]+$/i",$tmp_configfilename,$matches))
		{
			$save_config=false;
			$msg.='<p class="error">' . sprintf($lang['error_configfile_name'],$_POST['cron_savepath_new']) . '</p>';
		}
		else
		{
			$config['config_file']=$_POST['cron_savepath_new'];
			$config['cron_configurationfile']=$_POST['cron_savepath_new'] . ".conf.php";
		}
	}
	
	$config['cron_execution_path']=$_POST['cron_execution_path'];
	if ($config['cron_execution_path'] == "") $config['cron_execution_path']="msd_cron/";
	if (strlen($config['cron_execution_path']) > 1 && substr($config['cron_execution_path'],-1) != "/") $config['cron_execution_path'].="/";
	
	$config['cron_use_sendmail']=$_POST['cron_use_sendmail'];
	$config['cron_sendmail']=$_POST['cron_sendmail'];
	$config['cron_smtp']=isset($_POST['cron_smtp']) ? $_POST['cron_smtp'] : 'localhost';
	
	$config['cron_printout']=$_POST['cron_printout'];
	$config['cron_completelog']=$_POST['cron_completelog'];
	$config['cron_compression']=$_POST['compression'];
	$config['cron_completelog']=$_POST['cron_completelog'];
	
	$databases['multi']=Array();
	$databases['multi_praefix']=Array();
	$databases['multi_commandbeforedump']=Array();
	$databases['multi_commandafterdump']=Array();
	
	if (isset($databases['Name'][0]) && $databases['Name'][0] > '')
	{
		for ($i=0; $i < count($databases['Name']); $i++)
		{
			$databases['praefix'][$i]=isset($_POST['dbpraefix_' . $i]) ? $_POST['dbpraefix_' . $i] : '';
			$databases['command_before_dump'][$i]=( !isset($_POST['command_before_' . $i]) ) ? "" : $_POST['command_before_' . $i];
			$databases['command_after_dump'][$i]=( !isset($_POST['command_after_' . $i]) ) ? "" : $_POST['command_after_' . $i];
			if (isset($_POST['db_multidump_' . $i]) && $_POST['db_multidump_' . $i] == "db_multidump_$i")
			{
				$databases['multi'][]=$databases['Name'][$i];
				$databases['multi_praefix'][]=$databases['praefix'][$i];
				$databases['multi_commandbeforedump'][]=$databases['command_before_dump'][$i];
				$databases['multi_commandafterdump'][]=$databases['command_after_dump'][$i];
			}
		}
	}
	$databases['multisetting']=( count($databases['multi']) > 0 ) ? implode(";",$databases['multi']) : "";
	$databases['multisetting_praefix']=( count($databases['multi']) > 0 ) ? implode(";",$databases['multi_praefix']) : "";
	$databases['multisetting_commandbeforedump']=( count($databases['multi']) > 0 ) ? implode(";",$databases['multi_commandbeforedump']) : "";
	$databases['multisetting_commandafterdump']=( count($databases['multi']) > 0 ) ? implode(";",$databases['multi_commandafterdump']) : "";
	
	if ($config['cron_dbindex'] == -2)
	{
		$datenbanken=count($databases['Name']);
		$cron_db_array=str_replace(";","|",$databases['multisetting']);
		$cron_dbpraefix_array=str_replace(";","|",$databases['multisetting_praefix']);
		$cron_db_cbd_array=str_replace(";","|",$databases['multisetting_commandbeforedump']);
		$cron_db_cad_array=str_replace(";","|",$databases['multisetting_commandafterdump']);
	
	}
	elseif ($config['cron_dbindex'] == -3)
	{
		$cron_db_array=implode("|",$databases['Name']);
		$cron_dbpraefix_array=implode("|",$databases['praefix']);
		$cron_db_cbd_array=implode("|",$databases['command_before_dump']);
		$cron_db_cad_array=implode("|",$databases['command_after_dump']);
	}
	
	$config['ftp_transfer']=array();
	$config['ftp_timeout']=array();
	$config['ftp_mode']=array();
	$config['ftp_useSSL']=array();
	
	for ($i=0; $i < 3; $i++)
	{
		$checkFTP[$i]="";
		$config['ftp_transfer'][$i]=isset($_POST['ftp_transfer'][$i]) ? $_POST['ftp_transfer'][$i] : $config['ftp_transfer'][$i];
		$config['ftp_timeout'][$i]=isset($_POST['ftp_timeout'][$i]) ? $_POST['ftp_timeout'][$i] : 30;
		$config['ftp_useSSL'][$i]=isset($_POST['ftp_useSSL'][$i]) ? 1 : 0;
		
		$config['ftp_mode'][$i]=isset($_POST['ftp_mode'][$i]) ? 1 : 0;
		$config['ftp_server'][$i]=$_POST['ftp_server'][$i];
		$config['ftp_port'][$i]=$_POST['ftp_port'][$i];
		$config['ftp_user'][$i]=$_POST['ftp_user'][$i];
		$config['ftp_pass'][$i]=$_POST['ftp_pass'][$i];
		$config['ftp_dir'][$i]=stripslashes($_POST['ftp_dir'][$i]);
		if ($config['ftp_port'][$i] == 0) $config['ftp_port'][$i]=21;
		if ($config['ftp_dir'][$i] == "" || ( strlen($config['ftp_dir'][$i]) > 1 && substr($config['ftp_dir'][$i],-1) != "/" )) $config['ftp_dir'][$i].="/";
	}
	
	$config['bb_width']=$_POST['bb_width'];
	$config['bb_textcolor']=$_POST['bb_textcolor'];
	$config['sql_limit']=$_POST['sql_limit'];
	
	if ($config['dbhost'] != $_POST['dbhost'] || $config['dbuser'] != $_POST['dbuser'] || $config['dbpass'] != $_POST['dbpass'] || $config['dbport'] != $_POST['dbport'] || $config['dbsocket'] != $_POST['dbsocket'])
	{
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
		if (MSD_mysql_connect())
		{
			// neue Verbindungsdaten wurden akzeptiert -> manuelle DB-Liste von anderem User löschen
			if (file_exists('./' . $config['files']['dbs_manual'])) @unlink('./' . $config['files']['dbs_manual']);
			SetDefault();
			$msg.='<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
		}
		else
		{
			//alte Werte holen
			$config['dbhost']=$old['dbhost'];
			$config['dbuser']=$old['dbuser'];
			$config['dbpass']=$old['dbpass'];
			$config['dbport']=$old['dbport'];
			$config['dbsocket']=$old['dbsocket'];
			$msg.='<p class="error">' . $lang['wrong_connectionpars'] . '</p>';
		}
	}
	
	// Manuelles hinzufügen einer Datenbank
	if ($_POST['add_db_manual'] > '')
	{
		$to_add=trim($_POST['add_db_manual']);
		$found=false;
		// Prüfen, ob die DB bereits in der Liste vorhanden ist
		if (isset($databases['Name'][0]))
		{
			foreach ($databases['Name'] as $existing_db)
			{
				if ($existing_db == $to_add) $found=true;
			}
		}
		if ($found) $add_db_message=sprintf($lang['db_in_list'],$to_add);
		else
		{
			if (MSD_mysql_connect())
			{
				$res=mysql_selectdb($to_add,$config['dbconnection']);
				if (!$res === false)
				{
					$dbs_manual=array();
					if (file_exists('./' . $config['files']['dbs_manual'])) $dbs_manual=file('./' . $config['files']['dbs_manual']);
					if (!in_array($to_add,$dbs_manual)) $dbs_manual[]=$to_add;
					$file_handle=fopen('./' . $config['files']['dbs_manual'],'a');
					if ($file_handle)
					{
						foreach ($dbs_manual as $f)
						{
							fwrite($file_handle,$f);
						}
						fclose($file_handle);
						@chmod('./' . $config['files']['dbs_manual'],0777);
						//Menü aktualisieren, damit die DB in der Selectliste erscheint
						echo '<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php";</script>';
					}
					else
						$add_db_message=sprintf($lang['db_manual_file_error'],$to_add);
				}
				else
					$add_db_message=sprintf($lang['db_manual_error'],$to_add);
				$showVP=true;
			}
		}
	}
	
	//Nach einer Uebernahme einer neuen Configuration vor dem Schreiben ueberfluessige Indexe entfernen
	$anzahl_datenbanken=sizeof($databases['Name']);
	if (sizeof($databases['praefix']) > $anzahl_datenbanken)
	{
		for ($i=sizeof($databases['praefix']); $i >= $anzahl_datenbanken; $i--)
		{
			unset($databases['praefix'][$i]);
			unset($databases['command_before_dump'][$i]);
			unset($databases['command_after_dump'][$i]);
		}
		if ($databases['db_selected_index'] >= $anzahl_datenbanken) $databases['db_selected_index']=0;
	}
	
	// und wegschreiben
	if ($save_config)
	{
		if (WriteParams(false) == true)
		{
			//neue Sprache? Dann Menue links auch aktualisieren
			if ($_SESSION['config']['language'] != $config['language'] || $_POST['scaption_old'] != $config['interface_server_caption'] || $oldtheme != $config['theme'] || $oldscposition != $config['interface_server_caption_position'])
			{
				$msg.='<script type="text/javascript">parent.MySQL_Dumper_menu.location.href="menu.php?config=' . urlencode($config['config_file']) . '";</script>';
				if (isset($_POST['cron_savepath_new']) && $_POST['cron_savepath_new'] > '') $msg.='<p class="success">' . $lang['success_configfile_created'] . '</p>';
			}
			//Parameter laden
			read_config($config['config_file']);
			if ($config['logcompression'] != $oldlogcompression) SwitchLogfileFormat();
			$msg.='<p class="success">' . sprintf($lang['save_success'],$config['config_file']) . '</p>';
			$msg.='<script type="text/javascript" language="javascript">parent.MySQL_Dumper_menu.location.href="menu.php?config=' . $config['config_file'] . '";</script>';
		}
		else
			$msg.='<p class="error">' . $lang['save_error'] . '</p>';
	}

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
	document.getElementById("configs").style.display = 'none';
	for(i=0;i<8;i++) {
		document.getElementById("command"+i).className  ='ConfigButton';
	}
}
function SwitchVP(objid) {
	if (!document.getElementById(objid)) objid='VP';
	if(document.getElementById(objid).style.display=='none')
		document.getElementById(objid).style.display='block';
	else
		document.getElementById(objid).style.display='none'
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
		case "configs":
			document.getElementById("configs").style.display = 'block';
			document.getElementById("command0").className ='ConfigButtonSelected';
			break;
		case "all":
			document.getElementById("db").style.display = 'block';
			document.getElementById("global1").style.display = 'block';
			document.getElementById("global2").style.display = 'block';
			document.getElementById("global3").style.display = 'block';
			document.getElementById("transfer1").style.display = 'block';
			document.getElementById("transfer2").style.display = 'block';
			document.getElementById("cron").style.display = 'block';
			document.getElementById("configs").style.display = 'block';
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
	document.getElementById("mlimit").value=<?php
	echo round($config['php_ram'] * 1024 * 1024 * 0.9,0);
	?>;
}
</script>
<?php
if (!isset($config['email_maxsize1'])) $config['email_maxsize1']=0;
if (!isset($config['email_maxsize2'])) $config['email_maxsize2']=1;
if (!isset($databases['multisetting'])) $databases['multisetting']="";
$databases['multi']=explode(";",$databases['multisetting']);

//Ausgabe-Teile
$aus['formstart']=headline($lang['config_headline'] . ': ' . $config['config_file']);
$aus['formstart'].='<form name="frm_config" method="POST" action="config_overview.php"><input type="hidden" name="sel" id="sel" value="db">' . $nl;
$aus['formstart'].='<div id="configleft">';
$aus['formstart'].='<input type="Button" id="command1" onclick="show_pardivs(\'db\');" value="' . $lang['dbs'] . '" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command2" onclick="show_pardivs(\'global1\');" value="' . $lang['general'] . '" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command3" onclick="show_pardivs(\'global2\');" value="' . $lang['config_interface'] . '" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command4" onclick="show_pardivs(\'global3\');" value="' . $lang['config_autodelete'] . '" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command5" onclick="show_pardivs(\'transfer1\');" value="Email" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command6" onclick="show_pardivs(\'transfer2\');" value="FTP" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command7" onclick="show_pardivs(\'cron\');" value="Cronscript" class="ConfigButton"><br>' . $nl;
$aus['formstart'].='<input type="Button" id="command0" onclick="show_pardivs(\'configs\');" value="' . $lang['configfiles'] . '" class="ConfigButton"><br>' . $nl;
//$aus['formstart'].='<input type="Button" id="command8" onclick="show_pardivs(\'all\');" value="' . $lang['allpars'] . '" class="ConfigButton"><br>' . $nl;

//$aus['formstart'].='<input class="Formbutton" type="reset" name="reset" value="' . $lang['reset'] . '">';
$aus['formstart'].='<br><input class="Formbutton" type="submit" name="save" value="' . $lang['save'] . '"><br><br>' . $nl;
$aus['formstart'].='<input class="Formbutton" type="Submit" name="load" value="' . $lang['load'] . '" onclick="if (!confirm(\'' . $lang['config_askload'] . '\')) return false;">' . $nl;
//$aus['formstart'].='<input class="Formbutton" type="button" value="' . $lang['install'] . '" onclick="parent.location.href=\'install.php\'">' . $nl;
$aus['formstart'].='</div><div id="configright">' . $msg . $nl;

// Konfigurationsdateien
$aus['conf']='<div id="configs"><fieldset><legend>' . $lang['configfiles'] . '</legend>' . $nl . $nl;

$aus['conf'].='<table><tr class="dbrow">';
$aus['conf'].='<td style="vertical-align:middle">' . $lang['create_configfile'] . ':</td>';
$aus['conf'].='<td style="vertical-align:middle"><input type="text" class="text" style="width:300px;" name="cron_savepath_new" value=""></td>';
$aus['conf'].='<td colspan="2">'.print_save_button().'</td>';
$aus['conf'].='</tr></table>';

$aus['conf'].='<br><table class="bdr"><tr class="thead"><th>#</th><th>' . $lang['configfile'] . ' / ' . $lang['mysql_data'] . '</th>';
$aus['conf'].='<th>' . $lang['configurations'] . '</th><th>' . $lang['action'] . '</th></tr>';

$i=0;
$old_config=$config;
$configs=get_config_filenames();
if (sizeof($configs) > 0)
{
	foreach ($configs as $c)
	{
		$i++;
		unset($databases);
		read_config($c);
		$aus['conf'].='<tr class="';
		if ($old_config['config_file'] == $c) $aus['conf'].='dbrowsel';
		else $aus['conf'].=( $i % 2 ) ? 'dbrow' : 'dbrow1';
		$aus['conf'].='">';
		
		$aus['conf'].='<td><a name="config' . sprintf("%03d",$i) . '" style="text-decoration:none;">' . $i . '.</a></td>';
		
		// Einstellungen
		$aus['conf'].='<td>';
		
		$aus['conf'].='<table>';
		$aus['conf'].='<tr><td>' . $lang['name'] . ':</td><td><strong>' . $c . '</strong></td></tr>'; // filename
		

		$aus['conf'].='<tr><td>' . $lang['db_host'] . ':</td><td><strong>' . $config['dbhost'] . '</strong></td></tr>';
		$aus['conf'].='<tr><td>' . $lang['db_user'] . ':</td><td><strong>' . $config['dbuser'] . '</strong></td></tr>';
		$aus['conf'].='<tr><td>';
		
		$aus['conf'].=$lang['dbs'] . ':</td><td>';
		$aus['conf'].='<a href="#config' . sprintf("%03d",$i) . '" onclick="SwitchVP(\'show_db' . sprintf("%03d",$i) . '\');">';
		$aus['conf'].=$icon['search'] . '<strong>' . sizeof($databases['Name']) . '</strong></a>';
		$aus['conf'].='</td></tr>';
		
		// Datenbankliste anzeigen
		$aus['conf'].='<tr><td colspan="2">';
		$aus['conf'].='<div id="show_db' . sprintf("%03d",$i) . '" style="padding:0;margin:0;display:none;">';
		$a=1;
		$aus['conf'].='<table  class="bdr">';
		if (isset($databases['Name']))
		{
			foreach ($databases['Name'] as $d)
			{
				$aus['conf'].='<tr class="' . ( ( $a % 2 ) ? 'dbrow' : 'dbrow1' ) . '"><td style="text-align:right;">';
				$aus['conf'].=$a . '.&nbsp;</td><td>';
				$aus['conf'].='<a href="sql.php?db=' . urlencode($d) . '">';
				$aus['conf'].=$d . '</a></td></tr>';
				$a++;
			}
		}
		$aus['conf'].='</table></div></td></tr>';
		
		$aus['conf'].='</table></td>';
		
		$aus['conf'].='<td><table>';
		
		// String aus Multidump-DBs aufbauen
		$toolboxstring='';
		$databases['multi']=explode(";",$databases['multisetting']);
		$multi_praefixe=array();
		if (isset($databases['multisetting_praefix'])) $multi_praefixe=explode(";",$databases['multisetting_praefix']);
		if (is_array($databases['multi']))
		{
			for ($x=0; $x < sizeof($databases['multi']); $x++)
			{
				if ($x > 0) $toolboxstring.=', ';
				$toolboxstring.=$databases['multi'][$x];
				if (isset($multi_praefixe[$x]) && $multi_praefixe[$x] > '') $toolboxstring.=' (<i>\'' . $multi_praefixe[$x] . '\'</i>)';
			}
		}
		
		// DB-Liste fuer PHP
		if ($config['multi_dump'] == 1) // Multidump
		{
			$aus['conf'].=table_output($lang['backup_dbs_php'],$toolboxstring);
		}
		else
		{
			// aktuelle DB
			$text=isset($databases['db_actual']) ? $databases['db_actual'] : '';
			if (isset($databases['db_selected_index']) && isset($databases['praefix'][$databases['db_selected_index']]) && $databases['praefix'][$databases['db_selected_index']] > '') $text.=" ('<i>" . $databases['praefix'][$databases['db_selected_index']] . "</i>')";
			$aus['conf'].=table_output($lang['backup_dbs_php'],$text);
		}
		
		// DB-Liste fuer Perl
		// Fallback falls aus alten Konfigurationsdateien der Index noch nicht gesetzt ist -> alle DBs sichern
		if (!isset($config['cron_dbindex'])) $config['cron_dbindex']=-3;
		if ($config['cron_dbindex'] == -2)
		{
			$aus['conf'].=table_output($lang['backup_dbs_perl'],$toolboxstring);
		}
		elseif ($config['cron_dbindex'] == -3)
		{
			$text=$lang['all'];
			$aus['conf'].=table_output($lang['backup_dbs_perl'],$text);
		}
		else
		{
			$text=isset($databases['Name'][$config['cron_dbindex']]) ? $databases['Name'][$config['cron_dbindex']] : '';
			if (isset($databases['praefix'][$config['cron_dbindex']]) && $databases['praefix'][$config['cron_dbindex']] > '') $text.=" ('<i>" . $databases['praefix'][$config['cron_dbindex']] . "</i>')";
			$aus['conf'].=table_output($lang['backup_dbs_perl'],$text);
		}
		
		if ($config['multi_part'] == 1) // Multipart
		{
			$aus['conf'].=table_output($lang['multi_part'],$lang['yes'] . ", " . $lang['filesize'] . " " . byte_output($config['multipart_groesse']));
		}
		
		if ($config['send_mail'] == 1) //Email
		{
			$aus['conf'].=table_output($lang['send_mail_form'],$lang['yes'] . ", " . $lang['email_adress'] . ": " . $config['email_recipient']);
			if ($config['email_recipient_cc'] > '') $aus['conf'].=table_output($lang['email_cc'],$config['email_recipient_cc']);
			$text=$lang['yes'] . ", " . $lang['max_upload_size'] . ": ";
			$bytes=$config['email_maxsize1'] * 1024;
			if ($config['email_maxsize2'] == 2) $bytes=$bytes * 1024;
			$text.=byte_output($bytes);
			if ($config['send_mail_dump'] == 1) $aus['conf'].=table_output($lang['send_mail_dump'],$text);
		
		}
		
		for ($x=0; $x < 3; $x++)
		{
			if (isset($config['ftp_transfer'][$x]) && $config['ftp_transfer'][$x] > 0)
			{
				//$aus['conf'].=table_output($lang['ftp'],sprintf($lang['ftp_send_to'],$config['ftp_server'][$x],$config['ftp_dir'][$x]),1,2);
				$aus['conf'].=table_output($lang['ftp'],sprintf($lang['ftp_send_to'],$config['ftp_server'][$x],$config['ftp_dir'][$x]));
			}
		}
		$aus['conf'].='</table></td><td>';
		$aus['conf'].='<a href="config_overview.php?config=' . urlencode($c) . '">' . $icon['edit'] . '</a>';
		
		if ($c != 'mysqldumper') // && $old_config['config_file']!=$c)
$aus['conf'].='<a href="config_overview.php?config_delete=' . urlencode($c) . '" onclick="if(!confirm(\'' . sprintf($lang['confirm_configfile_delete'],$c) . '\')) return false;">' . $icon['delete'] . '</a>';
		else $aus['conf'].='&nbsp;';
		
		$aus['conf'].='</td></tr>';
	}
}

$configfile=$old_config['config_file'];
$config=$old_config;
unset($databases);
$databases=array();
read_config($configfile);

$aus['conf'].='</table>';
$aus['conf'].='</fieldset></div>' . $nl . $nl;

// Zugangsdaten
$aus['db']='<div id="db"><fieldset><legend>' . $lang['connectionpars'] . '</legend>' . $nl . $nl;
$aus['db'].='<div id="VP" style="display:none;"';
$aus['db'].='><table><tr><td>Host / User / Passwort:</td>';
$aus['db'].='<td><input class="text" type="text" name="dbhost" value="' . $config['dbhost'] . '">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="text" name="dbuser" value="' . $config['dbuser'] . '" size="20">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="password" name="dbpass" value="' . $config['dbpass'] . '" size="20"></td></tr>';
$aus['db'].='<tr><td colspan="2"><strong>' . $lang['extendedpars'] . '</strong></td></tr>';
$aus['db'].='<tr><td>Port / Socket:</td><td><input class="text" type="text" name="dbport" value="' . $config['dbport'] . '">&nbsp;&nbsp;/&nbsp;&nbsp;';
$aus['db'].='<input class="text" type="text" name="dbsocket" value="' . $config['dbsocket'] . '"></td></tr>';

$aus['db'].='<tr><td>' . $lang['add_db_manually'] . ':</td>';
$aus['db'].='<td><input class="text" type="text" name="add_db_manual" value=""></td></tr>';

if (isset($add_db_message))
{
	$aus['db'].='<tr><td colspan="2" class="error">' . $add_db_message;
	$aus['db'].='</td></tr>';
}
$aus['db'].='<tr><td colspan="2">'.print_save_button().'</td></tr>';

$aus['db'].='</table></div><div><a class="small" href="#" onclick="SwitchVP();">' . $lang['fade_in_out'] . '</a></div></fieldset><fieldset><legend>' . $lang['db_backuppars'] . '</legend>';


$aus['db'].='<table>';

//Wenn Datenbanken vorhanden sind
if (isset($databases['Name'][0]) && $databases['Name'][0] > '')
{
	if (!isset($databases['multi']) || ( !is_array($databases['multi']) )) $databases['multi']=array();
	if (count($databases['Name']) == 1)
	{
		$databases['db_actual']=$databases['Name'][0];
		$aus['db'].='<tr><td>' . Help($lang['help_db'],"conf1") . $lang['list_db'] . '</td>';
		$aus['db'].='<td><strong>' . $databases['db_actual'] . '</strong></td></tr>';
		$aus['db'].='<tr><td>' . Help($lang['help_praefix'],"conf2") . $lang['praefix'] . '</td><td><input type="text" class="text" name="dbpraefix_' . $databases['db_selected_index'] . '" size="10" value="' . $databases['praefix'][$databases['db_selected_index']] . '"></td></tr>';
		$aus['db'].='<tr><td>' . Help($lang['help_commands'],"") . 'Command before Dump</td><td>' . ComboCommandDump(0,$databases['db_selected_index']) . '</td></tr>';
		$aus['db'].='<tr><td>' . Help($lang['help_commands'],"") . 'Command after Dump</td><td>' . ComboCommandDump(1,$databases['db_selected_index']) . '</td>';
		$aus['db'].='<td><a href="sql.php?context=1">' . $lang['sql_befehle'] . '</a></td>';
		$aus['db'].='</tr>';
	}
	else
	{
		$aus['db'].='<tr><td>' . Help($lang['help_db'],"conf1") . $lang['list_db'] . '</td><td><input type="checkbox" class="checkbox" name="MultiDBDump" value="1" ' . ( ( $config['multi_dump'] == 1 ) ? "CHECKED" : "" ) . '>&nbsp;' . $lang['activate_multidump'] . '</td>';
		$aus['db'].='<tr><td colspan="2"><table class="bdr">';
		$aus['db'].='<tr class="thead"><th>' . $lang['db'] . '</th><th>Multidump<br><span class="ssmall">(<a href="javascript:SelectMD(true,' . count($databases['Name']) . ')" class="small">' . $lang['all'] . '</a>&nbsp;<a href="javascript:SelectMD(false,' . count($databases['Name']) . ')" class="small">' . $lang['none'] . '</a>)</span></th>';
		$aus['db'].='<th>' . Help($lang['help_praefix'],"conf2") . $lang['praefix'] . '</th><th>' . Help($lang['help_commands'],"",11) . 'Command before Dump</th><th>' . Help($lang['help_commands'],"",11) . 'Command after Dump</th><th>' . $lang['sql_befehle'] . '</th></tr>';
		
		//erst die aktuelle DB
		$aus['db'].='<tr class="dbrowsel"><td><strong>' . $databases['db_actual'] . '</strong></td>';
		$aus['db'].='<td align="center"><input type="checkbox" class="checkbox" name="db_multidump_' . $databases['db_selected_index'] . '" value="db_multidump_' . $databases['db_selected_index'] . '" ' . ( ( in_array($databases['db_actual'],$databases['multi']) ) ? "CHECKED" : "" ) . '></td>';
		$aus['db'].='<td><img src="' . $icon['blank'] . '" width="40" height="1" alt=""><input type="text" class="text" name="dbpraefix_' . $databases['db_selected_index'] . '" size="10" value="' . $databases['praefix'][$databases['db_selected_index']] . '"></td>';
		$aus['db'].='<td>' . ComboCommandDump(0,$databases['db_selected_index']) . '</td><td>' . ComboCommandDump(1,$databases['db_selected_index']) . '</td>';
		$aus['db'].='<td><a href="sql.php?context=1">' . $lang['sql_befehle'] . '</a></td>';
		$aus['db'].='</tr>';
		
		$dbacombo=$dbbcombo="";
		$j=0;
		for ($i=0; $i < count($databases['Name']); $i++)
		{
			if ($i != $databases['db_selected_index'])
			{
				$j++;
				$aus['db'].='<tr class="' . ( ( $i % 2 ) ? 'dbrow' : 'dbrow1' ) . '"><td>' . $databases['Name'][$i] . '</td>';
				$aus['db'].='<td align="center"><input type="checkbox" class="checkbox" name="db_multidump_' . $i . '" value="db_multidump_' . $i . '" ' . ( ( in_array($databases['Name'][$i],$databases['multi']) ) ? "CHECKED" : "" ) . '></td>';
				$aus['db'].='<td><img src="' . $icon['blank'] . '" width="40" height="1" alt=""><input type="text" class="text" name="dbpraefix_' . $i . '" size="10" value="' . $databases['praefix'][$i] . '"></td><td>' . ComboCommandDump(0,$i) . '</td><td>' . ComboCommandDump(1,$i) . '</td>';
				$aus['db'].='<td><a href="sql.php?context=1">' . $lang['sql_befehle'] . '</a></td>';
				$aus['db'].='</tr>';
			}
		}
	}
}
else
	$aus['db'].='<tr><td>' . $lang['no_db_found'] . '</td></tr>';
$aus['db'].='</table></td></tr>';
$aus['db'].='</table></fieldset></div>';

// sonstige Einstellungen
$aus['global1']='<div id="global1"><fieldset><legend>' . $lang['general'] . '</legend><table>';

$aus['global1'].='<tr><td>' . Help("","") . 'Logfiles:&nbsp;</td>';
$aus['global1'].='<td><input type="checkbox" class="checkbox" value="1" name="logcompression" ' . ( ( $config['zlib'] ) ? '' : 'disabled' ) . ( ( $config['logcompression'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['compressed'] . '<br>';
$aus['global1'].='' . $lang['maxsize'] . ':&nbsp;&nbsp;<input type="text" class="text" name="log_maxsize1" size="3" maxlength="3" value="' . $config['log_maxsize1'] . '">&nbsp;&nbsp;';
$aus['global1'].='<select name="log_maxsize2"><option value="1" ' . ( ( $config['log_maxsize2'] == 1 ) ? ' SELECTED' : '' ) . '>Kilobytes</option>';
$aus['global1'].='<option value="2" ' . ( ( $config['log_maxsize2'] == 2 ) ? ' SELECTED' : '' ) . '>Megabytes</option></select></td></tr>';

$aus['global1'].='<tr><td>' . Help($lang['help_memorylimit'],"") . $lang['memory_limit'] . ':&nbsp;&nbsp;</td>';
$aus['global1'].='<td>';
$aus['global1'].='<input type="text" class="text" size="10" id="mlimit" name="memory_limit" maxlength="10" style="text-align:right;font-size:11px;" value="' . $config['memory_limit'] . '"> Bytes&nbsp;&nbsp;&nbsp;<a href="#" onclick="WriteMem();" class="small">' . $lang['autodetect'] . '</a>';
$aus['global1'].='</td></tr>';

$aus['global1'].='<tr><td>' . Help($lang['help_speed'],"") . $lang['speed'] . ':&nbsp;</td>';
$aus['global1'].='<td><input type="text" class="text" size="6" name="minspeed" maxlength="6" style="text-align:right;" value="' . $config['minspeed'] . '">&nbsp;' . $lang['to'] . '&nbsp;<input type="text" class="text" size="6" name="maxspeed" maxlength="9" style="text-align:right;" value="' . $config['maxspeed'] . '"></td></tr>';

$aus['global1'].='</table></fieldset><fieldset><legend>' . $lang['dump'] . '</legend><table>';

$aus['global1'].='<tr><td>' . Help($lang['help_zip'],"conf3") . $lang['gzip'] . ':&nbsp;</td>';
$aus['global1'].='<td><input type="radio" class="radio" value="1" name="compression" ' . ( ( $config['zlib'] ) ? '' : 'disabled' ) . ( ( $config['compression'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['activated'];
$aus['global1'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="compression" ' . ( ( $config['compression'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['not_activated'] . '</td></tr>';
//Multipart-Backup -->
$aus['global1'].='<tr><td>' . Help($lang['help_multipart'],"") . $lang['multi_part'] . ':&nbsp;</td><td>';
$aus['global1'].='<input type="radio" class="radio" value="1" name="multi_part" onclick="obj_enable(\'multipartgroesse1\');obj_enable(\'multipartgroesse2\');" ' . ( ( $config['multi_part'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['global1'].='&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="multi_part" onclick="obj_disable(\'multipartgroesse1\');obj_disable(\'multipartgroesse2\');" ' . ( ( $config['multi_part'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'];
$aus['global1'].='</td></tr><tr><td>' . Help($lang['help_multipartgroesse'],"") . $lang['multi_part_groesse'] . ':&nbsp;</td>';
$aus['global1'].='<td>&nbsp;';

$aus['global1'].='<input type="text" class="text" id="multipartgroesse1" name="multipartgroesse1" size="3" maxlength="8" value="' . $config['multipartgroesse1'] . '"';
if ($config['multi_part'] == 0) $aus['global1'].=' disabled';

$aus['global1'].='>&nbsp;&nbsp;';
$aus['global1'].='<select id="multipartgroesse2" name="multipartgroesse2"';
if ($config['multi_part'] == 0) $aus['global1'].=' disabled';
$aus['global1'].='><option value="1" ' . ( ( $config['multipartgroesse2'] == 1 ) ? 'SELECTED' : '' ) . '>Kilobytes</option><option value="2" ' . ( ( $config['multipartgroesse2'] == 2 ) ? 'SELECTED' : '' ) . '>Megabytes</option></select></td></tr>';

$aus['global1'].='<tr><td>' . Help($lang['help_optimize'],"") . $lang['optimize'] . '</td>';
$aus['global1'].='<td><input type="radio" class="radio" value="1" name="optimize_tables" ' . ( ( $config['optimize_tables_beforedump'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['activated'];
$aus['global1'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="optimize_tables" ' . ( ( $config['optimize_tables_beforedump'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['not_activated'] . '</td></tr>';

$aus['global1'].='</table></fieldset><fieldset><legend>' . $lang['restore'] . '</legend><table>';
$aus['global1'].='<tr><td>' . Help($lang['help_empty_db_before_restore'],"conf4") . $lang['empty_db_before_restore'] . ':&nbsp;</td><td>';
$aus['global1'].='<input type="radio" class="radio" value="1" name="empty_db_before_restore" ' . ( ( $config['empty_db_before_restore'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['global1'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="empty_db_before_restore" ' . ( ( $config['empty_db_before_restore'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'];
$aus['global1'].='</td></tr>';

$aus['global1'].='<tr><td>' . Help("","") . $lang['errorhandling_restore'] . '</td><td>';
$aus['global1'].='<input type="radio" class="radio" name="stop_with_error" value="0" ' . ( ( $config['stop_with_error'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['ehrestore_continue'] . '<br>';
$aus['global1'].='<input type="radio" class="radio" name="stop_with_error" value="1" ' . ( ( $config['stop_with_error'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['ehrestore_stop'];
$aus['global1'].='</td></tr></table></fieldset>';
$aus['global1'].=print_save_button();
$aus['global1'].='</div>';

//Interface -->
$aus['global3']='<div id="global3"><fieldset><legend>' . $lang['config_interface'] . '</legend><table>';
$aus['global3'].='<tr><td>' . Help($lang['help_lang'],"conf11") . $lang['language'] . ':&nbsp;</td>';
$aus['global3'].='<td><select name="language">' . GetLanguageCombo("op");
$aus['global3'].='</select>&nbsp;&nbsp;<a href="' . $languagepacks_ref . '" target="_blank">' . $lang['download_languages'] . '</a><input type="hidden" name="lang_old" value="' . $config['language'] . '"><input type="hidden" name="scaption_old" value="' . $config['interface_server_caption'] . '"></td></tr>';

$aus['global3'].='<tr><td>' . Help($lang['help_servercaption'],"") . $lang['servercaption'] . ':</td>';
$aus['global3'].='<td><input type="checkbox" class="checkbox" value="1" name="server_caption" ' . ( ( $config['interface_server_caption'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['activated'] . '&nbsp;&nbsp;&nbsp;';
$aus['global3'].='<input type="radio" class="radio" name="server_caption_position" value="1" ' . ( ( $config['interface_server_caption_position'] == 1 ) ? "checked" : "" ) . '>&nbsp;' . $lang['in_mainframe'] . '&nbsp;&nbsp;<input type="radio" class="radio" name="server_caption_position" value="0" ' . ( ( $config['interface_server_caption_position'] == 0 ) ? "checked" : "" ) . '>&nbsp;' . $lang['in_leftframe'] . '';
$aus['global3'].='</td></tr>';
$aus['global3'].='<tr><td>' . Help("","") . 'Theme</td><td><select name="theme">' . GetThemes() . '</select>&nbsp;&nbsp;<a href="' . $stylepacks_ref . '" target="_blank">' . $lang['download_styles'] . '</a></td></tr>';

$aus['global3'].='</table></fieldset><fieldset><legend>' . $lang['sql_browser'] . '</legend><table>';
$aus['global3'].='<tr><td>' . Help("","") . $lang['sqlboxheight'] . ':&nbsp;</td>';
$aus['global3'].='<td><input type="text" class="text" name="sqlboxsize" value="' . $config['interface_sqlboxsize'] . '" size="3" maxlength="3">&nbsp;Pixel</td></tr>';
$aus['global3'].='<tr><td>' . Help("","") . $lang['sqllimit'] . ':&nbsp;</td>';
$aus['global3'].='<td><input type="text" class="text" name="sql_limit" value="' . $config['sql_limit'] . '" size="3" maxlength="6">&nbsp;</td></tr>';
$aus['global3'].='<tr><td>' . Help("","") . $lang['bbparams'] . ':&nbsp;</td>';
$aus['global3'].='<td>';
$aus['global3'].='<table><tr><td>' . $lang['width'] . ':</td><td><input type="text" class="text" name="bb_width" value="' . $config['bb_width'] . '" size="3" maxlength="3">&nbsp;pixel</td></tr>';
$aus['global3'].='<tr><td>' . $lang['bbtextcolor'] . ':&nbsp;</td>';
$aus['global3'].='<td><select name="bb_textcolor">
<option value="#000000" style="color :#000000;" ' . ( ( $config['bb_textcolor'] == "#000000" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#000066" style="color :#000066;" ' . ( ( $config['bb_textcolor'] == "#000066" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#800000" style="color :#800000;" ' . ( ( $config['bb_textcolor'] == "#800000" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#990000" style="color :#990000;" ' . ( ( $config['bb_textcolor'] == "#990000" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#006600" style="color :#006600;" ' . ( ( $config['bb_textcolor'] == "#006600" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#996600" style="color :#996600;" ' . ( ( $config['bb_textcolor'] == "#996600" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
<option value="#999999" style="color :#999999;" ' . ( ( $config['bb_textcolor'] == "#999999" ? "selected" : "" ) ) . '>&nbsp;Textcolor&nbsp;</option>
</select></td></tr></table>';
$aus['global3'].='</td></tr><tr><td>' . Help("","") . 'SQL-Grid:&nbsp;</td>';
$aus['global3'].='<td><input type="radio" class="radio" name="interface_table_compact" value="0" ' . ( ( $config['interface_table_compact'] == 0 ) ? 'checked' : '' ) . '>&nbsp;normal&nbsp;&nbsp;&nbsp;';
$aus['global3'].='<input type="radio" class="radio" name="interface_table_compact" value="1" ' . ( ( $config['interface_table_compact'] == 1 ) ? 'checked' : '' ) . '>&nbsp;compact</td></tr>';

$aus['global3'].='</table></fieldset>'.print_save_button().'</div>';

//automatisches L&ouml;schen-->
$aus['global2']='<div id="global2"><fieldset><legend>' . $lang['config_autodelete'] . '</legend><table>';
$aus['global2'].='<tr><td>' . Help($lang['help_ad1'],"conf8") . $lang['autodelete'] . ':&nbsp;</td>';
$aus['global2'].='<td><input type="radio" class="radio" value="1" name="auto_delete" ' . ( ( $config['auto_delete'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['activated'];
$aus['global2'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="auto_delete" ' . ( ( $config['auto_delete'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['not_activated'];
$aus['global2'].='</td>';
$aus['global2'].='</tr><tr><td>' . Help($lang['help_ad3'],"conf10") . $lang['number_of_files_form'] . ':&nbsp;</td>';
$aus['global2'].='<td><input type="text" class="text" size="3" name="max_backup_files" value="' . $config['max_backup_files'] . '">   ';
$aus['global2'].='</td></tr></table></fieldset>'.print_save_button().'</div>';

//Email-->
if (!isset($config['email_recipient_cc'])) $config['email_recipient_cc']=''; // backwards compatibility if field is undefined
$aus['transfer1']='<div id="transfer1"><fieldset><legend>' . $lang['config_email'] . '</legend><table>';
$aus['transfer1'].='<tr><td>' . $lang['send_mail_form'] . ':&nbsp;</td>';
$aus['transfer1'].='<td><input type="radio" class="radio" value="1" name="send_mail" ' . ( ( $config['send_mail'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['transfer1'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="send_mail" ' . ( ( $config['send_mail'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'];
$aus['transfer1'].='</td></tr><tr><td>' . $lang['email_adress'] . ':&nbsp;</td><td><input type="text" class="text" name="email0" value="' . $config['email_recipient'] . '" size="30"></td></tr>';
$aus['transfer1'].='<tr><td>' . $lang['email_cc'] . ':&nbsp;</td><td><input type="text" class="text" name="email_recipient_cc" value="' . $config['email_recipient_cc'] . '" size="60" maxlength="255"></td></tr>';

$aus['transfer1'].='<tr><td>' . $lang['email_subject'] . ':&nbsp;</td><td><input type="text" class="text" name="email1" value="' . $config['email_sender'] . '" size="30"></td></tr>';
$aus['transfer1'].='<tr><td>' . $lang['send_mail_dump'] . ':&nbsp;</td><td>';
$aus['transfer1'].='<input type="radio" class="radio" value="1" name="send_mail_dump" ' . ( ( $config['send_mail_dump'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['transfer1'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="send_mail_dump"' . ( ( $config['send_mail_dump'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'];
$aus['transfer1'].='</td></tr><tr><td>' . $lang['email_maxsize'] . ':&nbsp;</td><td>';
$aus['transfer1'].='<input type="text" class="text" name="email_maxsize1" size="3" maxlength="3" value="' . $config['email_maxsize1'] . '">&nbsp;&nbsp;';
$aus['transfer1'].='<select name="email_maxsize2"><option value="1" ' . ( ( $config['email_maxsize2'] == 1 ) ? ' SELECTED' : '' ) . '>Kilobytes</option>';
$aus['transfer1'].='<option value="2" ' . ( ( $config['email_maxsize2'] == 2 ) ? ' SELECTED' : '' ) . '>Megabytes</option></select></td></tr>';
$aus['transfer1'].='<tr><td>' . $lang['cron_mailprg'] . ':&nbsp;</td>';
$aus['transfer1'].='<td><table><tr><td><input type="radio" class="radio" name="cron_use_sendmail" value="1" ' . ( ( $config['cron_use_sendmail'] == 1 ) ? " checked" : "" ) . '>&nbsp;sendmail</td><td><input type="text" class="text" size="30" name="cron_sendmail" value="' . $config['cron_sendmail'] . '"></td></tr>';
$aus['transfer1'].='<tr><td><input type="radio" class="radio" name="cron_use_sendmail" value="0" ' . ( ( $config['cron_use_sendmail'] == 0 ) ? " checked" : "" ) . '>&nbsp;SMTP</td><td><input type="text" class="text" size="30" name="cron_smtp" value="' . $config['cron_smtp'] . '"></td></tr><tr><td>&nbsp;</td><td>SMTP-Port: <strong>' . $config['cron_smtp_port'] . '</strong></td></tr>';
$aus['transfer1'].='</table></td></tr></table></fieldset>'.print_save_button().'</div>';

//FTP-->
$aus['transfer2']='<div id="transfer2"><fieldset><legend>' . $lang['config_ftp'] . '</legend>';
for ($i=0; $i < 3; $i++)
{
	$aus['transfer2'].='<fieldset><legend>FTP-Connection ' . ( $i + 1 ) . '</legend><table>';
	
	$aus['transfer2'].='<tr><td>' . Help($lang['help_ftptransfer'],"") . $lang['ftp_transfer'] . ':&nbsp;</td>';
	$aus['transfer2'].='<td><input type="radio" class="radio" value="1" name="ftp_transfer[' . $i . ']" ' . ( ( !extension_loaded("ftp") ) ? "disabled " : "" ) . ( ( $config['ftp_transfer'][$i] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['activated'];
	$aus['transfer2'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="ftp_transfer[' . $i . ']" ' . ( ( $config['ftp_transfer'][$i] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['not_activated'] . '</td></tr>';
	
	$aus['transfer2'].='<tr><td>' . Help($lang['help_ftptimeout'],"") . $lang['ftp_timeout'] . ':&nbsp;</td>';
	$aus['transfer2'].='<td><input type="text" class="text" size="10" name="ftp_timeout[' . $i . ']" maxlength="3" style="text-align:right;" value="' . $config['ftp_timeout'][$i] . '">&nbsp;sec</td></tr>';
	
	$aus['transfer2'].='<tr><td>' . Help($lang['help_ftp_mode'],"") . $lang['ftp_choose_mode'] . ':&nbsp;</td>';
	$aus['transfer2'].='<td><input type="checkbox" class="checkbox" name="ftp_mode[' . $i . ']" value="1" ' . ( ( $config['ftp_mode'][$i] == 1 ) ? 'checked' : '' ) . '>&nbsp;';
	$aus['transfer2'].=$lang['ftp_passive'] . '</td></tr><tr><td colspan="2">';
	
	$aus['transfer2'].='<tr><td>' . Help($lang['help_ftpssl'],"") . $lang['ftp_ssl'] . ':&nbsp;</td>';
	$aus['transfer2'].='<td><input type="checkbox" class="checkbox" name="ftp_useSSL[' . $i . ']" value="1" ' . ( ( $config['ftp_useSSL'][$i] == 1 ) ? 'checked' : '' ) . ' ' . ( ( !extension_loaded("openssl") ) ? "disabled " : "" ) . '>';
	$aus['transfer2'].='&nbsp;<span ' . ( ( !extension_loaded("openssl") ) ? 'style="color:#999999;"' : '' ) . '>' . $lang['ftp_useSSL'] . '</span></td></tr><tr><td colspan="2">';
	
	$aus['transfer2'].='<tr><td><input type="submit" name="testFTP' . $i . '" value="' . $lang['testconnection'] . '" class="Formbutton"><br>' . $checkFTP[$i] . '</td><td><table>';
	$aus['transfer2'].='<tr><td class="small">' . Help($lang['help_ftpserver'],"conf14",12) . $lang['ftp_server'] . ':&nbsp;</td><td><input class="text" type="text" size="30" name="ftp_server[' . $i . ']" value="' . $config['ftp_server'][$i] . '"></td></tr>';
	$aus['transfer2'].='<tr><td class="small">' . Help($lang['help_ftpport'],"conf15",12) . $lang['ftp_port'] . ':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_port[' . $i . ']" value="' . $config['ftp_port'][$i] . '"></td></tr>';
	$aus['transfer2'].='<tr><td class="small">' . Help($lang['help_ftpuser'],"conf16",12) . $lang['ftp_user'] . ':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_user[' . $i . ']" value="' . $config['ftp_user'][$i] . '"></td></tr>';
	$aus['transfer2'].='<tr><td class="small">' . Help($lang['help_ftppass'],"conf17",12) . $lang['ftp_pass'] . ':&nbsp;</td><td class="small"><input class="text" type="password" size="30" name="ftp_pass[' . $i . ']" value="' . $config['ftp_pass'][$i] . '"></td></tr>';
	$aus['transfer2'].='<tr><td class="small">' . Help($lang['help_ftpdir'],"conf18",12) . $lang['ftp_dir'] . ':&nbsp;</td><td class="small"><input class="text" type="text" size="30" name="ftp_dir[' . $i . ']" value="' . $config['ftp_dir'][$i] . '"></td></tr>';
	$aus['transfer2'].='</table></td></tr></table>'.print_save_button().'</fieldset>';
}
$aus['transfer2'].='</fieldset></div>';

//Crondump
$aus['cron']='<div id="cron"><fieldset><legend>' . $lang['config_cronperl'] . '</legend><table>';
$aus['cron'].='<tr><td>' . Help($lang['help_cronextender'],"") . $lang['cron_extender'] . ':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="0" name="cron_extender" ' . ( ( $config['cron_extender'] == 0 ) ? " checked" : "" ) . '>&nbsp;.pl';
$aus['cron'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="1" name="cron_extender" ' . ( ( $config['cron_extender'] == 1 ) ? " checked" : "" ) . '>&nbsp;.cgi';
$aus['cron'].='</tr><tr><td>' . Help($lang['help_cronexecpath'],"") . $lang['cron_execpath'] . ':&nbsp;</td>';
$aus['cron'].='<td><input type="text" class="text" size="30" name="cron_execution_path" value="' . $config['cron_execution_path'] . '"></td>';
$aus['cron'].='</tr><tr><td>' . Help($lang['help_cronprintout'],"") . $lang['cron_printout'] . ':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_printout" ' . ( ( $config['cron_printout'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['cron'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="cron_printout" ' . ( ( $config['cron_printout'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'] . '</td></tr>';
$aus['cron'].='<tr><td>' . Help($lang['help_croncompletelog'],"") . $lang['cron_completelog'] . ':&nbsp;</td>';
$aus['cron'].='<td><input type="radio" class="radio" value="1" name="cron_completelog" ' . ( ( $config['cron_completelog'] == 1 ) ? " checked" : "" ) . '>&nbsp;' . $lang['yes'];
$aus['cron'].='&nbsp;&nbsp;&nbsp;<input type="radio" class="radio" value="0" name="cron_completelog" ' . ( ( $config['cron_completelog'] == 0 ) ? " checked" : "" ) . '>&nbsp;' . $lang['no'] . '</td></tr>';

$aus['cron'].='<tr><td>' . Help($lang['help_crondbindex'],"conf14") . $lang['cron_crondbindex'] . ':&nbsp;</td>';
$aus['cron'].='<td><select name="cron_dbindex" id="cron_dbindex">';
$aus['cron'].='<option value="-3" ';
if ($config['cron_dbindex'] == -3) $aus['cron'].='SELECTED';
$aus['cron'].='>' . $lang['multidumpall'] . "</option>\n";
$aus['cron'].='<option value="-2" ';
if ($config['cron_dbindex'] == -2) $aus['cron'].='SELECTED';
$aus['cron'].='>' . $lang['multidumpconf'] . "</option>\n";

if (isset($databases['Name'][0]) && $databases['Name'][0] > '')
{
	$datenbanken=count($databases['Name']);
	for ($i=0; $i < $datenbanken; $i++)
	{
		$aus['cron'].='<option value="' . $i . '" ';
		if ($i == $config['cron_dbindex']) $aus['cron'].='SELECTED';
		$aus['cron'].='>' . $databases['Name'][$i] . "</option>\n";
	}
}
else
{
	$config['cron_dbindex']=0;
}

$aus['cron'].='</select>' . "\n";
$aus['cron'].='</td></tr>';

// comment
$aus['cron'].='<tr><td>' . $lang['cron_comment'] . ':&nbsp;</td>';
$aus['cron'].='<td><input type="text" class="text" name="cron_comment" size="30" maxlength="100" value="' . htmlspecialchars($config['cron_comment']) . '"></td></tr>';
$aus['cron'].='</table></fieldset>'.print_save_button().'</div>';

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
echo $aus['conf'];

echo $aus['formende'];

echo '<script language="JavaScript" type="text/javascript">show_pardivs("' . $sel . '");';
// Wenn irgendetwas beim Wechsel eines Users nicht stimmt oder keine Db gefunden wurde oder eine DB nicht hinzugefügt
// werden konnte --> User mit der Nase drauf stossen und Verbindungsdaten einblenden
if (( $showVP ) || ( !isset($databases['Name']) ) || ( isset($databases['name']) && count($databases['Name'] == 0) ) || ( isset($add_db_message) )) echo 'SwitchVP();';
echo '</script>';
echo MSDFooter();
$_SESSION['config']=$config;
?>