<?php
include_once('./inc/runtime.php');

function get_page_parameter($parameter,$ziel='dump')
{
	$page_parameter='<form action="'.$ziel.'.php" method="POST" name="'.$ziel.'">'."\n";
	foreach ($parameter As $key=>$val)
	{
		$page_parameter.='<input type="hidden" name="'.$key.'" value="'.$val.'">'."\n";
	}
	$page_parameter.='</form>';
	return $page_parameter;
}

function mu_sort ($array, $key_sort) 
{
	$key_sorta = explode(",", $key_sort); 
	$keys = array_keys($array[0]);
	$n=0;

	for($m=0; $m < count($key_sorta); $m++) { $nkeys[$m] = trim($key_sorta[$m]); }
	$n += count($key_sorta);    // counter used inside loop
    
    for($i=0; $i < count($keys); $i++)
	{
        if(!in_array($keys[$i], $key_sorta))
		{
             $nkeys[$n] = $keys[$i];
             $n += "1"; 
		}
     }
	for($u=0;$u<count($array); $u++)
	{
		$arr = $array[$u];
        for ($s=0; $s<count($nkeys); $s++)
		{
            $k = $nkeys[$s];
            $output[$u][$k] = $array[$u][$k]; 
		}
	}
	// wenn die Sortierung nicht ab- sondern aufsteigend sein soll, muss sort() benutzt werden
	sort($output); // Sort=Aufsteigend -> oder rsort=absteigend
	return $output;
}

function FillMultiDBArrays()
{
	global $config,$databases;
	
	$databases['multi']=Array();
	$databases['multi_praefix']=Array();
	if(!isset($databases['db_selected_index'])) $databases['db_selected_index']=0;
	if(!isset($databases['db_actual']) && isset($databases['Name'])) $databases['db_actual']=$databases['Name'][$databases['db_selected_index']];
	if(!isset($databases['multisetting'])) $databases['multisetting']='';
	
	if($config['multi_dump']==1) 
	{
		if($databases['multisetting']=='')
		{
			$databases['multi'][0]=$databases['db_actual'];
			$databases['multi_praefix'][0]=(isset($databases['praefix'][0])) ? $databases['praefix'][0] : '';
		} 
		else 
		{	
			$databases['multi']=explode(';',$databases['multisetting']);
			$flipped = array_flip($databases['Name']);
			for($i=0;$i<count($databases['multi']);$i++) 
			{
				$ind=$flipped[$databases['multi'][$i]]; 
				$databases['multi_praefix'][$i]=(isset($databases['praefix'][$ind])) ? $databases['praefix'][$ind] : '';
			}
		}
		
	} 
	else  
	{
		$databases['multi'][0]=(isset($databases['db_actual'])) ? $databases['db_actual'] : '';
		$databases['multi_praefix'][0]=(isset($databases['praefix'])) ? $databases['praefix'][$databases['db_selected_index']] : '';
	}
}

function DBDetailInfo($index) 
{
	global $databases,$config;
	
	$databases['Detailinfo']['tables']=$databases['Detailinfo']['records']=$databases['Detailinfo']['size']=0;
	MSD_mysql_connect(); 
	mysql_select_db($databases['Name'][$index]);
	$databases['Detailinfo']['Name']=$databases['Name'][$index];
	$res=@mysql_query('SHOW TABLE STATUS FROM `'.$databases['Name'][$index].'`');
	if($res) $databases['Detailinfo']['tables']=mysql_num_rows($res);
	if($databases['Detailinfo']['tables']>0) {
		$s1=$s2=0;
		for ($i = 0; $i < $databases['Detailinfo']['tables']; $i++)
		{
	    	$row = mysql_fetch_array($res);
			$s1+=$row['Rows'];
			$s2+=$row['Data_length']+$row['Index_length'];
		}
		$databases['Detailinfo']['records']=$s1;
		$databases['Detailinfo']['size']=$s2;
	} 
}

//Globale Funktionen
function br($m=1)
{
	//gibt m Zeilenumbrüche zurück
	return str_repeat("\n",$m);
}
function Stringformat($s,$count)
{
	if($count>=strlen($s)) 
		return str_repeat("0",$count-strlen($s)).$s;
	else
		return $s;
}
function getmicrotime()
{
   list($usec, $sec) = explode(" ",microtime()); 
   return ((float)$usec + (float)$sec); 
}
function MD_FreeDiskSpace()
{
	global $lang;
	$dfs=@diskfreespace("../");
	return ($dfs) ? byte_output($dfs) : $lang['notavail'];
}

function WriteDynamicText($txt,$object)
{
	return '<script language="JavaScript">WP("'.addslashes($txt).','.$object.'");</script>';
}

function byte_output($bytes, $precision = 2, $names = Array())
{
   if (!is_numeric($bytes) || $bytes < 0) {
       return false;
   }
   for ($level = 0; $bytes >= 1024; $level++) {
       $bytes /= 1024;
   }
   switch ($level)
   {
       case 0:
           $suffix = (isset($names[0])) ? $names[0] : 'Bytes';
           break;
       case 1:
           $suffix = (isset($names[1])) ? $names[1] : 'KB';
           break;
       case 2:
           $suffix = (isset($names[2])) ? $names[2] : 'MB';
           break;
       case 3:
           $suffix = (isset($names[3])) ? $names[3] : 'GB';
           break;
       case 4:
           $suffix = (isset($names[4])) ? $names[4] : 'TB';
           break;
       default:
           $suffix = (isset($names[$level])) ? $names[$level] : '';
           break;
   }
   return round($bytes, $precision) . ' ' . $suffix;
}

function ExtractDBname($s)
{
	if(strpos(strtolower($s),"_structure_file")>0){
		return substr($s,0,strpos(strtolower($s),"_structure_file"));
		break;
	}
	$sp=explode('_',$s);
	$anz=count($sp)-1;
	$r=0;
	if($anz>4) {
	$df=5; //Datumsfelder
	if($sp[$anz-1]=='part') $df+=2;
	if($sp[$anz-3]=='crondump' || $sp[$anz-1]=='crondump') $df+=2;
	$anz=$anz-$df; //Datum weg
	for($i=0;$i<=$anz;$i++){ $r+=strlen($sp[$i])+1;}
	return substr($s,0,$r-1);
	} else {
	//Fremdformat
		return substr($s,0,strpos($s,'.'));
	}
}
function ExtractBUT($s)
{
	$i=strpos(strtolower($s),"part");
	if($i>0) $s=substr($s,0,$i-1);
	$i=strpos(strtolower($s),"crondump");
	if($i>0) $s=substr($s,0,$i-1);
	$i=strpos(strtolower($s),".sql");
	if($i>0) $s=substr($s,0,$i);
	$sp=explode("_",$s);
	$anz=count($sp)-1;
	if($anz>4) {
		return $sp[$anz-2].".".$sp[$anz-3].".".$sp[$anz-4]." ".$sp[$anz-1].":".$sp[$anz];
	} else {
	//Fremdformat
		return "";
	}
}

function WriteLog($aktion)
{
	global $config,$lang;
	$log=date('d.m.Y H:i:s').' '.$aktion."\n";
	
	$logfile=($config['logcompression']==1) ? $config['files']['log'].'.gz' : $config['files']['log'];
	if(@filesize($logfile)+strlen($log)>$config['log_maxsize']) @unlink($logfile);
	
	//Datei öffnen und schreiben
	if($config['logcompression']==1) {
		
		$fp = @gzopen($logfile, 'a');
		if($fp) {
			@gzwrite ($fp,$log) .'<br>';
			@gzclose ($fp);
		} else echo '<p class="warnung">'.$lang['logfilenotwritable'].' ('.$logfile.')</p>';
	} else {
		$fp = @fopen($logfile, "ab");
		if($fp) {
			@fwrite ($fp,$log);
			@fclose ($fp);
		} else echo '<p class="warnung">'.$lang['logfilenotwritable'].' ('.$logfile.')</p>';
	}
}

function WritePageParams($aktion)
{
	global $config,$restore,$dump,$nl;
	
	$pars="<?$nl";
	if($aktion=="dump") {
		$datei="dump.tmp";
		foreach($dump as $var => $val){ 
			if(is_array($val)) {
				foreach($val as $var2 => $val2){
					if ($config['magic_quotes_gpc']==0) {
						$pars.='$dump[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'\'] = "'.addslashes($val2)."\";$nl";
					} else {
						$pars.='$dump[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'\'] = "'.$val2."\";$nl";
					}
				}
			} else 	{
				if ($config['magic_quotes_gpc']==0) {
					$pars.='$dump[\''.$var.'\'] = "'.addslashes($val)."\";$nl";
				} else {
					$pars.='$dump[\''.$var.'\'] = "'.$val."\";$nl";
				}
			}
		}
	} elseif($aktion=="restore") {
		$datei="restore.tmp";
		foreach($restore as $var => $val){ 
			if(is_array($val)) {
				foreach($val as $var2 => $val2){
					if ($config['magic_quotes_gpc']==0) {
						$pars.='$restore[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'\'] = "'.addslashes($val2)."\";$nl";
					} else {
						$pars.='$restore[\''.$var.'\']['.((is_int($var2)) ? $var2 : "'".$var2."'").'] = "'.$val2."\";$nl";
					}
				}
			} else 	{
				if ($config['magic_quotes_gpc']==0) {
					$pars.='$restore[\''.$var.'\'] = "'.addslashes($val)."\";$nl";
				} else {
					$pars.='$restore[\''.$var.'\'] = "'.$val."\";$nl";
				}
			}
		}
	}
	$pars.="$nl?>";
	$fp = @fopen($config['paths']['log'].$datei, "w");
	
	if($fp) {
		@fwrite ($fp,$pars."\n");
		@fclose ($fp);
	} 
}
function ErrorLog($dest,$db,$sql,$error,$art=1)
{
	//$art=0 -> Fehlermeldung
	//$art=1 -> Hinweis
	
	global $config;
	if(strlen($sql)>100) $sql=substr($sql,0,100)." ... (snip)";
	//Error-Zeile generieren
	$errormsg=date('d.m.Y H:i:s').':  ';
	$errormsg.=($dest=='RESTORE') ? ' Restore of db `'.$db.'`|:|' : ' Dump of db `'.$db.'`|:|';

	if ($art==0)
	{
		$errormsg.='<font color="red">Error-Message: '.$error.'</font>|:|';
	}
	else
	{
		$errormsg.='<font color="green">Notice: '.$error.'</font>|:|';
	}

	$errormsg.='SQL: '.$sql."\n";
	
	//Datei öffnen und schreiben
	if($config['logcompression']==1) {
		$fp = @gzopen($config['paths']['log'].'error.log.gz', 'ab');
		if($fp) {
			@gzwrite ($fp,($errormsg));
			@gzclose ($fp);
		}
	} else {
		$fp = @fopen($config['paths']['log'].'error.log', 'ab');
		if($fp) {
			@fwrite ($fp,($errormsg));
			@fclose ($fp);
		} 
	}
}
function DirectoryWarnings($path="")
{
	global $config;
	$warn="";		
	if($path=="" || $path=="config") if(!is_writable($config['paths']['config'])) $warn.='Configpath is not writable!&nbsp;&nbsp;&nbsp;<a href="main.php?help=1&thema=path&dir=config"><img src="'.$config['files']['iconpath'].'help16.gif" alt="" width="16" height="16" border="0"></a><br>';
	if($path=="" || $path=="backup") if(!is_writable($config['paths']['backup'])) $warn.='Backuppath is not writable!&nbsp;&nbsp;&nbsp;<a href="main.php?help=1&thema=path&dir=backup"><img src="'.$config['files']['iconpath'].'help16.gif" alt="" width="16" height="16" border="0"></a><br>';
	if($path=="" || $path=="structure") if(!is_writable($config['paths']['structure'])) $warn.='Structurepath is not writable!&nbsp;&nbsp;&nbsp;<a href="main.php?help=1&thema=path&dir=structure"><img src="'.$config['files']['iconpath'].'help16.gif" alt="" width="16" height="16" border="0"></a><br>';
	if($path=="" || $path=="log") if(!is_writable($config['paths']['log'])) $warn.='Logpath is not writable!&nbsp;&nbsp;&nbsp;<a href="main.php?help=1&thema=path&dir=log"><img src="'.$config['files']['iconpath'].'help16.gif" alt="" width="16" height="16" border="0"></a><br>';
	if($warn!="") $warn='<span class="warnung"><strong>ERROR !</strong><br>'.$warn.'</span>';
	return $warn;
}

function TestWorkDir()
{
	global $config;

	//echo "work_chmod: $config['paths']['work']_chmod<br>";
	SetFileRechte($config['paths']['work']);
	SetFileRechte($config['paths']['backup']);
	SetFileRechte($config['paths']['structure']);
	SetFileRechte($config['paths']['log']);
	SetFileRechte($config['paths']['config']);

	if(!file_exists($config['files']['parameter'])) SetDefault(true);
	if(!file_exists($config['files']['log'])) DeleteLog();
}


function SetFileRechte($file,$perm="0777") 
{ 
   global $lang; 
   if(substr($file,-1)!="/") $file.="/";
   if(strlen($perm)!=4 || intval($perm)==0 || intval($perm)>777) $perm="0777"; 
   if( (ini_get('safe_mode')==1) && (!(is_dir($file))) ) 
   { 
      echo $lang['critical_safemode']; 
      return 0; 
   } else { 
   	   clearstatcache(); 
      if (!@is_dir($file)) @mkdir($file, $perm); 
      clearstatcache(); 
      $a=@substr(decoct(fileperms($file)),-4); 
      $ret=1; 
      if($a!=$perm && (ini_get('safe_mode')!=1)) { 
      $ret=@chmod($file,$perm); 
      } 
      return $ret; 
   } 
} 


function SelectDB($index)
{
	global $databases;
	$databases['db_actual'] = $databases['Name'][$index];
	$databases['praefix'][$databases['db_selected_index']] = $databases['praefix'][$index];
	$databases['db_selected_index']=$index;
}

function EmptyDB($dbn)
{
	global $config;
	//$res=mysql_query("DROP DATABASE `$dbn`") or die(mysql_error()."");
	//$res=mysql_query("CREATE DATABASE `$dbn`") or die(mysql_error()."");
	$t_sql=Array();
	$tabellen = mysql_list_tables($dbn,$config['dbconnection']); 
	$num_tables = mysql_num_rows($tabellen); 
	for($i=0;$i<$num_tables;$i++) {
		$t=mysql_tablename($tabellen,$i);
		$t_sql[]="DROP TABLE `$t`;";
	}
	for($i=0;$i<count($t_sql);$i++) {
		$res=mysql_query($t_sql[$i]) or die(mysql_error()."");
	}
	
}

function AutoDelete()
{
	global $del_files, $config, $lang,$out;

	//Files einlesen
	$dh = opendir($config['paths']['backup']);
	$dbbackups=Array();
	while (false !== ($filename = readdir($dh)))
	{


	    if ($filename != "." && $filename != ".." && !is_dir($config['paths']['backup'].$filename)) {
			//statuszeile auslesen
			if(substr($filename,-2)=="gz"){
				$fp = gzopen ($config['paths']['backup'].$filename, "r");
				$sline=gzgets($fp,40960);
				gzclose ($fp);
			}else{
				$fp = fopen ($config['paths']['backup'].$filename, "r");
				$sline=fgets($fp,500);
				fclose ($fp);
			}
			$statusline=ReadStatusline($sline);
			$tabellenanzahl=($statusline["tables"]==-1) ? "" : $statusline["tables"];
			$eintraege=($statusline["records"]==-1) ? "" : $statusline["records"];
			$part=($statusline["part"]=="MP_0") ? 0 : substr($statusline["part"],3);
			$databases['db_actual']=$statusline["dbname"];
			$datum=substr($filename,strlen($databases['db_actual'])+1);
			$datum=substr($datum,0,16);
			if(isset($dbbackups[$databases['db_actual']])) $dbbackups[$databases['db_actual']]++; else $dbbackups[$databases['db_actual']]=1;
			$files[] = "$datum|".$databases['db_actual']."|$part|$filename";
		}
	}

	@rsort($files);
	// Mehr Dateien vorhanden, als es laut config.php sein dürften? Dann weg damit :-)

	if($config['del_files_after_days']>0) {
		$nowtime=strtotime("-".($config['del_files_after_days']+1)." day");
		for($i=0; $i<sizeof($files); $i++)
		{
		     $delfile=explode("|",$files[$i]);
			 $ts=substr($delfile[0],0,4)."-".substr($delfile[0],5,2)."-".substr($delfile[0],8,2);
			 if(strtotime($ts)<$nowtime){
			 	$out.=DeleteFile($files[$i],"days");
				unset($files[$i]);
			 }
		}
	}
	@rsort($files);
	if($config['max_backup_files'] > 0)
	{
    	if (sizeof($files) > $config['max_backup_files'])
    	{
			if($config['max_backup_files_each']==1) {
				//gilt es nur für jede Datenbank
				for($i=sizeof($files)-1; $i>=0; $i--)
				{
					$delfile=explode("|",$files[$i]);
					if($dbbackups[$delfile[1]] > $config['max_backup_files'])
					 {
					 	$out.=DeleteFile($files[$i],"max");
						unset($files[$i]);
						$dbbackups[$delfile[1]]--;
					 }
				}
			} else {
				//oder gilt es für alle Backups
				for($i=sizeof($files)-1; $i>=$config['max_backup_files']; $i--)
				{
					$delfile=implode("|",$files);
					$out.=DeleteFile($files[$i],"max");
					unset($files[$i]);
				}
			}
    	}
	}



	return $out;
}

function DeleteFile($files,$function)
{
	global $config,$lang;
	$delfile=explode("|",$files);
	$ll=($function=="max") ? $lang['fm_autodel1']:$lang['fm_autodel2'];
	$r="<p class=\"error\">".$ll."<br>";
	$r.= $delfile[3]."<br>";
	WriteLog("autodeleted ($function) '$delfile[3]'.");
   	unlink($config['paths']['backup'].$delfile[3]);
	$r.= "</p>";
	return $r;
}

function ReadStatusline($line)
{
	/*AUFBAU der Statuszeile:
		-- Status:tabellenzahl:datensätze:Multipart:Datenbankname:script:scriptversion:Kommentar:MySQLVersion:Backupflags:SQLBefore:SQLAfter:EXTINFO
		Aufbau Backupflags (1 Zeichen pro Flag, 0 oder 1, 2=unbekannt)
		(complete inserts)(extended inserts)(ignore inserts)(delayed inserts)(downgrade)(lock tables)(optimize tables)
	*/
	$statusline=Array();
	if(substr($line,0,8)!="# Status" && substr($line,0,9)!="-- Status") 
	{
		//Fremdfile
		$statusline["tables"]=-1;
		$statusline["records"]=-1;
		$statusline["part"]="MP_0";
		$statusline["dbname"]="unknown";
		$statusline["script"]="";
		$statusline["scriptversion"]="";
		$statusline["comment"]="";
		$statusline["mysqlversion"]="unknown";
		$statusline["flags"]="2222222";
		$statusline["sqlbefore"]="";
		$statusline["sqlafter"]="";
	} 
	else 
	{
		// MySQLDumper-File - Informationen extrahieren
		$s=explode(":",$line);
		if(count($s)<12) 
		{
			//fehlenden Elemente auffüllen
			$c=count($s);
			array_pop($s);
			for($i=$c-1;$i<12;$i++) {$s[]="";}
		}
		$statusline["tables"]=$s[1];
		$statusline["records"]=$s[2];
		$statusline["part"]=$s[3];
		$statusline["dbname"]=$s[4];
		$statusline["script"]=$s[5];
		$statusline["scriptversion"]=$s[6];
		$statusline["comment"]=$s[7];
		$statusline["mysqlversion"]=$s[8];
		$statusline["flags"]=$s[9];
		$statusline["sqlbefore"]=$s[10];
		$statusline["sqlafter"]=$s[11];
	}
	
	//flags zerlegen
	if(strlen($statusline["flags"])<6) $statusline["flags"]="2222222";
	$statusline["complete_inserts"]=substr($statusline["flags"],0,1);
	$statusline["extended_inserts"]=substr($statusline["flags"],1,1);
	$statusline["ignore_inserts"]=substr($statusline["flags"],2,1);
	$statusline["delayed_inserts"]=substr($statusline["flags"],3,1);
	$statusline["downgrade"]=substr($statusline["flags"],4,1);
	$statusline["lock_tables"]=substr($statusline["flags"],5,1);
	$statusline["optimize_tables"]=substr($statusline["flags"],6,1);
	return $statusline;
}

function NextPart($s,$first=0) 
{
	global $restore;
	$nf=explode('_',$s);
	$i=array_search('part',$nf)+1;
	$p=substr($nf[$i],0,strpos($nf[$i],'.'));
	$ext=substr($nf[$i],strlen($p));
	if($first==1) {
		$nf[$i]='1'.$ext;
	} else {
		$nf[$i]=++$p.$ext;
	}
	$restore['part']=$p;
	return implode('_',$nf);
}

function zeit_format($t)
{
	$tt_m=floor($t/60);
	$tt_s=$t-($tt_m*60);
	return $tt_m.' min. '.floor($tt_s).' sec';
}

function ErrorReport()
{
	global $config,$PHP_SELF,$PATH,$PATH_TRANSLATED,$SCRIPT_FILENAME,$SCRIPT_NAME,$email,$_SERVER;

	$error_kind=$error_aus="";
	if(isset($_POST['p']) && $_POST['p']==1) {
		//von Programmfehler geposted
		$error_kind=$_POST['error_kind'];
		$error_aus=$_POST['error_aus'];
	}
	if(isset($_POST['create_sql']))  {
		//vom Parser
		$error_kind="Parser-Fehler";
		$error_aus=stripslashes(trim($_POST['create_sql']))."\n\n\n".stripslashes(trim($_POST['insert_sql']));
	}
	$subject = "Fehlerbericht vom ".date("d.m.Y H:s");

	$i=0;
	$r= '<form action="main.php?action=senderror" method="post">';
	$r.='<div id="content"><table class="bordersmall"><tr class="thead"><th align="center" colspan="2"><h4>'.$subject.'</h4></th></tr>'."\n";
	$r.='<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Absender</td><td><input type="text" name="error_absender" size="40" value="'.$config['email_recipient'].'"></td></tr>'."\n";
	$r.='<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Name</td><td><input type="text" name="error_name" size="40"></td></tr>'."\n";
	$r.='<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Art des Fehlers</td><td><input type="text" name="error_kind" value="'.$error_kind.'" size="40"></td></tr>'."\n";
	$r.='<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td valign="top">Anzeige des Fehlers</td><td><textarea name="error_aus" cols="30" rows="6">'.$error_aus.'</textarea></td></tr>'."\n";
	$r.='<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td valign="top">zusätzliche Bemerkungen</td><td><textarea name="error_zusatz" cols="30" rows="6"></textarea></td></tr>'."\n";

	$vi= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>MySQLDump-Version</td><td><b>'.MSD_VERSION.'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>MySQL-Version</td><td><b>'.MSD_MYSQL_VERSION.'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>PHP-Version</td><td><b>'.phpversion().'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>PHP-Extensions</td><td width="600"><b>'.implode(" ",get_loaded_extensions()).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>safe_mode</td><td width="600"><b>'.(($config['safe_mode']==1) ? "on" : "off").'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>magic_quotes</td><td width="600"><b>'.(($config['magic_quotes_gpc']==1) ? "on" : "off").'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Variable rootdir</td><td width="600"><b>'.addslashes($config['paths']['root']).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Server PHP_SELF</td><td width="600"><b>'.$_SERVER['PHP_SELF'].'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Server Path</td><td width="600"><b>'. addslashes(str_replace(';',";<br>",str_replace('\\','/',$_SERVER['PATH']))).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Server Script-Filename</td><td width="600"><b>'.$_SERVER['SCRIPT_FILENAME'].'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Server Script-Name</td><td width="600"><b>'.$_SERVER['SCRIPT_NAME'].'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Global PHP_SELF</td><td width="600"><b>'.$PHP_SELF.'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Global Path</td><td width="600"><b>'. addslashes($PATH).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Global Path-Translated</td><td width="600"><b>'. addslashes($PATH_TRANSLATED).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Global Script-Filename</td><td width="600"><b>'.addslashes($SCRIPT_FILENAME).'</b></td></tr>'."\n";
	$vi.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td>Global Script-Name</td><td width="600"><b>'.addslashes($SCRIPT_NAME).'</b></td></tr>'."\n";
	
	$formvi=str_replace("<","&lt;",$vi);
	$formvi=str_replace(">","&gt;",$formvi);
	
	//Form-vars
	$r.=$vi.'<input type="hidden" name="error_vars" value="'.$formvi.'">';
	$r.='<input type="hidden" name="error_subject" value="'.$subject.'">';
	$r.='<input type="hidden" name="error_mailfrom" value="'.$config['email_sender'].'">';

	$r.= '<tr class="'.(($i++ % 2) ? 'dbrow' : 'dbrow1').'"><td colspan="2" align="center"><input class="Formbutton" type="submit" name="error_submit" value="Fehlerbericht absenden"></td></tr>';


	$r.= "</table><br><br><a href='main.php'>Home</a>".MSDFooter();
	return $r;
}

function TesteFTP($ftp_server,$ftp_port,$ftp_user_name,$ftp_user_pass,$ftp_dir)
{
	global $lang,$config;
	if(!isset($config['ftp_timeout'])) $config['ftp_timeout']=60;
	
	if($ftp_port=="" || $ftp_port==0) $ftp_port=21;
	$pass=-1;
	if(!extension_loaded("ftp")) {
		$s='<span class="error">'.$lang['noftppossible'].'+++</span>';
	} else $pass=0;
	
	if($pass==0) {
		if($ftp_server=="" || $ftp_user_name=="" || $ftp_user_pass=="") {
			$s='<span class="error">'.$lang['wrongconnectionpars'].'</span>';
		} else $pass=1;
	}
	
	
	if($pass==1) {
		$s=$lang['connect_to'].' `'.$ftp_server.'` Port '.$ftp_port.'<br>';
		
		if($config['ftp_useSSL']==0) {
			$conn_id = @ftp_connect($ftp_server,$ftp_port,$config['ftp_timeout']); 
		} else {
			$conn_id = @ftp_ssl_connect($ftp_server,$ftp_port,$config['ftp_timeout']); 
		}
		if ($conn_id) $login_result = @ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		if(!$conn_id || (!$login_result)) {
			$s.='<span class="error">'.$lang['conn_not_possible'].'</span>';
		} else $pass=2;
	} 
	
	if($pass==2) {
		$s.='<br><strong>Login ok</strong><br>'.$lang['changedir'].' `'.$ftp_dir.'` ... ';
		$dirc=@ftp_chdir($conn_id,$ftp_dir); 
		if(!$dirc) {
			$s.='<br><span class="error">'.$lang['changedirerror'].'</span>';
		} else $pass=3;
		@ftp_close($conn_id);
	}
	if($pass==3) $s.='<br><br><strong>'.$lang['ftp_ok'].'</strong>';
	return $s;
}



function Realpfad($p) {
	global $config;
	if(!isset($config['disabled'])) $config['disabled']=ini_get("disable_functions");
	if(strpos($config['disabled'],"realpath"))
		$s=getcwd();
	else
		$s=realpath($p);
	$s=str_replace("\\","/",$s);
	if(substr($s,-1)!="/") $s.="/";
	return $s;
}

function GetPerlConfigs() {
	global $config;
	$default=$config['cron_configurationfile'];
	$dh = opendir($config['paths']['config']);
	$r="";
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($config['paths']['config'].$filename) && substr($filename,-5)==".conf") {
			$f=substr($filename,0,strlen($filename)-5);
			$r.='<option value="'.$f.'" ';
			if($filename==$default) $r.=' SELECTED';
			$r.='>&nbsp;&nbsp;'.$f.'&nbsp;&nbsp;</option>'."\n";
		}
	}
	return $r;
}
function GetThemes() {
	global $config;
	$default=$config['theme'];
	$dh = opendir($config['paths']['root']."css/");
	$r="";
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && is_dir($config['paths']['root']."css/".$filename)) {
			
			$r.='<option value="'.$filename.'" ';
			if($filename==$default) $r.=' SELECTED';
			$r.='>&nbsp;&nbsp;'.$filename.'&nbsp;&nbsp;</option>'."\n";
		}
	}
	return $r;
}
function GetLanguageCombo($k="op",$class="",$name="",$start="",$end="") {
	global $config,$lang;
	$default=$config['language'];
	$dh = opendir($config['paths']['root']."language/");
	$r="";
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != '.svn' && $filename != ".." && $filename != "flags" && is_dir($config['paths']['root']."language/".$filename)) {
			//echo $config['paths']['root']."language/".$filename."<br>";
			if($k=="op") {
				$r.=$start.'<option value="'.$filename.'" ';
				if($filename==$default) $r.=' SELECTED';
				$r.=' class="'.$class.'">&nbsp;&nbsp;'.$lang[$filename].'&nbsp;&nbsp;</option>'.$end."\n";
			} elseif($k=="radio") {
				$r.=$start.'<input type="radio" class="'.$class.'" name="'.$name.'" value="'.$filename.'" '.(($filename==$default) ? "checked" : "").' onclick="show_tooldivs(\''.$filename.'\');"><img src="language/flags/'.$filename.'.gif" alt="" width="25" height="15" border="0">&nbsp;&nbsp;&nbsp;'.$lang[$filename].$end."\n";
			}
		}
	}
	return $r;
}

function headline($title,$mainframe=1) {
	global $config,$lang;
	$s="";
	if($config['interface_server_caption']==1) {
		if($config['interface_server_caption_position']==$mainframe) {
			$s.='<div id="server'.$mainframe.'">'.$lang['server'].': <a class="server" href="http://'.$_SERVER['SERVER_NAME'].'" target="_blank" title="'.$_SERVER['SERVER_NAME'].'">'.$_SERVER['SERVER_NAME'].'</a></div>';
		}
	}	
	if ($mainframe==1) {
		$s.='<div id="pagetitle">'.$title.'</div>';
	 	$s.='<div id="content">';
	}
	return $s;
}

function PicCache($rpath="./") {
	global $BrowserIcon,$config;
	
	$t='<div style="display:none">';
	
	$dh=opendir($config['files']['iconpath']);
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($config['files']['iconpath'].$filename)) {
			$t.='<img src="'.$config['files']['iconpath'].$filename.'" width="16" height="16" alt="">';
		}
	}
	$t.='</div>';
	return $t;
}

function MSDHeader($kind=0,$onloadFunction="")
{
	global $config, $databases,$lang,$frameset_restore;
	//kind 0=main 1=menu 2=help
	$d=($kind==2) ? "../../" : "./";
	$r='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'."\n<html>\n<head>\n"; 

	if ($kind==0) {
		//Main without caching
		$r.='<META HTTP-EQUIV="Pragma" CONTENT="no-cache">'."\n";
	} else {
		$r.='<META HTTP-EQUIV="cache-control" CONTENT="public">'."\n";
	}
	$r.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'."\n";

	$r.='<META NAME="robots" CONTENT="none">'."\n";
	$r.='<META NAME="robots" CONTENT="noindex">'."\n";
	$r.='<title>MySqlDumper</title>'."\n";
	$r.='<link rel="stylesheet" type="text/css" href="'.$d.'css/'.$config['theme'].'/style.css">'."\n";
	$r.='<script language="JavaScript" src="'.$d.'js/script.js" type="text/javascript"></script>'."\n";
	
	
	if($frameset_restore==1) $r.='<script language="JavaScript">
			//restore the frameset
			var params="";
			if(document.URL.indexOf("/") != -1)  
			{
    			var stringArray = document.URL.split("/");
    			params = stringArray.pop();  
			}
			if (parent.frames.length == 0) { parent.location.href="index.php?page="+params; }
		</script>';
	
	
	$r.="</head>\n<body ".(($kind==1) ? 'class="menu"' : '').(($onloadFunction!="") ? ' onload="'.$onloadFunction.'();"' : '').'>';
	
	return $r;
}
function MSDFooter($rfoot="",$enddiv=1)
{
	global $config, $databases,$dump,$restore,$lang;
	$f= '<div id="footer">'.$lang['authors'].':&nbsp;
	<a class="small" href="http://dislabs.de" target="_new">
	Daniel Schlichtholz & Steffen Kamper</a> - Infoboard: 
	<a class="small" href="'.$config['homepage'].'" target="_blanc">'.
	$config['homepage'].'</a></div>';
	
	if($enddiv==1) $f.= '</div>';
	
	$f.=$rfoot.'</body></html>';
	
	return $f;
}

function save_bracket($str)
{
	// Wenn Klammer zu am Ende steht, diese behalten
	$str=trim($str);
	if (substr($str,-1)==')') $str=')';
	else $str='';
	return $str;
}	

function DownGrade($s,$show=true)
{
//	if (MSD_NEW_VERSION && strpos(strtolower($s),"collate ") && ($show) ) {
//		return $s;
//	} else {
		$tmp=explode(",",$s);
//echo "<pre>";print_r($tmp);echo "</pre>";

		for($i=0;$i<count($tmp);$i++) {
			$t=strtolower($tmp[$i]);
			if(strpos($t,"collate ")) {
				$tmp2=explode(" ",$tmp[$i]);
				for($j=0;$j<count($tmp2);$j++) {
					if(strtolower($tmp2[$j])=="collate") {$tmp2[$j]="";$tmp2[$j+1]=save_bracket($tmp2[$j+1]);$j++;}
				}
				$tmp[$i]=implode(" ",$tmp2);
			}
			if(strpos($t,"engine=")) {
				$tmp2=explode(" ",$tmp[$i]);
				for($j=0;$j<count($tmp2);$j++) {
					//echo $j.": ".$tmp2[$j]."<br>";
					if(substr(strtoupper($tmp2[$j]),0,7)=="ENGINE=") $tmp2[$j]="TYPE=".substr($tmp2[$j],7);
					if(substr(strtoupper($tmp2[$j]),0,8)=="CHARSET=") { $tmp2[$j]=""; 
						$tmp2[$j-1]=save_bracket($tmp2[$j-1]);}
					if(substr(strtoupper($tmp2[$j]),0,8)=="COLLATE=") 
					{ 
						$tmp2[$j]=save_bracket($tmp2[$j]); 
						if (isset($tmp2[$j+1])) $tmp2[$j+1]=save_bracket($tmp2[$j+1]);

						$tmp2[$j-1]="";
					}

				}
				$tmp[$i]=implode(" ",$tmp2);
			}

			// collate entfernen
			if(strpos($t,"collate")) 
			{
				$tmp2=explode(" ",$tmp[$i]);
				$end=false;
				
				for($j=0;$j<count($tmp2);$j++) {
					if(strtolower($tmp2[$j])=="collate"){ 
						$tmp2[$j]=save_bracket($tmp2[$j]);
						$tmp2[$j+1]=save_bracket($tmp2[$j+1]);
					}
				}
				$tmp[$i]=implode(" ",$tmp2);
			}

			// character Set sprache  entfernen
			if(strpos($t,"character set")) 
			{
				$tmp2=explode(" ",$tmp[$i]);
				$end=false;
				
				for($j=0;$j<count($tmp2);$j++) {
					if(strtolower($tmp2[$j])=="character"){ 
						$tmp2[$j]='';
						$tmp2[$j+1]=save_bracket($tmp2[$j+1]);
						$tmp2[$j+2]=save_bracket($tmp2[$j+2]);
					}
				}
				$tmp[$i]=implode(" ",$tmp2);
			}

			if(strpos($t,"timestamp")) {
				$tmp2=explode(" ",$tmp[$i]);
				$end=false;
				
				for($j=0;$j<count($tmp2);$j++) {
					if($end) $tmp2[$j]="";
					if(strtolower($tmp2[$j])=="timestamp"){ 
						$tmp2[$j]="TIMESTAMP(14)";
						$end=true;
					}
				}
				$tmp[$i]=implode(" ",$tmp2);
			}
		}	
		$t=implode(",",$tmp);
		if(substr(rtrim($t),-1)!=";") $t=rtrim($t).";";
//	if (strpos($t,'en_rules')) die ("<hr>".$t."</hr>");

		return $t;
//	}
}

function MySQL_Ticks($s) {
	$klammerstart=$end=0;
	$inner_s_start=strpos($s,"(");
	$inner_s_end=strrpos($s,")");
	$inner_s=substr($s,$inner_s_start+1,$inner_s_end-(1+$inner_s_start));
	$pieces=explode(",",$inner_s);
	for($i=0;$i<count($pieces);$i++) {
		$r=trim(rtrim($pieces[$i]));
		$klammerstart+=substr_count($r, "(")-substr_count($r, ")");
		if($i==count($pieces)-1) $klammerstart+=1;
		if(substr(strtoupper($r),0,4)=="KEY " || 
		   substr(strtoupper($r),0,7)=="UNIQUE " || 
		   substr(strtoupper($r),0,12)=="PRIMARY KEY " ||
		   substr(strtoupper($r),0,13)=="FULLTEXT KEY " 
		   ) {
		   	//nur ein Key
			$end=1;
		} else { 
			if(substr($r,0,1)!="`" && substr($r,0,1)!="'" && $klammerstart==0 && $end==0) {
				$pos=strpos($r," ");
				$r="`".substr($r,0,$pos)."`".substr($r,$pos);
			}
		}
		$pieces[$i]=$r;
	}
	$back=substr($s,0,$inner_s_start+1).implode(",",$pieces).");";
	return $back;
}
		
?>
