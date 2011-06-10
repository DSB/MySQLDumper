<?php
include_once('./inc/header.php');

$pagerefresh='
<script language="JavaScript" type="text/javascript">
var curl=parent.MySQL_Dumper_content.location.href.split("/");
var cdatei=curl.pop();
var ca=cdatei.split(".");
if(ca[0]!="sql" && ca[0]!="dump" && ca[0]!="restore" && ca[0]!="frameset") {
	parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;
}
</script>';

//Ausgabestart
echo MSDHeader(1);

if(isset($_GET['action'])) 
{
	if($_GET['action']=='dbrefresh')
	{
		SetDefault();
		SelectDB(0);	
		echo $pagerefresh;	
	}
}

if(isset($_POST['dbindex']))
{ 	
	$dbindex=$_POST['dbindex'];
	$databases['db_selected_index']=$dbindex;
	SelectDB($dbindex);	
	WriteParams(1,$config,$databases);
	echo $pagerefresh;
} 
else $dbindex=0;


echo headline('',0); 

?>

<div id="wrapmenu">
<p><a href="http://www.mysqldumper.de/" target="_blank"><img src="css/<?php echo $config['theme'];?>/pics/h1_logo.gif" alt="MySQL Dumper - Homepage" width="190" height="30"></a></p>

<div id="menu">

<?php
echo PicCache();
?>

<span class="version">Version <?php echo MSD_VERSION.'&nbsp;'.MSD_VERSION_ADD; ?></span>

<ul>
<li id="m1" class="active"><a 
href="main.php" target="MySQL_Dumper_content" onclick="setMenuActive('m1')"><?php echo $lang['home']; ?></a></li>
<li id="m2" class=""><a 
href="config_overview.php" target="MySQL_Dumper_content" onclick="setMenuActive('m2')"><?php echo $lang['config']; ?></a></li>
<?php
if (isset($databases['Name']) && count($databases['Name'])>0)
{
?>
<li id="m3" class=""><a 
href="filemanagement.php?action=dump" target="MySQL_Dumper_content" onclick="setMenuActive('m3')"><?php echo $lang['dump']; ?></a></li>
<li id="m4" class=""><a 
href="filemanagement.php?action=restore" target="MySQL_Dumper_content" onclick="setMenuActive('m4')"><?php echo $lang['restore']; ?></a></li>
<li id="m5" class=""><a 
href="filemanagement.php?action=files" target="MySQL_Dumper_content" onclick="setMenuActive('m5')"><?php echo $lang['file_manage']; ?></a></li>
<li id="m6" class=""><a 
href="sql.php?db=<?php echo $databases['db_actual']; ?>&amp;dbid=<?php echo $databases['db_selected_index']; ?>" target="MySQL_Dumper_content" onclick="setMenuActive('m6')"><?php echo $lang['sql_browser']; ?></a></li>
<li id="m7" class=""><a 
href="log.php" target="MySQL_Dumper_content" onclick="setMenuActive('m7')"><?php echo $lang['log']; ?></a></li>
<?php } ?>
<li id="m8" class=""><a 
href="<?php echo "language/".$config['language']; ?>/help.php" target="MySQL_Dumper_content" onclick="setMenuActive('m8')"><?php echo $lang['credits']; ?></a></li>
<?php
if(file_exists("develop.php")) {
?>
<li><a 
href="develop.php" target="MySQL_Dumper_content">Entwickler</a></li> 
<?php
}
?>
</ul>

</div></div>

<div id="db-selectbox">
	<br>
	<?php echo $lang['choose_db'];?>:<br>
<?php
	echo '<form action="menu.php" method="post">';
	if (isset($databases['Name']) && count($databases['Name'])>0)
	{
		echo '<select name="dbindex" style="width:157px;" onchange="this.form.submit()">';
		$datenbanken=count($databases['Name']);
		for($i=0;$i<$datenbanken;$i++)
		{
			echo '<option value="'.$i.'" ';
			if($i==$databases['db_selected_index']) echo 'SELECTED';
			echo '>'.$databases['Name'][$i].'</option>'."\n";
		}
		echo '</select>';
		echo '<noscript><input type="submit" name="submit" value="OK" /></noscript>';
		echo '</form>';
	}
	else echo $lang['none'].'<br>';
?>

	<a href="menu.php?action=dbrefresh"><?php echo $lang['load_database'] ?></a>
	<br>
</div>
<?php
if (!isset($databases['Name']) || count($databases['Name'])<1)
{
	echo '<script langugae="javascript">setMenuActive(\'m2\');parent.MySQL_Dumper_content.location.href=\'./config_overview.php\';</script>';
}

?>
</body>
</html>
