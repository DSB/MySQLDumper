#!/usr/bin/perl -w
########################################################################################
# MySQLDumper CronDump
#
# 2004,2005 by Steffen Kamper, Daniel Schlichtholz
# additional scripting: Detlev Richter
#
# for support etc. visit http://www.mysqldumper.de/board
# (c) GNU General Public License
########################################################################################
# Script-Version
my $pcd_version="1.22";

########################################################################################
# please enter the absolute path of the config-dir
# for using the script without Parameters the mysqldumper.conf will be load
# e.g. - (zum Beispiel): 
#my $absolute_path_of_configdir="/home/www/doc/8176/mysqldumper.de/www/mysqldumper/work/config/";
#
my $absolute_path_of_configdir="";
my $cgibin_path=""; # this is needed for MIME::Lite if it is in cgi-bin
my $default_configfile="mysqldumper.conf.php";

########################################################################################
# nothing to edit under this line !!!
########################################################################################
# import the necessary modules ...
use strict;
use DBI;
use File::Find;
use File::Basename;
use CGI::Carp qw/ warningsToBrowser fatalsToBrowser /;

# import the optional modules ...
my $eval_in_died;
my $mod_gz=0;
my $mod_ftp=0;
my $mod_mime=0;
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
########################################################################################

my @trash_files;
my $time_stamp;
my @filearr;
my $sql_file;
my $backupfile;
my $memory_limit=100000;
my $dbh;        # DBI databasehandle
my $sth;        # DBI statementhandle
my @db_array;
my @dbpraefix_array;
my @db_command_beforedump_array;
my @db_command_afterdump_array;
my $db_anz;
my $record_count;
my $filesize;
my $status_start;
my $status_end;
my $sql_text;
my $punktzaehler;
my @backupfiles_name;
my @backupfiles_size;
my $mysql_commentstring="-- ";
my $character_set="utf8";

use vars qw(
$pcd_version  $dbhost  $dbname  $dbuser  $dbpass $dbport
$cron_save_all_dbs $cron_db_array $cron_dbpraefix_array $dbpraefix $command_beforedump_array $command_afterdump_array
$compression  $backup_path $logdatei  $completelogdatei $nl $command_beforedump $command_afterdump
$cron_printout  $cronmail  $cronmail_dump $cronmailto $cronmailfrom
$cronftp $ftp_server $ftp_port $ftp_user $ftp_pass $ftp_dir $mp $multipart_groesse $email_maxsize
$auto_delete $cron_del_files_after_days $max_backup_files $max_backup_files_each $perlspeed $optimize_tables_beforedump $result
@key_value $pair $key $value $conffile @confname $logcompression $log_maxsize $complete_log 
$backup_complete_inserts $backup_extended_inserts $backup_delayed_inserts $backup_ignore_inserts $backup_lock_tables 
$starttime $Sekunden $Minuten $Stunden $Monatstag $Monat $Jahr $Wochentag $Jahrestag $Sommerzeit
$ri $rct $tabelle  @tables @tablerecords $dt $sql_create @ergebnis @ar $sql_daten $inhalt
$insert $totalrecords $error_message $cfh $oldbar $print_out $msg $dt $ftp $dateistamm $dateiendung
$mpdatei $i $BodyNormal $BodyMultipart $BodyToBig $BodyNoAttach $BodyAttachOnly $Body $DoAttach $cmt $part $fpath $fname
$fmtime $timenow $daydiff $datei $inh $gz $search $fdbname @str @dbarray $item %dbanz $anz %db_dat 
$delayed $ignore $complete $fieldlist $first_insert $my_comment $ftp_mode $sendmail_call
);

use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
warningsToBrowser(1);

# Script Start

opendir(DIR, $absolute_path_of_configdir) or die "The config-directory you entered is wrong !\n($absolute_path_of_configdir - $!) \n\nPlease edit the crondump.pl and enter the right configuration-path.\n\n";
closedir(DIR);

my $abc=length($absolute_path_of_configdir)-1;
my $defed=substr($absolute_path_of_configdir,$abc,1);
if($defed ne "/") {
	$absolute_path_of_configdir=$absolute_path_of_configdir."/";
}


#include config file
if($ENV{QUERY_STRING}) {
	@key_value = split(/&/,$ENV{QUERY_STRING});
	foreach $pair(@key_value){
		$pair =~ tr/+/ /;
		($key,$value) = split(/=/,$pair);
		$conffile=$value if($key eq "config");
	}
}

my $argnum=0;
foreach $argnum (0 .. $#ARGV) 
{
	$conffile=chomp(substr($argnum,7,length($argnum)-7))  if(substr($argnum,0,7) eq "config=");
}

if((!defined $conffile) || ($conffile eq "")) { $conffile=$default_configfile; }

die "No configuration was handed over to me. Wether you should edit crondump.pl to enter a standard configuration at $absolute_path_of_configdir or you should bypass the parameter config when calling this script! \n\n" if(chomp($conffile) eq "");
# Security: try to detcet wether someone tries to include some external configfile
die "Hacking attempt - I wont do anything!\nGo away\n\n" if (lc($conffile) =~ m /:/);

my $my_file=$absolute_path_of_configdir.$conffile;
open(CONFIG,"<$my_file") or die "\nI couldn't open the configurationfile:".$my_file."\nFile not found or not accessible!\n\n";
while (my $line = <CONFIG>)
{
	chomp($line);
	if ($line ne '<?php' && $line ne '1;' && substr($line,0,2) ne '?>' && substr($line,0,1) ne '#')
	{
		($key,$value) = split(/=/,$line);
		eval($line);
	}
}
close(CONFIG);

@confname=split(/\//,$conffile);

# Output Headers
PrintHeader();

PrintOut("Configurationfile '".$confname[$#confname]."' was loaded successfully.<br>");
if($mod_gz==1) {
	PrintOut("<span style=\"color:#0000FF;\">Compression Library loaded successfully...</span><br>");
} else {
	$compression=0;
	PrintOut("<span style=\"color:red;\">Compression Library loading failed - Compression deactivated ...</span><br>");
}
if($mod_ftp==1) {
	PrintOut("<span style=\"color:#0000FF;\">FTP Library loaded successfully...</span><br>");
} else {
	$cronftp=0;
	PrintOut("<span style=\"color:red;\">FTP Library loading failed - FTP deactivated ...</span><br>");
}
if($mod_mime==1) {
	PrintOut("<span style=\"color:#0000FF;\">Mail Library loaded successfully...</span><br>");
} else {
	$cronmail=0;
	PrintOut("<span style=\"color:red;\">Mail Library loading failed - Mail deactivated ...</span><br><br>");
}


# SignalHandler einrichten für Browser-Stop-Button,
# unterbrochene Socketverbindungen, Crtl-C
# Datenbankverbindung wird dann noch ordnungsgemäss geschlossen.
$SIG{HUP} = $SIG{PIPE} = $SIG{INT} =\&closeScript;


#teste Zugriff auf logfile
PrintOut("Starting Crondump ...     ");
write_log(": Starting backup using Perlscript version $pcd_version\n");

#Auto-Delete ausführen
if($auto_delete>0) {
	#Autodelete Days
	if($cron_del_files_after_days>0) {
		PrintOut("<hr>Autodelete: search for backups older than <font color=\"#0000FF\">$cron_del_files_after_days</font> days ...<br>");
		find(\&AutoDeleteDays, $backup_path);
		DeleteFiles (\@trash_files);
	}
	#Autodelete Count
	if($max_backup_files>0) {
		PrintOut("Autodelete: search for more backups than <font color=\"#0000FF\">$max_backup_files</font>  ...<hr>");
		find(\&AutoDeleteCount, $backup_path);
		DoAutoDeleteCount();
		DeleteFiles (\@trash_files);
	}
}

#Jetzt den Dump anschmeissen
# mal schauen, obs mehrere DB's sind
if($cron_save_all_dbs==0) {
	$command_beforedump=$command_beforedump_array;
	$command_afterdump=$command_afterdump_array;
	ExecuteCommand(1);
	DoDump();
	ExecuteCommand(2);
	PrintOut("<br><strong>Crondump finished.</strong><br>");
	closeScript();
}  else {
	@db_array=split(/\|/,$cron_db_array);
	@dbpraefix_array=split(/\|/,$cron_dbpraefix_array);
	@db_command_beforedump_array=split(/\|/,$command_beforedump_array);
	@db_command_afterdump_array=split(/\|/,$command_afterdump_array);
	$db_anz=@db_array;
	PrintOut("<h4>Starting backup progress for $db_anz databases ...</h4>");
	for(my $ii = 0; $ii < $db_anz; $ii++) {
		if ($mp>0) { $mp=1; } # Part-Reset if using Multipart (for next database)
		$dbname=$db_array[$ii];
		$dbpraefix=($dbpraefix_array[$ii]) ? $dbpraefix_array[$ii] : "";
		$command_beforedump=($db_command_beforedump_array[$ii]) ? $db_command_beforedump_array[$ii] : "";
		$command_afterdump=($db_command_afterdump_array[$ii]) ? $db_command_afterdump_array[$ii] : "";
		PrintOut("<h5>Starting backup ".($ii+1)." of $db_anz with database `$dbname` ".(($dbpraefix ne "") ? "(with praefix <span style=\"color:blue\">$dbpraefix</span>)" : "")."</h5>");
		ExecuteCommand(1);
		DoDump();
		ExecuteCommand(2);
	}
	PrintOut("<strong>ALL $db_anz BACKUPS ARE DONE!!!</strong><br>");
	$cron_save_all_dbs=2;
	closeScript();
}

##############################################
# Subroutinen                                #
##############################################
sub DoDump {
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900;$Monat+=1;$Jahrestag+=1;
	my $CTIME_String = localtime(time);
	$time_stamp=$Jahr."_".sprintf("%02d",$Monat)."_".sprintf("%02d",$Monatstag)."_".sprintf("%02d",$Stunden)."_".sprintf("%02d",$Minuten);
	$starttime= sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."  ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten);
	$fieldlist=$delayed=$ignore="";
	# Verbindung mit mSQL herstellen, $dbh ist das Database Handle
	PrintOut("connect to database`$dbname`&nbsp;&nbsp;&nbsp;");
	$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass") || die   "Database connection not made: $DBI::errstr"; 
	# herausfinden welche Mysql-Version verwendet wird
	$sth = $dbh->prepare("SELECT VERSION()");
	$sth->execute;
	my @mysql_version=$sth->fetchrow;
	my @v=split(/\./,$mysql_version[0]);
	if($v[0]>=5 || ($v[0]>=4 && $v[1]>=1) ){
		#mysql Version >= 4.1
		%db_dat = (name => 0,
		rows => 4,
		data_length =>6,
		index_length =>8,
		update_time =>11 );
	} else {
		#mysql Version < 4.1
		%db_dat = (name => 0,
		rows => 3,
		data_length =>5 ,
		index_length =>7,
		update_time =>11 );
	}

	PrintOut("<font color=#0000FF>ok</font><br><strong>MySQL-Version $v[0].$v[1].$v[2]</strong><br><strong>starting backup progress at ".$starttime."</strong><br>");

	$sth = $dbh->prepare("SET NAMES ".$character_set);
	$sth->execute;
	PrintOut("<br>Charset set to ".$character_set."<br>");

	my $format="";
	if($backup_complete_inserts==1) { $format.="complete inserts | "; } 
	if($backup_extended_inserts==1) { $format.="extended inserts | "; } 
	if($backup_ignore_inserts==1) { $format.="ignored inserts | "; }
	if($backup_delayed_inserts==1) { $format.="delayed inserts | "; } 
	if($backup_lock_tables==1 && $backup_delayed_inserts==0) { $format.="lock tables | ";} 
	if($format eq "") {
		$format="<font color=#33cc00>Backup Parameter: normal<br></font><br>";
	} else {
		$format="<font color=#33cc00>Backup Parameter: ".substr($format,0,length($format)-3)."</font><br><br>";
	}
	PrintOut($format);

	#Statuszeile erstellen
	my $t=0;
	my $r=0;
	$sth = $dbh->prepare("SHOW TABLE STATUS FROM `$dbname`");
	$sth->execute;
	my $st_e="\n";
	#Arrays löschen
	undef(@tables);
	undef(@tablerecords);
	my $opttbl=0;

	while ( @ar=$sth->fetchrow) {
		if($optimize_tables_beforedump==1) {
			#tabelle optimieren
			my $sth_to = $dbh->prepare("OPTIMIZE Table `$ar[$db_dat{name}]`");
			$sth_to->execute; $opttbl++;
		}
		if(!defined $ar[$db_dat{update_time}]) { PrintOut("<strong>Error: Table ".$ar[$db_dat{name}]." seems to be damaged. Couldn\'t read last update time. Check table definition!</strong><br>"); $ar[$db_dat{update_time}]=0; }
		
		if($dbpraefix eq ""){
			$t++;
			$r+=$ar[$db_dat{rows}];
			push(@tables,$ar[$db_dat{name}]);
			push(@tablerecords,$ar[$db_dat{rows}]);
			$st_e.=$mysql_commentstring."TABLE\|$ar[$db_dat{name}]\|$ar[$db_dat{rows}]\|".($ar[$db_dat{data_length}]+$ar[$db_dat{index_length}])."\|$ar[$db_dat{update_time}]\n";
		} else {
			if (substr($ar[$db_dat{name}],0,length($dbpraefix)) eq $dbpraefix) {
				$t++; 
				$r+=$ar[$db_dat{rows}];
				push(@tables,$ar[$db_dat{name}]);
				push(@tablerecords,$ar[$db_dat{rows}]);
				$st_e.=$mysql_commentstring."TABLE\|$ar[$db_dat{name}]\|$ar[$db_dat{rows}]\|".($ar[$db_dat{data_length}]+$ar[$db_dat{index_length}])."\|$ar[$db_dat{update_time}]\n";
			}
		}
	}
	PrintOut("<span style=\"color:blue;font-size:11px;\">$opttbl tables have been optimized</span><br>") if($opttbl>0) ;
	PrintOut("found $t tables with $r records.<br>");

	#AUFBAU der Statuszeile:
	#	-- Status:tabellenzahl:datensätze:Multipart:Datenbankname:script:scriptversion:Kommentar:MySQLVersion:Backupflags:SQLBefore:SQLAfter:Charset:EXTINFO
	#	Aufbau Backupflags (1 Zeichen pro Flag, 0 oder 1, 2=unbekannt)
	#	(complete inserts)(extended inserts)(ignore inserts)(delayed inserts)(downgrade)(lock tables)(optimize tables)
	#
	$status_start=$mysql_commentstring."Status:$t:$r:";
	my $downgrade=0;
	my $flags="$backup_complete_inserts$backup_extended_inserts$backup_ignore_inserts$backup_delayed_inserts$downgrade$backup_lock_tables$optimize_tables_beforedump";
	$status_end=":$dbname:perl:$pcd_version:$my_comment:$mysql_version[0]:$flags";
	$status_end.=":$command_beforedump:$command_afterdump:$character_set:EXTINFO$st_e\n".$mysql_commentstring."Dump created on $CTIME_String by PERL Cron-Script\n".$mysql_commentstring."Dump by MySQLDumper (http://www.mysqldumper.de/board/)\n\n";


	if($mp>0) {
		$sql_text=$status_start."MP_$mp".$status_end;
	} else {
		$sql_text=$status_start.$status_end;
	}
	NewFilename();
	
	$totalrecords=0;
	for (my $tt=0;$tt<$t;$tt++) {
		$tabelle=$tables[$tt];
		# definition auslesen
		if($dbpraefix eq "" or ($dbpraefix ne "" && substr($tabelle,0,length($dbpraefix)) eq $dbpraefix)) {
			PrintOut("dumping table `$tabelle` ");
			$a="\n\n$mysql_commentstring\n$mysql_commentstring Create Table `$tabelle`\n$mysql_commentstring\n\nDROP TABLE IF EXISTS `$tabelle`;\n\n";
			$sql_text.=$a;
			$sql_create="Show create table `$tabelle`";
			$sth = $dbh->prepare($sql_create);
			$sth->execute;
			@ergebnis=$sth->fetchrow;
			$sth->finish;
			$a=$ergebnis[1].";\n";
			$sql_text.=$a."\n$mysql_commentstring\n$mysql_commentstring Data for Table `$tabelle`\n$mysql_commentstring\n\n";
			if($backup_delayed_inserts==0) {
				$sql_text.="\n/*!40000 ALTER TABLE `$tabelle` DISABLE KEYS */;\n";
			}
			if($backup_lock_tables==1 && $backup_delayed_inserts==0) {
				$sql_text.="LOCK TABLES `$tabelle` WRITE;\n\n";
			}

			WriteToFile($sql_text);
			$sql_text="";
			PrintOut("<font color=blue>* </font>");
			$punktzaehler=64;
			if($backup_complete_inserts==1) {
				$fieldlist="(";
				$sql_create="Show fields from `$tabelle`";
				$sth = $dbh->prepare($sql_create);
				$sth->execute;
				while ( @ar=$sth->fetchrow) {
					$fieldlist.="`".$ar[0]."`,";
				}
				$fieldlist=substr($fieldlist,0,length($fieldlist)-1).")";
			}
			# daten auslesen
			$rct=$tablerecords[$tt];
			for (my $ttt=0;$ttt<$rct;$ttt+=$perlspeed) {
				$delayed="DELAYED " if($backup_delayed_inserts==1);
				$ignore="IGNORE  " if($backup_ignore_inserts==1);
				$insert = "INSERT ".$delayed.$ignore."INTO `$tabelle` $fieldlist VALUES (";
				$first_insert=0;
				$sql_daten="SELECT * FROM `$tabelle` Limit ".$ttt.",".$perlspeed.";";
				$sth = $dbh->prepare($sql_daten);
				$sth->execute;
				while ( @ar=$sth->fetchrow) {
					#Start the insert
					if($first_insert==0) {
						$a="\n$insert";
						if($backup_extended_inserts==1) {$first_insert=1;}
					} else {
						$a="\n(";
					}	
					foreach $inhalt(@ar){ $a.= $dbh->quote($inhalt).", "; }
					$a=substr($a,0, length($a)-2).")";
					if($backup_extended_inserts==1) {
						$a.=",";
					} else {
						$a.=";";
					}
					$sql_text.= $a;
					if($memory_limit>0 && length($sql_text)>$memory_limit) {
						if($backup_extended_inserts==1 && length($a)>0) {
							$sql_text=substr($sql_text,0, length($sql_text)-1).";" if(length($sql_text)>0);
							$first_insert=0;
						}
						WriteToFile($sql_text);
						$sql_text="";
						if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
					}
				}
			}
			#jetzt wegschreiben
			if($backup_extended_inserts==1) {
				$sql_text=substr($sql_text,0, length($sql_text)-1).";" if(length($sql_text)>0);;
			}
			if($backup_lock_tables==1 && $backup_delayed_inserts==0) {
				$sql_text.="\n\nUNLOCK TABLES;";
			}
			if($backup_delayed_inserts==0) {
				$sql_text.="\n/*!40000 ALTER TABLE `$tabelle` ENABLE KEYS */;\n";
			}
			WriteToFile($sql_text);
			$sql_text="";
			PrintOut("<br>&nbsp;&nbsp;&nbsp;<em>$tablerecords[$tt] inserted records (size of backupfile: $filesize Bytes)</em><br>");
			$totalrecords+=$tablerecords[$tt];
			if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
		}
	}
	# Ende
	WriteToFile("\n".$mysql_commentstring."EOB");
	PrintOut("<hr>Backup of Database `$dbname` complete.<br>");
	write_log(": Perl Cron-Dump `$backupfile` finished.\n");

	# Jetzt der Versand per Mail
	if($cronmail==1) {
		PrintOut("sending mail ...<br>");
		send_mail();
		write_log(": Mail was sent to $cronmailto. succesfully\n");
		PrintOut("Mail was sent to $cronmailto successfully.<br>");
	}

	# Jetzt der Versand per FTP
	if($cronftp==1) {
		PrintOut("sending ftp ...<br>");
		send_ftp($sql_file);
	}
}

#Wird aufgerufen, wenn Fehler passieren
sub err_trap {
	$error_message = shift(@_);
	print "Perl Cronscript ERROR: $error_message \n";
	close;
}

sub PrintHeader {
	print "Content-type: text/html;  charset=utf-8\n\n";
	PrintOut("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n");
	PrintOut("<html><head><title>MySQLDumper - Perl CronDump [Version $pcd_version]</title></head><body><h3>MySQLDumper - Perl CronDump [Version $pcd_version]</h3>\n");
}

sub PrintOut {
	$print_out = shift(@_);
	if($cron_printout==1) {
		local ($oldbar) = $|;
		$cfh = select (STDOUT);
		$| = 1;
		print $print_out."\n";
		$| = $oldbar;
		select ($cfh);
	}

	if($complete_log==1) {
		my $logsize=0;
		if (-e $completelogdatei) {
			$logsize=(stat($completelogdatei))[7];
			unlink($completelogdatei) if($logsize + length($print_out)>$log_maxsize && $log_maxsize>0);
		}
		if ( ($logcompression==0) || ($mod_gz==0)) {
			open(DATEI,">>$completelogdatei") || err_trap('can\'t open mysqldump_perl.complete.log ('.$completelogdatei.').');
			print DATEI $print_out."\n" || err_trap('can\'t write to mysqldump_perl.complete.log ('.$completelogdatei.').');
			close(DATEI)|| err_trap('can\'t close mysqldump_perl.complete.log ('.$completelogdatei.').');
			chmod(0777,$completelogdatei);
		} else {
			$gz = gzopen($completelogdatei, "ab") || err_trap("Cannot open mysqldump_perl.complete.log. ");
			$gz->gzwrite("$print_out\n")  || err_trap("Error writing mysqldump_perl.complete.log. ");
			$gz->gzclose ;
			chmod(0777,$completelogdatei);
		}
	}
}

sub write_log {
	$msg = shift(@_);
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900; $Monat+=1;$Jahrestag+=1;
	$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden);

	my $logsize=0;
	if (-e $logdatei) {
		$logsize=(stat($logdatei))[7];
		unlink($logdatei) if($logsize+200>$log_maxsize && $log_maxsize>0);
	}

	if ( ($logcompression==0) || ($mod_gz==0)) {
		open(DATEI,">>$logdatei") || err_trap("can't open file ($logdatei).");
		print DATEI "$dt $msg" || err_trap("can't write to file ($logdatei).");
		close(DATEI)|| err_trap("can't close file ($logdatei).");
			chmod(0777,$logdatei);
	} else {
		$gz = gzopen($logdatei, "ab") || err_trap("Cannot open $logdatei.");
		$gz->gzwrite("$dt $msg")  || err_trap("Error writing $logdatei. ");
		$gz->gzclose ;
		chmod(0777,$logdatei);
	}
}

sub send_ftp {
	$ftp = Net::FTP->new($ftp_server, Port => $ftp_port, Timeout => 360, Debug   => 1,Passive => $ftp_mode) or err_trap( "FTP-ERROR: Can't connect: $@\n");
	$ftp->login($ftp_user, $ftp_pass)   or err_trap("FTP-ERROR: Couldn't login\n");
	$ftp->binary();
	$ftp->cwd($ftp_dir)     or err_trap("FTP-ERROR: Couldn't change directory\n");
	if($mp==0) {
		$ftp->put($sql_file) or err_trap("FTP-ERROR: Couldn't put $sql_file\n");
		write_log(": FTP-Transfer: transferring of `$backupfile` to $ftp_server finished successfully.\n");
		PrintOut("FTP-Transfer transferring `$backupfile` to $ftp_server was successful.<br>");
	} else {
		$dateistamm=substr($backupfile,0,index($backupfile,"part_"))."part_";
		$dateiendung=($compression==1)?".sql.gz":".sql";
		$mpdatei="";
		for ($i=1;$i<$mp;$i++) {
			$mpdatei=$dateistamm.$i.$dateiendung;
			$ftp->put($backup_path.$mpdatei)    or err_trap("Couldn't put $backup_path.$mpdatei\n");
			write_log(": FTP-Transfer: transferring `$mpdatei` to $mpdatei finished successfully.\n");
			PrintOut("FTP-Transfer: transferring `$mpdatei` to $ftp_server was successful.<br>");
		}
	}
}

sub send_mail {
	MIME::Lite->send("sendmail", $sendmail_call);
	$BodyNormal='The Attachement is your backup of your database '.$dbname.'<br><br>Best regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
	$BodyMultipart='A multipart backup has been made. You will receive one or more Emails containing the backups.<br>The database `'.$dbname.'` has been backupped.<br><br>The following files have been created:<br><br>';
	$BodyToBig='The backup is bigger than the allowed max-limit of '.$email_maxsize.' Bytes  and has not been attached.<br>Backup of database '.$dbname.'<br><br>Best regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a><br><br>The following files have been created:<br><br>';
	$BodyNoAttach='The backup has not been attached.<br>I saved your database `'.$dbname.'` into file ';
	$BodyAttachOnly='Here is your backup.<br><br>Best regards<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
	$Body="";
	$DoAttach=1;
	my @mparray;
	if($mp==0) {
		if(($email_maxsize>0 && $filesize>$email_maxsize) || $cronmail_dump==0) {
			if($cronmail_dump==0) {
				$Body=$BodyNoAttach.$backupfile."&nbsp;&nbsp;&nbsp;".$filesize;
			} else {
				$Body=$BodyToBig.$backupfile."&nbsp;&nbsp;&nbsp;".$filesize;
			}
			$DoAttach=0;
		} else {
			$Body=$BodyNormal;
		}
	} else {
		$Body=$BodyMultipart;
		$dateistamm=substr($backupfile,0,index($backupfile,"part_"))."part_";
		$dateiendung=($compression==1)?".sql.gz":".sql";
		$mpdatei="";
		for ($i=1;$i<$mp;$i++) {
			$mpdatei=$dateistamm.$i.$dateiendung;
			push(@mparray,"$mpdatei|$i");
			$Body.="$mpdatei (".(stat($backup_path.$mpdatei))[7]." Bytes)<br>";
		}
		$Body.='<br><br><br>Best regards,<br><br>MySQLDumper<br><a href="http://www.mysqldumper.de/">www.mysqldumper.de</a>';
	}

	$msg = new MIME::Lite ;
	$msg = build MIME::Lite
	From    => $cronmailfrom ,
	To      => $cronmailto ,
	Subject => "MSD (Perl) - Backup of DB ".$dbname,
	Type    => 'text/html',
	Data    => $Body;
	if($DoAttach==1 && $mp==0) {
		attach $msg
		Type     => "BINARY" ,
		Path     => "$sql_file" ,
		Encoding => "base64",
		Filename => "$backupfile" ;
	}

	$msg->send || err_trap("Error sending mail !");
	
	if($DoAttach==1 && $mp>0 && $cronmail_dump>0) { 
		foreach $datei(@mparray) {
			@str=split(/\|/,$datei);
			$msg = new MIME::Lite ;
			$msg = build MIME::Lite
			From    => $cronmailfrom ,
			To      => $cronmailto ,
			Subject => "MSD (Perl) - Backup of DB $dbname File ".$str[1]." of ".@mparray ,
			Type    => 'text/html',
			Data    => $BodyAttachOnly;
			attach $msg
			Type     => "BINARY" ,
			Path     => $backup_path.$str[0] ,
			Encoding => "base64",
			Filename => $str[0] ;
			$msg->send || err_trap("Error sending mail !");
		}
	}
}


sub check_emailadr {
	$cmt = shift(@_);
	if ($cmt =~ /^([\w\-\+\.]+)@([\w\-\+\.]+)$/){ 
		return (1) 
	} else { 
		return (0) 
	}
}

sub NewFilename {
	$part="";
	if($mp>0) {
		$part="_part_$mp";
		$mp++;
	}
	if($compression==0) {
		$sql_file=$backup_path.$dbname."_".$time_stamp."_perl".$part.".sql";
		$backupfile=$dbname."_".$time_stamp."_perl".$part.".sql";
	} else {
		$sql_file=$backup_path.$dbname."_".$time_stamp."_perl".$part.".sql.gz";
		$backupfile=$dbname."_".$time_stamp."_perl".$part.".sql.gz";
	}
	if($mp==0) {
		PrintOut("<br>Starting to dump data into file <strong>`$backupfile`</strong><br>");
		write_log(": Dumping data into file <strong>`$backupfile`</strong> \n");
	}
	if($mp==2) {
		PrintOut("<br>Starting to dump data into multipart-file </strong>`$backupfile`</strong><br>");
		write_log(": Start Perl Multipart-Cron-Dump with file `$backupfile` \n");
	}
	if($mp>2) {
		PrintOut("<br>Continuing multipart-dump with file <strong>`$backupfile`</strong><br>");
		write_log(": Continuing multipart-dump with file `$backupfile` \n");
	}
	if($mp>0) {
		$sql_text=$status_start."MP_".($mp-1).$status_end;
	} else {
		$sql_text=$status_start.$status_end;
	}
	$sql_text.="\n/*!40101 SET NAMES `".$character_set."` */;\n";
	WriteToFile($sql_text);
	chmod(0644,$sql_file);
	$sql_text="";
	$first_insert=0;
	$punktzaehler=0;
	push(@backupfiles_name,$sql_file);
}

sub WriteToFile {
	$inh=shift;
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
		PrintOut("<font color=red>.</font>");
		$filesize= (stat($sql_file))[7];
		$punktzaehler++;
		if($punktzaehler>180){
			$punktzaehler=0;
			PrintOut("<br>");
		}
	}
}

sub AutoDeleteDays {
	$fpath=$File::Find::name;
	$fname=basename($fpath);
	$fmtime=(stat($fname))[9];
	if($fmtime) {
		$timenow=time;
		$daydiff=($timenow-$fmtime)/60/60/24;
		if (((/\.gz$/) || (/\.sql$/)) && ($daydiff>$cron_del_files_after_days)) {
			PrintOut "$fpath $daydiff <br>" if (-f $fname);
			push(@trash_files,$fpath);
		}
	}
}

sub AutoDeleteCount {
	$fpath=$File::Find::name;
	$fname=basename($fpath);
	$fmtime=(stat($fname))[9];
	if($fmtime) {
		($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr)=localtime($fmtime);
		$Jahr+=1900; $Monat+=1;
		$Monat="0".$Monat if(length($Monat)==1);
		$search="_".$Jahr."_".$Monat."_";
		$fdbname=substr($fname,0,index($fname,$search));
		if ((/\.gz$/) || (/\.sql$/))  {
			push(@filearr,"$fmtime|$fdbname|$fpath");
		}
	}
}

sub DoAutoDeleteCount {
	my @str;
	my @dbarray;
	my $item;
	my %dbanz;
	my $anz=@filearr;
	@filearr=sort(@filearr);
	if($max_backup_files_each==0) {
		PrintOut("Autodelete by count ($max_backup_files) => found $anz Backups<br>");
		if ($anz>0)
		{
			for($i = 0; $i < ($anz-$max_backup_files); $i++) {
				@str=split(/\|/,$filearr[$i]);
				push(@trash_files, $str[2]);
			}
		}
	} else {
		PrintOut("Autodelete by count each DB ($max_backup_files) => found $anz Backups<br>");
		if ($anz>0)
		{
			foreach $item (@filearr) {
				@str=split(/\|/,$item);
				$dbanz{$str[1]}++;
					push(@trash_files, $str[2]) if($dbanz{$str[1]}>$max_backup_files);
			}
		}
	}
}

sub DeleteFiles {
	if(@trash_files==0) {
		PrintOut("<font color=red><b>No file to delete.</b></font><br>");
	} else {
		foreach $datei(@trash_files) {
			PrintOut("<font color=red><b>".$datei." deleted.</b></font><br>");
			write_log( ": Perl Cronsript Autodelete - $datei deleted.\n" ) ;
		}
	}
	unlink @trash_files ;
	undef(@trash_files);
}

sub ExecuteCommand {
	my $cmt = shift(@_);
	my (@cad, $errText, $succText, $cd2, $commandDump);
	my $err='';
	
	if($cmt==1) {  #before dump
		$commandDump=$command_beforedump;
		$errText="Error while executing Query before Dump";
		$succText="executing Query before Dump was successful";
#write_log(": Executing Command before dump\n");
	} else {
		$commandDump=$command_afterdump;
		$errText="Error while executing Query after Dump";
		$succText="executing Query after Dump was successful";
#write_log(": Executing Command after dump\n");
	}
	if(length($commandDump)>0) {
		#jetzt ausführen
		if(substr($commandDump,0,7) ne "system:") {
			$dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass")|| die "Database connection not made: $DBI::errstr"; 
			$dbh->{PrintError} = 0;
			if(index($commandDump,";")>=0) {
				@cad=split(/;/,$commandDump);
				for($i=0;$i<@cad;$i++) {
					if($cad[$i] ne ""){
						
						$sth = $dbh->prepare($cad[$i]);
						$sth->execute or $err=$sth->errstr();
						if ($err ne '') { write_log(": Executing Command $cad[$i] caused an error: $err \n"); }
						else { write_log(": Executing Command ($cad[$i]) was successful\n"); }
						$sth->finish;
					}
				}
			} else {
				write_log(": Executing Command ($commandDump)\n");
				if($commandDump) {
					$sth = $dbh->prepare($commandDump);
					$sth->execute or $err=$sth->errstr();
					if ($err ne '') { write_log(": Executing Command ($cad[$i] caused an error: ".$err." \n"); }
					else { write_log(": Executing Command ($cad[$i] was successful\n"); }
					$sth->finish;
				}
			}
			if($@){
				my $ger=$@;
				PrintOut("<p style=\"color:red;\">$errText ($commandDump):<br>$ger</p>");
				write_log(": $errText ($commandDump): $ger\n");
			} else {
				PrintOut("<p style=\"color:blue;\">$succText</p>");
				write_log(": $succText\n");
			}
		} else {
			#Systembefehl
			$commandDump=substr($commandDump,7);
			system($commandDump);
			PrintOut("<p style=\"color:blue;\">$succText ($commandDump)</p>");
			write_log(": $succText ($commandDump)\n");
		}
	}
}

sub closeScript {
	my ($Start, $Jetzt, $Totalzeit);
	$Start = $^T; $Jetzt = (time); 
	$Totalzeit=$Jetzt - $Start;
	($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
	$Jahr+=1900;$Monat+=1;$Jahrestag+=1;
	$starttime=        sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."  ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten);
	if($cron_save_all_dbs!=1) {
		PrintOut("closing script <strong>$starttime</strong>, bye<hr><em>total time used: $Totalzeit sec.</em><br>#EOS<hr></body></html>\n");
		# Datenbankverbindung schliessen
		$sth->finish() if (defined $sth);
		($dbh->disconnect() || warn $dbh->errstr) if (defined $dbh);
	}
}
