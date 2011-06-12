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
$lang['L_ACTION']="Action";
$lang['L_ACTIVATED']="aktiveret";
$lang['L_ACTUALLY_INSERTED_RECORDS']="foreløbigt er der korrekt tilføjet"
    ." <b>%s</b> poster.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Foreløbigt er der korrekt tilføjet "
    ." <b>%s</b> af <b>%s</b> poster.";
$lang['L_ADD']="Add";
$lang['L_ADDED']="tilføjet";
$lang['L_ADD_DB_MANUALLY']="Opret manuelt database";
$lang['L_ADD_RECIPIENT']="Add recipient";
$lang['L_ALL']="alle";
$lang['L_ANALYZE']="Analyze";
$lang['L_ANALYZING_TABLE']="Tabellen '<b>%s</b>' er under"
    ." genetablering.";
$lang['L_ASKDBCOPY']="Vil du kopiere database `%s` til"
    ." database `%s`?";
$lang['L_ASKDBDELETE']="Vil du slette databasen `%s` med alt"
    ." indhold?";
$lang['L_ASKDBEMPTY']="Vil du tømme databasen `%s` ?";
$lang['L_ASKDELETEFIELD']="Vil du slette feltet?";
$lang['L_ASKDELETERECORD']="Er du sikker på at du vil slette"
    ." denne post?";
$lang['L_ASKDELETETABLE']="Skal tabellen `%s` slettes?";
$lang['L_ASKTABLEEMPTY']="Skal tabellen `%s` tømmes?";
$lang['L_ASKTABLEEMPTYKEYS']="Skal tabellen `%s` tømmes og"
    ." indeksene nulstilles?";
$lang['L_ATTACHED_AS_FILE']="attached as file";
$lang['L_ATTACH_BACKUP']="Vedhæft backup";
$lang['L_AUTHENTICATE']="Login information";
$lang['L_AUTHORIZE']="Authorize";
$lang['L_AUTODELETE']="Slet backups automatisk";
$lang['L_BACK']="tilbage";
$lang['L_BACKUPFILESANZAHL']="I Backup folderen er";
$lang['L_BACKUPS']="Backups";
$lang['L_BACKUP_DBS']="DBs to backup";
$lang['L_BACKUP_TABLE_DONE']="Dumping of table `%s` finished. %s"
    ." records have been saved.";
$lang['L_BACK_TO_OVERVIEW']="Databaseoversigt";
$lang['L_CALL']="Call";
$lang['L_CANCEL']="Cancel";
$lang['L_CANT_CREATE_DIR']="Kunne ikke oprette folderen '%s'."
    ." Opret den venligst med en FTP-klient.";
$lang['L_CHANGE']="skift";
$lang['L_CHANGEDIR']="Skifter til folder";
$lang['L_CHANGEDIRERROR']="Kunne ikke skifte folder!";
$lang['L_CHARSET']="Tegnsæt";
$lang['L_CHARSETS']="Character Sets";
$lang['L_CHECK']="Check";
$lang['L_CHECK_DIRS']="Check mine foldere";
$lang['L_CHOOSE_CHARSET']="MySQLDumper couldn't detect the"
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
    ." luck. ;)";
$lang['L_CHOOSE_DB']="Vælg Database";
$lang['L_CLEAR_DATABASE']="Tøm database";
$lang['L_CLOSE']="Close";
$lang['L_COLLATION']="Kollation";
$lang['L_COMMAND']="Kommando";
$lang['L_COMMAND_AFTER_BACKUP']="Command after backup";
$lang['L_COMMAND_BEFORE_BACKUP']="Command before backup";
$lang['L_COMMENT']="Kommentar";
$lang['L_COMPRESSED']="komprimeret (gz)";
$lang['L_CONFBASIC']="Basisparametre";
$lang['L_CONFIG']="Konfiguration";
$lang['L_CONFIGFILE']="Config File";
$lang['L_CONFIGFILES']="Configuration Files";
$lang['L_CONFIGURATIONS']="Configurations";
$lang['L_CONFIG_AUTODELETE']="Autoslet";
$lang['L_CONFIG_CRONPERL']="Crondump-indstillinger til Perl-script";
$lang['L_CONFIG_EMAIL']="Email-notifikation";
$lang['L_CONFIG_FTP']="FTP-overførsel af Backupfil";
$lang['L_CONFIG_HEADLINE']="Konfiguration";
$lang['L_CONFIG_INTERFACE']="Brugerflade";
$lang['L_CONFIG_LOADED']="Configuration \"%s\" has been imported"
    ." successfully.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Really delete the configuration file"
    ." %s?";
$lang['L_CONFIRM_DELETE_FILE']="Should the file '%s' really be"
    ." deleted?";
$lang['L_CONFIRM_DELETE_TABLES']="Really delete the selected tables?";
$lang['L_CONFIRM_DROP_DATABASES']="Should the selected databases really"
    ." be deleted?

Attention: all data will"
    ." be deleted! Maybe you should create a"
    ." backup first.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Should the recipient \"%s\" really be"
    ." deleted?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Should all tables of the selected"
    ." databases really be"
    ." deleted?

Attention: all data will be"
    ." deleted! Maybe you want to create a"
    ." backup first.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Really empty the selected tables?";
$lang['L_CONNECT']="forbind";
$lang['L_CONNECTIONPARS']="Forbindelsesparametre";
$lang['L_CONNECTTOMYSQL']="Forbind til MySQL";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continue Multipart-Restore with next"
    ." file '%s'.";
$lang['L_CONVERTED_FILES']="Converted Files";
$lang['L_CONVERTER']="Backupkonvertering";
$lang['L_CONVERTING']="Konverterer";
$lang['L_CONVERT_FILE']="Fil der skal konverteres";
$lang['L_CONVERT_FILENAME']="Navn på destinationsfilen (uden"
    ." filtype)";
$lang['L_CONVERT_FILEREAD']="Læs fil '%s'";
$lang['L_CONVERT_FINISHED']="Konvertering afsluttet, '%s' blev"
    ." skrevet korrekt.";
$lang['L_CONVERT_START']="Start konvertering";
$lang['L_CONVERT_TITLE']="Konvertér dump til MSD-format";
$lang['L_CONVERT_WRONG_PARAMETERS']="Forkerte parametre!  Konvertering er"
    ." ikke muligt.";
$lang['L_CREATE']="Opret";
$lang['L_CREATED']="Created";
$lang['L_CREATEDIRS']="Opret foldere";
$lang['L_CREATE_AUTOINDEX']="Opret Auto-Indeks";
$lang['L_CREATE_CONFIGFILE']="Create a new configuration file";
$lang['L_CREATE_DATABASE']="Opret ny database";
$lang['L_CREATE_TABLE_SAVED']="Definition of table `%s` saved.";
$lang['L_CREDITS']="Bidragydere / Hjælp";
$lang['L_CRONSCRIPT']="Cronscript";
$lang['L_CRON_COMMENT']="Indtast kommentar";
$lang['L_CRON_COMPLETELOG']="Log komplet output";
$lang['L_CRON_EXECPATH']="Sti til Perl scripts";
$lang['L_CRON_EXTENDER']="Filtype";
$lang['L_CRON_PRINTOUT']="Udskriv output til skærmen.";
$lang['L_CSVOPTIONS']="CSV-opsætning";
$lang['L_CSV_EOL']="Udskil linier med";
$lang['L_CSV_ERRORCREATETABLE']="Fejl ved oprettelse af tabel `%s` !";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="Felt-tælleren stemmer ikke overens"
    ." med de importerede data (%d i stedet"
    ." for %d).";
$lang['L_CSV_FIELDSENCLOSED']="Felter lukket inde i";
$lang['L_CSV_FIELDSEPERATE']="Felter adskilt med";
$lang['L_CSV_FIELDSESCAPE']="Felter escaped med";
$lang['L_CSV_FIELDSLINES']="%d felter genkendt, totalt %d linier";
$lang['L_CSV_FILEOPEN']="Åbn CSV-fil";
$lang['L_CSV_NAMEFIRSTLINE']="Feltnavne i første linie";
$lang['L_CSV_NODATA']="Ingen data fundet til import!";
$lang['L_CSV_NULL']="Erstat NULL med";
$lang['L_DATABASES_OF_USER']="Databases of user";
$lang['L_DATABASE_CREATED_FAILED']="The database wasn't created.
MySQL"
    ." returns:<br/>
%s";
$lang['L_DATABASE_CREATED_SUCCESS']="The database '%s' has been created"
    ." successfully.";
$lang['L_DATASIZE']="Size of data";
$lang['L_DATASIZE_INFO']="This is the size of the records - not"
    ." the size of the backup file";
$lang['L_DAY']="Day";
$lang['L_DAYS']="Days";
$lang['L_DB']="Database";
$lang['L_DBCONNECTION']="Databaseforbindelse";
$lang['L_DBPARAMETER']="Databaseparametre";
$lang['L_DBS']="Databaser";
$lang['L_DB_ADAPTER']="DB-Adapter";
$lang['L_DB_BACKUPPARS']="Database backupparametre";
$lang['L_DB_DEFAULT']="Default database";
$lang['L_DB_HOST']="Hostnavn";
$lang['L_DB_IN_LIST']="Databasen '%s' kunne ikke tilføjes da"
    ." den allerede findes.";
$lang['L_DB_NAME']="Databasenavn";
$lang['L_DB_PASS']="Kodeord";
$lang['L_DB_SELECT_ERROR']="<br />Fejl:<br />Valg af database <b>";
$lang['L_DB_SELECT_ERROR2']="</b> fejlede!";
$lang['L_DB_USER']="Bruger";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Default character set";
$lang['L_DEFAULT_CHARSET']="Default character set";
$lang['L_DEFAULT_COLLATION_NAME']="Default collation";
$lang['L_DELETE']="Slet";
$lang['L_DELETE_DATABASE']="Slet database";
$lang['L_DELETE_FILE_ERROR']="Error deleting file \"%s\"!";
$lang['L_DELETE_FILE_SUCCESS']="File \"%s\" was deleted successfully.";
$lang['L_DELETE_HTACCESS']="Fjern folderbeskyttelse (slet"
    ." .htaccess)";
$lang['L_DESCRIPTION']="Description";
$lang['L_DESELECT_ALL']="Fravælg alle";
$lang['L_DIR']="Folder";
$lang['L_DISABLEDFUNCTIONS']="Deaktiverede Funktioner";
$lang['L_DO']="Udfør";
$lang['L_DOCRONBUTTON']="Kør Perl Cron scriptet";
$lang['L_DONE']="Færdig!";
$lang['L_DONT_ATTACH_BACKUP']="Don't attach backup";
$lang['L_DOPERLTEST']="Test Perl-moduler";
$lang['L_DOSIMPLETEST']="Test Perl";
$lang['L_DOWNLOAD_FILE']="Download file";
$lang['L_DO_NOW']="gør det nu";
$lang['L_DUMP']="Backup";
$lang['L_DUMP_ENDERGEBNIS']="Filen indeholder <b>%s</b> tabeller"
    ." med <b>%s</b> poster.<br />";
$lang['L_DUMP_FILENAME']="Backup Fil";
$lang['L_DUMP_HEADLINE']="Lav backup...";
$lang['L_DUMP_NOTABLES']="Ingen tabeller fundet i database `%s`";
$lang['L_DUMP_OF_DB_FINISHED']="Dumping of database `%s` done";
$lang['L_DURATION']="Duration";
$lang['L_EDIT']="ret";
$lang['L_EHRESTORE_CONTINUE']="fortsæt og log fejl";
$lang['L_EHRESTORE_STOP']="stop";
$lang['L_EMAIL']="E-Mail";
$lang['L_EMAILBODY_ATTACH']="Den vedhæftede fil indeholder backup"
    ." af din MySQL-Database.<br />Backup af"
    ." Database `%s`
<br /><br />Følgende"
    ." fil blev oprettet:<br /><br />%s <br"
    ." /><br />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="En Multipart Backup er blevet"
    ." oprettet.<br />Backupfilerne er"
    ." vedhæftet separate emails.<br"
    ." />Backup af Database `%s`
<br /><br"
    ." />Følgende filer blev oprettet:<br"
    ." /><br />%s <br /><br />Med venlig"
    ." hilsen<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="En Multipart Backup blev oprettet.<br"
    ." />Backupfilerne er ikke vedhæftet"
    ." denne email!<br />Backup af Database"
    ." `%s`
<br /><br />Følgende filer blev"
    ." oprettet:<br /><br />%s
<br /><br"
    ." />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="Filer er ikke vedhæftet denne"
    ." email!<br />Backup af Database"
    ." `%s`
<br /><br />Følgende fil blev"
    ." oprettet:<br /><br />%s
<br /><br"
    ." />Venlig hilsen<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="Backupfilen oversteg"
    ." maksimumstørrelsen på %s og blev"
    ." ikke vedhæftet denne email.<br"
    ." />Backup sf Database `%s`
<br /><br"
    ." />Følgende fil blev oprettet:<br"
    ." /><br />%s
<br /><br />Venlig"
    ." hilsen<br /><br />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="E-Mail-Address";
$lang['L_EMAIL_CC']="CC-Receiver";
$lang['L_EMAIL_MAXSIZE']="Maksimumstørrelse på vedhæftede";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... kun vedhæftet.";
$lang['L_EMAIL_RECIPIENT']="Emailadresse";
$lang['L_EMAIL_SENDER']="Afsenderadresse på emailen";
$lang['L_EMAIL_START']="Starting to send e-mail";
$lang['L_EMAIL_WAS_SEND']="Email blev korrekt sendt til";
$lang['L_EMPTY']="Tøm";
$lang['L_EMPTYKEYS']="tøm og nulstil alle indeks";
$lang['L_EMPTYTABLEBEFORE']="Tøm tabel før";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Slet tabeller før genetablering";
$lang['L_ENCODING']="encoding";
$lang['L_ENCRYPTION_TYPE']="Krypteringsmetode";
$lang['L_ENGINE']="Engine";
$lang['L_ENTER_DB_INFO']="First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.";
$lang['L_ENTRY']="Indlæg";
$lang['L_ERROR']="Fejl";
$lang['L_ERRORHANDLING_RESTORE']="Fejlhandling under genetablering";
$lang['L_ERROR_CONFIGFILE_NAME']="Filename \"%s\" contains invalid"
    ." characters.";
$lang['L_ERROR_DELETING_CONFIGFILE']="Error: couldn't delete configuration"
    ." file %s!";
$lang['L_ERROR_LOADING_CONFIGFILE']="Couldn't load configfile \"%s\".";
$lang['L_ERROR_LOG']="Error Log";
$lang['L_ERROR_MULTIPART_RESTORE']="Multipart-Restore: couldn't finde the"
    ." next file '%s'!";
$lang['L_ESTIMATED_END']="Estimated end";
$lang['L_EXCEL2003']="Excel fra 2003";
$lang['L_EXISTS']="Exists";
$lang['L_EXPORT']="Eksport";
$lang['L_EXPORTFINISHED']="Eksport færdiggjort.";
$lang['L_EXPORTLINES']="<strong>%s</strong> linier eksporteret";
$lang['L_EXPORTOPTIONS']="Eksport-opsætning";
$lang['L_EXTENDEDPARS']="Udvidede parametre";
$lang['L_FADE_IN_OUT']="Visning til/fra";
$lang['L_FATAL_ERROR_DUMP']="Fatal error: the CREATE-Statement of"
    ." table '%s' in database '%s' couldn't"
    ." be read!";
$lang['L_FIELDS']="Felter";
$lang['L_FIELDS_OF_TABLE']="Fields of table";
$lang['L_FILE']="Fil";
$lang['L_FILES']="Files";
$lang['L_FILESIZE']="Filstørrelse";
$lang['L_FILE_MANAGE']="Fil Administration";
$lang['L_FILE_OPEN_ERROR']="Fejl: kunne ikke åbne fil.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="The file has been saved successfully.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="The file couldn't be saved!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="The file '%s' was uploaded"
    ." successfully.";
$lang['L_FILTER_BY']="Filter by";
$lang['L_FM_ALERTRESTORE1']="Skal databasen";
$lang['L_FM_ALERTRESTORE2']="genetableres med posterne fra filen";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="Alle backups";
$lang['L_FM_ANZ_BU']="Backups";
$lang['L_FM_ASKDELETE1']="Skal filen";
$lang['L_FM_ASKDELETE2']="virkelig slettes?";
$lang['L_FM_ASKDELETE3']="Vil du køre autoslet med de"
    ." konfigurerede regler nu?";
$lang['L_FM_ASKDELETE4']="Vil du slette alle backupfiler?";
$lang['L_FM_ASKDELETE5']="Vil du slette alle backupfiler med";
$lang['L_FM_ASKDELETE5_2']="* ?";
$lang['L_FM_AUTODEL1']="Autoslet: følgende filer blev slettet"
    ." grundet maksimalt antal"
    ." filer-indstillingen:";
$lang['L_FM_CHOOSE_ENCODING']="Choose encoding of backup file";
$lang['L_FM_COMMENT']="Indtast kommentar";
$lang['L_FM_DELETE']="Slet";
$lang['L_FM_DELETE1']="Filen";
$lang['L_FM_DELETE2']="blev slettet korrekt.";
$lang['L_FM_DELETE3']="kunne ikke slettes!";
$lang['L_FM_DELETEALL']="Slette alle backupfiler";
$lang['L_FM_DELETEALLFILTER']="Slet alle med";
$lang['L_FM_DELETEAUTO']="Kør autoslet manuelt";
$lang['L_FM_DUMPSETTINGS']="Konfiguration for Perl Cron scriptet";
$lang['L_FM_DUMP_HEADER']="Backup";
$lang['L_FM_FILEDATE']="Fildato";
$lang['L_FM_FILES1']="Databasebackups";
$lang['L_FM_FILESIZE']="Filstørrelse";
$lang['L_FM_FILEUPLOAD']="Upload fil";
$lang['L_FM_FREESPACE']="Fri plads på Server";
$lang['L_FM_LAST_BU']="Seneste backup";
$lang['L_FM_NOFILE']="Du valgte ikke en fil!";
$lang['L_FM_NOFILESFOUND']="Ingen fil fundet.";
$lang['L_FM_RECORDS']="Poster";
$lang['L_FM_RESTORE']="Genetabler";
$lang['L_FM_RESTORE_HEADER']="Genetablering af Database"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Vælg tabeller";
$lang['L_FM_STARTDUMP']="Start ny backup";
$lang['L_FM_TABLES']="Tabeller";
$lang['L_FM_TOTALSIZE']="Total størrelse";
$lang['L_FM_UPLOADFAILED']="Upload slog fejl!";
$lang['L_FM_UPLOADFILEEXISTS']="Der findes allerede en fil med samme"
    ." navn!";
$lang['L_FM_UPLOADFILEREQUEST']="vælg venligst en fil.";
$lang['L_FM_UPLOADMOVEERROR']="Kunne ikke flytte valgte fil til"
    ." upload folderen.";
$lang['L_FM_UPLOADNOTALLOWED1']="Denne filtype understøttes ikke.";
$lang['L_FM_UPLOADNOTALLOWED2']="Gyldige typer er: *.gz og *.sql-filer";
$lang['L_FOUND_DB']="fundet db:";
$lang['L_FROMFILE']="fra fil";
$lang['L_FROMTEXTBOX']="fra tekstboks";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Add connection";
$lang['L_FTP_CHOOSE_MODE']="FTP-overførselstilstand";
$lang['L_FTP_CONFIRM_DELETE']="Should this FTP-Connection really be"
    ." deleted?";
$lang['L_FTP_CONNECTION']="FTP-Connection";
$lang['L_FTP_CONNECTION_CLOSED']="FTP-Connection closed";
$lang['L_FTP_CONNECTION_DELETE']="Delete connection";
$lang['L_FTP_CONNECTION_ERROR']="The connection to server '%s' using"
    ." port %s couldn't be established";
$lang['L_FTP_CONNECTION_SUCCESS']="The connection to server '%s' using"
    ." port %s was established successfully";
$lang['L_FTP_DIR']="Upload-folder";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Transfer of file '%s' was faulty";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="The file '%s' was transferred"
    ." successfully";
$lang['L_FTP_LOGIN_ERROR']="Login as user '%s' was denied";
$lang['L_FTP_LOGIN_SUCCESS']="Login as user '%s' was successfull";
$lang['L_FTP_OK']="Forbindelse etableret.";
$lang['L_FTP_PASS']="Kodeord";
$lang['L_FTP_PASSIVE']="brug passiv-tilstand";
$lang['L_FTP_PASV_ERROR']="Switching to passive mode was"
    ." unsuccessful";
$lang['L_FTP_PASV_SUCCESS']="Switching to passive mode was"
    ." successfull";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="to <strong>%s</strong><br /> into"
    ." <strong>%s</strong>";
$lang['L_FTP_SERVER']="Server";
$lang['L_FTP_SSL']="Sikker SSL FTP-forbindelse";
$lang['L_FTP_START']="Starting FTP transfer";
$lang['L_FTP_TIMEOUT']="Forbindelses Timeout";
$lang['L_FTP_TRANSFER']="FTP-overførsel";
$lang['L_FTP_USER']="Bruger";
$lang['L_FTP_USESSL']="brug SSL-forbindelse";
$lang['L_GENERAL']="Generelt";
$lang['L_GZIP']="GZip-komprimering";
$lang['L_GZIP_COMPRESSION']="GZip-komprimering";
$lang['L_HOME']="Hjem";
$lang['L_HOUR']="Hour";
$lang['L_HOURS']="Hours";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Aktivér rewrite";
$lang['L_HTACC_ADD_HANDLER']="Tilføj handler";
$lang['L_HTACC_CONFIRM_DELETE']="Skal folderbeskyttelsen gemmes nu?";
$lang['L_HTACC_CONTENT']="Indhold af fil";
$lang['L_HTACC_CREATE']="Opret folderbeskyttelse";
$lang['L_HTACC_CREATED']="Folderbeskyttelsen blev oprettet.";
$lang['L_HTACC_CREATE_ERROR']="Der opstod en fejl ved oprettelse af"
    ." folderbeskyttelsen!<br />Opret"
    ." venligst de 2 filer manuelt med"
    ." følgende indhold";
$lang['L_HTACC_CRYPT']="Crypt (Linux og Unix-systemer)";
$lang['L_HTACC_DENY_ALLOW']="Deny / Allow";
$lang['L_HTACC_DIR_LISTING']="Folder-indholdslistning";
$lang['L_HTACC_EDIT']="Rediger .htaccess";
$lang['L_HTACC_ERROR_DOC']="Fejl-dokument";
$lang['L_HTACC_EXAMPLES']="Flere eksempler og dokumentation";
$lang['L_HTACC_EXISTS']="Der findes allerede en"
    ." folderbeskyttelse. Hvis du opretter en"
    ." ny, vil den tidligere blive"
    ." overskrevet!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Lav til eksekverbar";
$lang['L_HTACC_MD5']="MD5 (Linux og Unix-systemer)";
$lang['L_HTACC_NO_ENCRYPTION']="plain text, ingen kryptering (Windows)";
$lang['L_HTACC_NO_USERNAME']="Du skal indtaste et navn!";
$lang['L_HTACC_PROPOSED']="Stærkt anbefalet";
$lang['L_HTACC_REDIRECT']="Redirect";
$lang['L_HTACC_SCRIPT_EXEC']="Udfør script";
$lang['L_HTACC_SHA1']="SHA1 (all Systems)";
$lang['L_HTACC_WARNING']="Bemærk! .htaccess påvirker dirkte"
    ." browserens opførsel.<br />Med forkert"
    ." indhold kan disse sider blive"
    ." utilgængelige.";
$lang['L_IMPORT']="Import";
$lang['L_IMPORTIEREN']="Import";
$lang['L_IMPORTOPTIONS']="Import-opsætning";
$lang['L_IMPORTSOURCE']="Import-kilde";
$lang['L_IMPORTTABLE']="Import i Tabel";
$lang['L_IMPORT_NOTABLE']="Ingen tabel valgt til import!";
$lang['L_IN']="i";
$lang['L_INDEX_SIZE']="Size of index";
$lang['L_INFO_ACTDB']="Aktuel Database";
$lang['L_INFO_DATABASES']="Følgende database(r) er tilgængelige"
    ." på din server";
$lang['L_INFO_DBEMPTY']="Databasen er tom !";
$lang['L_INFO_FSOCKOPEN_DISABLED']="On this server the PHP command"
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
    ." site.";
$lang['L_INFO_LASTUPDATE']="Sidst opdateret";
$lang['L_INFO_LOCATION']="Din lokation er";
$lang['L_INFO_NODB']="database findes ikke.";
$lang['L_INFO_NOPROCESSES']="ingen kørende processer";
$lang['L_INFO_NOSTATUS']="ingen tilstand tilgængelig";
$lang['L_INFO_NOVARS']="ingen variabler tilgængelige";
$lang['L_INFO_OPTIMIZED']="optimeret";
$lang['L_INFO_RECORDS']="Poster";
$lang['L_INFO_SIZE']="Størrelse";
$lang['L_INFO_SUM']="Total";
$lang['L_INSTALL']="Installation";
$lang['L_INSTALLED']="Installed";
$lang['L_INSTALL_DB_DEFAULT']="Use as default database";
$lang['L_INSTALL_HELP_PORT']="(tom = Standardport)";
$lang['L_INSTALL_HELP_SOCKET']="(tom = Standard Socket)";
$lang['L_IS_WRITABLE']="Is writable";
$lang['L_KILL_PROCESS']="Stop process";
$lang['L_LANGUAGE']="Sprog";
$lang['L_LANGUAGE_NAME']="Dansk";
$lang['L_LASTBACKUP']="Seneste Backup";
$lang['L_LOAD']="Indlæs standard-indstillinger";
$lang['L_LOAD_DATABASE']="Genindlæs databaser";
$lang['L_LOAD_FILE']="Load file";
$lang['L_LOG']="Log";
$lang['L_LOGFILENOTWRITABLE']="Kan ikke skrive Logfil !";
$lang['L_LOGFILES']="Logfiles";
$lang['L_LOGGED_IN']="Logged in";
$lang['L_LOGIN']="Login";
$lang['L_LOGIN_AUTOLOGIN']="Automatic login";
$lang['L_LOGIN_INVALID_USER']="Unknown combination of username and"
    ." password.";
$lang['L_LOGOUT']="Log out";
$lang['L_LOG_CREATED']="Log file created.";
$lang['L_LOG_DELETE']="slet Log";
$lang['L_LOG_MAXSIZE']="Maximum size of log files";
$lang['L_LOG_NOT_READABLE']="The log file '%s' does not exist or is"
    ." not readable.";
$lang['L_MAILERROR']="Afsendelse af email slog fejl!";
$lang['L_MAILPROGRAM']="Mailprogram";
$lang['L_MAXIMUM_LENGTH']="Maximum length";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="This is the maximum number of bytes"
    ." one character needs, when it is saved"
    ." to disk.";
$lang['L_MAXSIZE']="maks. størrelse";
$lang['L_MAX_BACKUP_FILES_EACH2']="For hver database";
$lang['L_MAX_EXECUTION_TIME']="Max execution time";
$lang['L_MAX_UPLOAD_SIZE']="Maksimal filstørrelse";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Hvis din Dumpfil er større end den"
    ." ovennævnte grænse, skal du uploade"
    ." den via FTP til folderen"
    ." \"work/backup\". 
Derefter kan du"
    ." vælge den og begynde"
    ." genetableringsprocessen.";
$lang['L_MEMORY']="Memory";
$lang['L_MENU_HIDE']="Hide menu";
$lang['L_MENU_SHOW']="Show menu";
$lang['L_MESSAGE']="Message";
$lang['L_MESSAGE_TYPE']="Message type";
$lang['L_MINUTE']="Minute";
$lang['L_MINUTES']="Minutes";
$lang['L_MOBILE_OFF']="Off";
$lang['L_MOBILE_ON']="On";
$lang['L_MODE_EASY']="Easy";
$lang['L_MODE_EXPERT']="Expert";
$lang['L_MSD_INFO']="MySQLDumper-Information";
$lang['L_MSD_MODE']="MySQLDumper-Mode";
$lang['L_MSD_VERSION']="MySQLDumper-Version";
$lang['L_MULTIDUMP']="Multidump";
$lang['L_MULTIDUMP_FINISHED']="Backup af <b>%d</b> Databaser færdige";
$lang['L_MULTIPART_ACTUAL_PART']="Actual Part";
$lang['L_MULTIPART_SIZE']="maksimum Filstørrelse";
$lang['L_MULTI_PART']="Multipart Backup";
$lang['L_MYSQLVARS']="MySQL Variabler";
$lang['L_MYSQL_CLIENT_VERSION']="MySQL-Client";
$lang['L_MYSQL_CONNECTION_ENCODING']="Standard encoding of MySQL-Server";
$lang['L_MYSQL_DATA']="MySQL-Data";
$lang['L_MYSQL_ROUTINE']="Routine";
$lang['L_MYSQL_ROUTINES']="Routinen";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Stored functions and procedures";
$lang['L_MYSQL_TABLES_EXPLAIN']="Tables have a defined column structure"
    ." in which one can save data (records)."
    ." Each record represents a row in the"
    ." table.";
$lang['L_MYSQL_VERSION']="MySQL-Version";
$lang['L_MYSQL_VERSION_TOO_OLD']="We are sorry: the installed"
    ." MySQL-Version %s is too old and can"
    ." not be used together with this version"
    ." of MySQLDumper. Please update your"
    ." MySQL-Version to at least version"
    ." %s.
As an alternative you could"
    ." install MySQLDumper version 1.24,"
    ." which is able to work together with"
    ." older MySQL-Versions. But you will"
    ." lose some of the new functions of"
    ." MySQLDumper in that case.";
$lang['L_MYSQL_VIEW']="View";
$lang['L_MYSQL_VIEWS']="Views";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Views show (filtered) recordsets of"
    ." one ore more tables but don't contain"
    ." own records.";
$lang['L_NAME']="Name";
$lang['L_NEW']="ny";
$lang['L_NEWTABLE']="Ny tabel";
$lang['L_NEXT_AUTO_INCREMENT']="Next automatic index";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="Autoindex";
$lang['L_NO']="nej";
$lang['L_NOFTPPOSSIBLE']="Du har ingen FTP-funktioner til"
    ." rådighed!";
$lang['L_NOGZPOSSIBLE']="Da Zlib ikke er"
    ." installeret/tilgængeligt, kan du ikke"
    ." bruge GZip-funktionerne!";
$lang['L_NONE']="ingen";
$lang['L_NOREVERSE']="Ældste indlæg først";
$lang['L_NOTAVAIL']="<em>ikke tilgængelig</em>";
$lang['L_NOTHING_TO_DO']="There is nothing to do.";
$lang['L_NOTICE']="Notice";
$lang['L_NOTICES']="Bemærkninger";
$lang['L_NOT_ACTIVATED']="ikke aktiveret";
$lang['L_NOT_SUPPORTED']="Denne backup understøtter ikke denne"
    ." funktion.";
$lang['L_NO_DB_FOUND']="kunne ikke automatisk finde nogen"
    ." database! Åbn forbindelsesparametrene"
    ." og indtast manuelt navnet på"
    ." databasen.";
$lang['L_NO_DB_FOUND_INFO']="Forbindelsen til databasen blev"
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
    ." indtast databasenavnet dér.";
$lang['L_NO_DB_SELECTED']="No database selected.";
$lang['L_NO_ENTRIES']="Tabel \"<b>%s</b>\" er tom og"
    ." indeholder ingen poster.";
$lang['L_NO_MSD_BACKUPFILE']="Backups af andre scripts";
$lang['L_NO_NAME_GIVEN']="You didn't enter a name.";
$lang['L_NR_OF_RECORDS']="Number of records";
$lang['L_NR_TABLES_OPTIMIZED']="%s tabeller er blevet optimeret.";
$lang['L_NUMBER_OF_FILES_FORM']="Slet ud fra antal filer";
$lang['L_OF']="af";
$lang['L_OK']="OK";
$lang['L_OPTIMIZE']="Optimér";
$lang['L_OPTIMIZE_TABLES']="Optimér tabeller før backup";
$lang['L_OPTIMIZE_TABLE_ERR']="Error optimizing table `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Optimized table `%s` successfully.";
$lang['L_OS']="Operating system";
$lang['L_OVERHEAD']="Overhead";
$lang['L_PAGE']="Page";
$lang['L_PAGE_REFRESHS']="Pageviews";
$lang['L_PASS']="Kodeord";
$lang['L_PASSWORD']="Password";
$lang['L_PASSWORDS_UNEQUAL']="Kodeordene er ikke identiske eller"
    ." tomme!";
$lang['L_PASSWORD_REPEAT']="Password (repeat)";
$lang['L_PASSWORD_STRENGTH']="Password strength";
$lang['L_PERLOUTPUT1']="Linie i crondump.pl for"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="URL for browseren eller for eksternt"
    ." Cron job";
$lang['L_PERLOUTPUT3']="Kommandolinie i Shell eller for"
    ." Crontab";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-Log";
$lang['L_PERL_LOG']="Perl-Log";
$lang['L_PHPBUG']="Fejl i zlib ! Ingen komprimering"
    ." mulig!";
$lang['L_PHPMAIL']="PHP-Function mail()";
$lang['L_PHP_EXTENSIONS']="PHP-Extensions";
$lang['L_PHP_LOG']="PHP-Log";
$lang['L_PHP_VERSION']="PHP-Version";
$lang['L_PHP_VERSION_TOO_OLD']="We are sorry: the installed"
    ." PHP-Version is too old. MySQLDumper"
    ." needs a PHP-Version of %s or higher."
    ." This server has a PHP-Version of %s"
    ." which is too old. You need to update"
    ." your PHP-Version before you can"
    ." install and use MySQLDumper.";
$lang['L_POP3_PORT']="POP3-Port";
$lang['L_POP3_SERVER']="POP3-Server";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="bottom center";
$lang['L_POSITION_BL']="bottom left";
$lang['L_POSITION_BR']="bottom right";
$lang['L_POSITION_MC']="center center";
$lang['L_POSITION_ML']="middle left";
$lang['L_POSITION_MR']="middle right";
$lang['L_POSITION_NOTIFICATIONS']="Position of notification window";
$lang['L_POSITION_TC']="top center";
$lang['L_POSITION_TL']="top left";
$lang['L_POSITION_TR']="top right";
$lang['L_POSSIBLE_COLLATIONS']="Possible collations";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="These are the possible collations one"
    ." can choose for this character"
    ." set.

_cs = case sensitiv
_ci = case"
    ." insensitive";
$lang['L_PREFIX']="Præfiks";
$lang['L_PRIMARYKEYS_CHANGED']="Primary keys changed";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Error changing primary keys";
$lang['L_PRIMARYKEYS_SAVE']="Save primary keys";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Really delete primary key?";
$lang['L_PRIMARYKEY_DELETED']="Primary key deleted";
$lang['L_PRIMARYKEY_FIELD']="Primary key field";
$lang['L_PRIMARYKEY_NOTFOUND']="Primary key not found";
$lang['L_PROCESSKILL1']="Scriptet forsøger at dræbe proces";
$lang['L_PROCESSKILL2']="at dræbe.";
$lang['L_PROCESSKILL3']="Scriptet har forsøgt i";
$lang['L_PROCESSKILL4']="sek. at dræbe processen";
$lang['L_PROCESS_ID']="Process ID";
$lang['L_PROGRESS_FILE']="Progress file";
$lang['L_PROGRESS_OVER_ALL']="Samlet fremskridt";
$lang['L_PROGRESS_TABLE']="Fremskridt i tabel";
$lang['L_PROVIDER']="Leverandør";
$lang['L_PROZESSE']="Processer";
$lang['L_QUERY']="Query";
$lang['L_RECHTE']="Tilladelser";
$lang['L_RECORDS']="Poster";
$lang['L_RECORDS_INSERTED']="<b>%s</b> poster indsat.";
$lang['L_RECORDS_OF_TABLE']="Records of table";
$lang['L_RECORDS_PER_PAGECALL']="Records per pagecall";
$lang['L_REFRESHTIME']="Refresh time";
$lang['L_REFRESHTIME_PROCESSLIST']="Refreshing time of the process list";
$lang['L_REGISTRATION_DESCRIPTION']="Please enter the administrator account"
    ." now. You will login into MySQLDumper"
    ." with this user. Note the dates now"
    ." given good reason.

You can choose"
    ." your username and password free."
    ." Please make sure to choose the safest"
    ." possible combination of user name and"
    ." password to protect access to"
    ." MySQLDumper against unauthorized"
    ." access best!";
$lang['L_RELOAD']="Genindlæs";
$lang['L_REMOVE']="Remove";
$lang['L_REPAIR']="Repair";
$lang['L_RESET']="Nulstil";
$lang['L_RESET_SEARCHWORDS']="nulstil søgeord";
$lang['L_RESTORE']="Genetabler";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> tabeller oprettet.";
$lang['L_RESTORE_DB']="Database '<b>%s</b>' på '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Restoring of database '%s' finished in"
    ." %s.";
$lang['L_RESTORE_OF_TABLES']="Choose tables to be restored";
$lang['L_RESTORE_TABLE']="Restoring of table '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Foreløbigt er der oprettet <b>%d</b>"
    ." af <b>%d</b> tabeller.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Foreløbigt er der oprettet <b>%d</b>"
    ." tabeller.";
$lang['L_REVERSE']="Seneste indlæg først";
$lang['L_SAFEMODEDESC']="Because PHP is running in safe_mode"
    ." you need to create the following"
    ." directories manually using your"
    ." FTP-Programm:";
$lang['L_SAVE']="Gem";
$lang['L_SAVEANDCONTINUE']="Gem og fortsæt installation";
$lang['L_SAVE_ERROR']="Fejl - kunne ikke gemme konfiguration!";
$lang['L_SAVE_SUCCESS']="Configuration was saved succesfully"
    ." into configuration file \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Saving data of database '%s' to file"
    ." '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximum filesize reached: proceeding"
    ." with file '%s'";
$lang['L_SAVING_DB_FORM']="Database";
$lang['L_SAVING_TABLE']="Gemmer tabel";
$lang['L_SEARCH_ACCESS_KEYS']="Bladre: fremad=ALT+V, baglæns=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Søg i tabel";
$lang['L_SEARCH_NO_RESULTS']="Søgningen efter \"<b>%s</b>\" i tabel"
    ." \"<b>%s</b>\" gav ingen rsultater!";
$lang['L_SEARCH_OPTIONS']="Søgeindstillinger";
$lang['L_SEARCH_OPTIONS_AND']="en kolonne skal indeholde ALLE"
    ." søgeord (OG-søgning)";
$lang['L_SEARCH_OPTIONS_CONCAT']="en række skal indeholde alle"
    ." søgeordene men kan være i"
    ." hvilkensomhelst kolonne (kan tage"
    ." noget tid)";
$lang['L_SEARCH_OPTIONS_OR']="en kolonne skal indeholde et af"
    ." søgeordene (ELLER-søgning)";
$lang['L_SEARCH_RESULTS']="Søgningen efter \"<b>%s</b>\" i"
    ." tabellen \"<b>%s</b>\" giver følgende"
    ." resultater";
$lang['L_SECOND']="Second";
$lang['L_SECONDS']="Seconds";
$lang['L_SELECT']="Select";
$lang['L_SELECTED_FILE']="Valgt fil";
$lang['L_SELECT_ALL']="Vælg alle";
$lang['L_SELECT_FILE']="Select file";
$lang['L_SELECT_LANGUAGE']="Select language";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="send resultat som fil";
$lang['L_SEND_MAIL_FORM']="Send email rapport";
$lang['L_SERVER']="Server";
$lang['L_SERVERCAPTION']="Vis Server";
$lang['L_SETPRIMARYKEYSFOR']="Set new primary keys for table";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Showing entry %s to %s of %s";
$lang['L_SHOWRESULT']="vis resultat";
$lang['L_SHOW_TABLES']="Show tables";
$lang['L_SHOW_TOOLTIPS']="Show nicer tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-Host";
$lang['L_SMTP_PORT']="SMTP-Port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Speed";
$lang['L_SQLBOX']="SQL-Box";
$lang['L_SQLBOXHEIGHT']="Højde på SQL-Boks";
$lang['L_SQLLIB_ACTIVATEBOARD']="aktiver Board";
$lang['L_SQLLIB_BOARDS']="Boards";
$lang['L_SQLLIB_DEACTIVATEBOARD']="deaktiver Board";
$lang['L_SQLLIB_GENERALFUNCTIONS']="generelle funktioner";
$lang['L_SQLLIB_RESETAUTO']="nulstil auto-increment (forøgelse)";
$lang['L_SQLLIMIT']="Antal poster pr. side";
$lang['L_SQL_ACTIONS']="Handlinger";
$lang['L_SQL_AFTER']="efter";
$lang['L_SQL_ALLOWDUPS']="Dubletter tilladte";
$lang['L_SQL_ATPOSITION']="indsæt på position";
$lang['L_SQL_ATTRIBUTES']="Attributter";
$lang['L_SQL_BACKDBOVERVIEW']="Tilbage til Oversigt";
$lang['L_SQL_BEFEHLNEU']="Ny kommando";
$lang['L_SQL_BEFEHLSAVED1']="SQL-kommando";
$lang['L_SQL_BEFEHLSAVED2']="blev tilføjet";
$lang['L_SQL_BEFEHLSAVED3']="blev gemt";
$lang['L_SQL_BEFEHLSAVED4']="blev flyttet op";
$lang['L_SQL_BEFEHLSAVED5']="blev slettet";
$lang['L_SQL_BROWSER']="SQL-Browser";
$lang['L_SQL_CARDINALITY']="Kardinalitet";
$lang['L_SQL_CHANGED']="blev ændret.";
$lang['L_SQL_CHANGEFIELD']="ændre felt";
$lang['L_SQL_CHOOSEACTION']="Vælg handling";
$lang['L_SQL_COLLATENOTMATCH']="Tegnsæt og Kollation passer ikke"
    ." sammen!";
$lang['L_SQL_COLUMNS']="Kolonner";
$lang['L_SQL_COMMANDS']="SQL-kommandoer";
$lang['L_SQL_COMMANDS_IN']="linier i";
$lang['L_SQL_COMMANDS_IN2']="sek. bearbejdet.";
$lang['L_SQL_COPYDATADB']="Kopier hele databasen til";
$lang['L_SQL_COPYSDB']="Kopier database-struktur";
$lang['L_SQL_COPYTABLE']="kopier tabel";
$lang['L_SQL_CREATED']="blev oprettet.";
$lang['L_SQL_CREATEINDEX']="opret nyt indeks";
$lang['L_SQL_CREATETABLE']="opret tabel";
$lang['L_SQL_DATAVIEW']="Data Visning";
$lang['L_SQL_DBCOPY']="Indholdet af database `%s` blev"
    ." kopieret til database `%s`.";
$lang['L_SQL_DBSCOPY']="Database-strukturen fra database `%s`"
    ." blev kopieret til database `%s`.";
$lang['L_SQL_DELETED']="blev slettet";
$lang['L_SQL_DESTTABLE_EXISTS']="Destinationstabel findes allerede!";
$lang['L_SQL_EDIT']="ret";
$lang['L_SQL_EDITFIELD']="Ret felt";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Edit table structure";
$lang['L_SQL_EMPTYDB']="Tøm database";
$lang['L_SQL_ERROR1']="Fejl i forespørgsel:";
$lang['L_SQL_ERROR2']="MySQL siger:";
$lang['L_SQL_EXEC']="Udfør SQL-sætning";
$lang['L_SQL_EXPORT']="Eksport fra Database `%s`";
$lang['L_SQL_FIELDDELETE1']="Feltet";
$lang['L_SQL_FIELDNAMENOTVALID']="Fejl: Ikke gyldigt feltnavn";
$lang['L_SQL_FIRST']="først";
$lang['L_SQL_IMEXPORT']="Import-Eksport";
$lang['L_SQL_IMPORT']="Import i Database `%s`";
$lang['L_SQL_INDEXES']="Indeks";
$lang['L_SQL_INSERTFIELD']="indsæt felt";
$lang['L_SQL_INSERTNEWFIELD']="indsæt nyt felt";
$lang['L_SQL_LIBRARY']="SQL-bibliotek";
$lang['L_SQL_NAMEDEST_MISSING']="Destinationsnavn mangler!";
$lang['L_SQL_NEWFIELD']="Nyt felt";
$lang['L_SQL_NODATA']="ingen poster";
$lang['L_SQL_NODEST_COPY']="Ingen kopiering uden en destination!";
$lang['L_SQL_NOFIELDDELETE']="Slet er ikke muligt da tabeller skal"
    ." indeholde mindst et felt.";
$lang['L_SQL_NOTABLESINDB']="Ingen tabeller fundet i Database";
$lang['L_SQL_NOTABLESSELECTED']="Ingen tabeller valgt!";
$lang['L_SQL_OPENFILE']="Åbn SQL-fil";
$lang['L_SQL_OPENFILE_BUTTON']="Upload";
$lang['L_SQL_OUT1']="Udført";
$lang['L_SQL_OUT2']="Kommandoer";
$lang['L_SQL_OUT3']="Den havde";
$lang['L_SQL_OUT4']="Kommentarer";
$lang['L_SQL_OUT5']="Da outputtet indeholder mere end 5000"
    ." linier vises det ikke.";
$lang['L_SQL_OUTPUT']="SQL-Output";
$lang['L_SQL_QUERYENTRY']="Forespørgslen indeholder";
$lang['L_SQL_RECORDDELETED']="Post blev slettet";
$lang['L_SQL_RECORDEDIT']="rediger post";
$lang['L_SQL_RECORDINSERTED']="Post blev tilføjet";
$lang['L_SQL_RECORDNEW']="ny post";
$lang['L_SQL_RECORDUPDATED']="Post blev opdateret";
$lang['L_SQL_RENAMEDB']="Omdøb database";
$lang['L_SQL_RENAMEDTO']="blev omdøbt til";
$lang['L_SQL_SCOPY']="Tabelstrukturen fra `%s` blev kopieret"
    ." ind i Tabel `%s`.";
$lang['L_SQL_SEARCH']="Søg";
$lang['L_SQL_SEARCHWORDS']="Søgeord";
$lang['L_SQL_SELECTTABLE']="vælg tabel";
$lang['L_SQL_SERVER']="SQL-Server";
$lang['L_SQL_SHOWDATATABLE']="Vis Data i Tabel";
$lang['L_SQL_STRUCTUREDATA']="Struktur og Data";
$lang['L_SQL_STRUCTUREONLY']="Kun Struktur";
$lang['L_SQL_TABLEEMPTIED']="Tabel `%s` blev tømt.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="Tabel `%s` blev tømt og indeksene"
    ." blev nulstillet.";
$lang['L_SQL_TABLEINDEXES']="Indeks på tabel";
$lang['L_SQL_TABLENEW']="Ret Tabeller";
$lang['L_SQL_TABLENOINDEXES']="Ingen indeks i tabel";
$lang['L_SQL_TABLENONAME']="Tabellen skal have et navn!";
$lang['L_SQL_TABLESOFDB']="Tabeller i Database";
$lang['L_SQL_TABLEVIEW']="Tabel-visning";
$lang['L_SQL_TBLNAMEEMPTY']="Tabelnavnet kan ikke være tomt!";
$lang['L_SQL_TBLPROPSOF']="Tabelegenskaber for";
$lang['L_SQL_TCOPY']="Tabel `%s` blev kopieret med data ind"
    ." i Tabel `%s`.";
$lang['L_SQL_UPLOADEDFILE']="indlæst fil:";
$lang['L_SQL_VIEW_COMPACT']="View: compact";
$lang['L_SQL_VIEW_STANDARD']="View: standard";
$lang['L_SQL_VONINS']="fra totalt";
$lang['L_SQL_WARNING']="Udførelse af SQL-sætninger kan"
    ." manipulere data. PAS PÅ! Forfatterne"
    ." af dette system påtager sig intet"
    ." ansvar for beskadigede eller tabte"
    ." data.";
$lang['L_SQL_WASCREATED']="blev oprettet";
$lang['L_SQL_WASEMPTIED']="blev tømt";
$lang['L_STARTDUMP']="Start Backup";
$lang['L_START_RESTORE_DB_FILE']="Starting restore of database '%s' from"
    ." file '%s'.";
$lang['L_START_SQL_SEARCH']="Start søgning";
$lang['L_STATUS']="Tilstand";
$lang['L_STEP']="Trin";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="Configuration file \"%s\" has"
    ." successfully been created.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="The configuration file \"%s\" has"
    ." successfully been deleted.";
$lang['L_TABLE']="Tabel";
$lang['L_TABLENAME']="Table name";
$lang['L_TABLENAME_EXPLAIN']="Table name";
$lang['L_TABLES']="Tabeller";
$lang['L_TABLESELECTION']="Tabelvælg";
$lang['L_TABLE_CREATE_SUCC']="The table '%s' has been created"
    ." successfully.";
$lang['L_TABLE_TYPE']="Table Type";
$lang['L_TESTCONNECTION']="Test forbindelse";
$lang['L_THEME']="Theme";
$lang['L_TIME']="Time";
$lang['L_TIMESTAMP']="Timestamp";
$lang['L_TITLE_INDEX']="Index";
$lang['L_TITLE_KEY_FULLTEXT']="Fulltext key";
$lang['L_TITLE_KEY_PRIMARY']="Primary key";
$lang['L_TITLE_KEY_UNIQUE']="Unique key";
$lang['L_TITLE_MYSQL_HELP']="MySQL documentation";
$lang['L_TITLE_NOKEY']="No key";
$lang['L_TITLE_SEARCH']="Search";
$lang['L_TITLE_SHOW_DATA']="Show data";
$lang['L_TITLE_UPLOAD']="Upload SQL file";
$lang['L_TO']="til";
$lang['L_TOOLS']="Funktioner";
$lang['L_TOOLS_TOOLBOX']="Vælg Database / Datebasefunktioner /"
    ." Import - Eksport";
$lang['L_TRUNCATE']="Truncate";
$lang['L_TRUNCATE_DATABASE']="Truncate database";
$lang['L_UNIT_KB']="KiloByte";
$lang['L_UNIT_MB']="MegaByte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="ukendt";
$lang['L_UNKNOWN_SQLCOMMAND']="ukendt SQL-kommando";
$lang['L_UPDATE']="Update";
$lang['L_UPDATE_CONNECTION_FAILED']="Update failed because connection to"
    ." server '%s' could not be established.";
$lang['L_UPDATE_ERROR_RESPONSE']="Update failed, server returned: '%s'";
$lang['L_UPTO']="op til";
$lang['L_USERNAME']="Username";
$lang['L_USE_SSL']="Use SSL";
$lang['L_VALUE']="Værdi";
$lang['L_VERSIONSINFORMATIONEN']="Versionsinformation";
$lang['L_VIEW']="vis";
$lang['L_VISIT_HOMEPAGE']="Visit Homepage";
$lang['L_VOM']="fra";
$lang['L_WITH']="med";
$lang['L_WITHATTACH']="med vedhæftede";
$lang['L_WITHOUTATTACH']="uden vedhæftede";
$lang['L_WITHPRAEFIX']="med præfiks";
$lang['L_WRONGCONNECTIONPARS']="Forkerte eller manglende"
    ." forbindelsesparametre!";
$lang['L_WRONG_CONNECTIONPARS']="Forbindelsesparametre er forkerte!";
$lang['L_WRONG_RIGHTS']="Kan ikke skrive til filen eller"
    ." folderen '%s'.<br /> Fil-rettighederne"
    ." (chmod) er ikke sat korrekt eller har"
    ." den forkerte ejer.<br /> Sæt venligst"
    ." de korrekte attributter via din"
    ." FTP-klient.<br /> Filen eller mappen"
    ." skal være sat til %s.<br />";
$lang['L_XXXX']="x";
$lang['L_YES']="ja";
$lang['L_ZEND_FRAMEWORK_VERSION']="Zend Framework Version";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="The given filename '%value%' isn't a"
    ." directory.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="The given filename '%value%' isn't a"
    ." file.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="The given target '%value%' is not a"
    ." link.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="The file or directory '%value%' isn't"
    ." executable.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="The file or directory '%value%'"
    ." doesn't exists.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="The file or directory '%value%' isn't"
    ." readable.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="The given file '%value%' isn't an"
    ." uploaded file.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="The file or directory '%value%' isn't"
    ." writable.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Invalid type given. String, integer or"
    ." float expected.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="Value is an empty string.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="The email address can not be matched"
    ." against dot-atom format.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Invalid type given. String expected.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="The email address format is invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="The hostname is invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="The local part of the email address"
    ." (<local-part>@<domain>.<tld>) is"
    ." invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="There is no valid MX record for this"
    ." email address.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="The hostname is located in a not"
    ." routable network segment. The email"
    ." address can not be resolved from"
    ." public network.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="The email address is too long. The"
    ." maximum length is 320 chars.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="The email addess can not be matched"
    ." against quoted-string format.";
$lang['L_ZEND_ID_IS_EMPTY']="Value is required and can't be empty.";
$lang['L_ZEND_ID_MISSING_TOKEN']="No token was provided to match"
    ." against.";
$lang['L_ZEND_ID_NOT_DIGITS']="Only digits are allowed.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Invalid type given. String, integer,"
    ." float, boolean or array expected.";
$lang['L_ZEND_ID_NOT_SAME']="The two given tokens do not match.";
return $lang;
