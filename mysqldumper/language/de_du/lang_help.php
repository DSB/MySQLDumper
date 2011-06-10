<?php
//generated at 17.03.2007

$lang['help_db']="Dies ist die Liste der vorhandenen Datenbanken.";
$lang['help_praefix']="Der Präfix ist eine Zeichenfolge für den Anfang von Tabellen, der als Filter fungiert.";
$lang['help_zip']="Kompression mit GZip - emfohlen ist 'aktiviert'.";
$lang['help_memorylimit']="Das ist die maximale Größe in Bytes, die das Skript an Speicher bekommt.
0 = deaktiviert";
$lang['memory_limit']="Speichergrenze";
$lang['help_mail1']="Wenn aktiviert, dann wird nach der Erstellung der Sicherung eine E-Mail mit dem Backup verschickt.";
$lang['help_mail2']="Dies ist die Empfänger-Adresse der E-Mail.";
$lang['help_mail3']="Dies ist die Absende-Adresse der E-Mail.";
$lang['help_mail4']="Die maximale Größe für einen E-Mail-Anhang. Bei 0 bleibt die Angabe unberücksichtigt.";
$lang['help_mail5']="Hier kann bestimmt werden, ob das Backup als E-Mail-Anhang verschickt werden soll.";
$lang['help_ad1']="Wenn aktiviert, dann werden automatisch Backup-Dateien gelöscht.";
$lang['help_ad2']="Die maximale Anzahl von Tagen, die eine Backup-Datei haben darf (für Autodelete).
0 = deaktiviert";
$lang['help_ad3']="Die maximale Anzahl von Dateien, die im Backup-Verzeichnis sein dürfen (für Autodelete).
0 = deaktiviert";
$lang['help_lang']="Stellt auf die gewünschte Sprache.";
$lang['help_empty_db_before_restore']="Um überflüssige Daten zu eliminieren, kann man anweisen, die Datenbank vor der Wiederherstellung komplett zu leeren.";
$lang['help_cronmail']="Bestimmt, ob im Cronjob das Backup per E-Mail verschickt werden soll.";
$lang['help_cronmailprg']="Der Pfad zum E-Mail-Programm. Default ist sendmail im angegebenen Pfad.";
$lang['help_cronftp']="Bestimmt, ob im Cronjob das Backup per FTP verschickt werden soll.";
$lang['help_cronzip']="Kompression mit GZip. Emfohlen ist 'aktiviert'. (Die Kompressions-Lib muss installiert sein!)";
$lang['help_cronextender']="Die Endung des Perlscriptes, Standard ist '.pl'.";
$lang['help_cronsavepath']="Der Name der Konfigurationsdatei für das Perlskript.";
$lang['help_cronprintout']="Wenn die Textausgabe abgeschaltet ist, wird kein Text mehr ausgegeben.
Diese Funktion ist unabhängig von der Log-Ausgabe.";
$lang['help_cronsamedb']="Soll die gleiche Datenbank für Cronjob wie in den Einstellungen benutzt werden?";
$lang['help_crondbindex']="Wähle die Datenbank für den Cronjob.";
$lang['help_cronmail_dump']="Bestimmt, ob die vom Cronjob verschickten Email das Backup als Anhang enthalten soll. ";
$lang['help_ftptransfer']="Wenn aktiviert, wird nach dem Backup die Datei per FTP gesendet.";
$lang['help_ftpserver']="Adresse des FTP-Servers.";
$lang['help_ftpport']="Port des FTP-Servers. Standard: 21.";
$lang['help_ftpuser']="Gibt den Benutzernamen der FTP-Verbindung an.";
$lang['help_ftppass']="Gibt das Passwort der FTP-Verbindung an.";
$lang['help_ftpdir']="Wohin soll die Datei gesendet werden?";
$lang['help_speed']="Minimale und maximale Geschwindigkeit. Standard ist 50 bis 5000.
(Zu hohe Geschwindigkeiten können zu Timeouts führen!)";
$lang['speed']="Geschwindigkeitskontrolle";
$lang['help_cronexecpath']="Der Ort, an dem die Perlskripte liegen.
Ausgangspunkt ist die HTTP-Adresse (also im Browser).
Erlaubt sind absolute und relative Pfadangaben.";
$lang['cron_execpath']="Pfad der Perlskripte";
$lang['help_croncompletelog']="Wenn die Funktion aktiviert ist, wird die komplette Ausgabe im complete_log geschrieben.
Diese Funktion ist unabhängig von der Textausgabe.";
$lang['help_ftp_mode']="Wenn Probleme bei der FTP-Übertragung auftauchen, versuche den passiven FTP-Modus.";


?>