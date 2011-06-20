<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package       MySQLDumper
 * @subpackage    Language
 * @version       $Rev: $
 * @author        $Author: $
 */
$lang=array();
$lang['L_ACTION']="Action";
$lang['L_ACTIVATED']="aktiválva";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Up to now <b>%s</b> records were"
    ." successfully added.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Up to now  <b>%s</b> of <b>%s</b>"
    ." records were successfully added.";
$lang['L_ADD']="Hozzáadás";
$lang['L_ADDED']="hozzáadva";
$lang['L_ADD_DB_MANUALLY']="Adatbázis hozzáadása manuálisan";
$lang['L_ADD_RECIPIENT']="Add recipient";
$lang['L_ALL']="összes";
$lang['L_ANALYZE']="Analyze";
$lang['L_ANALYZING_TABLE']="Now data of the table '<b>%s</b>' is"
    ." being analyzed.";
$lang['L_ASKDBCOPY']="Át akarod másolni a(z) `%s`"
    ." adatbázist a(z) `%s` adatbázisba?";
$lang['L_ASKDBDELETE']="Törölni akarod a(z) `%s` adatbázist"
    ." és tartalmát?";
$lang['L_ASKDBEMPTY']="Ki akarod üríteni a(z) `%s`"
    ." adatbázist?";
$lang['L_ASKDELETEFIELD']="Törölni akarod a mezőt?";
$lang['L_ASKDELETERECORD']="Biztosan törölni akarod ezt a"
    ." rekordot?";
$lang['L_ASKDELETETABLE']="Biztosan törölni akarod a(z) `%s`"
    ." táblát?";
$lang['L_ASKTABLEEMPTY']="Biztosan ki akarod üríteni a(z) `%s`"
    ." táblát?";
$lang['L_ASKTABLEEMPTYKEYS']="Should the table `%s` be emptied and"
    ." the Indices reset?";
$lang['L_ATTACHED_AS_FILE']="csatolás fájlként";
$lang['L_ATTACH_BACKUP']="Biztonsági mentés csatolása";
$lang['L_AUTHENTICATE']="Bejelentkezési adatok";
$lang['L_AUTHORIZE']="Authorize";
$lang['L_AUTODELETE']="Biztonsági mentések automatikus"
    ." törlése";
$lang['L_BACK']="vissza";
$lang['L_BACKUPFILESANZAHL']="A biztonsági mentés könyvtárban";
$lang['L_BACKUPS']="Biztonsági mentések";
$lang['L_BACKUP_DBS']="DBs to backup";
$lang['L_BACKUP_TABLE_DONE']="Dumping of table `%s` finished. %s"
    ." records have been saved.";
$lang['L_BACK_TO_OVERVIEW']="Adatbázis áttekintése";
$lang['L_CALL']="Call";
$lang['L_CANCEL']="Mégse";
$lang['L_CANT_CREATE_DIR']="Nem sikerült létrehozni a '%s'"
    ." könyvtárt.<br />Hozd létre az FTP"
    ." programod segítségével.";
$lang['L_CHANGE']="change";
$lang['L_CHANGEDIR']="Könyvtár váltása";
$lang['L_CHANGEDIRERROR']="Nem lehet könyvtárat váltani!";
$lang['L_CHARSET']="Karakterkészlet";
$lang['L_CHARSETS']="Character Sets";
$lang['L_CHECK']="Ellenőrzés";
$lang['L_CHECK_DIRS']="Check my directories";
$lang['L_CHOOSE_CHARSET']="MySQLDumper couldn't detect the"
    ." encoding of the backup file"
    ." automatically.<br /><br />You must"
    ." choose the charset with which this"
    ." backup was saved.<br /><br />If you"
    ." discover any problems with some"
    ." characters after restoring, you can"
    ." repeat the backup-progress and then"
    ." choose another character set.<br /><br"
    ." />Good luck. ;)<br /><br />";
$lang['L_CHOOSE_DB']="Adatbázis kiválasztása";
$lang['L_CLEAR_DATABASE']="Adatbázis kiürítése";
$lang['L_CLOSE']="Bezár";
$lang['L_COLLATION']="Collation";
$lang['L_COMMAND']="Command";
$lang['L_COMMAND_AFTER_BACKUP']="Command after backup";
$lang['L_COMMAND_BEFORE_BACKUP']="Command before backup";
$lang['L_COMMENT']="Megjegyzés";
$lang['L_COMPRESSED']="tömörített (gz)";
$lang['L_CONFBASIC']="Basic Parameter";
$lang['L_CONFIG']="Beállítások";
$lang['L_CONFIGFILE']="Konfigurációs fájl";
$lang['L_CONFIGFILES']="Konfigurációs fájlok";
$lang['L_CONFIGURATIONS']="Beállítások";
$lang['L_CONFIG_AUTODELETE']="Automatikus törlés";
$lang['L_CONFIG_CRONPERL']="Crondump Settings for Perl script";
$lang['L_CONFIG_EMAIL']="E-mail értesítés";
$lang['L_CONFIG_FTP']="FTP Transfer of Backup file";
$lang['L_CONFIG_HEADLINE']="Beállítások";
$lang['L_CONFIG_INTERFACE']="Interface";
$lang['L_CONFIG_LOADED']="A(z) \"%s\" beállítás sikeresen"
    ." importálva.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Biztosan törölni akarod a(z) %s"
    ." konfigurációs fájlt?";
$lang['L_CONFIRM_DELETE_FILE']="Tényleg törölni akarod a(z) '%s'"
    ." fájlt?";
$lang['L_CONFIRM_DELETE_TABLES']="Biztosan törölni akarod a"
    ." kiválasztott táblákat?";
$lang['L_CONFIRM_DROP_DATABASES']="Biztosan törölni akarod a"
    ." kiválasztott adatbázisokat?<br /><br"
    ." />Figyelmeztetés: az összes adat"
    ." törölve lesz! Talán szeretnél egy"
    ." biztonsági mentést készíteni"
    ." először.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Should the recipient \"%s\" really be"
    ." deleted?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Biztosan törölni akarod a"
    ." kiválasztott adatbázisok összes"
    ." tábláját?<br /><br"
    ." />Figyelmeztetés: az összes adat"
    ." törölve lesz! Talán szeretnél egy"
    ." biztonsági mentést készíteni"
    ." először.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Biztosan törlöd a kiválasztott"
    ." táblákat?";
$lang['L_CONNECT']="kapcsolódás";
$lang['L_CONNECTIONPARS']="Connection Parameter";
$lang['L_CONNECTTOMYSQL']="Kapcsolódás a MySQl-hez";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continue Multipart-Restore with next"
    ." file '%s'.";
$lang['L_CONVERTED_FILES']="Converted Files";
$lang['L_CONVERTER']="Backup Converter";
$lang['L_CONVERTING']="Konvertálás";
$lang['L_CONVERT_FILE']="File to be converted";
$lang['L_CONVERT_FILENAME']="Name of destination file (without"
    ." extension)";
$lang['L_CONVERT_FILEREAD']="A(z) '%s' fájl olvasása";
$lang['L_CONVERT_FINISHED']="Conversion finished, '%s' was written"
    ." successfully.";
$lang['L_CONVERT_START']="Konvertálás kezdése";
$lang['L_CONVERT_TITLE']="Convert Dump to MSD Format";
$lang['L_CONVERT_WRONG_PARAMETERS']="Hibás paraméterek! A konvertálás"
    ." nem lehetséges.";
$lang['L_CREATE']="Create";
$lang['L_CREATED']="Létrehozva";
$lang['L_CREATEDIRS']="Könyvtárak létrehozása";
$lang['L_CREATE_AUTOINDEX']="Create Auto-Index";
$lang['L_CREATE_CONFIGFILE']="Új konfigurációs fájl"
    ." létrehozása";
$lang['L_CREATE_DATABASE']="Új adatbázis létrehozása";
$lang['L_CREATE_TABLE_SAVED']="Definition of table `%s` saved.";
$lang['L_CREDITS']="Kreditek / Segítség";
$lang['L_CRONSCRIPT']="Cronscript";
$lang['L_CRON_COMMENT']="Megjegyzés hozzáadása";
$lang['L_CRON_COMPLETELOG']="Log complete output";
$lang['L_CRON_EXECPATH']="Path of Perl scripts";
$lang['L_CRON_EXTENDER']="File extension";
$lang['L_CRON_PRINTOUT']="Print output on screen.";
$lang['L_CSVOPTIONS']="CSV opciók";
$lang['L_CSV_EOL']="Seperate lines with";
$lang['L_CSV_ERRORCREATETABLE']="Hiba a `%s` tábla létrehozása"
    ." közben!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="The count of fields doesn't match with"
    ." that of the data to import (%d instead"
    ." of %d).";
$lang['L_CSV_FIELDSENCLOSED']="Fields enclosed by";
$lang['L_CSV_FIELDSEPERATE']="Fields separated with";
$lang['L_CSV_FIELDSESCAPE']="Fields escaped with";
$lang['L_CSV_FIELDSLINES']="%d fields recognized, totally %d lines";
$lang['L_CSV_FILEOPEN']="CSV fájl megnyitása";
$lang['L_CSV_NAMEFIRSTLINE']="Field names in first line";
$lang['L_CSV_NODATA']="No data found for import!";
$lang['L_CSV_NULL']="Replace NULL with";
$lang['L_DATABASES_OF_USER']="Felhasználó adatbázisai";
$lang['L_DATABASE_CREATED_FAILED']="The database wasn't created.<br"
    ." />MySQL returns:<br/><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="A(z) '%s' adatbázis sikeresen"
    ." elkészült.";
$lang['L_DATASIZE']="Size of data";
$lang['L_DATASIZE_INFO']="Ez a rekordok mérete, nem pedig a"
    ." biztonsági mentésé";
$lang['L_DAY']="Nap";
$lang['L_DAYS']="Nap";
$lang['L_DB']="Adatbázis";
$lang['L_DBCONNECTION']="Adatbázis kapcsolat";
$lang['L_DBPARAMETER']="Database Parameters";
$lang['L_DBS']="Adatbázisok";
$lang['L_DB_ADAPTER']="DB-Adapter";
$lang['L_DB_BACKUPPARS']="Database Backup Parameter";
$lang['L_DB_DEFAULT']="Alapértelmezett adatbázis";
$lang['L_DB_HOST']="Hostname";
$lang['L_DB_IN_LIST']="The database '%s' couldn't be added"
    ." because it is allready existing.";
$lang['L_DB_NAME']="Adatbázis neve";
$lang['L_DB_PASS']="Jelszó";
$lang['L_DB_SELECT_ERROR']="<br />Error:<br />Selection of"
    ." database <b>";
$lang['L_DB_SELECT_ERROR2']="</b> nem sikerült!";
$lang['L_DB_USER']="Felhasználó";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Alapértelmezett karakterkészlet";
$lang['L_DEFAULT_CHARSET']="Alapértelmezett karakterkészlet";
$lang['L_DEFAULT_COLLATION_NAME']="Default collation";
$lang['L_DELETE']="Törlés";
$lang['L_DELETE_DATABASE']="Adatbázis törlése";
$lang['L_DELETE_FILE_ERROR']="Hiba a(z) \"%s\" fájl törlése"
    ." közben!";
$lang['L_DELETE_FILE_SUCCESS']="A(z) \"%s\" sikeresen törölve.";
$lang['L_DELETE_HTACCESS']="Remove directory protection (delete"
    ." .htaccess)";
$lang['L_DESCRIPTION']="Leírás";
$lang['L_DESELECT_ALL']="Deselect all";
$lang['L_DIR']="Könyvtár";
$lang['L_DISABLEDFUNCTIONS']="Letiltott funkciók";
$lang['L_DO']="Execute";
$lang['L_DOCRONBUTTON']="Perl Cron szkript futtatása";
$lang['L_DONE']="Kész!";
$lang['L_DONT_ATTACH_BACKUP']="Ne csatold a biztonsági mentést";
$lang['L_DOPERLTEST']="Perl modulok tesztelése";
$lang['L_DOSIMPLETEST']="Perl tesztelése";
$lang['L_DOWNLOAD_FILE']="Fájl letöltése";
$lang['L_DO_NOW']="operate now";
$lang['L_DUMP']="Backup";
$lang['L_DUMP_ENDERGEBNIS']="A fájl <b>%s</b> táblát tartalmaz"
    ." <b>%s</b> rekorddal.";
$lang['L_DUMP_FILENAME']="Backup File";
$lang['L_DUMP_HEADLINE']="Biztonsági mentés létrehozása";
$lang['L_DUMP_NOTABLES']="Nem találhatóak táblák a(z) `%s`"
    ." adatbázisban";
$lang['L_DUMP_OF_DB_FINISHED']="Dumping of database `%s` done";
$lang['L_DURATION']="Duration";
$lang['L_EDIT']="szerkesztés";
$lang['L_EHRESTORE_CONTINUE']="continue and log errors";
$lang['L_EHRESTORE_STOP']="állj";
$lang['L_EMAIL']="E-mail";
$lang['L_EMAILBODY_ATTACH']="A csatolmány a MySQL adatbázisod"
    ." biztonsági mentését tartalmazza.<br"
    ." />A(z) `%s` adatbázis biztonsági"
    ." mentése<br /><br /><br />A"
    ." következő fájl ekkor készült:<br"
    ." /><br />%s <br /><br"
    ." />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="`<br /><br />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="A többrészes biztonsági mentés"
    ." elkészült.<br />A fájlok"
    ." különböző e-mailekhez vannak"
    ." csatolva.<br />A(z) `%s` adatbázis"
    ." biztonsági mentése<br /><br /><br"
    ." />A követező fájlok ekkor"
    ." készültek:<br /><br />%s <br /><br"
    ." />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="A többrészes biztonsági mentés"
    ." elkészült.<br />A fájlok nincsenek"
    ." csatolva ehhez az e-mailhez!<br />A(z)"
    ." `%s` adatbázis biztonsági"
    ." mentése<br /><br /><br />A"
    ." következő fájlok ekkor"
    ." készültek:<br /><br />%s<br /><br"
    ." /><br />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="A fájlok nincsenek csatolva ehhez az"
    ." e-mailhez!<br />A(z) `%s` adatbázis"
    ." biztonsági mentése<br /><br /><br"
    ." />A következő fájl ekkor"
    ." készült:<br /><br />%s<br /><br"
    ." /><br />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="A biztonsági mentés meghaladta a(z)"
    ." %s-nyi maximális fájlméretet és"
    ." nem lett csatolva ehhez az"
    ." e-mailhez.<br />A(z) `%s` adatbázis"
    ." biztonsági mentése<br /><br /><br"
    ." />A következő fájl ekkor"
    ." készült:<br /><br />%s<br /><br"
    ." /><br />Üdvözlettel<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="E-mail cím";
$lang['L_EMAIL_CC']="CC-Receiver";
$lang['L_EMAIL_MAXSIZE']="Csatolmány maximális mérete";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... attachment only.";
$lang['L_EMAIL_RECIPIENT']="Címzett";
$lang['L_EMAIL_SENDER']="Feladó e-mail címe";
$lang['L_EMAIL_START']="Starting to send e-mail";
$lang['L_EMAIL_WAS_SEND']="E-mail sikeresen elküldve";
$lang['L_EMPTY']="Empty";
$lang['L_EMPTYKEYS']="empty and reset indexes";
$lang['L_EMPTYTABLEBEFORE']="Empty table before";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Táblák törlése visszaállítás"
    ." előtt";
$lang['L_ENCODING']="karakterkódolás";
$lang['L_ENCRYPTION_TYPE']="Kind of encrypting";
$lang['L_ENGINE']="Engine";
$lang['L_ENTER_DB_INFO']="First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.";
$lang['L_ENTRY']="Entry";
$lang['L_ERROR']="Hiba";
$lang['L_ERRORHANDLING_RESTORE']="Error Handling while restoring";
$lang['L_ERROR_CONFIGFILE_NAME']="A(z) \"%s\" fájlnév érvénytelen"
    ." karaktereket tartalmaz.";
$lang['L_ERROR_DELETING_CONFIGFILE']="Hiba: nem lehet törölni a(z) %s"
    ." konfigurációs fájlt!";
$lang['L_ERROR_LOADING_CONFIGFILE']="nem sikerült betölteni a(z) \"%s\""
    ." konfigurációs fájlt.";
$lang['L_ERROR_LOG']="Error Log";
$lang['L_ERROR_MULTIPART_RESTORE']="Multipart-Restore: couldn't finde the"
    ." next file '%s'!";
$lang['L_ESTIMATED_END']="Estimated end";
$lang['L_EXCEL2003']="Excel from 2003";
$lang['L_EXISTS']="Exists";
$lang['L_EXPORT']="Exportálás";
$lang['L_EXPORTFINISHED']="Exportálás befejezve.";
$lang['L_EXPORTLINES']="<strong>%s</strong> sor exportálva";
$lang['L_EXPORTOPTIONS']="Exportálási opciók";
$lang['L_EXTENDEDPARS']="Extended Parameter";
$lang['L_FADE_IN_OUT']="Display on/off";
$lang['L_FATAL_ERROR_DUMP']="Fatal error: the CREATE-Statement of"
    ." table '%s' in database '%s' couldn't"
    ." be read!";
$lang['L_FIELDS']="Mezők";
$lang['L_FIELDS_OF_TABLE']="Tábla mezői";
$lang['L_FILE']="Fájl";
$lang['L_FILES']="Fájlok";
$lang['L_FILESIZE']="Fájlméret";
$lang['L_FILE_MANAGE']="Fájl adiminisztráció";
$lang['L_FILE_OPEN_ERROR']="Hiba: nem lehet megnyitni a fájlt.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="A fájl sikeresen elmentve.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="A fájlt nem lehet elmenteni!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="A(z) '%s' fájl sikeresen feltöltve.";
$lang['L_FILTER_BY']="Filter by";
$lang['L_FM_ALERTRESTORE1']="Should the database";
$lang['L_FM_ALERTRESTORE2']="be restored with the records from the"
    ." file";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="Összes biztonsági mentés";
$lang['L_FM_ANZ_BU']="Biztonsági mentések";
$lang['L_FM_ASKDELETE1']="Should the file(s)";
$lang['L_FM_ASKDELETE2']="really be deleted?";
$lang['L_FM_ASKDELETE3']="Do you want autodelete to be executed"
    ." with configured rules now?";
$lang['L_FM_ASKDELETE4']="Az összes biztonsági mentést"
    ." törölni akarod?";
$lang['L_FM_ASKDELETE5']="Do you want to delete all backup files"
    ." with";
$lang['L_FM_ASKDELETE5_2']="* ?";
$lang['L_FM_AUTODEL1']="Autodelete: the following files were"
    ." deleted because of maximum files"
    ." setting:";
$lang['L_FM_CHOOSE_ENCODING']="Choose encoding of backup file";
$lang['L_FM_COMMENT']="Megjegyzése hozzáadása";
$lang['L_FM_DELETE']="Törlés";
$lang['L_FM_DELETE1']="A fájl";
$lang['L_FM_DELETE2']="was deleted successfully.";
$lang['L_FM_DELETE3']="couldn't be deleted!";
$lang['L_FM_DELETEALL']="Delete all backup files";
$lang['L_FM_DELETEALLFILTER']="Delete all with";
$lang['L_FM_DELETEAUTO']="Run autodelete manually";
$lang['L_FM_DUMPSETTINGS']="Biztonsági mentés beállításai";
$lang['L_FM_DUMP_HEADER']="Backup";
$lang['L_FM_FILEDATE']="File date";
$lang['L_FM_FILES1']="Database Backups";
$lang['L_FM_FILESIZE']="Fájlméret";
$lang['L_FM_FILEUPLOAD']="Fájl feltöltése";
$lang['L_FM_FREESPACE']="Szabad hely a szerveren";
$lang['L_FM_LAST_BU']="Last Backup";
$lang['L_FM_NOFILE']="Nincs fájl kiválasztva!";
$lang['L_FM_NOFILESFOUND']="A fájl nem található.";
$lang['L_FM_RECORDS']="Rekordok";
$lang['L_FM_RESTORE']="Restore";
$lang['L_FM_RESTORE_HEADER']="Restore of Database"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Táblák kiválasztása";
$lang['L_FM_STARTDUMP']="Start New Backup";
$lang['L_FM_TABLES']="Táblák";
$lang['L_FM_TOTALSIZE']="Teljes méret";
$lang['L_FM_UPLOADFAILED']="Nem sikerült a feltöltés!";
$lang['L_FM_UPLOADFILEEXISTS']="Már létezik ilyen nevű fájl!";
$lang['L_FM_UPLOADFILEREQUEST']="válassz egy fájlt.";
$lang['L_FM_UPLOADMOVEERROR']="Couldn't move selected file to the"
    ." upload directory.";
$lang['L_FM_UPLOADNOTALLOWED1']="Ez a fájltípus nem támogatott.";
$lang['L_FM_UPLOADNOTALLOWED2']="Valid types are: *.gz and *.sql-files";
$lang['L_FOUND_DB']="found db";
$lang['L_FROMFILE']="from file";
$lang['L_FROMTEXTBOX']="from text box";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Kapcsolat hozzáadása";
$lang['L_FTP_CHOOSE_MODE']="FTP Transfer Mode";
$lang['L_FTP_CONFIRM_DELETE']="Biztosan törölni akarod ezt az"
    ." FTP-kapcsolatot?";
$lang['L_FTP_CONNECTION']="FTP-kapcsolat";
$lang['L_FTP_CONNECTION_CLOSED']="FTP-kapcsolat bezárva";
$lang['L_FTP_CONNECTION_DELETE']="Kapcsolat törlése";
$lang['L_FTP_CONNECTION_ERROR']="The connection to server '%s' using"
    ." port %s couldn't be established";
$lang['L_FTP_CONNECTION_SUCCESS']="The connection to server '%s' using"
    ." port %s was established successfully";
$lang['L_FTP_DIR']="Könyvtár feltöltése";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Transfer of file '%s' was faulty";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="The file '%s' was transferred"
    ." successfully";
$lang['L_FTP_LOGIN_ERROR']="Bejelentkezés mint '%s' megtagadva";
$lang['L_FTP_LOGIN_SUCCESS']="Sikeresen bejelentkezve mint '%s'";
$lang['L_FTP_OK']="Sikeres kapcsolat.";
$lang['L_FTP_PASS']="Jelszó";
$lang['L_FTP_PASSIVE']="passzív mód használata";
$lang['L_FTP_PASV_ERROR']="Switching to passive mode was"
    ." unsuccessful";
$lang['L_FTP_PASV_SUCCESS']="Switching to passive mode was"
    ." successfull";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="to <strong>%s</strong><br /> into"
    ." <strong>%s</strong>";
$lang['L_FTP_SERVER']="Szerver";
$lang['L_FTP_SSL']="Biztonságos SSL FTP-kapcsolat";
$lang['L_FTP_START']="Starting FTP transfer";
$lang['L_FTP_TIMEOUT']="Connection Timeout";
$lang['L_FTP_TRANSFER']="FTP Transfer";
$lang['L_FTP_USER']="Felhasználó";
$lang['L_FTP_USESSL']="SSL kapcsolat használata";
$lang['L_GENERAL']="General";
$lang['L_GZIP']="GZip tömörítés";
$lang['L_GZIP_COMPRESSION']="GZip tömörítés";
$lang['L_HOME']="Kezdőlap";
$lang['L_HOUR']="Óra";
$lang['L_HOURS']="Hours";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Activate rewrite";
$lang['L_HTACC_ADD_HANDLER']="Add handler";
$lang['L_HTACC_CONFIRM_DELETE']="Should the directory protection be"
    ." written now ?";
$lang['L_HTACC_CONTENT']="Fájl tartalma";
$lang['L_HTACC_CREATE']="Create directory protection";
$lang['L_HTACC_CREATED']="The directory protection was created.";
$lang['L_HTACC_CREATE_ERROR']="There was an error while creating the"
    ." directory protection !<br />Please"
    ." create the 2 files manually with the"
    ." following content";
$lang['L_HTACC_CRYPT']="Crypt 8 Chars max (Linux and"
    ." Unix-Systems)";
$lang['L_HTACC_DENY_ALLOW']="Tilt / Enged";
$lang['L_HTACC_DIR_LISTING']="Directory Listing";
$lang['L_HTACC_EDIT']=".htaccess szerkesztése";
$lang['L_HTACC_ERROR_DOC']="Error Document";
$lang['L_HTACC_EXAMPLES']="More examples and documentation";
$lang['L_HTACC_EXISTS']="It already exists an directory"
    ." protection. If you create a new one,"
    ." the older one will be overwritten !";
$lang['L_HTACC_MAKE_EXECUTABLE']="Make executable";
$lang['L_HTACC_MD5']="MD5 (Linux és Unix rendszerek)";
$lang['L_HTACC_NO_ENCRYPTION']="plain text, no cryption (Windows)";
$lang['L_HTACC_NO_USERNAME']="Meg kell adnod egy nevet!";
$lang['L_HTACC_PROPOSED']="Urgently recommended";
$lang['L_HTACC_REDIRECT']="Átirányítás";
$lang['L_HTACC_SCRIPT_EXEC']="Execute script";
$lang['L_HTACC_SHA1']="SHA1 (minden rendszer)";
$lang['L_HTACC_WARNING']="Attention! The .htaccess directly"
    ." affects the browser's behavior.<br"
    ." />With incorrect content, these pages"
    ." may no longer be accessible.";
$lang['L_IMPORT']="Importálás";
$lang['L_IMPORTIEREN']="Importálás";
$lang['L_IMPORTOPTIONS']="Importálási opciók";
$lang['L_IMPORTSOURCE']="Import Source";
$lang['L_IMPORTTABLE']="Import in Table";
$lang['L_IMPORT_NOTABLE']="No table was selected for import!";
$lang['L_IN']="in";
$lang['L_INDEX_SIZE']="Size of index";
$lang['L_INFO_ACTDB']="Kiválasztott adatbázis";
$lang['L_INFO_DATABASES']="Accessable database(s)";
$lang['L_INFO_DBEMPTY']="Az adatbázis üres!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="Ezen a szerveren a fsockopen() PHP"
    ." funkció le van tiltva, ezért nem"
    ." lehet automatikusan letölteni a"
    ." nyelvi fájlokat. Ezt kikerülendő,"
    ." töltsd le manuálisan a csomagokat,"
    ." csomagold ki őket, majd töltsd fel a"
    ." MySQLDumper telepítésed \"language\""
    ." könyvtárába. Ezután itt elérhető"
    ." lesz az új nyelvi fájl.";
$lang['L_INFO_LASTUPDATE']="Legutóbbi frissítés";
$lang['L_INFO_LOCATION']="Your location is";
$lang['L_INFO_NODB']="adatbázis nem létezik.";
$lang['L_INFO_NOPROCESSES']="nincsenek futó folyamatok";
$lang['L_INFO_NOSTATUS']="no status available";
$lang['L_INFO_NOVARS']="no variables available";
$lang['L_INFO_OPTIMIZED']="optimized";
$lang['L_INFO_RECORDS']="Records";
$lang['L_INFO_SIZE']="Méret";
$lang['L_INFO_SUM']="Összesen";
$lang['L_INSTALL']="Telepítés";
$lang['L_INSTALLED']="Telepítve";
$lang['L_INSTALL_DB_DEFAULT']="Use as default database";
$lang['L_INSTALL_HELP_PORT']="(üres = alapértelmezett port)";
$lang['L_INSTALL_HELP_SOCKET']="(empty = Default Socket)";
$lang['L_IS_WRITABLE']="Írható";
$lang['L_KILL_PROCESS']="Stop process";
$lang['L_LANGUAGE']="Nyelv";
$lang['L_LANGUAGE_NAME']="Magyar";
$lang['L_LASTBACKUP']="Last Backup";
$lang['L_LOAD']="Alapértelmezett beállítások"
    ." betöltése";
$lang['L_LOAD_DATABASE']="Reload databases";
$lang['L_LOAD_FILE']="Load file";
$lang['L_LOG']="Log";
$lang['L_LOGFILENOTWRITABLE']="Can't write to logfile!";
$lang['L_LOGFILES']="Logfiles";
$lang['L_LOGGED_IN']="Bejelentkezve mint";
$lang['L_LOGIN']="Bejelentkezés";
$lang['L_LOGIN_AUTOLOGIN']="Automatikus bejelentkezés";
$lang['L_LOGIN_INVALID_USER']="Unknown combination of username and"
    ." password.";
$lang['L_LOGOUT']="Kijelentkezés";
$lang['L_LOG_CREATED']="Log file created.";
$lang['L_LOG_DELETE']="delete Log";
$lang['L_LOG_MAXSIZE']="Maximum size of log files";
$lang['L_LOG_NOT_READABLE']="The log file '%s' does not exist or is"
    ." not readable.";
$lang['L_MAILERROR']="Nem sikerült elküldeni az e-mailt!";
$lang['L_MAILPROGRAM']="Mail program";
$lang['L_MAXIMUM_LENGTH']="Maximális hossz";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="This is the maximum number of bytes"
    ." one character needs, when it is saved"
    ." to disk.";
$lang['L_MAXSIZE']="Max. Size";
$lang['L_MAX_BACKUP_FILES_EACH2']="For each database";
$lang['L_MAX_EXECUTION_TIME']="Max execution time";
$lang['L_MAX_UPLOAD_SIZE']="Maximális fájlméret";
$lang['L_MAX_UPLOAD_SIZE_INFO']="If your Dumpfile is bigger than the"
    ." above mentioned limit, you must upload"
    ." it via FTP into the directory"
    ." \"work/backup\". <br />After that you"
    ." can choose it to begin a restore"
    ." progress.";
$lang['L_MEMORY']="Memória";
$lang['L_MENU_HIDE']="Menü elrejtése";
$lang['L_MENU_SHOW']="Menü mutatása";
$lang['L_MESSAGE']="Message";
$lang['L_MESSAGE_TYPE']="Message type";
$lang['L_MINUTE']="Perc";
$lang['L_MINUTES']="Minutes";
$lang['L_MOBILE_OFF']="Ki";
$lang['L_MOBILE_ON']="Be";
$lang['L_MODE_EASY']="Könnyű";
$lang['L_MODE_EXPERT']="Expert";
$lang['L_MSD_INFO']="MySQLDumper-Information";
$lang['L_MSD_MODE']="MySQLDumper-Mode";
$lang['L_MSD_VERSION']="MySQLDumper-Version";
$lang['L_MULTIDUMP']="Multidump";
$lang['L_MULTIDUMP_FINISHED']="Backup of <b>%d</b> Databases done";
$lang['L_MULTIPART_ACTUAL_PART']="Actual Part";
$lang['L_MULTIPART_SIZE']="maximális fájlméret";
$lang['L_MULTI_PART']="Multipart Backup";
$lang['L_MYSQLVARS']="MySQL Variables";
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
$lang['L_MYSQL_VERSION']="MySQL-verzió";
$lang['L_MYSQL_VERSION_TOO_OLD']="Sajnáljuk, a telepített"
    ." MySQL-verzió %s túl régi és nem"
    ." használható a MySQLDumper ezen"
    ." verziójával. Frissítsd a MySQL-t"
    ." legalább a %s verzióra.<br"
    ." />Alternatívaként feltelepítheted a"
    ." MySQLDumper 1.24-es verzióját, amely"
    ." képes együttműködni a MySQL"
    ." régebbi verzióval. Abban az esetben"
    ." viszont néhány új funkcióját nem"
    ." fogod tudni használni a"
    ." MySQLDumper-nek.";
$lang['L_MYSQL_VIEW']="Nézet";
$lang['L_MYSQL_VIEWS']="Nézetek";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Views show (filtered) recordsets of"
    ." one ore more tables but don't contain"
    ." own records.";
$lang['L_NAME']="Név";
$lang['L_NEW']="új";
$lang['L_NEWTABLE']="Új tábla létrehozása";
$lang['L_NEXT_AUTO_INCREMENT']="Next automatic index";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="Autoindex";
$lang['L_NO']="nem";
$lang['L_NOFTPPOSSIBLE']="You don't have FTP functions !";
$lang['L_NOGZPOSSIBLE']="Mivel a Zlib nincs telepítve, nem"
    ." használhatod a GZip-funkciókat!";
$lang['L_NONE']="nincs";
$lang['L_NOREVERSE']="Oldest entry first";
$lang['L_NOTAVAIL']="<em>nem elérhető</em>";
$lang['L_NOTHING_TO_DO']="Nincs mit tenni.";
$lang['L_NOTICE']="Notice";
$lang['L_NOTICES']="Notices";
$lang['L_NOT_ACTIVATED']="nincs aktiválva";
$lang['L_NOT_SUPPORTED']="This backup doesn't support this"
    ." function.";
$lang['L_NO_DB_FOUND']="Nem találhatóak adatbázisok!<br"
    ." />Nyisd meg a kapcsolódási"
    ." paramétereket és írd be az"
    ." adatbázisnevet.";
$lang['L_NO_DB_FOUND_INFO']="Kapcsolat az adatbázishoz sikeresen"
    ." létrejött.<br /><br />A"
    ." felhasználói adataid érvényesek"
    ." és elfogadta őket a"
    ." MySQL-szerver.<br /><br />Viszont a"
    ." MySQLDumper nem talált egy"
    ." adatbázist sem.<br /><br />A szkript"
    ." általi automatikus érzékelés"
    ." néhány szerveren nincs"
    ." engedélyezve.<br /><br />Miután"
    ." befejezted a telepítést, az"
    ." adatbázis nevét manuálisan kell"
    ." beírnod.<br />Kattints a"
    ." \"beállítások\" - \"Kapcsolódási"
    ." paraméterek - megjelenítés\""
    ." menüpontra és írd be az adatbázis"
    ." nevét.";
$lang['L_NO_DB_SELECTED']="Nincs adatbázis kiválasztva.";
$lang['L_NO_ENTRIES']="Table is empty and doesn't have any"
    ." entry.";
$lang['L_NO_MSD_BACKUPFILE']="Más szkriptek mentései";
$lang['L_NO_NAME_GIVEN']="You didn't enter a name.";
$lang['L_NR_OF_QUERIES']="Number of queries";
$lang['L_NR_OF_RECORDS']="Rekordok száma";
$lang['L_NR_TABLES_OPTIMIZED']="%s tables have been optimized.";
$lang['L_NUMBER_OF_FILES_FORM']="Delete by number of files per database";
$lang['L_OF']="of";
$lang['L_OK']="OK";
$lang['L_OPTIMIZE']="Optimize";
$lang['L_OPTIMIZE_TABLES']="Optimize Tables before Backup";
$lang['L_OPTIMIZE_TABLE_ERR']="Error optimizing table `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Optimized table `%s` successfully.";
$lang['L_OS']="Operációs rendszer";
$lang['L_OVERHEAD']="Overhead";
$lang['L_PAGE']="Oldal";
$lang['L_PAGE_REFRESHS']="Oldalmegtekintések";
$lang['L_PASS']="Jelszó";
$lang['L_PASSWORD']="Jelszó";
$lang['L_PASSWORDS_UNEQUAL']="A jelszavak nem egyeznek vagy üresek!";
$lang['L_PASSWORD_REPEAT']="Jelszó (újra)";
$lang['L_PASSWORD_STRENGTH']="Jelszó erőssége";
$lang['L_PERLOUTPUT1']="Entry in crondump.pl for"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="URL for the browser or for external"
    ." Cron job";
$lang['L_PERLOUTPUT3']="Commandline in the Shell or for the"
    ." Crontab";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-Log";
$lang['L_PERL_LOG']="Perl-log";
$lang['L_PHPBUG']="Bug in zlib ! No Compression possible!";
$lang['L_PHPMAIL']="PHP-Funktion mail()";
$lang['L_PHP_EXTENSIONS']="PHP-kiterjesztések";
$lang['L_PHP_LOG']="PHP-log";
$lang['L_PHP_VERSION']="PHP-verzió";
$lang['L_PHP_VERSION_TOO_OLD']="Sajnáljuk, a telepített PHP verzió"
    ." túl régi. A MySQLDumper"
    ." használatához legalább %s vagy"
    ." magasabb verziószámú PHP"
    ." szükséges. Ezen a szerveren %s"
    ." verziójú PHP működik, amely túl"
    ." régi. Frissítsd a PHP verziódat"
    ." mielőtt telepítenéd és"
    ." használnád a MySQLDumpert.";
$lang['L_POP3_PORT']="POP3-port";
$lang['L_POP3_SERVER']="POP3-szerver";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="lent, középen";
$lang['L_POSITION_BL']="lent, balra";
$lang['L_POSITION_BR']="lent, jobbra";
$lang['L_POSITION_MC']="középen";
$lang['L_POSITION_ML']="balra középen";
$lang['L_POSITION_MR']="jobbra középen";
$lang['L_POSITION_NOTIFICATIONS']="Értesítési ablak helye";
$lang['L_POSITION_TC']="fent középen";
$lang['L_POSITION_TL']="balra középen";
$lang['L_POSITION_TR']="fent jobbra";
$lang['L_POSSIBLE_COLLATIONS']="Possible collations";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="These are the possible collations one"
    ." can choose for this character set.<br"
    ." /><br />_cs = case sensitiv<br />_ci ="
    ." case insensitive";
$lang['L_PREFIX']="Prefix";
$lang['L_PRIMARYKEYS_CHANGED']="Az elsődleges kulcsok megváltoztak";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Hiba az elsődleges kulcsok"
    ." megváltoztatása közben";
$lang['L_PRIMARYKEYS_SAVE']="Elsődleges kulcsok mentése";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Biztosan törlöd az elsődleges"
    ." kulcsot?";
$lang['L_PRIMARYKEY_DELETED']="Elsődleges kulcs törölve";
$lang['L_PRIMARYKEY_FIELD']="Elsődleges kulcs mező";
$lang['L_PRIMARYKEY_NOTFOUND']="Nem található elsődleges kulcs";
$lang['L_PROCESSKILL1']="The script tries to kill process";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="The script tries since";
$lang['L_PROCESSKILL4']="sec. to kill the process";
$lang['L_PROCESS_ID']="Folyamat ID";
$lang['L_PROGRESS_FILE']="Progress file";
$lang['L_PROGRESS_OVER_ALL']="Overall Progress";
$lang['L_PROGRESS_TABLE']="Progress of table";
$lang['L_PROVIDER']="Provider";
$lang['L_PROZESSE']="Folyamatok";
$lang['L_QUERY']="Query";
$lang['L_QUERY_TYPE']="Query type";
$lang['L_RECHTE']="Engedélyek";
$lang['L_RECORDS']="Rekord";
$lang['L_RECORDS_INSERTED']="<b>%s</b> rekord beszúrva.";
$lang['L_RECORDS_OF_TABLE']="Tábla rekordjai";
$lang['L_RECORDS_PER_PAGECALL']="Records per pagecall";
$lang['L_REFRESHTIME']="Refresh time";
$lang['L_REFRESHTIME_PROCESSLIST']="Refreshing time of the process list";
$lang['L_REGISTRATION_DESCRIPTION']="Please enter the administrator account"
    ." now. You will login into MySQLDumper"
    ." with this user. Note the dates now"
    ." given good reason.<br /><br />You can"
    ." choose your username and password"
    ." free. Please make sure to choose the"
    ." safest possible combination of user"
    ." name and password to protect access to"
    ." MySQLDumper against unauthorized"
    ." access best!";
$lang['L_RELOAD']="Frissítés";
$lang['L_REMOVE']="Eltávolítás";
$lang['L_REPAIR']="Javítás";
$lang['L_RESET']="Reset";
$lang['L_RESET_SEARCHWORDS']="reset search words";
$lang['L_RESTORE']="Visszaállítás";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> tábla létrehozva.";
$lang['L_RESTORE_DB']="Database '<b>%s</b>' on '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="A(z) '%s' adatbázis visszaállítása"
    ." %s múlva lesz készen.";
$lang['L_RESTORE_OF_TABLES']="Válaszd ki a visszaállítandó"
    ." táblákat";
$lang['L_RESTORE_TABLE']="A(z) '%s' tábla visszaállítása";
$lang['L_RESTORE_TABLES_COMPLETED']="Up to now <b>%d</b> of <b>%d</b>"
    ." tables were created.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Up to now <b>%d</b> tables were"
    ." created.";
$lang['L_RESULT']="Result";
$lang['L_REVERSE']="Last entry first";
$lang['L_SAFEMODEDESC']="Mivel a PHP safe_mode-ban fut, az"
    ." alábbi könyvtárakat manuálisan"
    ." kell elkészítened az FTP-programod"
    ." segítségével:";
$lang['L_SAVE']="Mentés";
$lang['L_SAVEANDCONTINUE']="Mentés és telepítés folytatása";
$lang['L_SAVE_ERROR']="Hiba: nem lehet menteni a"
    ." beállításokat!";
$lang['L_SAVE_SUCCESS']="A beállítások sikeresen elmentve"
    ." a(z) konfigurációs fájlba.";
$lang['L_SAVING_DATA_TO_FILE']="A(z) '%s' adatbázis adatainak"
    ." mentése a(z) '%s' fájlba";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximum filesize reached: proceeding"
    ." with file '%s'";
$lang['L_SAVING_DB_FORM']="Adatbázis";
$lang['L_SAVING_TABLE']="Tábla mentése";
$lang['L_SEARCH_ACCESS_KEYS']="Böngészés: előre=ALT+V,"
    ." vissza=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Keresés a táblában";
$lang['L_SEARCH_NO_RESULTS']="A(z) \"<b>%s</b>\" keresés a(z)"
    ." \"<b>%s</b>\" táblában nem talált"
    ." semmit.";
$lang['L_SEARCH_OPTIONS']="Keresési opciók";
$lang['L_SEARCH_OPTIONS_AND']="egy oszlopnak tartalmaznia kell az"
    ." összes keresőszót (ÉS-keresés)";
$lang['L_SEARCH_OPTIONS_CONCAT']="a row must contain all of the search"
    ." words but they can be in any column"
    ." (could take some time)";
$lang['L_SEARCH_OPTIONS_OR']="egy oszlopnak tartalmaznia kell"
    ." legalább egyet a keresőszavak"
    ." közül (VAGY-keresés)";
$lang['L_SEARCH_RESULTS']="A(z) \"<b>%s</b>\" keresés a(z)"
    ." \"<b>%s</b>\" táblában a következő"
    ." találatokat eredményezte:";
$lang['L_SECOND']="Másodperc";
$lang['L_SECONDS']="másodperc";
$lang['L_SELECT']="Select";
$lang['L_SELECTED_FILE']="Kiválasztott fájl";
$lang['L_SELECT_ALL']="Összes kiválasztása";
$lang['L_SELECT_FILE']="Fájl kiválasztása";
$lang['L_SELECT_LANGUAGE']="Nyelv kiválasztása";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="eredmény elküldése fájlként";
$lang['L_SEND_MAIL_FORM']="Send email report";
$lang['L_SERVER']="Szerver";
$lang['L_SERVERCAPTION']="Display Server";
$lang['L_SETPRIMARYKEYSFOR']="Set new primary keys for table";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Showing entry %s to %s of %s";
$lang['L_SHOWRESULT']="eredmény mutatása";
$lang['L_SHOW_TABLES']="Táblák mutatása";
$lang['L_SHOW_TOOLTIPS']="Show nicer tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-Host";
$lang['L_SMTP_PORT']="SMTP-port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Sebesség";
$lang['L_SQLBOX']="SQL-Box";
$lang['L_SQLBOXHEIGHT']="Height of SQL-Box";
$lang['L_SQLLIB_ACTIVATEBOARD']="activate Board";
$lang['L_SQLLIB_BOARDS']="Boards";
$lang['L_SQLLIB_DEACTIVATEBOARD']="deactivate Board";
$lang['L_SQLLIB_GENERALFUNCTIONS']="general functions";
$lang['L_SQLLIB_RESETAUTO']="reset auto-increment";
$lang['L_SQLLIMIT']="Count of records each page";
$lang['L_SQL_ACTIONS']="Actions";
$lang['L_SQL_AFTER']="after";
$lang['L_SQL_ALLOWDUPS']="Duplicates allowed";
$lang['L_SQL_ATPOSITION']="insert at position";
$lang['L_SQL_ATTRIBUTES']="Attribútumok";
$lang['L_SQL_BACKDBOVERVIEW']="Back to Overview";
$lang['L_SQL_BEFEHLNEU']="New command";
$lang['L_SQL_BEFEHLSAVED1']="SQL Command";
$lang['L_SQL_BEFEHLSAVED2']="hozzáadva";
$lang['L_SQL_BEFEHLSAVED3']="mentve";
$lang['L_SQL_BEFEHLSAVED4']="was moved up";
$lang['L_SQL_BEFEHLSAVED5']="törölve";
$lang['L_SQL_BROWSER']="SQL-Browser";
$lang['L_SQL_CARDINALITY']="Cardinality";
$lang['L_SQL_CHANGED']="was changed.";
$lang['L_SQL_CHANGEFIELD']="change field";
$lang['L_SQL_CHOOSEACTION']="Choose action";
$lang['L_SQL_COLLATENOTMATCH']="Charset and Collation don't fit"
    ." together!";
$lang['L_SQL_COLUMNS']="Oszlopok";
$lang['L_SQL_COMMANDS']="SQL Commands";
$lang['L_SQL_COMMANDS_IN']="lines in";
$lang['L_SQL_COMMANDS_IN2']="sec. parsed.";
$lang['L_SQL_COPYDATADB']="Copy complete Database to";
$lang['L_SQL_COPYSDB']="Copy Structure of Database";
$lang['L_SQL_COPYTABLE']="tábla másolása";
$lang['L_SQL_CREATED']="was created.";
$lang['L_SQL_CREATEINDEX']="új index létrehozása";
$lang['L_SQL_CREATETABLE']="tábla létrehozása";
$lang['L_SQL_DATAVIEW']="Adat nézet";
$lang['L_SQL_DBCOPY']="A(z) adatbázis tartalma átmásolva"
    ." a(z) `%s` adatbázisba.";
$lang['L_SQL_DBSCOPY']="The Structure of Database `%s` was"
    ." copied in Database `%s`.";
$lang['L_SQL_DELETED']="törölve";
$lang['L_SQL_DESTTABLE_EXISTS']="Destination Table exists !";
$lang['L_SQL_EDIT']="szerkesztés";
$lang['L_SQL_EDITFIELD']="Mező szerkesztése";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Edit table structure";
$lang['L_SQL_EMPTYDB']="Üres adatbázis";
$lang['L_SQL_ERROR1']="Error in Query:";
$lang['L_SQL_ERROR2']="MySQL says:";
$lang['L_SQL_EXEC']="Execute SQL Statement";
$lang['L_SQL_EXPORT']="Exportálás a(z) `%s` adatbázisból";
$lang['L_SQL_FIELDDELETE1']="The Field";
$lang['L_SQL_FIELDNAMENOTVALID']="Hiba: érvénytelen mezőnév";
$lang['L_SQL_FIRST']="első";
$lang['L_SQL_IMEXPORT']="Importálás-Exportálás";
$lang['L_SQL_IMPORT']="Importálás a(z) `%s` adatbázisba";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: incomplete statement detected.<br"
    ." />Couldn't find closing match for '%s'"
    ." in query:<br />%s";
$lang['L_SQL_INDEXES']="Indices";
$lang['L_SQL_INSERTFIELD']="mező beszúrása";
$lang['L_SQL_INSERTNEWFIELD']="új mező beszúrása";
$lang['L_SQL_LIBRARY']="SQL könyvtár";
$lang['L_SQL_NAMEDEST_MISSING']="Name of Destination is missing !";
$lang['L_SQL_NEWFIELD']="Új mező";
$lang['L_SQL_NODATA']="nincsenek rekordok";
$lang['L_SQL_NODEST_COPY']="No Copy without Destination !";
$lang['L_SQL_NOFIELDDELETE']="Delete is not possible because Tables"
    ." must contain at least one field.";
$lang['L_SQL_NOTABLESINDB']="Nem találhatóak táblák az"
    ." adatbázisban";
$lang['L_SQL_NOTABLESSELECTED']="Nincs tábla kiválasztva!";
$lang['L_SQL_OPENFILE']="SQL-fájl megnyitása";
$lang['L_SQL_OPENFILE_BUTTON']="Feltöltés";
$lang['L_SQL_OUT1']="Executed";
$lang['L_SQL_OUT2']="Commands";
$lang['L_SQL_OUT3']="It had";
$lang['L_SQL_OUT4']="Comments";
$lang['L_SQL_OUT5']="Because the output contains more than"
    ." 5000 lines it isn't displayed.";
$lang['L_SQL_OUTPUT']="SQL Output";
$lang['L_SQL_QUERYENTRY']="The Query contains";
$lang['L_SQL_RECORDDELETED']="Rekord törölve";
$lang['L_SQL_RECORDEDIT']="rekord szerkesztése";
$lang['L_SQL_RECORDINSERTED']="rekord hozzáadva";
$lang['L_SQL_RECORDNEW']="új rekord";
$lang['L_SQL_RECORDUPDATED']="Record was updated";
$lang['L_SQL_RENAMEDB']="Rename Database";
$lang['L_SQL_RENAMEDTO']="átnevezve";
$lang['L_SQL_SCOPY']="Table structure of `%s` was copied in"
    ." Table `%s`.";
$lang['L_SQL_SEARCH']="Keresés";
$lang['L_SQL_SEARCHWORDS']="Keresőszavak";
$lang['L_SQL_SELECTTABLE']="tábla kiválasztása";
$lang['L_SQL_SERVER']="SQL-szerver";
$lang['L_SQL_SHOWDATATABLE']="Show Data of Table";
$lang['L_SQL_STRUCTUREDATA']="Structure and Data";
$lang['L_SQL_STRUCTUREONLY']="Only Structure";
$lang['L_SQL_TABLEEMPTIED']="`%s` tábla törölve.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="Table `%s` was deleted and the indices"
    ." were reset.";
$lang['L_SQL_TABLEINDEXES']="Indexes of table";
$lang['L_SQL_TABLENEW']="Táblák szerkesztése";
$lang['L_SQL_TABLENOINDEXES']="No Indexes in Table";
$lang['L_SQL_TABLENONAME']="Table needs a name!";
$lang['L_SQL_TABLESOFDB']="Tables of Database";
$lang['L_SQL_TABLEVIEW']="Tábla nézet";
$lang['L_SQL_TBLNAMEEMPTY']="A tábla név nem lehet üres!";
$lang['L_SQL_TBLPROPSOF']="Table properties of";
$lang['L_SQL_TCOPY']="Table `%s` was copied with data in"
    ." Table `%s`.";
$lang['L_SQL_UPLOADEDFILE']="loaded file:";
$lang['L_SQL_VIEW_COMPACT']="Nézet: kompakt";
$lang['L_SQL_VIEW_STANDARD']="Nézet: standard";
$lang['L_SQL_VONINS']="from totally";
$lang['L_SQL_WARNING']="The execution of SQL Statements can"
    ." manipulate data. TAKE CARE! The"
    ." Authors don't accept any liability for"
    ." damaged or lost data.";
$lang['L_SQL_WASCREATED']="was created";
$lang['L_SQL_WASEMPTIED']="was emptied";
$lang['L_STARTDUMP']="Start Backup";
$lang['L_START_RESTORE_DB_FILE']="Starting restore of database '%s' from"
    ." file '%s'.";
$lang['L_START_SQL_SEARCH']="start search";
$lang['L_STATUS']="State";
$lang['L_STEP']="Lépés";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="A(z) \"%s\" konfigurációs fájl"
    ." sikeresen létrehozva.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="A(z) \"%s\" konfigurációs fájl"
    ." sikeresen törölve.";
$lang['L_SUM_TOTAL']="Sum";
$lang['L_TABLE']="Tábla";
$lang['L_TABLENAME']="Tábla neve";
$lang['L_TABLENAME_EXPLAIN']="Tábla neve";
$lang['L_TABLES']="Tables";
$lang['L_TABLESELECTION']="Table selection";
$lang['L_TABLE_CREATE_SUCC']="A(z) '%s' tábla sikeresen"
    ." elkészült.";
$lang['L_TABLE_TYPE']="Tábla típusa";
$lang['L_TESTCONNECTION']="Test Connection";
$lang['L_THEME']="Theme";
$lang['L_TIME']="Idő";
$lang['L_TIMESTAMP']="Timestamp";
$lang['L_TITLE_INDEX']="Index";
$lang['L_TITLE_KEY_FULLTEXT']="Fulltext key";
$lang['L_TITLE_KEY_PRIMARY']="Elsődleges kulcs";
$lang['L_TITLE_KEY_UNIQUE']="Unique key";
$lang['L_TITLE_MYSQL_HELP']="MySQL documentation";
$lang['L_TITLE_NOKEY']="Nincs kulcs";
$lang['L_TITLE_SEARCH']="Keresés";
$lang['L_TITLE_SHOW_DATA']="Show data";
$lang['L_TITLE_UPLOAD']="Upload SQL file";
$lang['L_TO']="to";
$lang['L_TOOLS']="Eszközök";
$lang['L_TOOLS_TOOLBOX']="Select Database / Datebase functions /"
    ." Import - Export";
$lang['L_TRUNCATE']="Truncate";
$lang['L_TRUNCATE_DATABASE']="Truncate database";
$lang['L_UNIT_KB']="KiloByte";
$lang['L_UNIT_MB']="MegaByte";
$lang['L_UNIT_PIXEL']="pixel";
$lang['L_UNKNOWN']="ismeretlen";
$lang['L_UNKNOWN_SQLCOMMAND']="unknown SQL-Command";
$lang['L_UPDATE']="Update";
$lang['L_UPDATE_CONNECTION_FAILED']="Update failed because connection to"
    ." server '%s' could not be established.";
$lang['L_UPDATE_ERROR_RESPONSE']="Update failed, server returned: '%s'";
$lang['L_UPTO']="up to";
$lang['L_USERNAME']="Felhasználónév";
$lang['L_USE_SSL']="SSL használata";
$lang['L_VALUE']="Value";
$lang['L_VERSIONSINFORMATIONEN']="Version Information";
$lang['L_VIEW']="view";
$lang['L_VISIT_HOMEPAGE']="Honlap megtekintése";
$lang['L_VOM']="from";
$lang['L_WITH']="with";
$lang['L_WITHATTACH']="with attach";
$lang['L_WITHOUTATTACH']="without attach";
$lang['L_WITHPRAEFIX']="with prefix";
$lang['L_WRONGCONNECTIONPARS']="A kapcsolódási paraméterek"
    ." hiányoznak vagy hibásak!";
$lang['L_WRONG_CONNECTIONPARS']="Connection parameters are wrong !";
$lang['L_WRONG_RIGHTS']="The file or the directory '%s' is not"
    ." writable for me. The rights (chmod)"
    ." are not set properly or it has the"
    ." wrong owner.<br /><br />Please set the"
    ." correct attributes using your FTP"
    ." program. The file or the directory"
    ." needs to be set to %s.";
$lang['L_YES']="igen";
$lang['L_ZEND_FRAMEWORK_VERSION']="Zend Framework verzió";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="A(z) '%value%' megadott fájlnév nem"
    ." könyvtár.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="A(z) '%value%' megadott fájlnév nem"
    ." fájl.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="The given target '%value%' is not a"
    ." link.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="A(z) '%value%' nevű fájl vagy"
    ." könyvtár nem futtatható.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="A(z) '%value%' nevű fájl vagy"
    ." könyvtár nem létezik.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="A(z) '%value%' fájl vagy könyvtár"
    ." nem olvasható.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="A(z) megadott '%value%' nincs"
    ." feltöltve.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="A(z) '%value%' nevű fájl vagy"
    ." könyvtár nem írható.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Invalid type given. String, integer or"
    ." float expected.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="Value is an empty string.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="The email address can not be matched"
    ." against dot-atom format.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Invalid type given. String expected.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="Érvénytelen e-mail cím.";
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
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="Az e-mail cím túl hosszú. A"
    ." maximális hossz 320 karakter.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="The email addess can not be matched"
    ." against quoted-string format.";
$lang['L_ZEND_ID_IS_EMPTY']="Value is required and can't be empty.";
$lang['L_ZEND_ID_MISSING_TOKEN']="No token was provided to match"
    ." against.";
$lang['L_ZEND_ID_NOT_DIGITS']="Csak számok engedélyezettek.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Invalid type given. String, integer,"
    ." float, boolean or array expected.";
$lang['L_ZEND_ID_NOT_SAME']="The two given tokens do not match.";
return $lang;
