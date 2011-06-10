<?php

include_once("inc/functions_global.php");
include_once("inc/mysql.php");

function Help($ToolTip,$Anker,$imgsize=12)
{
	global $config;
	if($Anker!=""){
	return '<a href="language/'.$config["language"].'/help.php#'.$Anker.'" titel="'.$ToolTip.'"><img src="images/help16.gif" width="'.$imgsize.'" height="'.$imgsize.'" hspace="'.($imgsize/4).'" vspace="0" border="0"></a>';
	} else {
	return '<img src="images/help16.gif" width="'.$imgsize.'" height="'.$imgsize.'" alt="Help" title="'.$ToolTip.'" border="0" hspace="'.($imgsize/4).'" vspace="0">';
	}
}

function DeleteFilesM($dir, $pattern = "*.*")
{   
 	$deleted = false;
	$pattern = str_replace(array("\*","\?"), array(".*","."), preg_quote($pattern));
	if (substr($dir,-1) != "/") $dir.= "/";
	if (is_dir($dir))
	{    $d = opendir($dir);
	    while ($file = readdir($d))
	    {    if (is_file($dir.$file) && ereg("^".$pattern."$", $file))
	        {    
				if (unlink($dir.$file))    $deleted[] = $file;
	        }
	    }
	    closedir($d);
	    return $deleted;
	}
	else return 0; 
}

function SetDefault($load_default=false)
{
	global $config,$databases,$nl,$out,$lang;

	//Arrays löschen
   	$i=0;
	$old_db=$databases["db_actual"];
	//unset($databases);
	$databases["Name"]=Array();
	
	$old_lang=$config["language"];
	
	if($load_default==true){	
		@unlink($config["files"]["parameter"]);
		include("./config.php"); 
		$config["language"]=$old_lang;
		include("language/".$config["language"]."/lang.php"); 
	}
	
	//DB-Liste holen
   	MSD_mysql_connect(); 
	
   	$databases["db_selected_index"]=-1;
	if($config["dbonly"]!="") {
		if(mysql_select_db($config["dbonly"],$config["dbconnection"])) {
		$databases["db_actual"]=$config["dbonly"];
		$databases["Name"][0]=$config["dbonly"];
		$databases["db_selected_index"]=0;
		$databases["praefix"][0]="";
		$databases["command_before_dump"][0] = "";
		$databases["command_after_dump"][0] = "";
	} else die(SQLError("Datenbankverbindung","Datenbank ".$config["dbonly"]." existiert nicht !")); 
	} else {
		$res = mysql_query("SHOW DATABASES ;",$config["dbconnection"]); 
		$numrows=mysql_numrows($res);
	   	for($i=0;$i<$numrows;$i++) {
			$row = mysql_fetch_row($res);
			$found_db=$row[0];
			//echo "found `$found_db`<br>";
			if($found_db==$old_db) $databases["db_selected_index"]=$i;
			$databases["Name"][$i]=$found_db;
			$databases["praefix"][$i]="";
			$databases["command_before_dump"][$i] = "";
			$databases["command_after_dump"][$i] = "";
			
			$out.=$lang['saving_db_form']." ".$found_db." ".$lang["added"]."$nl";
			
			
	   	}	
		
	}
	if($databases["db_selected_index"]==-1) {
		$databases["db_selected_index"]=0;
		$databases["db_actual"]=$databases["Name"][$databases["db_selected_index"]];
	} else $databases["db_actual"]=$databases["Name"][$databases["db_selected_index"]];
	$databases["db_actual_cronpraefix"]="";
	$databases["db_actual_cronindex"]=$databases["db_selected_index"];
	
	WriteParams(1,$config,$databases);
   	if($load_default==false) WriteLog("default settings loaded.");
		
	return $out;
}

function WriteParams($as=0,$config,$databases) 
{ 
   	$nl="\n";
	FillMultiDBArrays();
	//Parameter zusammensetzen 
	$config["multipart_groesse"]=$config["multipartgroesse1"]*(($config["multipartgroesse2"]==1) ? 1024 : 1024*1024);
	$param=$pars_all='<?php '.$nl; 
	if(!isset($config["email_maxsize"])) $config["email_maxsize"]=$config["email_maxsize1"]*(($config["email_maxsize2"]==1) ? 1024 : 1024*1024);
	if(!isset($config["cron_execution_path"])) $config["cron_execution_path"]="msd_cron/";
	if($as==0) $config["paths"]["root"]=addslashes(Realpfad("./")); 
	foreach($config as $var => $val){ 
		if(is_array($val)) {
			foreach($val as $var2 => $val2){
				if ($config["magic_quotes_gpc"]==0 || $as==1) {
					$pars_all.='$config["'."$var\"][".((is_int($var2)) ? $var2 : '"'.$var2.'"')."] = \"".addslashes($val2)."\";$nl";
				} else {
					$pars_all.='$config["'."$var\"][".((is_int($var2)) ? $var2 : '"'.$var2.'"')."] = \"$val2\";$nl";
				}
			}
		} else 	{
			if ($config["magic_quotes_gpc"]==0 || $as==1) {
				if($var != "dbconnection" && $var != "version" && $var != "ram") $pars_all.='$config["'."$var\"] = \"".addslashes($val)."\";$nl";
			} else {
				if($var != "dbconnection" && $var != "version" && $var != "ram") $pars_all.='$config["'."$var\"] = \"$val\";$nl";
			}
		}
	}
	foreach($databases as $var => $val){ 
		if(is_array($val)) {
			foreach($val as $var2 => $val2){
				if ($config["magic_quotes_gpc"]==0 || $as==1) {
					$pars_all.='$databases["'."$var\"][".((is_int($var2)) ? $var2 : '"'.$var2.'"')."] = \"".addslashes($val2)."\";$nl";
				} else {
					$pars_all.='$databases["'."$var\"][".((is_int($var2)) ? $var2 : '"'.$var2.'"')."] = \"$val2\";$nl";
				}
			}
		} else 	{
			if ($config["magic_quotes_gpc"]==0 || $as==1) {
				$pars_all.='$databases["'."$var\"] = \"".addslashes($val)."\";$nl";
			} else {
				$pars_all.='$databases["'."$var\"] = \"$val\";$nl";
			}
		}
	}
	
	 
	
   $param.='?>'; $pars_all.='?>'; 
     	
   //Datei öffnen und schreiben 
	$ret=true;
	@chmod($config["files"]["parameter"], 0777);
	if ($fp=fopen($config["files"]["parameter"], "wb"))
	{ 
		if (!fwrite($fp,$pars_all)) $ret=false; 
		if (!fclose($fp)) $ret=false; 
	}
	else $ret=false;
	
	$ret=WriteCronScript($config,$databases);
	
	return $ret;
} 

function WriteCronScript($config,$databases)
{
	global $nl, $cron_save_all_dbs,
	$cron_db_array,$cron_dbpraefix_array,$cron_db_cbd_array,$cron_db_cad_array;
	
	if(!isset($databases["praefix"][$databases["db_selected_index"]])) $databases["praefix"][$databases["db_selected_index"]]="";
	if(!isset($databases["db_actual_cronindex"])) $databases["db_actual_cronindex"]=$databases["db_selected_index"];
	if(!isset($config["email_maxsize"])) $config["email_maxsize"]=$config["email_maxsize1"]*(($config["email_maxsize2"]==1) ? 1024 : 1024*1024);
	
	if($config["cron_samedb"]==0) {
		$cron_dbname=$databases["db_actual"]; 
		$cron_dbpraefix = $databases["praefix"][$databases["db_selected_index"]]; 
	}else {
		if($databases["db_actual_cronindex"]>=0) {
			$cron_dbname=$databases["Name"][$databases["db_actual_cronindex"]];
			$cron_dbpraefix = $databases["db_actual_cronpraefix"]; 
			
		} else {
			$cron_dbname=$databases["db_actual"]; 
			$cron_dbpraefix = $databases["praefix"][$databases["db_selected_index"]]; 
		}
	}
	if($cron_save_all_dbs>0) {
		$csadb='$cron_save_all_dbs=1;'.$nl;
		$csadb.='$cron_db_array=qw('.$cron_db_array.');'.$nl;
		$csadb.='$cron_dbpraefix_array=qw('.$cron_dbpraefix_array.');'.$nl;
		$csadb.='$dbpraefix="";'.$nl; 
		$csadb.='$command_beforedump_array="'.$cron_db_cbd_array.'";'.$nl;
		$csadb.='$command_afterdump_array="'.$cron_db_cad_array.'";'.$nl;
	} else {
		$csadb='$cron_save_all_dbs=0;'.$nl;
		$csadb.='$cron_db_array="";'.$nl;
		$csadb.='$cron_dbpraefix_array="";'.$nl;
		$csadb.='$dbpraefix="'.$cron_dbpraefix.'";'.$nl; 
		$csadb.='$command_beforedump_array="'.$databases["command_before_dump"][$databases["db_selected_index"]].'";'.$nl;
		$csadb.='$command_afterdump_array="'.$databases["command_after_dump"][$databases["db_selected_index"]].'";'.$nl;
	}
	
	
	$r=str_replace("\\\\","/",$config["paths"]["root"]);
	$p1=$r.$config["paths"]["backup"];
	$p2=$r.$config["files"]["perllog"].(($config["logcompression"]==1) ? '.gz':'');
	$p3=$r.$config["files"]["perllogcomplete"].(($config["logcompression"]==1) ? '.gz':'');
	//$pcp=str_replace("\\\\","/",$config["cron_perlpath"]);
	
	
	
	$cronscript="#Vars - written at ".date("Y-m-d").$nl;
	$cronscript.='$dbhost="'.$config["dbhost"].'";'.$nl; 
	$cronscript.='$dbname="'.$cron_dbname.'";'.$nl; 
   	$cronscript.='$dbuser="'.$config["dbuser"].'";'.$nl; 
	$cronscript.='$dbpass="'.$config["dbpass"].'";'.$nl; 
	$cronscript.=$csadb;
	$cronscript.='$compression='.$config["cron_compression"].';'.$nl; 
	$cronscript.='$backup_path="'.$p1.'";'.$nl; 
	$cronscript.='$logdatei="'.$p2.'";'.$nl;
	$cronscript.='$completelogdatei="'.$p3.'";'.$nl;
	$cronscript.='$nl="\n";'.$nl;
	$cronscript.='$cron_printout='.$config["cron_printout"].';'.$nl;
   	$cronscript.='$cronmail='.$config["cron_mail"].';'.$nl;
	$cronscript.='$cronmail_dump='.$config["cron_mail_dump"].';'.$nl;
	$cronscript.='$cronmailto="'.str_replace("@","\@",$config["email_recipient"]).'";'.$nl; 
	$cronscript.='$cronmailfrom="'.str_replace("@","\@",$config["email_sender"]).'";'.$nl;
	$cronscript.='$cronftp='.$config["cron_ftp"].';'.$nl;
	$cronscript.='$ftp_server="'.$config["ftp_server"][$config["ftp_connectionindex"]].'";'.$nl;
	$cronscript.='$ftp_port='.$config["ftp_port"][$config["ftp_connectionindex"]].';'.$nl;
	$cronscript.='$ftp_user="'.$config["ftp_user"][$config["ftp_connectionindex"]].'";'.$nl;
	$cronscript.='$ftp_pass="'.$config["ftp_pass"][$config["ftp_connectionindex"]].'";'.$nl;
	$cronscript.='$ftp_dir="'.$config["ftp_dir"][$config["ftp_connectionindex"]].'";'.$nl;
	$cronscript.='$mp='.$config["multi_part"].';'.$nl;
	$cronscript.='$multipart_groesse='.$config["multipart_groesse"].';'.$nl;
	$cronscript.='$email_maxsize='.$config["email_maxsize"].';'.$nl;
	$cronscript.='$auto_delete='.$config["auto_delete"].';'.$nl;
	$cronscript.='$cron_del_files_after_days='.$config["del_files_after_days"].';'.$nl;
	$cronscript.='$max_backup_files='.$config["max_backup_files"].';'.$nl;
	$cronscript.='$max_backup_files_each='.$config["max_backup_files_each"].';'.$nl;
	$cronscript.='$perlspeed='.$config["perlspeed"].';'.$nl;
	$cronscript.='$optimize_tables_beforedump='.$config["optimize_tables_beforedump"].';'.$nl;
	$cronscript.='$logcompression='.$config["logcompression"].';'.$nl;
	$cronscript.='$log_maxsize='.$config["log_maxsize"].';'.$nl;
	$cronscript.='$backup_complete_inserts='.$config["backup_complete_inserts"].';'.$nl;
	$cronscript.='$backup_extended_inserts='.$config["backup_extended_inserts"].';'.$nl;
	$cronscript.='$backup_delayed_inserts='.$config["backup_delayed_inserts"].';'.$nl;
	$cronscript.='$backup_ignore_inserts='.$config["backup_ignore_inserts"].';'.$nl;
	$cronscript.='$backup_lock_tables='.$config["backup_lock_tables"].';'.$nl;
	$cronscript.='$complete_log='.$config["cron_completelog"].';'.$nl;
	$cronscript.='1;';
	
		
	//Datei öffnen und schreiben 
	$ret=true;
	
	
	
	$ext=($config["cron_extender"]==0) ? "pl" : "cgi";
	
	$sfile=$config["paths"]["config"].$config["cron_configurationfile"];
	
	@chmod("$sfile",0777);
	if ($fp=fopen($sfile, "wb"))
	{ 
		if (!fwrite($fp,$cronscript)) $ret=false; 
		if (!fclose($fp)) $ret=false; 
	}
	else $ret=false;
	
	if(!file_exists($config["paths"]["config"]."mysqldumper.conf")) {
		$sfile=$config["paths"]["config"]."mysqldumper.conf";
		if ($fp=fopen($sfile, "wb"))
		{ 
			if (!fwrite($fp,$cronscript)) $ret=false; 
			if (!fclose($fp)) $ret=false; 
			//chmod("$sfile",0755);
		}
		else $ret=false;
	}
	return $ret;
	
}

function LogFileInfo($logcompression) {
	global $config;
	
	$l=Array();$sum=$s=$l["log_size"]=$l["perllog_size"]=$l["perllogcomplete_size"]=$l["errorlog_size"]=$l["log_totalsize"]=0;
	if($logcompression==1) {
		$l["log"]=$config["files"]["log"].".gz";
		$l["perllog"]=$config["files"]["perllog"].".gz";
		$l["perllogcomplete"]=$config["files"]["perllogcomplete"].".gz";
		$l["errorlog"]=$config["paths"]["log"]."error.log.gz";
	} else {
		$l["log"]=$config["files"]["log"];
		$l["perllog"]=$config["files"]["perllog"];
		$l["perllogcomplete"]=$config["files"]["perllogcomplete"];
		$l["errorlog"]=$config["paths"]["log"]."error.log";
	}
	$l["log_size"]+=@filesize($l["log"]);$sum+=$l["log_size"];
	$l["perllog_size"]+=@filesize($l["perllog"]);$sum+=$l["perllog_size"];
	$l["perllogcomplete_size"]+=@filesize($l["perllogcomplete"]);$sum+=$l["perllogcomplete_size"];
	$l["errorlog_size"]+=@filesize($l["errorlog"]);$sum+=$l["errorlog_size"];
	$l["log_totalsize"]+=$sum;
	
		
	return $l;
}

function DeleteLog()
{
	global $config;
	//Datei öffnen und schreiben
	$log=date("d.m.Y h:i:s").": Log created.\n";
	if($config["logcompression"]==1) {
		$fp = @gzopen($config["files"]["log"].'.gz', "wb");
		@gzwrite ($fp,$log); 
		@gzclose ($fp);
		@chmod($config["files"]["log"].'.gz',0755); 
	} else {
		$fp = @fopen($config["files"]["log"], "wb");
		@fwrite ($fp,$log); 
		@fclose ($fp);
		@chmod($config["files"]["log"],0755); 
	}
}

function SwitchLogfileFormat()
{
	global $config;
	$del=DeleteFilesM($config["paths"]["log"],"*");
	DeleteLog();
}

function SYS_editor($dir=0,$fname="")
{
	global $dirs;
	$f=$text="";$i=0;
	$ref='filemanagement.php?action=files&svice=1&sysfedit=1';
	
	if($dir>0 && $fname=="") {
		$dirname=$dirs[$dir];
		$dh = opendir($dirname);
		while (false !== ($filename = readdir($dh)))
		{
	    	if ($filename != "." && $filename != ".." && !is_dir($dirname.$filename)) 
				$f.='<a '.((is_writable($filename)) ? '' : 'class="swarnung"').' href="'.$ref.'&dir='.$dir.'&filename='.$filename.'">'.$filename.'</a>&nbsp;&nbsp;&nbsp;';
				$i++;if(($i % 4)==1) $f.='<br>';
		}
	} elseif($dir>0 && $fname!="") {
		$dirname=$dirs[$dir];
		$text=implode("",file($dirname.$fname));
	}
		
	
	$r='<form action="'.$ref.'" method="post"><table border="1" rules="rows"><tr><td class="hd" colspan="2">Files in&nbsp;&nbsp;';
	$r.='<a href="'.$ref.'&dir=1">./</a>&nbsp;&nbsp;&nbsp;';
	$r.='<a href="'.$ref.'&dir=2">inc</a>&nbsp;&nbsp;&nbsp;';
	$r.='<a href="'.$ref.'&dir=3">msd_cron</a>&nbsp;&nbsp;&nbsp;';
	$r.='<a href="'.$ref.'&dir=4">language</a>&nbsp;&nbsp;&nbsp;';
	$r.='<a href="'.$ref.'&dir=5">config</a>&nbsp;&nbsp;&nbsp;';
	$r.='</td></tr>'.((!empty($f)) ? '<tr><td colspan="2">'.$f.'</td></tr>' : '');
	if($fname!="") $r.='<tr><td colspan="2" class="hd" align="center"><strong>File `'.$fname.'`</strong></td></tr>';
	$r.='<tr><td><input type="reset" name="rest" value=" reset "></td><td><input type="submit" name="fedit_save" value=" save "></tr>';
	$r.='<tr><td colspan="2" align="center"><input type="hidden" name="edit_filename" value="'.$fname.'"><input type="hidden" name="dir" value="'.$dir.'">';
	
	$r.='<textarea name="editor" style="width:740px;height:500px;overflow:auto;">'.$text.'</textarea></td></tr></table></form>';
	
	return $r;
}
?>