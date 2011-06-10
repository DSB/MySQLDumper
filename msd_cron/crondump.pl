#!/usr/bin/perl -w
########################################################################################
# MySQLDumper CronDump
#
# 2004-2009 by Steffen Kamper, Daniel Schlichtholz
# additional scripting: Detlev Richter
#
# for support etc. visit http://www.mysqldumper.de/board
# (c) GNU General Public License
########################################################################################
# Script-Version
$pcd_version="1.24";

########################################################################################
# please enter the absolute path of the config-dir
# when calling the script without parameters the default_configfile (mysqldumper.conf.php) will be loaded
# e.g. - (zum Beispiel): 
# my $absolute_path_of_configdir="/home/www/doc/8176/mysqldumper.de/www/mysqldumper/work/config/";

my $absolute_path_of_configdir="";
my $cgibin_path=""; # this is needed for MIME::Lite if it is in cgi-bin
my $default_configfile="mysqldumper.conf.php";

########################################################################################
# nothing to edit below this line !!!
########################################################################################
# import the necessary modules ...
use strict;
use warnings;
use DBI;
use File::Find;
use File::Basename;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
warningsToBrowser(1);
use CGI;
use Data::Dumper;

########################################################################################
use vars qw(
$pcd_version $dbhost $dbname $dbuser $dbpass $dbport $dbsocket
$cron_dbindex @cron_db_array @ftp_server $dbpraefix @cron_dbpraefix_array 
$compression  $backup_path $logdatei $completelogdatei $nl $command_beforedump $command_afterdump
$cron_printout $cronmail $cronmail_dump $cronmailto $cronmailto_cc $cronmailfrom
$cronftp $mp $multipart_groesse $email_maxsize
$auto_delete $max_backup_files $perlspeed $optimize_tables_beforedump $result
@key_value $pair $key $value $conffile @confname $logcompression $log_maxsize $complete_log 
$starttime $Sekunden $Minuten $Stunden $Monatstag $Monat $Jahr $Wochentag $Jahrestag $Sommerzeit
$rct $tabelle  @tables @tablerecords $dt $sql_create @ergebnis @ar $sql_daten $inhalt
$insert $totalrecords $error_message $cfh $oldbar $print_out $msg $dt $ftp $dateistamm $dateiendung
$mpdatei $i $BodyNormal $BodyMultipart $BodyToBig $BodyNoAttach $BodyAttachOnly $Body $DoAttach $cmt $part $fpath $fname
$fmtime $timenow $daydiff $datei $inh $gz $search $fdbname @str $item %dbanz $anz %db_dat 
$fieldlist $first_insert $my_comment $sendmail_call $config_read_from
$cron_smtp $cron_smtp_port $cron_use_sendmail $v1 $v2 
@ftp_transfer @ftp_timeout @ftp_user @ftp_pass @ftp_dir @ftp_server @ftp_port @ftp_mode
$output $query $skip $html_output $datei
@trash_files $time_stamp @filearr $sql_file $backupfile $memory_limit $dbh $sth @db_array
@dbpraefix_array @cron_command_before_dump @cron_command_after_dump $db_anz
$record_count $filesize $status_start $status_end $sql_text $punktzaehler @backupfiles_name
@backupfiles_size $mysql_commentstring $character_set $mod_gz $mod_mime $mod_ftp
@multipartfiles %db_tables @tablenames $tablename $opttbl $command
);

$memory_limit=100000;
$mysql_commentstring="-- ";
$character_set="utf8";
$sql_text='';
$sql_file='';
$punktzaehler=0;
@trash_files=();
@filearr=();
$opttbl=0;
$dbpraefix="";

# import the optional modules ...
my $eval_in_died;
$mod_gz=0;
$mod_ftp=0;
$mod_mime=0;
push (@INC, "$cgibin_path");

eval { $eval_in_died = 1; require Compress::Zlib; };
if(!$@){
	$mod_gz = 1;
	import Compress::Zlib;
}
eval { $eval_in_died = 1; require Net::FTP; };
if(!$@){
	$mod_ftp = 1;
	import Net::FTP;
}
eval { $eval_in_died = 1; require MIME::Lite; };
if(!$@){
	$mod_mime = 1;
	import MIME::Lite;
}

#include config file
$conffile="";

use Getopt::Long;
GetOptions ("config=s" => \$conffile, "html_output=s"  => \$html_output);
if (!defined $html_output) { $html_output=0; };	# suppress HTML Output 

if($ENV{'QUERY_STRING'}) {
	$html_output=1; # turn HTML Output on if called via Browser-Request
	my $querystring=$ENV{'QUERY_STRING'};
	#$querystring=~ s/\?/ /g;
	@key_value = split(/&/,$querystring);
	foreach $pair(@key_value)
	{
		#$pair =~ tr/+/ /;
		($key,$value) = split(/=/,$pair);
		if($key eq "config")
		{
			$value=~ s/\?/ /g;
			$conffile=$value;
			$config_read_from="Querystring";
		}
		if($key eq "html_output") { $html_output=$value; }; # overwrite var if given in call
	}
}else{
	$config_read_from="shell";
}

# Now we know if script was called via HTTP-Requets or from Shell. So output Headers
PrintHeader();

# Security: try to detect wether someone tries to include some external configfile
die "Hacking attempt - I wont do anything!\nGo away\n\n" if (lc($conffile) =~ m /:/);

#try to guess path if $absolute_path_of_configdir is not filled
if($absolute_path_of_configdir eq "" || ! -d $absolute_path_of_configdir) 
{	
	#get full path
	if ($config_read_from eq "shell") { $i=$0; } else { $i=$ENV{'SCRIPT_FILENAME'}; };
	#regex from http://www.perlmonks.org/?node_id=47035
	if ($i=~m#^(.*)\\#) {
		#windows
    		$absolute_path_of_configdir = "$1"."work\\config\\";
	} elsif ($i=~m#^(.*)/# ) {
		#*nix
    		$absolute_path_of_configdir = "$1"."work/config/";
	}
	$absolute_path_of_configdir =~ s/msd\_cron//g;
}

$conffile=trim($conffile);
if($conffile eq "") 
{
	$conffile=$default_configfile; # no Parameter for configfile given -> use standardfile "mysqldumper.php.conf"
	$config_read_from="standard configuration";
}


# check config-dir
$absolute_path_of_configdir=trim($absolute_path_of_configdir); # remove spaces
opendir(DIR, $absolute_path_of_configdir) or die "The config-directory you entered is wrong !\n($absolute_path_of_configdir - $!) \n\nPlease edit the crondump.pl and enter the right configuration-path.\n\n";
closedir(DIR);
my $abc=length($absolute_path_of_configdir)-1;
my $defed=substr($absolute_path_of_configdir,$abc,1);
if($defed ne "/") {
	$absolute_path_of_configdir=$absolute_path_of_configdir."/";
}

if (substr($conffile,length($conffile)-5,5) eq '.conf') { $conffile.='.php'; };
if (substr($conffile,length($conffile)-9,9) ne '.conf.php') { $conffile.='.conf.php'; };

# load configuration file
$datei=$absolute_path_of_configdir.$conffile;
open(CONFIG,"<$datei") or die "\nI couldn't open the configurationfile:".$datei."\nFile not found or not accessible!\n\n";
while (my $line = <CONFIG>)
{
	chomp($line);
	if ($line ne '<?php' && $line ne '1;' && substr($line,0,2) ne '?>' && substr($line,0,1) ne '#')
	{
		eval($line);
	}
}
close(CONFIG);

if ($html_output==1) { $cron_printout=1; }; # overwrite output if HTML-Output is activated

@confname=split(/\//,$conffile);


PrintOut("<span style=\"color:#0000FF;\">Configurationfile '".$conffile."' was loaded successfully from ".$config_read_from." .</span>");
if($mod_gz==1) {
	PrintOut("<span style=\"color:#0000FF;\">Compression Library loaded successfully...</span>");
} else {
	$compression=0;
	PrintOut("<span style=\"color:red;\">Compression Library loading failed - Compression deactivated ...</span>");
}
if($mod_ftp==1) {
	PrintOut("<span style=\"color:#0000FF;\">FTP Library loaded successfully...</span>");
} else {
	$cronftp=0;
	PrintOut("<span style=\"color:red;\">FTP Library loading failed - FTP deactivated ...</span>");
}
if($mod_mime==1) {
	PrintOut("<span style=\"color:#0000FF;\">Mail Library loaded successfully...</span>");
} else {
	$cronmail=0;
	PrintOut("<span style=\"color:red;\">Mail Library loading failed - Mail deactivated ...</span>");
}

#teste Zugriff auf logfile
write_log("Starting backup using Perlscript version $pcd_version (configuration $conffile)\n");

#Jetzt den Dump anschmeissen
# mal schauen, obs mehrere DB's sind
if($cron_dbindex > -1) 
{
	$dbname=$cron_db_array[$cron_dbindex];
	$dbpraefix=$cron_dbpraefix_array[$cron_dbindex];
	$command_beforedump=$cron_command_before_dump[$cron_dbindex];
	$command_afterdump=$cron_command_after_dump[$cron_dbindex];
	ExecuteCommand(1,$command_beforedump);
	DoDump();
	ExecuteCommand(2,$command_afterdump);
}  
else 
{
	$db_anz=@cron_db_array;
	for(my $ii = 0; $ii < $db_anz; $ii++) 
	{
		if ($mp>0) { $mp=1; } # Part-Reset if using Multipart (for next database)
		$dbname=$cron_db_array[$ii];
		$dbpraefix=$cron_dbpraefix_array[$ii];
		$command_beforedump=$cron_command_before_dump[$ii];
		$command_afterdump=$cron_command_after_dump[$ii];
		PrintOut("<hr>Starting backup <strong>".($ii+1)."</strong> of <strong>$db_anz</strong> (database <strong>`$dbname`</strong> ".(($dbpraefix ne "") ? "- looking for tables with prefix '<span style=\"color:blue\">$dbpraefix</span>')" : ")"));
		ExecuteCommand(1,$command_beforedump);
		DoDump();
		ExecuteCommand(2,$command_afterdump);
	}
	PrintOut("<hr><strong>ALL $db_anz BACKUPS ARE DONE!!!</strong>");
}

if($auto_delete>0) 
{
	if($max_backup_files>0) 
	{
		PrintOut("<br><b>Starting autodelete function:</b><br>Keep the latest <font color=\"#0000FF\">$max_backup_files</font> backup files for each database and delete older ones.");
		find(\&AutoDeleteCount, $backup_path);
		DoAutoDeleteCount();
		DeleteFiles (\@trash_files);
	}
}
closeScript();
if ($html_output==0) { print "\nEnd of Cronscript\n"; }

##############################################
# Subroutinen                                #
##############################################
sub DoDump {
	undef(%db_tables);
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900;$Monat+=1;$Jahrestag+=1;
	my $CTIME_String = localtime(time);
	my $ret=0;
	$time_stamp=$Jahr."_".sprintf("%02d",$Monat)."_".sprintf("%02d",$Monatstag)."_".sprintf("%02d",$Stunden)."_".sprintf("%02d",$Minuten);
	$starttime= sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."  ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten);
	$fieldlist="";
	# Verbindung mit MySQL herstellen, $dbh ist das Database Handle
	if (trim($dbsocket) eq "")
	{
		$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
	}
	else
	{
		$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport;mysql_socket=$dbsocket","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
	}
	# herausfinden welche Mysql-Version verwendet wird
	$sth = $dbh->prepare("SELECT VERSION()");
	$sth->execute;
	my @mysql_version=$sth->fetchrow;
	my @v=split(/\./,$mysql_version[0]);

	if($v[0]>=5 || ($v[0]>=4 && $v[1]>=1) )
	{
		#mysql Version >= 4.1
		$sth = $dbh->prepare("SET NAMES '".$character_set."'");
		$sth->execute;
		# get standard encoding of MySQl-Server
		$sth = $dbh->prepare("SHOW VARIABLES LIKE 'character_set_connection'");
		$sth->execute;
		@ar=$sth->fetchrow; 
		$character_set=$ar[1];
		PrintOut("Characterset of connection and backup file set to <strong>".$character_set."</strong>.");
	}
	else
	{
		# mysql Version < 4.1 -> no SET NAMES available
		# get standard encoding of MySQl-Server
		$sth = $dbh->prepare("SHOW VARIABLES LIKE 'character_set'");
		$sth->execute;
		@ar=$sth->fetchrow; 
		if (defined($ar[1])) { $character_set=$ar[1]; }
		PrintOut("Characterset of connection is <strong>".$character_set."</strong>.");
	}

	
	#Statuszeile erstellen
	my $t=0;
	my $r=0;
	my $st_e="\n";
	undef(@tables);
	undef(@tablerecords);
	my $value=0;
	my $engine='';
	my $query="SHOW TABLE STATUS FROM `$dbname`";
	if ($dbpraefix ne "") 
	{ 
		$query.=" LIKE '$dbpraefix%'"; 
		PrintOut("Searching for tables inside database <strong>`$dbname`</strong> with prefix <strong>'$dbpraefix'</strong>"); 
	} 
	else
	{
		PrintOut("Searching for tables inside database <strong>`$dbname`</strong>"); 
	}
	$sth = $dbh->prepare($query);
	$sth->execute || err_trap("Error executing: ".$query." !  MySQL-Error: ".$DBI::errstr);
	while ( $value=$sth->fetchrow_hashref()) 
	{
		$value->{skip_data}=0; #defaut -> backup data of table
		# decide if we need to skip the data while dumping (VIEWs and MEMORY)
		
		# check for old MySQL3-Syntax Type=xxx 
		if (defined $value->{Type})
		{
			# port old index type to index engine, so we can use the index Engine in the rest of the script
			$value->{Engine}=$value->{Type}; 
			$engine=uc($value->{Type});
			if ($engine eq "MEMORY")
			{
				$value->{skip_data}=1;
			}
		}

		# check for >MySQL3 Engine=xxx 
		if (defined $value->{Engine})
		{
			$engine=uc($value->{Engine});
			if ($engine eq "MEMORY")
			{
				$value->{skip_data}=1;
			}
		}

		# check for Views - if it is a view the comment starts with "VIEW"
		if (defined $value->{Comment} && uc(substr($value->{Comment},0,4)) eq 'VIEW')
		{
			$value->{skip_data}=1;
		}

		$db_tables{$value->{Name}}=$value;
	}
	$sth->finish;

	@tablenames=sort keys(%db_tables);
	$tablename='';
	if (@tablenames<1)
	{
		PrintOut("There are no tables inside database <b>".$dbname."</b>! It doesn't make sense to backup an empty database. Skipping this one.");
		return;	
	}
	if($optimize_tables_beforedump==1) 
	{
		optimise_tables();
	}
	
	$st_e.="-- TABLE-INFO\n";
	foreach $tablename (@tablenames) 
	{
		my $dump_table=1;
		if ($dbpraefix ne "")
		{
			if (substr($tablename,0,length($dbpraefix)) ne $dbpraefix) 
			{
				# eclude tabel from backup because it doesn't fit to praefix
				$dump_table=0;
			}
		}
						
		if ($dump_table==1)
		{
			$r+=$db_tables{$tablename}{Rows}; #calculate nr of records
			push(@tables,$db_tables{$tablename}{Name}); # add tablename to backupped tables
			$t++;
			if (!defined $db_tables{$tablename}{Update_time})
			{
				$db_tables{$tablename}{Update_time}=0;
			}
			
			$st_e.=$mysql_commentstring."TABLE\|$db_tables{$tablename}{Name}\|$db_tables{$tablename}{Rows}\|".($db_tables{$tablename}{Data_length}+$db_tables{$tablename}{Index_length})."\|$db_tables{$tablename}{Update_time}|$db_tables{$tablename}{Engine}\n";
		}
	}
	$st_e.="-- EOF TABLE-INFO";
	
	PrintOut("Found ".(@tables)." tables with $r records.");

	#AUFBAU der Statuszeile:
	#	-- Status:tabellenzahl:datensaetze:Multipart:Datenbankname:script:scriptversion:Kommentar:MySQLVersion:Backupflags:SQLBefore:SQLAfter:Charset:EXTINFO
	#	Aufbau Backupflags (1 Zeichen pro Flag, 0 oder 1, 2=unbekannt)
	#	(complete inserts)(extended inserts)(ignore inserts)(delayed inserts)(downgrade)(lock tables)(optimize tables)
	#
	$status_start=$mysql_commentstring."Status:$t:$r:";
	my $flags="1$optimize_tables_beforedump";
	$status_end=":$dbname:perl:$pcd_version:$my_comment:$mysql_version[0]:$flags";
	$status_end.=":$command_beforedump:$command_afterdump:$character_set:EXTINFO$st_e\n".$mysql_commentstring."Dump created on $CTIME_String by PERL Cron-Script\n".$mysql_commentstring."Dump by MySQLDumper (http://www.mysqldumper.de/)\n\n";


	if($mp>0) 
	{
		$sql_text=$status_start."MP_$mp".$status_end;
	}
	else
	{
		$sql_text=$status_start.$status_end;
	}
	NewFilename();
	
	$totalrecords=0;
	foreach $tablename (@tables) 
	{
		# first get CREATE TABLE Statement 
		if($dbpraefix eq "" || ($dbpraefix ne "" && substr($tablename,0,length($dbpraefix)) eq $dbpraefix)) 
		{
			PrintOut("Dumping table `<strong>$tablename</strong>` ");
			$a="\n\n$mysql_commentstring\n$mysql_commentstring Create Table `$tablename`\n$mysql_commentstring\n\nDROP TABLE IF EXISTS `$tablename`;\n";
			$sql_text.=$a;
			$sql_create="SHOW CREATE TABLE `$tablename`";
			$sth = $dbh->prepare($sql_create);
			if (!$sth)
			{
				err_trap("<font color=\"red\">Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
			}

			$sth->execute || err_trap("Couldn't execute ".$sql_create);
			@ergebnis=$sth->fetchrow;
			$sth->finish;
			$a=$ergebnis[1].";\n";
			if (length($a)<10)
			{
				err_trap("Fatal error! Couldn't read CREATE-Statement of table `$tabelle`! This backup might be incomplete! Check your database for errors.",1);
				$skip=1;
			}
			else 
			{
				$sql_text.=$a;
			}
			
			if ($db_tables{$tablename}{skip_data} == 0)
			{
				$sql_text.="\n$mysql_commentstring\n$mysql_commentstring Data for Table `$tablename`\n$mysql_commentstring\n";
				$sql_text.="\n/*!40000 ALTER TABLE `$tablename` DISABLE KEYS */;";

				WriteToFile($sql_text,0);
				$sql_text="";
				$punktzaehler=0;
				$fieldlist="(";
				$sql_create="SHOW FIELDS FROM `$tablename`";
				$sth = $dbh->prepare($sql_create);
				if (!$sth)
				{
					err_trap("<font color=\"red\">Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
				}
				
				$sth->execute || err_trap("Couldn't execute ".$sql_create);
				while ( @ar=$sth->fetchrow) {
					$fieldlist.="`".$ar[0]."`,";
				}
				$sth->finish;			
				$fieldlist=substr($fieldlist,0,length($fieldlist)-1).")";

				# daten auslesen
				$rct=$db_tables{$tablename}{Rows};

				for (my $ttt=0;$ttt<$rct;$ttt+=$perlspeed) 
				{
					$insert = "INSERT INTO `$tablename` $fieldlist VALUES (";
					$first_insert=0;
					$sql_daten="SELECT * FROM `$tablename` LIMIT ".$ttt.",".$perlspeed.";";
					$sth = $dbh->prepare($sql_daten);
					if (!$sth)
					{
						err_trap("<font color=\"red\">Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
					}
					$sth->execute || err_trap("Couldn't execute \"".$sql_daten."\" - MySQL-Error: ".$DBI::errstr);
					while ( @ar=$sth->fetchrow) 
					{
						#Start the insert
						if($first_insert==0) 
						{
							$a="\n$insert";
						}
						else
						{
							$a="\n(";
						}	
						foreach $inhalt(@ar) { $a.= $dbh->quote($inhalt).","; }
						$a=substr($a,0, length($a)-1).");";
						$sql_text.= $a;
						if($memory_limit>0 && length($sql_text)>$memory_limit) 
						{
							WriteToFile($sql_text);
							$sql_text="";
							if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
						}
					}
					$sth->finish;
				}
				$sql_text.="\n/*!40000 ALTER TABLE `$tablename` ENABLE KEYS */;";
			}

			#jetzt wegschreiben
			WriteToFile($sql_text);
			$sql_text="";
			PrintOut("\n<br><em>$db_tables{$tablename}{Rows} inserted records (size of backupfile now: ".byte_output($filesize).")</em>");
			$totalrecords+=$db_tables{$tablename}{Rows};
			if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
		}
	}
	# Ende
	WriteToFile("\nSET FOREIGN_KEY_CHECKS=1;\n");
	WriteToFile($mysql_commentstring."EOB\n");
	PrintOut("\n<hr>Finished backup of database `$dbname`.");
	write_log("Finished backup of database `$dbname`.\n");

	# Jetzt der Versand per Mail
	if($cronmail==1) {
		PrintOut("Sending E-Mail ...");
		$ret=send_mail();
		if ($ret)
		{
			write_log("Recipient/s: $cronmailto $cronmailto_cc\n");
			PrintOut("Recipient/s: $cronmailto $cronmailto_cc\n");
		}
	}

	# Jetzt der Versand per FTP
	send_ftp();
}

#Wird aufgerufen, wenn Fehler passieren
sub err_trap {
	$error_message = shift(@_);
	my $continue = shift(@_);
	PrintOut("<font color=\"red\">Perl Cronscript ERROR: <b>$error_message</b></font><br>");
	write_log("<font color=\"red\">Perl Cronscript ERROR: <b>$error_message</b></font><br>");
	if (!defined $continue)
	{
		PrintOut("<font color=\"red\"><b>Stopping script because of this fatal error!</b></font><br>");
		write_log("<font color=\"red\"><b>Stopping script because of this fatal error!</b></font><br>");
		exit(1);
	}
}

sub PrintHeader {
	my $cgi = new CGI;
	if ($html_output==1)
	{
		print $cgi->header(-type => 'text/html; charset=utf-8', -cache_control => 'no-cache, no-store, must-revalidate');
		print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
		print "<html><head><title>MySQLDumper - Perl CronDump [Version $pcd_version]</title>";
		print "<style type=\"text/css\">\nbody { padding:20px; } \n</style>";
		print "</head><body><h3>MySQLDumper - Perl CronDump [Version $pcd_version]</h3>\n";
	}
	else
	{
		#Mini-Ausgabe fuer externe Cronjob-Dienste, die eine kleine Rueckgabe erwarten
		print "MySQLDumper - Perl CronDump [Version $pcd_version] started successfully\n";
	}
}

sub PrintOut {
	$print_out = shift(@_);

	if (defined $print_out && length(trim($print_out))>0)
	{
		if($complete_log==1) 
		{
			my $logsize=0;
			($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
			$Jahr+=1900; $Monat+=1;$Jahrestag+=1;
			$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden);
			if (-e $completelogdatei) 
			{
				$logsize=(stat($completelogdatei))[7];
				unlink($completelogdatei) if($logsize + length($print_out)>$log_maxsize && $log_maxsize>0);
			}
			my $output=$print_out;
			#$output =~ s/<(.*?)>//gi;
			$output =~ s/\n//gi;
			$output =~ s/\r//gi;
			$output =~ s/<br>//gi;
			$output=trim($output);
			
			if ( ($logcompression==0) || ($mod_gz==0)) 
			{
				open(DATEI,">>$completelogdatei") || err_trap('can\'t open mysqldump_perl.complete.log ('.$completelogdatei.').');
				print DATEI "$dt $output\n" || err_trap('can\'t write to mysqldump_perl.complete.log ('.$completelogdatei.').');
				close(DATEI)|| err_trap('can\'t close mysqldump_perl.complete.log ('.$completelogdatei.').');
				chmod(0777,$completelogdatei);
			}
			else
			{
				$gz = gzopen($completelogdatei, "ab") || err_trap("Cannot open mysqldump_perl.complete.log. ");
				$gz->gzwrite("$dt $output\n")  || err_trap("Error writing mysqldump_perl.complete.log. ");
				$gz->gzclose ;
				chmod(0777,$completelogdatei);
			}
		}
		if($cron_printout==1) 
		{
			local ($oldbar) = $|;
			$cfh = select (STDOUT);
			$| = 1;
			if($html_output==0) 
			{
				$print_out =~ s/<(.*?)>//gi;
			}
			
			print $print_out;
			if ($html_output==1){ print "<br>\n"; } else { print "\n"; };
			$| = $oldbar;
			select ($cfh);
		}
	}
}

sub write_log {
	$msg = shift(@_);
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900; $Monat+=1;$Jahrestag+=1;
	$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden);

	my $logsize=0;
	if (-e $logdatei) 
	{
		$logsize=(stat($logdatei))[7];
		unlink($logdatei) if($logsize+200>$log_maxsize && $log_maxsize>0);
	}

	if ( ($logcompression==0) || ($mod_gz==0)) 
	{
		open(DATEI,">>$logdatei") || err_trap("Can't open file ($logdatei).");
		print DATEI "$dt $msg" || err_trap("Can't write to file ($logdatei).");
		close(DATEI)|| err_trap("can't close file ($logdatei).");
		chmod(0777,$logdatei);
	} 
	else
	{
		$gz = gzopen($logdatei, "ab") || err_trap("Can't open $logdatei.");
		$gz->gzwrite("$dt $msg")  || err_trap("Can't write to $logdatei. ");
		$gz->gzclose ;
		chmod(0777,$logdatei);
	}
}

sub send_ftp {
	my $ret=0;
	my $x=0;
	for(my $i = 0; $i <3; $i++)
	{
		if ($ftp_transfer[$i]==1)
		{
			if ($ftp_timeout[$i]<1) { $ftp_timeout[$i]=30; };
			$ftp = Net::FTP->new($ftp_server[$i], Port => $ftp_port[$i], Timeout => $ftp_timeout[$i], Debug   => 1,Passive => $ftp_mode[$i]) or err_trap( "FTP-ERROR: Can't connect: $@\n",1);
			$ftp->login($ftp_user[$i], $ftp_pass[$i]) or err_trap("FTP-ERROR: Couldn't login\n",1);
			$ftp->binary();
			$ftp->cwd($ftp_dir[$i]) or err_trap("FTP-ERROR: Couldn't change directory: ".$ftp_dir[$i],1);
			if($mp==0) 
			{
				PrintOut("FTP: transferring `$backupfile` to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]);
				$ret=$ftp->put($sql_file);
				if (!$ret)
				{
					err_trap("FTP-Error: Couldn't put $backupfile to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]."\n",1);
				}
				else
				{
					write_log("FTP: transferring of `$backupfile` to $ftp_server[$i] finished successfully.\n");
					PrintOut("FTP: transferring `$backupfile` to $ftp_server[$i] was successful.");
				}
			} 
			else 
			{
				PrintOut("FTP: starting Transfer of Multipart backup to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]);
				$dateistamm=substr($backupfile,0,index($backupfile,"part_"))."part_";
				$dateiendung=($compression==1)?".sql.gz":".sql";
				$mpdatei="";
				for ($x=1;$x<$mp;$x++) 
				{
					$mpdatei=$dateistamm.$x.$dateiendung;
					$ret=$ftp->put($backup_path.$mpdatei);
					if (!$ret) 
					{
						err_trap("Couldn't put $backup_path.$mpdatei to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]."\n",1);
					}
					else
					{
						write_log("FTP: transferring of `$mpdatei` to ".$ftp_server[$i]." finished successfully.\n");
						PrintOut("FTP: transferring of `$mpdatei` to $ftp_server[$i] finished successfully.");
					}
				}
			}
		}
	}
}

sub send_mail {
	$BodyNormal='The attachement is your backup of your database `'.$dbname.'`.';
	$BodyMultipart="A multipart backup has been made.<br>You will receive one or more emails with the backup-files attached.<br>The database `".$dbname."` has been backupped.<br>The following files have been created:";
	$BodyToBig="The backup is bigger than the allowed max-limit of ".byte_output($email_maxsize)." and has not been attached.<br>Backup of database ".$dbname."<br><br>The following files have been created:";
	$BodyNoAttach="The backup has not been attached.<br>I saved your database `".$dbname."` to file<br>";
	$BodyAttachOnly="Here is your backup.";
	$Body="";
	$DoAttach=1;
	my @mparray;
	my $ret=0;
	if($mp==0) 
	{
		if(($email_maxsize>0 && $filesize>$email_maxsize) || $cronmail_dump==0) 
		{
			if($cronmail_dump==0) 
			{
				$Body=$BodyNoAttach.$backupfile." (".byte_output($filesize).")";
			} 
			else 
			{
				$Body=$BodyToBig.$backupfile." (".byte_output($filesize).")"
			}
			$DoAttach=0;
		} 
		else 
		{
			$Body=$BodyNormal;
		}
	} 
	else 
	{
		$Body=$BodyMultipart;
		$dateistamm=substr($backupfile,0,index($backupfile,"part_"))."part_";
		$dateiendung=($compression==1)?".sql.gz":".sql";
		$mpdatei="";
		for ($i=1;$i<$mp;$i++) 
		{
			$mpdatei=$dateistamm.$i.$dateiendung;
			push(@mparray,"$mpdatei|$i");
			$filesize=(stat($backup_path.$mpdatei))[7];
			$Body.="\n<br>$mpdatei (".(byte_output($filesize))." )";
		}
	}
	$Body.="\n\n<br><br>Best regards,<br><br>MySQLDumper<br>If you have any questions, feel free and visit the support board at:<br><a href=\"http://forum.mysqldumper.de\">http://forum.mysqldumper.de</a>";

	if ($cron_use_sendmail==1)
	{	
		MIME::Lite->send("sendmail", $sendmail_call) || err_trap("Error setting sendmail call!",1);
	}
	else
	{
		MIME::Lite->send('smtp', $cron_smtp, Timeout=>60) || err_trap("Error setting smtp call !",1);	
	}

	$msg = MIME::Lite->new(
		From    => $cronmailfrom,
		To      => $cronmailto,
		Cc	=> $cronmailto_cc,
		Subject => "MSD (Perl) - Backup of DB ".$dbname,
		Type    => 'text/html; charset=iso-8859-1',
		Data    => "<body>\n".$Body."</body>\n"
	);

	if($DoAttach==1 && $mp==0) 
	{
		$msg->attach(
			Type     => "BINARY",
			Path     => "$sql_file",
			Encoding => "base64",
			Filename => "$backupfile" 
		);
		$ret=$msg->send;
		if (!$ret)
		{
			err_trap("Error 1 sending mail with backup ".$backupfile."!",1);
		}
		else
		{
			PrintOut("<font color=\"green\">E-Mail with backup ".$backupfile." sent successfully.</font>");
			write_log("<font color=\"green\">E-Mail with backup ".$backupfile." sent successfully.</font>\n");
		}
		return $ret;
	}
	
	if($DoAttach==1 && $mp>0 && $cronmail_dump>0) 
	{ 
		foreach $datei(@mparray) 
		{
			@str=split(/\|/,$datei);
			$msg = MIME::Lite->new(
				From    => $cronmailfrom,
				To      => $cronmailto,
				Cc	=> $cronmailto_cc,
				Subject => "MSD (Perl) - Backup of DB $dbname File ".$str[1]." of ".@mparray ,
				Type    => 'text/html; charset=iso-8859-1',
				Data    => "<body>\n".$Body."</body>\n"
			);

			$msg->attach(
				Type     => "BINARY",
				Path     => $backup_path.$str[0],
				Encoding => "base64",
				Filename => $str[0] 
			);
			$ret=$msg->send;
			if (!$ret)
			{
				err_trap("Error 2 sending mail with backup ".$str[0]."!",1);
			}
			else
			{
				PrintOut("<font color=\"green\">E-Mail with backup ".$str[0]." sent successfully.</font>");
				write_log("<font color=\"green\">E-Mail with backup ".$str[0]." sent successfully.</font>\n");
			}
		}
		return $ret;
	}

	$ret=$msg->send;
	if (!$ret)
	{
		err_trap("<font color=\"error\">Error 3 sending E-Mail!</font><br>",1);
	}
	else
	{
		PrintOut("<font color=\"green\">E-Mail sent successfully.</font>");
		write_log("<font color=\"green\">E-Mail sent successfully.</font>\n");
	}
	return $ret;
}

sub NewFilename {
	$part="";
	if($mp>0) 
	{
		$part="_part_$mp";
		$mp++;
	}
	if($compression==0) 
	{
		$sql_file=$backup_path.$dbname."_".$time_stamp.$part.".sql";
		$backupfile=$dbname."_".$time_stamp.$part.".sql";
	}
	else
	{
		$sql_file=$backup_path.$dbname."_".$time_stamp.$part.".sql.gz";
		$backupfile=$dbname."_".$time_stamp.$part.".sql.gz";
	}
	if($mp==0) 
	{
		PrintOut("\n<br>Starting to dump data into file <strong>`$backupfile`</strong>");
		write_log("Dumping data into file <strong>`$backupfile`</strong> \n");
	}
	if($mp==2) 
	{
		PrintOut("\n<br>Starting to dump data into multipart-file <strong>`$backupfile`</strong>");
		write_log("Start Perl Multipart-Dump with file `$backupfile` \n");
	}
	if($mp>2) 
	{
		PrintOut("\n<br>Continuing Multipart-Dump with file <strong>`$backupfile`</strong>");
		write_log("Continuing Multipart-Dump with file `$backupfile` \n");
	}
	if($mp>0) 
	{
		$sql_text=$status_start."MP_".($mp-1).$status_end;
	}
	else
	{
		$sql_text=$status_start.$status_end;
	}
	$sql_text.="/*!40101 SET NAMES '".$character_set."' */;\n";
	$sql_text.="SET FOREIGN_KEY_CHECKS=0;\n";
	
	WriteToFile($sql_text,1);
	chmod(0777,$sql_file);
	$sql_text="";
	$first_insert=0;
	$punktzaehler=0;
	push(@backupfiles_name,$sql_file);
}

sub WriteToFile {
	$inh=shift;
	my $points=shift;
	if (!defined($points)) { $points=2; }
	
	if(length($inh)>0) {
		if($compression==0){
			open(DATEI,">>$sql_file");
			print DATEI $inh;
			close(DATEI);
		} else {
			$gz = gzopen($sql_file, "ab") || err_trap("Cannot open ".$sql_file);
			$gz->gzwrite($inh)  || err_trap("Error writing ".$sql_file);
			$gz->gzclose ;
		}
		if ($points>1)
		{
			print "."; 
		}
		$filesize= (stat($sql_file))[7];
		$punktzaehler++;
		if($punktzaehler>120)
		{
			if ($html_output==1) { print "<br>"; } else { print "\n"; };
			$punktzaehler=0;
		}
	}
}

sub AutoDeleteCount {
	$fpath=$File::Find::name;
	$fname=basename($fpath);
	my @fileparts=split(/\./,"$fname");
	my $partcount=@fileparts;
	if ($partcount>1)
	{
		my $end=$fileparts[(@fileparts-1)];
#print "<br>Filename $fname<br>Dateiendung: $end";

		# Read Statusline and extract info
		my $line='';
		if ($end eq 'sql')
		{
			if (open(DATEI,"<$fpath"))
			{
				$line=<DATEI>;			
				close(DATEI);
			}
			else
			{
				print "<br>Error: couldn\'t open file: ".$fpath;
			}
		}
		if ($end eq 'gz')
		{
			$gz = gzopen("$fpath", "rb");
			if ($gz)
			{
				$gz->gzreadline($line);
				$gz->gzclose;
			}
			else
			{
				print "<br>Error: couldn\'t open file: ".$fpath;
			}
		}
#print "<br>Line: ".$line;
		if (length($line)>0)
		{
			#statusline read
			my @infos=split(/\:/,$line);
			my $file_multipart=$infos[3];
			$file_multipart=~ s/MP_/ /g;
			$file_multipart=trim($file_multipart);
#print "<br>File: ".$fname." MP: '".$file_multipart."'";
			my $file_databasename=$infos[4];
			if ($file_multipart eq "" || substr($file_multipart,0,1) eq "0")
			{
#print "<br>Kein Multipartfile<br>";
				push(@filearr,"$fname|$file_databasename");
			}
			else
			{
#print "<br>\n<strong>Multipart: ".$file_multipart.' '.$file_databasename.'</strong><br>';
				push(@filearr,"$fname|$file_databasename|$file_multipart");
			}
		
		}
		else
		{
#print "<br>No Statusline found. Seems not to be a MySQLDumper file. Skipping file..<br><br>";
		}
	}
}

sub DoAutoDeleteCount {
	my @str;
	my @dbarray;
	my $item;
	my $item2;
	my %dbanz;
	my $anz=@filearr;
	# sort filearr descending -> so the latest backups are at top
	# multipartfiles sorting is also descending -> part3, part2, part1 
	@filearr=sort{"$b" cmp "$a"}(@filearr);
	@multipartfiles=();
	if ($anz>0)
	{
		foreach $item (@filearr) 
		{
			@str=split(/\|/,$item);
			# str[0]=filename, str[1]=databasename, str[2]=multipart number
					
			#init db-counter if this index doesn't exist yet
			if (!defined $dbanz{$str[1]}) 
			{ 
				$dbanz{$str[1]}=0;
				@multipartfiles=();
			}		
			#PrintOut($max_backup_files.': '.$dbanz{$str[1]}.' -> '.$str[0].' - '.$str[1].' - '.$str[2]);
				
			#no multipart file -> update db counter
			if(!defined $str[2])
			{
				# handling for non multipart files
				$dbanz{$str[1]}++;
				# is the max number of backups for this database reached?
				# if yes -> push the actual filename into trash_files
				if($dbanz{$str[1]}>$max_backup_files)
				{
					push(@trash_files, $str[0]);
				}
			}
			else
			{
				# keep multipartz filename
				if($dbanz{$str[1]}>=$max_backup_files)
				{
					push(@multipartfiles,$str[0]);
				}
				
				# if it is a multipart file and it is part_1 -> update db counter
				# multiparts with higher numbers already passed the loop, so we can use
				# part1 to increase the db-counter
				if(defined $str[2] && $str[2]==1)
				{
					$dbanz{$str[1]}++;
					# now check if we have reached the limit
					if($dbanz{$str[1]}>$max_backup_files)
					{
						foreach $item2 (@multipartfiles)
						{
							push(@trash_files, $item2);
						}
					}
					# clear array for next multipart backup
					@multipartfiles=();
				}
			}
		}
	}
}

sub DeleteFiles 
{
	my $res=0;
	if(@trash_files==0) 
	{
		PrintOut("<font color=red><b>No file to delete.</b></font>");
	}
	else 
	{
		foreach $datei(@trash_files) 
		{
			my $file_to_delete = $backup_path.$datei;
			$res=unlink($file_to_delete);
			if ($res)
			{
				PrintOut("Autodelete: old backup file <font color=red><b>".$datei."</b></font> deleted.");
				write_log( "Autodelete: old backup file <b>$datei</b> deleted.\n" ) ;
			}
			else
			{
				err_trap("Autodelete: <font color=red>Error deleting old backup file <b>".$datei."</b></font>!<br>",1);
			}
		}
		undef(@trash_files);
	}
}

sub ExecuteCommand 
{
	my $cmt = shift(@_);
	my $command = shift(@_);
	my (@cad, $errText, $succText, $cd2, $commandDump);
	my $err='';
	$commandDump=$command;
	if($cmt==1)
	{  #before dump
		$errText="Error while executing Query before Dump";
		$succText="Executing Query before Dump was successful";
	}
	else
	{
		$errText="Error while executing Query after Dump";
		$succText="executing Query after Dump was successful";
	}
	
	if(defined $commandDump && length($commandDump)>0) 
	{
		if(substr($commandDump,0,7) ne "system:") 
		{
			if (trim($dbsocket) eq "")
			{
				$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
			}
			else
			{
				$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport;mysql_socket=$dbsocket","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
			}
			if(index($commandDump,";")>0) 
			{
				# more than 1 query
				@cad=split(/;/,$commandDump);
			}
			else 
			{
				@cad=array($commandDump);
			}

			for($i=0;$i<@cad;$i++) 
			{
				if($cad[$i] ne '')
				{
					$err='';
					$sth = $dbh->prepare($cad[$i]);
					$sth->execute or $err=$sth->errstr();
					if ($err ne '') 
					{
						write_log("<span style=\"color:red;\">Executing Query '$cad[$i]' caused an error! MySQL returns: '$err'</span>\n"); 
						PrintOut("<span style=\"color:red;\">Executing Query '$cad[$i]' caused an error! MySQL returns: '$err'</span>\n"); 
					}
					else 
					{
						write_log("<span style=\"color:green;font-size:11px;\">Successfully executed Query: $cad[$i]</span>\n"); 
						PrintOut("<span style=\"color:green;font-size:11px;\">Successfully executed Query: $cad[$i]</span>\n"); 
					}
					$sth->finish;
				}
			}
		} 
		else
		{
			#Systembefehl
			$commandDump=substr($commandDump,7);
			system($commandDump);
			PrintOut("<p style=\"color:blue;\">$succText ($commandDump)</p>");
			write_log("$succText ($commandDump)\n");
		}
	}
}

sub closeScript 
{
	my ($Start, $Jetzt, $Totalzeit);
	$Start = $^T; $Jetzt = (time); 
	$Totalzeit=$Jetzt - $Start;
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900;$Monat+=1;$Jahrestag+=1;
	$starttime=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."  ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden);
	PrintOut("Everythings is done: closing script <strong>$starttime</strong>");
	PrintOut("<em>total time used: $Totalzeit sec.</em>");
	PrintOut("#EOS (End of script)<hr></body></html>");
	# Datenbankverbindung schliessen
	$sth->finish() if (defined $sth);
	($dbh->disconnect() || warn $dbh->errstr) if (defined $dbh);
}

sub trim 
{ 
        my $string = shift; 
        if (defined($string)) 
        { 
                $string =~ s/^\s+//; 
                $string =~ s/\s+$//; 
        } 
        else 
        { 
                $string=''; 
        } 
        return $string; 
} 

sub byte_output
{
	my $bytes= shift;
	my $suffix="Bytes";
	if ($bytes>=1024) { $suffix="KB"; $bytes=sprintf("%.2f",($bytes/1024));};
	if ($bytes>=1024) { $suffix="MB"; $bytes=sprintf("%.2f",($bytes/1024));};
	my $ret=sprintf "%.2f",$bytes;
	$ret.=' '.$suffix;
	return $ret;
}

sub optimise_tables
{
	my $engine='';
	my $ret=0;
	$opttbl=0;
	PrintOut("Optimizing tables:");
	foreach $tablename (@tablenames)
	{
		#optimize table if engine supports optimization
		$engine=uc($db_tables{$tablename}{Engine});
		if ( $engine eq "MYISAM" or $engine eq "BDB" or $engine eq "INNODB")
		{
			my $sth_to = $dbh->prepare("OPTIMIZE TABLE `$tablename`");
			$ret=$sth_to->execute; 
			if ($ret)
			{
				PrintOut("<span style=\"color:green;font-size:11px;\">- Table ".($opttbl+1)." `$tablename` optimized successfully.</span>");
				$opttbl++;
			}
			else
			{
				err_trap("<span style=\"color:red;font-size:12px;\">&nbsp;&nbsp;Error optimizing table `$tablename`</span>",1);
			}
		}
	}
	PrintOut("<span style=\"font-size:11px;\">$opttbl tables have been optimized</span>") if($opttbl>0) ;
}