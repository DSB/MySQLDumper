<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Daniel Schlichtholz in 2004">
<title>MySQLDumper</title>
</head>
<frameset rows="1,*" frameborder="0" framespacing="0" border="0">
		<frame name="msd_action" src="<? echo ($_GET["action"]=="dump") ? "dump.php" : "restore.php?filename=".$_GET["filename"]."&kind=".$_GET["kind"]; ?>" scrolling="auto" noresize frameborder="0">
		<frame name="msd_ausgabe" src="" scrolling="auto" frameborder="0">
<noframes>
<body>
You need to get a newer browser!
</body>
</noframes>
</frameset>
</html>