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

function TestWorkDir()
{
	global $rootdir,$work,$backup_path,$structure_path,$log_path,$log_file,$config_path,$config_file;
	
	if (!is_dir($work)) {
		// Arbeitsverzeichnis existiert noch nicht? Na gut, dann machen wir eben eins. :-)
 		mkdir($work, 0777); 
		mkdir($backup_path, 0777); 
		mkdir($structure_path, 0777); 
		mkdir($log_path, 0777); 
		mkdir($config_path, 0777); 
		
	} else {
		if (!is_dir($backup_path))  mkdir($backup_path, 0777); 	else {if(decoct(fileperms($backup_path))<>0777)chmod($backup_path, 0777);}
		if (!is_dir($structure_path)) mkdir($structure_path, 0777); else {if(decoct(fileperms($structure_path)<>0777))chmod($structure_path, 0777);}
		if (!is_dir($log_path)) mkdir($log_path, 0777); else {if(decoct(fileperms($log_path)<>0777))chmod($log_path, 0777);}
		if (!is_dir($config_path)) mkdir($config_path, 0777); else {if(decoct(fileperms($config_path)<>0777))chmod($config_path, 0777);}
	}
	if(!file_exists($config_file))SetDefault();
	if(!file_exists($log_file)){DeleteLog();}
}

// Liest die Eigenschaften der Tabelle aus der DB und baut die CREATE-Anweisung zusammen
function get_def($dbname, $table) 
{ 
	global $conn,$nl,$next_sqlcommand; 
	$def = "DROP TABLE IF EXISTS `$table`;".$next_sqlcommand.$nl; 
	$result = mysql_db_query($dbname, "SHOW CREATE TABLE `$table`",$conn); 
	$row=mysql_fetch_row($result);
	$def .=$row[1].";".$next_sqlcommand.$nl; 
	return $def;
} 


// Liest die Daten aus der DB aus und baut die INSERT-Anweisung zusammen
function get_content($dbname, $table) 
{ 
	global $restzeilen,$conn,$anzahl_zeilen,$table_offset,$zeilen_offset,$nl,$next_sqlcommand, $countdata; 

	$content=""; 
	
	$query="SELECT * FROM $table LIMIT $zeilen_offset,".($restzeilen+1);
	$result = mysql_db_query($dbname,$query,$conn); 
	$ergebnisse=mysql_num_rows($result);
	$countdata+=$ergebnisse;
	if ($ergebnisse>$restzeilen)
	{
		$zeilen_offset=$zeilen_offset+$restzeilen;
		$ergebnisse--;
		$countdata--;
		$restzeilen=0;
	}
	else
	{
		$table_offset++;
		$zeilen_offset=0;
		$restzeilen=$restzeilen-$ergebnisse;
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

function SendViaFTP($source_file)
{
	global $ftp_server, $ftp_port, $ftp_user,$ftp_pass,$ftp_dir,$backup_path;
	flush();
	echo "<br><br>versende File via FTP...bitte hab etwas Geduld. ($ftp_server - $ftp_user)<br>";
	
	
	// Herstellen der Basis-Verbindung
	$conn_id = ftp_connect($ftp_server, $ftp_port) or die ("<font color=\"#FF0000\">Ftp-Verbindung zum Server $ftp_server nicht möglich!<br></font>"); 
	
	// Einloggen mit Benutzername und Kennwort
	$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass); 
	
	// Verbindung überprüfen
	if ((!$conn_id) || (!$login_result)) { 
	        echo "<font color=\"#FF0000\">Ftp-Verbindung nicht hergestellt!";
	        echo "Verbindung mit $ftp_server als Benutzer $ftp_user nicht möglich</font><br>"; 
	        die; 
	    } else {
	        echo "Verbunden mit $ftp_server als Benutzer $ftp_user<br>";
	    }
	
	// Upload der Datei
	$dest=$ftp_dir.$source_file;
	$source=$backup_path.$source_file;
	$upload = ftp_put($conn_id, $dest,$source , FTP_BINARY); 
	
	// Upload-Status überprüfen
	if (!$upload) { 
	        echo "<font color=\"#FF0000\">Ftp upload war fehlerhaft! <br>($source -> $dest)</font><br>";
	    } else {
	        echo "Datei $source_file auf $ftp_server als $ftp_dir.$source_file geschrieben<br>";
			WriteLog("'$backupdatei' sent via FTP.");
	    }
	
	// Schließen des FTP-Streams
	ftp_quit($conn_id); 
}

/////////////////////////////
// Kommt aus functions.php
/////////////////////////////
function SelectDB($index) 
{ 
   global $dbhost,$dbname,$dbuser,$dbpass, $dbpraefix,
   		  $dbhost_a, $dbname_a, $dbuser_a, $dbpass_a, $dbpraefix_a; 
    
   $dbhost = $dbhost_a[$index]; 
   $dbname = $dbname_a[$index]; 
   $dbuser = $dbuser_a[$index]; 
   $dbpass = $dbpass_a[$index]; 
   $dbpraefix = $dbpraefix_a[$index]; 
} 

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
function DeleteLog()
{
	global $log_file;
	//Datei öffnen und schreiben
	$log=date("d.m.Y h:i:s").": Log created.\n";
	$fp = fopen($log_file, "wb");
	fwrite ($fp,$log); 
	fclose ($fp); 
}

?>