<HTML>
<HEAD>
<TITLE>MySqlDump - Menu</TITLE>
<link rel="stylesheet" type="text/css" href="styles.css">
</HEAD>
<body bgcolor="#D0DCE0">

<?php
include("inc/functions.php");
if(!file_exists($config_file)) {
	$msg.=$l["first_run"];
	TestWorkDir();
	$msg.=SetDefault();
	
}

include($config_file);

// Sprachfile laden
include("language/lang_".$lang.".php");

if($_GET["action"]=="dbrefresh") {
	$msg.=SetDefault(true);
	echo '<script language="JavaScript">parent.main.location.href=parent.main.location.href;</script>';
}

// Leerzeile
$row='<tr height="10"><td></td><tr>';
if(!isset($_POST[dbindex]))
{ 	$dbindex=0; }
else
{ 
	$dbindex=$_POST[dbindex];
	$db_selected_index=$dbindex;
	SelectDB($dbindex);	
	@WriteParams();
	echo '<script language="JavaScript">parent.main.location.href=parent.main.location.href;</script>';
}
		
if($msg!="") { ?>
<!-- <script language="JavaScript">
	alert("<?php echo $msg;?>");
</script> -->
<?php 
}
?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center"><a href="http://www.daniel-schlichtholz.de/board" target="_blank">
	<img src="images/mysqldump_logo.png" width="160" height="63" alt=""></a><br>Version <?php echo $version; ?><br>
	<br><span class="small"><?php echo $l["choose_db"];?>:</span>
	<form action="menu.php" method="post" style="margin:0px;padding:0px;">
	<select name="dbindex" onchange="this.form.submit()">
		<?php
		$datenbanken=count($dbname_a);
		for($i=0;$i<$datenbanken;$i++)
		{
			echo '<option value="'.$i.'" ';
			if($i==$db_selected_index) echo 'SELECTED';
			echo '>'.$dbname_a[$i].'</option>\n';
		}
		?>
		</select><noscript><input type="submit" name="submit" value="OK" /></noscript></form>
		<a class="small" href="menu.php?action=dbrefresh"><?php echo $l["load_database"] ?></a>
	
		
	</td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="index.php" target="main"><?php echo $l["home"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="config_overview.php" target="main"><?php echo $l["config"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=dump" target="main"><?php echo $l["dump"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=restore" target="main"><?php echo $l["restore"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="filemanagement.php?action=files" target="main"><?php echo $l["file_manage"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="log.php" target="main"><?php echo $l["log"]; ?></a></td>
</tr>
<?php echo $row; ?>
<tr height="30">
	<td class="tableheads_off" onmouseover="this.className='tableheads_on'" onmouseout="this.className='tableheads_off'" align="center">
	<a href="<?php echo "language/help_".$lang; ?>.html" target="main"><?php echo $l["credits"]; ?></a> 
</tr>

</BODY>
</HTML>
