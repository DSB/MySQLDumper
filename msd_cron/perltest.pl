#!/usr/bin/perl -w
# This file is part of MySQLDumper released under the GNU/GPL 2 license
# http://www.mysqldumper.net 
# @package 			MySQLDumper
# @version 			$Rev$
# @author 			$Author$
# @lastmodified 	$Date$
# @filesource 		$URL$

use strict;
use Socket;
use Config;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
use CGI;
warningsToBrowser(1);

my $eval_in_died;
my $mod_dbi=0;
my $mod_ff=0;
my $mod_fb=0;
my $mod_gz=0;
my $mod_ftp=0;
my $mod_mime=0;
my $mod_auth=0;
my $mod_base64=0;
my $mod_ssl=0;
my $mod_ftpssl=0;
my $dbi_driver;
my $dbi_mysql_exists=0;
my $get_options=0;
my $ok='<font color="green">';
my $err='<font color="red">';
my $mod_version='unknown';
my $pversion ;

if ($^V){
    $pversion = sprintf "v%vd", $^V ; # v5.10.1
}else{
    $pversion = local $];
}

my $cgi = new CGI;
print $cgi->header(-type => 'text/html; charset=utf-8', -cache_control => 'no-cache, no-store, must-revalidate');
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
print "<html><head><title>MySQLDumper Perl modul test</title>\n";
print '<style type="text/css">body { padding-left:18px; font-family:Verdana,Helvetica,Sans-Serif;}</style></head>';
print "<body><h2>Testing needed Perl-Moduls in order to run the Perl script crondump.pl (Perl $pversion found)</h2>\n";
print "<h4 style=\"background-color:#ccffcc;\">Necessary Modules for crondump.pl</h4>";
print "<strong>testing DBI ...</strong>\n";
eval { $eval_in_died = 1; require DBI; };
       if(!$@){
            $mod_dbi = 1;
            import DBI;
            $mod_version = $DBI::VERSION;
            }
if($mod_dbi!=1){
    print $err."<br>Couldn't find DBI!<br>crondump.pl can't establish a connection to the MySQL database!</font>\n";
} else {
    print $ok."Found modul DBI <strong>".$mod_version."</strong>. OK.</font>\n";
	my @available_drivers = DBI->available_drivers('quiet');
	foreach $dbi_driver (@available_drivers)
	{
		print "<br>Found modul DBI::$dbi_driver\n";
		if ( $dbi_driver eq 'mysql' ) { $dbi_mysql_exists=1; } ;
	}
	if ($dbi_mysql_exists !=1 ) { print $err."<br>Critical error: modul DBI::mysql not found! crondump.pl can't establish a connection to the MySQL-Database if this modul isn't installed! Please install DBI::mysql!</font>"; }
	else { print "<br>".$ok."Found modul DBI::mysql. OK. crondump.pl can connect to MySQL-Database.</font>"; }
}

print "<br><br><strong>testing File::Find ...</strong>\n";
eval { $eval_in_died = 1; require File::Find; };
       if(!$@){
            $mod_ff = 1;
            import File::Find;
            $mod_version = $File::Find::VERSION;
            }
if($mod_ff!=1){
    print $err."Critical error: modul File::Find not found! Please install it</font><br>\n";
} else {
    print $ok."Found modul File::Find <strong>".$mod_version."</strong>. OK.</font><br>\n";
}

print "<strong>testing File::Basename ...</strong>\n";
eval { $eval_in_died = 1; require File::Basename; };
       if(!$@){
            $mod_fb = 1;
            import File::Basename;
            $mod_version = $File::Basename::VERSION;
            }
if($mod_fb!=1){
    print $err."Critical error: modul File::Basename not found! Please install it!</font><br>\n";
} else {
    print $ok."Found modul File::Basename <strong>".$mod_version."</strong>. OK.</font><br>\n";
}

print "<strong>testing Getop...</strong>\n";
eval { $eval_in_died = 1; require Getopt::Long; };
       if(!$@){
            $get_options = 1;
            import Getopt::Long;
            $mod_version = $Getopt::Long::VERSION;
            }
if($get_options!=1){
    print $err."Modul Getopt not found! You should install it if you want to set configfile via shell.</font><br>\n";
} else {
    print $ok."Found modul Getopt <strong>".$mod_version."</strong>. OK. crondump.pl can read configfile-parameter from shell.</font><br>\n";
}

print "<h4 style=\"background-color:#ccffcc;\">Configurable functions for crondump.pl (these moduls are only needed when explained option is turned on):</h4>";

print "<strong>testing Compress::Zlib (needed for dumping data into a crompessed *.gz-file)...</strong><br>\n";
eval { $eval_in_died = 1; require Compress::Zlib; };
	if(!$@){
		$mod_version=qq[ver $Compress::Zlib::VERSION];
            $mod_gz = 1;
            import Compress::Zlib;
            }
if($mod_gz!=1){
    print "<font color='red'>Error: modul Compress::Zlib not found! crondump.pl can't write compressed files. Falling back to uncrompressed files (files are 10 times bigger).</font><br>\n";
} else {
    print $ok."Found modul Compress::Zlib <strong>".$mod_version."</strong>. OK. crondump.pl can write compressed backups.</font><br>\n";
}

print "<br><strong>testing Net::FTP (needed if you want to transfer backups to another server)...</strong><br>\n";
eval { $eval_in_died = 1; require Net::FTP; };
       if(!$@){
            $mod_ftp = 1;
            import Net::FTP;
            $mod_version = $Net::FTP::VERSION;
            }
if($mod_ftp!=1){
    print $err."Error: modul Net::FTP not found! crondump.pl can't transfer data via FTP.</font><br>\n";
} else {
    print $ok."Found modul Net::FTP <strong>".$mod_version."</strong>. OK - crondump.pl can send backups via FTP.</font><br>\n";
}

print "<br><strong>testing Net::FTPSSL (needed if you want to transfer backups to another server with ssl encryption)...</strong><br>\n";
eval { $eval_in_died = 1; require Net::FTPSSL; };
       if(!$@){
            $mod_ftpssl = 1;
            import Net::FTPSSL;
            $mod_version = $Net::FTPSSL::VERSION;
            }
if($mod_ftpssl !=1){
print $err."Error: modul Net::FTPSSL not found! crondump.pl can't transfer data via FTP with ssl encryption.</font><br>\n";
} else {
    print $ok."Found modul Net::FTPSSL <strong>".$mod_version."</strong>. OK - crondump.pl can send backups via FTP with ssl encryption.</font><br>\n";
}


print "<br><strong>testing MIME::Lite (needed if you want to send backups via email)...</strong><br>\n";
eval { $eval_in_died = 1; require MIME::Lite; };
       if(!$@){
            $mod_mime = 1;
            import MIME::Lite;
            $mod_version = $MIME::Lite::VERSION;
            }
if($mod_mime!=1){
    print $err."Error: modul MIME::Lite not found!<br>crondump.pl can't send emails! Option will automatically be deactivated. Install Mime::Lite in order to send emails!</font>\n";
} else {
    print $ok."Found modul MIME::Lite <strong>".$mod_version."</strong>. OK. crondump.pl can send emails.</font><br>\n";
}

print "<br><strong>testing Authen::SASL (needed if you want to use SMTP_AUTH for email)...</strong><br>\n";
eval { $eval_in_died = 1; require Authen::SASL; };
       if(!$@){
            $mod_auth = 1;
            import Authen::SASL;
            $mod_version = $Authen::SASL::VERSION;
            }
if($mod_auth!=1){
    print $err."Error: modul Authen::SASL not found!<br>crondump.pl can't send emails with SMTP_AUTH. Install Authen::SASL in order to use SMTP_AUTH!</font>\n";
} else {
    print $ok."Found modul Authen::SASL <strong>".$mod_version."</strong>. OK. crondump.pl can use SMTP_AUTH.</font><br>\n";
}

print "<br><strong>testing MIME::Base64 (needed if you want to use SMTP_AUTH for email)...</strong><br>\n";
eval { $eval_in_died = 1; require MIME::Base64; };
if(!$@){
    $mod_base64 = 1;
	import MIME::Base64;
    $mod_version = $MIME::Base64::VERSION;
}
if($mod_base64!=1){
    print $err."Error: modul MIME::Base64 not found!<br>crondump.pl can't send emails with SMTP_AUTH! Option will automatically be deactivated. Install Mime::Base64 in order to use SMTP_AUTH!</font>\n";
} else {
    print $ok."Found modul MIME::Base64 <strong>".$mod_version."</strong>. OK. crondump.pl can encode user/pass for SMTP_AUTH.</font><br>\n";
}

print "<br><strong>testing Net::SMTP::SSL (needed if you want to send email with ssl encryption)...</strong><br>\n";
eval { $eval_in_died = 1; require Net::SMTP::SSL; };
       if(!$@){
            $mod_ssl = 1;
            import Net::SMTP::SSL;
            $mod_version = $Net::SMTP::SSL::VERSION;
            }
if($mod_ssl !=1){
    print $err."Error: modul Net::SMTP::SSL not found!<br>crondump.pl can't send emails with ssl! Option will automatically be deactivated. Install Net::SMTP::SSL in order to use SSL!</font>\n";
} else {
    print $ok."Found modul Net::SMTP::SSL <strong>".$mod_version."</strong>. OK. crondump.pl can send emails with ssl.</font><br>\n";
}

print "<br><br><br><br></body></html>\n";
