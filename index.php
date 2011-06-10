<?
$force=(isset($_GET["force"])) ? $_GET["force"] : 0;
$svice=(isset($_GET["svice"])) ? $_GET["svice"] : 0;
include_once("inc/functions.php");
if(!file_exists("work/config/parameter.php") && $force!=1) {
	header("location: install.php"); 	
	die;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Daniel Schlichtholz in 2004">
<title>MySQL Dumper</title>
</head>
<frameset cols="190,*" frameborder="0" framespacing="0" border="0">
		<frame name="MySQL_Dumper_menu" src="menu.php?svice=<?php echo $svice; ?>" scrolling="auto" noresize frameborder="1">
		<frame name="MySQL_Dumper_content" src="main.php" scrolling="auto" frameborder="0">
</frameset>
<noframes>
<body>
You need to get a newer browser!
</body>
</noframes>
</frameset>
</html>