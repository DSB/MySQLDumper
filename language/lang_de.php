<?php
// Die Sprachdateien werden in der config.php geladen. Deswegen muss diese vorher stets eingebunden werden, damit
// die unten aufgef&uuml;hrten Variablen zur Verf&uuml;gung stehen.

$cron_script=$rootdir.'/cron_dump.php';
$cron_abs=$_SERVER["DOCUMENT_ROOT"].'/cron_dump.php';

// Allgemeine Texte
$l["no"]="nein";
$l["yes"]="ja";
$l["activated"]="aktiviert";
$l["not_activated"]="nicht aktiviert";
$l["error"]="Fehler";
$l["added"]="hinzugefügt";
$l["added"]="hinzugefügt";
$l["first_run"]="Datenbanken gefunden:";
$l["dbrefresh"]="Datenbanken neu laden";
$l["db"]="Datenbank";


//Hilfe-Texte
$l["help_db"]="Dies ist die Liste der vorhandenen Datenbanken";
$l["help_praefix"]="Der Praefix ist eine Zeichenfolge für den Anfang von Tabellen, der als Filter fungiert.";
$l["help_zip"]="Kompression mit GZip - emfohlen ist 'aktiviert'";
$l["help_budir"]="Hier werden die Datenbank-Backups gespeichert.";
$l["help_mail1"]="Wenn aktiviert, dann wird nach Wiederherstellung eine Email mit dem Backup verschickt.";
$l["help_mail2"]="Dies ist die Empfänger-Adresse der Email.";
$l["help_mail3"]="Dies ist die Absende-Adresse der Email.";
$l["help_ad1"]="Wenn aktiviert, dann werden automatisch Backupfiles gelöscht.";
$l["help_ad2"]="die maximale Anzahl von Tagen, die ein Backupfile haben darf (für Autodelete)";
$l["help_ad3"]="die maximale Anzahl von Dateien, die im Backupverzeichnis sein dürfen (für Autodelete)";
$l["help_lang"]="stell auf die gewünschte Sprache";
$l["help_crontime"]="die Zeit, die das Cronscript zusätzlich bekommt (in Sekunden)";
$l["help_cronsamedb"]="Soll die gleiche Datenbank für Cronjob wie in Einstellungen benutzt werden?";
$l["help_crondbindex"]="wähle die Datenbank für den Cronjob";

$l["help_dumpz"]="Das ist die Anzahl der Zeilen, die beim Backup in einem Rutsch ausgelesen werden";
$l["help_restorez"]="Das ist die Anzahl der Zeilen, die bei der Wiederherstellung in einem Rutsch geschrieben werden";


// Text in filemanagement.php
$l["fm_title"]="Verwaltung";
$l["fm_uploadfilerequest"]="Bitte gib eine Datei an.";
$l["fm_uploadnotallowed1"]="Dieser Dateityp ist nicht erlaubt.";
$l["fm_uploadnotallowed2"]="G&uuml;ltige Typen sind: *.gz und *.sql-Dateien";
$l["fm_uploadmoveerror"]="Konnte die hochgeladene Datei nicht in den richtigen Ordner verschieben.";
$l["fm_uploadfailed"]="Der Upload ist leider fehlgeschlagen!";
$l["fm_uploadfileexists"]="Es existiert bereits eine Datei mit diesem Namen !";
$l["fm_nofile"]="Du hast gar keine Datei ausgew&auml;hlt!";
$l["fm_delete1"]="Die Datei ";
$l["fm_delete2"]=" wurde erfolgreich gel&ouml;scht.";
$l["fm_delete3"]=" konnte nicht gel&ouml;scht werden!";
$l["choose_file"]="gew&auml;hlte Datei:";

$l["fm_filename"]="Dateiname";
$l["fm_filesize"]="Dateigr&ouml;&szlig;e";
$l["fm_nofilesfound"]="Keine Datei gefunden.";
$l["fm_sizesum"]="Gesamtgr&ouml;&szlig;e";
$l["fm_freespace"]="Freier Speicher auf Server";
$l["fm_choosefile"]="W&auml;hle eine Datei zur Wiederherstellung oder zum L&ouml;schen aus:";
$l["fm_restore"]="Wiederherstellen";
$l["fm_alertrestore1"]="Soll die Datenbank ";
$l["fm_alertrestore2"]="mit den Inhalten der Datei";
$l["fm_alertrestore3"]="wiederhergestellt werden?";
$l["fm_delete"]="L&ouml;schen";
$l["fm_askdelete1"]="M&ouml;chtest Du die Datei ";
$l["fm_askdelete2"]=" wirklich l&ouml;schen?";
$l["fm_askdelete3"]="Möchten sie Autodelete nach den eingestellten Regeln jetzt ausführen?";
$l["fm_askdelete4"]="Möchten sie alle Backupdateien jetzt löschen?";
$l["fm_askdelete5"]="Möchten sie alle Backupdateien mit ".$dbname."_* jetzt löschen?";
$l["fm_deleteauto"]="Autodelete manuell ausführen";
$l["fm_deleteall"]="alle Backupdateien löschen";
$l["fm_deleteallfilter"]="alle löschen mit ".$dbname."_*";

$l["fm_newdump"]="Oder beginne ein neues Backup:";
$l["fm_startdump"]="Neues Backup starten";
$l["fm_upload"]="Oder lade eine Datei hoch:";
$l["fm_fileupload"]="Datei hochladen";
$l["fm_files"]="Files im Backupverzeichnis";
$l["fm_autodel1"]="Autodelete: Folgende Dateien wurden aufgrund der maximalen Files gel&ouml;scht:";
$l["fm_autodel2"]="Autodelete: Folgende Dateien wurden aufgrund ihres Erstellungsdatums gel&ouml;scht:";

$l["fm_dumpsettings"]="Folgende Datenbank wird mit folgendem [Präfix] gesichert: <strong>$dbname [$dbpraefix]</strong>";

$l["cron_adress"]="Adresse des Cronscripts: <a href=\"".$cron_script."\" style=\"text-decoration:underline\">".$cron_script."</a>";
$l["cron_desc"]="Das Cronscript läuft ohne eine Text-Ausgabe und benutzt die eingestellten Parameter incl. Mail- und FTP-Versand.<br>Bitte überzeugt euch vorher, das das Backup mit den eingestellten Parametern funktioniert, bevor ihr das Cronscript einsetzt.<br>ev. muss das Timelimit angepasst werden. Ihr könnt aus dem Log entnehmen, wie lange der Prozess gedauert hat.<br>das Cronscript liegt auf dem server unter '".$cron_abs."' <br>WICHTIG: Das Script funktioniert nur bis zu einer bestimmten Datenbankgrösse!";

$l["DoCronButton"]="Perl-Cronscript ausführen";
$l["cronperldesc"]="Dies geht nur, wenn Perl ausgeführt werden kann. <br>Das Script liegt unter ";

// Text in dump.php
$l["dump"]="Backup";
$l["dump_headline"]="erzeuge Backup...";
$l["gzip_compression"]="GZip-Kompression ist";
$l["on"]="an";
$l["off"]="aus";
$l["saving_table"]="Speichere Tabelle ";
$l["of"]="von";
$l["actual_table"]="Aktuelle Tabelle";
$l["progress_table"]="Fortschritt Tabelle";
$l["progress_over_all"]="Fortschritt gesamt";
$l["entry"]="Eintrag";
$l["done"]="Fertig!";
$l["file"]="Datei";
$l["dump_successful"]=" wurde erfolgreich erstellt.";
$l["upto"]="bis";
$l["email_was_send"]="Das Dumpfile wurde erfolgreich per Email verschickt.";
$l["back_to_control"]="weiter";
$l["dump_filename"]="Backup-Datei: ";

$l["dump_notables"]="Ich konnte keine Tabellen in der Datenbank '<b>".$dbname."</b>' finden.";
$l["dump_endergebnis1"]="Es wurden ";
$l["dump_endergebnis2"]=" Tabellen mit insgesamt ";
$l["dump_endergebnis3"]=" Datensätzen gesichert.<br>";
$l["mailerror"]="Leider ist beim Verschicken der Email ein Fehler aufgetreten!";
$l["emailbody"]="In der Anlage findest Du die Sicherung Deiner MySQL-Datenbank.\n\rSicherung der Datenbank '".$dbname."' vom ".date("d\.m\.Y",time())."\n\r\n\rViele Grüsse\n\r\n\rMySQLDump\n\rhttp://www.daniel-schlichtholz.de/board";
					
// Text in restore.php
$l["restore"]="Wiederherstellung";
$l["restore_db"]="der Datenbank '<b>".$dbname."</b>' auf '<b>".$dbhost."</b>'.<br>";
$l["restore_complete"]="</b> Tabellen wurden komplett wiederhergestellt.";
$l["restore_run1"]="<br>Bisher wurden <b>";
$l["restore_run2"]="</b> Datens&auml;tze erfolgreich eingetragen.";
$l["restore_run3"]="<br>Momentan wird die Tabelle '<b>";
$l["restore_run4"]="</b>' mit Daten gef&uuml;llt.<br>";
$l["restore_run5"]="der Datei eingetragen.";
$l["restore_total_complete"]="<br><b>Herzlichen Gl&uuml;ckwunsch.</b><br><br>Die Datenbank wurde komplett wiederhergestellt.<br>Alle Daten aus der Backupdatei wurden erfolgreich in die Datenbank eingetragen.<br><br>Alles fertig. :-)";
$l["db_no_connection"]="Keine Verbindung zur Datenbank m&ouml;glich!";
$l["db_select_error"]="<br>Fehler:<br>Auswahl der Datenbank '<b>".$dbname."</b>' fehlgeschlagen!";
$l["file_open_error"]="Fehler: Ich konnte die Datei nicht &ouml;ffnen.";
$l["restore_entryerror"]="Fehler beim Eintrag des Befehls:";


// Text in config_overview.php
$l["config_headline"]="Konfiguration";
$l["dump_dir"]="Die Backupdatei wird im Ordner '<b>".realpath($path)."</b>' gespeichert.";
$l["saving_db"]="Gesichert wird die Datenbank '<b>".$dbhost."/".$dbname."</b>'.";
$l["send_mail"]="Die fertige Backupdatei wird per Email an '<b>".$email[0]."</b>' geschickt.";
$l["no_send_mail"]="Die fertige Backupdatei wird <b>nicht</b> per Email verschickt.";
$l["del_files"]="Dateien werden automatisch gel&ouml;scht, wenn sie &auml;lter als '<b>".$del_files."</b>' Tage sind.";
$l["no_del_files"]="Es gibt keine Altersbegrenzung der Backupdateien.";
$l["number_of_files"]="Dateien werden automatisch gel&ouml;scht, wenn mehr als '<b>".$number_of_files."</b>' in ".realpath($path)." gespeichert sind.";
$l["no_number_of_files"]="Es gibt keine Begrenzung der Anzahl von Backupdateien.";
$l["save_success"]="Die Einstellungen wurden erfolgreich gespeichert.";
$l["save_error"]="Die Einstellungen konnten nicht gespeichert werden !";
$l["config_databases"]="Datenbanken";
$l["config_dumprestore"]="Backup / Wiederherstellung";
$l["config_email"]="Email-Benachrichtigung";
$l["config_autodelete"]="automatisches L&ouml;schen";
$l["config_interface"]="Interface";
$l["config_cron"]="Crondump-Einstellungen";
$l["cron_timelimit"]="Zeitlimit f&uuml;r Cronjob";
$l["praefix"]="Tabellen-Pr&auml;fix";
$l["config_askload"]="Sollen die Einstellungen wirklich mit den Anfangseinstellungen überschrieben werden?";
$l["load"]="Anfangseinstellungen laden";
$l["load_success"]="Die Anfangseinstellungen wurden geladen.";
$l["cron_samedb"]="Datenbank aus Einstellungen nehmen";
$l["cron_crondbindex"]="Datenbank und Tabellen-Präfix<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;für den Cronjob";
$l["dump_zeilen"]="Anzahl der Zeilen beim Backup";
$l["restore_zeilen"]="Anzahl der Zeilen bei Wiederherstellung";


// Text in config_overview.php - Formular
$l["gzip"]="GZip-Kompression";
$l["backup_dir"]="Backup-Verzeichnis";
$l["db_host"]="Hostname";
$l["saving_db_form"]="Datenbank";
$l["db_user"]="Benutzer";
$l["db_pass"]="Passwort";
$l["send_mail_form"]="Email mit Dumpfile";
$l["email_adress"]="Email-Adresse";
$l["email_subject"]="Absender der Email";
$l["age_of_files"]="Alter der Dateien (in Tagen)";
$l["number_of_files_form"]="Anzahl von Backupdateien";
$l["language"]="Sprache";
$l["list_db"]="Konfigurierte Datenbanken:";
$l["save"]="Speichern";
$l["reset"]="zur&uuml;cksetzen";
$l["autodelete"]="automatisches L&ouml;schen der Backups";


$l["help_ftptransfer"]="wenn aktiviert, wird nach Backup die Datei per FTP gesendet.";
$l["help_ftpserver"]="Adresse des FTP-Servers";
$l["help_ftpport"]="Port des FTP-Servers, Standard: 21";
$l["help_ftpuser"]="gib den Benutzername der FTP-Verbindung an";
$l["help_ftppass"]="gib das Passwort der FTP-Verbindung an";
$l["help_ftpdir"]="wohin soll das File gesendet werden?";

$l["config_ftp"]="FTP-Transfer der Backupdatei";

$l["ftp_transfer"]="FTP-Transfer";
$l["ftp_server"]="FTP Server";
$l["ftp_port"]="FTP Port";
$l["ftp_user"]="FTP User";
$l["ftp_pass"]="FTP Passwort";
$l["ftp_dir"]="FTP Upload-Ordner";



// Sprachen
$l["lang_de"]="Deutsch";
$l["lang_en"]="Englisch";

// Text aus menu.php
$l["load_database"]="Datenbanken neu laden";
$l["home"]="Home";
$l["config"]="Konfiguration";
$l["file_manage"]="Verwaltung";
$l["log"]="Log";
$l["project"]="&Uuml;ber das Projekt";
$l["choose_db"]="Datenbank w&auml;hlen";
$l["credits"]="Credits / Hilfe";


//Log
$l["log_delete"]="Log l&ouml;schen";

// Texte aus info.php
$l["info_location"]="Du befindest Dich auf ";
$l["info_browser"]="Dein Browser ist";
$l["info_admin"]="Der Serveradministrator ist ";
$l["info_databases"]="Folgende Datenbank(en) befinden sich auf dem MySql-Server:";
$l["info_nodb"]="Datenbank existiert nicht";
$l["info_table1"]="Tabelle";
$l["info_table2"]="n";
$l["info_dbdetail"]="Detail-Info von Datenbank ";
$l["info_dbempty"]="Die Datenbank ist leer !";
$l["info_records"]="Datens&auml;tze";
$l["info_size"]="Gr&ouml;sse";
$l["info_lastupdate"]="letztes Update";
$l["info_sum"]="insgesamt";
$l["info_rechte"]="Deine Rechte";
$l["info_cronyes"]="Du kannst MySQLDump als Cronjob durchf&uuml;hren.";
$l["info_cronno"]="Aufgrund deiner PHP-Einstellungen (safe_mode=on) kannst du MySQLDump nicht als Cronjob durchf&uuml;hren!'";

$l["clear_database"]="Datenbank leeren";
$l["delete_database"]="Datenbank l&ouml;schen";
$l["create_database"]="neue Datenbank anlegen:";
$l["button_create_database"]="anlegen";

$l["info_created"]="angelegt";
$l["info_cleared"]="wurde geleert";
$l["info_deleted"]="wurde gelöscht";

$l["info_workdir"]="Arbeitsverzeichnis";
$l["info_backupdir"]="Backupverzeichnis";
$l["info_cgidir"]="CGI-Bin-Verzeichnis";
$l["info_cginr"]="nicht vorhanden oder kein Zugriffsrecht";
$l["info_actdb"]="Aktuelle Datenbank";


$l["info_emptydb1"]="Soll die Datenbank";
$l["info_emptydb2"]=" wirklich geleert werden? (ACHTUNG: Alle Daten gehen unwideruflich verloren)";
$l["info_killdb"]=" wirklich gelöscht werden? (ACHTUNG: Alle Daten gehen unwideruflich verloren)";

?>