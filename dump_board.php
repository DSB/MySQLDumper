<?
////////////////////////
// mySQL - Variablen
 
$dbhost = 'localhost';
$dbname = '';
$dbuser = 'root';
$dbpass = '';

$nl="\n"; // neue Zeile-Code
$anzahl_zeilen=3000; // Wieviele Zeilen sollen pro Aufruf gespeichert werden?
$compression = 1; // Soll die Datei gepackt werden? Geht nur mit ZLib support, andernfalls auf 0 setzen 
$path="./"; // Wohin soll gespeichert werden ? Der Pfad ist relativ zum Scriptverzeichnis.
 
///////////////////
// Funktionen
/////////////////// 
function get_def($dbname, $table) 
{ 
	global $conn,$nl; 
	$def = ""; 
	$def .= "DROP TABLE IF EXISTS $table;".$nl; 
	$def .= "CREATE TABLE $table (".$nl; 
	$result = mysql_db_query($dbname, "SHOW FIELDS FROM $table",$conn); 
	while($row = mysql_fetch_array($result)) 
	{ 
		$def .= " $row[Field] $row[Type]"; 
		if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'"; 
		if ($row["Null"] != "YES") $def .= " NOT NULL"; 
		if ($row[Extra] != "") $def .= " $row[Extra]"; 
		$def .= ",".$nl; 
	} 
	$def = ereg_replace(",\n$","", $def); 
	$result = mysql_db_query($dbname, "SHOW KEYS FROM $table",$conn); 
	while($row = mysql_fetch_array($result)) 
	{ 
		$kname=$row[Key_name]; 
		if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname"; 
		if(!isset($index[$kname])) $index[$kname] = array(); 
		$index[$kname][] = $row[Column_name]; 
	} 
	while(list($x, $columns) = @each($index)) 
	{ 
		$def .= ",".$nl; 
		if($x == "PRIMARY") $def .= " PRIMARY KEY (" . implode($columns, ", ") . ")"; 
		else if (substr($x,0,6) == "UNIQUE") $def .= " UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")"; 
		else $def .= " KEY $x (" . implode($columns, ", ") . ")"; 
	} 

	$def .= $nl.");".$nl; 
	return (stripslashes($def)); 
} 

function get_content($dbname, $table) 
{ 
	global $conn,$anzahl_zeilen,$table_offset,$zeilen_offset,$nl; 
	$content=""; 
	$query="SELECT * FROM $table LIMIT $zeilen_offset,".($anzahl_zeilen+1);
	$result = mysql_db_query($dbname,$query,$conn); 
	$ergebnisse=mysql_num_rows($result);
	if ($ergebnisse>$anzahl_zeilen)
	{
		$zeilen_offset=$zeilen_offset+$anzahl_zeilen;
	}
	else
	{
		$table_offset++;
		$zeilen_offset=0;
	}
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
			$insert .= ");".$nl; 
			$content .= $insert; 
		}
	}	 
	return $content; 
} 
///////////////////////
// Ende Funktionen
///////////////////////

if (!empty($_GET['table_offset'])) $table_offset=$_GET['table_offset'];
else 
{
	$table_offset=0;	
	// Seitenerstaufruf -> Backupdatei anlegen
	$cur_time=date("Y-m-d H:i"); 
	$newfile.="# Dumpi from ".$cur_time."\r\n";
	$fp = fopen ($path."backup.sql","wb"); 
	fwrite ($fp,$newfile); 
	fclose ($fp); 
}
if (!empty($_GET['zeilen_offset'])) $zeilen_offset=$_GET['zeilen_offset'];
else $zeilen_offset=0;

$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error()); 
if (!is_dir($path)) mkdir($path, 0777); 
if ($compression==1) $filetype = "sql.gz"; else $filetype = "sql"; 

$tabellen = mysql_list_tables($dbname,$conn); 
$tables=ARRAY();
while ($erg=mysql_fetch_row($tabellen)) { $tables[]=$erg[0]; }
$anz=sizeof($tables);
$tabellen = mysql_list_tables($dbname,$conn); 
$num_tables = @mysql_num_rows($tabellen); 
$newfile="";
if ($table_offset < $num_tables) 
{ 
	$table = $tables[$table_offset]; 
	$newfile .= $nl."# ----------------------------------------------------------".$nl.$nl; 
	$newfile .= "# structur for table '$table'\n#\n"; 
	$newfile .= get_def($dbname,$table); 
	$newfile .= $nl.$nl; 
	$newfile .= "#\n# data for table '$table'\n#\n"; 
	$newfile .= get_content($dbname,$table); 
	$newfile .= $nl; 
} 
$fp = fopen ($path."backup.sql","ab"); 
fwrite ($fp,$newfile); 
fclose ($fp); 

$sql="SELECT COUNT(*) AS anzahl FROM ".$tables[$table_offset];
$res=mysql_query($sql);
echo "<h1>Datenbank-Backup:</h1>";
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
	echo "Speichere Tabelle <b>".($table_offset)."</b> von <b>".sizeof($tables)."</b>";
	echo "<br>Tabelle: <b>$table</b><br>";

	echo "<br>Fortschritt Tabelle:<br>";
	echo "<table width=\"500\" border=\"1\"><tr>";
	echo "<td width=\"".$fortschritt."\" bgcolor=\"blue\">&nbsp;</td>";
	echo "<td width=\"".(100-$fortschritt)."\">&nbsp;</td>";
	echo "<td width=\"50\" align=\"center\">".($fortschritt)." %</td>";
	if ($anzahl_zeilen>=$gesamt) 
	{
		$eintrag=$zeilen_offset;
		$zeilen_gesamt=$gesamt;
		if ($zeilen_gesamt==0) $eintrag=0;
	}
	else 
	{
		$zeilen_gesamt=$zeilen_offset+$anzahl_zeilen;
		$eintrag=$zeilen_offset+1;

	}
	echo "<td>Eintrag <b>$eintrag</b> bis <b>".$zeilen_gesamt."</b> von <b>$gesamt</b></td>";
	echo "</tr></table>";
	$tabellen_gesamt=sizeof($tables);
	$noch_zu_speichern=$tabellen_gesamt-$table_offset;
	$prozent= ($gesamt>0) ? round(((100*$noch_zu_speichern)/$tabellen_gesamt),0) : 100;
	echo "<br>Fortschritt gesamt:<br>";
	echo "<table width=\"500\" border=\"1\"><tr>";
	echo "<td width=\"".(100-$prozent)."\" bgcolor=\"blue\">&nbsp;</td>";
	echo "<td width=\"".$prozent."\" align=\"center\">&nbsp;</td>";
	echo "<td width=\"50\">".(100-$prozent)." %</td>";
	echo "<td>Tabelle <b>$table_offset</b> von <b>$tabellen_gesamt</b></td>";
	echo "</tr></table>";
}
	if ($table_offset<=$tabellen_gesamt)
	{
		echo "<script =\"javascript\">self.location=\"$PHP_SELF?";
		echo "table_offset=$table_offset&zeilen_offset=$zeilen_offset"; 
		echo "\"</script>";
	}
	else 
	{
		echo "<br>Alles fertig!";
		echo "<br>Backupdatei wurde erfolgreich gespeichert.";
		if ($compression==1) 
		{ 
			echo "<br>Die Datei wird nun komprimiert.";
			// liest den Inhalt einer Datei in einen String
			$backupdatei=$path."backup.sql";
			$handle = fopen ($backupdatei, "rb");
			$contents = fread ($handle, filesize ($backupdatei));
			fclose ($handle);

			// ungepackte, alte Datei loeschen
      		if (file_exists($backupdatei))
        	{
        		if (unlink($backupdatei))
              	{ 
					echo "<br>Die alte, ungepackte Datei wurde erfolgreich vom Server gel&ouml;scht!<br>";
        		}
			}

			$fp = gzopen($backupdatei.".gz","w"); 
			gzwrite ($fp,$contents); 
			gzclose ($fp);
			echo "<br>Datei wurde erfolgreich komprimiert.";
			echo "<br><br><a href=\"".$backupdatei.".gz\">Hier</a> kannst Du die Backupdatei nun herunterladen.";
			echo "<br><br>Beim nächsten Backup des Webspaces wird das Backup der Datenbank zu diesem ";
			echo "Zeitpunkt mit gespeichert.";
		}
		else
		{
			echo "<br><br><a href=\"".$path."backup.sql\">Hier</a> kannst Du die Backupdatei nun herunterladen.";
		}
	}
?>