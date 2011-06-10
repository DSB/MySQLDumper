<?php

include_once("inc/header.php");
include_once("inc/runtime.php");

echo MSDHeader(1);
$msg="";
if(isset($_GET["action"])) {
	if($_GET["action"]=="dbrefresh") {
		$msg.=SetDefault();
		echo '
<script language="JavaScript">
var curl=parent.MySQL_Dumper_content.location.href.split("/");
var cdatei=curl.pop();
var ca=cdatei.split(".");

if(ca[0]!="sql" && ca[0]!="dump" && ca[0]!="restore" && ca[0]!="frameset") {
	parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;
}
		
</script>';
		
	}
}

if(isset($_POST["dbindex"]))
{ 	
	$dbindex=$_POST["dbindex"];
		$databases["db_selected_index"]=$dbindex;
		SelectDB($dbindex);	
		WriteParams(1,$config,$databases);
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;</script>';
} else { 
		$dbindex=0;
}

$p=(isset($_GET['svice'])) ? "&svice=".$_GET['svice'] : "";

echo headline("",0); 
echo PicCache();
?>


<div style="padding:4px;" align="center">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" class="dbmenu"><a href="http://www.mysqldumper.de/" target="_blank">
	<img src="images/logo.gif" alt="MySQL Dumper - Homepage" width="160" height="42" border="1" vspace="0" class="logo">
	</a><span class="version">Version <?php echo MSD_VERSION.'&nbsp;'.MSD_VERSION_ADD; ?></span><br>
	<br><span class="small"><?php echo $lang["choose_db"];?>:</span>
	<form action="menu.php" method="post" style="margin:0px;padding:0px;">
	<select name="dbindex" onchange="this.form.submit()" style="width:160px;">
		<?php
		$datenbanken=count($databases["Name"]);
		for($i=0;$i<$datenbanken;$i++)
		{
			echo '<option value="'.$i.'" ';
			if($i==$databases["db_selected_index"]) echo 'SELECTED';
			echo '>'.$databases["Name"][$i].'</option>'."\n";
		}
		?>
		</select><noscript><input type="submit" name="submit" value="OK" /></noscript></form>
		<a class="small" href="menu.php?action=dbrefresh"><?php echo $lang["load_database"] ?></a>
	
		
	</td>
</tr>
</table>
<div id="menu">
<a href="main.php" class="home" target="MySQL_Dumper_content"><?php echo $lang["home"]; ?></a>
<a href="config_overview.php" class="config" target="MySQL_Dumper_content"><?php echo $lang["config"]; ?></a>
<a href="filemanagement.php?action=dump" class="backup" target="MySQL_Dumper_content"><?php echo $lang["dump"]; ?></a>
<a href="filemanagement.php?action=restore" class="restore" target="MySQL_Dumper_content"><?php echo $lang["restore"]; ?></a>
<a href="filemanagement.php?action=files<?php echo $p; ?>" class="filemanagement" target="MySQL_Dumper_content"><?php echo $lang["file_manage"]; ?></a>
<a href="sql.php?db=<?php echo $databases["db_actual"]; ?>&dbid=<?php echo $databases["db_selected_index"]; ?>" class="sql" target="MySQL_Dumper_content">Mini-SQL</a>
<a href="log.php" class="log" target="MySQL_Dumper_content"><?php echo $lang["log"]; ?></a>
<a href="<?php echo "language/".$config["language"]; ?>/help.php" class="credit" target="MySQL_Dumper_content"><?php echo $lang["credits"]; ?></a>
<?php
if(file_exists("develop.php")) {
?>
<a href="develop.php" class="config" target="MySQL_Dumper_content">Entwickler</a> 
<?php
}
?>
</div>
</div>
</BODY>
</HTML>
