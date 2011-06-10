<?
	if($_GET["action"]=="phpinfo") {
		phpinfo();
		echo '<p align="center"><a href="../index.php">Home</a></p>';
		die;
	}
	
	$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()."");
		
	if($_GET["action"]=="db") {
		for($i=0;$i<count($dbname_a);$i++) {
			if(isset($_POST["empty".$i])) {
				$res=mysql_query("DROP DATABASE `$dbname_a[$i]`") or die(mysql_error()."");
				$res=mysql_query("CREATE DATABASE `$dbname_a[$i]`") or die(mysql_error()."");
				$dba= $l["db"]." $dbname_a[$i] ".$l["info_cleared"]."<br>";
				break;
			}
			if(isset($_POST["kill".$i])) {
				$res=mysql_query("DROP DATABASE `$dbname_a[$i]`") or die(mysql_error()."");
				$dba= $l["db"]." $dbname_a[$i] ".$l["info_deleted"]."<br>";
				SetDefault(true);
				echo '<script language="JavaScript">parent.menu.location.href="menu.php";</script>';
				break;
			}		
		}
	}
		
	if($_GET["action"]=="newdb") {
		if($_POST["dbneu"]!="" && isset($_POST["submit"])) {
			$res=mysql_query("CREATE DATABASE `".$_POST["dbneu"]."`") or die(mysql_error()."");
			$dba=$l["db"]." '".$_POST["dbneu"]."' ".$l["info_created"]."<br>";
			SetDefault(true);
			echo '<script language="JavaScript">parent.menu.location.href="menu.php";</script>';
		}
	}
	
	$res=mysql_query("select version()");
	$row = mysql_fetch_array($res);
	echo 'PHP-Version: <strong>'.phpversion().'</strong> <a style="text-decoration:underline;" href="inc/info.php?action=phpinfo">[Info]</a><br>';
	echo 'MySQL-Version: <strong>'.$row[0].'</strong><br>';
	
	echo $l["info_location"].' "<b>'.$_SERVER["SERVER_NAME"].'</b>" ('.$_SERVER["DOCUMENT_ROOT"].').<br>';
	
	echo $l["info_workdir"].": <b>$work</b><br>";
	echo $l["info_backupdir"].": <b>$backup_path</b><br>";
	echo $l["info_actdb"].":<strong> $dbname</strong><br>";
	
	echo '<hr><h4>'.$l["info_databases"].'</h4><div style="padding-left:10px; font-weight:bold;">';
	echo $dba.'<table border="2" cellpadding="2" cellspacing="2" width="70%">';
	
	for($i=0;$i<count($dbname_a);$i++) {
		//gibts die Datenbank überhaupt?
		if (!mysql_select_db($dbname_a[$i],$conn)) {
			echo '<tr><td>'.$dbname_a[$i].'</td><td colspan="3">'.$l["info_nodb"].'</td>';
		} else {
			mysql_select_db($dbname_a[$i],$conn);
			$tabellen = mysql_list_tables($dbname_a[$i],$conn); 
			$num_tables = mysql_num_rows($tabellen); 
			echo '<tr><td><a style="text-decoration:underline;" href="'.$PHP_SELF.'?dbid='.$i.'">'.$dbname_a[$i].'</a></td>';
			echo '<td>'.$num_tables.' '.$l["info_table1"];
			echo ($num_tables>1) ? $l["info_table2"] : '';
			echo '</td>';
			
			
			echo '</tr>';
		}
	}
	echo '</table>';
	
	echo '<form action="'.$PHP_SELF.'?action=newdb" method="post"><table border="1"><tr>';
	echo '<td>'.$l["create_database"].'</td><td><input type="text" name="dbneu" size="23" maxlength="50"></td><td><input class="Formbutton2" type="submit" name="submit" value="'.$l["button_create_database"].'"></td></tr></table></form>';
	echo '</div>';
	
	if (isset($_GET["dbid"]))
	{
		$dbid=$_GET["dbid"];
		echo '<hr><h4>'.$l["info_dbdetail"].'"'.$dbname_a[$dbid].'"</h4>';
		
		$res=mysql_query("SHOW TABLE STATUS FROM ".$dbname_a[$dbid]);
		$numrows=mysql_num_rows($res);
		if($numrows==0) {
			echo $l["info_dbempty"];
			
		} else {
			echo $numrows.' '.$l["info_table1"];
			echo ($numrows>1) ? $l["info_table2"] : '';
	
			echo '<br><table border="1"><tr><td class="hd">Nr.</td><td class="hd">'.$l["info_table1"].'</td><td class="hd">'.$l["info_records"].'</td><td class="hd">'.$l["info_size"].'</td><td class="hd">'.$l["info_lastupdate"].'</td></tr>';
			$last_update="2000-01-01 00:00:00";
			for ($i = 0; $i < $numrows; $i++) 
			{
		    	$row = mysql_fetch_array($res);
				echo '<tr><td align="right">'.($i+1).'</td><td>'.$row[Name].'</td><td align="right">'.number_format($row[Rows],0,",",".").'</td><td align="right">'.number_format($row[Data_length]+$row[Index_length],0,",",".").' Bytes</td><td style="color:#006600;">'.$row[Update_time].'</td></tr>';
				if(strtotime($row[Update_time])>strtotime($last_update)) $last_update=$row[Update_time];
				$s1=$s1+$row[Rows];
				$s2=$s2+$row[Data_length]+$row[Index_length];
			}
			echo '<tr class="hellblau"><td colspan="2"><strong>'.$l["info_sum"].'</strong></td><td align="right"><strong>'.number_format($s1,0,",",".").'</strong></td><td align="right"><strong>'.number_format($s2,0,",",".").' Bytes</strong></td><td style="color:#006600;"><strong>'.$last_update.'</strong></td></tr>';
			echo '</table>';
		}
		$edb=$l["info_emptydb1"].' `'.$dbname_a[$dbid].'` '.$l["info_emptydb2"];
		$kdb=$l["info_emptydb1"].' `'.$dbname_a[$dbid].'` '.$l["info_killdb"];
			
		echo '<form action="'.$PHP_SELF.'?action=db" method="post"><table><tr>';
		if($numrows>0) echo '<td><input class="Formbutton2" type="submit" name="empty'.$dbid.'" value="'.$l["clear_database"].'" onclick="if (!confirm(\''.$edb.'\')) return false;"></td>';
		echo '<td><input class="Formbutton2" type="submit" name="kill'.$dbid.'" value="'.$l["delete_database"].'" onclick="if (!confirm(\''.$kdb.'\')) return false;"></td>';
		echo '</tr></table>';
	}
	include("footer.php");
?>
