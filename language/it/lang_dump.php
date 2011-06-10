<?php
$lang['dump_headline']="Crea backup...";
$lang['gzip_compression']="Compressione-GZip";
$lang['saving_table']="Salva tabella ";
$lang['of']="da";
$lang['actual_table']="Tabella attuale";
$lang['progress_table']="Processo della tabella";
$lang['progress_over_all']="Progresso totale";
$lang['entry']="Registrazione";
$lang['done']="Completato!";
$lang['dump_successful']="è stato creato con successo.";
$lang['upto']="fino a";
$lang['email_was_send']="L`e-mail è stata spedita con successo a ";
$lang['back_to_control']="continua";
$lang['back_to_overview']="Riassunto database";
$lang['dump_filename']="File di backup: ";
$lang['withpraefix']="con prefisso";
$lang['dump_notables']="Impossibile trovare tabelle `<b>%s</b>` nel database.";
$lang['dump_endergebnis']="Sono state salvate <b>%s</b> tabelle con <b>%s</b> record.<br>";
$lang['mailerror']="Spiacente, nell`inviare l`e-mail si è verificato un errore!";
$lang['emailbody_attach']="Nell`allegato trovi il backup del tuo database MySQL.<br>Backup del database `%s`
<br><br>Il seguente file è stato creato:<br><br>%s <br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="È stato creato un backup multipart.<br>Il backup non viene spedito come allegato!<br>Backup del database `%s`
<br><br>I seguenti file sono stati creati:<br><br>%s<br><br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="È stato creato un backup multipart.<br>Il backup viene spedito con e-mail separate, con allegati!<br>Backup del database`%s`
<br><br>I seguenti file sono stati creati:<br><br>%s<br><br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="`<br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="Il backup supera la grandezza massima di %s perciò i file non sono stati allegati.<br>Backup del database `%s`
<br><br>I seguenti file sono stati creati:<br><br>%s
<br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="È stato creato un backup.<br>Il backup non viene spedito come allegato!<br>Backup del database `%s`
<br><br>I seguenti file sono stati creati:<br><br>%s
<br><br>Buona giornata<br><br>MySQLDumper<br>";
$lang['email_only_attachment']="Allegati del backup";
$lang['tableselection']="Seleziona tabelle";
$lang['selectall']="seleziona tutto";
$lang['deselectall']="selezionare tutto";
$lang['startdump']="Fai partire il backup";
$lang['lastbufrom']="ultimo update dal";
$lang['not_supported']="Questo backup non supporta questa funzione.";
$lang['multidump']="Multidump: Sono stati salvati <b>%d</b> database.";
$lang['filesendftp']="Invio del file via FTP in corso... un attimo di pazienza prego. ";
$lang['ftpconnerror']="Connessione FTP non riuscita! Connessione con ";
$lang['ftpconnerror1']="come utente ";
$lang['ftpconnerror2']="non possibile";
$lang['ftpconnerror3']="FTP-Upload errato! ";
$lang['ftpconnected1']="Connesso con ";
$lang['ftpconnected2']="sul ";
$lang['ftpconnected3']="trasferimento completato con successo";
$lang['nr_tables_selected']="- con %s tabelle selezionate";
$lang['nr_tables_optimized']="<span class=\"small\">%s tabelle sono state ottimizzate.</span>";
$lang['dump_errors']="<p class=\"error\">%s errori riscontrati: <a href=\"log.php?r=3\">controllare gli errori</a></p>";
$lang['fatal_error_dump']="Errore fatale: l'istruzione di creazione della tabella '%s' nel database '%s' non è leggibile! <br> Controlla se ci sono dei errori nella tabella.";


?>