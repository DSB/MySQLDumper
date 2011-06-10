<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Daniel Schlichtholz in 2002">
<link rel="stylesheet" type="text/css" href="../styles.css">
<title>MySQL Dumper Hilfe</title>
</head>

<body>
<?php 
if(file_exists("../work/config/parameter.php")){
	@include("../work/config/parameter.php");
}
@include("../inc/functions_global.php");
echo headline();
?>
<h3>&Uuml;ber dieses Projekt</h3>
Die Idee f&uuml;r dieses Projekt kam von Daniel Schlichholz.<p>Er er&ouml;ffnete 2004 das Forum <a href="http://www.mysqldumper.de/board" target="_blank">MySQLDumper</a> und schon bald fanden sich Hobby-Programmierer, die neue Skripte schrieben und die von Daniel erweiterten.<br>Innerhalb k&uuml;rzester Zeit enstand aus dem kleine Backupskript ein stattliches Projekt.<p>Wenn Du Vorschl&auml;ge zur Verbesserung hast, dann wende ich an das MySQLDumper-Forum <a href="http://www.daniel-schlichtholz.de/board" target="_blank">http://www.daniel-schlichtholz.de/board</a>.<p>Wir w&uuml;nschen Dir viel Vergn&uuml;gen mit diesem Projekt.<br><p><h4>Das MySQLDumper-Team</h4>

<table><tr><td><img src="../images/logo.gif" alt="MySQLDumper" width="160" height="53" border="0"></td><td valign="top">
Daniel Schlichtholz - Steffen Kamper<br>
Perlscript mit Unterstützung von Detlev Richter<br>
</td></tr></table>
<br>
<hr>


<h3>MySQLDumper Hilfe</h3>


<h4>Download</h4>
Dieses Script erhaltet ihr auf der Homepage von MySQLDumper.<br>
Es empfielt sich, die Homepage regelm&auml;&szlig;ig zu besuchen, um Updates und
Hilfestellungen zu erlangen.<br>
Die Adresse lautet: <a href="http://www.mysqldumper.de/board" target="_blank">
http://www.mysqldumper.de/board
</a>

<h4>Systemvoraussetzung</h4>
Das Script arbeitet auf jedem Server (Windows, Linux, ...) <br>
mit PHP >= Version 4.3.4 mit GZip-Unterstützung, MySQL (ab Version 3.23), JavaScript (muss aktiviert sein).

<a href="../install.php?language=de" target="_top"><h4>Installation</h4></a>
Die Installation geht einfach von statten.
Entpackt das Archiv in einen beliebigen Ordner.<br>
Ladet alle Dateien auf Euren Webserver hoch. (z.B. in die unterste Ebene in [Server Webverzeichnis/]MySQLDumper)<br>
... fertig!<br>
Ihr k&ouml;nnt MySQLDumper nun im Webbrowser aufrufen durch "http://mein-webserver/MySQLDumper"<br>
um die Installation abzuschliessen. Folgt einfach den Instruktionen.<br>
<br><b>Hinweis:</b><br><i>Falls auf Eurem Server der PHP-Safemode eingeschaltet ist, darf das Script keine
Verzeichnisse erstellen.<br>
Dies müsst ihr dann von Hand nachholen, da MySqlDump die Daten geordnet in
Verzeichnissen ablegt.<br> 
Das Script bricht mit einer entsprechenden Anweisung ab!<br>
Nachdem ihr die Verzeichnisse (dem Hinweis entsprechend) erstellt habt, l&auml;uft es normal und ohne Einschr&auml;nkung.</i>

<h4>Bedienung</h4><ul>

<h6>Men&uuml;</h6>
In der obigen Auswahlliste stellt ihr die Datenbank ein.<br>
Alle Aktionen beziehen sich auf die hier eingestellte Datenbank.

<h6>Startseite</h6>
Hier erfahrt ihr einiges &uuml;ber euer System, die verschiedenen installierten
Versionen und Details &uuml;ber die konfigurierten Datenbanken.<br>
Wenn ihr auf den Datenbanknamen klickt, so seht ihr eine Auflistung der Tabellen
mit der Anzahl der Eintr&auml;ge, der Gr&ouml;sse und das letzte Aktualisierungsdatum.

<h6>Konfiguration</h6>
Hier k&ouml;nnt ihr eure Konfiguration bearbeiten, abspeichern oder die Ausgabgskonfiguration
wieder herstellen.
<ul><br>
	<li><a name="conf1"></a><strong>Konfigurierte Datenbanken:</strong> die Auflistung der konfigurierten Datenbanken. Die aktive Datenbank wird in <b>bold</b> gelistet. </li>
	<li><a name="conf2"></a><strong>Tabellen-Pr&auml;fix:</strong> hier k&ouml;nnt ihr (f&uuml;r jede Datenbank) einen Pr&auml;fix angeben. Dies ist ein Filter, der bei Dumps nur die Tabellen ber&uuml;cksichtigt, die mit diesem Pr&auml;fix beginnen (z.B. alle Tabellen, die mit "phpBB_" beginnen). Wenn alle Tabellen dieser Datenbank gespeichert werden sollen, 
so lasst das Feld einfach leer.</li>
	<li><a name="conf3"></a><strong>GZip-Kompression:</strong> Hier kann die Kompression aktiviert werden. Empfehlenswert ist die Aktivierung, da die Dateien doch wesentlich kleiner werden und Speicherplatz immer rar ist.</li>
	<li><a name="conf5"></a><strong>Email mit Dumpfile:</strong> Ist diese Option aktiviert, so wird nach abgeschlossenem Backup eine Email mit dem Dump als Anhang verschickt (Vorsicht, Kompression sollte unbedingt an sein, sonst wird der Anhang zu gross und kann ev. nicht versandt werden!)</li>
	<li><a name="conf6"></a><strong>Email-Adresse:</strong> Empf&auml;ngeradresse f&uuml;r die Email</li>
	<li><a name="conf7"></a><strong>Absender der Email:</strong> diese Adresse taucht als Absender in der Email auf</li>
	<li><a name="conf13"><strong>FTP-Transfer: </strong>Ist diese Option aktiviert, so wird nach abgeschlossenem Backup die Backupdatei per FTP versandt.</li>
	<li><a name="conf14"><strong>FTP Server: </strong>die Adresse des FTP-Servers (z.B. ftp.mybackups.de)</li>
	<li><a name="conf15"><strong>FTP Server Port: </strong>der Port des FTP-Servers (in der Regel 21)</li>
	<li><a name="conf16"><strong>FTP User: </strong>der Benutzername des FTP-Accounts </li>
	<li><a name="conf17"><strong>FTP Passwort: </strong>das Passwort des FTP-Accounts </li>
	<li><a name="conf18"><strong>FTP Upload-Ordner: </strong>das Verzeichnis, in das die Backupdatei soll (es müssen Upload-Berechtigungen bestehen!)</li>
	<li><a name="conf8"></a><strong>automatisches L&ouml;schen der Backups:</strong> Wenn diese Option aktiviert ist, werden &auml;ltere Backups nach den folgenden Regeln automatisch gel&ouml;scht. Kombinationen sind m&ouml;glich.</li>
	<li><a name="conf9"></a><strong>Alter der Dateien (in Tagen):</strong> Ein Wert > 0 l&ouml;scht alle Backupdateien, die &auml;lter als diese Angabe sind.</li>
	<li><a name="conf10"></a><strong>Anzahl von Backupdateien:</strong> Ein Wert > 0 l&ouml;scht alle Backupdateien, bis auf die hier angegeben Zahl</li>
	<li><a name="conf11"></a><strong>Sprache:</strong> hier legst du die Sprache f&uuml;r das Interface fest.</li>
	<li><a name="conf12"></a><strong>Zeitlimit f&uuml;r Cronjob:</strong> diese Angabe in Sekunden erh&ouml;ht das erlaubte Zeitlimit des Prozesses um die angegebenen Sekunden, wenn der Provider dies erlaubt.</li>
</ul>

<h6>Verwaltung</h6>
Hier werden die eigenlichen Aktionen durchgef&uuml;hrt.<br>
Es werden dir alle Dateien im Backup-Verzeichnis angezeigt.
F&uuml;r die Aktionen "Restore" und "Delete" muss eine Datei selektiert sein.
<UL>
	<li><strong>Restore:</strong> hiermit wird die Datenbank mit der ausgew&auml;hlten Backupdatei aktualisiert.</li>
	<li><strong>Delete:</strong> hiermit kannst du die selektierte Backupdatei l&ouml;schen.</li>
	<li><strong>Neues Backup starten:</strong> hier startest du ein neues Backup (Dump) nach den in der Konfiguration eingestellten Parametern.</li>
</UL>

<h6>Log</h6>
Hier kannst du die Logeintr&auml;ge sehen und l&ouml;schen.

<h6>Credits / Hilfe</h6>
diese Seite.
</ul>
<hr>
<h3>Unsere Sponsoren</h3>
Die Sponsoren finden Sie auch auf der <a class="ul" href="http://www.mysqldumper.de/de/index.php?m=7" target="_blank">Sponsorenseite</a><br>
<p class="verysmall" style="color:green;">Wir sind nicht verantwortlich für den Inhalt der folgenden Seiten.</p>

<?php
if ($sponsors = @file("http://www.mysqldumper.de/sponsors.php?lang=en")) {
  echo implode("\n",$sponsors);
} else echo "Seite nicht verfügbar.<br><br>Du must online sein !";
?>

<br><p align="center" class="small">
Idee: 
<a class="small" href="http://www.daniel-schlichtholz.de" target="_new">
Daniel Schlichtholz</a> - Infoboard: 
<a class="small" href="http://www.mysqldumper.de/board" target="_new">
www.mysqldumper.de/board</a></p>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
