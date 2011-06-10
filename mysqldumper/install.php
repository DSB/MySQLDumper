<?php
$config['files']['iconpath']='./css/msd/icons/';

$install_ftp_server=$install_ftp_user_name=$install_ftp_user_pass=$install_ftp_path="";
$dbhost=$dbuser=$dbpass=$dbport=$dbsocket='';

foreach($_GET as $getvar => $getval){ ${$getvar} = $getval; }
foreach($_POST as $postvar => $postval){ ${$postvar} = $postval; }

if(!isset($language)) $language="en";

//Übergabe der Parameter über FORM
if (isset($_POST['dbhost']))
{
	$config['dbhost']=$dbhost;
	$config['dbuser']=$dbuser;
	$config['dbpass']=$dbpass;
	$config['dbport']=$dbport;
	$config['dbsocket']=$dbsocket;
}
else
{
	// Wenn Connection-String existiert -> Verbindungsdaten aus connstr auslesen
	if (isset($connstr) && !empty($connstr))
	{
		$p=explode("|",$connstr);
		$dbhost=$config['dbhost']=$p[0];
		$dbuser=$config['dbuser']=$p[1];
		$dbpass=$config['dbpass']=$p[2];
		$dbport=$config['dbport']=$p[3];
		$dbsocket=$config['dbsocket']=$p[4];
	}
	else $connstr="";
}

//Variabeln
$phase=(isset($phase)) ? $phase : 0;
$connstr="$dbhost|$dbuser|$dbpass|$dbport|$dbsocket";
$delfiles=Array();

include_once('./inc/functions.php');
include_once('./inc/mysql.php');
include_once('./inc/runtime.php');

$config['language']=$language;
include('./language/lang_list.php');
include('language/'.$language.'/lang_install.php');
$img_ok='<img src="'.$config['files']['iconpath'].'ok.gif" width="16" height="16" alt="ok">';
$img_failed='<img src="'.$config['files']['iconpath'].'notok.gif" width="16" height="16" alt="failed">';
$href="install.php?language=$language&phase=$phase&connstr=$connstr";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="cache-control" content="must-revalidate">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-15">
	<title>MySQLDumper - Installation</title>

<link rel="stylesheet" type="text/css" href="css/msd/style.css">
<script src="js/script.js" type="text/javascript"></script>
</head>
<body>
<script language="JavaScript" type="text/javascript">
function hide_tooldivs() {
<?php foreach($lang['languages'] as $key) {
	echo 'document.getElementById("'.$key.'").style.display = \'none\';'."\n";
}?>
}

function show_tooldivs(lab) {
hide_tooldivs();
switch(lab) {
<?php foreach($lang['languages'] as $key) {
echo 'case "'.$key.'":'."\n".'document.getElementById("'.$key.'").style.display = \'block\';'."\n".'break;'."\n";
	}?>

	}
}
</script>


<?php
if($phase<10) {
	if($phase==0)
	 	$Anzeige=$lang['install'].' - '.$lang['installmenu'];
	else $Anzeige=$lang['install'].' - '.$lang['step'].' '.($phase);
} elseif ($phase>9 && $phase<12) {
	$Anzeige=$lang['install'].' - '.$lang['step'].' '.($phase-7);
} elseif ($phase>19 && $phase<100) {
	$Anzeige=$lang['tools'];
} else {
	$Anzeige=$lang['uninstall'].' - '.$lang['step'].' '.($phase-99);
}

echo '<div style="position:absolute;top:0;left:0;">
<p><a href="install.php"><img src="css/msd/pics/h1_logo.gif" alt="'.$lang['install_tomenu'].'"></a></p>
</div>';
echo '<div id="pagetitle" align="center"><p>
'.$Anzeige.'
</p></div>';

echo '<div id="content" align="center"><p class="small"><strong>Version '.MSD_VERSION.' '.MSD_VERSION_ADD.'</strong><br><a href="index.php?force=1" class="small">'.$lang['install_forcescript'].'</a></p>
';


switch ($phase) {

	case 0: // Anfang - Sprachauswahl
		if(file_exists("config.php") && file_exists($config['paths']['config']."parameter.php"))zipConfig();

		echo '<form action="install.php" method="get"><input type="hidden" name="phase" value="1">';
		echo '<table class="border"><tr class="thead"><th>Language</th><th>Tools</th></tr>';
		echo '<tr><td valign="top" width="300"><table>';
		echo GetLanguageCombo("radio","radio","language","<tr><td>","</td></tr>");
		echo '</table></td><td valign="top">';


		foreach($lang['languages'] as $key) {
			echo("\n<div id=\"".$key.'"><a href="install.php?language='.$key.'&phase=100">'.$lang['tools1'][$key].'</a><br><br>');
//			if(file_exists($config['paths']['config']."config.gz")) echo '<a href="install.php?language='.$key.'&phase=20">'.$lang['tools2'][$key].'</a><br><br>';
//			if(file_exists($config['paths']['config']."parameter.php")) echo '<a href="install.php?language='.$key.'&phase=21">'.$lang['tools3'][$key].'</a><br><br>';
//			if(file_exists("config.php") && file_exists($config['paths']['config']."parameter.php")) echo '<a href="'.$config['paths']['config'].'config.gz">'.$lang['tools4'][$key].'</a>';
			echo("</div>");
		}

		echo("\n</td></tr><tr><td colspan=\"2\"><input type=\"submit\" name=\"submit\" value=\"Installation\" class=\"Formbutton\"></td></tr></table></form>");
		echo '<script language="JavaScript" type="text/javascript">show_tooldivs("'.$language.'");</script>';
		break;
	case 1: // checken
		if(isset($trychmod) && $trychmod==1) @chmod("config.php","0777");
		echo '<h6>'.$lang['dbparameter'].'</h6>';
		if(!is_writable("config.php")) {
			echo '<p class="warning">'.$lang['confignotwritable'].'</p>';
			echo '<a href="'.$href.'">'.$lang['tryagain'].'</a>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="install.php">'.$lang['install_tomenu'].'</a>';
		} else {
			$tmp=file("config.php");
			$stored=0;

			if (!isset($_POST['dbconnect']))
			{
				// Erstaufruf - Daten aus config.php auslesen
				for($i=0;$i<count($tmp);$i++) {
					if(substr($tmp[$i],0,17)=='$config[\'dbhost\']') {
						$config['dbhost'] = extractValue($tmp[$i]);
						$dbhost=$config['dbhost'];
						$stored++;
					}
					if(substr($tmp[$i],0,17)=='$config[\'dbport\']') {
						$config['dbport'] = extractValue($tmp[$i]);
						$dbport=$config['dbport'];
						$stored++;
					}
					if(substr($tmp[$i],0,19)=='$config[\'dbsocket\']') {
						$config['dbsocket'] = extractValue($tmp[$i]);
						$dbsocket=$config['dbsocket'];
						$stored++;
					}
					if(substr($tmp[$i],0,17)=='$config[\'dbuser\']') {
						$config['dbuser'] = extractValue($tmp[$i]);
						$dbuser=$config['dbuser'];
						$stored++;
					}
					if(substr($tmp[$i],0,17)=='$config[\'dbpass\']') {
						$config['dbpass'] = extractValue($tmp[$i]);
						$dbpass=$config['dbpass'];
						$stored++;
					}
					if(substr($tmp[$i],0,19)=='$config[\'language\']') {
						$config['language'] = extractValue($tmp[$i]);
						$stored++;
					}
					if($stored==6) break;
				}
			}

			if(!isset($config['dbport'])) $config['dbport']="";
			if(!isset($config['dbsocket'])) $config['dbsocket']="";

			echo '<form action="install.php?language='.$language.'&phase='.$phase.'" method="post">';
			echo '<table class="border">';
			echo '<tr><td>'.$lang['db_host'].':</td><td><input type="text" name="dbhost" value="'.$dbhost.'" size="60" maxlength="100"></td></tr>';
			echo '<tr><td>'.$lang['db_user'].':</td><td><input type="text" name="dbuser" value="'.$dbuser.'" size="60" maxlength="100"></td></tr>';
			echo '<tr><td>'.$lang['db_pass'].':</td><td><input type="password" name="dbpass" value="'.$dbpass.'" size="60" maxlength="100"></td></tr>';
			echo '<tr><td>';
			echo $lang['port'].':</td><td><input type="text" name="dbport" value="'.$dbport.'" size="5" maxlength="5">&nbsp;&nbsp;'.$lang['install_help_port'].'</td></tr>';
			echo '<tr><td>'.$lang['socket'].':</td><td><input type="text" name="dbsocket" value="'.$dbsocket.'" size="5" maxlength="5">&nbsp;&nbsp;'.$lang['install_help_socket'].'</td></tr>';

			echo '<tr><td>'.$lang['testconnection'].':</td><td><input type="submit" name="dbconnect" value="'.$lang['connecttomysql'].'" class="Formbutton"></td></tr>';
			if(isset($dbconnect))
			{
				echo '<tr class="thead"><th colspan="2">'.$lang['dbconnection'].'</th></tr>';
				echo '<tr><td colspan="2">';
				MSD_mysql_connect();

				if(!$config['dbconnection']) {
					echo '<p class="error">'.$lang['connectionerror'].'</p><span>&nbsp;';
				} else {
					echo '<p class="success">'.$lang['connection_ok'].'</p><span class="ssmall">';
					$connection="ok";
					$connstr="$dbhost|$dbuser|$dbpass|$dbport|$dbsocket";
					echo '<input type="hidden" name="connstr" value="'.$connstr.'">';
					SearchDatabases(1);
				}
				echo '</span></td></tr>';
			}
			echo '</table></form><br>';

			if(isset($connection) && $connection=="ok" && !empty($databases['Name'])) {

			echo '<form action="install.php?language='.$language.'&phase='.($phase+1).'" method="post">';
			echo '<input type="hidden" name="dbhost" value="'.$config['dbhost'].'">
			<input type="hidden" name="dbuser" value="'.$config['dbuser'].'">
			<input type="hidden" name="dbpass" value="'.$config['dbpass'].'">
			<input type="hidden" name="dbport" value="'.$config['dbport'].'">
			<input type="hidden" name="dbsocket" value="'.$config['dbsocket'].'">
			<input type="hidden" name="connstr" value="'.$connstr.'">';
			echo '<input type="submit" name="submit" value=" '.$lang['saveandcontinue'].' " class="Formbutton"></form>';
			}
		}
		break;
	case 2: //
		echo '<h6>MySQLDumper - '.$lang['confbasic'].'</h6>';
		$tmp=@file("config.php");
		$stored=0;
		for($i=0;$i<count($tmp);$i++) {

			if(substr($tmp[$i],0,17)=='$config[\'dbhost\']') {
				$tmp[$i]='$config[\'dbhost\'] = \''.$dbhost.'\';'."\n";
				$stored++;
			}
			if(substr($tmp[$i],0,17)=='$config[\'dbport\']') {
				$tmp[$i]='$config[\'dbport\'] = \''.$dbport.'\';'."\n";
				$stored++;
			}
			if(substr($tmp[$i],0,19)=='$config[\'dbsocket\']') {
				$tmp[$i]='$config[\'dbsocket\'] = \''.$dbsocket.'\';'."\n";
				$stored++;
			}
			if(substr($tmp[$i],0,17)=='$config[\'dbuser\']') {
				$tmp[$i]='$config[\'dbuser\'] = \''.$dbuser.'\';'."\n";
				$stored++;
			}
			if(substr($tmp[$i],0,17)=='$config[\'dbpass\']') {
				$tmp[$i]='$config[\'dbpass\'] = \''.$dbpass.'\';'."\n";
				$stored++;
			}

			if($stored==6) break;
		}
		$ret=true;
		if ($fp=fopen("config.php", "wb"))
		{
			if (!fwrite($fp,implode($tmp,""))) $ret=false;
			if (!fclose($fp)) $ret=false;
		}
		if(!$ret) {
			echo '<p class="warnung">'.$lang['import12'].'</p>';
		} else {
			if(ini_get('safe_mode')==1) {
				$nextphase=(extension_loaded("ftp")) ? 10 : 9;
			} else $nextphase=$phase+2;
			echo $lang['install_step2finished'];
			echo '<p>&nbsp;</p>';
			echo '<form action="install.php?language='.$language.'&phase='.$nextphase.'" method="post" name="continue"><input type="hidden" name="connstr" value="'.$connstr.'"><input class="Formbutton" style="width:360px;" type="submit" name="continue2" value=" '.$lang['install_step2_1'].' "></form>';
			echo '<script language="javascript">';
			echo 'document.forms["continue"].submit();';
			echo '</script>';
			echo '<p>&nbsp;</p>';
			echo '<form action="install.php?language='.$language.'&phase='.($phase+1).'" method="post"><input type="hidden" name="connstr" value="'.$connstr.'"><input class="Formbutton" style="width:360px;" type="submit" name="continue1" value=" '.$lang['editconf'].' "></form>';
		}

		break;
	case 3: //
		if(ini_get('safe_mode')==1) $nextphase=10; else $nextphase=$phase+1;
		echo '<h6>'.$lang['editconf'].'</h6>';
		echo '<form action="install.php?language='.$language.'&phase='.$nextphase.'" method="post">
		<textarea name="configfile" rows="20" cols="10" style="width:80%;height:300px;">';
		$f=file("config.php");
		for($i=0;$i<count($f);$i++) { echo stripslashes($f[$i]);}
		echo '</textarea><br><input class="Formbutton" type="reset" name="reset" value="'.$lang['reset'].'">&nbsp;&nbsp;
		<input class="Formbutton" type="submit" name="submit" value="'.$lang['save'].'">&nbsp;&nbsp;
		<input class="Formbutton" type="submit" name="nosave" value="'.$lang['osweiter'].'">';
		echo '<input type="hidden" name="connstr" value="'.$connstr.'">';
		echo '</form>';

		break;
	case 4: //Verzeichnisse

		if(isset($_POST['submit'])) {
			$ret=true;
			if ($fp=fopen("config.php", "wb"))
			{
				if (!fwrite($fp,stripslashes(stripslashes($_POST['configfile'])))) $ret=false;
				if (!fclose($fp)) $ret=false;
			}
			else $ret=false;
			if($ret==false) {
				echo '<br><strong>'.$lang['errorman'].' config.php '.$lang['manuell'].'.';
				die;
			}
		}

		echo '<h6>'.$lang['createdirs'].'</h6>';

		SetFileRechte("work/");@chmod("work",0777);
		SetFileRechte("work/config/");@chmod("work/config",0777);
		SetFileRechte("work/log/");@chmod("work/log",0777);
		SetFileRechte("work/backup/");@chmod("work/backup",0777);
		SetFileRechte("work/structure/");@chmod("work/structure",0777);
		$iw[0]=IsWritable("work");
		$iw[1]=IsWritable("work/config");
		$iw[2]=IsWritable("work/log");
		$iw[3]=IsWritable("work/backup");
		$iw[4]=IsWritable("work/structure");

		if ($iw[0] && $iw[1] && $iw[2] && $iw[3] && $iw[4])
		{
			echo '<script language="javascript">';
			echo 'self.location.href=\'install.php?language='.$language.'&phase=5&connstr='.$connstr.'\'';
			echo '</script>';
		}


		echo '<form action="install.php?language='.$language.'&phase=4" method="post"><table class="border"><tr class="thead">';
		echo '<th>'.$lang['dir'].'</th><th>'.$lang['rechte'].'</th><th>'.$lang['status'].'</th></tr>';
		echo '<tr><td><strong>work</strong></td><td>'.Rechte("work").'</td><td>'.(($iw[0]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/config</strong></td><td>'.Rechte("work/config").'</td><td>'.(($iw[1]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/log</strong></td><td>'.Rechte("work/log").'</td><td>'.(($iw[2]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/backup</strong></td><td>'.Rechte("work/backup").'</td><td>'.(($iw[3]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/structure</strong></td><td>'.Rechte("work/structure").'</td><td>'.(($iw[4]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td colspan="3" align="right"><input type="hidden" name="connstr" value="'.$connstr.'"><input class="Formbutton" type="submit" name="dir_check" value=" '.$lang['check'].' "></td></tr>';
		if($iw[0] && $iw[1] && $iw[2] && $iw[3] && $iw[4])
			echo '<tr><td colspan="2">'.$lang['dirs_created'].'<br><br><input class="Formbutton" type="Button" value=" '.$lang['install_continue'].' " onclick="location.href=\'install.php?language='.$language.'&phase=5&connstr='.$connstr.'\'"></td></tr>';
		echo '</table></form>';
		// Wenn Verzeichnisse erstellt wurden - direkt weitermachen

		break;
	case 5:
		echo '<h6>'.$lang['laststep'].'</h6>';

		echo '<br><h4>'.$lang['installfinished'].'</h4>';
		SetDefault(true);
		include("language/".$language."/lang_install.php");

		// direkt zum Start des Dumeprs
		echo '<script language="javascript">';
		echo 'self.location.href=\'index.php\'';
		echo '</script>';

		if(file_exists($config['paths']['config']."config.gz")) {
			echo '<br><br><a href="install.php?language='.$language.'&phase=20">'.$lang['import1'].'</a>';
		}
		echo '<br><br><a href="install.php?language='.$language.'&phase=21">'.$lang['import2'].'</a>';

		break;
	case 9:

		clearstatcache();
		$iw[0]=IsWritable("work");
		$iw[1]=IsWritable("work/config");
		$iw[2]=IsWritable("work/log");
		$iw[3]=IsWritable("work/backup");
		$iw[4]=IsWritable("work/structure");
		echo '<h6>'.$lang['ftpmode'].'</h6>';
		echo '<p align="left" style="padding-left:100px; padding-right:100px;">'.$lang['safemodedesc'].'</p>';

		echo '<form action="install.php?language='.$language.'&phase=9" method="post"><input type="hidden" name="connstr" value="'.$connstr.'"><table>';
		echo '<tr><td class="hd2" colspan="2">'.$lang['idomanual'].'</td></tr>';
		echo '<tr><td colspan="2">'.$lang['dofrom'].'<br><div class="small">'.Realpfad('./').'</div></td></tr>';
		echo '<tr><td><strong>work</strong></td><td>'.(($iw[0]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/config</strong></td><td>'.(($iw[1]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/log</strong></td><td>'.(($iw[2]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/backup</strong></td><td>'.(($iw[3]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/structure</strong></td><td>'.(($iw[4]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td colspan="3" align="right"><input type="submit" class="Formbutton" name="dir_check" value=" '.$lang['check'].' "></td></tr>';
/*
		if($iw[0] && $iw[1] && $iw[2] && $iw[3] && $iw[4])
			echo '<tr><td colspan="2">'.$lang['dirs_created'].'<br><input class="Formbutton" type="Button" value=" '.$lang['install_continue'].' " onclick="location.href=\'install.php?language='.$language.'&phase=4&connstr='.$connstr.'\'" class="Formbutton"></td></tr>';
*/
		// Wenn Verzeichnisse erstellt wurden - direkt weitermachen
		if ($iw[0] && $iw[1] && $iw[2] && $iw[3] && $iw[4])
		{
			echo '<script language="javascript">';
			echo 'self.location.href=\'install.php?language='.$language.'&phase=4&connstr='.$connstr.'\'';
			echo '</script>';
		}
		echo '</table>';

		break;
	case 10: //safe_mode FTP
		$config['ftp_useSSL']=0;
		clearstatcache();
		$iw[0]=IsWritable("work");
		$iw[1]=IsWritable("work/config");
		$iw[2]=IsWritable("work/log");
		$iw[3]=IsWritable("work/backup");
		$iw[4]=IsWritable("work/structure");
		if(!isset($install_ftp_port) || $install_ftp_port<1) $install_ftp_port=21;
		echo '<h6>'.$lang['ftpmode'].'</h6>';
		echo '<p align="left" style="padding-left:100px; padding-right:100px;">'.$lang['safemodedesc'].'</p>';

		echo '<form action="install.php?language='.$language.'&phase=10" method="post"><input type="hidden" name="connstr" value="'.$connstr.'">
		<table width="80%"><tr><td width="50%" valign="top"><table>';
		echo '<tr><td class="hd2" colspan="2">'.$lang['idomanual'].'</td></tr>';
		echo '<tr><td colspan="2">'.$lang['dofrom'].'<br><div class="small">'.Realpfad('./').'</div></td></tr>';
		echo '<tr><td><strong>work</strong></td><td>'.(($iw[0]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/config</strong></td><td>'.(($iw[1]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/log</strong></td><td>'.(($iw[2]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/backup</strong></td><td>'.(($iw[3]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td><strong>work/structure</strong></td><td>'.(($iw[4]) ? $img_ok : $img_failed).'</td></tr>';
		echo '<tr><td colspan="3" align="right"><input type="submit" name="dir_check" value=" '.$lang['check'].' " class="Formbutton"></td></tr>';
		if($iw[0] && $iw[1] && $iw[2] && $iw[3] && $iw[4])
			echo '<tr><td colspan="2">'.$lang['dirs_created'].'<br><input class="Formbutton" type="Button" value=" '.$lang['install_continue'].' " onclick="location.href=\'install.php?language='.$language.'&phase=4&connstr='.$connstr.'\'"></td></tr>';
		echo '</table></td><td width="50%" valign="top">';
		echo '<table><tr><td class="hd2" colspan="2">'.$lang['ftpmode2'].'</td></tr>';
		echo '<tr><td>FTP-Server</td><td><input type="text" name="install_ftp_server" value="'.$install_ftp_server.'"></td></tr>';
		echo '<tr><td>FTP-Port</td><td><input type="text" name="install_ftp_port" value="'.$install_ftp_port.'" size="4"></td></tr>';
		echo '<tr><td>FTP-User</td><td><input type="text" name="install_ftp_user_name" value="'.$install_ftp_user_name.'"></td></tr>';
		echo '<tr><td>FTP-'.$lang['pass'].'</td><td><input type="text" name="install_ftp_user_pass" value="'.$install_ftp_user_pass.'"></td></tr>';
		echo '<tr><td>'.$lang['info_scriptdir'].'</td><td><input type="text" name="install_ftp_path" value="'.$install_ftp_path.'"></td></tr>';
		echo '<tr><td colspan="2" align="right">
		<input type="submit" name="ftp_connect" value="'.$lang['connect'].'" class="Formbutton"></td></tr></table></table></form>';
		if(isset($ftp_connect)) {
			echo '<table><tr><td class="small">';
			$tftp=TesteFTP($install_ftp_server,$install_ftp_port,$install_ftp_user_name,$install_ftp_user_pass,$install_ftp_path);
			echo $tftp;
			echo '</td><td colspan="2" align="right">&nbsp;';
			if(substr($tftp,-9)=="</strong>") {
				echo '<form action="install.php?language='.$language.'&phase=11" method="post">
				<input type="hidden" name="connstr" value="'.$connstr.'">';
				echo '<input type="hidden" name="install_ftp_server" value="'.$install_ftp_server.'">
				<input type="hidden" name="install_ftp_port" value="'.$install_ftp_port.'">
				<input type="hidden" name="install_ftp_user_name" value="'.$install_ftp_user_name.'">
				<input type="hidden" name="install_ftp_user_pass" value="'.$install_ftp_user_pass.'">
				<input type="hidden" name="install_ftp_path" value="'.$install_ftp_path.'">';
				echo '<input type="submit" name="submit" value=" '.$lang['createdirs2'].' " class="Formbutton"></form>';
			}
			echo '</td></tr></table>';
		}
		//echo '</td></tr>';

		//echo '</table>';


		break;

	case 11: //FTP-Create Dirs
		echo '<h6>'.$lang['ftpmode'].'</h6>';
		if(CreateDirsFTP()==1) {
			SetDefault(true);
			echo DirectoryWarnings();
			echo '<br>'.$lang['installfinished'];

			if(is_writable($config['paths']['config'])) {
				if(file_exists($config['paths']['config']."config.gz")) {
					echo '<br><br><a href="install.php?language='.$language.'&phase=20&connstr='.$connstr.'">'.$lang['import1'].'</a>';
				}
				echo '<br><a href="install.php?language='.$language.'&phase=21&connstr='.$connstr.'">'.$lang['import2'].'</a>';
			}
		}
		break;
	case 20: //import
		echo '<h6>'.$lang['import'].'</h6>';

		$import=importConfig($config['paths']['config']."config.gz");
		if($import==0) {
			echo '<h5>'.$lang['import3'].'</h5>';
			SetDefault(true);
			echo '<h5>'.$lang['import4'].'</h5>';
			echo '<a href="index.php">'.$lang['import5'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="install.php">'.$lang['import6'].'</a>';
		} elseif($import==1) {
			echo '<p class="warnung">'.$lang['import11'].'</p>';
		} elseif($import==2) {
			echo '<p class="warnung">'.$lang['import12'].'</p>';
		}
		break;



		break;
	case 21: //upload + import
		echo '<h6>'.$lang['import2'].'</h6>';
		echo '<form action="install.php?language='.$language.'&phase=22" method="POST" enctype="multipart/form-data">';
		echo '<table><tr><td align="center" colspan="2">';
		echo '<input type="file" name="upfile"></td><td align="center"><input type="submit" name="upload" value="'.$lang['fm_fileupload'].'">';
		echo '</td></tr></table></form>';

		break;
	case 22: //posting from upload
		echo '<h6>'.$lang['import7'].'</h6>';
		$backlink='<a href=install.php?language='.$language.'&phase=21">'.$lang['import8'].'</a>';
		if (isset($_POST['upload']))
		{
			$error=false;
		   	if (!($_FILES['upfile']['name'])) {
		     	echo "<font color=\"red\">".$lang['fm_uploadfilerequest'].'</font><br><br>'.$backlink;
		    	exit;
			}

			if (file_exists($config['paths']['config'].$_FILES['upfile']['name'])) unlink($config['paths']['config'].$_FILES['upfile']['name']);

			if ($_FILES['upfile']['name']!='config.gz')
	        {
	        	echo "<font color=\"red\">".$lang['import9']."</font><br><br>".$backlink;
				exit;
	        }
			if (move_uploaded_file($_FILES['upfile']['tmp_name'],$config['paths']['config'].$_FILES['upfile']['name']))
			{
				chmod($config['paths']['config'].$upfile_name,0755);

		    } else {
				echo "<font color=\"red\">".$lang['fm_uploadmoveerror']."<br>".$backlink;
				exit;
		    }
		}
		echo '<h5>'.$lang['import10'].'</h5>';
		$import=importConfig($config['paths']['config']."config.gz");
		if($import==0) {
			echo '<h5>'.$lang['import3'].'</h5>';
			SetDefault(true);
			echo '<h5>'.$lang['import4'].'</h5>';
			echo '<a href="index.php">'.$lang['import5'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="install.php">'.$lang['import6'].'</a>';
		} elseif($import==1) {
			echo '<p class="warnung">'.$lang['import11'].'</p>';
		} elseif($import==2) {
			echo '<p class="warnung">'.$lang['import12'].'</p>';
		}
		break;
	case 100: //uninstall
		echo '<h6>'.$lang['ui1'].'</h6>';
		echo zipConfig().'<br><br>';
		echo '<h6>'.$lang['ui2'].'</h6>';
		echo '<a href="install.php">'.$lang['ui3'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a href="install.php?language='.$language.'&phase=101">'.$lang['ui4'].'</a>';
		break;
	case 101:
		echo '<h6>'.$lang['ui5'].'</h6>';
		$paths=Array();
		$w=substr($config['paths']['work'],0,strlen($config['paths']['work'])-1);
		if(is_dir($w)) $res = rec_rmdir ($w); else $res=0;
		// wurde das Verzeichnis korrekt gelöscht
	    if($res==0) {
	        // das Verzeichnis wurde korrekt gelöscht
			echo '<p>'.$lang['ui6'].'</p>';
			echo $lang['ui7']."<br>\"".Realpfad("./")."\"<br> ".$lang['manuell'].".<br><br>";
			echo '<a href="../">'.$lang['ui8'].'</a>';

	    }else {
			echo '<p class="Warnung">'.$lang['ui9'].'"'.$paths[count($paths)-1].'"';

		}
		break;
	}

?>

</div>
</body>
</html>


<?
//eigene Funktionen
// rec_rmdir - loesche ein Verzeichnis rekursiv
// Rueckgabewerte:
//   0  - alles ok
//   -1 - kein Verzeichnis
//   -2 - Fehler beim Loeschen
//   -3 - Ein Eintrag eines Verzeichnisses war keine Datei und kein Verzeichnis und
//        kein Link
function rec_rmdir ($path) {
	global $paths;
	$paths[]=$path;
    // schau' nach, ob das ueberhaupt ein Verzeichnis ist
    if (!is_dir ($path)) {
        return -1;
    }
    // oeffne das Verzeichnis
    $dir = @opendir ($path);
    // Fehler?
    if (!$dir) {
        return -2;
    }

    // gehe durch das Verzeichnis
    while ($entry = @readdir($dir)) {
        // wenn der Eintrag das aktuelle Verzeichnis oder das Elternverzeichnis
        // ist, ignoriere es
        if ($entry == '.' || $entry == '..') continue;
        // wenn der Eintrag ein Verzeichnis ist, dann
        if (is_dir ($path.'/'.$entry)) {
            // rufe mich selbst auf
            $res = rec_rmdir ($path.'/'.$entry);
            // wenn ein Fehler aufgetreten ist
            if ($res == -1) { // dies duerfte gar nicht passieren
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // normalen Fehler melden
            } else if ($res == -2) { // Fehler?
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler weitergeben
            } else if ($res == -3) { // nicht unterstuetzer Dateityp?
                @closedir ($dir); // Verzeichnis schliessen
                return -3; // Fehler weitergeben
            } else if ($res != 0) { // das duerfe auch nicht passieren...
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler zurueck
            }
        } else if (is_file ($path.'/'.$entry) || is_link ($path.'/'.$entry)) {
            // ansonsten loesche diese Datei / diesen Link
            $res = @unlink ($path.'/'.$entry);
            // Fehler?
            if (!$res) {
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // melde ihn
            }
        } else {
            // ein nicht unterstuetzer Dateityp
            @closedir ($dir); // Verzeichnis schliessen
            return -3; // tut mir schrecklich leid...
        }
    }

    // schliesse nun das Verzeichnis
    @closedir ($dir);

    // versuche nun, das Verzeichnis zu loeschen
    $res = @rmdir ($path);

    // gab's einen Fehler?
    if (!$res) {
        return -2; // melde ihn
    }

    // alles ok
    return 0;
}

function Rechte($file)
{
	clearstatcache();
	return @substr(decoct(fileperms($file)),-3);
}

function zipConfig()
{
	global $config;

	$cfname=$config['paths']['config']."config.gz";
	if(file_exists($cfname)) unlink($cfname);

	$h1="### Configuration Summary - MySQLDumper ".MSD_VERSION."\n\n";
	$h2="###FILE_config.php\n";
	$h3="###FILE_".$config['paths']['config']."sql_statements\n";

	$cf=$h1.$h2;
	$tmp=file("config.php");
	while(substr($tmp[0],0,18)!='$config[\'direct_connection\']') {
		array_shift($tmp);
		if(count($tmp)==0) break;
	}

	array_shift($tmp);
	$cf.=implode($tmp,"")."\n".$h3;
	if(file_exists($config['paths']['config']."sql_statements")) {
		$tmp=file($config['paths']['config']."sql_statements");
		$cf.=implode($tmp,"")."\n";
	}
	if($config['zlib']) {
		$fp = gzopen ($cfname,"ab");
		gzwrite ($fp,$cf);
		gzclose ($fp);
	} else {
		$fp = fopen ($cfname,"ab");
		fwrite ($fp,$cf);
		fclose ($fp);
	}

	//return '<a href="'.$cfname.'">Download Config from '.$config['paths']['config'].'</a>';

}

function importConfig($importfile)
{
	global $config;

	$cf1=Array();
	$imp1=Array();
	$sql1=Array();
	$tmp=Array();

	if(!file_exists($importfile)) exit;
	$tmp=file("config.php");
	$imp=gzfile($importfile);

	for($i=0;$i<count($tmp);$i++) {
		$cf1[]=$tmp[$i];
		if(substr($tmp[$i],0,18)=='$config[\'direct_connection\']') break;
	}


	for($i=3;$i<count($imp);$i++) {

		if(substr($imp[$i],0,8)!="###FILE_") {
			$imp1[]=$imp[$i];
		} else {
			$last=$i+1;
			break;
		}

	}
	for($i=$last;$i<count($imp);$i++) {
		$sql1[]=$imp[$i];
	}
	$cf=array_merge($cf1,$imp1);

	//jetzt schreiben
	$ret=true;
	if(file_exists($config['paths']['config'])) {
		if ($fp=fopen($config['paths']['config']."sql_statements", "wb"))
		{
			if (!fwrite($fp,implode($sql1,""))) $ret=false;
			if (!fclose($fp)) $ret=false;
		}
	}
	if($ret==false){
		return 1;
	} else {
		if ($fp=fopen("config.php", "wb"))
		{
			if (!fwrite($fp,implode($cf,""))) $ret=false;
			if (!fclose($fp)) $ret=false;
		}
	}
	if($ret==false){
		return 2;
	} else {
		return 0;
	}
}

function extractValue($s)
{
	$r=trim(substr($s, strpos($s,"=")+1));
	$r=substr($r,0,strlen($r)-1);
	if(substr($r,-1)=="'" || substr($r,-1)=='"')$r=substr($r,0,strlen($r)-1);
	if(substr($r,0,1)=="'" || substr($r,0,1)=='"')$r=substr($r,1);
	return $r;
}




?>
