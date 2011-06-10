<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<title>MySqlDump</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body  bgcolor="#F5F5F5">
<?php
include_once("inc/functions.php");
TestWorkDir();
include($config_file); 
SelectDB($db_selected_index); 
?>