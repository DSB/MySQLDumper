<?php

include_once("inc/functions.php");
include_once($config["files"]["parameter"]);

// Sprachfile laden
if(!isset($config["language"]) && ($config["language"]!="de" && $config["language"] !="en")) $config["language"]="de"; 
include_once("language/lang_".$config["language"].".php");

if(isset($_GET["action"])) {
	if($_GET["action"]=="dbrefresh") {
		if($config["dbonly"]!="") {
			$msg.=SetDefault(true);
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;</script>';
		}
	}
}

// Leerzeile
$row='<tr height="10"><td></td><tr>';
if(isset($_POST["dbindex"]))
{ 	
	$dbindex=$_POST["dbindex"];
		$databases["db_selected_index"]=$dbindex;
		SelectDB($dbindex);	
		WriteParams(1,$config,$databases);
		//include($config["files"]["parameter"]);
		//echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="main.php";</script>';
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href=parent.MySQL_Dumper_content.location.href;</script>';
} else { 
		$dbindex=0;
		
	
}

$p="&svice=$svice";

?>

<HTML>
<HEAD>
<TITLE>MySQL Dumper - Menu</TITLE>
<link rel="stylesheet" type="text/css" href="styles.css">
</HEAD>
<body class="menu">
<div style="display:none">
<img src="images/ardown.gif" width="12" height="13" alt=""><img src="images/arrowdown.gif" width="16" height="16" alt=""><img src="images/arrowup.gif" width="16" height="16" alt=""><img src="images/arup.gif" width="12" height="13" alt=""><img src="images/blank.gif" width="1" height="1" alt=""><img src="images/close.gif" width="12" height="13" alt=""><img src="images/delete.gif" width="11" height="13" alt=""><img src="images/edit.gif" width="12" height="13" alt=""><img src="images/gz.gif" width="32" height="32" alt=""><img src="images/fbd.gif" width="40" height="16" alt=""><img src="images/fbr.gif" width="40" height="16" alt=""><img src="images/fbs.gif" width="40" height="16" alt=""><img src="images/help16.gif" width="16" height="16" alt=""><img src="images/help32.gif" width="32" height="32" alt=""><img src="images/key.gif" width="29" height="33" alt=""><img src="images/logo.gif" width="160" height="53" alt=""><img src="images/rename.gif" width="32" height="32" alt=""><img src="images/germany.gif" width="50" height="30" alt=""><img src="images/usa.gif" width="50" height="30" alt=""><img src="images/notok.gif" width="32" height="32" alt=""><img src="images/ok.gif" width="32" height="32" alt="">
</div>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center"><a href="http://www.mysqldumper.de/" target="_blank">
	<img src="images/logo.gif" alt="MySQL Dumper - Homepage" width="160" height="53" border="0" vspace="0">
	</a><br>Version <?php echo $config["version"]; ?><br>
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
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="main.php" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["home"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="config_overview.php" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["config"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=dump" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["dump"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=restore" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["restore"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=files<?php echo $p; ?>" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["file_manage"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="sql.php?db=<?php echo $databases["db_actual"]; ?>&dbid=<?php echo $databases["db_selected_index"]; ?>" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content">Mini-SQL</a> </td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="log.php" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["log"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="<?php echo "language/help_".$config["language"]; ?>.php" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content"><?php echo $lang["credits"]; ?></a> </td>
</tr>

<?php
if(file_exists("develop.php")) {
echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="develop.php" style="display:block;margin:0px;width:100%;height:100%;" target="MySQL_Dumper_content">Entwickler</a> </td>
</tr>
<?php
}
?>



</table>

 
</BODY>
</HTML>
