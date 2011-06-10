<?
include_once("config.php");

// Backupverzeichnis existiert noch nicht? Na gut, dann machen wir eben eins. :-)
if (!is_dir($path)) mkdir($path, 0777); 

$zeilen_offset= (isset($_GET['zeilen_offset'])) ? $zeilen_offset=$_GET['zeilen_offset']:0;
if (isset($_GET['backupdatei'])) $backupdatei=$_GET['backupdatei'];

if (isset($_GET['table_offset'])) $table_offset=$_GET['table_offset'];
else 
{
	$dateiname=date("d\.m\.Y\_H",time())."_Uhr_".date("i",time()); // Dateiname aus Datum und Uhrzeit bilden
	$endung= ($compression) ? ".sql.gz" : ".sql";
	$backupdatei=$dateiname.$endung;
	if (file_exists($path.$backupdatei)) unlink($path.$backupdatei);

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
		$fp = gzopen ($path.$backupdatei,"wb"); 
		gzwrite ($fp,$newfile); 
		gzclose ($fp);
		chmod($path.$backupdatei,0777); 
	}
	else
	{
		$fp = fopen ($path.$backupdatei,"wb"); 
		fwrite ($fp,$newfile); 
		fclose ($fp); 
		chmod($path.$backupdatei,0777); 
	}
}

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()); 
$tabellen = mysql_list_tables($dbname,$conn); 
$num_tables = @mysql_num_rows($tabellen); 
$tables=ARRAY();
if ($num_tables>0)
{
	for ($i=0;$i<$num_tables;$i++) 
	{ 
		$erg=mysql_fetch_row($tabellen);
		$tables[$i]=$erg[0]; 
	}
}
else die ("<br>Fehler:<br>Ich konnte keine Tabellen in der Datenbank '<b>".$dbname."</b>' finden.");

/////////////////////////////////
// Anzeige - Fortschritt
/////////////////////////////////
echo "<html>\n<title>MySql - DB-Restore</title>\n";
echo "<head>\n";
echo "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">";
echo "</head>\n";
echo "<body>\n";

$newfile="";
if ($table_offset < $num_tables) 
{ 
	$table = $tables[$table_offset]; 
	$aktuelle_tabelle=$table_offset;
	if ($zeilen_offset==0)
	{
		$newfile .= get_def($dbname,$table); 
	}
	$newfile .= get_content($dbname,$table); 
} 
if ($compression==1)
{
	$fp = gzopen ($path.$backupdatei,"ab");
	gzwrite ($fp,$newfile); 
	gzclose ($fp); 
}
else
{
	$fp = fopen ($path.$backupdatei,"ab"); 
	fwrite ($fp,$newfile); 
	fclose ($fp); 
}

if ($table_offset<$num_tables)
{
	// Selbstaufruf starten
	echo "\n\n<script =\"javascript\">self.location=\"cron_dump.php?";
	echo "table_offset=$table_offset&zeilen_offset=$zeilen_offset&backupdatei=";
	echo urlencode($backupdatei); 
	echo "\"</script>\n\n";
}
else 
{
	if ($send_mail==1)
	{
		$msg_body = "\n\r\n\rIn der Anlage findest Du die Sicherung Deiner MySQL-Datenbank.\n\r"
					." Sicherung der Datenbank '".$dbname."' vom ".date("d\.m\.Y",time())
					.".\n\r\n\rViele Grüsse\n\r\n\rMySQLDump\n\rhttp://www.daniel-schlichtholz.de/board";
		$file = "./$path/$backupdatei";
		$folder = $path;
		$fname = $backupdatei;
		$file_type = filetype("$file");
		$file_size = filesize("$file");
		$file_name = "$fname";
		$subject = "Backup '".$dbname."' - ".date("d\.m\.Y",time());
		$fp = fopen($file, "r");
		$contents = fread($fp, $file_size);
		$encoded_file = chunk_split(base64_encode($contents));
		fclose($fp);
		$header.= "FROM:$email[1] <$email[0]>\n";
		$header.= "MIME-version: 1.0\n";
		$header.= "Content-type: multipart/mixed; ";
		$header.= "boundary=\"Message-Boundary\"\n";
		$header.= "Content-transfer-encoding: 7BIT\n";
		$header.= "X-attachments: $file_name";
		$body_top = "--Message-Boundary\n";
		$body_top.= "Content-type: text/plain; charset=US-ASCII\n";
		$body_top.= "Content-transfer-encoding: 7BIT\n";
		$body_top.= "Content-description: Mail message body\n\n";
		$msg_body = $body_top . $msg_body;
		$msg_body.= "\n\n--Message-Boundary\n";
		$msg_body.= "Content-type: $file_type; name=\"$file_name\"\n";
		$msg_body.= "Content-Transfer-Encoding: BASE64\n";
		$msg_body.= "Content-disposition: attachment; filename=\"$file_name\"\n\n";
		$msg_body.= "$encoded_file\n";
		$msg_body.= "--Message-Boundary--\n";
		mail($email[0], stripslashes($subject), $msg_body, $header);
	}
}
echo "\n\n</body>\n</html>\n";

?>