<?php
include("config.php");

$end=false; // Ende des Files erreicht?
$actual_table= (!empty($_GET['actual_table'])) ? $_GET['actual_table'] : "unbekannt";
$offset= (!empty($_GET['offset'])) ? $_GET['offset'] : 0;
$aufruf= (!empty($_GET['aufruf'])) ? $_GET['aufruf'] : 0;
$table_ready= (!empty($_GET['table_ready'])) ? $_GET['table_ready'] : 0;
if (isset($_POST["filename"])) $filename=$_POST["filename"];
if (isset($_GET["filename"])) $filename=$_GET["filename"];

$gz=$compression;

echo "<html>\n<title>MySql - DB-Restore</title>\n";
echo "<head>\n<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
echo "</head>\n";
echo "<body>\n\n";

// Datei oeffnen
$f = ($gz) ? gzopen($path.$filename,"r") : fopen($path.$filename,"r");
if ($f)	
{
	// Wenn GZ-Komprimierung aus ist, koennen wir mit Hilfe der Filegroesse
	// ausrechnen, wieviel Prozent der Datei fertig sind.
	// Bei GZ=1 geht es nicht, weil sich der Offset auf die ungepackte Groesse
	// bezieht und somit nicht ins Verhältnis zur Dateigroesse gestellt werden kann.  
	if ($gz==0) $filegroesse=filesize($path.$filename);
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
	$link = mysql_connect($dbhost, $dbuser, $dbpass) or die("Keine Verbindung zur Datenbank möglich!");
	mysql_select_db($dbname) or die("<br>Fehler:<br>Auswahl der Datenbank '<b>".$dbname."</b>' fehlgeschlagen!\n");
	for ($i=0;$i<sizeof($sql_command);$i++) 
	{
		if ($sql_command[$i]!="end of file")
		{
			$res=mysql_query($sql_command[$i],$link);
			// Bei MySQL-Fehlern sofort abbrechen und Info ausgeben
			$meldung=mysql_error($link);
			if ($meldung!="")
			{
				echo "Fehler: ".$meldung."<br>";
				echo "Fehler beim Eintrag des Befehls:<br>".$sql_command[$i];
				die();
			}
		}
	}

	if (!$end) 
	{
		// Noch nicht fertig? - Dann Anzeige der Infos und Selbstaufruf durch Javascript
		$aufruf=$aufruf+1;
		if (!$gz) $prozent=($offset*100)/$filegroesse;
		echo "<h3>Wiederherstellung</h3>";
		echo "der Datenbank '<b>".$dbname."</b>' auf '<b>".$dbhost."</b>'.<br>";

		echo "<br><b>";
		if ($table_ready>0) echo $table_ready-1; else echo "0";
		echo "</b> Tabellen wurden komplett wiederhergestellt."; 

		echo "<br>Bisher wurden <b>";
		echo number_format(($aufruf*$anzahl_zeilen_restore)-$table_ready,0,",",".")."</b> Datens&auml;tze erfolgreich eingetragen.";
		echo "<br>Momentan wird die Tabelle '<b>".$actual_table."</b>' mit Daten gef&uuml;llt.<br>";
		if (!$gz) echo "<br><b>".number_format(sprintf("%.4f",$prozent),4,",",".")." %</b> der Datei eingetragen.";

		echo "<script =\"javascript\">self.location=\"$PHP_SELF?offset=";
		echo $offset."&aufruf=".$aufruf."&actual_table=".$actual_table;
		echo "&table_ready=".$table_ready."&filename=".urlencode($filename);
		echo "\"</script>";
	}
	else
	{
		// Uff, geschafft! Jetzt darf die Leitung wieder abkuehlen. :-)
		echo "<h3>Wiederherstellung</h3>";
		echo "der Datenbank '<b>".$dbname."</b>' auf '<b>".$dbhost."</b>'.<br>";

		echo "<br><b>Herzlichen Glückwunsch.</b>";
		echo "<br><br>Die Datenbank wurde komplett wiederhergestellt.";
		echo "<br>Alle Daten aus der Backupdatei wurden erfolgreich in die Datenbank eingetragen.<br>";
		echo "<br>Alles fertig. :-)";
		echo "<br><a href=\"index.php\">Hier geht es zur&uuml;ck zum Kontrollzentrum</a>";
	}
}
else echo "Ich konnte die Datei '".$path.$filename."' nicht öffnen.";
echo "\n</body>\n</html>\n";

?>