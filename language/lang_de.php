<?
// Allgemeine Texte
$lang['no']='nein';
$lang['yes']='ja';
$lang['to']='bis';
$lang['activated']='aktiviert';
$lang['not_activated']='nicht aktiviert';
$lang['error']='Fehler';
$lang['of']=' von ';
$lang['added']='hinzugef&uuml;gt';
$lang['first_run']='Datenbanken gefunden:';
$lang['dbrefresh']='Datenbanken neu laden';
$lang['db']='Datenbank';
$lang['dbs']='Datenbanken';
$lang['onlinehelp']='Onlinehilfe';
$lang['tables']='Tabellen';
$lang['table']='Tabelle';
$lang['records']='Datens&auml;tze';
$lang['compressed']='komprimiert (gz)';
$lang['general']='allgemein';
$lang['comment']='Kommentar';
$lang['filesize']='Dateigr&ouml;sse';
$lang['all']='alle';
$lang['none']='keine';
$lang['with']=' mit ';
$lang['dir']='Verzeichnis';
$lang['rechte']='Rechte';
$lang['status']='Status';
$lang['never']='nie';
$lang['finished']='fertig';
$lang['file']='Datei';
$lang['field']='Feld';
$lang['fields']='Felder';
$lang['was']='wurde';
$lang['new']='neue';
$lang['charset']='Zeichensatz';
$lang['collation']='Sortierung';
$lang['change']='&auml;ndern';
$lang['in']='in';
$lang['do']='ausf&uuml;hren';
$lang['errors_occured']='Es sind Fehler aufgetreten';
$lang['view']='ansehen';
$lang['new']='neu';
$lang['existing']='vorhanden';

$lang['critical_safemode']='<h3>Achtung: Fortsetzung im Safe-Modus nicht m&ouml;glich!</h3>Folgende Verzeichnisse m&uuml;ssen manuell im Scriptverzeichnisses angelegt werden:<br><div style="padding-left:20px;"><br>work<br>work/backup<br>work/config<br>work/log<br>work/structure</div><br>Geben sie all diesen Verzeichnissen die vollen Rechte (chmod 777).<br>Danach kann MySQL Dumper auch im Safe-Modus problemlos genutzt werden.';

$lang['mailabsendererror']='Mail kann ohne Absender nicht verschickt werden !';
$lang['Ausgabe']='Ausgabe';
$lang['Zusatz']='Zusatz';
$lang['Variabeln']='Variabeln';
$lang['berichtsent']='Der Fehlerbericht wurde erfolgreich abgesendet.';
$lang['autobericht']='automatisch generierter Fehlerbericht von';
$lang['berichtman1']='Bitte senden Sie die Mail manuell an das';
$lang['Statusinformationen']='Statusinformationen';
$lang['Versionsinformationen']='Versionsinformationen';
$lang['MySQL Dumper Informationen']='MySQL Dumper Informationen';
$lang['Fehlerbericht']='Fehlerbericht';
$lang['backupfilesanzahl']='Im Backupverzeichnis befinden sich';
$lang['lastbackup']='Letztes Backup';
$lang['notavail']='<em>nicht verf&uuml;gbar</em>';
$lang['vom']='vom';
$lang['mysqlvars']='Mysql-Variabeln';
$lang['mysqlsys']='Mysql-Befehle';

$lang['Status']='Status';
$lang['Prozesse']='Prozesse';
$lang['info_novars']='keine Variabeln verf&uuml;gbar';
$lang['Inhalt']='Inhalt';
$lang['info_nostatus']='kein Status verf&uuml;gbar';
$lang['info_noprocesses']='keine laufenden Prozesse';

//Hilfe-Texte
$lang['help_db']='Dies ist die Liste der vorhandenen Datenbanken';
$lang['help_praefix']='Der Praefix ist eine Zeichenfolge f&uuml;r den Anfang von Tabellen, der als Filter fungiert.';
$lang['help_sqltrenn']='Ein Trennzeichen, um die SQL-Befehle eindeutig zu trennen.';
$lang['help_zip']='Kompression mit GZip - emfohlen ist \'aktiviert\'';
$lang['help_memorylimit']='Das ist die max. Gr&ouml;sse in Bytes, die das Skript an Speicher bekommt'."\n".'0 = deaktiviert';
$lang['memory_limit']='Speichergrenze';
$lang['help_budir']='Hier werden die Datenbank-Backups gespeichert.';
$lang['help_mail1']='wenn aktiviert, dann wird nach der Erstellung der Sicherung eine Email mit dem Backup verschickt.';
$lang['help_mail2']='Dies ist die Empf&auml;nger-Adresse der Email.';
$lang['help_mail3']='Dies ist die Absende-Adresse der Email.';
$lang['help_mail4']='Die maximale Gr&ouml;sse f&uuml;r einen Email-Anhang, bei 0 bleibt die Angabe unber&uuml;cksichtigt';
$lang['help_mail5']='Hier kann bestimmt werden, ob das Backup als Email-Anhang verschickt werden soll';
$lang['help_ad1']='Wenn aktiviert, dann werden automatisch Backupfiles gel&ouml;scht.';
$lang['help_ad2']='die maximale Anzahl von Tagen, die ein Backupfile haben darf (f&uuml;r Autodelete)'."\n".'0 = deaktiviert';
$lang['help_ad3']='die maximale Anzahl von Dateien, die im Backupverzeichnis sein d&uuml;rfen (f&uuml;r Autodelete)'."\n".'0 = deaktiviert';
$lang['help_lang']='stell auf die gew&uuml;nschte Sprache';
$lang["help_empty_db_before_restore"]='Um &uuml;berfl&uuml;ssige Daten zu eleminieren kann man anweisen, die Datenbank vor der Wiederherstellung komplett zu leeren';
$lang['help_crontime']='die Zeit, die das Cronscript zus&auml;tzlich bekommt (in Sekunden)';
$lang['help_cronmail']='bestimme, ob im Cronjob das Backup per Mail verschickt werden soll';
$lang['help_cronmailprg']='der Pfad zum Mailprogramm, default ist sendmail im angegebenen Pfad';
$lang['help_cronmailto']='die Adresse, an die die Mail geschickt wird';
$lang['help_cronftp']='bestimme, ob im Cronjob das Backup per FTP verschickt werden soll';
$lang['help_cronzip']='Kompression mit GZip - emfohlen ist \'aktiviert\' (die Kompressions-Lib muss installiert sein!)';
$lang['help_cronperlpath']='Der Pfad zu Perl muss korrekt angegeben werden, sonst ist das Skript nicht lauff&auml;hig.'."\n".'In den meisten F&auml;llen ist das der vorgegebene Standardpfad.';
$lang['help_cronextender']='Die Endung des Perlscriptes, Standard ist \'.pl\'';
$lang['help_cronsavepath']='Der Name der Konfigurationsdatei f&uuml;r das Perlskript';
$lang['help_cronprintout']='Um das Script im Browser zu starten muss Textausgabe aktiviert sein.';
$lang['help_cronsamedb']='Soll die gleiche Datenbank f&uuml;r Cronjob wie in Einstellungen benutzt werden?';
$lang['help_crondbindex']='w&auml;hle die Datenbank f&uuml;r den Cronjob';
$lang['help_cronmail_dump']='';


$lang['help_ftptransfer']='wenn aktiviert, wird nach Backup die Datei per FTP gesendet.';
$lang['help_ftpserver']='Adresse des FTP-Servers';
$lang['help_ftpport']='Port des FTP-Servers, Standard: 21';
$lang['help_ftpuser']='gib den Benutzername der FTP-Verbindung an';
$lang['help_ftppass']='gib das Passwort der FTP-Verbindung an';
$lang['help_ftpdir']='wohin soll das File gesendet werden?';
$lang['help_chmod']='Standardeinstellung ist 777';
$lang['help_speed']='Minimale und maximale Geschwindigkeit, Standard ist 50 bis 5000'."\n".'(zu hohe Geschwindigkeiten k&ouml;nnen zu Timeouts f&uuml;hren!)';
$lang['speed']='Geschwindigkeitskontrolle';
$lang['help_cronexecpath']="Der Ort, an dem die Perlskripte liegen.\nAusgangspunkt ist die HTTP-Adresse (also im Browser)\nErlaubt sind absolute und relative Pfadangaben.";
$lang['cron_execpath']='Pfad der Perlskripte';
$lang['help_browser']='W&auml;hle Deinen Browser.'."\n".'Achtung: benutze nicht den Internet Explorer mit der Einstellung \'andere Browser\' !';

// Text in filemanagement.php
$lang['fm_title']='Verwaltung';
$lang['fm_uploadfilerequest']='Bitte gib eine Datei an.';
$lang['fm_uploadnotallowed1']='Dieser Dateityp ist nicht erlaubt.';
$lang['fm_uploadnotallowed2']='G&uuml;ltige Typen sind: *.gz und *.sql-Dateien';
$lang['fm_uploadmoveerror']='Konnte die hochgeladene Datei nicht in den richtigen Ordner verschieben.';
$lang['fm_uploadfailed']='Der Upload ist leider fehlgeschlagen!';
$lang['fm_uploadfileexists']='Es existiert bereits eine Datei mit diesem Namen !';
$lang['fm_nofile']='Du hast gar keine Datei ausgew&auml;hlt!';
$lang['fm_delete1']='Die Datei ';
$lang['fm_delete2']=' wurde erfolgreich gel&ouml;scht.';
$lang['fm_delete3']=' konnte nicht gel&ouml;scht werden!';
$lang['fm_choose_file']='gew&auml;hlte Datei:';
$lang['fm_filename']='Dateiname';
$lang['fm_filesize']='Dateigr&ouml;&szlig;e';
$lang["fm_filedate"]='Datum';
$lang['fm_nofilesfound']='Keine Datei gefunden.';
$lang['fm_tables']='Tabellen';
$lang['fm_records']='Eintr&auml;ge';

$lang['fm_all_bu']='alle Backups';
$lang['fm_anz_bu']='Anzahl Backups';
$lang['fm_last_bu']='letztes Backup';
$lang['fm_totalsize']='gesamte Gr&ouml;&szlig;e';
$lang['fm_selecttables']='Auswahl der Tabellen';
$lang['fm_comment']='Kommentar eingeben';

$lang['fm_sizesum']='Gesamtgr&ouml;&szlig;e';
$lang['fm_freespace']='Freier Speicher auf Server';
$lang['fm_choosefile']='W&auml;hle eine Datei zur Wiederherstellung oder zum L&ouml;schen aus:';
$lang['fm_restore']='Wiederherstellen';
$lang['fm_alertrestore1']='Soll die Datenbank ';
$lang['fm_alertrestore2']='mit den Inhalten der Datei';
$lang['fm_alertrestore3']='wiederhergestellt werden?';
$lang['fm_delete']='L&ouml;schen';
$lang['fm_askdelete1']='M&ouml;chtest Du die Datei ';
$lang['fm_askdelete2']=' wirklich l&ouml;schen?';
$lang['fm_askdelete3']='M&ouml;chten sie Autodelete nach den eingestellten Regeln jetzt ausf&uuml;hren?';
$lang['fm_askdelete4']='M&ouml;chten sie alle Backupdateien jetzt l&ouml;schen?';
$lang['fm_askdelete5']='M&ouml;chten sie alle Backupdateien mit ';
$lang['fm_askdelete5_2']='_* jetzt l&ouml;schen?';
$lang['fm_deleteauto']='Autodelete manuell ausf&uuml;hren';
$lang['fm_deleteall']='alle Backupdateien l&ouml;schen';
$lang['fm_deleteallfilter']='alle l&ouml;schen mit ';
$lang['fm_deleteallfilter2']='_*';
$lang['fm_newdump']='Oder beginne ein neues Backup:';
$lang['fm_startdump']='Neues Backup starten';
$lang['fm_upload']='Oder lade eine Datei hoch:';
$lang['fm_fileupload']='Datei hochladen';
$lang['fm_fileimport']='SQL-Datei importieren';
$lang['fm_dbname']='Datenbankname';
$lang['fm_files1']='Datenbank-Backups';
$lang['fm_files2']='Datenbank-Strukturen';
$lang['fm_autodel1']='Autodelete: Folgende Dateien wurden aufgrund der maximalen Files gel&ouml;scht:';
$lang['fm_autodel2']='Autodelete: Folgende Dateien wurden aufgrund ihres Erstellungsdatums gel&ouml;scht:';

$lang['fm_dumpsettings']='Einstellungen f&uuml;r das Backup';
$lang['fm_dumpsettings_cron']='Einstellungen f&uuml;r das Perl-Cronscript';
$lang['fm_oldbackup']='(unbekannt)';
$lang['fm_restore_header']='Wiederherstellung der Datenbank <strong>"';
$lang['fm_restore_header2']='"</strong>';
$lang['fm_dump_header']='Backup';

$lang['DoCronButton']='Perl-Cronscript ausf&uuml;hren';
$lang['DoPerlTest']='Perl-Module testen';
$lang['DoSimpleTest']='Perl testen';
$lang['cronperldesc']='Dies geht nur, wenn Perl ausgef&uuml;hrt werden kann. <br>Das Script liegt unter ';


// Text in dump.php
$lang['dump']='Backup';
$lang['dump_headline']='erzeuge Backup...';
$lang['gzip_compression']='GZip-Kompression ist';
$lang['on']='an';
$lang['off']='aus';
$lang['saving_table']='Speichere Tabelle ';
$lang['of']='von';
$lang['actual_table']='Aktuelle Tabelle';
$lang['progress_table']='Fortschritt Tabelle';
$lang['progress_over_all']='Fortschritt gesamt';
$lang['entry']='Eintrag';
$lang['done']='Fertig!';
$lang['file']='Datei';
$lang['dump_successful']=' wurde erfolgreich erstellt.';
$lang['upto']='bis';
$lang['email_was_send']='Die Email wurde erfolgreich verschickt an ';
$lang['back_to_control']='weiter';
$lang['dump_filename']='Backup-Datei: ';
$lang['withpraefix']='mit Praefix';
$lang['dump_notables']='Ich konnte keine Tabellen in der Datenbank \'<b>';
$lang['dump_notables2']='</b>\' finden.';
$lang['dump_endergebnis1']='Es wurden ';
$lang['dump_endergebnis2']=' Tabellen mit insgesamt ';
$lang['dump_endergebnis3']=' Datens&auml;tzen gesichert.<br>';
$lang['mailerror']='Leider ist beim Verschicken der Email ein Fehler aufgetreten!';

$lang['emailbody_n1']='In der Anlage findest Du die Sicherung Deiner MySQL-Datenbank.<br>Sicherung der Datenbank ';
$lang['emailbody_n2']='<br><br>Viele Gr&uuml;sse<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
$lang['emailbody_mp1']='Es wurde eine Multipart-Sicherung erstellt.<br>Die Sicherungen werden nicht als Anhang mitgeliefert!<br>Sicherung der Datenbank `';
$lang['emailbody_mp1an']='Es wurde eine Multipart-Sicherung erstellt.<br>Die Sicherungen werden in seperaten Mails als Anhang geliefert!<br>Sicherung der Datenbank `';
$lang['emailbody_mp1a']='`<br><br>Folgene Dateien wurden erzeugt:<br><br>';
$lang['emailbody_mp2']='<br><br><br>Viele Gr&uuml;sse<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
$lang['emailbody_tb1']='Die Sicherung &uuml;berschreitet die Maximalgr&ouml;sse von ';
$lang['emailbody_tb2']=' und wurde daher nicht angeh&auml;ngt.<br>Sicherung der Datenbank ';
$lang['emailbody_tb3']='<br><br>Viele Gr&uuml;sse<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a><br><br>Folgene Datei wurde erzeugt:<br><br>';
$lang['emailbody_na']='Das Backup wurde nicht angeh&auml;ngt.<br>Sicherung der Datenbank ';
$lang['only_attachment']=' ... nur der Anhang';
$lang['tableselection']='Tabellenauswahl';
$lang['selectall']='alle deselektieren';
$lang['deselectall']='alle selektieren';
$lang['startdump']='Backup starten';
$lang['datawith']='Datens&auml;tze mit';
$lang['lastbufrom']='letztes Update vom';
$lang['startrestore']='Wiederherstellung starten';
$lang['not_supported']='Dieses Backup unterst&uuml;tzt diese Funktion nicht.';

$lang['multidump1']='Multidump: Es wurden ';
$lang['multidump2']=' Datenbanken gesichert.';
$lang['filesendftp']='versende File via FTP... bitte hab etwas Geduld. ';
$lang['ftpconnerror']='FTP-Verbindung nicht hergestellt! Verbindung mit ';
$lang['ftpconnerror1']=' als Benutzer ';
$lang['ftpconnerror2']=' nicht m&ouml;glich';
$lang['ftpconnerror3']='FTP-Upload war fehlerhaft! ';
$lang['ftpconnected1']='Verbunden mit ';
$lang['ftpconnected2']=' auf ';
$lang['ftpconnected3']=' geschrieben';


// Text in restore.php
$lang['restore']='Wiederherstellung';
$lang['restore_db']='der Datenbank <b>';
$lang['restore_db1']='</b> auf <b>';
$lang['restore_db2']='</b>.<br>';
$lang['restore_complete']='</b> Tabellen wurden angelegt.';
$lang['restore_run1']='<br>Bisher wurden <b>';
$lang['restore_run2']='</b> Datens&auml;tze erfolgreich eingetragen.';
$lang['restore_run3']='<br>Momentan wird die Tabelle <b>';
$lang['restore_run4']='</b> mit Daten gef&uuml;llt.<br>';
$lang['restore_run5']='der Datei wiederhergestellt.';
$lang['restore_total_complete']='<br><b>Herzlichen Gl&uuml;ckwunsch.</b><br><br>Die Datenbank wurde komplett wiederhergestellt.<br>Alle Daten aus der Backupdatei wurden erfolgreich in die Datenbank eingetragen.<br><br>Alles fertig. :-)';
$lang['db_no_connection']='Keine Verbindung zur Datenbank m&ouml;glich!';
$lang['db_select_error']='<br>Fehler:<br>Auswahl der Datenbank \'<b>';
$lang['db_select_error2']='</b>\' fehlgeschlagen!';
$lang['file_open_error']='Fehler: Ich konnte die Datei nicht &ouml;ffnen.';
$lang['restore_entryerror']='Fehler beim Eintrag des Befehls:';


// Text in config_overview.php
$lang['config_headline']='Konfiguration';
$lang['sql_trenn']="Trennzeichen";
$lang['no_send_mail']='Die fertige Backupdatei wird <b>nicht</b> per Email verschickt.';
$lang['no_del_files']='Es gibt keine Altersbegrenzung der Backupdateien.';
$lang['no_number_of_files']='Es gibt keine Begrenzung der Anzahl von Backupdateien.';
$lang['save_success']='Die Einstellungen wurden erfolgreich gespeichert.';
$lang['save_error']='Die Einstellungen konnten nicht gespeichert werden !';
$lang['config_databases']='Datenbanken';
$lang['config_dumprestore']='Backup / Wiederherstellung';
$lang['config_email']='Email-Benachrichtigung';
$lang['config_autodelete']='automatisches L&ouml;schen';
$lang['config_interface']='Interface';
$lang['config_cron']='Crondump-Einstellungen f&uuml;r das PHP-Script';
$lang['multi_part']='Multipart-Backup';
$lang['multi_part_groesse']='maximale Dateigr&ouml;&szlig;e';
$lang['help_multipart']='Bei eingeschaltetem Multipart werden mehrere Backupdateien erzeugt, deren Maximalgr&ouml;sse sich nach der unteren Einstellung richtet';
$lang['help_multipartgroesse']='Die maximale Gr&ouml;sse der einzelnen Backupdateien kann hier bei eingeschaltetem Multipart bestimmt werden';
$lang['empty_db_before_restore']='Datenbank vor Wiederherstellung l&ouml;schen';
$lang['allpars']='alle Parameter';
$lang['cron_timelimit']='Zeitlimit f&uuml;r das PHP-Cronjob-Script';
$lang['cron_perlpath']='Pfad zu perl(.exe)';
$lang['cron_extender']='Dateiendung des Scripts';
$lang['cron_savepath']='Konfigurationsdatei';
$lang['cron_printout']='Textausgabe';
$lang['config_cronperl']='Crondump-Einstellungen f&uuml;r das Perlscript';
$lang['cron_mail']='Backup per Mail senden';
$lang['cron_mailprg']='Mailprogramm';
$lang['cron_mailto']='Mailadresse';
$lang['cron_ftp']='Backup per FTP senden';
$lang['optimize']='Tabellen vor dem Backup optimieren';
$lang['help_optimize']='Wenn die Option aktiviert ist, werden vor jedem Backup alle Tabellen optimiert';
$lang["help_ftptimeout"]='Die Zeit, die bei keiner &Uuml;bertragung zum Timeout f&uuml;hrt, Default 90 sek.';
$lang["ftp_timeout"]='Verbindungs-Timeout';
$lang["help_ftpssl"]='';

$lang['useconnection']='Benutze Verbindung';
$lang['wrongconnectionpars']='Falsche oder keine Verbindungs-parameter !';
$lang['conn_not_pssible']='Verbindung nicht m&ouml;glich !';
$lang['servercaption']='Anzeige des Servers';
$lang['help_servercaption']='Bei Benutzung auf verschieden Systemen kann es hilfreich sein, die Server-Adresse farblich gekennzeichnet einzublenden';
$lang['otherbrowser']='andere Browser';
$lang['activate_multidump']='MultiDump aktivieren';
$lang['praefix']='Tabellen-Pr&auml;fix';
$lang['config_askload']='Sollen die Einstellungen wirklich mit den Anfangseinstellungen &uuml;berschrieben werden?';
$lang['load']='Anfangseinstellungen laden';
$lang['load_success']='Die Anfangseinstellungen wurden geladen.';
$lang['cron_samedb']='Aktuelle Datenbank benutzen';
$lang['cron_crondbindex']='Datenbank und Tabellen-Pr&auml;fix<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f&uuml;r den Cronjob';
$lang['withattach']=' mit Anhang';
$lang['withoutattach']=' ohne Anhang';
$lang['multidumpconf']='=Multidump Einstellungen=';
$lang['multidumpall']='=alle Datenbanken=';


$lang['gzip']='GZip-Kompression';
$lang['backup_dir']='Backup-Verzeichnis';
$lang['db_host']='Hostname';
$lang['saving_db_form']='Datenbank';
$lang['db_user']='Benutzer';
$lang['db_pass']='Passwort';
$lang['db_only']='nur mit folgender Datenbank verbinden';
$lang['send_mail_form']='Email senden';
$lang['send_mail_dump']='Backup anh&auml;ngen';
$lang['email_adress']='Email-Adresse';
$lang['email_subject']='Absender der Email';
$lang['email_maxsize']='maximale Gr&ouml;sse des Anhangs';
$lang['age_of_files']='Alter der Dateien (in Tagen)';
$lang['number_of_files_form']='Anzahl von Backupdateien';
$lang['language']='Sprache';
$lang['list_db']='Konfigurierte Datenbanken:';
$lang['save']='Speichern';
$lang['reset']='zur&uuml;cksetzen';
$lang['autodelete']='automatisches L&ouml;schen der Backups';
$lang['max_backup_files_each1']='f&uuml;r alle Datenbanken';
$lang['max_backup_files_each2']='f&uuml;r jede Datenbank';
$lang['config_ftp']='FTP-Transfer der Backupdatei';

$lang['ftp_transfer']='FTP-Transfer';
$lang['ftp_server']='Server';
$lang['ftp_port']='Port';
$lang['ftp_user']='User';
$lang['ftp_pass']='Passwort';
$lang['ftp_dir']='Upload-Ordner';
$lang['ftp_ssl']='Sichere SSL-FTP-Verbindung';
$lang['ftp_useSSL']='benutze SSL-Verbindung';

$lang['sqlboxheight']='H&ouml;he der SQL-Box';
$lang['sqllimit']='Anzahl der Datens&auml;tze pro Seite';
$lang['bbparams']='Einstellung f&uuml;r BB-Code';
$lang['bbtextcolor']='Textfarbe';

$lang['config_expert']='Experten-Einstellungen';
$lang['exp_chmod']='CHMod f&uuml;r das Arbeitsverzeichnis';

$lang["help_commands"]='Man kann vor und nach dem Backup einen Befehl ausf&uuml;hren lassen.'."\n".'Dies kann eine SQL-Anweisung sein oder ein Systembefehl (z.B.ein Script)';
$lang['withalldbs']='bei jeder Datenbank';
$lang['cbd']='Befehl vor dem Backup';
$lang['cad']='Befehl nach dem Backup';
$lang['exec']='ausf&uuml;hren';
$lang['commkind']='Art des Befehls';
$lang['command']='Befehl';


// Sprachen
$lang['lang_de']='Deutsch';
$lang['lang_en']='Englisch';

// Text aus menu.php
$lang['load_database']='Datenbanken neu laden';
$lang['home']='Home';
$lang['config']='Konfiguration';
$lang['file_manage']='Verwaltung';
$lang['log']='Log';
$lang['project']='&Uuml;ber das Projekt';
$lang['choose_db']='Datenbank w&auml;hlen';
$lang['credits']='Credits / Hilfe';
$lang['onlinehelp']='Online-Hilfe';


//Log
$lang['log_delete']='Log l&ouml;schen';


// Texte aus main.php
$lang['info_location']='Du befindest Dich auf ';
$lang['info_browser']='Dein Browser ist';
$lang['info_admin']='Der Serveradministrator ist ';
$lang['info_databases']='Folgende Datenbank(en) befinden sich auf dem MySql-Server:';
$lang['info_nodb']='Datenbank existiert nicht';
$lang['info_table1']='Tabelle';
$lang['info_table2']='n';
$lang['info_dbdetail']='Detail-Info von Datenbank ';
$lang['info_dbempty']='Die Datenbank ist leer !';
$lang['info_records']='Datens&auml;tze';
$lang['info_size']='Gr&ouml;sse';
$lang['info_lastupdate']='letztes Update';
$lang['info_sum']='insgesamt';
$lang['info_rechte']='Deine Rechte';
$lang['info_cronyes']='Du kannst MySQL Dumper als Cronjob durchf&uuml;hren.';
$lang['info_cronno']='Aufgrund deiner PHP-Einstellungen (safe_mode=on) kannst du MySQL Dumper nicht als Cronjob durchf&uuml;hren!';
$lang['info_optimized']='optimiert';
$lang['optimize_databases']='Tabellen optimieren';
$lang['check_tables']='Tabellen &uuml;berpr&uuml;fen';

$lang['clear_database']='Datenbank leeren';
$lang['delete_database']='Datenbank l&ouml;schen';
$lang['create_database']='neue Datenbank anlegen:';
$lang['button_create_database']='anlegen';

$lang['info_created']='angelegt';
$lang['info_cleared']='wurde geleert';
$lang['info_deleted']='wurde gel&ouml;scht';

$lang['info_scriptdir']='Verzeichnis von MySQLDumper';
$lang['info_workdir']='Arbeitsverzeichnis';
$lang['info_backupdir']='Backupverzeichnis';
$lang['info_cgidir']='CGI-Bin-Verzeichnis';
$lang['info_cginr']='nicht vorhanden oder kein Zugriffsrecht';
$lang['info_actdb']='Aktuelle Datenbank';

$lang['info_emptydb1']='Soll die Datenbank';
$lang['info_emptydb2']=' wirklich geleert werden? (ACHTUNG: Alle Daten gehen unwideruflich verloren)';
$lang['info_killdb']=' wirklich gel&ouml;scht werden? (ACHTUNG: Alle Daten gehen unwideruflich verloren)';

$lang['dbnoempty']='Datenbankname darf nicht leer sein !';
$lang['processkill1']='Es wird versucht, Prozess ';
$lang['processkill2']=' zu beenden.';
$lang['processkill3']='Es wird seit ';
$lang['processkill4']=' sec. versucht, Prozess ';

$lang['htaccess1']='Verzeichnisschutz erstellen';
$lang['htaccess2']='Passwort:';
$lang['htaccess3']='Passwort (Wiederholung):';
$lang['htaccess4']='Verschl&uuml;sselungsart:';
$lang['htaccess5']='Linux und Unix-Systeme (Crypt)';
$lang['htaccess6']='Windows (MD5)';
$lang['htaccess7']='unverschl&uuml;sselt';
$lang['htaccess8']='Es besteht bereits ein Verzeichnisschutz. Wenn Du einen neuen erstellst, wird der alte &uuml;berschrieben !';
$lang['htaccess9']='Du musst einen Namen eingeben!<br>';
$lang['htaccess10']='Die Passw&ouml;rter sind nicht identisch oder leer!<br>';
$lang['htaccess11']='Soll der Verzeichnisschutz jetzt erstellt werden?';
$lang['htaccess12']='Der Verzeichnisschutz wurde erstellt.';
$lang['htaccess13']='Inhalt der Datei';
$lang['htaccess14']='Es ist ein Fehler bei der Erstellung des Verzeichnisschutzes aufgetreten!<br>Bitte erzeuge die Dateien manuell mit folgendem Inhalt:';
$lang['htaccess15']='Dringend empfohlen !';
$lang['htaccess16']='.htaccess editieren';
$lang['htaccess17']='.htaccess erstellen und editieren';
$lang['htaccess18']='.htaccess erstellen in ';
$lang['htaccess19']=' neu laden ';

$lang['htaccess20']='Skript ausf&uuml;hren';
$lang['htaccess21']='Handler zuf&uuml;gen';
$lang['htaccess22']='Ausf&uuml;hrbar machen';
$lang['htaccess23']='Verzeichnis-Listing';
$lang['htaccess24']='Error-Dokument';
$lang['htaccess25']='Rewrite aktivieren';
$lang['htaccess26']='Deny / Allow';
$lang['htaccess27']='Redirect';
$lang['htaccess28']='Error-Log';
$lang['htaccess29']='weitere Beispiele und Dokumentation';

$lang['htaccess30']='Provider';
$lang['htaccess31']='allgemein';
$lang['htaccess32']='Achtung! Die .htaccess hat eine direkte Auswirkung auf den Browser.<br>Bei falscher Anwendung sind die Seiten nicht mehr erreichbar.';
$lang['phpbug']='Bug in zlib ! Keine Kompression m&ouml;glich';


//Mini-SQL
$lang['sql_warning']='Die Ausf&uuml;hrung von SQL-Befehlen kann Daten manipulieren. Der Autor &uuml;bernimmt keine Haftung bei Datenverlusten.';
$lang['sql_back']='zur&uuml;ck zur Datenbank-&Uuml;bersicht';
$lang['database_overview']='Datenbank-&Uuml;bersicht';
$lang['sql_exec']='SQL-Befehl ausf&uuml;hren';
$lang['sql_dataview']='Daten-Ansicht';
$lang['sql_tableview']='Tabellen-Ansicht';
$lang['sql_vonins']='von insgesamt';
$lang['sql_nodata']='keine Datens&auml;tze';

$lang['sql_recordupdated']='Datensatz wurde ge&auml;ndert';
$lang['sql_recordinserted']='Datensatz wurde gespeichert';
$lang['sql_backdboverview']='zur&uuml;ck zur Datenbank&uuml;bersicht';
$lang['sql_recorddeleted']='Datensatz wurde gel&ouml;scht';
$lang['sql_tabledeleted1']='Tabelle `';
$lang['sql_tabledeleted2']='` wurde gel&ouml;scht';
$lang['sql_recordedit']='edititere Datensatz';
$lang['sql_recordnew']='Datensatz einf&uuml;gen';
$lang['sql_askdelete']='Soll der Datensatz gel&ouml;scht werden?';
$lang['sql_askdeletetable1']='Soll die Tabelle `';
$lang['sql_askdeletetable2']='` gel&ouml;scht werden?';
$lang['sql_befehle']='SQL-Befehle';
$lang['sql_befehlneu']='neuer Befehl';
$lang['sql_befehlsaved1']='SQL-Befehl';
$lang['sql_befehlsaved2']='wurde hinzugef&uuml;gt';
$lang['sql_befehlsaved3']='wurde gespeichert';
$lang['sql_befehlsaved4']='wurde nach oben gebracht';
$lang['sql_befehlsaved5']='wurde gel&ouml;scht';

$lang['sql_queryentry']='Die Abfrage enth&auml;lt';
$lang['sql_columns']='Spalten';

$lang['fm_askdbdelete1']='M&ouml;chtest Du die Datenbank ';
$lang['fm_askdbdelete2']=' samt Inhalt wirklich l&ouml;schen?';
$lang['fm_askdbempty1']='M&ouml;chtest Du die Datenbank ';
$lang['fm_askdbempty2']=' wirklich leeren?';
$lang['fm_askdbcopy1']='M&ouml;chtest Du den Inhalt der Datenbank ';
$lang['fm_askdbcopy2']=' in die Datenbank ';
$lang['fm_askdbcopy3']=' kopieren?';

$lang['sql_tablenew']='Tabellen bearbeiten';
$lang['sql_output']='SQL-Ausgabe';
$lang['do_now']='jetzt ausf&uuml;hren';
$lang['sql_namedest_missing']='Name f&uuml;r die Zieldatenbank fehlt!';
$lang['sql_askdeletefield']='Soll das Feld gel&ouml;scht werden?';
$lang['sql_commands_in']=' Zeilen in ';
$lang['sql_commands_in2']='  sek. abgearbeitet.';
$lang['sql_out1']='Es wurden ';
$lang['sql_out2']='Befehle ausgef&uuml;hrt';
$lang['sql_out3']='Es gab ';
$lang['sql_out4']='Kommentare';
$lang['sql_out5']='Da die Ausgabe &uuml;ber 5000 Zeilen enth&auml;lt, wird sie nicht angezeigt.';
$lang['sql_error1']='Fehler bei der Anfrage:';
$lang['sql_error2']='MySQL meldet:';
$lang['sql_selecdb']='Datenbank ausw&auml;hlen';
$lang['sql_tablesofdb']='Tabellen der Datenbank';
$lang['sql_edit']='bearbeiten';
$lang['sql_nofielddelete']='L&ouml;schen nicht m&ouml;glich, da eine Tabelle mindestens 1 Feld haben muss.';
$lang['sql_fielddelete1']='Das Feld';
$lang['sql_deleted']='wurde gel&ouml;scht';
$lang['sql_changed']='wurde ge&auml;ndert.';
$lang['sql_created']='wurde angelegt.';
$lang['sql_nodest_copy']='Ohne Ziel kann nicht kopiert werden !';
$lang['sql_desttable_exists']='Zieltabelle existiert schon !';
$lang['sql_scopy1']='Tabellenstruktur von';
$lang['sql_scopy2']='wurde in Tabelle';
$lang['sql_scopy3']='kopiert';
$lang['sql_copied']='kopiert';
$lang['sql_copy1']='wurde mit Daten in Tabelle';
$lang['sql_tablenoname']='Tabelle braucht einen Namen !';
$lang['sql_tblnameempty']='Tabellenname darf nicht leer sein !';
$lang['sql_collatenotmatch']='Zeichensatz und Sortierung passen nicht zueinander !';
$lang['sql_fieldnamenotvalid']='Fehler: Kein g&uuml;ltiger Feldname';
$lang['sql_createtable']='Tabelle anlegen';
$lang['sql_copytable']='Tabelle kopieren';
$lang['sql_structureonly']='nur Struktur';
$lang['sql_structuredata']='Struktur und Daten';
$lang['sql_notablesindb']='Es befinden sich keine Tabellen in der Datenbank';
$lang['sql_selecttable']='Tabelle ausw&auml;hlen';
$lang['sql_showdatatable']='Daten der Tabelle anzeigen';
$lang['sql_tblpropsof']='Tabelleneigenschaften  von';
$lang['sql_editfield']='Editiere Feld';
$lang['sql_newfield']='Neues Feld';
$lang['sql_indexes']='Indizes';
$lang['sql_atposition']='an Position einf&uuml;gen';
$lang['sql_first']='zuerst';
$lang['sql_after']='nach';
$lang['sql_changefield']='Feld &auml;ndern';
$lang['sql_insertfield']='Feld einf&uuml;gen';
$lang['sql_insertnewfield']='neues Feld einf&uuml;gen';
$lang['sql_tableindexes']='Indizes der Tabelle';
$lang['sql_allowdups']='Duplikate erlaubt';
$lang['sql_cardinality']='Kardinalit&auml;t';
$lang['sql_tablenoindexes']='Die Tabelle enth&auml;lt keine Indizes';
$lang['sql_createindex']='neuen Index erzeugen';
$lang['sql_wasemptied']='wurde geleert';
$lang['sql_renamedto']='wurde umbenannt in';
$lang['sql_dbcopy1']='Der Inhalt der Datenbank';
$lang['sql_dbcopy2']='wurde in die Datenbank';
$lang['sql_dbscopy1']='Die Struktur der Datenbank';
$lang['sql_wascreated']='wurde erzeugt';
$lang['sql_renamedb']='Umbenennen der Datenbank';
$lang['sql_actions']='Aktionen';
$lang['sql_chooseaction']='Aktion w&auml;hlen';
$lang['sql_deletedb']='Datenbank l&ouml;schen';
$lang['sql_emptydb']='Datenbank leeren';
$lang['sql_renamedb']='Datenbank umbenennen';
$lang['sql_copydatadb']='Inhalt in Datenbank kopieren';
$lang['sql_copysdb']='Struktur in Datenbank kopieren';


 
//Installation
$lang['install_forcescript']='MySQLDumper ohne Installation starten';
$lang['install_tomenu']='zum Hauptmen&uuml;';
$lang['installmenu']='Hauptmen&uuml;';
$lang['step']='Schritt';
$lang['install']='Installation';
$lang['uninstall']='Deinstallation';
$lang['tools']='Tools';
$lang['editconf']='Konfiguration bearbeiten';
$lang['osweiter']='ohne Speichern weiter';
$lang['errorman']='Fehler beim Schreiben der Konfiguration!</strong><br>Bitte editieren sie das File ';

$lang['manuell']='manuell';
$lang['createdirs']='erstelle Verzeichnisse';
$lang['check0']=' ...ok Rechte: ';
$lang['check1']='pr&uuml;fe Arbeitsverzeichnis ...  ';
$lang['check2']='pr&uuml;fe Backupverzeichnis ...  ';
$lang['check3']='pr&uuml;fe Strukturverzeichnis ...  ';
$lang['check4']='pr&uuml;fe Logverzeichnis ...  ';
$lang['check5']='pr&uuml;fe Konfigurationsverzeichnis ...  ';
$lang['check6']='Ich habe die Verzeichnisse manuell erstellt, ';
$lang['check7']='Die Verzeichnisse wurden erstellt. speicher die Konfiguration ...';
$lang['bitteweiter']='bitte weiter';
$lang['install_continue']='mit der Installation fortfahren';
$lang['installfinished']='<br>die Installation ist abgeschlossen   --> <a href="index.php">starte MySQLDumper</a><br>';

$lang['connecttomysql']=' zu MySQL verbinden ';

$lang['dbparameter']='Datenbank-Parameter';
$lang['confignotwritable']='Das File "config.php" ist nicht schreibbar. Bitte die entsprechenden Rechte &auml;ndern !';
$lang['testconnection']='Verbindung testen';
$lang['dbconnection']='Datenbank-Verbindung';
$lang['connectionerror']='Fehler: konnte keine Verbindung erstellen.';
$lang['connection_ok']='Datenbank-Verbindung wurde hergestellt.';
$lang['saveandcontinue']='speichern und Installation fortsetzen';
$lang['confbasic']='Grundeinstellungen';
$lang['install_step2finished']='Datenbankeinstellungen wurden gesichert.<br><br>Sie k&ouml;nnen mit der Standardkonfiguration die Installation fortsetzen oder die Konfiguration bearbeiten.';
$lang['install_step2_1']='Installation mit Standardkonfiguration fortsetzen';
$lang['laststep']='Abschluss der Installation';

$lang['ftpmode']='Verzeichnisse per FTP erzeugen (safe_mode)';
$lang['safemodedesc']='Da PHP mit der Option "safe_mode=1" l&auml;uft, darf PHP keine Verzeichnisse anlegen.<br>Aus diesem Grund bleibt nur das Erzeugen der Verzeichnisse per FTP. Entweder Du erstellst die erforderlichen Verzeichnisse manuell und setzt die Rechte der Verzeichnisse (wichtig!), oder Du l&auml;sst das Script dies machen. Dazu musst Du die Verbindungs-Parameter angeben :';
$lang['idomanual']='ich erstelle die Verzeichnisse manuell';
$lang['dofrom']='ausgehend von';
$lang['ftpmode2']='erstelle die Verzeichnisse per FTP';
$lang['connect']='verbinden';
$lang['dirs_created']='Die Verzeichnisse wurden ordnungsgem&auml;ss erstellt.';
$lang['connect_to']='verbinde zu';
$lang['changedir']='wechsel ins Verzeichnis';
$lang['changedirerror']='Wechsel ins Verzeichnis nicht m&ouml;glich';
$lang['ftp_ok']='FTP-Parameter sind ok';
$lang['createdirs2']='Verzeichnisse erstellen';
$lang['ftp_notconnected']='Ftp-Verbindung nicht hergestellt!';
$lang['connwith']='Verbindung mit';
$lang['asuser']='als Benutzer';
$lang['notpossible']='nicht m&ouml;glich';
$lang['dircr1']='erstelle Arbeitsverzeichnis';
$lang['dircr2']='erstelle Backupverzeichnis';
$lang['dircr3']='erstelle Strukturverzeichnis';
$lang['dircr4']='erstelle Logverzeichnis';
$lang['dircr5']='erstelle Konfigurationsverzeichnis';
$lang['indir']='bin im Verzeichnis';
$lang['test']='teste';
$lang['check']='&uuml;berpr&uuml;fen';
$lang['disabledfunctions']="Abgeschaltete Funktionen";
$lang['noftppossible']="Es stehen keine FTP-Funktionen zur Verf&uuml;gung!";
$lang['nogzpossible']="Es stehen keine Kompressions-Funktionen zur Verf&uuml;gung!";

$lang['ui1']='Es werden alle Arbeitsverzeichnisse incl. den darin enthaltenen Backups gel&ouml;scht.';
$lang['ui2']='Sind Sie sicher, das Sie das m&ouml;chten ?';
$lang['ui3']='nein, sofort abbrechen';
$lang['ui4']='ja, bitte fortfahren';
$lang['ui5']='l&ouml;sche Arbeitsverzeichnis';
$lang['ui6']='alles wurde erfolgreich gel&ouml;scht.';
$lang['ui7']='Bitte l&ouml;schen sie das Skriptverzeichnis';
$lang['ui8']='eine Ebene nach oben';
$lang['ui9']='Ein Fehler trat auf, l&ouml;schen war nicht m&ouml;glich</p>Fehler bei Verzeichnis ';

$lang['import']='Konfiguration importieren';
$lang['import1']='Einstellungen aus "config.gz" importieren';
$lang['import2']='Einstellungen hochladen und importieren';
$lang['import3']='Die Konfiguration wurde geladen ...';
$lang['import4']='Die Konfiguration wurde gesichert.';
$lang['import5']='MySQLDumper starten';
$lang['import6']='Installations-Men&uuml;';
$lang['import7']='Konfiguration uploaden';
$lang['import8']='zur&uuml;ck zum Upload';
$lang['import9']='Dies ist keine Konfigurationssicherung !';
$lang['import10']='Die Konfiguration wurde erfolgreich hochgeladen ...';
$lang['import11']='<strong>Fehler: </strong>Es gab Probleme beim Schreiben der sql_statements';
$lang['import12']='<strong>Fehler: </strong>Es gab Probleme beim Schreiben der config.php';
$lang['expert']='erweitert';
$lang['dbonlyneed']='... keine Database gefunden : <br>klick auf "erweitert" und gib den Namen der Datenbank an (nur mit folgender Datenbank verbinden ...)!';
$lang['install_help_port']='(leer = Standardport)';
$lang['install_help_socket']='(leer = Standardsocket)';
$lang['tryagain']='nochmal versuchen';

?>