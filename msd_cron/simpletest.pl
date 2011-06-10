#!/usr/bin/perl -w
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);  
warningsToBrowser(1);

print "Content-type: text/html\n\n";
print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', "\n";
print "<html><head><title>Testausgabe</title>\n";
print "</head><body>\n";

print "Wenn Du das siehst, funktioniert Perl auf Deinem System !<br><br>";
print "If you see this perl works fine on your system !";
print "</body></html>\n";


# Wenn Du diese Zeile hier siehst, dann wird Perl nicht ausgefuehrt.
# Frage Deinen Hoster, ob und wie Du Perl aktivieren kannst.
#
# If you can read this line Perl is not executed.
# Ask your hoster how to activate Perl.
#
