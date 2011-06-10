#!/usr/bin/perl -w
########################################################################################
# MySQLDumper CronDump
#
# 2004-2010 by Steffen Kamper, Daniel Schlichtholz
# additional scripting: Detlev Richter, Jonathan Tietz
#
# for support etc. visit http://forum.mysqldumper.de
# 
# This file is part of MySQLDumper released under the GNU/GPL 2 license
# http://www.mysqldumper.net 
# @package             MySQLDumper
# @version             $Rev$
# @author             $Author$
# @lastmodified     $Date$
# @filesource         $URL$
#
########################################################################################
# Script-Version
my $pcd_version='1.25 ($Rev$)';
$pcd_version =~ s/\(\$Rev:(.*) \$\)/\(Rev$1\)/;

#flush output buffer
$|=1;
########################################################################################
# please enter the absolute path of the config-dir
# when calling the script without parameters the default_configfile (mysqldumper.conf.php) will be loaded
# e.g. - (zum Beispiel): 
# my $absolute_path_of_configdir="/home/www/doc/8176/mysqldumper.de/www/mysqldumper/work/config/";

my $absolute_path_of_configdir='';
my $cgibin_path=''; # this is needed for MIME::Lite if it is in cgi-bin
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
use Getopt::Long;

########################################################################################
use vars qw(
$pcd_version $dbhost $dbname $dbuser $dbpass $dbport $dbsocket
$cron_dbindex @cron_db_array @ftp_server $dbpraefix @cron_dbpraefix_array 
$compression  $backup_path $logdatei $completelogdatei $command_beforedump $command_afterdump
$cron_printout $cronmail $cronmail_dump $cronmailto $cronmailto_cc $cronmailfrom $smtp_useauth $smtp_user $smtp_pass
$cronftp $mp $multipart_groesse $email_maxsize
$auto_delete $max_backup_files $perlspeed $optimize_tables_beforedump $result
@key_value $pair $key $value $conffile @confname $logcompression $log_maxsize $complete_log 
$starttime $Sekunden $Minuten $Stunden $Monatstag $Monat $Jahr $Wochentag $Jahrestag $Sommerzeit
$rct $tabelle  @tables @tablerecords $dt $sql_create @ergebnis @ar $sql_daten $inhalt
$insert $totalrecords $error_message $cfh $oldbar $print_out $msg $dt $ftp $dateistamm $dateiendung
$mpdatei $i $BodyNormal $BodyMultipart $BodyToBig $BodyNoAttach $BodyAttachOnly $Body $DoAttach $cmt $part $fpath $fname
$fmtime $timenow $daydiff $datei $inh $gz $search $fdbname @str $item %dbanz $anz %db_dat 
$fieldlist $first_insert $my_comment $sendmail_call $config_read_from
$cron_smtp $smtp_port $cron_use_sendmail $smtp_usessl
@ftp_transfer @ftp_timeout @ftp_user @ftp_pass @ftp_dir @ftp_server @ftp_port @ftp_mode @ftp_useSSL
$output $query $skip $html_output $datei
@trash_files $time_stamp @filearr $sql_file $backupfile $memory_limit $dbh $sth @db_array
@dbpraefix_array @cron_command_before_dump @cron_command_after_dump $db_anz $cron_sql_before_dump $cron_sql_after_dump
$record_count $filesize $status_start $status_end $sql_text $punktzaehler @backupfiles_name
@backupfiles_size $mysql_commentstring $character_set $mod_gz $mod_mime $mod_ftp $mod_auth $mod_base64 $mod_ssl
$mod_ftpssl @multipartfiles %db_tables @tablenames $tablename $opttbl $command $current_dir $smtp
);

#init vars
$memory_limit=100000;
$mysql_commentstring='-- ';
$character_set='utf8';
$sql_text='';
$sql_file='';
$punktzaehler=0;
@trash_files=();
@filearr=();
$opttbl=0;
$dbpraefix="";
$smtp_useauth = 0;
$complete_log= 0;
$cron_printout = 1;
$cron_dbindex = -3;
$my_comment = '';
#config file
$conffile="";

#sql statement written at beginning/end of dumpfile
$cron_sql_before_dump="SET FOREIGN_KEY_CHECKS=0;";
$cron_sql_after_dump="SET FOREIGN_KEY_CHECKS=1;";

#  Get used perl version
sub GetPerlVersion{
    my $pversion ;
    if ($^V){
        $pversion = sprintf "v%vd", $^V ; # v5.10.1
    }else{
        $pversion = local $];
    }
    return $pversion;
}

# import the optional modules ...
my $eval_in_died;
$mod_gz=0;
$mod_ftp=0;
$mod_mime=0;
$mod_auth=0;
$mod_base64=0;
$mod_ssl=0;
$mod_ftpssl=0;
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
eval { $eval_in_died = 1; require Net::FTPSSL; };
if(!$@){
    $mod_ftpssl = 1;
    import Net::FTPSSL;
}
eval { $eval_in_died = 1; require MIME::Lite; };
if(!$@){
    $mod_mime = 1;
    import MIME::Lite;
}

#required for smtp_auth
eval { $eval_in_died = 1; require Authen::SASL ; };
if(!$@){
    $mod_auth = 1;
    import Authen::SASL ;
}
#required for smtp_auth
eval { $eval_in_died = 1; require MIME::Base64 ; };
if(!$@){
    $mod_base64 = 1;
    import MIME::Base64 ;
}

#required for smtp with ssl
eval { $eval_in_died = 1; require Net::SMTP::SSL ; };
if(!$@){
    $mod_ssl = 1;
    import Net::SMTP::SSL ;
}

#read args from command
GetOptions ("config=s" => \$conffile, "html_output=s"  => \$html_output);
if (!defined $html_output) { $html_output=0; };    # suppress HTML Output

#called via browser or cmd
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
die "Hacking attempt - I wont do anything!\nGo away\n\n" if (lc($conffile) =~ m/:/);

#try to guess path if $absolute_path_of_configdir is not filled
if($absolute_path_of_configdir eq "" || ! -d $absolute_path_of_configdir)
{
    #get full path
    if ($config_read_from eq "shell") { $i=$0; } else { $i=$ENV{'SCRIPT_FILENAME'}; };
    if ($i=~m#^(.*)\\#) {
        #windows
            $current_dir = $1;
            $current_dir =~ s/msd\_cron//g;

            #set default log-files
            $logdatei= $current_dir ."work\\log\\mysqldump_perl.log";
            $completelogdatei= $current_dir . "work\\log\\mysqldump_perl.complete.log";

            $absolute_path_of_configdir = $current_dir ."work\\config\\";
    } elsif ($i=~m#^(.*)/# ) {
        #*nix
            $current_dir = $1;
            $current_dir =~ s/msd\_cron//g;

            #set default log-files
            $logdatei= $current_dir ."work/log/mysqldump_perl.log";
            $completelogdatei= $current_dir . "work/log/mysqldump_perl.complete.log";

            $absolute_path_of_configdir = $current_dir."work/config/";
    }
    #$absolute_path_of_configdir =~ s/msd\_cron//g;
    $backup_path = $absolute_path_of_configdir;
    $backup_path =~ s/config/backup/g;

    #if zlib is available, set default to compress
    if ($mod_gz){
        $logdatei .= ".gz";
        $completelogdatei .= ".gz";
        $logcompression=1;
    }
}

$conffile=trim($conffile);
if($conffile eq "") 
{
    $conffile=$default_configfile; # no Parameter for configfile given -> use standardfile "mysqldumper.conf.php"
    $config_read_from="standard configuration";
}

# check config-dir
$absolute_path_of_configdir=trim($absolute_path_of_configdir); # remove spaces
if (!opendir(DIR, $absolute_path_of_configdir)){
    err_trap("The config-directory you entered is wrong !\n($absolute_path_of_configdir - $!) \n\nPlease edit $0 and enter the right configuration-path.\n",0,1);
}
closedir(DIR);

#add trailing slash to confdir
if(substr($absolute_path_of_configdir,-1) ne "/") {
    $absolute_path_of_configdir=$absolute_path_of_configdir."/";
}

#add conffile extension
if (substr($conffile,length($conffile)-5,5) eq '.conf') { $conffile.='.php'; };
if (substr($conffile,length($conffile)-9,9) ne '.conf.php') { $conffile.='.conf.php'; };

# load configuration file
$datei=$absolute_path_of_configdir.$conffile;
if ($conffile =~ /^([0-9a-z_.]+)\z/){    
    if (!open(CONFIG,"<$datei")){
        err_trap("\nCould not open configuration: ".$datei."\nFile not found or not accessible!\n\n",0,1);
    }
    while (my $line = <CONFIG>)
    {
        chomp($line);
        if ($line ne '<?php' && $line ne '1;' && substr($line,0,2) ne '?>' && substr($line,0,1) ne '#')
        {
            eval($line);
        }
    }
    close(CONFIG);
}else{
    err_trap("\nCould not open configuration: ".$datei."\nNot save!\n\n",0,1);
}

if ($html_output==1) { $cron_printout=1; }; # overwrite output if HTML-Output is activated

# more than one conffile?
@confname=split(/\//,$conffile);


PrintOut("<span style=\"color:#0000FF;\">Configuration '".$conffile."' loaded successfully from ".$config_read_from.".</span>");
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
if($mod_ftpssl==1) {
    PrintOut("<span style=\"color:#0000FF;\">FTP-SSL Library loaded successfully...</span>");
    $cronftp=1;
} else {
    $cronftp=0;
    PrintOut("<span style=\"color:red;\">FTP-SSL Library loading failed - FTP-SSL deactivated ...</span>");
}
if($mod_mime==1) {
    PrintOut("<span style=\"color:#0000FF;\">Mail Library loaded successfully...</span>");
} else {
    $cronmail=0;
    PrintOut("<span style=\"color:red;\">Mail Library loading failed - Mail deactivated ...</span>");
}
if($mod_auth==1) {
    PrintOut("<span style=\"color:#0000FF;\">SMTP-Auth Library loaded successfully...</span>");
} else {
    PrintOut("<span style=\"color:red;\">SMTP-Auth Library loading failed - SMTP_Auth deactivated ...</span>");
}
if($mod_base64==1) {
    PrintOut("<span style=\"color:#0000FF;\">Base64 Library loaded successfully...</span>");
} else {
    $cronmail=0;
    PrintOut("<span style=\"color:red;\">Base64 Library loading failed - SMTP_Auth deactivated ...</span>");
}
if($mod_ssl==1) {
    PrintOut("<span style=\"color:#0000FF;\">SSL Library loaded successfully...</span>");
} else {
    $smtp_usessl=0;
    PrintOut("<span style=\"color:red;\">SSL Library loading failed - SMTP with ssl deactivated ...</span>");
}

#try writing to logfile
write_log("***********************************************************************\n");
write_log("Starting backup using Perlscript version $pcd_version (using perl ".GetPerlVersion().")\n");
write_log("Using configuration $conffile\n");

#tmp disable mail CC, TODO
if ($cronmailto_cc eq ", "){$cronmailto_cc='';} 

#now do the dump

#more than one db
if($cron_dbindex > -1)
{
    $dbname=$cron_db_array[$cron_dbindex];
    $dbpraefix=$cron_dbpraefix_array[$cron_dbindex];
    $command_beforedump=$cron_command_before_dump[$cron_dbindex];
    $command_afterdump=$cron_command_after_dump[$cron_dbindex];
    ExecuteCommand(1,$command_beforedump);
    DoDump($dbname);
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
        PrintOut("<hr>Starting to backup database <strong>`$dbname`</strong> (".($ii+1)."/$db_anz).");
        if ($dbpraefix ne "") {
            PrintOut("Scanning for tables with prefix '<span style=\"color:blue\">$dbpraefix</span>')");
        }
        ExecuteCommand(1,$command_beforedump);
        DoDump($dbname);
        ExecuteCommand(2,$command_afterdump);
    }
    PrintOut("<hr><strong>ALL $db_anz BACKUPS ARE DONE!!!</strong>");
}

if($auto_delete>0) 
{
    if($max_backup_files>0) 
    {
        PrintOut("<br><b>Starting autodelete function: </b><br>Keep the latest <font color=\"#0000FF\">$max_backup_files</font> backup files for each database and delete older ones.");
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
    $dbname = shift(@_);
    undef(%db_tables);
    ($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
    $Jahr+=1900;$Monat+=1;$Jahrestag+=1;
    my $CTIME_String = localtime(time);
    my $ret=0;
    $time_stamp=$Jahr."_".sprintf("%02d",$Monat)."_".sprintf("%02d",$Monatstag)."_".sprintf("%02d",$Stunden)."_".sprintf("%02d",$Minuten);
    $starttime= sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."  ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten);
    $fieldlist="";
    
    # connect to mysql, $dbh is the database handle
    if (trim($dbsocket) eq "")
    {
        $dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
    }
    else
    {
        $dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport;mysql_socket=$dbsocket","$dbuser","$dbpass") || die "Database connection not made: $DBI::errstr"; 
    }
    # which mysql version is used
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
    }
    else
    {
        # mysql Version < 4.1 -> no SET NAMES available
        # get standard encoding of MySQl-Server
        $sth = $dbh->prepare("SHOW VARIABLES LIKE 'character_set'");
        $sth->execute;
        @ar=$sth->fetchrow; 
        if (defined($ar[1])) { $character_set=$ar[1]; }
    }
    PrintOut("Characterset of connection and backup file set to <strong>".$character_set."</strong>.");
    
    #Statuszeile erstellen
    my $t=0;
    my $r=0;
    my $st_e="\n";
    undef(@tables);
    undef(@tablerecords);
    my $value=0;
    my $engine='';
    my %db_tables_views;
    my $query="SHOW TABLE STATUS FROM `$dbname`";
    if ($dbpraefix ne "") 
    { 
        $query.=" LIKE '$dbpraefix%'"; 
        PrintOut("Searching for tables inside database <strong>`$dbname`</strong> with prefix <strong>'$dbpraefix'</strong>."); 
    } 
    else
    {
        PrintOut("Searching for tables inside database <strong>`$dbname`</strong>."); 
    }
    $sth = $dbh->prepare($query);
    $sth->execute || err_trap("Error executing: ".$query." !  MySQL-Error: ".$DBI::errstr);
    while ( $value=$sth->fetchrow_hashref()) 
    {
        $value->{skip_data}=0; #defaut -> backup data of table
        # decide if we need to skip the data while dumping (VIEWs and MEMORY)
        
        # set default-values for VIEW or MEMORY 
        if (!defined $value->{Data_length})
        {
            $value->{Data_length}=0;
        }
        
        if (!defined $value->{Index_length})
        {
            $value->{Index_length}=0;
        }
        
        if (!defined $value->{Engine})
        {
            $value->{Engine}='';
        }
        
        if (!defined $value->{Rows})
        {
            $value->{Rows}=0;
        }

        if (!defined $value->{Update_time})
        {
            $value->{Update_time}='';
        }
   
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

        # check for Views - if it is a view the comment starts with "VIEW" and Engine is ''
        if (defined $value->{Comment} && uc(substr($value->{Comment},0,4)) eq 'VIEW' && $value->{Engine} eq '')
        {
            $value->{skip_data}=1;
            $value->{Engine}='VIEW'; 
            $value->{Update_time}='';
            $db_tables_views{$value->{Name}}=$value;
         }
         else
         {
            $db_tables{$value->{Name}}=$value;
         }

    }
    $sth->finish;

    @tablenames=sort keys(%db_tables);
    # add VIEW at the end as they need all tables to be created before
    @tablenames = (@tablenames,sort keys(%db_tables_views));
    %db_tables = (%db_tables,%db_tables_views);
    
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
    
    $st_e.=$mysql_commentstring."TABLE-INFO\n";
    foreach $tablename (@tablenames) 
    {
        #my $dump_table=1;
        #if ($dbpraefix ne "")
        #{
        #    if (substr($tablename,0,length($dbpraefix)) ne $dbpraefix) 
        #    {
                # exclude table from backup because it doesn't fit to praefix
        #        $dump_table=0;
        #    }
        #}
        # exclude table from backup because it doesn't fit to praefix
        if ($dbpraefix eq "" || ($dbpraefix ne "" && substr($tablename,0,length($dbpraefix)) eq $dbpraefix)){
        #if ($dump_table==1)
        #{
            $r+=$db_tables{$tablename}{Rows}; #calculate nr of records
            push(@tables,$db_tables{$tablename}{Name}); # add tablename to backuped tables
            $t++;
            $st_e.=$mysql_commentstring."TABLE\|$db_tables{$tablename}{Name}\|$db_tables{$tablename}{Rows}\|".($db_tables{$tablename}{Data_length}+$db_tables{$tablename}{Index_length})."\|$db_tables{$tablename}{Update_time}|$db_tables{$tablename}{Engine}\n";
        }
    }
    $st_e.=$mysql_commentstring."EOF TABLE-INFO";
    
    PrintOut("Found ".(@tables)." tables with $r records.");

    #AUFBAU der Statuszeile:
    #    -- Status:tabellenzahl:datensaetze:Multipart:Datenbankname:script:scriptversion:Kommentar:MySQLVersion:Backupflags:SQLBefore:SQLAfter:Charset:EXTINFO
    #    Aufbau Backupflags (1 Zeichen pro Flag, 0 oder 1, 2=unbekannt)
    #    (complete inserts)(extended inserts)(ignore inserts)(delayed inserts)(downgrade)(lock tables)(optimize tables)
    #
    $status_start=$mysql_commentstring."Status:$t:$r:";
    my $flags="1$optimize_tables_beforedump";
    $status_end=":$dbname:perl:$pcd_version:$my_comment:$mysql_version[0]:$flags";
    $status_end.=":$command_beforedump:$command_afterdump:$character_set:EXTINFO$st_e\n".$mysql_commentstring."Dump created on $CTIME_String by PERL Cron-Script\n".$mysql_commentstring."Dump by MySQLDumper (http://www.mysqldumper.net/)\n\n";


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
            if ($db_tables{$tablename}{skip_data} == 0)
            {
                PrintOut("Dumping table `<strong>$tablename</strong>` <em>(Type ".$db_tables{$tablename}{Engine}.")</em>:");
            }
            
            $a="\n\n$mysql_commentstring\n$mysql_commentstring"."Table structure for table `$tablename`\n$mysql_commentstring\n";
            
            if ($db_tables{$tablename}{Engine} ne 'VIEW' ) {
                $a.="DROP TABLE IF EXISTS `$tablename`;\n";
            } else {
                $a.="DROP VIEW IF EXISTS `$tablename`;\n";
            }
            
            $sql_text.=$a;
            $sql_create="SHOW CREATE TABLE `$tablename`";
            $sth = $dbh->prepare($sql_create);
            if (!$sth)
            {
                err_trap("Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
            }

            $sth->execute || err_trap("Couldn't execute '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
            @ergebnis=$sth->fetchrow;
            $sth->finish;
            $a=$ergebnis[1].";\n";
            if (length($a)<10)
            {
                err_trap("Fatal error! Couldn't read CREATE-Statement of table `$tabelle`! This backup might be incomplete! Check your database for errors."."' MySQL-Error: ".$DBI::errstr,1);
                $skip=1;
            }
            else 
            {
                $sql_text.=$a;
            }
            
            if ($db_tables{$tablename}{skip_data} == 0)
            {
                WriteToFile($sql_text,0);
                $sql_text="";
                $punktzaehler=0;

                # build fieldlist
                $fieldlist="(";
                $sql_create="SHOW FIELDS FROM `$tablename`";
                $sth = $dbh->prepare($sql_create);
                if (!$sth)
                {
                    err_trap("Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
                }
                
                $sth->execute || err_trap("Couldn't execute ".$sql_create."'! MySQL-Error: ".$DBI::errstr);
                while ( @ar=$sth->fetchrow) {
                    $fieldlist.="`".$ar[0]."`,";
                }
                $sth->finish;
                
                # remove trailing ',' and add ')'
                $fieldlist=substr($fieldlist,0,length($fieldlist)-1).")";

                # how many rows
                $rct=$db_tables{$tablename}{Rows};

                my $isDataWritten = 0;
                
                for (my $ttt=0;$ttt<$rct;$ttt+=$perlspeed) 
                {
                    # default beginning for INSERT-String
                    $insert = "INSERT INTO `$tablename` $fieldlist VALUES (";
                    $first_insert=0;
                    
                    # get rows (parts)
                    $sql_daten='SELECT * FROM `'.$tablename.'` LIMIT '.$ttt.','.$perlspeed.';';
                    $sth = $dbh->prepare($sql_daten);
                    if (!$sth)
                    {
                        err_trap("Fatal error sending Query '".$sql_create."'! MySQL-Error: ".$DBI::errstr);
                    }
                    $sth->execute || err_trap("Couldn't execute \"".$sql_daten."\" - MySQL-Error: ".$DBI::errstr);
                    
                    # step through all returned rows
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
                        
                        # quote all values
                        foreach $inhalt(@ar) { $a.= $dbh->quote($inhalt).","; }
                        
                        # remove trailing ',' and add end-sql
                        $a=substr($a,0, length($a)-1).");";
                        
                        # disable keys, before insert commands
                        if ($isDataWritten == 0)
                        {
                            $sql_text.="\n$mysql_commentstring\n$mysql_commentstring"."Dumping data for table `$tablename`\n$mysql_commentstring\n";
                            $sql_text .= "\n/*!40000 ALTER TABLE `$tablename` DISABLE KEYS */;";                                
                            $isDataWritten = 1;        
                        }
                        
                        $sql_text.= $a;
                        
                        # write sqlbuffer to file if size is over limit
                        if($memory_limit>0 && length($sql_text)>$memory_limit) 
                        {
                            WriteToFile($sql_text);
                            $sql_text='';
                            if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
                        }
                    }
                    $sth->finish;
                }

                # enable keys, after insert commands
                if ($isDataWritten == 1)
                {
                    $sql_text.="\n/*!40000 ALTER TABLE `$tablename` ENABLE KEYS */;\n";
                }
            }

            if ($db_tables{$tablename}{skip_data} == 0)
            {
                # write sql commands to file
                WriteToFile($sql_text);
                PrintOut("\n<br><em>$db_tables{$tablename}{Rows} inserted records (size of backupfile: ".byte_output($filesize).")</em>");
                $totalrecords+=$db_tables{$tablename}{Rows};
            }
            else
            {
                # write sql commands to file
                WriteToFile($sql_text,0);
                PrintOut("Dumping structure of <strong>`$tablename`</strong> <em>(Type ".$db_tables{$tablename}{Engine}." ) (size of backupfile: ".byte_output($filesize).")</em>");
                #PrintOut("\n(size of backupfile: ".byte_output($filesize).")</em>");
            }
            $sql_text="";
            if($mp>0 && $filesize>$multipart_groesse) {NewFilename();}
        }
    }
    # end
    WriteToFile("\n".$cron_sql_after_dump."\n",0);
    WriteToFile($mysql_commentstring."EOB\n",0);
    PrintOut("\n<hr>Finished backup of database `$dbname`.\n");
    write_log("Finished backup of database `$dbname`.\n");

    # sent via email
    if($cronmail==1) {
        PrintOut("Sending E-Mail ...");
        $ret=send_mail();
        if ($ret)
        {
            write_log("Recipient/s: $cronmailto $cronmailto_cc\n");
            PrintOut("Recipient/s: $cronmailto $cronmailto_cc\n");
        }
    }

    # sent to ftp-server
    send_ftp();
}

#Wird aufgerufen, wenn Fehler passieren
sub err_trap {
    my $error_message = shift(@_);
    
    #continue instead of exit
    my $continue = shift(@_);
    
    #don't write to logfile, if we did not read config before
    my $nolog = shift(@_);
    
    PrintOut("<font color=\"red\">Perl Cronscript ERROR: <b>$error_message</b></font><br>\n");
    write_log("Perl Cronscript ERROR: $error_message\n") if !defined $nolog;
    if (!defined $continue || $continue ==0)
    {
        PrintOut("<font color=\"red\"><b>Stopping script because of this fatal error!</b></font><br>\n");
        write_log("Stopping script because of this fatal error!\n") if !defined $nolog;
        exit(1);
    }
}

# Prints html-header
sub PrintHeader {
    my $cgi = new CGI;
    my $perlversion = GetPerlVersion();
    
    if ($html_output==1)
    {
        print $cgi->header(-type => 'text/html; charset=utf-8', -cache_control => 'no-cache, no-store, must-revalidate');
        print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
        print "<html>\n<head>\n<title>MySQLDumper - Perl CronDump [Version $pcd_version (using perl $perlversion)]</title>\n";
        print "<style type=\"text/css\">\nbody { padding:20px; font-family:Verdana,Helvetica,Sans-Serif;font-size: 0.9em !important;}</style>\n";
        print "</head>\n<body><h3>MySQLDumper - Perl CronDump [Version $pcd_version (using perl $perlversion)]</h3>\n";
    }
    else
    {
        #small output for external cronjobs, which expect a small returnvalue
        print "MySQLDumper - Perl CronDump [Version $pcd_version] started successfully (using perl $perlversion)\n";
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
                $gz = gzopen($completelogdatei, "ab") || err_trap("Cannot open mysqldump_perl.complete.log.gz. ");
                $gz->gzwrite("$dt $output\n")  || err_trap("Error writing mysqldump_perl.complete.log.gz. ");
                $gz->gzclose ;
                chmod(0777,$completelogdatei);
            }
        }
        if($cron_printout==1) 
        {
            #save current autoflush-setting
            local ($oldbar) = $|;

            #save current output filehandle and change it to STDOUT
            $cfh = select (STDOUT);

            #set autoflush on
            $| = 1;
            
            #remove html-tags
            if($html_output==0) 
            {
                $print_out =~ s/<(.*?)>//gi;
            }
            
            print $print_out;
            
            #TODO don't print <br> with the last printout (-> wrong html-syntax)
            if ($html_output==1){ print "<br>\n"; } else { print "\n"; };
            
            #restore old autoflush-setting
            $| = $oldbar;
            
            #set default output back to old filehandle
            select ($cfh);
        }
    }
}

sub write_log {
    $msg = shift(@_);
    ($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
    $Jahr+=1900; $Monat+=1;$Jahrestag+=1;
    #$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden);
    $dt=sprintf("%02d.%02d.%02d %02d:%02d:%02d",$Monatstag,$Monat,$Jahr,$Stunden,$Minuten,$Sekunden);

    my $logsize=0;
    if (-e $logdatei) 
    {
        $logsize=(stat($logdatei))[7];
        unlink($logdatei) if($logsize+200>$log_maxsize && $log_maxsize>0);
    }

    if ( ($logcompression==0) || ($mod_gz==0)) 
    {
        open(DATEI,">>$logdatei") || err_trap("Can't open file ($logdatei).",1,0);
        print DATEI "$dt $msg" || err_trap("Can't write to file ($logdatei).",1,0);
        close(DATEI)|| err_trap("can't close file ($logdatei).");
        chmod(0777,$logdatei);
    } 
    else
    {
        $gz = gzopen($logdatei, "ab") || err_trap("Can't open $logdatei.",1,0);
        if ($gz)
        {
            $gz->gzwrite("$dt $msg")  || err_trap("Can't write to $logdatei. ",1,0);
            $gz->gzclose ;
            chmod(0777,$logdatei);
        }
    }
}

sub send_ftp {
    #save files to ftp-server
    my $ret=0;
    my $x=0;
    for(my $i = 0; $i < @ftp_server; $i++)
    {
        if ($ftp_transfer[$i]==1)
        {
            if ($ftp_timeout[$i]<1) { $ftp_timeout[$i]=30; };
                if ($ftp_useSSL[$i]==1 && $mod_ftpssl==1)
                {    #use ftp-ssl
                    $ftp = Net::FTPSSL->new($ftp_server[$i], Encryption => Net::FTPSSL->EXP_CRYPT, Port => $ftp_port[$i], DataProtLevel =>Net::FTPSSL->DATA_PROT_CLEAR, Timeout => $ftp_timeout[$i], Debug   => 0) or err_trap( "FTP-SSL-ERROR: Can't connect: $@\n",1);
                }
                else
                {    #use 'plain' ftp
                    $ftp = Net::FTP->new($ftp_server[$i], Port => $ftp_port[$i], Timeout => $ftp_timeout[$i], Debug   => 1,Passive => $ftp_mode[$i]) or err_trap( "FTP-ERROR: Can't connect: $@\n",1);
                }
            $ftp->login($ftp_user[$i], $ftp_pass[$i]) or err_trap("FTP-ERROR: Couldn't login\n",1);
            $ftp->binary();
            $ftp->cwd($ftp_dir[$i]) or err_trap("FTP-ERROR: Couldn't change directory: ".$ftp_dir[$i],1);
            
            if($mp==0) 
            {
                PrintOut("FTP: transferring `$backupfile`");
                $ret=$ftp->put($sql_file);
                if (!$ret)
                {
                    err_trap("\nFTP-Error: Couldn't put $backupfile to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]."\n",1);
                }
                else
                {
                    write_log("FTP: transferred `$backupfile` to $ftp_server[$i] into dir $ftp_dir[$i] successfully\n");
                    PrintOut(" to $ftp_server[$i] into dir $ftp_dir[$i] was successful.\n");
                }
            } 
            else 
            {
                $dateistamm=substr($backupfile,0,index($backupfile,"part_"))."part_";
                $dateiendung=($compression==1)?".sql.gz":".sql";
                $mpdatei="";
                for ($x=1;$x<$mp;$x++) 
                {
                    $mpdatei=$dateistamm.$x.$dateiendung;
                    PrintOut("FTP: transferring multipart $mpdatei");
                    
                    $ret=$ftp->put($backup_path.$mpdatei);
                    if (!$ret) 
                    {
                        err_trap("Couldn't put $backup_path.$mpdatei to ".$ftp_server[$i]." into dir ".$ftp_dir[$i]."\n",1);
                    }
                    else
                    {
                        #write_log("FTP: transferring of `$mpdatei` to ".$ftp_server[$i]." finished successfully.\n");
                        #PrintOut("FTP: transferring of `$mpdatei` to $ftp_server[$i] finished successfully.");
                        write_log("FTP: transferred multipart `$mpdatei` to $ftp_server[$i] into dir $ftp_dir[$i] successfully\n");
                        PrintOut(" to $ftp_server[$i] into dir $ftp_dir[$i] was successful.\n");
                    }
                }
            }
        }
    }
}

# Send now mail
# 
# @param $msgnr    Which mode(1=mp+file,2=no mp + file,3=no file+ no mp)
# @param $file    String of current backupfile
# 
# @return string The converted Perl string
sub DoSendMail {
    my $msgnr = shift(@_);
    my $file = shift(@_);
    my $ret=0;
        #use ssl
        if ($smtp_usessl==1 && $mod_ssl==1)
        {
            $smtp->mail($cronmailfrom . "\n");
               $smtp->to($cronmailto . "\n");
               if (length($cronmailto_cc)>0)
            {
                my @tmpccs = split(/\,\ /,$cronmailto_cc);
                $smtp->cc(@tmpccs, { Notify => ['FAILURE'], SkipBad => 1 });
            }
            $smtp->data();
            $smtp->datasend( $msg->as_string() );
            $smtp->dataend();
            $smtp->quit;
            
            $ret = $smtp->ok();
        }
        else
        {
            $ret = $msg->send;
        }
        
        if(!$ret){
            #there was an error sending mail
            if($msgnr==1)
            {    #mp and attached file
                err_trap("Error 1 sending mail with backup ".$file."!",1);
            }
            elsif($msgnr==2)
            {    #attached files
                err_trap("Error 2 sending mail with backup ".$file."!",1);
            }
            else
            {    #no files
                err_trap("<font color=\"error\">Error 3 sending E-Mail!</font><br>",1);
            }
        }else{
            #mail was sent
            if($msgnr==3)
            {
                PrintOut("<font color=\"green\">E-Mail sent successfully.</font>");
                write_log("<font color=\"green\">E-Mail sent successfully.</font>\n");
            }else{
                PrintOut("<font color=\"green\">E-Mail with backup ".$file." sent successfully.</font>");
                write_log("<font color=\"green\">E-Mail with backup ".$file." sent successfully.</font>\n");
            }    
            
        }
        return $ret;
}

sub send_mail {
    #sent email w/o files
    $BodyNormal='Find attached a backup of your database `'.$dbname.'`.';
    $BodyMultipart="A multipart backup has been made.<br>You will receive one or more emails with the backup-files attached.<br>The database `".$dbname."` has been backuped.<br>The following files have been created:";
    $BodyToBig="The backup is bigger than the allowed max-limit of ".byte_output($email_maxsize)." and has not been attached.<br>Backup of database ".$dbname."<br><br>The following files have been created:";
    $BodyNoAttach="The backup has not been attached.<br>I saved your database `".$dbname."` to file<br>";
    $BodyAttachOnly="Here is your backup.";
    $Body="";
    $DoAttach=1;
    my @mparray;
    my $ret=0;
    if($mp==0)
    {    #no multipart
        if(($email_maxsize>0 && $filesize>$email_maxsize) || $cronmail_dump==0) 
        {
            #attache files
            if($cronmail_dump==0)
            {    #The backup has not been attached
                $Body=$BodyNoAttach.$backupfile." (".byte_output($filesize).")";
            } 
            else 
            {    #The backup is bigger than the allowed max-limit
                $Body=$BodyToBig.$backupfile." (".byte_output($filesize).")";
            }
            $DoAttach=0;
        } 
        else 
        {    #Find attached your backup
            $Body=$BodyNormal." File ".$backupfile." (".byte_output($filesize).")";
        }
    } 
    else 
    {    #multipart
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
    {    #send email via smtp
        #use ssl
        if ($smtp_usessl==1 && $mod_ssl==1)
        {
            if (not $smtp = Net::SMTP::SSL->new($cron_smtp,Port => $smtp_port,Debug => 0))
            {
                #try without ssl
                if (not $smtp = Net::SMTP->new($cron_smtp,Port => $smtp_port,Debug => 0))
                {
                    err_trap("Error setting smtp_over_ssl and smtp call !",1);
                }
            }    

            #should we use smtp_auth
            if ($smtp_useauth==1 && $mod_auth==1 && $mod_base64==1 && length($smtp_user)>0)
            {
                PrintOut("<font color=\"green\">Using SMTP_AUTH with user $smtp_user.</font>");
                write_log("<font color=\"green\">Using SMTP_AUTH with user $smtp_user.</font>\n");
                $smtp->auth($smtp_user,$smtp_pass)|| err_trap("Error setting smtp_auth_via_ssl call !",1);
            }
        }
        else
        {    #no ssl
            #should we use smtp_auth
            if ($smtp_useauth==1 && $mod_auth==1 && $mod_base64==1 && length($smtp_user)>0){
                PrintOut("<font color=\"green\">Using SMTP_AUTH with user $smtp_user.</font>");
                write_log("<font color=\"green\">Using SMTP_AUTH with user $smtp_user.</font>\n");
                MIME::Lite->send('smtp', $cron_smtp, Timeout=>60,AuthUser=>$smtp_user, AuthPass=>$smtp_pass) || err_trap("Error setting smtp call with smtp_auth!",1);
            }else{
                MIME::Lite->send('smtp', $cron_smtp, Timeout=>60) || err_trap("Error setting smtp call !",1);
            }
        }
    }

    $msg = MIME::Lite->new(
        From    => $cronmailfrom,
        To      => $cronmailto,
        Cc      => $cronmailto_cc,
        Subject => "MSD (Perl) - Backup of DB ".$dbname,
        Type    => 'text/html; charset=iso-8859-1',
        Data    => "<body>\n".$Body."</body>\n"
    );

    if($DoAttach==1 && $mp==0)
    {    #attach files, no multipart
        $msg->attach(
            Type     => "BINARY",
            Path     => "$sql_file",
            Encoding => "base64",
            Filename => "$backupfile"
        );
        
        $ret=DoSendMail(1,$backupfile);
        return $ret;
    }
    
    if($DoAttach==1 && $mp>0 && $cronmail_dump>0)
    {    #attach files, multipart
        foreach $datei(@mparray)
        {
            @str=split(/\|/,$datei);
            $msg = MIME::Lite->new(
                From    => $cronmailfrom,
                To      => $cronmailto,
                Cc      => $cronmailto_cc,
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
            
            $ret=DoSendMail(2,$str[0]);
#            if (!$ret)
#            {
#                err_trap("Error 2 sending mail with backup ".$str[0]."!",1);
#            }
#            else
#            {
#                PrintOut("<font color=\"green\">E-Mail with backup ".$str[0]." sent successfully.</font>");
#                write_log("<font color=\"green\">E-Mail with backup ".$str[0]." sent successfully.</font>\n");
#            }
        }
        return $ret;
    }

    #do not attach files, no multipart
    return DoSendMail(3);
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
        write_log("Dumping data into file `$backupfile` \n");
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
    $sql_text.=$cron_sql_before_dump."\n";
    
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

# Find files for autodelete
sub AutoDeleteCount {
    $fpath=$File::Find::name;
    $fname=basename($fpath);
    my @fileparts=split(/\./,"$fname");
    my $partcount=@fileparts;
    if ($partcount>1)
    {
        my $end=$fileparts[(@fileparts-1)];
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
        if (length($line)>0 && (substr($line,0,10) eq "-- Status:" ||substr($line,0,11) eq "--  Status:"))
        {
            #statusline read
            my @infos=split(/\:/,$line);
            my $file_multipart=($infos[3])?$infos[3]:'';
            $file_multipart=~ s/MP_/ /g;
            $file_multipart=trim($file_multipart);
            my $file_databasename=($infos[4])?$infos[4]:'';
            if ($file_multipart eq "" || substr($file_multipart,0,1) eq "0")
            {
                #no multipartfile
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
            PrintOut("No Statusline in `<strong>$fname</strong>` found. Seems not to be a MySQLDumper file. Skipping file.");
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
            if (defined $str[1] && !defined $dbanz{$str[1]}) 
            {
                $dbanz{$str[1]}=0;
                @multipartfiles=();
            }
            #PrintOut($max_backup_files.': '.$dbanz{$str[1]}.' -> '.$str[0].' - '.$str[1].' - '.$str[2]);
                
            #no multipart file -> update db counter
            if(defined $str[1] && !defined $str[2])
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
                if(defined $str[1] && $dbanz{$str[1]}>=$max_backup_files)
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
            # prepare command
            $commandDump = replaceQueryStringSimple($commandDump);
            if (trim($dbsocket) eq "")
            {
                $dbh = DBI->connect("DBI:mysql:$dbname:$dbhost:$dbport","$dbuser","$dbpass") || err_trap("Database connection not made: $DBI::errstr");
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
                @cad=$commandDump;
            }

            for($i=0;$i<@cad;$i++) 
            {
                if($cad[$i] ne '')
                {
                    $err='';
                    # replace $$MSD$$ back to ';'
                    $cad[$i] =~ s/\$\$MSD\$\$/\;/g;
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
    PrintOut("<hr>Everythings is done: closing script <strong>$starttime</strong>");
    PrintOut("<em>total time used: $Totalzeit sec.</em>");
    PrintOut("#EOS (End of script)<hr></body></html>");
    # Datenbankverbindung schliessen
    $sth->finish() if (defined $sth);
    ($dbh->disconnect() || warn $dbh->errstr) if (defined $dbh);
}

#  Strip whitespace (or other characters) from the beginning and end of a string
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
                PrintOut("<span style=\"color:green;font-size:11px;\"> Table ".($opttbl+1)." `$tablename` optimized successfully.</span>");
                $opttbl++;
            }
            else
            {
                err_trap("<span style=\"color:red;font-size:12px;\">&nbsp;&nbsp;Error optimizing table `$tablename`</span>",1);
            }
        }
    }
    PrintOut("<span style=\"font-size:11px;\">$opttbl tables have been optimized</span><br>") if($opttbl>0) ;
}

# replace in querystring all ';' in VALUES with '$$MSD$$'
sub replaceQueryStringSimple{
    my $string = shift(@_);
    
    if ($string =~ m#(.*)\'(.*)\;(.*)\'(.*)#){
        # if found search for more ';'
        return replaceQueryStringSimple($1.'\''.$2.'$$MSD$$'.$3.'\''.$4);;
    }else{
        return $string;
    }
}