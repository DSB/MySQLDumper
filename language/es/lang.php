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
    'L_ACTION' => "Acción",
    'L_ACTIVATED' => "activo",
    'L_ACTUALLY_INSERTED_RECORDS' => "Hasta el momento, se han recuperado"
    ." <b>%s</b> de tablas.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Hasta ahora se han importado <b>%s</b>"
    ." de <b>%s</b> registros",
    'L_ADD' => "Añadir",
    'L_ADDED' => "añadido",
    'L_ADD_DB_MANUALLY' => "Añadir base de datos manualmente",
    'L_ADD_RECIPIENT' => "Añadir destinatario",
    'L_ALL' => "todos",
    'L_ANALYZE' => "Analizar",
    'L_ANALYZING_TABLE' => "Se está llenando de datos la tabla"
    ." '<b>%s</b>'.",
    'L_ASKDBCOPY' => "¿Desea copiar el contenido de la base"
    ." de datos `%s` a la base de datos `%s`?",
    'L_ASKDBDELETE' => "¿Desea realmente eliminar la base de"
    ." datos `%s` así como todos sus"
    ." contenidos?",
    'L_ASKDBEMPTY' => "¿Desea realmente vaciar la base de"
    ." datos `%s` ?",
    'L_ASKDELETEFIELD' => "¿Desea eliminar el campo?",
    'L_ASKDELETERECORD' => "¿Desea eliminar el registro?",
    'L_ASKDELETETABLE' => "Desea eliminar la tabla `%s`?",
    'L_ASKTABLEEMPTY' => "¿Desea vaciar la tabla `%s`?",
    'L_ASKTABLEEMPTYKEYS' => "¿Desea vaciar la tabla `%s` y"
    ." resetear sus índices?",
    'L_ATTACHED_AS_FILE' => "adjunta como un archivo",
    'L_ATTACH_BACKUP' => "Adjuntar copia de seguridad",
    'L_AUTHORIZE' => "Autorizar",
    'L_AUTODELETE' => "Eliminación automática de las copias"
    ." de seguridad",
    'L_BACK' => "atrás",
    'L_BACKUPFILESANZAHL' => "En el directorio de copias de"
    ." seguridad se encuentran",
    'L_BACKUPS' => "copias de seguridad",
    'L_BACKUP_DBS' => "BB.DD. a copiar",
    'L_BACKUP_TABLE_DONE' => "Seguridad de la tabla `%s` completado."
    ." %s registros fueron almacenados.",
    'L_BACK_TO_OVERVIEW' => "Información general de bases de datos",
    'L_BACK_TO_OVERVIEW' => "vista de base de datos",
    'L_CALL' => "Llamada",
    'L_CANCEL' => "Cancelar",
    'L_CANT_CREATE_DIR' => "No se puede crear el directorio"
    ." '%s'.
Cree este directorio manualmente"
    ." utilizando un programa de FTP.",
    'L_CHANGE' => "Cambiar",
    'L_CHANGEDIR' => "cambiar al directorio",
    'L_CHANGEDIR' => "Cambiando al directorio",
    'L_CHANGEDIRERROR' => "No ha sido posible realizar el cambio"
    ." de directorio",
    'L_CHANGEDIRERROR' => "No se ha podido cambiar el directorio",
    'L_CHARSET' => "Juego de caracteres",
    'L_CHECK' => "Comprobar",
    'L_CHECK' => "comprobar",
    'L_CHECK_DIRS' => "Comprobar los directorios",
    'L_CHOOSE_CHARSET' => "MySQLDumper no pudo detectar la"
    ." codificación de los archivos de la"
    ." copia de seguridad de forma"
    ." automática.<br />
Usted debe elegir"
    ." el conjunto de caracteres con el que"
    ." se guardó la copia de seguridad.<br"
    ." />
Si usted descubre algún problema"
    ." con algunos caracteres después de la"
    ." restauración, puede repetir la"
    ." restauración de la copia de seguridad"
    ." con otro conjunto de caracteres. <br"
    ." />
Buena suerte. ;)",
    'L_CHOOSE_DB' => "Elegir base de datos",
    'L_CLEAR_DATABASE' => "Vaciar base de datos",
    'L_CLOSE' => "Cerrar",
    'L_COLLATION' => "Ordenación",
    'L_COMMAND' => "comando",
    'L_COMMAND' => "Comando",
    'L_COMMAND_AFTER_BACKUP' => "Comando después de seguridad",
    'L_COMMAND_BEFORE_BACKUP' => "Comando antes de seguridad",
    'L_COMMENT' => "Comentario",
    'L_COMPRESSED' => "comprimido (gz)",
    'L_CONFBASIC' => "Propiedades básicas",
    'L_CONFIG' => "Configuración",
    'L_CONFIGFILE' => "Archivo de configuración",
    'L_CONFIGFILES' => "Archivos de configuración",
    'L_CONFIGURATIONS' => "Configuraciones",
    'L_CONFIG_AUTODELETE' => "Eliminación automática",
    'L_CONFIG_CRONPERL' => "Propiedades de Crondump como script"
    ." perl",
    'L_CONFIG_EMAIL' => "Notificación por correo electrónico",
    'L_CONFIG_FTP' => "Transferencia por FTP de las copias de"
    ." seguridad",
    'L_CONFIG_HEADLINE' => "Configuración",
    'L_CONFIG_INTERFACE' => "Interfaz",
    'L_CONFIG_LOADED' => "La configuración \"%s\" se importó"
    ." correctamente.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "¿Está seguro de que desea borrar el"
    ." archivo de configuración %s?",
    'L_CONFIRM_DELETE_TABLES' => "Realmente eliminar las tablas"
    ." seleccionadas?",
    'L_CONFIRM_DROP_DATABASES' => "Quieres realmente eliminar la(s)"
    ." base(s) de datos seleccionada(s)?"
    ." Nota: Todas los datos seran perdido"
    ." irrevocablemente! Por favor crea antes"
    ." una copia de seguridad de los datos",
    'L_CONFIRM_RECIPIENT_DELETE' => "El destinatario \"%s\" debería ser"
    ." borrado?",
    'L_CONFIRM_TRUNCATE_DATABASES' => "Quieres realmente vaciar la(s) base(s)"
    ." de datos seleccionada(s)?
Nota: Todas"
    ." las tablas seran perdido"
    ." irrevocablemente! Por favor crea antes"
    ." una copia de seguridad de los datos",
    'L_CONFIRM_TRUNCATE_TABLES' => "Realmente claro las tablas"
    ." seleccionadas?",
    'L_CONNECT' => "conectar",
    'L_CONNECTIONPARS' => "Parámetros de conexión",
    'L_CONNECTTOMYSQL' => "Conectarse a MySQL",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continuar recuperació multiplo por el"
    ." siguiente archivo '%s'.",
    'L_CONVERTED_FILES' => "Archivos convertidos",
    'L_CONVERTER' => "Copia de seguridad-Conversor",
    'L_CONVERTING' => "La conversión",
    'L_CONVERT_FILE' => "archivo que se convertirá",
    'L_CONVERT_FILENAME' => "Nombre del archivo de destino (sin"
    ." extensión)",
    'L_CONVERT_FILEREAD' => "Leyendo el archivo '%s'",
    'L_CONVERT_FINISHED' => "Conversión finalizada: '%s' se ha"
    ." guardado correctamente.",
    'L_CONVERT_START' => "Iniciar conversión",
    'L_CONVERT_TITLE' => "Convertir copia de seguridad al"
    ." formato MSD",
    'L_CONVERT_WRONG_PARAMETERS' => "¡Parámetros incorrectos!  La"
    ." conversión no es posible.",
    'L_CREATE' => "crear",
    'L_CREATEAUTOINDEX' => "Crear índice automático",
    'L_CREATEDIRS' => "Directorios creados",
    'L_CREATE_CONFIGFILE' => "Crear un nuevo archivo de"
    ." configuración",
    'L_CREATE_DATABASE' => "Crear nueva base de datos",
    'L_CREATE_TABLE_SAVED' => "Definición de la tabla `% s"
    ." 'guardado.",
    'L_CREDITS' => "Créditos / Ayuda",
    'L_CRONSCRIPT' => "Script Cron",
    'L_CRON_COMMENT' => "Escriba un comentario",
    'L_CRON_COMPLETELOG' => "Registrar todas las operaciones",
    'L_CRON_EXECPATH' => "Camino del script cron",
    'L_CRON_EXTENDER' => "Extensión de nombre de archivo",
    'L_CRON_PRINTOUT' => "Salida de texto",
    'L_CSVOPTIONS' => "Opciones CSV",
    'L_CSV_EOL' => "separar líneas con",
    'L_CSV_ERRORCREATETABLE' => "¡Error al crear la tabla `%s`!",
    'L_CSV_FIELDCOUNT_NOMATCH' => "El número de campos no coincide con"
    ." el de los datos a importar (%d en vez"
    ." de  %d).",
    'L_CSV_FIELDSENCLOSED' => "Campos delimitados por",
    'L_CSV_FIELDSEPERATE' => "Campos separados por",
    'L_CSV_FIELDSESCAPE' => "Campos 'escapeados' con",
    'L_CSV_FIELDSLINES' => "%d campos reconocidos, totalizando %d"
    ." líneas",
    'L_CSV_FILEOPEN' => "abrir fichero CSV",
    'L_CSV_NAMEFIRSTLINE' => "Nombres de campo en la primera línea",
    'L_CSV_NODATA' => "¡No se han encontrado datos que"
    ." importar!",
    'L_CSV_NULL' => "reemplazar NULL con",
    'L_DATASIZE' => "Tamaño de los datos",
    'L_DATASIZE_INFO' => "Este es el tamaño de los datos"
    ." contenidos en la base de datos, no el"
    ." tamaño del file de backup.",
    'L_DAY' => "Día",
    'L_DAYS' => "Días",
    'L_DB' => "Base de datos",
    'L_DBCONNECTION' => "Conexión a la base de datos",
    'L_DBPARAMETER' => "Parámetros de la base de datos",
    'L_DBS' => "Bases de datos",
    'L_DB_BACKUPPARS' => "Propiedades de la copia de seguridad"
    ." de la base de datos",
    'L_DB_HOST' => "Servidor de base de datos",
    'L_DB_IN_LIST' => "La base de datos '%s' no se podría"
    ." añadir porque ya existe.",
    'L_DB_PASS' => "Contraseña",
    'L_DB_SELECT_ERROR' => "<br />Error:<br />La selección de la"
    ." base de datos '<b>",
    'L_DB_SELECT_ERROR2' => "</b>' ha fallado!",
    'L_DB_USER' => "Usuario",
    'L_DEFAULT_CHARSET' => "Conjunto de caracteres por defecto",
    'L_DELETE' => "Eliminar",
    'L_DELETE_DATABASE' => "Eliminar base de datos",
    'L_DELETE_FILE_ERROR' => "¡No fue posible borrar el archivo"
    ." \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "El archivo \"%s\" se ha eliminado con"
    ." éxito.",
    'L_DELETE_HTACCESS' => "Quitar la protección de directorio"
    ." (eliminar .htaccess)",
    'L_DESELECTALL' => "seleccionar todas",
    'L_DIR' => "Directorio",
    'L_DISABLEDFUNCTIONS' => "Funciones deshabilitadas",
    'L_DISABLEDFUNCTIONS' => "Funciones deshabilitadas",
    'L_DO' => "iniciar",
    'L_DOCRONBUTTON' => "Ejecutar Cronscript Perl",
    'L_DONE' => "Finalizado!",
    'L_DONT_ATTACH_BACKUP' => "No adjuntar copia de seguridad",
    'L_DOPERLTEST' => "Comprobar Módulos Perl",
    'L_DOSIMPLETEST' => "Comprobar Perl",
    'L_DOWNLOAD_FILE' => "Descargos ficheros",
    'L_DO_NOW' => "ejecutar ahora",
    'L_DUMP' => "Copia de seguridad",
    'L_DUMP_ENDERGEBNIS' => "<b>%s</b> Tablas con un total de"
    ." <b>%s</b> registros, han sido"
    ." guardadas con éxito.<br />",
    'L_DUMP_FILENAME' => "Archivo de backup",
    'L_DUMP_HEADLINE' => "Creando copia de seguridad...",
    'L_DUMP_NOTABLES' => "No se han encontrado tablas en la base"
    ." de datos `%s`",
    'L_DUMP_OF_DB_FINISHED' => "Descarga de database se `%s` hecho",
    'L_DURATION' => "Duración",
    'L_EDIT' => "editar",
    'L_EHRESTORE_CONTINUE' => "informar de los errores y seguir",
    'L_EHRESTORE_STOP' => "detenerse",
    'L_EMAIL' => "Correo electrónico",
    'L_EMAILBODY_ATTACH' => "En el fichero adjunto encontrará la"
    ." copia de seguridad de su base de datos"
    ." MySQL.<br />Copia de seguridad de la"
    ." base de datos `%s`
<br /><br />Se ha"
    ." creado el siguiente archivo:<br /><br"
    ." />%s <br /><br /><br />Saludos de<br"
    ." /><br />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "<br /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "Se ha realizado un backup de archivos"
    ." múltiples.<br />Los archivos se"
    ." adjuntan a emails separados!<br"
    ." />Copia de seguridad de la base de"
    ." datos `%s`
<br /><br />Los siguientes"
    ." archivos han sido adjuntados:<br /><br"
    ." />%s <br /><br /><br />Saludos de<br"
    ." /><br />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "Se ha realizado un backup de archivos"
    ." múltiples.<br />Los archivos no se"
    ." adjuntan a este email!<br />Copia de"
    ." seguridad de la base de datos `%s`
<br"
    ." /><br />Los siguientes archivos han"
    ." sido adjuntados:<br /><br />%s
<br"
    ." /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "No se adjunta el archivo de copia de"
    ." seguridad.<br />Copia de seguridad de"
    ." la base de datos `%s`
<br /><br />Se"
    ." ha creado el siguiente archivo:<br"
    ." /><br />%s <br /><br /><br />Saludos"
    ." de<br /><br />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "La copia de seguridad ha sobrepasado"
    ." el tamaño máximo de %s y por lo"
    ." tanto no ha sido adjuntada.<br />Copia"
    ." de seguridad de la base de datos"
    ." `%s`
<br /><br />Se ha creado el"
    ." siguiente archivo:<br /><br />%s <br"
    ." /><br /><br />Saludos de<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "Correo electrónico",
    'L_EMAIL_CC' => "Destinatarios en copia (CC)",
    'L_EMAIL_MAXSIZE' => "Tamaño máximo del fichero adjunto",
    'L_EMAIL_ONLY_ATTACHMENT' => "... solamente el fichero adjunto",
    'L_EMAIL_RECIPIENT' => "Destinatario",
    'L_EMAIL_SENDER' => "Remitente",
    'L_EMAIL_START' => "Iniciar el envío de e-mail",
    'L_EMAIL_WAS_SEND' => "Se ha enviado un email a",
    'L_EMPTY' => "Vaciar",
    'L_EMPTYKEYS' => "vaciar y resetear los índices",
    'L_EMPTYTABLEBEFORE' => "Vaciar la tabla antes de la operación",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Vaciar la base de datos antes de"
    ." recuperar los valores",
    'L_ENCODING' => "Codificación",
    'L_ENCRYPTION_TYPE' => "Tipo de encriptación",
    'L_ENGINE' => "Máquina",
    'L_ENTER_DB_INFO' => "Primero haga clic en el botón"
    ." \"Conectarse a MySQL\". Sólo si no"
    ." hay base de datos podría ser"
    ." detectado es necesario proporcionar un"
    ." nombre de base de datos aquí.",
    'L_ENTRY' => "Registro",
    'L_ERROR' => "Error",
    'L_ERRORHANDLING_RESTORE' => "Tratamiento de los errores en la"
    ." recuperación de datos",
    'L_ERROR_CONFIGFILE_NAME' => "El nombre del archivo \"%s\" contiene"
    ." caracteres no válidos.",
    'L_ERROR_DELETING_CONFIGFILE' => "¡Error: el archivo de configuración"
    ." %s no ha podido ser eliminado!",
    'L_ERROR_LOADING_CONFIGFILE' => "No se pudo cargar el archivo de"
    ." configuración \"%s\".",
    'L_ERROR_LOG' => "Archivo de registro de errores",
    'L_ERROR_MULTIPART_RESTORE' => "Restablecimiento múltiple: No se"
    ." puede encontrar el siguiente archivo"
    ." '%s'!",
    'L_ESTIMATED_END' => "Estimada de cierre",
    'L_EXCEL2003' => "Excel a partir de la versión 2003",
    'L_EXISTS' => "Existe",
    'L_EXPORT' => "Exportar",
    'L_EXPORTFINISHED' => "Exportación finalizada.",
    'L_EXPORTLINES' => "<strong>%s</strong> líneas exportadas",
    'L_EXPORTOPTIONS' => "Opciones de exportación",
    'L_EXTENDEDPARS' => "Parámetros extendidos",
    'L_FADE_IN_OUT' => "Mostrar/ocultar",
    'L_FATAL_ERROR_DUMP' => "¡Error fatal: las instrucciones para"
    ." crear la tabla '%s' en la base de"
    ." datos '%s' no se pueden leer!",
    'L_FIELDS' => "Campos",
    'L_FIELDS_OF_TABLE' => "Campos de la tabla",
    'L_FILE' => "Archivo",
    'L_FILES' => "Archivos",
    'L_FILESIZE' => "Tamaño de archivo",
    'L_FILE_MANAGE' => "Archivos",
    'L_FILE_OPEN_ERROR' => "Error: no he podido abrir el fichero.",
    'L_FILE_SAVED_SUCCESSFULLY' => "El archivo se ha guardado"
    ." correctamente.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "El archivo no puede ser salvado!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "El archivo '%s' se subido"
    ." correctamente.",
    'L_FILTER_BY' => "Filtrar por",
    'L_FM_ALERTRESTORE1' => "¿Desea llenar la base de datos",
    'L_FM_ALERTRESTORE2' => "con el contenido del archivo",
    'L_FM_ALERTRESTORE3' => "?",
    'L_FM_ALL_BU' => "Lista de todas las copias de seguridad",
    'L_FM_ANZ_BU' => "cantidad de copias de seguridad",
    'L_FM_ASKDELETE1' => "Desea realmente eliminar el archivo",
    'L_FM_ASKDELETE2' => "en serio borrar?",
    'L_FM_ASKDELETE3' => "¿Desea ejecutar el borrado"
    ." automático según las reglas"
    ." especificadas?",
    'L_FM_ASKDELETE4' => "¿Desea eliminar todos los archivos de"
    ." copia de seguridad?",
    'L_FM_ASKDELETE5' => "¿Desea eliminar todos los archivos"
    ." con el prefijo",
    'L_FM_ASKDELETE5_2' => "*?",
    'L_FM_AUTODEL1' => "Eliminado automático: Los siguientes"
    ." archivos han sido eliminados al"
    ." superarse la cantidad máxima de"
    ." ficheros:",
    'L_FM_CHOOSE_ENCODING' => "Seleccione la codificación de la"
    ." copia de seguridad",
    'L_FM_COMMENT' => "Enter Comment",
    'L_FM_DBNAME' => "Nombre de la base de datos",
    'L_FM_DELETE' => "Eliminar",
    'L_FM_DELETE1' => "El archivo",
    'L_FM_DELETE2' => "ha sido eliminado.",
    'L_FM_DELETE3' => "no ha podido ser eliminado!",
    'L_FM_DELETEALL' => "eliminar todas las copias de seguridad",
    'L_FM_DELETEALLFILTER' => "eliminar todos los archivos con",
    'L_FM_DELETEAUTO' => "Ejecutar borrado automático"
    ." manualmente",
    'L_FM_DUMPSETTINGS' => "Propiedades de la copia de seguridad",
    'L_FM_DUMP_HEADER' => "Copia de seguridad",
    'L_FM_FILEDATE' => "fecha",
    'L_FM_FILES1' => "Copias de seguridad",
    'L_FM_FILESIZE' => "Tamaño del fichero",
    'L_FM_FILEUPLOAD' => "Subir archivo",
    'L_FM_FILEUPLOAD' => "Subir archivo",
    'L_FM_FREESPACE' => "Espacio libre en el servidor",
    'L_FM_LAST_BU' => "última copia de seguridad",
    'L_FM_NOFILE' => "No ha elegido ningún archivo!",
    'L_FM_NOFILESFOUND' => "No se han encontrado archivos.",
    'L_FM_RECORDS' => "registros",
    'L_FM_RESTORE' => "Restaurar",
    'L_FM_RESTORE_HEADER' => "Recuperación de la base de datos"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Selección de tablas",
    'L_FM_STARTDUMP' => "Iniciar nueva copia de seguridad",
    'L_FM_TABLES' => "tablas",
    'L_FM_TOTALSIZE' => "Tamaño total",
    'L_FM_UPLOADFAILED' => "¡El envío del archivo ha fallado!",
    'L_FM_UPLOADFILEEXISTS' => "¡ Ya existe un archivo con este"
    ." nombre !",
    'L_FM_UPLOADFILEREQUEST' => "Por favor, elija un archivo.",
    'L_FM_UPLOADFILEREQUEST' => "Por favor, elija un archivo.",
    'L_FM_UPLOADMOVEERROR' => "No se ha podido copiar el archivo"
    ." enviado al directorio correcto.",
    'L_FM_UPLOADNOTALLOWED1' => "Esta clase de archivo no está"
    ." permitida.",
    'L_FM_UPLOADNOTALLOWED2' => "Los tipos de archivo permitidos son:"
    ." *.gz y *.sql",
    'L_FOUND_DB' => "Encontrada BB.DD.:",
    'L_FROMFILE' => "de un fichero",
    'L_FROMTEXTBOX' => "del campo de texto",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Agregar conexión",
    'L_FTP_CHOOSE_MODE' => "Modo de transferencia FTP",
    'L_FTP_CONFIRM_DELETE' => "Desea que esta conexión FTP séa"
    ." realmente eliminado?",
    'L_FTP_CONNECTION' => "Conexión FTP",
    'L_FTP_CONNECTION_CLOSED' => "Conexión FTP cerrado",
    'L_FTP_CONNECTION_DELETE' => "Eliminar la conexión",
    'L_FTP_CONNECTION_ERROR' => "Conexión con el servidor '%s', usando"
    ." el puerto %s, no se pudo evaluar",
    'L_FTP_CONNECTION_SUCCESS' => "Conexión con el servidor '%s', usando"
    ." el puerto %s se ha establecido con"
    ." éxito",
    'L_FTP_DIR' => "Directorio de subida",
    'L_FTP_FILE_TRANSFER_ERROR' => "Mal manejo de el file '%s'",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "El file '%s' fue transferido con"
    ." éxito",
    'L_FTP_LOGIN_ERROR' => "Ha denegado el acceso del usuario '%s'",
    'L_FTP_LOGIN_SUCCESS' => "Consultado el usuario '%s'",
    'L_FTP_OK' => "Los parámetros de FTP son correctos",
    'L_FTP_OK' => "La conexión se ha realizado"
    ." correctamente",
    'L_FTP_PASS' => "Contraseña",
    'L_FTP_PASSIVE' => "usar el modo de transferencia pasiva",
    'L_FTP_PASV_ERROR' => "No se puede cambiar al modo pasivo!",
    'L_FTP_PASV_SUCCESS' => "El cambio a modo pasivo, fue un"
    ." éxito!",
    'L_FTP_PORT' => "Puerto",
    'L_FTP_SEND_TO' => "para <strong>%s</strong><br />en"
    ." <strong>%s</s>",
    'L_FTP_SERVER' => "Servidor",
    'L_FTP_SSL' => "Conexión segura mediante SSL-FTP",
    'L_FTP_START' => "Iniciar transferencia FTP",
    'L_FTP_TIMEOUT' => "Cancelación de la conexión",
    'L_FTP_TRANSFER' => "Transferencia FTP",
    'L_FTP_USER' => "Usuario",
    'L_FTP_USESSL' => "conexión SSL usada",
    'L_GENERAL' => "general",
    'L_GENERAL' => "Genéricas",
    'L_GZIP' => "Compresión GZip",
    'L_GZIP_COMPRESSION' => "La compresión GZip",
    'L_HOME' => "Inicio",
    'L_HOUR' => "Hora",
    'L_HOURS' => "Horas",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Activar la reescritura",
    'L_HTACC_ADD_HANDLER' => "Escriba el proveedor",
    'L_HTACC_CONFIRM_DELETE' => "¿Desea crear ahora la protección del"
    ." directorio?",
    'L_HTACC_CONTENT' => "Contenido del archivo",
    'L_HTACC_CREATE' => "Crear protección de directorio",
    'L_HTACC_CREATED' => "La protección del directorio ha sido"
    ." creada.",
    'L_HTACC_CREATE_ERROR' => "Se ha producido un error al crear la"
    ." protección del directorio!<br />Por"
    ." favor, coloque en él el siguiente"
    ." archivo, con el contenido especificado",
    'L_HTACC_CRYPT' => "Crypt máximo de 8 caracteres (Linux y"
    ." Unix)",
    'L_HTACC_DENY_ALLOW' => "Denegar / Permitir",
    'L_HTACC_DIR_LISTING' => "Listado de directorios",
    'L_HTACC_EDIT' => "editar .htaccess",
    'L_HTACC_ERROR_DOC' => "Documentos de error",
    'L_HTACC_EXAMPLES' => "otros ejemplos y documentación",
    'L_HTACC_EXISTS' => "Ya existe actualmente una protección"
    ." del directorio. ¡Si crea una nueva,"
    ." la antigua será sobreescrita!",
    'L_HTACC_MAKE_EXECUTABLE' => "Permitir ejecución",
    'L_HTACC_MD5' => "MD5 (Linux y sistemas Unix)",
    'L_HTACC_NO_ENCRYPTION' => "sin encriptación (Windows)",
    'L_HTACC_NO_USERNAME' => "Debe darle un nombre!",
    'L_HTACC_PROPOSED' => "¡Altamente recomendado",
    'L_HTACC_REDIRECT' => "Redirecccionar",
    'L_HTACC_SCRIPT_EXEC' => "Ejecutar script",
    'L_HTACC_SHA1' => "SHA1 (todos los sistemas)",
    'L_HTACC_WARNING' => "Nota! El fichero .htaccess influye"
    ." directamente el comportamiento de los"
    ." navegadores.<br />Si lo crea de forma"
    ." incorrecta, estas páginas no serán"
    ." accesibles.",
    'L_IMPORT' => "importar configuración",
    'L_IMPORT' => "Importar",
    'L_IMPORTIEREN' => "Importar",
    'L_IMPORTOPTIONS' => "Opciones de importación",
    'L_IMPORTSOURCE' => "Origen de la importación",
    'L_IMPORTTABLE' => "Importar a tabla",
    'L_IMPORT_NOTABLE' => "¡No ha seleccionado ninguna tabla"
    ." para importar!",
    'L_IN' => "en",
    'L_INFO_ACTDB' => "Base de datos actual",
    'L_INFO_DATABASES' => "Las siguentes bases de datos se"
    ." encuentran en el servidor de MySQL",
    'L_INFO_DBEMPTY' => "La base de datos está vacía !",
    'L_INFO_FSOCKOPEN_DISABLED' => "En este servidor el comando fsockopen"
    ." () de PHP está deshabilitado por la"
    ." configuración del servidor. Debido a"
    ." esto los
descarga automática de"
    ." paquetes de idioma no es posible. Para"
    ." evitar esto, usted puede descargar"
    ." manualmente los paquetes, el extracto"
    ." de
en el plano local y cargarlas en el"
    ." directorio de \"lenguaje\" de la"
    ." instalación de MySQLDumper. Después,"
    ." el nuevo
paquete de idioma está"
    ." disponible en este sitio.",
    'L_INFO_LASTUPDATE' => "última actualización",
    'L_INFO_LOCATION' => "Se encuentra en",
    'L_INFO_NODB' => "Base de datos inexistente",
    'L_INFO_NOPROCESSES' => "no hay procesos corriendo",
    'L_INFO_NOSTATUS' => "no hay estados disponibles",
    'L_INFO_NOVARS' => "no hay variables disponibles",
    'L_INFO_OPTIMIZED' => "optimizado",
    'L_INFO_RECORDS' => "Registros",
    'L_INFO_RECORDS' => "Registros",
    'L_INFO_SIZE' => "Tamaño",
    'L_INFO_SUM' => "Total",
    'L_INSTALL' => "Instalación",
    'L_INSTALL' => "Instalación",
    'L_INSTALLED' => "Instala",
    'L_INSTALL_HELP_PORT' => "(vacío = Puerto estándar)",
    'L_INSTALL_HELP_SOCKET' => "(vacío = Socket estándar)",
    'L_IS_WRITABLE' => "Se puede escribir",
    'L_KILL_PROCESS' => "Detener el proceso",
    'L_LANGUAGE' => "Idioma",
    'L_LASTBACKUP' => "Última copia de seguridad",
    'L_LOAD' => "Cargar config. inicial.",
    'L_LOAD_DATABASE' => "Refrescar la lista de BB.DD.",
    'L_LOAD_FILE' => "Cargar archivo",
    'L_LOG' => "Archivo de registro",
    'L_LOGFILENOTWRITABLE' => "No se puede escribir en el archivo de"
    ." registro (log)!",
    'L_LOGFILENOTWRITABLE' => "No se puede escribir en el fichero de"
    ." historial (log)!",
    'L_LOGFILES' => "Archivos de registro",
    'L_LOG_DELETE' => "Eliminar fichero de historial (log)",
    'L_MAILERROR' => "Se ha producido un error al intentar"
    ." enviar el email!",
    'L_MAILPROGRAM' => "Programa de correo electrónico",
    'L_MAXSIZE' => "Tamaño máximo",
    'L_MAX_BACKUP_FILES_EACH2' => "para cada base de datos",
    'L_MAX_EXECUTION_TIME' => "Tiempo máximo de ejecución",
    'L_MAX_UPLOAD_SIZE' => "Tamaño máximo del fichero",
    'L_MAX_UPLOAD_SIZE' => "Tamaño máximo del fichero",
    'L_MAX_UPLOAD_SIZE_INFO' => "Si el archivo de copia de seguridad es"
    ." mayor que el límite fijado, entonces"
    ." debe cargarlo a través de FTP en la"
    ." carpeta \"work/backup\". 
Después ese"
    ." archivo se mostrará aquí, y podrá"
    ." ser elegido para restaurar.",
    'L_MEMORY' => "Memoria",
    'L_MESSAGE' => "Mensaje",
    'L_MESSAGE_TYPE' => "Tipo de mensaje",
    'L_MINUTE' => "Minuto",
    'L_MINUTES' => "Minutos",
    'L_MODE_EASY' => "Sencillo",
    'L_MODE_EXPERT' => "Experto",
    'L_MSD_INFO' => "Información sobre MySQLDumper",
    'L_MSD_MODE' => "Modo MySQLDumper",
    'L_MSD_VERSION' => "Versión MySQLDumper",
    'L_MULTIDUMP' => "Múltiple dump",
    'L_MULTIDUMP_FINISHED' => "Copia de seguridad de <b>%d</b> bases"
    ." de datos resalizada",
    'L_MULTIPART_ACTUAL_PART' => "Sub archivo actual",
    'L_MULTIPART_SIZE' => "Tamaño máximo del archivo",
    'L_MULTI_PART' => "Copia de seguridad en múltiples"
    ." archivos",
    'L_MYSQLVARS' => "Variables de MySQL",
    'L_MYSQL_CLIENT_VERSION' => "Cliente MySQL",
    'L_MYSQL_CONNECTION_ENCODING' => "Codificación por defecto para"
    ." MySQL-Server",
    'L_MYSQL_DATA' => "Datos MySQL",
    'L_MYSQL_VERSION' => "Versión MySQL",
    'L_NAME' => "Nombre",
    'L_NAME' => "Nombre",
    'L_NEW' => "nuevo",
    'L_NEWTABLE' => "nueva tabla",
    'L_NEXT_AUTO_INCREMENT' => "Próximo indice automático",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. indice automatico",
    'L_NO' => "no",
    'L_NOFTPPOSSIBLE' => "Las funciones de FTP no están"
    ." disponibles!",
    'L_NOFTPPOSSIBLE' => "Las funciones de FTP no están"
    ." disponibles!",
    'L_NOFTPPOSSIBLE' => "Las funciones de FTP no están"
    ." disponibles!",
    'L_NOGZPOSSIBLE' => "Las funciones de compressión no"
    ." están disponibles!",
    'L_NOGZPOSSIBLE' => "Dado que Zlib no está instalado, no"
    ." puede usar las funciones de"
    ." compresión GZip!",
    'L_NONE' => "ninguno",
    'L_NOREVERSE' => "Mostrar las entradas más antiguas"
    ." primero",
    'L_NOTAVAIL' => "<em>no disponible</em>",
    'L_NOTICE' => "Legal",
    'L_NOTICES' => "Avisos",
    'L_NOT_ACTIVATED' => "inactivo",
    'L_NOT_SUPPORTED' => "Esta copia de seguridad no comprende"
    ." esta función.",
    'L_NO_DB_FOUND' => "No pude encontrar ninguna base de"
    ." datos de forma automática! Por favor,"
    ." mostrar los parámetros de conexión,"
    ." e introduzca el nombre de su base de"
    ." datos manualmente.",
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
    ." some server.<br />
You must enter your"
    ." databasename manually after the"
    ." installation is finished.
Click on"
    ." \"configuration\" \"Connection"
    ." Parameter - display\" and enter the"
    ." databasename there.",
    'L_NO_DB_SELECTED' => "No hay base de datos seleccionada.",
    'L_NO_ENTRIES' => "La tabla \"<b>%s</b>\" está vacía y"
    ." no contiene ninguna entrada.",
    'L_NO_MSD_BACKUPFILE' => "Copias de seguridad de otros programas",
    'L_NO_NAME_GIVEN' => "No ha introducido un nombre.",
    'L_NR_TABLES_OPTIMIZED' => "%s tablas optimizadas.",
    'L_NUMBER_OF_FILES_FORM' => "Cantidad de archivos de copia de"
    ." seguridad",
    'L_OF' => "de",
    'L_OF' => "de",
    'L_OK' => "Ok",
    'L_OPTIMIZE' => "Optimizar",
    'L_OPTIMIZE_TABLES' => "Optimizar las tablas antes de la copia"
    ." de seguridad",
    'L_OPTIMIZE_TABLE_ERR' => "No se ha podido optimizar la tabla"
    ." `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "La tabla `%s` ha sido optimizado con"
    ." éxito.",
    'L_OS' => "Sistema operativo",
    'L_PAGE_REFRESHS' => "Vistas de página",
    'L_PASS' => "Password",
    'L_PASSWORD' => "Contraseña",
    'L_PASSWORDS_UNEQUAL' => "¡Las contraseñas no son idénticos o"
    ." vacíos!",
    'L_PASSWORD_REPEAT' => "Contraseña (repetición)",
    'L_PASSWORD_STRENGTH' => "Fortaleza de la contraseña",
    'L_PERLOUTPUT1' => "Línea a escribir en crondump.pl para"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "Ejecutar desde el navegador o desde un"
    ." Cronjob externo al servidor",
    'L_PERLOUTPUT3' => "Ejecutar desde Shell o como entrada en"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Completo-Perl-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "¡Bug en zlib! No es posible comprimir"
    ." archivos!",
    'L_PHPMAIL' => "Función PHP mail()",
    'L_PHP_EXTENSIONS' => "Extensiones de PHP",
    'L_PHP_VERSION' => "Versión PHP",
    'L_POP3_PORT' => "Puerto POP3",
    'L_POP3_SERVER' => "Servidor POP3",
    'L_PORT' => "Puerto",
    'L_PORT' => "Puerto",
    'L_POSITION_BC' => "abajo en el centro",
    'L_POSITION_BL' => "abajo a la izquierda",
    'L_POSITION_BR' => "abajo a la derecha",
    'L_POSITION_MC' => "en el medio centrado",
    'L_POSITION_ML' => "en el medio a la izquierda",
    'L_POSITION_MR' => "en el medio a la derecha",
    'L_POSITION_NOTIFICATIONS' => "Posición de la ventana del mensaje",
    'L_POSITION_TC' => "arriba en el centro",
    'L_POSITION_TL' => "arriba a la izquierda",
    'L_POSITION_TR' => "arriba a la derecha",
    'L_PREFIX' => "Prefijo",
    'L_PRIMARYKEYS_CHANGED' => "Clave principal cambiada",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error al cambiar la clave principal",
    'L_PRIMARYKEYS_SAVE' => "Guardar las claves principales",
    'L_PRIMARYKEY_CONFIRMDELETE' => "¿Realmente desea eliminar la clave"
    ." principal?",
    'L_PRIMARYKEY_DELETED' => "Clave principal eliminada",
    'L_PRIMARYKEY_FIELD' => "Campo de clave principal",
    'L_PRIMARYKEY_NOTFOUND' => "Clave principal no encontrada",
    'L_PROCESSKILL1' => "Se intentará, terminar el proceso",
    'L_PROCESSKILL2' => ".",
    'L_PROCESSKILL3' => "Se ha intentado desde hace",
    'L_PROCESSKILL4' => "seg. para eliminar el proceso",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progreso de archivo",
    'L_PROGRESS_OVER_ALL' => "Progreso total",
    'L_PROGRESS_OVER_ALL' => "Progreso total",
    'L_PROGRESS_TABLE' => "Progreso de la tabla actual",
    'L_PROVIDER' => "Proveedor",
    'L_PROZESSE' => "Proceso",
    'L_RECHTE' => "derechos",
    'L_RECORDS' => "registros",
    'L_RECORDS_INSERTED' => "<b>%s</b> registros insertados.",
    'L_RECORDS_PER_PAGECALL' => "Registros por página vista",
    'L_REFRESHTIME' => "Intervalo de actualización",
    'L_REFRESHTIME_PROCESSLIST' => "Intervalo de actualización de la"
    ." lista de proceso",
    'L_RELOAD' => "Cargar de nuevo",
    'L_REMOVE' => "Eliminar",
    'L_REPAIR' => "Reparar",
    'L_RESET' => "Volver",
    'L_RESET_SEARCHWORDS' => "Reinicializar criterios de búsqueda",
    'L_RESTORE' => "Restaurar",
    'L_RESTORE_COMPLETE' => "<b>%s</b> Las tablas han sido"
    ." importadas.",
    'L_RESTORE_DB' => "la base de datos '<b>%s</b>' en"
    ." '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restablecimiento de la base de datos"
    ." '%s' se ha completado en %s.",
    'L_RESTORE_OF_TABLES' => "Elija las tablas a restaurar",
    'L_RESTORE_TABLE' => "Restablecer la tabla '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Hasta el momento, se han recuperado"
    ." <b>%d</b> de <b>%d</b> tablas.",
    'L_RESTORE_TABLES_COMPLETED0' => "Hasta el momento, se han recuperado"
    ." <b>%d</b> tablas.",
    'L_REVERSE' => "Mostrar las entradas más nuevas"
    ." primero",
    'L_SAFEMODEDESC' => "Debido a que en este servidor está"
    ." ejecutándose PHP en modo seguro"
    ." (safe_mode),necesita crear los"
    ." siguientes directorios manualmente"
    ." utilizando su programa de FTP:",
    'L_SAVE' => "Guardar",
    'L_SAVEANDCONTINUE' => "Guardar y seguir con la instalación",
    'L_SAVE_ERROR' => "¡La configuración no ha podido ser"
    ." guardada!",
    'L_SAVE_SUCCESS' => "La configuración se ha guardado con"
    ." éxito en el archivo de configuración"
    ." \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Guardar el contenido de la database"
    ." '%s' en el archivo '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Tamaño máximo alcanzado: Continuar"
    ." con el archivo '%s'",
    'L_SAVING_DB_FORM' => "Base de datos",
    'L_SAVING_TABLE' => "Guardando tabla",
    'L_SEARCH_ACCESS_KEYS' => "Navegar:
Adelante=ALT+V
Atrás=ALT+C",
    'L_SEARCH_IN_TABLE' => "Buscar en la tabla",
    'L_SEARCH_NO_RESULTS' => "¡La búsqueda para \"<b>%s</b>\" en"
    ." la tabla \"<b>%s</b>\" no produjo"
    ." ningún resultado!",
    'L_SEARCH_OPTIONS' => "Opciones de búsqueda",
    'L_SEARCH_OPTIONS_AND' => "una columna debe contener todos los"
    ." términos de búsqueda (Y-Búsqueda)",
    'L_SEARCH_OPTIONS_CONCAT' => "Una línea debe contener todos los"
    ." términos de búsqueda, pero estos"
    ." puede ser en cualquiera de las"
    ." columnas (¡podría tardar!)",
    'L_SEARCH_OPTIONS_OR' => "Una columna debe contener al menos un"
    ." criterio de búsqueda (O-Búsqueda)",
    'L_SEARCH_RESULTS' => "La búsqueda para \"<b>%s</b>\" en la"
    ." tabla \"<b>%s</b>\" produjo los"
    ." siguientes resultados",
    'L_SECOND' => "Segundo",
    'L_SECONDS' => "Segundos",
    'L_SELECT' => "Seleccione",
    'L_SELECTALL' => "seleccionar todas",
    'L_SELECTED_FILE' => "archivo elegido",
    'L_SELECT_FILE' => "Seleccione archivo",
    'L_SELECT_LANGUAGE' => "Seleccionar idioma",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "Enviar resultados como archivo",
    'L_SEND_MAIL_FORM' => "Enviar un correo electrónico",
    'L_SERVER' => "Servidor",
    'L_SERVERCAPTION' => "Nombre del servidor",
    'L_SETPRIMARYKEYSFOR' => "Establecer nueva clave principal para"
    ." la tabla",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Muestra los datos de %s hasta %s de %s",
    'L_SHOWRESULT' => "Mostrar resultados",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "Servidor SMTP",
    'L_SMTP_PORT' => "Puerto STMP",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Rapidez",
    'L_SQLBOX' => "Ventana SQL",
    'L_SQLBOXHEIGHT' => "Altura de la ventana SQL",
    'L_SQLLIB_ACTIVATEBOARD' => "activar foro",
    'L_SQLLIB_BOARDS' => "Foros",
    'L_SQLLIB_DEACTIVATEBOARD' => "desactivar foro",
    'L_SQLLIB_GENERALFUNCTIONS' => "funciones generales",
    'L_SQLLIB_RESETAUTO' => "reinicializar autoincremento",
    'L_SQLLIMIT' => "Cantidad de registros por página",
    'L_SQL_ACTIONS' => "Acciones",
    'L_SQL_AFTER' => "siguiente",
    'L_SQL_ALLOWDUPS' => "Se permiten duplicados",
    'L_SQL_ATPOSITION' => "insertar en la posición",
    'L_SQL_ATTRIBUTES' => "Atributos",
    'L_SQL_BACKDBOVERVIEW' => "volver a la vista de bases de datos",
    'L_SQL_BEFEHLNEU' => "nuevo comando",
    'L_SQL_BEFEHLSAVED1' => "El comando SQL",
    'L_SQL_BEFEHLSAVED2' => "ha sido insertado",
    'L_SQL_BEFEHLSAVED3' => "ha sido guardado",
    'L_SQL_BEFEHLSAVED4' => "ha sido desplazado hacia arriba",
    'L_SQL_BEFEHLSAVED5' => "ha sido eliminado",
    'L_SQL_BROWSER' => "Navegador-SQL",
    'L_SQL_CARDINALITY' => "Cardinalidad",
    'L_SQL_CHANGED' => "ha sido modificado.",
    'L_SQL_CHANGEFIELD' => "modificar campo",
    'L_SQL_CHOOSEACTION' => "Elija una acción",
    'L_SQL_COLLATENOTMATCH' => "¡Este juego de caracteres y el orden"
    ." solicitado no pueden funcionar juntos!",
    'L_SQL_COLUMNS' => "columnas",
    'L_SQL_COMMANDS' => "Comandos SQL",
    'L_SQL_COMMANDS_IN' => "líneas en",
    'L_SQL_COMMANDS_IN2' => "registros modificados por segundo.",
    'L_SQL_COPYDATADB' => "Copiar contenido de la base de datos",
    'L_SQL_COPYSDB' => "Copiar estructura en la base de datos",
    'L_SQL_COPYTABLE' => "Copiar tabla",
    'L_SQL_CREATED' => "ha sido insertado.",
    'L_SQL_CREATEINDEX' => "crear nuevo índice",
    'L_SQL_CREATETABLE' => "Crear tabla",
    'L_SQL_DATAVIEW' => "Vista de datos",
    'L_SQL_DBCOPY' => "El contenido de la base de datos `%s`"
    ." ha sido copiado a la base de datos"
    ." `%s`.",
    'L_SQL_DBSCOPY' => "La estructura de la base de datos `%s`"
    ." ha sido copiado a la base de datos"
    ." `%s`.",
    'L_SQL_DELETED' => "ha sido eliminado",
    'L_SQL_DELETEDB' => "eliminar base de datos",
    'L_SQL_DESTTABLE_EXISTS' => "¡La tabla de destino ya existe!",
    'L_SQL_EDIT' => "editar",
    'L_SQL_EDITFIELD' => "editar campo",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Modificar la estructura de la tabla",
    'L_SQL_EMPTYDB' => "vaciar base de datos",
    'L_SQL_ERROR1' => "Error de ejecución:",
    'L_SQL_ERROR2' => "MySQL informa:",
    'L_SQL_EXEC' => "ejecutar comando SQL",
    'L_SQL_EXPORT' => "Exportar la base de datos `%s`",
    'L_SQL_FIELDDELETE1' => "El campo",
    'L_SQL_FIELDNAMENOTVALID' => "ERROR: nombre de campo inválido",
    'L_SQL_FIRST' => "primero",
    'L_SQL_IMEXPORT' => "Im-/Exportar",
    'L_SQL_IMPORT' => "Importar a la base de datos `%s`",
    'L_SQL_INDEXES' => "índices",
    'L_SQL_INSERTFIELD' => "insertar campo",
    'L_SQL_INSERTNEWFIELD' => "insertar nuevo campo",
    'L_SQL_LIBRARY' => "Librería SQL",
    'L_SQL_NAMEDEST_MISSING' => "¡Falta el nombre de destino!",
    'L_SQL_NEWFIELD' => "nuevo campo",
    'L_SQL_NODATA' => "No hay registros que mostrar",
    'L_SQL_NODEST_COPY' => "¡Sin destino, no se puede copiar"
    ." nada!",
    'L_SQL_NOFIELDDELETE' => "Eliminación imposible, ya que la"
    ." tabla debe contener al menos un campo.",
    'L_SQL_NOTABLESINDB' => "No hay ninguna tabla en la base de"
    ." datos",
    'L_SQL_NOTABLESSELECTED' => "¡No se han seleccionado tablas!",
    'L_SQL_OPENFILE' => "Abrir archivo SQL",
    'L_SQL_OPENFILE_BUTTON' => "Subir",
    'L_SQL_OUT1' => "Se han ejecutado",
    'L_SQL_OUT2' => "comandos",
    'L_SQL_OUT3' => "Hubo",
    'L_SQL_OUT4' => "comentarios",
    'L_SQL_OUT5' => "Dado que el comando afecta más de"
    ." 5000 registros, no se mostrarán los"
    ." resultados.",
    'L_SQL_OUTPUT' => "Salida de SQL",
    'L_SQL_QUERYENTRY' => "La consulta contiene",
    'L_SQL_RECORDDELETED' => "Registro eliminado",
    'L_SQL_RECORDEDIT' => "editar registro",
    'L_SQL_RECORDINSERTED' => "Registro insertado",
    'L_SQL_RECORDNEW' => "insertar registro",
    'L_SQL_RECORDUPDATED' => "Registro actualizado",
    'L_SQL_RENAMEDB' => "renombrar base de datos",
    'L_SQL_RENAMEDTO' => "ha sido renombrada a",
    'L_SQL_SCOPY' => "La estructura de tabla de `%s` ha sido"
    ." copiada en la tabla `%s`.",
    'L_SQL_SEARCH' => "Búsqueda",
    'L_SQL_SEARCHWORDS' => "Palabra(s) de búsqueda",
    'L_SQL_SELECTTABLE' => "elegir tabla",
    'L_SQL_SHOWDATATABLE' => "mostrar los datos de la tabla",
    'L_SQL_STRUCTUREDATA' => "estructura y datos",
    'L_SQL_STRUCTUREONLY' => "solamente estructura",
    'L_SQL_TABLEEMPTIED' => "La tabla `%s` ha sido vaciada.",
    'L_SQL_TABLEEMPTIEDKEYS' => "La tabla `%s` ha sido eliminada, y los"
    ." índices reinicializados.",
    'L_SQL_TABLEINDEXES' => "Índices de la tabla",
    'L_SQL_TABLENEW' => "Modificar tabla",
    'L_SQL_TABLENOINDEXES' => "La tabla no contiene ningún índice",
    'L_SQL_TABLENONAME' => "¡La tabla necesita un nombre!",
    'L_SQL_TABLESOFDB' => "Tablas de la base de datos",
    'L_SQL_TABLEVIEW' => "Vista de tablas",
    'L_SQL_TBLNAMEEMPTY' => "¡El nombre de la tabla no puede estar"
    ." vacío!",
    'L_SQL_TBLPROPSOF' => "Propiedades de tabla de",
    'L_SQL_TCOPY' => "La tabla `%s` ha sido copiada (con sus"
    ." datos), en la tabla `%s`.",
    'L_SQL_UPLOADEDFILE' => "Fichero cargado:",
    'L_SQL_VIEW_COMPACT' => "Ver: Compacto",
    'L_SQL_VIEW_STANDARD' => "Ver: Normal",
    'L_SQL_VONINS' => "de un total de",
    'L_SQL_WARNING' => "La ejecución de comandos SQL sirve"
    ." para manipular directamente los datos"
    ." de la base de datos. Los autores no se"
    ." responsabilizarán de la pérdida de"
    ." datos ocurrida debido al uso de esta"
    ." utilidad.",
    'L_SQL_WASCREATED' => "ha sido creada con éxito",
    'L_SQL_WASEMPTIED' => "ha sido vaciada",
    'L_STARTDUMP' => "iniciar copia de seguridad",
    'L_START_RESTORE_DB_FILE' => "Inicie la recuperación de database"
    ." '%s' del archivo '%s'.",
    'L_START_SQL_SEARCH' => "Iniciar búsqueda",
    'L_STATUS' => "Estado",
    'L_STATUS' => "Estado",
    'L_STEP' => "Paso",
    'L_SUCCESS_CONFIGFILE_CREATED' => "El archivo de configuración \"%s\" se"
    ." ha creado correctamente.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "El archivo de configuración \"%s\" ha"
    ." sido eliminado.",
    'L_TABLE' => "Tabla",
    'L_TABLES' => "Tablas",
    'L_TABLESELECTION' => "Elección de tablas",
    'L_TABLE_CREATE_SUCC' => "La tabla '%s' se ha creado"
    ." correctamente.",
    'L_TABLE_TYPE' => "Tipo",
    'L_TESTCONNECTION' => "Probar conexión",
    'L_THEME' => "Tema",
    'L_TIME' => "Tiempo",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Índice",
    'L_TITLE_KEY_FULLTEXT' => "Clave texto completo",
    'L_TITLE_KEY_PRIMARY' => "Clave principal",
    'L_TITLE_KEY_UNIQUE' => "Clave única",
    'L_TITLE_MYSQL_HELP' => "Documentación de MySQL",
    'L_TITLE_NOKEY' => "No hay clave",
    'L_TITLE_SEARCH' => "Búsqueda",
    'L_TITLE_SHOW_DATA' => "Ver datos",
    'L_TITLE_UPLOAD' => "Subir archivo SQL",
    'L_TO' => "hasta",
    'L_TOOLS' => "Herramientas",
    'L_TOOLS' => "Herramientas",
    'L_TOOLS_TOOLBOX' => "Elección de base de datos / Funciones"
    ." de base de datos / Im- y Exportar",
    'L_UNIT_KB' => "Kilobyte",
    'L_UNIT_MB' => "Megabyte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "desconocido",
    'L_UNKNOWN_SQLCOMMAND' => "comando SQL desconocido",
    'L_UPDATE' => "Actualizar",
    'L_UPTO' => "hasta",
    'L_USERNAME' => "Nombre de usuario",
    'L_USE_SSL' => "Usar SSL",
    'L_VALUE' => "Contenido",
    'L_VERSIONSINFORMATIONEN' => "Versión",
    'L_VIEW' => "ver",
    'L_VISIT_HOMEPAGE' => "Visite el sitio web",
    'L_VOM' => "de",
    'L_WITH' => "con",
    'L_WITHATTACH' => "con fichero adjunto",
    'L_WITHOUTATTACH' => "sin fichero adjunto",
    'L_WITHPRAEFIX' => "con prefijo",
    'L_WRONGCONNECTIONPARS' => "Conexión errónea o sin parámetros !",
    'L_WRONG_CONNECTIONPARS' => "¡Parámetros de conexión"
    ." incorrectos!",
    'L_WRONG_RIGHTS' => "El archivo o directorio '%s' no tiene"
    ." permisos de escritura para mi.<br"
    ." />
Los permisos (chmod) están mal"
    ." configurados o el propietario no es"
    ." correcto.<br />
Por favor, compruebe"
    ." los atributos utilizando su software"
    ." de FTP.<br />
El archivo o directorio"
    ." debe ser configurado a %s.",
    'L_YES' => "si",
));
