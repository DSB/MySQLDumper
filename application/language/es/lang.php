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
    ." codificación del archivo de la copia"
    ." de seguridad de forma automática.<br"
    ." /><br />Usted debe elegir el juego de"
    ." carácteres con el que se guardó la"
    ." copia de seguridad.<br /><br />Si"
    ." después de la restauración descubre"
    ." algún problema con algunos"
    ." carácteres, puede repetir la"
    ." restauración con otro juego de"
    ." caracteres. <br /><br />Buena suerte."
    ." ;)";
$lang['L_CHOOSE_DB']="Elegir base de datos";
$lang['L_CLEAR_DATABASE']="Vaciar la base de datos";
$lang['L_CLOSE']="Cerrar";
$lang['L_COLLATION']="Ordenación";
$lang['L_COMMAND']="Comando";
$lang['L_COMMAND_AFTER_BACKUP']="Comando después de la copia";
$lang['L_COMMAND_BEFORE_BACKUP']="Comando antes de la copia";
$lang['L_COMMENT']="Comentario";
$lang['L_COMPRESSED']="comprimido (gz)";
$lang['L_CONFBASIC']="Propiedades básicas";
$lang['L_CONFIG']="Configuración";
$lang['L_CONFIGFILE']="Archivo de configuración";
$lang['L_CONFIGFILES']="Archivos de configuración";
$lang['L_CONFIGURATIONS']="Configuraciones";
$lang['L_CONFIG_AUTODELETE']="Eliminación automática";
$lang['L_CONFIG_CRONPERL']="Configuración del volcado programado"
    ." (crondump) para el script de Perl";
$lang['L_CONFIG_EMAIL']="Notificación por correo electrónico";
$lang['L_CONFIG_FTP']="Transferencia por FTP de las copias de"
    ." seguridad";
$lang['L_CONFIG_HEADLINE']="Configuración";
$lang['L_CONFIG_INTERFACE']="Interfaz";
$lang['L_CONFIG_LOADED']="La configuración \"%s\" se importó"
    ." correctamente.";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="¿Está seguro de que desea borrar el"
    ." archivo de configuración %s?";
$lang['L_CONFIRM_DELETE_FILE']="¿Relamente quiere que el fichero '%s'"
    ." seleccionado sea eliminado?";
$lang['L_CONFIRM_DELETE_TABLES']="¿Quiere realmente eliminar las tablas"
    ." seleccionadas?";
$lang['L_CONFIRM_DROP_DATABASES']="¿Quiere realmente eliminar la(s)"
    ." base(s) de datos seleccionada(s)?"
    ." Nota: Todos los datos se perderán"
    ." irrevocablemente! Por favor, cree"
    ." antes una copia de seguridad de los"
    ." datos.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="¿Realmente quiere eliminar el"
    ." destinatario \"%s\"?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="¿Quiere realmente eliminar todas las"
    ." tablas de las bases de datos"
    ." seleccionadas?<br />Nota: Todos los"
    ." datos se perderán irrevocablemente!"
    ." Tal vez desee crear una copia de"
    ." seguridad de los datos primero.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="¿Realmente quiere vaciar las tablas"
    ." seleccionadas?";
$lang['L_CONNECT']="conectar";
$lang['L_CONNECTIONPARS']="Parámetros de conexión";
$lang['L_CONNECTTOMYSQL']="Conectar con MySQL";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continuar la restauración por partes"
    ." con el siguiente archivo '%s'.";
$lang['L_CONVERTED_FILES']="Archivos convertidos";
$lang['L_CONVERTER']="Conversor de copias de seguridad";
$lang['L_CONVERTING']="Conviertiendo";
$lang['L_CONVERT_FILE']="Archivo que se convertirá";
$lang['L_CONVERT_FILENAME']="Nombre del archivo de destino (sin"
    ." extensión)";
$lang['L_CONVERT_FILEREAD']="Leyendo el archivo '%s'";
$lang['L_CONVERT_FINISHED']="Conversión finalizada: '%s' se ha"
    ." guardado correctamente.";
$lang['L_CONVERT_START']="Iniciar la conversión";
$lang['L_CONVERT_TITLE']="Convertir la copia de seguridad al"
    ." formato MSD";
$lang['L_CONVERT_WRONG_PARAMETERS']="¡Parámetros incorrectos!  No es"
    ." posible la conversión.";
$lang['L_CREATE']="Crear";
$lang['L_CREATED']="Creado";
$lang['L_CREATEDIRS']="Crear directorios";
$lang['L_CREATE_AUTOINDEX']="Crear índice automático";
$lang['L_CREATE_CONFIGFILE']="Crear un nuevo archivo de"
    ." configuración";
$lang['L_CREATE_DATABASE']="Crear nueva base de datos";
$lang['L_CREATE_TABLE_SAVED']="Definición de la tabla '%s' guardada.";
$lang['L_CREDITS']="Créditos / Ayuda";
$lang['L_CRONSCRIPT']="Script Cron";
$lang['L_CRON_COMMENT']="Escriba un comentario";
$lang['L_CRON_COMPLETELOG']="Registrar todas las operaciones";
$lang['L_CRON_EXECPATH']="Ruta de los scripts de Perl";
$lang['L_CRON_EXTENDER']="Extensión de nombre de archivo";
$lang['L_CRON_PRINTOUT']="Salida de texto";
$lang['L_CSVOPTIONS']="Opciones CSV";
$lang['L_CSV_EOL']="separar líneas con";
$lang['L_CSV_ERRORCREATETABLE']="¡Error al crear la tabla `%s`!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="El número de campos no coincide con"
    ." el de los datos a importar (%d en vez"
    ." de  %d).";
$lang['L_CSV_FIELDSENCLOSED']="Campos delimitados por";
$lang['L_CSV_FIELDSEPERATE']="Campos separados con";
$lang['L_CSV_FIELDSESCAPE']="Campos 'escapados' con";
$lang['L_CSV_FIELDSLINES']="%d campos reconocidos, un total de %d"
    ." líneas";
$lang['L_CSV_FILEOPEN']="Abrir archivo CSV";
$lang['L_CSV_NAMEFIRSTLINE']="Nombres de campo en la primera línea";
$lang['L_CSV_NODATA']="¡No se han encontrado registros que"
    ." importar!";
$lang['L_CSV_NULL']="Reemplazar NULL con";
$lang['L_DATABASES_OF_USER']="Bases de datos del usuario";
$lang['L_DATABASE_CREATED_FAILED']="No se creó la base de datos.<br"
    ." />MySQL devolvió:<br /><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="La base de datos '%s' se ha creado con"
    ." éxito.";
$lang['L_DATASIZE']="Tamaño de los datos";
$lang['L_DATASIZE_INFO']="Este es el tamaño de los datos"
    ." contenidos en la base de datos, no del"
    ." archivo de la copia de seguridad.";
$lang['L_DAY']="Día";
$lang['L_DAYS']="Días";
$lang['L_DB']="Base de datos";
$lang['L_DBCONNECTION']="Conexión con la base de datos";
$lang['L_DBPARAMETER']="Parámetros de la base de datos";
$lang['L_DBS']="Bases de datos";
$lang['L_DB_ADAPTER']="Adaptador de BB.DD.";
$lang['L_DB_BACKUPPARS']="Parámetros de la copia de seguridad"
    ." de la base de datos";
$lang['L_DB_DEFAULT']="Base de datos por defecto";
$lang['L_DB_HOST']="Servidor (hostname)";
$lang['L_DB_IN_LIST']="La base de datos '%s' no se pudo"
    ." añadir porque ya existe.";
$lang['L_DB_NAME']="Nombre de la base de datos";
$lang['L_DB_PASS']="Contraseña";
$lang['L_DB_SELECT_ERROR']="<br />Error:<br /> la selección de la"
    ." base de datos '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' ha fallado!";
$lang['L_DB_USER']="Usuario";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Juego de carácteres por defecto";
$lang['L_DEFAULT_CHARSET']="Juego de carácteres por defecto";
$lang['L_DEFAULT_COLLATION_NAME']="Orden por defecto";
$lang['L_DELETE']="Eliminar";
$lang['L_DELETE_DATABASE']="Eliminar la base de datos";
$lang['L_DELETE_FILE_ERROR']="¡Sucedió un error al intentar borrar"
    ." el archivo \"%s\"!";
$lang['L_DELETE_FILE_SUCCESS']="El archivo \"%s\" se ha eliminado con"
    ." éxito.";
$lang['L_DELETE_HTACCESS']="Quite la protección del directorio"
    ." (elimine .htaccess)";
$lang['L_DESCRIPTION']="Descripción";
$lang['L_DESELECT_ALL']="Deseleccionar todas";
$lang['L_DIR']="Directorio";
$lang['L_DISABLEDFUNCTIONS']="Funciones deshabilitadas";
$lang['L_DO']="Ejecuta";
$lang['L_DOCRONBUTTON']="Ejecutar el script Cron de Perl";
$lang['L_DONE']="Finalizado!";
$lang['L_DONT_ATTACH_BACKUP']="No adjuntar copia de seguridad";
$lang['L_DOPERLTEST']="Probar módulos Perl";
$lang['L_DOSIMPLETEST']="Probar Perl";
$lang['L_DOWNLOAD_FILE']="Descargar fichero";
$lang['L_DO_NOW']="ejecutar ahora";
$lang['L_DUMP']="Copia de seguridad";
$lang['L_DUMP_ENDERGEBNIS']="El archivo contiene <b>%s</b> tablas"
    ." con <b>%s</b> registros.<br />";
$lang['L_DUMP_FILENAME']="Archivo de la copia de seguridad";
$lang['L_DUMP_HEADLINE']="Creando la copia de seguridad...";
$lang['L_DUMP_NOTABLES']="No se han encontrado tablas en la base"
    ." de datos `%s`";
$lang['L_DUMP_OF_DB_FINISHED']="Volcado de la base de datos `%s` hecho";
$lang['L_DURATION']="Duración";
$lang['L_EDIT']="editar";
$lang['L_EHRESTORE_CONTINUE']="seguir y registrar los errores";
$lang['L_EHRESTORE_STOP']="stop";
$lang['L_EMAIL']="Dirección de email";
$lang['L_EMAILBODY_ATTACH']="El fichero adjunto contiene la copia"
    ." de seguridad de su base de datos"
    ." MySQL.<br />Copia de seguridad de la"
    ." base de datos `%s`<br /><br /><br />Se"
    ." ha creado el siguiente archivo:<br"
    ." /><br />%s <br /><br /><br />Saludos"
    ." de<br /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_ATTACH']="Se ha realizado una copia de seguridad"
    ." por partes.<br />Los archivos de esta"
    ." copia se adjuntan a emails"
    ." separados!<br />Copia de seguridad de"
    ." la base de datos `%s`<br /><br /><br"
    ." />Se han creado los siguientes"
    ." archivos:<br /><br />%s <br /><br"
    ." /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_MP_NOATTACH']="Se ha realizado un copia de seguridad"
    ." por partes.<br />Los archivos no se"
    ." adjuntan a este email!<br />Copia de"
    ." seguridad de la base de datos `%s`<br"
    ." /><br /><br />Han sido creados estos"
    ." archivos:<br /><br />%s<br /><br /><br"
    ." /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAILBODY_NOATTACH']="¡No se ha adjuntado el archivo de la"
    ." copia de seguridad a este email!<br"
    ." />Copia de seguridad de la base de"
    ." datos `%s`<br /><br /><br />Se ha"
    ." creado el siguiente archivo:<br /><br"
    ." />%s <br /><br /><br />Saludos de<br"
    ." /><br />MySQLDumper<br />";
$lang['L_EMAILBODY_TOOBIG']="La copia de seguridad ha sobrepasado"
    ." el tamaño máximo de %s y por lo"
    ." tanto no ha sido adjuntada.<br />Copia"
    ." de seguridad de la base de datos"
    ." `%s`<br /><br /><br />Se ha creado el"
    ." siguiente archivo:<br /><br />%s <br"
    ." /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />";
$lang['L_EMAIL_ADDRESS']="Dirección de email";
$lang['L_EMAIL_CC']="Destinatarios en copia (CC)";
$lang['L_EMAIL_MAXSIZE']="Tamaño máximo para ficheros adjuntos";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... solamente el fichero adjunto";
$lang['L_EMAIL_RECIPIENT']="Destinatario";
$lang['L_EMAIL_SENDER']="Remitente";
$lang['L_EMAIL_START']="Iniciar el envío de e-mail";
$lang['L_EMAIL_WAS_SEND']="Se ha enviado con éxito un email a";
$lang['L_EMPTY']="Vaciar";
$lang['L_EMPTYKEYS']="vaciar y resetear los índices";
$lang['L_EMPTYTABLEBEFORE']="Primero vaciar la tabla";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Eliminar las tablas antes de la"
    ." restauración";
$lang['L_ENCODING']="Codificación";
$lang['L_ENCRYPTION_TYPE']="Tipo de encriptación";
$lang['L_ENGINE']="Máquina";
$lang['L_ENTER_DB_INFO']="Primero pulse el botón \"Conectar con"
    ." MySQL\". Solamente si no es posible"
    ." detectar ninguna base de datos es"
    ." necesario que especifique un nombre"
    ." aquí.";
$lang['L_ENTRY']="Registro";
$lang['L_ERROR']="Error";
$lang['L_ERRORHANDLING_RESTORE']="Tratamiento de los errores en la"
    ." restauración de datos";
$lang['L_ERROR_CONFIGFILE_NAME']="El nombre del archivo \"%s\" contiene"
    ." carácteres no válidos.";
$lang['L_ERROR_DELETING_CONFIGFILE']="¡Error: no se ha podido eliminar el"
    ." archivo de configuración %s !";
$lang['L_ERROR_LOADING_CONFIGFILE']="No se pudo cargar el archivo de"
    ." configuración \"%s\".";
$lang['L_ERROR_LOG']="Registro de errores";
$lang['L_ERROR_MULTIPART_RESTORE']="Restauración por partes: no se puede"
    ." encontrar el siguiente archivo '%s'!";
$lang['L_ESTIMATED_END']="Estimación de la finalización";
$lang['L_EXCEL2003']="Excel a partir de la versión 2003";
$lang['L_EXISTS']="Existe";
$lang['L_EXPORT']="Exportar";
$lang['L_EXPORTFINISHED']="Exportación finalizada.";
$lang['L_EXPORTLINES']="<strong>%s</strong> líneas exportadas";
$lang['L_EXPORTOPTIONS']="Opciones de exportación";
$lang['L_EXTENDEDPARS']="Parámetros avanzados";
$lang['L_FADE_IN_OUT']="Mostrar/ocultar";
$lang['L_FATAL_ERROR_DUMP']="¡Error fatal: la instrucción CREATE"
    ." de la tabla '%s' en la base de datos"
    ." '%s' no se pueden leer!";
$lang['L_FIELDS']="Campos";
$lang['L_FIELDS_OF_TABLE']="Campos de la tabla";
$lang['L_FILE']="Archivo";
$lang['L_FILES']="Archivos";
$lang['L_FILESIZE']="Tamaño de archivo";
$lang['L_FILE_MANAGE']="Gestión de archivos";
$lang['L_FILE_OPEN_ERROR']="Error: no se ha podido abrir el"
    ." archivo.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="El archivo se ha guardado"
    ." correctamente.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="¡No se pudo guardar el archivo!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="El archivo '%s' se subido"
    ." correctamente.";
$lang['L_FILTER_BY']="Filtrar por";
$lang['L_FM_ALERTRESTORE1']="¿Desea llenar la base de datos";
$lang['L_FM_ALERTRESTORE2']="con el contenido del archivo";
$lang['L_FM_ALERTRESTORE3']="?";
$lang['L_FM_ALL_BU']="Todas las copias de seguridad";
$lang['L_FM_ANZ_BU']="cantidad de copias";
$lang['L_FM_ASKDELETE1']="Desea realmente eliminar el archivo";
$lang['L_FM_ASKDELETE2']="?";
$lang['L_FM_ASKDELETE3']="¿Desea ejecutar ahora el borrado"
    ." automático según las reglas"
    ." especificadas?";
$lang['L_FM_ASKDELETE4']="¿Desea eliminar todos los archivos de"
    ." copias de seguridad?";
$lang['L_FM_ASKDELETE5']="¿Desea eliminar todos los archivos"
    ." con el prefijo";
$lang['L_FM_ASKDELETE5_2']="* ?";
$lang['L_FM_AUTODEL1']="Eliminado automático: Los siguientes"
    ." archivos han sido eliminados por"
    ." superar la cantidad máxima de"
    ." archivos establecida:";
$lang['L_FM_CHOOSE_ENCODING']="Seleccione la codificación del"
    ." archivo de la copia de seguridad";
$lang['L_FM_COMMENT']="Escriba un comentario";
$lang['L_FM_DELETE']="Eliminar";
$lang['L_FM_DELETE1']="El archivo";
$lang['L_FM_DELETE2']="ha sido eliminado.";
$lang['L_FM_DELETE3']="no ha podido ser eliminado!";
$lang['L_FM_DELETEALL']="Eliminar todas las copias de seguridad";
$lang['L_FM_DELETEALLFILTER']="Eliminar todos los archivos con";
$lang['L_FM_DELETEAUTO']="Ejecutar borrado automático"
    ." manualmente";
$lang['L_FM_DUMPSETTINGS']="Configuración de la copia de"
    ." seguridad";
$lang['L_FM_DUMP_HEADER']="Copia de seguridad";
$lang['L_FM_FILEDATE']="fecha";
$lang['L_FM_FILES1']="Copias de seguridad";
$lang['L_FM_FILESIZE']="Tamaño del fichero";
$lang['L_FM_FILEUPLOAD']="Subir archivo";
$lang['L_FM_FREESPACE']="Espacio libre en el servidor";
$lang['L_FM_LAST_BU']="Última copia de seguridad";
$lang['L_FM_NOFILE']="¡No ha elegido ningún archivo!";
$lang['L_FM_NOFILESFOUND']="No se han encontrado archivos.";
$lang['L_FM_RECORDS']="Registros";
$lang['L_FM_RESTORE']="Restaurar";
$lang['L_FM_RESTORE_HEADER']="Restauración de la base de datos"
    ." `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Seleccione las tablas";
$lang['L_FM_STARTDUMP']="Iniciar nueva copia de seguridad";
$lang['L_FM_TABLES']="Tablas";
$lang['L_FM_TOTALSIZE']="Tamaño total";
$lang['L_FM_UPLOADFAILED']="¡La subida del archivo ha fallado!";
$lang['L_FM_UPLOADFILEEXISTS']="¡Ya existe un archivo con este"
    ." nombre!";
$lang['L_FM_UPLOADFILEREQUEST']="Por favor, elija un archivo.";
$lang['L_FM_UPLOADMOVEERROR']="No se ha podido mover el archivo"
    ." subido al directorio correcto.";
$lang['L_FM_UPLOADNOTALLOWED1']="Este tipo de archivo no está"
    ." permitido.";
$lang['L_FM_UPLOADNOTALLOWED2']="Los tipos de archivo permitidos son:"
    ." *.gz y *.sql";
$lang['L_FOUND_DB']="Encontrada BB.DD.:";
$lang['L_FROMFILE']="de fichero";
$lang['L_FROMTEXTBOX']="desde caja de texto";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Agregar conexión";
$lang['L_FTP_CHOOSE_MODE']="Modo de transferencia FTP";
$lang['L_FTP_CONFIRM_DELETE']="¿Desea realmente eliminar esta"
    ." conexión FTP?";
$lang['L_FTP_CONNECTION']="Conexión FTP";
$lang['L_FTP_CONNECTION_CLOSED']="Conexión FTP cerrada";
$lang['L_FTP_CONNECTION_DELETE']="Eliminar la conexión";
$lang['L_FTP_CONNECTION_ERROR']="No se pudo establecer conexión con el"
    ." servidor '%s' usando el puerto %s.";
$lang['L_FTP_CONNECTION_SUCCESS']="Se ha conectado con éxito con el"
    ." servidor '%s' usando el puerto %s";
$lang['L_FTP_DIR']="Directorio de subida";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Falló la transferencia del archivo"
    ." '%s'";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="El file '%s' fue transferido con"
    ." éxito";
$lang['L_FTP_LOGIN_ERROR']="Se ha denegado el acceso como usuario"
    ." '%s'";
$lang['L_FTP_LOGIN_SUCCESS']="Acceso como usuario '%s' con éxito";
$lang['L_FTP_OK']="La conexión se ha realizado"
    ." correctamente.";
$lang['L_FTP_PASS']="Contraseña";
$lang['L_FTP_PASSIVE']="usar el modo de transferencia pasiva";
$lang['L_FTP_PASV_ERROR']="¡No se puede cambiar al modo pasivo!";
$lang['L_FTP_PASV_SUCCESS']="El cambio a modo pasivo, fue un"
    ." éxito!";
$lang['L_FTP_PORT']="Puerto";
$lang['L_FTP_SEND_TO']="para <strong>%s</strong><br />en"
    ." <strong>%s</s>";
$lang['L_FTP_SERVER']="Servidor";
$lang['L_FTP_SSL']="Conexión segura mediante SSL-FTP";
$lang['L_FTP_START']="Iniciar la transferencia FTP";
$lang['L_FTP_TIMEOUT']="Cancelación de la conexión por"
    ." tiempo";
$lang['L_FTP_TRANSFER']="Transferencia FTP";
$lang['L_FTP_USER']="Usuario";
$lang['L_FTP_USESSL']="usa conexión SSL";
$lang['L_GENERAL']="Genéricas";
$lang['L_GZIP']="Compresión GZip";
$lang['L_GZIP_COMPRESSION']="Compresión GZip";
$lang['L_HOME']="Inicio";
$lang['L_HOUR']="Hora";
$lang['L_HOURS']="Horas";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Activar la reescritura";
$lang['L_HTACC_ADD_HANDLER']="Añadir controlador";
$lang['L_HTACC_CONFIRM_DELETE']="¿Desea crear ahora la protección del"
    ." directorio?";
$lang['L_HTACC_CONTENT']="Contenido del archivo";
$lang['L_HTACC_CREATE']="Crear protección de directorio";
$lang['L_HTACC_CREATED']="La protección del directorio ha sido"
    ." creada.";
$lang['L_HTACC_CREATE_ERROR']="Se ha producido un error al crear la"
    ." protección del directorio!<br />Por"
    ." favor, coloque manualmente en él el"
    ." siguiente archivo, con el siguiente"
    ." contenido";
$lang['L_HTACC_CRYPT']="Crypt máximo de 8 carácteres (Linux"
    ." y Unix)";
$lang['L_HTACC_DENY_ALLOW']="Denegar / Permitir";
$lang['L_HTACC_DIR_LISTING']="Listado de directorios";
$lang['L_HTACC_EDIT']="editar .htaccess";
$lang['L_HTACC_ERROR_DOC']="Documento de errores";
$lang['L_HTACC_EXAMPLES']="otros ejemplos y documentación";
$lang['L_HTACC_EXISTS']="Ya existe actualmente una protección"
    ." del directorio. ¡Si crea una nueva,"
    ." la antigua será sobreescrita!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Permitir ejecución";
$lang['L_HTACC_MD5']="MD5 (Linux y Unix)";
$lang['L_HTACC_NO_ENCRYPTION']="texto plano, sin encriptación"
    ." (Windows)";
$lang['L_HTACC_NO_USERNAME']="Debe darle un nombre!";
$lang['L_HTACC_PROPOSED']="¡Altamente recomendado";
$lang['L_HTACC_REDIRECT']="Redirecccionar";
$lang['L_HTACC_SCRIPT_EXEC']="Ejecutar script";
$lang['L_HTACC_SHA1']="SHA1 (todos los sistemas)";
$lang['L_HTACC_WARNING']="¡Cuidado! El archivo .htaccess"
    ." influye directamente en el"
    ." comportamiento de los navegadores.<br"
    ." />Con el contenido inadecuado, estas"
    ." páginas pueden no ser accesibles.";
$lang['L_IMPORT']="Importar";
$lang['L_IMPORTIEREN']="Importar";
$lang['L_IMPORTOPTIONS']="Opciones de importación";
$lang['L_IMPORTSOURCE']="Origen de la importación";
$lang['L_IMPORTTABLE']="Importar a tabla";
$lang['L_IMPORT_NOTABLE']="¡No ha seleccionado ninguna tabla"
    ." para importar!";
$lang['L_IN']="en";
$lang['L_INDEX_SIZE']="Tamaño del índice";
$lang['L_INFO_ACTDB']="Base de datos actual";
$lang['L_INFO_DATABASES']="Bases de datos accesibles";
$lang['L_INFO_DBEMPTY']="¡La base de datos está vacía!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="En este servidor el comando"
    ." fsockopen() de PHP está deshabilitado"
    ." por la configuración del servidor."
    ." Debido a esto la descarga automática"
    ." de paquetes de idioma no es posible."
    ." Para sortear esto, usted puede"
    ." descargar manualmente los paquetes,"
    ." extraerlos localmente y subirlos al"
    ." directorio \"language\" de su"
    ." instalación de MySQLDumper. Después,"
    ." el nuevo<br />paquete de idioma"
    ." estará disponible en este sitio.";
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
$lang['L_INSTALL_DB_DEFAULT']="Usar como base de datos por defecto";
$lang['L_INSTALL_HELP_PORT']="(vacío = puerto estándar)";
$lang['L_INSTALL_HELP_SOCKET']="(vacío = Socket estándar)";
$lang['L_IS_WRITABLE']="Se puede escribir";
$lang['L_KILL_PROCESS']="Detener el proceso";
$lang['L_LANGUAGE']="Idioma";
$lang['L_LANGUAGE_NAME']="Español";
$lang['L_LASTBACKUP']="Última copia de seguridad";
$lang['L_LOAD']="Cargar config. por defecto";
$lang['L_LOAD_DATABASE']="Refrescar la lista de BB.DD.";
$lang['L_LOAD_FILE']="Cargar archivo";
$lang['L_LOG']="Archivo de registro";
$lang['L_LOGFILENOTWRITABLE']="¡No se puede escribir en el archivo"
    ." de registro (log)!";
$lang['L_LOGFILES']="Archivos de registro";
$lang['L_LOGGED_IN']="Iniciada sesión";
$lang['L_LOGIN']="Acceder";
$lang['L_LOGIN_AUTOLOGIN']="Inicio de sesión automático";
$lang['L_LOGIN_INVALID_USER']="La dirección de correo electrónico o"
    ." la contraseña son incorrectas.";
$lang['L_LOGOUT']="Cerrar sesión";
$lang['L_LOG_CREATED']="Archivo de registro creado.";
$lang['L_LOG_DELETE']="Eliminar el archivo de registro (log)";
$lang['L_LOG_MAXSIZE']="Tamaño máximo de archivos los"
    ." archivos de registro (log)";
$lang['L_LOG_NOT_READABLE']="El archivo de registro '%s' no existe"
    ." o no es legible.";
$lang['L_MAILERROR']="Se ha producido un error al intentar"
    ." enviar el email!";
$lang['L_MAILPROGRAM']="Programa de correo electrónico";
$lang['L_MAXIMUM_LENGTH']="Longitud máxima";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="Éste es el número máximo de bytes"
    ." que necesita un carácter para"
    ." grabarse en un disco.";
$lang['L_MAXSIZE']="Tamaño máximo";
$lang['L_MAX_BACKUP_FILES_EACH2']="para cada base de datos";
$lang['L_MAX_EXECUTION_TIME']="Tiempo máximo de ejecución";
$lang['L_MAX_UPLOAD_SIZE']="Tamaño máximo del fichero";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Si el archivo de la copia de seguridad"
    ." es mayor que el límite arriba"
    ." mencionado, entonces debe subirlo a"
    ." través de FTP en la carpeta"
    ." \"work/backup\". <br />Después ese"
    ." archivo se mostrará aquí, y podrá"
    ." ser elegido para restaurar.";
$lang['L_MEMORY']="Memoria";
$lang['L_MENU_HIDE']="Ocultar el menú";
$lang['L_MENU_SHOW']="Mostrar el menú";
$lang['L_MESSAGE']="Mensaje";
$lang['L_MESSAGE_TYPE']="Tipo de mensaje";
$lang['L_MINUTE']="Minuto";
$lang['L_MINUTES']="Minutos";
$lang['L_MOBILE_OFF']="De";
$lang['L_MOBILE_ON']="a";
$lang['L_MODE_EASY']="Sencillo";
$lang['L_MODE_EXPERT']="Experto";
$lang['L_MSD_INFO']="Información sobre MySQLDumper";
$lang['L_MSD_MODE']="Modo MySQLDumper";
$lang['L_MSD_VERSION']="Versión de MySQLDumper";
$lang['L_MULTIDUMP']="Volcado por partes";
$lang['L_MULTIDUMP_FINISHED']="Copia de seguridad de <b>%d</b> bases"
    ." de datos finalizada";
$lang['L_MULTIPART_ACTUAL_PART']="Sub archivo actual";
$lang['L_MULTIPART_SIZE']="Tamaño máximo de archivo";
$lang['L_MULTI_PART']="Copia de seguridad en múltiples"
    ." archivos";
$lang['L_MYSQLVARS']="Variables de MySQL";
$lang['L_MYSQL_CLIENT_VERSION']="Cliente MySQL";
$lang['L_MYSQL_CONNECTION_ENCODING']="Codificación habitual para servidores"
    ." MySQL";
$lang['L_MYSQL_DATA']="Datos MySQL";
$lang['L_MYSQL_ROUTINE']="Rutina";
$lang['L_MYSQL_ROUTINES']="Rutinas";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Funciones y procedimientos almacenados";
$lang['L_MYSQL_TABLES_EXPLAIN']="Las tablas tienen una estructura"
    ." definida por columnas en las que se"
    ." puede guardar datos en forma de filas"
    ." (registros). Cada registro de la base"
    ." de datos es pues representado por una"
    ." fila en la tabla.";
$lang['L_MYSQL_VERSION']="Versión de MySQL";
$lang['L_MYSQL_VERSION_TOO_OLD']="Lo sentimos: La versión disponible de"
    ." MySQL %s es demasiado antigua y no se"
    ." puede utilizar junto con esta versión"
    ." de MySQLDumper. Por favor, actualice"
    ." la versión de MySQL, por lo menos su"
    ." versión %s o superior. Como"
    ." alternativa, puede instalar la"
    ." versión 1.24 de MySQLDumper que es"
    ." compatible con la mayoría de"
    ." servidores de MySQL. Pero en este caso"
    ." perderá algunas de las nuevas"
    ." características de MySQLDumper ;)";
$lang['L_MYSQL_VIEW']="Vista";
$lang['L_MYSQL_VIEWS']="Vistas";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Las vistas muestran (filtrados)"
    ." conjuntos de registros de una o más"
    ." tablas, pero que en sí mismos no son"
    ." registros.";
$lang['L_NAME']="Nombre";
$lang['L_NEW']="nuevo";
$lang['L_NEWTABLE']="crear una nueva tabla";
$lang['L_NEXT_AUTO_INCREMENT']="Próximo indice automático";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="índice automatico";
$lang['L_NO']="no";
$lang['L_NOFTPPOSSIBLE']="¡Las funciones de FTP no están"
    ." disponibles!";
$lang['L_NOGZPOSSIBLE']="Dado que Zlib no está instalado, ¡no"
    ." puede usar las funciones de"
    ." compresión de archivos GZip!";
$lang['L_NONE']="ninguno";
$lang['L_NOREVERSE']="Mostrar las entradas más antiguas"
    ." primero";
$lang['L_NOTAVAIL']="<em>no disponible</em>";
$lang['L_NOTHING_TO_DO']="No hay nada que hacer.";
$lang['L_NOTICE']="Indicación";
$lang['L_NOTICES']="Indicaciones";
$lang['L_NOT_ACTIVATED']="inactivo";
$lang['L_NOT_SUPPORTED']="Esta copia de seguridad no acepta esta"
    ." función.";
$lang['L_NO_DB_FOUND']="¡No pudo encontrar ninguna base de"
    ." datos de forma automática! Por favor,"
    ." muestre los parámetros de la"
    ." conexión, e introduzca el nombre de"
    ." su base de datos manualmente.";
$lang['L_NO_DB_FOUND_INFO']="Se estableció con éxito la conexión"
    ." al servidor de la base de datos.<br />"
    ." Sus datos de usuario son válidos y"
    ." fueron aceptados por el servidor"
    ." MySQL.<br /><br />¡Pero MySQLDumper"
    ." no pudo encontrar ninguna base de"
    ." datos!<br />En algunos servidores"
    ." está bloqueada la detección"
    ." automática a través de scripts por"
    ." cuestiones de seguridad.<br /><br"
    ." />Debe escribir manualmente el nombre"
    ." de su base de datos una vez que"
    ." finalice la instalación.<br />Pulse"
    ." en \"configuración\" \"Parámetros de"
    ." conexión - mostrar\" y escriba ahí"
    ." el nombre de la base de datos.";
$lang['L_NO_DB_SELECTED']="No se ha seleccionado ninguna base de"
    ." datos.";
$lang['L_NO_ENTRIES']="La tabla está vacía y no contiene"
    ." ningún registro.";
$lang['L_NO_MSD_BACKUPFILE']="Copias de seguridad de otros programas";
$lang['L_NO_NAME_GIVEN']="No ha escrito un nombre.";
$lang['L_NR_OF_QUERIES']="Número de consultas";
$lang['L_NR_OF_RECORDS']="Número de registros";
$lang['L_NR_TABLES_OPTIMIZED']="Se han optimizado %s tablas.";
$lang['L_NUMBER_OF_FILES_FORM']="Cantidad de archivos de copia de"
    ." seguridad";
$lang['L_OF']="de";
$lang['L_OK']="Ok";
$lang['L_OPTIMIZE']="Optimizar";
$lang['L_OPTIMIZE_TABLES']="Optimizar las tablas antes de la copia"
    ." de seguridad";
$lang['L_OPTIMIZE_TABLE_ERR']="Ha ocurrido un error intentando"
    ." optimizar la tabla `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="La tabla `%s` ha sido optimizado con"
    ." éxito.";
$lang['L_OS']="Sistema operativo";
$lang['L_OVERHEAD']="Sobresalir";
$lang['L_PAGE']="Página";
$lang['L_PAGE_REFRESHS']="Vistas de página";
$lang['L_PASS']="Contraseña";
$lang['L_PASSWORD']="Contraseña";
$lang['L_PASSWORDS_UNEQUAL']="¡Las contraseñas no son idénticos o"
    ." están vacías!";
$lang['L_PASSWORD_REPEAT']="Contraseña (reescribir)";
$lang['L_PASSWORD_STRENGTH']="Fortaleza de la contraseña";
$lang['L_PERLOUTPUT1']="Valor para absolute_path_of_configdir"
    ." en crondump.pl";
$lang['L_PERLOUTPUT2']="Accesible desde el navegador o desde"
    ." un Cronjob externo al servidor";
$lang['L_PERLOUTPUT3']="Instrucción para la consola (shell) o"
    ." para el Crontab";
$lang['L_PERL_COMPLETELOG']="Registro completo de Perl";
$lang['L_PERL_LOG']="Registro de Perl";
$lang['L_PHPBUG']="¡Error en la librería zlib! ¡No es"
    ." posible comprimir archivos!";
$lang['L_PHPMAIL']="Función mail() de PHP";
$lang['L_PHP_EXTENSIONS']="Extensiones de PHP";
$lang['L_PHP_LOG']="Registro de PHP";
$lang['L_PHP_VERSION']="Versión de PHP";
$lang['L_PHP_VERSION_TOO_OLD']="Lo sentimos: la versión de PHP"
    ." instalada en este servidor es"
    ." demasiado vieja para ser usada con"
    ." esta versión de MySQLDumper. PHP debe"
    ." ser de la versión %s o posterior. La"
    ." versión actual de PHP es %s. Debe"
    ." actualizar la versión de PHP para"
    ." poder instalar y usar esta versión de"
    ." MySQLDumper.";
$lang['L_POP3_PORT']="Puerto POP3";
$lang['L_POP3_SERVER']="Servidor POP3";
$lang['L_PORT']="Puerto";
$lang['L_POSITION_BC']="abajo en el centro";
$lang['L_POSITION_BL']="abajo a la izquierda";
$lang['L_POSITION_BR']="abajo a la derecha";
$lang['L_POSITION_MC']="en el medio centrado";
$lang['L_POSITION_ML']="en el medio a la izquierda";
$lang['L_POSITION_MR']="en el medio a la derecha";
$lang['L_POSITION_NOTIFICATIONS']="Posición de la ventana de"
    ." notificaciones";
$lang['L_POSITION_TC']="arriba en el centro";
$lang['L_POSITION_TL']="arriba a la izquierda";
$lang['L_POSITION_TR']="arriba a la derecha";
$lang['L_POSSIBLE_COLLATIONS']="Colaciones posibles";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="Estas son las posibles locaciones que"
    ." uno puede escoger para este juego de"
    ." carácteres:<br /><br />_cs = sensible"
    ." a mayúsculas<br />_ci = no distingue"
    ." mayúsculas/minúsculas";
$lang['L_PREFIX']="Prefijo";
$lang['L_PRIMARYKEYS_CHANGED']="Clave principal cambiada";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Error al cambiar la clave principal";
$lang['L_PRIMARYKEYS_SAVE']="Guardar la clave principal";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="¿Realmente desea eliminar la clave"
    ." principal?";
$lang['L_PRIMARYKEY_DELETED']="Clave principal eliminada";
$lang['L_PRIMARYKEY_FIELD']="Campo de clave principal";
$lang['L_PRIMARYKEY_NOTFOUND']="Clave principal no encontrada";
$lang['L_PROCESSKILL1']="Se intentará forzar la finalización"
    ." del proceso";
$lang['L_PROCESSKILL2']=".";
$lang['L_PROCESSKILL3']="Se ha intentado desde hace";
$lang['L_PROCESSKILL4']="seg. para eliminar el proceso";
$lang['L_PROCESS_ID']="ID del proceso";
$lang['L_PROGRESS_FILE']="Progreso del archivo";
$lang['L_PROGRESS_OVER_ALL']="Progreso total";
$lang['L_PROGRESS_TABLE']="Progreso de la tabla actual";
$lang['L_PROVIDER']="Proveedor";
$lang['L_PROZESSE']="Procesos";
$lang['L_QUERY']="Consulta";
$lang['L_QUERY_TYPE']="Tipo de consulta";
$lang['L_RECHTE']="permisos";
$lang['L_RECORDS']="registros";
$lang['L_RECORDS_INSERTED']="<b>%s</b> registros insertados.";
$lang['L_RECORDS_OF_TABLE']="Registros de la tabla";
$lang['L_RECORDS_PER_PAGECALL']="Registros por página vista";
$lang['L_REFRESHTIME']="Período de actualización";
$lang['L_REFRESHTIME_PROCESSLIST']="Período de actualización de la lista"
    ." de proceso";
$lang['L_REGISTRATION_DESCRIPTION']="Por favor, añada ahora la cuenta de"
    ." administrador. Con ella accederá en"
    ." el futuro en MySQLDumper. Por esa"
    ." razón debería tomar nota de los"
    ." datos de la misma. <br /><br />Usted"
    ." puede escoger libremente su nombre de"
    ." usuario y contraseña. Por favor,"
    ." asegúrese de escoger la combinación"
    ." más segura posible para proteger a"
    ." MySQLDumper contra el acceso no"
    ." autorizado!";
$lang['L_RELOAD']="Cargar de nuevo";
$lang['L_REMOVE']="Eliminar";
$lang['L_REPAIR']="Reparar";
$lang['L_RESET']="Reinicializar";
$lang['L_RESET_SEARCHWORDS']="reinicializar palabras a buscar";
$lang['L_RESTORE']="Restaurar";
$lang['L_RESTORE_COMPLETE']="Se han creado <b>%s</b> tablas.";
$lang['L_RESTORE_DB']="la base de datos '<b>%s</b>' en"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Finalizada la restauración de la base"
    ." de datos '%s' en %s.";
$lang['L_RESTORE_OF_TABLES']="Elija las tablas a restaurar";
$lang['L_RESTORE_TABLE']="Restauración de la tabla '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Hasta el momento, se han creado"
    ." <b>%d</b> de <b>%d</b> tablas.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Hasta el momento, se han creado"
    ." <b>%d</b> tablas.";
$lang['L_RESULT']="Resultado";
$lang['L_REVERSE']="Mostrar las entradas más nuevas"
    ." primero";
$lang['L_SAFEMODEDESC']="Debido a que en este servidor está"
    ." ejecutándose PHP en modo seguro"
    ." (safe_mode),necesita crear los"
    ." siguientes directorios manualmente"
    ." utilizando su programa de FTP:";
$lang['L_SAVE']="Guardar";
$lang['L_SAVEANDCONTINUE']="Guardar y seguir con la instalación";
$lang['L_SAVE_ERROR']="¡Ha habido un error! ¡La"
    ." configuración no ha podido ser"
    ." guardada!";
$lang['L_SAVE_SUCCESS']="La configuración se ha guardado con"
    ." éxito en el archivo de configuración"
    ." \"%s\".";
$lang['L_SAVING_DATA_TO_FILE']="Guardar el contenido de la base de"
    ." datos '%s' en el archivo '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Tamaño máximo de archivo alcanzado:"
    ." continuando con el archivo '%s'";
$lang['L_SAVING_DB_FORM']="Base de datos";
$lang['L_SAVING_TABLE']="Guardando tabla";
$lang['L_SEARCH_ACCESS_KEYS']="Navegar: Adelante=ALT+V, Atrás=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Buscar en la tabla";
$lang['L_SEARCH_NO_RESULTS']="¡La búsqueda para \"<b>%s</b>\" en"
    ." la tabla \"<b>%s</b>\" no produjo"
    ." ningún resultado!";
$lang['L_SEARCH_OPTIONS']="Opciones de búsqueda";
$lang['L_SEARCH_OPTIONS_AND']="una columna debe contener todos los"
    ." términos de búsqueda (búsqueda AND)";
$lang['L_SEARCH_OPTIONS_CONCAT']="una línea debe contener todos los"
    ." términos de búsqueda, pero estos"
    ." pueden estar en cualquiera de las"
    ." columnas (¡podría tardar!)";
$lang['L_SEARCH_OPTIONS_OR']="una columna debe contener al menos uno"
    ." de los términos de búsqueda"
    ." (búsqueda OR)";
$lang['L_SEARCH_RESULTS']="La búsqueda de \"<b>%s</b>\" en la"
    ." tabla \"<b>%s</b>\" produjo los"
    ." siguientes resultados";
$lang['L_SECOND']="Segundo";
$lang['L_SECONDS']="Segundos";
$lang['L_SELECT']="Seleccione";
$lang['L_SELECTED_FILE']="archivo elegido";
$lang['L_SELECT_ALL']="Seleccionar todas";
$lang['L_SELECT_FILE']="Seleccione un archivo";
$lang['L_SELECT_LANGUAGE']="Escoger idioma";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Enviar resultados como archivo";
$lang['L_SEND_MAIL_FORM']="Enviar un correo electrónico";
$lang['L_SERVER']="Servidor";
$lang['L_SERVERCAPTION']="Visualización del servidor";
$lang['L_SETPRIMARYKEYSFOR']="Establecer nueva clave principal para"
    ." la tabla";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Mostrando los registros de %s hasta %s"
    ." de %s";
$lang['L_SHOWRESULT']="Mostrar resultados";
$lang['L_SHOW_TABLES']="Mostrar tablas";
$lang['L_SHOW_TOOLTIPS']="Mostrar consejos (tooltips) bonitos";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="Servidor SMTP";
$lang['L_SMTP_PORT']="Puerto STMP";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Velocidad";
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
$lang['L_SQL_BACKDBOVERVIEW']="Volver al listado de bases de datos";
$lang['L_SQL_BEFEHLNEU']="Nueva instrucción";
$lang['L_SQL_BEFEHLSAVED1']="Instrucción SQL";
$lang['L_SQL_BEFEHLSAVED2']="ha sido añadido";
$lang['L_SQL_BEFEHLSAVED3']="ha sido guardado";
$lang['L_SQL_BEFEHLSAVED4']="ha sido desplazado hacia arriba";
$lang['L_SQL_BEFEHLSAVED5']="ha sido eliminado";
$lang['L_SQL_BROWSER']="Navegador SQL";
$lang['L_SQL_CARDINALITY']="Cardinalidad";
$lang['L_SQL_CHANGED']="ha sido modificado.";
$lang['L_SQL_CHANGEFIELD']="modificar campo";
$lang['L_SQL_CHOOSEACTION']="Elija una acción";
$lang['L_SQL_COLLATENOTMATCH']="¡Este juego de caracteres y la"
    ." colación solicitada no pueden"
    ." funcionar juntos!";
$lang['L_SQL_COLUMNS']="columnas";
$lang['L_SQL_COMMANDS']="Instrucciones SQL";
$lang['L_SQL_COMMANDS_IN']="líneas en";
$lang['L_SQL_COMMANDS_IN2']="registros modificados por segundo.";
$lang['L_SQL_COPYDATADB']="Copiar contenido completo de la base"
    ." de datos a";
$lang['L_SQL_COPYSDB']="Copiar la estructura de la base de"
    ." datos";
$lang['L_SQL_COPYTABLE']="Copiar tabla";
$lang['L_SQL_CREATED']="ha sido creado.";
$lang['L_SQL_CREATEINDEX']="crear nuevo índice";
$lang['L_SQL_CREATETABLE']="Crear tabla";
$lang['L_SQL_DATAVIEW']="Vista de datos";
$lang['L_SQL_DBCOPY']="El contenido de la base de datos `%s`"
    ." ha sido copiado en la base de datos"
    ." `%s`.";
$lang['L_SQL_DBSCOPY']="La estructura de la base de datos `%s`"
    ." ha sido copiado en la base de datos"
    ." `%s`.";
$lang['L_SQL_DELETED']="ha sido eliminado";
$lang['L_SQL_DESTTABLE_EXISTS']="¡La tabla de destino ya existe!";
$lang['L_SQL_EDIT']="editar";
$lang['L_SQL_EDITFIELD']="editar campo";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Modificar la estructura de la tabla";
$lang['L_SQL_EMPTYDB']="Vaciar la base de datos";
$lang['L_SQL_ERROR1']="¡Error en la consulta!";
$lang['L_SQL_ERROR2']="MySQL informa:";
$lang['L_SQL_EXEC']="ejecutar instrucción SQL";
$lang['L_SQL_EXPORT']="Exportar desde la base de datos `%s`";
$lang['L_SQL_FIELDDELETE1']="El campo";
$lang['L_SQL_FIELDNAMENOTVALID']="ERROR: nombre de campo inválido";
$lang['L_SQL_FIRST']="primero";
$lang['L_SQL_IMEXPORT']="Importar/Exportar";
$lang['L_SQL_IMPORT']="Importar en la base de datos `%s`";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: detectada instrucción"
    ." incompleta.<br />No se pudo encontrar"
    ." un cierre para '%s' en la çonsulta:"
    ." <br />%s";
$lang['L_SQL_INDEXES']="Índices";
$lang['L_SQL_INSERTFIELD']="insertar campo";
$lang['L_SQL_INSERTNEWFIELD']="insertar nuevo campo";
$lang['L_SQL_LIBRARY']="Librería SQL";
$lang['L_SQL_NAMEDEST_MISSING']="¡Falta el nombre del destino!";
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
$lang['L_SQL_OUT1']="Se ha ejecutado";
$lang['L_SQL_OUT2']="Instrucciones";
$lang['L_SQL_OUT3']="Hubo";
$lang['L_SQL_OUT4']="comentarios";
$lang['L_SQL_OUT5']="Dado que el resultado contiene más de"
    ." 5000 registros, no se mostrará.";
$lang['L_SQL_OUTPUT']="Salida del SQL";
$lang['L_SQL_QUERYENTRY']="La consulta contiene";
$lang['L_SQL_RECORDDELETED']="Se ha eliminado el registro";
$lang['L_SQL_RECORDEDIT']="editar registro";
$lang['L_SQL_RECORDINSERTED']="Se ha añadido el registro";
$lang['L_SQL_RECORDNEW']="insertar registro";
$lang['L_SQL_RECORDUPDATED']="Registro actualizado";
$lang['L_SQL_RENAMEDB']="Renombrar base de datos";
$lang['L_SQL_RENAMEDTO']="ha sido renombrada a";
$lang['L_SQL_SCOPY']="La estructura de tabla de `%s` ha sido"
    ." copiada en la tabla `%s`.";
$lang['L_SQL_SEARCH']="Búsqueda";
$lang['L_SQL_SEARCHWORDS']="Palabra(s) de búsqueda";
$lang['L_SQL_SELECTTABLE']="elegir tabla";
$lang['L_SQL_SERVER']="Servidor SQL";
$lang['L_SQL_SHOWDATATABLE']="mostrar los datos de la tabla";
$lang['L_SQL_STRUCTUREDATA']="estructura y datos";
$lang['L_SQL_STRUCTUREONLY']="solamente estructura";
$lang['L_SQL_TABLEEMPTIED']="La tabla `%s` ha sido eliminada.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="La tabla `%s` ha sido eliminada, y los"
    ." índices reinicializados.";
$lang['L_SQL_TABLEINDEXES']="Índices de la tabla";
$lang['L_SQL_TABLENEW']="Edición de tablas";
$lang['L_SQL_TABLENOINDEXES']="La tabla no contiene ningún índice";
$lang['L_SQL_TABLENONAME']="¡La tabla necesita un nombre!";
$lang['L_SQL_TABLESOFDB']="Tablas de la base de datos";
$lang['L_SQL_TABLEVIEW']="Vista de tablas";
$lang['L_SQL_TBLNAMEEMPTY']="¡El nombre de la tabla no puede estar"
    ." vacío!";
$lang['L_SQL_TBLPROPSOF']="Propiedades de tabla de";
$lang['L_SQL_TCOPY']="La tabla `%s` ha sido copiada (con sus"
    ." datos), en la tabla `%s`.";
$lang['L_SQL_UPLOADEDFILE']="Archivo cargado:";
$lang['L_SQL_VIEW_COMPACT']="Vista: compacta";
$lang['L_SQL_VIEW_STANDARD']="Vista: estándar";
$lang['L_SQL_VONINS']="de un total de";
$lang['L_SQL_WARNING']="La ejecución de instrucciones SQL"
    ." sirve para manipular directamente los"
    ." datos de la base de datos. Los autores"
    ." de MySQLDumper no se"
    ." responsabilizarán de la pérdida de"
    ." datos ocurrida debido al uso de esta"
    ." utilidad.";
$lang['L_SQL_WASCREATED']="ha sido creada con éxito";
$lang['L_SQL_WASEMPTIED']="ha sido vaciada";
$lang['L_STARTDUMP']="iniciar copia de seguridad";
$lang['L_START_RESTORE_DB_FILE']="Iniciando la restauración de la base"
    ." de datos '%s' desde el archivo '%s'.";
$lang['L_START_SQL_SEARCH']="Iniciar búsqueda";
$lang['L_STATUS']="Estado";
$lang['L_STEP']="Paso";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="El archivo de configuración \"%s\" se"
    ." ha creado correctamente.";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="El archivo de configuración \"%s\" ha"
    ." sido eliminado.";
$lang['L_SUM_TOTAL']="Suma";
$lang['L_TABLE']="Tabla";
$lang['L_TABLENAME']="Nombre de la tabla";
$lang['L_TABLENAME_EXPLAIN']="Nombre de la tabla";
$lang['L_TABLES']="Tablas";
$lang['L_TABLESELECTION']="Elección de tablas";
$lang['L_TABLE_CREATE_SUCC']="La tabla '%s' se ha creado"
    ." correctamente.";
$lang['L_TABLE_TYPE']="Tipo de tabla";
$lang['L_TESTCONNECTION']="Probar conexión";
$lang['L_THEME']="Tema";
$lang['L_TIME']="Tiempo";
$lang['L_TIMESTAMP']="Marca de tiempo";
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
    ." de la base de datos / Importar y"
    ." Exportar";
$lang['L_TRUNCATE']="Truncar";
$lang['L_TRUNCATE_DATABASE']="Vaciar base de datos";
$lang['L_UNIT_KB']="Kilobyte";
$lang['L_UNIT_MB']="Megabyte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="desconocido";
$lang['L_UNKNOWN_SQLCOMMAND']="instrucción SQL desconocida";
$lang['L_UPDATE']="Actualizar";
$lang['L_UPDATE_CONNECTION_FAILED']="Falló la actualización porque no se"
    ." pudo conectar con el servidor '%s'.";
$lang['L_UPDATE_ERROR_RESPONSE']="Falló la actualización, el servidor"
    ." devolvió: '%s'";
$lang['L_UPTO']="hasta";
$lang['L_USERNAME']="Nombre de usuario";
$lang['L_USE_SSL']="Usar SSL";
$lang['L_VALUE']="Contenido";
$lang['L_VERSIONSINFORMATIONEN']="Versión";
$lang['L_VIEW']="ver";
$lang['L_VISIT_HOMEPAGE']="Visite la web oficial";
$lang['L_VOM']="de";
$lang['L_WITH']="con";
$lang['L_WITHATTACH']="con archivo adjunto";
$lang['L_WITHOUTATTACH']="sin archivo adjunto";
$lang['L_WITHPRAEFIX']="con prefijo";
$lang['L_WRONGCONNECTIONPARS']="¡Parámetros de conexión erróneos o"
    ." incompletos!";
$lang['L_WRONG_CONNECTIONPARS']="¡Los parámetros de conexión son"
    ." incorrectos!";
$lang['L_WRONG_RIGHTS']="No se tienen permisos de escritura"
    ." sobre el archivo o directorio '%s'.<br"
    ." /><br />Los permisos (chmod) están"
    ." mal configurados o el propietario no"
    ." es el adecuado.<br /><br /><br />Por"
    ." favor, compruebe los atributos de"
    ." archivo/directorio utilizando su"
    ." software de FTP.<br /><br />Estos han"
    ." de ser establecidos a %s.";
$lang['L_YES']="sí";
$lang['L_ZEND_FRAMEWORK_VERSION']="Versión de Zend Framework";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="El nombre de archivo dado '%value%' no"
    ." es un directorio.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="El nombre de archivo dado '%value%' no"
    ." es un archivo.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="El destino proporcionado '%value%' no"
    ." es un enlace.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="El archivo o directorio '%value%' no"
    ." es ejecutable.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="El archivo o directorio '%value%' no"
    ." existe.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="El archivo o directorio '%value%' no"
    ." es legible.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="El archivo dado '%value%' no es un"
    ." archivo subido.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="El archivo o directorio '%value%' no"
    ." es escribible.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Tipo no válido. Se esperaba String"
    ." (cadena de texto), Integer (número"
    ." entero) o Float (número con coma"
    ." flotante).";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="El valor está vacío.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="La dirección de correo electrónico"
    ." contiene otros carácteres que no son"
    ." puntos (\".\"), ni letras, ni"
    ." números. Es decir, no cumple con el"
    ." formato \"dot-atom\".";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Tipo no válido. Se esperaba String"
    ." (cadena de texto).";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="El formato de la dirección de correo"
    ." electrónico no es válida.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="El nombre del servidor (host) no es"
    ." válido.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="La parte local de la dirección de"
    ." correo electrónico"
    ." (parte_local@dominio.tld) no es"
    ." válida.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="Para este dirección de correo"
    ." electrónico no existe un registro MX"
    ." válido.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="El nombre de servidor (hostname) se"
    ." encuentra en un segmento de red no"
    ." enrutable. La dirección de correo"
    ." electrónico no puede ser resuelta"
    ." desde la red pública.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="La dirección de email es demasiado"
    ." larga. La longitud máxima es de 320"
    ." carácteres.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="El dirección de email no cuple con el"
    ." formato \"quoted-string\".";
$lang['L_ZEND_ID_HOSTNAME_CANNOT_DECODE_PUNYCODE']="El nombre de dominio punycode"
    ." especificado no puede ser"
    ." decodificado.";
$lang['L_ZEND_ID_HOSTNAME_DASH_CHARACTER']="El nombre de dominio contiene un"
    ." guión en una posición no válida.";
$lang['L_ZEND_ID_HOSTNAME_INVALID']="Tipo no vàlido. Se esperaba String"
    ." (cadena de texto).";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME']="El nombre de dominio no coincide con"
    ." la estructura esperada.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_HOSTNAME_SCHEMA']="El nombre de dominio no cumple con los"
    ." esquemas dados para TLD.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_LOCAL_NAME']="El nombre de dominio contiene un"
    ." nombre de red local no válido.";
$lang['L_ZEND_ID_HOSTNAME_INVALID_URI']="El nombre de dominio no cumple con la"
    ." sintaxis URI.";
$lang['L_ZEND_ID_HOSTNAME_IP_ADDRESS_NOT_ALLOWED']="No se permiten direcciones IP en los"
    ." nombres de dominio (hostnames).";
$lang['L_ZEND_ID_HOSTNAME_LOCAL_NAME_NOT_ALLOWED']="Nombres de redes locales no están"
    ." permitidas como nombres de servidor.";
$lang['L_ZEND_ID_HOSTNAME_UNDECIPHERABLE_TLD']="No se puede extraer la parte TLD del"
    ." nombre de dominio.";
$lang['L_ZEND_ID_HOSTNAME_UNKNOWN_TLD']="El nombre de dominio contiene un TLD"
    ." desconocido.";
$lang['L_ZEND_ID_IS_EMPTY']="Este valor es necesario y no puede"
    ." estar vacío.";
$lang['L_ZEND_ID_MISSING_TOKEN']="Característica no establecida para"
    ." contraponer.";
$lang['L_ZEND_ID_NOT_DIGITS']="Sólo se permite números.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Tipo no válido. Se esperaba String"
    ." (cadena de texto), Integer (número"
    ." entero), Float (número con coma"
    ." flotante), Boolean (boleano) o Array"
    ." (matriz).";
$lang['L_ZEND_ID_NOT_SAME']="Ambos IDs no coinciden.";
return $lang;
