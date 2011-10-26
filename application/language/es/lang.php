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
$lang['L_ACTION']="Acción";
$lang['L_ACTIVATED']="activo";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Hasta el momento, se han añadido con"
    ." éxito <b>%s</b> registros.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Hasta ahora se han añadido con éxito"
    ." <b>%s</b> de <b>%s</b> registros.";
$lang['L_ADD']="Añadir";
$lang['L_ADDED']="añadido";
$lang['L_ADD_DB_MANUALLY']="Añadir base de datos manualmente";
$lang['L_ADD_RECIPIENT']="Añadir destinatario";
$lang['L_ALL']="todos";
$lang['L_ANALYZE']="Analizar";
$lang['L_ANALYZING_TABLE']="Ahora se están analizando los datos"
    ." de la tabla '<b>%s</b>'.";
$lang['L_ASKDBCOPY']="¿Desea copiar el contenido de la base"
    ." de datos `%s` a la base de datos `%s`?";
$lang['L_ASKDBDELETE']="¿Desea realmente eliminar la base de"
    ." datos `%s` así como todo su"
    ." contenido?";
$lang['L_ASKDBEMPTY']="¿Desea realmente vaciar la base de"
    ." datos `%s` ?";
$lang['L_ASKDELETEFIELD']="¿Desea eliminar el campo?";
$lang['L_ASKDELETERECORD']="¿Realmente desea eliminar este"
    ." registro?";
$lang['L_ASKDELETETABLE']="¿Debería ser eliminada la tabla"
    ." `%s`?";
$lang['L_ASKTABLEEMPTY']="¿Debería ser vaciada la tabla `%s`?";
$lang['L_ASKTABLEEMPTYKEYS']="¿Debería ser vaciada la tabla `%s` y"
    ." reseteados sus índices?";
$lang['L_ATTACHED_AS_FILE']="adjunto como un archivo";
$lang['L_ATTACH_BACKUP']="Adjuntar copia de seguridad";
$lang['L_AUTHENTICATE']="Información de acceso";
$lang['L_AUTHORIZE']="Autorizar";
$lang['L_AUTODELETE']="Eliminación automática de las copias"
    ." de seguridad";
$lang['L_BACK']="atrás";
$lang['L_BACKUPFILESANZAHL']="En el directorio de copias de"
    ." seguridad se encuentran";
$lang['L_BACKUPS']="Copias de seguridad";
$lang['L_BACKUP_DBS']="BB.DD. a copiar";
$lang['L_BACKUP_TABLE_DONE']="Completado el volcado de la tabla"
    ." `%s`. Se almacenaron %s registros.";
$lang['L_BACK_TO_OVERVIEW']="Información general de la base de"
    ." datos";
$lang['L_CALL']="Llamar";
$lang['L_CANCEL']="Cancelar";
$lang['L_CANT_CREATE_DIR']="No se pudo crear el directorio"
    ." '%s'.<br />Cree este directorio"
    ." manualmente utilizando un programa de"
    ." FTP.";
$lang['L_CHANGE']="Cambiar";
$lang['L_CHANGEDIR']="Cambiando al directorio";
$lang['L_CHANGEDIRERROR']="¡No se ha podido cambiar de"
    ." directorio!";
$lang['L_CHARSET']="Juego de carácteres";
$lang['L_CHARSETS']="Juego de carácteres";
$lang['L_CHECK']="Comprobar";
$lang['L_CHECK_DIRS']="Comprobar mis directorios";
$lang['L_CHOOSE_CHARSET']="MySQLDumper no pudo detectar la"
    ." codificación de los archivos de la"
    ." copia de seguridad de forma"
    ." automática.<br /><br />Usted debe"
    ." elegir el conjunto de caracteres con"
    ." el que se guardó la copia de"
    ." seguridad.<br /><br />Si usted"
    ." descubre algún problema con algunos"
    ." caracteres después de la"
    ." restauración, puede repetir la"
    ." restauración de la copia de seguridad"
    ." con otro conjunto de caracteres. <br"
    ." /><br />Buena suerte. ;)";
$lang['L_CHOOSE_DB']="Elegir base de datos";
$lang['L_CLEAR_DATABASE']="Vaciar base de datos";
$lang['L_CLOSE']="Cerrar";
$lang['L_COLLATION']="Ordenación";
$lang['L_COMMAND']="comando";
$lang['L_COMMAND_AFTER_BACKUP']="Comando después de seguridad";
$lang['L_COMMAND_BEFORE_BACKUP']="Comando antes de seguridad";
$lang['L_COMMENT']="Comentario";
$lang['L_COMPRESSED']="comprimido (gz)";
$lang['L_CONFBASIC']="Propiedades básicas";
$lang['L_CONFIG']="Configuración";
$lang['L_CONFIGFILE']="Archivo de configuración";
$lang['L_CONFIGFILES']="Archivos de configuración";
$lang['L_CONFIGURATIONS']="Configuraciones";
$lang['L_CONFIG_AUTODELETE']="Eliminación automática";
$lang['L_CONFIG_CRONPERL']="Propiedades de Crondump como script"
    ." perl";
$lang['L_CONFIG_EMAIL']="Notificación por correo electrónico";
$lang['L_CONFIG_FTP']="Transferencia por FTP de las copias de"
    ." seguridad";
$lang['L_CONFIG_HEADLINE']="Configuración";
$lang['L_CONFIG_INTERFACE']="Interfaz";
$lang['L_CONFIG_LOADED']="La configuración \"%s\" se importó"
    ." correctamente.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="¿Está seguro de que desea borrar el"
    ." archivo de configuración %s?";
$lang['L_CONFIRM_DELETE_FILE']="Quieres realmente eliminar el fichero"
    ." seleccionado?";
$lang['L_CONFIRM_DELETE_TABLES']="Quieres realmente eliminar las tablas"
    ." seleccionadas?";
$lang['L_CONFIRM_DROP_DATABASES']="Quieres realmente eliminar la(s)"
    ." base(s) de datos seleccionada(s)?"
    ." Nota: Todas los datos seran perdido"
    ." irrevocablemente! Por favor crea antes"
    ." una copia de seguridad de los datos";
$lang['L_CONFIRM_RECIPIENT_DELETE']="El destinatario \"%s\" debería ser"
    ." borrado?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Quieres realmente vaciar la(s) base(s)"
    ." de datos seleccionada(s)?<br />Nota:"
    ." Todas las tablas seran perdido"
    ." irrevocablemente! Por favor crea antes"
    ." una copia de seguridad de los datos<br"
    ." />";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Realmente claro las tablas"
    ." seleccionadas?";
$lang['L_CONNECT']="conectar";
$lang['L_CONNECTIONPARS']="Parámetros de conexión";
$lang['L_CONNECTTOMYSQL']="Conectarse a MySQL";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continuar recuperació multiplo por el"
    ." siguiente archivo '%s'.";
$lang['L_CONVERTED_FILES']="Archivos convertidos";
$lang['L_CONVERTER']="Copia de seguridad-Conversor";
$lang['L_CONVERTING']="La conversión";
$lang['L_CONVERT_FILE']="archivo que se convertirá";
$lang['L_CONVERT_FILENAME']="Nombre del archivo de destino (sin"
    ." extensión)";
$lang['L_CONVERT_FILEREAD']="Leyendo el archivo '%s'";
$lang['L_CONVERT_FINISHED']="Conversión finalizada: '%s' se ha"
    ." guardado correctamente.";
$lang['L_CONVERT_START']="Iniciar conversión";
$lang['L_CONVERT_TITLE']="Convertir copia de seguridad al"
    ." formato MSD";
$lang['L_CONVERT_WRONG_PARAMETERS']="¡Parámetros incorrectos!  La"
    ." conversión no es posible.";
$lang['L_CREATE']="crear";
$lang['L_CREATED']="Creado";
$lang['L_CREATEDIRS']="Directorios creados";
$lang['L_CREATE_AUTOINDEX']="Crear índice automático";
$lang['L_CREATE_CONFIGFILE']="Crear un nuevo archivo de"
    ." configuración";
$lang['L_CREATE_DATABASE']="Crear nueva base de datos";
$lang['L_CREATE_TABLE_SAVED']="Definición de la tabla `% s"
    ." 'guardado.";
$lang['L_CREDITS']="Créditos / Ayuda";
$lang['L_CRONSCRIPT']="Script Cron";
$lang['L_CRON_COMMENT']="Escriba un comentario";
$lang['L_CRON_COMPLETELOG']="Registrar todas las operaciones";
$lang['L_CRON_EXECPATH']="Camino del script cron";
$lang['L_CRON_EXTENDER']="Extensión de nombre de archivo";
$lang['L_CRON_PRINTOUT']="Salida de texto";
$lang['L_CSVOPTIONS']="Opciones CSV";
$lang['L_CSV_EOL']="separar líneas con";
$lang['L_CSV_ERRORCREATETABLE']="¡Error al crear la tabla `%s`!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="El número de campos no coincide con"
    ." el de los datos a importar (%d en vez"
    ." de  %d).";
$lang['L_CSV_FIELDSENCLOSED']="Campos delimitados por";
$lang['L_CSV_FIELDSEPERATE']="Campos separados por";
$lang['L_CSV_FIELDSESCAPE']="Campos 'escapeados' con";
$lang['L_CSV_FIELDSLINES']="%d campos reconocidos, totalizando %d"
    ." líneas";
$lang['L_CSV_FILEOPEN']="abrir fichero CSV";
$lang['L_CSV_NAMEFIRSTLINE']="Nombres de campo en la primera línea";
$lang['L_CSV_NODATA']="¡No se han encontrado datos que"
    ." importar!";
$lang['L_CSV_NULL']="reemplazar NULL con";
$lang['L_DATABASES_OF_USER']="Databases de usuario";
$lang['L_DATABASE_CREATED_FAILED']="The database wasn't created.<br"
    ." />MySQL returns:<br/><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="The database '%s' has been created"
    ." successfully.";
$lang['L_DATASIZE']="Tamaño de los datos";
$lang['L_DATASIZE_INFO']="Este es el tamaño de los datos"
    ." contenidos en la base de datos, no el"
    ." tamaño del file de backup.";
$lang['L_DAY']="Día";
$lang['L_DAYS']="Días";
$lang['L_DB']="Base de datos";
$lang['L_DBCONNECTION']="Conexión a la base de datos";
$lang['L_DBPARAMETER']="Parámetros de la base de datos";
$lang['L_DBS']="Bases de datos";
$lang['L_DB_ADAPTER']="Adaptador de BB.DD.";
$lang['L_DB_BACKUPPARS']="Propiedades de la copia de seguridad"
    ." de la base de datos";
$lang['L_DB_DEFAULT']="Default database";
$lang['L_DB_HOST']="Servidor de base de datos";
$lang['L_DB_IN_LIST']="La base de datos '%s' no se podría"
    ." añadir porque ya existe.";
$lang['L_DB_NAME']="Nombre de la base de datos";
$lang['L_DB_PASS']="Contraseña";
$lang['L_DB_SELECT_ERROR']="<br />Error:<br />La selección de la"
    ." base de datos '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' ha fallado!";
$lang['L_DB_USER']="Usuario";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Conjunto de caracteres por defecto";
$lang['L_DEFAULT_CHARSET']="Conjunto de caracteres por defecto";
$lang['L_DEFAULT_COLLATION_NAME']="Colación por defecto";
$lang['L_DELETE']="Eliminar";
$lang['L_DELETE_DATABASE']="Eliminar base de datos";
$lang['L_DELETE_FILE_ERROR']="¡No fue posible borrar el archivo"
    ." \"%s\"!";
$lang['L_DELETE_FILE_SUCCESS']="El archivo \"%s\" se ha eliminado con"
    ." éxito.";
$lang['L_DELETE_HTACCESS']="Quitar la protección de directorio"
    ." (eliminar .htaccess)";
$lang['L_DESCRIPTION']="Description";
$lang['L_DESELECT_ALL']="seleccionar todas";
$lang['L_DIR']="Directorio";
$lang['L_DISABLEDFUNCTIONS']="Funciones deshabilitadas";
$lang['L_DO']="iniciar";
$lang['L_DOCRONBUTTON']="Ejecutar Cronscript Perl";
$lang['L_DONE']="Finalizado!";
$lang['L_DONT_ATTACH_BACKUP']="No adjuntar copia de seguridad";
$lang['L_DOPERLTEST']="Comprobar Módulos Perl";
$lang['L_DOSIMPLETEST']="Comprobar Perl";
$lang['L_DOWNLOAD_FILE']="Descargos ficheros";
$lang['L_DO_NOW']="ejecutar ahora";
$lang['L_DUMP']="Copia de seguridad";
$lang['L_DUMP_ENDERGEBNIS']="<b>%s</b> Tablas con un total de"
    ." <b>%s</b> registros, han sido"
    ." guardadas con éxito.<br />";
$lang['L_DUMP_FILENAME']="Archivo de backup";
$lang['L_DUMP_HEADLINE']="Creando copia de seguridad...";
$lang['L_DUMP_NOTABLES']="No se han encontrado tablas en la base"
    ." de datos `%s`";
$lang['L_DUMP_OF_DB_FINISHED']="Descarga de database se `%s` hecho";
$lang['L_DURATION']="Duración";
$lang['L_EDIT']="editar";
$lang['L_EHRESTORE_CONTINUE']="informar de los errores y seguir";
$lang['L_EHRESTORE_STOP']="detenerse";
$lang['L_EMAIL']="Correo electrónico";
$lang['L_EMAILBODY_ATTACH']="En el fichero adjunto encontrará la"
    ." copia de seguridad de su base de datos"
    ." MySQL.<br />Copia de seguridad de la"
    ." base de datos `%s`<br /><br /><br />Se"
    ." ha creado el siguiente archivo:<br"
    ." /><br />%s <br /><br /><br />Saludos"
    ." de<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="Se ha realizado un backup de archivos"
    ." múltiples.<br />Los archivos se"
    ." adjuntan a emails separados!<br"
    ." />Copia de seguridad de la base de"
    ." datos `%s`<br /><br /><br />Los"
    ." siguientes archivos han sido"
    ." adjuntados:<br /><br />%s <br /><br"
    ." /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="Se ha realizado un backup de archivos"
    ." múltiples.<br />Los archivos no se"
    ." adjuntan a este email!<br />Copia de"
    ." seguridad de la base de datos `%s`<br"
    ." /><br /><br />Los siguientes archivos"
    ." han sido adjuntados:<br /><br />%s<br"
    ." /><br /><br /><br />Saludos de<br"
    ." /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="No se adjunta el archivo de copia de"
    ." seguridad.<br />Copia de seguridad de"
    ." la base de datos `%s`<br /><br /><br"
    ." />Se ha creado el siguiente"
    ." archivo:<br /><br />%s <br /><br /><br"
    ." />Saludos de<br /><br />MySQLDumper<br"
    ." />";
$lang['L_EMAILBODY_TOOBIG']="La copia de seguridad ha sobrepasado"
    ." el tamaño máximo de %s y por lo"
    ." tanto no ha sido adjuntada.<br />Copia"
    ." de seguridad de la base de datos"
    ." `%s`<br /><br /><br />Se ha creado el"
    ." siguiente archivo:<br /><br />%s <br"
    ." /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="Correo electrónico";
$lang['L_EMAIL_CC']="Destinatarios en copia (CC)";
$lang['L_EMAIL_MAXSIZE']="Tamaño máximo del fichero adjunto";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... solamente el fichero adjunto";
$lang['L_EMAIL_RECIPIENT']="Destinatario";
$lang['L_EMAIL_SENDER']="Remitente";
$lang['L_EMAIL_START']="Iniciar el envío de e-mail";
$lang['L_EMAIL_WAS_SEND']="Se ha enviado un email a";
$lang['L_EMPTY']="Vaciar";
$lang['L_EMPTYKEYS']="vaciar y resetear los índices";
$lang['L_EMPTYTABLEBEFORE']="Vaciar la tabla antes de la operación";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Vaciar la base de datos antes de"
    ." recuperar los valores";
$lang['L_ENCODING']="Codificación";
$lang['L_ENCRYPTION_TYPE']="Tipo de encriptación";
$lang['L_ENGINE']="Máquina";
$lang['L_ENTER_DB_INFO']="Primero haga clic en el botón"
    ." \"Conectarse a MySQL\". Sólo si no"
    ." hay base de datos podría ser"
    ." detectado es necesario proporcionar un"
    ." nombre de base de datos aquí.";
$lang['L_ENTRY']="Registro";
$lang['L_ERROR']="Error";
$lang['L_ERRORHANDLING_RESTORE']="Tratamiento de los errores en la"
    ." recuperación de datos";
$lang['L_ERROR_CONFIGFILE_NAME']="El nombre del archivo \"%s\" contiene"
    ." caracteres no válidos.";
$lang['L_ERROR_DELETING_CONFIGFILE']="¡Error: el archivo de configuración"
    ." %s no ha podido ser eliminado!";
$lang['L_ERROR_LOADING_CONFIGFILE']="No se pudo cargar el archivo de"
    ." configuración \"%s\".";
$lang['L_ERROR_LOG']="Archivo de registro de errores";
$lang['L_ERROR_MULTIPART_RESTORE']="Restablecimiento múltiple: No se"
    ." puede encontrar el siguiente archivo"
    ." '%s'!";
$lang['L_ESTIMATED_END']="Estimada de cierre";
$lang['L_EXCEL2003']="Excel a partir de la versión 2003";
$lang['L_EXISTS']="Existe";
$lang['L_EXPORT']="Exportar";
$lang['L_EXPORTFINISHED']="Exportación finalizada.";
$lang['L_EXPORTLINES']="<strong>%s</strong> líneas exportadas";
$lang['L_EXPORTOPTIONS']="Opciones de exportación";
$lang['L_EXTENDEDPARS']="Parámetros extendidos";
$lang['L_FADE_IN_OUT']="Mostrar/ocultar";
$lang['L_FATAL_ERROR_DUMP']="¡Error fatal: las instrucciones para"
    ." crear la tabla '%s' en la base de"
    ." datos '%s' no se pueden leer!";
$lang['L_FIELDS']="Campos";
$lang['L_FIELDS_OF_TABLE']="Campos de la tabla";
$lang['L_FILE']="Archivo";
$lang['L_FILES']="Archivos";
$lang['L_FILESIZE']="Tamaño de archivo";
$lang['L_FILE_MANAGE']="Archivos";
$lang['L_FILE_OPEN_ERROR']="Error: no he podido abrir el fichero.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="El archivo se ha guardado"
    ." correctamente.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="El archivo no puede ser salvado!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="El archivo '%s' se subido"
    ." correctamente.";
$lang['L_FILTER_BY']="Filtrar por";
$lang['L_FM_ALERTRESTORE1']="¿Desea llenar la base de datos";
$lang['L_FM_ALERTRESTORE2']="con el contenido del archivo";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="Lista de todas las copias de seguridad";
$lang['L_FM_ANZ_BU']="cantidad de copias de seguridad";
$lang['L_FM_ASKDELETE1']="Desea realmente eliminar el archivo";
$lang['L_FM_ASKDELETE2']="en serio borrar?";
$lang['L_FM_ASKDELETE3']="¿Desea ejecutar el borrado"
    ." automático según las reglas"
    ." especificadas?";
$lang['L_FM_ASKDELETE4']="¿Desea eliminar todos los archivos de"
    ." copia de seguridad?";
$lang['L_FM_ASKDELETE5']="¿Desea eliminar todos los archivos"
    ." con el prefijo";
$lang['L_FM_ASKDELETE5_2']="*?";
$lang['L_FM_AUTODEL1']="Eliminado automático: Los siguientes"
    ." archivos han sido eliminados al"
    ." superarse la cantidad máxima de"
    ." ficheros:";
$lang['L_FM_CHOOSE_ENCODING']="Seleccione la codificación de la"
    ." copia de seguridad";
$lang['L_FM_COMMENT']="Enter Comment";
$lang['L_FM_DELETE']="Eliminar";
$lang['L_FM_DELETE1']="El archivo";
$lang['L_FM_DELETE2']="ha sido eliminado.";
$lang['L_FM_DELETE3']="no ha podido ser eliminado!";
$lang['L_FM_DELETEALL']="eliminar todas las copias de seguridad";
$lang['L_FM_DELETEALLFILTER']="eliminar todos los archivos con";
$lang['L_FM_DELETEAUTO']="Ejecutar borrado automático"
    ." manualmente";
$lang['L_FM_DUMPSETTINGS']="Propiedades de la copia de seguridad";
$lang['L_FM_DUMP_HEADER']="Copia de seguridad";
$lang['L_FM_FILEDATE']="fecha";
$lang['L_FM_FILES1']="Copias de seguridad";
$lang['L_FM_FILESIZE']="Tamaño del fichero";
$lang['L_FM_FILEUPLOAD']="Subir archivo";
$lang['L_FM_FREESPACE']="Espacio libre en el servidor";
$lang['L_FM_LAST_BU']="última copia de seguridad";
$lang['L_FM_NOFILE']="No ha elegido ningún archivo!";
$lang['L_FM_NOFILESFOUND']="No se han encontrado archivos.";
$lang['L_FM_RECORDS']="registros";
$lang['L_FM_RESTORE']="Restaurar";
$lang['L_FM_RESTORE_HEADER']="Recuperación de la base de datos"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Selección de tablas";
$lang['L_FM_STARTDUMP']="Iniciar nueva copia de seguridad";
$lang['L_FM_TABLES']="tablas";
$lang['L_FM_TOTALSIZE']="Tamaño total";
$lang['L_FM_UPLOADFAILED']="¡El envío del archivo ha fallado!";
$lang['L_FM_UPLOADFILEEXISTS']="¡ Ya existe un archivo con este"
    ." nombre !";
$lang['L_FM_UPLOADFILEREQUEST']="Por favor, elija un archivo.";
$lang['L_FM_UPLOADMOVEERROR']="No se ha podido copiar el archivo"
    ." enviado al directorio correcto.";
$lang['L_FM_UPLOADNOTALLOWED1']="Esta clase de archivo no está"
    ." permitida.";
$lang['L_FM_UPLOADNOTALLOWED2']="Los tipos de archivo permitidos son:"
    ." *.gz y *.sql";
$lang['L_FOUND_DB']="Encontrada BB.DD.:";
$lang['L_FROMFILE']="de un fichero";
$lang['L_FROMTEXTBOX']="del campo de texto";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Agregar conexión";
$lang['L_FTP_CHOOSE_MODE']="Modo de transferencia FTP";
$lang['L_FTP_CONFIRM_DELETE']="Desea que esta conexión FTP séa"
    ." realmente eliminado?";
$lang['L_FTP_CONNECTION']="Conexión FTP";
$lang['L_FTP_CONNECTION_CLOSED']="Conexión FTP cerrado";
$lang['L_FTP_CONNECTION_DELETE']="Eliminar la conexión";
$lang['L_FTP_CONNECTION_ERROR']="Conexión con el servidor '%s', usando"
    ." el puerto %s, no se pudo evaluar";
$lang['L_FTP_CONNECTION_SUCCESS']="Conexión con el servidor '%s', usando"
    ." el puerto %s se ha establecido con"
    ." éxito";
$lang['L_FTP_DIR']="Directorio de subida";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Mal manejo de el file '%s'";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="El file '%s' fue transferido con"
    ." éxito";
$lang['L_FTP_LOGIN_ERROR']="Ha denegado el acceso del usuario '%s'";
$lang['L_FTP_LOGIN_SUCCESS']="Consultado el usuario '%s'";
$lang['L_FTP_OK']="La conexión se ha realizado"
    ." correctamente";
$lang['L_FTP_PASS']="Contraseña";
$lang['L_FTP_PASSIVE']="usar el modo de transferencia pasiva";
$lang['L_FTP_PASV_ERROR']="No se puede cambiar al modo pasivo!";
$lang['L_FTP_PASV_SUCCESS']="El cambio a modo pasivo, fue un"
    ." éxito!";
$lang['L_FTP_PORT']="Puerto";
$lang['L_FTP_SEND_TO']="para <strong>%s</strong><br />en"
    ." <strong>%s</s>";
$lang['L_FTP_SERVER']="Servidor";
$lang['L_FTP_SSL']="Conexión segura mediante SSL-FTP";
$lang['L_FTP_START']="Iniciar transferencia FTP";
$lang['L_FTP_TIMEOUT']="Cancelación de la conexión";
$lang['L_FTP_TRANSFER']="Transferencia FTP";
$lang['L_FTP_USER']="Usuario";
$lang['L_FTP_USESSL']="conexión SSL usada";
$lang['L_GENERAL']="Genéricas";
$lang['L_GZIP']="Compresión GZip";
$lang['L_GZIP_COMPRESSION']="La compresión GZip";
$lang['L_HOME']="Inicio";
$lang['L_HOUR']="Hora";
$lang['L_HOURS']="Horas";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Activar la reescritura";
$lang['L_HTACC_ADD_HANDLER']="Escriba el proveedor";
$lang['L_HTACC_CONFIRM_DELETE']="¿Desea crear ahora la protección del"
    ." directorio?";
$lang['L_HTACC_CONTENT']="Contenido del archivo";
$lang['L_HTACC_CREATE']="Crear protección de directorio";
$lang['L_HTACC_CREATED']="La protección del directorio ha sido"
    ." creada.";
$lang['L_HTACC_CREATE_ERROR']="Se ha producido un error al crear la"
    ." protección del directorio!<br />Por"
    ." favor, coloque en él el siguiente"
    ." archivo, con el contenido especificado";
$lang['L_HTACC_CRYPT']="Crypt máximo de 8 caracteres (Linux y"
    ." Unix)";
$lang['L_HTACC_DENY_ALLOW']="Denegar / Permitir";
$lang['L_HTACC_DIR_LISTING']="Listado de directorios";
$lang['L_HTACC_EDIT']="editar .htaccess";
$lang['L_HTACC_ERROR_DOC']="Documentos de error";
$lang['L_HTACC_EXAMPLES']="otros ejemplos y documentación";
$lang['L_HTACC_EXISTS']="Ya existe actualmente una protección"
    ." del directorio. ¡Si crea una nueva,"
    ." la antigua será sobreescrita!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Permitir ejecución";
$lang['L_HTACC_MD5']="MD5 (Linux y sistemas Unix)";
$lang['L_HTACC_NO_ENCRYPTION']="sin encriptación (Windows)";
$lang['L_HTACC_NO_USERNAME']="Debe darle un nombre!";
$lang['L_HTACC_PROPOSED']="¡Altamente recomendado";
$lang['L_HTACC_REDIRECT']="Redirecccionar";
$lang['L_HTACC_SCRIPT_EXEC']="Ejecutar script";
$lang['L_HTACC_SHA1']="SHA1 (todos los sistemas)";
$lang['L_HTACC_WARNING']="Nota! El fichero .htaccess influye"
    ." directamente el comportamiento de los"
    ." navegadores.<br />Si lo crea de forma"
    ." incorrecta, estas páginas no serán"
    ." accesibles.";
$lang['L_IMPORT']="Importar";
$lang['L_IMPORTIEREN']="Importar";
$lang['L_IMPORTOPTIONS']="Opciones de importación";
$lang['L_IMPORTSOURCE']="Origen de la importación";
$lang['L_IMPORTTABLE']="Importar a tabla";
$lang['L_IMPORT_NOTABLE']="¡No ha seleccionado ninguna tabla"
    ." para importar!";
$lang['L_IN']="en";
$lang['L_INDEX_SIZE']="Size of index";
$lang['L_INFO_ACTDB']="Base de datos actual";
$lang['L_INFO_DATABASES']="Las siguentes bases de datos se"
    ." encuentran en el servidor de MySQL";
$lang['L_INFO_DBEMPTY']="La base de datos está vacía !";
$lang['L_INFO_FSOCKOPEN_DISABLED']="En este servidor el comando fsockopen"
    ." () de PHP está deshabilitado por la"
    ." configuración del servidor. Debido a"
    ." esto los<br />descarga automática de"
    ." paquetes de idioma no es posible. Para"
    ." evitar esto, usted puede descargar"
    ." manualmente los paquetes, el extracto"
    ." de<br />en el plano local y cargarlas"
    ." en el directorio de \"lenguaje\" de la"
    ." instalación de MySQLDumper. Después,"
    ." el nuevo<br />paquete de idioma está"
    ." disponible en este sitio.";
$lang['L_INFO_LASTUPDATE']="última actualización";
$lang['L_INFO_LOCATION']="Se encuentra en";
$lang['L_INFO_NODB']="Base de datos inexistente";
$lang['L_INFO_NOPROCESSES']="no hay procesos corriendo";
$lang['L_INFO_NOSTATUS']="no hay estados disponibles";
$lang['L_INFO_NOVARS']="no hay variables disponibles";
$lang['L_INFO_OPTIMIZED']="optimizado";
$lang['L_INFO_RECORDS']="Registros";
$lang['L_INFO_SIZE']="Tamaño";
$lang['L_INFO_SUM']="Total";
$lang['L_INSTALL']="Instalación";
$lang['L_INSTALLED']="Instalado";
$lang['L_INSTALL_DB_DEFAULT']="Use as default database";
$lang['L_INSTALL_HELP_PORT']="(vacío = Puerto estándar)";
$lang['L_INSTALL_HELP_SOCKET']="(vacío = Socket estándar)";
$lang['L_IS_WRITABLE']="Se puede escribir";
$lang['L_KILL_PROCESS']="Detener el proceso";
$lang['L_LANGUAGE']="Idioma";
$lang['L_LANGUAGE_NAME']="Español";
$lang['L_LASTBACKUP']="Última copia de seguridad";
$lang['L_LOAD']="Cargar config. inicial.";
$lang['L_LOAD_DATABASE']="Refrescar la lista de BB.DD.";
$lang['L_LOAD_FILE']="Cargar archivo";
$lang['L_LOG']="Archivo de registro";
$lang['L_LOGFILENOTWRITABLE']="No se puede escribir en el archivo de"
    ." registro (log)!";
$lang['L_LOGFILES']="Archivos de registro";
$lang['L_LOGGED_IN']="Identificado";
$lang['L_LOGIN']="Iniciar sesión";
$lang['L_LOGIN_AUTOLOGIN']="Inicio de sesión automático";
$lang['L_LOGIN_INVALID_USER']="La dirección de correo electrónico o"
    ." la contraseña son incorrectas.";
$lang['L_LOGOUT']="Desconectarse";
$lang['L_LOG_CREATED']="Archivo de registro creado";
$lang['L_LOG_DELETE']="Eliminar fichero de historial (log)";
$lang['L_LOG_MAXSIZE']="Tamaño máximo de archivos log";
$lang['L_LOG_NOT_READABLE']="El archivo de registro '%s' no existe"
    ." o no es legible.";
$lang['L_MAILERROR']="Se ha producido un error al intentar"
    ." enviar el email!";
$lang['L_MAILPROGRAM']="Programa de correo electrónico";
$lang['L_MAXIMUM_LENGTH']="Maximum length";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="This is the maximum number of bytes"
    ." one character needs, when it is saved"
    ." to disk.";
$lang['L_MAXSIZE']="Tamaño máximo";
$lang['L_MAX_BACKUP_FILES_EACH2']="para cada base de datos";
$lang['L_MAX_EXECUTION_TIME']="Tiempo máximo de ejecución";
$lang['L_MAX_UPLOAD_SIZE']="Tamaño máximo del fichero";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Si el archivo de copia de seguridad es"
    ." mayor que el límite fijado, entonces"
    ." debe cargarlo a través de FTP en la"
    ." carpeta \"work/backup\". <br"
    ." />Después ese archivo se mostrará"
    ." aquí, y podrá ser elegido para"
    ." restaurar.";
$lang['L_MEMORY']="Memoria";
$lang['L_MENU_HIDE']="Ocultar el menú";
$lang['L_MENU_SHOW']="Mostrar el menú";
$lang['L_MESSAGE']="Mensaje";
$lang['L_MESSAGE_TYPE']="Tipo de mensaje";
$lang['L_MINUTE']="Minuto";
$lang['L_MINUTES']="Minutos";
$lang['L_MOBILE_OFF']="Off";
$lang['L_MOBILE_ON']="On";
$lang['L_MODE_EASY']="Sencillo";
$lang['L_MODE_EXPERT']="Experto";
$lang['L_MSD_INFO']="Información sobre MySQLDumper";
$lang['L_MSD_MODE']="Modo MySQLDumper";
$lang['L_MSD_VERSION']="Versión MySQLDumper";
$lang['L_MULTIDUMP']="Múltiple dump";
$lang['L_MULTIDUMP_FINISHED']="Copia de seguridad de <b>%d</b> bases"
    ." de datos resalizada";
$lang['L_MULTIPART_ACTUAL_PART']="Sub archivo actual";
$lang['L_MULTIPART_SIZE']="Tamaño máximo del archivo";
$lang['L_MULTI_PART']="Copia de seguridad en múltiples"
    ." archivos";
$lang['L_MYSQLVARS']="Variables de MySQL";
$lang['L_MYSQL_CLIENT_VERSION']="Cliente MySQL";
$lang['L_MYSQL_CONNECTION_ENCODING']="Codificación por defecto para"
    ." MySQL-Server";
$lang['L_MYSQL_DATA']="Datos MySQL";
$lang['L_MYSQL_ROUTINE']="Routine";
$lang['L_MYSQL_ROUTINES']="Routinen";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Stored functions and procedures";
$lang['L_MYSQL_TABLES_EXPLAIN']="Tables have a defined column structure"
    ." in which one can save data (records)."
    ." Each record represents a row in the"
    ." table.";
$lang['L_MYSQL_VERSION']="Versión MySQL";
$lang['L_MYSQL_VERSION_TOO_OLD']="Lo sentimos: La versión disponible de"
    ." MySQL %s es demasiado viejo y no se"
    ." puede utilizar junto con esta versión"
    ." de MySQLDumper. Por favor, actualice"
    ." la versión de MySQL, por lo menos s"
    ." versión %s o superior. Como"
    ." alternativa, puede utilizar la"
    ." versión 1.24 de MySQLDumper que"
    ." estaba compatible con mayores"
    ." servidores de MySQL. Pero usted va a"
    ." perder algunas de las nuevas"
    ." características de MySQLDumper.";
$lang['L_MYSQL_VIEW']="View";
$lang['L_MYSQL_VIEWS']="Views";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Views show (filtered) recordsets of"
    ." one ore more tables but don't contain"
    ." own records.";
$lang['L_NAME']="Nombre";
$lang['L_NEW']="nuevo";
$lang['L_NEWTABLE']="nueva tabla";
$lang['L_NEXT_AUTO_INCREMENT']="Próximo indice automático";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="n. indice automatico";
$lang['L_NO']="no";
$lang['L_NOFTPPOSSIBLE']="Las funciones de FTP no están"
    ." disponibles!";
$lang['L_NOGZPOSSIBLE']="Dado que Zlib no está instalado, no"
    ." puede usar las funciones de"
    ." compresión GZip!";
$lang['L_NONE']="ninguno";
$lang['L_NOREVERSE']="Mostrar las entradas más antiguas"
    ." primero";
$lang['L_NOTAVAIL']="<em>no disponible</em>";
$lang['L_NOTHING_TO_DO']="There is nothing to do.";
$lang['L_NOTICE']="Legal";
$lang['L_NOTICES']="Avisos";
$lang['L_NOT_ACTIVATED']="inactivo";
$lang['L_NOT_SUPPORTED']="Esta copia de seguridad no comprende"
    ." esta función.";
$lang['L_NO_DB_FOUND']="No pude encontrar ninguna base de"
    ." datos de forma automática! Por favor,"
    ." mostrar los parámetros de conexión,"
    ." e introduzca el nombre de su base de"
    ." datos manualmente.";
$lang['L_NO_DB_FOUND_INFO']="The connection to the database was"
    ." successfully established.<br /><br"
    ." />Your userdata is valid and was"
    ." accepted by the MySQL-Server.<br /><br"
    ." />But MySQLDumper was not able to find"
    ." any database.<br /><br />The automatic"
    ." detection via script is blocked on"
    ." some server.<br /><br />You must enter"
    ." your databasename manually after the"
    ." installation is finished.<br />Click"
    ." on \"configuration\" \"Connection"
    ." Parameter - display\" and enter the"
    ." databasename there.";
$lang['L_NO_DB_SELECTED']="No hay base de datos seleccionada.";
$lang['L_NO_ENTRIES']="La tabla \"<b>%s</b>\" está vacía y"
    ." no contiene ninguna entrada.";
$lang['L_NO_MSD_BACKUPFILE']="Copias de seguridad de otros programas";
$lang['L_NO_NAME_GIVEN']="No ha introducido un nombre.";
$lang['L_NR_OF_QUERIES']="Number of queries";
$lang['L_NR_OF_RECORDS']="Number of records";
$lang['L_NR_TABLES_OPTIMIZED']="%s tablas optimizadas.";
$lang['L_NUMBER_OF_FILES_FORM']="Cantidad de archivos de copia de"
    ." seguridad";
$lang['L_OF']="de";
$lang['L_OK']="Ok";
$lang['L_OPTIMIZE']="Optimizar";
$lang['L_OPTIMIZE_TABLES']="Optimizar las tablas antes de la copia"
    ." de seguridad";
$lang['L_OPTIMIZE_TABLE_ERR']="No se ha podido optimizar la tabla"
    ." `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="La tabla `%s` ha sido optimizado con"
    ." éxito.";
$lang['L_OS']="Sistema operativo";
$lang['L_OVERHEAD']="Sobresalir";
$lang['L_PAGE']="Página";
$lang['L_PAGE_REFRESHS']="Vistas de página";
$lang['L_PASS']="Password";
$lang['L_PASSWORD']="Contraseña";
$lang['L_PASSWORDS_UNEQUAL']="¡Las contraseñas no son idénticos o"
    ." vacíos!";
$lang['L_PASSWORD_REPEAT']="Contraseña (repetición)";
$lang['L_PASSWORD_STRENGTH']="Fortaleza de la contraseña";
$lang['L_PERLOUTPUT1']="Línea a escribir en crondump.pl para"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="Ejecutar desde el navegador o desde un"
    ." Cronjob externo al servidor";
$lang['L_PERLOUTPUT3']="Ejecutar desde Shell o como entrada en"
    ." Crontab";
$lang['L_PERL_COMPLETELOG']="Completo-Perl-Log";
$lang['L_PERL_LOG']="Archivos en Perl";
$lang['L_PHPBUG']="¡Bug en zlib! No es posible comprimir"
    ." archivos!";
$lang['L_PHPMAIL']="Función PHP mail()";
$lang['L_PHP_EXTENSIONS']="Extensiones de PHP";
$lang['L_PHP_LOG']="PHP-Log";
$lang['L_PHP_VERSION']="Versión PHP";
$lang['L_PHP_VERSION_TOO_OLD']="Lo sentimos: la versión de PHP es"
    ." demasiado viejo para ser capaz de"
    ." utilizar MySQLDumper. PHP debe ser en"
    ." la versión %s o más. La versión %s"
    ." de PHP instalada en este servidor es"
    ." demasiado viejo. La versión de PHP"
    ." debe ser actualizado antes que"
    ." MySQLDumper puede ser instalado y"
    ." utilizado.";
$lang['L_POP3_PORT']="Puerto POP3";
$lang['L_POP3_SERVER']="Servidor POP3";
$lang['L_PORT']="Puerto";
$lang['L_POSITION_BC']="abajo en el centro";
$lang['L_POSITION_BL']="abajo a la izquierda";
$lang['L_POSITION_BR']="abajo a la derecha";
$lang['L_POSITION_MC']="en el medio centrado";
$lang['L_POSITION_ML']="en el medio a la izquierda";
$lang['L_POSITION_MR']="en el medio a la derecha";
$lang['L_POSITION_NOTIFICATIONS']="Posición de la ventana del mensaje";
$lang['L_POSITION_TC']="arriba en el centro";
$lang['L_POSITION_TL']="arriba a la izquierda";
$lang['L_POSITION_TR']="arriba a la derecha";
$lang['L_POSSIBLE_COLLATIONS']="Possible collations";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="These are the possible collations one"
    ." can choose for this character set.<br"
    ." /><br />_cs = case sensitiv<br />_ci ="
    ." case insensitive";
$lang['L_PREFIX']="Prefijo";
$lang['L_PRIMARYKEYS_CHANGED']="Clave principal cambiada";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Error al cambiar la clave principal";
$lang['L_PRIMARYKEYS_SAVE']="Guardar las claves principales";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="¿Realmente desea eliminar la clave"
    ." principal?";
$lang['L_PRIMARYKEY_DELETED']="Clave principal eliminada";
$lang['L_PRIMARYKEY_FIELD']="Campo de clave principal";
$lang['L_PRIMARYKEY_NOTFOUND']="Clave principal no encontrada";
$lang['L_PROCESSKILL1']="Se intentará, terminar el proceso";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="Se ha intentado desde hace";
$lang['L_PROCESSKILL4']="seg. para eliminar el proceso";
$lang['L_PROCESS_ID']="Process ID";
$lang['L_PROGRESS_FILE']="Progreso de archivo";
$lang['L_PROGRESS_OVER_ALL']="Progreso total";
$lang['L_PROGRESS_TABLE']="Progreso de la tabla actual";
$lang['L_PROVIDER']="Proveedor";
$lang['L_PROZESSE']="Proceso";
$lang['L_QUERY']="Query";
$lang['L_QUERY_TYPE']="Query type";
$lang['L_RECHTE']="derechos";
$lang['L_RECORDS']="registros";
$lang['L_RECORDS_INSERTED']="<b>%s</b> registros insertados.";
$lang['L_RECORDS_OF_TABLE']="Registros de la tabla";
$lang['L_RECORDS_PER_PAGECALL']="Registros por página vista";
$lang['L_REFRESHTIME']="Intervalo de actualización";
$lang['L_REFRESHTIME_PROCESSLIST']="Intervalo de actualización de la"
    ." lista de proceso";
$lang['L_REGISTRATION_DESCRIPTION']="Por favor, introduzca la cuenta de"
    ." administrador ahora. Le pedirá que"
    ." ingrese en MySQLDumper con este"
    ." usuario. Recuerdes bien los datos por"
    ." este razón. Usted puede escoger"
    ." libremente su nombre de usuario y"
    ." contraseña. Por favor, asegúrese de"
    ." escoger la forma más segura posible"
    ." para la combinación del nombre de"
    ." usuario y de la contraseña para"
    ." proteger el acceso a MySQLDumper"
    ." contra el acceso no autorizado.";
$lang['L_RELOAD']="Cargar de nuevo";
$lang['L_REMOVE']="Eliminar";
$lang['L_REPAIR']="Reparar";
$lang['L_RESET']="Volver";
$lang['L_RESET_SEARCHWORDS']="Reinicializar criterios de búsqueda";
$lang['L_RESTORE']="Restaurar";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> Las tablas han sido"
    ." importadas.";
$lang['L_RESTORE_DB']="la base de datos '<b>%s</b>' en"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Restablecimiento de la base de datos"
    ." '%s' se ha completado en %s.";
$lang['L_RESTORE_OF_TABLES']="Elija las tablas a restaurar";
$lang['L_RESTORE_TABLE']="Restablecer la tabla '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Hasta el momento, se han recuperado"
    ." <b>%d</b> de <b>%d</b> tablas.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Hasta el momento, se han recuperado"
    ." <b>%d</b> tablas.";
$lang['L_RESULT']="Result";
$lang['L_REVERSE']="Mostrar las entradas más nuevas"
    ." primero";
$lang['L_SAFEMODEDESC']="Debido a que en este servidor está"
    ." ejecutándose PHP en modo seguro"
    ." (safe_mode),necesita crear los"
    ." siguientes directorios manualmente"
    ." utilizando su programa de FTP:";
$lang['L_SAVE']="Guardar";
$lang['L_SAVEANDCONTINUE']="Guardar y seguir con la instalación";
$lang['L_SAVE_ERROR']="¡La configuración no ha podido ser"
    ." guardada!";
$lang['L_SAVE_SUCCESS']="La configuración se ha guardado con"
    ." éxito en el archivo de configuración"
    ." \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Guardar el contenido de la database"
    ." '%s' en el archivo '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Tamaño máximo alcanzado: Continuar"
    ." con el archivo '%s'";
$lang['L_SAVING_DB_FORM']="Base de datos";
$lang['L_SAVING_TABLE']="Guardando tabla";
$lang['L_SEARCH_ACCESS_KEYS']="Navegar:<br />Adelante=ALT+V<br"
    ." />Atrás=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Buscar en la tabla";
$lang['L_SEARCH_NO_RESULTS']="¡La búsqueda para \"<b>%s</b>\" en"
    ." la tabla \"<b>%s</b>\" no produjo"
    ." ningún resultado!";
$lang['L_SEARCH_OPTIONS']="Opciones de búsqueda";
$lang['L_SEARCH_OPTIONS_AND']="una columna debe contener todos los"
    ." términos de búsqueda (Y-Búsqueda)";
$lang['L_SEARCH_OPTIONS_CONCAT']="Una línea debe contener todos los"
    ." términos de búsqueda, pero estos"
    ." puede ser en cualquiera de las"
    ." columnas (¡podría tardar!)";
$lang['L_SEARCH_OPTIONS_OR']="Una columna debe contener al menos un"
    ." criterio de búsqueda (O-Búsqueda)";
$lang['L_SEARCH_RESULTS']="La búsqueda para \"<b>%s</b>\" en la"
    ." tabla \"<b>%s</b>\" produjo los"
    ." siguientes resultados";
$lang['L_SECOND']="Segundo";
$lang['L_SECONDS']="Segundos";
$lang['L_SELECT']="Seleccione";
$lang['L_SELECTED_FILE']="archivo elegido";
$lang['L_SELECT_ALL']="seleccionar todas";
$lang['L_SELECT_FILE']="Seleccione archivo";
$lang['L_SELECT_LANGUAGE']="Seleccionar idioma";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Enviar resultados como archivo";
$lang['L_SEND_MAIL_FORM']="Enviar un correo electrónico";
$lang['L_SERVER']="Servidor";
$lang['L_SERVERCAPTION']="Nombre del servidor";
$lang['L_SETPRIMARYKEYSFOR']="Establecer nueva clave principal para"
    ." la tabla";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Muestra los datos de %s hasta %s de %s";
$lang['L_SHOWRESULT']="Mostrar resultados";
$lang['L_SHOW_TABLES']="Show tablas";
$lang['L_SHOW_TOOLTIPS']="Show nicer tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="Servidor SMTP";
$lang['L_SMTP_PORT']="Puerto STMP";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Rapidez";
$lang['L_SQLBOX']="Ventana SQL";
$lang['L_SQLBOXHEIGHT']="Altura de la ventana SQL";
$lang['L_SQLLIB_ACTIVATEBOARD']="activar foro";
$lang['L_SQLLIB_BOARDS']="Foros";
$lang['L_SQLLIB_DEACTIVATEBOARD']="desactivar foro";
$lang['L_SQLLIB_GENERALFUNCTIONS']="funciones generales";
$lang['L_SQLLIB_RESETAUTO']="reinicializar autoincremento";
$lang['L_SQLLIMIT']="Cantidad de registros por página";
$lang['L_SQL_ACTIONS']="Acciones";
$lang['L_SQL_AFTER']="siguiente";
$lang['L_SQL_ALLOWDUPS']="Se permiten duplicados";
$lang['L_SQL_ATPOSITION']="insertar en la posición";
$lang['L_SQL_ATTRIBUTES']="Atributos";
$lang['L_SQL_BACKDBOVERVIEW']="volver a la vista de bases de datos";
$lang['L_SQL_BEFEHLNEU']="nuevo comando";
$lang['L_SQL_BEFEHLSAVED1']="El comando SQL";
$lang['L_SQL_BEFEHLSAVED2']="ha sido insertado";
$lang['L_SQL_BEFEHLSAVED3']="ha sido guardado";
$lang['L_SQL_BEFEHLSAVED4']="ha sido desplazado hacia arriba";
$lang['L_SQL_BEFEHLSAVED5']="ha sido eliminado";
$lang['L_SQL_BROWSER']="Navegador-SQL";
$lang['L_SQL_CARDINALITY']="Cardinalidad";
$lang['L_SQL_CHANGED']="ha sido modificado.";
$lang['L_SQL_CHANGEFIELD']="modificar campo";
$lang['L_SQL_CHOOSEACTION']="Elija una acción";
$lang['L_SQL_COLLATENOTMATCH']="¡Este juego de caracteres y el orden"
    ." solicitado no pueden funcionar juntos!";
$lang['L_SQL_COLUMNS']="columnas";
$lang['L_SQL_COMMANDS']="Comandos SQL";
$lang['L_SQL_COMMANDS_IN']="líneas en";
$lang['L_SQL_COMMANDS_IN2']="registros modificados por segundo.";
$lang['L_SQL_COPYDATADB']="Copiar contenido de la base de datos";
$lang['L_SQL_COPYSDB']="Copiar estructura en la base de datos";
$lang['L_SQL_COPYTABLE']="Copiar tabla";
$lang['L_SQL_CREATED']="ha sido insertado.";
$lang['L_SQL_CREATEINDEX']="crear nuevo índice";
$lang['L_SQL_CREATETABLE']="Crear tabla";
$lang['L_SQL_DATAVIEW']="Vista de datos";
$lang['L_SQL_DBCOPY']="El contenido de la base de datos `%s`"
    ." ha sido copiado a la base de datos"
    ." `%s`.";
$lang['L_SQL_DBSCOPY']="La estructura de la base de datos `%s`"
    ." ha sido copiado a la base de datos"
    ." `%s`.";
$lang['L_SQL_DELETED']="ha sido eliminado";
$lang['L_SQL_DESTTABLE_EXISTS']="¡La tabla de destino ya existe!";
$lang['L_SQL_EDIT']="editar";
$lang['L_SQL_EDITFIELD']="editar campo";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Modificar la estructura de la tabla";
$lang['L_SQL_EMPTYDB']="vaciar base de datos";
$lang['L_SQL_ERROR1']="Error de ejecución:";
$lang['L_SQL_ERROR2']="MySQL informa:";
$lang['L_SQL_EXEC']="ejecutar comando SQL";
$lang['L_SQL_EXPORT']="Exportar la base de datos `%s`";
$lang['L_SQL_FIELDDELETE1']="El campo";
$lang['L_SQL_FIELDNAMENOTVALID']="ERROR: nombre de campo inválido";
$lang['L_SQL_FIRST']="primero";
$lang['L_SQL_IMEXPORT']="Im-/Exportar";
$lang['L_SQL_IMPORT']="Importar a la base de datos `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: incomplete statement detected.<br"
    ." />Couldn't find closing match for '%s'"
    ." in query:<br />%s";
$lang['L_SQL_INDEXES']="índices";
$lang['L_SQL_INSERTFIELD']="insertar campo";
$lang['L_SQL_INSERTNEWFIELD']="insertar nuevo campo";
$lang['L_SQL_LIBRARY']="Librería SQL";
$lang['L_SQL_NAMEDEST_MISSING']="¡Falta el nombre de destino!";
$lang['L_SQL_NEWFIELD']="nuevo campo";
$lang['L_SQL_NODATA']="No hay registros que mostrar";
$lang['L_SQL_NODEST_COPY']="¡Sin destino, no se puede copiar"
    ." nada!";
$lang['L_SQL_NOFIELDDELETE']="Eliminación imposible, ya que la"
    ." tabla debe contener al menos un campo.";
$lang['L_SQL_NOTABLESINDB']="No hay ninguna tabla en la base de"
    ." datos";
$lang['L_SQL_NOTABLESSELECTED']="¡No se han seleccionado tablas!";
$lang['L_SQL_OPENFILE']="Abrir archivo SQL";
$lang['L_SQL_OPENFILE_BUTTON']="Subir";
$lang['L_SQL_OUT1']="Se han ejecutado";
$lang['L_SQL_OUT2']="comandos";
$lang['L_SQL_OUT3']="Hubo";
$lang['L_SQL_OUT4']="comentarios";
$lang['L_SQL_OUT5']="Dado que el comando afecta más de"
    ." 5000 registros, no se mostrarán los"
    ." resultados.";
$lang['L_SQL_OUTPUT']="Salida de SQL";
$lang['L_SQL_QUERYENTRY']="La consulta contiene";
$lang['L_SQL_RECORDDELETED']="Registro eliminado";
$lang['L_SQL_RECORDEDIT']="editar registro";
$lang['L_SQL_RECORDINSERTED']="Registro insertado";
$lang['L_SQL_RECORDNEW']="insertar registro";
$lang['L_SQL_RECORDUPDATED']="Registro actualizado";
$lang['L_SQL_RENAMEDB']="renombrar base de datos";
$lang['L_SQL_RENAMEDTO']="ha sido renombrada a";
$lang['L_SQL_SCOPY']="La estructura de tabla de `%s` ha sido"
    ." copiada en la tabla `%s`.";
$lang['L_SQL_SEARCH']="Búsqueda";
$lang['L_SQL_SEARCHWORDS']="Palabra(s) de búsqueda";
$lang['L_SQL_SELECTTABLE']="elegir tabla";
$lang['L_SQL_SERVER']="SQL-Server";
$lang['L_SQL_SHOWDATATABLE']="mostrar los datos de la tabla";
$lang['L_SQL_STRUCTUREDATA']="estructura y datos";
$lang['L_SQL_STRUCTUREONLY']="solamente estructura";
$lang['L_SQL_TABLEEMPTIED']="La tabla `%s` ha sido vaciada.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="La tabla `%s` ha sido eliminada, y los"
    ." índices reinicializados.";
$lang['L_SQL_TABLEINDEXES']="Índices de la tabla";
$lang['L_SQL_TABLENEW']="Modificar tabla";
$lang['L_SQL_TABLENOINDEXES']="La tabla no contiene ningún índice";
$lang['L_SQL_TABLENONAME']="¡La tabla necesita un nombre!";
$lang['L_SQL_TABLESOFDB']="Tablas de la base de datos";
$lang['L_SQL_TABLEVIEW']="Vista de tablas";
$lang['L_SQL_TBLNAMEEMPTY']="¡El nombre de la tabla no puede estar"
    ." vacío!";
$lang['L_SQL_TBLPROPSOF']="Propiedades de tabla de";
$lang['L_SQL_TCOPY']="La tabla `%s` ha sido copiada (con sus"
    ." datos), en la tabla `%s`.";
$lang['L_SQL_UPLOADEDFILE']="Fichero cargado:";
$lang['L_SQL_VIEW_COMPACT']="Ver: Compacto";
$lang['L_SQL_VIEW_STANDARD']="Ver: Normal";
$lang['L_SQL_VONINS']="de un total de";
$lang['L_SQL_WARNING']="La ejecución de comandos SQL sirve"
    ." para manipular directamente los datos"
    ." de la base de datos. Los autores no se"
    ." responsabilizarán de la pérdida de"
    ." datos ocurrida debido al uso de esta"
    ." utilidad.";
$lang['L_SQL_WASCREATED']="ha sido creada con éxito";
$lang['L_SQL_WASEMPTIED']="ha sido vaciada";
$lang['L_STARTDUMP']="iniciar copia de seguridad";
$lang['L_START_RESTORE_DB_FILE']="Inicie la recuperación de database"
    ." '%s' del archivo '%s'.";
$lang['L_START_SQL_SEARCH']="Iniciar búsqueda";
$lang['L_STATUS']="Estado";
$lang['L_STEP']="Paso";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="El archivo de configuración \"%s\" se"
    ." ha creado correctamente.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="El archivo de configuración \"%s\" ha"
    ." sido eliminado.";
$lang['L_SUM_TOTAL']="Sum";
$lang['L_TABLE']="Tabla";
$lang['L_TABLENAME']="Table name";
$lang['L_TABLENAME_EXPLAIN']="Table name";
$lang['L_TABLES']="Tablas";
$lang['L_TABLESELECTION']="Elección de tablas";
$lang['L_TABLE_CREATE_SUCC']="La tabla '%s' se ha creado"
    ." correctamente.";
$lang['L_TABLE_TYPE']="Tipo";
$lang['L_TESTCONNECTION']="Probar conexión";
$lang['L_THEME']="Tema";
$lang['L_TIME']="Tiempo";
$lang['L_TIMESTAMP']="Timestamp";
$lang['L_TITLE_INDEX']="Índice";
$lang['L_TITLE_KEY_FULLTEXT']="Clave texto completo";
$lang['L_TITLE_KEY_PRIMARY']="Clave principal";
$lang['L_TITLE_KEY_UNIQUE']="Clave única";
$lang['L_TITLE_MYSQL_HELP']="Documentación de MySQL";
$lang['L_TITLE_NOKEY']="No hay clave";
$lang['L_TITLE_SEARCH']="Búsqueda";
$lang['L_TITLE_SHOW_DATA']="Ver datos";
$lang['L_TITLE_UPLOAD']="Subir archivo SQL";
$lang['L_TO']="hasta";
$lang['L_TOOLS']="Herramientas";
$lang['L_TOOLS_TOOLBOX']="Elección de base de datos / Funciones"
    ." de base de datos / Im- y Exportar";
$lang['L_TRUNCATE']="Truncate";
$lang['L_TRUNCATE_DATABASE']="Truncate database";
$lang['L_UNIT_KB']="Kilobyte";
$lang['L_UNIT_MB']="Megabyte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="desconocido";
$lang['L_UNKNOWN_SQLCOMMAND']="comando SQL desconocido";
$lang['L_UPDATE']="Actualizar";
$lang['L_UPDATE_CONNECTION_FAILED']="Actualización falló, porque con '%s'"
    ." del servidor no se pudo establecer.";
$lang['L_UPDATE_ERROR_RESPONSE']="Actualización falló, el servidor"
    ." devuelve: '%s'";
$lang['L_UPTO']="hasta";
$lang['L_USERNAME']="Nombre de usuario";
$lang['L_USE_SSL']="Usar SSL";
$lang['L_VALUE']="Contenido";
$lang['L_VERSIONSINFORMATIONEN']="Versión";
$lang['L_VIEW']="ver";
$lang['L_VISIT_HOMEPAGE']="Visite el sitio web";
$lang['L_VOM']="de";
$lang['L_WITH']="con";
$lang['L_WITHATTACH']="con fichero adjunto";
$lang['L_WITHOUTATTACH']="sin fichero adjunto";
$lang['L_WITHPRAEFIX']="con prefijo";
$lang['L_WRONGCONNECTIONPARS']="Conexión errónea o sin parámetros !";
$lang['L_WRONG_CONNECTIONPARS']="¡Parámetros de conexión"
    ." incorrectos!";
$lang['L_WRONG_RIGHTS']="El archivo o directorio '%s' no tiene"
    ." permisos de escritura para mi.<br"
    ." /><br />Los permisos (chmod) están"
    ." mal configurados o el propietario no"
    ." es correcto.<br /><br />Por favor,"
    ." compruebe los atributos utilizando su"
    ." software de FTP.<br /><br />El archivo"
    ." o directorio debe ser configurado a"
    ." %s.";
$lang['L_YES']="si";
$lang['L_ZEND_FRAMEWORK_VERSION']="Versión de Zend Framework";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="El nombre de archivo dado '%value%' no"
    ." es un directorio.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="El nombre de archivo dado '%value%' no"
    ." es un archivo.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="El objetivo determinado '%value%' no"
    ." es un link.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="El archivo o directorio '%value%' no"
    ." es ejecutable.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="El archivo o directorio '%value%' no"
    ." existe.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="El archivo o directorio '%value%' no"
    ." es legible.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="El archivo dado '%value%' no es un"
    ." archivo subido.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="El archivo o directorio 'value%%' no"
    ." está escribible.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Tipo no válido entregado. Se espera"
    ." String, Integer o Float.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="El valor está vacío.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="La dirección de correo electrónico"
    ." no puede ser comparada al formato"
    ." \"dot-atom\".";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Tipo no válido entregado. Se espera"
    ." String.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="La dirección de correo electrónico"
    ." es incorrecta.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="El nombre de host no es válido.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="La parte local de la dirección de"
    ." correo electrónico (Parte"
    ." local@Dominio.TLD) no es válido.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="Para este dirección de correo"
    ." electrónico no existe un registro MX"
    ." valida.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="El nombre de host se encuentra en un"
    ." segmento de red no enrutable. La"
    ." dirección de correo electrónico no"
    ." deben ser resueltas desde la red"
    ." pública.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="La dirección de email es demasiado"
    ." largo. El largo máxima es de 320"
    ." caracteres.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="El email no puede se compare con"
    ." formato de cita-cadena.";
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
$lang['L_ZEND_ID_IS_EMPTY']="Valor es necesario y no puede estar"
    ." vacío.";
$lang['L_ZEND_ID_MISSING_TOKEN']="No hay token fue siempre para que"
    ." coincida en contra.";
$lang['L_ZEND_ID_NOT_DIGITS']="Sólo se permite números.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Tipo no válido dado. String, integer,"
    ." float, booleanos o array espera.";
$lang['L_ZEND_ID_NOT_SAME']="Ambas tokens dado no coinciden.";
return $lang;
