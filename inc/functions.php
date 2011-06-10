<?php

$version="0.9.3c";
$nl="\n";
define ("_DEVELOP_",true);

//Die Arbeitsverzeichnisse
$rootdir=substr($PHP_SELF,0,strrpos($PHP_SELF,"/"));
$work="work/";
$backup_path=$work."backup/";
$structure_path=$work."structure/";
$log_path=$work."log/";
$log_file=$log_path."mysqldump.log";
$config_path=$work."config/";
$config_file=$config_path."parameter.php";

function TestWorkDir()
{
	global $rootdir,$work,$backup_path,$structure_path,$log_path,$log_file,$config_path,$config_file;
	
	if (!is_dir($work)) {
		// Arbeitsverzeichnis existiert noch nicht? Na gut, dann machen wir eben eins. :-)
 		mkdir($work, 0777); 
		mkdir($backup_path, 0777); 
		mkdir($structure_path, 0777); 
		mkdir($log_path, 0777); 
		mkdir($config_path, 0777); 
		
	} else {
		if (!is_dir($backup_path))  mkdir($backup_path, 0777); 	else {if(decoct(fileperms($backup_path))<>0777)chmod($backup_path, 0777);}
		if (!is_dir($structure_path)) mkdir($structure_path, 0777); else {if(decoct(fileperms($structure_path)<>0777))chmod($structure_path, 0777);}
		if (!is_dir($log_path)) mkdir($log_path, 0777); else {if(decoct(fileperms($log_path)<>0777))chmod($log_path, 0777);}
		if (!is_dir($config_path)) mkdir($config_path, 0777); else {if(decoct(fileperms($config_path)<>0777))chmod($config_path, 0777);}
	}
	if(!file_exists($config_file))SetDefault();
	if(!file_exists($log_file)){DeleteLog();}
}

function Help($ToolTip,$Anker)
{
	global $lang;
	return '<a href="language/help_'.$lang.'.html#'.$Anker.'"><img src="images/help16.gif" width="16" height="16" alt="'.$ToolTip.'" hspace="4" vspace="0"></a>';
}

function DeleteFiles($dir, $pattern = "*.*")
{   
 	$deleted = false;
	$pattern = str_replace(array("\*","\?"), array(".*","."), preg_quote($pattern));
	if (substr($dir,-1) != "/") $dir.= "/";
	if (is_dir($dir))
	{    $d = opendir($dir);
	    while ($file = readdir($d))
	    {    if (is_file($dir.$file) && ereg("^".$pattern."$", $file))
	        {    if (unlink($dir.$file))    $deleted[] = $file;
	        }
	    }
	    closedir($d);
	    return $deleted;
	}
	else return 0; 
}


function SelectDB($index) 
{ 
	global $dbname,$dbpraefix, $dbname_a, $dbpraefix_a,$db_selected_index; 
	
	$dbname = $dbname_a[$index]; 
	$dbpraefix = $dbpraefix_a[$index]; 
	$db_selected_index=$index;
	
} 


function SetDefault($dbonly=false)
{
	global $dbhost,$dbname,$dbuser,$dbpass, $dbpraefix, $compression,$send_mail,$email,$nl,
		$anzahl_zeilen,$anzahl_zeilen_restore,$tabellen_praefix,$next_sqlcommand,
		$dbhost_a, $dbname_a, $dbuser_a, $dbpass_a, $dbpraefix_a, $db_selected_index, $lang,
		$auto_delete,  $del_files_after_days, $max_backup_files,
		$cron_timelimit,$cron_samedb,$cron_dbindex, $l,
		$rootdir,$work,$backup_path,$structure_path,$log_path,$config_path,$config_file;
	
		
	if($dbonly==false){	
		@unlink($config_file);
   		include("inc/config.php"); 
	}
	//Arrays löschen
   	$i=0;
	$dbname_a=Array();
	//DB-Liste holen
   	$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error().$l["wrong_userpass"]);
   	$db_list = mysql_list_dbs($conn); 
   	while ($row = mysql_fetch_object($db_list)) 
   	{
		$found_db=$row->Database;
		$cnt=mysql_list_tables($found_db,$conn);
		if($cnt!=NULL){
   		$dbname_a[$i++]=$found_db;
		$out.=$l["saving_db_form"]." ".$found_db." ($cnt) ".$l["added"]."$nl";
		}
   	}	
	$dbname=$dbname_a[0];
	
   	//SelectDB(0); 
   	WriteParams();
   	
	if($dbonly==false) WriteLog("default settings loaded.");
	return $out;
}

function WriteParams() 
{ 
   global $dbhost,$dbname,$dbuser,$dbpass, $dbpraefix, $dbcronpraefix, 			$compression,$send_mail,$email,$nl,
		$anzahl_zeilen,$anzahl_zeilen_restore,$next_sqlcommand,
		$dbhost_a, $dbname_a, $dbuser_a, $dbpass_a, $dbpraefix_a, $db_selected_index, $lang,
		$auto_delete,  $del_files_after_days, $max_backup_files,
		$cron_timelimit,$cron_samedb,$cron_dbindex,
		$ftp_transfer, $ftp_server, $ftp_port, $ftp_user, $ftp_pass, $ftp_dir,
		$rootdir,$work,$backup_path,$structure_path,$log_path,$config_path,$config_file;
   
    //Parameter überprüfen und gegebenfalls auf Standardwerte setzen
	if(!isset($anzahl_zeilen))$anzahl_zeilen=2000;
	if(!isset($anzahl_zeilen_restore))$anzahl_zeilen_restore=1000;
	if(!isset($del_files_after_days))$del_files_after_days=0;
	if(!isset($max_backup_files))$max_backup_files=0;
	if(!isset($cron_timelimit))$cron_timelimit=360;
	if(!isset($ftp_port))$ftp_port=21;
	
	
	//Parameter zusammensetzen 
	$param='<?php '.$nl; 
	if (!isset($db_selected_index)) $db_selected_index=0;
	
	$param.='$db_selected_index='.$db_selected_index.';'.$nl; 
	$param.='$dbhost="'.$dbhost.'";'.$nl; 
	$param.='$dbname="'.$dbname.'";'.$nl; 
	$param.='$dbuser="'.$dbuser.'";'.$nl; 
	$param.='$dbpass="'.$dbpass.'";'.$nl; 
   
	for($i=0;$i<count($dbname_a);$i++) 
	{
			$param.='$dbname_a['.$i.']="'.$dbname_a[$i].'";'.$nl; 
			$param.='$dbpraefix_a['.$i.']="'.$dbpraefix_a[$i].'";'.$nl; 
	} 
   //$param.='$path="'.$path.'";'.$nl; 
   $param.='$compression='.$compression.';'.$nl; 
	if (!isset($send_mail)) $send_mail=0;
   $param.='$send_mail='.$send_mail.';'.$nl; 
   $param.='$email[0]="'.$email[0].'";'.$nl; 
   $param.='$email[1]="'.$email[1].'";'.$nl; 
   
   $param.='$auto_delete='.$auto_delete.';'.$nl; 
   $param.='$del_files_after_days='.$del_files_after_days.';'.$nl; 
   $param.='$max_backup_files='.$max_backup_files.';'.$nl; 
   
   $param.=(strlen($next_sqlcommand)==1) ? '$next_sqlcommand=CHR('.ord($next_sqlcommand).');'.$nl :'$next_sqlcommand="'.$next_sqlcommand.'";'.$nl; 
   $param.='$anzahl_zeilen='.$anzahl_zeilen.';'.$nl; 
   $param.='$anzahl_zeilen_restore='.$anzahl_zeilen_restore.';'.$nl;
   $param.='$lang="'.$lang.'";'.$nl;
   $param.='$dbpraefix="'.$dbpraefix.'";'.$nl;
   $param.='$dbcronpraefix="'.$dbcronpraefix.'";'.$nl;
   $param.='$cron_timelimit='.$cron_timelimit.';'.$nl;
   $param.='$cron_samedb='.$cron_samedb.';'.$nl;
   $param.='$cron_dbindex='.$cron_dbindex.';'.$nl;
   $param.='$ftp_transfer="'.$ftp_transfer.'";'.$nl;
   $param.='$ftp_server="'.$ftp_server.'";'.$nl;
   $param.='$ftp_port="'.$ftp_port.'";'.$nl;
   $param.='$ftp_user="'.$ftp_user.'";'.$nl;
   $param.='$ftp_pass="'.$ftp_pass.'";'.$nl;
   $param.='$ftp_dir="'.$ftp_dir.'";'.$nl;
   
   $param.='// Sprachfile laden'.$nl.'include("language/lang_'.$lang.'.php")'.$nl;;
   $param.='?>'; 
   
   	
   //Datei öffnen und schreiben 
	$ret=true;
	
	if ($fp=fopen($config_file, "wb"))
	{ 
		if (!fwrite($fp,$param)) $ret=false; 
		if (!fclose($fp)) $ret=false; 
	}
	else $ret=false;
	$ret=WriteCronScript();
	
	return $ret;
} 



function AutoDelete()
{
	global $del_files, $max_backup_files, $del_files_after_days, $l,
	$rootdir,$work,$backup_path,$structure_path,$log_path,$config_path,$config_file;
	
	$dh = opendir($backup_path);
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != "..") {
		 $z=substr($filename,strpos($filename,".")-2);
		 $z=substr($z,6,4).substr($z,3,2).substr($z,0,2).substr($z,11,2).substr($z,18,2);
		 $files[] = $z."|".$filename;
		}
	}
	
	@rsort($files);
	
	// Mehr Dateien vorhanden, als es laut config.php sein dürften? Dann weg damit :-)
	if($max_backup_files > 0)
	{
    	if (sizeof($files) > $max_backup_files)
    	{
			$out.="<font color=\"red\">".$l["fm_autodel1"]."<br>";
			for($n=sizeof($files)-1; $n>=$max_backup_files; $n--)
			{ 
	    		$delfile=substr($files[$n],13);
				$out.= $backup_path.$delfile."<br>";
				WriteLog("autodeleted (max)'$delfile'.");
	    		unlink($backup_path.$delfile); 
			}
			$out.= "</font>";
    	}
	}
	
	if($del_files_after_days>0) {
		//neu einlesen
		$dh = opendir($backup_path);
		$nowtime=strtotime("-".($del_files_after_days+1)." day");
		$zout="<font color=\"red\">".$l["fm_autodel2"]."<br>";
		$dfad=false;
		while (false !== ($filename = readdir($dh)))
		{
		    if ($filename != "." && $filename != "..") {
			 $z=substr($filename,strpos($filename,".")-2);
			 $z=substr($z,6,4)."-".substr($z,3,2)."-".substr($z,0,2);
			 if(strtotime($z)<$nowtime){
			 	$out.= $backup_path.$filename."<br>";
				WriteLog("autodeleted (days)'$delfile'.");
				unlink($backup_path.$filename); 
				$dfad=true;
			 }
			}
		}
		$zout.= "</font>";
		if($dfad) $out.=$outz;
	}
	
	return $out;
}

function WriteLog($aktion)
{
	global $log_file;
	//Zeile zusammensetzen
	$log=date("d.m.Y h:i:s").':  '.$aktion."\n";
	//Datei öffnen und schreiben
	$fp = fopen($log_file, "a+");
	fwrite ($fp,($log)); 
	fclose ($fp); 
}

function DeleteLog()
{
	global $log_file;
	//Datei öffnen und schreiben
	$log=date("d.m.Y h:i:s").": Log created.\n";
	$fp = fopen($log_file, "wb");
	fwrite ($fp,$log); 
	fclose ($fp); 
}

function WriteCronScript()
{

	global $nl, $config_path,$dbname,$dbname_a,$dbcronpraefix,$cron_samedb,
	$dbuser,$dbpass,$compression,$backup_path,$log_file,$rootdir,$cron_dbindex;
	
	if($cron_samedb==0) {
		$cron_dbname=$dbname; 
		$cron_dbpraefix = $dbpraefix; 
	}else {
		$cron_dbname=$dbname_a[$cron_dbindex];
		$cron_dbpraefix = $dbcronpraefix; 
	}
	
	$p1=$_SERVER["DOCUMENT_ROOT"].'/'.substr($rootdir,1).'/'.$backup_path;
	$p2=$_SERVER["DOCUMENT_ROOT"].'/'.substr($rootdir,1).'/'.$log_file;
	
	if(substr($p1,1,1)==":"){
		$p1=str_replace("/","\\\\",$p1);
		$p2=str_replace("/","\\\\",$p2);
	}
	
	
	$cronscript='#!/usr/bin/perl -w';
	$cronscript.='##################################################'.$nl; 
	$cronscript.='# MySQLDump CronDump'.$nl; 
	$cronscript.='# 2004, Steffen Kamper'.$nl; 
	$cronscript.='##################################################'.$nl; 
	$cronscript.='use DBI;'.$nl; 
	$cronscript.='use Compress::Zlib ;'.$nl; 
	$cronscript.='# Parameter'.$nl.$nl;
	
   	$cronscript.='my $dbname="'.$cron_dbname.'";'.$nl; 
	$cronscript.='my $dbpraefix="'.$dbcronpraefix.'";'.$nl; 
   	$cronscript.='my $dbuser="'.$dbuser.'";'.$nl; 
	$cronscript.='my $dbpass="'.$dbpass.'";'.$nl; 
	$cronscript.='my $compression='.$compression.';'.$nl; 
	$cronscript.='my $backup_path="'.$p1.'";'.$nl; 
	$cronscript.='my $logdatei="'.$p2.'";'.$nl.$nl;
	       
	$cronscript.='($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);'.$nl;
	$cronscript.='$Jahr+=1900;'.$nl;
	$cronscript.='my $CTIME_String = localtime(time);'.$nl;
	$cronscript.='$time_stamp=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr."_".sprintf("%02d",$Stunden)."_Uhr_".sprintf("%02d",$Minuten);'.$nl;
	$cronscript.='$sql_file=$backup_path.$dbname."_".$time_stamp."_crondump_perl.sql";'.$nl;
	$cronscript.='$sql_file_z=$backup_path.$dbname."_".$time_stamp."_crondump_perl.sql.gz";'.$nl;
	$cronscript.='$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".$Jahr." ". sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden).": ";'.$nl;
	$cronscript.='if($compression==0){$dt.="Start Perl Cron-Dump \'$sql_file\'\n";}else{$dt.="Start Perl Cron-Dump \'$sql_file_z\' \n";}'.$nl;
	$cronscript.='open(DATEI,">>$logdatei");'.$nl;
	$cronscript.='print DATEI $dt;'.$nl;
	$cronscript.='close(DATEI);'.$nl;
	$cronscript.='open(DATEI,">$sql_file");'.$nl;
	$cronscript.='print DATEI "";'.$nl;
	$cronscript.='close(DATEI);'.$nl;
	
	$cronscript.='# Verbindung mit mSQL herstellen, $dbh ist das Database Handle'.$nl;
	$cronscript.='my $dbh = DBI->connect("DBI:mysql:".$dbname,$dbuser,$dbpass)|| die   "Database connection not made: $DBI::errstr";'.$nl;
	$cronscript.='my $nl="\n";'.$nl;
	$cronscript.='my $next_sqlcommand="[n.!!e_w._!]";'.$nl;
	$cronscript.='my $sql_text="# Dump created on $CTIME_String by PERL Cron-Script\n";'.$nl;
	$cronscript.='$sql_text.="# Remember that you must use my restorescript in order to get a working DB\n";'.$nl;
	$cronscript.='$sql_text.="# because I use a special code to mark the end of a command.\n";'.$nl;
	$cronscript.='$sql_text.="# This is NOT compatible with other restorescripts!\n";'.$nl;
	$cronscript.='$sql_text.="# Anyway, have fun with this but use it at your own risk. :-)\n";'.$nl;
	$cronscript.='@tables=$dbh->tables;'.$nl;
	$cronscript.='foreach $tabelle (@tables) {'.$nl;
	$cronscript.='# definition auslesen'.$nl;
	$cronscript.='if($dbpraefix eq "" or ($dbpraefix ne "" && substr($tabelle,0,length($dbpraefix)) eq $dbpraefix)) {'.$nl;
	$cronscript.='$a="DROP TABLE IF EXISTS `".$tabelle."`;".$next_sqlcommand."\n";'.$nl;
	$cronscript.='$sql_text.=$a;'.$nl;
	$cronscript.='$sql_create="Show create table `".$tabelle."`";'.$nl;
	$cronscript.='$sth = $dbh->prepare($sql_create);'.$nl;
	$cronscript.='$sth->execute;'.$nl;
	$cronscript.='@ergebnis=$sth->fetchrow;'.$nl;
	$cronscript.='$sth->finish;'.$nl;
	$cronscript.='$a=$ergebnis[1].";".$next_sqlcommand."\n";'.$nl;
	$cronscript.='$sql_text.=$a;'.$nl;
	$cronscript.='# daten auslesen'.$nl;
	$cronscript.='$insert = "INSERT INTO `$tabelle` VALUES (";'.$nl;
	$cronscript.='$sql_daten="SELECT * FROM `".$tabelle."`";'.$nl;
	$cronscript.='$sth = $dbh->prepare($sql_daten);'.$nl;
	$cronscript.='$sth->execute;'.$nl;
	$cronscript.='while ( @ar=$sth->fetchrow)'.$nl;
	$cronscript.='{'.$nl;
	$cronscript.='$a=$insert;'.$nl;
	$cronscript.='foreach $inhalt(@ar)'.$nl;
	$cronscript.='{$a.= $dbh->quote($inhalt).", ";}'.$nl;
	$cronscript.='$a=substr($a,0, length($a)-2).");";'.$nl;
	$cronscript.='$sql_text.= $a.$next_sqlcommand."\n";'.$nl;
	$cronscript.='}#jetzt wegschreiben'.$nl;
	$cronscript.='if($compression==0){'.$nl;
	$cronscript.=' open(DATEI,">>$sql_file");'.$nl;
	$cronscript.=' print DATEI $sql_text;'.$nl;
	$cronscript.=' close(DATEI);'.$nl;
	$cronscript.='} else {'.$nl;
	$cronscript.='$gz = gzopen($sql_file_z, "wb") or die "Cannot open : $gzerrno\n" ;'.$nl;
	$cronscript.='$gz->gzwrite($sql_text) or die "error writing: $gzerrno\n" ;'.$nl;
	$cronscript.='$gz->gzclose ;'.$nl;
	$cronscript.='  } $sql_text="";'.$nl;
	$cronscript.='}}# Ende'.$nl;
	
	$cronscript.='($Sekunden, $Minuten, $Stunden, $Monatstag, $Monat, $Jahr, $Wochentag, $Jahrestag, $Sommerzeit) = localtime(time);'.$nl;
	$cronscript.='$Jahr+=1900;'.$nl;
	$cronscript.='$dt=sprintf("%02d",$Monatstag).".".sprintf("%02d",$Monat).".".sprintf("%02d",$Jahr)." ".sprintf("%02d",$Stunden).":".sprintf("%02d",$Minuten).":".sprintf("%02d",$Sekunden).": Perl Cron-Dump \'$sql_file\' finished.\n";'.$nl;
	
	$cronscript.='open(DATEI,">>$logdatei");'.$nl;
	$cronscript.='print DATEI $dt;'.$nl;
	$cronscript.='close(DATEI);'.$nl;
	$cronscript.='$dbh->disconnect();'.$nl;
	
	//Datei öffnen und schreiben 
	$ret=true;
	
	if ($fp=fopen($config_path."crondump.pl", "wb"))
	{ 
		if (!fwrite($fp,$cronscript)) $ret=false; 
		if (!fclose($fp)) $ret=false; 
	}
	
	else $ret=false;
	chmod($config_path."crondump.pl",0777);
	return $ret;
	
}
?>