<?php
$lang['dump_headline']="skapa backup ...";
$lang['gzip_compression']="GZip-Kompression";
$lang['saving_table']="Speichere Tabelle ";
$lang['of']="von";
$lang['actual_table']="Aktuell tabell";
$lang['progress_table']="Fortschritt Tabelle";
$lang['progress_over_all']="Fortschritt Gesamt";
$lang['entry']="Eintrag";
$lang['done']="Färdig!";
$lang['dump_successful']=" har skapats.";
$lang['upto']="bis";
$lang['email_was_send']="Die Email wurde erfolgreich verschickt an ";
$lang['back_to_control']="fortsätt";
$lang['back_to_overview']="Databasöversikt";
$lang['dump_filename']="Backup-fil: ";
$lang['withpraefix']="mit Praefix";
$lang['dump_notables']="Inga tabeller hittades i databasen `<b>%s</b>`.";
$lang['dump_endergebnis']="<b>%s</b> tabeller med totalt <b>%s</b> dataposter har säkrats.<br>";
$lang['mailerror']="Leider ist beim Verschicken der Email ein Fehler aufgetreten!";
$lang['emailbody_attach']="Här kommer säkringen av din mysqldatabas.<br>Säkring av databasen `%s`
<br><br>Följande fil har skapats:<br><br>%s <br><br>Med vänliga hälsningar<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="En multipart-säkring har skapats.<br>Säkringarna levereras EJ som bilaga i mail!<br>Säkring av databasen `%s`
<br><br>Följande filer har skapats:<br><br>%s<br><br><br>Med vänliga hälsningar<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="En multipart-säkring har skapats.<br>Säkringen levereras i separata mail!<br>Säkring av databasen `%s`
<br><br>Följande filer har skapats:<br><br>%s<br><br><br>Med vänliga hälsningar<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="<br><br><br>Med vänliga hälsningar<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="Die Sicherung überschreitet die Maximalgröße von %s und wurde daher nicht angehängt.<br>Sicherung der Datenbank `%s`
<br><br>Folgende Datei wurde erzeugt:<br><br>%s
<br><br>Viele Grüße<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="Das Backup wurde nicht angehängt.<br>Sicherung der Datenbank `%s`
<br><br>Folgene Datei wurde erzeugt:<br><br>%s
<br><br>Viele Grüße<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... nur der Anhang";
$lang['tableselection']="Tabellenauswahl";
$lang['selectall']="markera alla";
$lang['deselectall']="Deselect all";
$lang['startdump']="Backup starten";
$lang['lastbufrom']="letztes Update vom";
$lang['not_supported']="Dieses Backup unterstützt diese Funktion nicht.";
$lang['multidump']="Multidump: Es wurden <b>%d</b> Datenbanken gesichert.";
$lang['filesendftp']="versende File via FTP... bitte habe etwas Geduld. ";
$lang['ftpconnerror']="FTP-Verbindung nicht hergestellt! Verbindung mit ";
$lang['ftpconnerror1']=" als Benutzer ";
$lang['ftpconnerror2']=" nicht möglich";
$lang['ftpconnerror3']="FTP-Upload war fehlerhaft! ";
$lang['ftpconnected1']="Verbunden mit ";
$lang['ftpconnected2']=" auf ";
$lang['ftpconnected3']=" geschrieben";
$lang['nr_tables_selected']="- mit %s gewählten Tabellen";
$lang['nr_tables_optimized']="<span class=\"small\">%s tables have been optimized.</span>";
$lang['dump_errors']="<p class=\"error\">%s errori riscontrati: <a href=\"log.php?r=3\">verdere</a></p>";
$lang['fatal_error_dump']="Fatal error: the CREATE-Statement of table '%s' in database '%s' couldn't be read!<br>
Check this table for errors.";


?>