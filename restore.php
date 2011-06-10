<?php
include_once("inc/functions_restore.php");
include_once($config['files']['parameter']);
include_once("inc/mysql.php");
include_once("language/".$config['language']."/lang.php");
include_once("language/".$config['language']."/lang_restore.php");

$aus=Array();
$aus1=$page_parameter="";
$RestoreFertig=$eingetragen=$dauer=$filegroesse=0;
//Browserweiche
if($config['browser_switch']==0) {
	$frames=(MSD_BROWSER_AGENT == "IE") ? 0 : 1;
} else $frames=$config['browser_switch']-1;
$relativ_path=($frames==1) ? "../../" : "./";

//echo '<script language="JavaScript">alert("frames='.$frames.'");</script>';die();
			
MSD_mysql_connect(); 
mysql_select_db($databases['db_actual']) or die($lang['db_select_error'].$databases['db_actual'].$lang['db_select_error2']);

$restore['num_table_fields']=array(); // Array initialisieren
//Zeitzähler aktivieren
$restore['max_zeit']=intval($config['max_execution_time']*$config['time_buffer']);
if($restore['max_zeit']==0) $restore['max_zeit']=20;
$restore['startzeit']=time();
$restore['xtime']=(isset($_GET['xtime'])) ? $_GET['xtime'] : time();
$restore['fileEOF']=false; // Ende des Files erreicht?
$restore['actual_table']= (!empty($_GET['actual_table'])) ? $_GET['actual_table'] : "unbekannt";
$restore['offset']= (!empty($_GET['offset'])) ? $_GET['offset'] : 0;
$restore['aufruf']= (!empty($_GET['aufruf'])) ? $_GET['aufruf'] : 0;
$restore['table_ready']= (!empty($_GET['table_ready'])) ? $_GET['table_ready'] : 0;
$restore['part']= (!empty($_GET['part'])) ? $_GET['part'] : "";
$restore['do_it']= (isset($_GET['do_it'])) ? $_GET['do_it'] : false;
$restore['errors']= (isset($_GET['err'])) ? $_GET['err'] : 0;
$restore['anzahl_eintraege']=(isset($_GET['anzahl_eintraege'])) ? $_GET['anzahl_eintraege'] : 0;
$restore['anzahl_tabellen']=(isset($_GET['anzahl_tabellen'])) ? $_GET['anzahl_tabellen'] : 0;
$restore['filename']=(isset($_GET['filename'])) ? urldecode($_GET['filename']) : ""; 
$restore['actual_fieldcount']=(isset($_GET['actual_fieldcount'])) ? $_GET['actual_fieldcount'] : 0;
$restore['eintraege_ready']=(isset($_GET['eintraege_ready'])) ? $_GET['eintraege_ready'] : 0;
$restore['anzahl_zeilen']=(isset($_GET['anzahl_zeilen'])) ? $_GET['anzahl_zeilen'] : $config['minspeed'];
$restore['summe_eintraege']=(isset($_GET['summe_eintraege'])) ? $_GET['summe_eintraege'] : 0;
$restore['erweiterte_inserts']=(isset($_GET['erw_ins'])) ? $_GET['erw_ins'] : 0;
$restore['flag']=(isset($_GET['flag'])) ? $_GET['flag'] : -1;

//0=Datenbank  1=Struktur
$restore['kind']=(!isset($_GET['kind'])) ? $_GET['kind']:0;
if($restore['kind']==0) $fpath=$config['paths']['backup']; else $fpath=$config['paths']['structure'];
$restore['compressed'] = (substr(strtolower($restore['filename']),-2)=="gz") ? 1 : 0; 

$fmp=0;
//auf Multipart überprüfen
if(strlen($restore['filename'])>20)
{
	$fname=substr($restore['filename'],-20);
	$pp=strpos($fname,"part");
	$fmp=($pp>0);
	if(($fmp>0) && $restore['offset']==0 && $restore['part']=="")
	{
		//ersten Part erzeugen
		$restore['filename']=NextPart($restore['filename'],1);
	}
}


// Datei oeffnen
$restore['filehandle'] = ($restore['compressed']) ? gzopen($fpath.$restore['filename'],"r") : fopen($fpath.$restore['filename'],"r");
if ($restore['filehandle'])	
{
	//nur am Anfang Logeintrag
	if($restore['offset']==0)
	{
		if($fmp>0)WriteLog("Start Multipart-Restore '".$restore['filename']."'");
		else WriteLog("Start Restore '".$restore['filename']."'");

		// Statuszeile auslesen
		$statusline= ($restore['compressed']) ? gzgets($restore['filehandle'],40960):fgets($restore['filehandle'],500);
		$sline=ReadStatusline($statusline);
		$restore['anzahl_tabellen']=$sline[0];
		$restore['anzahl_eintraege']=$sline[1];
		$restore['part']=($sline[2]=="") ? 0 : substr($sline[2],3);
		if($config['empty_db_before_restore']==1 && $restore['part']==0) EmptyDB($databases['db_actual']);
		$restore['tablelock']=0;
		$restore['erweiterte_inserts']=0;
		$restore['protokoll'][]=$statusline;
	} 
	else 
	{
		if ($restore['compressed']==0) $filegroesse=filesize($fpath.$restore['filename']);
		// Dateizeiger an die richtige Stelle setzen
		($restore['compressed']) ? gzseek($restore['filehandle'],$restore['offset']) : fseek($restore['filehandle'],$restore['offset']);
		// Jetzt basteln wir uns mal unsere Befehle zusammen...
		$a=0;
		$dauer=0;
		//lock_table($restore['actual_table']);
		WHILE ( ($a<$restore['anzahl_zeilen']  ) 
			&& (!$restore['fileEOF']) && ($dauer<$restore['max_zeit']) 
			&& !isset($restore["EOB"]) ) 
		{
			$sql_command=get_sqlbefehl(); 
			
			if($sql_command!="") 
			{
				$meldung="";
				$res=mysql_query($sql_command,$config['dbconnection']);
				//if(strtoupper(substr($sql_command,0,12))=="CREATE TABLE") lock_table();			
				// Bei MySQL-Fehlern sofort abbrechen und Info ausgeben
				$meldung=mysql_error($config['dbconnection']);
				if ($meldung!="")	
				{
					if($config['stop_with_error']==0) 	
					{
						Errorlog("RESTORE",$databases['db_actual'],$sql_command,$meldung);
						$restore['errors']++;   
					} 
					else 
					{
						SQLError($sql_command,$meldung);
						die();
					}
				}
				$anzsql=mysql_affected_rows($config['dbconnection']);
				if($anzsql>1){
					 $restore['eintraege_ready']+=($anzsql-1);
					 //WriteLog("Erweiterte Inserts: $anzsql Einträge in ".$restore['actual_table']);
				}
			}
			$a++;
			$dauer=time()-$restore['startzeit'];
		}
		$eingetragen=$a-1;
	}
	
	$restore['offset']= ($restore['compressed']) ? gztell($restore['filehandle']) : ftell($restore['filehandle']);
	if ($restore['compressed']) gzclose($restore['filehandle']); else fclose($restore['filehandle']);
	
	$aus_header[]= PicCache($relativ_path);
	$aus_header[]= headline($lang['restore']);
	$aus_header[]='Browser : <img src="'.$relativ_path.$BrowserIcon.'"> '.(($frames==0) ? " (automatisch erkannt)" : ""); //.' / '.$frames;
	
	if (!$restore['fileEOF'] && !isset($restore["EOB"]))
	{
		$restore['aufruf']++;
		if (!$restore['compressed']) $prozent=($filegroesse>0) ? ($restore['offset']*100)/$filegroesse : 0;
		else
		{
			if ($restore['anzahl_eintraege']>0) $prozent=$restore['eintraege_ready']*100/$restore['anzahl_eintraege'];
			else $prozent=0;
		}
		if ($prozent>100) $prozent=100;
		
		if($aus1!="") $aus[]= '<br>'.$aus1.'<br><br>';
		$aus[]= '<br><br>'.sprintf($lang['restore_db'],$databases['db_actual'],$config['dbhost']).'<br><br>';
		//$aus[]=$lang['restore_db1'].$config['dbhost'].$lang['restore_db2'].'</p>Backup-File: <b>'.$restore['filename'].'</b>';
		if($fmp>0) $aus[]= '<br>Multipart File <strong>'.$restore['part'].'</strong><br>';
		//if($restore['erweiterte_inserts']==1) $aus[]='<br><span style="background-color:#ffcc99;">Format: erweiterte Inserts</span><br>';
		
		$tabellen_fertig=($restore['table_ready']>0) ? $restore['table_ready']:'0';
		$to_do= ($restore['anzahl_tabellen']>0) ? $restore['anzahl_tabellen']:$lang['unknown'];
		if($restore['anzahl_tabellen']>0)
			$aus[]=sprintf($lang['restore_tables_completed'],$tabellen_fertig,$to_do);
		else
			$aus[]=sprintf($lang['restore_tables_completed0'],$tabellen_fertig);

		$done=number_format($restore['eintraege_ready'],0,",",".");
		$to_do=number_format($restore['anzahl_eintraege'],0,",",".");
		if ($restore['anzahl_eintraege']>0) 
			$aus[]=sprintf($lang['restore_run1'],$done,$to_do);
		else
			$aus[]=sprintf($lang['restore_run0'],$done);
		$aus[]=sprintf($lang['restore_run2'],$restore['actual_table']);
		$aus[]=$lang['progress_over_all'].'<br>';

		//Fortschrittsbalken
		$prozentbalken=(round($prozent,0)*3);
		if ($restore['anzahl_eintraege']>0)
		{
			$aus[]= '<table border="0" width="440"><tr>';
			if ($prozentbalken>=3) $aus[]= '<td width="'.$prozentbalken.'" nowrap>
			<img src="'.$relativ_path.'images/fbr.gif" name="restorebalken" alt="" width="'.$prozentbalken.'" height="16" border="0"></td>';
			$aus[]= '<td width="'.(round(100-$prozent,0)*3).'">&nbsp;</td>'
				.'<td width="80" align="right" nowrap><b>'.(number_format($prozent,2,",",".")).' %</b></td></tr></table>';
		}
		else $aus[]= ' <b>'.$lang['unknown_number_of_records'].'</b><br><br>';
		
		//Speed-Anzeige
		$fw=($config['maxspeed']==$config['minspeed']) ? 300 : round(($restore['anzahl_zeilen']-$config['minspeed'])/($config['maxspeed']-$config['minspeed'])*300,0);
		$aus[]='<br><table border="0" cellpadding="0" cellspacing="0"><tr nowrap>';
		$aus[]='<td class="nomargin" width="60" valign="top" align="center" style="color:#990000; font-size:10px;" >';
		$aus[]='<strong>Speed</strong><br>'.$restore['anzahl_zeilen'].'</td><td class="nomargin" width="300">';
		$aus[]='<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr nowrap>';
		$aus[]='<td class="nomargin" align="left"class="small" width="300" nowrap>';
		$aus[]='<img src="'.$relativ_path.'images/fbs.gif" name="speedbalken" alt="" width="'.$fw.'" height="12" border="0" vspace="0" hspace="0">';
		$aus[]='</td></tr></table><table border="0" width="100%" cellpadding="0" cellspacing="0">';
		$aus[]='<tr nowrap><td class="nomargin" align="left" width="50%" nowrap style="font-size:10px;" >'.$config['minspeed'].'</td>';
		$aus[]='<td class="nomargin" align="right" width="50%" nowrap style="font-size:10px;" >'.$config['maxspeed'].'</td>';
		$aus[]='</tr></table></td></tr></table>';

		//Status-Text
		$aus[]= '<p class="small">'.zeit_format(time()-$restore['xtime']).', '.$restore['aufruf'].' pages'; //, speed '.$anzahl_zeilen;
		$aus[]= ($fmp>0) ? ', file '.$restore['part'] : '';
		$aus[]= ($restore['errors']>0) ? ', <span style="color:red;">'.$restore['errors'].' errors</span>' : '';
		$aus[]= '</p>';		
		$restore['summe_eintraege']+=$eingetragen; 
    			
		//Zeitanpassung
		if($config['direct_connection']==1) {
			if ($dauer<$restore['max_zeit'])
			{
				$restore['anzahl_zeilen']=$restore['anzahl_zeilen']*$config['tuning_add']; 
			}
			else 
			{
				$restore['anzahl_zeilen']=$restore['anzahl_zeilen']*$config['tuning_sub'];
			}
			$restore['anzahl_zeilen']=round($restore['anzahl_zeilen'],0);
			if($config['minspeed']>0) {if ($restore['anzahl_zeilen']<$config['minspeed']) $restore['anzahl_zeilen']=$config['minspeed'];}
			if($config['maxspeed']>0) {if($restore['anzahl_zeilen']>$config['maxspeed']) $restore['anzahl_zeilen']=$config['maxspeed'];}
		}
		
		$page_parameter='offset='.$restore['offset'].'&aufruf='.$restore['aufruf'].'&actual_table='.$restore['actual_table'];
		$page_parameter.="&filename=".urlencode($restore['filename'])."&kind=".$restore['kind']."&xtime=".$restore['xtime'];
		$page_parameter.= "&table_ready=".$restore['table_ready']."&eintraege_ready=".$restore['eintraege_ready'];
		$page_parameter.= "&anzahl_tabellen=".$restore['anzahl_tabellen']."&anzahl_eintraege=".$restore['anzahl_eintraege'];
		$page_parameter.= "&actual_fieldcount=".$restore['actual_fieldcount']."&part=".$restore['part'];
		$page_parameter.= "&anzahl_zeilen=".$restore['anzahl_zeilen'];
		$page_parameter.= "&summe_eintraege=".$restore['summe_eintraege']."&do_it=".$restore['do_it']."&err=".$restore['errors'];
		$page_parameter.= "&erw_ins=".$restore['erweiterte_inserts']."&flag=".$restore['flag'];	

	}
	else
	{
		if(($restore['part']=="") || 
		($restore['table_ready']==$restore['anzahl_tabellen'] && $restore['eintraege_ready']==$restore['anzahl_eintraege'])
		|| (isset($restore["EOB"]))  ) {
			// Uff, geschafft! Jetzt darf die Leitung wieder abkuehlen. :-)
			
			$restore['xtime']=time()-$restore['xtime'];
			WriteLog("Restore '".$restore['filename']."' finished in ".zeit_format($restore['xtime']).".");
			$aus[]=$lang['restore_total_complete']."<br>";
			$aus[]= sprintf($lang['restore_complete'],$restore['table_ready']).'<br>';
			$aus[]= sprintf($lang['restore_complete2'],number_format($restore['eintraege_ready'],0,",","."));
			$aus[]= '<p class="small">'.zeit_format($restore['xtime']).", ".$restore['aufruf']." pages</p>";
			if($restore['errors']>0) $aus[]='<p class="warnung">Es sind '.$restore['errors'].' Fehler aufgetreten: <a href="'.$relativ_path.'log.php?r=3">ansehen</a></p>';
			$aus[]= "&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang['back_to_minisql']."\" onclick=\"self.location.href='".$relativ_path."sql.php'\"></a>";
			$aus[]= "&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang['back_to_overview']."\" onclick=\"self.location.href='".$relativ_path."main.php?action=db&dbid=".$databases['db_selected_index']."#dbid'\"></a>";
			$RestoreFertig=1;
		} else {
			//Multipart-Restore
			$nextfile=NextPart($restore['filename']);
			if(!file_exists($config['paths']['backup'].$nextfile)) {
				$done=number_format($restore['eintraege_ready'],0,",",".");
				$to_do=number_format($restore['anzahl_eintraege'],0,",",".");
				$aus[]= '<h3>'.$lang['restore'].'</h3>';
				$aus[]= sprintf($lang['restore_db'],$databases['db_actual'],$config['dbhost']);
				$aus[]= '<p class="warning">Multipart-Backup: Missing File \''.$nextfile.'\' !</p>';
				$aus[]=sprintf($lang['restore_run1'],$done,$to_do);
				$aus[]=sprintf($lang['restore_run2'],$restore['actual_table']);
				$aus[]= '<p class="small">'.zeit_format(time()-$restore['xtime']).', '.$restore['aufruf'].' pages'; //, speed '.$anzahl_zeilen;
				$aus[]= ($fmp>0) ? ', file '.$restore['part'] : '';
				$aus[]= ($restore['errors']>0) ? ', <span style="color:red;">'.$restore['errors'].' errors</span>' : '';
				$aus[]= '</p>'.((isset($restore["EOB"])) ? "EOB":"");		
				//$aus[]='<hr><pre>'.print_r($restore['protokoll'],true).'</pre>';
		
			} else {
				//Selbstaufruf mit nächstem File
				
		
				$page_parameter="offset=0&aufruf=".$restore['aufruf']."&actual_table=".$restore['actual_table'];
				$page_parameter.= "&filename=".urlencode($nextfile)."&kind=".$restore['kind']."&xtime=".$restore['xtime'];
				$page_parameter.= "&table_ready=".$restore['table_ready']."&eintraege_ready=".$restore['eintraege_ready'];
				$page_parameter.= "&anzahl_tabellen=".$restore['anzahl_tabellen']."&anzahl_eintraege=".$restore['anzahl_eintraege'];
				$page_parameter.= "&actual_fieldcount=".$restore['actual_fieldcount']."&part=".++$restore['part'];
				$page_parameter.= "&anzahl_zeilen=".$restore['anzahl_zeilen'];
				$page_parameter.= "&summe_eintraege=".$restore['summe_eintraege']."&do_it=".$restore['do_it']."&err=".$restore['errors'];
				$page_parameter.= "&erw_ins=".$restore['erweiterte_inserts']."&flag=".$restore['flag'];	
			}
		}
	}
}
else $aus[]=$fpath.$restore['filename']." :  ".$lang['file_open_error'];



//=====================================================================
//================= Anzeige ===========================================
//=====================================================================

//Seite basteln
$svice=(isset($_GET['svice'])) ? $_GET['svice'] : 0;
//DEBUGGER
$debugausgabe="";
$manuell=0;
//$debugausgabe="<hr>".$page_parameter;
$pagefooter=($RestoreFertig==1) ?  MSDFooter() : '</div></div></BODY></HTML>';
if($svice==1) $pagefooter.='<table width="100%"><tr bgcolor="#808080"><td>'.$config_array.'</td></tr><tr bgcolor="#808080"><td>'.$database_array.'</td></tr><tr bgcolor="#808080"><td>'.$dump_array.'</td></tr><tr bgcolor="#808080"><td>'.$restore_array.'</td></tr></table>';
$aus=array_merge($aus_header,$aus);

if($frames==1) {
	
	$js_aufruf_automatisch=($page_parameter=="") ? ">" : "onload=\"restart_restore()\">";
	$js_aufruf_manuell=($page_parameter=="") ? ">" : '><input type="Button" value="weitermachen" onclick="restart_restore()"><br><br>';
	
	
	$s="\n<script type=\"text/javascript\">\n";
	$s.="function restart_restore()\n{\n";
	$s.="parent.msd_action.location.href=\"".$relativ_path."restore.php?".$page_parameter."\";\n";
	$s.="\n}\n";
	$s.="</script>";
	$pageheader='<html><head>'.$meta.'<title>MySqlDump</title><link rel="stylesheet" type="text/css" href="'.$relativ_path.'css/'.$config['theme'].'/style.css">'.$s.'</head>
	<body  bgcolor="#F5F5F5"  '.(($manuell==0) ? $js_aufruf_automatisch : $js_aufruf_manuell);
	$complete_page=$pageheader.implode("\n",$aus).$debugausgabe.$pagefooter;
	// und raus
	$f=fopen("work/log/out.html","w");
	fwrite($f,$complete_page);
	fclose($f);
	flush();
	echo '<script type="text/javascript">parent.msd_ausgabe.location.href="./work/log/out.html";</script>';

} else {
	$pageheader='<html><head>'.$meta.'<title>MySqlDump</title><link rel="stylesheet" type="text/css" href="css/'.$config['theme'].'/style.css"></head><body>';
	$js_aufruf_automatisch='<script language="javascript">self.location="restore.php?'.$page_parameter.'";</script>';
	$js_aufruf_manuell='<input type="Button" value="weitermachen" onclick="self.location.href=\'restore.php?'.$page_parameter.'\'">';
	$selbstaufruf=($page_parameter=="") ? "" : (($manuell==0) ? $js_aufruf_automatisch : $js_aufruf_manuell);
	$complete_page=$pageheader.(($aus!="") ? implode("\n",$aus) : "").$debugausgabe.$selbstaufruf.$pagefooter;
	// und raus
	echo $complete_page;
	flush();
}

 
?>