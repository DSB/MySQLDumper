<?

include_once("inc/functions_dump.php");
@TestWorkDir();
include($config_file); 

@set_time_limit ($cron_timelimit); 
@ignore_user_abort(1); 

if (!isset($table_offset))
{
	//Crondb
	if($cron_samedb==0) {
		$cron_dbname=$dbname; 
		$cron_dbpraefix = $dbpraefix; 
	}else {
		$cron_dbname=$dbname_a[$cron_dbindex];
		$cron_dbpraefix = $dbpraefix_a[$cron_dbindex]; 
	}
	
	$dateiname=$cron_dbname."_".date("d\.m\.Y\_H",time())."_Uhr_".date("i",time())."_cron"; // Dateiname aus Datum und Uhrzeit bilden
	$endung= ($compression) ? ".sql.gz" : ".sql";
	$backupdatei=$dateiname.$endung;
	if (file_exists($backup_path.$backupdatei)) @unlink($backup_path.$backupdatei);
	WriteLog("Start Cron-Dump '$backupdatei' from '$HTTP_REFERER'");
	
	$table_offset=0;	
	// Seitenerstaufruf -> Backupdatei anlegen
	$cur_time=date("Y-m-d H:i"); 
	$newfile="# Dump created on $cur_time\r\n"; 
	$newfile.="# Remember that you must use my restorescript in order to get a working DB\r\n";
	$newfile.="# because I use a special code to mark the end of a command.\r\n";
	$newfile.="# This is NOT compatible with other restorescripts!\r\n";
	$newfile.="# Anyway, have fun with this but use it at your own risk. :-) \r\n";

	if ($compression==1)
	{
		$fp = gzopen ($backup_path.$backupdatei,"wb"); 
		gzwrite ($fp,$newfile); 
		gzclose ($fp);
		chmod($backup_path.$backupdatei,0777); 
	}
	else
	{
		$fp = fopen ($backup_path.$backupdatei,"wb"); 
		fwrite ($fp,$newfile); 
		fclose ($fp); 
		chmod($backup_path.$backupdatei,0777); 
	}
}

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()); 
$tabellen = mysql_list_tables($cron_dbname,$conn); 
$num_tables = @mysql_num_rows($tabellen); 
$tables=ARRAY();

if ($num_tables>0)
{
	for ($i=0;$i<$num_tables;$i++) 
	{ 
		$erg=mysql_fetch_row($tabellen);
		if ($dbpraefix>"")
		{
			if (substr($erg[0],0,strlen($cron_dbpraefix))==$cron_dbpraefix) $tables[]=$erg[0];
		}
		else $tables[$i]=$erg[0];
	}
}
else die("<br>Fehler:<br>Ich konnte keine Tabellen in der Datenbank '<b>".$dbname."</b>' finden.");
$num_tables=count($tables);

$newfile="";
$zeilen_offset==0;

while ($table_offset < $num_tables)
{

	if ($table_offset < $num_tables) 
	{ 
		$table = $tables[$table_offset]; 
		$aktuelle_tabelle=$table_offset;
		
		if ($zeilen_offset==0) $newfile = @get_def($cron_dbname,$table);
		$newfile.= @cron_get_content($cron_dbname,$table); 
	} 
	if ($compression==1)
	{
		$fp = gzopen ($backup_path.$backupdatei,"ab");
		gzwrite ($fp,$newfile); 
		gzclose ($fp); 
	}
	else
	{
		$fp = fopen ($backup_path.$backupdatei,"ab"); 
		fwrite ($fp,$newfile); 
		fclose ($fp); 
	}
}

WriteLog("Cron-Dump '$backupdatei' finished.");
if ($send_mail==1)
{
	$msg_body = "\n\r\n\rIn der Anlage findest Du die Sicherung Deiner MySQL-Datenbank.\n\r"
				." Sicherung der Datenbank '".$cron_dbname."' vom ".date("d\.m\.Y",time())
				.".\n\r\n\rViele Grüsse\n\r\n\rMySQLDump\n\rhttp://www.daniel-schlichtholz.de/board";
	$file = "$backup_path/$backupdatei";
	$folder = $backup_path;
	$file_type = filetype("$file");
	$file_size = filesize("$file");
	$subject = "Backup '".$cron_dbname."' - ".date("d\.m\.Y",time());
	$fp = fopen($file, "r");
	$contents = fread($fp, $file_size);
	$encoded_file = chunk_split(base64_encode($contents));
	fclose($fp);
	$header.= "FROM:$email[1] <$email[0]>\n";
	$header.= "MIME-version: 1.0\n";
	$header.= "Content-type: multipart/mixed; ";
	$header.= "boundary=\"Message-Boundary\"\n";
	$header.= "Content-transfer-encoding: 7BIT\n";
	$header.= "X-attachments: $backupdatei";
	$body_top = "--Message-Boundary\n";
	$body_top.= "Content-type: text/plain; charset=US-ASCII\n";
	$body_top.= "Content-transfer-encoding: 7BIT\n";
	$body_top.= "Content-description: Mail message body\n\n";
	$msg_body = $body_top . $msg_body;
	$msg_body.= "\n\n--Message-Boundary\n";
	$msg_body.= "Content-type: $file_type; name=\"backupdatei\"\n";
	$msg_body.= "Content-Transfer-Encoding: BASE64\n";
	$msg_body.= "Content-disposition: attachment; filename=\"$backupdatei\"\n\n";
	$msg_body.= "$encoded_file\n";
	$msg_body.= "--Message-Boundary--\n";
	if (mail($email[0], stripslashes($subject), $msg_body, $header)) WriteLog("Cron-Dump - Email was sent");
	else WriteLog("Cron-Dump - Email failed with '$backupdatei'.");

	if($ftp_transfer==1) {
		SendViaFTP($backupdatei);
		WriteLog("Cron-Dump - file sent via FTP: '$backupdatei'.");
	}
}

echo "Alles fertig!";

// Liest die Daten aus der DB aus und baut die INSERT-Anweisung zusammen
function cron_get_content($dbname, $table) 
{ 
	global $conn,$anzahl_zeilen,$table_offset,$zeilen_offset,$nl,$next_sqlcommand,$num_tables; 

	$content=""; 
	$query="SELECT * FROM $table";
	$result = mysql_db_query($dbname,$query,$conn); 
	$ergebnisse=mysql_num_rows($result);
	
	// zum debuggen : echo "get table $table ($table_offset of $num_tables - $zeilen_offset / $ergebnisse)<br>";
		
	for ($x=0;$x<$ergebnisse;$x++)
	{
		$row=mysql_fetch_row($result);
		{ 
			$insert = "INSERT INTO $table VALUES ("; 
			for($j=0; $j<mysql_num_fields($result);$j++) 
			{ 
				if(!isset($row[$j])) $insert .= "NULL,"; 
				else if($row[$j] != "") $insert .= "'".addslashes($row[$j])."',"; 
				else $insert .= "'',"; 
			} 
			$insert = ereg_replace(",$","",$insert); 
			$insert .= ");"; 
			$content .= $insert.$next_sqlcommand.$nl; 
		}
	}
	$table_offset++;
 	return $content;
} 


?>