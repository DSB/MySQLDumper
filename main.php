<?php

include("inc/header.php");
echo headline();
//echo "<h4>".$databases["db_selected_index"]."</h4>";
//$config["disabled"]=ini_get("disable_functions");
//vars
$td='<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">';
$action=(isset($_GET["action"])) ? $_GET["action"] : "status";
$checkit=(isset($_GET["checkit"])) ? urldecode($_GET["checkit"]) : "";
$repair=(isset($_GET["repair"])) ? $_GET["repair"] : 0;
$is_htaccess=(file_exists(".htaccess"));
if($is_htaccess) $htaccess_exist=file(".htaccess");
$dba=$hta_dir=$Overwrite=$msg="";


//MySQL-Verbindung herstellen
MSD_mysql_connect(); 

if(isset($_GET["help"]) && $_GET["help"]==1) {
	echo '<h3>Verzeichnis-Hilfe</h3>';
	
	if($_GET["dir"]=="config") $helpdir=$config["paths"]["config"];
	if($_GET["dir"]=="backup") $helpdir=$config["paths"]["backup"];
	if($_GET["dir"]=="structure") $helpdir=$config["paths"]["structure"];
	if($_GET["dir"]=="log") $helpdir=$config["paths"]["log"];
	
	echo 'Hilfe zu '.$_GET["dir"].'-Verzeichnis ('.$helpdir.')<br><br>';
	@chmod($helpdir, 0777);
	
	if(!is_writable($helpdir)) {
		echo "<div class=\"warnung\">Verzeichnis $helpdir ist nicht schreibbar.<br>chmod scheitert.</div>";
	} else { 
		echo "Verzeichnis $helpdir ist schreibbar.<br>";
	}
	
	exit;

}

if(isset($_POST["htaccess"]) || $action=="schutz") {

	if($is_htaccess) $Overwrite='<p class="fehler">'.$lang["htaccess8"].'</p>';
	$cry_txt=array($lang["htaccess5"],$lang["htaccess6"],$lang["htaccess7"]);
	$step=(isset($_POST["step"]))?$_POST["step"]:0;
	$cryptart=(isset($_POST["cryptart"])) ? $_POST["cryptart"] :0;
	$uname=(isset($_POST["username"])) ? $_POST["username"] : "";
	$upass1=(isset($_POST["userpass1"])) ? $_POST["userpass1"] : "";
	$upass2=(isset($_POST["userpass2"])) ? $_POST["userpass2"] : "";
		
	if($step==1) {
		$msg="";
		if($uname=="") $msg=$lang["htaccess9"];
		if(($upass1!=$upass2) || ($upass1=="")) $msg.=$lang["htaccess10"];
		if($msg!="") {
			$msg='<p class="warnung">'.$msg.'</p>';
			$step=0;
		} else {
			$msg='<p class="meldung">'.$lang["htaccess11"].'</p>';
		}
	} elseif($step==2) {
		$htaccess = "AuthName \"MySQLDump\"\nAuthType Basic\nAuthUserFile ". $config["paths"]["root"]."/.htpasswd\n<Limit GET>\nrequire valid-user\n</Limit>";
		if($cryptart==0) $userpass=crypt($upass1);
		elseif($cryptart==1) $userpass=md5($upass1);
		else $userpass=$upass1;
		$htpasswd = $uname.":".$userpass;
		if($file_htpasswd=@fopen(".htpasswd","w")) {
        	fputs($file_htpasswd,$htpasswd);
            fclose($file_htpasswd);
			$file_htaccess=@fopen(".htaccess","w");
			fputs($file_htaccess,$htaccess);
            fclose($file_htaccess);
            $msg= $lang["htaccess12"].'<br><br><br><pre><b>'.$lang["htaccess13"].' .htaccess:</b>'."\n".htmlspecialchars($htaccess).'</pre><br><br><pre><b>'.$lang["htaccess13"].' .htpasswd:</b>'."\n". htmlspecialchars($htpasswd)."</pre>";
		} else {$msg='<p class="warnung">'.$lang["htaccess14"].'</p><br><pre><b>'.$lang["htaccess13"].' .htaccess:</b>'."\n".htmlspecialchars($htaccess).'</pre><br><br><pre><b>'.$lang["htaccess13"].' .htpasswd:</b>'."\n". htmlspecialchars($htpasswd).'</pre>';}
	}

	//Ausgabe
	echo '<h3><img src="images/key.gif" alt="" width="29" height="33" hspace="16" border="0">'.$lang["htaccess1"].'</h3>'.$Overwrite;
	if($step<2){
		
		
		if($step==0) {
			$un='<input type="text" name="username" size="25" value="'.$uname.'">';
			$p1='<input type="password" name="userpass1" size="25">';
			$p2='<input type="password" name="userpass2" size="25">';
			$cry='<input type="radio" name="cryptart" value="0"'.(($cryptart==0) ? " CHECKED" : "").'>'.$cry_txt[0].'&nbsp;&nbsp;<input type="radio" name="cryptart" value="1"'.(($cryptart==1) ? " CHECKED" : "").'>'.$cry_txt[1];
		} else {
			$un=$uname.'<input type="hidden" name="username" value="'.$uname.'">';
			$p1='***************<input type="hidden" name="userpass1" value="'.$upass1.'">';
			$p2='***************<input type="hidden" name="userpass2" value="'.$upass2.'">';
			$cry='<input type="hidden" name="cryptart" value="'.$cryptart.'">'.$cry_txt[$cryptart];
		}
		echo $msg.'<form method="post" action="main.php?action=schutz">';
		echo '<input type="hidden" name="step" value="'.($step+1).'">';
		echo '<table><tr><td>Name</td><td>'.$un.'</td></tr><tr><td>'.$lang["htaccess2"].'</td><td>'.$p1.'</td></tr><tr><td>'.$lang["htaccess3"].'</td><td>'.$p2.'</td></tr><tr><td colspan="2">'.$lang["htaccess4"].' '.$cry.'</td></tr><tr><td align="center" colspan="2"><br><input type="submit" name="htaccess" value="'.$lang["htaccess1"].'"></td></tr></table>';
		echo '</form>';
		
		
	} else echo $msg;
	echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
	include("inc/footer.php");
	die();

}


if(isset($_POST["error_submit"])) {
	
	$debug_adress="debug@daniel-schlichtholz.de";
	//$debug_adress="admin@localhost";
	
	if(!isset($_POST["error_absender"]) || $_POST["error_absender"]=="") {
		echo '<p class="Warnung">'.$lang["mailabsendererror"].'</p>';
		echo '<a href="javascript:history.back();" class="ul">back ...</a>';
		die;
	}
	if($_POST["error_name"]=="")$_POST["error_name"]=$_POST["error_absender"];
	$header="From: ".$_POST["error_name"]." <".$_POST["error_absender"].">\n";
	$header .= "Reply-To: ".$_POST["error_absender"]."\n";
	$header .= "X-Mailer: PHP/" . phpversion(). "\n";
	$header .= "X-Sender-IP: $REMOTE_ADDR\n";
	$header .= "Content-Type: text/html";
	$subject=stripslashes($_POST["error_subject"]);
	$body="=======================================<br>Art: ".$_POST["error_kind"]."<br><br>";
	$body.=$lang['Ausgabe'].": ".stripslashes(nl2br($_POST["error_aus"]))."<br><br>";
	$body.=$lang['Zusatz'].": ".nl2br($_POST["error_zusatz"])."<br><br>";
	$body.=$lang['Variabeln'].": ".nl2br($_POST["error_vars"]);
	$body.="<br>=======================================<br><br>";

	if (@mail($debug_adress, $subject, $body, $header)) {
		echo $lang['berichtsent']."<br><br>";
	} else {
		echo '<p class="Warnung">'.$lang["mailerror"].'</p>';
		$body=$lang['autobericht']." '".$_POST["error_name"]."'<br><br>".$body;
		$b=str_replace("<br>","\n",$body);
		$b=str_replace("</tr>","\n",$b);
		$b=rawurlencode(strip_tags($b));
		echo $lang['berichtman1'].' <a href="mailto:debug@daniel-schlichtholz.de?subject='.rawurlencode($subject).'&amp;body='.$b.'" class="ul">Debug-Team</a>';

	}
	
}

if($action=="edithtaccess") {
	$htaccessdontexist=0;
	
	if((isset($_GET["create"]) && $_GET["create"]==1 ) || (isset($_POST["create"]) && $_POST["create"]==1)) {
		$fp = fopen("$hta_dir.htaccess", "w");
		fwrite ($fp,"# created by MySQLDumper ".$config["version"]."\n"); 
		fclose ($fp);
	}
	if(isset($_POST["newload"])){
		$hta_dir=(isset($_POST["newhtadir"])) ? $_POST["newhtadir"] : ""; 
	} else $hta_dir=(isset($_POST["hta_dir"])) ? $_POST["hta_dir"] : "";
	if($hta_dir !="" && substr($hta_dir,-1)!="/")$hta_dir.="/";
	
	if(isset($_POST["submit"]) && isset($_POST["thta"])){
		$fp = fopen("$hta_dir.htaccess", "w");
		fwrite ($fp,$_POST["thta"]); 
		fclose ($fp);
	}
	if(file_exists("$hta_dir.htaccess")){
		$htaccess_exist=file("$hta_dir.htaccess");
	} else {
	$htaccessdontexist=1;
	}
	
	
	echo '<h3><img src="images/key.gif" alt="" width="29" height="33" hspace="16" border="0">'.$lang["htaccess16"].'</h3>';
	echo '<p class="fehler">'.$lang['htaccess32'].'</p>';
	echo '<form name="ehta" action="main.php?action=edithtaccess" method="post">File: <input type="text" name="newhtadir" value="'.$hta_dir.'" style="text-align:right;">.htaccess&nbsp;&nbsp;&nbsp;<input type="submit" name="newload" value=" '.$lang['htaccess19'].' " class="Formbutton">';
	if($htaccessdontexist!=1) {
		echo '<table><tr><td><textarea id="thta" name="thta" style="font-size:11px;color:blue;width:400px;height:300px;overflow:scroll;">'.implode("",$htaccess_exist).'</textarea><br><br>';
		echo '</td><td valign="top">';
		//Presets
		echo '<h6>Presets</h6><p><strong>'.$lang['htaccess30'].'</strong><p>
		<a href="javascript:insertHTA(1,document.ehta.thta)">all-inkl</a><br>
		
		<br><p><strong>'.$lang['htaccess31'].'</strong></p>
		<a href="javascript:insertHTA(101,document.ehta.thta)">'.$lang['htaccess20'].'</a><br>
		<a href="javascript:insertHTA(102,document.ehta.thta)">'.$lang['htaccess21'].'</a><br>
		<a href="javascript:insertHTA(103,document.ehta.thta)">'.$lang['htaccess22'].'</a><br>		
		<a href="javascript:insertHTA(104,document.ehta.thta)">'.$lang['htaccess23'].'</a><br>
		<a href="javascript:insertHTA(105,document.ehta.thta)">'.$lang['htaccess24'].'</a><br>
		<a href="javascript:insertHTA(106,document.ehta.thta)">'.$lang['htaccess25'].'</a><br>
		<a href="javascript:insertHTA(107,document.ehta.thta)">'.$lang['htaccess26'].'</a><br>
		<a href="javascript:insertHTA(108,document.ehta.thta)">'.$lang['htaccess27'].'</a><br>
		<a href="javascript:insertHTA(109,document.ehta.thta)">'.$lang['htaccess28'].'</a><br>
		<br>
		<a href="http://lrs.fmi.uni-passau.de/support/doc/apache-1.3/mod/directives.html" target="_blank">'.$lang['htaccess29'].'</a>
		';
		echo '</td></tr><tr><td colspan="2">'.$lang['htaccess18'].'<input type="text" name="hta_dir" size="60" value="'.$hta_dir.'"></td></tr><tr><td colspan="2">';
		echo '<input type="submit" name="submit" value=" '.$lang['save'].' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
		echo '<input type="reset" name="reset" value=" '.$lang['reset'].' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
		echo '</td></tr></table></form>';
	} else {
		echo '<p class="warnung">'.$hta_dir.'.htaccess existiert nicht. Soll sie erstellt werden ?</p>';
		echo '<form action="" method="post"><input type="hidden" name="hta_dir" value="'.$hta_dir.'"><input type="hidden" name="create" value="1"><input type="submit" name="createhtaccess" value="erstellen"></form>';
	}
	echo '<br><a href="main.php">zurück</a>';
	//echo "<pre>$_POST[thta]</pre>";
	exit;
}
if($action=="phpinfo") {
	phpinfo();
	echo '<p align="center"><a href="main.php">Home</a></p>';
	exit;
}
if($action=="extinfo") {
	echo ErrorReport();
	exit;
}

if($action=="db") {
	for($i=0;$i<count($databases["Name"]);$i++) {
		if(isset($_POST["empty".$i])) {
			EmptyDB($databases["Name"][$i]);
			$dba= '<p class="green">'.$lang["db"]." ".$databases["Name"][$i]." ".$lang["info_cleared"]."</p>";
			break;
		}
		if(isset($_POST["kill".$i])) {
			$res=mysql_query("DROP DATABASE `".$databases["Name"][$i]."`") or die(mysql_error()."");
			$dba= '<p class="green">'.$lang["db"]." ".$databases["Name"][$i]." ".$lang["info_deleted"]."</p>";
			SetDefault(true);
			include ($config["files"]["parameter"]);
			echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';
			break;
		}
		if(isset($_POST["optimize".$i])) {
			mysql_select_db($databases["Name"][$i],$config["dbconnection"]);
			$res = mysql_list_tables($databases["Name"][$i],$config["dbconnection"]);
			$tabellen="";
			WHILE ($row=mysql_fetch_row($res)) $tabellen.=$row[0].",";
			$tabellen=substr($tabellen,0,(strlen($tabellen)-1));
			if ($tabellen>"")
			{
				$query="OPTIMIZE TABLE ".$tabellen;
				$res=mysql_query($query) or die(mysql_error()."");
			}
			$_GET["dbid"]=$i;
			$dba= '<p class="green">'.$lang["db"].' <b>'.$databases["Name"][$i].'</b> '.$lang["info_optimized"].'.</p>';
			break;
		}
		if(isset($_POST["check".$i])) {
			$checkit="ALL";$_GET["dbid"]=$i;
		}
	}
}

if($action=="newdb") {
	if(isset($_POST["submit"])) {
		if ($_POST["dbneu"]==""){
			$dba='<p class="warnung">'.$lang["dbnoempty"].'</p>';
		} else {
			$sql_command="CREATE DATABASE `".$_POST["dbneu"]."`";
			$res=mysql_query($sql_command,$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if ($meldung!="")
				$dba='<p class="warnung">MySQL-Error: '.$meldung.'</p>';
			else {
				SetDefault(true);
				include ($config["files"]["parameter"]);
				$dba='<p class="green">'.$lang["db"]." '".$_POST["dbneu"]."' ".$lang["info_created"]."</p>";
				echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';
			}
		}
	}
	$action="db";
}




//Hier beginnt die Ausgabe 
echo "<h3>Home</h3>";
echo '<div align="center"><table border="1"><tr>';
echo $td.'<input class="Menubutton" type="Button" value="'.$lang['Statusinformationen'].'" onclick="document.location.href=\'main.php?action=status\';"></td>';
echo $td.'<input class="Menubutton" type="Button" value="'.$lang['dbs'].'" onclick="document.location.href=\'main.php?action=db\';"></td>';
echo $td.'<input class="Menubutton" type="Button" value="'.$lang['mysqlvars'].'" onclick="document.location.href=\'main.php?action=vars\';"></td>';
echo $td.'<input class="Menubutton" type="Button" value="'.$lang['mysqlsys'].'" onclick="document.location.href=\'main.php?action=sys\';"></td>';
echo '</tr></table></div><br>';


if($action=="status") {
	//Infos über Backups
	$Sum_Files=$Sum_Size=0;
	$Last_BU=Array();
	$sm=($config["safe_mode"]==1) ? "  (Safemode)" : "";

	$dh = opendir($config["paths"]["backup"]);
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($config["paths"]["backup"].$filename)){
			$files[] = $filename;
			$Sum_Files++;
			$Sum_Size+=filesize($config["paths"]["backup"].$filename);
			$ft=filectime($config["paths"]["backup"].$filename);
			if(!isset($Last_BU[2]) || (isset($Last_BU[2]) && $ft>$Last_BU[2])){
				$Last_BU[0]=$filename;
				$Last_BU[1]=date("d.m.Y h:i",$ft);
				$Last_BU[2]=$ft;
			} 
		}
	}
	require("inc/runtime.php");
	$status='<h5>'.$lang['Statusinformationen'].'</h5>';
	$status.= DirectoryWarnings();
	//Versionen
	$status.='<h6>'.$lang['Versionsinformationen'].'</h6>';
	$status.='MySQL Dumper-Version: <strong>'.$config["version"].'</strong><br>';
	$status.='MySQL-Version: <strong>'.MSD_MYSQL_VERSION.'</strong><br>';
	$status.='PHP-Version: <strong>'.PHP_VERSION.'</strong> '.(($config["zlib"]) ? '': '<span class="smallwarnung">&nbsp;&nbsp;'.$lang["phpbug"].'.&nbsp;&nbsp;</span>').'<a style="text-decoration:underline;" href="main.php?action=phpinfo">[Info]</a>&nbsp;&nbsp;'.$sm;
	$status.='<br>PHP-Extensions: <span class="smallgrey">'.$config["phpextensions"].'</span>';
	if($config["disabled"]!="") $status.='<br>'.$lang['disabledfunctions'].': <span class="smallwarnung">'.$config["disabled"].'</span>';
	if(!extension_loaded("ftp")) $status.= '<br><span class="smallwarnung">'.$lang['noftppossible'].'</span>';
	if(!$config["zlib"]) $status.= '&nbsp;&nbsp;&nbsp;<span class="smallwarnung"><br>'.$lang['nogzpossible'].'</span>';
	
	//MySQLDumper Informationen
	$status.='<h6>'.$lang['MySQL Dumper Informationen'].'</h6>'.$lang["info_location"].' "<b>'.$_SERVER["SERVER_NAME"].'</b>" ('.($config["paths"]["root"]).')<br>';
	$status.=$lang["info_actdb"].":<strong> ".$databases["db_actual"]."</strong><br>";
	$status.='<a style="text-decoration:underline; color:#006600;font-size: 10pt;" href="main.php?action=extinfo&mysqlversion='.MSD_MYSQL_VERSION.'">['.$lang['Fehlerbericht'].']</a><br><br>';
	if($config["no_htaccess"]==0) $status.='<a class="ul" href="main.php?action=schutz">'.$lang["htaccess1"].'</a>&nbsp;&nbsp;'.(($is_htaccess) ? '' : '<font color="#FF0000">'.$lang["htaccess15"].'</font>');
	if($is_htaccess) $status.='<a class="ul" href="main.php?action=edithtaccess">*** '.$lang["htaccess16"].' ***</a>';
	else $status.='&nbsp;&nbsp;&nbsp;<a class="ul" href="main.php?action=edithtaccess&create=1">+++ '.$lang["htaccess17"].' +++</a>';
	//History
	$status.='<br><h6>History</h6>'.$lang['backupfilesanzahl'].' <strong>'.$Sum_Files.'</strong> Backups (<strong>'.byte_output($Sum_Size).'</strong>)<br>';
	
	$status.=$lang["fm_freespace"].': <strong>'.MD_FreeDiskSpace().'</strong><br>';
	if($Sum_Files>0) $status.=$lang['lastbackup'].' '.$lang["vom"].' <strong><span class="crondumppars">'.((isset($Last_BU[1])) ? $Last_BU[1] : " - ").'</span></strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.((isset($Last_BU[1])) ? '<a class="ul" href="'.$config["paths"]["backup"].$Last_BU[0].'">' : " - ").'<strong>'.((isset($Last_BU[0])) ? $Last_BU[0] : " - ").'</strong></a><br>';
	$status.='<br>';
	echo $status;
} elseif($action=="db") {


	//Datenbanken
	echo '<h5>'.$lang["info_databases"].'</h5><div style="padding-left:10px; font-weight:bold;">';
	echo $dba.'<table border="2" cellpadding="2" cellspacing="2" width="70%">';
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 

	for($i=0;$i<count($databases["Name"]);$i++) {
		//gibts die Datenbank überhaupt?
		if (!mysql_select_db($databases["Name"][$i],$config["dbconnection"])) {
			echo '<tr><td>'.$databases["Name"][$i].'</td><td colspan="3">'.$lang["info_nodb"].'</td>';
		} else {
			mysql_select_db($databases["Name"][$i],$config["dbconnection"]);
			$tabellen = mysql_list_tables($databases["Name"][$i],$config["dbconnection"]);
			$num_tables = mysql_num_rows($tabellen);
			$cl=($i==$databases["db_selected_index"]) ? "#ccffff" : "white";
			echo '<tr bgcolor="'.$cl.'"><td><a class="ul" href="main.php?action=db&dbid='.$i.'#dbid">';
			echo ($i==$databases["db_selected_index"]) ? "<strong>".$databases["Name"][$i]."</strong>" : $databases["Name"][$i];
			echo '</a></td><td>'.$num_tables.' '.$lang["info_table1"];
			echo ($num_tables>1) ? $lang["info_table2"] : '';
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';

	echo '<form action="main.php?action=newdb" method="post"><table border="1"><tr>';
	echo '<td>'.$lang["create_database"].'</td><td><input type="text" name="dbneu" size="23" maxlength="50"></td><td><input class="Formbutton2" type="submit" name="submit" value="'.$lang["button_create_database"].'"></td></tr></table></form>';
	echo '</div>';
} elseif($action=="sys") {
	$sysaction=(isset($_GET["dosys"])) ? $_GET["dosys"] : 0;
	$msg="";
	$res=@mysql_query("SHOW VARIABLES LIKE 'datadir'",$config["dbconnection"]);
	if($res) {
		$row = mysql_fetch_array($res);
		$data_dir=$row[1];
	}
	switch($sysaction) {
		case 1: //FLUSH PRIVILEGES
			$msg="> operating FLUSH PRIVILEGES<br>";
			$res=@mysql_query("FLUSH PRIVILEGES",$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if($meldung!="") {
				$msg.='> MySQL-Error: '.$meldung;
			} else {
				$msg.="> Privileges were reloaded.";
			}
			break;
		case 2: //FLUSH STATUS
			$msg="> operating FLUSH STATUS<br>";
			$res=@mysql_query("FLUSH STATUS",$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if($meldung!="") {
				$msg.='> MySQL-Error: '.$meldung;
			} else {
				$msg.="> Status was reset.";
			}
			break;
		case 3: //FLUSH HOSTS
			$msg="> operating FLUSH HOSTS<br>";
			$res=@mysql_query("FLUSH HOSTS",$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if($meldung!="") {
				$msg.='> MySQL-Error: '.$meldung;
			} else {
				$msg.="> Hosts were reloaded.";;
			}
			break;
		case 4: //SHOW MASTER LOGS
			$msg="> operating SHOW MASTER LOGS<br>";
			$res=@mysql_query("SHOW MASTER LOGS",$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if($meldung!="") {
				$msg.='> MySQL-Error: '.$meldung;
			} else {
				$numrows=mysql_num_rows($res);
				if($numrows==0) {
					$msg.='> there are no master log-files';
				}else{
					$msg.='> there are '.$numrows.' logfiles<br>';
					for($i=0;$i<$numrows;$i++) {
						$row=mysql_fetch_row($res);
						$msg.='> '.$row[0].'&nbsp;&nbsp;&nbsp;'.(($data_dir) ? byte_output(filesize($data_dir.$row[0])) : '').'<br>';
					}
				}
			}
			break;
		case 5: //RESET MASTER
			$msg="> operating RESET MASTER<br>";
			$res=@mysql_query("RESET MASTER",$config["dbconnection"]);
			$meldung=mysql_error($config["dbconnection"]);
			if($meldung!="") {
				$msg.='> MySQL-Error: '.$meldung;
			} else {
				$msg.="> All Masterlogs were deleted.";
			}
			break;
	}
	echo '<h5>Mysql-Befehle</h5>';
	echo '';
	echo '<table cellpadding="2" cellspacing="2">
		<tr>
			<td><a href="main.php?action=sys&dosys=1" class="MYSQLbutton">Reload Privileges</a></td>
			<td><a href="main.php?action=sys&dosys=2" class="MYSQLbutton">Reset Status</a></td>
			<td><a href="main.php?action=sys&dosys=3" class="MYSQLbutton">Reload Hosts</a></td>
			<td><a href="main.php?action=sys&dosys=4" class="MYSQLbutton">Show Log-Files</a></td>
		</tr>
		<tr>
			<td><a href="main.php?action=sys&dosys=5" class="MYSQLbutton">Reset Master-Log</a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table></table><hr>';
	echo '<div align="center" class="MySQLbox">';
	echo '> MysSQL Dumper v'.$config["version"].' - Output Console<br><br>';
	echo ($msg!="") ? $msg : '> waiting for operation ...<br>';
	echo '</div>';
} elseif($action=="vars") {
	$var=(isset($_GET["var"])) ? $_GET["var"] : "prozesse";
	$Titelausgabe=array("variables"=>$lang['Variabeln'],"status"=>$lang['Status'],"prozesse"=>$lang['Prozesse']);
	echo '<h5>'.$lang['mysqlvars'].'</h5><div align="center"><table border="1" width="80%">';
	echo '<tr><td class="hd" align="center"><div align="left" class="green1">'.$Titelausgabe[$var].'</div>';
	echo '<a class="ul" href="main.php?action=vars&var=prozesse">'.$lang['Prozesse'].'</a>&nbsp;&nbsp;&nbsp;';
	echo '<a class="ul" href="main.php?action=vars&var=status">'.$lang['Status'].'</a>&nbsp;&nbsp;&nbsp;';
	echo '<a class="ul" href="main.php?action=vars&var=variables">'.$lang['Variabeln'].'</a>&nbsp;&nbsp;&nbsp;';

	echo '</td></tr>';
	echo '<tr><td>';
	//Variabeln
	switch($var) {
		case "variables":
			$res=@mysql_query("SHOW variables");
			if($res) $numrows=mysql_num_rows($res);
			if($numrows==0) {echo $lang["info_novars"];} else {
				echo '<table><tr bgcolor="#ccffcc"><td>Name</td><td>'.$lang['Inhalt'].'</td></tr>';
				for ($i = 0; $i < $numrows; $i++) {
			    	$row = mysql_fetch_array($res);
					echo "<tr><td valign=top>$row[0]</td><td valign=top>$row[1]</td></tr>";
				}
			}
			echo '</table>';
			break;
		case "status":
			$res=@mysql_query("SHOW STATUS");
			if($res) $numrows=mysql_num_rows($res);
			if($numrows==0) {echo $lang["info_nostatus"];} else {
				echo '<table><tr bgcolor="#ccffcc"><td>Name</td><td>'.$lang['Inhalt'].'</td></tr>';
				for ($i = 0; $i < $numrows; $i++) {
			    	$row = mysql_fetch_array($res);
					echo "<tr><td valign=top>$row[0]</td><td valign=top>$row[1]</td></tr>";
				}
			}
			echo '</table>';
			break;
		case "prozesse":
			if($config["processlist_refresh"]<1000)$config["processlist_refresh"]=2000;
			if(isset($_GET["killid"]) && $_GET["killid"]>0) {
				$killid=(isset($_GET["killid"])) ? $_GET["killid"] : 0;
				$wait=(isset($_GET["wait"])) ? $_GET["wait"] : 0;
				if($wait==0) {
					$ret=mysql_query("KILL ".$_GET["killid"]);
					$wait=2;
				} else $wait+=2;

				if($wait==0) {
					echo '<p class="meldung">'.$lang["processkill1"].$_GET["killid"].$lang["processkill2"].$ret.'</p>';
				} else {
					echo '<p class="meldung">'.$lang["processkill3"].$wait.$lang["processkill4"].$_GET["killid"].$lang["processkill2"].$ret.'</p>';
				}

			}

			$killid=$wait=0;
			$res=@mysql_query("SHOW FULL PROCESSLIST ");
			if($res) $numrows=mysql_num_rows($res);
			if($numrows==0) {echo $lang["info_noprocesses"];} else {
				echo '<table><tr bgcolor="#ccffcc" nowrap><td>ID</td><td>User</td><td>Host</td><td>DB</td><td>Command</td><td>Time</td><td>State</td><td>Info</td><td nowrap>RT: '.round($config["processlist_refresh"]/1000).' sec</td></tr>';
				for ($i = 0; $i < $numrows; $i++) {
			    	$row = mysql_fetch_array($res);
					echo "<tr><td valign=top class=\"sm\">$row[0]</td><td valign=top class=\"sm\">$row[1]</td><td valign=top class=\"sm\">$row[2]</td><td valign=top class=\"sm\">$row[3]</td><td valign=top class=\"sm\">$row[4]</td><td valign=top class=\"sm\">$row[5]</td><td valign=top class=\"sm\">$row[6]</td><td valign=top class=\"sm\">$row[7]</td><td class=\"sm\"><a href=\"main.php?action=vars&var=prozesse&killid=".$row[0]."\" class=\"SQLbutton\">&nbsp;kill&nbsp;</a></td></tr>";
					if($row[0]==$killid && $row[4]=="Killed") {
						$wait=$killid=0;
					}
				}
			}
			echo '</table>';
			echo '<form name="f" method="get" action="main.php">
			<input type="hidden" name="wait" value="'.$wait.'">
			<input type="hidden" name="killid" value="'.$killid.'">
			<input type="hidden" name="action" value="vars">
			<input type="hidden" name="var" value="prozesse"></form>';
			echo '<script ="javascript">window.setTimeout("document.f.submit();","'.$config["processlist_refresh"].'");</script>';

			break;
	}
	echo '</td></tr></table></div>';

}


//Datenbankdetails
if (isset($_GET["dbid"]))
{
	$dbid=$_GET["dbid"];
	echo '<hr><a name="dbid"></a><h4>'.$lang["info_dbdetail"].'"'.$databases["Name"][$dbid].'"</h4>';
	
	//@mysql_query("USE ".$databases["Name"][$dbid]);
	$res=@mysql_query("SHOW TABLE STATUS FROM `".$databases["Name"][$dbid]."`");
	if($res) $numrows=mysql_num_rows($res);
	if($numrows==0) {
		echo $lang["info_dbempty"];

	} else {
		echo $numrows.' '.$lang["info_table1"];
		echo ($numrows>1) ? $lang["info_table2"] : '';

		echo '<br><table border="1"><tr><td class="hd">Nr.</td><td class="hd">'.
			$lang["info_table1"].'</td><td class="hd">'.
			$lang["info_records"].'</td><td class="hd">'.
			$lang["info_size"].'</td><td class="hd">'.
			$lang["info_lastupdate"].'</td><td class="hd">'.
			$lang["info_optimized"].'</td><td class="hd">Status</td>'.
			'</tr>';
		$last_update="2000-01-01 00:00:00";
		$s=$s1=$s2="";
		for ($i = 0; $i < $numrows; $i++)
		{
	    	$row = mysql_fetch_array($res);
			$akt_size=$row["Data_length"]+$row["Index_length"];
			echo '<tr><td align="right" class="small">'.($i+1).'</td><td class="small"><a class="small" style="text-decoration:underline;" href="sql.php?db='.$databases["Name"][$dbid].'&tablename='.
				urlencode($row["Name"]).'&dbid='.$dbid.'">'.
				$row["Name"].'</a></td><td align="right" class="small">'.
				number_format($row["Rows"],0,",",".").'</td><td align="right" class="small">'.
				number_format($akt_size,0,",",".").
				' Bytes</td><td class="small" style="color:#006600;">&nbsp;'.
				$row["Update_time"].'</td><td align="center" class="small">';
			if ($row["Data_free"]==0) echo '<img src="images/ok.gif" alt="" width="12" height="12" border="0">';
				else echo '<font color="red"><img src="images/notok.gif" alt="" width="12" height="12" border="0">&nbsp;'.$lang["no"].'&nbsp;<img src="images/notok.gif" alt="" width="12" height="12" border="0"></font>';
			echo '</td><td align="center" class="small">';
			if($checkit==$row["Name"] || $repair==1) {
				$tmp_res=mysql_query("REPAIR TABLE `".$row["Name"]."`");
			}
			if(($checkit==$row["Name"] || $checkit=="ALL") && $akt_size>0) {
				$tmp_res=mysql_query("CHECK TABLE `".$row["Name"]."`");
				if($tmp_res) {
					$tmp_row = mysql_fetch_row($tmp_res);
					echo ($tmp_row[3]=="OK") ? '<img src="images/ok.gif" alt="" width="12" height="12" border="0">' : '<a class="uls" href="main.php?action=db&dbid='.$dbid.'&checkit='.urlencode($row["Name"]).'&repair=1#dbid"><img src="images/notok.gif" alt="" width="12" height="12" border="0">&nbsp;repair&nbsp;<img src="images/notok.gif" alt="" width="12" height="12" border="0"></a>';
				} else echo "CHECK TABLE `".$row["Name"]."`";
			} else {
				if($akt_size>0) echo '<a class="small" href="main.php?action=db&dbid='.$dbid.'&checkit='.urlencode($row["Name"]).'#dbid">check</a>';
				else echo "-";
			}
			echo '</td></tr>';
			if(isset($row["Update_time"])) if(strtotime($row["Update_time"])>strtotime($last_update)) $last_update=$row["Update_time"];
			$s1=$s1+$row["Rows"];
			$s2=$s2+$row["Data_length"]+$row["Index_length"];
		}
		echo '<tr class="hellblau"><td colspan="2"><strong>'.$lang["info_sum"].'</strong></td><td align="right"><strong>'.number_format($s1,0,",",".").'</strong></td><td align="right"><strong>'.number_format($s2,0,",",".").' Bytes</strong></td><td style="color:#006600;"><strong>'.$last_update.'</strong></td>';
		echo '<td class="hellblau" colspan="2">&nbsp;</td></tr></table>';
	}
	$edb=$lang["info_emptydb1"].' `'.$databases["Name"][$dbid].'` '.$lang["info_emptydb2"];
	$kdb=$lang["info_emptydb1"].' `'.$databases["Name"][$dbid].'` '.$lang["info_killdb"];

	echo '<form action="main.php?action=db#dbid" method="post"><table><tr>';
	if($numrows>0) echo '<td><input class="Formbutton2" type="submit" name="empty'.$dbid.'" value="'.$lang["clear_database"].'" onclick="if (!confirm(\''.$edb.'\')) return false;"></td>';
	echo '<td><input class="Formbutton2" type="submit" name="kill'.$dbid.'" value="'.$lang["delete_database"].'" onclick="if (!confirm(\''.$kdb.'\')) return false;"></td>';
	if($numrows>0) {
		echo '<td><input class="Formbutton2" type="submit" name="optimize'.$dbid.'" value="'.$lang["optimize_databases"].'"></td>';
		echo '<td><input class="Formbutton2" type="submit" name="check'.$dbid.'" value="'.$lang["check_tables"].'"></td>';
	}
	echo '</tr></table>';
}
include("inc/footer.php");


?>
