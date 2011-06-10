<?php
//generated at 17.03.2007

$lang['help_db']="Ceci est la liste des bases de données existantes";
$lang['help_praefix']="Le préfixe est une suite pour le début de tables et sert comme filtre.";
$lang['help_zip']="Compression avec GZip - 'activé' est recommandé";
$lang['help_memorylimit']="C'est la taille maximale en octets que la mémoire donne au scripte
0 = désactivé";
$lang['memory_limit']="Limite de la mémoire";
$lang['help_mail1']="si c'est activé, alors après la sauvegarde un courriel avec la copie de sauvegarde est jointe.";
$lang['help_mail2']="Ceci est l'adresse électronique du destinataire.";
$lang['help_mail3']="Ceci est l'adresse électronique expéditeur.";
$lang['help_mail4']="La taille maximale pour une pièce jointe. Avec la valeur 0 l'indication est non considérée";
$lang['help_mail5']="Ici vous définissez si la copie de sauvegarde qui doit être envoyée en pièce jointe dans le courriel";
$lang['help_ad1']="Si activé alors les copies de sauvegarde seront automatiquement supprimées.";
$lang['help_ad2']="le nombre maximum de jour que la copie de sauvegarde peut avoir (pour le cas de suppression automatique)
0 = déactivé";
$lang['help_ad3']="le nombre maximum de fichier dans le répertoire des copies de sauvegardes (pour le cas de suppression automatique)
0 = déactivé";
$lang['help_lang']="change sur la langue désirée";
$lang['help_empty_db_before_restore']="Pour éliminer les données superflues on peut définir que la base de données soit vidée complètement avant la restauration";
$lang['help_cronmail']="défini si le script Cron doit envoyer la copie de sauvegarde par courriel";
$lang['help_cronmailprg']="le chemin du programme de courriel, par défaut c'est 'sendmail' qui est indiqué dans le chemin";
$lang['help_cronftp']="défini si le script Cron doit envoyer la copie de sauvegarde par FTP";
$lang['help_cronzip']="La compression avec GZip - 'activé' est recommandée (la 'lib' de compression doit être installée!)";
$lang['help_cronextender']="L'extension standard du script Perl est '.pl'";
$lang['help_cronsavepath']="Le nom du fichier de configuration pour le script Perl";
$lang['help_cronprintout']="Si la sortie de texte est désactivée, aucun texte n'est donné.
Cette fonction est indépendante du journal.";
$lang['help_cronsamedb']="Voulez-vous que la même base de données de la configuration soit utilisée pour le script Cron?";
$lang['help_crondbindex']="sélectionne la base de données pour le script Cron";
$lang['help_cronmail_dump']="Sélectionner si le le cron job doit attacher la sauvegarde au courriel.";
$lang['help_ftptransfer']="si activé, alors après la sauvegarde la copie de sauvegarde est envoyée par FTP.";
$lang['help_ftpserver']="Adresse FTP du serveur";
$lang['help_ftpport']="Port FTP du serveur, Port Standard: 21";
$lang['help_ftpuser']="Entrer le nom de l'utilisateur de la connexion FTP";
$lang['help_ftppass']="entrer le mot de passe de la connexion FTP";
$lang['help_ftpdir']="où doit-être envoyé le fichier?";
$lang['help_speed']="Vitesse minimale et maximale, Standard est de 50 jusqu'à 5000
(des vitesses trop élevées peuvent provoquer des temporisations!)";
$lang['speed']="Contrôle de vitesse";
$lang['help_cronexecpath']="L'endroit où se trouve les scripts Perl.
Point de départ est l'adresse HTTP (dans le navigateur)
Autorisé sont les chemins absolus et relatifs.";
$lang['cron_execpath']="Chemin du script Perl";
$lang['help_croncompletelog']="Si la fonction est activée alors la sortie complète est écrite dans le journal 'complete_log'.
Cette fonction est indépendante de la fonction sortie de texte.";
$lang['help_ftp_mode']="Si vous avez des problèmes durant le transfert FTP, essayez en choisissant passif comme mode de transfert.";


?>