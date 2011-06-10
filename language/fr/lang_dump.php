<?php
$lang['dump_headline']="créer copie de sauvegarde...";
$lang['gzip_compression']="La compression GZip";
$lang['saving_table']="Sauvegarder les tables ";
$lang['of']="de";
$lang['actual_table']="Table actuelle";
$lang['progress_table']="Progression de la table";
$lang['progress_over_all']="Progression totale";
$lang['entry']="Point d'entrée";
$lang['done']="Terminé!";
$lang['dump_successful']=" crée avec succès.";
$lang['upto']="jusqu'à";
$lang['email_was_send']="Le courriel a été envoyé avec succès à ";
$lang['back_to_control']="Continuer";
$lang['back_to_overview']="Aperçu général des\nbases de données";
$lang['dump_filename']="Nom du fichier de sauvegarde: ";
$lang['withpraefix']="avec préfixe";
$lang['dump_notables']="Aucune table n'a été trouvée dans la base de donnée `<b>%s</b>`.";
$lang['dump_endergebnis']="<b>%s</b> table(s) avec en tout <b>%s</b> enregistrement(s) a/ont été sauvegardée(s).<br>";
$lang['mailerror']="Malheureusement une erreur est apparue lors de l'envoie par courriel!";
$lang['emailbody_attach']="Dans le fichier joint vous trouverez une sauvegarde de votre base de données MySQL.<br>Copie de sauvegarde de la base de données `%s`
<br><br>Les fichiers suivants ont été créés:<br><br>%s <br><br>Cordialement<br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="Une sauvegarde en plusieurs parties a été créé.<br>Les sauvegardes ne sont pas envoyées en pièces jointes!<br>Copie de sauvegarde de la base de données `%s`
<br><br>Les fichiers suivants ont été créés:<br><br>%s<br><br><br>Cordialemene<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="Une sauvegarde en plusieurs parties a été créé.<br>Les sauvegardes sont envoyées en pièces jointes!<br>Copie de sauvegarde de la base de données `%s`
<br><br>Les fichiers suivants ont été créés:<br><br>%s<br><br><br>Cordialemene<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="<br><br><br>Cordialement<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="La copie de sauvegarde dépasse la taille maximale de %s. Pour cette raison elle n'a pas été envoyée en pièces jointes.<br>Copie de sauvegarde de la base de données `%s`
<br><br>Les fichiers suivants ont été créés:<br><br>%s
<br><br>Cordialement<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="La copie de sauvegarde n'est pas jointe.<br>Copie de sauvegarde de la base de données `%s`
<br><br>Les fichiers suivants ont été créés:<br><br>%s
<br><br>Cordialement<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... seulement la pièce jointe";
$lang['tableselection']="Sélection de la table";
$lang['selectall']="Tout sélectionner";
$lang['deselectall']="Tout désélectionner";
$lang['startdump']="Démarrer la sauvegarde";
$lang['lastbufrom']="dernière sauvegarde du";
$lang['not_supported']="Cette sauvegarde ne supporte pas cette fonction.";
$lang['multidump']="Sauvegarde en plusieurs parties: Les bases de données <b>%d</b> ont été sauvegardées.";
$lang['filesendftp']="Les fichiers sont envoyés par FTP... Veuillez patienter. ";
$lang['ftpconnerror']="Aucune connexion FTP n'a pu être établie! Connecter avec ";
$lang['ftpconnerror1']=" comme utilisateur ";
$lang['ftpconnerror2']=" impossible";
$lang['ftpconnerror3']="Téléchargement vers le serveur FTP est erroné! ";
$lang['ftpconnected1']="Connecté avec ";
$lang['ftpconnected2']=" sur ";
$lang['ftpconnected3']=" a été écrit";
$lang['nr_tables_selected']="- avec %s des tables sélectionnées";
$lang['nr_tables_optimized']="<span class=\"small\">%s tables ont été optimisées.</span>";
$lang['dump_errors']="<p class=\"error\">%s erreurs rencontrées: <a href=\"log.php?r=3\">verdere</a></p>";
$lang['fatal_error_dump']="Erreur fatale: Le rapport de création de la table '%s' de la base de données
'%s' ne peut pas être lu !<br>Vérifiez cette table et les erreurs éventuelles.";


?>