#!/usr/bin/perl -w


use strict;
use CGI::Carp qw(fatalsToBrowser warningsToBrowser);


print "Content-type: text/html\n\n";
print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">', "\n";
print "<html><head><title>Testausgabe</title>\n";
print "</head><body>\n";

print "Wenn Du das siehst, funktioniert Perl auf Deinem System !<br><br>";
print "If you see this perl works fine on your system !";
print "</body></html>\n";
