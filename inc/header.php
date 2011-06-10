<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta name="robots" content="none">
<meta name="robots" content="noindex">
<title>MySqlDumper</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<script language="JavaScript" src="script.js"></script>
</head>
<body>

<?php
include_once("inc/functions.php");
include_once("inc/mysql.php");

if(!file_exists($config["files"]["parameter"])) TestWorkDir();
include($config["files"]["parameter"]); 
if(!isset($config["language"]) && ($config["language"]!="de" && $config["language"] !="en")) $config["language"]="de"; 
include_once("language/lang_".$config["language"].".php");
SelectDB($databases["db_selected_index"]); 


?>