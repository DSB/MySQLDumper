<?php
include("functions.php");
///////////////////////////////////////////////////////////
// Backup-Script von Daniel Schlichtholz
//
// Benutzung erfolgt nat�rlich auf eigene Gefahr
//
// f�r Bugfixes und Erweiterungen schaut auf mein Board:
// http://www.daniel-schlichtholz.de/board
//
// Version 0.9.2
//////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////
// erforderliche Variablen - bitte anpassen 
//////////////////////////////////////////////////////////

$dbhost = 'localhost'; // die Adresse Deines MySQL-Servers
$dbname = 'test'; // der Name der Datenbank
$dbuser = ''; // Dein Benutzername fuer MySQL 
$dbpass = ''; // Dein Passwort fuer den Benutzernamen

// Wo liegt die Datei bzw. wohin soll gespeichert werden ?
// Der Pfad ist relativ zum Scriptverzeichnis.
// Das Script muss Schreibrechte in diesem Ordner haben!
// Wenn das Verzeichnis nicht existiert, wird versucht es anzulegen.
// z.B. $path="./backup/";

$path="./backup/"; 

// Soll die Datei gepackt werden?
// Geht nur mit ZLib support (haben die meisten Anbieter aber),
// andernfalls auf 0 setzen 
// bei $compression=0 wird eine ungepackten Datei 'DD.MM.YYYY_HH_Uhr_MM.sql' erstellt
// bei $compression=1 wird eine gepackte Datei 'DD.MM.YYYY_HH_Uhr_MM.sql.gz' erstellt

$compression=1;

// Soll das fertige Dumpfile an Dich per Email verschickt werden?
// $send_mail=1 -> ja
// $send_mail=0 -> nein
// Achte aber darauf, dass Dein Postfach auch gro� genug f�r Dein Dumpfile ist!

$send_mail=0;

// Wohin soll die Email geschickt werden?
$email[0]="admin@daniel-schlichtholz.de";

// Welche Absenderadresse soll drinstehen?
$email[1]="mein_board@weltweit.de";


////////////////////////////////////////////////////////////////
//
// Variablen, die nur bei Problemen ge�ndert werden sollten...
//
////////////////////////////////////////////////////////////////

 // neue Zeile-Code (soll nur einen Zeilenumbruch im Dump bewirken)
$nl="\n";
 
// Der "Ende des SQL-Befehls"-Code kann ge�ndert werden falls in der Datenbank
// zuf�llig der Standardcode (CHR(1)) vorhanden sein sollte und Du Fehlermeldungen
// beim Restore bekommst.
// Es muss aber ein eindeutiger String sein, der NICHT in den Daten der DB vorkommt.
// z.B. $next_sqlcommand="hier_beginnt_wirklich_der_neue_befehl_124356";
// ein langer String bl�ht zwar das Dumpfile etwas auf, aber lieber ein gro�es funktionierendes 
// Backup, als ein kleines kaputtes :-)

$next_sqlcommand=CHR(1);

// Wieviele Zeilen sollen pro Seitenaufruf gespeichert werden? 
// Hier musst Du testen, was Dein Provider so mitmacht :-) 
// Je h�her die Zahl, desto schneller ist das Backup fertig, aber
// die Gefahr auf ein Timeout zu laufen steigt damit nat�rlich auch.
// Falls Du einen Timeout-Error erhaeltst, verringere die Zahl entsprechend.

$anzahl_zeilen=2000;

// Wieviele SQL-Befehle sollen pro Seitenaufruf in die DB geschrieben werden?
// MySQL ist beim Schreiben langsamer, als beim Lesen - 
// deshalb sollte die Zahl nicht zu hoch gew�hlt werden.
// Falls Du einen Timeout-Error erhaeltst, verringere die Zahl entsprechend.

$anzahl_zeilen_restore=1000;

?>