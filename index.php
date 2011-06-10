<?php
///////////////////////////////////////////////////////////
// Backup-Script von Daniel Schlichtholz
//
// Benutzung erfolgt natürlich auf eigene Gefahr
//
// für Bugfixes und Erweiterungen schaut auf mein Board:
// http://www.daniel-schlichtholz.de/board
//
// Version 0.9.2
//////////////////////////////////////////////////////////

include("config.php");

echo "<html>\n<head>\n<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
echo "<title>MySql-DB-Dump/Restore</title>\n";
echo "<style type='text/css'>\n";
echo "<!--
    p.meldung { font-size: 12pt;color:#0000FF;font-weight:normal;text-align: left;}
    p.fehler  { font-size: 16pt;color:#FF0000;font-weight:bold;text-align: left;}
    p.warnung { font-size: 14pt;color:#FF9E00;font-weight:normal;text-align: left;}
//-->
</style>\n";

echo "</head>\n";
echo "<body>\n";
echo "<b><u>Konfiguration:</u></b><br>";
echo "GZip-Komprimierung ist ";
if (!$compression) echo "<b>nicht</b> ";
echo "aktiviert.<br>";
echo "Die Backupdatei wird im Ordner '<b>".$path."</b>' abgelegt.<br>";
echo "Gesichert wird die Datenbank: '<b>".$dbhost."/".$dbname."</b>'.<br>";
echo "Nach dem Backup wird ";
if (!$send_mail) echo "k";
echo "eine Email mit dem Dumpfile ";
if ($send_mail) echo "an '<b>".$email[0]."</b>' ";
echo "verschickt.<br>";
echo "<br>Um die Konfiguration zu ver&auml;ndern, musst Du die Datei 'config.php' bearbeiten.<br><br>";
//--------------------------------------------------------
//*** Abfrage ob Neues Dump ***
//--------------------------------------------------------
if (isset($_POST["dump"]))
{
   include("dump.php");
   exit;
}
//--------------------------------------------------------
//*** Abfrage ob Restore ***
//--------------------------------------------------------
if (isset($_POST["restore"]))
{
   if (isset($_POST["file"]))
   {
   	PRINT "<p class='warnung'>Soll die Datenbank '<b>".$dbname;
	echo "</b>' mit den Inhalten der Datei '<b>".$file."</b>' wiederhergestellt werden?</p>\n";
   	PRINT "<form method='post' action='restore.php'>\n";
   	PRINT "<input  type='hidden' name='filename' value='$file'>\n";
   	PRINT "<input  type='submit' value='Ja'>, ich bin sicher.\n";
   	PRINT "<input  type='button' value='Nein' onclick=\"self.location.href='index.php'\"> lieber nicht.\n";
   	PRINT "</form>\n";
      echo "</body>\n</html>";
   	exit;
   }
   ELSE
   	PRINT "<p class='fehler'>Bitte zuerst eine Datei auswählen!</p>\n";
}

//--------------------------------------------------------
//*** Abfrage ob Delete ***
//--------------------------------------------------------
if (isset($_POST["delete"]))
{
   if (isset($_POST["file"]))
   {
	$file=$_POST["file"];
   	if (@unlink($path.$file))
    		PRINT "<p class='meldung'>Die Datei $file wurde erfolgreich gelöscht.</p>";
   	else
    		PRINT "<p class='fehler'>Löschen der Datei $file GESCHEITERT!</p>";
    }
    ELSE
    PRINT "<p class='fehler'>Bitte zuerst eine Datei auswählen!</p>\n";
}

//--------------------------------------------------------
//*** Ausgabe der Dateien ***
//--------------------------------------------------------

// Backupverzeichnis existiert noch nicht? Na gut, dann machen wir eben eins. :-)   PUS
if (!is_dir($path)) mkdir($path, 0777);
$dh = opendir($path);
while (false !== ($filename = readdir($dh)))
{
    if ($filename != "." && $filename != "..") $files[] = $filename;
}
echo "<table border='1' rules='rows'>\n";
echo "<tr>\n";
echo "<td>&nbsp;</td>\n";
echo "<td><b>Dateiname</td>\n";
echo "<td align=\"right\" colspan=\"2\"><b>Dateigröße</b></td>\n";
echo "</tr>\n";
@rsort($files);
echo "<form method='post' action='".$PHP_SELF."'>\n";
for ($i=0; $i<sizeof($files); $i++)
{
    // Dateigröße
    $size = filesize("$path/$files[$i]");
    // Gesamtgröße aller Backupfiles
    $gesamt = $gesamt + $size;
    // freier Speicherplatz
    $space = diskfreespace("../");
    // Hier werden die Dateinamen ausgegeben
    echo "<tr>\n";
	echo "<td align=\"right\"><input name='file' type='radio' value='$files[$i]'></td>\n";
	echo "<td><a href='$path$files[$i]'>$files[$i]</a></td>\n";
	echo "<td align=\"right\" colspan=\"2\">".round($size/1024)." kByte</td>\n\t</tr>\n";
}
if (!is_array($files)) echo "<tr><td colspan=\"4\" bgcolor=\"#CCCCCC\">Keine Datei gefunden.</td></tr>\n";



//--------------------------------------------------------
//*** Ausgabe der Gesamtgröße aller Backupfiles ***
//--------------------------------------------------------
echo "<tr>\n";
echo "<td align='left' colspan='2'><b>Gesamtgröße:</b></td>\n";
echo "<td align=\"right\" colspan=\"2\"><b>".round($gesamt/1024)." kByte</b></td>\n";
echo "</tr>\n";
//echo "</table>\n";


//--------------------------------------------------------
//*** Ausgabe des freien Speicher auf dem Rechner ***
//--------------------------------------------------------
//echo "<table border='1'>\n";
echo "<tr>\n";
echo "<td bgcolor='#00FF00' colspan='3'>Freier Speicher auf Server: </td>";
echo "<td bgcolor='#00FF00' align=\"right\"><b>".round(($space/(1024*1024*1024)),2)."</b> GByte</td>\n";
echo "</tr>\n";

echo "<tr>\n";
echo "<td colspan=\"2\">Wähle eine Datei zur Wiederherstellung oder zum Löschen aus:</td>\n";
echo "<td align=\"center\"><input name='restore' type='submit' value='Restore'></td>\n";
echo "<td align=\"center\"><input name='delete' type='submit' value='Delete'></td>\n";
echo "</tr>\n";

echo "<tr>\n<td colspan=\"4\">&nbsp;</td>\n</tr>";

echo "<tr>\n<td colspan=\"2\">Oder beginne ein neues Backup:</td>\n";
echo "<td colspan=\"2\" align='center'>";
echo "<input name='dump' type='submit' value='Neues Backup starten'></td>\n";
echo "</tr>\n";
echo "</form>\n";
echo "<tr>\n<td colspan=\"4\">&nbsp;</td>\n</tr>\n";

echo "</table>\n";
echo "<br><a href=\"http://www.daniel-schlichtholz.de/board\" target=\"_blank\">";
echo "Zum Hilfeboard</a>";
?>