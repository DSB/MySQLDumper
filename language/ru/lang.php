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
    'L_ACTION' => "Действие",
    'L_ACTIVATED' => "активировано",
    'L_ACTUALLY_INSERTED_RECORDS' => "Up to now <b>%s</b> records were"
    ." successfully added.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Up to now  <b>%s</b> of <b>%s</b>"
    ." records were successfully added.",
    'L_ADD' => "Add",
    'L_ADDED' => "добавлено",
    'L_ADD_DB_MANUALLY' => "Add database manually",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "все",
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
    'L_ATTACH_BACKUP' => "Attach backup",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "Автоматическое"
    ." удаление резервных"
    ." копий",
    'L_BACK' => "назад",
    'L_BACKUPFILESANZAHL' => "В папке резервных"
    ." копий находятся",
    'L_BACKUPS' => "Резервные копии",
    'L_BACKUP_DBS' => "DBs to backup",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Database Overview",
    'L_BACK_TO_OVERVIEW' => "Database Overview",
    'L_CALL' => "Call",
    'L_CANCEL' => "отмена",
    'L_CANT_CREATE_DIR' => "Не получилось"
    ." создать папку '%s'."
    ." Пожалуйста, создайте"
    ." её с помощью вашего"
    ." FTP-клиента.",
    'L_CHANGE' => "Изменить",
    'L_CHANGEDIR' => "change to dir",
    'L_CHANGEDIR' => "Changing to Directory",
    'L_CHANGEDIRERROR' => "change to dir was not possible",
    'L_CHANGEDIRERROR' => "Couldn`t change directory!",
    'L_CHARSET' => "Набор символов",
    'L_CHECK' => "Check",
    'L_CHECK' => "Проверить",
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
    'L_CHOOSE_DB' => "выбрать базу данных",
    'L_CLEAR_DATABASE' => "Опустошить базу"
    ." данных",
    'L_CLOSE' => "Закрыть",
    'L_COLLATION' => "Сортировка",
    'L_COMMAND' => "Command",
    'L_COMMAND' => "Command",
    'L_COMMAND_AFTER_BACKUP' => "Команда после"
    ." сохранения"
    ." резервной копии",
    'L_COMMAND_BEFORE_BACKUP' => "Команда поред"
    ." сохранением"
    ." резервной копии",
    'L_COMMENT' => "Комментарий",
    'L_COMPRESSED' => "сжато (gz)",
    'L_CONFBASIC' => "Basic Parameter",
    'L_CONFIG' => "Настройки",
    'L_CONFIGFILE' => "Config File",
    'L_CONFIGFILES' => "Configuration Files",
    'L_CONFIGURATIONS' => "Configurations",
    'L_CONFIG_AUTODELETE' => "Autodelete",
    'L_CONFIG_CRONPERL' => "Crondump Settings for Perl script",
    'L_CONFIG_EMAIL' => "Email Notification",
    'L_CONFIG_FTP' => "FTP Transfer of Backup file",
    'L_CONFIG_HEADLINE' => "Configuration",
    'L_CONFIG_INTERFACE' => "Interface",
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
    'L_CONNECT' => "connect",
    'L_CONNECTIONPARS' => "Connection Parameter",
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
    'L_CREATE' => "создать",
    'L_CREATEAUTOINDEX' => "Create Auto-Index",
    'L_CREATEDIRS' => "Create Directories",
    'L_CREATE_CONFIGFILE' => "Create a new configuration file",
    'L_CREATE_DATABASE' => "создать новую базу"
    ." данных",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Помощь / Участники"
    ." проекта",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Enter Comment",
    'L_CRON_COMPLETELOG' => "Записывать все"
    ." операции в лог",
    'L_CRON_EXECPATH' => "Path of Perl scripts",
    'L_CRON_EXTENDER' => "File extension",
    'L_CRON_PRINTOUT' => "Print output on screen.",
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
    'L_DATASIZE' => "Размер данных",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "день",
    'L_DAYS' => "дней",
    'L_DB' => "База данных",
    'L_DBCONNECTION' => "Database Connection",
    'L_DBPARAMETER' => "Database Parameters",
    'L_DBS' => "Базы данных",
    'L_DB_BACKUPPARS' => "Database Backup Parameter",
    'L_DB_HOST' => "Хост базы данных",
    'L_DB_IN_LIST' => "The database '%s' couldn't be added"
    ." because it is allready existing.",
    'L_DB_PASS' => "Пароль к базе данных",
    'L_DB_SELECT_ERROR' => "<br />Error:<br />Selection of"
    ." database <b>",
    'L_DB_SELECT_ERROR2' => "</b> failed!",
    'L_DB_USER' => "Имя пользователя"
    ." базы данных",
    'L_DEFAULT_CHARSET' => "Default character set",
    'L_DELETE' => "Delete",
    'L_DELETE_DATABASE' => "Удалить базу данных",
    'L_DELETE_FILE_ERROR' => "Error deleting file \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "File \"%s\" was deleted successfully.",
    'L_DELETE_HTACCESS' => "Удалить защиту папки"
    ." (.htaccess)",
    'L_DESELECTALL' => "Deselect all",
    'L_DIR' => "папка",
    'L_DISABLEDFUNCTIONS' => "Disabled Functions",
    'L_DISABLEDFUNCTIONS' => "отключенные функции",
    'L_DO' => "Выполнить",
    'L_DOCRONBUTTON' => "Run the Perl Cron script",
    'L_DONE' => "Done!",
    'L_DONT_ATTACH_BACKUP' => "Не вкладывать"
    ." резервную копию",
    'L_DOPERLTEST' => "Test Perl Modules",
    'L_DOSIMPLETEST' => "Test Perl",
    'L_DOWNLOAD_FILE' => "Скачать файл",
    'L_DO_NOW' => "operate now",
    'L_DUMP' => "Сделать резервную"
    ." копию",
    'L_DUMP_ENDERGEBNIS' => "The file contains <b>%s</b> tables"
    ." with <b>%s</b> records.<br />",
    'L_DUMP_FILENAME' => "Backup File",
    'L_DUMP_HEADLINE' => "Create backup...",
    'L_DUMP_NOTABLES' => "No tables found in database `%s`",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Продолжительность",
    'L_EDIT' => "edit",
    'L_EHRESTORE_CONTINUE' => "continue and log errors",
    'L_EHRESTORE_STOP' => "stop",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "The Attachment contains the backup of"
    ." your MySQL-Database.<br />Backup of"
    ." Database `%s`
<br /><br />Following"
    ." File was created:<br /><br />%s <br"
    ." /><br />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "`<br /><br />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "A Multipart Backup was created.<br"
    ." />The Backup files are attached to"
    ." separate emails.<br />Backup of"
    ." Database `%s`
<br /><br />Following"
    ." Files were created:<br /><br />%s <br"
    ." /><br />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "A Multipart Backup was created.<br"
    ." />The Backup files are not attached to"
    ." this email!<br />Backup of Database"
    ." `%s`
<br /><br />Following Files were"
    ." created:<br /><br />%s
<br /><br"
    ." />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "Files are not attached to this"
    ." email!<br />Backup of Database"
    ." `%s`
<br /><br />Following File was"
    ." created:<br /><br />%s
<br /><br"
    ." />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "The Backup file exceeded the maximum"
    ." size of %s and was not attached to"
    ." this email.<br />Backup of Database"
    ." `%s`
<br /><br />Following File was"
    ." created:<br /><br />%s
<br /><br"
    ." />Kind regards<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "Электронная почта",
    'L_EMAIL_CC' => "CC-Receiver",
    'L_EMAIL_MAXSIZE' => "Maximum size of attachment",
    'L_EMAIL_ONLY_ATTACHMENT' => "... attachment only.",
    'L_EMAIL_RECIPIENT' => "Receiver",
    'L_EMAIL_SENDER' => "Sender address of the email",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "Email was successfully sent to",
    'L_EMPTY' => "Empty",
    'L_EMPTYKEYS' => "empty and reset indexes",
    'L_EMPTYTABLEBEFORE' => "Empty table before",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Delete tables before restoring",
    'L_ENCODING' => "encoding",
    'L_ENCRYPTION_TYPE' => "Способ шифрования",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Entry",
    'L_ERROR' => "ошибка",
    'L_ERRORHANDLING_RESTORE' => "Error Handling while restoring",
    'L_ERROR_CONFIGFILE_NAME' => "Filename \"%s\" contains invalid"
    ." characters.",
    'L_ERROR_DELETING_CONFIGFILE' => "Error: couldn't delete configuration"
    ." file %s!",
    'L_ERROR_LOADING_CONFIGFILE' => "Couldn't load configfile \"%s\".",
    'L_ERROR_LOG' => "Протокол ошибок",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Предпологаемый"
    ." конец",
    'L_EXCEL2003' => "Excel from 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Export",
    'L_EXPORTFINISHED' => "Экспорт закончен.",
    'L_EXPORTLINES' => "<strong>%s</strong> lines exported",
    'L_EXPORTOPTIONS' => "Export Options",
    'L_EXTENDEDPARS' => "Extended Parameter",
    'L_FADE_IN_OUT' => "Display on/off",
    'L_FATAL_ERROR_DUMP' => "Fatal error: the CREATE-Statement of"
    ." table '%s' in database '%s' couldn't"
    ." be read!",
    'L_FIELDS' => "Поля",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "файл",
    'L_FILES' => "Файлы",
    'L_FILESIZE' => "размер файла",
    'L_FILE_MANAGE' => "Менеджер файлов",
    'L_FILE_OPEN_ERROR' => "Error: could not open file.",
    'L_FILE_SAVED_SUCCESSFULLY' => "Файл успешно"
    ." сохранён",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "При сохранении файла"
    ." произошла ошибка",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Отфильтровать по",
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
    'L_FM_FREESPACE' => "Свободное место на"
    ." сервере",
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
    'L_FTP_DIR' => "Upload directory",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "FTP parameter are ok",
    'L_FTP_OK' => "Connection successful.",
    'L_FTP_PASS' => "Password",
    'L_FTP_PASSIVE' => "use passive mode",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "to <strong>%s</strong><br /> into"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Server",
    'L_FTP_SSL' => "Secure SSL FTP connection",
    'L_FTP_START' => "Starting FTP transfer",
    'L_FTP_TIMEOUT' => "Connection Timeout",
    'L_FTP_TRANSFER' => "FTP Transfer",
    'L_FTP_USER' => "User",
    'L_FTP_USESSL' => "use SSL Connection",
    'L_GENERAL' => "Общее",
    'L_GENERAL' => "General",
    'L_GZIP' => "GZip compression",
    'L_GZIP_COMPRESSION' => "GZip Compression",
    'L_HOME' => "Начало",
    'L_HOUR' => "час",
    'L_HOURS' => "часов",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Активировать"
    ." преобразование",
    'L_HTACC_ADD_HANDLER' => "Добавить обработчик",
    'L_HTACC_CONFIRM_DELETE' => "Создать защиту папки"
    ." прямо сейчас?",
    'L_HTACC_CONTENT' => "Содержимое файла",
    'L_HTACC_CREATE' => "создать защиту папки",
    'L_HTACC_CREATED' => "Защита папки"
    ." созданна.",
    'L_HTACC_CREATE_ERROR' => "При попытке создания"
    ." защиты папки"
    ." произошла ошибка!<br"
    ." />Создайте,"
    ." пожалуйста, вручную"
    ." файл со следующим"
    ." содержанием",
    'L_HTACC_CRYPT' => "Crypt (макс. 8 знаков,"
    ." системы Linux и Windows)",
    'L_HTACC_DENY_ALLOW' => "Запретить /"
    ." Разрешить",
    'L_HTACC_DIR_LISTING' => "Обзор папки",
    'L_HTACC_EDIT' => "Редактировать .htaccess",
    'L_HTACC_ERROR_DOC' => "Страница ошибки",
    'L_HTACC_EXAMPLES' => "Примеры и"
    ." документация .htaccess",
    'L_HTACC_EXISTS' => "Защита папки уже"
    ." существует",
    'L_HTACC_MAKE_EXECUTABLE' => "Сделать выполняемой.",
    'L_HTACC_MD5' => "MD5 (системы Linux и Unix)",
    'L_HTACC_NO_ENCRYPTION' => "Незашифрованый (Windows)",
    'L_HTACC_NO_USERNAME' => "Задайте имя"
    ." пользователя!",
    'L_HTACC_PROPOSED' => "Настоятельно"
    ." рекомендовано",
    'L_HTACC_REDIRECT' => "Перенаправление",
    'L_HTACC_SCRIPT_EXEC' => "Запустить скрипт",
    'L_HTACC_SHA1' => "SHA1 (все системы)",
    'L_HTACC_WARNING' => "Внимание! .htaccess"
    ." влияет на"
    ." доступность"
    ." страницы. При"
    ." неправильном"
    ." приминении доступ к"
    ." страницам будет"
    ." невозможен.",
    'L_IMPORT' => "Import Configuration",
    'L_IMPORT' => "Import",
    'L_IMPORTIEREN' => "Import",
    'L_IMPORTOPTIONS' => "Import Options",
    'L_IMPORTSOURCE' => "Import Source",
    'L_IMPORTTABLE' => "Import in Table",
    'L_IMPORT_NOTABLE' => "No table was selected for import!",
    'L_IN' => "в",
    'L_INFO_ACTDB' => "Tекущая база данных",
    'L_INFO_DATABASES' => "Доступные базы"
    ." данных",
    'L_INFO_DBEMPTY' => "База данных пуста!",
    'L_INFO_FSOCKOPEN_DISABLED' => "К сожалению на этом"
    ." сервере PHP функция"
    ." fsockopen() выключена в"
    ." настройках сервера."
    ." Поэтому языковые"
    ." пакеты не могут быть"
    ." скачаны"
    ." автоматически.

Однако,"
    ." вы можете скачать"
    ." нужные пакеты"
    ." вручную, распаковать"
    ." и загрузить их с"
    ." помощью FTP менеджера"
    ." в папку \"languages\" в"
    ." вашей версии MySQLDumper."
    ." После этого вы"
    ." сможете выбрать"
    ." здесь эти пакеты.",
    'L_INFO_LASTUPDATE' => "Последнее"
    ." обновление",
    'L_INFO_LOCATION' => "Вы находитесь на",
    'L_INFO_NODB' => "База данных не"
    ." существует.",
    'L_INFO_NOPROCESSES' => "Нет работающих"
    ." процесов",
    'L_INFO_NOSTATUS' => "Нет статуса",
    'L_INFO_NOVARS' => "Нет переменных",
    'L_INFO_OPTIMIZED' => "Оптимировано",
    'L_INFO_RECORDS' => "Строк",
    'L_INFO_RECORDS' => "records",
    'L_INFO_SIZE' => "Размер",
    'L_INFO_SUM' => "Всего",
    'L_INSTALL' => "Installation",
    'L_INSTALL' => "Installation",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(empty = Default Port)",
    'L_INSTALL_HELP_SOCKET' => "(empty = Default Socket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Завершить процес",
    'L_LANGUAGE' => "Language",
    'L_LASTBACKUP' => "Последняя резервная"
    ." копия",
    'L_LOAD' => "Load default settings",
    'L_LOAD_DATABASE' => "Перезагрузить базы"
    ." данных",
    'L_LOAD_FILE' => "Загрузить файл",
    'L_LOG' => "Лог",
    'L_LOGFILENOTWRITABLE' => "Не получилось"
    ." записать файл лога.",
    'L_LOGFILENOTWRITABLE' => "Can't write Log file !",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "delete Log",
    'L_MAILERROR' => "Sending of email failed!",
    'L_MAILPROGRAM' => "Mail program",
    'L_MAXSIZE' => "Max. Size",
    'L_MAX_BACKUP_FILES_EACH2' => "Для каждой базы"
    ." данных",
    'L_MAX_EXECUTION_TIME' => "Максимальное время"
    ." выполнения",
    'L_MAX_UPLOAD_SIZE' => "Maximum filesize",
    'L_MAX_UPLOAD_SIZE' => "Maximum file size",
    'L_MAX_UPLOAD_SIZE_INFO' => "If your Dumpfile is bigger than the"
    ." above mentioned limit, you must upload"
    ." it via FTP into the directory"
    ." \"work/backup\". 
After that you can"
    ." choose it to begin a restore progress.",
    'L_MEMORY' => "память",
    'L_MESSAGE' => "Сообщение",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Минута",
    'L_MINUTES' => "Минут",
    'L_MODE_EASY' => "Простой",
    'L_MODE_EXPERT' => "Экспертный",
    'L_MSD_INFO' => "Информация о MySQLDumper",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "Версия MySQLDumper",
    'L_MULTIDUMP' => "Составной образ",
    'L_MULTIDUMP_FINISHED' => "Backup of <b>%d</b> Databases done",
    'L_MULTIPART_ACTUAL_PART' => "Текущая часть образа",
    'L_MULTIPART_SIZE' => "Максимальный размер"
    ." файла",
    'L_MULTI_PART' => "Составная резервная"
    ." копия",
    'L_MYSQLVARS' => "переменные MySQL",
    'L_MYSQL_CLIENT_VERSION' => "Версия клиентской"
    ." программы MySQL",
    'L_MYSQL_CONNECTION_ENCODING' => "Стандартная"
    ." кодировка сервера"
    ." MySQL",
    'L_MYSQL_DATA' => "MySQL-Data",
    'L_MYSQL_VERSION' => "Версия MySQL",
    'L_NAME' => "Name",
    'L_NAME' => "Name",
    'L_NEW' => "Новый",
    'L_NEWTABLE' => "New table",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "нет",
    'L_NOFTPPOSSIBLE' => "You don't have FTP functions !",
    'L_NOFTPPOSSIBLE' => "Функции FTP"
    ." отсутсвуют",
    'L_NOFTPPOSSIBLE' => "You don't have FTP functions !",
    'L_NOGZPOSSIBLE' => "You don't have compression functions !",
    'L_NOGZPOSSIBLE' => "Фунции GZip"
    ." отсутствую, как как"
    ." не установлено"
    ." расширение zlib",
    'L_NONE' => "Никакие",
    'L_NOREVERSE' => "Oldest entry first",
    'L_NOTAVAIL' => "<em>отсутствует</em>",
    'L_NOTICE' => "Уведомление",
    'L_NOTICES' => "Уведомления",
    'L_NOT_ACTIVATED' => "Не активировано",
    'L_NOT_SUPPORTED' => "This backup doesn't support this"
    ." function.",
    'L_NO_DB_FOUND' => "I couldn't find any databases"
    ." automatically!
Please unhide the"
    ." connection parameters, and enter the"
    ." name of your database manually.",
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
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s tables have been optimized.",
    'L_NUMBER_OF_FILES_FORM' => "Delete by number of files per database",
    'L_OF' => "из",
    'L_OF' => "of",
    'L_OK' => "ОК",
    'L_OPTIMIZE' => "Optimize",
    'L_OPTIMIZE_TABLES' => "Optimize Tables before Backup",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Операционная"
    ." система",
    'L_PAGE_REFRESHS' => "Обновления страниц",
    'L_PASS' => "Password",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "Пароли не совпадают"
    ." либо пусты.",
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
    'L_PHPBUG' => "Ошибка в zlib! Сжатие"
    ." невозможно.",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "Расширения PHP",
    'L_PHP_VERSION' => "Версия PHP",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Port",
    'L_PORT' => "Порт",
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
    'L_PREFIX' => "Префикс",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "Сохранить первичные"
    ." ключи",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Действительно"
    ." удалить первичные"
    ." ключи?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "Поле первичного"
    ." ключа",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "Пытаюсь закончить"
    ." процесс",
    'L_PROCESSKILL2' => ".",
    'L_PROCESSKILL3' => "Пытаюсь уже",
    'L_PROCESSKILL4' => "секунд(у) закончить"
    ." процесс",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Overall Progress",
    'L_PROGRESS_OVER_ALL' => "Overall Progress",
    'L_PROGRESS_TABLE' => "Progress of table",
    'L_PROVIDER' => "Provider",
    'L_PROZESSE' => "Processes",
    'L_RECHTE' => "Permissions",
    'L_RECORDS' => "Records",
    'L_RECORDS_INSERTED' => "<b>%s</b> records inserted.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Reload",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "Reset",
    'L_RESET_SEARCHWORDS' => "reset search words",
    'L_RESTORE' => "Restore",
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
    'L_SAVE_ERROR' => "Error - unable to save configuration!",
    'L_SAVE_SUCCESS' => "Configuration was saved succesfully"
    ." into configuration file \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Database",
    'L_SAVING_TABLE' => "Saving table",
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
    'L_SECONDS' => "Seconds",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "Select All",
    'L_SELECTED_FILE' => "Selected file",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "send result as file",
    'L_SEND_MAIL_FORM' => "Send email report",
    'L_SERVER' => "Сервер",
    'L_SERVERCAPTION' => "Display Server",
    'L_SETPRIMARYKEYSFOR' => "Set new primary keys for table",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "show result",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Height of SQL-Box",
    'L_SQLLIB_ACTIVATEBOARD' => "activate Board",
    'L_SQLLIB_BOARDS' => "Boards",
    'L_SQLLIB_DEACTIVATEBOARD' => "deactivate Board",
    'L_SQLLIB_GENERALFUNCTIONS' => "general functions",
    'L_SQLLIB_RESETAUTO' => "reset auto-increment",
    'L_SQLLIMIT' => "Count of records each page",
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
    'L_SQL_BROWSER' => "Обозреватель SQL",
    'L_SQL_CARDINALITY' => "Cardinality",
    'L_SQL_CHANGED' => "was changed.",
    'L_SQL_CHANGEFIELD' => "change field",
    'L_SQL_CHOOSEACTION' => "Choose action",
    'L_SQL_COLLATENOTMATCH' => "Charset and Collation don't fit"
    ." together!",
    'L_SQL_COLUMNS' => "Columns",
    'L_SQL_COMMANDS' => "SQL Commands",
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
    'L_SQL_ERROR1' => "Error in Query:",
    'L_SQL_ERROR2' => "MySQL says:",
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
    'L_STATUS' => "State",
    'L_STATUS' => "State",
    'L_STEP' => "Step",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Configuration file \"%s\" has"
    ." successfully been created.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "The configuration file \"%s\" has"
    ." successfully been deleted.",
    'L_TABLE' => "Table",
    'L_TABLES' => "Tables",
    'L_TABLESELECTION' => "Table selection",
    'L_TABLE_CREATE_SUCC' => "Таблица '%s' успешно"
    ." созданна.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "Test Connection",
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
    'L_TO' => "до",
    'L_TOOLS' => "Tools",
    'L_TOOLS' => "Tools",
    'L_TOOLS_TOOLBOX' => "Select Database / Datebase functions /"
    ." Import - Export",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "unknown",
    'L_UNKNOWN_SQLCOMMAND' => "unknown SQL-Command",
    'L_UPDATE' => "Update",
    'L_UPTO' => "up to",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "Value",
    'L_VERSIONSINFORMATIONEN' => "Version Information",
    'L_VIEW' => "view",
    'L_VISIT_HOMEPAGE' => "Посетить домашний"
    ." сайт",
    'L_VOM' => "from",
    'L_WITH' => "с",
    'L_WITHATTACH' => "with attach",
    'L_WITHOUTATTACH' => "without attach",
    'L_WITHPRAEFIX' => "with prefix",
    'L_WRONGCONNECTIONPARS' => "Connection parameters wrong or"
    ." missing!",
    'L_WRONG_CONNECTIONPARS' => "Connection parameters are wrong !",
    'L_WRONG_RIGHTS' => "The file or the directory '%s' is not"
    ." writable for me.<br />
The rights"
    ." (chmod) are not set properly or it has"
    ." the wrong owner.<br />
Pleae set the"
    ." correct attributes using your FTP"
    ." program.<br />
The file or the"
    ." directory needs to be set to %s.<br />",
    'L_YES' => "да",
));
