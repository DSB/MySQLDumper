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
$lang['languages']=Array('de','en','de_du','es','fr','it','nl','sw','da','pt_br','lu','tr','pt');

// *****************************************************************************
// Language name in its own language.
$lang['en']='English';
$lang['de']='Deutsch';
$lang['es']='Español';
$lang['fr']='Français';
$lang['it']='Italiano';
$lang['nl']='Nederlands';
$lang['sw']='Swedish';
$lang['de_du']='Deutsch (mit Anredeform "du")';
$lang['pt_br']='Portuguese - BR';
$lang['tr']='Türkçe';
$lang['da']='Dansk';
$lang['lu']='Luxemburg';
$lang['pt']='Luxemburg';

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
$lang['tools2']['es']='Importar configuración existente';
$lang['tools3']['es']='Subir copia de la configuración e importar';
$lang['tools4']['es']='Crear y descargar una copia de la configuración';

$lang['tools1']['fr']='Désinstaller MySQLDumper';
$lang['tools2']['fr']='Importation d\'une copie de sauvegarde existante';
$lang['tools3']['fr']='Télécharger une copie de sauvegarde sur le serveur ';
$lang['tools4']['fr']='Télécharger une copie de sauvegarde';

$lang['tools1']['it']='MySQLDumper disinstallare';
$lang['tools2']['it']='Importare l`attuale sicurezza di configurazione';
$lang['tools3']['it']='Prelevare ed importare la sicurezza di configurazione';
$lang['tools4']['it']='Scaricare sicurezza di configurazione';

$lang['tools1']['nl']='MySQLDumper deinstalleren';
$lang['tools2']['nl']='Bestaande configuratie backup importeren';
$lang['tools3']['nl']='Upload configuratie backup en importeren';
$lang['tools4']['nl']='Download configuratie backup';

$lang['tools1']['sw']='Avinstallera MySQLDumper';
$lang['tools2']['sw']='Importera existerande konfigureringsbackup';
$lang['tools3']['sw']='Ladda upp och importera konfigureringsbackup';
$lang['tools4']['sw']='Ladda hem konfigureringsbackup';

$lang['tools1']['pt_br']='Desinstalar MySQLDumper';
$lang['tools2']['pt_br']='Importar backup de configuração existente';
$lang['tools3']['pt_br']='Enviar backup da configuração e importar';
$lang['tools4']['pt_br']='Baixar backup da configuração';

$lang['tools1']['tr']='MySQLDumper\'i sil';
$lang['tools2']['tr']='Ayar dosyasını ithal et';
$lang['tools3']['tr']='Ayar dosyasını yükle';
$lang['tools4']['tr']='Ayar dosyasını indir';

$lang['tools1']['da']='Afinstallér MySQLDumper';
$lang['tools2']['da']='Importér eksisterende konfigurationsbackup';
$lang['tools3']['da']='Upload og importér konfigurationsbackup';
$lang['tools4']['da']='Download konfigurationsbackup';

$lang['tools1']['lu']='';
$lang['tools2']['lu']='';
$lang['tools3']['lu']='';
$lang['tools4']['lu']='';

$lang['tools1']['pt']='Uninstall MySQLDumper';
$lang['tools2']['pt']='Import existing configuration backup';
$lang['tools3']['pt']='Upload configuration backup and import';
$lang['tools4']['pt']='Download Configuration Backup';

// *****************************************************************************
// Language defaults to english.

if (!in_array($config['language'],$lang['languages'])) $config['language']='en';
include_once('./language/'.$config['language'].'/lang.php');
?>