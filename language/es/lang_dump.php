<?php
$lang['dump_headline']="Creando copia de seguridad...";
$lang['gzip_compression']="La compresión GZip";
$lang['saving_table']="Guardando tabla ";
$lang['of']="de";
$lang['actual_table']="Tabla actual";
$lang['progress_table']="Progreso de la tabla actual";
$lang['progress_over_all']="Progreso total";
$lang['entry']="Registro";
$lang['done']="Finalizado!";
$lang['dump_successful']=" ha sido realizado con éxito.";
$lang['upto']="hasta";
$lang['email_was_send']="Se ha enviado un email a ";
$lang['back_to_control']="seguir";
$lang['back_to_overview']="vista de base de datos";
$lang['dump_filename']="Archivo de backup: ";
$lang['withpraefix']="con prefijo";
$lang['dump_notables']="No se han encontrado tablas en la base de datos `<b>%s</b>` ";
$lang['dump_endergebnis']="<b>%s</b> Tablas con un total de <b>%s</b> registros, han sido guardadas con éxito.<br>";
$lang['mailerror']="Se ha producido un error al intentar enviar el email!";
$lang['emailbody_attach']="En el fichero adjunto encontrará la copia de seguridad de su base de datos MySQL.<br>Copia de seguridad de la base de datos `%s`
<br><br>Se ha creado el siguiente archivo:<br><br>%s <br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="Se ha realizado un backup de archivos múltiples.<br>Los archivos no se adjuntan a este email!<br>Copia de seguridad de la base de datos `%s`
<br><br>Los siguientes archivos han sido adjuntados:<br><br>%s
<br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="Se ha realizado un backup de archivos múltiples.<br>Los archivos se adjuntan a emails separados!<br>Copia de seguridad de la base de datos `%s`
<br><br>Los siguientes archivos han sido adjuntados:<br><br>%s <br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="<br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="La copia de seguridad ha sobrepasado el tamaño máximo de %s y por lo tanto no ha sido adjuntada.<br>Copia de seguridad de la base de datos `%s`
<br><br>Se ha creado el siguiente archivo:<br><br>%s <br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="No se adjunta el archivo de copia de seguridad.<br>Copia de seguridad de la base de datos `%s`
<br><br>Se ha creado el siguiente archivo:<br><br>%s <br><br><br>Saludos de<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... solamente el fichero adjunto";
$lang['tableselection']="Elección de tablas";
$lang['selectall']="seleccionar todas
";
$lang['deselectall']="seleccionar todas";
$lang['startdump']="iniciar copia de seguridad";
$lang['lastbufrom']="última actualización el";
$lang['not_supported']="Esta copia de seguridad no comprende esta función.";
$lang['multidump']="Copia múltiple, copia de seguridad de <b>%d</b> bases de datos resalizada.";
$lang['filesendftp']="envío del archivo vía FTP... tenga un poco de paciencia, por favor. ";
$lang['ftpconnerror']="Conexión no establecida! Conectarse a ";
$lang['ftpconnerror1']=" con el usuario ";
$lang['ftpconnerror2']=" ha sido imposible";
$lang['ftpconnerror3']="El envío por FTP ha fallado! ";
$lang['ftpconnected1']="Conectado con ";
$lang['ftpconnected2']=" en ";
$lang['ftpconnected3']=" escritos";
$lang['nr_tables_selected']="- con %s tablas seleccionadas";
$lang['nr_tables_optimized']="<span class=\"small\">%s tablas optimizadas.</span>";
$lang['dump_errors']="<p class=\"error\">Ha(n) ocurrido %s error(es): <a href=\"log.php?r=3\">visualizar</a></p>";
$lang['fatal_error_dump']="Fatal error: the CREATE-Statement of table '%s' in database '%s' couldn't be read!<br>
Check this table for errors.";


?>