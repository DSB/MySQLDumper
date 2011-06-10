MySQlDump von Daniel Schlichtholz
Version 0.9.2
http://www.daniel-schlichtholz.de/board


Willkommen und viel Spaß bei der Benutzung von MySqlDump mit PHP. 

Die Benutzung erfolgt auf eigene Gefahr. 
Ich kann nicht für Datenverluste verantwortlich gemacht werden.

Was hat sich in dieser Version geändert:
----------------------------------------
Die Datei "index.php" ist als neue Schaltzentrale hinzugekommen.
Von hier aus kann man jetzt alle Aktionen auslösen.
Hier habe ich die Erweiterung von Elax und pus234 eingebaut - Vielen Dank.

Erweiterung von Joachim Leicht eingebaut (http://nic.eu.ki) - Vielen Dank.
Das Dumpfile kann nun als Email verschickt werden.

Es ist die Datei "cron_dump.php" hinzugekommen.
Diese Datei eignet sich als Aufrufziel eines Cronjobs, da sie auf 
Ausgaben völlig verzichtet. Sie orientiert sich aber an den Einstellungen 
in der config.php.

Ich habe alle Funktionen in die Datei "functions.php" ausgelagert.
Das macht die anderen Dateien übersichtlicher und vereinfacht eine 
Erweiterung durch andere Programmierer.

In "config.php" kann man nun den "neuer_sql-Befehl-Code" selbst einstellen.
(Es kann auch ein längerer String sein.)

Bugfix: 
bei register_globals=off vergaß "dump.php" den Namen der Backupdatei - gefixt


Viel Spaß mit dem Script.
DSB (Daniel Schlichtholz)