<?php
include_once("inc/functions.php");
include_once("inc/mysql.php");

if(!file_exists($config["files"]["parameter"])) TestWorkDir();
include($config["files"]["parameter"]); 
include("language/lang_list.php");
SelectDB($databases["db_selected_index"]); 
?>