<?php
include_once("inc/functions_global.php");

function new_file($last_groesse=0)
{
	global $dump,$databases,$config,$out,$lang,$nl;
	
	
	// Dateiname aus Datum und Uhrzeit bilden
	if ($dump["part"]-$dump["part_offset"]==1) $dump["filename_stamp"]=date("Y_m_d_H_i",time());
	if ($config["multi_part"]==1) {
		$dateiname=$databases["Name"][$dump["dbindex"]]."_".$dump["filename_stamp"]."_part_".($dump["part"]-$dump["part_offset"]); 
	} 	else
		$dateiname=$databases["Name"][$dump["dbindex"]]."_".date("Y_m_d_H_i",time()); 
		$structurefilename=$databases["Name"][$dump["dbindex"]]."_structure_file";
		$endung= ($config["compression"]) ? ".sql.gz" : ".sql";
		$dump["backupdatei"]=$dateiname.$endung;
		$dump["backupdatei_structure"]=$structurefilename.$endung;
		
		if (file_exists($config["paths"]["backup"].$dump["backupdatei"])) unlink($config["paths"]["backup"].$dump["backupdatei"]);
		if($config["multi_part"]==0 || ($config["multi_part"]==1 && ($dump["part"]-$dump["part_offset"])==1)) {
		if (file_exists($config["paths"]["structure"].$dump["backupdatei_structure"])) unlink($config["paths"]["structure"].$dump["backupdatei_structure"]);
	}
	$cur_time=date("Y-m-d H:i"); 
	$statuszeile=GetStatusLine()."".$nl."# Dump by MySQLDump ".$config["version"]." (".$config["homepage"].")".$nl;

	if ($dump["part"]-$dump["part_offset"]==1)
	{
		if($config["multi_part"]==0) {
			if($config["multi_dump"]==1) WriteLog("starting Multidump with ".count($databases["multi"])." Datenbases.");
			WriteLog("Start Dump '".$dump["backupdatei"]."'"); 
		} else {
			WriteLog("Start Multipart-Dump '$dateiname'");
		}
		$out.="<strong>".$lang['startdump']."`".$databases["Name"][$dump["dbindex"]]."`</strong>".(($databases["praefix"][$dump["dbindex"]]!="") ?' ('.$lang["withpraefix"].' <span style="color:blue">'.$databases["praefix"][$dump["dbindex"]].'</span>)' : '')."...   ";
		ExecuteCommand("b");
		if($dump["part"]==1) {
			$dump["table_offset"]=0;	
			$dump["countdata"]=0;
		}
		// Seitenerstaufruf -> Backupdatei anlegen
		
		$dump["data"]=$statuszeile.'# Dump created on '.$cur_time.$nl.$nl; 
		$dump["structure"]="# Status:0:0::".$databases["Name"][$dump["dbindex"]];
		$dump["structure"].=":php:".$config["version"].$nl;
		$dump["structure"].="# Dump by MySQLDump ".$config["version"]." (".$config["homepage"].")".$nl;
		$dump["structure"].='# Dump created on '.$cur_time.$nl."# This file is only the structure of the database without data \r\n";
		
	}
	else
	{
		if($config["multi_part"]!=0) {
			WriteLog("Continue Multipart-Dump with File ".($dump["part"]-$dump["part_offset"])." (last file was $last_groesse Bytes)");
			$dump["data"]=$statuszeile.'# This is part '.($dump["part"]-$dump["part_offset"]).' of the backup.'.$nl.$nl.$dump["data"];
			
		}
		
	}
	WriteToDumpFile();
	$dump["part"]++;
}

function GetStatusLine($kind="php")
{
	global $databases,$config, $dump;
	
	$t_array=explode("|",$databases["db_actual_tableselected"]);
	$t=0;
	$r=0;
	$mp="";$t_zeile="";
	MSD_mysql_connect(); 
	$res=mysql_query("SHOW TABLE STATUS FROM `".$databases["Name"][$dump["dbindex"]]."`");
	$numrows=mysql_num_rows($res);
	for($i=0;$i<$numrows;$i++) {
		$erg=mysql_fetch_array($res);
		if($databases["db_actual_tableselected"]=="" || ($databases["db_actual_tableselected"]!="" && (in_array($erg[0],$t_array)))) {
			$t++;$r+=$erg["Rows"];
			$t_zeile.="# TABLE|".$erg["Name"]."|".$erg["Rows"]."|".($erg["Data_length"]+$erg["Index_length"])."|".$erg["Update_time"]."\n";
		}
	}
	if($config["multi_part"]==1) $mp="MP_".($dump["part"]-$dump["part_offset"]);
	return "# Status:$t:$r:$mp:".$databases["Name"][$dump["dbindex"]].":$kind:".$config["version"].":".$dump["kommentar"].":EXTINFO\n".$t_zeile;
}

// Liest die Eigenschaften der Tabelle aus der DB und baut die CREATE-Anweisung zusammen
function get_def($db, $table) 
{ 
	global $config,$nl; 
	
	$def = "DROP TABLE IF EXISTS `$table`;".$nl; 
	mysql_select_db($db);
	$result = mysql_query("SHOW CREATE TABLE `$table`",$config["dbconnection"]); 
	$row=mysql_fetch_row($result);
	$def .=$row[1].";".$nl; 
	return $def;
} 


// Liest die Daten aus der DB aus und baut die INSERT-Anweisung zusammen
function get_content($db, $table) 
{ 
	global $config,$nl,$dump; 

	$content=""; 
	
	$query="SELECT * FROM `$table` LIMIT ".$dump["zeilen_offset"].",".($dump["restzeilen"]+1);
	mysql_select_db($db);
	$result = mysql_query($query,$config["dbconnection"]); 
	$ergebnisse=mysql_num_rows($result);
	//$dump["countdata"]+=$ergebnisse;
	if ($ergebnisse>$dump["restzeilen"])
	{
		$dump["zeilen_offset"]+=$dump["restzeilen"];
		$ergebnisse--;
		//$dump["countdata"]--;
		$dump["restzeilen"]=0;
	}
	else
	{
		$dump["table_offset"]++;
		$dump["zeilen_offset"]=0;
		$dump["restzeilen"]=$dump["restzeilen"]-$ergebnisse;
	}
	for ($x=0;$x<$ergebnisse;$x++)
	{
		$row=mysql_fetch_row($result);
		{ 
			
			$insert = "INSERT INTO `$table` VALUES ("; 
			$num_felder=mysql_num_fields($result);
			for($j=0; $j<$num_felder;$j++) 
			{ 
				if(!isset($row[$j])) $insert .= "NULL,"; 
				else if($row[$j] != "") $insert .= "'".mysql_escape_string($row[$j])."',"; 
				else $insert .= "'',"; 
			} 
			$insert = ereg_replace(",$","",$insert); 
			$insert .= ");"; 
			$dump["data"] .= $insert.$nl; 
			$dump["countdata"]++;
			if(strlen($content)>$config["memory_limit"] || ($config["multi_part"]==1 && strlen($content)>$config["multipart_groesse"]) ) {
				WriteToDumpFile();
			}
		}
	}
 	mysql_free_result($result);
} 

function WriteToDumpFile()
{
	global $config,$dump;
	
	$df=$config["paths"]["backup"].$dump["backupdatei"];
	$sf=$config["paths"]["structure"].$dump["backupdatei_structure"];
	
	if ($config["compression"]==1)
	{
		if($dump["data"]!="") {
			$fp = gzopen ($df,"ab");
			gzwrite ($fp,$dump["data"]); gzclose ($fp); 
		}
		if($dump["structure"]!="") {
			$fp = gzopen ($sf,"ab");
			gzwrite ($fp,$dump["structure"]); gzclose ($fp); 
		}
	}
	else
	{
		if($dump["data"]!="") {
			$fp = fopen ($df,"ab"); 
			fwrite ($fp,$dump["data"]);fclose ($fp); 
		}
		if($dump["structure"]!="") {
			$fp = fopen ($sf,"ab"); 
			fwrite ($fp,$dump["structure"]); fclose ($fp); 
		}
	}
	$dump["data"]=$dump["structure"]="";
	if(!isset($dump["fileoperations"])) $dump["fileoperations"]=0;
	$dump["fileoperations"]++;
	
	$dump["filesize"]=filesize($df);
	if ($config["multi_part"]==1 && $dump["filesize"]>$config["multipart_groesse"]) 
		new_file($dump["filesize"]); // Wenn maximale Dateigroesse erreicht -> neues File starten
}





function ExecuteCommand($when)
{
	global $config,$databases,$dump,$out,$lang;
	
	
	if($when=="b") {  // before dump
		$cd=$databases["command_before_dump"][$dump["dbindex"]];
		$cap="before Dump"; $lf="<br>";
	} else {
		$cd=$databases["command_after_dump"][$dump["dbindex"]];
		$cap="after Dump";	$lf="";
	}	
		
	if($cd!="") {
		//jetzt ausführen
		if(substr(strtolower($cd),0,7)!="system:") {
			@mysql_select_db($databases["Name"][$dump["dbindex"]]);
			if(strpos($cd,";")) {
				$cad=explode(";",$cd);
				for($i=0;$i<count($cad);$i++) {
					if($cad[$i]) $result .= @mysql_query($cad[$i],$config["dbconnection"]); 
				}
			} else {
				$result = @mysql_query($cd,$config["dbconnection"]); 
			}
			if(!$result) {
				WriteLog("Error while executing Query $cap ($cd) : ".mysql_error());
				ErrorLog("Command ".$cap,$databases["Name"][$dump["dbindex"]],$cd,mysql_error());
				$dump["errors"]++;
				$out.=$lf.'<span class=smallwarnung>ERROR executing Query '.$cap.'</span><br>';
			} else {
				WriteLog("executing Query $cap ($cd) was successful");
				$out.=$lf.'<span class=smallblue>executing Query '.$cap.' was successful</span><br>';
			}
		} elseif(substr(strtolower($cd),0,7)=="system:") {
			//$result=@system(substr($cd,7),$returnval);
			$cap=substr($cd,7);
			$result=1;
			if(!$result) {
				WriteLog("Error while executing System Command $cap");
				$dump["errors"]++;
				$out.=$lf.'<span class=smallwarnung>ERROR executing System Command '.$cap.'</span><br>';
			} else {
				WriteLog("executing System Command $cap was successful. [$returnval]");
				$out.=$lf.'<span class=smallblue>executing System Command '.$cap.' was successful</span><br>';
			}
		}
	}
	
}

function DoEmail()
{
	global $config,$dump,$databases,$email,$lang,$out,$REMOTE_ADDR;
	
	$header="";
	if($config["cron_use_sendmail"]==1) {
	//sendmail
		if(ini_get("sendmail_path")!=$config["cron_sendmail"]) @ini_set("SMTP",$config["cron_sendmail"]);
		if(ini_get("sendmail_from")!=$config["email_sender"]) @ini_set("SMTP",$config["email_sender"]);
	} else {
	//SMTP
	}
		if(ini_get("SMTP")!=$config["cron_smtp"]) @ini_set("SMTP",$config["cron_smtp"]);
		if(ini_get("smtp_port")!=25) @ini_set("smtp_port",25);
	
	
	if($config["multi_part"]==0) {
		$file = $dump["backupdatei"];
		$file_name=(strpos("/",$file)) ? substr($file,strrpos("/",$file)) : $file;
		$file_type = filetype($config["paths"]["backup"].$file);
		$file_size = filesize($config["paths"]["backup"].$file);
		if(($config["email_maxsize"]>0 && $file_size>$config["email_maxsize"]) || $config["send_mail_dump"]==0) {
			//anhang zu gross
			$subject = "Backup '".$databases["Name"][$dump["dbindex"]]."' - ".date("d\.m\.Y H:i",time());
			$header.= "FROM:".$config["email_sender"]."\n";
			$header .= "X-Mailer: PHP/" . phpversion(). "\n";          
			$header .= "X-Sender-IP: $REMOTE_ADDR\n"; 
			$header .= "Content-Type: text/html"; 
			if($config["send_mail_dump"]!=0) {
				$msg_body = $lang["emailbody_tb1"].byte_output($config["email_maxsize"]). $lang["emailbody_tb2"];
			} else {
				$msg_body = $lang["emailbody_na"];
			}
			$msg_body.="`".$databases["Name"][$dump["dbindex"]]."` ".$lang["emailbody_tb3"];
			$msg_body.="$file (".byte_output(filesize($config["paths"]["backup"].$file)).")<br>";
			$msg_body=str_replace("\\n\\r","<br>",$msg_body);
			$email_log="Email sent to '".$config["email_recipient"]."'";
			$email_out=$lang["email_was_send"]."`".$config["email_recipient"]."`<br>";
		} else {
			//alles ok, anhang generieren
			$msg_body = $lang["emailbody_n1"].'`'.$databases["Name"][$dump["dbindex"]].'`  ('.byte_output(filesize($config["paths"]["backup"].$file)).') '.$lang["emailbody_n2"];
			$subject = "Backup '".$databases["Name"][$dump["dbindex"]]."' - ".date("d\.m\.Y",time());
			$fp = fopen($config["paths"]["backup"].$file, "r");
			$contents = fread($fp, $file_size);
			$encoded_file = chunk_split(base64_encode($contents));
			fclose($fp);
			$header.= "FROM:".$config["email_sender"]."\n";
			$header.= "MIME-version: 1.0\n";
			$header.= "Content-type: multipart/mixed; ";
			$header.= "boundary=\"Message-Boundary\"\n";
			$header.= "Content-transfer-encoding: 7BIT\n";
			$header.= "X-attachments: $file_name";
			$body_top = "--Message-Boundary\n";
			//$body_top.= "Content-type: text/plain; charset=US-ASCII\n";
			$body_top.= "Content-type: text/html\n";
			$body_top.= "Content-transfer-encoding: 7BIT\n";
			$body_top.= "Content-description: Mail message body\n\n";
			$msg_body = $body_top . $msg_body;
			$msg_body.= "\n\n--Message-Boundary\n";
			$msg_body.= "Content-type: $file_type; name=\"$file\"\n";
			$msg_body.= "Content-Transfer-Encoding: BASE64\n";
			$msg_body.= "Content-disposition: attachment; filename=\"$file\"\n\n";
			$msg_body.= "$encoded_file\n";
			$msg_body.= "--Message-Boundary--\n";
			$email_log="Email was sent to '".$config["email_recipient"]."' with '".$dump["backupdatei"]."'.";
			$email_out=$lang["email_was_send"]."`".$config["email_recipient"]."`".$lang['with']."`".$dump["backupdatei"]."`.<br>";
		}
	} else {
		//Multipart
		$mp_sub="Backup '".$databases["Name"][$dump["dbindex"]]."' - ".date("d\.m\.Y",time());
		$msg_body = (($config["send_mail_dump"]==1) ? $lang["emailbody_mp1an"] : $lang["emailbody_mp1"]).$databases["Name"][$dump["dbindex"]].$lang['emailbody_mp1a'];
		$subject = $mp_sub;
		$header.= "FROM:".$config["email_sender"]."\n";
		$header .= "X-Mailer: PHP/" . phpversion(). "\n";          
		$header .= "X-Sender-IP: $REMOTE_ADDR\n"; 
		$header .= "Content-Type: text/html"; 
		$body_top = "";
		$msg_body = $body_top . $msg_body;
		//$msg_body.=$lang["emailbody2"];
		$dateistamm=substr($dump["backupdatei"],0,strrpos($dump["backupdatei"],"part_"))."part_";
		$dateiendung=($config["compression"]==1)?".sql.gz":".sql";
		$mpdatei=Array();
		for ($i=1;$i<($dump["part"]-$dump["part_offset"]);$i++) {
			$mpdatei[$i-1]=$dateistamm.$i.$dateiendung;
			$sz=byte_output(@filesize($config["paths"]["backup"].$mpdatei[$i-1]));
			$msg_body.=$mpdatei[$i-1]." (".$sz.")<br>";
		}
		$msg_body .=$lang["emailbody_mp2"];
		$email_log="Email was sent to '".$config["email_recipient"]."'";
		$email_out=$lang["email_was_send"]."`".$config["email_recipient"]."`<br>";
	}
	if (@mail($config["email_recipient"], stripslashes($subject), $msg_body, $header)) {
		$out.= '<span class="smallbrown">'.$email_out.'</span>';
		WriteLog("$email_log");
	} else {
		$out.='<span class="smallwarnung">'.$lang["mailerror"].'</span><br>';
		WriteLog("Email to '".$config["email_recipient"]."' failed !");
		ErrorLog("Email ",$databases["Name"][$dump["dbindex"]],'Subject: '.stripslashes($subject),$lang["mailerror"]);
		$dump["errors"]++;
	}
	
	if(isset($mpdatei) && $config["send_mail_dump"]==1) { // && ($config["email_maxsize"]==0 || ($config["email_maxsize"]>0 && $config["multipartgroesse2"]<=$config["email_maxsize"]))) {
		for($i=0;$i<count($mpdatei);$i++) {
			$file_name=$mpdatei[$i];
			$file_type = filetype($config["paths"]["backup"].$mpdatei[$i]);
			$file_size = filesize($config["paths"]["backup"].$mpdatei[$i]);
			$fp = fopen($config["paths"]["backup"].$mpdatei[$i], "r");
			$contents = fread($fp, $file_size);
			$encoded_file = chunk_split(base64_encode($contents));
			fclose($fp);
			$subject =$mp_sub. "  [Part ".($i+1)." / ".count($mpdatei)."]"; 
			$header= "FROM:".$config["email_sender"]."\n";
			$header.= "MIME-version: 1.0\n";
			$header.= "Content-type: multipart/mixed; ";
			$header.= "boundary=\"Message-Boundary\"\n";
			$header.= "Content-transfer-encoding: 7BIT\n";
			$header.= "X-attachments: $file_name";
			$body_top = "--Message-Boundary\n";
			$body_top.= "Content-type: text/html\n";
			$body_top.= "Content-transfer-encoding: 7BIT\n";
			$body_top.= "Content-description: Mail message body\n\n";
			$msg_body = $body_top.$lang['only_attachment'].$lang['emailbody_mp2'];
			$msg_body.= "\n\n--Message-Boundary\n";
			$msg_body.= "Content-type: $file_type; name=\"".$mpdatei[$i]."\"\n";
			$msg_body.= "Content-Transfer-Encoding: BASE64\n";
			$msg_body.= "Content-disposition: attachment; filename=\"".$mpdatei[$i]."\"\n\n";
			$msg_body.= "$encoded_file\n";
			$msg_body.= "--Message-Boundary--\n";
			$email_log="Email with $mpdatei[$i] was sent to '".$config["email_recipient"]."'";
			$email_out=$lang["email_was_send"]."`".$config["email_recipient"]."`".$lang['with']."`".$mpdatei[$i]."`.<br>";
			
			if (@mail($config["email_recipient"], stripslashes($subject), $msg_body, $header)) {
				$out.= '<span class="smallbrown">'.$email_out.'</span>';
				WriteLog("$email_log");
			} else {
				$out.='<span class="smallwarnung">'.$lang["mailerror"].'</span><br>';
				WriteLog("Email to '".$config["email_recipient"]."' failed !");
				ErrorLog("Email ",$databases["Name"][$dump["dbindex"]],'Subject: '.stripslashes($subject),$lang["mailerror"]);
				$dump["errors"]++;
			}
		} 
	} 
}

function DoFTP()
{	
	global $config,$dump,$out;
	
	if($config["multi_part"]==0) {
		SendViaFTP($dump["backupdatei"],1);
	} else {
		$dateistamm=substr($dump["backupdatei"],0,strrpos($dump["backupdatei"],"part_"))."part_";
		$dateiendung=($config["compression"]==1)?".sql.gz":".sql";
		for ($i=1;$i<($dump["part"]-$dump["part_offset"]);$i++) {
			$mpdatei=$dateistamm.$i.$dateiendung;
			SendViaFTP($mpdatei,$i);
		}
	}
	$out.='<span class="smallgreen">'."file sent via FTP (".$dump["backupdatei"]." => ".$config["ftp_server"][$config["ftp_connectionindex"]].")</span><br><br>";
}

function SendViaFTP($source_file,$conn_msg=1)
{
	global $config,$out,$lang;
	flush();
	if($conn_msg==1) $out.='<span class="smallgreen" style="padding-left:20px;">'.$lang['filesendftp']."(".$config["ftp_server"][$config["ftp_connectionindex"]]." - ".$config["ftp_user"][$config["ftp_connectionindex"]].")</span><br>";
	
	
	// Herstellen der Basis-Verbindung
	if($config["ftp_useSSL"]==0)
		$conn_id = ftp_connect($config["ftp_server"][$config["ftp_connectionindex"]], $config["ftp_port"][$config["ftp_connectionindex"]],$config["ftp_timeout"]); 
	else
		$conn_id = ftp_ssl_connect($config["ftp_server"][$config["ftp_connectionindex"]], $config["ftp_port"][$config["ftp_connectionindex"]],$config["ftp_timeout"]); 
	// Einloggen mit Benutzername und Kennwort
	$login_result = ftp_login($conn_id, $config["ftp_user"][$config["ftp_connectionindex"]], $config["ftp_pass"][$config["ftp_connectionindex"]]); 
	
	// Verbindung überprüfen
	if ((!$conn_id) || (!$login_result)) { 
	        $out.= '<span class="smallwarnung" style="padding-left:20px;">'.$lang['ftpconnerror'].$config["ftp_server"][$config["ftp_connectionindex"]].$lang['ftpconnerror1'].$config["ftp_user"][$config["ftp_connectionindex"]].$lang['ftpconnerror2'].'</span><br>'; 
	        exit; 
	    } else {
	        if($conn_msg==1) $out.= '<span class="smallgreen" style="padding-left:20px;">'.$lang['ftpconnected1'].$config["ftp_server"][$config["ftp_connectionindex"]].$lang['ftpconnerror1'].$config["ftp_user"][$config["ftp_connectionindex"]].'</span><br>';
	    }
	
	// Upload der Datei
	$dest=$config["ftp_dir"][$config["ftp_connectionindex"]].$source_file;
	$source=$config["paths"]["backup"].$source_file;
	$upload = @ftp_put($conn_id, $dest,$source , FTP_BINARY); 
	
	// Upload-Status überprüfen
	if (!$upload) { 
	        $out.= '<span class="smallwarnung">'.$lang['ftpconnerror3']."<br>($source -> $dest)</span><br>";
	    } else {
	        $out.= '<span class="smallgreen" style="padding-left:20px;">'.$lang['file'].' <a href="'.$config["paths"]["backup"].$source_file.'" class="smallblack">'.$source_file.'</a>'.$lang['ftpconnected2'].$config["ftp_server"][$config["ftp_connectionindex"]].$lang['ftpconnected3'].'</span><br>';
			WriteLog("'$source_file' sent via FTP.");
	    }
	
	// Schließen des FTP-Streams
	@ftp_quit($conn_id); 
}
?>