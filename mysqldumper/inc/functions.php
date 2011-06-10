<?php
include_once('./inc/functions_global.php');
include_once('./inc/mysql.php');

function Help($ToolTip,$Anker,$imgsize=12)
{
	global $config;
	if($Anker!=""){
	return '<a href="language/'.$config['language'].'/help.php#'.$Anker.'" title="'.$ToolTip.'"><img src="'.$config['files']['iconpath'].'help16.gif" width="'.$imgsize.'" height="'.$imgsize.'" hspace="'.(round($imgsize/4,0)).'" vspace="0" border="0" alt="Help"></a>';
	} else {
	return '<img src="'.$config['files']['iconpath'].'help16.gif" width="'.$imgsize.'" height="'.$imgsize.'" alt="Help" title="'.$ToolTip.'" border="0" hspace="'.(round($imgsize/4,0)).'" vspace="0" >';
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
	global $config,$databases,$nl,$out,$lang,$preConfig;

	//Arrays löschen
   	$i=0;
	$databases['Name']=Array();

	$old_lang=isset($config['language']) && in_array($config['language'],$lang['languages']) ? $config['language'] : '';
	if($load_default==true)
	{
		if(file_exists($config['files']['parameter'])) @unlink($config['files']['parameter']);
		include("./config.php");
		if(is_array($preConfig)) {
			foreach($preConfig as $key=>$val) {$config[$key]=$val;}
		}

		if($old_lang!='') $config['language']=$old_lang;
		include("./language/".$config['language']."/lang.php");
	}

	//DB-Liste holen
   	MSD_mysql_connect();

	$create_statement='CREATE TABLE `mysqldumper_test_abcxyvfgh` (`test` varchar(200) default NULL, `id` bigint(20) unsigned NOT NULL auto_increment,'
  				.'PRIMARY KEY  (`id`)) TYPE=MyISAM;';

	$res = mysql_query("SHOW DATABASES ;",$config['dbconnection']);
	if (!$res===false)
	{
		$numrows=mysql_numrows($res);
		$a=0;
   		for($i=0;$i<$numrows;$i++)
		{
			$row = mysql_fetch_row($res);
			$found_db=$row[0];

			// Testverbindung - Tabelle erstellen, nachschauen, ob es geklappt hat und dann wieder löschen
			$use=@mysql_select_db($found_db);
			if ($use)
			{
				$res2=mysql_query("DROP TABLE IF EXISTS `mysqldumper_test_abcxyvfgh`",$config['dbconnection']);
				$res2=mysql_query($create_statement,$config['dbconnection']);
				if (!$res2===false)
				{
					$res2=mysql_query("DROP TABLE IF EXISTS `mysqldumper_test_abcxyvfgh`",$config['dbconnection']);

					if( isset($old_db) && $found_db==$old_db) $databases['db_selected_index']=$a;
					$databases['Name'][$a]=$found_db;
					$databases['praefix'][$a]="";
					$databases['command_before_dump'][$a] = "";
					$databases['command_after_dump'][$a] = "";
					$out.=$lang['saving_db_form']." ".$found_db." ".$lang['added']."$nl";
					$a++;
				}
			}
		}
		if(!isset($databases['db_selected_index']))
		{
			$databases['db_selected_index']=0;
			$databases['db_actual']=$databases['Name'][0];
		}
		$databases['db_actual_cronpraefix']="";
		$databases['db_actual_cronindex']=0;
	}

	WriteParams(1);
   	if($load_default===true) WriteLog("default settings loaded.");

	return $out;
}

function WriteParams($as=0)
{
   	global $config,$databases,$config_dontsave;
	$nl="\n";
	FillMultiDBArrays();
	check_manual_dbs();

	//Parameter zusammensetzen
	$config['multipart_groesse']=$config['multipartgroesse1']*(($config['multipartgroesse2']==1) ? 1024 : 1024*1024);
	$param=$pars_all='<?php '.$nl;
	if(!isset($config['email_maxsize'])) $config['email_maxsize']=$config['email_maxsize1']*(($config['email_maxsize2']==1) ? 1024 : 1024*1024);
	if(!isset($config['cron_execution_path'])) $config['cron_execution_path']="msd_cron/";
	if($as==0) $config['paths']['root']=addslashes(Realpfad("./"));
	foreach($config as $var => $val){
		if (!in_array($var,$config_dontsave))
		{
			if(is_array($val)) {
				foreach($val as $var2 => $val2){
					if ($config['magic_quotes_gpc']==0 || $as==1) {
						$pars_all.='$config[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'] = \''.addslashes($val2)."';$nl";
					} else {
						$pars_all.='$config[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'] = \''.$val2."';$nl";
					}
				}
			} else 	{
				if ($config['magic_quotes_gpc']==0 || $as==1) {
					if(!in_array($var,$config_dontsave)) $pars_all.='$config[\''.$var.'\'] = \''.addslashes($val)."';$nl";
				} else {
					if(!in_array($var,$config_dontsave)) $pars_all.='$config[\''.$var.'\'] = \''.$val."';$nl";
				}
			}
		}
	}
	foreach($databases as $var => $val){
		if(is_array($val)) {
			foreach($val as $var2 => $val2){
				if ($config['magic_quotes_gpc']==0 || $as==1) {
					$pars_all.='$databases[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'] = \''.addslashes($val2)."';$nl";
				} else {
					$pars_all.='$databases[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'] = \''.$val2."';$nl";
				}
			}
		} else 	{
			if ($config['magic_quotes_gpc']==0 || $as==1) {
				$pars_all.='$databases[\''.$var.'\'] = \''.addslashes($val)."';$nl";
			} else {
				$pars_all.='$databases[\''.$var.'\'] = \''.$val."';$nl";
			}
		}
	}



   $param.='?>'; $pars_all.='?>';

   //Datei öffnen und schreiben
	$ret=true;
	@chmod($config['files']['parameter'], 0777);
	if ($fp=fopen($config['files']['parameter'], "wb"))
	{
		if (!fwrite($fp,$pars_all)) $ret=false;
		if (!fclose($fp)) $ret=false;
	}
	else $ret=false;

	$ret=WriteCronScript();

	return $ret;
}

function escape_specialchars($text)
{
//	$tomask=Array('@'=>'\@','$'=>'\$','\\'=>'\\\\');
	$suchen=ARRAY('@','$','\\\\');
	$ersetzen=ARRAY('\@','\$','\\');
	$text=str_replace($suchen,$ersetzen,$text);
	return $text;
}

function WriteCronScript()
{

	global $nl, $config, $databases, $cron_save_all_dbs,
	$cron_db_array,$cron_dbpraefix_array,$cron_db_cbd_array,$cron_db_cad_array;

	if (!isset($databases['db_selected_index'])) $databases['db_selected_index']=0;
	if(!isset($databases['praefix'][$databases['db_selected_index']])) $databases['praefix'][$databases['db_selected_index']]="";
	if(!isset($databases['db_actual_cronindex'])) $databases['db_actual_cronindex']=$databases['db_selected_index'];
	if(!isset($config['email_maxsize'])) $config['email_maxsize']=$config['email_maxsize1']*(($config['email_maxsize2']==1) ? 1024 : 1024*1024);

	if($config['cron_samedb']==0)
	{
		$cron_dbname=(isset($databases['db_actual'])) ? $databases['db_actual']:0;
		$cron_dbpraefix = $databases['praefix'][$databases['db_selected_index']];
	}
	else
	{
		if($databases['db_actual_cronindex']>=0)
		{
			$cron_dbname=$databases['Name'][$databases['db_actual_cronindex']];
			$cron_dbpraefix = $databases['db_actual_cronpraefix'];

		}
		else
		{
			$cron_dbname=$databases['db_actual'];
			$cron_dbpraefix = $databases['praefix'][$databases['db_selected_index']];
		}
	}

	if($databases['db_actual_cronindex']=="-2")
	{
		$cron_save_all_dbs=1;
		$datenbanken=count($databases['Name']);
		$cron_db_array=str_replace(";","|",$databases['multisetting']);
		$cron_dbpraefix_array=str_replace(";","|",$databases['multisetting_praefix']);
		$cron_db_cbd_array=str_replace(";","|",$databases['multisetting_commandbeforedump']);
		$cron_db_cad_array=str_replace(";","|",$databases['multisetting_commandafterdump']);
	}

	if ($databases['db_actual_cronindex']=="-3")
	{
		$cron_save_all_dbs=1;
		$cron_db_array=implode("|",$databases['Name']);
		$cron_dbpraefix_array=implode("|",$databases['praefix']);
		$cron_db_cbd_array=implode("|",$databases['command_before_dump']);
		$cron_db_cad_array=implode("|",$databases['command_after_dump']);
	}

	if($databases['db_actual_cronindex']<0)
	{
		$csadb='$cron_save_all_dbs=1;'.$nl;
		$csadb.='$cron_db_array=qw('.$cron_db_array.');'.$nl;
		$csadb.='$cron_dbpraefix_array=qw('.$cron_dbpraefix_array.');'.$nl;
		$csadb.='$dbpraefix="";'.$nl;
		$csadb.='$command_beforedump_array="'.$cron_db_cbd_array.'";'.$nl;
		$csadb.='$command_afterdump_array="'.$cron_db_cad_array.'";'.$nl;
	}
	else
	{
		$csadb='$cron_save_all_dbs=0;'.$nl;
		$csadb.='$cron_db_array="";'.$nl;
		$csadb.='$cron_dbpraefix_array="";'.$nl;
		$csadb.='$dbpraefix="'.$cron_dbpraefix.'";'.$nl;
		if (!isset($databases['command_before_dump'][$databases['db_selected_index']])) $databases['command_before_dump'][$databases['db_selected_index']]='';
		$csadb.='$command_beforedump_array="'.$databases['command_before_dump'][$databases['db_selected_index']].'";'.$nl;
		if (!isset($databases['command_after_dump'][$databases['db_selected_index']])) $databases['command_after_dump'][$databases['db_selected_index']]='';
		$csadb.='$command_afterdump_array="'.$databases['command_after_dump'][$databases['db_selected_index']].'";'.$nl;
	}


	$r=str_replace("\\\\","/",$config['paths']['root']);
	$r=str_replace("@","\@",$r);
	$p1=$r.$config['paths']['backup'];
	$p2=$r.$config['files']['perllog'].(($config['logcompression']==1) ? '.gz':'');
	$p3=$r.$config['files']['perllogcomplete'].(($config['logcompression']==1) ? '.gz':'');

	// auf manchen Server wird statt 0 ein leerer String gespeichert -> fuehrt zu einem Syntax-Fehler
	// hier die entsprechenden Ja/Nein-Variablen sicherheitshalber in intvalues aendern
	$int_array=array('dbport','cron_compression','cron_printout','cron_mail','cron_mail_dump','multi_part',
				'multipart_groesse','email_maxsize','auto_delete','del_files_after_days',
				'del_files_after_days','max_backup_files','perlspeed','optimize_tables_beforedump',
				'logcompression','log_maxsize','backup_complete_inserts','backup_extended_inserts',
				'backup_delayed_inserts','backup_ignore_inserts','backup_lock_tables','cron_completelog');
	foreach ($int_array as $i)
	{
		$config[$i]=intval($config[$i]);
	}
	if ($config['dbport']==0) $config['dbport']=3306;

	$cronscript="<?php\n#Vars - written at ".date("Y-m-d").$nl;
	$cronscript.='$dbhost="'.$config['dbhost'].'";'.$nl;
	$cronscript.='$dbname="'.$cron_dbname.'";'.$nl;
   	$cronscript.='$dbuser="'.escape_specialchars($config['dbuser']).'";'.$nl;
	$cronscript.='$dbpass="'.escape_specialchars($config['dbpass']).'";'.$nl;
	$cronscript.='$dbport='.$config['dbport'].';'.$nl;
	$cronscript.=$csadb;
	$cronscript.='$compression='.$config['cron_compression'].';'.$nl;
	$cronscript.='$backup_path="'.$p1.'";'.$nl;
	$cronscript.='$logdatei="'.$p2.'";'.$nl;
	$cronscript.='$completelogdatei="'.$p3.'";'.$nl;
	$cronscript.='$sendmail_call="'.escape_specialchars($config['cron_sendmail']).'";'.$nl;
	$cronscript.='$nl="\n";'.$nl;
	$cronscript.='$cron_printout='.$config['cron_printout'].';'.$nl;
   	$cronscript.='$cronmail='.$config['cron_mail'].';'.$nl;
	$cronscript.='$cronmail_dump='.$config['cron_mail_dump'].';'.$nl;
	$cronscript.='$cronmailto="'.escape_specialchars($config['email_recipient']).'";'.$nl;
	$cronscript.='$cronmailfrom="'.escape_specialchars($config['email_sender']).'";'.$nl;
	$cronscript.='$cronftp='.$config['cron_ftp'].';'.$nl;
	$cronscript.='$ftp_server="'.$config['ftp_server'][$config['ftp_connectionindex']].'";'.$nl;
	$cronscript.='$ftp_port='.$config['ftp_port'][$config['ftp_connectionindex']].';'.$nl;
	$cronscript.='$ftp_mode='.intval($config['ftp_mode']).';'.$nl;
	$cronscript.='$ftp_user="'.escape_specialchars($config['ftp_user'][$config['ftp_connectionindex']]).'";'.$nl;
	$cronscript.='$ftp_pass="'.escape_specialchars($config['ftp_pass'][$config['ftp_connectionindex']]).'";'.$nl;
	$cronscript.='$ftp_dir="'.$config['ftp_dir'][$config['ftp_connectionindex']].'";'.$nl;
	$cronscript.='$mp='.$config['multi_part'].';'.$nl;
	$cronscript.='$multipart_groesse='.$config['multipart_groesse'].';'.$nl;
	$cronscript.='$email_maxsize='.$config['email_maxsize'].';'.$nl;
	$cronscript.='$auto_delete='.$config['auto_delete'].';'.$nl;
	$cronscript.='$cron_del_files_after_days='.$config['del_files_after_days'].';'.$nl;
	$cronscript.='$max_backup_files='.$config['max_backup_files'].';'.$nl;
	$cronscript.='$max_backup_files_each='.$config['max_backup_files_each'].';'.$nl;
	$cronscript.='$perlspeed='.$config['perlspeed'].';'.$nl;
	$cronscript.='$optimize_tables_beforedump='.$config['optimize_tables_beforedump'].';'.$nl;
	$cronscript.='$logcompression='.$config['logcompression'].';'.$nl;
	$cronscript.='$log_maxsize='.$config['log_maxsize'].';'.$nl;
	$cronscript.='$backup_complete_inserts='.$config['backup_complete_inserts'].';'.$nl;
	$cronscript.='$backup_extended_inserts='.$config['backup_extended_inserts'].';'.$nl;
	$cronscript.='$backup_delayed_inserts='.$config['backup_delayed_inserts'].';'.$nl;
	$cronscript.='$backup_ignore_inserts='.$config['backup_ignore_inserts'].';'.$nl;
	$cronscript.='$backup_lock_tables='.$config['backup_lock_tables'].';'.$nl;
	$cronscript.='$complete_log='.$config['cron_completelog'].';'.$nl;
	$cronscript.='$my_comment="";'.$nl;
	$cronscript.="1;\n?>";


	//Datei öffnen und schreiben
	$ret=true;



	$ext=($config['cron_extender']==0) ? "pl" : "cgi";

	$sfile=$config['paths']['config'].$config['cron_configurationfile'];
    if(substr($sfile,-5)=='.conf') {
        @unlink($sfile);
        $sfile.='.php';
    }
	if(file_exists($sfile)) @chmod("$sfile",0777);

	if ($fp=fopen($sfile, "wb"))
	{
		if (!fwrite($fp,$cronscript)) $ret=false;
		if (!fclose($fp)) $ret=false;
	}
	else $ret=false;

    if(file_exists($config['paths']['config']."mysqldumper.conf")) @unlink($config['paths']['config']."mysqldumper.conf");

	if(!file_exists($config['paths']['config']."mysqldumper.conf.php")) {
		$sfile=$config['paths']['config']."mysqldumper.conf.php";
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

	$l=Array();$sum=$s=$l['log_size']=$l['perllog_size']=$l['perllogcomplete_size']=$l['errorlog_size']=$l['log_totalsize']=0;
	if($logcompression==1) {
		$l['log']=$config['files']['log'].".gz";
		$l['perllog']=$config['files']['perllog'].".gz";
		$l['perllogcomplete']=$config['files']['perllogcomplete'].".gz";
		$l['errorlog']=$config['paths']['log']."error.log.gz";
	} else {
		$l['log']=$config['files']['log'];
		$l['perllog']=$config['files']['perllog'];
		$l['perllogcomplete']=$config['files']['perllogcomplete'];
		$l['errorlog']=$config['paths']['log']."error.log";
	}
	$l['log_size']+=@filesize($l['log']);$sum+=$l['log_size'];
	$l['perllog_size']+=@filesize($l['perllog']);$sum+=$l['perllog_size'];
	$l['perllogcomplete_size']+=@filesize($l['perllogcomplete']);$sum+=$l['perllogcomplete_size'];
	$l['errorlog_size']+=@filesize($l['errorlog']);$sum+=$l['errorlog_size'];
	$l['log_totalsize']+=$sum;


	return $l;
}

function DeleteLog()
{
	global $config;
	//Datei öffnen und schreiben
	$log=date('d.m.Y H:i:s')." Log created.\n";
	if($config['logcompression']==1) {
		$fp = @gzopen($config['files']['log'].'.gz', "wb");
		@gzwrite ($fp,$log);
		@gzclose ($fp);
		@chmod($config['files']['log'].'.gz',0755);
	} else {
		$fp = @fopen($config['files']['log'], "wb");
		@fwrite ($fp,$log);
		@fclose ($fp);
		@chmod($config['files']['log'],0755);
	}
}

function SwitchLogfileFormat()
{
	global $config;
	$del=DeleteFilesM($config['paths']['log'],"*");
	DeleteLog();
}


function CreateDirsFTP() {

	global $config,$lang,$install_ftp_server,$install_ftp_port,$install_ftp_user_name,$install_ftp_user_pass,$install_ftp_path;
	// Herstellen der Basis-Verbindung
	 echo '<hr>'.$lang['connect_to'].' `'.$install_ftp_server.'` Port '.$install_ftp_port.' ...<br>';
    $conn_id = ftp_connect($install_ftp_server);
    // Einloggen mit Benutzername und Kennwort
    $login_result = ftp_login($conn_id, $install_ftp_user_name, $install_ftp_user_pass);
    // Verbindung überprüfen
    if ((!$conn_id) || (!$login_result)) {
            echo $lang['ftp_notconnected'];
            echo $lang['connwith']." $tinstall_ftp_server ".$lang['asuser']." $install_ftp_user_name ".$lang['notpossible'];
            return 0;
    } else {
		if ($config['ftp_mode']==1) ftp_pasv($conn_id,true);
		//Wechsel in betroffenes Verzeichnis
		echo $lang['changedir'].' `'.$install_ftp_path.'` ...<br>';
	    ftp_chdir($conn_id,$install_ftp_path);
		// Erstellen der Verzeichnisse
		echo $lang['dircr1'].' ...<br>';
	    ftp_mkdir($conn_id,"work");
	    ftp_site($conn_id, "CHMOD 0777 work");
		echo $lang['changedir'].' `work` ...<br>';
		ftp_chdir($conn_id,"work");
		echo $lang['indir'].' `'.ftp_pwd($conn_id).'`<br>';
		echo $lang['dircr5'].' ...<br>';
		ftp_mkdir($conn_id,"config");
	    ftp_site($conn_id, "CHMOD 0777 config");
		echo $lang['dircr2'].' ...<br>';
		ftp_mkdir($conn_id,"backup");
	    ftp_site($conn_id, "CHMOD 0777 backup");
		echo $lang['dircr3'].' ...<br>';
		ftp_mkdir($conn_id,"structure");
	    ftp_site($conn_id, "CHMOD 0777 structure");
		echo $lang['dircr4'].' ...<br>';
		ftp_mkdir($conn_id,"log");
	    ftp_site($conn_id, "CHMOD 0777 log");

	    // Schließen des FTP-Streams
	    ftp_quit($conn_id);
		return 1;
	}
}

function ftp_mkdirs($config,$dirname)
{
   $dir=split("/", $dirname);
   for ($i=0;$i<count($dir)-1;$i++)
   {
       $path.=$dir[$i]."/";
       @ftp_mkdir($config['dbconnection'],$path);
   }
   if (@ftp_mkdir($config['dbconnection'],$dirname))
       return 1;
}

function IsWritable($dir)
{
	$testfile=$dir . "/.writetest";
	if ($writable = @fopen ($testfile, 'w')) {
    	@fclose ($writable);
    	@unlink ($testfile);
    }
	return $writable;
}

function SearchDatabases($printout)
{
	global $databases,$config,$lang;

	if(!isset($config['dbconnection'])) MSD_mysql_connect();
	$db_list = array();
	$show_dbs=mysql_query("SHOW DATABASES",$config['dbconnection']);
	if (!$show_dbs===false)
	{
		WHILE ($row=mysql_fetch_row($show_dbs))
		{
			$db_list[]=$row[0];
		}
	}

	$databases['db_selected_index'] = 0;
	for ($i=0;$i<sizeof($db_list);$i++)
	{
		// Test-Select um zu sehen, ob Berechtigungen existieren
	    if(!@mysql_query("SHOW TABLES FROM `".$db_list[$i]."`",$config['dbconnection'])===false)
		{
			$databases['Name'][$i]=$row[0];
			$databases['praefix'][$i] = '';
			$databases['command_before_dump'][$i] = '';
			$databases['command_after_dump'][$i] = '';

			if($printout==1) echo $lang['found_db'].' `'.$db_list[$i].'`<br />';
		}
	}
	if (isset($databases['Name'][0])) $databases['db_actual']=$databases['Name'][0];
}

// removes tags from inputs recursivly
function my_strip_tags($value)
{
	$ret='';
	if (is_array($value))
	{
		foreach ($value as $key=>$val)
		{
			$$key=my_strip_tags($val);
		}
	}
	else $ret=trim(strip_tags($value));
	return $ret;
}

?>