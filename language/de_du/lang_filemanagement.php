<?php
$lang['convert_start']="Konvertierung starten";
$lang['convert_title']="Konvertiere Dump ins MSD-Format";
$lang['convert_wrong_parameters']="Falsche Parameter! Konvertierung ist nicht möglich.";
$lang['fm_uploadfilerequest']="Gib bitte eine Datei an.";
$lang['fm_uploadnotallowed1']="Dieser Dateityp ist nicht erlaubt.";
$lang['fm_uploadnotallowed2']="Gültige Typen sind: *.gz und *.sql-Dateien";
$lang['fm_uploadmoveerror']="Die hochgeladene Datei konnte nicht in den richtigen Ordner verschoben werden.";
$lang['fm_uploadfailed']="Der Upload ist leider fehlgeschlagen!";
$lang['fm_uploadfileexists']="Es existiert bereits eine Datei mit diesem Namen!";
$lang['fm_nofile']="Du hast gar keine Datei ausgewählt!";
$lang['fm_delete1']="Die Datei ";
$lang['fm_delete2']=" wurde erfolgreich gelöscht.";
$lang['fm_delete3']=" konnte nicht gelöscht werden!";
$lang['fm_choose_file']="gewählte Datei:";
$lang['fm_filesize']="Dateigröße";
$lang['fm_filedate']="Datum";
$lang['fm_nofilesfound']="Keine Datei gefunden.";
$lang['fm_tables']="Tabellen";
$lang['fm_records']="Einträge";
$lang['fm_all_bu']="alle Backups";
$lang['fm_anz_bu']="Backups";
$lang['fm_last_bu']="letztes Backup";
$lang['fm_totalsize']="Gesamtgröße";
$lang['fm_selecttables']="Auswahl bestimmter Tabellen";
$lang['fm_comment']="Kommentar eingeben";
$lang['fm_restore']="Wiederherstellen";
$lang['fm_alertrestore1']="Soll die Datenbank ";
$lang['fm_alertrestore2']="mit den Inhalten der Datei";
$lang['fm_alertrestore3']="wiederhergestellt werden?";
$lang['fm_delete']="ausgewählte Dateien
löschen";
$lang['fm_askdelete1']="Möchtest du die Datei ";
$lang['fm_askdelete2']=" wirklich löschen?";
$lang['fm_askdelete3']="Möchtest du Autodelete nach den eingestellten Regeln jetzt ausführen?";
$lang['fm_askdelete4']="Möchtest du alle Backup-Dateien jetzt löschen?";
$lang['fm_askdelete5']="Möchtest du alle Backup-Dateien mit ";
$lang['fm_askdelete5_2']="_* jetzt löschen?";
$lang['fm_deleteauto']="Autodelete manuell ausführen";
$lang['fm_deleteall']="alle Backup-Dateien löschen";
$lang['fm_deleteallfilter']="alle löschen mit
";
$lang['fm_deleteallfilter2']="_*";
$lang['fm_startdump']="Neues Backup starten";
$lang['fm_fileupload']="Datei hochladen";
$lang['fm_dbname']="Datenbankname";
$lang['fm_files1']="Datenbank-Backups";
$lang['fm_files2']="Datenbank-Strukturen";
$lang['fm_autodel1']="Autodelete: Folgende Dateien wurden aufgrund der maximalen Dateianzahl gelöscht:";
$lang['delete_file_success']="Die Datei \"%s\" wurde erfolgreich gelöscht.";
$lang['fm_dumpsettings']="Einstellungen für das Backup";
$lang['fm_oldbackup']="(unbekannt)";
$lang['fm_restore_header']="Wiederherstellung der Datenbank \"<strong>%s</strong>\"";
$lang['delete_file_error']="Die Datei \"%s\" konnte nicht gelöscht werden!";
$lang['fm_dump_header']="Backup";
$lang['DoCronButton']="Perl-Cronscript ausführen";
$lang['DoPerlTest']="Perl-Module testen";
$lang['DoSimpleTest']="Perl testen";
$lang['perloutput1']="Eintrag in crondump.pl für absolute_path_of_configdir";
$lang['perloutput2']="Aufruf im Browser oder für externen Cronjob";
$lang['perloutput3']="Aufruf in der Shell oder für die Crontab";
$lang['restore_of_tables']="Wiederherstellen bestimmter Tabellen";
$lang['converter']="Backup-Konverter";
$lang['convert_file']="zu konvertierende Datei";
$lang['convert_filename']="Name der Zieldatei (ohne Endung)";
$lang['converting']="Konvertierung";
$lang['convert_fileread']="Datei '%s' wird eingelesen";
$lang['convert_finished']="Konvertierung abgeschlossen, '%s' wurde erzeugt.";
$lang['no_msd_backupfile']="Dateien anderer Programme";
$lang['max_upload_size']="Maximale Dateigröße";
$lang['max_upload_size_info']="Wenn Deine Backup-Datei größer als das angegebene Limit ist, dann musst Du Sie per FTP in den \"work/backup\"-Ordner hochladen.
Danach wird diese Datei hier in der Verwaltung angezeigt und lässt sich für eine Wiederherstellung auswählen.";
$lang['encoding']="Kodierung";
$lang['fm_choose_encoding']="Kodierung der Backupdatei wählen";
$lang['choose_charset']="Leider konnte nicht automatisch ermittelt werden mit welchem Zeichensatz diese Backupdatei seinerzeit angelegt wurde.
<br>Du musst die Kodierung, in der Zeichenketten in dieser Datei vorliegen, manuell angeben.
<br>Danach stellt MySQLDumper die Verbindungskennung zum MySQL-Server auf den ausgewählten Zeichensatz und beginnt mit der Wiederherstellung der Daten.
<br>Solltest Du nach der Wiederherstellung Probleme mit Sonderzeichen entdecken, so kannst Du versuchen, das Backup mit einer anderen Zeichensatzauswahl wiederherzustellen.
<br>Viel Glück. ;)";


?>