<?php
$lang['dump_headline']="Lav backup...";
$lang['gzip_compression']="GZip-komprimering";
$lang['saving_table']="Gemmer tabel ";
$lang['of']="af";
$lang['actual_table']="Aktuel tabel";
$lang['progress_table']="Fremskridt i tabel";
$lang['progress_over_all']="Samlet fremskridt";
$lang['entry']="Indlæg";
$lang['done']="Færdig!";
$lang['dump_successful']=" blev fremstillet korrekt.";
$lang['upto']="op til";
$lang['email_was_send']="Email blev korrekt sendt til ";
$lang['back_to_control']="Fortsæt";
$lang['back_to_overview']="Databaseoversigt";
$lang['dump_filename']="Backup Fil: ";
$lang['withpraefix']="med præfiks";
$lang['dump_notables']="Ingen tabeller fundet i database `<b>%s</b>` ";
$lang['dump_endergebnis']="Filen indeholder <b>%s</b> tabeller med <b>%s</b> poster.<br>";
$lang['mailerror']="Afsendelse af email slog fejl!";
$lang['emailbody_attach']="Den vedhæftede fil indeholder backup af din MySQL-Database.<br>Backup af Database `%s`
<br><br>Følgende fil blev oprettet:<br><br>%s <br><br>Venlig hilsen<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="En Multipart Backup blev oprettet.<br>Backupfilerne er ikke vedhæftet denne email!<br>Backup af Database `%s`
<br><br>Følgende filer blev oprettet:<br><br>%s
<br><br>Venlig hilsen<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="En Multipart Backup er blevet oprettet.<br>Backupfilerne er vedhæftet separate emails.<br>Backup af Database `%s`
<br><br>Følgende filer blev oprettet:<br><br>%s <br><br>Med venlig hilsen<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="<br><br>Venlig hilsen<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="Backupfilen oversteg maksimumstørrelsen på %s og blev ikke vedhæftet denne email.<br>Backup sf Database `%s`
<br><br>Følgende fil blev oprettet:<br><br>%s
<br><br>Venlig hilsen<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="Filer er ikke vedhæftet denne email!<br>Backup af Database `%s`
<br><br>Følgende fil blev oprettet:<br><br>%s
<br><br>Venlig hilsen<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... kun vedhæftet.";
$lang['tableselection']="Tabelvælg";
$lang['selectall']="Vælg alle";
$lang['deselectall']="Fravælg alle";
$lang['startdump']="Start Backup";
$lang['lastbufrom']="sidst opdateret fra";
$lang['not_supported']="Denne backup understøtter ikke denne funktion.";
$lang['multidump']="Multidump: Backup af <b>%d</b> Databaser færdige.";
$lang['filesendftp']="send fil via FTP... vær venligst tålmodig. ";
$lang['ftpconnerror']="FTP-forbindelse ikke etableret! Forbind med ";
$lang['ftpconnerror1']=" som bruger ";
$lang['ftpconnerror2']=" ikke muligt";
$lang['ftpconnerror3']="FTP-upload fejlede! ";
$lang['ftpconnected1']="Forbundet med ";
$lang['ftpconnected2']=" på ";
$lang['ftpconnected3']=" overførsel korrekt gennemført";
$lang['nr_tables_selected']="- med %s valgte tabeller";
$lang['nr_tables_optimized']="<span class=\"small\">%s tabeller er blevet optimeret.</span>";
$lang['dump_errors']="<p class=\"error\">%s fejl optrådte: <a href=\"log.php?r=3\">se log</a></p>


";
$lang['fatal_error_dump']="Fatal error: the CREATE-Statement of table '%s' in database '%s' couldn't be read!<br>
Check this table for errors.";


?>