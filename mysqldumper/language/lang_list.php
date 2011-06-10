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
$lang['languages']=Array('de','de_du','en','es','it');

// *****************************************************************************
// Language name in its own language.
$lang['en']='English';
$lang['de']='Deutsch';
$lang['es']='Espa&ntilde;ol';
$lang['it']='Italiano';
$lang['de_du']='Deutsch (mit Anredeform "Du")';

// *****************************************************************************
// Add the installation entries here, and you're done with this file. :-)

$lang['tools1']['de']='MySQLDumper deinstallieren';
$lang['tools2']['de']='Vorhandene Konfigurationssicherung importieren';
$lang['tools3']['de']='Konfigurationssicherung hochladen und importieren';
$lang['tools4']['de']='Konfigurationssicherung herunterladen';

$lang['tools1']['de_du']='MySQLDumper deinstallieren';
$lang['tools2']['de_du']='Vorhandene Konfigurationssicherung importieren';
$lang['tools3']['de_du']='Konfigurationssicherung hochladen und importieren';
$lang['tools4']['de_du']='Konfigurationssicherung herunterladen';

$lang['tools1']['en']='Uninstall MySQLDumper';
$lang['tools2']['en']='Import existing configuration backup';
$lang['tools3']['en']='Upload configuration backup and import';
$lang['tools4']['en']='Download Configuration Backup';

$lang['tools1']['es']='Desinstalar MySQLDumper';
$lang['tools2']['es']='Importar configuraci&oacute;n existente';
$lang['tools3']['es']='Subir copia de la configuraci&oacute;n e importar';
$lang['tools4']['es']='Crear y descargar una copia de la configuraci&oacute;n';

$lang['tools1']['it']='MySQLDumper disinstallare';
$lang['tools2']['it']='Importare l`attuale sicurezza di configurazione';
$lang['tools3']['it']='Prelevare ed importare la sicurezza di configurazione';
$lang['tools4']['it']='Scaricare sicurezza di configurazione';

// *****************************************************************************
// Language defaults to english.

if (!isset($config['language'])) $config['language']='en';
include_once('./language/'.$config['language'].'/lang.php');

?>