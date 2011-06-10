<?php
include_once('./inc/functions_restore.php');
include_once('./'.$config['files']['parameter']);
include_once('./inc/mysql.php');
include_once('./language/'.$config['language'].'/lang.php');
include_once('./language/'.$config['language'].'/lang_restore.php');

$aus=Array();
$aus_header=Array();
$aus1=$page_parameter='';
$RestoreFertig=$eingetragen=$dauer=$filegroesse=0;
$relativ_path='./';

MSD_mysql_connect(); 
mysql_select_db($databases['db_actual']) or die($lang['db_select_error'].$databases['db_actual'].$lang['db_select_error2']);

$restore['num_table_fields']=array(); // Array initialisieren
//Zeitzähler aktivieren
$restore['max_zeit']=intval($config['max_execution_time']*$config['time_buffer']);
if($restore['max_zeit']==0) $restore['max_zeit']=20;
$restore['startzeit']=time();
$restore['xtime']=(isset($_POST['xtime'])) ? $_POST['xtime'] : time();
$restore['fileEOF']=false; // Ende des Files erreicht?
$restore['actual_table']= (!empty($_POST['actual_table'])) ? $_POST['actual_table'] : 'unbekannt';
$restore['offset']= (!empty($_POST['offset'])) ? $_POST['offset'] : 0;
$restore['aufruf']= (!empty($_POST['aufruf'])) ? $_POST['aufruf'] : 0;
$restore['table_ready']= (!empty($_POST['table_ready'])) ? $_POST['table_ready'] : 0;
$restore['part']= (isset($_POST['part'])) ? $_POST['part'] : 0;
$restore['do_it']= (isset($_POST['do_it'])) ? $_POST['do_it'] : false;
$restore['errors']= (isset($_POST['err'])) ? $_POST['err'] : 0;
$restore['notices']= (isset($_POST['notices'])) ? $_POST['notices'] : 0;
$restore['anzahl_eintraege']=(isset($_POST['anzahl_eintraege'])) ? $_POST['anzahl_eintraege'] : 0;
$restore['anzahl_tabellen']=(isset($_POST['anzahl_tabellen'])) ? $_POST['anzahl_tabellen'] : 0;
$restore['filename']=(isset($_POST['filename'])) ? urldecode($_POST['filename']) : '';
if (isset($_GET['filename'])) $restore['filename']=urldecode($_GET['filename']);

$restore['actual_fieldcount']=(isset($_POST['actual_fieldcount'])) ? $_POST['actual_fieldcount'] : 0;
$restore['eintraege_ready']=(isset($_POST['eintraege_ready'])) ? $_POST['eintraege_ready'] : 0;
$restore['anzahl_zeilen']=(isset($_POST['anzahl_zeilen'])) ? $_POST['anzahl_zeilen'] : $config['minspeed'];
$restore['summe_eintraege']=(isset($_POST['summe_eintraege'])) ? $_POST['summe_eintraege'] : 0;
$restore['erweiterte_inserts']=(isset($_POST['erweiterte_inserts'])) ? $_POST['erweiterte_inserts'] : 0;
$restore['flag']=(isset($_POST['flag'])) ? $_POST['flag'] : -1;
$restore['EOB']=(isset($_POST['EOB'])) ? $_POST['EOB'] : 0;
$restore['insert_syntax']=(isset($_POST['insert_syntax'])) ? $_POST['insert_syntax'] :'';

//0=Datenbank  1=Struktur
$restore['kind']=(isset($_POST['kind'])) ? $_POST['kind']:0;
if($restore['kind']==0) $fpath=$config['paths']['backup']; else $fpath=$config['paths']['structure'];

$fmp=$restore['part'];

$restore['compressed'] = (substr(strtolower($restore['filename']),-2)=='gz') ? 1 : 0; 

// Datei oeffnen
$restore['filehandle'] = ($restore['compressed']==1) ? gzopen($fpath.$restore['filename'],'r') : fopen($fpath.$restore['filename'],'r');
if ($restore['filehandle'])	
{
	//nur am Anfang Logeintrag
	if($restore['offset']==0 && $restore['anzahl_tabellen']==0)
	{
		// Statuszeile auslesen
		$restore['part']=0;

		$statusline= ($restore['compressed']==1) ? gzgets($restore['filehandle']):fgets($restore['filehandle']);
		$sline=ReadStatusline($statusline);
		$restore['anzahl_tabellen']=$sline['tables'];
		$restore['anzahl_eintraege']=$sline['records'];
		if ($sline['part']!='MP_0') $restore['part']=1; //substr($sline['part'],3);
		if($config['empty_db_before_restore']==1) EmptyDB($databases['db_actual']);
		$restore['tablelock']=0;
		$restore['erweiterte_inserts']=0;
		if($sline['tables']=="-1") ($restore['compressed']) ? gzseek($restore['filehandle'],0) : fseek($restore['filehandle'],0);
		if($restore['part']>0) WriteLog('Start Multipart-Restore \''.$restore['filename'].'\'');
		else WriteLog('Start Restore \''.$restore['filename'].'\'');
	} 
	else 
	{
		if ($restore['compressed']==0) $filegroesse=filesize($fpath.$restore['filename']);
		// Dateizeiger an die richtige Stelle setzen
		($restore['compressed']) ? gzseek($restore['filehandle'],$restore['offset']) : fseek($restore['filehandle'],$restore['offset']);

		// Jetzt basteln wir uns mal unsere Befehle zusammen...
		$a=0;
		$dauer=0;
		$restore['EOB']=false;
		//lock_table($restore['actual_table']);
		WHILE ( ($a<$restore['anzahl_zeilen']  ) 
			&& (!$restore['fileEOF']) && ($dauer<$restore['max_zeit']) && !$restore['EOB'] ) 
		{
			$sql_command=get_sqlbefehl(); 
			
			if($sql_command>'') 
			{
//WriteLog($sql_command);
				$meldung='';
				$res=mysql_query($sql_command,$config['dbconnection']);
			
				if (!$res===false)
				{
					$anzsql=mysql_affected_rows($config['dbconnection']);

					// Anzahl der eingetragenen Datensaetze ermitteln (Indexaktionen nicht zaehlen)
					$command=strtoupper(substr($sql_command,0,7));
					if ($command=='INSERT ')
					{
						$anzsql=mysql_affected_rows($config['dbconnection']);
						if($anzsql>0)
						{
							$restore['eintraege_ready']+=$anzsql;
						}
					}
				}

				// Bei MySQL-Fehlern sofort abbrechen und Info ausgeben
				$meldung=mysql_error($config['dbconnection']);
				if ($meldung!='')	
				{
					if (strtolower(substr($meldung,0,15))=='duplicate entry') 
					{
						ErrorLog('RESTORE',$databases['db_actual'],$sql_command,$meldung,1);
						$restore['notices']++;
					}
					else
					{
						if($config['stop_with_error']==0) 	
						{
							Errorlog("RESTORE",$databases['db_actual'],$sql_command,$meldung);
							$restore['errors']++;   
						} 
						else 
						{
							Errorlog("RESTORE",$databases['db_actual'],$sql_command,'Restore failed: '.$meldung,0);
							SQLError($sql_command,$meldung);
							die();
						}
					}
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
	$aus_header[]='Browser : <img src="images/'.$BrowserIcon.'"> ';
	
	$restore['aufruf']++;
	if (!$restore['compressed']) $prozent=($filegroesse>0) ? ($restore['offset']*100)/$filegroesse : 0;
	else 
	{
		if ($restore['anzahl_eintraege']>0) $prozent=$restore['eintraege_ready']*100/$restore['anzahl_eintraege'];
		else $prozent=0;
	}
	if ($prozent>100) $prozent=100;
	
	if($aus1!='') $aus[]= '<br>'.$aus1.'<br><br>';
	$aus[]= '<br><br>'.sprintf($lang['restore_db'],$databases['db_actual'],$config['dbhost']).'<br>';
	$aus[]='Backup-File: <b>'.$restore['filename'].'</b><br>';
	if($fmp>0) $aus[]= '<br>Multipart File <strong>'.$restore['part'].'</strong><br>';

	$tabellen_fertig=($restore['table_ready']>0) ? $restore['table_ready']:'0';
	$to_do= ($restore['anzahl_tabellen']>0) ? $restore['anzahl_tabellen']:$lang['unknown'];
	if($restore['anzahl_tabellen']>0)
		$aus[]=sprintf($lang['restore_tables_completed'],$tabellen_fertig,$to_do);
	else
		$aus[]=sprintf($lang['restore_tables_completed0'],$tabellen_fertig);

	$done=number_format($restore['eintraege_ready'],0,',','.');
	$to_do=number_format($restore['anzahl_eintraege'],0,',','.');
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
		<img src="'.$config['files']['iconpath'].'progressbar_restore.gif" name="restorebalken" alt="" width="'.$prozentbalken.'" height="16" border="0"></td>';
		$aus[]= '<td width="'.(round(100-$prozent,0)*3).'">&nbsp;</td>'
			.'<td width="80" align="right" nowrap><b>'.(number_format($prozent,2,",",".")).' %</b></td></tr></table>';
	}
	else $aus[]= ' <b>'.$lang['unknown_number_of_records'].'</b><br><br>';
	
	//Speed-Anzeige
	$fw=($config['maxspeed']==$config['minspeed']) ? 300 : round(($restore['anzahl_zeilen']-$config['minspeed'])/($config['maxspeed']-$config['minspeed'])*300,0);
	$aus[]='<br><table border="0" cellpadding="0" cellspacing="0"><tr nowrap>';
	$aus[]='<td width="60" valign="top" align="center" style="color:#990000; font-size:10px;" >';
	$aus[]='<strong>Speed</strong><br>'.$restore['anzahl_zeilen'].'</td><td width="300">';
	$aus[]='<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr nowrap>';
	$aus[]='<td align="left"class="small" width="300" nowrap>';
	$aus[]='<img src="'.$config['files']['iconpath'].'progressbar_speed.gif" name="speedbalken" alt="" width="'.$fw.'" height="12" border="0" vspace="0" hspace="0">';
	$aus[]='</td></tr></table><table border="0" width="100%" cellpadding="0" cellspacing="0">';
	$aus[]='<tr nowrap style="padding:0;margin:0;"><td align="left" nowrap style="font-size:10px;" >'.$config['minspeed'].'</td>';
	$aus[]='<td style="text-align:right;font-size:10px;" nowrap>'.$config['maxspeed'].'</td>';
	$aus[]='</tr></table></td></tr></table>';

	//Status-Text
	$aus[]= '<p class="small">'.zeit_format(time()-$restore['xtime']).', '.$restore['aufruf'].' pages'; //, speed '.$anzahl_zeilen;
	$aus[]= ($fmp>0) ? ', file '.$restore['part'] : '';
	$aus[]= ($restore['errors']>0) ? ', <span class="error">'.$restore['errors'].' errors</span>' : '';
	$aus[]= ($restore['notices']>0) ? ', <span class="notice">'.$restore['notices'].' notices</span>' : '';
	$aus[]= '</p>';		
	$restore['summe_eintraege']+=$eingetragen; 
    			
	//Zeitanpassung
	if($config['direct_connection']==1) 
	{
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

	if ($restore['fileEOF'] && $restore['part']==0) $restore['EOB']=true;

	if ($restore['EOB'])
	{
		// Uff, geschafft! Jetzt darf die Leitung wieder abkuehlen. :-)
		unset($aus);
		$aus=array();

		$restore['xtime']=time()-$restore['xtime'];
		WriteLog("Restore '".$restore['filename']."' finished in ".zeit_format($restore['xtime']).".");
		$aus[]=$lang['restore_total_complete']."<br>";
		$aus[]=$lang['file'].': <b>'.$restore['filename'].'</b><br><br>';
		$aus[]= sprintf($lang['restore_complete'],$restore['table_ready']).'<br>';
		$aus[]= sprintf($lang['restore_complete2'],number_format($restore['eintraege_ready'],0,",","."));
		$aus[]= '<p class="small">'.zeit_format($restore['xtime']).", ".$restore['aufruf']." pages</p>";
		if($restore['errors']>0) $aus[]=$lang['errors'].': '.$restore['errors'].'  <a href="'.$relativ_path.'log.php?r=3">&raquo; '.$lang['view'].'</a></br>';
		if($restore['notices']>0) $aus[]=$lang['notices'].': '.$restore['notices'].'  <a href="'.$relativ_path.'log.php?r=3">&raquo; '.$lang['view'].'</a><br>';
		$aus[]= "<br>&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang['back_to_minisql']."\" onclick=\"self.location.href='".$relativ_path."sql.php'\"></a>";
		$aus[]= "&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang['back_to_overview']."\" onclick=\"self.location.href='".$relativ_path."main.php?action=db&dbid=".$databases['db_selected_index']."#dbid'\"></a>";
		$RestoreFertig=1;
	} 
	else 
	{
		if ($restore['fileEOF'])
		{
			//Multipart-Restore
			$nextfile=NextPart($restore['filename']);

			if(!file_exists($config['paths']['backup'].$nextfile)) 
			{
				$done=number_format($restore['eintraege_ready'],0,",",".");
				$to_do=number_format($restore['anzahl_eintraege'],0,",",".");
				$aus[]= '<h3>'.$lang['restore'].'</h3>';
				$aus[]= sprintf($lang['restore_db'],$databases['db_actual'],$config['dbhost']);
				$aus[]= '<p class="error">'.$lang['multi_part'].': '.$lang['file_missing'].' \''.$nextfile.'\' !</p>';
				$aus[]=sprintf($lang['restore_run1'],$done,$to_do);
				$aus[]=sprintf($lang['restore_run2'],$restore['actual_table']);
				$aus[]= '<p class="small">'.zeit_format(time()-$restore['xtime']).', '.$restore['aufruf'].' pages'; //, speed '.$anzahl_zeilen;
				$aus[]= ($fmp>0) ? ', '.$lang['file'].' '.$restore['part'] : '';
				$aus[]= ($restore['errors']>0) ? ', <span class="error">'.$restore['errors'].' errors</span>' : '';
				$aus[]= '</p>'.((isset($restore['EOB'])) ? "EOB":"");		
				WriteLog('<span class="error">Restore unsuccessful: Cannot find Multipartfile \''.$nextfile.'\'</span>');
				$RestoreFertig=1;
			}
			else
			{
				$restore['filename']=urlencode($nextfile);
				$restore['offset']=0;
				$restore['part']++;
			}
		}
	}
}
else $aus[]=$fpath.$restore['filename'].' :  '.$lang['file_open_error'];

//=====================================================================
//================= Anzeige ===========================================
//=====================================================================

//Seite basteln
//DEBUGGER
$debugausgabe='';
$manuell=0;

$pagefooter=($RestoreFertig==1) ?  MSDFooter() : '</div></div></BODY></HTML>';
if (is_array($aus_header)) $aus=array_merge($aus_header,$aus);

$page_parameter=get_page_parameter($restore,'restore');
if ($RestoreFertig==1) $page_parameter='';

$pageheader='<html><head>'.$meta.'<title>MySqlDumper</title><link rel="stylesheet" type="text/css" href="css/'.$config['theme'].'/style.css"></head><body>'.$page_parameter;
$js_aufruf_automatisch='<script language="javascript">document.restore.submit();</script>';
$js_aufruf_manuell='<input type="Button" value="weitermachen" onclick="document.restore.submit();">';
$selbstaufruf=($page_parameter=="") ? "" : (($manuell==0) ? $js_aufruf_automatisch : $js_aufruf_manuell);
$complete_page=$pageheader.(($aus!='') ? implode("\n",$aus) : '').$debugausgabe.$selbstaufruf.$pagefooter;
echo $complete_page;
 
?>