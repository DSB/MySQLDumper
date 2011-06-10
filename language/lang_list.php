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
GetLanguageArray();

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
$lang['pl']='Polski';
$lang['ch']='Schweizer Deutsch';
$lang['ar']='Arabic';
$lang['vn']='Vietnamese';
$lang['el']='Ελληνικά';

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
$lang['tools2']['it']='Importare l`attuale backup di configurazione';
$lang['tools3']['it']='Prelevare ed importare il backup di configurazione';
$lang['tools4']['it']='Scaricare backup di configurazione';

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

$lang['tools1']['tr']='MySQLDumperi kaldır';
$lang['tools2']['tr']='Ayar dosyasını içeri aktar';
$lang['tools3']['tr']='Ayar dosyasını yükle ve içeri aktar';
$lang['tools4']['tr']='Ayar dosyasını indir';

$lang['tools1']['da']='Afinstallér MySQLDumper';
$lang['tools2']['da']='Importér eksisterende konfigurationsbackup';
$lang['tools3']['da']='Upload og importér konfigurationsbackup';
$lang['tools4']['da']='Download konfigurationsbackup';

$lang['tools1']['lu']='MySQLDumper deinstallieren';
$lang['tools2']['lu']='Vorhandene Konfigurationssicherung importieren';
$lang['tools3']['lu']='Konfigurationssicherung hochladen und importieren';
$lang['tools4']['lu']='Konfigurationssicherung herunterladen';

$lang['tools1']['pl']='Odinstaluj MySQLDumper';
$lang['tools2']['pl']='Zaimportuj istniejące ustawienia backupu';
$lang['tools3']['pl']='Prześil i zaimportuj ustawienia backupu';
$lang['tools4']['pl']='Ściągnij ustawienia backupu';

$lang['tools1']['ch']='MySQLDumper deinstallieren';
$lang['tools2']['ch']='Vorhandene Konfigurationssicherung importieren';
$lang['tools3']['ch']='Konfigurationssicherung hochladen und importieren';
$lang['tools4']['ch']='Konfigurationssicherung herunterladen';

$lang['tools1']['ar']='Uninstall MySQLDumper';
$lang['tools2']['ar']='Import existing configuration backup';
$lang['tools3']['ar']='Upload configuration backup and import';
$lang['tools4']['ar']='Download Configuration Backup';

$lang['tools1']['vn']='Uninstall MySQLDumper';
$lang['tools2']['vn']='Import existing configuration backup';
$lang['tools3']['vn']='Upload configuration backup and import';
$lang['tools4']['vn']='Download Configuration Backup';

$lang['tools1']['el']='Απεγκατάσταση MySQLDumper';
$lang['tools2']['el']='Εισαγωγή υπάρχουσας αποθηκευμένης ρύθμισης';
$lang['tools3']['el']='Φόρτωση αποθηκευμένης ρύθμισης και εισαγωγή της';
$lang['tools4']['el']='Μεταφόρτωση αποθηκευμένης ρύθμισης';

// *****************************************************************************
// Language defaults to english.

if (!in_array($config['language'],$lang['languages'])) $config['language']='en';
include_once('./language/'.$config['language'].'/lang.php');
?>