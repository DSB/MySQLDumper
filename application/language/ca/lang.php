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
$lang['L_NO_MSD_BACKUPFILE']="Backups of other scripts";
$lang['L_NO_NAME_GIVEN']="You didn't enter a name.";
$lang['L_NR_OF_QUERIES']="Number of queries";
$lang['L_NR_OF_RECORDS']="Number of records";
$lang['L_NR_TABLES_OPTIMIZED']="%s tables have been optimized.";
$lang['L_NUMBER_OF_FILES_FORM']="Delete by number of files per database";
$lang['L_OF']="of";
$lang['L_OK']="OK";
$lang['L_OPTIMIZE']="Optimize";
$lang['L_OPTIMIZE_TABLES']="Optimize Tables before Backup";
$lang['L_OPTIMIZE_TABLE_ERR']="Error optimizing table `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Optimized table `%s` successfully.";
$lang['L_OS']="Operating system";
$lang['L_OVERHEAD']="Overhead";
$lang['L_PAGE']="Page";
$lang['L_PAGE_REFRESHS']="Pageviews";
$lang['L_PASS']="Password";
$lang['L_PASSWORD']="Password";
$lang['L_PASSWORDS_UNEQUAL']="The Passwords are not identical or"
    ." empty !";
$lang['L_PASSWORD_REPEAT']="Password (repeat)";
$lang['L_PASSWORD_STRENGTH']="Password strength";
$lang['L_PERLOUTPUT1']="Entry in crondump.pl for"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="URL for the browser or for external"
    ." Cron job";
$lang['L_PERLOUTPUT3']="Commandline in the Shell or for the"
    ." Crontab";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-Log";
$lang['L_PERL_LOG']="Perl-Log";
$lang['L_PHPBUG']="Bug in zlib ! No Compression possible!";
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
    ." install and use MySQLDumper. <br />";
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
    ." can choose for this character set.<br"
    ." /><br />_cs = case sensitiv<br />_ci ="
    ." case insensitive";
$lang['L_PREFIX']="Prefix";
$lang['L_PRIMARYKEYS_CHANGED']="Primary keys changed";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Error changing primary keys";
$lang['L_PRIMARYKEYS_SAVE']="Save primary keys";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Really delete primary key?";
$lang['L_PRIMARYKEY_DELETED']="Primary key deleted";
$lang['L_PRIMARYKEY_FIELD']="Primary key field";
$lang['L_PRIMARYKEY_NOTFOUND']="Primary key not found";
$lang['L_PROCESSKILL1']="The script tries to kill process";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="The script tries since";
$lang['L_PROCESSKILL4']="sec. to kill the process";
$lang['L_PROCESS_ID']="Process ID";
$lang['L_PROGRESS_FILE']="Progress file";
$lang['L_PROGRESS_OVER_ALL']="Overall Progress";
$lang['L_PROGRESS_TABLE']="Progress of table";
$lang['L_PROVIDER']="Provider";
$lang['L_PROZESSE']="Processes";
$lang['L_QUERY']="Query";
$lang['L_QUERY_TYPE']="Query type";
$lang['L_RECHTE']="Permissions";
$lang['L_RECORDS']="Records";
$lang['L_RECORDS_INSERTED']="<b>%s</b> records inserted.";
$lang['L_RECORDS_OF_TABLE']="Records of table";
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
$lang['L_RELOAD']="Reload";
$lang['L_REMOVE']="Remove";
$lang['L_REPAIR']="Repair";
$lang['L_RESET']="Reset";
$lang['L_RESET_SEARCHWORDS']="reset search words";
$lang['L_RESTORE']="Restore";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> tables created.";
$lang['L_RESTORE_DB']="Database '<b>%s</b>' on '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Restoring of database '%s' finished in"
    ." %s.";
$lang['L_RESTORE_OF_TABLES']="Choose tables to be restored";
$lang['L_RESTORE_TABLE']="Restoring of table '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Up to now <b>%d</b> of <b>%d</b>"
    ." tables were created.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Up to now <b>%d</b> tables were"
    ." created.";
$lang['L_RESULT']="Result";
$lang['L_REVERSE']="Last entry first";
$lang['L_SAFEMODEDESC']="Because PHP is running in safe_mode"
    ." you need to create the following"
    ." directories manually using your"
    ." FTP-Programm:";
$lang['L_SAVE']="Save";
$lang['L_SAVEANDCONTINUE']="Save and continue installation";
$lang['L_SAVE_ERROR']="Error - unable to save configuration!";
$lang['L_SAVE_SUCCESS']="Configuration was saved succesfully"
    ." into configuration file \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Saving data of database '%s' to file"
    ." '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximum filesize reached: proceeding"
    ." with file '%s'";
$lang['L_SAVING_DB_FORM']="Database";
$lang['L_SAVING_TABLE']="Saving table";
$lang['L_SEARCH_ACCESS_KEYS']="Browse: forward=ALT+V, backwards=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Search in table";
$lang['L_SEARCH_NO_RESULTS']="The search for \"<b>%s</b>\" in table"
    ." \"<b>%s</b>\" doesn't bring any hits!";
$lang['L_SEARCH_OPTIONS']="Search options";
$lang['L_SEARCH_OPTIONS_AND']="a column must contain all search words"
    ." (AND-search)";
$lang['L_SEARCH_OPTIONS_CONCAT']="a row must contain all of the search"
    ." words but they can be in any column"
    ." (could take some time)";
$lang['L_SEARCH_OPTIONS_OR']="a column must have one of the search"
    ." words (OR-search)";
$lang['L_SEARCH_RESULTS']="The search for \"<b>%s</b>\" in table"
    ." \"<b>%s</b>\" brings the following"
    ." results";
$lang['L_SECOND']="Second";
$lang['L_SECONDS']="Seconds";
$lang['L_SELECT']="Select";
$lang['L_SELECTED_FILE']="Selected file";
$lang['L_SELECT_ALL']="Select All";
$lang['L_SELECT_FILE']="Select file";
$lang['L_SELECT_LANGUAGE']="Select language";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="send result as file";
$lang['L_SEND_MAIL_FORM']="Send email report";
$lang['L_SERVER']="Server";
$lang['L_SERVERCAPTION']="Display Server";
$lang['L_SETPRIMARYKEYSFOR']="Set new primary keys for table";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Showing entry %s to %s of %s";
$lang['L_SHOWRESULT']="show result";
$lang['L_SHOW_TABLES']="Show tables";
$lang['L_SHOW_TOOLTIPS']="Show nicer tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-Host";
$lang['L_SMTP_PORT']="SMTP-Port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Speed";
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
$lang['L_SQL_ATTRIBUTES']="Attributes";
$lang['L_SQL_BACKDBOVERVIEW']="Back to Overview";
$lang['L_SQL_BEFEHLNEU']="New command";
$lang['L_SQL_BEFEHLSAVED1']="SQL Command";
$lang['L_SQL_BEFEHLSAVED2']="was added";
$lang['L_SQL_BEFEHLSAVED3']="was saved";
$lang['L_SQL_BEFEHLSAVED4']="was moved up";
$lang['L_SQL_BEFEHLSAVED5']="was deleted";
$lang['L_SQL_BROWSER']="SQL-Browser";
$lang['L_SQL_CARDINALITY']="Cardinality";
$lang['L_SQL_CHANGED']="was changed.";
$lang['L_SQL_CHANGEFIELD']="change field";
$lang['L_SQL_CHOOSEACTION']="Choose action";
$lang['L_SQL_COLLATENOTMATCH']="Charset and Collation don't fit"
    ." together!";
$lang['L_SQL_COLUMNS']="Columns";
$lang['L_SQL_COMMANDS']="SQL Commands";
$lang['L_SQL_COMMANDS_IN']="lines in";
$lang['L_SQL_COMMANDS_IN2']="sec. parsed.";
$lang['L_SQL_COPYDATADB']="Copy complete Database to";
$lang['L_SQL_COPYSDB']="Copy Structure of Database";
$lang['L_SQL_COPYTABLE']="copy table";
$lang['L_SQL_CREATED']="was created.";
$lang['L_SQL_CREATEINDEX']="create new index";
$lang['L_SQL_CREATETABLE']="create table";
$lang['L_SQL_DATAVIEW']="Data View";
$lang['L_SQL_DBCOPY']="The Content of Database `%s` was"
    ." copied in Database `%s`.";
$lang['L_SQL_DBSCOPY']="The Structure of Database `%s` was"
    ." copied in Database `%s`.";
$lang['L_SQL_DELETED']="was deleted";
$lang['L_SQL_DESTTABLE_EXISTS']="Destination Table exists !";
$lang['L_SQL_EDIT']="edit";
$lang['L_SQL_EDITFIELD']="Edit field";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Edit table structure";
$lang['L_SQL_EMPTYDB']="Empty Database";
$lang['L_SQL_ERROR1']="Error in Query:";
$lang['L_SQL_ERROR2']="MySQL says:";
$lang['L_SQL_EXEC']="Execute SQL Statement";
$lang['L_SQL_EXPORT']="Export from Database `%s`";
$lang['L_SQL_FIELDDELETE1']="The Field";
$lang['L_SQL_FIELDNAMENOTVALID']="Error: No valid fieldname";
$lang['L_SQL_FIRST']="first";
$lang['L_SQL_IMEXPORT']="Import-Export";
$lang['L_SQL_IMPORT']="Import in Database `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: incomplete statement detected.<br"
    ." />Couldn't find closing match for '%s'"
    ." in query:<br />%s";
$lang['L_SQL_INDEXES']="Indices";
$lang['L_SQL_INSERTFIELD']="insert field";
$lang['L_SQL_INSERTNEWFIELD']="insert new field";
$lang['L_SQL_LIBRARY']="SQL Library";
$lang['L_SQL_NAMEDEST_MISSING']="Name of Destination is missing !";
$lang['L_SQL_NEWFIELD']="New field";
$lang['L_SQL_NODATA']="no records";
$lang['L_SQL_NODEST_COPY']="No Copy without Destination !";
$lang['L_SQL_NOFIELDDELETE']="Delete is not possible because Tables"
    ." must contain at least one field.";
$lang['L_SQL_NOTABLESINDB']="No tables found in Database";
$lang['L_SQL_NOTABLESSELECTED']="No tables selected !";
$lang['L_SQL_OPENFILE']="Open SQL-File";
$lang['L_SQL_OPENFILE_BUTTON']="Upload";
$lang['L_SQL_OUT1']="Executed";
$lang['L_SQL_OUT2']="Commands";
$lang['L_SQL_OUT3']="It had";
$lang['L_SQL_OUT4']="Comments";
$lang['L_SQL_OUT5']="Because the output contains more than"
    ." 5000 lines it isn't displayed.";
$lang['L_SQL_OUTPUT']="SQL Output";
$lang['L_SQL_QUERYENTRY']="The Query contains";
$lang['L_SQL_RECORDDELETED']="Record was deleted";
$lang['L_SQL_RECORDEDIT']="edit record";
$lang['L_SQL_RECORDINSERTED']="Record was added";
$lang['L_SQL_RECORDNEW']="new record";
$lang['L_SQL_RECORDUPDATED']="Record was updated";
$lang['L_SQL_RENAMEDB']="Rename Database";
$lang['L_SQL_RENAMEDTO']="was renamed to";
$lang['L_SQL_SCOPY']="Table structure of `%s` was copied in"
    ." Table `%s`.";
$lang['L_SQL_SEARCH']="Search";
$lang['L_SQL_SEARCHWORDS']="Searchword(s)";
$lang['L_SQL_SELECTTABLE']="select table";
$lang['L_SQL_SERVER']="SQL-Server";
$lang['L_SQL_SHOWDATATABLE']="Show Data of Table";
$lang['L_SQL_STRUCTUREDATA']="Structure and Data";
$lang['L_SQL_STRUCTUREONLY']="Only Structure";
$lang['L_SQL_TABLEEMPTIED']="Table `%s` was deleted.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="Table `%s` was deleted and the indices"
    ." were reset.";
$lang['L_SQL_TABLEINDEXES']="Indexes of table";
$lang['L_SQL_TABLENEW']="Edit Tables";
$lang['L_SQL_TABLENOINDEXES']="No Indexes in Table";
$lang['L_SQL_TABLENONAME']="Table needs a name!";
$lang['L_SQL_TABLESOFDB']="Tables of Database";
$lang['L_SQL_TABLEVIEW']="Table View";
$lang['L_SQL_TBLNAMEEMPTY']="Table name can't be empty!";
$lang['L_SQL_TBLPROPSOF']="Table properties of";
$lang['L_SQL_TCOPY']="Table `%s` was copied with data in"
    ." Table `%s`.";
$lang['L_SQL_UPLOADEDFILE']="loaded file:";
$lang['L_SQL_VIEW_COMPACT']="View: compact";
$lang['L_SQL_VIEW_STANDARD']="View: standard";
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
$lang['L_STEP']="Step";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="Configuration file \"%s\" has"
    ." successfully been created.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="The configuration file \"%s\" has"
    ." successfully been deleted.";
$lang['L_SUM_TOTAL']="Sum";
$lang['L_TABLE']="Table";
$lang['L_TABLENAME']="Table name";
$lang['L_TABLENAME_EXPLAIN']="Table name";
$lang['L_TABLES']="Tables";
$lang['L_TABLESELECTION']="Table selection";
$lang['L_TABLE_CREATE_SUCC']="The table '%s' has been created"
    ." successfully.";
$lang['L_TABLE_TYPE']="Table Type";
$lang['L_TESTCONNECTION']="Test Connection";
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
$lang['L_TO']="to";
$lang['L_TOOLS']="Tools";
$lang['L_TOOLS_TOOLBOX']="Select Database / Datebase functions /"
    ." Import - Export";
$lang['L_TRUNCATE']="Truncate";
$lang['L_TRUNCATE_DATABASE']="Truncate database";
$lang['L_UNIT_KB']="KiloByte";
$lang['L_UNIT_MB']="MegaByte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="unknown";
$lang['L_UNKNOWN_SQLCOMMAND']="unknown SQL-Command";
$lang['L_UPDATE']="Update";
$lang['L_UPDATE_CONNECTION_FAILED']="Update failed because connection to"
    ." server '%s' could not be established.";
$lang['L_UPDATE_ERROR_RESPONSE']="Update failed, server returned: '%s'";
$lang['L_UPTO']="up to";
$lang['L_USERNAME']="Username";
$lang['L_USE_SSL']="Use SSL";
$lang['L_VALUE']="Value";
$lang['L_VERSIONSINFORMATIONEN']="Version Information";
$lang['L_VIEW']="view";
$lang['L_VISIT_HOMEPAGE']="Visit Homepage";
$lang['L_VOM']="from";
$lang['L_WITH']="with";
$lang['L_WITHATTACH']="with attach";
$lang['L_WITHOUTATTACH']="without attach";
$lang['L_WITHPRAEFIX']="with prefix";
$lang['L_WRONGCONNECTIONPARS']="Connection parameters wrong or"
    ." missing!";
$lang['L_WRONG_CONNECTIONPARS']="Connection parameters are wrong !";
$lang['L_WRONG_RIGHTS']="The file or the directory '%s' is not"
    ." writable for me. The rights (chmod)"
    ." are not set properly or it has the"
    ." wrong owner.<br /><br />Please set the"
    ." correct attributes using your FTP"
    ." program. The file or the directory"
    ." needs to be set to %s.";
$lang['L_YES']="yes";
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
    ." (local-part@domain.tld) is invalid.";
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
$lang['L_ZEND_ID_HOSTNAME_CANNOT_DECODE_PUNYCODE']="The given punycode notation of the"
    ." hostname cannot be decoded.";
$lang['L_ZEND_ID_HOSTNAME_DASH_CHARACTER']="The hostname contains a dash in an"
    ." invalid position.";
$lang['L_ZEND_ID_HOSTNAME_INVALID']="Invalid type given. String expected.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME']="The hostname does not match the"
    ." expected structure.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME_SCHEMA']="The hostname cannot match against"
    ." schema for given TLD.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_LOCAL_NAME']="The hostname contains an invalid local"
    ." network name.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_URI']="The hostname does not match the URI"
    ." syntax.";
$lang['L_ZEND_ID_HOSTNAME_IP_ADDRESS_NOT_ALLOWED']="IP addresses in hostnames are not"
    ." allowed.";
$lang['L_ZEND_ID_HOSTNAME_LOCAL_NAME_NOT_ALLOWED']="Local network names in hostnames are"
    ." not allowed.";
$lang['L_ZEND_ID_HOSTNAME_UNDECIPHERABLE_TLD']="Cannot extract TLD part from hostname.";
$lang['L_ZEND_ID_HOSTNAME_UNKNOWN_TLD']="The hostname contains unknown TLD.";
$lang['L_ZEND_ID_IS_EMPTY']="Value is required and can't be empty.";
$lang['L_ZEND_ID_MISSING_TOKEN']="No token was provided to match"
    ." against.";
$lang['L_ZEND_ID_NOT_DIGITS']="Only digits are allowed.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Invalid type given. String, integer,"
    ." float, boolean or array expected.";
$lang['L_ZEND_ID_NOT_SAME']="The two given tokens do not match.";
return $lang;
