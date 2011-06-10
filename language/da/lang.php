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
    'L_ACTION' => "Action",
    'L_ACTIVATED' => "aktiveret",
    'L_ACTUALLY_INSERTED_RECORDS' => "foreløbigt er der korrekt tilføjet"
    ." <b>%s</b> poster.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Foreløbigt er der korrekt tilføjet "
    ." <b>%s</b> af <b>%s</b> poster.",
    'L_ADD' => "Add",
    'L_ADDED' => "tilføjet",
    'L_ADD_DB_MANUALLY' => "Opret manuelt database",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "alle",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "Tabellen '<b>%s</b>' er under"
    ." genetablering.",
    'L_ASKDBCOPY' => "Vil du kopiere database `%s` til"
    ." database `%s`?",
    'L_ASKDBDELETE' => "Vil du slette databasen `%s` med alt"
    ." indhold?",
    'L_ASKDBEMPTY' => "Vil du tømme databasen `%s` ?",
    'L_ASKDELETEFIELD' => "Vil du slette feltet?",
    'L_ASKDELETERECORD' => "Er du sikker på at du vil slette"
    ." denne post?",
    'L_ASKDELETETABLE' => "Skal tabellen `%s` slettes?",
    'L_ASKTABLEEMPTY' => "Skal tabellen `%s` tømmes?",
    'L_ASKTABLEEMPTYKEYS' => "Skal tabellen `%s` tømmes og"
    ." indeksene nulstilles?",
    'L_ATTACHED_AS_FILE' => "attached as file",
    'L_ATTACH_BACKUP' => "Vedhæft backup",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "Slet backups automatisk",
    'L_BACK' => "tilbage",
    'L_BACKUPFILESANZAHL' => "I Backup folderen er",
    'L_BACKUPS' => "Backups",
    'L_BACKUP_DBS' => "DBs to backup",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Databaseoversigt",
    'L_BACK_TO_OVERVIEW' => "Database-oversigt",
    'L_CALL' => "Call",
    'L_CANCEL' => "Cancel",
    'L_CANT_CREATE_DIR' => "Kunne ikke oprette folderen '%s'."
    ." Opret den venligst med en FTP-klient.",
    'L_CHANGE' => "skift",
    'L_CHANGEDIR' => "skift til folder",
    'L_CHANGEDIR' => "Skifter til folder",
    'L_CHANGEDIRERROR' => "skift til folder var ikke muligt",
    'L_CHANGEDIRERROR' => "Kunne ikke skifte folder!",
    'L_CHARSET' => "Tegnsæt",
    'L_CHECK' => "Check",
    'L_CHECK' => "check",
    'L_CHECK_DIRS' => "Check mine foldere",
    'L_CHOOSE_CHARSET' => "MySQLDumper couldn't detect the"
    ." encoding of the backup file"
    ." automatically.
<br />You must choose"
    ." the charset with which this backup was"
    ." saved.
<br />If you discover any"
    ." problems with some characters after"
    ." restoring, you can repeat the"
    ." backup-progress and then choose"
    ." another character set.
<br />Good"
    ." luck. ;)",
    'L_CHOOSE_DB' => "Vælg Database",
    'L_CLEAR_DATABASE' => "Tøm database",
    'L_CLOSE' => "Close",
    'L_COLLATION' => "Kollation",
    'L_COMMAND' => "Kommando",
    'L_COMMAND' => "Kommando",
    'L_COMMAND_AFTER_BACKUP' => "Command after backup",
    'L_COMMAND_BEFORE_BACKUP' => "Command before backup",
    'L_COMMENT' => "Kommentar",
    'L_COMPRESSED' => "komprimeret (gz)",
    'L_CONFBASIC' => "Basisparametre",
    'L_CONFIG' => "Konfiguration",
    'L_CONFIGFILE' => "Config File",
    'L_CONFIGFILES' => "Configuration Files",
    'L_CONFIGURATIONS' => "Configurations",
    'L_CONFIG_AUTODELETE' => "Autoslet",
    'L_CONFIG_CRONPERL' => "Crondump-indstillinger til Perl-script",
    'L_CONFIG_EMAIL' => "Email-notifikation",
    'L_CONFIG_FTP' => "FTP-overførsel af Backupfil",
    'L_CONFIG_HEADLINE' => "Konfiguration",
    'L_CONFIG_INTERFACE' => "Brugerflade",
    'L_CONFIG_LOADED' => "Configuration \"%s\" has been imported"
    ." successfully.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Really delete the configuration file"
    ." %s?",
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
    'L_CONNECT' => "forbind",
    'L_CONNECTIONPARS' => "Forbindelsesparametre",
    'L_CONNECTTOMYSQL' => "Forbind til MySQL",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Backupkonvertering",
    'L_CONVERTING' => "Konverterer",
    'L_CONVERT_FILE' => "Fil der skal konverteres",
    'L_CONVERT_FILENAME' => "Navn på destinationsfilen (uden"
    ." filtype)",
    'L_CONVERT_FILEREAD' => "Læs fil '%s'",
    'L_CONVERT_FINISHED' => "Konvertering afsluttet, '%s' blev"
    ." skrevet korrekt.",
    'L_CONVERT_START' => "Start konvertering",
    'L_CONVERT_TITLE' => "Konvertér dump til MSD-format",
    'L_CONVERT_WRONG_PARAMETERS' => "Forkerte parametre!  Konvertering er"
    ." ikke muligt.",
    'L_CREATE' => "Opret",
    'L_CREATEAUTOINDEX' => "Opret Auto-Indeks",
    'L_CREATEDIRS' => "Opret foldere",
    'L_CREATE_CONFIGFILE' => "Create a new configuration file",
    'L_CREATE_DATABASE' => "Opret ny database",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Bidragydere / Hjælp",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Indtast kommentar",
    'L_CRON_COMPLETELOG' => "Log komplet output",
    'L_CRON_EXECPATH' => "Sti til Perl scripts",
    'L_CRON_EXTENDER' => "Filtype",
    'L_CRON_PRINTOUT' => "Udskriv output til skærmen.",
    'L_CSVOPTIONS' => "CSV-opsætning",
    'L_CSV_EOL' => "Udskil linier med",
    'L_CSV_ERRORCREATETABLE' => "Fejl ved oprettelse af tabel `%s` !",
    'L_CSV_FIELDCOUNT_NOMATCH' => "Felt-tælleren stemmer ikke overens"
    ." med de importerede data (%d i stedet"
    ." for %d).",
    'L_CSV_FIELDSENCLOSED' => "Felter lukket inde i",
    'L_CSV_FIELDSEPERATE' => "Felter adskilt med",
    'L_CSV_FIELDSESCAPE' => "Felter escaped med",
    'L_CSV_FIELDSLINES' => "%d felter genkendt, totalt %d linier",
    'L_CSV_FILEOPEN' => "Åbn CSV-fil",
    'L_CSV_NAMEFIRSTLINE' => "Feltnavne i første linie",
    'L_CSV_NODATA' => "Ingen data fundet til import!",
    'L_CSV_NULL' => "Erstat NULL med",
    'L_DATASIZE' => "Size of data",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "Database",
    'L_DBCONNECTION' => "Databaseforbindelse",
    'L_DBPARAMETER' => "Databaseparametre",
    'L_DBS' => "Databaser",
    'L_DB_BACKUPPARS' => "Database backupparametre",
    'L_DB_HOST' => "Hostnavn",
    'L_DB_IN_LIST' => "Databasen '%s' kunne ikke tilføjes da"
    ." den allerede findes.",
    'L_DB_PASS' => "Kodeord",
    'L_DB_SELECT_ERROR' => "<br />Fejl:<br />Valg af database <b>",
    'L_DB_SELECT_ERROR2' => "</b> fejlede!",
    'L_DB_USER' => "Bruger",
    'L_DEFAULT_CHARSET' => "Default character set",
    'L_DELETE' => "Slet",
    'L_DELETE_DATABASE' => "Slet database",
    'L_DELETE_FILE_ERROR' => "Error deleting file \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "File \"%s\" was deleted successfully.",
    'L_DELETE_HTACCESS' => "Fjern folderbeskyttelse (slet"
    ." .htaccess)",
    'L_DESELECTALL' => "Fravælg alle",
    'L_DIR' => "Folder",
    'L_DISABLEDFUNCTIONS' => "Deaktiverede Funktioner",
    'L_DISABLEDFUNCTIONS' => "Funktioner slået fra",
    'L_DO' => "Udfør",
    'L_DOCRONBUTTON' => "Kør Perl Cron scriptet",
    'L_DONE' => "Færdig!",
    'L_DONT_ATTACH_BACKUP' => "Don't attach backup",
    'L_DOPERLTEST' => "Test Perl-moduler",
    'L_DOSIMPLETEST' => "Test Perl",
    'L_DOWNLOAD_FILE' => "Download file",
    'L_DO_NOW' => "gør det nu",
    'L_DUMP' => "Backup",
    'L_DUMP_ENDERGEBNIS' => "Filen indeholder <b>%s</b> tabeller"
    ." med <b>%s</b> poster.<br />",
    'L_DUMP_FILENAME' => "Backup Fil",
    'L_DUMP_HEADLINE' => "Lav backup...",
    'L_DUMP_NOTABLES' => "Ingen tabeller fundet i database `%s`",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Duration",
    'L_EDIT' => "ret",
    'L_EHRESTORE_CONTINUE' => "fortsæt og log fejl",
    'L_EHRESTORE_STOP' => "stop",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "Den vedhæftede fil indeholder backup"
    ." af din MySQL-Database.<br />Backup af"
    ." Database `%s`
<br /><br />Følgende"
    ." fil blev oprettet:<br /><br />%s <br"
    ." /><br />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "<br /><br />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "En Multipart Backup er blevet"
    ." oprettet.<br />Backupfilerne er"
    ." vedhæftet separate emails.<br"
    ." />Backup af Database `%s`
<br /><br"
    ." />Følgende filer blev oprettet:<br"
    ." /><br />%s <br /><br />Med venlig"
    ." hilsen<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "En Multipart Backup blev oprettet.<br"
    ." />Backupfilerne er ikke vedhæftet"
    ." denne email!<br />Backup af Database"
    ." `%s`
<br /><br />Følgende filer blev"
    ." oprettet:<br /><br />%s
<br /><br"
    ." />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "Filer er ikke vedhæftet denne"
    ." email!<br />Backup af Database"
    ." `%s`
<br /><br />Følgende fil blev"
    ." oprettet:<br /><br />%s
<br /><br"
    ." />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "Backupfilen oversteg"
    ." maksimumstørrelsen på %s og blev"
    ." ikke vedhæftet denne email.<br"
    ." />Backup sf Database `%s`
<br /><br"
    ." />Følgende fil blev oprettet:<br"
    ." /><br />%s
<br /><br />Venlig"
    ." hilsen<br /><br />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Receiver",
    'L_EMAIL_MAXSIZE' => "Maksimumstørrelse på vedhæftede",
    'L_EMAIL_ONLY_ATTACHMENT' => "... kun vedhæftet.",
    'L_EMAIL_RECIPIENT' => "Emailadresse",
    'L_EMAIL_SENDER' => "Afsenderadresse på emailen",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "Email blev korrekt sendt til",
    'L_EMPTY' => "Tøm",
    'L_EMPTYKEYS' => "tøm og nulstil alle indeks",
    'L_EMPTYTABLEBEFORE' => "Tøm tabel før",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Slet tabeller før genetablering",
    'L_ENCODING' => "encoding",
    'L_ENCRYPTION_TYPE' => "Krypteringsmetode",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Indlæg",
    'L_ERROR' => "Fejl",
    'L_ERRORHANDLING_RESTORE' => "Fejlhandling under genetablering",
    'L_ERROR_CONFIGFILE_NAME' => "Filename \"%s\" contains invalid"
    ." characters.",
    'L_ERROR_DELETING_CONFIGFILE' => "Error: couldn't delete configuration"
    ." file %s!",
    'L_ERROR_LOADING_CONFIGFILE' => "Couldn't load configfile \"%s\".",
    'L_ERROR_LOG' => "Error Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel fra 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Eksport",
    'L_EXPORTFINISHED' => "Eksport færdiggjort.",
    'L_EXPORTLINES' => "<strong>%s</strong> linier eksporteret",
    'L_EXPORTOPTIONS' => "Eksport-opsætning",
    'L_EXTENDEDPARS' => "Udvidede parametre",
    'L_FADE_IN_OUT' => "Visning til/fra",
    'L_FATAL_ERROR_DUMP' => "Fatal error: the CREATE-Statement of"
    ." table '%s' in database '%s' couldn't"
    ." be read!",
    'L_FIELDS' => "Felter",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "Fil",
    'L_FILES' => "Files",
    'L_FILESIZE' => "Filstørrelse",
    'L_FILE_MANAGE' => "Fil Administration",
    'L_FILE_OPEN_ERROR' => "Fejl: kunne ikke åbne fil.",
    'L_FILE_SAVED_SUCCESSFULLY' => "The file has been saved successfully.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "The file couldn't be saved!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Skal databasen",
    'L_FM_ALERTRESTORE2' => "genetableres med posterne fra filen",
    'L_FM_ALERTRESTORE3' => "?",
    'L_FM_ALL_BU' => "Alle backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Skal filen",
    'L_FM_ASKDELETE2' => "virkelig slettes?",
    'L_FM_ASKDELETE3' => "Vil du køre autoslet med de"
    ." konfigurerede regler nu?",
    'L_FM_ASKDELETE4' => "Vil du slette alle backupfiler?",
    'L_FM_ASKDELETE5' => "Vil du slette alle backupfiler med",
    'L_FM_ASKDELETE5_2' => "* ?",
    'L_FM_AUTODEL1' => "Autoslet: følgende filer blev slettet"
    ." grundet maksimalt antal"
    ." filer-indstillingen:",
    'L_FM_CHOOSE_ENCODING' => "Choose encoding of backup file",
    'L_FM_COMMENT' => "Indtast kommentar",
    'L_FM_DBNAME' => "Databasenavn",
    'L_FM_DELETE' => "Slet",
    'L_FM_DELETE1' => "Filen",
    'L_FM_DELETE2' => "blev slettet korrekt.",
    'L_FM_DELETE3' => "kunne ikke slettes!",
    'L_FM_DELETEALL' => "Slette alle backupfiler",
    'L_FM_DELETEALLFILTER' => "Slet alle med",
    'L_FM_DELETEAUTO' => "Kør autoslet manuelt",
    'L_FM_DUMPSETTINGS' => "Konfiguration for Perl Cron scriptet",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "Fildato",
    'L_FM_FILES1' => "Databasebackups",
    'L_FM_FILESIZE' => "Filstørrelse",
    'L_FM_FILEUPLOAD' => "Upload fil",
    'L_FM_FILEUPLOAD' => "Upload fil",
    'L_FM_FREESPACE' => "Fri plads på Server",
    'L_FM_LAST_BU' => "Seneste backup",
    'L_FM_NOFILE' => "Du valgte ikke en fil!",
    'L_FM_NOFILESFOUND' => "Ingen fil fundet.",
    'L_FM_RECORDS' => "Poster",
    'L_FM_RESTORE' => "Genetabler",
    'L_FM_RESTORE_HEADER' => "Genetablering af Database"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Vælg tabeller",
    'L_FM_STARTDUMP' => "Start ny backup",
    'L_FM_TABLES' => "Tabeller",
    'L_FM_TOTALSIZE' => "Total størrelse",
    'L_FM_UPLOADFAILED' => "Upload slog fejl!",
    'L_FM_UPLOADFILEEXISTS' => "Der findes allerede en fil med samme"
    ." navn!",
    'L_FM_UPLOADFILEREQUEST' => "vælg venligst en fil.",
    'L_FM_UPLOADFILEREQUEST' => "vælg venligst en fil.",
    'L_FM_UPLOADMOVEERROR' => "Kunne ikke flytte valgte fil til"
    ." upload folderen.",
    'L_FM_UPLOADNOTALLOWED1' => "Denne filtype understøttes ikke.",
    'L_FM_UPLOADNOTALLOWED2' => "Gyldige typer er: *.gz og *.sql-filer",
    'L_FOUND_DB' => "fundet db:",
    'L_FROMFILE' => "fra fil",
    'L_FROMTEXTBOX' => "fra tekstboks",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Add connection",
    'L_FTP_CHOOSE_MODE' => "FTP-overførselstilstand",
    'L_FTP_CONFIRM_DELETE' => "Should this FTP-Connection really be"
    ." deleted?",
    'L_FTP_CONNECTION' => "FTP-Connection",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Connection closed",
    'L_FTP_CONNECTION_DELETE' => "Delete connection",
    'L_FTP_CONNECTION_ERROR' => "The connection to server '%s' using"
    ." port %s couldn't be established",
    'L_FTP_CONNECTION_SUCCESS' => "The connection to server '%s' using"
    ." port %s was established successfully",
    'L_FTP_DIR' => "Upload-folder",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "FTP-parameter er ok",
    'L_FTP_OK' => "Forbindelse etableret.",
    'L_FTP_PASS' => "Kodeord",
    'L_FTP_PASSIVE' => "brug passiv-tilstand",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "to <strong>%s</strong><br /> into"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "Sikker SSL FTP-forbindelse",
    'L_FTP_START' => "Starting FTP transfer",
    'L_FTP_TIMEOUT' => "Forbindelses Timeout",
    'L_FTP_TRANSFER' => "FTP-overførsel",
    'L_FTP_USER' => "Bruger",
    'L_FTP_USESSL' => "brug SSL-forbindelse",
    'L_GENERAL' => "generelt",
    'L_GENERAL' => "Generelt",
    'L_GZIP' => "GZip-komprimering",
    'L_GZIP_COMPRESSION' => "GZip-komprimering",
    'L_HOME' => "Hjem",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Aktivér rewrite",
    'L_HTACC_ADD_HANDLER' => "Tilføj handler",
    'L_HTACC_CONFIRM_DELETE' => "Skal folderbeskyttelsen gemmes nu?",
    'L_HTACC_CONTENT' => "Indhold af fil",
    'L_HTACC_CREATE' => "Opret folderbeskyttelse",
    'L_HTACC_CREATED' => "Folderbeskyttelsen blev oprettet.",
    'L_HTACC_CREATE_ERROR' => "Der opstod en fejl ved oprettelse af"
    ." folderbeskyttelsen!<br />Opret"
    ." venligst de 2 filer manuelt med"
    ." følgende indhold",
    'L_HTACC_CRYPT' => "Crypt (Linux og Unix-systemer)",
    'L_HTACC_DENY_ALLOW' => "Deny / Allow",
    'L_HTACC_DIR_LISTING' => "Folder-indholdslistning",
    'L_HTACC_EDIT' => "Rediger .htaccess",
    'L_HTACC_ERROR_DOC' => "Fejl-dokument",
    'L_HTACC_EXAMPLES' => "Flere eksempler og dokumentation",
    'L_HTACC_EXISTS' => "Der findes allerede en"
    ." folderbeskyttelse. Hvis du opretter en"
    ." ny, vil den tidligere blive"
    ." overskrevet!",
    'L_HTACC_MAKE_EXECUTABLE' => "Lav til eksekverbar",
    'L_HTACC_MD5' => "MD5 (Linux og Unix-systemer)",
    'L_HTACC_NO_ENCRYPTION' => "plain text, ingen kryptering (Windows)",
    'L_HTACC_NO_USERNAME' => "Du skal indtaste et navn!",
    'L_HTACC_PROPOSED' => "Stærkt anbefalet",
    'L_HTACC_REDIRECT' => "Redirect",
    'L_HTACC_SCRIPT_EXEC' => "Udfør script",
    'L_HTACC_SHA1' => "SHA1 (all Systems)",
    'L_HTACC_WARNING' => "Bemærk! .htaccess påvirker dirkte"
    ." browserens opførsel.<br />Med forkert"
    ." indhold kan disse sider blive"
    ." utilgængelige.",
    'L_IMPORT' => "Import Konfiguration",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "Import",
    'L_IMPORTOPTIONS' => "Import-opsætning",
    'L_IMPORTSOURCE' => "Import-kilde",
    'L_IMPORTTABLE' => "Import i Tabel",
    'L_IMPORT_NOTABLE' => "Ingen tabel valgt til import!",
    'L_IN' => "i",
    'L_INFO_ACTDB' => "Aktuel Database",
    'L_INFO_DATABASES' => "Følgende database(r) er tilgængelige"
    ." på din server",
    'L_INFO_DBEMPTY' => "Databasen er tom !",
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
    'L_INFO_LASTUPDATE' => "Sidst opdateret",
    'L_INFO_LOCATION' => "Din lokation er",
    'L_INFO_NODB' => "database findes ikke.",
    'L_INFO_NOPROCESSES' => "ingen kørende processer",
    'L_INFO_NOSTATUS' => "ingen tilstand tilgængelig",
    'L_INFO_NOVARS' => "ingen variabler tilgængelige",
    'L_INFO_OPTIMIZED' => "optimeret",
    'L_INFO_RECORDS' => "Poster",
    'L_INFO_RECORDS' => "poster",
    'L_INFO_SIZE' => "Størrelse",
    'L_INFO_SUM' => "Total",
    'L_INSTALL' => "Installation",
    'L_INSTALL' => "Installation",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(tom = Standardport)",
    'L_INSTALL_HELP_SOCKET' => "(tom = Standard Socket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Sprog",
    'L_LASTBACKUP' => "Seneste Backup",
    'L_LOAD' => "Indlæs standard-indstillinger",
    'L_LOAD_DATABASE' => "Genindlæs databaser",
    'L_LOAD_FILE' => "Load file",
    'L_LOG' => "Log",
    'L_LOGFILENOTWRITABLE' => "Kan ikke skrive Logfil !",
    'L_LOGFILENOTWRITABLE' => "Kan <b>ikke</b> skrive Logfil!",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "slet Log",
    'L_MAILERROR' => "Afsendelse af email slog fejl!",
    'L_MAILPROGRAM' => "Mailprogram",
    'L_MAXSIZE' => "maks. størrelse",
    'L_MAX_BACKUP_FILES_EACH2' => "For hver database",
    'L_MAX_EXECUTION_TIME' => "Max execution time",
    'L_MAX_UPLOAD_SIZE' => "Maksimal filstørrelse",
    'L_MAX_UPLOAD_SIZE' => "Maksimal filstørrelse",
    'L_MAX_UPLOAD_SIZE_INFO' => "Hvis din Dumpfil er større end den"
    ." ovennævnte grænse, skal du uploade"
    ." den via FTP til folderen"
    ." \"work/backup\". 
Derefter kan du"
    ." vælge den og begynde"
    ." genetableringsprocessen.",
    'L_MEMORY' => "Memory",
    'L_MESSAGE' => "Message",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Minute",
    'L_MINUTES' => "Minutes",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "MySQLDumper-Information",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Backup af <b>%d</b> Databaser færdige",
    'L_MULTIPART_ACTUAL_PART' => "Actual Part",
    'L_MULTIPART_SIZE' => "maksimum Filstørrelse",
    'L_MULTI_PART' => "Multipart Backup",
    'L_MYSQLVARS' => "MySQL Variabler",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "Standard encoding of MySQL-Server",
    'L_MYSQL_DATA' => "MySQL-Data",
    'L_MYSQL_VERSION' => "MySQL-Version",
    'L_NAME' => "Name",
    'L_NAME' => "Name",
    'L_NEW' => "ny",
    'L_NEWTABLE' => "Ny tabel",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "nej",
    'L_NOFTPPOSSIBLE' => "Du har ikke adgang til FTP-funktioner!",
    'L_NOFTPPOSSIBLE' => "Du har ingen FTP-funktioner til"
    ." rådighed!",
    'L_NOFTPPOSSIBLE' => "Du har ingen FTP-funktioner !",
    'L_NOGZPOSSIBLE' => "Du har ikke adgang til"
    ." komprimerings-funktioner!",
    'L_NOGZPOSSIBLE' => "Da Zlib ikke er"
    ." installeret/tilgængeligt, kan du ikke"
    ." bruge GZip-funktionerne!",
    'L_NONE' => "ingen",
    'L_NOREVERSE' => "Ældste indlæg først",
    'L_NOTAVAIL' => "<em>ikke tilgængelig</em>",
    'L_NOTICE' => "Notice",
    'L_NOTICES' => "Bemærkninger",
    'L_NOT_ACTIVATED' => "ikke aktiveret",
    'L_NOT_SUPPORTED' => "Denne backup understøtter ikke denne"
    ." funktion.",
    'L_NO_DB_FOUND' => "kunne ikke automatisk finde nogen"
    ." database! Åbn forbindelsesparametrene"
    ." og indtast manuelt navnet på"
    ." databasen.",
    'L_NO_DB_FOUND_INFO' => "Forbindelsen til databasen blev"
    ." korrekt etableret.<br /> Dine"
    ." brugerdata er gyldige og blev"
    ." accepteret af MySQL-serveren.<br />"
    ." Men MySQLDumper kunne ikke finde nogen"
    ." database.<br /> Den automatiske"
    ." visning af databaser via script er"
    ." slået fra på visse servere.<br /> Du"
    ." skal indtaste databasenavnet manuelt"
    ." efter installationen er færdiggjort."
    ." Klik på \"konfiguration\""
    ." \"Forbindelsesparametr - vis\" og"
    ." indtast databasenavnet dér.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "Tabel \"<b>%s</b>\" er tom og"
    ." indeholder ingen poster.",
    'L_NO_MSD_BACKUPFILE' => "Backups af andre scripts",
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s tabeller er blevet optimeret.",
    'L_NUMBER_OF_FILES_FORM' => "Slet ud fra antal filer",
    'L_OF' => "af",
    'L_OF' => "af",
    'L_OK' => "OK",
    'L_OPTIMIZE' => "Optimér",
    'L_OPTIMIZE_TABLES' => "Optimér tabeller før backup",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Operating system",
    'L_PAGE_REFRESHS' => "Pageviews",
    'L_PASS' => "Kodeord",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "Kodeordene er ikke identiske eller"
    ." tomme!",
    'L_PASSWORD_REPEAT' => "Password (repeat)",
    'L_PASSWORD_STRENGTH' => "Password strength",
    'L_PERLOUTPUT1' => "Linie i crondump.pl for"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "URL for browseren eller for eksternt"
    ." Cron job",
    'L_PERLOUTPUT3' => "Kommandolinie i Shell eller for"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Fejl i zlib ! Ingen komprimering"
    ." mulig!",
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
    'L_PREFIX' => "Præfiks",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "Save primary keys",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Really delete primary key?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "Primary key field",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "Scriptet forsøger at dræbe proces",
    'L_PROCESSKILL2' => "at dræbe.",
    'L_PROCESSKILL3' => "Scriptet har forsøgt i",
    'L_PROCESSKILL4' => "sek. at dræbe processen",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Samlet fremskridt",
    'L_PROGRESS_OVER_ALL' => "Samlede fremskridt",
    'L_PROGRESS_TABLE' => "Fremskridt i tabel",
    'L_PROVIDER' => "Leverandør",
    'L_PROZESSE' => "Processer",
    'L_RECHTE' => "Tilladelser",
    'L_RECORDS' => "Poster",
    'L_RECORDS_INSERTED' => "<b>%s</b> poster indsat.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Genindlæs",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "Nulstil",
    'L_RESET_SEARCHWORDS' => "nulstil søgeord",
    'L_RESTORE' => "Genetabler",
    'L_RESTORE_COMPLETE' => "<b>%s</b> tabeller oprettet.",
    'L_RESTORE_DB' => "Database '<b>%s</b>' på '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "Choose tables to be restored",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Foreløbigt er der oprettet <b>%d</b>"
    ." af <b>%d</b> tabeller.",
    'L_RESTORE_TABLES_COMPLETED0' => "Foreløbigt er der oprettet <b>%d</b>"
    ." tabeller.",
    'L_REVERSE' => "Seneste indlæg først",
    'L_SAFEMODEDESC' => "Because PHP is running in safe_mode"
    ." you need to create the following"
    ." directories manually using your"
    ." FTP-Programm:",
    'L_SAVE' => "Gem",
    'L_SAVEANDCONTINUE' => "Gem og fortsæt installation",
    'L_SAVE_ERROR' => "Fejl - kunne ikke gemme konfiguration!",
    'L_SAVE_SUCCESS' => "Configuration was saved succesfully"
    ." into configuration file \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Database",
    'L_SAVING_TABLE' => "Gemmer tabel",
    'L_SEARCH_ACCESS_KEYS' => "Bladre: fremad=ALT+V, baglæns=ALT+C",
    'L_SEARCH_IN_TABLE' => "Søg i tabel",
    'L_SEARCH_NO_RESULTS' => "Søgningen efter \"<b>%s</b>\" i tabel"
    ." \"<b>%s</b>\" gav ingen rsultater!",
    'L_SEARCH_OPTIONS' => "Søgeindstillinger",
    'L_SEARCH_OPTIONS_AND' => "en kolonne skal indeholde ALLE"
    ." søgeord (OG-søgning)",
    'L_SEARCH_OPTIONS_CONCAT' => "en række skal indeholde alle"
    ." søgeordene men kan være i"
    ." hvilkensomhelst kolonne (kan tage"
    ." noget tid)",
    'L_SEARCH_OPTIONS_OR' => "en kolonne skal indeholde et af"
    ." søgeordene (ELLER-søgning)",
    'L_SEARCH_RESULTS' => "Søgningen efter \"<b>%s</b>\" i"
    ." tabellen \"<b>%s</b>\" giver følgende"
    ." resultater",
    'L_SECOND' => "Second",
    'L_SECONDS' => "Seconds",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "Vælg alle",
    'L_SELECTED_FILE' => "Valgt fil",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "send resultat som fil",
    'L_SEND_MAIL_FORM' => "Send email rapport",
    'L_SERVER' => "Server",
    'L_SERVERCAPTION' => "Vis Server",
    'L_SETPRIMARYKEYSFOR' => "Set new primary keys for table",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "vis resultat",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Højde på SQL-Boks",
    'L_SQLLIB_ACTIVATEBOARD' => "aktiver Board",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "deaktiver Board",
    'L_SQLLIB_GENERALFUNCTIONS' => "generelle funktioner",
    'L_SQLLIB_RESETAUTO' => "nulstil auto-increment (forøgelse)",
    'L_SQLLIMIT' => "Antal poster pr. side",
    'L_SQL_ACTIONS' => "Handlinger",
    'L_SQL_AFTER' => "efter",
    'L_SQL_ALLOWDUPS' => "Dubletter tilladte",
    'L_SQL_ATPOSITION' => "indsæt på position",
    'L_SQL_ATTRIBUTES' => "Attributter",
    'L_SQL_BACKDBOVERVIEW' => "Tilbage til Oversigt",
    'L_SQL_BEFEHLNEU' => "Ny kommando",
    'L_SQL_BEFEHLSAVED1' => "SQL-kommando",
    'L_SQL_BEFEHLSAVED2' => "blev tilføjet",
    'L_SQL_BEFEHLSAVED3' => "blev gemt",
    'L_SQL_BEFEHLSAVED4' => "blev flyttet op",
    'L_SQL_BEFEHLSAVED5' => "blev slettet",
    'L_SQL_BROWSER' => "SQL-Browser",
    'L_SQL_CARDINALITY' => "Kardinalitet",
    'L_SQL_CHANGED' => "blev ændret.",
    'L_SQL_CHANGEFIELD' => "ændre felt",
    'L_SQL_CHOOSEACTION' => "Vælg handling",
    'L_SQL_COLLATENOTMATCH' => "Tegnsæt og Kollation passer ikke"
    ." sammen!",
    'L_SQL_COLUMNS' => "Kolonner",
    'L_SQL_COMMANDS' => "SQL-kommandoer",
    'L_SQL_COMMANDS_IN' => "linier i",
    'L_SQL_COMMANDS_IN2' => "sek. bearbejdet.",
    'L_SQL_COPYDATADB' => "Kopier hele databasen til",
    'L_SQL_COPYSDB' => "Kopier database-struktur",
    'L_SQL_COPYTABLE' => "kopier tabel",
    'L_SQL_CREATED' => "blev oprettet.",
    'L_SQL_CREATEINDEX' => "opret nyt indeks",
    'L_SQL_CREATETABLE' => "opret tabel",
    'L_SQL_DATAVIEW' => "Data Visning",
    'L_SQL_DBCOPY' => "Indholdet af database `%s` blev"
    ." kopieret til database `%s`.",
    'L_SQL_DBSCOPY' => "Database-strukturen fra database `%s`"
    ." blev kopieret til database `%s`.",
    'L_SQL_DELETED' => "blev slettet",
    'L_SQL_DELETEDB' => "Slet database",
    'L_SQL_DESTTABLE_EXISTS' => "Destinationstabel findes allerede!",
    'L_SQL_EDIT' => "ret",
    'L_SQL_EDITFIELD' => "Ret felt",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Edit table structure",
    'L_SQL_EMPTYDB' => "Tøm database",
    'L_SQL_ERROR1' => "Fejl i forespørgsel:",
    'L_SQL_ERROR2' => "MySQL siger:",
    'L_SQL_EXEC' => "Udfør SQL-sætning",
    'L_SQL_EXPORT' => "Eksport fra Database `%s`",
    'L_SQL_FIELDDELETE1' => "Feltet",
    'L_SQL_FIELDNAMENOTVALID' => "Fejl: Ikke gyldigt feltnavn",
    'L_SQL_FIRST' => "først",
    'L_SQL_IMEXPORT' => "Import-Eksport",
    'L_SQL_IMPORT' => "Import i Database `%s`",
    'L_SQL_INDEXES' => "Indeks",
    'L_SQL_INSERTFIELD' => "indsæt felt",
    'L_SQL_INSERTNEWFIELD' => "indsæt nyt felt",
    'L_SQL_LIBRARY' => "SQL-bibliotek",
    'L_SQL_NAMEDEST_MISSING' => "Destinationsnavn mangler!",
    'L_SQL_NEWFIELD' => "Nyt felt",
    'L_SQL_NODATA' => "ingen poster",
    'L_SQL_NODEST_COPY' => "Ingen kopiering uden en destination!",
    'L_SQL_NOFIELDDELETE' => "Slet er ikke muligt da tabeller skal"
    ." indeholde mindst et felt.",
    'L_SQL_NOTABLESINDB' => "Ingen tabeller fundet i Database",
    'L_SQL_NOTABLESSELECTED' => "Ingen tabeller valgt!",
    'L_SQL_OPENFILE' => "Åbn SQL-fil",
    'L_SQL_OPENFILE_BUTTON' => "Upload",
    'L_SQL_OUT1' => "Udført",
    'L_SQL_OUT2' => "Kommandoer",
    'L_SQL_OUT3' => "Den havde",
    'L_SQL_OUT4' => "Kommentarer",
    'L_SQL_OUT5' => "Da outputtet indeholder mere end 5000"
    ." linier vises det ikke.",
    'L_SQL_OUTPUT' => "SQL-Output",
    'L_SQL_QUERYENTRY' => "Forespørgslen indeholder",
    'L_SQL_RECORDDELETED' => "Post blev slettet",
    'L_SQL_RECORDEDIT' => "rediger post",
    'L_SQL_RECORDINSERTED' => "Post blev tilføjet",
    'L_SQL_RECORDNEW' => "ny post",
    'L_SQL_RECORDUPDATED' => "Post blev opdateret",
    'L_SQL_RENAMEDB' => "Omdøb database",
    'L_SQL_RENAMEDTO' => "blev omdøbt til",
    'L_SQL_SCOPY' => "Tabelstrukturen fra `%s` blev kopieret"
    ." ind i Tabel `%s`.",
    'L_SQL_SEARCH' => "Søg",
    'L_SQL_SEARCHWORDS' => "Søgeord",
    'L_SQL_SELECTTABLE' => "vælg tabel",
    'L_SQL_SHOWDATATABLE' => "Vis Data i Tabel",
    'L_SQL_STRUCTUREDATA' => "Struktur og Data",
    'L_SQL_STRUCTUREONLY' => "Kun Struktur",
    'L_SQL_TABLEEMPTIED' => "Tabel `%s` blev tømt.",
    'L_SQL_TABLEEMPTIEDKEYS' => "Tabel `%s` blev tømt og indeksene"
    ." blev nulstillet.",
    'L_SQL_TABLEINDEXES' => "Indeks på tabel",
    'L_SQL_TABLENEW' => "Ret Tabeller",
    'L_SQL_TABLENOINDEXES' => "Ingen indeks i tabel",
    'L_SQL_TABLENONAME' => "Tabellen skal have et navn!",
    'L_SQL_TABLESOFDB' => "Tabeller i Database",
    'L_SQL_TABLEVIEW' => "Tabel-visning",
    'L_SQL_TBLNAMEEMPTY' => "Tabelnavnet kan ikke være tomt!",
    'L_SQL_TBLPROPSOF' => "Tabelegenskaber for",
    'L_SQL_TCOPY' => "Tabel `%s` blev kopieret med data ind"
    ." i Tabel `%s`.",
    'L_SQL_UPLOADEDFILE' => "indlæst fil:",
    'L_SQL_VIEW_COMPACT' => "View: compact",
    'L_SQL_VIEW_STANDARD' => "View: standard",
    'L_SQL_VONINS' => "fra totalt",
    'L_SQL_WARNING' => "Udførelse af SQL-sætninger kan"
    ." manipulere data. PAS PÅ! Forfatterne"
    ." af dette system påtager sig intet"
    ." ansvar for beskadigede eller tabte"
    ." data.",
    'L_SQL_WASCREATED' => "blev oprettet",
    'L_SQL_WASEMPTIED' => "blev tømt",
    'L_STARTDUMP' => "Start Backup",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "Start søgning",
    'L_STATUS' => "Tilstand",
    'L_STATUS' => "Tilstand",
    'L_STEP' => "Trin",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Configuration file \"%s\" has"
    ." successfully been created.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "The configuration file \"%s\" has"
    ." successfully been deleted.",
    'L_TABLE' => "Tabel",
    'L_TABLES' => "Tabeller",
    'L_TABLESELECTION' => "Tabelvælg",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "Test forbindelse",
    'L_THEME' => "Theme",
    'L_TIME' => "Time",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Fulltext key",
    'L_TITLE_KEY_PRIMARY' => "Primary key",
    'L_TITLE_KEY_UNIQUE' => "Unique key",
    'L_TITLE_MYSQL_HELP' => "MySQL documentation",
    'L_TITLE_NOKEY' => "No key",
    'L_TITLE_SEARCH' => "Search",
    'L_TITLE_SHOW_DATA' => "Show data",
    'L_TITLE_UPLOAD' => "Upload SQL file",
    'L_TO' => "til",
    'L_TOOLS' => "Funktioner",
    'L_TOOLS' => "Funktioner",
    'L_TOOLS_TOOLBOX' => "Vælg Database / Datebasefunktioner /"
    ." Import - Eksport",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "ukendt",
    'L_UNKNOWN_SQLCOMMAND' => "ukendt SQL-kommando",
    'L_UPDATE' => "Update",
    'L_UPTO' => "op til",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "Værdi",
    'L_VERSIONSINFORMATIONEN' => "Versionsinformation",
    'L_VIEW' => "vis",
    'L_VISIT_HOMEPAGE' => "Visit Homepage",
    'L_VOM' => "fra",
    'L_WITH' => "med",
    'L_WITHATTACH' => "med vedhæftede",
    'L_WITHOUTATTACH' => "uden vedhæftede",
    'L_WITHPRAEFIX' => "med præfiks",
    'L_WRONGCONNECTIONPARS' => "Forkerte eller manglende"
    ." forbindelsesparametre!",
    'L_WRONG_CONNECTIONPARS' => "Forbindelsesparametre er forkerte!",
    'L_WRONG_RIGHTS' => "Kan ikke skrive til filen eller"
    ." folderen '%s'.<br /> Fil-rettighederne"
    ." (chmod) er ikke sat korrekt eller har"
    ." den forkerte ejer.<br /> Sæt venligst"
    ." de korrekte attributter via din"
    ." FTP-klient.<br /> Filen eller mappen"
    ." skal være sat til %s.<br />",
    'L_YES' => "ja",
));
