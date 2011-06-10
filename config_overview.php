<?php
include("inc/header.php");

if (isset($_POST["load"]))
{
	$msg=SetDefault();
	$msg=nl2br($msg)."<br>". $l["load_success"]."<br>";
	?>
			<script language="JavaScript">
			parent.menu.location.href="menu.php";
			</script>
	<?php
}

if (isset($_POST["save"]))
{
	//Parameter auslesen
	$dbpraefix=$_POST["dbpraefix"];
	$dbpraefix_a[$db_selected_index]=$dbpraefix;
	
	$dbcronpraefix=$_POST["dbcronpraefix"];
	$compression=$_POST["compression"];
	$lang=$_POST["lang"];
	$email[0]=$_POST["email0"]; 
	$email[1]=$_POST["email1"]; 
	$send_mail=$_POST["send_mail"];
	//$path=$_POST["path"];
	if(substr($path,strlen($path)-1,1)!="/") $path.="/";
	$auto_delete=$_POST["auto_delete"];
	$del_files_after_days=$_POST["del_files_after_days"];
	$max_backup_files=$_POST["max_backup_files"];
	$cron_timelimit=$_POST["cron_timelimit"];
	$cron_samedb=$_POST["cron_samedb"];
	$cron_dbindex=$_POST["cron_dbindex"];
	
	if($cron_samedb==0)$cron_dbindex=$db_selected_index;
	
	$ftp_transfer=$_POST["ftp_transfer"];
	$ftp_server=$_POST["ftp_server"];
	$ftp_port=$_POST["ftp_port"];
	$ftp_user=$_POST["ftp_user"];
	$ftp_pass=$_POST["ftp_pass"];
	$ftp_dir=$_POST["ftp_dir"];
	
	$anzahl_zeilen=$_POST["dumpz"];
	$anzahl_zeilen_restore=$_POST["restorez"];
	
	// und wegschreiben
	if (WriteParams()==true)
	{ 
		//neue Sprache? Dann Men&uuml; links auch aktualisieren
		if($_POST["lang_old"]!=$lang) 
		{
			?>
			<script language="JavaScript">
			parent.menu.location.href="menu.php";
			</script>
			<?php
		}
		//Parameter laden
		include($config_file);

		$msg.= $l["save_success"];
	} else $msg.= $l["save_error"];
}  


echo "<h3>".$l["config_headline"]."</h3>".$msg;


?>


<form method="POST" action="config_overview.php">


<?php
$td='<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">';
$a1.= '<div align="center"><table border="1"><tr>';

echo $a1;
echo $td.'<input class="Menubutton" name="load" type="submit" value="'.$l["load"].'"	onclick="if (!confirm(\''.$l["config_askload"].'\')) return false;"></td>';
echo '</tr></table></div>';
?>

<table border="1" cellpadding="0" cellspacing="0" align="center">
	<!--Zugangsdaten-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_databases"]; ?></td></tr>
<tr>
	<td valign="top"><?php echo Help($l["help_db"],"conf1").$l["list_db"];?></td>
	<td><div align="left" class="scrollbox">
<?php
		$datenbanken=count($dbname_a); 
		for($i=0;$i<$datenbanken;$i++) 
		{ 
    		$a=($i+1).". ".$dbname_a[$i].'<br>'; 
			if($i==$db_selected_index) $a='<strong>'.$a.'</strong>';
			echo $a;
		}
?> 
			</select></div>
		</td>
	</tr>	
	<tr><td><?php echo Help($l["help_praefix"],"conf2").$l["praefix"]; ?>:&nbsp;</td><td><input type="text" name="dbpraefix" value="<?php echo $dbpraefix; ?>"></td></tr>
	
	<!--sonstige Einstellungen-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_dumprestore"]; ?></td></tr>
	<tr>
		<td><?php echo Help($l["help_zip"],"conf3").$l["gzip"]; ?>:&nbsp;</td>
		<td>
			<input type="radio" value="1" name="compression" <?php echo($compression==1)?" checked":""?>><?php echo $l["activated"]; ?>
		    <input type="radio" value="0" name="compression"<?php echo($compression==0)?" checked":""?>><?php echo $l["not_activated"]; ?>
		</td>
	</tr>
	<tr>
 		<td><?php echo Help($l["help_dumpz"],"conf19").$l["dump_zeilen"]; ?>:&nbsp;</td>
		<td><input type="text" size="6" maxlength="6" name="dumpz" value="<?php echo $anzahl_zeilen; ?>"></td>
	</tr>	
	<tr>
 		<td><?php echo Help($l["help_restorez"],"conf20").$l["restore_zeilen"]; ?>:&nbsp;</td>
		<td><input type="text" size="6" maxlength="6" name="restorez" value="<?php echo $anzahl_zeilen_restore; ?>"></td>
	</tr>	
	<!-- <tr><td><?php echo Help($l["help_budir"],"conf4").$l["backup_dir"]; ?>:&nbsp;</td><td><input type="text" name="path" value="<?php echo $path; ?>"></td></tr>
	 -->
 	<!--Email-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_email"]; ?></td></tr>
	<tr>
		<td><?php echo Help($l["help_mail1"],"conf5").$l["send_mail_form"]; ?>:&nbsp;</td>
		<td>
			<input type="radio" value="1" name="send_mail"<?php echo($send_mail==1)?" checked":""?>><?php echo $l["activated"]; ?>
			<input type="radio" value="0" name="send_mail"<?php echo($send_mail==0)?" checked":""?>><?php echo $l["not_activated"]; ?>
		</td>
	</tr>
	<tr><td><?php echo Help($l["help_mail2"],"conf6").$l["email_adress"]; ?>:&nbsp;</td><td><input type="text" name="email0" value="<?php echo $email[0]; ?>" size="30"></td></tr>	
	<tr><td><?php echo Help($l["help_mail3"],"conf7").$l["email_subject"]; ?>:&nbsp;</td><td><input type="text" name="email1" value="<?php echo $email[1]; ?>" size="30"></td></tr>
	
	<!--FTP-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_ftp"]; ?></td></tr>
	<tr>
 		<td><?php echo Help($l["help_ftptransfer"],"conf13").$l["ftp_transfer"]; ?>:&nbsp;</td>
		<td>
			<input type="radio" value="1" name="ftp_transfer" <?php echo($ftp_transfer==1)?" checked":""?>><?php echo $l["activated"]; ?>
		    <input type="radio" value="0" name="ftp_transfer"<?php echo($ftp_transfer==0)?" checked":""?>><?php echo $l["not_activated"]; ?>
	</td>
	</tr>	
	<tr>
 		<td><?php echo Help($l["help_ftpserver"],"conf14").$l["ftp_server"]; ?>:&nbsp;</td>
		<td><input type="text" size="30" name="ftp_server" value="<?php echo $ftp_server; ?>"></td>
	</tr>	
	<tr>
 		<td><?php echo Help($l["help_ftpport"],"conf15").$l["ftp_port"]; ?>:&nbsp;</td>
		<td><input type="text" size="30" name="ftp_port" value="<?php echo $ftp_port; ?>"></td>
	</tr>		
	<tr>
 		<td><?php echo Help($l["help_ftpuser"],"conf16").$l["ftp_user"]; ?>:&nbsp;</td>
		<td><input type="text" size="30" name="ftp_user" value="<?php echo $ftp_user; ?>"></td>
	</tr>		
	<tr>
 		<td><?php echo Help($l["help_ftppass"],"conf17").$l["ftp_pass"]; ?>:&nbsp;</td>
		<td><input type="password" size="30" name="ftp_pass" value="<?php echo $ftp_pass; ?>"></td>
	</tr>		
	 <tr>
 		<td><?php echo Help($l["help_ftpdir"],"conf18").$l["ftp_dir"]; ?>:&nbsp;</td>
		<td><input type="text" size="30" name="ftp_dir" value="<?php echo $ftp_dir; ?>"></td>
	</tr>
	
	<!--automatisches L&ouml;schen-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_autodelete"]; ?></td></tr>
	<tr>
 		<td><?php echo Help($l["help_ad1"],"conf8").$l["autodelete"]; ?>:&nbsp;</td>
		<td>
			<input type="radio" value="1" name="auto_delete" <?php echo($auto_delete==1)?" checked":""?>><?php echo $l["activated"]; ?>
		    <input type="radio" value="0" name="auto_delete"<?php echo($auto_delete==0)?" checked":""?>><?php echo $l["not_activated"]; ?>
</td>
	</tr>	
		
	<tr>
 		<td><?php echo Help($l["help_ad2"],"conf9").$l["age_of_files"]; ?>:&nbsp;</td>
		<td><input type="text" size="3" name="del_files_after_days" value="<?php echo $del_files_after_days; ?>"></td>
	</tr>		
	<tr><td><?php echo Help($l["help_ad3"],"conf10").$l["number_of_files_form"]; ?>:&nbsp;</td><td><input type="text" size="3" name="max_backup_files" value="<?php echo $max_backup_files; ?>"></td></tr>
	
	<tr><td colspan="2" class="hd"><?php echo $l["config_interface"]; ?></td></tr>
	<tr>
		<td><?php echo Help($l["help_lang"],"conf11").$l["language"]; ?>:&nbsp;</td>
		<td><select name="lang">
			<option value="de" <?php echo($lang=="de")?" SELECTED":""?>><?php echo $l["lang_de"]; ?></option>
			<option value="en" <?php echo($lang=="en")?" SELECTED":""?>><?php echo $l["lang_en"]; ?></option>
		</select><input type="hidden" name="lang_old" value="<?php echo $lang; ?>"></td>
	</tr>
	<!--Cronjob-->
	<tr><td colspan="2" class="hd"><?php echo $l["config_cron"]; ?></td></tr>
	<tr>
 		<td><?php echo Help($l["help_crontime"],"conf12").$l["cron_timelimit"]; ?>:&nbsp;</td>
		<td><input type="text" size="3" maxlength="3" name="cron_timelimit" value="<?php echo $cron_timelimit; ?>"> sek.</td>
	</tr>	
	<tr>
 		<td><?php echo Help($l["help_cronsamedb"],"conf13").$l["cron_samedb"]; ?>:&nbsp;</td>
		<td>
			<input type="radio" value="0" name="cron_samedb" onclick="document.getElementById('cdb').style.visibility='hidden';" <?php echo($cron_samedb==0)?" checked":""?>><?php echo $l["yes"]; ?>
		    <input type="radio" value="1" name="cron_samedb" onclick="document.getElementById('cdb').style.visibility='visible';" <?php echo($cron_samedb==1)?" checked":""?>><?php echo $l["no"]; ?>
		</td>
	</tr>	
	
	<tr>
 		<td><?php echo Help($l["help_crondbindex"],"conf14").$l["cron_crondbindex"]; ?>:&nbsp;</td>
		<td><div id="cdb" style="visibility:<?php echo ($cron_samedb==0)?"hidden;":"visible;"?>">
		<select name="cron_dbindex">
		<?php
		$datenbanken=count($dbname_a);
		for($i=0;$i<$datenbanken;$i++)
		{
			echo '<option value="'.$i.'" ';
			if($i==$cron_dbindex) echo 'SELECTED';
			echo '>'.$dbname_a[$i].'</option>\n';
		}
		?>
		</select><br>
		<input type="text" name="dbcronpraefix" value="<?php echo $dbcronpraefix; ?>">
		</div>	
		</td>
	</tr>	
	
	<!-- Formular-Buttons -->		
	<tr height="50"><td colspan="2" align="center">
		<input class="Formbutton" type="reset" name="reset" value="<?php echo $l["reset"];?>">&nbsp;&nbsp;&nbsp;<input class="Formbutton" type="submit" name="save" value="<?php echo $l["save"];?>">
		</td></tr>
	</table>
</form>

<?php
include("inc/footer.php");
?>