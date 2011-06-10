<?
echo '<html><head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><title>MySqlDump</title><link rel="stylesheet" type="text/css" href="styles.css"></head><body  bgcolor="#F5F5F5">';
include("inc/functions_dump.php");
@TestWorkDir();
include($config_file); 

$zeilen_offset= (isset($_GET['zeilen_offset'])) ? $zeilen_offset=$_GET['zeilen_offset']:0;
if (isset($_GET['backupdatei'])) $backupdatei=$_GET['backupdatei'];
if (isset($_GET['backupdateistructure'])) $backupdateistructure=$_GET['backupdateistructure']; 

if (isset($_GET['table_offset'])) $table_offset=$_GET['table_offset'];
else 
{
	$dateiname=$dbname."_".date("d\.m\.Y\_H",time())."_Uhr_".date("i",time()); // Dateiname aus Datum und Uhrzeit bilden
	$structurefilename=$dbname."_structure_file";
	$endung= ($compression) ? ".sql.gz" : ".sql";
	$backupdatei=$dateiname.$endung;
	$backupdateistructure=$structurefilename.$endung;
	
	
	if (file_exists($backup_path.$backupdatei)) unlink($backup_path.$backupdatei);
	if (file_exists($structure_path.$backupdateistructure)) unlink($structure_path.$backupdateistructure);
	
	WriteLog("Start Dump '$dateiname'");
	$table_offset=0;	
	$countdata=0;
	// Seitenerstaufruf -> Backupdatei anlegen
	$cur_time=date("Y-m-d H:i"); 
	$newfile="# Dump created on $cur_time\r\n"; 
	$newfile.="# Remember that you must use my restorescript in order to get a working DB\r\n";
	$newfile.="# because I use a special code to mark the end of a command.\r\n";
	$newfile.="# This is NOT compatible with other restorescripts!\r\n";
	$newfile.="# Anyway, have fun with this but use it at your own risk. :-) \r\n";
	
	$structurefile=$newfile."# This file is only Structure of the Database without Data \r\n";

	if ($compression==1)
	{
		$fp = gzopen ($backup_path.$backupdatei,"wb"); 
		gzwrite ($fp,$newfile); gzclose ($fp); 	chmod($backup_path.$backupdatei,0777);
		$fp = gzopen ($structure_path.$backupdateistructure,"wb"); 
		gzwrite ($fp,$structurefile); gzclose ($fp); 	chmod($structure_path.$backupdateistructure,0777);  
	}
	else
	{
		$fp = fopen ($backup_path.$backupdatei,"wb"); 
		fwrite ($fp,$newfile); fclose ($fp); chmod($backup_path.$backupdatei,0777); 
		$fp = fopen ($structure_path.$backupdateistructure,"wb"); 
		fwrite ($fp,$structurefile); fclose ($fp); chmod($structure_path.$backupdateistructure,0777); 
	}
}

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()); 
$tabellen = mysql_list_tables($dbname,$conn); 
$num_tables = mysql_num_rows($tabellen); 
$tables=ARRAY();

if ($num_tables>0)
{
	for ($i=0;$i<$num_tables;$i++) 
	{ 
		$erg=mysql_fetch_row($tabellen);
		if ($dbpraefix>"")
		{
			if (substr($erg[0],0,strlen($dbpraefix))==$dbpraefix) $tables[]=$erg[0];
		}
		else $tables[$i]=$erg[0];
	}
}
else die ("<br>".$l["error"].":<br>".$l["dump_notables"]);
$num_tables=count($tables);

$newfile=""; 
$structurefile="";


$restzeilen=$anzahl_zeilen;
WHILE ( ($table_offset < $num_tables) && ($restzeilen>0) ) 
{ 
	$table = $tables[$table_offset]; 
	$aktuelle_tabelle=$table_offset; 
   	if ($zeilen_offset==0) {
		$newfile .= get_def($dbname,$table); 
		$structurefile.=get_def($dbname,$table); 
	}
	$newfile .= get_content($dbname,$table);
	$restzeilen--; 
} 
 
/////////////////////////////////
// Anzeige - Fortschritt
/////////////////////////////////
?>
<html>
<title>MySqlDump</title>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
</head>
<body>
<h3><?php echo $l["dump_headline"];?></h3>
<?php
echo $l["dump_filename"].$backupdatei."<br><br>";

echo $l["gzip_compression"]." <b>";
if ($compression==1) echo $l["activated"]; else echo $l["not_activated"];
echo "</b>.<br>";

$sql="SELECT COUNT(*) AS anzahl FROM ".$tables[$table_offset];
$res=mysql_query($sql);
if ($res)
{
	$row=mysql_fetch_object($res);
	$gesamt=intval($row->anzahl);
	
	if ($gesamt>0)
	{
		$fortschritt=round(((100*$zeilen_offset)/$gesamt),0);
		if ($anzahl_zeilen>=$gesamt) $fortschritt=100;
	}
	else $fortschritt=100;

	echo $l["saving_table"]."<b>".($table_offset+1)."</b> ".
			$l["of"]."<b> ".sizeof($tables)."</b><br>";
	echo $l["actual_table"].": <b>".($tables[$table_offset])."</b><br><br>";

	echo $l["progress_table"].":<br>\n";
	echo "<table border=\"0\" width=\"380\">\n<tr>\n";
	echo "<td width=\"".($fortschritt*3)."\" bgcolor=\"blue\">&nbsp;</td>\n";
	echo "<td width=\"".((100-$fortschritt)*3)."\">&nbsp;</td>\n";
	echo "<td width=\"80\" align=\"right\">".($fortschritt)." %</td>\n";

	if ($anzahl_zeilen+$zeilen_offset>=$gesamt) 
	{
		$eintrag=$zeilen_offset+1;
		$zeilen_gesamt=$gesamt;
		if ($zeilen_gesamt==0) $eintrag=0;
	}
	else 
	{
		$zeilen_gesamt=$zeilen_offset+$anzahl_zeilen;
		$eintrag=$zeilen_offset+1;
	}

	echo "</tr>\n<tr>\n";
	echo "<td colspan=\"3\">".$l["entry"]." <b>".number_format($eintrag,0,",",".")."</b> ".$l["upto"]." <b>";
	echo number_format(($zeilen_gesamt),0,",",".")."</b> ".$l["of"]." <b>";
	echo number_format($gesamt,0,",",".")."</b></td>\n";
	echo "</tr>\n\n</table>\n\n";

	$tabellen_gesamt=sizeof($tables);
	$noch_zu_speichern=$tabellen_gesamt-$table_offset;
	$prozent= ($tabellen_gesamt>0) ? round(((100*$noch_zu_speichern)/$tabellen_gesamt),0) : 100;
	if ($noch_zu_speichern==0) $prozent=100;

	echo "<br>".$l["progress_over_all"].":";
	echo "\n\n<table border=\"0\" width=\"550\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>\n";
	echo "<td width=\"".(5*(100-$prozent))."\" bgcolor=\"blue\"></td>\n";
	echo "<td width=\"".($prozent*5)."\" align=\"center\"></td>\n";
	echo "<td width=\"50\">".(100-$prozent)." %</td>\n";
	echo "</tr>\n</table>\n";

	flush();
}
//////////////////////////////////////
// Ende Anzeige
//////////////////////////////////////

function byte_output($bytes, $precision = 2, $names = '')
{
   if (!is_numeric($bytes) || $bytes < 0) {
       return false;
   }
       
   for ($level = 0; $bytes >= 1024; $level++) {    
       $bytes /= 1024;      
   }
   
   switch ($level)
   {
       case 0:
           $suffix = (isset($names[0])) ? $names[0] : 'Bytes';
           break;
       case 1:
           $suffix = (isset($names[1])) ? $names[1] : 'KB';
           break;
       case 2:
           $suffix = (isset($names[2])) ? $names[2] : 'MB';
           break;
       case 3:
           $suffix = (isset($names[3])) ? $names[3] : 'GB';
           break;      
       case 4:
           $suffix = (isset($names[4])) ? $names[4] : 'TB';
           break;                            
       default:
           $suffix = (isset($names[$level])) ? $names[$level] : '';
           break;
   }
   
   if (empty($suffix)) {
       trigger_error('Unable to find suffix for case ' . $level);
       return false;
   }
   
   return round($bytes, $precision) . ' ' . $suffix;
}


if ($compression==1)
{
	$groesse=filesize($backup_path.$backupdatei);
	print "<br><h1>Dateigroesse: ".byte_output($groesse")."</h1>";
	
	$fp = gzopen ($backup_path.$backupdatei,"ab");
	gzwrite ($fp,$newfile); gzclose ($fp); 
	$fp = gzopen ($structure_path.$backupdateistructure,"ab");
	gzwrite ($fp,$structurefile); gzclose ($fp); 
}
else
{
	$fp = fopen ($backup_path.$backupdatei,"ab"); 
	fwrite ($fp,$newfile); 	fclose ($fp); 
	$fp = fopen ($structure_path.$backupdateistructure,"ab"); 
	fwrite ($fp,$structurefile); 	fclose ($fp); 
}

flush();
if ($table_offset<=$tabellen_gesamt)
{
	// Selbstaufruf starten
	echo "\n\n<script =\"javascript\">self.location=\"dump.php?"
			."table_offset=$table_offset&zeilen_offset=$zeilen_offset&countdata=".$countdata."&backupdatei="
			.urlencode($backupdatei)."&backupdateistructure=" .urlencode($backupdateistructure)."\"</script>\n\n";
}
else 
{
	//Backup fertig
	
	WriteLog("Dump '$backupdatei' finished.");
	echo "<br>".$l["done"]."<br><br>".$l["file"]." '<a href=\"".$backup_path.$backupdatei."\"><strong>".$backupdatei."</strong></a>' ".$l["dump_successful"]."<br><br>";
	echo $l["dump_endergebnis1"]."<strong>$num_tables</strong>".$l["dump_endergebnis2"]."<strong>".number_format($countdata,0,",",".")."</strong>".$l["dump_endergebnis3"];
	echo str_repeat("&nbsp;",60)."<br>";
	
	flush();
	
	if ($send_mail==1)
	{
		$msg_body = $l["emailbody"];
		$file = $backupdatei;
		$file_type = filetype("$backup_path$file");
		$file_size = filesize("$backup_path$file");
		$subject = "Backup '".$dbname."' - ".date("d\.m\.Y",time());
		$fp = fopen($backup_path.$file, "r");
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
		$msg_body.= "Content-type: $file_type; name=\"$file\"\n";
		$msg_body.= "Content-Transfer-Encoding: BASE64\n";
		$msg_body.= "Content-disposition: attachment; filename=\"$file\"\n\n";
		$msg_body.= "$encoded_file\n";
		$msg_body.= "--Message-Boundary--\n";
		if (mail($email[0], stripslashes($subject), $msg_body, $header)) {
			echo "<br>".$l["email_was_send"];
			WriteLog("Email sent with '$backupdatei'.");
		} else {
			echo "<br><font color=\"red\">".$l["mailerror"]."</font>";
			WriteLog("Email failed with '$backupdatei'.");
		}
	}
	
	if($ftp_transfer==1) {
		SendViaFTP($backupdatei);
		WriteLog("file sent via FTP: '$backupdatei'.");
	}
	echo "<br><br><input class=\"Formbutton\" type=\"button\" value=\"".$l["back_to_control"]."\" onclick=\"self.location.href='filemanagement.php'\"></a>";
}
echo "\n\n</body>\n</html>\n";

?>