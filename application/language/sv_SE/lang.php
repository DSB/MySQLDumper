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
$lang['L_ACTION']="Aktion";
$lang['L_ACTIVATED']="aktiverat";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Hittills har <b>%s</b> dataposter"
    ." överförts.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Hittills har <b>%s</b> av <b>%s</b>"
    ." dataposter överförts.";
$lang['L_ADD']="Lägg till";
$lang['L_ADDED']="adderat";
$lang['L_ADD_DB_MANUALLY']="Lägg till databas manuellt";
$lang['L_ADD_RECIPIENT']="Lägg till mottagare";
$lang['L_ALL']="alla";
$lang['L_ANALYZE']="Analysera";
$lang['L_ANALYZING_TABLE']="För närvarande analyseras datan i"
    ." tabell '<b>%s</b>'.";
$lang['L_ASKDBCOPY']="Vill du kopiera innehållet i"
    ." databasen `%s` till databasen `%s`?";
$lang['L_ASKDBDELETE']="Vill du verkligen radera databasen"
    ." `%s` samt dess innehåll?";
$lang['L_ASKDBEMPTY']="Vill du verkligen tömma databasen"
    ." `%s`?";
$lang['L_ASKDELETEFIELD']="Skall fältet verkligen raderas?";
$lang['L_ASKDELETERECORD']="Skall dataposten verkligen raderas?";
$lang['L_ASKDELETETABLE']="Skall tabellen `%s` verkligen raderas?";
$lang['L_ASKTABLEEMPTY']="Skall tabellen `%s` verkligen tömmas?";
$lang['L_ASKTABLEEMPTYKEYS']="Skall tabellen `%s` tömmas och"
    ." indexen återställas?";
$lang['L_ATTACHED_AS_FILE']="bifoga som fil";
$lang['L_ATTACH_BACKUP']="Bifoga backup";
$lang['L_AUTHENTICATE']="Inloggningsinformation";
$lang['L_AUTHORIZE']="Auktorisera";
$lang['L_AUTODELETE']="Automatisk radering av backup-filer";
$lang['L_BACK']="tillbaka";
$lang['L_BACKUPFILESANZAHL']="I backup-mappen finns";
$lang['L_BACKUPS']="backup(er)";
$lang['L_BACKUP_DBS']="backup av databaser";
$lang['L_BACKUP_TABLE_DONE']="Backup av tabellen `%s` avslutad. %s"
    ." poster har säkrats.";
$lang['L_BACK_TO_OVERVIEW']="Databasöversikt";
$lang['L_CALL']="Anrop";
$lang['L_CANCEL']="Avbryt";
$lang['L_CANT_CREATE_DIR']="Mappen '%s' kunde ej skapas. Skapa den"
    ." med ditt FTP-program.";
$lang['L_CHANGE']="redigera";
$lang['L_CHANGEDIR']="Hoppa till mapp";
$lang['L_CHANGEDIRERROR']="Kunde ej hoppa till mapp!";
$lang['L_CHARSET']="Teckensats";
$lang['L_CHARSETS']="Teckensatser";
$lang['L_CHECK']="Kontrollera";
$lang['L_CHECK_DIRS']="kontrollera mina mappar";
$lang['L_CHOOSE_CHARSET']="Tyvärr kunde ej fastställas"
    ." automatiskt med vilken teckensats"
    ." denna backupfil har skapats.<br />Du"
    ." måste ange koderingen manuellt.<br"
    ." />Därefter ställer MySQLDumper in"
    ." förbindelseparametrarna till"
    ." MySQL-servern till den valda"
    ." teckensatsen och startar"
    ." återställningen.<br />Om datan"
    ." återges med fel specialtecken efter"
    ." återställningen så bör du upprepa"
    ." återställningen med en annan"
    ." inställning för teckensatsen.<br"
    ." />Lycka till.";
$lang['L_CHOOSE_DB']="Välj databas";
$lang['L_CLEAR_DATABASE']="Töm databasen";
$lang['L_CLOSE']="Stäng";
$lang['L_COLLATION']="Sortering";
$lang['L_COMMAND']="Kommando";
$lang['L_COMMAND_AFTER_BACKUP']="Kommando efter backup";
$lang['L_COMMAND_BEFORE_BACKUP']="Kommando före backup";
$lang['L_COMMENT']="Kommentar";
$lang['L_COMPRESSED']="komprimerat (gz)";
$lang['L_CONFBASIC']="Grundinställningar";
$lang['L_CONFIG']="Konfigurering";
$lang['L_CONFIGFILE']="Konfigureringsfil";
$lang['L_CONFIGFILES']="Konfigureringsfiler";
$lang['L_CONFIGURATIONS']="Inställningar";
$lang['L_CONFIG_AUTODELETE']="Automatisk radering";
$lang['L_CONFIG_CRONPERL']="Crondump-inställningar för"
    ." Perl-skriptet";
$lang['L_CONFIG_EMAIL']="Epostmeddelande";
$lang['L_CONFIG_FTP']="FTP-överföring av backup-filen";
$lang['L_CONFIG_HEADLINE']="Konfigurering";
$lang['L_CONFIG_INTERFACE']="Gränssnitt";
$lang['L_CONFIG_LOADED']="Konfigureringen \"%s\" har laddats.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Ska konfigureringsfilen %s verkligen"
    ." raderas?";
$lang['L_CONFIRM_DELETE_FILE']="Skall filen '%s' verkligen raderas?";
$lang['L_CONFIRM_DELETE_TABLES']="Ska de valda tabellerna verkligen"
    ." raderas?";
$lang['L_CONFIRM_DROP_DATABASES']="Ska de valda databaserna verkligen"
    ." raderas? OBS: all data går förlorad"
    ." och kan ej återställas! Skapa först"
    ." en backup!";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Ska mottagaren \"%s\" verkligen tas"
    ." bort";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Ska de valda databaserna verkligen"
    ." tömmas? OBS: alla tabeller går"
    ." förlorade och kan ej återställas!"
    ." Skapa först en backup!";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Ska de valda tabellerna verkligen"
    ." tömmas?";
$lang['L_CONNECT']="förbind";
$lang['L_CONNECTIONPARS']="Förbindelse-parametrar";
$lang['L_CONNECTTOMYSQL']="förbind med mysql";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Fortsätt mulipart-återställningen"
    ." med nästa fil '%s'.";
$lang['L_CONVERTED_FILES']="Konverterade filer";
$lang['L_CONVERTER']="Backup-konverterare";
$lang['L_CONVERTING']="Konvertering";
$lang['L_CONVERT_FILE']="fil som skall konverteras";
$lang['L_CONVERT_FILENAME']="Målfilens namn (utan filändelse)";
$lang['L_CONVERT_FILEREAD']="Filen '%s' läses in";
$lang['L_CONVERT_FINISHED']="Konverteringen avslutad, '%s' har"
    ." skapats.";
$lang['L_CONVERT_START']="Starta konvertering";
$lang['L_CONVERT_TITLE']="Konvertera dump till MSD-formatet";
$lang['L_CONVERT_WRONG_PARAMETERS']="Fel parametrar! Konverteringen kan ej"
    ." genomföras.";
$lang['L_CREATE']="skapa";
$lang['L_CREATED']="Skapad";
$lang['L_CREATEDIRS']="skapar mappar";
$lang['L_CREATE_AUTOINDEX']="Skapa auto-index";
$lang['L_CREATE_CONFIGFILE']="Skapa en ny konfigureringsfil";
$lang['L_CREATE_DATABASE']="skapa ny databas";
$lang['L_CREATE_TABLE_SAVED']="Definition av tabellen `%s` sparad.";
$lang['L_CREDITS']="Credits / Hjälp";
$lang['L_CRONSCRIPT']="Cronskript";
$lang['L_CRON_COMMENT']="Mata in kommentar";
$lang['L_CRON_COMPLETELOG']="Logga hela utmatningen";
$lang['L_CRON_EXECPATH']="Perl-skriptens sökväg";
$lang['L_CRON_EXTENDER']="Skriptets filändelse";
$lang['L_CRON_PRINTOUT']="Textutmatning";
$lang['L_CSVOPTIONS']="CSV-optioner";
$lang['L_CSV_EOL']="Raderna separerade med";
$lang['L_CSV_ERRORCREATETABLE']="Fel när tabellen `%s` skulle skapas!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="Antalet tabell-fält stämmer ej"
    ." överens med antalet som skall"
    ." importeras (%d istället för %d).";
$lang['L_CSV_FIELDSENCLOSED']="Fält inneslutna av";
$lang['L_CSV_FIELDSEPERATE']="Fält separerade med";
$lang['L_CSV_FIELDSESCAPE']="Fält escaped från";
$lang['L_CSV_FIELDSLINES']="%d fält fastställda, totalt %d rader";
$lang['L_CSV_FILEOPEN']="Öppna CSV-fil";
$lang['L_CSV_NAMEFIRSTLINE']="Fältnamn i första raden";
$lang['L_CSV_NODATA']="Ingen data kunde hittas för import!";
$lang['L_CSV_NULL']="Ersätt NULL med";
$lang['L_DATABASES_OF_USER']="Användarens databas";
$lang['L_DATABASE_CREATED_FAILED']="Databasen skapades ej.
MySQL ger"
    ." följande felmeddelande:<br/>
%s";
$lang['L_DATABASE_CREATED_SUCCESS']="Databasen '%s' har skapats.";
$lang['L_DATASIZE']="Datastorlek";
$lang['L_DATASIZE_INFO']="Detta är dataposternas storlek - inte"
    ." backupfilens storlek";
$lang['L_DAY']="Dag";
$lang['L_DAYS']="Dagar";
$lang['L_DB']="Databas";
$lang['L_DBCONNECTION']="Databas-förbindelse";
$lang['L_DBPARAMETER']="Databas-parametrar";
$lang['L_DBS']="Databaser";
$lang['L_DB_ADAPTER']="DB-adapter";
$lang['L_DB_BACKUPPARS']="Backup-inställningar för databas";
$lang['L_DB_DEFAULT']="Standarddatabas";
$lang['L_DB_HOST']="Databas-hostnamn";
$lang['L_DB_IN_LIST']="Databasen '%s' kunde ej läggas till"
    ." eftersom den redan existerar.";
$lang['L_DB_NAME']="Databasens namn";
$lang['L_DB_PASS']="Databas-lösenord";
$lang['L_DB_SELECT_ERROR']="<br />Fel:<br /> val av databasen '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' misslyckades!";
$lang['L_DB_USER']="Databas-användare";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Standardteckensats";
$lang['L_DEFAULT_CHARSET']="Standardteckensats";
$lang['L_DEFAULT_COLLATION_NAME']="Standardsortering";
$lang['L_DELETE']="Radera";
$lang['L_DELETE_DATABASE']="Radera databas";
$lang['L_DELETE_FILE_ERROR']="Filen \"%s\" kunde ej raderas!";
$lang['L_DELETE_FILE_SUCCESS']="Filen \"%s\" har raderats.";
$lang['L_DELETE_HTACCESS']="Avlägsna mappskyddet (radera"
    ." .htaccess-filen)";
$lang['L_DESCRIPTION']="Beskrivning";
$lang['L_DESELECT_ALL']="Avmarkera alla";
$lang['L_DIR']="Mapp";
$lang['L_DISABLEDFUNCTIONS']="Deaktiverade funktioner";
$lang['L_DO']="utför";
$lang['L_DOCRONBUTTON']="Utför Perl-cronscript";
$lang['L_DONE']="Färdig!";
$lang['L_DONT_ATTACH_BACKUP']="Bifoga ej backupfilen";
$lang['L_DOPERLTEST']="Testa Perl-modulerna";
$lang['L_DOSIMPLETEST']="Testa Perl";
$lang['L_DOWNLOAD_FILE']="Ladda hem filen";
$lang['L_DO_NOW']="utför nu";
$lang['L_DUMP']="Backup";
$lang['L_DUMP_ENDERGEBNIS']="<b>%s</b> tabeller med totalt"
    ." <b>%s</b> dataposter har säkrats.<br"
    ." />";
$lang['L_DUMP_FILENAME']="Backup-fil";
$lang['L_DUMP_HEADLINE']="skapa backup ...";
$lang['L_DUMP_NOTABLES']="Inga tabeller hittades i databasen"
    ." `%s`.";
$lang['L_DUMP_OF_DB_FINISHED']="Backup av databasen `%s` avslutad";
$lang['L_DURATION']="Längd";
$lang['L_EDIT']="redigera";
$lang['L_EHRESTORE_CONTINUE']="fortsätt och protokollera fel";
$lang['L_EHRESTORE_STOP']="stoppa";
$lang['L_EMAIL']="E-post";
$lang['L_EMAILBODY_ATTACH']="Här kommer backupen av din"
    ." MySQLdatabas.<br />Backup av databasen"
    ." `%s`
<br /><br />Följande fil har"
    ." skapats:<br /><br />%s <br /><br />Med"
    ." vänliga hälsningar<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Med vänliga"
    ." hälsningar<br /><br />MySQLDumper<br"
    ." />";
$lang['L_EMAILBODY_MP_ATTACH']="En multipart-backup har skapats.<br"
    ." />Backupen levereras i separata"
    ." mail!<br />Backup av databasen"
    ." `%s`
<br /><br />Följande filer har"
    ." skapats:<br /><br />%s<br /><br /><br"
    ." />Med vänliga hälsningar<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="En multipart-backup har skapats.<br"
    ." />Backuperna levereras EJ som bilaga i"
    ." mail!<br />Backup av databasen"
    ." `%s`
<br /><br />Följande filer har"
    ." skapats:<br /><br />%s<br /><br /><br"
    ." />Med vänliga hälsningar<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="Backuperna levereras EJ som bilaga i"
    ." mail!<br />Backup av databasen `%s`"
    ." <br /><br />Följande filer har"
    ." skapats:<br /><br />%s<br /><br /><br"
    ." />Med vänliga hälsningar<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="Backupen överskrider den maximala"
    ." storleken på %s och har därför ej"
    ." bifogats.<br />Backup av databasen"
    ." `%s` <br /><br />Följande fil har"
    ." skapats:<br /><br />%s <br /><br"
    ." />Vänliga hälsningar<br />Din"
    ." MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="Epost-adress";
$lang['L_EMAIL_CC']="CC-mottagare";
$lang['L_EMAIL_MAXSIZE']="Bilagans maximala storlek";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... endast bilagan";
$lang['L_EMAIL_RECIPIENT']="Epostadress";
$lang['L_EMAIL_SENDER']="Meddelandets avsändare";
$lang['L_EMAIL_START']="Startar e-postförsändelse";
$lang['L_EMAIL_WAS_SEND']="Epostmeddelandet har skickats till";
$lang['L_EMPTY']="Töm";
$lang['L_EMPTYKEYS']="töm och återställ index";
$lang['L_EMPTYTABLEBEFORE']="Töm tabellen före";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Radera databasen före"
    ." återställningen";
$lang['L_ENCODING']="Kodering";
$lang['L_ENCRYPTION_TYPE']="Krypteringssätt";
$lang['L_ENGINE']="Engine";
$lang['L_ENTER_DB_INFO']="Klicka först på knappen \"förbind"
    ." med mysql\". Endast om denna"
    ." förbindelse ej fungerar behöver du"
    ." mata in data här.";
$lang['L_ENTRY']="Post";
$lang['L_ERROR']="Fel";
$lang['L_ERRORHANDLING_RESTORE']="Felhantering under återställning";
$lang['L_ERROR_CONFIGFILE_NAME']="Filnamnet \"%s\" innehåller ogiltiga"
    ." tecken.";
$lang['L_ERROR_DELETING_CONFIGFILE']="Fel: konfigureringsfilen %s kunde ej"
    ." raderas!";
$lang['L_ERROR_LOADING_CONFIGFILE']="Konfigureringsfilen \"%s\" kunde ej"
    ." laddas.";
$lang['L_ERROR_LOG']="Fel-logg";
$lang['L_ERROR_MULTIPART_RESTORE']="Multipart-återställning: kunde ej"
    ." hitta filen '%s'!";
$lang['L_ESTIMATED_END']="Uppskattat slut";
$lang['L_EXCEL2003']="Excel från och med 2003";
$lang['L_EXISTS']="Existerar";
$lang['L_EXPORT']="Export";
$lang['L_EXPORTFINISHED']="Exporten avslutad.";
$lang['L_EXPORTLINES']="<strong>%s</strong> rader har"
    ." exporterats";
$lang['L_EXPORTOPTIONS']="Exportoptioner";
$lang['L_EXTENDEDPARS']="Ytterligare parametrar";
$lang['L_FADE_IN_OUT']="visa/dölj";
$lang['L_FATAL_ERROR_DUMP']="Kritiskt fel: CREATE-kommandot i"
    ." tabellen '%s' i databasen '%s' kunde"
    ." ej läsas!";
$lang['L_FIELDS']="Fält";
$lang['L_FIELDS_OF_TABLE']="Fält i tabellen";
$lang['L_FILE']="Fil";
$lang['L_FILES']="Filer";
$lang['L_FILESIZE']="Filstorlek";
$lang['L_FILE_MANAGE']="Administrering";
$lang['L_FILE_OPEN_ERROR']="Fel: filen kunde ej öppnas.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="Filen har sparats.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="Filen kunde ej sparas!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="Filen '%s' har laddats upp.";
$lang['L_FILTER_BY']="Filtra efter";
$lang['L_FM_ALERTRESTORE1']="Ska databasen";
$lang['L_FM_ALERTRESTORE2']="återställas med innehållet i filen";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="alla backuper";
$lang['L_FM_ANZ_BU']="Antal backuper";
$lang['L_FM_ASKDELETE1']="Vill du verkligen radera filen"
    ." (filerna)";
$lang['L_FM_ASKDELETE2']="?";
$lang['L_FM_ASKDELETE3']="Vill du utföra den automatiska"
    ." raderingen enligt de inställda"
    ." reglerna nu?";
$lang['L_FM_ASKDELETE4']="Vill du radera alla backupfiler nu?";
$lang['L_FM_ASKDELETE5']="Vill du radera alla backupfiler med";
$lang['L_FM_ASKDELETE5_2']="* nu?";
$lang['L_FM_AUTODEL1']="Automatisk radering: följande filer"
    ." raderades på grund av maximalt antal"
    ." filer:";
$lang['L_FM_CHOOSE_ENCODING']="Välj backupfilens kodering";
$lang['L_FM_COMMENT']="Mata in en kommentar";
$lang['L_FM_DELETE']="Radera valda filer";
$lang['L_FM_DELETE1']="Filen";
$lang['L_FM_DELETE2']="har raderats.";
$lang['L_FM_DELETE3']="kunde ej raderas!";
$lang['L_FM_DELETEALL']="Radera alla backupfiler";
$lang['L_FM_DELETEALLFILTER']="Radera alla med";
$lang['L_FM_DELETEAUTO']="Genomför automatisk radering manuellt";
$lang['L_FM_DUMPSETTINGS']="Backup-inställningar";
$lang['L_FM_DUMP_HEADER']="Backup";
$lang['L_FM_FILEDATE']="Datum";
$lang['L_FM_FILES1']="Databas-backuper";
$lang['L_FM_FILESIZE']="Filstorlek";
$lang['L_FM_FILEUPLOAD']="Ladda upp fil";
$lang['L_FM_FREESPACE']="Ledigt utrymme på servern";
$lang['L_FM_LAST_BU']="Senaste backup";
$lang['L_FM_NOFILE']="Du har ej valt någon fil!";
$lang['L_FM_NOFILESFOUND']="Ingen fil hittades.";
$lang['L_FM_RECORDS']="Poster";
$lang['L_FM_RESTORE']="Återställning";
$lang['L_FM_RESTORE_HEADER']="Återställning av databasen"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Val av bestämda tabeller";
$lang['L_FM_STARTDUMP']="Starta ny backup";
$lang['L_FM_TABLES']="Tabeller";
$lang['L_FM_TOTALSIZE']="Total storlek";
$lang['L_FM_UPLOADFAILED']="Uppladdningen har tyvärr misslyckats!";
$lang['L_FM_UPLOADFILEEXISTS']="Det existerar redan en fil med samma"
    ." namn!";
$lang['L_FM_UPLOADFILEREQUEST']="Ange en fil.";
$lang['L_FM_UPLOADMOVEERROR']="Den uppladdade filen kunde ej flyttas"
    ." till rätt mapp.";
$lang['L_FM_UPLOADNOTALLOWED1']="Denna filtyp är ej tillåten.";
$lang['L_FM_UPLOADNOTALLOWED2']="Tillåtna filtyper: *.gz och *.sql";
$lang['L_FOUND_DB']="hittad databas:";
$lang['L_FROMFILE']="ur fil";
$lang['L_FROMTEXTBOX']="ur textfält";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Lägg till förbindelse";
$lang['L_FTP_CHOOSE_MODE']="FTP-överföringsläge";
$lang['L_FTP_CONFIRM_DELETE']="Ska denna FTP-förbindelse verkligen"
    ." raderas?";
$lang['L_FTP_CONNECTION']="FTP-förbindelse";
$lang['L_FTP_CONNECTION_CLOSED']="FTP-förbindelsen stängd";
$lang['L_FTP_CONNECTION_DELETE']="Förbindelsen har raderats";
$lang['L_FTP_CONNECTION_ERROR']="Förbindelsen till servern '%s' över"
    ." port %s kunde ej upprättas";
$lang['L_FTP_CONNECTION_SUCCESS']="Förbindelsen till servern '%s' över"
    ." port %s har upprättats";
$lang['L_FTP_DIR']="Uppladdningsmapp";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Överföringen av filen '%s'"
    ." misslyckades";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="Filen '%s' har överförts";
$lang['L_FTP_LOGIN_ERROR']="Inloggning som användare '%s'"
    ." avvisades";
$lang['L_FTP_LOGIN_SUCCESS']="Inloggad som användare '%s'";
$lang['L_FTP_OK']="Förbindelsen kunde skapas.";
$lang['L_FTP_PASS']="Lösenord";
$lang['L_FTP_PASSIVE']="använd passivt läge";
$lang['L_FTP_PASV_ERROR']="Kunde ej byta läge till passivt"
    ." FTP-läge";
$lang['L_FTP_PASV_SUCCESS']="Läge inställt till passivt FTP-läge";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="till <strong>%s</strong><br />i"
    ." <strong>%s</strong>";
$lang['L_FTP_SERVER']="Server";
$lang['L_FTP_SSL']="Säker SSL-FTP-förbindelse";
$lang['L_FTP_START']="Startar FTP-överföring";
$lang['L_FTP_TIMEOUT']="Förbindelse-timeout";
$lang['L_FTP_TRANSFER']="FTP-överföring";
$lang['L_FTP_USER']="Användare";
$lang['L_FTP_USESSL']="använd SSL-förbindelse";
$lang['L_GENERAL']="Allmänt";
$lang['L_GZIP']="GZIP-komprimering";
$lang['L_GZIP_COMPRESSION']="GZIP-komprimering";
$lang['L_HOME']="Hem";
$lang['L_HOUR']="Timme";
$lang['L_HOURS']="Timmar";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Aktivera rewrite";
$lang['L_HTACC_ADD_HANDLER']="Lägg till handler";
$lang['L_HTACC_CONFIRM_DELETE']="Ska mappskyddet skapas nu?";
$lang['L_HTACC_CONTENT']="Filens innehåll";
$lang['L_HTACC_CREATE']="Skapa mappskydd";
$lang['L_HTACC_CREATED']="Mappskyddet har skapats.";
$lang['L_HTACC_CREATE_ERROR']="Ett fel uppträdde när mappskyddet"
    ." skulle skapas!<br />Skapa filerna"
    ." manuellt med följande innehåll";
$lang['L_HTACC_CRYPT']="Crypt (Linux och Unix-system)";
$lang['L_HTACC_DENY_ALLOW']="Deny / Allow";
$lang['L_HTACC_DIR_LISTING']="Mapp-listning";
$lang['L_HTACC_EDIT']="Editera .htaccess-skyddet";
$lang['L_HTACC_ERROR_DOC']="Fel-dokument";
$lang['L_HTACC_EXAMPLES']="ytterligare exempel och dokumentation";
$lang['L_HTACC_EXISTS']="Mappskydd existerar redan. Det gamla"
    ." skrivs över om du skapar ett nytt!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Gör utförbart";
$lang['L_HTACC_MD5']="MD5 (Linux och Unix-system)";
$lang['L_HTACC_NO_ENCRYPTION']="ingen kryptering (Windows)";
$lang['L_HTACC_NO_USERNAME']="Du måste mata in ett namn!";
$lang['L_HTACC_PROPOSED']="Rekommenderas starkt";
$lang['L_HTACC_REDIRECT']="Redirect";
$lang['L_HTACC_SCRIPT_EXEC']="Utför skriptet";
$lang['L_HTACC_SHA1']="SHA1 (alla system)";
$lang['L_HTACC_WARNING']="OBS! .htaccess har direkt inverkan på"
    ." servern.<br />Om .htaccess ställs in"
    ." på fel sätt kan sidan ej nås.";
$lang['L_IMPORT']="Import";
$lang['L_IMPORTIEREN']="importera";
$lang['L_IMPORTOPTIONS']="Importoptioner";
$lang['L_IMPORTSOURCE']="Importkälla";
$lang['L_IMPORTTABLE']="Import till tabellen";
$lang['L_IMPORT_NOTABLE']="Ingen tabell har valts för importen!";
$lang['L_IN']="i";
$lang['L_INDEX_SIZE']="Indexstorlek";
$lang['L_INFO_ACTDB']="Aktuell databas";
$lang['L_INFO_DATABASES']="Följande databas(er) finns på"
    ." MySQL-servern";
$lang['L_INFO_DBEMPTY']="Databasen är tom!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="På denna server har PHP-funktionen"
    ." fsockopen() deaktiverats i serverns"
    ." konfigurering, därför kan"
    ." språkpaketen ej laddas ner"
    ." automatiskt. Du kan dock ladda ner"
    ." önskade paket manuellt, packa upp och"
    ." ladda upp paketen till mappen"
    ." \"language\" med ditt FTP-program."
    ." Därefter kan du välja det nya"
    ." språket.";
$lang['L_INFO_LASTUPDATE']="senaste uppdatering";
$lang['L_INFO_LOCATION']="Du befinner dig på";
$lang['L_INFO_NODB']="Databasen existerar ej";
$lang['L_INFO_NOPROCESSES']="inga aktuella processer";
$lang['L_INFO_NOSTATUS']="ingen status";
$lang['L_INFO_NOVARS']="inga variabler";
$lang['L_INFO_OPTIMIZED']="optimerat";
$lang['L_INFO_RECORDS']="Dataposter";
$lang['L_INFO_SIZE']="Storlek";
$lang['L_INFO_SUM']="Totalt";
$lang['L_INSTALL']="Installation";
$lang['L_INSTALLED']="Installerat";
$lang['L_INSTALL_DB_DEFAULT']="Ställ in som standarddatabas";
$lang['L_INSTALL_HELP_PORT']="(tom = standardport)";
$lang['L_INSTALL_HELP_SOCKET']="(tom = standardsocket)";
$lang['L_IS_WRITABLE']="Är skrivbart";
$lang['L_KILL_PROCESS']="Avsluta processen";
$lang['L_LANGUAGE']="Språk";
$lang['L_LANGUAGE_NAME']="Svenska";
$lang['L_LASTBACKUP']="Senaste backup";
$lang['L_LOAD']="Grundinställningar";
$lang['L_LOAD_DATABASE']="Ladda om databaserna";
$lang['L_LOAD_FILE']="Ladda fil";
$lang['L_LOG']="Logg";
$lang['L_LOGFILENOTWRITABLE']="Loggfil kan ej skrivas!";
$lang['L_LOGFILES']="Loggfiler";
$lang['L_LOGGED_IN']="Inloggad";
$lang['L_LOGIN']="Logga in";
$lang['L_LOGIN_AUTOLOGIN']="Automatisk inloggning";
$lang['L_LOGIN_INVALID_USER']="Denna kombination av användarnamn och"
    ." lösenord är ej giltig.";
$lang['L_LOGOUT']="Logga ut";
$lang['L_LOG_CREATED']="Loggfilen skapad.";
$lang['L_LOG_DELETE']="Radera loggen";
$lang['L_LOG_MAXSIZE']="Loggfilens maximala storlek";
$lang['L_LOG_NOT_READABLE']="Loggfilen '%s' existerar ej eller kan"
    ." ej läsas.";
$lang['L_MAILERROR']="Tyvärr uppträdde ett fel när"
    ." epostmeddelandet skickades!";
$lang['L_MAILPROGRAM']="Epostprogram";
$lang['L_MAXIMUM_LENGTH']="Maximal längd";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="This is the maximum number of bytes"
    ." one character needs, when it is saved"
    ." to disk.";
$lang['L_MAXSIZE']="max. storlek";
$lang['L_MAX_BACKUP_FILES_EACH2']="för varje databas";
$lang['L_MAX_EXECUTION_TIME']="Maximal exekveringstid";
$lang['L_MAX_UPLOAD_SIZE']="Maximal filstorlek";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Om din backup-fil är större än det"
    ." angivna värdet så måste du ladda"
    ." upp den till mappen \"work/backup\""
    ." via FTP. Därefter visas filen här i"
    ." översikten och kan väljas för"
    ." återställning.";
$lang['L_MEMORY']="Minne";
$lang['L_MENU_HIDE']="Dölj menyn";
$lang['L_MENU_SHOW']="Visa menyn";
$lang['L_MESSAGE']="Meddelande";
$lang['L_MESSAGE_TYPE']="Typ av meddelande";
$lang['L_MINUTE']="minut";
$lang['L_MINUTES']="minuter";
$lang['L_MOBILE_OFF']="Av";
$lang['L_MOBILE_ON']="På";
$lang['L_MODE_EASY']="Enkel";
$lang['L_MODE_EXPERT']="Expert";
$lang['L_MSD_INFO']="MySQLDumper-informationer";
$lang['L_MSD_MODE']="MySQLDumper-läge";
$lang['L_MSD_VERSION']="MySQLDumper-version";
$lang['L_MULTIDUMP']="Multidump";
$lang['L_MULTIDUMP_FINISHED']="<b>%d</b> databaser har säkrats";
$lang['L_MULTIPART_ACTUAL_PART']="Aktuell delfil";
$lang['L_MULTIPART_SIZE']="Maximal filstorlek";
$lang['L_MULTI_PART']="Backup uppdelad i flera filer";
$lang['L_MYSQLVARS']="MySQL-variabler";
$lang['L_MYSQL_CLIENT_VERSION']="MySQL-klient";
$lang['L_MYSQL_CONNECTION_ENCODING']="MySQL-serverns standardkodering";
$lang['L_MYSQL_DATA']="MySQL-data";
$lang['L_MYSQL_ROUTINE']="Rutin";
$lang['L_MYSQL_ROUTINES']="Rutiner";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Sparade funktioner och procedurer";
$lang['L_MYSQL_TABLES_EXPLAIN']="Tables have a defined column structure"
    ." in which one can save data (records)."
    ." Each record represents a row in the"
    ." table.";
$lang['L_MYSQL_VERSION']="MySQL-version";
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
$lang['L_MYSQL_VIEWS_EXPLAIN']="Views visar (filtrade) masker av"
    ." dataposterna ur en eller flera"
    ." tabeller. Själva viewerna innehåller"
    ." ingen data.";
$lang['L_NAME']="Namn";
$lang['L_NEW']="ny";
$lang['L_NEWTABLE']="ny tabell";
$lang['L_NEXT_AUTO_INCREMENT']="Nästa automatiska index";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="n. auto-index";
$lang['L_NO']="nej";
$lang['L_NOFTPPOSSIBLE']="Det står inga FTP-funktioner till"
    ." förfogande!";
$lang['L_NOGZPOSSIBLE']="Det står inga GZIP-funktioner till"
    ." förfogande eftersom zlib ej har"
    ." installerats!";
$lang['L_NONE']="inga";
$lang['L_NOREVERSE']="Äldsta posten först";
$lang['L_NOTAVAIL']="<em>existerar ej</em>";
$lang['L_NOTHING_TO_DO']="Det finns inget att göra.";
$lang['L_NOTICE']="Hänvisning";
$lang['L_NOTICES']="Hänvisningar";
$lang['L_NOT_ACTIVATED']="ej aktiverat";
$lang['L_NOT_SUPPORTED']="Denna backup har inget stöd för den"
    ." funktionen.";
$lang['L_NO_DB_FOUND']="Inga databaser hittades. Gå till"
    ." förbindelseparametrarna och ange"
    ." databasens namn.";
$lang['L_NO_DB_FOUND_INFO']="Förbindelsen till databasen kunde"
    ." upprättas.<br />Dina"
    ." inloggningsinformationer är giltiga"
    ." har accepterats av MySQL-servern.<br"
    ." />Tyvärr kunde MySQLDumper inte hitta"
    ." några databaser.<br />Automatisk"
    ." detektering spärras av vissa"
    ." webbhotell.<br />Du måste ange"
    ." databasen efter installationen,"
    ." menypunkt \"Konfigurering\" \"Visa"
    ." förbindelseparametrar\".<br"
    ." />Genomför detta steg omedelbart"
    ." efter installationen.";
$lang['L_NO_DB_SELECTED']="Ingen databas har valts.";
$lang['L_NO_ENTRIES']="Tabellen \"<b>%s</b>\" är tom och har"
    ." inga poster.";
$lang['L_NO_MSD_BACKUPFILE']="Filer skapade med andra program";
$lang['L_NO_NAME_GIVEN']="Du har ej angivit något namn.";
$lang['L_NR_OF_RECORDS']="Antal dataposter";
$lang['L_NR_TABLES_OPTIMIZED']="%s tabeller har optimerats.";
$lang['L_NUMBER_OF_FILES_FORM']="Antal backup-filer per databas";
$lang['L_OF']="av";
$lang['L_OK']="OK";
$lang['L_OPTIMIZE']="Optimera";
$lang['L_OPTIMIZE_TABLES']="Optimera tabellerna före backup";
$lang['L_OPTIMIZE_TABLE_ERR']="Fel under optimering av tabellen `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Tabellen `%s` har uppdaterats.";
$lang['L_OS']="Operativsystem";
$lang['L_OVERHEAD']="Overhead";
$lang['L_PAGE']="Sida";
$lang['L_PAGE_REFRESHS']="sidvisningar";
$lang['L_PASS']="Lösenord";
$lang['L_PASSWORD']="Lösenord";
$lang['L_PASSWORDS_UNEQUAL']="Lösenorden är ej identiska eller"
    ." tomma!";
$lang['L_PASSWORD_REPEAT']="Upprepa lösenord";
$lang['L_PASSWORD_STRENGTH']="Lösenordets säkerhet";
$lang['L_PERLOUTPUT1']="Angivelse i crondump.pl för"
    ." absolute_path_of_configd";
$lang['L_PERLOUTPUT2']="Browseradress eller adress för extern"
    ." crontab";
$lang['L_PERLOUTPUT3']="Shelladress eller adress för crontab";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-logg";
$lang['L_PERL_LOG']="Perl-logg";
$lang['L_PHPBUG']="Bugg i zlib! Komprimering kan ej"
    ." utföras!";
$lang['L_PHPMAIL']="PHP-funktion mail()";
$lang['L_PHP_EXTENSIONS']="PHP-extensioner";
$lang['L_PHP_LOG']="PHP-logg";
$lang['L_PHP_VERSION']="PHP-version";
$lang['L_PHP_VERSION_TOO_OLD']="We are sorry: the installed"
    ." PHP-Version is too old. MySQLDumper"
    ." needs a PHP-Version of %s or higher."
    ." This server has a PHP-Version of %s"
    ." which is too old. You need to update"
    ." your PHP-Version before you can"
    ." install and use MySQLDumper.";
$lang['L_POP3_PORT']="POP3-port";
$lang['L_POP3_SERVER']="POP3-server";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="nere i mitten";
$lang['L_POSITION_BL']="nere till vänster";
$lang['L_POSITION_BR']="nere till höger";
$lang['L_POSITION_MC']="i mitten";
$lang['L_POSITION_ML']="i mitten till vänster";
$lang['L_POSITION_MR']="i mitten till höger";
$lang['L_POSITION_NOTIFICATIONS']="Meddelanderutans position";
$lang['L_POSITION_TC']="uppe i mitten";
$lang['L_POSITION_TL']="uppe till vänster";
$lang['L_POSITION_TR']="uppe till höger";
$lang['L_POSSIBLE_COLLATIONS']="Möjliga sorteringar";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="These are the possible collations one"
    ." can choose for this character"
    ." set.

_cs = case sensitiv
_ci = case"
    ." insensitive";
$lang['L_PREFIX']="Prefix";
$lang['L_PRIMARYKEYS_CHANGED']="Den primära nyckeln har ändrats";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Ett fel uppträdde när den primära"
    ." nyckeln skulle ändras";
$lang['L_PRIMARYKEYS_SAVE']="Spara primärnycklar";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Vill du verkligen radera"
    ." primärnyckeln?";
$lang['L_PRIMARYKEY_DELETED']="Den primära nyckeln har raderats";
$lang['L_PRIMARYKEY_FIELD']="Nyckelfält";
$lang['L_PRIMARYKEY_NOTFOUND']="Den primära nyckeln kunde ej hittas";
$lang['L_PROCESSKILL1']="Försöker avsluta process";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="Sedan";
$lang['L_PROCESSKILL4']="sekund(er) försöks avsluta process";
$lang['L_PROCESS_ID']="Process-ID";
$lang['L_PROGRESS_FILE']="Framsteg fil";
$lang['L_PROGRESS_OVER_ALL']="Genomfört totalt";
$lang['L_PROGRESS_TABLE']="Genomfört av tabell";
$lang['L_PROVIDER']="Provider";
$lang['L_PROZESSE']="Processer";
$lang['L_QUERY']="Query";
$lang['L_RECHTE']="Rättigheter";
$lang['L_RECORDS']="Dataposter";
$lang['L_RECORDS_INSERTED']="<b>%s</b> dataposter har överförts.";
$lang['L_RECORDS_OF_TABLE']="Dataposter i tabellen";
$lang['L_RECORDS_PER_PAGECALL']="Dataposter per sidoladdning";
$lang['L_REFRESHTIME']="Aktualiseringsintervall";
$lang['L_REFRESHTIME_PROCESSLIST']="Processlistans aktualiseringsintervall";
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
$lang['L_RELOAD']="Ladda om";
$lang['L_REMOVE']="Avlägsna";
$lang['L_REPAIR']="Reparera";
$lang['L_RESET']="Återställa";
$lang['L_RESET_SEARCHWORDS']="Återställ inmatningen";
$lang['L_RESTORE']="Återställning";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> tabeller har skapats.";
$lang['L_RESTORE_DB']="Databas '<b>%s</b>' på server"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Återställning av databasen '%s'"
    ." avslutad i %s.";
$lang['L_RESTORE_OF_TABLES']="Återställning av bestämda tabeller";
$lang['L_RESTORE_TABLE']="Återställning av tabellen '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Hittills har <b>%d</b> av <b>%d</b>"
    ." tabeller skapats.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Hittills har <b>%d</b> av <b>%d</b>"
    ." tabeller skapats.";
$lang['L_REVERSE']="Nyaste posten först";
$lang['L_SAFEMODEDESC']="Eftersom PHP utförs med optionen"
    ." \"safe_mode=on\" på denna server"
    ." måste följande mappar skapas"
    ." manuellt med ett FTP-program:";
$lang['L_SAVE']="Spara";
$lang['L_SAVEANDCONTINUE']="spara och fortsätt installationen";
$lang['L_SAVE_ERROR']="Inställningarna kunde ej sparas!";
$lang['L_SAVE_SUCCESS']="Inställningarna har sparats i"
    ." konfigureringsfilen \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Sparar data ur databasen '%s' i filen"
    ." '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximal filstorlek uppnådd:"
    ." fortsätter med filen '%s'";
$lang['L_SAVING_DB_FORM']="Databas";
$lang['L_SAVING_TABLE']="Sparar tabellen";
$lang['L_SEARCH_ACCESS_KEYS']="Bläddra: framåt=ALT+V,"
    ." tillbaka=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Sök i tabell";
$lang['L_SEARCH_NO_RESULTS']="Sökningen på \"<b>%s</b>\" i"
    ." tabellen \"<b>%s</b>\" gav inga"
    ." träffar!";
$lang['L_SEARCH_OPTIONS']="Sökinställningar";
$lang['L_SEARCH_OPTIONS_AND']="en kolumn måste innehålla alla"
    ." sökord (OCH-sökning)";
$lang['L_SEARCH_OPTIONS_CONCAT']="en datapost måste innehålla alla"
    ." sökord, dessa kan dock befinna sig i"
    ." olika kolumner (stor"
    ." serverbelastning!)";
$lang['L_SEARCH_OPTIONS_OR']="en kolumn måste innehålla minst ett"
    ." sökord (ELLER-sökning)";
$lang['L_SEARCH_RESULTS']="Sökningen på \"<b>%s</b>\" i"
    ." tabellen \"<b>%s</b>\" gav följande"
    ." resultat";
$lang['L_SECOND']="Sekund";
$lang['L_SECONDS']="sekunder";
$lang['L_SELECT']="Välj";
$lang['L_SELECTED_FILE']="Vald fil";
$lang['L_SELECT_ALL']="markera alla";
$lang['L_SELECT_FILE']="Välj fil";
$lang['L_SELECT_LANGUAGE']="Välj språk";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Skicka resultatet som fil";
$lang['L_SEND_MAIL_FORM']="Skicka epost";
$lang['L_SERVER']="Server";
$lang['L_SERVERCAPTION']="Visning av server";
$lang['L_SETPRIMARYKEYSFOR']="Sätt nya primärnycklar för tabellen";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Visa post %s till %s av %s";
$lang['L_SHOWRESULT']="Visa resultatet";
$lang['L_SHOW_TABLES']="Visa tabellerna";
$lang['L_SHOW_TOOLTIPS']="Visa finare tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-server";
$lang['L_SMTP_PORT']="SMTP-port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Hastighet";
$lang['L_SQLBOX']="SQL-box";
$lang['L_SQLBOXHEIGHT']="SQL-fältets höjd";
$lang['L_SQLLIB_ACTIVATEBOARD']="Aktivera forumet";
$lang['L_SQLLIB_BOARDS']="Forum";
$lang['L_SQLLIB_DEACTIVATEBOARD']="Deaktivera forumet";
$lang['L_SQLLIB_GENERALFUNCTIONS']="allmäna funktioner";
$lang['L_SQLLIB_RESETAUTO']="återställ auto-värde";
$lang['L_SQLLIMIT']="Antal datasatser per sida";
$lang['L_SQL_ACTIONS']="Aktioner";
$lang['L_SQL_AFTER']="efter";
$lang['L_SQL_ALLOWDUPS']="Tillåt duplikat";
$lang['L_SQL_ATPOSITION']="infoga vid position";
$lang['L_SQL_ATTRIBUTES']="Attribut";
$lang['L_SQL_BACKDBOVERVIEW']="tillbaka till databas-översikten";
$lang['L_SQL_BEFEHLNEU']="nytt kommando";
$lang['L_SQL_BEFEHLSAVED1']="SQL-kommando";
$lang['L_SQL_BEFEHLSAVED2']="har lagts till";
$lang['L_SQL_BEFEHLSAVED3']="har sparats";
$lang['L_SQL_BEFEHLSAVED4']="har flyttats upp";
$lang['L_SQL_BEFEHLSAVED5']="har raderats";
$lang['L_SQL_BROWSER']="SQL-läsare";
$lang['L_SQL_CARDINALITY']="Kardinalitet";
$lang['L_SQL_CHANGED']="har ändrats.";
$lang['L_SQL_CHANGEFIELD']="ändra fält";
$lang['L_SQL_CHOOSEACTION']="Välj aktion";
$lang['L_SQL_COLLATENOTMATCH']="Teckensats och sortering passar ej"
    ." ihop!";
$lang['L_SQL_COLUMNS']="Kolumner";
$lang['L_SQL_COMMANDS']="SQL-kommandon";
$lang['L_SQL_COMMANDS_IN']="rader bearbetade i";
$lang['L_SQL_COMMANDS_IN2']="sekund(er).";
$lang['L_SQL_COPYDATADB']="Kopiera hela databasen till";
$lang['L_SQL_COPYSDB']="Kopiera databasens struktur";
$lang['L_SQL_COPYTABLE']="Kopiera tabellen";
$lang['L_SQL_CREATED']="har skapats.";
$lang['L_SQL_CREATEINDEX']="skapa nytt index";
$lang['L_SQL_CREATETABLE']="skapa tabell";
$lang['L_SQL_DATAVIEW']="Datavy";
$lang['L_SQL_DBCOPY']="Innehållet i databas `%s` har"
    ." kopierats till databas `%s`.";
$lang['L_SQL_DBSCOPY']="Strukturen i databas `%s` har"
    ." kopierats till databas `%s`.";
$lang['L_SQL_DELETED']="har raderats.";
$lang['L_SQL_DESTTABLE_EXISTS']="Måltabellen existerar redan!";
$lang['L_SQL_EDIT']="bearbeta";
$lang['L_SQL_EDITFIELD']="Bearbeta fält";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Bearbeta tabellens struktur";
$lang['L_SQL_EMPTYDB']="Töm databasen";
$lang['L_SQL_ERROR1']="Fel i förfrågningen:";
$lang['L_SQL_ERROR2']="MySQL svarar:";
$lang['L_SQL_EXEC']="Utför SQL-kommandot";
$lang['L_SQL_EXPORT']="Export ur databasen `%s`";
$lang['L_SQL_FIELDDELETE1']="Fältet";
$lang['L_SQL_FIELDNAMENOTVALID']="Fel: fältnamnet ej giltigt";
$lang['L_SQL_FIRST']="först";
$lang['L_SQL_IMEXPORT']="Import/export";
$lang['L_SQL_IMPORT']="Import till databasen `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: incomplete statement"
    ." detected.
Couldn't find closing match"
    ." for '%s' in query:
%s";
$lang['L_SQL_INDEXES']="Index";
$lang['L_SQL_INSERTFIELD']="infoga fält";
$lang['L_SQL_INSERTNEWFIELD']="infoga nytt fält";
$lang['L_SQL_LIBRARY']="SQL-bibliotek";
$lang['L_SQL_NAMEDEST_MISSING']="Namn saknas för måldatabasen!";
$lang['L_SQL_NEWFIELD']="Nytt fält";
$lang['L_SQL_NODATA']="inga dataposter";
$lang['L_SQL_NODEST_COPY']="Utan mål kan kopiering ej utföras!";
$lang['L_SQL_NOFIELDDELETE']="Radering ej möjlig eftersom en tabell"
    ." måste innehålla minst ett fält.";
$lang['L_SQL_NOTABLESINDB']="Det finns inga tabeller i databasen";
$lang['L_SQL_NOTABLESSELECTED']="Inga tabeller har valts!";
$lang['L_SQL_OPENFILE']="Öppna SQL-fil";
$lang['L_SQL_OPENFILE_BUTTON']="Ladda upp";
$lang['L_SQL_OUT1']="Det har utförts";
$lang['L_SQL_OUT2']="kommandon";
$lang['L_SQL_OUT3']="Det fanns";
$lang['L_SQL_OUT4']="kommantarer";
$lang['L_SQL_OUT5']="Eftersom resultatet har över 5000"
    ." rader visas det ej här.";
$lang['L_SQL_OUTPUT']="SQL-resultat";
$lang['L_SQL_QUERYENTRY']="Frågan innehåller";
$lang['L_SQL_RECORDDELETED']="Dataposten har raderats";
$lang['L_SQL_RECORDEDIT']="ändra dataposten";
$lang['L_SQL_RECORDINSERTED']="Dataposten har sparats";
$lang['L_SQL_RECORDNEW']="infoga datapost";
$lang['L_SQL_RECORDUPDATED']="Dataposten har ändrats";
$lang['L_SQL_RENAMEDB']="Ombenämn databas";
$lang['L_SQL_RENAMEDTO']="har ombenämnts till";
$lang['L_SQL_SCOPY']="Tabellenstrukturen i `%s` har"
    ." kopierats till tabellen `%s`.";
$lang['L_SQL_SEARCH']="Sökning";
$lang['L_SQL_SEARCHWORDS']="Sökord";
$lang['L_SQL_SELECTTABLE']="välj tabell";
$lang['L_SQL_SERVER']="SQL-server";
$lang['L_SQL_SHOWDATATABLE']="Visa datan i tabellen";
$lang['L_SQL_STRUCTUREDATA']="Struktur och data";
$lang['L_SQL_STRUCTUREONLY']="endast struktur";
$lang['L_SQL_TABLEEMPTIED']="Tabellen `%s` har tömts.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="Tabellen `%s` har tömts och index har"
    ." återställts.";
$lang['L_SQL_TABLEINDEXES']="Index i tabellen";
$lang['L_SQL_TABLENEW']="Bearbeta tabeller";
$lang['L_SQL_TABLENOINDEXES']="Tabellen innehåller inga index";
$lang['L_SQL_TABLENONAME']="Tabellen måste ha ett namn!";
$lang['L_SQL_TABLESOFDB']="Tabeller i databasen";
$lang['L_SQL_TABLEVIEW']="Tabellvy";
$lang['L_SQL_TBLNAMEEMPTY']="Tabellens namn får ej vara tomt!";
$lang['L_SQL_TBLPROPSOF']="Tabellegenskaper för";
$lang['L_SQL_TCOPY']="Tabell `%s` kopierades med datan till"
    ." tabell `%s`.";
$lang['L_SQL_UPLOADEDFILE']="laddad fil:";
$lang['L_SQL_VIEW_COMPACT']="Visning: kompakt";
$lang['L_SQL_VIEW_STANDARD']="Visning: normal";
$lang['L_SQL_VONINS']="av totalt";
$lang['L_SQL_WARNING']="Utförs SQL-kommandon kan detta"
    ." förändra data! Autorn ansvarar ej"
    ." för förlust av data.";
$lang['L_SQL_WASCREATED']="har skapats";
$lang['L_SQL_WASEMPTIED']="har tömts";
$lang['L_STARTDUMP']="Starta backup";
$lang['L_START_RESTORE_DB_FILE']="Påbörjar återställningen av"
    ." databasen '%s' ur filen '%s'.";
$lang['L_START_SQL_SEARCH']="Starta sökningen";
$lang['L_STATUS']="Status";
$lang['L_STEP']="Steg";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="Konfigureringsfilen \"%s\" har"
    ." skapats.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="Konfigureringsfilen \"%s\" har"
    ." raderats.";
$lang['L_TABLE']="Tabell";
$lang['L_TABLENAME']="Tabellnamn";
$lang['L_TABLENAME_EXPLAIN']="Tabellnamn";
$lang['L_TABLES']="Tabeller";
$lang['L_TABLESELECTION']="Välj tabeller";
$lang['L_TABLE_CREATE_SUCC']="Tabellen '%s' har skapats.";
$lang['L_TABLE_TYPE']="Typ";
$lang['L_TESTCONNECTION']="Testa förbindelsen";
$lang['L_THEME']="Stil";
$lang['L_TIME']="Tid";
$lang['L_TIMESTAMP']="Tidstämpel";
$lang['L_TITLE_INDEX']="Index";
$lang['L_TITLE_KEY_FULLTEXT']="Fulltextnyckel";
$lang['L_TITLE_KEY_PRIMARY']="Primär nyckel";
$lang['L_TITLE_KEY_UNIQUE']="Unik nyckel";
$lang['L_TITLE_MYSQL_HELP']="MySQL dokumentation";
$lang['L_TITLE_NOKEY']="Ingen nyckel";
$lang['L_TITLE_SEARCH']="Sök";
$lang['L_TITLE_SHOW_DATA']="Visa data";
$lang['L_TITLE_UPLOAD']="Ladda upp SQL-fil";
$lang['L_TO']="till";
$lang['L_TOOLS']="Verktyg";
$lang['L_TOOLS_TOOLBOX']="Välj databas / Databasfunktioner /"
    ." Import/Export";
$lang['L_TRUNCATE']="Töm";
$lang['L_TRUNCATE_DATABASE']="Töm databasen";
$lang['L_UNIT_KB']="Kilobyte";
$lang['L_UNIT_MB']="Megabyte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="okänd";
$lang['L_UNKNOWN_SQLCOMMAND']="Okänt SQL-kommando:";
$lang['L_UPDATE']="Aktualisera";
$lang['L_UPDATE_CONNECTION_FAILED']="Aktualiseringen kunde ej utföras"
    ." eftersom ingen förbindelse kunde"
    ." etableras till server '%s'.";
$lang['L_UPDATE_ERROR_RESPONSE']="Aktualiseringen kunde ej utföras,"
    ." servern svarade med: '%s'";
$lang['L_UPTO']="upp till";
$lang['L_USERNAME']="Användarnamn";
$lang['L_USE_SSL']="Använd SSL";
$lang['L_VALUE']="Innehåll";
$lang['L_VERSIONSINFORMATIONEN']="Versionsinformationer";
$lang['L_VIEW']="visa";
$lang['L_VISIT_HOMEPAGE']="Besök hemsidan";
$lang['L_VOM']="den";
$lang['L_WITH']="med";
$lang['L_WITHATTACH']="med bilaga";
$lang['L_WITHOUTATTACH']="utan bilaga";
$lang['L_WITHPRAEFIX']="med prefix";
$lang['L_WRONGCONNECTIONPARS']="Fel eller inga"
    ." förbindelse-parametrar!";
$lang['L_WRONG_CONNECTIONPARS']="Fel förbindelseparametrar!";
$lang['L_WRONG_RIGHTS']="Filen eller mappen '%s' kan ej skrivas"
    ." till.<br />Antingen har den fel ägare"
    ." (Owner) eller fel behörigheter"
    ." (Chmod).<br />Ställ in rätt attribut"
    ." med ett FTP-program. <br />Filen eller"
    ." mappen måste ha %s.<br />";
$lang['L_YES']="ja";
$lang['L_ZEND_FRAMEWORK_VERSION']="Zend Framework version";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="Det angivna filnamnet '%value%' är"
    ." inget arkivnamn.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="Det angivna filnamnet '%value%' är"
    ." ingen fil.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="Det angivna målet '%value%' är ingen"
    ." länk.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="Den angivna filen eller arkivet"
    ." '%value%' är ej exekverbart.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="Filen elelr arkivet '%value%'"
    ." existerar ej.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="Filen eller arkivet '%value%' är ej"
    ." läsbar.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="Den angivna filen '%value%' har ej"
    ." laddats upp.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="Filen eller arkivet '%value%' är ej"
    ." skrivbart.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Ogilitig typ överförs. Förväntar"
    ." String, Integer eller Float.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="Tomt värde.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="Epostadressen kan ej kontrolleras mot"
    ." \"Dot-Atom\"-formatet.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Ogiltig typ överförd. Förväntar"
    ." String.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="Epostadressens format är ogiltigt.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="Domännamnet är ogiltigt.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="Epostadressens lokala del"
    ." (<lokal-del>@<domän>.<TLD>) är"
    ." ogiltig.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="Epostadressen har inget giltigt"
    ." MX-register.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="Domänen befinner sig ej inom ett"
    ." routbart nätverkssegment."
    ." Epostadressen kan ej adresseras av det"
    ." offentliga nätverket.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="Epostadressen är för lång. Den får"
    ." innehålla maximalt 320 tecken.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="Epostadressen kan ej kontrolleras mot"
    ." \"Quoted-String\"-formatet.";
$lang['L_ZEND_ID_IS_EMPTY']="Värdet är erforderligt och får ej"
    ." vara tomt.";
$lang['L_ZEND_ID_MISSING_TOKEN']="Inget kriterium för kontroll angavs.";
$lang['L_ZEND_ID_NOT_DIGITS']="Ange endast siffror.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Värdets typ är ogiltig. String,"
    ." Integer, Float, Boolean eller Array"
    ." förväntas.";
$lang['L_ZEND_ID_NOT_SAME']="De bägge kriterierna stämmer ej"
    ." överens.";
return $lang;
