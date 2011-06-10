<?
$force=(isset($_GET["force"])) ? $_GET["force"] : 0;
$svice=(isset($_GET["svice"])) ? $_GET["svice"] : 0;
$page=(isset($_GET["page"])) ? $_GET["page"] : 'main.php';
$msv='';
if($svive!=0) {
	if($page='main.php') {
		$page.='?svice=1';
	} else {
		$page.='&svice=1';
	}
	$msv='?svice=1';
}
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
<meta name="Author" content="Daniel Schlichtholz und Steffen Kamper">
<title>MySQL Dumper</title>
<script language="JavaScript" type="text/javascript">
<!-- 
if (self != top) {
	parent.location.href=self.location.href;
}
-->
</script>
</head>

<frameset cols="190,*" frameborder="0" framespacing="0" border="0">
		<frame name="MySQL_Dumper_menu" src="menu.php<?php echo $msv;?>" scrolling="no" noresize frameborder="0">
		<frame name="MySQL_Dumper_content" src="<?php echo $page;?>" scrolling="auto" frameborder="0">
</frameset>
<noframes>
<body>
You need to get a newer browser!
</body>
</noframes>
</html>