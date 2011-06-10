<?php
echo '<html><head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><title>MySqlDump</title><link rel="stylesheet" type="text/css" href="styles.css"></head><body  bgcolor="#F5F5F5">';
include("inc/functions_restore.php");
include($config_file);


$end=false; // Ende des Files erreicht?
$actual_table= (!empty($_GET['actual_table'])) ? $_GET['actual_table'] : "unbekannt";
$offset= (!empty($_GET['offset'])) ? $_GET['offset'] : 0;
$aufruf= (!empty($_GET['aufruf'])) ? $_GET['aufruf'] : 0;
$table_ready= (!empty($_GET['table_ready'])) ? $_GET['table_ready'] : 0;
if (isset($_POST["filename"])) $filename=$_POST["filename"];
if (isset($_GET["filename"])) $filename=$_GET["filename"];

//$gz=$compression;
// Tipp von pus234
$ext = strrchr($filename,'.'); 
if ($ext==".gz") $gz=1; ELSE $gz=0;

echo "<html>\n<title>MySql - DB-Restore</title>\n";
echo "<head>\n<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
echo "</head>\n";
echo "<body>\n\n";

// Datei oeffnen
$f = ($gz) ? gzopen($backup_path.$filename,"r") : fopen($backup_path.$filename,"r");
if ($f)	
{
	//nur am Anfang Logeintrag
	if($offset==0) WriteLog("Start Restore '$filename'");
	
	// Wenn GZ-Komprimierung aus ist, koennen wir mit Hilfe der Filegroesse
	// ausrechnen, wieviel Prozent der Datei fertig sind.
	// Bei GZ=1 geht es nicht, weil sich der Offset auf die ungepackte Groesse
	// bezieht und somit nicht ins Verhältnis zur Dateigroesse gestellt werden kann.  
	if ($gz==0) $filegroesse=filesize($backup_path.$filename);
	$sql_command=array();
 	
	
	
	// Dateizeiger an die richtige Stelle setzen
	($gz) ? gzseek($f,$offset) : fseek($f,$offset);

	// Jetzt basteln wir uns mal unsere Befehle zusammen...
	$a=0;
	WHILE ( ($a<$anzahl_zeilen_restore) && (!$end) ) 
	{
		$befehl="";
		// Einen MySQL-Befehl holen. Solange, bis wir wirklich etwas sinnvolles haben...
		WHILE ( ($befehl=="") && (!$end) ) { $befehl=get_sqlbefehl();}

		if ($befehl=="end of file")
		{
			// Am Ende der Datei angekommen - Schleife verlassen 
			$end=true;
			break;
		}
		else
		{
			$sql_command[$a]=$befehl;
			$a++;
		}
	}

	// Offset merken, um beim naechsten Seitenaufruf an die richtige Stelle zu springen
	$offset= ($gz) ? gztell($f) : ftell($f);
	if ($gz) gzclose($f); else fclose($f);

	// Und jetzt koennen wir unsere MySQL-Befehle an die Datenbank schicken
	$link = mysql_connect($dbhost, $dbuser, $dbpass) or die($l["db_no_connection"]);
	mysql_select_db($dbname) or die($l["db_select_error"]);
	for ($i=0;$i<sizeof($sql_command);$i++) 
	{
		if ($sql_command[$i]!="end of file")
		{
			$res=mysql_query($sql_command[$i],$link);
			// Bei MySQL-Fehlern sofort abbrechen und Info ausgeben
			$meldung=mysql_error($link);
			if ($meldung!="")
			{
				echo $l["error"].": ".$meldung."<br>";
				echo $l["restore_entryerror"]."<br>".$sql_command[$i];
				die();
			}
		}
	}

	if (!$end) 
	{
		// Noch nicht fertig? - Dann Anzeige der Infos und Selbstaufruf durch Javascript
		$aufruf=$aufruf+1;
		if (!$gz) $prozent=($offset*100)/$filegroesse;
		echo '<h3>'.$l["restore"].'</h3>';
		echo $l["restore_db"];

		echo "<br><b>";
		if ($table_ready>0) echo $table_ready-1; else echo "0";
		echo $l["restore_complete"]; 

		echo $l["restore_run1"];
		echo number_format(($aufruf*$anzahl_zeilen_restore)-$table_ready,0,",",".").$l["restore_run2"];
		echo $l["restore_run3"].$actual_table.$l["restore_run4"];
		if (!$gz) echo "<br><b>".number_format(sprintf("%.4f",$prozent),4,",",".")." %</b> ".$l["restore_run5"];

		echo "<script =\"javascript\">self.location=\"$PHP_SELF?offset=";
		echo $offset."&aufruf=".$aufruf."&actual_table=".$actual_table;
		echo "&table_ready=".$table_ready."&filename=".urlencode($filename);
		echo "\"</script>";
	}
	else
	{
		// Uff, geschafft! Jetzt darf die Leitung wieder abkuehlen. :-)
		WriteLog("Restore '$filename' finished.");
		echo '<h3>'.$l["restore"].'</h3>';
		echo $l["restore_db"];
		
		echo $l["restore_total_complete"];

	}
}
else echo $backup_path.$filename." :  ".$l["file_open_error"];
echo "\n</body>\n</html>\n";

?>