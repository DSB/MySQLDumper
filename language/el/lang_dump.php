<?php
$lang['dump_headline']="Δημιουργία Αντιγράφου Ασφαλείας...";
$lang['gzip_compression']="Συμπίεση GZip";
$lang['saving_table']="Αποθήκευση πίνακα ";
$lang['of']="από";
$lang['actual_table']="Παρών πίνακας";
$lang['progress_table']="Πρόοδος του πίνακα";
$lang['progress_over_all']="Συνολική Πρόοδος";
$lang['entry']="Εισαγωγή";
$lang['done']="Εγινε!";
$lang['dump_successful']=" δημιουργήθηκε επιτυχώς.";
$lang['upto']="έως";
$lang['email_was_send']="Email στάλθηκε επιτυχώς σε ";
$lang['back_to_control']="Συνέχεια";
$lang['back_to_overview']="Επισκόπηση Β.Δεδομένων";
$lang['dump_filename']="Αρχείο Αντιγράφου Ασφαλείας: ";
$lang['withpraefix']="με πρόθεμα";
$lang['dump_notables']="Δε βρέθηκαν πίνακες στη Β.Δεδομένων `<b>%s</b>` ";
$lang['dump_endergebnis']="Το αρχείο περιέχει <b>%s</b> πίνακες με <b>%s</b> εγγραφές.<br>";
$lang['mailerror']="Η αποστολή email απέτυχε!";
$lang['emailbody_attach']="Το συννημένο περιέχει αντίγραφο ασφαλείας της Βάσης MySQL.<br>Αντίγραφο της Β.Δεδομένων `%s`
<br><br>Το παρακάτω αρχείο δημιουργήθηκε:<br><br>%s <br><br>Ευχαριστίες<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="Ενα αντίγραφο ασφαλείας Multipart δημιουργήθηκε.<br>Τα Αντίγραφα ασφαλείας δεν επισυνάφθηκαν σε αυτό το email!<br>Αντίγραφο της Β.Δεδομένων `%s`
<br><br>Δημιουργήθηκαν τα παρακάτω αρχεία:<br><br>%s
<br><br>Ευχαριστίες<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="Δημιουργήθηκε ένα Multipart Αντίγραφο ασφαλείας.<br>Τα Αντίγραφα ασφαλείας επισυνάφθηκαν σε χωριστά emails.<br>Αντίγραφο της Β.Δεδομένων `%s`
<br><br>Δημιουργήθηκαν τα παρακάτω αρχεία:<br><br>%s <br><br>Ευχαριστίες<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="`<br><br>Ευχαριστώ<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="Το αντίγραφο ασφαλείας έχει υπερβεί το μέγιστο μέγεθος %s και δεν επισυνάφθηκε σε αυτό το email.<br>Αντίγραφο της Β.Δεδομένων `%s`
<br><br>Δημιουργήθηκε το παρακάτω αρχείο:<br><br>%s
<br><br>Ευχαριστίες<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="Τα αρχεία δεν επισυνάφθηκαν σε αυτό το email!<br>Αντίγραφο της Β.Δεδομένων `%s`
<br><br>Δημιουργήθηκε το παρακάτω αρχείο:<br><br>%s
<br><br>Ευχαριστίες<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... συννημένο μόνο.";
$lang['tableselection']="Επιλογή πίνακα";
$lang['selectall']="Επιλογή όλων";
$lang['deselectall']="Αποεπιλογή όλων";
$lang['startdump']="Εκκίνηση Αντιγράφων Ασφαλείας";
$lang['lastbufrom']="Τελευταία αναβάθμιση από";
$lang['not_supported']="Το αντίγραφο ασφαλείας δεν υποστηρίζει αυτή τη λειτουργία.";
$lang['multidump']="Multidump: Το αντίγραφο ασφαλείας της Β.Δεδομένων <b>%d</b> ολοκληρώθηκε.";
$lang['filesendftp']="αποστολή αρχείου μέσω FTP... παρακαλώ περιμένετε. ";
$lang['ftpconnerror']="Δεν έγινε σύνδεση FTP ! ΄Σύνδεση με ";
$lang['ftpconnerror1']=" σαν χρήστης ";
$lang['ftpconnerror2']=" δεν είναι δυνατόν";
$lang['ftpconnerror3']="Η Φόρτωση FTP απέτυχε! ";
$lang['ftpconnected1']="Συνδεμένο με ";
$lang['ftpconnected2']=" σε ";
$lang['ftpconnected3']=" Επιτυχής μεταφορά";
$lang['nr_tables_selected']="- με %s επιλεγμένους πίνακες";
$lang['nr_tables_optimized']="<span class=\"small\">%s πίνακες έχουν βελτιστοποιηθεί.</span>";
$lang['dump_errors']="<p class=\"error\">%s σφάλματα παρουσιάστηκαν: <a href=\"log.php?r=3\">view</a></p>";
$lang['fatal_error_dump']="Γενικό Σφάλμα: Η δήλωση CREATE-Statement του πίνακα '%s' στη Β.Δεδομένων '%s' δε μπορεί να διαβαστεί!<br>
Ελέγξτε τον πίνακα για σφάλματα.


";


?>