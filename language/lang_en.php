<?

// Allgemeine Texte
$lang['no']='no';
$lang['yes']='yes';
$lang['to']='to';
$lang['activated']='activated';
$lang['not_activated']='not activated';
$lang['error']='Error';
$lang['of']=' of ';
$lang['added']='added';
$lang['first_run']='Database found:';
$lang['dbrefresh']='refresh Database list';
$lang['db']='Database';
$lang['dbs']='Databases';
$lang['onlinehelp']='Onlinehelp';
$lang['tables']='Tables';
$lang['table']='Table';
$lang['records']='Records';
$lang['compressed']='compressed (gz)';
$lang['general']='general';
$lang['comment']='Comment';
$lang['filesize']='Filesize';
$lang['all']='all';
$lang['none']='none';
$lang['with']=' with ';
$lang['dir']='Directory';
$lang['rechte']='Permissions';
$lang['status']='State';
$lang['never']='never';
$lang['finished']='finished';
$lang['file']='File';
$lang['field']='Field';
$lang['was']='was';
$lang['new']='new';
$lang['charset']='Charset';
$lang['collation']='Collation';
$lang['change']='change';
$lang['in']='in';
$lang['do']='execute';
$lang['errors_occured']='Errors occured';
$lang['view']='view';
$lang['new']='new';
$lang['existing']='existing';

$lang['critical_safemode']='<h3>Attention:Program can\'t continue in Safe-Mode!</h3>Create the following directories manually in the Scriptdirectory:<br><div style="padding-left:20px;"><br>work<br>work/backup<br>work/config<br>work/log<br>work/structure</div><br>Give full permissions to the directories (chmod 777).<br>After that you can use MySQL Dumper without any problems.';

$lang['mailabsendererror']='Mail without Sender can\'t be send !';
$lang['Ausgabe']='Output';
$lang['Zusatz']='Addition';
$lang['Variabeln']='Variables';
$lang['berichtsent']='The Error-Report was sent successfully.';
$lang['autobericht']='automatic generated Error-Report from';
$lang['berichtman1']='Please send the Mail manually to the ';
$lang['Statusinformationen']='State Informations';
$lang['Versionsinformationen']='Version Informations';
$lang['MySQL Dumper Informationen']='MySQL Dumper Informations';
$lang['Fehlerbericht']='Error-Report';
$lang['backupfilesanzahl']='in the Backupdir there are ';
$lang['lastbackup']='Last Backup';
$lang['notavail']='<em>not available</em>';
$lang['vom']='from';
$lang['mysqlvars']='Mysql-Variables';
$lang['mysqlsys']='Mysql-Commands';

$lang['Status']='State';
$lang['Prozesse']='Processes';
$lang['info_novars']='no variables available';
$lang['Inhalt']='Value';
$lang['info_nostatus']='no state available';
$lang['info_noprocesses']='no running processes';

//Hilfe-Texte
$lang['help_db']='This is the list of all Databases';
$lang['help_praefix']='the prefix is a string at the beginning of a table name, which works as a filter.';
$lang['help_sqltrenn']='A Seperator to seperate the SQL-Statements unambiguous.';
$lang['help_zip']='Compression with GZip - recommended state is \'activated\'';
$lang['help_memorylimit']='The max. amount of memory in Bytes for the script'."\n".'0 = deactivated';
$lang['memory_limit']='Memorylimit';
$lang['help_budir']='Here is the folder where backups are placed..';
$lang['help_mail1']='If activated, then after a backup, an email is sent with the backup as an attachment.';
$lang['help_mail2']='This is the receiver of the email.';
$lang['help_mail3']='This is the  sender of the email.';
$lang['help_mail4']='The maximum size for email-attach , if is 0 it will be ignored';
$lang['help_mail5']='Here you can select if the backup should send as email-attach';
$lang['help_ad1']='If activated, then backup files will be deleted automatically.';
$lang['help_ad2']='the maximum number of days to keep backup file (for autodelete)'."\n".'0 = deactivated';
$lang['help_ad3']='the maximum number of backup files (for autodelete)'."\n".'0 = deactivated';
$lang['help_lang']='select your language';
$lang["help_empty_db_before_restore"]='To eleminate useless data you can instruct to empty the database before restore';
$lang['help_crontime']='the time in seconds the cronscript will get on top';
$lang['help_cronmail']='Select if the Cronjob should send the Backup via Mail';
$lang['help_cronmailprg']='the Path to your mailprogram, default is sendmail with given path';
$lang['help_cronmailto']='the Adress for sending mail';
$lang['help_cronftp']='Select if the Cronjob should send the Backup via FTP';
$lang['help_cronzip']='Compression with GZip in Cronjob- recommended state is \'activated\' (you need the Compression-Lib installed!)';
$lang['help_cronperlpath']='The Path to perl must be exact, other the script may not work.'."\n".'Default setting works in most cases.';
$lang['help_cronextender']='The extension of the perlscriptes, default is \'.pl\'';
$lang['help_cronsavepath']='The name of the configurationfile for the perlscript';
$lang['help_cronprintout']='If you want to start the script in the Browser you need it activated.';
$lang['help_cronsamedb']='Use same database in cronjob like configured under Database?';
$lang['help_crondbindex']='choose the database for cronjob';
$lang['help_cronmail_dump']='';


$lang['help_ftptransfer']='if activated, file will be sent via FTP.';
$lang['help_ftpserver']='Address of the FTP-Server';
$lang['help_ftpport']='Port of the FTP-Server, standard: 21';
$lang['help_ftpuser']='enter username for FTP';
$lang['help_ftppass']='enter password for FTP';
$lang['help_ftpdir']='where is the upload-dir? enter path!';
$lang['help_chmod']='Default setting is 777';
$lang['help_speed']='Minimum and maximum speed, default is 50 to 5000';
$lang['speed']='Speed-Control';
$lang['help_cronexecpath']="The place of the perlscripts.\nStarting Point is the HTTP-Adress (like Adresses in the Browser)\nAllowed are absolute or relative entries.";

$lang['cron_execpath']='Path of Perlscripts';
$lang['help_browser']='Select your Browser.'."\n".'Attention: don\'t use Internet Explorer with the setting \'other Browser\' !';

// Text in filemanagement.php
$lang['fm_title']='File Administration';
$lang['fm_uploadfilerequest']='please choose a file.';
$lang['fm_uploadnotallowed1']='This file type is not supported.';
$lang['fm_uploadnotallowed2']='Valid types are: *.gz and *.sql-files';
$lang['fm_uploadmoveerror']='Couldn\'t move selected file to the upload-directory.';
$lang['fm_uploadfailed']='The upload has failed!';
$lang['fm_uploadfileexists']='A file with the same name already exists !';
$lang['fm_nofile']='You didn\'t choose a file!';
$lang['fm_delete1']='The file ';
$lang['fm_delete2']=' was deleted successfully.';
$lang['fm_delete3']=' couldn\'t be deleted!';
$lang['fm_choose_file']='chosen file:';
$lang['fm_filename']='Filename';
$lang['fm_filesize']='Filesize';
$lang["fm_filedate"]='Filedate';
$lang['fm_nofilesfound']='No file found.';
$lang['fm_tables']='Tables';
$lang['fm_records']='Records';

$lang['fm_all_bu']='all backups';
$lang['fm_anz_bu']='Backups';
$lang['fm_last_bu']='last Backup';
$lang['fm_totalsize']='total size';
$lang['fm_selecttables']='Select tables';
$lang['fm_comment']='Enter Comment';

$lang['fm_sizesum']='Total size';
$lang['fm_freespace']='Free space on server';
$lang['fm_choosefile']='Choose a file to restore or delete:';
$lang['fm_restore']='Restore';
$lang['fm_alertrestore1']='Should the database';
$lang['fm_alertrestore2']='be restored with the records from the file';
$lang['fm_alertrestore3']=' ?';
$lang['fm_delete']='Delete';
$lang['fm_askdelete1']='Should the file ';
$lang['fm_askdelete2']=' really be deleted?';
$lang['fm_askdelete3']='Do you want autodelete to be executed with configured rules now?';
$lang['fm_askdelete4']='Do you want to delete all backup files?';
$lang['fm_askdelete5']='Do you want to delete all backup files with ';
$lang['fm_askdelete5_2']='_* ?';
$lang['fm_deleteauto']='execute autodelete manually';
$lang['fm_deleteall']='delete all backup files';
$lang['fm_deleteallfilter']='delete all with ';
$lang['fm_deleteallfilter2']='_*';
$lang['fm_newdump']='Or start a new backup:';
$lang['fm_startdump']='Start new backup';
$lang['fm_upload']='Or upload file:';
$lang['fm_fileupload']='Upload file';
$lang['fm_fileimport']='Import SQL-File';
$lang['fm_dbname']='Databasename';
$lang['fm_files1']='Database Backups';
$lang['fm_files2']='Database Structures';
$lang['fm_autodel1']='Autodelete: the following files were deleted because of maximum files setting:';
$lang['fm_autodel2']='Autodelete: the following files were deleted because of their date:';

$lang['fm_dumpsettings']='Configuration for Backup';
$lang['fm_dumpsettings']='Configuration for Perl-Cronscript';
$lang['fm_oldbackup']='(unknown)';
$lang['fm_restore_header']='Restore of Database <strong>"';
$lang['fm_restore_header2']='"</strong>';
$lang['fm_dump_header']='Backup';

$lang['DoCronButton']='Do the Perl-Cronscript';
$lang['DoPerlTest']='test perl-modules';
$lang['DoSimpleTest']='test perl';
$lang['cronperldesc']='This only works if you have Perl and the rights to use it <br>The address of the script is ';


// Text in dump.php
$lang['dump']='Backup';
$lang['dump_headline']='Create backup...';
$lang['gzip_compression']='GZip-Compression is';
$lang['on']='on';
$lang['off']='off';
$lang['saving_table']='Saving table ';
$lang['of']='of';
$lang['actual_table']='Actual table';
$lang['progress_table']='Progress of table';
$lang['progress_over_all']='Overall Progress';
$lang['entry']='Entry';
$lang['done']='Done!';
$lang['file']='File';
$lang['dump_successful']=' was successfully created.';
$lang['upto']='up to';
$lang['email_was_send']='Email was successfully sent to ';
$lang['back_to_control']='Continue';
$lang['dump_filename']='Backup-File: ';
$lang['withpraefix']='with praefix';
$lang['dump_notables']='No tables found in database <b>';
$lang['dump_notables2']='</b>.';
$lang['dump_endergebnis1']='The file contains ';
$lang['dump_endergebnis2']=' tables with  ';
$lang['dump_endergebnis3']=' records.<br>';
$lang['mailerror']='Sending of email failed!';

$lang['emailbody_n1']='The Attachment contains the backup of your MySQL-Database.<br>Backup of Database ';
$lang['emailbody_n2']='<br><br>Kind regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
$lang['emailbody_mp1']='A Multipart-Backup was created.<br>The Backupfiles are not attached to this email!<br>Backup of Database `';
$lang['emailbody_mp1an']='A Multipart-Backup was created.<br>The Backupfiles are attached to seperate emails!<br>Backup of Database `';
$lang['emailbody_mp1a']='`<br><br>Following Files were created:<br><br>';
$lang['emailbody_mp2']='`<br><br>Kind regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
$lang['emailbody_tb1']='The Backupfile exceeded the maximum size of ';
$lang['emailbody_tb2']=' and was not attached to this email.<br>Backup of Database ';
$lang['emailbody_tb3']='<br><br>Kind regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a><br><br>Following File was created:<br><br>';
$lang['emailbody_na']='Files are not attached to this email!<br>Backup of Database ';
$lang['only_attachment']=' ... only attachment';

$lang['tableselection']='Tableselection';
$lang['selectall']='select all';
$lang['deselectall']='select none';
$lang['startdump']='start backup';
$lang['datawith']='Records with';
$lang['lastbufrom']='last update from';
$lang['startrestore']='start restore';
$lang['not_supported']='This backup does\'nt support this function.';

$lang['multidump1']='Multidump: Backup of ';
$lang['multidump2']=' Databases done.';
$lang['filesendftp']='send file via FTP... please be patient. ';
$lang['ftpconnerror']='FTP-connection not established! Connection with ';
$lang['ftpconnerror1']=' as user ';
$lang['ftpconnerror2']=' not possible';
$lang['ftpconnerror3']='FTP-Upload failed! ';
$lang['ftpconnected1']='Connected with ';
$lang['ftpconnected2']=' on ';
$lang['ftpconnected3']=' transfered successful';

// Text in restore.php
$lang['restore']='Restore';
$lang['restore_db']='of database <b>';
$lang['restore_db1']='</b> on <b>';
$lang['restore_db2']='</b>.<br>';
$lang['restore_complete']='</b> tables created.';
$lang['restore_run1']='<br>up to now <b>';
$lang['restore_run2']='</b> records were successfully added.';
$lang['restore_run3']='<br>momentary the table <b>';
$lang['restore_run4']='</b> is receiving data.<br>';
$lang['restore_run5']='of the file finished.';
$lang['restore_total_complete']='<br><b>Congratulations.</b><br><br>The restoration of the database is done.<br>All data from the backup-file was re-restored.<br><br>Everything is done. :-)';
$lang['db_no_connection']='Connection to database failed!';
$lang['db_select_error']='<br>Error:<br>Selection of database <b>';
$lang['db_select_error2']='</b> failed!';
$lang['file_open_error']='Error: could not open file.';
$lang['restore_entryerror']='Error: command can\'t be done:';


// Text in config_overview.php - Status
$lang['config_headline']='Configuration';
$lang['sql_trenn']="Seperator";
$lang['no_send_mail']='The dumpfile won\'t be mailed to anyone.';
$lang['no_del_files']='There is no age limit for the backupfiles.';
$lang['no_number_of_files']='There is no limit to the number of backupfiles.';
$lang['save_success']='Configuration was saved.';
$lang['save_error']='Error - unable to save configuration!';
$lang['config_databases']='Databases';
$lang['config_dumprestore']='Backup / Restore';
$lang['config_email']='Email-Notification';
$lang['config_autodelete']='Autodelete';
$lang['config_interface']='Interface';
$lang['config_cron']='Crondump-Settings';
$lang['multi_part']='Multipart-Backup';
$lang['multi_part_groesse']='maximum Filesize';
$lang['help_multipart']='If Multipart is switched on, Backup creates multiple Backupfiles, which maximum size determined by the configuration below';
$lang['help_multipartgroesse']='The maximum size of Backupfiles can be determined here, if Multipart is switched on';
$lang['empty_db_before_restore']='delete tables before restoring';
$lang['allpars']='all parameters';
$lang['cron_timelimit']='Timelimit for Cronjob';
$lang['cron_perlpath']='Path to perl(.exe)';
$lang['cron_extender']='Fileextension';
$lang['cron_savepath']='Configurationfile';
$lang['cron_printout']='Print additional text';
$lang['config_cronperl']='Crondump-Settings for perlscript';
$lang['cron_mail']='Send backup per mail';
$lang['cron_mailprg']='Mailprogram';
$lang['cron_mailto']='Mailadress';
$lang['cron_ftp']='Send backup per FTP';
$lang['optimize']='Optimize Tables before Backup';
$lang['help_optimize']='If this option is activated, all tables will be optimized before the backup';
$lang["help_ftptimeout"]='Die Zeit, die bei keiner Übertragung zum Timeout führt, Default 90 sek.';
$lang["ftp_timeout"]='Connection-Timeout';
$lang["help_ftpssl"]='';

$lang['useconnection']='Use connection';
$lang['wrongconnectionpars']='Wrong or empty connection parameters !';
$lang['conn_not_pssible']='Connection not possible !';
$lang['servercaption']='Display Server';
$lang['help_servercaption']='When using MySQLDumper on different systems it can be helpful to fade in the server address coloured characterized';
$lang['otherbrowser']='other Browser';
$lang['activate_multidump']='activate multidump';
$lang['praefix']='Table-Prefix';
$lang['config_askload']='Do you want to override the actual settings with the default settings?';
$lang['load']='load default settings';
$lang['load_success']='The default settings were loaded.';
$lang['cron_samedb']='use actual database';
$lang['cron_crondbindex']='Database and Table-Prefix<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for the Cronjob';
$lang['withattach']=' with attach';
$lang['withoutattach']=' without attach';
$lang['multidumpconf']='=Multidump Configuration=';
$lang['multidumpall']='=all Databases=';

$lang['gzip']='GZip-compression';
$lang['backup_dir']='Directory for Backup files';
$lang['db_host']='Host name';
$lang['saving_db_form']='Database';
$lang['db_user']='User';
$lang['db_pass']='Password';
$lang['db_only']='only connect to this database';
$lang['send_mail_form']='Send emailreport';
$lang['send_mail_dump']='Attach backup';
$lang['email_adress']='Email address';
$lang['email_subject']='Sender address of the email';
$lang['email_maxsize']='Maximum size of attachment';
$lang['age_of_files']='Delete by age of files (in days)';
$lang['number_of_files_form']='Delete by number of files';
$lang['language']='Language';
$lang['list_db']='Configured Databases:';
$lang['save']='Save';
$lang['reset']='Reset';
$lang['autodelete']='Delete backups automatically';
$lang['max_backup_files_each1']='For all databases';
$lang['max_backup_files_each2']='For each database';
$lang['config_ftp']='FTP-Transfer of Backupfile';

$lang['ftp_transfer']='FTP-Transfer';
$lang['ftp_server']='Server';
$lang['ftp_port']='Port';
$lang['ftp_user']='User';
$lang['ftp_pass']='Password';
$lang['ftp_dir']='Upload-Dir';
$lang['ftp_ssl']='Secure SSL-FTP connection';
$lang['ftp_useSSL']='use SSL-Connection';

$lang['sqlboxheight']='Height of SQL-Box';
$lang['sqllimit']='Count of records each page';
$lang['bbparams']='Configuration for BB-Code';
$lang['bbtextcolor']='Textcolor';

$lang['config_expert']='Expert-Configuration';
$lang['exp_chmod']='CHMod for Work-Dir';


$lang["help_commands"]='You can execute a command before and after the backup.'."\n".'This command can be a SQL-Construct or a System Command (e.g. a script)';
$lang['withalldbs']='with every database';
$lang['cbd']='Command before Backup';
$lang['cad']='Command after Backup';
$lang['exec']='execute';
$lang['commkind']='Kind of Command';
$lang['command']='Command';

// Sprachen
$lang['lang_de']='German';
$lang['lang_en']='English';

// Text aus menu.php
$lang['load_database']='Reload databases';
$lang['home']='Home';
$lang['config']='Config';
$lang['file_manage']='File Administration';
$lang['log']='Log';
$lang['project']='About this project';
$lang['choose_db']='choose Database';
$lang['credits']='Credits / Help';
$lang['onlinehelp']='Online-Help';


//Log
$lang['log_delete']='delete Log';


// Texte aus main.php
$lang['info_location']='Your location is ';
$lang['info_browser']='Your Browser is';
$lang['info_admin']='The Server\'s administrator is ';
$lang['info_databases']='The following database(s) are on your server:';
$lang['info_nodb']='database does not exist.';
$lang['info_table1']='Table';
$lang['info_table2']='s';
$lang['info_dbdetail']='Detail-Info of database ';
$lang['info_dbempty']='The database is empty !';
$lang['info_records']='Records';
$lang['info_size']='Size';
$lang['info_lastupdate']='last Update';
$lang['info_sum']='total';
$lang['info_rechte']='Your Priviliges';
$lang['info_cronyes']='Du kannst MySQL Dumper als Cronjob durchf&uuml;hren.';
$lang['info_cronno']='Aufgrund deiner PHP-Einstellungen (safe_mode=on) kannst du MySQL Dumper nicht als Cronjob durchf&uuml;hren!';
$lang['info_optimized']='optimized';
$lang['optimize_databases']='Optimize Tables';
$lang['check_tables']='Check Tables';

$lang['clear_database']='Clear database';
$lang['delete_database']='Delete database';
$lang['create_database']='Create new database:';
$lang['button_create_database']='Create';

$lang['info_created']='created';
$lang['info_cleared']='was cleared';
$lang['info_deleted']='was deleted';

$lang['info_scriptdir']='Directory of MySQLDumper';
$lang['info_workdir']='Working directory';
$lang['info_backupdir']='Backup directory';
$lang['info_cgidir']='CGI-Bin-Directory';
$lang['info_cginr']='does not exist or is forbidden';
$lang['info_actdb']='Actual Database';

$lang['info_emptydb1']='Should the Database';
$lang['info_emptydb2']=' be truncated? (Attention: All Data will be lost forever!)';
$lang['info_killdb']=' be deleted? (Attention: All Data will be lost forever!)';

$lang['dbnoempty']='Databasename can\'t be empty !';
$lang['processkill1']='The script tries to kill process ';
$lang['processkill2']='';
$lang['processkill3']='The script tries since  ';
$lang['processkill4']=' sec. to kill the process ';

$lang['htaccess1']='create directory protection';
$lang['htaccess2']='Password:';
$lang['htaccess3']='Password (repeat):';
$lang['htaccess4']='Kind of encrypting:';
$lang['htaccess5']='Crypt (Linux and Unix-Systems)';
$lang['htaccess6']='MD5 (Windows)';
$lang['htaccess7']='plain text (no cryption)';
$lang['htaccess8']='It already exists an directory protection. If you create a new one, the older one will be overwritten !';
$lang['htaccess9']='You have to enter a name !<br>';
$lang['htaccess10']='The Passwords are not identically or empty !<br>';
$lang['htaccess11']='Shell the directory protection be written now ?';
$lang['htaccess12']='The directory protection was created.';
$lang['htaccess13']='Contents of file:';
$lang['htaccess14']='There was an error while creating the directory protection !<br>Pleas create the 2 files manually with following content:';
$lang['htaccess15']='Urgently recommended !';
$lang['htaccess16']='edit .htaccess';
$lang['htaccess17']='create and edit .htaccess';
$lang['htaccess18']='create .htaccess in ';
$lang['htaccess19']=' reload ';

$lang['htaccess20']='execute script';
$lang['htaccess21']='add handler';
$lang['htaccess22']='make executable';
$lang['htaccess23']='Directory-Listing';
$lang['htaccess24']='Error-Document';
$lang['htaccess25']='activate Rewrite';
$lang['htaccess26']='Deny / Allow';
$lang['htaccess27']='Redirect';
$lang['htaccess28']='Error-Log';
$lang['htaccess29']='more examples and documentation';

$lang['htaccess30']='Provider';
$lang['htaccess31']='allgemein';
$lang['htaccess32']='Attention! The .htaccess directly manipulate the browser behavior.<br>With wrong application the sides are no longer attainable.';
$lang['phpbug']='Bug in zlib ! No Compression possible';

//Mini-SQL
$lang['sql_warning']='The Execution of SQL-Statements can manipulate Data. The Author doesn\'t take any liability for losing data.';
$lang['sql_back']='back to Database-Overview';
$lang['database_overview']='Database-Overview';
$lang['sql_exec']='execute SQL-Statement';
$lang['sql_dataview']='Data-View';
$lang['sql_tableview']='Table-View';
$lang['sql_vonins']='from totally';
$lang['sql_nodata']='no records';

$lang['sql_recordupdated']='Record was updated';
$lang['sql_recordinserted']='Record was added';
$lang['sql_backdboverview']='back to Overview';
$lang['sql_recorddeleted']='Record was deleted';
$lang['sql_tabledeleted1']='Table `';
$lang['sql_tabledeleted2']='` was deleted';
$lang['sql_recordedit']='edit record';
$lang['sql_recordnew']='new record';
$lang['sql_askdelete']='Are you sure to delete this record?';
$lang['sql_askdeletetable1']='Shell the table `';
$lang['sql_askdeletetable2']='` be deleted?';
$lang['sql_befehle']='SQL-Commands';
$lang['sql_befehlneu']='new Command';
$lang['sql_befehlsaved1']='SQL-Command';
$lang['sql_befehlsaved2']='was added';
$lang['sql_befehlsaved3']='was saved';
$lang['sql_befehlsaved4']='was moved up';
$lang['sql_befehlsaved5']='was deleted';

$lang['sql_queryentry']='The Query contains';
$lang['sql_columns']='Columns';

$lang['fm_askdbdelete1']='Do you want to delete the Database ';
$lang['fm_askdbdelete2']=' with the content?';
$lang['fm_askdbempty1']='Do you want to empty the Database ';
$lang['fm_askdbempty2']=' ?';
$lang['fm_askdbcopy1']='Do you  want to copy the Database ';
$lang['fm_askdbcopy2']=' in the Database ';
$lang['fm_askdbcopy3']=' ?';

$lang['sql_tablenew']='Edit Tables';
$lang['sql_output']='SQL-Output';
$lang['do_now']='operate now';
$lang['sql_namedest_missing']='Name of Destination is missing !';
$lang['sql_askdeletefield']='Do you want to delete the Field?';
$lang['sql_commands_in']=' lines in ';
$lang['sql_commands_in2']='  sec. parsed.';
$lang['sql_out1']='Executed ';
$lang['sql_out2']='Commands';
$lang['sql_out3']='It had ';
$lang['sql_out4']='Comments';
$lang['sql_out5']='Because the output contains more than 5000 lines it is\'nt displayed.';
$lang['sql_error1']='Error in Query:';
$lang['sql_error2']='MySQL says:';
$lang['sql_selecdb']='Select Database';
$lang['sql_tablesofdb']='Tables of Database';
$lang['sql_edit']='edit';
$lang['sql_nofielddelete']='Delete is not possible because Tables must contain at least one field.';
$lang['sql_fielddelete1']='The Field';
$lang['sql_deleted']='was deleted';
$lang['sql_changed']='was changed.';
$lang['sql_created']='was created.';
$lang['sql_nodest_copy']='No Copy without Destination !';
$lang['sql_desttable_exists']='Destination Table exists !';
$lang['sql_scopy1']='Tablestructure of';
$lang['sql_scopy2']='was copied in Table';
$lang['sql_scopy3']='';
$lang['sql_copied']='copied';
$lang['sql_copy1']='was copied with data in Table';
$lang['sql_tablenoname']='Table needs a name!';
$lang['sql_tblnameempty']='Tablename can\'t be empty!';
$lang['sql_collatenotmatch']='Charset and Collation don\'t fit together!';
$lang['sql_fieldnamenotvalid']='Error: No valid fieldname';
$lang['sql_createtable']='create table';
$lang['sql_copytable']='copy table';
$lang['sql_structureonly']='only Structur';
$lang['sql_structuredata']='Structur and Data';
$lang['sql_notablesindb']='No tables found in Database';
$lang['sql_selecttable']='select table';
$lang['sql_showdatatable']='Show Data of Table';
$lang['sql_tblpropsof']='Tableproperties of';
$lang['sql_editfield']='Edit field';
$lang['sql_newfield']='New field';
$lang['sql_indexes']='Indexes';
$lang['sql_atposition']='insert at position';
$lang['sql_first']='first';
$lang['sql_after']='after';
$lang['sql_changefield']='change field';
$lang['sql_insertfield']='insert field';
$lang['sql_insertnewfield']='insert new field';
$lang['sql_tableindexes']='Indexes of table';
$lang['sql_allowdups']='Duplicates allowed';
$lang['sql_cardinality']='Cardinality';
$lang['sql_tablenoindexes']='No Indexes in Table';
$lang['sql_createindex']='create new index';
$lang['sql_wasemptied']='was emptied';
$lang['sql_renamedto']='was renamed to';
$lang['sql_dbcopy1']='The Content of Database';
$lang['sql_dbcopy2']='was copied in Database';
$lang['sql_dbscopy1']='The Structure of Database';
$lang['sql_wascreated']='was created';
$lang['sql_renamedb']='Rename Database';
$lang['sql_actions']='Actions';
$lang['sql_chooseaction']='choose Action';
$lang['sql_deletedb']='Delete Database';
$lang['sql_emptydb']='Empty Database';
$lang['sql_renamedb']='Rename Database';
$lang['sql_copydatadb']='Copy complete Database to';
$lang['sql_copysdb']='Copy Structure of Database';

//Installation
$lang['install_forcescript']='Start MySQLDumper without installation';
$lang['install_tomenu']='Back to main menu';
$lang['installmenu']='Main menu';
$lang['step']='Step';
$lang['install']='Installation';
$lang['uninstall']='Uninstall';
$lang['tools']='Tools';
$lang['editconf']='edit Configuration';
$lang['osweiter']='continue without saving';
$lang['errorman']='Error while saving the Configuration!</strong><br>Please edit the File ';

$lang['manuell']='manually';
$lang['createdirs']='create Directories';
$lang['check0']=' ...ok Rights: ';
$lang['check1']='checking work-directory ...  ';
$lang['check2']='checking backup-directory ...  ';
$lang['check3']='checking structure-directory ...  ';
$lang['check4']='checking log-directory ...  ';
$lang['check5']='checking configuration-directory ...  ';
$lang['check6']='I have created the directories manually, ';
$lang['check7']='Directories were created. Saving configuration ...';
$lang['bitteweiter']='please continue';
$lang['install_continue']='continue with installation';
$lang['installfinished']='<br>Installation completed  --> <a href="index.php">start MySQLDumper</a><br>';

$lang['connecttomysql']=' connect to MySQL ';


$lang['dbparameter']='Database-Parameter';
$lang['confignotwritable']='The file "config.php" is not writable. Please CHMOD fie to 777!';
$lang['testconnection']='test connection';
$lang['dbconnection']='Database-Connection';
$lang['connectionerror']='Error: unable to connect.';
$lang['connection_ok']='Database-Connection was established.';
$lang['saveandcontinue']='Save and continue installation';
$lang['confbasic']='Basic Parameter';
$lang['install_step2finished']='Database-Parameter were saved.<br><br>You may continue installation with Default-Settings or edit configuration.';
$lang['install_step2_1']='continue installation with the Default-Settings';
$lang['laststep']='Installation Finish';

$lang['ftpmode']='Create necessary directories in safe-mode';
$lang['safemodedesc']='Because PHP is running in "safe-mode", it is not allowed to create directorys on this server.<br>The only way to create directories is using FTP or doing it by yourself. Either you create the dirs manually and set the write permissions to CHMOD 0777 (!!!) or let the script do it via FTP. In order to do so you must enter the correct connection parameters to your FTP-Server:';
$lang['idomanual']='I create the dirs myself';
$lang['dofrom']='starting from';
$lang['ftpmode2']='create the dirs with FTP';
$lang['connect']='connect';
$lang['dirs_created']='The dirs were created.';
$lang['connect_to']='connect to';
$lang['changedir']='change to dir';
$lang['changedirerror']='change to dir was not possible';
$lang['ftp_ok']='FTP-Parameter are ok';
$lang['createdirs2']='create dirs';
$lang['ftp_notconnected']='Ftp-Connection not established!';
$lang['connwith']='Connection with';
$lang['asuser']='as user';
$lang['notpossible']='not possible';
$lang['dircr1']='create workdir';
$lang['dircr2']='create backupdir';
$lang['dircr3']='create structurdir';
$lang['dircr4']='create logdir';
$lang['dircr5']='create configurationdir';
$lang['indir']='now in dir';
$lang['test']='test';
$lang['check']='check my dirs';
$lang['disabledfunctions']="Disabled Functions";
$lang['noftppossible']="You don't have ftp-functions !";
$lang['nogzpossible']="You don't have compression-functions !";

$lang['ui1']='All working directories which can contain backups will be deleted.';
$lang['ui2']='Are you sure you want that?';
$lang['ui3']='no, cancel immediately';
$lang['ui4']='yes, please continue';
$lang['ui5']='delete working directories';
$lang['ui6']='all was deleted successfully.';
$lang['ui7']='Please delete the script directory';
$lang['ui8']='one level up';
$lang['ui9']='An error occured, deleting was not possible</p>Error with directory ';

$lang['import']='Import Configuration';
$lang['import1']='Import settings from "config.gz"';
$lang['import2']='Upload and import settings';
$lang['import3']='Configuration was loaded ...';
$lang['import4']='Configuration was saved.';
$lang['import5']='start MySQLDumper';
$lang['import6']='Installation-Menu';
$lang['import7']='Upload configuration';
$lang['import8']='back to upload';
$lang['import9']='This is not a configuration backup !';
$lang['import10']='Configuration was uploaded successfully ...';
$lang['import11']='<strong>Error: </strong>There were problems writing sql_statements';
$lang['import12']='<strong>Error: </strong>There were problems writing config.php';
$lang['expert']='extended';
$lang['dbonlyneed']='... no Database found : <br>click on "extended" and enter name of your Database (only connect to database ...)!';
$lang['install_help_port']='(empty = Default Port)';
$lang['install_help_socket']='(empty = Default Socket)';
$lang['tryagain']='try again';

?>