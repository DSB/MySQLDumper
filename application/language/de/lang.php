<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package       MySQLDumper
 * @subpackage    Language
 * @version       $Rev$
 * @author        $Author$
 */
$lang=array();
$lang['L_ACTION']="Aktion";
$lang['L_ACTIVATED']="aktiviert";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Es wurden bisher <b>%s</b> Datensätze"
    ." erfolgreich eingetragen.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Es wurden bisher <b>%s</b> von"
    ." <b>%s</b> Datensätzen erfolgreich"
    ." eingetragen.";
$lang['L_ADD']="Hinzufügen";
$lang['L_ADDED']="hinzugefügt";
$lang['L_ADD_DB_MANUALLY']="Datenbank manuell hinzufügen";
$lang['L_ADD_RECIPIENT']="Empfänger hinzufügen";
$lang['L_ALL']="alle";
$lang['L_ANALYZE']="Analysiere";
$lang['L_ANALYZING_TABLE']="Momentan werden Daten der Tabelle"
    ." '<b>%s</b>' analysiert.";
$lang['L_ASKDBCOPY']="Soll der Inhalt der Datenbank `%s` in"
    ." die Datenbank `%s` kopiert werden?";
$lang['L_ASKDBDELETE']="Soll die Datenbank `%s` samt Inhalt"
    ." wirklich gelöscht werden?";
$lang['L_ASKDBEMPTY']="Soll die Datenbank `%s` wirklich"
    ." geleert werden?";
$lang['L_ASKDELETEFIELD']="Soll das Feld gelöscht werden?";
$lang['L_ASKDELETERECORD']="Soll der Datensatz gelöscht werden?";
$lang['L_ASKDELETETABLE']="Soll die Tabelle `%s` gelöscht"
    ." werden?";
$lang['L_ASKTABLEEMPTY']="Soll die Tabelle `%s` geleert werden?";
$lang['L_ASKTABLEEMPTYKEYS']="Sollen die Tabelle `%s` geleert und"
    ." die Indizes zurückgesetzt werden?";
$lang['L_ATTACHED_AS_FILE']="als Datei angehängt";
$lang['L_ATTACH_BACKUP']="Backup anhängen";
$lang['L_AUTHENTICATE']="Anmeldeinformationen";
$lang['L_AUTHORIZE']="Autorisieren";
$lang['L_AUTODELETE']="Automatisches Löschen der Backups";
$lang['L_BACK']="zurück";
$lang['L_BACKUPFILESANZAHL']="Im Backup-Verzeichnis befinden sich";
$lang['L_BACKUPS']="Sicherungsdateien";
$lang['L_BACKUP_DBS']="zu sichernde DBs";
$lang['L_BACKUP_TABLE_DONE']="Sicherung der Tabelle `%s`"
    ." abgeschlossen. %s Datensätze wurden"
    ." gespeichert.";
$lang['L_BACK_TO_OVERVIEW']="Datenbank-Übersicht";
$lang['L_CALL']="Aufruf";
$lang['L_CANCEL']="Abbruch";
$lang['L_CANT_CREATE_DIR']="Ich konnte das Verzeichnis '%s' nicht"
    ." anlegen. Bitte erstellen Sie es mit"
    ." Ihrem FTP-Programm.";
$lang['L_CHANGE']="Ändern";
$lang['L_CHANGEDIR']="Wechsle in das Verzeichnis";
$lang['L_CHANGEDIRERROR']="Es konnte nicht in das Verzeichnis"
    ." gewechselt werden!";
$lang['L_CHARSET']="Zeichensatz";
$lang['L_CHARSETS']="Zeichensätze";
$lang['L_CHECK']="Überprüfe";
$lang['L_CHECK_DIRS']="Verzeichnisse überprüfen";
$lang['L_CHOOSE_CHARSET']="Leider konnte nicht automatisch"
    ." ermittelt werden mit welchem"
    ." Zeichensatz diese Backupdatei"
    ." seinerzeit angelegt wurde. <br /><br"
    ." />Sie müssen die Kodierung, in der"
    ." Zeichenketten in dieser Datei"
    ." vorliegen, manuell angeben.<br /><br"
    ." />Danach stellt MySQLDumper die"
    ." Verbindungskennung zum MySQL-Server"
    ." auf den ausgewählten Zeichensatz und"
    ." beginnt mit der Wiederherstellung der"
    ." Daten.<br /><br />Sollten Sie nach der"
    ." Wiederherstellung Probleme mit"
    ." Sonderzeichen entdecken, so können"
    ." Sie versuchen, das Backup mit einer"
    ." anderen Zeichensatzauswahl"
    ." wiederherzustellen.<br /><br />Viel"
    ." Glück. ;)<br /><br /><br />";
$lang['L_CHOOSE_DB']="Datenbank wählen";
$lang['L_CLEAR_DATABASE']="Datenbank leeren";
$lang['L_CLOSE']="Schließen";
$lang['L_COLLATION']="Sortierung";
$lang['L_COMMAND']="Befehl";
$lang['L_COMMAND_AFTER_BACKUP']="Befehl nach Backup";
$lang['L_COMMAND_BEFORE_BACKUP']="Befehl vor Backup";
$lang['L_COMMENT']="Kommentar";
$lang['L_COMPRESSED']="komprimiert (gz)";
$lang['L_CONFBASIC']="Grundeinstellungen";
$lang['L_CONFIG']="Konfiguration";
$lang['L_CONFIGFILE']="Konfigurationsdatei";
$lang['L_CONFIGFILES']="Konfigurationsdateien";
$lang['L_CONFIGURATIONS']="Einstellungen";
$lang['L_CONFIG_AUTODELETE']="Automatisches Löschen";
$lang['L_CONFIG_CRONPERL']="Crondump-Einstellungen für das"
    ." Perlscript";
$lang['L_CONFIG_EMAIL']="E-Mail-Benachrichtigung";
$lang['L_CONFIG_FTP']="FTP-Transfer der Backup-Datei";
$lang['L_CONFIG_HEADLINE']="Konfiguration";
$lang['L_CONFIG_INTERFACE']="Oberfläche";
$lang['L_CONFIG_LOADED']="Die Konfiguration \"%s\" wurde"
    ." erfolgreich geladen.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Soll die Konfigurationsdatei %s"
    ." wirklich gelöscht werden?";
$lang['L_CONFIRM_DELETE_FILE']="Soll die Datei '%s' wirklich gelöscht"
    ." werden?";
$lang['L_CONFIRM_DELETE_TABLES']="Sollen die gewählten Tabellen"
    ." wirklich gelöscht werden?";
$lang['L_CONFIRM_DROP_DATABASES']="Soll/en die gewählte/n Datenbank/en"
    ." wirklich gelöscht werden?<br /><br"
    ." />Achtung: alle Daten gehen"
    ." unwiderruflich verloren! Legen Sie"
    ." sicherheitshalber vorher eine"
    ." Sicherung der Daten an.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Soll der Empfänger \"%s\" wirklich"
    ." entfernt werden?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Soll/en die gewählte/n Datenbank/en"
    ." wirklich geleert werden?<br /><br"
    ." />Achtung: alle Tabellen gehen"
    ." unwiderruflich verloren! Legen Sie"
    ." sicherheitshalber vorher eine"
    ." Sicherung der Daten an.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Sollen die gewählten Tabellen"
    ." wirklich geleert werden?";
$lang['L_CONNECT']="verbinden";
$lang['L_CONNECTIONPARS']="Verbindungsparameter";
$lang['L_CONNECTTOMYSQL']="zu MySQL verbinden";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Multipart-Wiederherstellung mit"
    ." nächster Datei '%s' fortfahren .";
$lang['L_CONVERTED_FILES']="Konvertierte Dateien";
$lang['L_CONVERTER']="Backup-Konverter";
$lang['L_CONVERTING']="Konvertierung";
$lang['L_CONVERT_FILE']="zu konvertierende Datei";
$lang['L_CONVERT_FILENAME']="Name der Zieldatei (ohne Endung)";
$lang['L_CONVERT_FILEREAD']="Datei '%s' wird eingelesen";
$lang['L_CONVERT_FINISHED']="Konvertierung abgeschlossen, '%s'"
    ." wurde erzeugt.";
$lang['L_CONVERT_START']="Konvertierung starten";
$lang['L_CONVERT_TITLE']="Konvertiere Dump ins MSD-Format";
$lang['L_CONVERT_WRONG_PARAMETERS']="Falsche Parameter! Konvertierung ist"
    ." nicht möglich.";
$lang['L_CREATE']="anlegen";
$lang['L_CREATED']="Erstellt";
$lang['L_CREATEDIRS']="erstelle Verzeichnisse";
$lang['L_CREATE_AUTOINDEX']="Autoindex erzeugen";
$lang['L_CREATE_CONFIGFILE']="Eine neue Konfigurationsdatei anlegen";
$lang['L_CREATE_DATABASE']="Neue Datenbank anlegen";
$lang['L_CREATE_TABLE_SAVED']="Definition der Tabelle `%s`"
    ." gespeichert.";
$lang['L_CREDITS']="Credits / Hilfe";
$lang['L_CRONSCRIPT']="Cronscript";
$lang['L_CRON_COMMENT']="Kommentar eingeben";
$lang['L_CRON_COMPLETELOG']="Komplette Ausgabe loggen";
$lang['L_CRON_EXECPATH']="Pfad der Perlskripte";
$lang['L_CRON_EXTENDER']="Dateiendung des Scripts";
$lang['L_CRON_PRINTOUT']="Textausgabe";
$lang['L_CSVOPTIONS']="CSV-Optionen";
$lang['L_CSV_EOL']="Zeilen getrennt mit";
$lang['L_CSV_ERRORCREATETABLE']="Fehler beim Erstellen der Tabelle"
    ." `%s`!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="Die Anzahl der Tabellenfelder stimmen"
    ." nicht mit den zu importierenden Daten"
    ." überein (%d statt %d).";
$lang['L_CSV_FIELDSENCLOSED']="Felder eingeschlossen von";
$lang['L_CSV_FIELDSEPERATE']="Felder getrennt mit";
$lang['L_CSV_FIELDSESCAPE']="Felder escaped von";
$lang['L_CSV_FIELDSLINES']="%d Felder ermittelt, insgesamt %d"
    ." Zeilen";
$lang['L_CSV_FILEOPEN']="CSV-Datei öffnen";
$lang['L_CSV_NAMEFIRSTLINE']="Feldnamen in die erste Zeile";
$lang['L_CSV_NODATA']="Keine Daten zum Importieren gefunden!";
$lang['L_CSV_NULL']="Ersetze NULL durch";
$lang['L_DATABASES_OF_USER']="Datenbanken des Benutzers";
$lang['L_DATABASE_CREATED_FAILED']="Die Datenbank wurde nicht erstellt.<br"
    ." />MySQL lieferte folgenden"
    ." Fehler:<br/><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="Die Datenbank '%s' wurde erfolgreich"
    ." erstellt.";
$lang['L_DATASIZE']="Datengröße";
$lang['L_DATASIZE_INFO']="Dies ist die Größe der Datensätze -"
    ." nicht die Größe der Sicherungsdatei";
$lang['L_DAY']="Tag";
$lang['L_DAYS']="Tage";
$lang['L_DB']="Datenbank";
$lang['L_DBCONNECTION']="Datenbank-Verbindung";
$lang['L_DBPARAMETER']="Datenbank-Parameter";
$lang['L_DBS']="Datenbanken";
$lang['L_DB_ADAPTER']="DB-Adapter";
$lang['L_DB_BACKUPPARS']="Einstellungen";
$lang['L_DB_DEFAULT']="Standarddatenbank";
$lang['L_DB_HOST']="Datenbank-Hostname";
$lang['L_DB_IN_LIST']="Die Datenbank '%s' konnte nicht"
    ." hinzugefügt werden, da sie bereits"
    ." vorhanden ist.";
$lang['L_DB_NAME']="Datenbankname";
$lang['L_DB_PASS']="Datenbank-Passwort";
$lang['L_DB_SELECT_ERROR']="<br />Fehler:<br />Auswahl der"
    ." Datenbank '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' fehlgeschlagen!";
$lang['L_DB_USER']="Datenbank-Benutzer";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Standardzeichensatz";
$lang['L_DEFAULT_CHARSET']="Standardzeichensatz";
$lang['L_DEFAULT_COLLATION_NAME']="Standardsortierung";
$lang['L_DELETE']="Lösche";
$lang['L_DELETE_DATABASE']="Datenbank löschen";
$lang['L_DELETE_FILE_ERROR']="Die Datei \"%s\" konnte nicht"
    ." gelöscht werden!";
$lang['L_DELETE_FILE_SUCCESS']="Die Datei \"%s\" wurde erfolgreich"
    ." gelöscht.";
$lang['L_DELETE_HTACCESS']="Verzeichnisschutz entfernen (.htaccess"
    ." löschen)";
$lang['L_DESCRIPTION']="Beschreibung";
$lang['L_DESELECT_ALL']="Auswahl aufheben";
$lang['L_DIR']="Verzeichnis";
$lang['L_DISABLEDFUNCTIONS']="Abgeschaltete Funktionen";
$lang['L_DO']="ausführen";
$lang['L_DOCRONBUTTON']="Perl-Cronscript ausführen";
$lang['L_DONE']="Fertig!";
$lang['L_DONT_ATTACH_BACKUP']="Backup nicht anhängen";
$lang['L_DOPERLTEST']="Perl-Module testen";
$lang['L_DOSIMPLETEST']="Perl testen";
$lang['L_DOWNLOAD_FILE']="Datei herunterladen";
$lang['L_DO_NOW']="jetzt ausführen";
$lang['L_DUMP']="Backup";
$lang['L_DUMP_ENDERGEBNIS']="Es wurden <b>%s</b> Tabellen mit"
    ." insgesamt <b>%s</b> Datensätzen"
    ." gesichert.<br />";
$lang['L_DUMP_FILENAME']="Backup-Datei";
$lang['L_DUMP_HEADLINE']="erzeuge Backup...";
$lang['L_DUMP_NOTABLES']="Es konnten keine Tabellen in der"
    ." Datenbank `%s` gefunden werden.";
$lang['L_DUMP_OF_DB_FINISHED']="Sicherung der Datenbank `%s`"
    ." abgeschlossen";
$lang['L_DURATION']="Dauer";
$lang['L_EDIT']="editieren";
$lang['L_EHRESTORE_CONTINUE']="fortfahren und Fehler protokollieren";
$lang['L_EHRESTORE_STOP']="anhalten";
$lang['L_EMAIL']="E-Mail";
$lang['L_EMAILBODY_ATTACH']="In der Anlage finden Sie die Sicherung"
    ." Ihrer MySQL-Datenbank.<br />Sicherung"
    ." der Datenbank `%s`<br /><br /><br"
    ." />Folgende Datei wurde erzeugt:<br"
    ." /><br />%s <br /><br />Viele"
    ." Grüße<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Viele Grüße<br"
    ." /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="Es wurde eine Multipart-Sicherung"
    ." erstellt.<br />Die Sicherungen werden"
    ." in separaten E-Mails als Anhang"
    ." geliefert!<br />Sicherung der"
    ." Datenbank `%s`<br /><br /><br"
    ." />Folgende Dateien wurden erzeugt:<br"
    ." /><br />%s<br /><br /><br />Viele"
    ." Grüße<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="Es wurde eine Multipart-Sicherung"
    ." erstellt.<br />Die Sicherungen werden"
    ." nicht als Anhang mitgeliefert!<br"
    ." />Sicherung der Datenbank `%s`<br"
    ." /><br /><br />Folgende Dateien wurden"
    ." erzeugt:<br /><br />%s<br /><br /><br"
    ." />Viele Grüße<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="Das Backup wurde nicht angehängt.<br"
    ." />Sicherung der Datenbank `%s`<br"
    ." /><br /><br />Folgende Datei wurde"
    ." erzeugt:<br /><br />%s<br /><br /><br"
    ." />Viele Grüße<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="Die Sicherung überschreitet die"
    ." Maximalgröße von %s und wurde daher"
    ." nicht angehängt.<br />Sicherung der"
    ." Datenbank `%s`<br /><br /><br"
    ." />Folgende Datei wurde erzeugt:<br"
    ." /><br />%s<br /><br /><br />Viele"
    ." Grüße<br /><br />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="E-Mail-Adresse";
$lang['L_EMAIL_CC']="CC-Empfänger";
$lang['L_EMAIL_MAXSIZE']="Maximale Größe des Anhangs";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... nur der Anhang";
$lang['L_EMAIL_RECIPIENT']="Empfänger";
$lang['L_EMAIL_SENDER']="Absender der E-Mail";
$lang['L_EMAIL_START']="Starte E-Mail-Versand";
$lang['L_EMAIL_WAS_SEND']="Die E-Mail wurde erfolgreich"
    ." verschickt an";
$lang['L_EMPTY']="Leere";
$lang['L_EMPTYKEYS']="leeren und Indizes zurücksetzen";
$lang['L_EMPTYTABLEBEFORE']="Tabelle vorher leeren";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Datenbank vor Wiederherstellung"
    ." löschen";
$lang['L_ENCODING']="Kodierung";
$lang['L_ENCRYPTION_TYPE']="Verschlüsselungsart";
$lang['L_ENGINE']="Treiber";
$lang['L_ENTER_DB_INFO']="Klicken Sie zuerst auf den Button \"zu"
    ." MySQL verbinden\". Nur wenn daraufhin"
    ." keine Datenbank erkannt werden konnte,"
    ." ist hier eine Angabe notwendig.";
$lang['L_ENTRY']="Eintrag";
$lang['L_ERROR']="Fehler";
$lang['L_ERRORHANDLING_RESTORE']="Fehlerbehandlung bei Wiederherstellung";
$lang['L_ERROR_CONFIGFILE_NAME']="Der Dateiname \"%s\" enthält"
    ." ungültige Zeichen.";
$lang['L_ERROR_DELETING_CONFIGFILE']="Fehler: die Konfigurationsdatei %s"
    ." konnte nicht gelöscht werden!";
$lang['L_ERROR_LOADING_CONFIGFILE']="Die Konfigurationsdatei \"%s\" konnte"
    ." nicht geladen werden.";
$lang['L_ERROR_LOG']="Error-Log";
$lang['L_ERROR_MULTIPART_RESTORE']="Multipart-Wiederherstellung: Konnte"
    ." die nächste Datei '%s' nicht finden!";
$lang['L_ESTIMATED_END']="Geschätztes Ende";
$lang['L_EXCEL2003']="Excel ab 2003";
$lang['L_EXISTS']="Existiert";
$lang['L_EXPORT']="Export";
$lang['L_EXPORTFINISHED']="Export beendet.";
$lang['L_EXPORTLINES']="<strong>%s</strong> Zeilen exportiert";
$lang['L_EXPORTOPTIONS']="Export-Optionen";
$lang['L_EXTENDEDPARS']="erweiterte Parameter";
$lang['L_FADE_IN_OUT']="ein-/ausblenden";
$lang['L_FATAL_ERROR_DUMP']="Schwerwiegender Fehler: die"
    ." CREATE-Anweisung der Tabelle '%s' in"
    ." der Datenbank '%s' konnte nicht"
    ." gelesen werden!";
$lang['L_FIELDS']="Felder";
$lang['L_FIELDS_OF_TABLE']="Felder der Tabelle";
$lang['L_FILE']="Datei";
$lang['L_FILES']="Dateien";
$lang['L_FILESIZE']="Dateigröße";
$lang['L_FILE_MANAGE']="Verwaltung";
$lang['L_FILE_OPEN_ERROR']="Fehler: Die Datei konnte nicht"
    ." geöffnet werden.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="Die Datei wurde erfolgreich"
    ." gespeichert.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="Die Datei konnte nicht gespeichert"
    ." werden!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="Die Datei '%s' wurde erfolgreich"
    ." hochgeladen.";
$lang['L_FILTER_BY']="Filtern nach";
$lang['L_FM_ALERTRESTORE1']="Soll die Datenbank";
$lang['L_FM_ALERTRESTORE2']="mit den Inhalten der Datei";
$lang['L_FM_ALERTRESTORE3']="wiederhergestellt werden?";
$lang['L_FM_ALL_BU']="alle Backups";
$lang['L_FM_ANZ_BU']="Backups";
$lang['L_FM_ASKDELETE1']="Möchten Sie die Datei(en)";
$lang['L_FM_ASKDELETE2']="wirklich löschen?";
$lang['L_FM_ASKDELETE3']="Möchten Sie das automatische Löschen"
    ." nach den eingestellten Regeln jetzt"
    ." ausführen?";
$lang['L_FM_ASKDELETE4']="Möchten Sie alle Backup-Dateien jetzt"
    ." löschen?";
$lang['L_FM_ASKDELETE5']="Möchten Sie alle Backup-Dateien mit";
$lang['L_FM_ASKDELETE5_2']="* jetzt löschen?";
$lang['L_FM_AUTODEL1']="Automatisches Löschen: Folgende"
    ." Dateien wurden aufgrund der maximalen"
    ." Dateianzahl gelöscht:";
$lang['L_FM_CHOOSE_ENCODING']="Kodierung der Backupdatei wählen";
$lang['L_FM_COMMENT']="Kommentar eingeben";
$lang['L_FM_DELETE']="Ausgewählte Dateien löschen";
$lang['L_FM_DELETE1']="Die Datei";
$lang['L_FM_DELETE2']="wurde erfolgreich gelöscht.";
$lang['L_FM_DELETE3']="konnte nicht gelöscht werden!";
$lang['L_FM_DELETEALL']="Alle Backup-Dateien löschen";
$lang['L_FM_DELETEALLFILTER']="Alle löschen mit";
$lang['L_FM_DELETEAUTO']="Automatisches löschen manuell"
    ." ausführen";
$lang['L_FM_DUMPSETTINGS']="Einstellungen für das Backup";
$lang['L_FM_DUMP_HEADER']="Backup";
$lang['L_FM_FILEDATE']="Datum";
$lang['L_FM_FILES1']="Datenbank-Backups";
$lang['L_FM_FILESIZE']="Dateigröße";
$lang['L_FM_FILEUPLOAD']="Datei hochladen";
$lang['L_FM_FREESPACE']="Freier Speicher auf Server";
$lang['L_FM_LAST_BU']="letztes Backup";
$lang['L_FM_NOFILE']="Sie haben gar keine Datei ausgewählt!";
$lang['L_FM_NOFILESFOUND']="Keine Datei gefunden.";
$lang['L_FM_RECORDS']="Einträge";
$lang['L_FM_RESTORE']="Wiederherstellen";
$lang['L_FM_RESTORE_HEADER']="Wiederherstellung der Datenbank"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Auswahl bestimmter Tabellen";
$lang['L_FM_STARTDUMP']="Neues Backup starten";
$lang['L_FM_TABLES']="Tabellen";
$lang['L_FM_TOTALSIZE']="Gesamtgröße";
$lang['L_FM_UPLOADFAILED']="Der Upload ist leider fehlgeschlagen!";
$lang['L_FM_UPLOADFILEEXISTS']="Es existiert bereits eine Datei mit"
    ." diesem Namen!";
$lang['L_FM_UPLOADFILEREQUEST']="Geben Sie bitte eine Datei an.";
$lang['L_FM_UPLOADMOVEERROR']="Die hochgeladene Datei konnte nicht in"
    ." den richtigen Ordner verschoben"
    ." werden.";
$lang['L_FM_UPLOADNOTALLOWED1']="Dieser Dateityp ist nicht erlaubt.";
$lang['L_FM_UPLOADNOTALLOWED2']="Gültige Typen sind: *.gz und"
    ." *.sql-Dateien";
$lang['L_FOUND_DB']="gefundene DB:";
$lang['L_FROMFILE']="aus Datei";
$lang['L_FROMTEXTBOX']="aus Textfeld";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Verbindung hinzufügen";
$lang['L_FTP_CHOOSE_MODE']="FTP-Übertragungsmodus";
$lang['L_FTP_CONFIRM_DELETE']="Soll diese FTP-Verbindung wirklich"
    ." gelöscht werden?";
$lang['L_FTP_CONNECTION']="FTP-Verbindung";
$lang['L_FTP_CONNECTION_CLOSED']="FTP-Verbindung geschlossen";
$lang['L_FTP_CONNECTION_DELETE']="Verbindung löschen";
$lang['L_FTP_CONNECTION_ERROR']="Die Verbindung zum Server '%s' über"
    ." Port %s konnte nicht aufgebaut werden";
$lang['L_FTP_CONNECTION_SUCCESS']="Die Verbindung zum Server '%s' über"
    ." Port %s wurde erfolgreich hergestellt";
$lang['L_FTP_DIR']="Upload-Ordner";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Die Übertragung der Datei '%s' war"
    ." fehlerhaft";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="Die Datei '%s' wurde erfolgreich"
    ." übertragen";
$lang['L_FTP_LOGIN_ERROR']="Die Anmeldung als Benutzer '%s' wurde"
    ." abgelehnt";
$lang['L_FTP_LOGIN_SUCCESS']="Die Anmeldung als Benutzer '%s' war"
    ." erfolgreich";
$lang['L_FTP_OK']="Die Verbindung wurde erfolgreich"
    ." hergestellt.";
$lang['L_FTP_PASS']="Passwort";
$lang['L_FTP_PASSIVE']="passiven Übertragungsmodus benutzen";
$lang['L_FTP_PASV_ERROR']="Der Wechsel in den passiven FTP-Modus"
    ." war nicht erfolgreich";
$lang['L_FTP_PASV_SUCCESS']="Der Wechsel in den passiven FTP-Modus"
    ." war erfolgreich";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="an <strong>%s</strong><br />in"
    ." <strong>%s</strong>";
$lang['L_FTP_SERVER']="Server";
$lang['L_FTP_SSL']="Sichere SSL-FTP-Verbindung";
$lang['L_FTP_START']="Starte FTP-Übertragung";
$lang['L_FTP_TIMEOUT']="Verbindungs-Timeout";
$lang['L_FTP_TRANSFER']="FTP-Transfer";
$lang['L_FTP_USER']="Benutzer";
$lang['L_FTP_USESSL']="benutze SSL-Verbindung";
$lang['L_GENERAL']="Allgemein";
$lang['L_GZIP']="GZip-Kompression";
$lang['L_GZIP_COMPRESSION']="GZip-Kompression";
$lang['L_HOME']="Home";
$lang['L_HOUR']="Stunde";
$lang['L_HOURS']="Stunden";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Rewrite aktivieren";
$lang['L_HTACC_ADD_HANDLER']="Handler zufügen";
$lang['L_HTACC_CONFIRM_DELETE']="Soll der Verzeichnisschutz jetzt"
    ." erstellt werden?";
$lang['L_HTACC_CONTENT']="Inhalt der Datei";
$lang['L_HTACC_CREATE']="Verzeichnisschutz erstellen";
$lang['L_HTACC_CREATED']="Der Verzeichnisschutz wurde erstellt.";
$lang['L_HTACC_CREATE_ERROR']="Es ist ein Fehler bei der Erstellung"
    ." des Verzeichnisschutzes"
    ." aufgetreten!<br />Bitte erzeugen Sie"
    ." die Dateien manuell mit folgendem"
    ." Inhalt";
$lang['L_HTACC_CRYPT']="Crypt maximal 8 Zeichen (Linux und"
    ." Unix-Systeme)";
$lang['L_HTACC_DENY_ALLOW']="Deny / Allow";
$lang['L_HTACC_DIR_LISTING']="Verzeichnis-Listing";
$lang['L_HTACC_EDIT']=".htaccess editieren";
$lang['L_HTACC_ERROR_DOC']="Error-Dokument";
$lang['L_HTACC_EXAMPLES']="weitere Beispiele und Dokumentation";
$lang['L_HTACC_EXISTS']="Es besteht bereits ein"
    ." Verzeichnisschutz. Wenn Sie einen"
    ." neuen erstellen, wird der alte"
    ." überschrieben!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Ausführbar machen";
$lang['L_HTACC_MD5']="MD5 (Linux und Unix-Systeme)";
$lang['L_HTACC_NO_ENCRYPTION']="unverschlüsselt (Windows)";
$lang['L_HTACC_NO_USERNAME']="Sie müssen einen Namen eingeben!";
$lang['L_HTACC_PROPOSED']="Dringend empfohlen";
$lang['L_HTACC_REDIRECT']="Redirect";
$lang['L_HTACC_SCRIPT_EXEC']="Skript ausführen";
$lang['L_HTACC_SHA1']="SHA1 (alle Systeme)";
$lang['L_HTACC_WARNING']="Achtung! Die .htaccess hat eine"
    ." direkte Auswirkung auf den Browser.<br"
    ." />Bei falscher Anwendung sind die"
    ." Seiten nicht mehr erreichbar.";
$lang['L_IMPORT']="Import";
$lang['L_IMPORTIEREN']="importieren";
$lang['L_IMPORTOPTIONS']="Import-Optionen";
$lang['L_IMPORTSOURCE']="Import-Quelle";
$lang['L_IMPORTTABLE']="Import in Tabelle";
$lang['L_IMPORT_NOTABLE']="Es ist keine Tabelle für den Import"
    ." ausgewählt!";
$lang['L_IN']="in";
$lang['L_INDEX_SIZE']="Größe des Indexes";
$lang['L_INFO_ACTDB']="Aktuelle Datenbank";
$lang['L_INFO_DATABASES']="Datenbank(en) im Zugriff";
$lang['L_INFO_DBEMPTY']="Die Datenbank ist leer!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="Auf diesem Server ist die PHP-Funktion"
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
    ." zur Auswahl zur Verfügung.";
$lang['L_INFO_LASTUPDATE']="letzte Aktualisierung";
$lang['L_INFO_LOCATION']="Sie befinden sich auf";
$lang['L_INFO_NODB']="Datenbank existiert nicht";
$lang['L_INFO_NOPROCESSES']="keine laufenden Prozesse";
$lang['L_INFO_NOSTATUS']="kein Status verfügbar";
$lang['L_INFO_NOVARS']="keine Variablen verfügbar";
$lang['L_INFO_OPTIMIZED']="optimiert";
$lang['L_INFO_RECORDS']="Datensätze";
$lang['L_INFO_SIZE']="Größe";
$lang['L_INFO_SUM']="Insgesamt";
$lang['L_INSTALL']="Installation";
$lang['L_INSTALLED']="Installiert";
$lang['L_INSTALL_DB_DEFAULT']="Als Standarddatenbank festlegen";
$lang['L_INSTALL_HELP_PORT']="(leer = Standardport)";
$lang['L_INSTALL_HELP_SOCKET']="(leer = Standardsocket)";
$lang['L_IS_WRITABLE']="Ist beschreibbar";
$lang['L_KILL_PROCESS']="Prozess beenden";
$lang['L_LANGUAGE']="Sprache";
$lang['L_LANGUAGE_NAME']="Deutsch";
$lang['L_LASTBACKUP']="Letztes Backup";
$lang['L_LOAD']="Grundeinstellungen";
$lang['L_LOAD_DATABASE']="Datenbanken neu laden";
$lang['L_LOAD_FILE']="Datei laden";
$lang['L_LOG']="Log";
$lang['L_LOGFILENOTWRITABLE']="Log-Datei kann nicht geschrieben"
    ." werden!";
$lang['L_LOGFILES']="Log-Dateien";
$lang['L_LOGGED_IN']="Angemeldet";
$lang['L_LOGIN']="Anmelden";
$lang['L_LOGIN_AUTOLOGIN']="Automatisch anmelden";
$lang['L_LOGIN_INVALID_USER']="Diese Kombination von Benutzername und"
    ." Passwort ist unbekannt.";
$lang['L_LOGOUT']="Abmelden";
$lang['L_LOG_CREATED']="Logdatei angelegt.";
$lang['L_LOG_DELETE']="Log löschen";
$lang['L_LOG_MAXSIZE']="Maximale Größe der Logdateien";
$lang['L_LOG_NOT_READABLE']="Die Log-Datei '%s' existiert nicht"
    ." oder ist nicht lesbar.";
$lang['L_MAILERROR']="Leider ist beim Verschicken der E-Mail"
    ." ein Fehler aufgetreten!";
$lang['L_MAILPROGRAM']="Mailprogramm";
$lang['L_MAXIMUM_LENGTH']="Maximallänge";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="Dies ist die Anzahl von Bytes, die ein"
    ." Zeichen beim Speichern in diesem"
    ." Zeichensatz maximal verbraucht.";
$lang['L_MAXSIZE']="Maximale Größe";
$lang['L_MAX_BACKUP_FILES_EACH2']="für jede Datenbank";
$lang['L_MAX_EXECUTION_TIME']="Maximale Ausführungszeit";
$lang['L_MAX_UPLOAD_SIZE']="Maximale Dateigröße";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Wenn Ihre Backup-Datei größer als"
    ." das angegebene Limit ist, dann müssen"
    ." Sie diese per FTP in den"
    ." \"work/backup\"-Ordner hochladen. <br"
    ." />Danach wird diese Datei hier in der"
    ." Verwaltung angezeigt und lässt sich"
    ." für eine Wiederherstellung"
    ." auswählen.";
$lang['L_MEMORY']="Speicher";
$lang['L_MENU_HIDE']="Menü ausblenden";
$lang['L_MENU_SHOW']="Menü einblenden";
$lang['L_MESSAGE']="Nachricht";
$lang['L_MESSAGE_TYPE']="Nachrichtentyp";
$lang['L_MINUTE']="Minute";
$lang['L_MINUTES']="Minuten";
$lang['L_MOBILE_OFF']="Aus";
$lang['L_MOBILE_ON']="An";
$lang['L_MODE_EASY']="Einfach";
$lang['L_MODE_EXPERT']="Experte";
$lang['L_MSD_INFO']="MySQLDumper-Informationen";
$lang['L_MSD_MODE']="MySQLDumper-Modus";
$lang['L_MSD_VERSION']="MySQLDumper-Version";
$lang['L_MULTIDUMP']="Multidump";
$lang['L_MULTIDUMP_FINISHED']="Es wurden <b>%d</b> Datenbanken"
    ." gesichert";
$lang['L_MULTIPART_ACTUAL_PART']="Aktuelle Teildatei";
$lang['L_MULTIPART_SIZE']="Maximale Dateigröße";
$lang['L_MULTI_PART']="Multipart-Backup";
$lang['L_MYSQLVARS']="MySQL-Variablen";
$lang['L_MYSQL_CLIENT_VERSION']="MySQL-Client";
$lang['L_MYSQL_CONNECTION_ENCODING']="Standardkodierung des MySQL-Servers";
$lang['L_MYSQL_DATA']="MySQL-Daten";
$lang['L_MYSQL_ROUTINE']="Routine";
$lang['L_MYSQL_ROUTINES']="Routinen";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Gespeicherte Funktionen und Prozeduren";
$lang['L_MYSQL_TABLES_EXPLAIN']="Tabellen besitzen eine definierte"
    ." Spaltenstruktur in der Datensätze"
    ." gespeichert werden können. Jeder"
    ." Datensatz entspricht dabei einer Zeile"
    ." der Tabelle.";
$lang['L_MYSQL_VERSION']="MySQL-Version";
$lang['L_MYSQL_VERSION_TOO_OLD']="Es tut uns leid: die hier verfügbare"
    ." MySQL-Version %s ist leider zu alt und"
    ." kann nicht zusammen mit dieser"
    ." MySQLDumper-Version genutzt werden."
    ." Bitte aktualisieren Sie die"
    ." MySQL-Version auf mindestens Version"
    ." %s oder höher.<br />Alternativ"
    ." können Sie auf die"
    ." MySQLDumper-Version 1.24"
    ." zurückgreifen, welche sich auch mit"
    ." älteren MySQL-Servern betreiben"
    ." lässt. Jedoch gehen Ihnen in dem Fall"
    ." einige der neuen Funktionen in"
    ." MySQLDumper verloren.<br />";
$lang['L_MYSQL_VIEW']="Sicht";
$lang['L_MYSQL_VIEWS']="Sichten";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Sichten (Views) zeigen (gefilterte)"
    ." Ansichten auf Datensätze einer oder"
    ." mehrerer Tabellen. Sie selbst"
    ." enthalten keine Datensätze.";
$lang['L_NAME']="Name";
$lang['L_NEW']="neu";
$lang['L_NEWTABLE']="Neue Tabelle anlegen";
$lang['L_NEXT_AUTO_INCREMENT']="Nächster automatisch vergebener Index";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="Autoindex";
$lang['L_NO']="nein";
$lang['L_NOFTPPOSSIBLE']="Es stehen keine FTP-Funktionen zur"
    ." Verfügung!";
$lang['L_NOGZPOSSIBLE']="Da zlib nicht installiert ist, stehen"
    ." keine GZip-Funktionen zur Verfügung!";
$lang['L_NONE']="keine";
$lang['L_NOREVERSE']="Ältester Eintrag zuerst";
$lang['L_NOTAVAIL']="<em>nicht verfügbar</em>";
$lang['L_NOTHING_TO_DO']="Es gibt nichts zu tun.";
$lang['L_NOTICE']="Hinweis";
$lang['L_NOTICES']="Hinweise";
$lang['L_NOT_ACTIVATED']="nicht aktiviert";
$lang['L_NOT_SUPPORTED']="Dieses Backup unterstützt diese"
    ." Funktion nicht.";
$lang['L_NO_DB_FOUND']="Es wurde keine Datenbank gefunden.<br"
    ." />Blenden Sie die Verbindungsparameter"
    ." ein und geben Sie den Namen Ihrer"
    ." Datenbanken manuell ein!";
$lang['L_NO_DB_FOUND_INFO']="Die Verbindung zur Datenbank konnte"
    ." erfolgreich hergestellt werden.<br"
    ." /><br />Ihre Zugangsdaten sind gültig"
    ." und wurden vom MySQL-Server"
    ." akzeptiert.<br /><br />Leider konnte"
    ." MySQLDumper keine Datenbank finden.<br"
    ." /><br />Die automatische Erkennung per"
    ." Programm ist bei manchen Hostern"
    ." gesperrt.<br /><br />Sie müssen Ihre"
    ." Datenbank nach dem Abschluß der"
    ." Installation unter dem Menüpunkt"
    ." \"Konfiguration\""
    ." \"Verbindungsparameter einblenden\""
    ." angeben.<br /><br />Bitte begeben Sie"
    ." sich nach Abschluß der Installation"
    ." umgehend dort hin und tragen den Namen"
    ." Ihrer Datenbank dort ein.";
$lang['L_NO_DB_SELECTED']="Es ist keine Datenbank gewählt.";
$lang['L_NO_ENTRIES']="Die Tabelle ist leer und enthält"
    ." keine Einträge.";
$lang['L_NO_MSD_BACKUPFILE']="Dateien anderer Programme";
$lang['L_NO_NAME_GIVEN']="Sie haben keinen Namen angegeben.";
$lang['L_NR_OF_QUERIES']="Anzahl Querys";
$lang['L_NR_OF_RECORDS']="Anzahl der Datensätze";
$lang['L_NR_TABLES_OPTIMIZED']="%s Tabellen wurden optimiert.";
$lang['L_NUMBER_OF_FILES_FORM']="Anzahl von Backup-Dateien pro"
    ." Datenbank";
$lang['L_OF']="von";
$lang['L_OK']="OK";
$lang['L_OPTIMIZE']="Optimiere";
$lang['L_OPTIMIZE_TABLES']="Tabellen vor dem Backup optimieren";
$lang['L_OPTIMIZE_TABLE_ERR']="Fehler beim Optimieren der Tabelle"
    ." `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Die Tabelle `%s` wurde erfolgreich"
    ." optimiert.";
$lang['L_OS']="Betriebssystem";
$lang['L_OVERHEAD']="Überhang";
$lang['L_PAGE']="Seite";
$lang['L_PAGE_REFRESHS']="Seitenaufrufe";
$lang['L_PASS']="Passwort";
$lang['L_PASSWORD']="Kennwort";
$lang['L_PASSWORDS_UNEQUAL']="Die Passwörter sind nicht identisch"
    ." oder leer!";
$lang['L_PASSWORD_REPEAT']="Kennwort (Wiederholung)";
$lang['L_PASSWORD_STRENGTH']="Kennwortstärke";
$lang['L_PERLOUTPUT1']="Eintrag in crondump.pl für"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="Aufruf im Browser oder für externen"
    ." Cronjob";
$lang['L_PERLOUTPUT3']="Aufruf in der Shell oder für die"
    ." Crontab";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-Log";
$lang['L_PERL_LOG']="Perl-Log";
$lang['L_PHPBUG']="Bug in zlib! Keine Kompression"
    ." möglich!";
$lang['L_PHPMAIL']="PHP-Funktion mail()";
$lang['L_PHP_EXTENSIONS']="PHP-Erweiterungen";
$lang['L_PHP_LOG']="PHP-Log";
$lang['L_PHP_VERSION']="PHP-Version";
$lang['L_PHP_VERSION_TOO_OLD']="Es tut uns leid: die PHP-Version ist"
    ." leider zu alt, um MySQLDumper nutzen"
    ." zu können.<br />PHP muss in der"
    ." Version %s oder höher installiert"
    ." sein. Die auf diesem Server"
    ." installierte PHP-Version %s ist leider"
    ." zu alt.<br />Die PHP-Version muss"
    ." aktualisiert werden, bevor MySQLDumper"
    ." installiert und genutzt werden"
    ." kann.<br />";
$lang['L_POP3_PORT']="POP3-Port";
$lang['L_POP3_SERVER']="POP3-Server";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="unten mittig";
$lang['L_POSITION_BL']="unten links";
$lang['L_POSITION_BR']="unten rechts";
$lang['L_POSITION_MC']="mittig mittig";
$lang['L_POSITION_ML']="mittig links";
$lang['L_POSITION_MR']="mittig rechts";
$lang['L_POSITION_NOTIFICATIONS']="Position des Nachrichtenfensters";
$lang['L_POSITION_TC']="oben mittig";
$lang['L_POSITION_TL']="oben links";
$lang['L_POSITION_TR']="oben rechts";
$lang['L_POSSIBLE_COLLATIONS']="Mögliche Sortierungen";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="Dies sind die für diesen Zeichensatz"
    ." möglichen Sortierregeln.<br /><br"
    ." />_cs = case sensitiv ->"
    ." Groß-/Kleinschreibung wird"
    ." unterschieden<br />_ci = case"
    ." insensitive -> Groß-/Kleinschreibung"
    ." wird nicht beachtet";
$lang['L_PREFIX']="Präfix";
$lang['L_PRIMARYKEYS_CHANGED']="Primärschlüssel geändert";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Fehler beim Ändern der"
    ." Primärschlüssel";
$lang['L_PRIMARYKEYS_SAVE']="Primärschlüssel speichern";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Primärschlüssel wirklich löschen?";
$lang['L_PRIMARYKEY_DELETED']="Primärschlüssel gelöscht";
$lang['L_PRIMARYKEY_FIELD']="Schlüsselfeld";
$lang['L_PRIMARYKEY_NOTFOUND']="Primärschlüssel nicht gefunden";
$lang['L_PROCESSKILL1']="Es wird versucht, Prozess";
$lang['L_PROCESSKILL2']="zu beenden.";
$lang['L_PROCESSKILL3']="Es wird seit";
$lang['L_PROCESSKILL4']="Sekunde(n) versucht, Prozess";
$lang['L_PROCESS_ID']="Prozess ID";
$lang['L_PROGRESS_FILE']="Fortschritt Datei";
$lang['L_PROGRESS_OVER_ALL']="Fortschritt gesamt";
$lang['L_PROGRESS_TABLE']="Fortschritt Tabelle";
$lang['L_PROVIDER']="Provider";
$lang['L_PROZESSE']="Prozesse";
$lang['L_QUERY']="Abfrage";
$lang['L_QUERY_TYPE']="Query-Typ";
$lang['L_RECHTE']="Rechte";
$lang['L_RECORDS']="Datensätze";
$lang['L_RECORDS_INSERTED']="<b>%s</b> Datensätze wurden"
    ." eingetragen.";
$lang['L_RECORDS_OF_TABLE']="Datensätze der Tabelle";
$lang['L_RECORDS_PER_PAGECALL']="Datensätze pro Seitenaufruf";
$lang['L_REFRESHTIME']="Aktualisierungsintervall";
$lang['L_REFRESHTIME_PROCESSLIST']="Aktualisierungsintervall der"
    ." Prozessliste";
$lang['L_REGISTRATION_DESCRIPTION']="Geben Sie jetzt bitte den"
    ." Administrator-Zugang an. Mit diesem"
    ." Benutzer werden Sie sich künftig bei"
    ." MySQLDumper anmelden können. Merken"
    ." Sie sich die jetzt angegebenen Daten"
    ." deshalb gut.<br /><br />Sie können"
    ." Benutzername und Kennwort frei"
    ." wählen. Achten Sie jedoch darauf,"
    ." eine möglichst sichere Kombination"
    ." von Benutzername und Kennwort zu"
    ." wählen, um den Zugang zu MySQLDumper"
    ." bestmöglich vor unbefugten Zugriffen"
    ." zu schützen!";
$lang['L_RELOAD']="Neu laden";
$lang['L_REMOVE']="Entfernen";
$lang['L_REPAIR']="Repariere";
$lang['L_RESET']="Zurücksetzen";
$lang['L_RESET_SEARCHWORDS']="Eingabe zurücksetzen";
$lang['L_RESTORE']="Wiederherstellung";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> Tabellen wurden angelegt.";
$lang['L_RESTORE_DB']="Datenbank '<b>%s</b>' auf Server"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Wiederherstellung der Datenbank '%s'"
    ." in %s abgeschlossen.";
$lang['L_RESTORE_OF_TABLES']="Wiederherstellen bestimmter Tabellen";
$lang['L_RESTORE_TABLE']="Wiederherstellung der Tabelle '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Es wurden bisher <b>%d</b> von"
    ." <b>%d</b> Tabellen angelegt.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Es wurden bisher <b>%d</b> Tabellen"
    ." angelegt.";
$lang['L_RESULT']="Ergebnis";
$lang['L_REVERSE']="Neuster Eintrag zuerst";
$lang['L_SAFEMODEDESC']="Da PHP auf diesem Server mit der"
    ." Option \"safe_mode=on\" ausgeführt"
    ." wird, müssen folgende Verzeichnisse"
    ." von Hand angelegt werden (dies können"
    ." Sie mit Ihrem FTP-Programm"
    ." erledigen):<br /><br /><br />";
$lang['L_SAVE']="Speichern";
$lang['L_SAVEANDCONTINUE']="speichern und Installation fortsetzen";
$lang['L_SAVE_ERROR']="Die Einstellungen konnten nicht"
    ." gespeichert werden!";
$lang['L_SAVE_SUCCESS']="Die Einstellungen wurden erfolgreich"
    ." in der Konfigurationsdatei \"%s\""
    ." gespeichert.";
$lang['L_SAVING_DATA_TO_FILE']="Speichere Daten der Datenbank '%s' in"
    ." der Datei '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximale Dateigröße erreicht:"
    ." Fortfahren mit Datei '%s'";
$lang['L_SAVING_DB_FORM']="Datenbank";
$lang['L_SAVING_TABLE']="Speichere Tabelle";
$lang['L_SEARCH_ACCESS_KEYS']="Blättern: vor=ALT+V, zurück=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Suche in Tabelle";
$lang['L_SEARCH_NO_RESULTS']="Die Suche nach \"<b>%s</b>\" in der"
    ." Tabelle \"<b>%s</b>\" liefert keine"
    ." Ergebnisse!";
$lang['L_SEARCH_OPTIONS']="Suchoptionen";
$lang['L_SEARCH_OPTIONS_AND']="eine Spalte muss alle Suchbegriffe"
    ." enthalten (UND-Suche)";
$lang['L_SEARCH_OPTIONS_CONCAT']="ein Datensatz muss alle Suchbegriffe"
    ." enthalten, diese können aber in"
    ." beliebigen Spalten sein"
    ." (Rechenintensiv!)";
$lang['L_SEARCH_OPTIONS_OR']="eine Spalte muss mindestens einen"
    ." Suchbegriff enthalten (ODER-Suche)";
$lang['L_SEARCH_RESULTS']="Die Suche nach \"<b>%s</b>\" in der"
    ." Tabelle \"<b>%s</b>\" lieferte"
    ." folgende Treffer";
$lang['L_SECOND']="Sekunde";
$lang['L_SECONDS']="Sekunden";
$lang['L_SELECT']="Wählen";
$lang['L_SELECTED_FILE']="Gewählte Datei";
$lang['L_SELECT_ALL']="Alle auswählen";
$lang['L_SELECT_FILE']="Datei wählen";
$lang['L_SELECT_LANGUAGE']="Sprache wählen";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Ergebnis als Datei senden";
$lang['L_SEND_MAIL_FORM']="E-Mail senden";
$lang['L_SERVER']="Server";
$lang['L_SERVERCAPTION']="Anzeige des Servers";
$lang['L_SETPRIMARYKEYSFOR']="Setzen neuer Primärschlüssel für"
    ." die Tabelle";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Zeige Eintrag %s bis %s von %s";
$lang['L_SHOWRESULT']="Ergebnis anzeigen";
$lang['L_SHOW_TABLES']="Tabellen anzeigen";
$lang['L_SHOW_TOOLTIPS']="Schönere Tooltips anzeigen";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-Server";
$lang['L_SMTP_PORT']="SMTP-Port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Geschwindigkeit";
$lang['L_SQLBOX']="SQL-Box";
$lang['L_SQLBOXHEIGHT']="Höhe der SQL-Box";
$lang['L_SQLLIB_ACTIVATEBOARD']="Board aktivieren";
$lang['L_SQLLIB_BOARDS']="Boards";
$lang['L_SQLLIB_DEACTIVATEBOARD']="Board deaktivieren";
$lang['L_SQLLIB_GENERALFUNCTIONS']="allgemeine Funktionen";
$lang['L_SQLLIB_RESETAUTO']="Auto-Wert zurücksetzen";
$lang['L_SQLLIMIT']="Anzahl der Datensätze pro Seite";
$lang['L_SQL_ACTIONS']="Aktionen";
$lang['L_SQL_AFTER']="nach";
$lang['L_SQL_ALLOWDUPS']="Duplikate erlaubt";
$lang['L_SQL_ATPOSITION']="an Position einfügen";
$lang['L_SQL_ATTRIBUTES']="Attribute";
$lang['L_SQL_BACKDBOVERVIEW']="zurück zur Datenbank-Übersicht";
$lang['L_SQL_BEFEHLNEU']="neuer Befehl";
$lang['L_SQL_BEFEHLSAVED1']="SQL-Befehl";
$lang['L_SQL_BEFEHLSAVED2']="wurde hinzugefügt";
$lang['L_SQL_BEFEHLSAVED3']="wurde gespeichert";
$lang['L_SQL_BEFEHLSAVED4']="wurde nach oben gebracht";
$lang['L_SQL_BEFEHLSAVED5']="wurde gelöscht";
$lang['L_SQL_BROWSER']="SQL-Browser";
$lang['L_SQL_CARDINALITY']="Kardinalität";
$lang['L_SQL_CHANGED']="wurde geändert.";
$lang['L_SQL_CHANGEFIELD']="Feld ändern";
$lang['L_SQL_CHOOSEACTION']="Aktion wählen";
$lang['L_SQL_COLLATENOTMATCH']="Zeichensatz und Sortierung passen"
    ." nicht zueinander!";
$lang['L_SQL_COLUMNS']="Spalten";
$lang['L_SQL_COMMANDS']="SQL-Befehle";
$lang['L_SQL_COMMANDS_IN']="Zeilen in";
$lang['L_SQL_COMMANDS_IN2']="Sekunde(n) abgearbeitet.";
$lang['L_SQL_COPYDATADB']="Inhalt in Datenbank kopieren";
$lang['L_SQL_COPYSDB']="Struktur in Datenbank kopieren";
$lang['L_SQL_COPYTABLE']="Tabelle kopieren";
$lang['L_SQL_CREATED']="wurde angelegt.";
$lang['L_SQL_CREATEINDEX']="Neuen Index erzeugen";
$lang['L_SQL_CREATETABLE']="Tabelle anlegen";
$lang['L_SQL_DATAVIEW']="Daten-Ansicht";
$lang['L_SQL_DBCOPY']="Der Inhalt der Datenbank `%s` wurde in"
    ." die Datenbank `%s` kopiert.";
$lang['L_SQL_DBSCOPY']="Die Struktur der Datenbank `%s` wurde"
    ." in die Datenbank `%s` kopiert.";
$lang['L_SQL_DELETED']="wurde gelöscht.";
$lang['L_SQL_DESTTABLE_EXISTS']="Zieltabelle existiert schon!";
$lang['L_SQL_EDIT']="bearbeiten";
$lang['L_SQL_EDITFIELD']="Editiere Feld";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Tabellenstruktur bearbeiten";
$lang['L_SQL_EMPTYDB']="Datenbank leeren";
$lang['L_SQL_ERROR1']="Fehler bei der Anfrage:";
$lang['L_SQL_ERROR2']="MySQL meldet:";
$lang['L_SQL_EXEC']="SQL-Befehl ausführen";
$lang['L_SQL_EXPORT']="Export aus Datenbank `%s`";
$lang['L_SQL_FIELDDELETE1']="Das Feld";
$lang['L_SQL_FIELDNAMENOTVALID']="Fehler: Kein gültiger Feldname";
$lang['L_SQL_FIRST']="zuerst";
$lang['L_SQL_IMEXPORT']="Im-/Export";
$lang['L_SQL_IMPORT']="Import in Datenbank `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: unvollständige Anweisung"
    ." gefunden.<br />Konnte schließende"
    ." Übereinstimmung '%s' nicht finden."
    ." <br />Query:<br />%s";
$lang['L_SQL_INDEXES']="Indizes";
$lang['L_SQL_INSERTFIELD']="Feld einfügen";
$lang['L_SQL_INSERTNEWFIELD']="Neues Feld einfügen";
$lang['L_SQL_LIBRARY']="SQL-Bibliothek";
$lang['L_SQL_NAMEDEST_MISSING']="Name für die Zieldatenbank fehlt!";
$lang['L_SQL_NEWFIELD']="Neues Feld";
$lang['L_SQL_NODATA']="keine Datensätze";
$lang['L_SQL_NODEST_COPY']="Ohne Ziel kann nicht kopiert werden!";
$lang['L_SQL_NOFIELDDELETE']="Löschen nicht möglich, da eine"
    ." Tabelle mindestens 1 Feld haben muss.";
$lang['L_SQL_NOTABLESINDB']="Es befinden sich keine Tabellen in der"
    ." Datenbank";
$lang['L_SQL_NOTABLESSELECTED']="Es sind keine Tabellen ausgewählt!";
$lang['L_SQL_OPENFILE']="SQL-Datei öffnen";
$lang['L_SQL_OPENFILE_BUTTON']="Hochaden";
$lang['L_SQL_OUT1']="Es wurden";
$lang['L_SQL_OUT2']="Befehle ausgeführt";
$lang['L_SQL_OUT3']="Es gab";
$lang['L_SQL_OUT4']="Kommentare";
$lang['L_SQL_OUT5']="Da die Ausgabe über 5000 Zeilen"
    ." enthält, wird sie nicht angezeigt.";
$lang['L_SQL_OUTPUT']="SQL-Ausgabe";
$lang['L_SQL_QUERYENTRY']="Die Abfrage enthält";
$lang['L_SQL_RECORDDELETED']="Datensatz wurde gelöscht";
$lang['L_SQL_RECORDEDIT']="editiere Datensatz";
$lang['L_SQL_RECORDINSERTED']="Datensatz wurde gespeichert";
$lang['L_SQL_RECORDNEW']="Datensatz einfügen";
$lang['L_SQL_RECORDUPDATED']="Datensatz wurde geändert";
$lang['L_SQL_RENAMEDB']="Datenbank umbenennen";
$lang['L_SQL_RENAMEDTO']="wurde umbenannt in";
$lang['L_SQL_SCOPY']="Tabellenstruktur von `%s` wurde in"
    ." Tabelle `%s` kopiert.";
$lang['L_SQL_SEARCH']="Suche";
$lang['L_SQL_SEARCHWORDS']="Suchbegriff(e)";
$lang['L_SQL_SELECTTABLE']="Tabelle auswählen";
$lang['L_SQL_SERVER']="SQL-Server";
$lang['L_SQL_SHOWDATATABLE']="Daten der Tabelle anzeigen";
$lang['L_SQL_STRUCTUREDATA']="Struktur und Daten";
$lang['L_SQL_STRUCTUREONLY']="nur Struktur";
$lang['L_SQL_TABLEEMPTIED']="Tabelle `%s` wurde geleert.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="Tabelle `%s` wurde geleert, und die"
    ." Indizes wurden zurückgesetzt.";
$lang['L_SQL_TABLEINDEXES']="Indizes der Tabelle";
$lang['L_SQL_TABLENEW']="Tabellen bearbeiten";
$lang['L_SQL_TABLENOINDEXES']="Die Tabelle enthält keine Indizes";
$lang['L_SQL_TABLENONAME']="Tabelle braucht einen Namen!";
$lang['L_SQL_TABLESOFDB']="Tabellen der Datenbank";
$lang['L_SQL_TABLEVIEW']="Tabellen-Ansicht";
$lang['L_SQL_TBLNAMEEMPTY']="Tabellenname darf nicht leer sein!";
$lang['L_SQL_TBLPROPSOF']="Tabelleneigenschaften  von";
$lang['L_SQL_TCOPY']="Tabelle `%s` wurde mit Daten in"
    ." Tabelle `%s` kopiert.";
$lang['L_SQL_UPLOADEDFILE']="geladene Datei:";
$lang['L_SQL_VIEW_COMPACT']="Ansicht: kompakt";
$lang['L_SQL_VIEW_STANDARD']="Ansicht: normal";
$lang['L_SQL_VONINS']="von insgesamt";
$lang['L_SQL_WARNING']="Die Ausführung von SQL-Befehlen kann"
    ." Daten manipulieren! Der Autor"
    ." übernimmt keine Haftung bei"
    ." Datenverlusten.";
$lang['L_SQL_WASCREATED']="wurde erzeugt";
$lang['L_SQL_WASEMPTIED']="wurde geleert";
$lang['L_STARTDUMP']="Backup starten";
$lang['L_START_RESTORE_DB_FILE']="Beginne Wiederherstellung der"
    ." Datenbank '%s' aus Datei '%s'.";
$lang['L_START_SQL_SEARCH']="Suche starten";
$lang['L_STATUS']="Status";
$lang['L_STEP']="Schritt";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="Die Konfigurationsdatei \"%s\" wurde"
    ." erfolgreich angelegt.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="Die Konfigurationsdatei \"%s\" wurde"
    ." erfolgreich gelöscht.";
$lang['L_SUM_TOTAL']="Summe";
$lang['L_TABLE']="Tabelle";
$lang['L_TABLENAME']="Tabellenname";
$lang['L_TABLENAME_EXPLAIN']="Name der Tabelle";
$lang['L_TABLES']="Tabellen";
$lang['L_TABLESELECTION']="Tabellenauswahl";
$lang['L_TABLE_CREATE_SUCC']="Die Tabelle '%s' wurde erfolgreich"
    ." angelegt.";
$lang['L_TABLE_TYPE']="Tabellentyp";
$lang['L_TESTCONNECTION']="Verbindung testen";
$lang['L_THEME']="Stil";
$lang['L_TIME']="Zeit";
$lang['L_TIMESTAMP']="Zeitstempel";
$lang['L_TITLE_INDEX']="Index";
$lang['L_TITLE_KEY_FULLTEXT']="Volltextschlüssel";
$lang['L_TITLE_KEY_PRIMARY']="Primärschlüssel";
$lang['L_TITLE_KEY_UNIQUE']="Eindeutiger Schlüssel";
$lang['L_TITLE_MYSQL_HELP']="MySQL Dokumentation";
$lang['L_TITLE_NOKEY']="Kein Schlüssel";
$lang['L_TITLE_SEARCH']="Suche";
$lang['L_TITLE_SHOW_DATA']="Daten anzeigen";
$lang['L_TITLE_UPLOAD']="SQL-Datei hochladen";
$lang['L_TO']="bis";
$lang['L_TOOLS']="Tools";
$lang['L_TOOLS_TOOLBOX']="Datenbank auswählen /"
    ." Datenbankfunktionen / Im- und Export";
$lang['L_TRUNCATE']="Leeren";
$lang['L_TRUNCATE_DATABASE']="Datenbank leeren";
$lang['L_UNIT_KB']="KiloByte";
$lang['L_UNIT_MB']="MegaByte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="unbekannt";
$lang['L_UNKNOWN_SQLCOMMAND']="Unbekannter SQL-Befehl:";
$lang['L_UPDATE']="Aktualisieren";
$lang['L_UPDATE_CONNECTION_FAILED']="Aktualisierung fehlgeschlagen, da"
    ." keine Verbindung zum Server '%s'"
    ." aufgebaut werden konnte.";
$lang['L_UPDATE_ERROR_RESPONSE']="Aktualisierung fehlgeschlagen, Server"
    ." antwortete: '%s'";
$lang['L_UPTO']="bis";
$lang['L_USERNAME']="Benutzername";
$lang['L_USE_SSL']="SSL benutzen";
$lang['L_VALUE']="Wert";
$lang['L_VERSIONSINFORMATIONEN']="Versionsinformationen";
$lang['L_VIEW']="ansehen";
$lang['L_VISIT_HOMEPAGE']="Besuchen Sie die Homepage";
$lang['L_VOM']="vom";
$lang['L_WITH']="mit";
$lang['L_WITHATTACH']="mit Anhang";
$lang['L_WITHOUTATTACH']="ohne Anhang";
$lang['L_WITHPRAEFIX']="mit Praefix";
$lang['L_WRONGCONNECTIONPARS']="Falsche oder keine"
    ." Verbindungsparameter!";
$lang['L_WRONG_CONNECTIONPARS']="Verbindungsparameter stimmen nicht!";
$lang['L_WRONG_RIGHTS']="Die Datei oder das Verzeichnis '%s'"
    ." ist für mich nicht beschreibbar. Der"
    ." Besitzer (Owner) oder die Rechte"
    ." (Chmod) sind falsch gesetzt.<br /><br"
    ." />Setzen Sie die richtigen Attribute"
    ." mit Ihrem FTP-Programm. Die Datei oder"
    ." das Verzeichnis benötigt die Rechte"
    ." %s.";
$lang['L_YES']="ja";
$lang['L_ZEND_FRAMEWORK_VERSION']="Zend Framework Version";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="Der angegebene Dateiname '%value%' ist"
    ." kein Verzeichnis.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="Der angegebene Dateiname '%value%' ist"
    ." keine Datei.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="Das angegebene Ziel '%value%' ist kein"
    ." Link.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="Die Datei oder das Verzeichnis"
    ." '%value%' ist nicht ausführbar.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="Die Datei oder das Verzeichnis"
    ." '%value%' existiert nicht.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="Die Datei oder das Verzeichnis"
    ." '%value%' ist nicht lesbar.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="Die angegebene Datei '%value%' wurde"
    ." nicht hoch geladen.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="Die Datei oder das Verzeichnis"
    ." '%value%' ist nicht schreibbar.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Ungültigen Typ übergeben. Erwartet"
    ." wird String, Integer oder Float.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="Der Wert ist leer.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="Die E-Mail-Adresse kann nicht gegen"
    ." das \"Dot-Atom\"-Format geprüft"
    ." werden.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Ungültiger Typ übergeben. Erwartet"
    ." wird String.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="Das Format der E-Mail-Adresse ist"
    ." ungültig.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="Der Domainname ist ungültig.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="Der lokale Teil der E-Mail-Adresse"
    ." (Lokaler-Teil@Domain.TLD) ist"
    ." ungültig.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="Für die E-Mail-Adresse gibt es keinen"
    ." gültigen MX-Eintrag.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="Die Domain befindet sich in einem"
    ." nicht routbaren Netzwerksegment. Die"
    ." E-Mail-Adresse kann vom öffentlichen"
    ." Netzwerk nicht aufgelöst werden.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="Die E-Mail-Adresse ist zu lang. Sie"
    ." darf maximal 320 Zeichen lang sein.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="Die E-Mail-Adresse kann nicht gegen"
    ." das \"Quoted-String\"-Format geprüft"
    ." werden.";
$lang['L_ZEND_ID_HOSTNAME_CANNOT_DECODE_PUNYCODE']="Die angegebene Punycode-Schreibweise"
    ." des Domainnamen kann nicht dekodiert"
    ." werden.";
$lang['L_ZEND_ID_HOSTNAME_DASH_CHARACTER']="Der Domainname enthält einen"
    ." Bindestrich an einer ungültigen"
    ." Position.";
$lang['L_ZEND_ID_HOSTNAME_INVALID']="Ungültiger Typ übergeben. Erwartet"
    ." wird String.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME']="Der Domainname entspricht nicht der"
    ." erwarteten Struktur.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME_SCHEMA']="Der Domainname entspricht nicht dem"
    ." Schema der angegebenen TLD.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_LOCAL_NAME']="Der Domainname beinhaltet einen"
    ." ungültigen lokalen Netzwerknamen.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_URI']="Der Domainname entspricht nicht der"
    ." URI-Syntax.";
$lang['L_ZEND_ID_HOSTNAME_IP_ADDRESS_NOT_ALLOWED']="IP-Adressen in Dommainnamen sind nicht"
    ." erlaubt.";
$lang['L_ZEND_ID_HOSTNAME_LOCAL_NAME_NOT_ALLOWED']="Lokale Netzwerknamen in Domainnamen"
    ." sind nicht erlaubt.";
$lang['L_ZEND_ID_HOSTNAME_UNDECIPHERABLE_TLD']="Die TLD kann nicht aus dem Domainnamen"
    ." extrahiert werden.";
$lang['L_ZEND_ID_HOSTNAME_UNKNOWN_TLD']="Der Domainname enthält unbekannte"
    ." TLD.";
$lang['L_ZEND_ID_IS_EMPTY']="Der Wert wird benötigt und darf nicht"
    ." leer sein.";
$lang['L_ZEND_ID_MISSING_TOKEN']="Es wurde kein Merkmal zum Gegenprüfen"
    ." angegeben.";
$lang['L_ZEND_ID_NOT_DIGITS']="Es dürfen nur Zahlen eingegeben"
    ." werden.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Der Typ des Wertes ist ungültig. Es"
    ." wird ein String, Integer, Float,"
    ." Boolean oder Array erwartet.";
$lang['L_ZEND_ID_NOT_SAME']="Die beiden angegebenen Merkmale"
    ." stimmen nicht überein.";
return $lang;
