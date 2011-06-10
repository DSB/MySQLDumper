<?php
$nl="\n"; // Newline-Code
//Die Arbeitsverzeichnisse
$rootdir=substr($PHP_SELF,0,strrpos($PHP_SELF,"/"));
$work="work/";
$backup_path=$work."backup/";
$structure_path=$work."structure/";
$log_path=$work."log/";
$log_file=$log_path."mysqldump.log";
$config_path=$work."config/";
$config_file=$config_path."parameter.php";
////////////////////////////////////
// funktion kommt aus functions.php
// muss hier aber vorhanden sein
////////////////////////////////////
function WriteLog($aktion)
{
	global $log_file;
	//Zeile zusammensetzen
	$log=date("d.m.Y h:i:s").':  '.$aktion."\n";
	//Datei öffnen und schreiben
	$fp = fopen($log_file, "a+");
	fwrite ($fp,($log)); 
	fclose ($fp); 
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