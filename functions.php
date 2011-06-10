<?php

// Liest die Eigenschaften der Tabelle aus der DB und baut die CREATE-Anweisung zusammen
function get_def($dbname, $table) 
{ 
	global $conn,$nl,$next_sqlcommand; 
	$def = ""; 
	$def .= "DROP TABLE IF EXISTS $table;".$next_sqlcommand.$nl; 
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
		$def .= ","; 
		if($x == "PRIMARY") $def .= " PRIMARY KEY (" . implode($columns, ", ") . ")"; 
		else if (substr($x,0,6) == "UNIQUE") $def .= " UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")"; 
		else $def .= " KEY $x (" . implode($columns, ", ") . ")"; 
	} 

	$def .= ");".$next_sqlcommand.$nl; 
	return (stripslashes($def)); 
} 


// Liest die Daten aus der DB aus und baut die INSERT-Anweisung zusammen
function get_content($dbname, $table) 
{ 
	global $conn,$anzahl_zeilen,$table_offset,$zeilen_offset,$nl,$next_sqlcommand; 

	$content=""; 
	$query="SELECT * FROM $table LIMIT $zeilen_offset,".($anzahl_zeilen+1);
	$result = mysql_db_query($dbname,$query,$conn); 
	$ergebnisse=mysql_num_rows($result);

	if ($ergebnisse>$anzahl_zeilen)
	{
		$zeilen_offset=$zeilen_offset+$anzahl_zeilen;
		$ergebnisse--;
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
			$insert .= ");"; 
			$content .= $insert.$next_sqlcommand.$nl; 
		}
	}
 	return $content;
} 

// Prüft ob es sich um eine Kommentarzeile handelt
function is_sqlvalue($t)
{
	// Uebergeht Kommentarzeilen im Dump
	if ( (strlen($t)>0) && (substr($t,0,1)!="#") ) return $t;
	else return "";
}

// extrahiert auf einfache Art den Tabellennamen aus dem "Create"-Befehl
function get_tablename($t)
{
	global $table_ready;
	$t=trim(str_replace("CREATE TABLE","",$t));
	$w=explode(" ",$t);
	$table_ready++;
	return $w[0];
}

// Liest zeilenweise aus dem Dump und setzt den MySQl-Befehl
// bis zum Vorkommen des Codes [chr(1)] zusammen
function get_sqlbefehl()
{
	global $f,$gz,$end,$actual_table,$next_sqlcommand;
	$ret=false;
	$befehl="";
	$befehl_gefunden=false;
	WHILE ( ($befehl_gefunden==false) && (!($end)) )
	{
		$zeile= ($gz) ? gzgets($f,40960) : fgets($f,40960);
		if ($zeile)
		{	
			// Prima, wir haben Text in unserer Zeile.
			// Dann wollen wir den Befehl mal zusammensetzen. :-)

			// Zuerst mal schauen, ob es sich nicht um eine Kommentarzeile handelt
			// Aber nur am Anfang eines Befehls - sonst besteht die Gefahr, dass
			// Zeilen in Datensaetzen geloescht werden.
			if ($befehl=="") $zeile=is_sqlvalue($zeile);		

			// Dann schauen wir mal nach dem Ende-Code...
			$pos=strpos($zeile,$next_sqlcommand);
			if (!$pos===false)
			{
				// Ende des Befehls gefunden - Rueckgabe ohne Semikolon und Ende-Code
				$befehl.=substr($zeile,0,($pos-1));
				$befehl_gefunden=true;
				$ret=$befehl;
			}
			// Befehl ist noch nicht fertig: Zeile zum Befehl hinzufuegen
			else $befehl.=$zeile; 

			// Pruefen, ob die naechste Tabelle angelegt wird (nur fuer Infoanzeige)
			if (strtolower(substr($zeile,0,13))=="create table ") $actual_table=get_tablename($zeile);
		}
		else
		{
			// Ups, kein Rueckgabewert in der Zeile?
			// Ja sind wir denn schon fertig? - Das ueberpruefen wir mal mit eof()...
			if ( ($gz) && (gzeof($f)) ) $end=true;
			if ( (!$gz) && (feof($f)) ) $end=true;
			$ret="end of file";
		}
	}
	return $ret;
}

?>