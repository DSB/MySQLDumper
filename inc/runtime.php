<?php


//error_reporting(E_ALL);
error_reporting(E_ERROR);


//feste Variabeln
$config["version"]="1.14 Beta 3";



//Pfade und Files
$config["paths"]["root"]=Realpfad("./"); 
$config["paths"]["work"]="work/";
$config["paths"]["backup"]=$config["paths"]["work"]."backup/";
$config["paths"]["structure"]=$config["paths"]["work"]."structure/";
$config["paths"]["log"]=$config["paths"]["work"]."log/";
$config["paths"]["config"]=$config["paths"]["work"]."config/";
$config["paths"]["perlexec"]="msd_cron/";
$config["cron_configurationfile"]="mysqldumper.conf";
$config["files"]["log"]=$config["paths"]["log"]."mysqldump.log";
$config["files"]["perllog"]=$config["paths"]["log"]."mysqldump_perl.log";
$config["files"]["perllogcomplete"]=$config["paths"]["log"]."mysqldump_perl.complete.log";
$config["files"]["parameter"]=$config["paths"]["config"]."parameter.php";

//Ini-Parameter
$config["max_execution_time"]=ini_get("max_execution_time");
$config["safe_mode"]=ini_get('safe_mode');
$config["magic_quotes_gpc"]=ini_get('magic_quotes_gpc');
$config["disabled"]=ini_get("disable_functions");
$config["phpextensions"]=implode(" ",get_loaded_extensions());

//Ist zlib möglich?
$p1=explode(" ",$config["phpextensions"]);
$p2=explode(",",str_replace(" ","",$config["disabled"]));
//Buggy PHP-Version ?  
$p3=explode(".",PHP_VERSION);
$buggy=($p3[0]==4 && $p3[1]==3 && $p3[2]<4);
$config["zlib"]=(!$buggy) && (in_array("zlib",$p1) && (!in_array("gzopen",$p2) || !in_array("gzwrite",$p2) || !in_array("gzgets",$p2) || !in_array("gzseek",$p2) || !in_array("gztell",$p2)));
//echo '<pre>'.print_r($p3,true).'</pre>';
//Tuning-Ecke
$config["tuning_add"]=1.1;
$config["tuning_sub"]=0.9;
$config["time_buffer"]=0.75; //max_zeit=$config["max_execution_time"]*$config["time_buffer"]
$config["perlspeed"]=10000;  //Anzahl der Datensätze, die in einem Rutsch gelesen werden


//Bausteine
$meta=br().br().'<meta http-equiv="expires" content="3600"> '.br().'<META HTTP-EQUIV="Pragma" CONTENT="no-cache">'.br(2);
$preload_restore='<script language="JavaScript">Preload(2)</script>';
$preload_dump='<script language="JavaScript">Preload(1)</script>';
$config["homepage"]="http://www.mysqldumper.de/board/";
$nl="\n";

//Initialisierungen


//SQL-Library
$sqllib["board_deacticate"]="UPDATE `phpbb_config` set config_value=1 where config_name=\"board_disable\"";
$sqllib["board_acticate"]="UPDATE `phpbb_config` set config_value=0 where config_name=\"board_disable\"";



?>