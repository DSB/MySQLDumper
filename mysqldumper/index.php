<?php
$force=(isset($_GET['force'])) ? $_GET['force'] : 0;
$page=(isset($_GET['page'])) ? $_GET['page'] : 'main.php';
$msv='';

include_once('./inc/functions.php');
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
<meta name="Author" content="Daniel Schlichtholz und Steffen Kamper">
<title>MySQLDumper</title>
</head>

<frameset cols="190,*" border="0">
		<frame name="MySQL_Dumper_menu" src="menu.php<?php echo $msv;?>" scrolling="no" noresize frameborder="0" marginwidth="0" marginheight="0">
		<frame name="MySQL_Dumper_content" src="<?php echo $page;?>" scrolling="auto" frameborder="0" marginwidth="0" marginheight="0">
</frameset>

</html>