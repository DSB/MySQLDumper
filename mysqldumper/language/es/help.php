<?php
if(file_exists("./../../work/config/parameter.php")){
	@include("./../../work/config/parameter.php");
}
@include("./../../inc/functions_global.php");
@include("./../../language/".$config["language"]."/lang.php");
@include("./../../language/".$config["language"]."/lang_help.php");
echo MSDHeader(2);
echo headline($lang['credits']);
?>
<div id="content">
<h3>Sobre este proyecto </h3>
La idea para este proyecto proviene de Daniel Schlichholz.
<p>En 2004 abri&oacute; el foro <a href="http://www.mysqldumper.de/board" target="_blank">MySQLDumper</a> e inmediatamente algunos aficionados a la programaci&oacute;n se encontraron all&iacute;, para escribir y ampliar la versi&oacute;n inicial de los scripts de Daniel.<br>
En poco tiempo qued&oacute; establecido el proyecto de realizar un script de copia de seguridad.
<p>Si tiene Vd. alguna propuesta de mejora, notif&iacute;quela en el foro de MySQLDumper-Forum: <a href="http://www.mysqldumper.de/board" target="_blank">http://www.mysqldumper.de/board</a>.
<p>Le deseamos que disfrute del trabajo realizado en este proyecto.<br>
<p>
<h4>El equipo de MySQLDumper</h4>

<table><tr><td><img src="../../images/logo.gif" alt="MySQLDumper" width="160" height="42" border="1"></td><td valign="top">
Daniel Schlichtholz - Steffen Kamper<br>
Perlscript con ayuda de Detlev Richter<br>
</td></tr></table>
<br>

<h3>Ayuda de MySQLDumper</h3>


<h4>Descarga</h4>
Este script puede descargarlo desde la p&aacute;gina principal de MySQLDumper.<br>
Se recomienda que visite dicha p&aacute;gina regularmente, para mantener el producto actualizado y poder descargar las ampliaciones que se vayan realizando.<br>
La direcci&oacute;n es: <a href="http://www.mysqldumper.de/board" target="_blank">
http://www.mysqldumper.de/board
</a>

<h4>Requisitos del sistema </h4>
<p>El script funciona en cualquier servidor (Windows, Linux, ...) que soporte una versi&oacute;n de PHP superior a la 4.3.4
(con GZip instalado) <br>
y con MySQL a partir de la versi&oacute;n 3.23</p>
<p>Adem&aacute;s, debe tener activado el ejecutar secuencias de comandos  JavaScript en su navegador.</p>
<a href="../../install.php?language=de" target="_top">
<h4>Instalaci&oacute;n</h4>
</a>
La instalaci&oacute;n es muy sencilla. Simplemente extraiga los ficheros (conservando la estructura de directorios) en una carpeta cualquiera.<br>
Suba (por FTP u otros medios) dichos ficheros a su servidor web. (por ejemplo, [directorio web de su servidor]/MySQLDumper)<br>
... listo!<br>
Ahora puede ejecutar MySQLDumper desde su navegador llam&aacute;ndolo desde la direcci&oacute;n "http://www.su_servidor.com/MySQLDumper", para iniciar el proceso de configuraci&oacute;n, para el que simplemente debe seguir las instrucciones en pantalla.<br>
<br><b>Aviso:</b><br>
<i>En caso de que su servidor tenga activado el modo seguro de PHP, el script no podr&aacute; crear los directorios que necesita.<br>
Si es as&iacute;, deber&aacute; hacerlo Vd. de forma manual, seg&uacute;n las instrucciones del proceso de configuraci&oacute;n.<br>
Tras haber creado dichos directorios, todo funcionar&aacute; normalmente y sin restricciones.</i>

<a name="perl"></a>
<h4>Instrucciones para la instalaci&oacute;n del script Perl</h4>
<p>En la mayor&iacute;a de los casos, el servidor dispondr&aacute; de un directorio llamado cgi-bin (o perl) desde el que pueden ejecutarse scripts perl. <br>
  Dichos scripts se podr&aacute;n acceder desde su navegador mediante la direcci&oacute;n http://www.su_servidor.com/cgi-bin/ . <br>
  <br>
Si este es su caso, siga las instrucciones siguientes:<br>
<br>
1. Ejecute MySQLDumper desde su navegador, y vaya a la p&aacute;gina de and click "Backup Perl"<br>
2. Copie el camino que aparece en la secci&oacute;n de propiedades del Cronscript Perl, al lado de $absolute_path_of_configdir: . <br>
3. Abra el fichero "crondump.pl" en un editor cualquiera de texto.<br>
4. Pegue el camino copiado en la entrada absolute_path_of_configdir (sin espacios vac&iacute;os). Hay una muestra dos l&iacute;neas por encima. <br>
5. Guarde "crondump.pl".<br>
6. Copie los ficheros "crondump.pl", as&iacute; como "perltest.pl" y "simpletest.pl" en el directorio cgi-bin (h&aacute;galo en modo ASCII si usa FTP).<br>
7. D&eacute; a dichos ficheros los derechos 0x755 (use chmod desde shell o desde su programa de FTP).<br>
7b. En caso de ser neesaria la extensi&oacute;n "cgi" para los scripts, c&aacute;mbiela en los tres ficheros de "pl" a "cgi" (cambiar nombre).<br>
8. Vaya a la p&aacute;gina de
<?php echo $lang['config']?>
en MySQLDumper.<br>
9. Elija el apartado Cronscript.<br>
10. Cambie el Camino al Cronscript a "/cgi-bin/" (sin comillas). <br>
10b. Si ha renombrado los scripts a ".cgi", cambie la extensi&oacute;n de los scripts a ".cgi".<br>
11. Guarde la configuraci&oacute;n.<br>
<br>
Ya ha terminado. Ahora puede llamar los scripts desde la p&aacute;gina de
<?php echo $lang['config']?>
. Le recomendamos que pruebe primero tanto Perl como los M&oacute;dulos Perl, usando los botones apropiados para ello. Si no funciona alguno de los dos, es probable que no pueda utilizar su script.<br>
<br>
Aquellos usuarios que pueden ejecutar Perl en cualquier directorio, pueden alternativamente, seguir los pasos siguientes (m&aacute;s sencillos):<br>
<br>
1. Ejecute MySQLDumper desde su navegador, y vaya a la p&aacute;gina de
<?php echo $lang['config']?>
<br>
2. Copie el camino que aparece en la secci&oacute;n de propiedades del Cronscript Perl, al lado de $absolute_path_of_configdir: . <br>
3. Abra el fichero "crondump.pl" en un editor cualquiera de texto.<br>
4. Pegue el camino copiado en la entrada absolute_path_of_configdir (sin espacios vac&iacute;os). Hay una muestra dos l&iacute;neas por encima. <br>
5. Guarde "crondump.pl" (si lo ha editado en local, s&uacute;balo nuevamente al servidor).<br>
6. D&eacute; a los ficheros "crondump.pl", as&iacute; como "perltest.pl" y "simpletest.pl", los derechos 0x755 (use chmod desde shell o desde su programa de FTP).<br>
7. En caso de ser neesaria la extensi&oacute;n "cgi" para los scripts, c&aacute;mbiela en los tres ficheros de "pl" a "cgi" (cambiar nombre).<br>
8. Si ha renombrado los scripts a ".cgi", vaya a la p&aacute;gina de
<?php echo $lang['config']?>
en MySQLDumper, elija el apartado Cronscript y cambie la extensi&oacute;n de los scripts a ".cgi". Guarde la configuraci&oacute;n.<br>
  <br>

  <b>Nota:</b> Tanto los usuarios de Windows como los usuarios de servidores con configuraciones no est&aacute;ndar, deber&aacute;n cambiar en los tres scripts la primera l&iacute;nea para reflejar el camino correcto de Perl. Por ejemplo: <br>
en vez de: #!/usr/bin/perl -w <br>
ponga: #!C:\perl\bin\perl.exe -w <br>
</p>
<h4>Instrucciones de uso</h4>

<h6>Men&uacute;</h6>
<p>En el desplegable superior se encuentra la lista de bases de datos disponibles para trabajar con ellas. Tenga en cuenta que no necesariamente tendr&aacute; permiso para trabajar con todas ellas, s&oacute;lo aquellas en las que su usuario tenga permisos podr&aacute;n ser realmente accedidas. Las dem&aacute;s le dar&aacute;n simplemente un error.<br />
Todas las acciones se refieren siempre a la base de datos seleccionada en este desplegable.</p>

<ul>
	<h6><?php echo $lang['home']?></h6>
	<p>Aqu&iacute; encontrar&aacute; algunas propiedades de su sistema, como las versiones instaladas y algunos detalles de la base de datos.<br />
    Los botones superiores le permitir&aacute;n acceder a las diferentes opciones, que tendr&aacute;n m&aacute;s o menos sentido seg&uacute;n el nivel de privilegios de su usuario de base de datos:</p>
	<ul><li><b><?php echo $lang['Statusinformationen']?></b> le mostrar&aacute; las informaciones gen&eacute;ricas, pudiendo adem&aacute;s acceder a algunas de ellas en particular, para ampliarlas.</li>
	  <li><b><?php echo $lang['dbs']?></b> le llevar&aacute; a la lista de las mismas, pudiendo crear otras nuevas. Si hace click en alguna de ellas, se le llevar&aacute; a un men&uacute; avanzado d&oacute;nde se le mostrar&aacute;n las tablas que contiene y distintas opciones para con ellas. </li>
	  <li><b><?php echo $lang['mysqlvars']?></b> le mostrar&aacute; respectivamente los procesos, el estado y las opciones y definiciones del servidor de base de datos MySQL. </li>
	  <li><b><?php echo $lang['mysqlsys']?></b> le permitir&aacute; acceder a una pseudoconsola del servidor de bases de datos y realizar operaciones complejas con el mismo. Nota: para poder utilizar dichas opciones, deber&aacute; tener los privilegios adecuados en el servidor MySQL.</li>
	</ul>
	<p>Otra de las opciones importantes de este men&uacute;, es la creaci&oacute;n o modificaci&oacute;n de los ficheros .htaccess. Dichos ficheros gestionan directamente la seguridad de los directorios y es importante por ejemplo, que no cualquier visitante pueda acceder a los datos de su base de datos mediante este programa. Por ello se recomienda encarecidamente utilizar dicha opci&oacute;n (o cualquier otra de que disponga) para proteger esta aplicaci&oacute;n de usos indebidos. No obstante tenga en cuenta que hacerlo de forma err&oacute;nea puede impedirle a Vd. mismo el acceso. Si le sucede esto, no se preocupe, acceda al directorio mediante FTP o mediante su gestor de archivos habitual, y elimine el fichero .htaccess para desprotegerlo y poder volver a acceder normalmente al mismo.</p>
	<h6><?php echo $lang['config']?></h6>
	<p>Aqu&iacute; puede cambiar todos los datos de configuraci&oacute;n del programa, guardar una copia de seguridad de la configuraci&oacute;n, cargar una configuraci&oacute;n preexistente, o volver a los valores iniciales de instalaci&oacute;n.</p>
	<ul>
		<li><b><?php echo $lang['dbs']?></b> le permite cambiar los par&aacute;metros de conexi&oacute;n (haga click en mostrar / esconder) del usuario de base de datos.  Si hay m&aacute;s de una base de datos, puede elegir hacer un volcado m&uacute;ltiple e incluir m&aacute;s de una bases de datos en la copia de seguridad (la base de datos actual se muestra siempre en <b>negrita</b>). Adem&aacute;s, podr&aacute; seleccionar las tablas que ser&aacute;n incluidas en la copia de seguridad mediante un prefijo.</li>
		<ul>
		  <li><a name="conf1"></a><b><?php echo $lang['help_db']?></b> muestra un listado de todas las bases de datos accesibles. Si ha especificado en los par&aacute;metros de conexi&oacute;n, que solamente se muestre un tipo una base de datos, solamente aparecer&aacute; &eacute;sta. Si hay m&aacute;s de una base de datos accesible, puede elegir hacer un volcado m&uacute;ltiple e incluir m&aacute;s de una bases de datos en la copia de seguridad (la base de datos actual se muestra siempre en <b>negrita</b>). Adem&aacute;s, podr&aacute; seleccionar las tablas de cada base de datos que deben ser incluidas en la copia de seguridad mediante un prefijo, excluyendo las que no contengan el mismo.</li>
		  <li><a name="conf2"></a><?php echo $lang['help_praefix']?> es el prefijo que puede especificar para seleccionar tablas de una base de datos. Por ejemplo puede especificar solamente aquellas tablas que empiecen con el prefijo "phpBB_". Si desea hacer una copia de seguridad de toda la base de datos, deje este campo en blanco.</li>
		</ul>
		<li><b><?php echo $lang['general']?></b> sirve para elegir las caracter&iacute;sticas gen&eacute;ricas de las copias de seguridad (compresi&oacute;n, memoria, velocidad [ALERTA: la velocidad excesiva puede provocar que el servidor deje de responder (timeout)], archivos de registro o logs, si se deben optimizar las tablas antes de hacer la copia, etc...) y de la restauraci&oacute;n de datos (si se deben vaciar las tablas antes de hacerla, si se debe detener la importaci&oacute;n en caso de errores).</li>
		<ul>
		  <li><a name="conf3"></a><b><?php echo $lang['gzip']?></b> permite activar la compresi&oacute;n de los archivos. Se recomienda activarla, si el m&oacute;dulo GZIP est&aacute; disponible en su servidor, ya que el tama&ntilde;o de los archivos se reduce sensiblemente.</li>
		  <li><a name="conf4"></a><?php echo $lang['empty_db_before_restore']?>
       permite vaciar el contenido de la base de datos totalmente antes de realizar la recuperaci&oacute;n de datos de una copia de seguridad existente. Es recomendable en caso de recuperar una serie de tablas que se hayan corrompido. En caso de duda, se recomienda dejarlo desactivado, puesto que si realiza una recuperaci&oacute;n parcial de algunas tablas, se eliminar&iacute;an antes todas las tablas existentes, aunque no se encuentren presentes en la copia de seguridad a recuperar.</li>
		</ul>
		<li><b><?php echo $lang['config_interface']?></b> permite elegir las caracter&iacute;sticas gr&aacute;ficas de la interfaz del programa. Puede elegir idioma, tema, definir algunos tama&ntilde;os de ventana, incluso decidir si desea que aparezca el nombre del servidor en que se encuentra en este momento, y en qu&eacute; lugar. La elecci&oacute;n del navegador que utiliza es importante, ya que si lo hace de forma incorrecta, el programa no funcionar&aacute; correctamente. </li>
		<ul>
			<li><a name="conf11"></a><b><?php echo $lang["help_lang"]?>:</b> aqu&iacute; puede seleccionar el idioma para el interfaz gr&aacute;fico.</li>
		</ul>
		<li><b><?php echo $lang['config_autodelete']?></b> define los par&aacute;metros que determinan si se van a eliminar archivos de copia de seguridad de forma autom&aacute;tica o no.</li>
		<ul>
			<li><a name="conf8"></a><b><?php echo $lang["help_ad1"]?>:</b> activa o desactiva la eliminaci&oacute;n augom&aacute;tica. Si est&aacute; activado, se eliminar&aacute;n los archivos necesarios (seg&uacute;n las reglas definidas a continuaci&oacute;n) antes de iniciar una nueva copia de seguridad. Es una opci&oacute;n &uacute;til para ahorrar espacio en el servidor, pero le recomendamos que no la active antes de haber podido probar el funcionamiento correcto del programa.</li>
			<li><a name="conf9"></a><b><?php echo $lang["help_ad2"]?>:</b> un valor mayor que cero elimina todos los archivos de copia de seguridad que tengan mayor antig&uuml;edad que la escrita.</li>
			<li><a name="conf10"></a><b><?php echo $lang["help_ad3"]?>:</b> un valor mayor que cero elimina todos los archivos de copia de seguridad en exceso del n&uacute;mero especificado, bien en total, bien para cada base de datos distinta.</li>
		</ul>
		<li><b><?php echo $lang['config_email']?></b> define los par&aacute;metros que determinan si se va a enviar un email tras haber completado una copia de seguridad, as&iacute; como si se deber&aacute; adjuntar dicha copia de seguridad y en qu&eacute; forma.</li>
		<ul>
			<li><a name="conf8"></a><b><?php echo $lang["help_mail1"]?>:</b> activa o desactiva el env&iacute;o de un email al haberse terminado la copia de seguridad, sea con o sin &eacute;xito.</li>
			<li><a name="conf9"></a><b><?php echo $lang["help_mail2"]?>:</b> es la direcci&oacute;n de email a d&oacute;nde se enviar&aacute; el mensaje.</li>
			<li><a name="conf10"></a><b><?php echo $lang["help_mail3"]?>:</b> es la direcci&oacute;n de email desde donde se enviar&aacute; el mensaje. Recuerde permitirle el paso a trav&eacute;s de su filtro anti-spam, si dispone de uno.</li>
		</ul>
		<li><b><?php echo $lang['config_ftp']?></b> permite definir una (o varias) transferencias por FTP del archivo de copia de seguridad una vez terminada la misma. Si se activa, se deben especificar las par&aacute;metros necesarios para realizar la conexi&oacute;n. Adem&aacute;s, deber&aacute; tener los derechos apropiados en el servidor de destino de la copia.</li>
		<ul>
			<li><a name="conf13"></a><b><?php echo $lang["help_ftptransfer"]?>:</b> activa o desactiva el env&iacute;o de la copia de seguridad realizada con &eacute;xito, por FTP.</li>
			<li><a name="conf14"></a><b><?php echo $lang["help_ftpserver"]?>:</b> es la direcci&oacute;n del servidor de FTP destinatario del archivo (por ejemplo ftp.misbackups.com).</li>
			<li><a name="conf15"></a><b><?php echo $lang["help_ftpport"]?>:</b> es el puerto de conexi&oacute;n del servidor FTP (generalmente, el puerto 21).</li>
			<li><a name="conf16"></a><b><?php echo $lang["help_ftpuser"]?>:</b> es el nombre de usuario con el que debe realizarse la conexi&oacute;n.</li>
			<li><a name="conf17"></a><b><?php echo $lang["help_ftppass"]?>:</b> es el password a utilizar para establecer la conexi&oacute;n.</li>
			<li><a name="conf18"></a><b><?php echo $lang["help_ftpdir"]?>:</b> es el directorio de destino del archivo a almacenar. Puede ser un camino absoluto o relativo (pero debe tener derechos de escritura en el mismo).</li>
		</ul>
		<li><b><?php echo $lang['config_cronperl']?></b> permite definir las caracter&iacute;sticas de la copia de seguridad utilizando el script Perl. La mayor&iacute;a de las opciones son muy parecidas a las establecidas para el interfaz gr&aacute;fico, pero para el script Perl, que act&uacute;a de forma independiente.</li>
	</ul>
	<h6><?php echo $lang['dump']?></h6>
	<p>Esta es la parte m&aacute;s importante del programa. Desde aqu&iacute; puede realizar una copia de seguridad de sus datos seg&uacute;n las opciones establecidas anteriormente. Adem&aacute;s, podr&aacute; seleccionar (si as&iacute; lo desea) solamente algunas tablas para hacer dicha copia, de forma que no todos los datos de la base de datos sean copiados. </p>
	<h6><?php echo $lang['restore']?></h6>
	<p>Desde esta opci&oacute;n, podr&aacute; restaurar una copia de seguridad existente, a la base de datos seleccionada actualmente. </p>
	<h6><?php echo $lang['file_manage']?></h6>
	<p>En esta p&aacute;gina se encuentran los archivos de copia de seguridad generados por el programa.<br>
  Podr&aacute; eliminarlos de uno en uno o en grupo, ejecutar el borrado autom&aacute;tico de forma manual, descargar los archivos o subir un archivos para poder restaurarlo posteriormente.</p>
	<h6><?php echo $lang['mini-sql']?></h6>
	<p>Aqu&iacute; podr&aacute; ejecutar comandos SQL contra la base de datos, as&iacute; como consultar la estructura de sus tablas. Para usuarios avanzados de MySQL. </p>
	<h6><?php echo $lang['log']?></h6>
	<p>Aqu&iacute; encontrar&aacute; los informes de las operaciones realizadas y podr&aacute; borrarlos si as&iacute; lo desea.</p>
	<h6><?php echo $lang['credits']?></h6>
	<p>La p&aacute;gina actual.</p>
</ul>
<h3>Nuestros esponsors</h3>
Los esponsors de nuestra aplicaci&oacute;n los puede consultar en la <a class="ul" href="http://www.mysqldumper.de/de/index.php?m=7" target="_blank">p&aacute;gina de esponsors</a><br>
<?php echo MSDFooter();?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>