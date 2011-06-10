<?php
//////////////////////////////////////////////////////////
// erforderliche Variablen - bitte anpassen 
// please enter your database-login
//////////////////////////////////////////////////////////
$dbhost = '62.75.192.145';
$dbuser = 'tonischeel';
$dbpass = 'tester';

/////////////////////////////////////////////////////////////////////////////////
// das wars schon - der Rest kann auch innerhalb des Programms geändert werden!
// that's it - you can change the other values from within the program!
/////////////////////////////////////////////////////////////////////////////////

$lang="de"; // de,en
$path="backup/"; 
$compression=1; 
$send_mail=0; 
$email[0]="admin@daniel-schlichtholz.de";
$email[1]="mein_board@weltweit.de";
$ftp_transfer=0;
$ftp_server=""; // Adresse des FTP-Servers. z.B. ftp.server.de
$ftp_port="21"; // Port des FTP-Servers. z.B. 21
$ftp_user=""; // Username
$ftp_pass=""; // Passwort
$ftp_dir=""; // der Pfad, wohin gesendet werden soll (der user muss in diesem Verzeichnis Upload-Rechte haben)
$auto_delete=0;
$del_files_after_days=0;
$max_backup_files=3;
$tabellen_praefix=""; // zum Beispiel /for example "phpBB_"
$anzahl_zeilen=2000;
$anzahl_zeilen_restore=1000;
$cron_timelimit=360;
$cron_samedb=0;
$cron_dbindex=0;
$work_chmod=0777;
?>