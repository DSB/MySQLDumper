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
    'L_ACTION' => "Actie",
    'L_ACTIVATED' => "geactiveerd",
    'L_ACTUALLY_INSERTED_RECORDS' => "Tot nu toe zijn <b>%s</b> records"
    ." succesvol toegevoegd.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Tot nu toe zijn er <b>%s</b> van"
    ." <b>%s</b> records succesvol"
    ." toegevoegd.",
    'L_ADD' => "Add",
    'L_ADDED' => "toegevoegd",
    'L_ADD_DB_MANUALLY' => "Voeg database handmatig toe",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "alles",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "De tabel '<b>%s</b>' is nu hersteld.",
    'L_ASKDBCOPY' => "Do you  want to copy database `%s` to"
    ." database `%s`?",
    'L_ASKDBDELETE' => "Do you want to delete the Database"
    ." `%s` with the content?",
    'L_ASKDBEMPTY' => "Do you want to empty the Database `%s`"
    ." ?",
    'L_ASKDELETEFIELD' => "Do you want to delete the Field?",
    'L_ASKDELETERECORD' => "Are you sure to delete this record?",
    'L_ASKDELETETABLE' => "Should the table `%s` be deleted?",
    'L_ASKTABLEEMPTY' => "Should the table `%s` be emptied?",
    'L_ASKTABLEEMPTYKEYS' => "Should the table `%s` be emptied and"
    ." the Indices reset?",
    'L_ATTACHED_AS_FILE' => "attached as file",
    'L_ATTACH_BACKUP' => "Toevoegen backup",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "Verwijder backups automatisch",
    'L_BACK' => "terug",
    'L_BACKUPFILESANZAHL' => "In de Backup directorie zijn er",
    'L_BACKUPS' => "Backups",
    'L_BACKUP_DBS' => "DBs naar backup",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Database Overzicht",
    'L_BACK_TO_OVERVIEW' => "Database Overzicht",
    'L_CALL' => "Call",
    'L_CANCEL' => "Cancel",
    'L_CANT_CREATE_DIR' => "Kan de dir '%s' niet aanmaken. 
Maak"
    ." gebruik van uw FTP programma a.u.b.",
    'L_CHANGE' => "wijzig",
    'L_CHANGEDIR' => "wijzig naar dir",
    'L_CHANGEDIR' => "Verander van Directorie",
    'L_CHANGEDIRERROR' => "wijzig naar dir is niet mogelijk",
    'L_CHANGEDIRERROR' => "Kan de directorie niet wijzigen!",
    'L_CHARSET' => "Characterset",
    'L_CHECK' => "Controleer",
    'L_CHECK' => "controleer",
    'L_CHECK_DIRS' => "Controleer mijn directories",
    'L_CHOOSE_CHARSET' => "MySQLDumper kan de ontcijfering van"
    ." een bestand niet automatisch"
    ." herkennen.
<br />U moet zelf het"
    ." charset kiezen waarmee de backup is"
    ." gemaakt.
<br />Als u enkele problemen"
    ." ontdekt met sommige characters na"
    ." herstel, kunt het backup-proces"
    ." herhalen en een ander character set"
    ." kiezen.
<br />Succes. ;)",
    'L_CHOOSE_DB' => "Selecteer Database",
    'L_CLEAR_DATABASE' => "Maak database leeg",
    'L_CLOSE' => "Close",
    'L_COLLATION' => "Collation",
    'L_COMMAND' => "Command0",
    'L_COMMAND' => "Commando",
    'L_COMMAND_AFTER_BACKUP' => "Command after backup",
    'L_COMMAND_BEFORE_BACKUP' => "Command before backup",
    'L_COMMENT' => "Commentaar",
    'L_COMPRESSED' => "gezipt (gz)",
    'L_CONFBASIC' => "Basic Parameter",
    'L_CONFIG' => "Configuratie",
    'L_CONFIGFILE' => "Config Bestand",
    'L_CONFIGFILES' => "Configuratie Bestanden",
    'L_CONFIGURATIONS' => "Configuraties",
    'L_CONFIG_AUTODELETE' => "Autodelete",
    'L_CONFIG_CRONPERL' => "Crondump instellingen voor de"
    ." Perl-script",
    'L_CONFIG_EMAIL' => "Email Notificatie",
    'L_CONFIG_FTP' => "FTP Transfer van Backup bestandfile",
    'L_CONFIG_HEADLINE' => "Configuratie",
    'L_CONFIG_INTERFACE' => "Interface",
    'L_CONFIG_LOADED' => "Configuratie \"%s\" is succesvol"
    ." ge�mporteerd.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Wilt u echt het configuratie bestand"
    ." %s verwijderen?",
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
    'L_CONNECT' => "maak verbinding",
    'L_CONNECTIONPARS' => "Connectie Parameter",
    'L_CONNECTTOMYSQL' => "Verbinding met MySQL",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Backup Converter",
    'L_CONVERTING' => "Converting",
    'L_CONVERT_FILE' => "Bestand welke wordt geconverteerd",
    'L_CONVERT_FILENAME' => "Naam van bestemmingsbestand (zonder"
    ." extensie)",
    'L_CONVERT_FILEREAD' => "Lees bestand '%s'",
    'L_CONVERT_FINISHED' => "Conversie be�ndigd, '%s' is"
    ." succesvol geschreven.",
    'L_CONVERT_START' => "Start Conversie",
    'L_CONVERT_TITLE' => "Converteer Dump naar MSD Formaat",
    'L_CONVERT_WRONG_PARAMETERS' => "Verkeerde parameters!  Conversie is"
    ." niet mogelijk.",
    'L_CREATE' => "Maak",
    'L_CREATEAUTOINDEX' => "Create Auto-Index",
    'L_CREATEDIRS' => "Maak Directories",
    'L_CREATE_CONFIGFILE' => "Maak een nieuw configuratie bestand"
    ." aan",
    'L_CREATE_DATABASE' => "Maak nieuw database",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Tegoed / Help",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Geef Commentaar in",
    'L_CRON_COMPLETELOG' => "Log complete output",
    'L_CRON_EXECPATH' => "Pad van de Perl scripts",
    'L_CRON_EXTENDER' => "Bestands extensie",
    'L_CRON_PRINTOUT' => "Print output op het scherm.",
    'L_CSVOPTIONS' => "CSV Options",
    'L_CSV_EOL' => "Seperate lines with",
    'L_CSV_ERRORCREATETABLE' => "Error while creating table `%s` !",
    'L_CSV_FIELDCOUNT_NOMATCH' => "The count of fields doesn't match with"
    ." that of the data to import (%d instead"
    ." of %d).",
    'L_CSV_FIELDSENCLOSED' => "Fields enclosed by",
    'L_CSV_FIELDSEPERATE' => "Fields separated with",
    'L_CSV_FIELDSESCAPE' => "Fields escaped with",
    'L_CSV_FIELDSLINES' => "%d fields recognized, totally %d lines",
    'L_CSV_FILEOPEN' => "Open CSV file",
    'L_CSV_NAMEFIRSTLINE' => "Field names in first line",
    'L_CSV_NODATA' => "No data found for import!",
    'L_CSV_NULL' => "Replace NULL with",
    'L_DATASIZE' => "Size of data",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "Database",
    'L_DBCONNECTION' => "Database Connectie",
    'L_DBPARAMETER' => "Database Parameters",
    'L_DBS' => "Databases",
    'L_DB_BACKUPPARS' => "Database Backup Parameter",
    'L_DB_HOST' => "Hostname",
    'L_DB_IN_LIST' => "De database '%s' kan niet worden"
    ." toegevoegd omdat deze reeds bestaat.",
    'L_DB_PASS' => "Wachtwoord",
    'L_DB_SELECT_ERROR' => "<br />Fout:<br />Selectie van de"
    ." database <b>",
    'L_DB_SELECT_ERROR2' => "</b> mislukt!",
    'L_DB_USER' => "Gebruiker",
    'L_DEFAULT_CHARSET' => "Default character set",
    'L_DELETE' => "delete",
    'L_DELETE_DATABASE' => "Verwijder database",
    'L_DELETE_FILE_ERROR' => "FOUT verwijderen bestand \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "Bestand \"%s\" is succesvol"
    ." verwijderd.",
    'L_DELETE_HTACCESS' => "Verwijder directorie protectie"
    ." (verwijder .htaccess)",
    'L_DESELECTALL' => "Deselecteer alles",
    'L_DIR' => "Directorie",
    'L_DISABLEDFUNCTIONS' => "Niet toegestane Functies",
    'L_DISABLEDFUNCTIONS' => "Functies uitschakelen",
    'L_DO' => "Uitvoeren",
    'L_DOCRONBUTTON' => "Run de Perl Cron script",
    'L_DONE' => "Klaar!",
    'L_DONT_ATTACH_BACKUP' => "Don't attach backup",
    'L_DOPERLTEST' => "Test Perl Modules",
    'L_DOSIMPLETEST' => "Test Perl",
    'L_DOWNLOAD_FILE' => "Download bestand",
    'L_DO_NOW' => "operate now",
    'L_DUMP' => "Backup",
    'L_DUMP_ENDERGEBNIS' => "Het bestand bevat <b>%s</b> tabellen"
    ." met <b>%s</b> records.<br />",
    'L_DUMP_FILENAME' => "Backup Bestand",
    'L_DUMP_HEADLINE' => "Maak backup...",
    'L_DUMP_NOTABLES' => "Geen tabellen gevonden in de database"
    ." `<b>%s</b>`",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Duration",
    'L_EDIT' => "edit",
    'L_EHRESTORE_CONTINUE' => "voortgangs- en log fouten",
    'L_EHRESTORE_STOP' => "stop",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "De bijlage bevat de backup van uw"
    ." database.<br />Backup van Database"
    ." `%s`
<br /><br />Het volgende bestand"
    ." is aangemaakt:<br /><br />%s <br /><br"
    ." />Mvrgr<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "`<br /><br />Mvrgr.<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "Een Meervoudige Backup is"
    ." aangemaakt.<br />De Backup bestanden"
    ." zijn aan verschillende emails"
    ." toegevoegd.<br />Backup of Database"
    ." `%s`
<br /><br />De volgende bestanden"
    ." zijn aangemaakt:<br /><br />%s <br"
    ." /><br />Mvrgr<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "Een Meervoudige Backup is"
    ." aangemaakt.<br />De Backup bestanden"
    ." zijn niet aan deze email"
    ." toegevoegd!<br />Backup van Database"
    ." `%s`
<br /><br />De volgende bestanden"
    ." zijn aangemaakt:<br /><br />%s
<br"
    ." /><br />Mvrgr<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "Bestanden zijn niet toegevoegd aan"
    ." deze email!<br />Backup of Database"
    ." `%s`
<br /><br />Het volgende bestand"
    ." is aangemaakt:<br /><br />%s
<br /><br"
    ." />Mvrgr<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "Het Backup bestand %s heeft zijn"
    ." maximale grote bereikt en is niet aan"
    ." de email toegevoegd.<br />Backup of"
    ." Database `%s`
<br /><br />Het volgende"
    ." bestand is aangemaakt:<br /><br"
    ." />%s
<br /><br />Mvrgr<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Ontvanger",
    'L_EMAIL_MAXSIZE' => "Maximum grote van de bijlage",
    'L_EMAIL_ONLY_ATTACHMENT' => "... alleen bijlage.",
    'L_EMAIL_RECIPIENT' => "Ontvanger",
    'L_EMAIL_SENDER' => "Afzender adres van de email",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "Email is succesvol gezonden naar",
    'L_EMPTY' => "Empty",
    'L_EMPTYKEYS' => "empty and reset indexes",
    'L_EMPTYTABLEBEFORE' => "Empty table before",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Verwijder de tabellen voor herstellen",
    'L_ENCODING' => "Charset",
    'L_ENCRYPTION_TYPE' => "Soort van codering",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "Klil eerst de knop \"Verbinding naar"
    ." MySQL\". Alleen als er geen database"
    ." wordt gedetecteerd moet u zelf een"
    ." naam hier ingeven.",
    'L_ENTRY' => "Ingang",
    'L_ERROR' => "FOUT",
    'L_ERRORHANDLING_RESTORE' => "Fout afhandeling tijdens herstellen",
    'L_ERROR_CONFIGFILE_NAME' => "Bestandsnaam \"%s\" bevat niet"
    ." toegestane characters.",
    'L_ERROR_DELETING_CONFIGFILE' => "FOUT: kan het configuratie bestand %s"
    ." niet verwijderen!",
    'L_ERROR_LOADING_CONFIGFILE' => "Kan configbestand \"%s\" niet laden",
    'L_ERROR_LOG' => "Error Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel from 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Export",
    'L_EXPORTFINISHED' => "Export Be�ndigd.",
    'L_EXPORTLINES' => "<strong>%s</strong> lines exported",
    'L_EXPORTOPTIONS' => "Export Options",
    'L_EXTENDEDPARS' => "Parameter van buiten",
    'L_FADE_IN_OUT' => "Display aan/uit",
    'L_FATAL_ERROR_DUMP' => "Fatale fout: het aanmaak-commando van"
    ." tabel '%s' in database '%s' kan niet"
    ." worden gelezen!",
    'L_FIELDS' => "Velden",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "Bestand",
    'L_FILES' => "Files",
    'L_FILESIZE' => "Bestand grote",
    'L_FILE_MANAGE' => "Bestand Administratie",
    'L_FILE_OPEN_ERROR' => "Fout: kan bestand niet openen.",
    'L_FILE_SAVED_SUCCESSFULLY' => "The file has been saved successfully.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "The file couldn't be saved!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Moet de database",
    'L_FM_ALERTRESTORE2' => "worden hersteld met de records van dit"
    ." bestand",
    'L_FM_ALERTRESTORE3' => "?",
    'L_FM_ALL_BU' => "Alle Backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Moeten bestand(en)",
    'L_FM_ASKDELETE2' => "echt worden verwijderd?",
    'L_FM_ASKDELETE3' => "Wilt u dat automatisch verwijderen nu"
    ." wordt uitgevoerd volgens de"
    ." configuratie regels?",
    'L_FM_ASKDELETE4' => "Wilt u alle backup bestanden"
    ." verwijderen?",
    'L_FM_ASKDELETE5' => "Wilt u alle backup bestanden"
    ." verwijderen met",
    'L_FM_ASKDELETE5_2' => "_* ?",
    'L_FM_AUTODEL1' => "Autodelete: de volgende bestanden zijn"
    ." verwijderd i.v.m. met de instelling"
    ." van het aantal maximale bestanden:",
    'L_FM_CHOOSE_ENCODING' => "Kies ontcijfering van het backup"
    ." bestand",
    'L_FM_COMMENT' => "Geef Commentaar in",
    'L_FM_DBNAME' => "Database naam",
    'L_FM_DELETE' => "Verwijder",
    'L_FM_DELETE1' => "Het bestand",
    'L_FM_DELETE2' => "is succesvol verwijderd.",
    'L_FM_DELETE3' => "kan niet worden verwijderd!",
    'L_FM_DELETEALL' => "Verwijder alle backup bestanden",
    'L_FM_DELETEALLFILTER' => "Verwijder alles met",
    'L_FM_DELETEAUTO' => "Run autodelete handmatig",
    'L_FM_DUMPSETTINGS' => "Backup Configuratie",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "Bestands datum",
    'L_FM_FILES1' => "Database Backups",
    'L_FM_FILESIZE' => "Bestands grootte",
    'L_FM_FILEUPLOAD' => "Upload bestand",
    'L_FM_FILEUPLOAD' => "Laad bestand",
    'L_FM_FREESPACE' => "Vrije Ruimte op de Server",
    'L_FM_LAST_BU' => "Laatste Backup",
    'L_FM_NOFILE' => "U heeft geen bestand gekozen!",
    'L_FM_NOFILESFOUND' => "Geen bestand gevonden.",
    'L_FM_RECORDS' => "Records",
    'L_FM_RESTORE' => "Herstellen",
    'L_FM_RESTORE_HEADER' => "Herstel van Database"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Geselecteerde tabellen",
    'L_FM_STARTDUMP' => "Start Nieuwe Backup",
    'L_FM_TABLES' => "Tabellen",
    'L_FM_TOTALSIZE' => "Totale grootte",
    'L_FM_UPLOADFAILED' => "De upload is mislukt!",
    'L_FM_UPLOADFILEEXISTS' => "Een bestand met dezelfde naam bestaat"
    ." reeds!",
    'L_FM_UPLOADFILEREQUEST' => "kies een bestand a.u.b.",
    'L_FM_UPLOADFILEREQUEST' => "please choose a file.",
    'L_FM_UPLOADMOVEERROR' => "Kan geselecteerd bestand niet"
    ." verplaatsen naar upload directorie.",
    'L_FM_UPLOADNOTALLOWED1' => "Dit bestands type wordt niet"
    ." ondersteund.",
    'L_FM_UPLOADNOTALLOWED2' => "Valide types zijn: *.gz en *.sql-files",
    'L_FOUND_DB' => "gevonden db",
    'L_FROMFILE' => "from file",
    'L_FROMTEXTBOX' => "from text box",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Add connection",
    'L_FTP_CHOOSE_MODE' => "FTP Transfer Mode",
    'L_FTP_CONFIRM_DELETE' => "Should this FTP-Connection really be"
    ." deleted?",
    'L_FTP_CONNECTION' => "FTP-Connection",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Connection closed",
    'L_FTP_CONNECTION_DELETE' => "Delete connection",
    'L_FTP_CONNECTION_ERROR' => "The connection to server '%s' using"
    ." port %s couldn't be established",
    'L_FTP_CONNECTION_SUCCESS' => "The connection to server '%s' using"
    ." port %s was established successfully",
    'L_FTP_DIR' => "Upload directorie",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "FTP parameter zijn ok",
    'L_FTP_OK' => "Connectie succesvol.",
    'L_FTP_PASS' => "Password",
    'L_FTP_PASSIVE' => "gebruik passieve mode",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Poort",
    'L_FTP_SEND_TO' => "naar <strong>%s</strong><br /> in"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "Beveiligde SSL FTP connectie",
    'L_FTP_START' => "Starting FTP transfer",
    'L_FTP_TIMEOUT' => "Connectie Timeout",
    'L_FTP_TRANSFER' => "FTP Transfer",
    'L_FTP_USER' => "User",
    'L_FTP_USESSL' => "gebruik SSL Connectie",
    'L_GENERAL' => "generaal",
    'L_GENERAL' => "Generaal",
    'L_GZIP' => "GZip compressie",
    'L_GZIP_COMPRESSION' => "GZip Compressie",
    'L_HOME' => "Home",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Activate rewrite",
    'L_HTACC_ADD_HANDLER' => "Add handler",
    'L_HTACC_CONFIRM_DELETE' => "Moet de directorie protectie nu worden"
    ." geschreven ?",
    'L_HTACC_CONTENT' => "Inhoud van het bestand",
    'L_HTACC_CREATE' => "Maak directorie protectie aan",
    'L_HTACC_CREATED' => "De directorie protectie is aangemaakt.",
    'L_HTACC_CREATE_ERROR' => "Er is een Fout opgetreden bij het"
    ." aanmaken van de directorie protectie"
    ." !<br />Maak a.u.b. de 2 bestanden"
    ." handmatig met de volgende inhoud",
    'L_HTACC_CRYPT' => "Crypt 8 Chars max (Linux en"
    ." Unix-Systems)",
    'L_HTACC_DENY_ALLOW' => "Deny / Allow",
    'L_HTACC_DIR_LISTING' => "Directory Listing",
    'L_HTACC_EDIT' => "Bewerk .htaccess",
    'L_HTACC_ERROR_DOC' => "Error Document",
    'L_HTACC_EXAMPLES' => "More examples and documentation",
    'L_HTACC_EXISTS' => "It already exists an directory"
    ." protection. If you create a new one,"
    ." the older one will be overwritten !",
    'L_HTACC_MAKE_EXECUTABLE' => "Make executable",
    'L_HTACC_MD5' => "MD5 (Linux en Unix-Systems)",
    'L_HTACC_NO_ENCRYPTION' => "platte text, geen cryptie (Windows)",
    'L_HTACC_NO_USERNAME' => "U moet een naam ingeven!",
    'L_HTACC_PROPOSED' => "Hoogste aanbeveling",
    'L_HTACC_REDIRECT' => "Redirect",
    'L_HTACC_SCRIPT_EXEC' => "Execute script",
    'L_HTACC_SHA1' => "SHA1 (alle Systemen)",
    'L_HTACC_WARNING' => "Attention! The .htaccess directly"
    ." affects the browser's behavior.<br"
    ." />With incorrect content, these pages"
    ." may no longer be accessible.",
    'L_IMPORT' => "Import Configuratie",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "Import",
    'L_IMPORTOPTIONS' => "Import Options",
    'L_IMPORTSOURCE' => "Import Source",
    'L_IMPORTTABLE' => "Import in Table",
    'L_IMPORT_NOTABLE' => "Geen tabel voor import gese;ecteerd!",
    'L_IN' => "in",
    'L_INFO_ACTDB' => "Geselecteerde Database",
    'L_INFO_DATABASES' => "De volgende database(s) zijn op uw"
    ." server",
    'L_INFO_DBEMPTY' => "De database is leeg !",
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
    'L_INFO_LASTUPDATE' => "Laatste update",
    'L_INFO_LOCATION' => "Uw locatie is",
    'L_INFO_NODB' => "database bestaat niet.",
    'L_INFO_NOPROCESSES' => "geen werkende processen",
    'L_INFO_NOSTATUS' => "geen status beschikbaar",
    'L_INFO_NOVARS' => "geen variabele beschikbaar",
    'L_INFO_OPTIMIZED' => "geoptimaliseerd",
    'L_INFO_RECORDS' => "Records",
    'L_INFO_RECORDS' => "records",
    'L_INFO_SIZE' => "Grootte",
    'L_INFO_SUM' => "totaal",
    'L_INSTALL' => "Installatie",
    'L_INSTALL' => "Installatie",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(Leeg = Standaard Poort)",
    'L_INSTALL_HELP_SOCKET' => "(Leeg = Standaard Socket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Taal",
    'L_LASTBACKUP' => "Laatste Backup",
    'L_LOAD' => "Laad standaard instelling",
    'L_LOAD_DATABASE' => "Herlaad databases",
    'L_LOAD_FILE' => "Load file",
    'L_LOG' => "Log",
    'L_LOGFILENOTWRITABLE' => "Kan logbestand niet schrijven !",
    'L_LOGFILENOTWRITABLE' => "Kan Log file niet schrijven !",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "verwijder Log",
    'L_MAILERROR' => "Verzenden van email gefaald!",
    'L_MAILPROGRAM' => "Mail programma",
    'L_MAXSIZE' => "max. grote",
    'L_MAX_BACKUP_FILES_EACH2' => "Voor iedere database",
    'L_MAX_EXECUTION_TIME' => "Max bewerkings tijd",
    'L_MAX_UPLOAD_SIZE' => "Maximum bestands grote",
    'L_MAX_UPLOAD_SIZE' => "Maximum file size",
    'L_MAX_UPLOAD_SIZE_INFO' => "Als uw Dumpfile groter is dan de"
    ." ingestelde limit, moet u de upload via"
    ." FTP in de directory \"work/backup\"."
    ." 
plaatsen, daarna kunt u er voor"
    ." kiezen om te beginnen met het"
    ." herstelproces.",
    'L_MEMORY' => "Geheugen",
    'L_MESSAGE' => "Message",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Minuten",
    'L_MINUTES' => "Minuten",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "MySQLDumper-Informatie",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Versie",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Backup of <b>%d</b> Databases done",
    'L_MULTIPART_ACTUAL_PART' => "Actual Part",
    'L_MULTIPART_SIZE' => "max. bestandsgroote",
    'L_MULTI_PART' => "Meervoudige Backup",
    'L_MYSQLVARS' => "MySQL Variabele",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "Standaard decoderen van de"
    ." MySQL-Server",
    'L_MYSQL_DATA' => "MySQL-Data",
    'L_MYSQL_VERSION' => "MySQL-Versie",
    'L_NAME' => "Name",
    'L_NAME' => "Naam",
    'L_NEW' => "nieuw",
    'L_NEWTABLE' => "New table",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "nee",
    'L_NOFTPPOSSIBLE' => "U heeft geen FTP functies !",
    'L_NOFTPPOSSIBLE' => "U heeft geen FTP functies !",
    'L_NOFTPPOSSIBLE' => "U heeft geen FTP functies !",
    'L_NOGZPOSSIBLE' => "U heeft geen compressie functies !",
    'L_NOGZPOSSIBLE' => "Omdat Zlib niet is ge�nstalleerd,"
    ." kan u de GZip-Functies niet gebruiken!",
    'L_NONE' => "geen",
    'L_NOREVERSE' => "Oudste invoer eerst",
    'L_NOTAVAIL' => "<em>niet beschikbaar</em>",
    'L_NOTICE' => "Notice",
    'L_NOTICES' => "Notities",
    'L_NOT_ACTIVATED' => "niet geactiveerd",
    'L_NOT_SUPPORTED' => "Deze backup ondersteund deze functie"
    ." niet.",
    'L_NO_DB_FOUND' => "Ik kan geen enkele database"
    ." automatisch vinden, zoek de connectie"
    ." parameters en voer de naam handmatig"
    ." in van uw datbase.",
    'L_NO_DB_FOUND_INFO' => "De verbinding met de database is"
    ." succesvol gerealiseerd.<br />
Uw"
    ." userdata is actueel en is geaccepteerd"
    ." door de MySQL-Server.<br />
Maar"
    ." MySQLDumper is het niet gelukt enige"
    ." database te vinden.<br />
De"
    ." automatische detectie via script is"
    ." geblokkeerd op sommige servers.<br"
    ." />
U moet uw database handmatig"
    ." ingeven nadat de installatie is"
    ." bee�ndigd.
Klik op \"configuratie\""
    ." \"Connectie Parameter - toon\" en geef"
    ." de database naam daar in.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "Table \"<b>%s</b>\" is empty and"
    ." doesn't have any entry.",
    'L_NO_MSD_BACKUPFILE' => "Backups van andere scripts",
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s tabellen zijn geoptimaliseerd.",
    'L_NUMBER_OF_FILES_FORM' => "Verwijderd door aantal bestanden per"
    ." database",
    'L_OF' => "van",
    'L_OF' => "uit",
    'L_OK' => "OK",
    'L_OPTIMIZE' => "Bijgewerkte",
    'L_OPTIMIZE_TABLES' => "Optimaliseer Tabelen voor de Backup",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Bestuurs systeem",
    'L_PAGE_REFRESHS' => "Pagina vernieuwingen",
    'L_PASS' => "Wachtwoord",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "De Wachtwoorden zijn niet gelijk of"
    ." leeg !",
    'L_PASSWORD_REPEAT' => "Password (repeat)",
    'L_PASSWORD_STRENGTH' => "Wachtwoord sterkte",
    'L_PERLOUTPUT1' => "Geef in crondump.pl het absolute pad"
    ." in van de configuratiedirectory",
    'L_PERLOUTPUT2' => "URL van de browser of externe Cron job",
    'L_PERLOUTPUT3' => "Commandolijn in de Shell of voor de"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Bug in zlib ! Geen Compressie"
    ." mogelijk!",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "PHP-Extensies",
    'L_PHP_VERSION' => "PHP-Versie",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Poort",
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
    'L_PREFIX' => "Prefix",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "Sla primary sleutels op",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Wilt u de primary sleutel verwijderen?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "Primary sleutelveld",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "De script probeert het proces te"
    ." stoppen",
    'L_PROCESSKILL2' => ".",
    'L_PROCESSKILL3' => "De script probeert sinds",
    'L_PROCESSKILL4' => "sec. het proces te stoppen",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Algehele voortgang",
    'L_PROGRESS_OVER_ALL' => "Algemene voortgang",
    'L_PROGRESS_TABLE' => "Voortgang van de tabel",
    'L_PROVIDER' => "Provider",
    'L_PROZESSE' => "Processen",
    'L_RECHTE' => "Permissie",
    'L_RECORDS' => "Records",
    'L_RECORDS_INSERTED' => "<b>%s</b> records ingevoegd.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Reload",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "Reset",
    'L_RESET_SEARCHWORDS' => "reset search words",
    'L_RESTORE' => "Restore",
    'L_RESTORE_COMPLETE' => "<b>%s</b> tabellen aangemaakt.",
    'L_RESTORE_DB' => "Database '<b>%s</b>' op '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "Kies tabellen welke worden hersteld",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Tot nu toe zijn er <b>%d</b> van de"
    ." <b>%d</b> tabellen aangemaakt.",
    'L_RESTORE_TABLES_COMPLETED0' => "Tot nu toe zijn er <b>%d</b> tabellen"
    ." aangemaakt.",
    'L_REVERSE' => "Laatste invoer eerst",
    'L_SAFEMODEDESC' => "Omdat PHP is draait in safe_mode moet"
    ." u de volgende directories handmatig"
    ." aanmaken  welke gebruikt worden door"
    ." uw FTP-programma:",
    'L_SAVE' => "Opslaan",
    'L_SAVEANDCONTINUE' => "Sla op en ga door met de installatie",
    'L_SAVE_ERROR' => "Fout - Niet mogelijk de configuratie"
    ." op te slaan!",
    'L_SAVE_SUCCESS' => "Configuratie is succesvol opgeslagen"
    ." in het configuratie bestand \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Database",
    'L_SAVING_TABLE' => "Bewaar tabel",
    'L_SEARCH_ACCESS_KEYS' => "Browse: forward=ALT+V, backwards=ALT+C",
    'L_SEARCH_IN_TABLE' => "Search in table",
    'L_SEARCH_NO_RESULTS' => "The search for \"<b>%s</b>\" in table"
    ." \"<b>%s</b>\" doesn't bring any hits!",
    'L_SEARCH_OPTIONS' => "Search options",
    'L_SEARCH_OPTIONS_AND' => "a column must contain all search words"
    ." (AND-search)",
    'L_SEARCH_OPTIONS_CONCAT' => "a row must contain all of the search"
    ." words but they can be in any column"
    ." (could take some time)",
    'L_SEARCH_OPTIONS_OR' => "a column must have one of the search"
    ." words (OR-search)",
    'L_SEARCH_RESULTS' => "The search for \"<b>%s</b>\" in table"
    ." \"<b>%s</b>\" brings the following"
    ." results",
    'L_SECOND' => "Second",
    'L_SECONDS' => "Seconden",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "Selecteer Alles",
    'L_SELECTED_FILE' => "Selected file",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "send result as file",
    'L_SEND_MAIL_FORM' => "Stuur email rapport",
    'L_SERVER' => "Server",
    'L_SERVERCAPTION' => "Toon Server",
    'L_SETPRIMARYKEYSFOR' => "Stel nieuw primary sleutels in voor de"
    ." tabel",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "show result",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Hoogte van de SQL-Box",
    'L_SQLLIB_ACTIVATEBOARD' => "activate Board",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "deactivate Board",
    'L_SQLLIB_GENERALFUNCTIONS' => "general functions",
    'L_SQLLIB_RESETAUTO' => "reset auto-increment",
    'L_SQLLIMIT' => "Getelde records op iedere pagina",
    'L_SQL_ACTIONS' => "Actions",
    'L_SQL_AFTER' => "after",
    'L_SQL_ALLOWDUPS' => "Duplicates allowed",
    'L_SQL_ATPOSITION' => "insert at position",
    'L_SQL_ATTRIBUTES' => "Attributes",
    'L_SQL_BACKDBOVERVIEW' => "Back to Overview",
    'L_SQL_BEFEHLNEU' => "New command",
    'L_SQL_BEFEHLSAVED1' => "SQL Command",
    'L_SQL_BEFEHLSAVED2' => "was added",
    'L_SQL_BEFEHLSAVED3' => "was saved",
    'L_SQL_BEFEHLSAVED4' => "was moved up",
    'L_SQL_BEFEHLSAVED5' => "was deleted",
    'L_SQL_BROWSER' => "SQL-Browser",
    'L_SQL_CARDINALITY' => "Cardinality",
    'L_SQL_CHANGED' => "was changed.",
    'L_SQL_CHANGEFIELD' => "change field",
    'L_SQL_CHOOSEACTION' => "Choose action",
    'L_SQL_COLLATENOTMATCH' => "Charset and Collation don't fit"
    ." together!",
    'L_SQL_COLUMNS' => "Columns",
    'L_SQL_COMMANDS' => "SQL-bevel",
    'L_SQL_COMMANDS_IN' => "lines in",
    'L_SQL_COMMANDS_IN2' => "sec. parsed.",
    'L_SQL_COPYDATADB' => "Copy complete Database to",
    'L_SQL_COPYSDB' => "Copy Structure of Database",
    'L_SQL_COPYTABLE' => "copy table",
    'L_SQL_CREATED' => "was created.",
    'L_SQL_CREATEINDEX' => "create new index",
    'L_SQL_CREATETABLE' => "create table",
    'L_SQL_DATAVIEW' => "Data Overzicht",
    'L_SQL_DBCOPY' => "The Content of Database `%s` was"
    ." copied in Database `%s`.",
    'L_SQL_DBSCOPY' => "The Structure of Database `%s` was"
    ." copied in Database `%s`.",
    'L_SQL_DELETED' => "was deleted",
    'L_SQL_DELETEDB' => "Delete Database",
    'L_SQL_DESTTABLE_EXISTS' => "Destination Table exists !",
    'L_SQL_EDIT' => "edit",
    'L_SQL_EDITFIELD' => "Edit field",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Edit table structure",
    'L_SQL_EMPTYDB' => "Empty Database",
    'L_SQL_ERROR1' => "FOUT in de Query:",
    'L_SQL_ERROR2' => "MySQL zegt:",
    'L_SQL_EXEC' => "Voer SQL Statement uit",
    'L_SQL_EXPORT' => "Export from Database `%s`",
    'L_SQL_FIELDDELETE1' => "The Field",
    'L_SQL_FIELDNAMENOTVALID' => "Error: No valid fieldname",
    'L_SQL_FIRST' => "first",
    'L_SQL_IMEXPORT' => "Import-Export",
    'L_SQL_IMPORT' => "Import in Database `%s`",
    'L_SQL_INDEXES' => "Indices",
    'L_SQL_INSERTFIELD' => "insert field",
    'L_SQL_INSERTNEWFIELD' => "insert new field",
    'L_SQL_LIBRARY' => "SQL Library",
    'L_SQL_NAMEDEST_MISSING' => "Name of Destination is missing !",
    'L_SQL_NEWFIELD' => "New field",
    'L_SQL_NODATA' => "no records",
    'L_SQL_NODEST_COPY' => "No Copy without Destination !",
    'L_SQL_NOFIELDDELETE' => "Delete is not possible because Tables"
    ." must contain at least one field.",
    'L_SQL_NOTABLESINDB' => "No tables found in Database",
    'L_SQL_NOTABLESSELECTED' => "No tables selected !",
    'L_SQL_OPENFILE' => "Open SQL-File",
    'L_SQL_OPENFILE_BUTTON' => "Upload",
    'L_SQL_OUT1' => "Executed",
    'L_SQL_OUT2' => "Commands",
    'L_SQL_OUT3' => "It had",
    'L_SQL_OUT4' => "Comments",
    'L_SQL_OUT5' => "Because the output contains more than"
    ." 5000 lines it isn't displayed.",
    'L_SQL_OUTPUT' => "SQL Output",
    'L_SQL_QUERYENTRY' => "The Query contains",
    'L_SQL_RECORDDELETED' => "Record was deleted",
    'L_SQL_RECORDEDIT' => "edit record",
    'L_SQL_RECORDINSERTED' => "Record was added",
    'L_SQL_RECORDNEW' => "new record",
    'L_SQL_RECORDUPDATED' => "Record was updated",
    'L_SQL_RENAMEDB' => "Rename Database",
    'L_SQL_RENAMEDTO' => "was renamed to",
    'L_SQL_SCOPY' => "Table structure of `%s` was copied in"
    ." Table `%s`.",
    'L_SQL_SEARCH' => "Search",
    'L_SQL_SEARCHWORDS' => "Searchword(s)",
    'L_SQL_SELECTTABLE' => "select table",
    'L_SQL_SHOWDATATABLE' => "Show Data of Table",
    'L_SQL_STRUCTUREDATA' => "Structure and Data",
    'L_SQL_STRUCTUREONLY' => "Only Structure",
    'L_SQL_TABLEEMPTIED' => "Table `%s` was deleted.",
    'L_SQL_TABLEEMPTIEDKEYS' => "Table `%s` was deleted and the indices"
    ." were reset.",
    'L_SQL_TABLEINDEXES' => "Indexes of table",
    'L_SQL_TABLENEW' => "Edit Tables",
    'L_SQL_TABLENOINDEXES' => "No Indexes in Table",
    'L_SQL_TABLENONAME' => "Table needs a name!",
    'L_SQL_TABLESOFDB' => "Tables of Database",
    'L_SQL_TABLEVIEW' => "Tabel Overzicht",
    'L_SQL_TBLNAMEEMPTY' => "Table name can't be empty!",
    'L_SQL_TBLPROPSOF' => "Table properties of",
    'L_SQL_TCOPY' => "Table `%s` was copied with data in"
    ." Table `%s`.",
    'L_SQL_UPLOADEDFILE' => "loaded file:",
    'L_SQL_VIEW_COMPACT' => "View: compact",
    'L_SQL_VIEW_STANDARD' => "View: standard",
    'L_SQL_VONINS' => "from totally",
    'L_SQL_WARNING' => "De uitvoering van SQL Statements kan"
    ." data manipuleren. PAS OP! De makers"
    ." accepteren geen verantwoording t.a.v."
    ." verloren of beschadigde data.",
    'L_SQL_WASCREATED' => "was created",
    'L_SQL_WASEMPTIED' => "was emptied",
    'L_STARTDUMP' => "Start Backup",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "start search",
    'L_STATUS' => "Status",
    'L_STATUS' => "Status",
    'L_STEP' => "Stap",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Configuratie bestand %s is succesvol"
    ." aangemaakt.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "Het configuratie bestand %s is"
    ." succesvol verwijderd.",
    'L_TABLE' => "Tabel",
    'L_TABLES' => "Tabellen",
    'L_TABLESELECTION' => "Tabel selectie",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "Test Connectie",
    'L_THEME' => "Theme",
    'L_TIME' => "Time",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Fulltext key",
    'L_TITLE_KEY_PRIMARY' => "Primary key",
    'L_TITLE_KEY_UNIQUE' => "Unique key",
    'L_TITLE_MYSQL_HELP' => "MySQL Documentation",
    'L_TITLE_NOKEY' => "No key",
    'L_TITLE_SEARCH' => "Search",
    'L_TITLE_SHOW_DATA' => "Toon data",
    'L_TITLE_UPLOAD' => "Upload SQL file",
    'L_TO' => "naar",
    'L_TOOLS' => "Tools",
    'L_TOOLS' => "Tools",
    'L_TOOLS_TOOLBOX' => "Select Database / Datebase functions /"
    ." Import - Export",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "onbekend",
    'L_UNKNOWN_SQLCOMMAND' => "onbekend SQL-Commando",
    'L_UPDATE' => "Update",
    'L_UPTO' => "op naar",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "Inhoud",
    'L_VERSIONSINFORMATIONEN' => "Versie Informatie",
    'L_VIEW' => "toon",
    'L_VISIT_HOMEPAGE' => "Bezoek de Homepage",
    'L_VOM' => "van",
    'L_WITH' => "met",
    'L_WITHATTACH' => "met bijlage",
    'L_WITHOUTATTACH' => "zonder bijlage",
    'L_WITHPRAEFIX' => "met prefix",
    'L_WRONGCONNECTIONPARS' => "Verbindings parameters verkeerd of"
    ." niet aanwezig!",
    'L_WRONG_CONNECTIONPARS' => "Connectie parameters zijn verkeerd!",
    'L_WRONG_RIGHTS' => "Het bestand of de directorie '%s' is"
    ." door mij niet te beschrijven.<br />
De"
    ." rechten (chmod) zijn niet correct"
    ." ingesteld of heeft een verkeerde"
    ." eigenaar.<br />
Stel de correcte"
    ." rechten in m.b.v. uw FTP programma.<br"
    ." />
Het bestand of de directorie moeten"
    ." zijn ingesteld naar %s.<br />",
    'L_YES' => "Ja",
));
