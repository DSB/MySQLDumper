<?php
// Die Sprachdateien werden in der config.php geladen. Deswegen muss diese vorher stets eingebunden werden, damit
// die unten aufgeführten Variablen zur Verfügung stehen.

$cron_script=$rootdir.'/cron_dump.php';
$cron_abs=$_SERVER["DOCUMENT_ROOT"].'/cron_dump.php';

// Allgemeine Texte
$l["no"]="no";
$l["yes"]="yes";
$l["activated"]="activated";
$l["not_activated"]="not activated";
$l["error"]="Error";
$l["added"]="added";
$l["first_run"]="Database found:";
$l["dbrefresh"]="refresh Database list";
$l["db"]="Database";

//Hilfe-Texte
$l["help_db"]="This is the list of all Databases";
$l["help_praefix"]="the prefix is a string at the beginning of a table name, which works as a filter.";
$l["help_zip"]="Compression with GZip - recommended state is 'activated'";
$l["help_budir"]="Here is the folder where backups are placed..";
$l["help_mail1"]="If activated, then after a backup, an email is sent with the backup as an attachment.";
$l["help_mail2"]="This is the receiver of the email.";
$l["help_mail3"]="This is the  sender of the email.";
$l["help_ad1"]="If activated, then backup files will be deleted automatically.";
$l["help_ad2"]="the maximum number of days to keep backup file (for autodelete)";
$l["help_ad3"]="the maximum number of backup files (for autodelete)";
$l["help_lang"]="select your language";
$l["help_crontime"]="the time in seconds the cronscript will get on top";

$l["help_dumpz"]="this are the number of records which are being read simultaneously while backup";
$l["help_restorez"]="this are the number of records which are being read simultaneously while restore";


// Text in filemanagement.php
$l["fm_title"]="File management";
$l["fm_uploadfilerequest"]="please choose a file.";
$l["fm_uploadnotallowed1"]="This file type is not supported.";
$l["fm_uploadnotallowed2"]="Valid types are: *.gz and *.sql-files";
$l["fm_uploadmoveerror"]="Couldn't move selected file to the upload-directory.";
$l["fm_uploadfailed"]="The upload has failed!";
$l["fm_uploadfileexists"]="A file with the same name already exists !";
$l["fm_nofile"]="You didn't choose a file!";
$l["fm_delete1"]="The file ";
$l["fm_delete2"]=" was deleted successfully.";
$l["fm_delete3"]=" couldn't be deleted!";
$l["fm_filename"]="Filename";
$l["fm_filesize"]="Filesize";
$l["fm_nofilesfound"]="No file found.";
$l["fm_sizesum"]="Total size";
$l["fm_freespace"]="Free space on server";
$l["fm_choosefile"]="Choose a file to restore or delete:";
$l["fm_restore"]="Restore";
$l["fm_alertrestore1"]="Should the database";
$l["fm_alertrestore2"]="be restored with the records from the file";
$l["fm_alertrestore3"]=" ?";
$l["fm_delete"]="Delete";
$l["fm_askdelete1"]="Should the file ";
$l["fm_askdelete2"]=" really be deleted?";
$l["fm_askdelete3"]="Do you want autodelete to be executed with configured rules now?";
$l["fm_askdelete4"]="Do you want to delete all backup files?";
$l["fm_askdelete5"]="Do you want to delete all backup files with ".$dbname."_* ?";
$l["fm_deleteauto"]="execute autodelete manually";
$l["fm_deleteall"]="delete all backup files";
$l["fm_deleteallfilter"]="delete all with ".$dbname."_*";
$l["choose_file"]="chosen file:";

$l["fm_newdump"]="Or start a new backup:";
$l["fm_startdump"]="Start new backup";
$l["fm_upload"]="Or upload file:";
$l["fm_fileupload"]="upload file";
$l["fm_files"]="Files in the backup-directory";
$l["fm_autodel1"]="Autodelete: the following files were deleted because of maximum files setting:";
$l["fm_autodel2"]="Autodelete: the following files were deleted because of their date:";

$l["fm_dumpsettings"]="The following Database will be saved with the following [prefix]:<strong> $dbname [$dbpraefix]</strong>";

$l["cron_adress"]="Address of the cronscripts: <a href=\"".$cron_script."\" style=\"text-decoration:underline\">".$cron_script."</a>";
$l["cron_desc"]="The Cronscript doesn't use any screen output and use the configured parameters incl. mail and FTP-sending.<br>Please make sure that the Backup works correctly with your parameters before using the cronscript.<br>problems may occur with too few timelimit. See in the log how long the process has taken.<br>The Cronscript can be found on the server here: '".$cron_abs."' <br>IMPORTANT: The script works only with smaller databases!";
$l["DoCronButton"]="Do the Perl-Cronscript";
$l["cronperldesc"]="This only works if you have Perl and the rights to use it <br>The address of the script is ";


// Text in dump.php
$l["dump"]="Backup";
$l["dump_headline"]="Create backup...";
$l["gzip_compression"]="GZip-Compression is";
$l["on"]="on";
$l["off"]="off";
$l["saving_table"]="Saving table ";
$l["of"]="of";
$l["actual_table"]="Actual table";
$l["progress_table"]="Progress of table";
$l["progress_over_all"]="Overall Progress";
$l["entry"]="Entry";
$l["done"]="Done!";
$l["file"]="File";
$l["dump_successful"]=" was successfully created.";
$l["upto"]="up to";
$l["email_was_send"]="The dumpfile was successfully sent by email.";
$l["back_to_control"]="Continue";
$l["dump_filename"]="Backup-File: ";

$l["dump_notables"]="There are no tables found in the database '<b>".$dbname."</b>'.";
$l["dump_endergebnis1"]="The Backup saved ";
$l["dump_endergebnis2"]=" Tables with  ";
$l["dump_endergebnis3"]=" records.<br>";
$l["mailerror"]="The sending of the Email has failed!";
$l["emailbody"]="In the Attachment you find the Backup of your MySQL-Database.\n\rBackup of Database '".$dbname."' from ".date("Y-m-d",time())."\n\r\n\rKind regards\n\r\n\rMySQLDump\n\rhttp://www.daniel-schlichtholz.de/board";

// Text in restore.php
$l["restore"]="Restore";
$l["restore_db"]="of database '<b>".$dbname."</b>' on '<b>".$dbhost."</b>'.<br>";
$l["restore_complete"]="</b> tables restore completed.";
$l["restore_run1"]="<br>up to now <b>";
$l["restore_run2"]="</b> records were successfully added.";
$l["restore_run3"]="<br>momentary the table '<b>";
$l["restore_run4"]="</b>' is receiving data.<br>";
$l["restore_run5"]="of the file finished.";
$l["restore_total_complete"]="<br><b>Congratulations.</b><br><br>The restoration of the database is done.<br>All data from the backup-file was re-restored..<br><br>Everything is done. :-)";
$l["db_no_connection"]="Connection to database failed!";
$l["db_select_error"]="<br>Error:<br>Selection of database '<b>".$dbname."</b>' failed!";
$l["file_open_error"]="Error: could not open file.";
$l["restore_entryerror"]="Error: command can't be done:";

// Text in config_overview.php - Status
$l["config_headline"]="Configuration";
$l["dump_dir"]="Dumpfile will be saved in directory '<b>".realpath($path)."</b>'.";
$l["saving_db"]="Database '<b>".$dbhost."/".$dbname."</b>' will be backed up.";
$l["send_mail"]="The dumpfile will be emailed to '<b>".$email[0]."</b>'.";
$l["no_send_mail"]="The dumpfile won't be mailed to anyone.";
$l["del_files"]="Files will be deleted automatically, when they are older than '<b>".$del_files."</b>' days.";
$l["no_del_files"]="There is no age limit for the backupfiles.";
$l["number_of_files"]="Files will be deleted automatically, when more than '<b>".$number_of_files."</b>' are stored in ".realpath($path).".";
$l["no_number_of_files"]="There is no limit to the number of backupfiles.";
$l["save_success"]="Configuration was saved.";
$l["save_error"]="Error - unable to save configuration!";
$l["config_databases"]="Databases";
$l["config_dumprestore"]="Backup / Restore";
$l["config_email"]="Email-Notification";
$l["config_autodelete"]="delete automatically";
$l["config_interface"]="Interface";
$l["config_cron"]="Crondump-Settings";
$l["cron_timelimit"]="Timelimit for Cronjob";
$l["praefix"]="Table-Prefix";
$l["config_askload"]="Do you want to override the actual settings with the default settings?";
$l["load"]="load default settings";
$l["load_success"]="The default settings were loaded.";
$l["cron_samedb"]="take database from configuration";
$l["cron_crondbindex"]="Database and Table-Prefix<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for the Cronjob";
$l["dump_zeilen"]="Number of records for backup";
$l["restore_zeilen"]="Number of records for restore";


// Text in config_overview.php - Formular
$l["gzip"]="GZip-compression";
$l["backup_dir"]="Directory for Backup files";
$l["db_host"]="Host name";
$l["saving_db_form"]="Database";
$l["db_user"]="User";
$l["db_pass"]="Password";
$l["send_mail_form"]="Send dumpfile as email";
$l["email_adress"]="Email address";
$l["email_subject"]="Sender address of the email";
$l["age_of_files"]="Delete by age of files (in days)";
$l["number_of_files_form"]="Delete by number of files";
$l["language"]="Language";
$l["list_db"]="Configured Databases:";
$l["save"]="Save";
$l["reset"]="Reset";
$l["autodelete"]="delete backups automatically";
$l["config_cron"]="Crondump-Settings";
$l["cron_timelimit"]="Timelimit for Cronjob";
$l["cron_samedb"]="take Database from Configuration";
$l["cron_crondbindex"]="Database for the Cronjob";

$l["help_ftptransfer"]="if activated, the Backupfile will be sent via FTP.";
$l["help_ftpserver"]="Address of the FTP-Server";
$l["help_ftpport"]="Port of the FTP-Server, standard: 21";
$l["help_ftpuser"]="enter username for FTP";
$l["help_ftppass"]="enter password for FTP";
$l["help_ftpdir"]="where is the upload-dir? enter path!";

$l["config_ftp"]="FTP-Transfer of Backupfile";

$l["ftp_transfer"]="FTP-Transfer";
$l["ftp_server"]="FTP Server";
$l["ftp_port"]="FTP Port";
$l["ftp_user"]="FTP User";
$l["ftp_pass"]="FTP Password";
$l["ftp_dir"]="FTP Upload-Dir";


// Sprachen
$l["lang_de"]="German";
$l["lang_en"]="English";

// Text aus menu.php
$l["load_database"]="Reload databases";
$l["home"]="Home";
$l["config"]="Config";
$l["file_manage"]="Management";
$l["log"]="Log";
$l["project"]="About this project";
$l["choose_db"]="choose Database";
$l["credits"]="Credits / Help";

//Log
$l["log_delete"]="delete Log";

// Texte aus info.php
$l["info_location"]="Your location is ";
$l["info_browser"]="Your Browser is";
$l["info_admin"]="The Server's administrator is ";
$l["info_databases"]="The following database(s) are on your server:";
$l["info_nodb"]="database doesn't exist.";
$l["info_table1"]="Table";
$l["info_table2"]="s";
$l["info_dbdetail"]="Detail-Info of database ";
$l["info_dbempty"]="The database is empty !";
$l["info_records"]="Records";
$l["info_size"]="Size";
$l["info_lastupdate"]="last Update";
$l["info_sum"]="total";
$l["info_rechte"]="Your Priviliges";
$l["clear_database"]="Clear database";
$l["delete_database"]="Delete database";
$l["create_database"]="Create new database:";
$l["button_create_database"]="Create";

$l["info_created"]="created";
$l["info_cleared"]="was cleared";
$l["info_deleted"]="was deleted";

$l["info_workdir"]="Working directory";
$l["info_backupdir"]="Backup directory";
$l["info_cgidir"]="CGI-Bin-Directory";
$l["info_cginr"]="does not exist or is forbidden";
$l["info_actdb"]="Actual Database";

$l["info_emptydb1"]="Should the Database";
$l["info_emptydb2"]=" be truncated? (Attention: All Data will be lost forever!)";
$l["info_killdb"]=" be deleted? (Attention: All Data will be lost forever!)";


?>