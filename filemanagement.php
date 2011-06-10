<?php
include ( './inc/header.php' );
include_once ( './language/' . $config['language'] . '/lang.php' );
include_once ( './language/' . $config['language'] . '/lang_filemanagement.php' );
include_once ( './language/' . $config['language'] . '/lang_config_overview.php' );
include_once ( './language/' . $config['language'] . '/lang_main.php' );
include_once ( './inc/functions_files.php' );
include_once ( './inc/functions_sql.php' );

get_sql_encodings();
echo MSDHeader();
$msg='';
$dump=array();
$dirs=Array(
			
			"", 
			"./", 
			"./inc/", 
			"./msd_cron/", 
			"./language/", 
			"./work/config/"
);
if ($config['auto_delete'] == 1) $msg=AutoDelete();

//0=Datenbank  1=Struktur
$action=( isset($_GET['action']) ) ? $_GET['action'] : "files";
$kind=( isset($_GET['kind']) ) ? $_GET['kind'] : 0;
$expand=( isset($_GET['expand']) ) ? $_GET['expand'] : -1;
$selectfile=( isset($_POST['selectfile']) ) ? $_POST['selectfile'] : "";
$destfile=( isset($_POST['destfile']) ) ? $_POST['destfile'] : "";
$compressed=( isset($_POST['compressed']) ) ? $_POST['compressed'] : "";
$dk=( isset($_POST['dumpKommentar']) ) ? ( ( get_magic_quotes_gpc() ) ? stripslashes($_POST['dumpKommentar']) : $_POST['dumpKommentar'] ) : "";
$dk=str_replace(':','|',$dk); // remove : because of statusline
$dump['sel_dump_encoding']=( isset($_POST['sel_dump_encoding']) ) ? $_POST['sel_dump_encoding'] : get_index($config['mysql_possible_character_sets'],$config['mysql_standard_character_set']);
$dump['dump_encoding']=isset($config['mysql_possible_character_sets'][$dump['sel_dump_encoding']]) ? $config['mysql_possible_character_sets'][$dump['sel_dump_encoding']] : 0;

$toolboxstring="";

$fpath=$config['paths']['backup'];
$dbactiv=( isset($_GET['dbactiv']) ) ? $_GET['dbactiv'] : $databases['db_actual'];

$databases['multi']=Array();
if ($databases['multisetting'] == "")
{
	$databases['multi'][0]=$databases['db_actual'];
}
else
{
	$databases['multi']=explode(";",$databases['multisetting']);
	$multi_praefixe=array();
	$multi_praefixe=explode(";",$databases['multisetting_praefix']);
	$toolboxstring='<br>';
	if (is_array($databases['multi']))
	{
		for ($i=0; $i < sizeof($databases['multi']); $i++)
		{
			if ($i > 0) $toolboxstring.=', ';
			$toolboxstring.=$databases['multi'][$i];
			if ($multi_praefixe[$i] > '') $toolboxstring.=' (<i>\'' . $multi_praefixe[$i] . '\'</i>)';
		}
	}
}

//--------------------------------------------------------
//*** Abfrage ob Dump nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST['dump_tbl']))
{
	$check_dirs=TestWorkDir();
	if (!$check_dirs === true) die($check_dirs);
	$databases['db_actual_tableselected']=substr($_POST['tbl_array'],0,strlen($_POST['tbl_array']) - 1);
	WriteParams();
	$dump['fileoperations']=0;
	echo '<script language="JavaScript" type="text/javascript">parent.MySQL_Dumper_content.location.href="dump.php?comment=' . urlencode($dk) . '&sel_dump_encoding=' . $dump['sel_dump_encoding'] . '&config=' . urlencode($config['config_file']) . '";</script></body></html>';
	exit();
}

//--------------------------------------------------------
//*** Abfrage ob Dump ***
//--------------------------------------------------------
if (isset($_POST['dump']))
{
	if (isset($_POST['tblfrage']) && $_POST['tblfrage'] == 1)
	{
		//Tabellenabfrage
		$tblfrage_refer="dump";
		include ( "inc/tabellenabfrage.php" );
		exit();
	}
	else
	{
		@$check_dir=TestWorkDir();
		if (!$check_dir === true) die($check_dir);
		$databases['db_actual_tableselected']="";
		WriteParams();
		
		$dump['fileoperations']=0;
		echo '<script language="JavaScript" type="text/javascript">parent.MySQL_Dumper_content.location.href="dump.php?comment=' . urlencode($dk) . '&sel_dump_encoding=' . $dump['sel_dump_encoding'] . '&config=' . urlencode($config['config_file']) . '";</script></body></html>';
		exit();
	}
}

//--------------------------------------------------------
//*** Abfrage ob Restore nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST['restore_tbl']))
{
	$databases['db_actual_tableselected']=substr($_POST['tbl_array'],0,strlen($_POST['tbl_array']) - 1);
	WriteParams();
	echo '<script language="JavaScript" type="text/javascript">parent.MySQL_Dumper_content.location.href="restore.php?filename=' . urlencode($_POST['filename']) . '";</script></body></html>';
	
	exit();
}
//--------------------------------------------------------
//*** Abfrage ob Restore ***
//--------------------------------------------------------
if (isset($_POST['restore']))
{
	if (isset($_POST['file']))
	{
		if (isset($_POST['tblfrage']) && $_POST['tblfrage'] == 1)
		{
			//Tabellenabfrage
			$tblfrage_refer="restore";
			$filename=urldecode($_POST['file'][0]);
			include ( "inc/tabellenabfrage.php" );
			exit();
		}
		else
		{
			$file=$_POST['file'][0];
			$statusline=read_statusline_from_file($file);
			if (isset($_POST['sel_dump_encoding_restore']))
			{
				$encodingstring=$config['mysql_possible_character_sets'][$_POST['sel_dump_encoding_restore']];
				$encoding=explode(' ',$encodingstring);
				$dump_encoding=$encoding[0];
			}
			else
			{
				if (!isset($statusline['charset']) || trim($statusline['charset']) == '?')
				{
					echo headline($lang['fm_restore'] . ': ' . $file);
					
					// if we can't detect encoding ask user
					echo '<br>' . $lang['choose_charset'] . '<br><br>';
					echo '<form action="filemanagement.php?action=restore&amp;kind=0" method="POST">';
					echo '<table><tr><td>' . $lang['fm_choose_encoding'] . ':</td><td>';
					echo '<select name="sel_dump_encoding_restore">';
					echo make_options($config['mysql_possible_character_sets'],$dump['sel_dump_encoding']);
					echo '</select></td></tr><tr><td>';
					echo $lang['mysql_connection_encoding'] . ':</td><td><strong>' . $config['mysql_standard_character_set'] . '</strong></td></tr>';
					
					echo '<tr><td colspan="2"><br><input type="submit" name="restore" class="Formbutton" value="' . $lang['fm_restore'] . '">';
					echo '<input type="hidden" name="file[0]" value="' . $file . '">';
					echo '</td></tr></table></form></body></html>';
					exit();
				}
				else
					$dump_encoding=$statusline['charset'];
			}
			
			$databases['db_actual_tableselected']="";
			WriteParams();
			echo '<script language="JavaScript" type="text/javascript">parent.MySQL_Dumper_content.location.href="restore.php?filename=' . $file . '&dump_encoding=' . $dump_encoding . '&kind=' . $kind . '";</script></body></html>';
			exit();
		}
	}
	else
		$msg.='<p class="error">' . $lang['fm_nofile'] . '</p>';
}

//--------------------------------------------------------
//*** Abfrage ob Delete ***
//--------------------------------------------------------
$del=array();
if (isset($_POST['delete']))
{
	if (isset($_POST['file']))
	{
		$file=$_POST['file'];
		if ($_POST['multi'] == 1)
		{
			$delfiles=Array();
			for ($i=0; $i < count($_POST['file']); $i++)
			{
				if ($_POST['multipart'][$i] == 0)
				{
					$delfiles[]=$_POST['file'][$i];
				}
				else
				{
					$delfiles[]=substr($_POST['file'][$i],0,strpos($_POST['file'][$i],"_part_")) . "*.*";
				}
			}
			for ($i=0; $i < count($delfiles); $i++)
			{
				$del=array_merge($del,DeleteFilesM($fpath,$delfiles[$i]));
			}
		}
		else
		{
			
			if ($_POST['multipart'][0] == 0)
			{
				$delfiles[]=$_POST['file'][0];
			}
			else
			{
				$delfiles[]=substr($_POST['file'][0],0,strpos($_POST['file'][0],"_part_")) . "*.*";
			}
			
			$del=array_merge($del,DeleteFilesM($fpath,$delfiles[0]));
		}
	}
	else
		$msg.='<p class="error">' . $lang['fm_nofile'] . '</p>';
}
if (isset($_POST['deleteauto'])) $msg.='<p class="small">' . AutoDelete() . '</p>';

if (isset($_POST['deleteall']) || isset($_POST['deleteallfilter']))
{
	if (isset($_POST['deleteall']))
	{
		$del=DeleteFilesM($fpath,"*.sql");
		$del=array_merge($del,DeleteFilesM($fpath,"*.gz"));
	}
	else
		$del=DeleteFilesM($fpath,$databases['db_actual'] . "*");
}

// print file-delete-messages
if (is_array($del))
{
	foreach ($del as $filename=>$success)
	{
		if ($success)
		{
			$msg.='<span class="small">';
			$msg.=$lang['fm_delete1'] . ' \'' . $filename . '\' ' . $lang['fm_delete2'];
			WriteLog("deleted '$filename'.");
			$msg.='</span><br>';
		}
		else
		{
			$msg.='<span class="small error">';
			$msg.=$lang['fm_delete1'] . ' \'' . $filename . '\' ' . $lang['fm_delete3'];
			WriteLog("deleted '$filename'.");
			$msg.='</span><br>';
		}
	}
}

//////////////////////////////////
// Upload
///////////////////////////////////
if (isset($_POST['upload']))
{
	$error=false;
	if (!isset($_FILES['upfile']['name'])) echo '<span class="error">' . $lang['fm_uploadfilerequest'] . '</span><br><br>';
	else
	{
		if (!file_exists($fpath . $_FILES['upfile']['name']))
		{
			// Extension ermitteln -strrpos f&auml;ngt hinten an und ermittelt somit den letzten Punkt
			$endung=strrchr($_FILES['upfile']['name'],".");
			$erlaubt=ARRAY(
							
							".gz", 
							".sql"
			);
			if (!in_array($endung,$erlaubt))
			{
				$msg.="<font color=\"red\">" . $lang['fm_uploadnotallowed1'] . "<br>";
				$msg.=$lang['fm_uploadnotallowed2'] . "</font>";
			}
			else
			{
				if (!$error)
				{
					if (move_uploaded_file($_FILES['upfile']['tmp_name'],$fpath . $_FILES['upfile']['name'])) @chmod($fpath . $upfile_name,0755);
					else $error.="<font color=\"red\">" . $lang['fm_uploadmoveerror'] . "<br>";
				}
				if ($error) $msg.=$error . "<font color=\"red\">" . $lang['fm_uploadfailed'] . "</font><br>";
			}
		}
		else
			$msg.="<font color=\"red\">" . $lang['fm_uploadfileexists'] . "</font><br>";
	}
}

//Seitenteile vordefinieren
$href='filemanagement.php?action=' . $action . '&amp;kind=' . $kind;

$tbl_abfrage='';
if ($config['multi_dump'] == 0) $tbl_abfrage='<tr><td>' . $lang['fm_selecttables'] . '</td><td><input type="checkbox" class="checkbox" name="tblfrage" value="1"></td></tr>';
$dk=( isset($_POST['dumpKommentar']) ) ? htmlentities($_POST['dumpKommentar']) : '';
$tbl_abfrage.='<tr><td>' . $lang['fm_comment'] . ':</td><td><input type="text" class="text" style="width:260px;" name="dumpKommentar" value="' . $dk . '"></td></tr>';

$autodel='<p class="autodel">' . $lang['autodelete'] . ": ";
$autodel.=( $config['auto_delete'] == 0 ) ? $lang['not_activated'] : $lang['activated'] . ' (' . $config['max_backup_files'] . ' ' . $lang['max_backup_files_each2'] . ')';
$autodel.='</p>';

//Fallunterscheidung
switch ($action)
{
	case 'dump':
		//Variablen
		if ($config['multi_dump'] == 0) DBDetailInfo($databases['db_selected_index']);
		$cext=( $config['cron_extender'] == 0 ) ? "pl" : "cgi";
		$actualUrl=substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],"/") + 1);
		if (substr($actualUrl,-1) != "/") $actualUrl.="/";
		if (substr($actualUrl,0,1) != "/") $actualUrl="/$actualUrl";
		$refdir=( substr($config['cron_execution_path'],0,1) == "/" ) ? "" : $actualUrl;
		$scriptdir=$config['cron_execution_path'] . 'crondump.' . $cext;
		$sfile=$config['cron_execution_path'] . "perltest.$cext";
		$simplefile=$config['cron_execution_path'] . "simpletest.$cext";
		$scriptentry=Realpfad("./") . $config['paths']['config'];
		$cronabsolute=( substr($config['cron_execution_path'],0,1) == "/" ) ? $_SERVER['DOCUMENT_ROOT'] . $scriptdir : Realpfad("./") . $scriptdir;
		$confabsolute=$config['config_file'];
		$scriptref=getServerProtocol() . $_SERVER['SERVER_NAME'] . $refdir . $config['cron_execution_path'] . 'crondump.' . $cext . "?config=" . $confabsolute;
		$cronref="perl " . $cronabsolute . " -config=" . $confabsolute . " -html_output=0";
		
		//Ausgabe
		echo headline($lang['fm_dump_header'] . ' <span class="small">("' . $lang['config_headline'] . ': ' . $config['config_file'] . '")</span>');
		if (!is_writable($config['paths']['backup'])) die('<span class="error">' . sprintf($lang['wrong_rights'],'work/backup','777') . '</span>');
		
		echo ( $msg > '' ) ? $msg . '<br>' : '';
		echo $autodel;
		
		//Auswahl
		echo '<div>
		<input type="button" value=" ' . $lang['dump'] . ' PHP " class="Formbutton" onclick="document.getElementById(\'buperl\').style.display=\'none\';document.getElementById(\'buphp\').style.display=\'block\';">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value=" ' . $lang['dump'] . ' PERL " class="Formbutton" onclick="document.getElementById(\'buphp\').style.display=\'none\';document.getElementById(\'buperl\').style.display=\'block\';">
		</div>';
		
		echo '<div id="buphp">';
		
		//Dumpsettings
		echo '<h6>' . $lang['dump'] . ' (PHP)</h6>';
		
		echo '<div><form name="fm" id="fm" method="post" action="' . $href . '">';
		echo '<input class="Formbutton" name="dump" type="submit" value="';
		echo $lang['fm_startdump'] . '"><br>';
		
		echo '<fieldset>
					<legend></legend>';
		echo '<table>';
		echo $tbl_abfrage;
		echo '<tr><td><label for "sel_dump_encoding">' . $lang['fm_choose_encoding'] . '</label></td>';
		echo '<td><select name="sel_dump_encoding" id="sel_dump_encoding">';
		echo make_options($config['mysql_possible_character_sets'],$dump['sel_dump_encoding']);
		echo '</select></td></tr>';
		echo '<tr><td>' . $lang['mysql_connection_encoding'] . ':</td><td><strong>' . $config['mysql_standard_character_set'] . '</strong></td></tr>';
		echo '</table></form></div>';
		echo '</fieldset>';
		
		echo '<h6>' . $lang['fm_dumpsettings'] . ' (PHP)</h6>';
		
		echo '<table>';
		echo '<tr><td>' . $lang['db'] . ':</td><td><strong>';
		if ($config['multi_dump'] == 1)
		{
			echo 'Multidump (' . count($databases['multi']) . ' ' . $lang['dbs'] . ')</strong>';
			echo '<span class="small">' . $toolboxstring . '</span>';
		}
		else
		{
			echo $databases['db_actual'] . '&nbsp;&nbsp;<span>(' . $databases['Detailinfo']['tables'] . " Tables, " . $databases['Detailinfo']['records'] . " Records, " . byte_output($databases['Detailinfo']['size']) . ')</span></strong>';
		
		}
		echo '</td></tr>';
		
		if ($config['multi_dump'] == 0 && $databases['praefix'][$databases['db_selected_index']] > '')
		{
			echo '<tr><td>' . $lang['praefix'] . ':</td><td><strong>';
			echo $databases['praefix'][$databases['db_selected_index']];
			echo '</strong></td></tr>';
		}
		
		echo '<tr><td>' . $lang['gzip'] . ':</td><td><strong>' . ( ( $config['compression'] == 1 ) ? $lang['activated'] : $lang['not_activated'] );
		echo '</strong></td></tr>';
		
		echo '<tr><td>' . $lang['multi_part'] . ':</td><td><strong>' . ( ( $config['multi_part'] == 1 ) ? $lang['yes'] : $lang['no'] );
		echo '</strong></td></tr>';
		
		if ($config['multi_part'] == 1)
		{
			echo '<tr><td>' . $lang['multi_part_groesse'] . ':</td><td><strong>' . byte_output($config['multipart_groesse']) . '</strong></td></tr>';
		}
		
		if ($config['send_mail'] == 1)
		{
			$t=$config['email_recipient'] . ( ( $config['send_mail_dump'] == 1 ) ? $lang['withattach'] : $lang['withoutattach'] );
		}
		echo '<tr><td>' . $lang['send_mail_form'] . ':</td><td><strong>' . ( ( $config['send_mail'] == 1 ) ? $t : $lang['not_activated'] );
		echo '</strong></td></tr>';
		
		for ($x=0; $x < 3; $x++)
		{
			if (isset($config['ftp_transfer'][$x]) && $config['ftp_transfer'][$x] > 0)
			{
				echo table_output($lang['ftp_transfer'],sprintf(str_replace('<br>',' ',$lang['ftp_send_to']),$config['ftp_server'][$x],$config['ftp_dir'][$x]),1,2);
			}
		}
		//echo '</td></tr>';
		echo '</table>';
		
		echo '<div style="display:none"><img src="' . $config['files']['iconpath'] . 'progressbar_dump.gif"><br><img src="' . $config['files']['iconpath'] . 'progressbar_speed.gif"></div>';
		
		echo '</div><div id="buperl" style="display:none;">';
		
		//crondumpsettings
		echo '<h6>' . $lang['dump'] . ' (PERL)</h6>';
		
		echo '<p><input class="Formbutton" type="Button" name="DoCronscript" value="' . $lang['DoCronButton'] . '" onclick="self.location.href=\'' . $scriptref . '\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton" type="Button" name="DoPerlTest" value="' . $lang['DoPerlTest'] . '" onclick="self.location.href=\'' . $sfile . '\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton" type="Button" name="DoSimpleTest" value="' . $lang['DoSimpleTest'] . '" onclick="self.location.href=\'' . $simplefile . '\'"></p>';
		
		echo '<h6>' . $lang['fm_dumpsettings'] . ' (PERL)</h6>';
		
		if ($config['cron_dbindex'] == -3)
		{
			$cron_dbname=$lang['multidumpall'];
			$cron_dbpraefix="";
		}
		elseif ($config['cron_dbindex'] == -2)
		{
			//$cron_dbname='Multidump ('.count($databases['multi']).' '.$lang['dbs'].')';
			$cron_dbname='Multidump (' . count($databases['multi']) . ' ' . $lang['dbs'] . ')</strong>';
			$cron_dbname.='<span class="small">' . $toolboxstring . '</span>';
			$cron_dbpraefix="";
		}
		else
		{
			$cron_dbname=$databases['Name'][$config['cron_dbindex']];
			$cron_dbpraefix=$databases['praefix'][$config['cron_dbindex']];
		}
		
		echo '<table>';
		echo '<tr><td>' . $lang['db'] . ':</td><td><strong>' . $cron_dbname . '</strong></td></tr>';
		
		if ($cron_dbpraefix > '')
		{
			echo '<tr><td>' . $lang['praefix'] . ":</td><td><strong>";
			echo $cron_dbpraefix . '</strong></td></tr>';
		}
		
		echo '<tr><td>' . $lang['gzip'] . ":</td><td><strong>" . ( ( $config['cron_compression'] == 1 ) ? $lang['activated'] : $lang['not_activated'] );
		echo '</strong></td></tr>';
		
		echo '<tr><td>' . $lang['multi_part'] . ":</td><td><strong>" . ( ( $config['multi_part'] == 1 ) ? $lang['yes'] : $lang['no'] );
		echo '</strong></td></tr>';
		
		if ($config['multi_part'] == 1)
		{
			echo '<tr><td>' . $lang['multi_part_groesse'] . ':</td><td><strong>' . byte_output($config['multipart_groesse']) . '</td></tr>';
		}
		echo '<tr><td>' . $lang['cron_printout'] . ':</td><td><strong>' . ( ( $config['cron_printout'] == 1 ) ? $lang['activated'] : $lang['not_activated'] ) . '</strong></td></tr>';
		
		if ($config['send_mail'] == 1)
		{
			$t=$config['email_recipient'] . ( ( $config['send_mail_dump'] == 1 ) ? $lang['withattach'] : $lang['withoutattach'] );
		}
		echo '<tr><td>' . $lang['send_mail_form'] . ':</td><td><strong>' . ( ( $config['send_mail'] == 1 ) ? $t : $lang['not_activated'] ) . '</strong></td></tr>';
		
		for ($x=0; $x < 3; $x++)
		{
			if (isset($config['ftp_transfer'][$x]) && $config['ftp_transfer'][$x] > 0)
			{
				echo table_output($lang['ftp_transfer'],sprintf(str_replace('<br>',' ',$lang['ftp_send_to']),$config['ftp_server'][$x],$config['ftp_dir'][$x]),1,2);
			}
		}
		//echo '</td></tr>';
		echo '</table>';
		
		//	Eintraege fuer Perl
		echo '<br><p class="small">' . $lang['perloutput1'] . ':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>' . $scriptentry . '</strong><br>';
		echo $lang['perloutput2'] . ':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>' . $scriptref . '</strong><br>';
		echo $lang['perloutput3'] . ':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>' . $cronref . '</strong></p>';
		
		echo '</div>';
		
		break;
	
	case 'restore':
		echo headline(sprintf($lang['fm_restore_header'],$databases['db_actual']));
		echo '<div id="content">';
		
		echo ( $msg > '' ) ? $msg : '';
		echo $autodel;
		
		echo '<form name="fm" id="fm" method="post" action="' . $href . '">';
		echo '<div>';
		echo '<input class="Formbutton" name="restore" type="submit" value="' . $lang['fm_restore'] . '" onclick="if (!confirm(\'' . $lang['fm_alertrestore1'] . ' `' . $databases['db_actual'] . '`  ' . $lang['fm_alertrestore2'] . ' `\' + GetSelectedFilename() + \'` ' . $lang['fm_alertrestore3'] . '\')) return false;">';
		echo '<input class="Formbutton" name="restore" type="submit" value="' . $lang['restore_of_tables'] . '" onclick="if (!confirm(\'' . $lang['fm_alertrestore1'] . ' `' . $databases['db_actual'] . '`  ' . $lang['fm_alertrestore2'] . ' `\' + GetSelectedFilename() + \'` ' . $lang['fm_alertrestore3'] . '\')) return false; document.forms[0].tblfrage.value=1;">';
		
		echo FileList();
		
		echo '<input type="hidden" name="tblfrage" value="0">';
		
		echo '</div></form>';
		
		break;
	case 'files':
		$sysfedit=( isset($_POST['sysfedit']) ) ? 1 : 0;
		$sysfedit=( isset($_GET['sysfedit']) ) ? $_GET['sysfedit'] : $sysfedit;
		echo headline($lang['file_manage']);
		echo ( $msg > '' ) ? $msg . '<br>' : '';
		echo $autodel;
		echo '<form name="fm" id="fm" method="post" action="' . $href . '">';
		echo '<input class="Formbutton" name="delete" type="submit" value="' . $lang['fm_delete'] . '"	onclick="if (!confirm(\'' . $lang['fm_askdelete1'] . '`\' + GetSelectedFilename() + \'`' . $lang['fm_askdelete2'] . '\')) return false;">';
		echo '<input class="Formbutton" name="deleteauto" type="submit" value="' . $lang['fm_deleteauto'] . '"	onclick="if (!confirm(\'' . $lang['fm_askdelete3'] . '\')) return false;">';
		echo '<input class="Formbutton" name="deleteall" type="submit" value="' . $lang['fm_deleteall'] . '"	onclick="if (!confirm(\'' . $lang['fm_askdelete4'] . '\')) return false;">';
		echo '<input class="Formbutton" name="deleteallfilter" type="submit" value="' . $lang['fm_deleteallfilter'] . $databases['db_actual'] . $lang['fm_deleteallfilter2'] . '"	onclick="if (!confirm(\'' . $lang['fm_askdelete5'] . $databases['db_actual'] . $lang['fm_askdelete5_2'] . '\')) return false;">';
		
		echo FileList() . '</form>';
		
		echo '<h6>' . $lang['fm_fileupload'] . '</h6>';
		echo '<div align="left"><form action="' . $href . '" method="POST" enctype="multipart/form-data">';
		echo '<input type="file" name="upfile" class="Formbutton" size="60">';
		echo '<input type="submit" name="upload" value="' . $lang['fm_fileupload'] . '" class="Formbutton">';
		echo '<br>' . $lang['max_upload_size'] . ': <strong>' . $config['upload_max_filesize'] . '</strong>';
		echo '<br>' . $lang['max_upload_size_info'];
		
		echo '</form></div>';
		
		echo '<h6>Tools</h6><div align="left">';
		echo '<input type="Button" onclick="document.location=\'filemanagement.php?action=convert\'" class="Formbutton" value="' . $lang['converter'] . '">';
		echo '</div>';
		
		break;
	case "convert":
		// Konverter
		echo headline($lang['converter']);
		echo '<br><br><form action="filemanagement.php?action=convert" method="post">';
		echo '<div align="center"><table class="bdr"><tr><th colspan="2">' . $lang['convert_title'] . '</th></tr>';
		echo '<tr><td>' . $lang['convert_file'] . '</td><td>' . FilelisteCombo($config['paths']['backup'],$selectfile) . '</td></tr>';
		echo '<tr><td>' . $lang['convert_filename'] . ':</td><td><input type="text" name="destfile" size="50" value="' . $destfile . '"></td></tr>';
		echo '<tr><td><input type="checkbox" name="compressed" value="1" ' . ( ( $compressed == 1 ) ? "checked" : "" ) . '>' . $lang['compressed'] . '</td>';
		echo '<td><input type="submit" name="startconvert" value=" ' . $lang['convert_start'] . ' " class="Formbutton"></td></tr>';
		echo '</table></div></form><br>';
		if (isset($_POST['startconvert']))
		{
			//$destfile.=($compressed==1) ? ".sql.gz" : ".sql";
			echo $lang['converting'] . " $selectfile ==&gt; $destfile<br>";
			
			if ($selectfile != "" && file_exists($config['paths']['backup'] . $selectfile) && strlen($destfile) > 2)
			{
				Converter($selectfile,$destfile,$compressed);
			}
			else
				echo $lang['convert_wrong_parameters'];
		}

}
echo MSDFooter();
?>