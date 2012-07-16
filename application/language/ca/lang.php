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
$lang['L_ACTION']="Acció";
$lang['L_ACTIVATED']="actiu";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Fins ara, s'han afegit amb èxit"
    ." <b>%s</b> registres.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Fins ara s'han afegit amb èxit"
    ." <b>%s</b> de <b>%s</b> registres.";
$lang['L_ADD']="Afegir";
$lang['L_ADDED']="afegit";
$lang['L_ADD_DB_MANUALLY']="Afegir base de dades manualment";
$lang['L_ADD_RECIPIENT']="Afegir destinatari";
$lang['L_ALL']="tots";
$lang['L_ANALYZE']="Analitzar";
$lang['L_ANALYZING_TABLE']="Ara s'estàn analitzant les dades de"
    ." la taula '<b>%s</b>'.";
$lang['L_ASKDBCOPY']="¿Vol copiar el contingut de la base"
    ." de dades `%s` a la base de dades `%s`?";
$lang['L_ASKDBDELETE']="¿Realment vol eliminar la base de"
    ." dades `%s` i tot el seu contingut?";
$lang['L_ASKDBEMPTY']="Realment vol buidar la base de dades"
    ." `%s`?";
$lang['L_ASKDELETEFIELD']="Realment vol eliminar el camp?";
$lang['L_ASKDELETERECORD']="Realment vol eliminar aquest registre?";
$lang['L_ASKDELETETABLE']="Hauria de ser eliminada la taula `%s`?";
$lang['L_ASKTABLEEMPTY']="Hauria de ser buidada la taula `%s`?";
$lang['L_ASKTABLEEMPTYKEYS']="Hauria de ser buidada la taula `%s` i"
    ." resetejats els seus índexs?";
$lang['L_ATTACHED_AS_FILE']="adjunt com a arxiu";
$lang['L_ATTACH_BACKUP']="Adjuntar còpia de seguretat";
$lang['L_AUTHENTICATE']="Informació d'accés";
$lang['L_AUTHORIZE']="Autoritzar";
$lang['L_AUTODELETE']="Eliminació automàtica de les còpies"
    ." de seguretat";
$lang['L_BACK']="enrere";
$lang['L_BACKUPFILESANZAHL']="Al directori de còpies de seguretat"
    ." trobem";
$lang['L_BACKUPS']="Còpies de seguretat";
$lang['L_BACKUP_DBS']="BB.DD. a copiar";
$lang['L_BACKUP_TABLE_DONE']="Completat el volcat de la taula `%s`."
    ." S'han guardat %s registres.";
$lang['L_BACK_TO_OVERVIEW']="Informació general de la base de"
    ." dades";
$lang['L_CALL']="Trucar";
$lang['L_CANCEL']="Cancelar";
$lang['L_CANT_CREATE_DIR']="No s'ha pogut crear el directori"
    ." '%s'.<br />Crei aquest directori"
    ." manualment utilitzant un programa de"
    ." FTP.";
$lang['L_CHANGE']="Canviar";
$lang['L_CHANGEDIR']="Canviant al directori";
$lang['L_CHANGEDIRERROR']="No s'ha pogut canviar de directori!";
$lang['L_CHARSET']="Joc de caràcters";
$lang['L_CHARSETS']="Joc de caràcters";
$lang['L_CHECK']="Comprovar";
$lang['L_CHECK_DIRS']="Comprovar els meus directoris";
$lang['L_CHOOSE_CHARSET']="MySQLDumper no ha pogut detectar la"
    ." codificació de l'arxiu de la còpia"
    ." de seguretat de forma automàtica.<br"
    ." /> Vosté ha d'escollir el joc de"
    ." caràcters amb el que es va guardar la"
    ." còpia de seguretat.<br />Si després"
    ." de la restauració descubreix cap"
    ." problema amb alguns caràcters, pot"
    ." repetir la restauració amb un altre"
    ." joc de caràcters.<br />Bona sort. ;)";
$lang['L_CHOOSE_DB']="Escollir base de dades";
$lang['L_CLEAR_DATABASE']="Buidar la base de dades";
$lang['L_CLOSE']="Tancar";
$lang['L_COLLATION']="Ordenació";
$lang['L_COMMAND']="Comanda";
$lang['L_COMMAND_AFTER_BACKUP']="Comanda després de la còpia";
$lang['L_COMMAND_BEFORE_BACKUP']="Comanda abans de la còpia";
$lang['L_COMMENT']="Comentari";
$lang['L_COMPRESSED']="comprimit (gz)";
$lang['L_CONFBASIC']="Propietats bàsiques";
$lang['L_CONFIG']="Configuració";
$lang['L_CONFIGFILE']="Arxiu de configuració";
$lang['L_CONFIGFILES']="Arxius de configuració";
$lang['L_CONFIGURATIONS']="Configuracions";
$lang['L_CONFIG_AUTODELETE']="Eliminació automàtica";
$lang['L_CONFIG_CRONPERL']="Configuració del volcat programat"
    ." (crondump) per l'script de Perl";
$lang['L_CONFIG_EMAIL']="Notificació per correu electrònic";
$lang['L_CONFIG_FTP']="Transferència per FTP de les còpies"
    ." de seguretat";
$lang['L_CONFIG_HEADLINE']="Configuració";
$lang['L_CONFIG_INTERFACE']="Interfície";
$lang['L_CONFIG_LOADED']="La configuració \"%s\" s'ha importat"
    ." amb èxit.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Està segur de que vol esborrar"
    ." l'arxiu de configuració %s?";
$lang['L_CONFIRM_DELETE_FILE']="Realment vol que el fitxer '%s'"
    ." seleccionat sigui eliminat?";
$lang['L_CONFIRM_DELETE_TABLES']="Realment vol eliminar les taules"
    ." seleccionades?";
$lang['L_CONFIRM_DROP_DATABASES']="Realment vol eliminar les bases de"
    ." dades seleccionades?<br />Nota: Totes"
    ." les dades es perderan sense"
    ." possibilitat de recuperació! Si us"
    ." plau, faci primer una còpia de"
    ." seguretat de les dades.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Realment vol eliminar el destinatari"
    ." \"%s\"?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Realment vol eliminar totes les taules"
    ." de les bases de dades"
    ." seleccionades?<br />Nota: totes les"
    ." dades es perdran sense posibilitat de"
    ." recuperació! Potser vulgui fer primer"
    ." una còpia de seguretat.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Realment vol buidar les taules"
    ." seleccionades?";
$lang['L_CONNECT']="conectar";
$lang['L_CONNECTIONPARS']="Paràmetres de conexió";
$lang['L_CONNECTTOMYSQL']="Conectar amb MySQL";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continuar amb la restauració per"
    ." parts amb el següent arxiu '%s'.";
$lang['L_CONVERTED_FILES']="Arxius convertits";
$lang['L_CONVERTER']="Conversor de còpies de seguretat";
$lang['L_CONVERTING']="Convertint";
$lang['L_CONVERT_FILE']="Arxiu que es convertirà";
$lang['L_CONVERT_FILENAME']="Nom de l'arxiu de destí (sense"
    ." extensió)";
$lang['L_CONVERT_FILEREAD']="Llegint l'arxiu '%s'";
$lang['L_CONVERT_FINISHED']="Conversió finalitzada: '%s' s'ha"
    ." guardat correctament.";
$lang['L_CONVERT_START']="Començar la conversió";
$lang['L_CONVERT_TITLE']="Convertir la còpia de seguretat al"
    ." format MSD";
$lang['L_CONVERT_WRONG_PARAMETERS']="Paràmetres incorrectes! No és"
    ." possible la conversió.";
$lang['L_CREATE']="Crear";
$lang['L_CREATED']="Creat";
$lang['L_CREATEDIRS']="Crear directoris";
$lang['L_CREATE_AUTOINDEX']="Crear índex automàtic";
$lang['L_CREATE_CONFIGFILE']="Crear un nou arxiu de configuració";
$lang['L_CREATE_DATABASE']="Crear una nova base de dades";
$lang['L_CREATE_TABLE_SAVED']="Definició de la taula '%s' guardada.";
$lang['L_CREDITS']="Crèdits / Ajuda";
$lang['L_CRONSCRIPT']="Script Cron";
$lang['L_CRON_COMMENT']="Escrigui un comentari";
$lang['L_CRON_COMPLETELOG']="Registrar totes les operacions";
$lang['L_CRON_EXECPATH']="Ruta dels scripts de Perl";
$lang['L_CRON_EXTENDER']="Extensió de nom d'arxiu";
$lang['L_CRON_PRINTOUT']="Sortida de texte";
$lang['L_CSVOPTIONS']="Opcions CSV";
$lang['L_CSV_EOL']="separar línies amb";
$lang['L_CSV_ERRORCREATETABLE']="Error al crear la taula `%s`!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="El nombre de camps no coincideix amb"
    ." el de les dades a importar (%d en lloc"
    ." de %d).";
$lang['L_CSV_FIELDSENCLOSED']="Camps delimitats per";
$lang['L_CSV_FIELDSEPERATE']="Camps separats amb";
$lang['L_CSV_FIELDSESCAPE']="Camps 'escapats' amb";
$lang['L_CSV_FIELDSLINES']="%d camps reconeguts, un total de %d"
    ." línies";
$lang['L_CSV_FILEOPEN']="Obrir arxiu CSV";
$lang['L_CSV_NAMEFIRSTLINE']="Noms de camps a la primera línia";
$lang['L_CSV_NODATA']="No s'han trobat registres per a"
    ." importar!";
$lang['L_CSV_NULL']="Reemplaçar NULL amb";
$lang['L_DATABASES_OF_USER']="Bases de dades de l'usuari";
$lang['L_DATABASE_CREATED_FAILED']="No s'ha creat la base de dades.<br"
    ." />MySQL ha retornat:<br /><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="La base de dades '%s' s'ha creat amb"
    ." èxit.";
$lang['L_DATASIZE']="Tamany de les dades";
$lang['L_DATASIZE_INFO']="Aquest és el tamany de les dades que"
    ." conté la base de dades, no de l'arxiu"
    ." de la còpia de seguretat.";
$lang['L_DAY']="Dia";
$lang['L_DAYS']="Dies";
$lang['L_DB']="Base de dades";
$lang['L_DBCONNECTION']="Conexió amb la base de dades";
$lang['L_DBPARAMETER']="Paràmetres de la base de dades";
$lang['L_DBS']="Bases de dades";
$lang['L_DB_ADAPTER']="Adaptador de BBDD";
$lang['L_DB_BACKUPPARS']="Paràmetres de la còpia de seguretat"
    ." de la base de dades";
$lang['L_DB_DEFAULT']="Base de dades per defecte";
$lang['L_DB_HOST']="Servidor (hostname)";
$lang['L_DB_IN_LIST']="La base de dades '%s' no s'ha pogut"
    ." afegir perqué ja existeix.";
$lang['L_DB_NAME']="Nom de la base de dades";
$lang['L_DB_PASS']="Contrasenya";
$lang['L_DB_SELECT_ERROR']="<br />Error:<br /> la selecció de la"
    ." base de dades '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' ha fallat!";
$lang['L_DB_USER']="Usuari";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Joc de caràcters per defecte";
$lang['L_DEFAULT_CHARSET']="Joc de caràcters per defecte";
$lang['L_DEFAULT_COLLATION_NAME']="Ordre per defecte";
$lang['L_DELETE']="Eliminar";
$lang['L_DELETE_DATABASE']="Eliminar la base de dades";
$lang['L_DELETE_FILE_ERROR']="Ha succeït un error al provar"
    ." d'esborrar l'arxiu \"%s\"!";
$lang['L_DELETE_FILE_SUCCESS']="L'arxiu \"%s\" s'ha eliminat amb"
    ." èxit.";
$lang['L_DELETE_HTACCESS']="Tregui la protecció del directori"
    ." (esborri .htaccess)";
$lang['L_DESCRIPTION']="Descripció";
$lang['L_DESELECT_ALL']="Deseleccionar totes";
$lang['L_DIR']="Directori";
$lang['L_DISABLEDFUNCTIONS']="Funcions deshabilitades";
$lang['L_DO']="Executa";
$lang['L_DOCRONBUTTON']="Executar l'script Cron de Perl";
$lang['L_DONE']="Fet!";
$lang['L_DONT_ATTACH_BACKUP']="No adjuntar la còpia de seguretat";
$lang['L_DOPERLTEST']="Provar mòduls Perl";
$lang['L_DOSIMPLETEST']="Provar Perl";
$lang['L_DOWNLOAD_FILE']="Descarregar arxiu";
$lang['L_DO_NOW']="executar ara";
$lang['L_DUMP']="Còpia de seguretat";
$lang['L_DUMP_ENDERGEBNIS']="L'arxiu conté <b>%s</b> taules amb"
    ." <b>%s</b> registres.<br />";
$lang['L_DUMP_FILENAME']="Arxiu de la còpia de seguretat";
$lang['L_DUMP_HEADLINE']="Creant la còpia de seguretat...";
$lang['L_DUMP_NOTABLES']="No s'han trobat taules a la base de"
    ." dades `%s`";
$lang['L_DUMP_OF_DB_FINISHED']="Volcat de la base de dades `%s` fet";
$lang['L_DURATION']="Durada";
$lang['L_EDIT']="editar";
$lang['L_EHRESTORE_CONTINUE']="continuar i registrar els errors";
$lang['L_EHRESTORE_STOP']="stop";
$lang['L_EMAIL']="Adreça d'email";
$lang['L_EMAILBODY_ATTACH']="El fitxer adjunt conté la còpia de"
    ." seguretat de la seva base de dades"
    ." MySQL.<br />Còpia de seguretat de la"
    ." base de dades `%s`<br /><br /><br />Se"
    ." ha creat el següent arxiu:<br /><br"
    ." />%s <br /><br /><br />Salutacions"
    ." de<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Salutacions de<br"
    ." /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="S'ha fet una còpia de seguretat per"
    ." parts.<br />Els arxius d'aquesta"
    ." còpia s'adjunten en emails"
    ." separats!<br />Còpia de seguretat de"
    ." la base de dades `%s`<br /><br /><br"
    ." />S'han creat aquests arxius:<br /><br"
    ." />%s <br /><br /><br />Salutacions"
    ." de<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="S'ha fet una còpia de seguretat per"
    ." parts.<br />Els arxius no s'han"
    ." adjuntat en aquest email!<br />Còpia"
    ." de seguretat de la base de dades"
    ." `%s`<br /><br /><br />Han estat creats"
    ." aquests arxius:<br /><br />%s<br /><br"
    ." /><br /><br />Salutacions de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="No s'ha adjuntat l'arxiu de la còpia"
    ." de seguretat en aquest email!<br"
    ." />Còpia de seguretat de la base de"
    ." dades `%s`<br /><br />S'ha creat"
    ." aquest arxiu:<br /><br />%s <br /><br"
    ." /><br />Salutacions de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="La còpia de seguretat ha sobrepasat"
    ." el tamany màxim de %s i per tant no"
    ." ha estat adjuntada.<br />Còpia de"
    ." seguretat de la base de dades `%s`<br"
    ." /><br /><br />S'ha creat aquest"
    ." arxiu:<br /><br />%s <br /><br /><br"
    ." />Salutacions de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="Adreça d'email";
$lang['L_EMAIL_CC']="Destinataris en còpia (CC)";
$lang['L_EMAIL_MAXSIZE']="Tamany màxim per a fitxers adjunts";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... només el fitxer adjunt";
$lang['L_EMAIL_RECIPIENT']="Destinatari";
$lang['L_EMAIL_SENDER']="Remitent";
$lang['L_EMAIL_START']="Engegar l'enviament de l'email";
$lang['L_EMAIL_WAS_SEND']="S'ha enviat amb èxit un email a";
$lang['L_EMPTY']="Buidar";
$lang['L_EMPTYKEYS']="buidar i resetejar els índexs";
$lang['L_EMPTYTABLEBEFORE']="Primer buidar la taula";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Eliminar les taules abans de la"
    ." restauració";
$lang['L_ENCODING']="Codificació";
$lang['L_ENCRYPTION_TYPE']="Tipus d'encriptació";
$lang['L_ENGINE']="Màquina";
$lang['L_ENTER_DB_INFO']="Primer pulsi el botó \"Conectar amb"
    ." MySQL\". Només si no és possible"
    ." detectar cap base de dades és"
    ." necesari que escrigui un nom aquí.";
$lang['L_ENTRY']="Registre";
$lang['L_ERROR']="Error";
$lang['L_ERRORHANDLING_RESTORE']="Gestió dels errors en la restauració"
    ." de dades";
$lang['L_ERROR_CONFIGFILE_NAME']="El nom d'arxiu \"%s\" conté"
    ." caràcters no vàlids.";
$lang['L_ERROR_DELETING_CONFIGFILE']="Error! no s'ha pogut eliminar l'arxiu"
    ." de configuració %s !";
$lang['L_ERROR_LOADING_CONFIGFILE']="No s'ha pogut carregar l'arxiu de"
    ." configuració \"%s\".";
$lang['L_ERROR_LOG']="Registre d'errors";
$lang['L_ERROR_MULTIPART_RESTORE']="Restauració per parts: no s'ha trobat"
    ." el següent arxiu '%s'!";
$lang['L_ESTIMATED_END']="Estimació de la finalització";
$lang['L_EXCEL2003']="Excel a partir de la versió 2003";
$lang['L_EXISTS']="Existeix";
$lang['L_EXPORT']="Exportar";
$lang['L_EXPORTFINISHED']="Exportació finalitzada.";
$lang['L_EXPORTLINES']="<strong>%s</strong> línies exportades";
$lang['L_EXPORTOPTIONS']="Opcions d'exportació";
$lang['L_EXTENDEDPARS']="Paràmetres avançats";
$lang['L_FADE_IN_OUT']="Mostrar/ocultar";
$lang['L_FATAL_ERROR_DUMP']="Error fatal! la instrucció CREATE de"
    ." la taula '%s' a la base de dades '%s'"
    ." no s'ha pogut llegir!";
$lang['L_FIELDS']="Camps";
$lang['L_FIELDS_OF_TABLE']="Camps de la taula";
$lang['L_FILE']="Arxiu";
$lang['L_FILES']="Arxius";
$lang['L_FILESIZE']="Tamany d'arxiu";
$lang['L_FILE_MANAGE']="Gestió d'arxius";
$lang['L_FILE_OPEN_ERROR']="Error: no s'ha pogut obrir l'arxiu.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="L'arxiu s'ha guardat amb èxit.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="No s'ha pogut guardar l'arxiu!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="L'arxiu '%s' s'ha pujat amb èxit.";
$lang['L_FILTER_BY']="Filtrar per";
$lang['L_FM_ALERTRESTORE1']="Vol complir la base de dades";
$lang['L_FM_ALERTRESTORE2']="amb els registres de l'arxiu";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="Totes les còpies de seguretat";
$lang['L_FM_ANZ_BU']="nombre de còpies";
$lang['L_FM_ASKDELETE1']="Realment vol eliminar l'arxiu";
$lang['L_FM_ASKDELETE2']="?";
$lang['L_FM_ASKDELETE3']="Vol executar ara l'eliminació"
    ." automàtica segons les regles"
    ." especificades?";
$lang['L_FM_ASKDELETE4']="Realment vol eliminar tots els arxius"
    ." de còpies de seguretat?";
$lang['L_FM_ASKDELETE5']="Vol eliminar tots els arxius de"
    ." còpies de seguretat amb el prefix";
$lang['L_FM_ASKDELETE5_2']="* ?";
$lang['L_FM_AUTODEL1']="Eliminació automàtica: els següents"
    ." arxius han estat eliminats per superar"
    ." el nombre màxim d'arxius establert:";
$lang['L_FM_CHOOSE_ENCODING']="Seleccioni la codificació de l'arxiu"
    ." de la còpia de seguretat";
$lang['L_FM_COMMENT']="Faci un comentari";
$lang['L_FM_DELETE']="Eliminar";
$lang['L_FM_DELETE1']="L'arxiu";
$lang['L_FM_DELETE2']="ha estat eliminat.";
$lang['L_FM_DELETE3']="no ha pogut ser eliminat!";
$lang['L_FM_DELETEALL']="Eliminar totes les còpies de"
    ." seguretat";
$lang['L_FM_DELETEALLFILTER']="Eliminar tots els arxius amb";
$lang['L_FM_DELETEAUTO']="Executar eliminació automàtica"
    ." manualment";
$lang['L_FM_DUMPSETTINGS']="Configuració de la còpia de"
    ." seguretat";
$lang['L_FM_DUMP_HEADER']="Còpia de seguretat";
$lang['L_FM_FILEDATE']="data";
$lang['L_FM_FILES1']="Còpies de seguretat";
$lang['L_FM_FILESIZE']="Tamany de l'arxiu";
$lang['L_FM_FILEUPLOAD']="Pujar arxiu";
$lang['L_FM_FREESPACE']="Espai lliure al servidor";
$lang['L_FM_LAST_BU']="Darrera còpia de seguretat";
$lang['L_FM_NOFILE']="No ha escollit cap arxiu!";
$lang['L_FM_NOFILESFOUND']="No s'han trobat arxius.";
$lang['L_FM_RECORDS']="Registres";
$lang['L_FM_RESTORE']="Restaurar";
$lang['L_FM_RESTORE_HEADER']="Restauració de la base de dades"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Seleccioni les taules";
$lang['L_FM_STARTDUMP']="Iniciar nova còpia de seguretat";
$lang['L_FM_TABLES']="Taules";
$lang['L_FM_TOTALSIZE']="Tamany total";
$lang['L_FM_UPLOADFAILED']="Ha fallat la pujada de l'arxiu!";
$lang['L_FM_UPLOADFILEEXISTS']="Ja existeix un arxiu amb aquest nom!";
$lang['L_FM_UPLOADFILEREQUEST']="Si us plau, esculli un arxiu.";
$lang['L_FM_UPLOADMOVEERROR']="No s'ha pogut moure l'arxiu pujat al"
    ." directori corresponent.";
$lang['L_FM_UPLOADNOTALLOWED1']="Aquest tipus d'arxiu no està"
    ." suportat.";
$lang['L_FM_UPLOADNOTALLOWED2']="Els tipus d'arxius permesos són: *.gz"
    ." i *.sql";
$lang['L_FORCE_UPDATE']="";
$lang['L_FOUND_DB']="Trobada BBDD:";
$lang['L_FROMFILE']="d'arxiu";
$lang['L_FROMTEXTBOX']="des de casella de text";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Afegir conexió";
$lang['L_FTP_CHOOSE_MODE']="Modus de transferència FTP";
$lang['L_FTP_CONFIRM_DELETE']="Realment vol eliminar aquesta conexió"
    ." FTP?";
$lang['L_FTP_CONNECTION']="Conexió FTP";
$lang['L_FTP_CONNECTION_CLOSED']="Conexió FTP tancada";
$lang['L_FTP_CONNECTION_DELETE']="Eliminar la conexió";
$lang['L_FTP_CONNECTION_ERROR']="No s'ha pogut establir conexió amb el"
    ." servidor '%s' emprant el port %s.";
$lang['L_FTP_CONNECTION_SUCCESS']="S'ha conectat amb èxit amb el"
    ." servidor '%s' emprant el port %s";
$lang['L_FTP_DIR']="Directori de pujada";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Ha fallat la transferència de l'arxiu"
    ." '%s'";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="Se ha transferido con éxito el"
    ." archivo '%s'";
$lang['L_FTP_LOGIN_ERROR']="S'ha denegat l'accés com a usuari"
    ." '%s'";
$lang['L_FTP_LOGIN_SUCCESS']="Accés com a usuari '%s' amb èxit";
$lang['L_FTP_OK']="La conexió s'ha realitzat amb èxit.";
$lang['L_FTP_PASS']="Contrasenya";
$lang['L_FTP_PASSIVE']="emprar el modus de transferència"
    ." pasiva";
$lang['L_FTP_PASV_ERROR']="No s'ha pogut canviar al modus passiu!";
$lang['L_FTP_PASV_SUCCESS']="El canvi a modus passiu ha estat un"
    ." èxit!";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="para <strong>%s</strong><br />a"
    ." <strong>%s</s>";
$lang['L_FTP_SERVER']="Servidor";
$lang['L_FTP_SSL']="Conexió segura mediante SSL-FTP";
$lang['L_FTP_START']="Començar la transferència FTP";
$lang['L_FTP_TIMEOUT']="Cancelació de la conexió per temps";
$lang['L_FTP_TRANSFER']="Transferència FTP";
$lang['L_FTP_USER']="Usuari";
$lang['L_FTP_USESSL']="utilitza conexió SSL";
$lang['L_GENERAL']="Genèriques";
$lang['L_GZIP']="Compressió Gzip";
$lang['L_GZIP_COMPRESSION']="Compressió GZip";
$lang['L_HOME']="Inici";
$lang['L_HOUR']="Hora";
$lang['L_HOURS']="Hores";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Activar la reescritura";
$lang['L_HTACC_ADD_HANDLER']="Afegir controlador";
$lang['L_HTACC_CONFIRM_DELETE']="Vol crear ara la protecció de"
    ." directori?";
$lang['L_HTACC_CONTENT']="Contingut de l'arxiu";
$lang['L_HTACC_CREATE']="Crear protecció de directori";
$lang['L_HTACC_CREATED']="la protecció de directori ha estat"
    ." creada.";
$lang['L_HTACC_CREATE_ERROR']="S'ha produit un error al crear la"
    ." protecció del directori!<br />Si us"
    ." plau, coloqui manualment a dintre el"
    ." següent arxiu, amb el següent"
    ." contingut";
$lang['L_HTACC_CRYPT']="Crypt màxim de 8 caràcters (Linux i"
    ." Unix)";
$lang['L_HTACC_DENY_ALLOW']="Denegar / Permetre";
$lang['L_HTACC_DIR_LISTING']="Llistat de directoris";
$lang['L_HTACC_EDIT']="editar .htaccess";
$lang['L_HTACC_ERROR_DOC']="Document d'errors";
$lang['L_HTACC_EXAMPLES']="altres exemples i documentació";
$lang['L_HTACC_EXISTS']="Ja existeix actualment una protecció"
    ." del directori. Si en crea una de nova,"
    ." la vella serà sobreescrita!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Permetre execució";
$lang['L_HTACC_MD5']="MD5 (Linux i Unix)";
$lang['L_HTACC_NO_ENCRYPTION']="text pla, sense encriptació (Windows)";
$lang['L_HTACC_NO_USERNAME']="Ha de posar-hi un nom!";
$lang['L_HTACC_PROPOSED']="Molt recomenat";
$lang['L_HTACC_REDIRECT']="Redirecccionar";
$lang['L_HTACC_SCRIPT_EXEC']="Executar script";
$lang['L_HTACC_SHA1']="SHA1 (tots els sistemes)";
$lang['L_HTACC_WARNING']="Compte! L'arxiu .htaccess afecta"
    ." directament al comportament dels"
    ." navegadors.<br />Amb el contingut"
    ." inadequat, aquestes planes poden no"
    ." ser accesibles!";
$lang['L_IMPORT']="Importar";
$lang['L_IMPORTIEREN']="Importar";
$lang['L_IMPORTOPTIONS']="Opcions d'importació";
$lang['L_IMPORTSOURCE']="Origen de la importació";
$lang['L_IMPORTTABLE']="Importar a taula";
$lang['L_IMPORT_NOTABLE']="No s'ha seleccionat cap taula per a"
    ." importar!";
$lang['L_IN']="a";
$lang['L_INDEX_SIZE']="Tamany de l'índex";
$lang['L_INFO_ACTDB']="Base de dades actual";
$lang['L_INFO_DATABASES']="Bases de dades accesibles";
$lang['L_INFO_DBEMPTY']="La base de dades està buida!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="En aquest servidor la instrucció"
    ." fsockopen() de PHP està deshabilitada"
    ." per la configuració del servidor."
    ." Degut a això la descàrrega"
    ." automàtica de paquets d'idioma no és"
    ." possible! Per a resoldre això, pot"
    ." descarregar manualment els paquets,"
    ." extreure'ls localment i pujarlos al"
    ." directori \"language\" de la seva"
    ." instalació de MySQLDumper. Després,"
    ." el nou paquet d'idioma apareixerà"
    ." disponible en aquest lloc.";
$lang['L_INFO_LASTUPDATE']="darrera actualització";
$lang['L_INFO_LOCATION']="Es troba a";
$lang['L_INFO_NODB']="Base de dades inexistent";
$lang['L_INFO_NOPROCESSES']="no hi ha processos en marxa";
$lang['L_INFO_NOSTATUS']="no hi ha estats disponibles";
$lang['L_INFO_NOVARS']="no hi ha variables disponibles";
$lang['L_INFO_OPTIMIZED']="optimitzat";
$lang['L_INFO_RECORDS']="Registres";
$lang['L_INFO_SIZE']="Tamany";
$lang['L_INFO_SUM']="Total";
$lang['L_INSTALL']="Instalació";
$lang['L_INSTALLED']="Instalat";
$lang['L_INSTALL_DB_DEFAULT']="Emprar com a base de dades per defecte";
$lang['L_INSTALL_HELP_PORT']="(buit = port estandard)";
$lang['L_INSTALL_HELP_SOCKET']="(buit = socket estàndar)";
$lang['L_IS_WRITABLE']="Es pot reescriure";
$lang['L_KILL_PROCESS']="Aturar el procés";
$lang['L_LANGUAGE']="Idioma";
$lang['L_LANGUAGE_NAME']="Catalan";
$lang['L_LASTBACKUP']="Darrera còpia de seguretat";
$lang['L_LOAD']="Carregar configuració per defecte";
$lang['L_LOAD_DATABASE']="Refrescar la llista de BBDD";
$lang['L_LOAD_FILE']="Carregar arxiu";
$lang['L_LOG']="Arxiu de registre";
$lang['L_LOGFILENOTWRITABLE']="No es pot escriure a l'arxiu de"
    ." registre (log)!";
$lang['L_LOGFILES']="Arxius de registre";
$lang['L_LOGGED_IN']="Iniciada sessió";
$lang['L_LOGIN']="Accessar";
$lang['L_LOGIN_AUTOLOGIN']="Inici de sessió automàtic";
$lang['L_LOGIN_INVALID_USER']="L'adreça d'email o la contrasenya no"
    ." són correctes.";
$lang['L_LOGOUT']="Tancar sessió";
$lang['L_LOG_CREATED']="Arxiu de registre creat.";
$lang['L_LOG_DELETE']="Eliminar l'arxiu de registre (log)";
$lang['L_LOG_MAXSIZE']="Tamany màxim dels arxius de registre"
    ." (log)";
$lang['L_LOG_NOT_READABLE']="L'arxiu de registre '%s' no existeix o"
    ." no és legible.";
$lang['L_MAILERROR']="Ha fallat l'enviament de l'email!";
$lang['L_MAILPROGRAM']="Programa de correu electrònic";
$lang['L_MAXIMUM_LENGTH']="Longitud màxima";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="Aquest és el nombre màxim de bytes"
    ." que necesita un caràcter per a"
    ." gravar-se a un disc.";
$lang['L_MAXSIZE']="Tamany màxim";
$lang['L_MAX_BACKUP_FILES_EACH2']="per a cada base de dades";
$lang['L_MAX_EXECUTION_TIME']="Temps màxim d'execució";
$lang['L_MAX_UPLOAD_SIZE']="Tamany màxim de l'arxiu";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Si l'arxiu de la còpia de seguretat"
    ." és més gran que el límit esmentat a"
    ." dalt, llavors ha de pujar-lo per FTP"
    ." al directori \"/work/backup\".<br"
    ." />Després aquest arxiu es mostrarà"
    ." aquí, i podrà escollir-lo per a fer"
    ." la restauració.";
$lang['L_MEMORY']="Memòria";
$lang['L_MENU_HIDE']="Amagar el menú";
$lang['L_MENU_SHOW']="Mostrar el menú";
$lang['L_MESSAGE']="Missatge";
$lang['L_MESSAGE_TYPE']="Tipus de missatge";
$lang['L_MINUTE']="Minut";
$lang['L_MINUTES']="Minuts";
$lang['L_MOBILE_OFF']="De";
$lang['L_MOBILE_ON']="a";
$lang['L_MODE_EASY']="Senzill";
$lang['L_MODE_EXPERT']="Expert";
$lang['L_MSD_INFO']="Informació sobre MySQLDumper";
$lang['L_MSD_MODE']="Modus MySQLDumper";
$lang['L_MSD_VERSION']="Versió de MySQLDumper";
$lang['L_MULTIDUMP']="Volcat per parts";
$lang['L_MULTIDUMP_FINISHED']="Còpia de seguretat de <b>%d</b> bases"
    ." de dades finalitzada";
$lang['L_MULTIPART_ACTUAL_PART']="Sub-arxiu actual";
$lang['L_MULTIPART_SIZE']="Tamany màxim d'arxiu";
$lang['L_MULTI_PART']="Còpia de seguretat en múltiples"
    ." arxius";
$lang['L_MYSQLVARS']="Variables de MySQL";
$lang['L_MYSQL_CLIENT_VERSION']="Client MySQL";
$lang['L_MYSQL_CONNECTION_ENCODING']="Codificació habitual per a servidors"
    ." MySQL";
$lang['L_MYSQL_DATA']="Dades MySQL";
$lang['L_MYSQL_ROUTINE']="Rutina";
$lang['L_MYSQL_ROUTINES']="Rutines";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Funcions i procediments emmagatzemats";
$lang['L_MYSQL_TABLES_EXPLAIN']="Les taules tenen una estructura"
    ." definida per columnes en les que s'hi"
    ." pot guardar dades en forma de files"
    ." (registres). Cada registre de la base"
    ." de dades es representa doncs per una"
    ." fila a una taula.";
$lang['L_MYSQL_VERSION']="Versió de MySQL";
$lang['L_MYSQL_VERSION_TOO_OLD']="Ho sentim: la versió disponible de"
    ." MySQL %s és massa antiga i no es pot"
    ." utilitzar amb aquesta versió de"
    ." MySQLDumper. Si us plau, actualitzi la"
    ." versió de MySQL, al menys a la seva"
    ." versió %s o superior. Com a"
    ." alternativa, pot instalar la versió"
    ." 1.24 de MySQLDumper que és compatible"
    ." amb la gran majoria de servidors"
    ." MySQL. Però en aquest cas perdrà"
    ." algunes de les noves característiques"
    ." de MySQLDumper ;)";
$lang['L_MYSQL_VIEW']="Vista";
$lang['L_MYSQL_VIEWS']="Vistes";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Les vistes mostren (filtrats) conjunts"
    ." de registres d'una o més taules,"
    ." però que en sí mateix no són són"
    ." registres.";
$lang['L_NAME']="Nom";
$lang['L_NEW']="nou";
$lang['L_NEWTABLE']="crear una nova taula";
$lang['L_NEXT_AUTO_INCREMENT']="Pròxim índex automàtic";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="índex automàtic";
$lang['L_NO']="no";
$lang['L_NOFTPPOSSIBLE']="Les funcions de FTP no estàn"
    ." disponibles!";
$lang['L_NOGZPOSSIBLE']="Donat que Zlib no està instalat en el"
    ." seu servidor, no pot emprar les"
    ." funcions de compresió d'arxius GZip!";
$lang['L_NONE']="cap";
$lang['L_NOREVERSE']="Mostrar les entrades més antigues"
    ." primer";
$lang['L_NOTAVAIL']="<em>no disponible</em>";
$lang['L_NOTHING_TO_DO']="No hi ha res a fer.";
$lang['L_NOTICE']="Indicació";
$lang['L_NOTICES']="Indicacions";
$lang['L_NOT_ACTIVATED']="inactiu";
$lang['L_NOT_SUPPORTED']="Aquesta còpia de seguretat no accepta"
    ." aquesta funció.";
$lang['L_NO_DB_FOUND']="No s'ha pogut trobar cap base de dades"
    ." automàticament! Si us plau, mostri"
    ." els paràmetres de la conexió, i"
    ." escrigui el nom de la seva base de"
    ." dades manualmet.";
$lang['L_NO_DB_FOUND_INFO']="S'ha establert amb èxit la conexió"
    ." amb el servidor de la base de"
    ." dades.<br /> Les seves dades d'usuari"
    ." són vàlides i foren acceptades pel"
    ." servidor MySQL.<br /><br />Però"
    ." MySQLDumper no ha pogut trobar cap"
    ." base de dades!<br />En alguns"
    ." servidors està bloquejada la"
    ." detecció automàtica a través"
    ." d'scripts per questions de"
    ." seguretat.<br />Ha d'escriure"
    ." manualment el nom de la seva base de"
    ." dades un cop que finalitzi la"
    ." instalació. Pulsi a \"configuració\""
    ." \"paràmetres de conexió - mostrar\""
    ." i escrigui allà el nom de la base de"
    ." dades.";
$lang['L_NO_DB_SELECTED']="No s'ha seleccionat cap base de dades.";
$lang['L_NO_ENTRIES']="La taula és buida i no conté cap"
    ." registre.";
$lang['L_NO_MSD_BACKUPFILE']="Còpies de seguretat d'altre"
    ." programari";
$lang['L_NO_NAME_GIVEN']="No ha escrit un nom.";
$lang['L_NR_OF_QUERIES']="Nombre de consultes";
$lang['L_NR_OF_RECORDS']="Nombre de registres";
$lang['L_NR_TABLES_OPTIMIZED']="S'han optimitzat %s taules.";
$lang['L_NUMBER_OF_FILES_FORM']="Quantitat d'arxius de còpia de"
    ." seguretat";
$lang['L_OF']="de";
$lang['L_OK']="Ok";
$lang['L_OPTIMIZE']="Optimitzar";
$lang['L_OPTIMIZE_TABLES']="Optimitzar les taules abans de la"
    ." còpia de seguretat";
$lang['L_OPTIMIZE_TABLE_ERR']="Ha hagut un error provant d'optimitzar"
    ." la taula `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="L taula '%s' ha estat optimitzada amb"
    ." èxit.";
$lang['L_OS']="Sistema operatiu";
$lang['L_OVERHEAD']="Sobresortir";
$lang['L_PAGE']="Plana";
$lang['L_PAGE_REFRESHS']="Vistes de plana";
$lang['L_PASS']="Contrasenya";
$lang['L_PASSWORD']="Contrasenya";
$lang['L_PASSWORDS_UNEQUAL']="Les contrasenyes són buides o no són"
    ." idèntiques!";
$lang['L_PASSWORD_REPEAT']="Contrasenya (reescriure)";
$lang['L_PASSWORD_STRENGTH']="Fortalesa de la contrasenya";
$lang['L_PERLOUTPUT1']="Valor per a absolute_path_of_configdir"
    ." a crondump.pl";
$lang['L_PERLOUTPUT2']="Accesible des del navegador o des d'un"
    ." cronjob extern al servidor";
$lang['L_PERLOUTPUT3']="Instrucció per la consola (shell) o"
    ." per al Crontab";
$lang['L_PERL_COMPLETELOG']="Registre complert de Perl";
$lang['L_PERL_LOG']="Registre de Perl";
$lang['L_PHPBUG']="Error a la llibreria zlib! No és"
    ." posible comprimir arxius!";
$lang['L_PHPMAIL']="Funció mail() de PHP";
$lang['L_PHP_EXTENSIONS']="Extensions de PHP";
$lang['L_PHP_LOG']="Registre de PHP";
$lang['L_PHP_VERSION']="Versió de PHP";
$lang['L_PHP_VERSION_TOO_OLD']="Ho sentim: la versió de PHP instalada"
    ." en aquest servidor és massa antiga"
    ." per a funcionar amb aquesta versió de"
    ." MySQLDumper. PHP ha d'èsser de la"
    ." versió %s o posterior. La versió"
    ." actual de PHP és %s. Ha d'actualitzar"
    ." la versió de PHP per a poder instalar"
    ." i usar aquesta versió de MySQLDumper.";
$lang['L_POP3_PORT']="Port POP3";
$lang['L_POP3_SERVER']="Servidor POP3";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="a sota al centre";
$lang['L_POSITION_BL']="a sota a l'esquerra";
$lang['L_POSITION_BR']="a sota a la dreta";
$lang['L_POSITION_MC']="al mig centrat";
$lang['L_POSITION_ML']="al mig a l'esquerra";
$lang['L_POSITION_MR']="al mig a la dreta";
$lang['L_POSITION_NOTIFICATIONS']="Posició de la finestra de"
    ." notificacions";
$lang['L_POSITION_TC']="a dalt al centre";
$lang['L_POSITION_TL']="a dalt a l'esquerra";
$lang['L_POSITION_TR']="a dalt a la dreta";
$lang['L_POSSIBLE_COLLATIONS']="Colacions posibles";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="Aquestes són les posibles locacions"
    ." que hom pot escollir per a aquest joc"
    ." de caràcters:<br /><br />_cs ="
    ." sensible a majúscules<br />_ci = no"
    ." distingeix majúscules/minúscules";
$lang['L_PREFIX']="Prefixe";
$lang['L_PRIMARYKEYS_CHANGED']="Clau principal canviada";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Error al canviar la clau principal";
$lang['L_PRIMARYKEYS_SAVE']="Guardar la clau principal";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Realment vol eliminar la clau"
    ." principal?";
$lang['L_PRIMARYKEY_DELETED']="Clau principal eliminada";
$lang['L_PRIMARYKEY_FIELD']="Camp de clau principal";
$lang['L_PRIMARYKEY_NOTFOUND']="Clau principal no trobada";
$lang['L_PROCESSKILL1']="Es provarà de forçar la"
    ." finalització del procés";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="S'ha provat des de fa";
$lang['L_PROCESSKILL4']="segons per a eliminar el procés";
$lang['L_PROCESS_ID']="ID del procés";
$lang['L_PROGRESS_FILE']="Progrés de l'arxiu";
$lang['L_PROGRESS_OVER_ALL']="Progrés total";
$lang['L_PROGRESS_TABLE']="Progrés de la taula actual";
$lang['L_PROVIDER']="Proveidor";
$lang['L_PROZESSE']="Processos";
$lang['L_QUERY']="Consulta";
$lang['L_QUERY_TYPE']="Tipus de consulta";
$lang['L_RECHTE']="permissos";
$lang['L_RECORDS']="registres";
$lang['L_RECORDS_INSERTED']="<b>%s</b> registres inserits.";
$lang['L_RECORDS_OF_TABLE']="Registres de la taula";
$lang['L_RECORDS_PER_PAGECALL']="Registres per plana vista";
$lang['L_REFRESHTIME']="Període per a actualització";
$lang['L_REFRESHTIME_PROCESSLIST']="Període d'actualització de la llista"
    ." de processos";
$lang['L_REGISTRATION_DESCRIPTION']="Si us plau, crei ara el compte"
    ." d'administrador. Amb ell podrà"
    ." accedir en el futur a MySQLDumper. Per"
    ." aquesta raó hauria de prendre nota de"
    ." les dades d'aquest compte.<br /><br"
    ." />Vosté pot escollir lliurament el"
    ." nom d'usuari i la contrasenya. Si us"
    ." plau, estigui segur d'escollir la"
    ." combinació més segura posible per a"
    ." protegir a MySQLDumper contra l'accés"
    ." no autoritzat!";
$lang['L_RELOAD']="Tornar a carregar";
$lang['L_REMOVE']="Eliminar";
$lang['L_REPAIR']="Reparar";
$lang['L_RESET']="Reinicialitzar";
$lang['L_RESET_SEARCHWORDS']="reinicialitzar paraules a buscar";
$lang['L_RESTORE']="Restaurar";
$lang['L_RESTORE_COMPLETE']="S'han creat <b>%s</b> taules.";
$lang['L_RESTORE_DB']="la base de dades '<b>%s</b>' a"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Finalitzada la restauració de la base"
    ." de dades '%s' en %s.";
$lang['L_RESTORE_OF_TABLES']="Escolli les taules a restaurar";
$lang['L_RESTORE_TABLE']="Restauració de la taula '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Fins ara, s'han creat <b>%d</b> de"
    ." <b>%d</b> taules.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Fins ara, s'han creat <b>%d</b>"
    ." taules.";
$lang['L_RESULT']="Resultat";
$lang['L_REVERSE']="Mostrar les entrades més noves primer";
$lang['L_SAFEMODEDESC']="Donat que a aquest servidor s'està"
    ." executant PHP en modus segur"
    ." (safe_mode), necesita crear els"
    ." següents directoris manualment"
    ." emprant el seu programa de FTP:";
$lang['L_SAVE']="Desar";
$lang['L_SAVEANDCONTINUE']="Desar i continuar amb la instalació";
$lang['L_SAVE_ERROR']="Hi ha hagut un error! no s'ha pogut"
    ." desar la configuració!";
$lang['L_SAVE_SUCCESS']="La configuració s'ha desat amb èxit"
    ." a l'arxiu de configuració \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Desar el contingut de la base de dades"
    ." '%s' a l'arxiu '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Tamany màxim d'arxiu rebasat:"
    ." continuant amb l'arxiu '%s'";
$lang['L_SAVING_DB_FORM']="Base de dades";
$lang['L_SAVING_TABLE']="Desant taula";
$lang['L_SEARCH_ACCESS_KEYS']="Navegar: Endavant=ALT+V, Enrere=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Buscar a la taula";
$lang['L_SEARCH_NO_RESULTS']="¡La cerca de \"<b>%s</b>\" a la taula"
    ." \"<b>%s</b>\" no ha produït cap"
    ." resultat!";
$lang['L_SEARCH_OPTIONS']="Opcions de cerca";
$lang['L_SEARCH_OPTIONS_AND']="una columna ha de contenir tots els"
    ." termes cercats (cerca AND)";
$lang['L_SEARCH_OPTIONS_CONCAT']="una línia ha de contenir tots els"
    ." termes cercats, però aquests poden"
    ." èsser a qualsevol de les columnes"
    ." (podria trigar una mica!)";
$lang['L_SEARCH_OPTIONS_OR']="una columna ha de contenir al menys un"
    ." dels termes cercats (cerca OR)";
$lang['L_SEARCH_RESULTS']="La cerca de \"<b>%s</b>\" a la taula"
    ." \"<b>%s</b>\" ha produït els"
    ." següents resultats";
$lang['L_SECOND']="Segon";
$lang['L_SECONDS']="Segons";
$lang['L_SELECT']="Seleccioni";
$lang['L_SELECTED_FILE']="arxiu escollit";
$lang['L_SELECT_ALL']="Escollir totes";
$lang['L_SELECT_FILE']="Esculli un arxiu";
$lang['L_SELECT_LANGUAGE']="Escollir idioma";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Enviar resultats com a arxiu";
$lang['L_SEND_MAIL_FORM']="Enviar un correu electrònic";
$lang['L_SERVER']="Servidor";
$lang['L_SERVERCAPTION']="Visualització del servidor";
$lang['L_SETPRIMARYKEYSFOR']="Crear nova clau principal per a la"
    ." taula";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Mostrant els registres de %s fins a %s"
    ." de %s";
$lang['L_SHOWRESULT']="Mostrar resultats";
$lang['L_SHOW_TABLES']="Mostrar taulas";
$lang['L_SHOW_TOOLTIPS']="Mostrar consells (tooltips) macos";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="Servidor SMTP";
$lang['L_SMTP_PORT']="Port STMP";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Velocitat";
$lang['L_SQLBOX']="Caixa SQL";
$lang['L_SQLBOXHEIGHT']="Alçària de la caixa SQL";
$lang['L_SQLLIB_ACTIVATEBOARD']="activar forum";
$lang['L_SQLLIB_BOARDS']="Fòrums";
$lang['L_SQLLIB_DEACTIVATEBOARD']="desactivar fòrum";
$lang['L_SQLLIB_GENERALFUNCTIONS']="funcions generals";
$lang['L_SQLLIB_RESETAUTO']="reinicialitzar autoincrement";
$lang['L_SQLLIMIT']="Nombre de registres per plana";
$lang['L_SQL_ACTIONS']="Accions";
$lang['L_SQL_AFTER']="següent";
$lang['L_SQL_ALLOWDUPS']="Se permiten duplicaciones";
$lang['L_SQL_ATPOSITION']="inserir a la posició";
$lang['L_SQL_ATTRIBUTES']="Atributs";
$lang['L_SQL_BACKDBOVERVIEW']="Tornar al llistat de bases de dades";
$lang['L_SQL_BEFEHLNEU']="Nova instrucció";
$lang['L_SQL_BEFEHLSAVED1']="Instrucció SQL";
$lang['L_SQL_BEFEHLSAVED2']="s'ha afegit";
$lang['L_SQL_BEFEHLSAVED3']="s'ha desat";
$lang['L_SQL_BEFEHLSAVED4']="s'ha desplaçat cap amunt";
$lang['L_SQL_BEFEHLSAVED5']="s'ha eliminat";
$lang['L_SQL_BROWSER']="Navegador SQL";
$lang['L_SQL_CARDINALITY']="Cardinalitat";
$lang['L_SQL_CHANGED']="s'ha modificat.";
$lang['L_SQL_CHANGEFIELD']="modificar camp";
$lang['L_SQL_CHOOSEACTION']="Esculli una acció";
$lang['L_SQL_COLLATENOTMATCH']="Aquest joc de caràcters i la colació"
    ." escollida no poden funcionar"
    ." conjuntament!";
$lang['L_SQL_COLUMNS']="columnes";
$lang['L_SQL_COMMANDS']="Instruccions SQL";
$lang['L_SQL_COMMANDS_IN']="línies a";
$lang['L_SQL_COMMANDS_IN2']="registres procesats per segon.";
$lang['L_SQL_COPYDATADB']="Copiar el contingut complert de la"
    ." base de dades a";
$lang['L_SQL_COPYSDB']="Copiar l'estructura de la base de"
    ." dades";
$lang['L_SQL_COPYTABLE']="Copiar taula";
$lang['L_SQL_CREATED']="s'ha creat.";
$lang['L_SQL_CREATEINDEX']="crear nou índex";
$lang['L_SQL_CREATETABLE']="Crear taula";
$lang['L_SQL_DATAVIEW']="Vista de dades";
$lang['L_SQL_DBCOPY']="El contingut de la base de dades `%s`"
    ." ha estat copiat a la base de dades"
    ." `%s`.";
$lang['L_SQL_DBSCOPY']="L'estructura de la base de dades `%s`"
    ." ha estat copiada a la base de dades"
    ." `%s`.";
$lang['L_SQL_DELETED']="s'ha eliminat";
$lang['L_SQL_DESTTABLE_EXISTS']="La taula de destí ja existeix!";
$lang['L_SQL_EDIT']="editar";
$lang['L_SQL_EDITFIELD']="editar camp";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Modificar l'estructura de la taula";
$lang['L_SQL_EMPTYDB']="Buidar la base de dades";
$lang['L_SQL_ERROR1']="Error a la consulta!";
$lang['L_SQL_ERROR2']="MySQL diu:";
$lang['L_SQL_EXEC']="executar instrucció SQL";
$lang['L_SQL_EXPORT']="Exportar des de la base de dades `%s`";
$lang['L_SQL_FIELDDELETE1']="El camp";
$lang['L_SQL_FIELDNAMENOTVALID']="Error: nom de camp no vàlid";
$lang['L_SQL_FIRST']="primer";
$lang['L_SQL_IMEXPORT']="Importar/Exportar";
$lang['L_SQL_IMPORT']="Importar a la base de dades `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: detectada instrucció"
    ." incomplerta.<br />No s'ha pogut trobar"
    ." un tancament per a '%s' a la"
    ." consulta:<br />%s";
$lang['L_SQL_INDEXES']="Índexs";
$lang['L_SQL_INSERTFIELD']="insertar camp";
$lang['L_SQL_INSERTNEWFIELD']="insertar nou camp";
$lang['L_SQL_LIBRARY']="Librería SQL";
$lang['L_SQL_NAMEDEST_MISSING']="Falta el nom del destí!";
$lang['L_SQL_NEWFIELD']="nou camp";
$lang['L_SQL_NODATA']="No hi ha registres";
$lang['L_SQL_NODEST_COPY']="No es pot copiar res si no hi ha un"
    ." destí!";
$lang['L_SQL_NOFIELDDELETE']="L'eliminació no és posible, doncs la"
    ." taula ha de contenir un camp com a"
    ." mínim.";
$lang['L_SQL_NOTABLESINDB']="No s'ha trobat cap taula a la base de"
    ." dades";
$lang['L_SQL_NOTABLESSELECTED']="No s'ha escollit cap taula!";
$lang['L_SQL_OPENFILE']="Obrir arxiu SQL";
$lang['L_SQL_OPENFILE_BUTTON']="Pujar";
$lang['L_SQL_OUT1']="S'ha executat";
$lang['L_SQL_OUT2']="Instruccions";
$lang['L_SQL_OUT3']="Va haver-hi";
$lang['L_SQL_OUT4']="comentaris";
$lang['L_SQL_OUT5']="Donat que el resultat conté aprop de"
    ." 5000 registres, aquests no es"
    ." mostraran.";
$lang['L_SQL_OUTPUT']="Resposta del SQL";
$lang['L_SQL_QUERYENTRY']="La consulta conté";
$lang['L_SQL_RECORDDELETED']="S'ha eliminat el registre";
$lang['L_SQL_RECORDEDIT']="editar registre";
$lang['L_SQL_RECORDINSERTED']="S'ha afegit el registre";
$lang['L_SQL_RECORDNEW']="nuevo registro";
$lang['L_SQL_RECORDUPDATED']="Registre actualitzat";
$lang['L_SQL_RENAMEDB']="Canviar el nom a la base de dades";
$lang['L_SQL_RENAMEDTO']="se li ha canviat el nom a";
$lang['L_SQL_SCOPY']="L'estructura de la taula `%s` ha estat"
    ." copiada a la taula `%s`.";
$lang['L_SQL_SEARCH']="Cerca";
$lang['L_SQL_SEARCHWORDS']="Paraules a cercar";
$lang['L_SQL_SELECTTABLE']="esculli taula";
$lang['L_SQL_SERVER']="Servidor SQL";
$lang['L_SQL_SHOWDATATABLE']="mostrar les dades de la taula";
$lang['L_SQL_STRUCTUREDATA']="estructura i dades";
$lang['L_SQL_STRUCTUREONLY']="només estructura";
$lang['L_SQL_TABLEEMPTIED']="La taula `%s` ha estat eliminada.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="La taula `%s` ha estat eliminada i els"
    ." índexs reinicialitzats.";
$lang['L_SQL_TABLEINDEXES']="Índexs de la taula";
$lang['L_SQL_TABLENEW']="Edició de taules";
$lang['L_SQL_TABLENOINDEXES']="La taula no té cap índex definit";
$lang['L_SQL_TABLENONAME']="La taula necesita un nom!";
$lang['L_SQL_TABLESOFDB']="Taules de la base de dades";
$lang['L_SQL_TABLEVIEW']="Vista de taules";
$lang['L_SQL_TBLNAMEEMPTY']="El nom de la taula no pot ser buit!";
$lang['L_SQL_TBLPROPSOF']="Propietats de la taula de";
$lang['L_SQL_TCOPY']="La taula `%s` ha estat copiada (amb"
    ." dades) a la taula `%s`.";
$lang['L_SQL_UPLOADEDFILE']="Arxiu carregat:";
$lang['L_SQL_VIEW_COMPACT']="Vista: compacta";
$lang['L_SQL_VIEW_STANDARD']="Vista: estàndar";
$lang['L_SQL_VONINS']="d'un total de";
$lang['L_SQL_WARNING']="L'execució d'instruccions SQL serveix"
    ." per a manipular directament les dades"
    ." de la base de dades. Els autors de"
    ." MySQLDumper no es responsabilitzen de"
    ." la posible pèrdua de dades després"
    ." d'emprar aquesta utilitat.";
$lang['L_SQL_WASCREATED']="s'ha creat";
$lang['L_SQL_WASEMPTIED']="s'ha buidat";
$lang['L_STARTDUMP']="començar còpia de seguretat";
$lang['L_START_RESTORE_DB_FILE']="Iniciant la restauració de la base de"
    ." dades '%s' des de l'arxiu '%s'.";
$lang['L_START_SQL_SEARCH']="Començar la cerca";
$lang['L_STATUS']="Estat";
$lang['L_STEP']="Pas";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="L'arxiu de configuració \"%s\" s'ha"
    ." creat correctament.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="L'arxiu de configuració \"%s\" s'ha"
    ." eliminat amb èxit.";
$lang['L_SUM_TOTAL']="Suma";
$lang['L_TABLE']="Taula";
$lang['L_TABLENAME']="Nom de la taula";
$lang['L_TABLENAME_EXPLAIN']="Nom de la taula";
$lang['L_TABLES']="Taules";
$lang['L_TABLESELECTION']="Elecció de taules";
$lang['L_TABLE_CREATE_SUCC']="La taula '%s' s'ha creat amb èxit.";
$lang['L_TABLE_TYPE']="Tipus de taula";
$lang['L_TESTCONNECTION']="Provar connexió";
$lang['L_THEME']="Tema";
$lang['L_TIME']="Temps";
$lang['L_TIMESTAMP']="Marca de temps";
$lang['L_TITLE_INDEX']="Índex";
$lang['L_TITLE_KEY_FULLTEXT']="Clau de texte complert";
$lang['L_TITLE_KEY_PRIMARY']="Clau principal";
$lang['L_TITLE_KEY_UNIQUE']="Clau única";
$lang['L_TITLE_MYSQL_HELP']="Documentació de MySQL";
$lang['L_TITLE_NOKEY']="No hi ha clau";
$lang['L_TITLE_SEARCH']="Cerca";
$lang['L_TITLE_SHOW_DATA']="Veure dades";
$lang['L_TITLE_UPLOAD']="Pujar arxiu SQL";
$lang['L_TO']="fins";
$lang['L_TOOLS']="Eines";
$lang['L_TOOLS_TOOLBOX']="Elecció de la base de dades /"
    ." Funcions de la base de dades /"
    ." Importar i exportar";
$lang['L_TRUNCATE']="Truncar";
$lang['L_TRUNCATE_DATABASE']="Buidar base de dades";
$lang['L_UNIT_KB']="Kilobyte";
$lang['L_UNIT_MB']="Megabyte";
$lang['L_UNIT_PIXEL']="Píxel";
$lang['L_UNKNOWN']="desconegut";
$lang['L_UNKNOWN_SQLCOMMAND']="instrucció SQL desconeguda";
$lang['L_UPDATE']="Actualitzar";
$lang['L_UPDATE_CONNECTION_FAILED']="Ha fallat l'actualització perqué no"
    ." s'ha pogut conectar amb el servidor"
    ." '%s'.";
$lang['L_UPDATE_ERROR_RESPONSE']="Ha fallat l'actualització, el"
    ." servidor ha respost: '%s'";
$lang['L_UPTO']="fins";
$lang['L_USERNAME']="Nom d'usuari";
$lang['L_USE_SSL']="Usar SSL";
$lang['L_VALUE']="Valor";
$lang['L_VERSIONSINFORMATIONEN']="Versió";
$lang['L_VIEW']="veure";
$lang['L_VISIT_HOMEPAGE']="Visiti la web oficial";
$lang['L_VOM']="de";
$lang['L_WITH']="amb";
$lang['L_WITHATTACH']="amb arxiu adjunt";
$lang['L_WITHOUTATTACH']="sense cap arxiu adjunt";
$lang['L_WITHPRAEFIX']="amb prefixe";
$lang['L_WRONGCONNECTIONPARS']="Paràmetres de conexió erronis o"
    ." incomplerts!";
$lang['L_WRONG_CONNECTIONPARS']="Els paàmetres de conexió no són"
    ." correctes!";
$lang['L_WRONG_RIGHTS']="No es tenen permisos d'escriptura"
    ." sobre l'arxiu o directori '%s'.<br"
    ." />Els permisos (chmod) estan mal"
    ." configurats o el propietari no és"
    ." l'adequat.<br /><br />Si us plau,"
    ." comprovi els atributs"
    ." d'arxiu/directori utilitzant el seu"
    ." software de FTP.<br />Aquests han"
    ." d'èsser establerts a %s.";
$lang['L_YES']="sí";
$lang['L_ZEND_FRAMEWORK_VERSION']="Versió de Zend Framework";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="El nom d'arxiu donat '%value%' no és"
    ." un directori.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="El nom d'arxiu donat '%value%' no és"
    ." un arxiu.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="El destí proporcionat '%value%' no"
    ." és un enllaç.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="L'arxiu o directori '%value%' no és"
    ." executable.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="L'arxiu o directori '%value%' no"
    ." existeix.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="L'arxiu o directori '%value%' no és"
    ." llegible.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="L'arxiu donat '%value%' no és un"
    ." arxiu pujat.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="L'arxiu o directori '%value%' no es"
    ." pot reescriure.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Tipus no vàlid. S'esperava String"
    ." (cadena de text), Integer (nombre"
    ." sencer) o Float (nombre amb coma"
    ." flotant).";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="El valor és buit.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="L'adreça de correu electrònic conté"
    ." altres caràcters que no són punts"
    ." (\".\"), ni lletres, ni nombres. És a"
    ." dir, no cumpleix amb el format"
    ." \"dot-atom\".";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Tipus no vàlid. S'esperava String"
    ." (cadena de text).";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="El format de l'adreça de correu"
    ." electrònic no és vàlida.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="El nom del servidor (host) no és"
    ." vàlid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="La part local de l'adreça de correu"
    ." electrònic (part_local@domini.tld) no"
    ." és vàlida.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="Per a aquesta adreça de correu"
    ." electrònic no existeix un registre MX"
    ." vàlid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="El nom del servidor (hostname) es"
    ." troba en un segment de xarxa no"
    ." enrutable. L'adreça de correu"
    ." electrònic doncs no pot ser resolta"
    ." des de la xarxa pública.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="L'adreça d'email és massa llarga. La"
    ." longitud màxima és de 320"
    ." caràcters.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="L'adreça d'email no cumpleix amb el"
    ." format \"quoted-string\".";
$lang['L_ZEND_ID_HOSTNAME_CANNOT_DECODE_PUNYCODE']="El nom de domini punycode especificat"
    ." no pot ser decodificat.";
$lang['L_ZEND_ID_HOSTNAME_DASH_CHARACTER']="El nom de domini conté un guió en"
    ." una posició no vàlida.";
$lang['L_ZEND_ID_HOSTNAME_INVALID']="Tipus no vàlid. S'esperava String"
    ." (cadena de text).";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME']="El nom de domini no coincideix amb"
    ." l'estructura esperada.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME_SCHEMA']="El nom de domini no cumpleix amb els"
    ." esquemes donats per a TLD.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_LOCAL_NAME']="El nom de domini conté un nom de"
    ." xarxa local no vàlid.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_URI']="El nom de domini no cumpleix amb la"
    ." sintaxis URI.";
$lang['L_ZEND_ID_HOSTNAME_IP_ADDRESS_NOT_ALLOWED']="No es permeten adreces IP en els noms"
    ." de domini (hostnames).";
$lang['L_ZEND_ID_HOSTNAME_LOCAL_NAME_NOT_ALLOWED']="Noms de xarxes locals no estan"
    ." permeses com a noms de servidor.";
$lang['L_ZEND_ID_HOSTNAME_UNDECIPHERABLE_TLD']="No es pot extreure la part TLD del nom"
    ." de domini.";
$lang['L_ZEND_ID_HOSTNAME_UNKNOWN_TLD']="El nom de domini conté un TLD"
    ." desconegut.";
$lang['L_ZEND_ID_IS_EMPTY']="Aquest valor és necesari i no pot"
    ." romandre buit.";
$lang['L_ZEND_ID_MISSING_TOKEN']="Característica no establerta per a"
    ." contraposar.";
$lang['L_ZEND_ID_NOT_DIGITS']="Només es permeten digits numerals.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Tipus no vàlid. S'esperava String"
    ." (cadena de texte), Integer (nombre"
    ." sencer), Float (nombre amb coma"
    ." flotant), Boolean (boleà) o Array"
    ." (matriz).";
$lang['L_ZEND_ID_NOT_SAME']="Ambdós IDs no coincideixen.";
return $lang;
