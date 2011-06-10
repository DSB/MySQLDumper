<?php
// *****************************************************************************
// This file holds all available languages
// *****************************************************************************
// Do not change anything here :-)
// *****************************************************************************

// Array initialization
$lang=Array();

// *****************************************************************************
// Add language to array. Must match directory name of the language.
$lang['languages']=Array('de','en','es');

// *****************************************************************************
// Language name in its own language. 
$lang['en']='English'; 
$lang['de']='Deutsch'; 
$lang['es']='Espa&ntilde;ol'; 

// *****************************************************************************
// Add the installation entries here, and you're done with this file. :-)

$lang['tools1']['de']='MySQLDumper deinstallieren';
$lang['tools2']['de']='Vorhandene Konfigurationssicherung importieren';
$lang['tools3']['de']='Konfigurationssicherung hochladen und importieren';
$lang['tools4']['de']='Konfigurationssicherung herunterladen';

$lang['tools1']['en']='Uninstall MySQLDumper';
$lang['tools2']['en']='Import existing configuration backup';
$lang['tools3']['en']='Upload configuration backup and import';
$lang['tools4']['en']='Download Configuration Backup';

$lang['tools1']['es']='Desinstalar MySQLDumper';
$lang['tools2']['es']='Importar configuraci&oacute;n existente';
$lang['tools3']['es']='Subir copia de la configuraci&oacute;n e importar';
$lang['tools4']['es']='Crear y descargar una copia de la configuraci&oacute;n';

// *****************************************************************************
// Language defaults to english. 

if (!isset($lang[$config['language']])) $config['language']='en';
include_once('language/'.$config['language'].'/lang.php');

?>