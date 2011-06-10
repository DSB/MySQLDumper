<!-- 
	Kommentare zu MySQL
	
	Dump ohne Kommentare
	mysqldump --host=$HostName --user=$UserName --password=$Password --opt $db_name $db_tables | sed -e 's/^--/##/' -e '/^\//d' > $dateiname

	-- Kommentar
	/*!40000 ALTER TABLE xxx DISABLE KEYS */;

 -->
<?
	
	include("inc/header.php");
	require_once("inc/functions_restore.php");
echo MSDHeader();	
	
	if($config["magic_quotes_gpc"]) {
		foreach($_POST as $postvar => $postval){ ${$postvar} = stripslashes($postval); } 
		foreach($_GET as $getvar => $getval){ ${$getvar} = stripslashes($getval); }
	} else {
		foreach($_POST as $postvar => $postval){ ${$postvar} = $postval; } 
		foreach($_GET as $getvar => $getval){ ${$getvar} = $getval; }
	}

	if((isset($rows) && $rows<5) || !isset($rows)) $rows=5; 
	if((isset($fontsize) && $fontsize<9) || !isset($fontsize)) $fontsize=9;
	
	if(!isset($destfile)) $destfile="";
	if(!isset($selectfile)) $selectfile="";
	if(!isset($compressed)) $compressed=0;
	if(!isset($debugoutput)) $debugoutput=0;
	if(!isset($insert)) $insert="";
	if(!isset($create)) $create="";
	if(!isset($exp)) $exp=0;
	
	echo headline("Entwicklung - Tests, Konverter, ...");
	// Konverter
	echo '<h6>Konverter</h6>';
	echo '<form action="develop.php" method="post">';
	echo '<table border="1" rules="all"><tr><td colspan="2" class="hd">Erweiterte Inserts -> vollständige Inserts (alles findet im backup-Verzeichnis statt)</td></tr>';
	echo '<tr><td>zu konvertierendes File</td><td>'.FilelisteCombo($config["paths"]["backup"],$selectfile).'</td></tr>';
	echo '<tr><td>Name des Zielfiles (ohne Endung):</td><td><input type="text" name="destfile" size="50" value="'.$destfile.'"></td></tr>';
	echo '<tr><td><input type="checkbox" name="compressed" value="1" '.(($compressed==1) ? "checked" : "").'>komprimiert</td><td><input type="submit" name="startconvert" value=" Konvertierung starten "></td></tr>';
	echo '</table></form><br>';
	
	if(isset($startconvert)) {
		$destfile.=($compressed==1) ? ".sql.gz" : ".sql";
		echo "Konvertierung $selectfile ==> $destfile<br>";
		if(file_exists($config["paths"]["backup"].$selectfile) && strlen($destfile)>7) {
			Converter($selectfile,$destfile,$compressed);
		}
		else echo "falsche Parameter ! Konvertierung ist nicht möglich.";
		
	}
	
	// Parser-Test
	echo '<h6>Parser-Test</h6>';
	echo '<span style="font-size:11px;"><form action="develop.php" method="post">';
	echo '<table border="1" rules="all"><tr><td colspan="2" class="hd">Parser-Test&nbsp;&nbsp;&nbsp;&nbsp;';
	echo 'Fontgrösse: <select name="fontsize" style="font-size:11px;"><option value="9" '.(($fontsize==9) ? "SELECTED" : "").'>9 px</option><option value="10" '.(($fontsize==10) ? "SELECTED" : "").'>10 px</option><option value="12" '.(($fontsize==12) ? "SELECTED" : "").'>12 px</option><option value="14" '.(($fontsize==14) ? "SELECTED" : "").'>14 px</option></select>';
	echo '&nbsp;&nbsp;&nbsp;Zeilen: <select name="rows" style="font-size:11px;"><option value="5" '.(($rows==5) ? "SELECTED" : "").'>5</option><option value="10" '.(($rows==10) ? "SELECTED" : "").'>10</option><option value="15" '.(($rows==15) ? "SELECTED" : "").'>15</option></select>';
	echo '</td></tr><tr><td>Create-Anweisung:</td><td><textarea cols="100" rows="'.$rows.'" name="create" style="font-size:'.$fontsize.'px; width: 500px;">'.$create.'</textarea></td></tr>';
	echo '<tr><td>Insert-Anweisung:</td><td><textarea cols="100" rows="'.$rows.'" name="insert" style="font-size:'.$fontsize.'px; width: 500px;">'.$insert.'</textarea></td></tr>';
	echo '<tr><td><input type="checkbox" name="debugoutput" value="1"'.(($debugoutput==1) ? " CHECKED" : "").'>mit Debugausgabe</td><td><input type="submit" name="startparse" value=" Parsertest starten ">&nbsp;&nbsp;&nbsp;erwartete Anzahl:<input type="text" name="exp" value="'.$exp.'"></td></tr>';
	echo '</table></form></span><br>';
	
	if(isset($startparse)) {
		$restore["erweiterte_inserts"]=0;
		
		echo '<font face="Courier">';
		if($debugoutput==1) echo '<strong>DEBUG-Ausgabe "Create"-parsing</strong><br>';
		$AnzahlFelder=AnzahlTabellenfelder($create,$debugoutput);
		if($debugoutput==1) echo '<strong>DEBUG-Ausgabe "Insert"-parsing</strong><br>';
		$AnzahlParser=SQL_Is_Complete($insert,$exp,$debugoutput);
		echo "</font><hr>Create-Anweisung: $AnzahlFelder Felder, Insert-Anweisung: $AnzahlParser Felder<br>";
	
	}
	
	
	// Testwiese
	echo '<a name="testwiese"></a><h6>Testwiese</h6>';
	include("inc/functions_restore.php");
	MSD_mysql_connect();
	$c="CREATE TABLE `changelog` ( `id` int(11) NOT NULL auto_increment, `datum` date NOT NULL default '0000-00-00', `beschreibung` text collate latin1_general_ci NOT NULL, `autor` varchar(50) collate latin1_general_ci NOT NULL default '', `version` varchar(8) collate latin1_general_ci default NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci";
	echo "<p>CREATE:<br>$c</p>";
	echo "<hr><p>UMWANDLUNG:<br>".ConvertCreate($c)."</p>";
	echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
	include("inc/footer.php");
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////  Funktionen   ////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////

function FilelisteCombo($fpath,$selected) {
	$r='<select name="selectfile">';
	$r.='<option value="" '.(($selected=="") ? "SELECTED" : "").'></option>';
	
	$dh = opendir($fpath);
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($fpath.$filename)) {
			$r.='<option value="'.$filename.'" ';
			if($filename==$selected) $r.=' SELECTED';
			$r.='>'.$filename.'</option>'."\n";
		}
	}
	$r.='</select>';
	return $r;
}

function Converter1($filesource,$filedestination,$cp)
{
global $config;


$insert= substr($f[0],0,strpos($f[0],"("));
for($i=0;$i<count($f);$i++) {
	$f[$i]=str_replace("),(",");\n$insert (",$f[$i]);
	
}

$z=  fopen($config["paths"]["backup"].$filedestination,"w");
fwrite($z,implode("\n",$f));
fclose($z);
echo "fertig";

}



function Converter($filesource,$filedestination,$cp)
{
global $config;

$cps=(substr(strtolower($filesource),-2)=="gz") ? 1 : 0;

echo "<h5>Datei '$filesource' wird eingelesen.....</h5><span style=\"font-size:10px;\">";

if(file_exists($config["paths"]["backup"].$filedestination)) unlink($config["paths"]["backup"].$filedestination);

$f = ($cps==1) ? gzopen($config["paths"]["backup"].$filesource,"r") : fopen($config["paths"]["backup"].$filesource,"r");
$z=  ($cps==1)  ? gzopen($config["paths"]["backup"].$filedestination,"w") : fopen($config["paths"]["backup"].$filedestination,"w");

$insert=$mode="";
$n=0;
$eof= ($cps==1) ? gzeof($f) : feof($f);
WHILE (!$eof)
{
	$eof= ($cps==1) ? gzeof($f) : feof($f);
	$zeile= ($cps==1) ? gzgets($f,8192) : fgets($f,8192);
	if (substr($zeile,0,2)=="--") $zeile="";
	//$zeile=rtrim($zeile);
	$t=strtolower(substr($zeile,0,10));
	if ($t>"")
	{
		switch ($t)
		{
			case "insert int":
				{
					// eine neue Insert Anweisung beginnt
					$insert= substr($zeile,0,strpos($zeile,"("));
					if(substr(strtoupper($insert),-7)!="VALUES ") $insert.="VALUES ";
					$mode="insert";
					
				};
				break;

			case "create tab":
				{
					$mode="create";
					WHILE (substr(rtrim($zeile),-1)!=";") 
					{ 

						$zeile.=fgets($f,8192);
					}
					break;
				}
			case "drop table":
				{
					$mode="drop";
					$zeile.="\n";
					break;
				}
		}
		if ($mode=="insert") 
		{
			// Komma loeschen
			$zeile=str_replace("),(",");\n$insert (",$zeile);
			if(substr(rtrim($zeile),0,2)==",(" && $insert !="") {
				$zeile=";\n".$insert.substr($zeile,1);
			}
			if(substr(rtrim($zeile),-2)==")," && $insert !="") {
				$zeile=substr(rtrim($zeile),0,strlen(rtrim($zeile))-1).";\n$insert";
			}
		}
		$n++;
		if ($n>1000) { $n=0;echo "<br>"; }
		echo ".";
		if($cps==1) gzwrite($z,$zeile); else fwrite($z,$zeile);
	}
	flush();
	$n++;
}
if($cps==1) gzclose($z); else fclose($z);
if($cps==1) gzclose($f); else fclose($f);

echo "</span><h5>Konvertierung abgeschlossen, '$filedestination' wurde erzeugt.</h5>";
}


function ReadStatus($line)
{
	//Format # Status:Tabellen:Datensätze:Multipart:DBname
	if(substr($line,0,8)!="# Status") {
		$s=Array("-1","-1","");
	} else {
		$s=explode(":",$line);
		array_shift($s);
	}
	return $s;
}

?>