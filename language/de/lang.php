<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
  * http://www.mysqldumper.net
 * 
 * @package       MySQLDumper
 * @subpackage    Languages
 * @version       $Rev$
 * @author        $Author$
 * @lastmodified  $Date$
  */
$lang=array_merge($lang, array(
    'L_ACTION' => "Aktion",
    'L_ACTIVATED' => "aktiviert",
    'L_ACTUALLY_INSERTED_RECORDS' => "Es wurden bisher <b>%s</b> Datensätze"
    ." erfolgreich eingetragen.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Es wurden bisher <b>%s</b> von"
    ." <b>%s</b> Datensätzen erfolgreich"
    ." eingetragen.",
    'L_ADD' => "Hinzufügen",
    'L_ADDED' => "hinzugefügt",
    'L_ADD_DB_MANUALLY' => "Datenbank manuell hinzufügen",
    'L_ADD_RECIPIENT' => "Empfänger hinzufügen",
    'L_ALL' => "alle",
    'L_ANALYZE' => "Analysiere",
    'L_ANALYZING_TABLE' => "Momentan werden Daten der Tabelle"
    ." '<b>%s</b>' analysiert.",
    'L_ASKDBCOPY' => "Soll der Inhalt der Datenbank `%s` in"
    ." die Datenbank `%s` kopiert werden?",
    'L_ASKDBDELETE' => "Soll die Datenbank `%s` samt Inhalt"
    ." wirklich gelöscht werden?",
    'L_ASKDBEMPTY' => "Soll die Datenbank `%s` wirklich"
    ." geleert werden?",
    'L_ASKDELETEFIELD' => "Soll das Feld gelöscht werden?",
    'L_ASKDELETERECORD' => "Soll der Datensatz gelöscht werden?",
    'L_ASKDELETETABLE' => "Soll die Tabelle `%s` gelöscht"
    ." werden?",
    'L_ASKTABLEEMPTY' => "Soll die Tabelle `%s` geleert werden?",
    'L_ASKTABLEEMPTYKEYS' => "Sollen die Tabelle `%s` geleert und"
    ." die Indizes zurückgesetzt werden?",
    'L_ATTACHED_AS_FILE' => "als Datei angehängt",
    'L_ATTACH_BACKUP' => "Backup anhängen",
    'L_AUTHORIZE' => "Autorisieren",
    'L_AUTODELETE' => "Automatisches Löschen der Backups",
    'L_BACK' => "zurück",
    'L_BACKUPFILESANZAHL' => "Im Backup-Verzeichnis befinden sich",
    'L_BACKUPS' => "Sicherungsdateien",
    'L_BACKUP_DBS' => "zu sichernde DBs",
    'L_BACKUP_TABLE_DONE' => "Sicherung der Tabelle `%s`"
    ." abgeschlossen. %s Datensätze wurden"
    ." gespeichert.",
    'L_BACK_TO_OVERVIEW' => "Datenbank-Übersicht",
    'L_BACK_TO_OVERVIEW' => "Datenbank-Übersicht",
    'L_CALL' => "Aufruf",
    'L_CANCEL' => "Abbruch",
    'L_CANT_CREATE_DIR' => "Ich konnte das Verzeichnis '%s' nicht"
    ." erstellen.
Bitte erstellen Sie es mit"
    ." Ihrem FTP-Programm.",
    'L_CHANGE' => "Ändern",
    'L_CHANGEDIR' => "Wechsel ins Verzeichnis",
    'L_CHANGEDIR' => "Wechsle in das Verzeichnis",
    'L_CHANGEDIRERROR' => "Wechsel ins Verzeichnis nicht möglich",
    'L_CHANGEDIRERROR' => "Es konnte nicht in das Verzeichnis"
    ." gewechselt werden!",
    'L_CHARSET' => "Zeichensatz",
    'L_CHECK' => "Überprüfe",
    'L_CHECK' => "prüfen",
    'L_CHECK_DIRS' => "Verzeichnisse überprüfen",
    'L_CHOOSE_CHARSET' => "Leider konnte nicht automatisch"
    ." ermittelt werden mit welchem"
    ." Zeichensatz diese Backupdatei"
    ." seinerzeit angelegt wurde. 
<br />Sie"
    ." müssen die Kodierung, in der"
    ." Zeichenketten in dieser Datei"
    ." vorliegen, manuell angeben.
<br"
    ." />Danach stellt MySQLDumper die"
    ." Verbindungskennung zum MySQL-Server"
    ." auf den ausgewählten Zeichensatz und"
    ." beginnt mit der Wiederherstellung der"
    ." Daten.
<br />Sollten Sie nach der"
    ." Wiederherstellung Probleme mit"
    ." Sonderzeichen entdecken, so können"
    ." Sie versuchen, das Backup mit einer"
    ." anderen Zeichensatzauswahl"
    ." wiederherzustellen.
<br />Viel Glück."
    ." ;)",
    'L_CHOOSE_DB' => "Datenbank wählen",
    'L_CLEAR_DATABASE' => "Datenbank leeren",
    'L_CLOSE' => "Schließen",
    'L_COLLATION' => "Sortierung",
    'L_COMMAND' => "Befehl",
    'L_COMMAND' => "Befehl",
    'L_COMMAND_AFTER_BACKUP' => "Befehl nach Backup",
    'L_COMMAND_BEFORE_BACKUP' => "Befehl vor Backup",
    'L_COMMENT' => "Kommentar",
    'L_COMPRESSED' => "komprimiert (gz)",
    'L_CONFBASIC' => "Grundeinstellungen",
    'L_CONFIG' => "Konfiguration",
    'L_CONFIGFILE' => "Konfigurationsdatei",
    'L_CONFIGFILES' => "Konfigurationsdateien",
    'L_CONFIGURATIONS' => "Einstellungen",
    'L_CONFIG_AUTODELETE' => "Automatisches Löschen",
    'L_CONFIG_CRONPERL' => "Crondump-Einstellungen für das"
    ." Perlscript",
    'L_CONFIG_EMAIL' => "E-Mail-Benachrichtigung",
    'L_CONFIG_FTP' => "FTP-Transfer der Backup-Datei",
    'L_CONFIG_HEADLINE' => "Konfiguration",
    'L_CONFIG_INTERFACE' => "Oberfläche",
    'L_CONFIG_LOADED' => "Die Konfiguration \"%s\" wurde"
    ." erfolgreich geladen.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Soll die Konfigurationsdatei %s"
    ." wirklich gelöscht werden?",
    'L_CONFIRM_DELETE_TABLES' => "Sollen die gewählten Tabellen"
    ." wirklich gelöscht werden?",
    'L_CONFIRM_DROP_DATABASES' => "Soll/en die gewählte/n Datenbank/en"
    ." wirklich gelöscht werden?

Achtung:"
    ." alle Daten gehen unwiderruflich"
    ." verloren! Legen Sie sicherheitshalber"
    ." vorher eine Sicherung der Daten an.",
    'L_CONFIRM_RECIPIENT_DELETE' => "Soll der Empfänger \"%s\" wirklich"
    ." entfernt werden?",
    'L_CONFIRM_TRUNCATE_DATABASES' => "Soll/en die gewählte/n Datenbank/en"
    ." wirklich geleert werden?

Achtung:"
    ." alle Tabellen gehen unwiderruflich"
    ." verloren! Legen Sie sicherheitshalber"
    ." vorher eine Sicherung der Daten an.",
    'L_CONFIRM_TRUNCATE_TABLES' => "Sollen die gewählten Tabellen"
    ." wirklich geleert werden?",
    'L_CONNECT' => "verbinden",
    'L_CONNECTIONPARS' => "Verbindungsparameter",
    'L_CONNECTTOMYSQL' => "zu MySQL verbinden",
    'L_CONTINUE_MULTIPART_RESTORE' => "Multipart-Wiederherstellung mit"
    ." nächster Datei '%s' fortfahren .",
    'L_CONVERTED_FILES' => "Konvertierte Dateien",
    'L_CONVERTER' => "Backup-Konverter",
    'L_CONVERTING' => "Konvertierung",
    'L_CONVERT_FILE' => "zu konvertierende Datei",
    'L_CONVERT_FILENAME' => "Name der Zieldatei (ohne Endung)",
    'L_CONVERT_FILEREAD' => "Datei '%s' wird eingelesen",
    'L_CONVERT_FINISHED' => "Konvertierung abgeschlossen, '%s'"
    ." wurde erzeugt.",
    'L_CONVERT_START' => "Konvertierung starten",
    'L_CONVERT_TITLE' => "Konvertiere Dump ins MSD-Format",
    'L_CONVERT_WRONG_PARAMETERS' => "Falsche Parameter! Konvertierung ist"
    ." nicht möglich.",
    'L_CREATE' => "anlegen",
    'L_CREATEAUTOINDEX' => "Auto-Index erzeugen",
    'L_CREATEDIRS' => "erstelle Verzeichnisse",
    'L_CREATE_CONFIGFILE' => "Eine neue Konfigurationsdatei anlegen",
    'L_CREATE_DATABASE' => "Neue Datenbank anlegen",
    'L_CREATE_TABLE_SAVED' => "Definition der Tabelle `%s`"
    ." gespeichert.",
    'L_CREDITS' => "Credits / Hilfe",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Kommentar eingeben",
    'L_CRON_COMPLETELOG' => "Komplette Ausgabe loggen",
    'L_CRON_EXECPATH' => "Pfad der Perlskripte",
    'L_CRON_EXTENDER' => "Dateiendung des Scripts",
    'L_CRON_PRINTOUT' => "Textausgabe",
    'L_CSVOPTIONS' => "CSV-Optionen",
    'L_CSV_EOL' => "Zeilen getrennt mit",
    'L_CSV_ERRORCREATETABLE' => "Fehler beim Erstellen der Tabelle"
    ." `%s`!",
    'L_CSV_FIELDCOUNT_NOMATCH' => "Die Anzahl der Tabellenfelder stimmen"
    ." nicht mit den zu importierenden Daten"
    ." überein (%d statt %d).",
    'L_CSV_FIELDSENCLOSED' => "Felder eingeschlossen von",
    'L_CSV_FIELDSEPERATE' => "Felder getrennt mit",
    'L_CSV_FIELDSESCAPE' => "Felder escaped von",
    'L_CSV_FIELDSLINES' => "%d Felder ermittelt, insgesamt %d"
    ." Zeilen",
    'L_CSV_FILEOPEN' => "CSV-Datei öffnen",
    'L_CSV_NAMEFIRSTLINE' => "Feldnamen in die erste Zeile",
    'L_CSV_NODATA' => "Keine Daten zum Importieren gefunden!",
    'L_CSV_NULL' => "Ersetze NULL durch",
    'L_DATASIZE' => "Datengröße",
    'L_DATASIZE_INFO' => "Dies ist die Größe der Datensätze -"
    ." nicht die Größe der Sicherungsdatei",
    'L_DAY' => "Tag",
    'L_DAYS' => "Tage",
    'L_DB' => "Datenbank",
    'L_DBCONNECTION' => "Datenbank-Verbindung",
    'L_DBPARAMETER' => "Datenbank-Parameter",
    'L_DBS' => "Datenbanken",
    'L_DB_BACKUPPARS' => "Einstellungen",
    'L_DB_HOST' => "Datenbank-Hostname",
    'L_DB_IN_LIST' => "Die Datenbank '%s' konnte nicht"
    ." hinzugefügt werden, da sie bereits"
    ." vorhanden ist.",
    'L_DB_PASS' => "Datenbank-Passwort",
    'L_DB_SELECT_ERROR' => "<br />Fehler:<br />Auswahl der"
    ." Datenbank '<b>",
    'L_DB_SELECT_ERROR2' => "</b>' fehlgeschlagen!",
    'L_DB_USER' => "Datenbank-Benutzer",
    'L_DEFAULT_CHARSET' => "Standardzeichensatz",
    'L_DELETE' => "Lösche",
    'L_DELETE_DATABASE' => "Datenbank löschen",
    'L_DELETE_FILE_ERROR' => "Die Datei \"%s\" konnte nicht"
    ." gelöscht werden!",
    'L_DELETE_FILE_SUCCESS' => "Die Datei \"%s\" wurde erfolgreich"
    ." gelöscht.",
    'L_DELETE_HTACCESS' => "Verzeichnisschutz entfernen (.htaccess"
    ." löschen)",
    'L_DESELECTALL' => "Auswahl aufheben",
    'L_DIR' => "Verzeichnis",
    'L_DISABLEDFUNCTIONS' => "Abgeschaltete Funktionen",
    'L_DISABLEDFUNCTIONS' => "Abgeschaltete Funktionen",
    'L_DO' => "ausführen",
    'L_DOCRONBUTTON' => "Perl-Cronscript ausführen",
    'L_DONE' => "Fertig!",
    'L_DONT_ATTACH_BACKUP' => "Backup nicht anhängen",
    'L_DOPERLTEST' => "Perl-Module testen",
    'L_DOSIMPLETEST' => "Perl testen",
    'L_DOWNLOAD_FILE' => "Datei herunterladen",
    'L_DO_NOW' => "jetzt ausführen",
    'L_DUMP' => "Backup",
    'L_DUMP_ENDERGEBNIS' => "Es wurden <b>%s</b> Tabellen mit"
    ." insgesamt <b>%s</b> Datensätzen"
    ." gesichert.<br />",
    'L_DUMP_FILENAME' => "Backup-Datei",
    'L_DUMP_HEADLINE' => "erzeuge Backup...",
    'L_DUMP_NOTABLES' => "Es konnten keine Tabellen in der"
    ." Datenbank `%s` gefunden werden.",
    'L_DUMP_OF_DB_FINISHED' => "Sicherung der Datenbank `%s`"
    ." abgeschlossen",
    'L_DURATION' => "Dauer",
    'L_EDIT' => "editieren",
    'L_EHRESTORE_CONTINUE' => "fortfahren und Fehler protokollieren",
    'L_EHRESTORE_STOP' => "anhalten",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "In der Anlage finden Sie die Sicherung"
    ." Ihrer MySQL-Datenbank.<br />Sicherung"
    ." der Datenbank `%s`
<br /><br"
    ." />Folgende Datei wurde erzeugt:<br"
    ." /><br />%s <br /><br />Viele"
    ." Grüße<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "<br /><br /><br />Viele Grüße<br"
    ." /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "Es wurde eine Multipart-Sicherung"
    ." erstellt.<br />Die Sicherungen werden"
    ." in separaten E-Mails als Anhang"
    ." geliefert!<br />Sicherung der"
    ." Datenbank `%s`
<br /><br />Folgende"
    ." Dateien wurden erzeugt:<br /><br"
    ." />%s<br /><br /><br />Viele Grüße<br"
    ." /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "Es wurde eine Multipart-Sicherung"
    ." erstellt.<br />Die Sicherungen werden"
    ." nicht als Anhang mitgeliefert!<br"
    ." />Sicherung der Datenbank `%s`
<br"
    ." /><br />Folgende Dateien wurden"
    ." erzeugt:<br /><br />%s<br /><br /><br"
    ." />Viele Grüße<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "Das Backup wurde nicht angehängt.<br"
    ." />Sicherung der Datenbank `%s`
<br"
    ." /><br />Folgende Datei wurde"
    ." erzeugt:<br /><br />%s
<br /><br"
    ." />Viele Grüße<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "Die Sicherung überschreitet die"
    ." Maximalgröße von %s und wurde daher"
    ." nicht angehängt.<br />Sicherung der"
    ." Datenbank `%s`
<br /><br />Folgende"
    ." Datei wurde erzeugt:<br /><br />%s
<br"
    ." /><br />Viele Grüße<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "E-Mail-Adresse",
    'L_EMAIL_CC' => "CC-Empfänger",
    'L_EMAIL_MAXSIZE' => "Maximale Größe des Anhangs",
    'L_EMAIL_ONLY_ATTACHMENT' => "... nur der Anhang",
    'L_EMAIL_RECIPIENT' => "Empfänger",
    'L_EMAIL_SENDER' => "Absender der E-Mail",
    'L_EMAIL_START' => "Starte E-Mail Versand",
    'L_EMAIL_WAS_SEND' => "Die E-Mail wurde erfolgreich"
    ." verschickt an",
    'L_EMPTY' => "Leere",
    'L_EMPTYKEYS' => "leeren und Indizes zurücksetzen",
    'L_EMPTYTABLEBEFORE' => "Tabelle vorher leeren",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Datenbank vor Wiederherstellung"
    ." löschen",
    'L_ENCODING' => "Kodierung",
    'L_ENCRYPTION_TYPE' => "Verschlüsselungsart",
    'L_ENGINE' => "Typ",
    'L_ENTER_DB_INFO' => "Klicken Sie zuerst auf den Button \"zu"
    ." MySQL verbinden\". Nur wenn daraufhin"
    ." keine Datenbank erkannt werden konnte,"
    ." ist hier eine Angabe notwendig.",
    'L_ENTRY' => "Eintrag",
    'L_ERROR' => "Fehler",
    'L_ERRORHANDLING_RESTORE' => "Fehlerbehandlung bei Wiederherstellung",
    'L_ERROR_CONFIGFILE_NAME' => "Der Dateiname \"%s\" enthält"
    ." ungültige Zeichen.",
    'L_ERROR_DELETING_CONFIGFILE' => "Fehler: die Konfigurationsdatei %s"
    ." konnte nicht gelöscht werden!",
    'L_ERROR_LOADING_CONFIGFILE' => "Die Konfigurationsdatei \"%s\" konnte"
    ." nicht geladen werden.",
    'L_ERROR_LOG' => "Error-Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Wiederherstellung: Konnte"
    ." die nächste Datei '%s' nicht finden!",
    'L_ESTIMATED_END' => "Geschätztes Ende",
    'L_EXCEL2003' => "Excel ab 2003",
    'L_EXISTS' => "Existiert",
    'L_EXPORT' => "Export",
    'L_EXPORTFINISHED' => "Export beendet.",
    'L_EXPORTLINES' => "<strong>%s</strong> Zeilen exportiert",
    'L_EXPORTOPTIONS' => "Export-Optionen",
    'L_EXTENDEDPARS' => "erweiterte Parameter",
    'L_FADE_IN_OUT' => "ein-/ausblenden",
    'L_FATAL_ERROR_DUMP' => "Schwerwiegender Fehler: die"
    ." CREATE-Anweisung der Tabelle '%s' in"
    ." der Datenbank '%s' konnte nicht"
    ." gelesen werden!",
    'L_FIELDS' => "Felder",
    'L_FIELDS_OF_TABLE' => "Felder der Tabelle",
    'L_FILE' => "Datei",
    'L_FILES' => "Dateien",
    'L_FILESIZE' => "Dateigröße",
    'L_FILE_MANAGE' => "Verwaltung",
    'L_FILE_OPEN_ERROR' => "Fehler: Die Datei konnte nicht"
    ." geöffnet werden.",
    'L_FILE_SAVED_SUCCESSFULLY' => "Die Datei wurde erfolgreich"
    ." gespeichert.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "Die Datei konnte nicht gespeichert"
    ." werden!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "Die Datei '%s' wurde erfolgreich"
    ." hochgeladen.",
    'L_FILTER_BY' => "Filtern nach",
    'L_FM_ALERTRESTORE1' => "Soll die Datenbank",
    'L_FM_ALERTRESTORE2' => "mit den Inhalten der Datei",
    'L_FM_ALERTRESTORE3' => "wiederhergestellt werden?",
    'L_FM_ALL_BU' => "alle Backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Möchten Sie die Datei(en)",
    'L_FM_ASKDELETE2' => "wirklich löschen?",
    'L_FM_ASKDELETE3' => "Möchten Sie das automatische Löschen"
    ." nach den eingestellten Regeln jetzt"
    ." ausführen?",
    'L_FM_ASKDELETE4' => "Möchten Sie alle Backup-Dateien jetzt"
    ." löschen?",
    'L_FM_ASKDELETE5' => "Möchten Sie alle Backup-Dateien mit",
    'L_FM_ASKDELETE5_2' => "* jetzt löschen?",
    'L_FM_AUTODEL1' => "Automatisches Löschen: Folgende"
    ." Dateien wurden aufgrund der maximalen"
    ." Dateianzahl gelöscht:",
    'L_FM_CHOOSE_ENCODING' => "Kodierung der Backupdatei wählen",
    'L_FM_COMMENT' => "Kommentar eingeben",
    'L_FM_DBNAME' => "Datenbankname",
    'L_FM_DELETE' => "Ausgewählte Dateien löschen",
    'L_FM_DELETE1' => "Die Datei",
    'L_FM_DELETE2' => "wurde erfolgreich gelöscht.",
    'L_FM_DELETE3' => "konnte nicht gelöscht werden!",
    'L_FM_DELETEALL' => "Alle Backup-Dateien löschen",
    'L_FM_DELETEALLFILTER' => "Alle löschen mit",
    'L_FM_DELETEAUTO' => "Automatisches löschen manuell"
    ." ausführen",
    'L_FM_DUMPSETTINGS' => "Einstellungen für das Backup",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "Datum",
    'L_FM_FILES1' => "Datenbank-Backups",
    'L_FM_FILESIZE' => "Dateigröße",
    'L_FM_FILEUPLOAD' => "Datei hochladen",
    'L_FM_FILEUPLOAD' => "Datei hochladen",
    'L_FM_FREESPACE' => "Freier Speicher auf Server",
    'L_FM_LAST_BU' => "letztes Backup",
    'L_FM_NOFILE' => "Sie haben gar keine Datei ausgewählt!",
    'L_FM_NOFILESFOUND' => "Keine Datei gefunden.",
    'L_FM_RECORDS' => "Einträge",
    'L_FM_RESTORE' => "Wiederherstellen",
    'L_FM_RESTORE_HEADER' => "Wiederherstellung der Datenbank"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Auswahl bestimmter Tabellen",
    'L_FM_STARTDUMP' => "Neues Backup starten",
    'L_FM_TABLES' => "Tabellen",
    'L_FM_TOTALSIZE' => "Gesamtgröße",
    'L_FM_UPLOADFAILED' => "Der Upload ist leider fehlgeschlagen!",
    'L_FM_UPLOADFILEEXISTS' => "Es existiert bereits eine Datei mit"
    ." diesem Namen!",
    'L_FM_UPLOADFILEREQUEST' => "Geben Sie bitte eine Datei an.",
    'L_FM_UPLOADFILEREQUEST' => "Bitte geben Sie eine Datei an.",
    'L_FM_UPLOADMOVEERROR' => "Die hochgeladene Datei konnte nicht in"
    ." den richtigen Ordner verschoben"
    ." werden.",
    'L_FM_UPLOADNOTALLOWED1' => "Dieser Dateityp ist nicht erlaubt.",
    'L_FM_UPLOADNOTALLOWED2' => "Gültige Typen sind: *.gz und"
    ." *.sql-Dateien",
    'L_FOUND_DB' => "gefundene DB:",
    'L_FROMFILE' => "aus Datei",
    'L_FROMTEXTBOX' => "aus Textfeld",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Verbindung hinzufügen",
    'L_FTP_CHOOSE_MODE' => "FTP-Übertragungsmodus",
    'L_FTP_CONFIRM_DELETE' => "Soll diese FTP-Verbindung wirklich"
    ." gelöscht werden?",
    'L_FTP_CONNECTION' => "FTP-Verbindung",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Verbindung geschlossen",
    'L_FTP_CONNECTION_DELETE' => "Verbindung löschen",
    'L_FTP_CONNECTION_ERROR' => "Die Verbindung zum Server '%s' über"
    ." Port %s konnte nicht aufgebaut werden",
    'L_FTP_CONNECTION_SUCCESS' => "Die Verbindung zum Server '%s' über"
    ." Port %s wurde erfolgreich hergestellt",
    'L_FTP_DIR' => "Upload-Ordner",
    'L_FTP_FILE_TRANSFER_ERROR' => "Die Übertragung der Datei '%s' war"
    ." fehlerhaft",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "Die Datei '%s' wurde erfolgreich"
    ." übertragen",
    'L_FTP_LOGIN_ERROR' => "Die Anmeldung als Benutzer '%s' wurde"
    ." abgelehnt",
    'L_FTP_LOGIN_SUCCESS' => "Die Anmeldung als Benutzer '%s' war"
    ." erfolgreich",
    'L_FTP_OK' => "FTP-Parameter sind ok",
    'L_FTP_OK' => "Die Verbindung wurde erfolgreich"
    ." hergestellt.",
    'L_FTP_PASS' => "Passwort",
    'L_FTP_PASSIVE' => "passiven Übertragungsmodus benutzen",
    'L_FTP_PASV_ERROR' => "Der Wechsel in den passiven FTP-Modus"
    ." war nicht erfolgreich",
    'L_FTP_PASV_SUCCESS' => "Der Wechsel in den passiven FTP-Modus"
    ." war erfolgreich",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "an <strong>%s</strong><br />in"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "Sichere SSL-FTP-Verbindung",
    'L_FTP_START' => "Starte FTP-Übertragung",
    'L_FTP_TIMEOUT' => "Verbindungs-Timeout",
    'L_FTP_TRANSFER' => "FTP-Transfer",
    'L_FTP_USER' => "Benutzer",
    'L_FTP_USESSL' => "benutze SSL-Verbindung",
    'L_GENERAL' => "allgemein",
    'L_GENERAL' => "Allgemein",
    'L_GZIP' => "GZip-Kompression",
    'L_GZIP_COMPRESSION' => "GZip-Kompression",
    'L_HOME' => "Home",
    'L_HOUR' => "Stunde",
    'L_HOURS' => "Stunden",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Rewrite aktivieren",
    'L_HTACC_ADD_HANDLER' => "Handler zufügen",
    'L_HTACC_CONFIRM_DELETE' => "Soll der Verzeichnisschutz jetzt"
    ." erstellt werden?",
    'L_HTACC_CONTENT' => "Inhalt der Datei",
    'L_HTACC_CREATE' => "Verzeichnisschutz erstellen",
    'L_HTACC_CREATED' => "Der Verzeichnisschutz wurde erstellt.",
    'L_HTACC_CREATE_ERROR' => "Es ist ein Fehler bei der Erstellung"
    ." des Verzeichnisschutzes"
    ." aufgetreten!<br />Bitte erzeugen Sie"
    ." die Dateien manuell mit folgendem"
    ." Inhalt",
    'L_HTACC_CRYPT' => "Crypt maximal 8 Zeichen (Linux und"
    ." Unix-Systeme)",
    'L_HTACC_DENY_ALLOW' => "Deny / Allow",
    'L_HTACC_DIR_LISTING' => "Verzeichnis-Listing",
    'L_HTACC_EDIT' => ".htaccess editieren",
    'L_HTACC_ERROR_DOC' => "Error-Dokument",
    'L_HTACC_EXAMPLES' => "weitere Beispiele und Dokumentation",
    'L_HTACC_EXISTS' => "Es besteht bereits ein"
    ." Verzeichnisschutz. Wenn Sie einen"
    ." neuen erstellen, wird der alte"
    ." überschrieben!",
    'L_HTACC_MAKE_EXECUTABLE' => "Ausführbar machen",
    'L_HTACC_MD5' => "MD5 (Linux und Unix-Systeme)",
    'L_HTACC_NO_ENCRYPTION' => "unverschlüsselt (Windows)",
    'L_HTACC_NO_USERNAME' => "Sie müssen einen Namen eingeben!",
    'L_HTACC_PROPOSED' => "Dringend empfohlen",
    'L_HTACC_REDIRECT' => "Redirect",
    'L_HTACC_SCRIPT_EXEC' => "Skript ausführen",
    'L_HTACC_SHA1' => "SHA1 (alle Systeme)",
    'L_HTACC_WARNING' => "Achtung! Die .htaccess hat eine"
    ." direkte Auswirkung auf den Browser.<br"
    ." />Bei falscher Anwendung sind die"
    ." Seiten nicht mehr erreichbar.",
    'L_IMPORT' => "Konfiguration importieren",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "importieren",
    'L_IMPORTOPTIONS' => "Import-Optionen",
    'L_IMPORTSOURCE' => "Import-Quelle",
    'L_IMPORTTABLE' => "Import in Tabelle",
    'L_IMPORT_NOTABLE' => "Es ist keine Tabelle für den Import"
    ." ausgewählt!",
    'L_IN' => "in",
    'L_INFO_ACTDB' => "Aktuelle Datenbank",
    'L_INFO_DATABASES' => "Datenbank(en) im Zugriff",
    'L_INFO_DBEMPTY' => "Die Datenbank ist leer!",
    'L_INFO_FSOCKOPEN_DISABLED' => "Auf diesem Server ist die PHP-Funktion"
    ." fsockopen() leider per"
    ." Serverkonfiguration deaktiviert,"
    ." weshalb das automatische Herunterladen"
    ." der Sprachpakete nicht ausgeführt"
    ." werden kann. Sie können die"
    ." gewünschten Pakete jedoch manuell"
    ." herunterladen, entpacken und mit Ihrem"
    ." FTP-Programm in den Unterordner"
    ." \"language\" Ihrer"
    ." MySQLDumper-Installation speichern."
    ." Anschließend stehen Ihnen diese hier"
    ." zur Auswahl zur Verfügung.",
    'L_INFO_LASTUPDATE' => "letzte Aktualisierung",
    'L_INFO_LOCATION' => "Sie befinden sich auf",
    'L_INFO_NODB' => "Datenbank existiert nicht",
    'L_INFO_NOPROCESSES' => "keine laufenden Prozesse",
    'L_INFO_NOSTATUS' => "kein Status verfügbar",
    'L_INFO_NOVARS' => "keine Variablen verfügbar",
    'L_INFO_OPTIMIZED' => "optimiert",
    'L_INFO_RECORDS' => "Datensätze",
    'L_INFO_RECORDS' => "Datensätze",
    'L_INFO_SIZE' => "Größe",
    'L_INFO_SUM' => "Insgesamt",
    'L_INSTALL' => "Installation",
    'L_INSTALL' => "Installation",
    'L_INSTALLED' => "Installiert",
    'L_INSTALL_HELP_PORT' => "(leer = Standardport)",
    'L_INSTALL_HELP_SOCKET' => "(leer = Standardsocket)",
    'L_IS_WRITABLE' => "Ist beschreibbar",
    'L_KILL_PROCESS' => "Prozess beenden",
    'L_LANGUAGE' => "Sprache",
    'L_LASTBACKUP' => "Letztes Backup",
    'L_LOAD' => "Grundeinstellungen",
    'L_LOAD_DATABASE' => "Datenbanken neu laden",
    'L_LOAD_FILE' => "Datei laden",
    'L_LOG' => "Log",
    'L_LOGFILENOTWRITABLE' => "Log-File kann nicht geschrieben"
    ." werden!",
    'L_LOGFILENOTWRITABLE' => "Log-Datei kann nicht geschrieben"
    ." werden!",
    'L_LOGFILES' => "Log-Dateien",
    'L_LOG_DELETE' => "Log löschen",
    'L_MAILERROR' => "Leider ist beim Verschicken der E-Mail"
    ." ein Fehler aufgetreten!",
    'L_MAILPROGRAM' => "Mailprogramm",
    'L_MAXSIZE' => "Maximale Größe",
    'L_MAX_BACKUP_FILES_EACH2' => "für jede Datenbank",
    'L_MAX_EXECUTION_TIME' => "Maximale Ausführungszeit",
    'L_MAX_UPLOAD_SIZE' => "Maximale Dateigröße",
    'L_MAX_UPLOAD_SIZE' => "Maximale Dateigröße",
    'L_MAX_UPLOAD_SIZE_INFO' => "Wenn Ihre Backup-Datei größer als"
    ." das angegebene Limit ist, dann müssen"
    ." Sie diese per FTP in den"
    ." \"work/backup\"-Ordner hochladen."
    ." 
Danach wird diese Datei hier in der"
    ." Verwaltung angezeigt und lässt sich"
    ." für eine Wiederherstellung"
    ." auswählen.",
    'L_MEMORY' => "Speicher",
    'L_MESSAGE' => "Nachricht",
    'L_MESSAGE_TYPE' => "Nachrichtentyp",
    'L_MINUTE' => "Minute",
    'L_MINUTES' => "Minuten",
    'L_MODE_EASY' => "Einfach",
    'L_MODE_EXPERT' => "Experte",
    'L_MSD_INFO' => "MySQLDumper-Informationen",
    'L_MSD_MODE' => "MySQLDumper-Modus",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Es wurden <b>%d</b> Datenbanken"
    ." gesichert",
    'L_MULTIPART_ACTUAL_PART' => "Aktuelle Teildatei",
    'L_MULTIPART_SIZE' => "Maximale Dateigröße",
    'L_MULTI_PART' => "Multipart-Backup",
    'L_MYSQLVARS' => "MySQL-Variablen",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "Standardkodierung des MySQL-Servers",
    'L_MYSQL_DATA' => "MySQL-Daten",
    'L_MYSQL_VERSION' => "MySQL-Version",
    'L_NAME' => "Name",
    'L_NAME' => "Name",
    'L_NEW' => "neu",
    'L_NEWTABLE' => "neue Tabelle",
    'L_NEXT_AUTO_INCREMENT' => "Nächster automatischer Index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. Auto-Index",
    'L_NO' => "nein",
    'L_NOFTPPOSSIBLE' => "Es stehen keine FTP-Funktionen zur"
    ." Verfügung!",
    'L_NOFTPPOSSIBLE' => "Es stehen keine FTP-Funktionen zur"
    ." Verfügung!",
    'L_NOFTPPOSSIBLE' => "Es stehen keine FTP-Funktionen zur"
    ." Verfügung!",
    'L_NOGZPOSSIBLE' => "Es stehen keine"
    ." Kompressions-Funktionen zur"
    ." Verfügung!",
    'L_NOGZPOSSIBLE' => "Da zlib nicht installiert ist, stehen"
    ." keine GZip-Funktionen zur Verfügung!",
    'L_NONE' => "keine",
    'L_NOREVERSE' => "Ältester Eintrag zuerst",
    'L_NOTAVAIL' => "<em>nicht verfügbar</em>",
    'L_NOTICE' => "Hinweis",
    'L_NOTICES' => "Hinweise",
    'L_NOT_ACTIVATED' => "nicht aktiviert",
    'L_NOT_SUPPORTED' => "Dieses Backup unterstützt diese"
    ." Funktion nicht.",
    'L_NO_DB_FOUND' => "Es wurde keine Datenbank"
    ." gefunden.
Blenden Sie die"
    ." Verbindungsparameter ein und geben Sie"
    ." den Namen Ihrer Datenbanken manuell"
    ." ein!",
    'L_NO_DB_FOUND_INFO' => "Die Verbindung zur Datenbank konnte"
    ." erfolgreich hergestellt werden.<br"
    ." />
Ihre Zugangsdaten sind gültig und"
    ." wurden vom MySQL-Server akzeptiert.<br"
    ." />
Leider konnte MySQLDumper keine"
    ." Datenbank finden.<br />
Die"
    ." automatische Erkennung per Programm"
    ." ist bei manchen Hostern gesperrt.<br"
    ." />
Sie müssen Ihre Datenbank nach dem"
    ." Abschluß der Installation unter dem"
    ." Menüpunkt \"Konfiguration\""
    ." \"Verbindungsparameter einblenden\""
    ." angeben.<br />
Bitte begeben Sie sich"
    ." nach Abschluß der Installation"
    ." umgehend dort hin und tragen den Namen"
    ." Ihrer Datenbank dort ein.",
    'L_NO_DB_SELECTED' => "Es ist keine Datenbank gewählt.",
    'L_NO_ENTRIES' => "Die Tabelle \"<b>%s</b>\" ist leer und"
    ." hat keine Einträge.",
    'L_NO_MSD_BACKUPFILE' => "Dateien anderer Programme",
    'L_NO_NAME_GIVEN' => "Sie haben keinen Namen angegeben.",
    'L_NR_TABLES_OPTIMIZED' => "%s Tabellen wurden optimiert.",
    'L_NUMBER_OF_FILES_FORM' => "Anzahl von Backup-Dateien pro"
    ." Datenbank",
    'L_OF' => "von",
    'L_OF' => "von",
    'L_OK' => "OK",
    'L_OPTIMIZE' => "Optimiere",
    'L_OPTIMIZE_TABLES' => "Tabellen vor dem Backup optimieren",
    'L_OPTIMIZE_TABLE_ERR' => "Fehler beim Optimieren der Tabelle"
    ." `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Die Tabelle `%s` wurde erfolgreich"
    ." optimiert.",
    'L_OS' => "Betriebssystem",
    'L_PAGE_REFRESHS' => "Seitenaufrufe",
    'L_PASS' => "Passwort",
    'L_PASSWORD' => "Kennwort",
    'L_PASSWORDS_UNEQUAL' => "Die Passwörter sind nicht identisch"
    ." oder leer!",
    'L_PASSWORD_REPEAT' => "Kennwort (Wiederholung)",
    'L_PASSWORD_STRENGTH' => "Kennwortstärke",
    'L_PERLOUTPUT1' => "Eintrag in crondump.pl für"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "Aufruf im Browser oder für externen"
    ." Cronjob",
    'L_PERLOUTPUT3' => "Aufruf in der Shell oder für die"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Bug in zlib! Keine Kompression"
    ." möglich!",
    'L_PHPMAIL' => "PHP-Funktion mail()",
    'L_PHP_EXTENSIONS' => "PHP-Erweiterungen",
    'L_PHP_VERSION' => "PHP-Version",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Port",
    'L_PORT' => "Port",
    'L_POSITION_BC' => "unten mittig",
    'L_POSITION_BL' => "unten links",
    'L_POSITION_BR' => "unten rechts",
    'L_POSITION_MC' => "mittig mittig",
    'L_POSITION_ML' => "mittig links",
    'L_POSITION_MR' => "mittig rechts",
    'L_POSITION_NOTIFICATIONS' => "Position des Nachrichtenfensters",
    'L_POSITION_TC' => "oben mittig",
    'L_POSITION_TL' => "oben links",
    'L_POSITION_TR' => "oben rechts",
    'L_PREFIX' => "Präfix",
    'L_PRIMARYKEYS_CHANGED' => "Primärschlüssel geändert",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Fehler beim Ändern der"
    ." Primärschlüssel",
    'L_PRIMARYKEYS_SAVE' => "Primärschlüssel speichern",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Primärschlüssel wirklich löschen?",
    'L_PRIMARYKEY_DELETED' => "Primärschlüssel gelöscht",
    'L_PRIMARYKEY_FIELD' => "Schlüsselfeld",
    'L_PRIMARYKEY_NOTFOUND' => "Primärschlüssel nicht gefunden",
    'L_PROCESSKILL1' => "Es wird versucht, Prozess",
    'L_PROCESSKILL2' => "zu beenden.",
    'L_PROCESSKILL3' => "Es wird seit",
    'L_PROCESSKILL4' => "Sekunde(n) versucht, Prozess",
    'L_PROCESS_ID' => "Prozess ID",
    'L_PROGRESS_FILE' => "Fortschritt Datei",
    'L_PROGRESS_OVER_ALL' => "Fortschritt gesamt",
    'L_PROGRESS_OVER_ALL' => "Fortschritt gesamt",
    'L_PROGRESS_TABLE' => "Fortschritt Tabelle",
    'L_PROVIDER' => "Provider",
    'L_PROZESSE' => "Prozesse",
    'L_RECHTE' => "Rechte",
    'L_RECORDS' => "Datensätze",
    'L_RECORDS_INSERTED' => "<b>%s</b> Datensätze wurden"
    ." eingetragen.",
    'L_RECORDS_PER_PAGECALL' => "Datensätze pro Seitenaufruf",
    'L_REFRESHTIME' => "Aktualisierungsintervall",
    'L_REFRESHTIME_PROCESSLIST' => "Aktualisierungsintervall der"
    ." Prozessliste",
    'L_RELOAD' => "Neu laden",
    'L_REMOVE' => "Entfernen",
    'L_REPAIR' => "Repariere",
    'L_RESET' => "Zurücksetzen",
    'L_RESET_SEARCHWORDS' => "Eingabe zurücksetzen",
    'L_RESTORE' => "Wiederherstellung",
    'L_RESTORE_COMPLETE' => "<b>%s</b> Tabellen wurden angelegt.",
    'L_RESTORE_DB' => "Datenbank '<b>%s</b>' auf Server"
    ." '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Wiederherstellung der Datenbank '%s'"
    ." in %s abgeschlossen.",
    'L_RESTORE_OF_TABLES' => "Wiederherstellen bestimmter Tabellen",
    'L_RESTORE_TABLE' => "Wiederherstellung der Tabelle '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Es wurden bisher <b>%d</b> von"
    ." <b>%d</b> Tabellen angelegt.",
    'L_RESTORE_TABLES_COMPLETED0' => "Es wurden bisher <b>%d</b> Tabellen"
    ." angelegt.",
    'L_REVERSE' => "Neuster Eintrag zuerst",
    'L_SAFEMODEDESC' => "Da PHP auf diesem Server mit der"
    ." Option \"safe_mode=on\" ausgeführt"
    ." wird, müssen folgende Verzeichnisse"
    ." von Hand angelegt werden (dies können"
    ." Sie mit Ihrem FTP-Programm erledigen):",
    'L_SAVE' => "Speichern",
    'L_SAVEANDCONTINUE' => "speichern und Installation fortsetzen",
    'L_SAVE_ERROR' => "Die Einstellungen konnten nicht"
    ." gespeichert werden!",
    'L_SAVE_SUCCESS' => "Die Einstellungen wurden erfolgreich"
    ." in der Konfigurationsdatei \"%s\""
    ." gespeichert.",
    'L_SAVING_DATA_TO_FILE' => "Speichere Daten der Datenbank '%s' in"
    ." der Datei '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximale Dateigröße erreicht:"
    ." Fortfahren mit Datei '%s'",
    'L_SAVING_DB_FORM' => "Datenbank",
    'L_SAVING_TABLE' => "Speichere Tabelle",
    'L_SEARCH_ACCESS_KEYS' => "Blättern: vor=ALT+V, zurück=ALT+C",
    'L_SEARCH_IN_TABLE' => "Suche in Tabelle",
    'L_SEARCH_NO_RESULTS' => "Die Suche nach \"<b>%s</b>\" in der"
    ." Tabelle \"<b>%s</b>\" liefert keine"
    ." Ergebnisse!",
    'L_SEARCH_OPTIONS' => "Suchoptionen",
    'L_SEARCH_OPTIONS_AND' => "eine Spalte muss alle Suchbegriffe"
    ." enthalten (UND-Suche)",
    'L_SEARCH_OPTIONS_CONCAT' => "ein Datensatz muss alle Suchbegriffe"
    ." enthalten, diese können aber in"
    ." beliebigen Spalten sein"
    ." (Rechenintensiv!)",
    'L_SEARCH_OPTIONS_OR' => "eine Spalte muss mindestens einen"
    ." Suchbegriff enthalten (ODER-Suche)",
    'L_SEARCH_RESULTS' => "Die Suche nach \"<b>%s</b>\" in der"
    ." Tabelle \"<b>%s</b>\" lieferte"
    ." folgende Treffer",
    'L_SECOND' => "Sekunde",
    'L_SECONDS' => "Sekunden",
    'L_SELECT' => "Wählen",
    'L_SELECTALL' => "alle auswählen",
    'L_SELECTED_FILE' => "Gewählte Datei",
    'L_SELECT_FILE' => "Datei wählen",
    'L_SELECT_LANGUAGE' => "Sprache wählen",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "Ergebnis als Datei senden",
    'L_SEND_MAIL_FORM' => "E-Mail senden",
    'L_SERVER' => "Server",
    'L_SERVERCAPTION' => "Anzeige des Servers",
    'L_SETPRIMARYKEYSFOR' => "Setzen neuer Primärschlüssel für"
    ." die Tabelle",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Zeige Eintrag %s bis %s von %s",
    'L_SHOWRESULT' => "Ergebnis anzeigen",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Server",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Geschwindigkeit",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Höhe der SQL-Box",
    'L_SQLLIB_ACTIVATEBOARD' => "Board aktivieren",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "Board deaktivieren",
    'L_SQLLIB_GENERALFUNCTIONS' => "allgemeine Funktionen",
    'L_SQLLIB_RESETAUTO' => "Auto-Wert zurücksetzen",
    'L_SQLLIMIT' => "Anzahl der Datensätze pro Seite",
    'L_SQL_ACTIONS' => "Aktionen",
    'L_SQL_AFTER' => "nach",
    'L_SQL_ALLOWDUPS' => "Duplikate erlaubt",
    'L_SQL_ATPOSITION' => "an Position einfügen",
    'L_SQL_ATTRIBUTES' => "Attribute",
    'L_SQL_BACKDBOVERVIEW' => "zurück zur Datenbank-Übersicht",
    'L_SQL_BEFEHLNEU' => "neuer Befehl",
    'L_SQL_BEFEHLSAVED1' => "SQL-Befehl",
    'L_SQL_BEFEHLSAVED2' => "wurde hinzugefügt",
    'L_SQL_BEFEHLSAVED3' => "wurde gespeichert",
    'L_SQL_BEFEHLSAVED4' => "wurde nach oben gebracht",
    'L_SQL_BEFEHLSAVED5' => "wurde gelöscht",
    'L_SQL_BROWSER' => "SQL-Browser",
    'L_SQL_CARDINALITY' => "Kardinalität",
    'L_SQL_CHANGED' => "wurde geändert.",
    'L_SQL_CHANGEFIELD' => "Feld ändern",
    'L_SQL_CHOOSEACTION' => "Aktion wählen",
    'L_SQL_COLLATENOTMATCH' => "Zeichensatz und Sortierung passen"
    ." nicht zueinander!",
    'L_SQL_COLUMNS' => "Spalten",
    'L_SQL_COMMANDS' => "SQL-Befehle",
    'L_SQL_COMMANDS_IN' => "Zeilen in",
    'L_SQL_COMMANDS_IN2' => "Sekunde(n) abgearbeitet.",
    'L_SQL_COPYDATADB' => "Inhalt in Datenbank kopieren",
    'L_SQL_COPYSDB' => "Struktur in Datenbank kopieren",
    'L_SQL_COPYTABLE' => "Tabelle kopieren",
    'L_SQL_CREATED' => "wurde angelegt.",
    'L_SQL_CREATEINDEX' => "Neuen Index erzeugen",
    'L_SQL_CREATETABLE' => "Tabelle anlegen",
    'L_SQL_DATAVIEW' => "Daten-Ansicht",
    'L_SQL_DBCOPY' => "Der Inhalt der Datenbank `%s` wurde in"
    ." die Datenbank `%s` kopiert.",
    'L_SQL_DBSCOPY' => "Die Struktur der Datenbank `%s` wurde"
    ." in die Datenbank `%s` kopiert.",
    'L_SQL_DELETED' => "wurde gelöscht.",
    'L_SQL_DELETEDB' => "Datenbank löschen",
    'L_SQL_DESTTABLE_EXISTS' => "Zieltabelle existiert schon!",
    'L_SQL_EDIT' => "bearbeiten",
    'L_SQL_EDITFIELD' => "Editiere Feld",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Tabellenstruktur bearbeiten",
    'L_SQL_EMPTYDB' => "Datenbank leeren",
    'L_SQL_ERROR1' => "Fehler bei der Anfrage:",
    'L_SQL_ERROR2' => "MySQL meldet:",
    'L_SQL_EXEC' => "SQL-Befehl ausführen",
    'L_SQL_EXPORT' => "Export aus Datenbank `%s`",
    'L_SQL_FIELDDELETE1' => "Das Feld",
    'L_SQL_FIELDNAMENOTVALID' => "Fehler: Kein gültiger Feldname",
    'L_SQL_FIRST' => "zuerst",
    'L_SQL_IMEXPORT' => "Im-/Export",
    'L_SQL_IMPORT' => "Import in Datenbank `%s`",
    'L_SQL_INDEXES' => "Indizes",
    'L_SQL_INSERTFIELD' => "Feld einfügen",
    'L_SQL_INSERTNEWFIELD' => "Neues Feld einfügen",
    'L_SQL_LIBRARY' => "SQL-Bibliothek",
    'L_SQL_NAMEDEST_MISSING' => "Name für die Zieldatenbank fehlt!",
    'L_SQL_NEWFIELD' => "Neues Feld",
    'L_SQL_NODATA' => "keine Datensätze",
    'L_SQL_NODEST_COPY' => "Ohne Ziel kann nicht kopiert werden!",
    'L_SQL_NOFIELDDELETE' => "Löschen nicht möglich, da eine"
    ." Tabelle mindestens 1 Feld haben muss.",
    'L_SQL_NOTABLESINDB' => "Es befinden sich keine Tabellen in der"
    ." Datenbank",
    'L_SQL_NOTABLESSELECTED' => "Es sind keine Tabellen ausgewählt!",
    'L_SQL_OPENFILE' => "SQL-Datei öffnen",
    'L_SQL_OPENFILE_BUTTON' => "Hochaden",
    'L_SQL_OUT1' => "Es wurden",
    'L_SQL_OUT2' => "Befehle ausgeführt",
    'L_SQL_OUT3' => "Es gab",
    'L_SQL_OUT4' => "Kommentare",
    'L_SQL_OUT5' => "Da die Ausgabe über 5000 Zeilen"
    ." enthält, wird sie nicht angezeigt.",
    'L_SQL_OUTPUT' => "SQL-Ausgabe",
    'L_SQL_QUERYENTRY' => "Die Abfrage enthält",
    'L_SQL_RECORDDELETED' => "Datensatz wurde gelöscht",
    'L_SQL_RECORDEDIT' => "editiere Datensatz",
    'L_SQL_RECORDINSERTED' => "Datensatz wurde gespeichert",
    'L_SQL_RECORDNEW' => "Datensatz einfügen",
    'L_SQL_RECORDUPDATED' => "Datensatz wurde geändert",
    'L_SQL_RENAMEDB' => "Datenbank umbenennen",
    'L_SQL_RENAMEDTO' => "wurde umbenannt in",
    'L_SQL_SCOPY' => "Tabellenstruktur von `%s` wurde in"
    ." Tabelle `%s` kopiert.",
    'L_SQL_SEARCH' => "Suche",
    'L_SQL_SEARCHWORDS' => "Suchbegriff(e)",
    'L_SQL_SELECTTABLE' => "Tabelle auswählen",
    'L_SQL_SHOWDATATABLE' => "Daten der Tabelle anzeigen",
    'L_SQL_STRUCTUREDATA' => "Struktur und Daten",
    'L_SQL_STRUCTUREONLY' => "nur Struktur",
    'L_SQL_TABLEEMPTIED' => "Tabelle `%s` wurde geleert.",
    'L_SQL_TABLEEMPTIEDKEYS' => "Tabelle `%s` wurde geleert, und die"
    ." Indizes wurden zurückgesetzt.",
    'L_SQL_TABLEINDEXES' => "Indizes der Tabelle",
    'L_SQL_TABLENEW' => "Tabellen bearbeiten",
    'L_SQL_TABLENOINDEXES' => "Die Tabelle enthält keine Indizes",
    'L_SQL_TABLENONAME' => "Tabelle braucht einen Namen!",
    'L_SQL_TABLESOFDB' => "Tabellen der Datenbank",
    'L_SQL_TABLEVIEW' => "Tabellen-Ansicht",
    'L_SQL_TBLNAMEEMPTY' => "Tabellenname darf nicht leer sein!",
    'L_SQL_TBLPROPSOF' => "Tabelleneigenschaften  von",
    'L_SQL_TCOPY' => "Tabelle `%s` wurde mit Daten in"
    ." Tabelle `%s` kopiert.",
    'L_SQL_UPLOADEDFILE' => "geladene Datei:",
    'L_SQL_VIEW_COMPACT' => "Ansicht: kompakt",
    'L_SQL_VIEW_STANDARD' => "Ansicht: normal",
    'L_SQL_VONINS' => "von insgesamt",
    'L_SQL_WARNING' => "Die Ausführung von SQL-Befehlen kann"
    ." Daten manipulieren! Der Autor"
    ." übernimmt keine Haftung bei"
    ." Datenverlusten.",
    'L_SQL_WASCREATED' => "wurde erzeugt",
    'L_SQL_WASEMPTIED' => "wurde geleert",
    'L_STARTDUMP' => "Backup starten",
    'L_START_RESTORE_DB_FILE' => "Beginne Wiederherstellung der"
    ." Datenbank '%s' aus Datei '%s'.",
    'L_START_SQL_SEARCH' => "Suche starten",
    'L_STATUS' => "Status",
    'L_STATUS' => "Status",
    'L_STEP' => "Schritt",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Die Konfigurationsdatei \"%s\" wurde"
    ." erfolgreich angelegt.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "Die Konfigurationsdatei \"%s\" wurde"
    ." erfolgreich gelöscht.",
    'L_TABLE' => "Tabelle",
    'L_TABLES' => "Tabellen",
    'L_TABLESELECTION' => "Tabellenauswahl",
    'L_TABLE_CREATE_SUCC' => "Die Tabelle '%s' wurde erfolgreich"
    ." angelegt.",
    'L_TABLE_TYPE' => "Typ",
    'L_TESTCONNECTION' => "Verbindung testen",
    'L_THEME' => "Stil",
    'L_TIME' => "Zeit",
    'L_TIMESTAMP' => "Zeitstempel",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Volltextschlüssel",
    'L_TITLE_KEY_PRIMARY' => "Primärschlüssel",
    'L_TITLE_KEY_UNIQUE' => "Eindeutiger Schlüssel",
    'L_TITLE_MYSQL_HELP' => "MySQL Dokumentation",
    'L_TITLE_NOKEY' => "Kein Schlüssel",
    'L_TITLE_SEARCH' => "Suche",
    'L_TITLE_SHOW_DATA' => "Daten anzeigen",
    'L_TITLE_UPLOAD' => "SQL-Datei hochladen",
    'L_TO' => "bis",
    'L_TOOLS' => "Tools",
    'L_TOOLS' => "Tools",
    'L_TOOLS_TOOLBOX' => "Datenbank auswählen /"
    ." Datenbankfunktionen / Im- und Export",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "unbekannt",
    'L_UNKNOWN_SQLCOMMAND' => "Unbekannter SQL-Befehl:",
    'L_UPDATE' => "Aktualisieren",
    'L_UPTO' => "bis",
    'L_USERNAME' => "Benutzername",
    'L_USE_SSL' => "SSL benutzen",
    'L_VALUE' => "Wert",
    'L_VERSIONSINFORMATIONEN' => "Versionsinformationen",
    'L_VIEW' => "ansehen",
    'L_VISIT_HOMEPAGE' => "Besuchen Sie die Homepage",
    'L_VOM' => "vom",
    'L_WITH' => "mit",
    'L_WITHATTACH' => "mit Anhang",
    'L_WITHOUTATTACH' => "ohne Anhang",
    'L_WITHPRAEFIX' => "mit Praefix",
    'L_WRONGCONNECTIONPARS' => "Falsche oder keine"
    ." Verbindungsparameter!",
    'L_WRONG_CONNECTIONPARS' => "Verbindungsparameter stimmen nicht!",
    'L_WRONG_RIGHTS' => "Die Datei oder das Verzeichnis '%s'"
    ." ist für mich nicht beschreibbar.<br"
    ." />
Entweder hat sie den falschen"
    ." Besitzer (Owner) oder die falschen"
    ." Rechte (Chmod).<br /> 
Bitte setzen"
    ." Sie die richtigen Attribute mit Ihrem"
    ." FTP-Programm. <br />
Die Datei oder"
    ." das Verzeichnis benötigt die Rechte"
    ." %s.<br />",
    'L_YES' => "ja",
));
