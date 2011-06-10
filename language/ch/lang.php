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
    'L_ACTIVATED' => "aktiviärt",
    'L_ACTUALLY_INSERTED_RECORDS' => "Es sind bis ez <b>%s</b> Datesätz"
    ." erfolgriich iitreit worde.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Es sind bis ez <b>%s</b> vo <b>%s</b>"
    ." Datesätz erfolgriich iitreit worde.",
    'L_ADD' => "Add",
    'L_ADDED' => "dezue gfüegt",
    'L_ADD_DB_MANUALLY' => "Datebank vo Hand dezue tue",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "alli",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "Momentan werdet Date vo de Tabälle"
    ." '<b>%s</b>' analysiert.",
    'L_ASKDBCOPY' => "Söll de Inhalt vo de Datenbank `%s` i"
    ." diä Datebank `%s` kopiert wärde?",
    'L_ASKDBDELETE' => "Söll diä Datebank `%s` samt em"
    ." Inhalt würkli glöscht wärde?",
    'L_ASKDBEMPTY' => "Söll diä Datebank `%s` würkli"
    ." gläärt wärde?",
    'L_ASKDELETEFIELD' => "Söll das Feld glöscht wärde?",
    'L_ASKDELETERECORD' => "Söll dä Datesatz glöscht wärde?",
    'L_ASKDELETETABLE' => "Söll diä Tabelle `%s` glöscht"
    ." wärde?",
    'L_ASKTABLEEMPTY' => "Söll diä Tabälle `%s` geläärt"
    ." wärde?",
    'L_ASKTABLEEMPTYKEYS' => "Sölled diä Tabälle `%s` geläärt"
    ." und diä Indizes zrugggsetzt wärde?",
    'L_ATTACHED_AS_FILE' => "attached as file",
    'L_ATTACH_BACKUP' => "Backup aahänke",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "automatisch lösche vo de Backups",
    'L_BACK' => "zrugg",
    'L_BACKUPFILESANZAHL' => "Im Backupverzeichnis häts",
    'L_BACKUPS' => "Backups",
    'L_BACKUP_DBS' => "DBs zum Sichere",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "zrugg zur Übersicht",
    'L_BACK_TO_OVERVIEW' => "Datebank-Übersicht",
    'L_CALL' => "Call",
    'L_CANCEL' => "Cancel",
    'L_CANT_CREATE_DIR' => "Ha s Verzeichnis '%s' nöd chöne"
    ." mache. Mached Si s bitte mit Irem"
    ." FTP-Programm",
    'L_CHANGE' => "ändere",
    'L_CHANGEDIR' => "Wächsel is Verzeichnis",
    'L_CHANGEDIR' => "Wächsle zum Verzeichnis",
    'L_CHANGEDIRERROR' => "Wächsel is Verzeichnis nöd mögli",
    'L_CHANGEDIRERROR' => "Es hät nid chöne is Verzeichnis"
    ." gwächslet werde!",
    'L_CHARSET' => "Zeichesatz",
    'L_CHECK' => "Überprüefe",
    'L_CHECK' => "check",
    'L_CHECK_DIRS' => "überprüefe",
    'L_CHOOSE_CHARSET' => "Leider hät nöd chöne automatich"
    ." ermittlet mit welem Zeichesatz diä"
    ." Backupdatei sinerziit aagleit worde"
    ." isch.<br /> Sie müend diä Kodierig,"
    ." i dere Zeichechette i dere Datei sind,"
    ." vo Hand aagäh.<br />Dänn stellt"
    ." MySQLDumper diä Verbindigskännig zum"
    ." MySQL-Server uf de usgwählti"
    ." Zeichesatz und fangt mit de"
    ." Reschtaurierig vo de Date"
    ." a.>br>Sötted Si nach de"
    ." Reschtaurierig Problem mit"
    ." Sonderzeiche ha, chönd Si probiere,"
    ." das Backup mit ere andere"
    ." Zeichesatzuswahl z reschtauriere.<br"
    ." /> Vill Glück. ;)",
    'L_CHOOSE_DB' => "Datebank uswähle",
    'L_CLEAR_DATABASE' => "Datebank lääre",
    'L_CLOSE' => "Close",
    'L_COLLATION' => "Sortierig",
    'L_COMMAND' => "Befähl",
    'L_COMMAND' => "Befähl",
    'L_COMMAND_AFTER_BACKUP' => "Command after backup",
    'L_COMMAND_BEFORE_BACKUP' => "Command before backup",
    'L_COMMENT' => "Kommentar",
    'L_COMPRESSED' => "komprimiert (gz)",
    'L_CONFBASIC' => "Grundiischtellige",
    'L_CONFIG' => "Konfiguration",
    'L_CONFIGFILE' => "Konfigurationsdatei",
    'L_CONFIGFILES' => "Konfigurationsdateie",
    'L_CONFIGURATIONS' => "Ischtellige",
    'L_CONFIG_AUTODELETE' => "automatisches Lösche",
    'L_CONFIG_CRONPERL' => "Crondump-Iischtellige fürs Perlscript",
    'L_CONFIG_EMAIL' => "E-Mail-Benachrichtigung",
    'L_CONFIG_FTP' => "FTP-Transfer vo de Backup-Datei",
    'L_CONFIG_HEADLINE' => "Konfiguration",
    'L_CONFIG_INTERFACE' => "Interface",
    'L_CONFIG_LOADED' => "D Konfiguration \"%s\" isch"
    ." erfolgriich glade worde.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Söll d Konfigurationsdatei %s würkli"
    ." glöscht werde?",
    'L_CONFIRM_DELETE_TABLES' => "Really delete the selected tables?",
    'L_CONFIRM_DROP_DATABASES' => "Should the selected databases really"
    ." be deleted?

Attention: all data will"
    ." be deleted! Maybe you should create a"
    ." backup first.",
    'L_CONFIRM_RECIPIENT_DELETE' => "Should the recipient \"%s\" really be"
    ." deleted?",
    'L_CONFIRM_TRUNCATE_DATABASES' => "Should all tables of the selected"
    ." databases really be"
    ." deleted?

Attention: all data will be"
    ." deleted! Maybe you want to create a"
    ." backup first.",
    'L_CONFIRM_TRUNCATE_TABLES' => "Really empty the selected tables?",
    'L_CONNECT' => "verbinde",
    'L_CONNECTIONPARS' => "Verbindigsparameter",
    'L_CONNECTTOMYSQL' => "zu MySQL verbinde",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Backup-Konverter",
    'L_CONVERTING' => "Konvertierig",
    'L_CONVERT_FILE' => "z konvertierendi Datei",
    'L_CONVERT_FILENAME' => "Name vo de Zieldatei (ohni Endig)",
    'L_CONVERT_FILEREAD' => "Datei '%s' wird eingläse",
    'L_CONVERT_FINISHED' => "Konvertierig abgschlosse, '%s' isch"
    ." erzügt worde.",
    'L_CONVERT_START' => "Konvertierig starte",
    'L_CONVERT_TITLE' => "Konvertiere Dump is MSD-Format",
    'L_CONVERT_WRONG_PARAMETERS' => "Falschi Parameter! Konvertierig isch"
    ." nöd mögli.",
    'L_CREATE' => "aalegge",
    'L_CREATEAUTOINDEX' => "Auto-Index mache",
    'L_CREATEDIRS' => "mache Verzeichnis",
    'L_CREATE_CONFIGFILE' => "E neui Konfigurationsdatei aalegge",
    'L_CREATE_DATABASE' => "Neui Datebank aalegge",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Kredits und Hilf",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Kommentar iigää",
    'L_CRON_COMPLETELOG' => "Kompletti Usgab logge",
    'L_CRON_EXECPATH' => "Pfad vo de Perlskripts",
    'L_CRON_EXTENDER' => "Dateiändig vom Skript",
    'L_CRON_PRINTOUT' => "Textuusgab",
    'L_CSVOPTIONS' => "CSV-Optione",
    'L_CSV_EOL' => "Ziile trännt mit",
    'L_CSV_ERRORCREATETABLE' => "Fähler bim Mache vo de Tabälle `%s`!",
    'L_CSV_FIELDCOUNT_NOMATCH' => "D Aazahl vo de Tabällefelder"
    ." schtimmed nöd mit de date vo de z"
    ." importierende Date überii (%d statt"
    ." %d).",
    'L_CSV_FIELDSENCLOSED' => "Fälder igschlosse vo",
    'L_CSV_FIELDSEPERATE' => "Fälder trännt mit",
    'L_CSV_FIELDSESCAPE' => "Fälder \"escaped\" vo",
    'L_CSV_FIELDSLINES' => "%d Fälder ermittlet, total %d Ziile",
    'L_CSV_FILEOPEN' => "CSV-Datei ufmache",
    'L_CSV_NAMEFIRSTLINE' => "Fäldname i di erschti Ziile",
    'L_CSV_NODATA' => "Kei Date zum Importiere gfunde!",
    'L_CSV_NULL' => "Ersetz NULL dur",
    'L_DATASIZE' => "Size of data",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "Datebank",
    'L_DBCONNECTION' => "Datebank-Verbindig",
    'L_DBPARAMETER' => "Datebank-Parameter",
    'L_DBS' => "Datebanke",
    'L_DB_BACKUPPARS' => "Datenbanke Backup-Iischtellige",
    'L_DB_HOST' => "Datebank- Hoschtname",
    'L_DB_IN_LIST' => "D Datenbank '%s' hät nöd chöne"
    ." gmacht werde, wils die scho git.",
    'L_DB_PASS' => "Datebank- Passwort",
    'L_DB_SELECT_ERROR' => "<br />Fähler:<br />Uuswahl vo de"
    ." Datebank '<b>",
    'L_DB_SELECT_ERROR2' => "</b>' abverheit!",
    'L_DB_USER' => "Datebank- Nutzer",
    'L_DEFAULT_CHARSET' => "Standardzeichesatz",
    'L_DELETE' => "Lösche",
    'L_DELETE_DATABASE' => "Datebank lösche",
    'L_DELETE_FILE_ERROR' => "Error deleting file \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "File \"%s\" was deleted successfully.",
    'L_DELETE_HTACCESS' => "Verzeichnisschutz wägmache (.htaccess"
    ." lösche)",
    'L_DESELECTALL' => "Uswahl ufhebä",
    'L_DIR' => "Verzeichnis",
    'L_DISABLEDFUNCTIONS' => "Abgschalteti Funktionen",
    'L_DISABLEDFUNCTIONS' => "Abgschalteti Funktione",
    'L_DO' => "machs!",
    'L_DOCRONBUTTON' => "Perl-Cronscript usfüere",
    'L_DONE' => "Alls gmacht!",
    'L_DONT_ATTACH_BACKUP' => "Don't attach backup",
    'L_DOPERLTEST' => "Perl-Module teschte",
    'L_DOSIMPLETEST' => "Perl teschte",
    'L_DOWNLOAD_FILE' => "Download file",
    'L_DO_NOW' => "jetzt usfüere",
    'L_DUMP' => "Backup mache",
    'L_DUMP_ENDERGEBNIS' => "Es sind <b>%s</b> Tabälle mit zäme"
    ." <b>%s</b> Datesätz gsicheret"
    ." worde.<br />",
    'L_DUMP_FILENAME' => "Backup-Datei",
    'L_DUMP_HEADLINE' => "bi am backup mache..",
    'L_DUMP_NOTABLES' => "Es händ kei Tabällen i de Datenbank"
    ." `%s` chöne gfunde werde.",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Duration",
    'L_EDIT' => "editiere",
    'L_EHRESTORE_CONTINUE' => "wiitermache und Fähler protokoliere",
    'L_EHRESTORE_STOP' => "aahalte",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "Im Aahang finded Si d Sicherig vo"
    ." Ihrer MySQL-Datenbank.<br />Sicherig"
    ." vo de Datenbank `%s` <br /><br"
    ." />Folgende Datei wurde erzeugt:<br"
    ." /><br />%s <br /><br />Fründlichi"
    ." Grüess<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "<br /><br /><br />Fründlichi"
    ." Grüess<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "Es isch e Multipart-Sicherig erstellt"
    ." worde.<br />D Sicherige werdet i"
    ." separate E-Mails als Anhang"
    ." glieferet!<br />Sicherig vo de"
    ." Datenbank `%s` <br /><br />Folgendi"
    ." Dateie sind erzügt worde:<br /><br"
    ." />%s<br /><br /><br />Fründlichi"
    ." Grüess<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "Es isch e Multipart-Sicherig erstellt"
    ." worde.<br />Die Sicherige werdet nöd"
    ." als Aahang mitglieferet!<br />Sicherig"
    ." vo de Datenbank `%s` <br /><br"
    ." />Folgendi Dateie sind erzügt"
    ." worde:<br /><br />%s<br /><br /><br"
    ." />Fründlichi Grüess<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "S Backup isch nöd aaghänkt worde.<br"
    ." />Sicherig vo de Datenbank `%s` <br"
    ." /><br />Folgendi Datei isch erzügt"
    ." worde:<br /><br />%s <br /><br"
    ." />Fründlichi Grüess<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "D Sicherig überschriitet d"
    ." Maximalgrössi von %s und isch drum"
    ." nöd aagehänkt worde.<br />Sicherig"
    ." vo de Datenbank `%s` <br /><br"
    ." />Folgendi Datei isch erzügt"
    ." worde:<br /><br />%s <br /><br"
    ." />Fründlichi Grüess<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Empfänger",
    'L_EMAIL_MAXSIZE' => "maximali Grössi vom Aahang",
    'L_EMAIL_ONLY_ATTACHMENT' => "... nume dr Aahang",
    'L_EMAIL_RECIPIENT' => "Empfänger",
    'L_EMAIL_SENDER' => "Absänder vo dr E-Mail",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "D E-Mail isch erfolriich verschickt"
    ." worde an",
    'L_EMPTY' => "Lääre",
    'L_EMPTYKEYS' => "lääre und Indizes zruggsetze",
    'L_EMPTYTABLEBEFORE' => "Tabälle vorhär lääre",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Datebank vor Reschtaurierig lösche",
    'L_ENCODING' => "Kodierig",
    'L_ENCRYPTION_TYPE' => "Verschlüsseligsart",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Itrag",
    'L_ERROR' => "Fähler",
    'L_ERRORHANDLING_RESTORE' => "Fählerbehandlig bi de Reschtaurierig",
    'L_ERROR_CONFIGFILE_NAME' => "Im Dateiname \"%s\" häts ungültigi"
    ." Zeiche.",
    'L_ERROR_DELETING_CONFIGFILE' => "Fähler: d Konfigurationsdatei %s hät"
    ." nöd chöne glöscht wärde!",
    'L_ERROR_LOADING_CONFIGFILE' => "D Konfigurationsdatei \"%s\" hät nöd"
    ." chöne glade wärde.",
    'L_ERROR_LOG' => "Error-Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel ab 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Export",
    'L_EXPORTFINISHED' => "Export fertig gmacht",
    'L_EXPORTLINES' => "<strong>%s</strong> Ziile exportiert",
    'L_EXPORTOPTIONS' => "Export-Optione",
    'L_EXTENDEDPARS' => "erwiitereti Parameter",
    'L_FADE_IN_OUT' => "ii-/usblände",
    'L_FATAL_ERROR_DUMP' => "Fatale Fähler: d CREATE-Aawiisig vo"
    ." de Tabelle '%s' i de Datenbank '%s'"
    ." hät nöd chöne gläse werde!",
    'L_FIELDS' => "Fälder",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "Datei",
    'L_FILES' => "Files",
    'L_FILESIZE' => "Dateigrössi",
    'L_FILE_MANAGE' => "Verwaltig",
    'L_FILE_OPEN_ERROR' => "Fähler: Diä Datei hät nöd chöne"
    ." ufgmacht wärde",
    'L_FILE_SAVED_SUCCESSFULLY' => "The file has been saved successfully.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "The file couldn't be saved!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Söll diä Datenbank",
    'L_FM_ALERTRESTORE2' => "mit de Inhält vo dere Datei",
    'L_FM_ALERTRESTORE3' => "reschtauriert wärde?",
    'L_FM_ALL_BU' => "alli Backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Wänd Si diä Datei",
    'L_FM_ASKDELETE2' => "würkli lösche?",
    'L_FM_ASKDELETE3' => "Wänd Sie Autodelete nach de"
    ." iigschtellte Regle jetzt usfüere?",
    'L_FM_ASKDELETE4' => "Wänd Si alli Backup-Dateie jetzt"
    ." lösche?",
    'L_FM_ASKDELETE5' => "Wänd Si alli Backup-Dateie mit",
    'L_FM_ASKDELETE5_2' => "* jetzt lösche?",
    'L_FM_AUTODEL1' => "Autodelete: Folgendi Dateie sind"
    ." ufgrund vo de maximale Dateiaazahl"
    ." gelöscht worde:",
    'L_FM_CHOOSE_ENCODING' => "Kodierig vo de Backupdatei wähle",
    'L_FM_COMMENT' => "Kommentar iigäh",
    'L_FM_DBNAME' => "Datebankname",
    'L_FM_DELETE' => "usgwählti Dateie lösche",
    'L_FM_DELETE1' => "Diä Datei",
    'L_FM_DELETE2' => "isch erfolgriich glöscht worde.",
    'L_FM_DELETE3' => "hät nöd chöne glöscht wärde!",
    'L_FM_DELETEALL' => "alli Backup-Dateie lösche",
    'L_FM_DELETEALLFILTER' => "alli lösche mit",
    'L_FM_DELETEAUTO' => "Autodelete vo Hand ausfüere",
    'L_FM_DUMPSETTINGS' => "Iischtellige fürs Backup",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "Datum",
    'L_FM_FILES1' => "Datebank-Backups",
    'L_FM_FILESIZE' => "Dateigrössi",
    'L_FM_FILEUPLOAD' => "Datei ufelade",
    'L_FM_FILEUPLOAD' => "Datei ufelade",
    'L_FM_FREESPACE' => "Freie Speicher uf em Server",
    'L_FM_LAST_BU' => "sletschte Backup",
    'L_FM_NOFILE' => "Si händ gar kei Datei usgwählt!",
    'L_FM_NOFILESFOUND' => "Kei Datei gfunde.",
    'L_FM_RECORDS' => "Iiträg",
    'L_FM_RESTORE' => "Reschtauriere",
    'L_FM_RESTORE_HEADER' => "Reschtaurierig vo de Datebank"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Uswahl vo bestimmte Tabälle",
    'L_FM_STARTDUMP' => "Neus Backup starte",
    'L_FM_TABLES' => "Tabälle",
    'L_FM_TOTALSIZE' => "Gsamtgrössi",
    'L_FM_UPLOADFAILED' => "Dr Upload isch leider fählgschlage!",
    'L_FM_UPLOADFILEEXISTS' => "Es git scho e Datei mit däm Name!",
    'L_FM_UPLOADFILEREQUEST' => "Gänd Si bitte e Datei a.",
    'L_FM_UPLOADFILEREQUEST' => "Gänd Si bitte e Datei aa.",
    'L_FM_UPLOADMOVEERROR' => "Dia ufeglade Datei hät nöd chöne in"
    ." richtige Order verschobe wärde.",
    'L_FM_UPLOADNOTALLOWED1' => "Dä Dateityp isch nöd erlaubt.",
    'L_FM_UPLOADNOTALLOWED2' => "Gültigi Type sind: *.gz und"
    ." *.sql-Dateie",
    'L_FOUND_DB' => "gfundeni DB:",
    'L_FROMFILE' => "us de Datei",
    'L_FROMTEXTBOX' => "usem Textfäld",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Add connection",
    'L_FTP_CHOOSE_MODE' => "FTP-Überträgigsmodus",
    'L_FTP_CONFIRM_DELETE' => "Should this FTP-Connection really be"
    ." deleted?",
    'L_FTP_CONNECTION' => "FTP-Connection",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Connection closed",
    'L_FTP_CONNECTION_DELETE' => "Delete connection",
    'L_FTP_CONNECTION_ERROR' => "The connection to server '%s' using"
    ." port %s couldn't be established",
    'L_FTP_CONNECTION_SUCCESS' => "The connection to server '%s' using"
    ." port %s was established successfully",
    'L_FTP_DIR' => "Upload-Ordner",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "FTP-Parameter sind ok",
    'L_FTP_OK' => "d Verbindig isch erfolgriich gsi",
    'L_FTP_PASS' => "Passwort",
    'L_FTP_PASSIVE' => "passive Überträgigsmodus bruche",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "an <strong>%s</strong><br />in"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "sicheri SSL-FTP-Verbindig",
    'L_FTP_START' => "Starting FTP transfer",
    'L_FTP_TIMEOUT' => "Verbindigs-Timeout",
    'L_FTP_TRANSFER' => "FTP-Transfer",
    'L_FTP_USER' => "User",
    'L_FTP_USESSL' => "bruch SSL-Verbindig",
    'L_GENERAL' => "allgemein",
    'L_GENERAL' => "generell",
    'L_GZIP' => "GZip-Kompression",
    'L_GZIP_COMPRESSION' => "GZip-Kompression",
    'L_HOME' => "an Aafang",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Rewrite aktiviere",
    'L_HTACC_ADD_HANDLER' => "Handler zuefüege",
    'L_HTACC_CONFIRM_DELETE' => "Söll de Verzeichnisschutz jetzt"
    ." gmacht wärde?",
    'L_HTACC_CONTENT' => "Inhalt vo de Datei",
    'L_HTACC_CREATE' => "Verzeichnisschutz mache",
    'L_HTACC_CREATED' => "De Verzeichnisschutz isch gmacht.",
    'L_HTACC_CREATE_ERROR' => "Es isch en Fähler bim"
    ." Verzeichnisschutz mache passiert!<br"
    ." /> Mached Si bitte vo Hand e Datei mit"
    ." folgendem Inhalt",
    'L_HTACC_CRYPT' => "Crypt (Linux und Unix-System)",
    'L_HTACC_DENY_ALLOW' => "Deny / Allow",
    'L_HTACC_DIR_LISTING' => "Verzeichnis-Listing",
    'L_HTACC_EDIT' => ".htaccess editiere",
    'L_HTACC_ERROR_DOC' => "Error-Dokument",
    'L_HTACC_EXAMPLES' => "wiiteri Bischpiel und Dokumentation",
    'L_HTACC_EXISTS' => "Es hät scho en Verzeichnisschutz."
    ." Wänn Si en neue mached, wird de alti"
    ." überschribe!",
    'L_HTACC_MAKE_EXECUTABLE' => "Usfüerbar mache",
    'L_HTACC_MD5' => "MD5 (Linux und Unix-System)",
    'L_HTACC_NO_ENCRYPTION' => "unverschlüsslet (Windows)",
    'L_HTACC_NO_USERNAME' => "Si müend en Name iigäh!",
    'L_HTACC_PROPOSED' => "Dringend empfohle",
    'L_HTACC_REDIRECT' => "Redirect",
    'L_HTACC_SCRIPT_EXEC' => "Skript ausfüere",
    'L_HTACC_SHA1' => "SHA1 (all Systems)",
    'L_HTACC_WARNING' => "Achtung! Diä .htaccess hät e"
    ." diräkti Uswirkig uf de Browser.<br"
    ." />Bi falscher Anwendig sind diä Siite"
    ." nüme erreichbar.",
    'L_IMPORT' => "Konfiguration importiere",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "importiere",
    'L_IMPORTOPTIONS' => "Import-Optione",
    'L_IMPORTSOURCE' => "Import-Quälle",
    'L_IMPORTTABLE' => "Import i Tabälle",
    'L_IMPORT_NOTABLE' => "Es isch kei Tabälle für de Import"
    ." ausgwählt!",
    'L_IN' => "in",
    'L_INFO_ACTDB' => "Aktuelli Datebank",
    'L_INFO_DATABASES' => "Folgendi Datebank(e) sind ufem"
    ." MySql-Server",
    'L_INFO_DBEMPTY' => "Diä Datnbank isch läär!",
    'L_INFO_FSOCKOPEN_DISABLED' => "On this server the PHP command"
    ." fsockopen() is disabled by the"
    ." server's configuration. Because of"
    ." this the automatic download of"
    ." language packs is not possible. To"
    ." bypass this, you can download packages"
    ." manually, extract them locally and"
    ." upload them to the directory"
    ." \"language\" of your MySQLDumper"
    ." installation. Afterwards the new"
    ." language pack is available on this"
    ." site.",
    'L_INFO_LASTUPDATE' => "sletscht Update",
    'L_INFO_LOCATION' => "Si sind uf",
    'L_INFO_NODB' => "Datebank gits nöd",
    'L_INFO_NOPROCESSES' => "kei laufendi Prozäss",
    'L_INFO_NOSTATUS' => "kei Status verfüegbar",
    'L_INFO_NOVARS' => "kei Variable verfüegbar",
    'L_INFO_OPTIMIZED' => "optimiert",
    'L_INFO_RECORDS' => "Datesätz",
    'L_INFO_RECORDS' => "Datesätz",
    'L_INFO_SIZE' => "Grössi",
    'L_INFO_SUM' => "total",
    'L_INSTALL' => "Installation",
    'L_INSTALL' => "Installation",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(läär = Standardport)",
    'L_INSTALL_HELP_SOCKET' => "(läär = Standardsocket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Sprach",
    'L_LASTBACKUP' => "sletschti Backup",
    'L_LOAD' => "Afangsiischtellige lade",
    'L_LOAD_DATABASE' => "Datebank neu lade",
    'L_LOAD_FILE' => "Load file",
    'L_LOG' => "Log",
    'L_LOGFILENOTWRITABLE' => "s'Logfile cha nöd gschribe wärde",
    'L_LOGFILENOTWRITABLE' => "Log-Datei cha nöd gschribe wärde!",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "Log lösche",
    'L_MAILERROR' => "Leider isch bim Verschicke vo de"
    ." E-Mail en Fähler underloffe!",
    'L_MAILPROGRAM' => "Mailprogramm",
    'L_MAXSIZE' => "maximali Grössi",
    'L_MAX_BACKUP_FILES_EACH2' => "für jedi Datebank",
    'L_MAX_EXECUTION_TIME' => "Max execution time",
    'L_MAX_UPLOAD_SIZE' => "Maximali Dateigrössi",
    'L_MAX_UPLOAD_SIZE' => "Maximali Dateigrössi",
    'L_MAX_UPLOAD_SIZE_INFO' => "Wänn Ihri Backup-Datei grösser als"
    ." das agebne Limit isch, müend Si diä"
    ." per FTP in \"work/backup\"-Ordner"
    ." ufelade. Dänn wird diä Datei, do i"
    ." de Verwaltig aazeigt und laht sich"
    ." dänn für en Reschtaurierig uswähle.",
    'L_MEMORY' => "Memory",
    'L_MESSAGE' => "Message",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Minute",
    'L_MINUTES' => "Minutes",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "MySQLDumper-Informatione",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Es sind <b>%d</b> Datenbanke"
    ." gesicheret worde",
    'L_MULTIPART_ACTUAL_PART' => "Actual Part",
    'L_MULTIPART_SIZE' => "maximali Dateigrössi",
    'L_MULTI_PART' => "Multipart-Backup",
    'L_MYSQLVARS' => "MySQL-Variable",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "Standardkodierig vom MySQL-Server",
    'L_MYSQL_DATA' => "MySQL-Date",
    'L_MYSQL_VERSION' => "MySQL-Version",
    'L_NAME' => "Name",
    'L_NAME' => "Name",
    'L_NEW' => "neu",
    'L_NEWTABLE' => "neui Tabälle",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "nei",
    'L_NOFTPPOSSIBLE' => "Es hät kei FTP-Funktionen zur"
    ." Verfüegig!",
    'L_NOFTPPOSSIBLE' => "Es schtönd kei FTP-Funktione zur"
    ." Verfüegig!",
    'L_NOFTPPOSSIBLE' => "Es stönd kei FTP-Funktione zur"
    ." Verfüegig!",
    'L_NOGZPOSSIBLE' => "Es hät kei Kompressions-Funktione zur"
    ." Verfüegig!",
    'L_NOGZPOSSIBLE' => "Will zlib nöd inschtalliert isch,"
    ." schtönd kei GZip-Funktione zur"
    ." Verfüegig!",
    'L_NONE' => "keini",
    'L_NOREVERSE' => "ältischte Iitrag zerscht",
    'L_NOTAVAIL' => "<em>nöd verfüegbar</em>",
    'L_NOTICE' => "Notice",
    'L_NOTICES' => "Hiiwis",
    'L_NOT_ACTIVATED' => "nöd aktiviert",
    'L_NOT_SUPPORTED' => "Das Backup cha diä Funktion nöd.",
    'L_NO_DB_FOUND' => "Es isch kei Datebank gfunde worde."
    ." Bländet Si d Verbindigsparameter ii"
    ." und gänd Si de Name vo de Datebank vo"
    ." Hand ii!",
    'L_NO_DB_FOUND_INFO' => "D Verbindig zur Datebank isch"
    ." erfolgriich gsi.<br />Ihri"
    ." Zuegangsdate sind gültig und sind vom"
    ." MySQL-Server akzeptiert worde.<br"
    ." />Leider hät de MySQLDumper kei"
    ." Datebank gfunde.<br />Di automatischi"
    ." Erkännig isch bi mänge Hoschter"
    ." gschpeert.<br />Si müend Ihri"
    ." Datebank nachem Abschluss vo de"
    ." Installation under em Menüpunkt"
    ." \"Konfiguration\""
    ." \"Verbindigsparameter iiblände\""
    ." agäh.<br />Gönd Si bitte sofort nach"
    ." em Abschluss vo de Installation det"
    ." hii und träged Si de Name vo Irer"
    ." Datebank det ii.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "Diä Tabälle \"<b>%s</b>\" ist läär"
    ." und hät keine Iiträg.",
    'L_NO_MSD_BACKUPFILE' => "Dateie vo andere Programm",
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s Tabälle sind optimiert worde.",
    'L_NUMBER_OF_FILES_FORM' => "Aazahl vo Backup-Dateie",
    'L_OF' => "vo",
    'L_OF' => "vo",
    'L_OK' => "ok",
    'L_OPTIMIZE' => "Optimiere",
    'L_OPTIMIZE_TABLES' => "Tabälle vorem Backup optimiere",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Operating system",
    'L_PAGE_REFRESHS' => "Pageviews",
    'L_PASS' => "Passwort",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "Diä Passwörter sind nöd identisch"
    ." oder läär!",
    'L_PASSWORD_REPEAT' => "Password (repeat)",
    'L_PASSWORD_STRENGTH' => "Password strength",
    'L_PERLOUTPUT1' => "Iitrag in crondump.pl für"
    ." absolute_path_of_con",
    'L_PERLOUTPUT2' => "Ufruef im Browser oder für externe"
    ." Cronjob",
    'L_PERLOUTPUT3' => "Ufruef i de Shell oder für d Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Bug in zlib! Kei Kompression mögli!",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "PHP-Extensions",
    'L_PHP_VERSION' => "PHP-Version",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Port",
    'L_PORT' => "Port",
    'L_POSITION_BC' => "bottom center",
    'L_POSITION_BL' => "bottom left",
    'L_POSITION_BR' => "bottom right",
    'L_POSITION_MC' => "center center",
    'L_POSITION_ML' => "middle left",
    'L_POSITION_MR' => "middle right",
    'L_POSITION_NOTIFICATIONS' => "Position of notification window",
    'L_POSITION_TC' => "top center",
    'L_POSITION_TL' => "top left",
    'L_POSITION_TR' => "top right",
    'L_PREFIX' => "Präfix",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "Save primary keys",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Really delete primary key?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "Primary key field",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "Es wird versuecht, Prozess",
    'L_PROCESSKILL2' => "z beände",
    'L_PROCESSKILL3' => "Es wird sit",
    'L_PROCESSKILL4' => "Sekunde versuecht, Prozess",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Fortschritt gsamt",
    'L_PROGRESS_OVER_ALL' => "Fortschritt total",
    'L_PROGRESS_TABLE' => "Fortschritt Tabälle",
    'L_PROVIDER' => "Provider",
    'L_PROZESSE' => "Prozäss",
    'L_RECHTE' => "Rächt",
    'L_RECORDS' => "Datesätz",
    'L_RECORDS_INSERTED' => "<b>%s</b> Datesätz sind iitreit"
    ." worde.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Neu lade",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "zruggsetze",
    'L_RESET_SEARCHWORDS' => "Iigab zruggsetze",
    'L_RESTORE' => "Reschtauriere",
    'L_RESTORE_COMPLETE' => "<b>%s</b> Tabälle sind angleit worde.",
    'L_RESTORE_DB' => "Datebank '<b>%s</b>' uf Server"
    ." '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "Reschtauriere vo bestimmte Tabälle",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Es sind bis ez <b>%d</b> vo <b>%d</b>"
    ." Tabälle agleit worde.",
    'L_RESTORE_TABLES_COMPLETED0' => "Es sind bis ez <b>%d</b> Tabälle"
    ." agleit worde.",
    'L_REVERSE' => "neuschte Iitrag zerscht",
    'L_SAFEMODEDESC' => "Will PHP uf däm Server mit de Option"
    ." \"safe_mode=on\" usgfuert wird, müend"
    ." folgendi Verzeichnis vo Hand aagleit"
    ." wärde (Si chönd das mit Irem"
    ." FTP-Programm erlegige):",
    'L_SAVE' => "Speichere",
    'L_SAVEANDCONTINUE' => "spiichere und wiitermache mit de"
    ." Installation",
    'L_SAVE_ERROR' => "D Iischtellige händ nöd chöne"
    ." gschpeicheret wärde!",
    'L_SAVE_SUCCESS' => "D Iischtellige sind erfolgriich i de"
    ." Konfigurationsdatei \"%s\" gspeicheret"
    ." worde.",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Datebank",
    'L_SAVING_TABLE' => "Spichere Tabälle",
    'L_SEARCH_ACCESS_KEYS' => "Blättere: vürschi=ALT+V, zrugg=ALT+C",
    'L_SEARCH_IN_TABLE' => "Suech i de Tabälle",
    'L_SEARCH_NO_RESULTS' => "D Suech nach \"<b>%s</b>\" i de"
    ." Tabälle \"<b>%s</b>\" lieferet kei"
    ." Ergebniss!",
    'L_SEARCH_OPTIONS' => "Suechoptione",
    'L_SEARCH_OPTIONS_AND' => "e Spalte mues alli Suechbegriff"
    ." enthalte (UND-Suche)",
    'L_SEARCH_OPTIONS_CONCAT' => "en Datesatz mues alli Suechbegriffe"
    ." enthalte, diä chöned aber i"
    ." beliebige Spalte sii (Recheintensiv!)",
    'L_SEARCH_OPTIONS_OR' => "e Spalte mues mindeschtens ein"
    ." Suechbegriff enthalte (ODER-Suche)",
    'L_SEARCH_RESULTS' => "D Suech nach \"<b>%s</b>\" i de"
    ." Tabälle \"<b>%s</b>\" liferet"
    ." folgendi Träffer",
    'L_SECOND' => "Second",
    'L_SECONDS' => "Seconds",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "ali uuswähle",
    'L_SELECTED_FILE' => "gwählti Datei",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "Ergebnis als Datei schicke",
    'L_SEND_MAIL_FORM' => "E-Mail schicke",
    'L_SERVER' => "Server",
    'L_SERVERCAPTION' => "Aazeig vom Server",
    'L_SETPRIMARYKEYSFOR' => "Set new primary keys for table",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "Ergebnis aazeige",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Höchi vo de SQL-Box",
    'L_SQLLIB_ACTIVATEBOARD' => "Board aktiviere",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "Board deaktiviere",
    'L_SQLLIB_GENERALFUNCTIONS' => "allgemeini Funktione",
    'L_SQLLIB_RESETAUTO' => "Auto-Wert zruggsetze",
    'L_SQLLIMIT' => "Aazahl Datesätz pro Siite",
    'L_SQL_ACTIONS' => "Aktione",
    'L_SQL_AFTER' => "nach",
    'L_SQL_ALLOWDUPS' => "Duplikat erlaubt",
    'L_SQL_ATPOSITION' => "a Position iifüege",
    'L_SQL_ATTRIBUTES' => "Attribut",
    'L_SQL_BACKDBOVERVIEW' => "zrugg zur Datebank-Übersicht",
    'L_SQL_BEFEHLNEU' => "neue Befähl",
    'L_SQL_BEFEHLSAVED1' => "SQL-Befähl",
    'L_SQL_BEFEHLSAVED2' => "isch zuegfüegt worde",
    'L_SQL_BEFEHLSAVED3' => "isch gschpeicheret worde",
    'L_SQL_BEFEHLSAVED4' => "isch nach obe bracht worde",
    'L_SQL_BEFEHLSAVED5' => "isch glöscht worde",
    'L_SQL_BROWSER' => "SQL-Browser",
    'L_SQL_CARDINALITY' => "Kardinalität",
    'L_SQL_CHANGED' => "isch gänderet worde",
    'L_SQL_CHANGEFIELD' => "Fäld ändere",
    'L_SQL_CHOOSEACTION' => "Aktion wähle",
    'L_SQL_COLLATENOTMATCH' => "Zeichesatz und Sortierig passed nöd"
    ." zäme!",
    'L_SQL_COLUMNS' => "Spalte",
    'L_SQL_COMMANDS' => "SQL-Befähl",
    'L_SQL_COMMANDS_IN' => "Ziile i",
    'L_SQL_COMMANDS_IN2' => "Sekunde(n) abgschafft.",
    'L_SQL_COPYDATADB' => "Inhalt i Datebank kopiere",
    'L_SQL_COPYSDB' => "Struktur i Datebank kopiere",
    'L_SQL_COPYTABLE' => "Tabälle kopiere",
    'L_SQL_CREATED' => "isch aagleit worde",
    'L_SQL_CREATEINDEX' => "neue Index mache",
    'L_SQL_CREATETABLE' => "Tabälle aalegge",
    'L_SQL_DATAVIEW' => "Daten-Aasicht",
    'L_SQL_DBCOPY' => "De Inhalt vo de Datebank `%s` isch i d"
    ." Datenbank `%s` kopiert worde.",
    'L_SQL_DBSCOPY' => "D Struktur vo de Datebank `%s` isch i"
    ." d Datebank `%s` kopiert worde.",
    'L_SQL_DELETED' => "isch glöscht worde",
    'L_SQL_DELETEDB' => "Datebank lösche",
    'L_SQL_DESTTABLE_EXISTS' => "Zieltabälle existiert scho!",
    'L_SQL_EDIT' => "bearbeite",
    'L_SQL_EDITFIELD' => "Editiere Fäld",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Tabällestruktur bearbeite",
    'L_SQL_EMPTYDB' => "Datebank lääre",
    'L_SQL_ERROR1' => "Fähler bi de Aafrag:",
    'L_SQL_ERROR2' => "MySQL mäldet:",
    'L_SQL_EXEC' => "SQL-Befähl usfüere",
    'L_SQL_EXPORT' => "Export us Datebank `%s`",
    'L_SQL_FIELDDELETE1' => "Das Fäld",
    'L_SQL_FIELDNAMENOTVALID' => "Fähler: Kei gültige Fäldname",
    'L_SQL_FIRST' => "zerscht",
    'L_SQL_IMEXPORT' => "Im-/Export",
    'L_SQL_IMPORT' => "Import i Datebank `%s`",
    'L_SQL_INDEXES' => "Indizes",
    'L_SQL_INSERTFIELD' => "Fäld iifüege",
    'L_SQL_INSERTNEWFIELD' => "neus Fäld iifüege",
    'L_SQL_LIBRARY' => "SQL-Bibliothek",
    'L_SQL_NAMEDEST_MISSING' => "Name für d Zieldatebank fählt!",
    'L_SQL_NEWFIELD' => "neus Fäld",
    'L_SQL_NODATA' => "kei Datesätz",
    'L_SQL_NODEST_COPY' => "Ohni Ziel cha nöd kopiert wärde!",
    'L_SQL_NOFIELDDELETE' => "Lösche nöd mögli, will e Tabälle"
    ." mindischtens 1 Fäld ha mues.",
    'L_SQL_NOTABLESINDB' => "Es hät kei Tabälle i de Datebank",
    'L_SQL_NOTABLESSELECTED' => "Es sind kei Tabälle usgwählt!",
    'L_SQL_OPENFILE' => "SQL-Datei ufmache",
    'L_SQL_OPENFILE_BUTTON' => "Ufelade",
    'L_SQL_OUT1' => "Es wurden",
    'L_SQL_OUT2' => "Befähl usgfüert",
    'L_SQL_OUT3' => "Es gab",
    'L_SQL_OUT4' => "Kommentar",
    'L_SQL_OUT5' => "Will d Uusgab über 5000 Ziile hät,"
    ." wird si nöd aazeigt.",
    'L_SQL_OUTPUT' => "SQL-Uusgab",
    'L_SQL_QUERYENTRY' => "D Abfrag hät",
    'L_SQL_RECORDDELETED' => "Datesatz isch gelöscht worde",
    'L_SQL_RECORDEDIT' => "editiere Datesatz",
    'L_SQL_RECORDINSERTED' => "Datesatz isch gspeicheret worde",
    'L_SQL_RECORDNEW' => "Datesatz iifüege",
    'L_SQL_RECORDUPDATED' => "Datesatz isch gändert worde",
    'L_SQL_RENAMEDB' => "Datesatz umbenänne",
    'L_SQL_RENAMEDTO' => "isch unbenännt worde i",
    'L_SQL_SCOPY' => "Tabällestruktur vo `%s` isch i"
    ." Tabelle `%s` kopiert worde.",
    'L_SQL_SEARCH' => "Suechi",
    'L_SQL_SEARCHWORDS' => "Suechbegriff",
    'L_SQL_SELECTTABLE' => "Tabälle uswähle",
    'L_SQL_SHOWDATATABLE' => "Date vo de Tabälle aazeige",
    'L_SQL_STRUCTUREDATA' => "Struktur und Date",
    'L_SQL_STRUCTUREONLY' => "nume Struktur",
    'L_SQL_TABLEEMPTIED' => "Tabälle `%s` isch gläärt worde.",
    'L_SQL_TABLEEMPTIEDKEYS' => "Tabälle `%s` isch gläärt worde, und"
    ." d Indizes sind zrugggsetzt worde.",
    'L_SQL_TABLEINDEXES' => "Indizes vo de Tabälle",
    'L_SQL_TABLENEW' => "Tabälle bearbeite",
    'L_SQL_TABLENOINDEXES' => "Diä Tabälle hät kei Indizes",
    'L_SQL_TABLENONAME' => "Tabälle brucht en Namen!",
    'L_SQL_TABLESOFDB' => "Tabälle vo de Datebank",
    'L_SQL_TABLEVIEW' => "Tabälle-Aasicht",
    'L_SQL_TBLNAMEEMPTY' => "Tabällename dörf nöd läär sii!",
    'L_SQL_TBLPROPSOF' => "Tabälleeigeschafte vo",
    'L_SQL_TCOPY' => "Tabälle `%s` isch mit Date in"
    ." Tabälle `%s` kopiert worde.",
    'L_SQL_UPLOADEDFILE' => "gladeni Datei:",
    'L_SQL_VIEW_COMPACT' => "View: compact",
    'L_SQL_VIEW_STANDARD' => "View: standard",
    'L_SQL_VONINS' => "vo total",
    'L_SQL_WARNING' => "D Uusfüerig vo SQL-Befähl cha Date"
    ." manipuliere! Dr Autor übernimmt kei"
    ." Haftig bi Dateverlüscht.",
    'L_SQL_WASCREATED' => "isch gmacht worde",
    'L_SQL_WASEMPTIED' => "isch gläärt worde",
    'L_STARTDUMP' => "Backup starte",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "Suechi starte",
    'L_STATUS' => "Status",
    'L_STATUS' => "Status",
    'L_STEP' => "Schritt",
    'L_SUCCESS_CONFIGFILE_CREATED' => "D Konfigurationsdatei \"%s\" isch"
    ." erfolgriich aagleit worde.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "D Konfigurationsdatei \"%s\" isch"
    ." erfolgriich glöscht worde.",
    'L_TABLE' => "Tabälle",
    'L_TABLES' => "Tabälle",
    'L_TABLESELECTION' => "Tabälleuswahl",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "Verbindig teschte",
    'L_THEME' => "Theme",
    'L_TIME' => "Time",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Volltextschlüssel",
    'L_TITLE_KEY_PRIMARY' => "Primärschlüssel",
    'L_TITLE_KEY_UNIQUE' => "Eidütige Schlüssel",
    'L_TITLE_MYSQL_HELP' => "MySQL Dokumentation",
    'L_TITLE_NOKEY' => "Kei Schlüssel",
    'L_TITLE_SEARCH' => "Suechi",
    'L_TITLE_SHOW_DATA' => "Date aazeige",
    'L_TITLE_UPLOAD' => "SQL-Datei ufelade",
    'L_TO' => "bis",
    'L_TOOLS' => "Tools",
    'L_TOOLS' => "Tools",
    'L_TOOLS_TOOLBOX' => "Datebank uswähle / Datebankfunktionen"
    ." / Im- und Export",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "ubekannt",
    'L_UNKNOWN_SQLCOMMAND' => "Unbekannte SQL-Befehl:",
    'L_UPDATE' => "Update",
    'L_UPTO' => "bis",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "Wert",
    'L_VERSIONSINFORMATIONEN' => "Versionsinformatione",
    'L_VIEW' => "aaluege",
    'L_VISIT_HOMEPAGE' => "Visit Homepage",
    'L_VOM' => "vo",
    'L_WITH' => "mit",
    'L_WITHATTACH' => "mit Aahang",
    'L_WITHOUTATTACH' => "ohni Aahang",
    'L_WITHPRAEFIX' => "mit Präfix",
    'L_WRONGCONNECTIONPARS' => "Falschi oder kei Verbindigsparameter",
    'L_WRONG_CONNECTIONPARS' => "Verbindigsparameter stimmed nöd!",
    'L_WRONG_RIGHTS' => "Diä Datei oder das Verzeichnis '%s'"
    ." isch für mi nöd beschriibbar.<br />"
    ." Entweder hät si de falschi Besitzer"
    ." (Owner) oder di falsche Rächt"
    ." (Chmod).<br /> Bitte setzed Si diä"
    ." richtige Attribut mit Irem"
    ." FTP-Programm. <br /> Diä Datei oder"
    ." das Verzeichnis brucht diä Rächt"
    ." %s.<br />",
    'L_YES' => "jo",
));
