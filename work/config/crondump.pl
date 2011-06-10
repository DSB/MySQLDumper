#!/usr/bin/perl -w##################################################
# MySQLDump CronDump
# 2004, Steffen Kamper
##################################################
use DBI;
use Compress::Zlib ;
# Parameter

my $dbname="pharma_peter";
my $dbpraefix="";
my $dbuser="root";
my $dbpass="";
my $compression=1;
my $backup_path="C:\\PHP\\\\\\work\\backup\\";
my $logdatei="C:\\PHP\\\\\\work\\log\\mysqldump.log";

($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
$Jahr+=1900;
my $CTIME_String = localtime(time);
$time_stamp=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."_".sprintf("%02d",$Stunden)."_Uhr_".sprintf("%02d",$Minuten);
$sql_file=$backup_path.$dbname."_".$time_stamp."_crondump_perl.sql";
$sql_file_z=$backup_path.$dbname."_".$time_stamp."_crondump_perl.sql.gz";
$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr." ". sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden).": ";
if($compression==0){$dt.="Start Perl Cron-Dump '$sql_file'\n";}else{$dt.="Start Perl Cron-Dump '$sql_file_z' \n";}
open(DATEI,">>$logdatei");
print DATEI $dt;
close(DATEI);
open(DATEI,">$sql_file");
print DATEI "";
close(DATEI);
# Verbindung mit mSQL herstellen, $dbh ist das Database Handle
my $dbh = DBI->connect("DBI:mysql:".$dbname,$dbuser,$dbpass)|| die   "Database connection not made: $DBI::errstr";
my $nl="\n";
my $next_sqlcommand="[n.!!e_w._!]";
my $sql_text="# Dump created on $CTIME_String by PERL Cron-Script\n";
$sql_text.="# Remember that you must use my restorescript in order to get a working DB\n";
$sql_text.="# because I use a special code to mark the end of a command.\n";
$sql_text.="# This is NOT compatible with other restorescripts!\n";
$sql_text.="# Anyway, have fun with this but use it at your own risk. :-)\n";
@tables=$dbh->tables;
foreach $tabelle (@tables) {
# definition auslesen
if($dbpraefix eq "" or ($dbpraefix ne "" && substr($tabelle,0,length($dbpraefix)) eq $dbpraefix)) {
$a="DROP TABLE IF EXISTS `".$tabelle."`;".$next_sqlcommand."\n";
$sql_text.=$a;
$sql_create="Show create table `".$tabelle."`";
$sth = $dbh->prepare($sql_create);
$sth->execute;
@ergebnis=$sth->fetchrow;
$sth->finish;
$a=$ergebnis[1].";".$next_sqlcommand."\n";
$sql_text.=$a;
# daten auslesen
$insert = "INSERT INTO `$tabelle` VALUES (";
$sql_daten="SELECT * FROM `".$tabelle."`";
$sth = $dbh->prepare($sql_daten);
$sth->execute;
while ( @ar=$sth->fetchrow)
{
$a=$insert;
foreach $inhalt(@ar)
{$a.= $dbh->quote($inhalt).", ";}
$a=substr($a,0, length($a)-2).");";
$sql_text.= $a.$next_sqlcommand."\n";
}#jetzt wegschreiben
if($compression==0){
 open(DATEI,">>$sql_file");
 print DATEI $sql_text;
 close(DATEI);
} else {
$gz = gzopen($sql_file_z, "wb") or die "Cannot open : $gzerrno\n" ;
$gz->gzwrite($sql_text) or die "error writing: $gzerrno\n" ;
$gz->gzclose ;
  } $sql_text="";
}}# Ende
($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);
$Jahr+=1900;
$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden).": Perl Cron-Dump '$sql_file' finished.\n";
open(DATEI,">>$logdatei");
print DATEI $dt;
close(DATEI);
$dbh->disconnect();
