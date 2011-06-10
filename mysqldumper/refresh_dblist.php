<?php
// File to update the database-list - meant for server where databases are added or deleted
// just call this script via cronjob before starting crondump.pl and the list of databases 
// in mysqldumper.conf will be refreshed
error_reporting(E_ALL);

include_once('./inc/functions.php');
$config['language']='en';
$config['theme']="msd";
$config['files']['iconpath']='css/'.$config['theme'].'/icons/';
include($config['paths']['config'].'parameter.php');

$conf=file($config['paths']['config'].'mysqldumper.conf');
foreach ($conf as $c) { eval($c); } ;

//v($databases);
//v($config);

SetDefault();
//v($databases);

?>
