#!/usr/bin/perl -w
#
# ERROR / FEHLER !!
# +++++++++++++++++
# If you can read this line Perl is not executed.
# Ask your hoster how to activate Perl.
#
# Wenn Du diese Zeile hier siehst, dann wird Perl nicht ausgefuehrt.
# Frage Deinen Hoster, ob und wie Du Perl aktivieren kannst.
#
# Sample Apache-Config:
# <Directory /usr/local/apache2/htdocs/mysqldumper/msd_cron>
#    Options ExecCGI
#    AddHandler cgi-script cgi pl
# </Directory>
# 
# This file is part of MySQLDumper released under the GNU/GPL 2 license
# http://www.mysqldumper.net 
# @package 			MySQLDumper
# @version 			$Rev$
# @author 			$Author$
# @lastmodified 	$Date$
# @filesource 		$URL$

use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
use CGI;
warningsToBrowser(1);
my $cgi = new CGI;

print $cgi->header(-type => 'text/html; charset=utf-8', -cache_control => 'no-cache, no-store, must-revalidate');
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
print "<html><head><title>MySQLDumper - simple Perl test</title>\n";
print '<style type="text/css">body { padding-left:18px; font-family:Verdana,Helvetica,Sans-Serif;}</style>';
print "\n</head><body>\n";
print "<p>If you see this perl works fine on your system !<br><br>";
print "Wenn Du das siehst, funktioniert Perl auf Deinem System !</p>";
print "</body></html>\n";