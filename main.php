<?php
include_once ( './inc/header.php' );
include_once ( './inc/runtime.php' );
include_once ( './language/' . $config['language'] . '/lang_main.php' );
echo MSDHeader();
//vars
$td='<td>';
$action=( isset($_GET['action']) ) ? $_GET['action'] : "status";
$checkit=( isset($_GET['checkit']) ) ? urldecode($_GET['checkit']) : "";
$repair=( isset($_GET['repair']) ) ? $_GET['repair'] : 0;

if ($action == "deletehtaccess")
{
	@unlink($config['paths']['root'] . '.htaccess');
	@unlink($config['paths']['root'] . '.htpasswd');
	$action="status";
}

$is_htaccess=( file_exists("./.htaccess") );
if ($is_htaccess) $htaccess_exist=file(".htaccess");
$dba=$hta_dir=$Overwrite=$msg="";

//MySQL-Verbindung herstellen
MSD_mysql_connect();

if (isset($_POST['htaccess']) || $action == "schutz")
{
	if ($is_htaccess) $Overwrite='<p class="error">' . $lang['htaccess8'] . '</p>';
	$cry_txt=array(
					
					$lang['htaccess5'], 
					$lang['htaccess6'], 
					$lang['htaccess7']
	);
	$step=( isset($_POST['step']) ) ? $_POST['step'] : 0;
	$cryptart=( isset($_POST['cryptart']) ) ? $_POST['cryptart'] : 0;
	$uname=( isset($_POST['username']) ) ? $_POST['username'] : "";
	$upass1=( isset($_POST['userpass1']) ) ? $_POST['userpass1'] : "";
	$upass2=( isset($_POST['userpass2']) ) ? $_POST['userpass2'] : "";
	
	if ($step == 1)
	{
		$msg="";
		if ($uname == "") $msg=$lang['htaccess9'];
		if (( $upass1 != $upass2 ) || ( $upass1 == "" )) $msg.=$lang['htaccess10'];
		if ($msg != "")
		{
			$msg='<p class="error">' . $msg . '</p>';
			$step=0;
		}
		else
		{
			$msg='<p class="success">' . $lang['htaccess11'] . '</p>';
		}
	}
	elseif ($step == 2)
	{
		$htaccess="AuthName \"MySQLDumper\"\nAuthType Basic\nAuthUserFile \"" . $config['paths']['root'] . ".htpasswd\"\nrequire valid-user\n";
		if ($cryptart == 0) $userpass=crypt($upass1,CRYPT_STD_DES);
		elseif ($cryptart == 1) $userpass=md5($upass1);
		else $userpass=$upass1;
		$htpasswd=$uname . ":" . $userpass;
		@chmod($config['paths']['root'],0777);
		
		if ($file_htpasswd=@fopen(".htpasswd","w"))
		{
			fputs($file_htpasswd,$htpasswd);
			fclose($file_htpasswd);
			$file_htaccess=@fopen(".htaccess","w");
			fputs($file_htaccess,$htaccess);
			fclose($file_htaccess);
			$msg=$lang['htaccess12'] . '<br><br><br><pre><b>' . $lang['htaccess13'] . ' .htaccess:</b>' . "\n" . htmlspecialchars($htaccess) . '</pre><br><br><pre><b>' . $lang['htaccess13'] . ' .htpasswd:</b>' . "\n" . htmlspecialchars($htpasswd) . "</pre>";
			@chmod($config['paths']['root'],0755);
		}
		else
		{
			$msg='<p class="error">' . $lang['htaccess14'] . '</p><br><pre><b>' . $lang['htaccess13'] . ' .htaccess:</b>' . "\n" . htmlspecialchars($htaccess) . '</pre><br><br><pre><b>' . $lang['htaccess13'] . ' .htpasswd:</b>' . "\n" . htmlspecialchars($htpasswd) . '</pre>';
		}
	}
	
	//Ausgabe
	echo headline($lang['htaccess1']) . $Overwrite;
	if ($step < 2)
	{
		
		if ($step == 0)
		{
			$un='<input type="text" name="username" size="25" value="' . $uname . '" class="Formtext">';
			$p1='<input type="password" name="userpass1" size="25" class="Formtext">';
			$p2='<input type="password" name="userpass2" size="25" class="Formtext">';
			$cry='<input class="radio" type="radio" name="cryptart" value="0"' . ( ( $cryptart == 0 ) ? " CHECKED" : "" ) . '>' . $cry_txt[0] . '&nbsp;&nbsp;';
			$cry.='<input class="radio" type="radio" name="cryptart" value="1"' . ( ( $cryptart == 1 ) ? " CHECKED" : "" ) . '>' . $cry_txt[1] . '&nbsp;&nbsp;';
			$cry.='<input class="radio" type="radio" name="cryptart" value="2"' . ( ( $cryptart == 2 ) ? " CHECKED" : "" ) . '>' . $cry_txt[2] . '&nbsp;&nbsp;';
		
		}
		else
		{
			$un=$uname . '<input type="hidden" name="username" value="' . $uname . '">';
			$p1='***************<input type="hidden" name="userpass1" value="' . $upass1 . '">';
			$p2='***************<input type="hidden" name="userpass2" value="' . $upass2 . '">';
			$cry='<input type="hidden" name="cryptart" value="' . $cryptart . '">' . $cry_txt[$cryptart];
		}
		echo $msg . '<br><form method="post" action="main.php?action=schutz">';
		echo '<input type="hidden" name="step" value="' . ( $step + 1 ) . '">';
		echo '<table class="bdr"><tr><td>Name</td><td>' . $un . '</td></tr><tr><td>' . $lang['htaccess2'] . '</td><td>' . $p1 . '</td></tr><tr><td>' . $lang['htaccess3'] . '</td><td>' . $p2 . '</td></tr><tr><td colspan="2">' . $lang['htaccess4'] . ' ' . $cry . '</td></tr><tr><td align="center" colspan="2"><br><input type="submit" class="Formbutton" name="htaccess" value="' . $lang['htaccess1'] . '"></td></tr></table>';
		echo '</form>';
	
	}
	else
		echo $msg;
	echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
	include ( "inc/footer.php" );
	die();

}

if ($action == "edithtaccess")
{
	$htaccessdontexist=0;
	
	if (( isset($_GET['create']) && $_GET['create'] == 1 ) || ( isset($_POST['create']) && $_POST['create'] == 1 ))
	{
		$fp=fopen("$hta_dir.htaccess","w");
		fwrite($fp,"# created by MySQLDumper " . MSD_VERSION . "\n");
		fclose($fp);
	}
	if (isset($_POST['newload']))
	{
		$hta_dir=( isset($_POST['newhtadir']) ) ? $_POST['newhtadir'] : "";
	}
	else
		$hta_dir=( isset($_POST['hta_dir']) ) ? $_POST['hta_dir'] : "";
	if ($hta_dir != "" && substr($hta_dir,-1) != "/") $hta_dir.="/";
	
	if (isset($_POST['submit']) && isset($_POST['thta']))
	{
		$fp=fopen("$hta_dir.htaccess","w");
		fwrite($fp,$_POST['thta']);
		fclose($fp);
	}
	if (file_exists("$hta_dir.htaccess"))
	{
		$htaccess_exist=file("$hta_dir.htaccess");
	}
	else
	{
		$htaccessdontexist=1;
	}
	
	echo headline($lang['htaccess16']);
	echo $lang['htaccess32'];
	echo '<form name="ehta" action="main.php?action=edithtaccess" method="post">File: <input type="text" name="newhtadir" value="' . $hta_dir . '" style="text-align:right;">.htaccess&nbsp;&nbsp;&nbsp;<input type="submit" name="newload" value=" ' . $lang['htaccess19'] . ' " class="Formbutton">';
	if ($htaccessdontexist != 1)
	{
		echo '<table class="bdr"><tr><td style="width:70%;"><textarea rows="25" cols="40" name="thta" id="thta">' . htmlspecialchars(implode("",$htaccess_exist)) . '</textarea><br><br>';
		echo '</td><td valign="top">';
		//Presets
		echo '<h6>Presets</h6><p><strong>' . $lang['htaccess30'] . '</strong><p>
		<a href="javascript:insertHTA(1,document.ehta.thta)">all-inkl</a><br>

		<br><p><strong>' . $lang['htaccess31'] . '</strong></p>
		<a href="javascript:insertHTA(101,document.ehta.thta)">' . $lang['htaccess20'] . '</a><br>
		<a href="javascript:insertHTA(102,document.ehta.thta)">' . $lang['htaccess21'] . '</a><br>
		<a href="javascript:insertHTA(103,document.ehta.thta)">' . $lang['htaccess22'] . '</a><br>
		<a href="javascript:insertHTA(104,document.ehta.thta)">' . $lang['htaccess23'] . '</a><br>
		<a href="javascript:insertHTA(105,document.ehta.thta)">' . $lang['htaccess24'] . '</a><br>
		<a href="javascript:insertHTA(106,document.ehta.thta)">' . $lang['htaccess25'] . '</a><br>
		<a href="javascript:insertHTA(107,document.ehta.thta)">' . $lang['htaccess26'] . '</a><br>
		<a href="javascript:insertHTA(108,document.ehta.thta)">' . $lang['htaccess27'] . '</a><br>
		<a href="javascript:insertHTA(109,document.ehta.thta)">' . $lang['htaccess28'] . '</a><br>
		<br><a href="http://httpd.apache.org/docs/2.0/mod/directives.html" target="_blank">' . $lang['htaccess29'] . '</a>';
		echo '</td></tr><tr><td colspan="2">' . $lang['htaccess18'] . '<input type="text" name="hta_dir" size="60" value="' . $hta_dir . '"></td></tr><tr><td colspan="2">';
		echo '<input type="submit" class="Formbutton" name="submit" value=" ' . $lang['save'] . ' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
		echo '<input type="reset" class="Formbutton" name="reset" value=" ' . $lang['reset'] . ' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
		echo '</td></tr></table></form>';
	}
	else
	{
		echo '<p class="warnung">' . $hta_dir . '.htaccess existiert nicht. Soll sie erstellt werden ?</p>';
		echo '<form action="" method="post"><input type="hidden" name="hta_dir" value="' . $hta_dir . '"><input type="hidden" name="create" value="1"><input type="submit" name="createhtaccess" value="erstellen"></form>';
	}
	echo '<br><a href="main.php">' . $lang['back'] . '</a>';
	exit();
}

if ($action == "phpinfo")
{
	phpinfo();
	echo '<p align="center"><a href="main.php">Home</a></p>';
	exit();
}

if ($action == "db")
{
	for ($i=0; $i < count($databases['Name']); $i++)
	{
		if (isset($_POST['empty' . $i]))
		{
			EmptyDB($databases['Name'][$i]);
			$dba='<p class="green">' . $lang['db'] . " " . $databases['Name'][$i] . " " . $lang['info_cleared'] . "</p>";
			break;
		}
		if (isset($_POST['kill' . $i]))
		{
			$res=mysql_query("DROP DATABASE `" . $databases['Name'][$i] . "`") or die(mysql_error() . "");
			$dba='<p class="green">' . $lang['db'] . " " . $databases['Name'][$i] . " " . $lang['info_deleted'] . "</p>";
			SetDefault();
			include ( $config['files']['parameter'] );
			echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';
			break;
		}
		if (isset($_POST['optimize' . $i]))
		{
			mysql_select_db($databases['Name'][$i],$config['dbconnection']);
			$res=mysql_list_tables($databases['Name'][$i],$config['dbconnection']);
			$tabellen='';
			WHILE ($row=mysql_fetch_row($res))
				$tabellen.='`' . $row[0] . '`,';
			$tabellen=substr($tabellen,0,( strlen($tabellen) - 1 ));
			if ($tabellen > "")
			{
				$query="OPTIMIZE TABLE " . $tabellen;
				$res=mysql_query($query) or die(mysql_error() . "");
			}
			$_GET['dbid']=$i;
			$dba='<p class="green">' . $lang['db'] . ' <b>' . $databases['Name'][$i] . '</b> ' . $lang['info_optimized'] . '.</p>';
			break;
		}
		if (isset($_POST['check' . $i]))
		{
			$checkit="ALL";
			$_GET['dbid']=$i;
		}
	}
}

//Hier beginnt die Ausgabe
echo headline('Home');
echo '<ul id="topnavi">';
echo '<li><a href="main.php?action=status" title="' . $lang['Statusinformationen'] . '"><span>» </span>' . $lang['Statusinformationen'] . '</a></li>';
echo '<li><a href="main.php?action=db" title="' . $lang['dbs'] . '"><span>» </span>' . $lang['dbs'] . '</a></li>';
echo '<li><a href="main.php?action=vars" title="' . $lang['mysqlvars'] . '"><span>» </span>' . $lang['mysqlvars'] . '</a></li>';
echo '<li><a href="main.php?action=sys" title="' . $lang['mysqlsys'] . '"><span>» </span>' . $lang['mysqlsys'] . '</a></li>';
echo '</ul><br style="clear: left">';

if ($action == "status")
{
	//Infos ueber Backups
	$Sum_Files=$Sum_Size=0;
	$Last_BU=Array();
	$sm=( $config['safe_mode'] == 1 ) ? "  (Safemode)" : "";
	
	$dh=opendir($config['paths']['backup']);
	while (false !== ( $filename=readdir($dh) ))
	{
		if ($filename != "." && $filename != ".." && !is_dir($config['paths']['backup'] . $filename))
		{
			$files[]=$filename;
			$Sum_Files++;
			$Sum_Size+=filesize($config['paths']['backup'] . $filename);
			$ft=filectime($config['paths']['backup'] . $filename);
			if (!isset($Last_BU[2]) || ( isset($Last_BU[2]) && $ft > $Last_BU[2] ))
			{
				$Last_BU[0]=$filename;
				$Last_BU[1]=date("d.m.Y H:i",$ft);
				$Last_BU[2]=$ft;
			}
		}
	}
	
	$status='<h5>' . $lang['Statusinformationen'] . '</h5>';
	$status.=DirectoryWarnings();
	//Versionen
	$status.='<h6>' . $lang['Versionsinformationen'] . '</h6>';
	$status.='<img src="css/' . $config['theme'] . '/pics/loveyourdata.gif" align="right" alt="love your data" title="love your data">';
	
	$status.='MySQLDumper-Version: <strong>' . MSD_VERSION . '</strong><br>';
	$status.='OS: <strong>' . MSD_OS . '</strong> (' . MSD_OS_EXT . ')<br>';
	$status.='MySQL-Version: <strong>' . MSD_MYSQL_VERSION . '</strong><br>';
	$status.='PHP-Version: <strong>' . PHP_VERSION . '</strong> Speicher: <strong>' . $config['php_ram'] . ' MB</strong> ' . ( ( $config['zlib'] ) ? '' : '<span class="error">&nbsp;&nbsp;' . $lang['phpbug'] . '.&nbsp;&nbsp;</span>' ) . $sm . '&nbsp;&nbsp;';
	$status.='Max Execution Time: <strong>' . $config['max_execution_time'] . '&nbsp;sec.</strong>&nbsp;&nbsp;<a style="text-decoration:underline;" href="main.php?action=phpinfo">[PHP-Info]</a>&nbsp;&nbsp;';
	$status.='<br>PHP-Extensions: <span class="small">' . $config['phpextensions'] . '</span><br clear="all">';
	
	if ($config['disabled'] != "") $status.='<br>' . $lang['disabledfunctions'] . ': <span class="small">' . str_replace(',',', ',$config['disabled']) . '</span>';
	if (!extension_loaded("ftp")) $status.='<br><span class="error">' . $lang['noftppossible'] . '</span>';
	if (!$config['zlib']) $status.='&nbsp;&nbsp;&nbsp;<span class="error"><br>' . $lang['nogzpossible'] . '</span>';
	
	//MySQLDumper Informationen
	$status.='<h6>' . $lang['MySQL Dumper Informationen'] . '</h6>' . $lang['info_location'] . ' "<b>' . $_SERVER['SERVER_NAME'] . '</b>" (' . ( $config['paths']['root'] ) . ')<br>';
	$status.=$lang['info_actdb'] . ":<strong> " . $databases['db_actual'] . "</strong><br>";
	if ($is_htaccess)
	{
		$status.='<a href="main.php?action=edithtaccess">' . $lang['htaccess16'] . '</a>';
		$status.='&nbsp;<a href="main.php?action=deletehtaccess">' . $lang['delete_htaccess'] . '</a>';
	}
	else
	{
		$status.='<a href="main.php?action=schutz">' . $lang['htaccess1'] . '</a>&nbsp;&nbsp;<span class="error">' . $lang['htaccess15'] . '</span>';
	}
	//History
	$status.='<br><h6>History</h6>' . $lang['backupfilesanzahl'] . ' <strong>' . $Sum_Files . '</strong> Backups (<strong>' . byte_output($Sum_Size) . '</strong>)<br>';
	
	$status.=$lang['fm_freespace'] . ': <strong>' . MD_FreeDiskSpace() . '</strong><br>';
	if ($Sum_Files > 0) $status.=$lang['lastbackup'] . ' ' . $lang['vom'] . ' <strong><span class="small">' . ( ( isset($Last_BU[1]) ) ? $Last_BU[1] : " - " ) . '</span></strong><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . ( ( isset($Last_BU[1]) ) ? '<a href="' . $config['paths']['backup'] . $Last_BU[0] . '">' : " - " ) . '<strong>' . ( ( isset($Last_BU[0]) ) ? $Last_BU[0] : " - " ) . '</strong></a><br>';
	echo $status;
}
elseif ($action == "db")
{
	
	//Datenbanken
	echo '<h5>' . $lang['info_databases'] . '</h5><div style="padding-left:10px; font-weight:bold;">';
	echo $dba . '<table class="bdr">';
	echo '<tr class="thead"><td>' . $lang['dbs'] . '</td><td>' . $lang['tables'] . '</td></tr>';
	if (!isset($config['dbconnection'])) MSD_mysql_connect();
	
	for ($i=0; $i < count($databases['Name']); $i++)
	{
		//gibts die Datenbank überhaupt?
		if (!mysql_select_db($databases['Name'][$i],$config['dbconnection']))
		{
			echo '<tr><td>' . $databases['Name'][$i] . '</td><td colspan="3">' . $lang['info_nodb'] . '</td>';
		}
		else
		{
			mysql_select_db($databases['Name'][$i],$config['dbconnection']);
			$tabellen=mysql_query("SHOW TABLES FROM `" . $databases['Name'][$i] . "`",$config['dbconnection']);
			$num_tables=mysql_num_rows($tabellen);
			$cl=( $i % 2 ) ? "dbrow" : "dbrow1";
			if ($i == $databases['db_selected_index']) $cl="dbrowsel";
			echo '<tr class="' . $cl . '"><td><a href="main.php?action=db&amp;dbid=' . $i . '#dbid">';
			echo ( $i == $databases['db_selected_index'] ) ? "<strong>" . $databases['Name'][$i] . "</strong>" : $databases['Name'][$i];
			echo '</a></td><td>' . $num_tables . ' ' . $lang['info_table1'];
			echo ( $num_tables > 1 ) ? $lang['info_table2'] : '';
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '<tr><td colspan="2" align="center"><br><input type="button" class="Formbutton" onclick="location.href=\'sql.php?context=3\'" value="' . $lang['create_database'] . '"><br><br></td></tr></table>';
	echo '</div>';
}
elseif ($action == "sys")
{
	$sysaction=( isset($_GET['dosys']) ) ? $_GET['dosys'] : 0;
	$msg="";
	$res=@mysql_query("SHOW VARIABLES LIKE 'datadir'",$config['dbconnection']);
	if ($res)
	{
		$row=mysql_fetch_array($res);
		$data_dir=$row[1];
	}
	switch ($sysaction)
	{
		case 1: //FLUSH PRIVILEGES
			$msg="&gt; operating FLUSH PRIVILEGES<br>";
			$res=@mysql_query("FLUSH PRIVILEGES",$config['dbconnection']);
			$meldung=mysql_error($config['dbconnection']);
			if ($meldung != "")
			{
				$msg.='&gt; MySQL-Error: ' . $meldung;
			}
			else
			{
				$msg.="&gt; Privileges were reloaded.";
			}
			break;
		case 2: //FLUSH STATUS
			$msg="&gt; operating FLUSH STATUS<br>";
			$res=@mysql_query("FLUSH STATUS",$config['dbconnection']);
			$meldung=mysql_error($config['dbconnection']);
			if ($meldung != "")
			{
				$msg.='&gt; MySQL-Error: ' . $meldung;
			}
			else
			{
				$msg.="&gt; Status was reset.";
			}
			break;
		case 3: //FLUSH HOSTS
			$msg="&gt; operating FLUSH HOSTS<br>";
			$res=@mysql_query("FLUSH HOSTS",$config['dbconnection']);
			$meldung=mysql_error($config['dbconnection']);
			if ($meldung != "")
			{
				$msg.='&gt; MySQL-Error: ' . $meldung;
			}
			else
			{
				$msg.="&gt; Hosts were reloaded.";
				;
			}
			break;
		case 4: //SHOW MASTER LOGS
			$msg="> operating SHOW MASTER LOGS<br>";
			$res=@mysql_query("SHOW MASTER LOGS",$config['dbconnection']);
			$meldung=mysql_error($config['dbconnection']);
			if ($meldung != "")
			{
				$msg.='&gt; MySQL-Error: ' . $meldung;
			}
			else
			{
				$numrows=mysql_num_rows($res);
				if ($numrows == 0 || $numrows === false)
				{
					$msg.='&gt; there are no master log-files';
				}
				else
				{
					$msg.='&gt; there are ' . $numrows . ' logfiles<br>';
					for ($i=0; $i < $numrows; $i++)
					{
						$row=mysql_fetch_row($res);
						$msg.='&gt; ' . $row[0] . '&nbsp;&nbsp;&nbsp;' . ( ( $data_dir ) ? byte_output(@filesize($data_dir . $row[0])) : '' ) . '<br>';
					}
				}
			}
			break;
		case 5: //RESET MASTER
			$msg="&gt; operating RESET MASTER<br>";
			$res=@mysql_query("RESET MASTER",$config['dbconnection']);
			$meldung=mysql_error($config['dbconnection']);
			if ($meldung != "")
			{
				$msg.='&gt; MySQL-Error: ' . $meldung;
			}
			else
			{
				$msg.="&gt; All Masterlogs were deleted.";
			}
			break;
	}
	echo '<h5>' . $lang['mysqlsys'] . '</h5>';
	echo '<div id="hormenu"><ul>
			<li><a href="main.php?action=sys&amp;dosys=1">Reload Privileges</a></li>
			<li><a href="main.php?action=sys&amp;dosys=2">Reset Status</a></li>
			<li><a href="main.php?action=sys&amp;dosys=3">Reload Hosts</a></li>
			<li><a href="main.php?action=sys&amp;dosys=4">Show Log-Files</a></li>
			<li><a href="main.php?action=sys&amp;dosys=5">Reset Master-Log</a></li>
			</ul></div>';
	echo '<div align="center" class="MySQLbox">';
	echo '&gt; MysSQL Dumper v' . MSD_VERSION . ' - Output Console<br><br>';
	echo ( $msg != "" ) ? $msg : '> waiting for operation ...<br>';
	echo '</div>';
}
elseif ($action == "vars")
{
	$var=( isset($_GET['var']) ) ? $_GET['var'] : "prozesse";
	$Titelausgabe=array(
						
						"variables" => $lang['Variabeln'], 
						"status" => $lang['Status'], 
						"prozesse" => $lang['Prozesse']
	);
	echo '<h5>' . $lang['mysqlvars'] . '</h5><strong>' . $Titelausgabe[$var] . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="main.php?action=vars&amp;var=prozesse">' . $lang['Prozesse'] . '</a>&nbsp;&nbsp;&nbsp;';
	echo '<a href="main.php?action=vars&amp;var=status">' . $lang['Status'] . '</a>&nbsp;&nbsp;&nbsp;';
	echo '<a href="main.php?action=vars&amp;var=variables">' . $lang['Variabeln'] . '</a>&nbsp;&nbsp;&nbsp;';
	
	echo '<p>&nbsp;</p>';
	//Variabeln
	switch ($var)
	{
		case "variables":
			$res=@mysql_query("SHOW variables");
			if ($res) $numrows=mysql_num_rows($res);
			if ($numrows == 0)
			{
				echo $lang['info_novars'];
			}
			else
			{
				echo '<table class="bdr"><tr class="thead"><th><strong>Name</strong></th><th><strong>' . $lang['Inhalt'] . '</strong></th></tr>';
				for ($i=0; $i < $numrows; $i++)
				{
					$row=mysql_fetch_array($res);
					$cl=( $i % 2 ) ? "dbrow" : "dbrow1";
					echo '<tr class="' . $cl . '"><td align="left">' . $row[0] . '</td><td  align="left">' . $row[1] . '</td></tr>';
				}
			}
			echo '</table>';
			break;
		case "status":
			$res=@mysql_query("SHOW STATUS");
			if ($res) $numrows=mysql_num_rows($res);
			if ($numrows == 0)
			{
				echo $lang['info_nostatus'];
			}
			else
			{
				echo '<table class="bdr"><tr class="thead"><th>Name</th><th>' . $lang['Inhalt'] . '</th></tr>';
				for ($i=0; $i < $numrows; $i++)
				{
					$cl=( $i % 2 ) ? "dbrow" : "dbrow1";
					$row=mysql_fetch_array($res);
					echo '<tr class="' . $cl . '"><td align="left" valign="top">' . $row[0] . '</td><td align="left" valign="top">' . $row[1] . '</td></tr>';
				}
			}
			echo '</table>';
			break;
		case "prozesse":
			if ($config['processlist_refresh'] < 1000) $config['processlist_refresh']=2000;
			if (isset($_GET['killid']) && $_GET['killid'] > 0)
			{
				$killid=( isset($_GET['killid']) ) ? $_GET['killid'] : 0;
				$wait=( isset($_GET['wait']) ) ? $_GET['wait'] : 0;
				if ($wait == 0)
				{
					$ret=mysql_query("KILL " . $_GET['killid']);
					$wait=2;
				}
				else
					$wait+=2;
				
				if ($wait == 0)
				{
					echo '<p class="success">' . $lang['processkill1'] . $_GET['killid'] . $lang['processkill2'] . $ret . '</p>';
				}
				else
				{
					echo '<p class="success">' . $lang['processkill3'] . $wait . $lang['processkill4'] . $_GET['killid'] . $lang['processkill2'] . $ret . '</p>';
				}
			
			}
			
			$killid=$wait=0;
			$res=@mysql_query("SHOW FULL PROCESSLIST ");
			if ($res) $numrows=mysql_num_rows($res);
			if ($numrows == 0)
			{
				echo $lang['info_noprocesses'];
			}
			else
			{
				echo '<table class="bdr" style="width:100%"><tr class="thead"><th>ID</th><th>User</th><th>Host</th><th>DB</th><th>Command</th><th>Time</th><th>State</th><th width="800">Info</th><th nowrap="nowrap">RT: ' . round($config['processlist_refresh'] / 1000) . ' sec</th></tr>';
				for ($i=0; $i < $numrows; $i++)
				{
					$cl=( $i % 2 ) ? "dbrow" : "dbrow1";
					$row=mysql_fetch_array($res);
					echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[5] . '</td>
					<td>' . $row[6] . '</td><td>' . $row[7] . '</td>
					<td><a href="main.php?action=vars&amp;var=prozesse&amp;killid=' . $row[0] . '">kill</a></td></tr>';
					if ($row[0] == $killid && $row[4] == "Killed")
					{
						$wait=$killid=0;
					}
				}
			}
			echo '</table>';
			echo '<form name="f" method="get" action="main.php">
			<input type="hidden" name="wait" value="' . $wait . '">
			<input type="hidden" name="killid" value="' . $killid . '">
			<input type="hidden" name="action" value="vars">
			<input type="hidden" name="var" value="prozesse"></form>';
			echo '<script language="JavaScript" type="text/javascript">window.setTimeout("document.f.submit();","' . $config['processlist_refresh'] . '");</script>';
			
			break;
	}
}

//Datenbankdetails
if (isset($_GET['dbid']))
{
	$dbid=$_GET['dbid'];
	echo '<a name="dbid"></a><h5>' . $lang['info_dbdetail'] . '"' . $databases['Name'][$dbid] . '"</h5>';
	
	$res=@mysql_query("SHOW TABLE STATUS FROM `" . $databases['Name'][$dbid] . "`");
	mysql_select_db($databases['Name'][$dbid]);
	if ($res) $numrows=mysql_num_rows($res);
	if ($numrows == 0)
	{
		echo $lang['info_dbempty'];
	
	}
	else
	{
		echo $numrows . ' ' . $lang['info_table1'];
		echo ( $numrows > 1 ) ? $lang['info_table2'] : '';
		echo "\n" . '<br><table class="bdr" class="small"><tr class="thead"><th>Nr.</th><th>' . $lang['info_table1'] . '</th><th>' . $lang['info_records'] . '</th><th>' . $lang['info_size'] . '</th><th>' . $lang['info_lastupdate'] . '</th><th>' . $lang['info_optimized'] . '</th><th>Status</th>' . '</tr>' . "\n";
		$last_update="2000-01-01 00:00:00";
		$s=$s1=$s2="";
		for ($i=0; $i < $numrows; $i++)
		{
			$row=mysql_fetch_array($res);
			
			// Get nr of records -> need to do it this way because of incorrect returns when using InnoDBs
			$sql_2="SELECT count(*) as `count_records` FROM `" . $databases['Name'][$dbid] . "`.`" . $row['Name'] . "`";
			$res2=@mysql_query($sql_2);
			if ($res2 === false)
			{
				echo "\n" . '<tr class="dbrowsel">';
				echo '<td align="right">' . ( $i + 1 ) . '</td><td><a href="sql.php?db=' . $databases['Name'][$dbid] . '&amp;tablename=' . urlencode($row['Name']) . '&amp;dbid=' . $dbid . '">' . $row['Name'] . '</a></td><td colspan="3">' . $lang['unknown_number_of_records'] . '</td><td>';
				echo '<img src="' . $config['files']['iconpath'] . 'notok.gif" alt="" width="12" height="12" border="0">&nbsp;' . $lang['no'] . '&nbsp;<img src="' . $config['files']['iconpath'] . '/notok.gif" alt="" width="12" height="12" border="0">';
				$akt_size=0;
			}
			else
			{
				$row2=mysql_fetch_array($res2);
				$row['Rows']=$row2['count_records'];
				
				$akt_size=$row['Data_length'] + $row['Index_length'];
				$cl=( $i % 2 ) ? 'dbrow' : 'dbrow1';
				echo "\n" . '<tr class="' . $cl . '">';
				echo '<td align="right">' . ( $i + 1 ) . '</td><td><a href="sql.php?db=' . $databases['Name'][$dbid] . '&amp;tablename=' . urlencode($row['Name']) . '&amp;dbid=' . $dbid . '">' . $row['Name'] . '</a></td><td style="text-align:right">' . number_format($row['Rows'],0,",",".") . '</td><td style="text-align:right;">' . byte_output($akt_size) . '</td><td>&nbsp;' . $row['Update_time'] . '</td><td align="center">';
				if ($row['Data_free'] == 0) echo '<img src="' . $config['files']['iconpath'] . 'ok.gif" alt="" width="12" height="12" border="0">';
				else echo '<img src="' . $config['files']['iconpath'] . 'notok.gif" alt="" width="12" height="12" border="0">&nbsp;' . $lang['no'] . '&nbsp;<img src="' . $config['files']['iconpath'] . '/notok.gif" alt="" width="12" height="12" border="0">';
				echo '</td>';
			}
			
			echo '<td align="center">';
			if ($checkit == $row['Name'] || $repair == 1)
			{
				$tmp_res=mysql_query("REPAIR TABLE `" . $row['Name'] . "`");
			}
			if (( $checkit == $row['Name'] || $checkit == "ALL" )) // && $akt_size>0)
			{
				$tmp_res=mysql_query("CHECK TABLE `" . $row['Name'] . "`");
				if ($tmp_res)
				{
					$tmp_row=mysql_fetch_row($tmp_res);
					if ($tmp_row[3] != 'OK') echo $tmp_row[3] . '<br>';
					echo ( $tmp_row[3] == "OK" ) ? '<img src="' . $config['files']['iconpath'] . 'ok.gif" alt="" width="12" height="12" border="0">' : '<a href="main.php?action=db&amp;dbid=' . $dbid . '&amp;checkit=' . urlencode($row['Name']) . '&amp;repair=1#dbid"><img src="' . $config['files']['iconpath'] . '/notok.gif" alt="" width="12" height="12" border="0">&nbsp;repair&nbsp;<img src="' . $config['files']['iconpath'] . '/notok.gif" alt="" width="12" height="12" border="0"></a>';
				}
				else
					echo "CHECK TABLE `" . $row['Name'] . "`";
			}
			else
			{
				if ($akt_size > 0) echo '<a href="main.php?action=db&amp;dbid=' . $dbid . '&amp;checkit=' . urlencode($row['Name']) . '#dbid">check</a>';
				else echo "-";
			}
			echo '</td></tr>';
			if (isset($row['Update_time'])) if (strtotime($row['Update_time']) > strtotime($last_update)) $last_update=$row['Update_time'];
			$s1=$s1 + $row['Rows'];
			$s2=$s2 + $row['Data_length'] + $row['Index_length'];
		}
		echo '<tr class="dbrowsel"><td colspan="2">' . $lang['info_sum'] . '</td><td style="text-align:right">' . number_format($s1,0,",",".") . '</td><td style="text-align:right">' . byte_output($s2) . '</td><td>' . $last_update . '</td>';
		echo '<td colspan="2">&nbsp;</td></tr></table>';
	}
	$edb=$lang['info_emptydb1'] . ' `' . $databases['Name'][$dbid] . '` ' . $lang['info_emptydb2'];
	$kdb=$lang['info_emptydb1'] . ' `' . $databases['Name'][$dbid] . '` ' . $lang['info_killdb'];
	
	echo '<br><form action="main.php?action=db#dbid" method="post">';
	if ($numrows > 0) echo '<input class="Formbutton" type="submit" name="empty' . $dbid . '" value="' . $lang['clear_database'] . '" onclick="if (!confirm(\'' . $edb . '\')) return false;">';
	echo '<input class="Formbutton" type="submit" name="kill' . $dbid . '" value="' . $lang['delete_database'] . '" onclick="if (!confirm(\'' . $kdb . '\')) return false;">';
	if ($numrows > 0)
	{
		echo '<input class="Formbutton" type="submit" name="optimize' . $dbid . '" value="' . $lang['optimize_databases'] . '">';
		echo '<input class="Formbutton" type="submit" name="check' . $dbid . '" value="' . $lang['check_tables'] . '">';
	}
	echo '</div>';
}
echo MSDFooter();
;

?>