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
    'L_ACTION' => "Actiunea",
    'L_ACTIVATED' => "aktivat",
    'L_ACTUALLY_INSERTED_RECORDS' => "Up to now <b>%s</b> records were"
    ." successfully added.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Up to now  <b>%s</b> of <b>%s</b>"
    ." records were successfully added.",
    'L_ADD' => "Add",
    'L_ADDED' => "postat la",
    'L_ADD_DB_MANUALLY' => "Se adauga baze de date",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "toţi",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "Now data of the table '<b>%s</b>' is"
    ." being analyzed.",
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
    'L_ATTACH_BACKUP' => "Backup anexele",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "ştergerea automatâ de backup",
    'L_BACK' => "înapoi",
    'L_BACKUPFILESANZAHL' => "în zona de backup sunt",
    'L_BACKUPS' => "Copie de rezervă",
    'L_BACKUP_DBS' => "DBs să fie susţinute",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Baza de date Prezentare generală",
    'L_BACK_TO_OVERVIEW' => "Database Overview",
    'L_CALL' => "Call",
    'L_CANCEL' => "închide",
    'L_CANT_CREATE_DIR' => "Nu am putut sa creeze dossaru '%s'. Va"
    ." rugam sa va crea o cu FTP",
    'L_CHANGE' => "schimbâ",
    'L_CHANGEDIR' => "change to dir",
    'L_CHANGEDIR' => "Schimbarea la directorul",
    'L_CHANGEDIRERROR' => "change to dir was not possible",
    'L_CHANGEDIRERROR' => "Acesta nu a putut fi schimbat în"
    ." listă!",
    'L_CHARSET' => "setul de caractere",
    'L_CHECK' => "Verifica",
    'L_CHECK' => "Verificarea",
    'L_CHECK_DIRS' => "Check my directories",
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
    'L_CHOOSE_DB' => "alege baza de date",
    'L_CLEAR_DATABASE' => "goleşte Baza de date",
    'L_CLOSE' => "închide",
    'L_COLLATION' => "sortarea",
    'L_COMMAND' => "Command",
    'L_COMMAND' => "Commanda",
    'L_COMMAND_AFTER_BACKUP' => "comandă, după copie de rezervă",
    'L_COMMAND_BEFORE_BACKUP' => "comandă, înainte de face copie de"
    ." rezervă",
    'L_COMMENT' => "comentar",
    'L_COMPRESSED' => "comprimată (gz)",
    'L_CONFBASIC' => "Basic Parameter",
    'L_CONFIG' => "configurare",
    'L_CONFIGFILE' => "Fişier de configurare",
    'L_CONFIGFILES' => "Fişiere de configurare",
    'L_CONFIGURATIONS' => "Preferences",
    'L_CONFIG_AUTODELETE' => "Automatic Deletion",
    'L_CONFIG_CRONPERL' => "Crondump-Setări pentru Perlscript",
    'L_CONFIG_EMAIL' => "Email notification",
    'L_CONFIG_FTP' => "FTP Transfer of Backup file",
    'L_CONFIG_HEADLINE' => "configurare",
    'L_CONFIG_INTERFACE' => "Interfaţa",
    'L_CONFIG_LOADED' => "Configurare \"%s\" a fost încărcat"
    ." cu succes.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "În cazul în care fişierul de"
    ." configurare \"%s\" sunt foarte"
    ." şterse?",
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
    'L_CONNECT' => "connect",
    'L_CONNECTIONPARS' => "Parametrii de conectare",
    'L_CONNECTTOMYSQL' => "Connect to MySQL",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Backup Converter",
    'L_CONVERTING' => "Converting",
    'L_CONVERT_FILE' => "File to be converted",
    'L_CONVERT_FILENAME' => "Name of destination file (without"
    ." extension)",
    'L_CONVERT_FILEREAD' => "Read file '%s'",
    'L_CONVERT_FINISHED' => "Conversion finished, '%s' was written"
    ." successfully.",
    'L_CONVERT_START' => "Start Conversion",
    'L_CONVERT_TITLE' => "Convert Dump to MSD Format",
    'L_CONVERT_WRONG_PARAMETERS' => "Wrong parameters!  Conversion is not"
    ." possible.",
    'L_CREATE' => "create",
    'L_CREATEAUTOINDEX' => "Create Auto-Index",
    'L_CREATEDIRS' => "Create Directories",
    'L_CREATE_CONFIGFILE' => "Crearea unui nou fişier de"
    ." configurare",
    'L_CREATE_DATABASE' => "crearea unei baze de date nou",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Credits / Ajutor",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Enter Comment",
    'L_CRON_COMPLETELOG' => "scrie jornalul complet",
    'L_CRON_EXECPATH' => "Cale de scripturi Perl",
    'L_CRON_EXTENDER' => "Extinderea script-ul",
    'L_CRON_PRINTOUT' => "Textul in scris",
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
    'L_DATASIZE' => "Dosarul marimi",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "baza de date",
    'L_DBCONNECTION' => "Database Connection",
    'L_DBPARAMETER' => "Database Parameters",
    'L_DBS' => "baza de date",
    'L_DB_BACKUPPARS' => "Preferences",
    'L_DB_HOST' => "baza de date-nume host",
    'L_DB_IN_LIST' => "Baza de date '%s' nu a putut fi"
    ." adăugat, pentru că există deja.",
    'L_DB_PASS' => "baza de date-password",
    'L_DB_SELECT_ERROR' => "<br />Error:<br />Selection of"
    ." database <b>",
    'L_DB_SELECT_ERROR2' => "</b> failed!",
    'L_DB_USER' => "baza de date-utilizatorul",
    'L_DEFAULT_CHARSET' => "Default character set",
    'L_DELETE' => "Delete",
    'L_DELETE_DATABASE' => "sterge Baza de date",
    'L_DELETE_FILE_ERROR' => "Error deleting file \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "File \"%s\" was deleted successfully.",
    'L_DELETE_HTACCESS' => "sterge protecţia de dosar",
    'L_DESELECTALL' => "selecţie anulaţi",
    'L_DIR' => "zona",
    'L_DISABLEDFUNCTIONS' => "Disabled Functions",
    'L_DISABLEDFUNCTIONS' => "functionale oprite",
    'L_DO' => "face",
    'L_DOCRONBUTTON' => "Run the Perl Cron script",
    'L_DONE' => "Gata!",
    'L_DONT_ATTACH_BACKUP' => "Nu ataşaţi Backup",
    'L_DOPERLTEST' => "Test Perl Modules",
    'L_DOSIMPLETEST' => "Test Perl",
    'L_DOWNLOAD_FILE' => "Download file",
    'L_DO_NOW' => "operate now",
    'L_DUMP' => "copie de rezervă",
    'L_DUMP_ENDERGEBNIS' => "<b>%s</b> Tabele cu un total de"
    ." <b>%s</b> Records salvate.<br />",
    'L_DUMP_FILENAME' => "Backup File",
    'L_DUMP_HEADLINE' => "Create backup...",
    'L_DUMP_NOTABLES' => "Nu sunt tabelele din baza de date `%s`",
    'L_DUMP_OF_DB_FINISHED' => "Copie de siguranţă a bazei de date"
    ." `%s` completate",
    'L_DURATION' => "Duration",
    'L_EDIT' => "edit",
    'L_EHRESTORE_CONTINUE' => "în continuare pentru şi fă un"
    ." Jurnal",
    'L_EHRESTORE_STOP' => "pause",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "In Anexa puteţi găsi copie de"
    ." rezervă a bazei de date MySQL.<br />"
    ." Baza de date de rezervă `%s`<br /><br"
    ." />Fişierul a fost creat:<br /><br"
    ." />%s <br /><br />Multe salutări <br"
    ." /><br /> MySQL-Dumper",
    'L_EMAILBODY_FOOTER' => "<br /><br /><br />Multe salutări <br"
    ." /><br /> MySQL-Dumper",
    'L_EMAILBODY_MP_ATTACH' => "Aceasta a creat un sistem"
    ." Multipart-Copie de rezervă.<br"
    ." />Backup-uri sunt livrate în separat"
    ." de e-mail-uri ca ataşare!<br />Baza"
    ." de date de rezervă `%s` <br /><br"
    ." />Sunt create fisierele:<br /><br"
    ." />%s<br /><br /><br />Multe salutări"
    ." <br /><br /> MySQL-Dumper",
    'L_EMAILBODY_MP_NOATTACH' => "Aceasta a creat un sistem"
    ." Multipart-Copie de rezervă.<br"
    ." />Siguranţe nu sunt incluse ca"
    ." ataşare!<br />Baza de date de"
    ." rezervă `%s` <br /><br />Sunt create"
    ." fisierele:<br /><br />%s<br /><br"
    ." /><br />Multe salutări <br /><br />"
    ." MySQL-Dumper",
    'L_EMAILBODY_NOATTACH' => "Copii de rezervă nu sunt"
    ." ataşată.<br />Baza de date de"
    ." rezervă `%s` <br /><br />Sunt create"
    ." fisierele:<br /><br />%s<br /><br"
    ." /><br />Multe salutări <br /><br />"
    ." MySQL-Dumper",
    'L_EMAILBODY_TOOBIG' => "Fuse depăşeşte dimensiunea maximă"
    ." de %s, nu sunt ataşat.<br />Baza de"
    ." date de rezervă `%s` <br /><br />Sunt"
    ." create fisierele:<br /><br />%s<br"
    ." /><br /><br />Multe salutări <br"
    ." /><br /> MySQL-Dumper",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Destinatarii",
    'L_EMAIL_MAXSIZE' => "Maximum size of attachment",
    'L_EMAIL_ONLY_ATTACHMENT' => "... doar anexă",
    'L_EMAIL_RECIPIENT' => "destinatarii",
    'L_EMAIL_SENDER' => "Expeditorul mesajului e-mail",
    'L_EMAIL_START' => "Start Trimiterea de e-mail",
    'L_EMAIL_WAS_SEND' => "De e-mail a fost trimis cu succes la",
    'L_EMPTY' => "Empty",
    'L_EMPTYKEYS' => "empty and reset indexes",
    'L_EMPTYTABLEBEFORE' => "Empty table before",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Ştergeţi baza de date înainte de"
    ." restaurare",
    'L_ENCODING' => "encoding",
    'L_ENCRYPTION_TYPE' => "Criptare",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Entry",
    'L_ERROR' => "greşeală",
    'L_ERRORHANDLING_RESTORE' => "Rezolvarea problemelor Restaurare",
    'L_ERROR_CONFIGFILE_NAME' => "Nume de fişier \"%s\" conţine"
    ." caractere invalide.",
    'L_ERROR_DELETING_CONFIGFILE' => "Eroare: fisier de configurare %s nu a"
    ." putut fi şterse!",
    'L_ERROR_LOADING_CONFIGFILE' => "Fişier de configurare \"%s\" nu a"
    ." putut fi încărcat.",
    'L_ERROR_LOG' => "Error-Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel from 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Export",
    'L_EXPORTFINISHED' => "exporturile sfarsit",
    'L_EXPORTLINES' => "<strong>%s</strong> lines exported",
    'L_EXPORTOPTIONS' => "Export Options",
    'L_EXTENDEDPARS' => "Parametri Advanced",
    'L_FADE_IN_OUT' => "Arăta/Ascunde",
    'L_FATAL_ERROR_DUMP' => "Fatal error: Declaraţia CREATE din"
    ." tabelul '%s', în baza de date '%s' nu"
    ." a putut fi citit!",
    'L_FIELDS' => "zone",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "data",
    'L_FILES' => "Datele",
    'L_FILESIZE' => "mărime de date",
    'L_FILE_MANAGE' => "administraţii de date",
    'L_FILE_OPEN_ERROR' => "Error: could not open file.",
    'L_FILE_SAVED_SUCCESSFULLY' => "Datele a fost salvat cu succes",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "Datele nu a putut fi salvat",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Should the database",
    'L_FM_ALERTRESTORE2' => "be restored with the records from the"
    ." file",
    'L_FM_ALERTRESTORE3' => "?",
    'L_FM_ALL_BU' => "All Backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Should the file(s)",
    'L_FM_ASKDELETE2' => "really be deleted?",
    'L_FM_ASKDELETE3' => "Do you want autodelete to be executed"
    ." with configured rules now?",
    'L_FM_ASKDELETE4' => "Do you want to delete all backup"
    ." files?",
    'L_FM_ASKDELETE5' => "Do you want to delete all backup files"
    ." with",
    'L_FM_ASKDELETE5_2' => "* ?",
    'L_FM_AUTODEL1' => "Autodelete: the following files were"
    ." deleted because of maximum files"
    ." setting:",
    'L_FM_CHOOSE_ENCODING' => "Choose encoding of backup file",
    'L_FM_COMMENT' => "Enter Comment",
    'L_FM_DBNAME' => "Database name",
    'L_FM_DELETE' => "Delete",
    'L_FM_DELETE1' => "The file",
    'L_FM_DELETE2' => "was deleted successfully.",
    'L_FM_DELETE3' => "couldn't be deleted!",
    'L_FM_DELETEALL' => "Delete all backup files",
    'L_FM_DELETEALLFILTER' => "Delete all with",
    'L_FM_DELETEAUTO' => "Run autodelete manually",
    'L_FM_DUMPSETTINGS' => "Backup Configuration",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "File date",
    'L_FM_FILES1' => "Database Backups",
    'L_FM_FILESIZE' => "File size",
    'L_FM_FILEUPLOAD' => "Upload file",
    'L_FM_FILEUPLOAD' => "Upload file",
    'L_FM_FREESPACE' => "spaţiu liber pe server",
    'L_FM_LAST_BU' => "Last Backup",
    'L_FM_NOFILE' => "You didn't choose a file!",
    'L_FM_NOFILESFOUND' => "No file found.",
    'L_FM_RECORDS' => "Records",
    'L_FM_RESTORE' => "Restore",
    'L_FM_RESTORE_HEADER' => "Restore of Database"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Select tables",
    'L_FM_STARTDUMP' => "Start New Backup",
    'L_FM_TABLES' => "Tables",
    'L_FM_TOTALSIZE' => "Total Size",
    'L_FM_UPLOADFAILED' => "The upload has failed!",
    'L_FM_UPLOADFILEEXISTS' => "A file with the same name already"
    ." exists !",
    'L_FM_UPLOADFILEREQUEST' => "please choose a file.",
    'L_FM_UPLOADFILEREQUEST' => "please choose a file.",
    'L_FM_UPLOADMOVEERROR' => "Couldn't move selected file to the"
    ." upload directory.",
    'L_FM_UPLOADNOTALLOWED1' => "This file type is not supported.",
    'L_FM_UPLOADNOTALLOWED2' => "Valid types are: *.gz and *.sql-files",
    'L_FOUND_DB' => "found db",
    'L_FROMFILE' => "from file",
    'L_FROMTEXTBOX' => "from text box",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Adauga conexiune",
    'L_FTP_CHOOSE_MODE' => "FTP Transfer Mode",
    'L_FTP_CONFIRM_DELETE' => "Conexiunea FTP: se elimină"
    ." într-adevăr?",
    'L_FTP_CONNECTION' => "Conexiunea FTP",
    'L_FTP_CONNECTION_CLOSED' => "Conexiune de FTP închisă",
    'L_FTP_CONNECTION_DELETE' => "şterge conexiunea",
    'L_FTP_CONNECTION_ERROR' => "Conexiunea la server '%s' pe portul %s"
    ." nu a putut fi construită",
    'L_FTP_CONNECTION_SUCCESS' => "Conexiunea la server '%s' pe portul %s"
    ." a fost produsă cu succes",
    'L_FTP_DIR' => "Upload directory",
    'L_FTP_FILE_TRANSFER_ERROR' => "De transfer a fişierului '%s' a fost"
    ." greşită",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "Fisierul '%s' a fost transferat cu"
    ." succes",
    'L_FTP_LOGIN_ERROR' => "Inregistrare ca un utilizator '%s' a"
    ." fost respinsă",
    'L_FTP_LOGIN_SUCCESS' => "Inregistrare ca un utilizator '%s' a"
    ." fost cu succes",
    'L_FTP_OK' => "FTP parameter are ok",
    'L_FTP_OK' => "Conexiunea cu succes",
    'L_FTP_PASS' => "Password",
    'L_FTP_PASSIVE' => "modul pasiv de transfer",
    'L_FTP_PASV_ERROR' => "Schimbare în modul pasiv-FTP nu a"
    ." avut succes",
    'L_FTP_PASV_SUCCESS' => "Schimbare în modul pasiv-FTP a fost"
    ." reuşit",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "la <strong>%s</strong><br />in"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "Secure SSL FTP connection",
    'L_FTP_START' => "Incepand de transfer FTP",
    'L_FTP_TIMEOUT' => "Connection Timeout",
    'L_FTP_TRANSFER' => "FTP-Transfer",
    'L_FTP_USER' => "User",
    'L_FTP_USESSL' => "folosi SSL-Conexiunea",
    'L_GENERAL' => "general",
    'L_GENERAL' => "Comun",
    'L_GZIP' => "GZip-Compression",
    'L_GZIP_COMPRESSION' => "GZip Compression",
    'L_HOME' => "acasâ",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Activare de \"Rewrite\"",
    'L_HTACC_ADD_HANDLER' => "Adauga manipulant",
    'L_HTACC_CONFIRM_DELETE' => "Sa create acum directorul de"
    ." protecţie?",
    'L_HTACC_CONTENT' => "Conţinutul dosarului",
    'L_HTACC_CREATE' => "Creaţi directorul de protecţie acum",
    'L_HTACC_CREATED' => "Director este creat cu o protecţie",
    'L_HTACC_CREATE_ERROR' => "Este o eroare atunci când am"
    ." compilarea listei de protecţie!<br"
    ." />Vă rugăm să creaţi fişierele"
    ." manual cu următorul conţinut",
    'L_HTACC_CRYPT' => "Maxime Cripta de 8 caractere (Linux"
    ." şi Unix-Systeme)",
    'L_HTACC_DENY_ALLOW' => "nega / permite",
    'L_HTACC_DIR_LISTING' => "Listare de director",
    'L_HTACC_EDIT' => ".htaccess editaţi",
    'L_HTACC_ERROR_DOC' => "Error Document",
    'L_HTACC_EXAMPLES' => "Mai multe exemple şi documentaţie",
    'L_HTACC_EXISTS' => "Există deja un director de"
    ." protecţie. Când creaţi unul nou,"
    ." acesta va suprascrie",
    'L_HTACC_MAKE_EXECUTABLE' => "A face executabil",
    'L_HTACC_MD5' => "MD5 (Linux şi Unix-Systems)",
    'L_HTACC_NO_ENCRYPTION' => "indicarea clar (Windows)",
    'L_HTACC_NO_USERNAME' => "Trebuie să introduceţi un nume",
    'L_HTACC_PROPOSED' => "Urgently recommended",
    'L_HTACC_REDIRECT' => "Redirect",
    'L_HTACC_SCRIPT_EXEC' => "Execute script",
    'L_HTACC_SHA1' => "SHA1 (all Systems)",
    'L_HTACC_WARNING' => "Atenţie! .htaccess are un impact"
    ." direct asupra browser-ul.<br"
    ." />Aplicării incorecte a paginilor nu"
    ." mai sunt accesibile.",
    'L_IMPORT' => "Import Configuration",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "Import",
    'L_IMPORTOPTIONS' => "Import Options",
    'L_IMPORTSOURCE' => "Import Source",
    'L_IMPORTTABLE' => "Import in Table",
    'L_IMPORT_NOTABLE' => "No table was selected for import!",
    'L_IN' => "în",
    'L_INFO_ACTDB' => "baza de date actualâ",
    'L_INFO_DATABASES' => "Baza de date următoarele sunt situate"
    ." pe server MySQL",
    'L_INFO_DBEMPTY' => "Baza de date este gol",
    'L_INFO_FSOCKOPEN_DISABLED' => "Pe acest server, funcţia PHP"
    ." \"fsockopen()\" pare a fi dezactivat"
    ." prin intermediul serverului de"
    ." configurare, de ce descărcarea"
    ." automată a vocii nu poate fi"
    ." executat.Dar, aveţi posibilitatea să"
    ." descărcaţi manual pachete pe care"
    ." doriţi. Salvaţi şi dezarhivaţi"
    ." programul  în subfolderul"
    ." \"language\" al instalării"
    ." MySQLDumper. Apoi, aveţi această"
    ." disponibile pentru o selecţie.",
    'L_INFO_LASTUPDATE' => "Last update",
    'L_INFO_LOCATION' => "Sunteţi pe",
    'L_INFO_NODB' => "Baza de date nu exista",
    'L_INFO_NOPROCESSES' => "nici un procesele care ruleaza",
    'L_INFO_NOSTATUS' => "statut disponibile",
    'L_INFO_NOVARS' => "variabile disponibile",
    'L_INFO_OPTIMIZED' => "optimizată",
    'L_INFO_RECORDS' => "Recorduri",
    'L_INFO_RECORDS' => "records",
    'L_INFO_SIZE' => "măsură",
    'L_INFO_SUM' => "total",
    'L_INSTALL' => "Installation",
    'L_INSTALL' => "Installation",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(empty = Default Port)",
    'L_INSTALL_HELP_SOCKET' => "(empty = Default Socket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Limba",
    'L_LASTBACKUP' => "ultimul backup",
    'L_LOAD' => "Load default settings",
    'L_LOAD_DATABASE' => "reîncarcă baza de date",
    'L_LOAD_FILE' => "Încărcaţi fişier",
    'L_LOG' => "jornal",
    'L_LOGFILENOTWRITABLE' => "jurnalul nu poate fi scris!",
    'L_LOGFILENOTWRITABLE' => "Can't write Log file !",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "delete Log",
    'L_MAILERROR' => "s-a întâmplat o greşeală la"
    ." trimiterea de e-mail!",
    'L_MAILPROGRAM' => "Programul de mail",
    'L_MAXSIZE' => "Dimensiune maximă",
    'L_MAX_BACKUP_FILES_EACH2' => "pentru fiecare bazâ de date",
    'L_MAX_EXECUTION_TIME' => "Timp maxim de executie",
    'L_MAX_UPLOAD_SIZE' => "Maximum filesize",
    'L_MAX_UPLOAD_SIZE' => "Maximum file size",
    'L_MAX_UPLOAD_SIZE_INFO' => "If your Dumpfile is bigger than the"
    ." above mentioned limit, you must upload"
    ." it via FTP into the directory"
    ." \"work/backup\". 
After that you can"
    ." choose it to begin a restore progress.",
    'L_MEMORY' => "Memory",
    'L_MESSAGE' => "Message",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "minute",
    'L_MINUTES' => "minute",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "MySQLDumper-informaţii",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Au fost susţinute <b>%d</b> Baze de"
    ." date",
    'L_MULTIPART_ACTUAL_PART' => "Subfile curent",
    'L_MULTIPART_SIZE' => "Mărimea maximă a fişierului",
    'L_MULTI_PART' => "multe bucăţi-Backup",
    'L_MYSQLVARS' => "MySQL-variabile",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "codificare standard de la"
    ." MySQL-Serveru",
    'L_MYSQL_DATA' => "MySQL-Data",
    'L_MYSQL_VERSION' => "MySQL-Version",
    'L_NAME' => "Name",
    'L_NAME' => "Nume",
    'L_NEW' => "nou",
    'L_NEWTABLE' => "New table",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "nu",
    'L_NOFTPPOSSIBLE' => "You don't have FTP functions !",
    'L_NOFTPPOSSIBLE' => "Nu sunt funcţii de FTP disponibile!",
    'L_NOFTPPOSSIBLE' => "Nu sunt funcţii de FTP disponibile!",
    'L_NOGZPOSSIBLE' => "You don't have compression functions !",
    'L_NOGZPOSSIBLE' => "Deoarece \"zlib\" nu este instalat,"
    ." caracteristici GZip nu sunt"
    ." disponibile!",
    'L_NONE' => "nimic",
    'L_NOREVERSE' => "Oldest entry first",
    'L_NOTAVAIL' => "<em>unavailable</em>",
    'L_NOTICE' => "Nota",
    'L_NOTICES' => "Notele",
    'L_NOT_ACTIVATED' => "inactivi",
    'L_NOT_SUPPORTED' => "Această copie de rezervă nu acceptă"
    ." această caracteristică.",
    'L_NO_DB_FOUND' => "Nu se vedea o baza de date. Expand"
    ." parametrii de conexiune şi"
    ." introduceţi numele de baze de date"
    ." manual!",
    'L_NO_DB_FOUND_INFO' => "The connection to the database was"
    ." successfully established.<br />
Your"
    ." userdata is valid and was accepted by"
    ." the MySQL-Server.<br />
But"
    ." MySQLDumper was not able to find any"
    ." database.<br />
The automatic"
    ." detection via script is blocked on"
    ." some servers.<br />
You must enter"
    ." your database name manually after the"
    ." installation is finished.
Click on"
    ." \"configuration\" \"Connection"
    ." Parameter - display\" and enter the"
    ." database name there.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "Table \"<b>%s</b>\" is empty and"
    ." doesn't have any entry.",
    'L_NO_MSD_BACKUPFILE' => "Backups of other scripts",
    'L_NO_NAME_GIVEN' => "nici un nume scris",
    'L_NR_TABLES_OPTIMIZED' => "%s Tabelele sunt optimizate.",
    'L_NUMBER_OF_FILES_FORM' => "Numărul de fişiere de rezervă"
    ." pentru fiecare bază de date",
    'L_OF' => "de la",
    'L_OF' => "al",
    'L_OK' => "OK",
    'L_OPTIMIZE' => "Optimizare",
    'L_OPTIMIZE_TABLES' => "Optimizaţi înainte de mese de"
    ." rezervă",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Operating system",
    'L_PAGE_REFRESHS' => "Pageviews",
    'L_PASS' => "Password",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "\"Passwords\" nu sunt identice sau"
    ." gol!",
    'L_PASSWORD_REPEAT' => "Password (repeat)",
    'L_PASSWORD_STRENGTH' => "Password strength",
    'L_PERLOUTPUT1' => "Entry in crondump.pl for"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "URL for the browser or for external"
    ." Cron job",
    'L_PERLOUTPUT3' => "Commandline in the Shell or for the"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Bug in \"Zlib\"! Nu de compresie"
    ." disponibile!",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "PHP-Extensions",
    'L_PHP_VERSION' => "PHP-Version",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Port",
    'L_PORT' => "Portul",
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
    'L_PREFIX' => "Prefixul",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "primarâ cheie in memorie (save)",
    'L_PRIMARYKEY_CONFIRMDELETE' => "sâ  şterg primarâ cheie?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "primarâ cheie",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "Încercarea procesului",
    'L_PROCESSKILL2' => "a termina.",
    'L_PROCESSKILL3' => "Acesta este din moment",
    'L_PROCESSKILL4' => "Seconds încercarea de a procesului",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Progresul total",
    'L_PROGRESS_OVER_ALL' => "Overall Progress",
    'L_PROGRESS_TABLE' => "Progresele tabelul",
    'L_PROVIDER' => "Provider",
    'L_PROZESSE' => "procesele",
    'L_RECHTE' => "permisuri",
    'L_RECORDS' => "înregistrarea",
    'L_RECORDS_INSERTED' => "<b>%s</b> records inserted.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Reload",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "reset",
    'L_RESET_SEARCHWORDS' => "reset search words",
    'L_RESTORE' => "recuperare",
    'L_RESTORE_COMPLETE' => "<b>%s</b> tables created.",
    'L_RESTORE_DB' => "Database '<b>%s</b>' on '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "Choose tables to be restored",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Up to now <b>%d</b> of <b>%d</b>"
    ." tables were created.",
    'L_RESTORE_TABLES_COMPLETED0' => "Up to now <b>%d</b> tables were"
    ." created.",
    'L_REVERSE' => "Last entry first",
    'L_SAFEMODEDESC' => "Because PHP is running in safe_mode"
    ." you need to create the following"
    ." directories manually using your"
    ." FTP-Programm:",
    'L_SAVE' => "Save",
    'L_SAVEANDCONTINUE' => "Save and continue installation",
    'L_SAVE_ERROR' => "Setările nu a putut fi salvat!",
    'L_SAVE_SUCCESS' => "Setările de succes au fost stocate"
    ." în fişierul de configurare \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Salvaţi de date la baza de date '%s'"
    ." în fişierul de '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Mărimea maximă a fişierului ajuns:"
    ." Continuaţi cu dosar '%s'",
    'L_SAVING_DB_FORM' => "basâ de date",
    'L_SAVING_TABLE' => "Salvare de tabele",
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
    'L_SECONDS' => "secunde",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "selecteaza tot",
    'L_SELECTED_FILE' => "Selected file",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "send result as file",
    'L_SEND_MAIL_FORM' => "Trimite E-mail",
    'L_SERVER' => "serverul",
    'L_SERVERCAPTION' => "selectati serverul",
    'L_SETPRIMARYKEYSFOR' => "nou primarâ cheie pentru tabele",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "show result",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Viteză",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Înălţimea SQL-Box",
    'L_SQLLIB_ACTIVATEBOARD' => "activate Board",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "deactivate Board",
    'L_SQLLIB_GENERALFUNCTIONS' => "general functions",
    'L_SQLLIB_RESETAUTO' => "reset auto-increment",
    'L_SQLLIMIT' => "Numărul de înregistrări pe pagină",
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
    'L_SQL_COMMANDS' => "SQL-comanda",
    'L_SQL_COMMANDS_IN' => "lines in",
    'L_SQL_COMMANDS_IN2' => "sec. parsed.",
    'L_SQL_COPYDATADB' => "Copy complete Database to",
    'L_SQL_COPYSDB' => "Copy Structure of Database",
    'L_SQL_COPYTABLE' => "copy table",
    'L_SQL_CREATED' => "was created.",
    'L_SQL_CREATEINDEX' => "create new index",
    'L_SQL_CREATETABLE' => "create table",
    'L_SQL_DATAVIEW' => "Data View",
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
    'L_SQL_ERROR1' => "Erori la cererea de:",
    'L_SQL_ERROR2' => "MySQL report:",
    'L_SQL_EXEC' => "Execute SQL Statement",
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
    'L_SQL_TABLEVIEW' => "Table View",
    'L_SQL_TBLNAMEEMPTY' => "Table name can't be empty!",
    'L_SQL_TBLPROPSOF' => "Table properties of",
    'L_SQL_TCOPY' => "Table `%s` was copied with data in"
    ." Table `%s`.",
    'L_SQL_UPLOADEDFILE' => "loaded file:",
    'L_SQL_VIEW_COMPACT' => "View: compact",
    'L_SQL_VIEW_STANDARD' => "View: standard",
    'L_SQL_VONINS' => "from totally",
    'L_SQL_WARNING' => "The execution of SQL Statements can"
    ." manipulate data. TAKE CARE! The"
    ." Authors don't accept any liability for"
    ." damaged or lost data.",
    'L_SQL_WASCREATED' => "was created",
    'L_SQL_WASEMPTIED' => "was emptied",
    'L_STARTDUMP' => "Start Backup",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "start search",
    'L_STATUS' => "Statut",
    'L_STATUS' => "Statut",
    'L_STEP' => "Step",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Fişier de configurare \"%s\" a fost"
    ." creat cu succes.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "Fişier de configurare \"%s\" a fost"
    ." şters cu succes.",
    'L_TABLE' => "Tabele",
    'L_TABLES' => "Tabele",
    'L_TABLESELECTION' => "Selecţie de tabele",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "testare de conexiune",
    'L_THEME' => "Style",
    'L_TIME' => "Time",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Fulltext key",
    'L_TITLE_KEY_PRIMARY' => "Primary key",
    'L_TITLE_KEY_UNIQUE' => "Unique key",
    'L_TITLE_MYSQL_HELP' => "MySQL documentation",
    'L_TITLE_NOKEY' => "No key",
    'L_TITLE_SEARCH' => "Search",
    'L_TITLE_SHOW_DATA' => "aratâ datele",
    'L_TITLE_UPLOAD' => "Upload SQL file",
    'L_TO' => "până la",
    'L_TOOLS' => "Tools",
    'L_TOOLS' => "Tools",
    'L_TOOLS_TOOLBOX' => "Select Database / Datebase functions /"
    ." Import - Export",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "nu cunoscuţi",
    'L_UNKNOWN_SQLCOMMAND' => "unknown SQL-Command",
    'L_UPDATE' => "Update",
    'L_UPTO' => "până",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "conţinut",
    'L_VERSIONSINFORMATIONEN' => "informaţii despre versiune",
    'L_VIEW' => "privi",
    'L_VISIT_HOMEPAGE' => "vizitâ Homepage",
    'L_VOM' => "de la",
    'L_WITH' => "cu",
    'L_WITHATTACH' => "cu anexa",
    'L_WITHOUTATTACH' => "fără anexa",
    'L_WITHPRAEFIX' => "cu prefix",
    'L_WRONGCONNECTIONPARS' => "Incorectâ sau parametrii greşti de"
    ." conexiune!",
    'L_WRONG_CONNECTIONPARS' => "Parametrii de conectare nu sunt"
    ." corecte!",
    'L_WRONG_RIGHTS' => "Fişier sau director '%s' nu poate fi"
    ." scris pentru mine.<br />Fie ea a"
    ." greşit proprietarul (owner) sau"
    ." drepturile de greşit (chmod).<br"
    ." />Vă rugăm să setaţi atribute"
    ." corect cu programul FTP.<br />Fişier"
    ." sau director are nevoie de drepturi"
    ." %s.<br />",
    'L_YES' => "da",
));
