<?php
ob_start();
include_once ( './inc/header.php' );

$lang_old=$config['language'];
$config_refresh='';

if (isset($_POST['selected_config']) || isset($_GET['config']))
{
	if (isset($_POST['selected_config'])) $new_config=$_POST['selected_config'];
	if (isset($_GET['config'])) $new_config=$_GET['config']; // Aenderung der Konfiguration aus Contentbereich empfangen
	// letzten aktiven Menuepunkt wieder herstellen
	if (is_readable($config['paths']['config'] . $new_config . '.php'))
	{
		clearstatcache();
		unset($databases);
		$databases=array();
		if (read_config($new_config))
		{
			$config['config_file']=$new_config;
			$_SESSION['config_file']=$new_config; //$config['config_file'];
			$config_refresh='
			<script language="JavaScript" type="text/javascript">
			if (parent.MySQL_Dumper_content.location.href.indexOf("config_overview.php")!=-1)
			{
				var selected_div=parent.MySQL_Dumper_content.document.getElementById("sel").value;
			}
			else selected_div=\'\';
			parent.MySQL_Dumper_content.location.href=\'config_overview.php?config=' . urlencode($new_config) . '&sel=\'+selected_div</script>';
		}
		if (isset($_GET['config'])) $config_refresh=''; //Neu-Aufruf bei Uebergabe aus Content-Bereich verhindern
	}
}

$pagerefresh='
<script language="JavaScript" type="text/javascript">
var curl=parent.MySQL_Dumper_content.location.href.split("/");
var cdatei=curl.pop();
var ca=cdatei.split(".");
if(ca[0]!="dump" && ca[0]!="restore" && ca[0]!="frameset" && ca[0]!="crondump") {
	parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;
}
if(ca[0]=="sql")
{
	parent.MySQL_Dumper_content.location.href=\'sql.php';
if (isset($_POST['dbindex'])) $pagerefresh.='?dbid=' . $_POST['dbindex'];
$pagerefresh.='\';
}
</script>';

//Ausgabestart
echo MSDHeader(1);
echo headline('',0);

if ($config_refresh > '') echo $config_refresh;

// Sprache gewechselt?
if ($config['language'] != $lang_old)
{
	echo '<script language="JavaScript" type="text/javascript">
		self.location.href=\'menu.php\';
		</script>';
}

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'dbrefresh')
	{
		// DB-Namen merken
		$old_dbname=isset($databases['Name'][$databases['db_selected_index']]) ? $databases['Name'][$databases['db_selected_index']] : '';
		SetDefault();
		// jetzt nachschauen, ob es den DB-Namen noch gibt
		$old_dbs=array_flip($databases['Name']);
		if (isset($old_dbs[$old_dbname])) SelectDB($old_dbs[$old_dbname]);
		else SelectDB(0);
		echo $pagerefresh;
	}
}

if (isset($_POST['dbindex']))
{
	$dbindex=$_POST['dbindex'];
	$databases['db_selected_index']=$dbindex;
	SelectDB($dbindex);
	WriteParams(0);
	echo $pagerefresh;
}
else
	$dbindex=0;

?>
<a href="http://www.mysqldumper.de/" target="_blank"><img src="css/<?php
	echo $config['theme'];
	?>/pics/h1_logo.gif"
	alt="MySQL Dumper - Homepage"></a><div id="menu">
<p class="version">Version <?php
echo MSD_VERSION ;
?></p>
<ul>
	<li id="m1" class="active"><a href="main.php"
		target="MySQL_Dumper_content" onclick="setMenuActive('m1')"><?php
		echo $lang['home'];
		?> </a></li>
	<li id="m2" class=""><a href="config_overview.php"
		target="MySQL_Dumper_content" onclick="setMenuActive('m2')"><?php
		echo $lang['config'];
		?> </a></li>
        <?php
								if (isset($databases['Name']) && count($databases['Name']) > 0)
								{
									?>
        <li id="m3" class=""><a href="filemanagement.php?action=dump"
		target="MySQL_Dumper_content" onclick="setMenuActive('m3')"><?php
									echo $lang['dump'];
									?> </a></li>
	<li id="m4" class=""><a href="filemanagement.php?action=restore"
		target="MySQL_Dumper_content" onclick="setMenuActive('m4')"><?php
									echo $lang['restore'];
									?> </a></li>
	<li id="m5" class=""><a href="filemanagement.php?action=files"
		target="MySQL_Dumper_content" onclick="setMenuActive('m5')"><?php
									echo $lang['file_manage'];
									?> </a></li>
	<li id="m6" class=""><a
		href="sql.php?db=<?php
									echo $databases['db_actual'];
									?>&amp;dbid=<?php
									echo $databases['db_selected_index'];
									?>"
		target="MySQL_Dumper_content" onclick="setMenuActive('m6')"><?php
									echo $lang['sql_browser'];
									?> </a></li>
	<li id="m7" class=""><a href="log.php" target="MySQL_Dumper_content"
		onclick="setMenuActive('m7')"><?php
									echo $lang['log'];
									?> </a></li>
        <?php
								}
								?>
        <li id="m8" class=""><a href="help.php"
		target="MySQL_Dumper_content" onclick="setMenuActive('m8')"><?php
		echo $lang['credits'];
		?> </a></li>
</ul>
</div>
<div id="selectConfig">
<form action="menu.php" method="post">
<fieldset id="configSelect"><legend><?php
echo $lang['config'];
?>:</legend> <select name="selected_config" style="width: 157px;"
	onchange="this.form.submit()">
        		<?php
										echo get_config_filelist();
										?>
        	</select></fieldset>
</form>
<form action="menu.php" method="post">
<fieldset id="dbSelect"><legend><?php
echo $lang['choose_db'];
?>:</legend>
<?php
if (isset($databases['Name']) && count($databases['Name']) > 0)
{
	echo '<select name="dbindex" style="width:157px;" onchange="this.form.submit()">';
	$datenbanken=count($databases['Name']);
	for ($i=0; $i < $datenbanken; $i++)
	{
		echo '<option value="' . $i . '"';
		if ($i == $databases['db_selected_index']) echo ' selected';
		echo '>&nbsp;&nbsp;' . $databases['Name'][$i] . '</option>' . "\n";
	}
	echo '</select>';
}
else
	echo $lang['none'] . '<br>';
?>
        <p><a href="menu.php?action=dbrefresh"><?php
								echo $lang['load_database']?></a></p>
</fieldset>
</form>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post"
	target="_blank">
<p align="center"><input type="hidden" name="cmd" value="_s-xclick"> <input
	type="image" src="./images/paypal-de.gif" name="submit"
	alt="Support MySQLDumper" title="Support MySQLDumper"> <script type=""
	language="JavaScript">
		var s='<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">';
		document.write(s);
	</script></p>
</form>
</div>

<?php
echo PicCache();
if (!isset($databases['Name']) || count($databases['Name']) < 1)
{
	echo '<script language="javascript" type="text/javascript">setMenuActive(\'m2\');parent.MySQL_Dumper_content.location.href=\'./config_overview.php\';</script>';
}
else
	echo '<script language="javascript" type="text/javascript">setactiveMenuFromContent();</script>';
?>
</body>
</html>
<?php
ob_end_flush();
?>