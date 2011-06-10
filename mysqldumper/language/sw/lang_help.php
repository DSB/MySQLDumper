<?php
//generated at 17.03.2007

$lang['help_db']="Dies ist die Liste der vorhandenen Datenbanken";
$lang['help_praefix']="Der Präfix ist eine Zeichenfolge für den Anfang von Tabellen, der als Filter fungiert.";
$lang['help_zip']="Kompression mit GZip - emfohlen ist 'aktiviert'";
$lang['help_memorylimit']="Das ist die max. Größe in Bytes, die das Skript an Speicher bekommt
0 = deaktiviert";
$lang['memory_limit']="Speichergrenze";
$lang['help_mail1']="Wenn aktiviert, dann wird nach der Erstellung der Sicherung eine Email mit dem Backup verschickt.";
$lang['help_mail2']="Dies ist die Empfänger-Adresse der Email.";
$lang['help_mail3']="Dies ist die Absende-Adresse der Email.";
$lang['help_mail4']="Die maximale Größe für einen Email-Anhang, bei 0 bleibt die Angabe unberücksichtigt.";
$lang['help_mail5']="Hier kann bestimmt werden, ob das Backup als Email-Anhang verschickt werden soll.";
$lang['help_ad1']="Wenn aktiviert, dann werden automatisch Backupfiles gelöscht.";
$lang['help_ad2']="Die maximale Anzahl von Tagen, die ein Backupfile haben darf (für Autodelete)
0 = deaktiviert";
$lang['help_ad3']="Die maximale Anzahl von Dateien, die im Backupverzeichnis sein dürfen (für Autodelete)
0 = deaktiviert";
$lang['help_lang']="Stellt auf die gewünschte Sprache";
$lang['help_empty_db_before_restore']="Um überflüssige Daten zu eleminieren, kann man anweisen, die Datenbank vor der Wiederherstellung komplett zu leeren.";
$lang['help_cronmail']="Bestimmt, ob im Cronjob das Backup per Mail verschickt werden soll.";
$lang['help_cronmailprg']="Der Pfad zum Mailprogramm, default ist sendmail im angegebenen Pfad.";
$lang['help_cronftp']="Bestimmt, ob im Cronjob das Backup per FTP verschickt werden soll";
$lang['help_cronzip']="Kompression mit GZip - emfohlen ist 'aktiviert' (die Kompressions-Lib muss installiert sein!).";
$lang['help_cronextender']="Die Endung des Perlscriptes, Standard ist '.pl'.";
$lang['help_cronsavepath']="Der Name der Konfigurationsdatei für das Perlskript.";
$lang['help_cronprintout']="Wenn die Textausgabe abgeschaltet ist, wird kein Text mehr ausgegeben.
Diese Funktion ist unabhängig von der Logausgabe.";
$lang['help_cronsamedb']="Soll die gleiche Datenbank für Cronjob wie in Einstellungen benutzt werden?";
$lang['help_crondbindex']="Wähle die Datenbank für den Cronjob.";
$lang['help_cronmail_dump']="Select if the Cron job should attach the backup to the email.";
$lang['help_ftptransfer']="Wenn aktiviert, wird nach dem Backup die Datei per FTP gesendet.";
$lang['help_ftpserver']="Adresse des FTP-Servers.";
$lang['help_ftpport']="Port des FTP-Servers, Standard: 21.";
$lang['help_ftpuser']="Gibt den Benutzernamen der FTP-Verbindung an.";
$lang['help_ftppass']="Gibt das Passwort der FTP-Verbindung an.";
$lang['help_ftpdir']="Wohin soll das File gesendet werden?";
$lang['help_speed']="Minimale und maximale Geschwindigkeit, Standard ist 50 bis 5000
(zu hohe Geschwindigkeiten können zu Timeouts führen!).";
$lang['speed']="Geschwindigkeitskontrolle";
$lang['help_cronexecpath']="Der Ort, an dem die Perlskripte liegen.
Ausgangspunkt ist die HTTP-Adresse (also im Browser)
Erlaubt sind absolute und relative Pfadangaben.";
$lang['cron_execpath']="Perl-skriptens sökväg";
$lang['help_croncompletelog']="Wenn die Funktion aktiviert ist, wird die komplette Ausgabe im complete_log geschrieben.
Diese Funktion ist unabhängig von der Textausgabe.";
$lang['help_ftp_mode']="When problems occur while transfering via FTP, try to use the passive mode. ";


?>