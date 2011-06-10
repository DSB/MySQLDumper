<?php
function FilelisteCombo($fpath,$selected) {
	$r='<select name="selectfile">';
	$r.='<option value="" '.(($selected=="") ? "SELECTED" : "").'></option>';
	
	$dh = opendir($fpath);
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($fpath.$filename)) {
			$r.='<option value="'.$filename.'" ';
			if($filename==$selected) $r.=' SELECTED';
			$r.='>'.$filename.'</option>'."\n";
		}
	}
	$r.='</select>';
	return $r;
}

function FileList($multi=0)
{
	global $config,$kind,$fpath,$lang,$databases,$href,$dbactiv,$action,$expand;
	
	$files=Array();
	if($kind==0){
		//Backup-Dateien
		$Theader=$lang['fm_files1'].' '.$lang['of'].' '.$dbactiv;
		$Wheader=$lang['fm_files2'];
		$akind=1;
	} else {
		//Struktur-Dateien
		$Theader=$lang['fm_files2'];
		$Wheader=$lang['fm_files1'];
		$akind=0;
	}
	$Sum_Files=0;
	$dh = opendir($fpath);
	$fl="";
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($fpath.$filename)) {
			$files[] = $filename;
			$Sum_Files++;
		}
	}
	$fl.='<div align="center">'.br().$lang['fm_choose_file'].br();
	$fl.='<span id="gd" style="color:#330099; font-weight:bold;">&nbsp;</span>'.br().'<br><br>';
	
	$fl.='<table border="1" rules="rows" align="center" width="80%" cellpadding="0" cellspacing="0">'.br();
	$fl.='<tr>'.br().'<td colspan="7" align="left"><strong>'.$Theader.'</strong></td>'.br().'<td colspan="3" align="right"><a href="filemanagement.php?action='.$action.'&kind='.$akind.'" class="small">'.$Wheader.'</a></td>'.br().'</tr>'.br();
	
	//Tableheader
	$fl.='<tr>'.br().'<td colspan="2" class="hd">'.$lang['db'].'</td>'.br().'
	<td class="hd">gz</td>'.br().'
	<td class="hd">Script</td>'.br().'
	<td class="hd">'.$lang['comment'].'</td>'.br().'
	
	<td class="hd">'.$lang['fm_filedate'].'</td>'.br().'
	<td class="hd">Multipart</td>'.br().'
	<td class="hd">'.$lang['fm_tables'].' / '.$lang['fm_records'].'</td>'.br().'
	<td align="right" colspan="2" class="hd">'.$lang['fm_filesize'].'</td>'.br().'</tr>'.br();
	
	//@rsort($files);
	$checkindex=$arrayindex=$gesamt=0;
	$db_summary_anzahl=Array();
	if(count($files)>0) {
		for ($i=0; $i<sizeof($files); $i++)
		{
		    // Dateigr&ouml;&szlig;e
		    $size = filesize($fpath.$files[$i]);
			$file_datum=date("d\.m\.Y H:i", filemtime($fpath.$files[$i]));
			//statuszeile auslesen
			if(substr($files[$i],-2)=="gz"){
				if($config['zlib']) {
				$fp = gzopen ($fpath.$files[$i], "r");
				$statusline=gzgets($fp,40960);
				gzclose ($fp);
				} else $statusline="";
			}else{
				$fp = fopen ($fpath.$files[$i], "r");
				$statusline=fgets($fp,500);
				fclose ($fp);
			}
			$tabellenanzahl="-1";
			$eintraege="-1";
			$sline=ReadStatusline($statusline);
			if($sline[0]!="-1") {
				$tabellenanzahl=$sline[0];
				$eintraege=$sline[1];
			}
			$part=($sline[2]=="") ? 0 : substr($sline[2],3);
			$kommentar=(isset($sline[6])) ? $sline[6] : "";
			if($kommentar=="EXTINFO") $kommentar="";
			
			$but=ExtractBUT($files[$i]);
			if($but=="")$but=$file_datum;
			$dbn=ExtractDBname($files[$i]);
			//jetzt alle in ein Array packen
			
			
			if($part==0) {
				$db_backups[$arrayindex]['name']=$files[$i];
				$db_backups[$arrayindex]['db']=$dbn;
				$db_backups[$arrayindex]['size']=$size;
				$db_backups[$arrayindex]['date']=$but;
				$db_backups[$arrayindex]['tabellen']=$tabellenanzahl;
				$db_backups[$arrayindex]['eintraege']=$eintraege;
				$db_backups[$arrayindex]['multipart']=0;
				$db_backups[$arrayindex]['kommentar']=$kommentar;
				$db_backups[$arrayindex]['script']=(!empty($sline[4]) && !empty($sline[5])) ? $sline[4]."(".$sline[5].")" : "";
				
				if(!isset($db_summary_last[$dbn])) $db_summary_last[$dbn]=$but;
				$db_summary_anzahl[$dbn]=(isset($db_summary_anzahl[$dbn])) ? $db_summary_anzahl[$dbn]+1 : 1;
				$db_summary_size[$dbn]=(isset($db_summary_size[$dbn])) ? $db_summary_size[$dbn]+$size : $size;
				if($but>$db_summary_last[$dbn])$db_summary_last[$dbn]=$but;
				
			} else {
				//multipart nur einmal
				$done=0;
				for($j=0;$j<$arrayindex;$j++) {
					if(isset($db_backups[$j])) {
						if($db_backups[$j]['date']==$but) {
							$db_backups[$j]['multipart']++;
							$db_backups[$j]['size']+=$size;
							$db_summary_size[$dbn]+=$size;
							$done=1;
							break;
						}
					}
				}
				if($done==0) {
					//Eintrag war noch nicht vorhanden
					$db_backups[$arrayindex]['name']=$files[$i];
					$db_backups[$arrayindex]['db']=$dbn;
					$db_backups[$arrayindex]['size']=$size;
					$db_backups[$arrayindex]['date']=$but;
					$db_backups[$arrayindex]['tabellen']=$tabellenanzahl;
					$db_backups[$arrayindex]['eintraege']=$eintraege;
					$db_backups[$arrayindex]['multipart']=1;
					$db_backups[$arrayindex]['kommentar']=$kommentar;
					$db_backups[$arrayindex]['script']=$sline[4]."(".$sline[5].")";
				
					if(!isset($db_summary_last[$dbn])) $db_summary_last[$dbn]=$but;
					$db_summary_anzahl[$dbn]=(isset($db_summary_anzahl[$dbn])) ? $db_summary_anzahl[$dbn]+1 : 1;
					$db_summary_size[$dbn]=(isset($db_summary_size[$dbn])) ? $db_summary_size[$dbn]+$size : $size;
					if( $but>$db_summary_last[$dbn])$db_summary_last[$dbn]=$but;
					
				}
			}
	    // Gesamtgr&ouml;&szlig;e aller Backupfiles
		$arrayindex++;
	    $gesamt = $gesamt + $size;
		}
	}
	//Schleife fertig - jetzt Ausgabe
	
	// Hier werden die Dateinamen ausgegeben
	if($arrayindex>0) {
		for($i=$arrayindex;$i>=0;$i--) {
			if(isset($db_backups[$i]['db']) && $db_backups[$i]['db']==$dbactiv) {
				$multi=($db_summary_anzahl[$dbactiv]>1 && $action=="files") ? 1 : 0;
				$fl.='<input type="hidden" name="multi" value="'.$multi.'">';
				if($db_backups[$i]['multipart']>0) {$dbn=NextPart($db_backups[$i]['name'],1);}else{$dbn=$db_backups[$i]['name'];}
				$fl.='<tr '.(($dbactiv==$databases['db_actual']) ? 'class="dbrowsel"' : '').'>'.br();
				$fl.='<td align="left" colspan="2">'.br();
				if($multi==0){
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]['multipart'].'"><input name="file[]" type="radio" class="radio" value="'.$dbn.'" onClick="Check('.$checkindex++.',0);">';
				} else {
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]['multipart'].'"><input name="file[]" type="checkbox" class="checkbox" value="'.$dbn.'" onClick="Check('.$checkindex++.',1);">';
				}
				$fl.=($db_backups[$i]['multipart']==0) ? '&nbsp;<a href="'.$fpath.$dbn.'" title="Backupfile: '.$dbn.'" style="font-size:8pt;">'.$db_backups[$i]['db'].'</a></td>'.br() : '&nbsp;<span style="font-size:8pt;">'.$db_backups[$i]['db'].'</span></td>'.br();
				
				$fl.='<td class="sm" nowrap align="center">'.((substr($dbn,-3)==".gz") ? '<img src="images/gz.gif" alt="'.$lang['compressed'].'" width="16" height="16" border="0">' : "&nbsp;").'</td>';
				$fl.='<td class="sm" nowrap align="center">'.$db_backups[$i]['script'].'</td>';
				$fl.='<td class="sm" nowrap align="center">'.(($db_backups[$i]['kommentar']!="") ? '<img src="images/rename.gif" alt="'.$db_backups[$i]['kommentar'].'" width="16" height="16" border="0">' : "&nbsp;").'</td>';
				
				
				$fl.='<td class="sm" nowrap>'.$db_backups[$i]['date'].'</td>'.br();
				$fl.='<td align="center" style="font-size:8pt;">';
				$fl.=($db_backups[$i]['multipart']==0) ? $lang['no'] : '<a style="font-size:11px;" href="filemanagement.php?action=files&kind=0&dbactiv='.$dbactiv.'&expand='.$i.'">'.$db_backups[$i]['multipart'].' Files</a>'; //
				$fl.='</td>'.br().'<td align="center" style="font-size:8pt;" nowrap>';
				$fl.=($db_backups[$i]['eintraege']!=-1) ? $db_backups[$i]['tabellen'].' / '.number_format($db_backups[$i]['eintraege'],0,",",".") :$lang['fm_oldbackup'];
				$fl.='</td>'.br();
				$fl.='<td align="right" colspan="2" style="font-size:8pt;">'.byte_output($db_backups[$i]['size']).'</td>'.br();
				$fl.='</tr>'.br();
				
				if($expand==$i) {
					$fl.='<tr '.(($dbactiv==$databases['db_actual']) ? 'bgcolor="#e6e6e6"' : '').'>'.br();
					$fl.='<td class="sm" valign="top">All Parts:</td><td  class="sm" colspan="9">'.PartListe($db_backups[$i]['name'],$db_backups[$i]['multipart']).'</td>';
				}
			}
		}
	}
		
	$fl.='<tr>'.br().'<td colspan="10">&nbsp;&nbsp;&nbsp;<strong>'.$lang['fm_all_bu'].'</strong></td>'.br().'</tr>'.br();
	//Tableheader
	$fl.='<tr>'.br().'<td class="hd" colspan="4" style="text-align:left;">'.$lang['fm_dbname'].'</td>'.br().'
	<td class="hd" align="left">'.$lang['fm_anz_bu'].'</td>'.br().'
	<td class="hd">'.$lang['fm_last_bu'].'</td>'.br().'
	<td class="hd" colspan="4" style="text-align:right;">'.$lang['fm_totalsize'].'</td>'.br();
	//die anderen Backups
	if(count($db_summary_anzahl)>0) {
	while(list($key, $val) = each($db_summary_anzahl)) 
	{
		$keyaus=($key=="") ? "<em>[unknown]</em>" : $key;
		$fl.='<tr>'.br().'<td colspan="4"><a href="'.$href.'&dbactiv='.$key.'">'.$keyaus.'</a></td>'.br();
		$fl.='<td align="center">'.$val.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>'.br();
		$fl.='<td class="sm" nowrap>'.((isset($db_summary_last[$key])) ? $db_summary_last[$key] : "").'</td>'.br();
		$fl.='<td align="right" style="font-size:8pt;" colspan="5">'.byte_output($db_summary_size[$key]).'&nbsp;</td>'.br();
		$fl.='</tr>'.br(3);
		
	}
	}
	if (!is_array($files)) $fl.='<tr><td colspan="10" class="dbrow">'.$lang['fm_nofilesfound'].'</td></tr>'.br();
	
	//--------------------------------------------------------
	//*** Ausgabe der Gesamtgr&ouml;&szlig;e aller Backupfiles ***
	//--------------------------------------------------------
	$space = MD_FreeDiskSpace();
	$fl.= '<tr>'.br();
	$fl.= '<td align="left" colspan="7"><b>'.$lang['fm_sizesum'].'('.$Sum_Files.' files): </b> </td>'.br();
	$fl.= '<td align="right" colspan="3"><b>'.byte_output($gesamt).'</b></td>'.br();
	$fl.= '</tr>'.br();
	
	
	//--------------------------------------------------------
	//*** Ausgabe des freien Speicher auf dem Rechner ***
	//--------------------------------------------------------
	$fl.= '<tr class="dbrow">'.br();
	$fl.= '<td colspan="7">'.$lang['fm_freespace'].': </td>'.br();
	$fl.= '<td colspan="3" align="right"><b>'.$space.'</b></td>'.br();
	$fl.= '</tr>'.br();
	$fl.= '</table>'.br();
	
	return $fl;
}

function PartListe($f,$nr)
{
	global $config;
	$dateistamm=substr($f,0,strrpos($f,"part_"))."part_";
	$dateiendung=(substr(strtolower($f),-2)=="gz")?".sql.gz":".sql";
	$s="";
	for($i=1;$i<=$nr;$i++) {
		if($i>1) $s.="<br>";
		$s.='<a href="'.$config['paths']['backup'].$dateistamm.$i.$dateiendung.'" style="font-size:8pt;">'.$dateistamm.$i.$dateiendung.'</a>&nbsp;&nbsp;&nbsp;&nbsp;'.byte_output(@filesize($config['paths']['backup'].$dateistamm.$i.$dateiendung));
	}
	return $s;
}
function Converter($filesource,$filedestination,$cp) {
	global $config,$lang;
	
	$cps=(substr(strtolower($filesource),-2)=="gz") ? 1 : 0;
	echo "<h5>".sprintf($lang["convert_fileread"],$filesource).".....</h5><span style=\"font-size:10px;\">";
	if(file_exists($config["paths"]["backup"].$filedestination)) unlink($config["paths"]["backup"].$filedestination);
	$f = ($cps==1) ? gzopen($config["paths"]["backup"].$filesource,"r") : fopen($config["paths"]["backup"].$filesource,"r");
	$z=  ($cps==1)  ? gzopen($config["paths"]["backup"].$filedestination,"w") : fopen($config["paths"]["backup"].$filedestination,"w");
	$insert=$mode="";
	$n=0;
	$eof= ($cps==1) ? gzeof($f) : feof($f);
	WHILE (!$eof)
	{
		$eof= ($cps==1) ? gzeof($f) : feof($f);
		$zeile= ($cps==1) ? gzgets($f,8192) : fgets($f,8192);
		if (substr($zeile,0,2)=="--") $zeile="";
		//$zeile=rtrim($zeile);
		$t=strtolower(substr($zeile,0,10));
		if ($t>"")
		{
			switch ($t)
			{
				case "insert int":
					{
						// eine neue Insert Anweisung beginnt
						$insert= substr($zeile,0,strpos($zeile,"("));
						if(substr(strtoupper($insert),-7)!="VALUES ") $insert.="VALUES ";
						$mode="insert";
						
					};
					break;
				case "create tab":
					{
						$mode="create";
						WHILE (substr(rtrim($zeile),-1)!=";") 
						{ 
							$zeile.=fgets($f,8192);
						}
						$zeile=MySQL_Ticks($zeile);
						break;
					}
				case "drop table":
					{
						$mode="drop";
						$zeile.="\n";
						break;
					}
			}
			if ($mode=="insert") 
			{
				// Komma loeschen
				$zeile=str_replace("),(",");\n$insert (",$zeile);
				if(substr(rtrim($zeile),0,2)==",(" && $insert !="") {
					$zeile=";\n".$insert.substr($zeile,1);
				}
				if(substr(rtrim($zeile),-2)==")," && $insert !="") {
					$zeile=substr(rtrim($zeile),0,strlen(rtrim($zeile))-1).";\n$insert";
				}
			}
			$n++;
			if ($n>1000) { $n=0;echo "<br>"; }
			echo ".";
			if($cps==1) gzwrite($z,$zeile); else fwrite($z,$zeile);
		}
		flush();
		$n++;
	}
	if($cps==1) gzclose($z); else fclose($z);
	if($cps==1) gzclose($f); else fclose($f);
	echo "</span><h5>".sprintf($lang["convert_finished"],$filedestination)."</h5>";
}


?>