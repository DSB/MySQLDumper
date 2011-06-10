<?php
//generated at 12.11.2005

$lang['help_db']="Dies ist die Liste der vorhandenen Datenbanken";
$lang['help_praefix']="Der Pr&auml;fix ist eine Zeichenfolge f&uuml;r den Anfang von Tabellen, der als Filter fungiert.";
$lang['help_sqltrenn']="Ein Trennzeichen, um die SQL-Befehle eindeutig zu trennen.";
$lang['help_zip']="Kompression mit GZip - emfohlen ist 'aktiviert'";
$lang['help_memorylimit']="Das ist die max. Gr&ouml;&szlig;e in Bytes, die das Skript an Speicher bekommt
0 = deaktiviert";
$lang['memory_limit']="Speichergrenze";
$lang['help_budir']="Hier werden die Datenbank-Backups gespeichert.";
$lang['help_mail1']="Wenn aktiviert, dann wird nach der Erstellung der Sicherung eine Email mit dem Backup verschickt.";
$lang['help_mail2']="Dies ist die Empf&auml;nger-Adresse der Email.";
$lang['help_mail3']="Dies ist die Absende-Adresse der Email.";
$lang['help_mail4']="Die maximale Gr&ouml;&szlig;e f&uuml;r einen Email-Anhang, bei 0 bleibt die Angabe unber&uuml;cksichtigt.";
$lang['help_mail5']="Hier kann bestimmt werden, ob das Backup als Email-Anhang verschickt werden soll.";
$lang['help_ad1']="Wenn aktiviert, dann werden automatisch Backupfiles gel&ouml;scht.";
$lang['help_ad2']="Die maximale Anzahl von Tagen, die ein Backupfile haben darf (f&uuml;r Autodelete)
0 = deaktiviert";
$lang['help_ad3']="Die maximale Anzahl von Dateien, die im Backupverzeichnis sein d&uuml;rfen (f&uuml;r Autodelete)
0 = deaktiviert";
$lang['help_lang']="Stellt auf die gew&uuml;nschte Sprache";
$lang['help_empty_db_before_restore']="Um &uuml;berfl&uuml;ssige Daten zu eleminieren, kann man anweisen, die Datenbank vor der Wiederherstellung komplett zu leeren.";
$lang['help_crontime']="Die Zeit, die das Cronscript zus&auml;tzlich bekommt (in Sekunden).";
$lang['help_cronmail']="Bestimmt, ob im Cronjob das Backup per Mail verschickt werden soll.";
$lang['help_cronmailprg']="Der Pfad zum Mailprogramm, default ist sendmail im angegebenen Pfad.";
$lang['help_cronmailto']="Die Adresse, an die die Mail geschickt wird.";
$lang['help_cronftp']="Bestimmt, ob im Cronjob das Backup per FTP verschickt werden soll";
$lang['help_cronzip']="Kompression mit GZip - emfohlen ist 'aktiviert' (die Kompressions-Lib muss installiert sein!).";
$lang['help_cronperlpath']="Der Pfad zu Perl muss korrekt angegeben werden, sonst ist das Skript nicht lauff&auml;hig.
In den meisten F&auml;llen ist das der vorgegebene Standardpfad.";
$lang['help_cronextender']="Die Endung des Perlscriptes, Standard ist '.pl'.";
$lang['help_cronsavepath']="Der Name der Konfigurationsdatei f&uuml;r das Perlskript.";
$lang['help_cronprintout']="Wenn die Textausgabe abgeschaltet ist, wird kein Text mehr ausgegeben.
Diese Funktion ist unabh&auml;ngig von der Logausgabe.";
$lang['help_cronsamedb']="Soll die gleiche Datenbank f&uuml;r Cronjob wie in Einstellungen benutzt werden?";
$lang['help_crondbindex']="W&auml;hle die Datenbank f&uuml;r den Cronjob.";
$lang['help_cronmail_dump']="";
$lang['help_ftptransfer']="Wenn aktiviert, wird nach dem Backup die Datei per FTP gesendet.";
$lang['help_ftpserver']="Adresse des FTP-Servers.";
$lang['help_ftpport']="Port des FTP-Servers, Standard: 21.";
$lang['help_ftpuser']="Gibt den Benutzernamen der FTP-Verbindung an.";
$lang['help_ftppass']="Gibt das Passwort der FTP-Verbindung an.";
$lang['help_ftpdir']="Wohin soll das File gesendet werden?";
$lang['help_chmod']="Standardeinstellung ist 777.";
$lang['help_speed']="Minimale und maximale Geschwindigkeit, Standard ist 50 bis 5000
(zu hohe Geschwindigkeiten k&ouml;nnen zu Timeouts f&uuml;hren!).";
$lang['speed']="Geschwindigkeitskontrolle";
$lang['help_cronexecpath']="Der Ort, an dem die Perlskripte liegen.
Ausgangspunkt ist die HTTP-Adresse (also im Browser)
Erlaubt sind absolute und relative Pfadangaben.";
$lang['cron_execpath']="Pfad der Perlskripte";
$lang['help_browser']="W&auml;hle Deinen Browser.
Achtung: Benutze nicht den Internet Explorer mit der Einstellung 'andere Browser'!";
$lang['help_croncompletelog']="Wenn die Funktion aktiviert ist, wird die komplette Ausgabe im complete_log geschrieben. 
Diese Funktion ist unabh&auml;ngig von der Textausgabe.";


?>