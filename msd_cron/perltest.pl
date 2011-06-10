#!/usr/bin/perl -w
use strict;
use Socket;
use Config;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
use CGI;
my $cgi = CGI->new();
print $cgi->header();
warningsToBrowser(1); # dies ist ganz wichtig!

use vars qw($eval_in_died $mod_dbi $mod_ff $mod_fb $mod_gz $mod_ftp $mod_mime);


print "<html><h1>Perl-Test f�r MySQLDumper</h1>\n";
print "<h6 style=\"font-size:11px;background-color:#ccffcc;\">Unbedingt notwendige Funktionen f�r das Cronscript</h6>";
print "<h4>teste DBI ...</h4>\n";
eval { $eval_in_died = 1; require DBI; };
       if(!$@){
            $mod_dbi = 1;
            import DBI;
            }
if($mod_dbi!=1){
    print "DBI ist nicht vorhanden !<br>\n";
} else {
    print "DBI ist installiert.<br>\n";
}

print "<h4>teste File::Find ...</h4>\n";
eval { $eval_in_died = 1; require File::Find; };
       if(!$@){
            $mod_ff = 1;
            import File::Find;
            }
if($mod_ff!=1){
    print "File::Find ist nicht vorhanden !<br>\n";
} else {
    print "File::Find ist installiert.<br>\n";
}


print "<h4>teste File::Basename ...</h4>\n";
eval { $eval_in_died = 1; require File::Basename; };
       if(!$@){
            $mod_fb = 1;
            import File::Basename;
            }
if($mod_fb!=1){
    print "File::Basename ist nicht vorhanden !<br>\n";
} else {
    print "File::Basename ist installiert.<br>\n";
}

print "<h6 style=\"font-size:11px;background-color:#ccffcc;\">Konfigurierbare Funktionen f�r das Cronscript</h6>";

print "<h4>teste Compress::Zlib ...</h4>\n";
eval { $eval_in_died = 1; require Compress::Zlib; };
       if(!$@){
            $mod_gz = 1;
            import Compress::Zlib;
            }
if($mod_gz!=1){
    print "Compress::Zlib ist nicht vorhanden !<br>\n";
} else {
    print "Compress::Zlib ist installiert.<br>\n";
}

print "<h4>teste Net::FTP ...</h4>\n";
eval { $eval_in_died = 1; require Net::FTP; };
       if(!$@){
            $mod_ftp = 1;
            import Net::FTP;
            }
if($mod_ftp!=1){
    print "Net::FTP ist nicht vorhanden !<br>\n";
} else {
    print "Net::FTP ist installiert.<br>\n";
}

print "<h4>teste MIME::Lite ...</h4>\n";
eval { $eval_in_died = 1; require MIME::Lite; };
       if(!$@){
            $mod_mime = 1;
            import MIME::Lite;
            }
if($mod_mime!=1){
    print "MIME::Lite ist nicht vorhanden !<br>\n";
} else {
    print "MIME::Lite ist installiert.<br>\n";
}


print "</html>\n";