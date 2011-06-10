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

function sortierdatum($datum)
{
	$p=explode(' ',$datum);
	$uhrzeit=$p[1];
	$p2=explode('.',$p[0]);
	$day=$p2[0];
	$month=$p2[1];
	$year=$p2[2];
	return $year.'.'.$month.'.'.$day.' '.$uhrzeit;
}

function FileList($multi=0)
{
	global $config,$kind,$fpath,$lang,$databases,$href,$dbactiv,$action,$expand;

	$files=Array();
	if($kind==0){
		//Backup-Dateien
		$Theader=$lang['fm_files1'].' '.$lang['of'].' "'.$dbactiv.'"';
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
	$i=0;
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != ".." && !is_dir($fpath.$filename))
		{
			$files[$i]['name'] = $filename;
			$Sum_Files++;
			$i++;
		}
	}

	$fl.='<div align="center">'.br().$lang['fm_choose_file'].br();
	$fl.='<span id="gd">&nbsp;</span>'.br().'<br><br>';

	$fl.='<table class="border">'.br();
	$fl.='<tr>'.br().'<td colspan="8" align="left"><strong>'.$Theader.'</strong></td>'.br().'<td colspan="3" align="right"><a href="filemanagement.php?action='.$action.'&amp;kind='.$akind.'" class="small">'.$Wheader.'</a></td>'.br().'</tr>'.br();

	//Tableheader
	$fl.='<tr class="thead">'.br().'<th colspan="2">'.$lang['db'].'</th>'.br().'
	<th>gz</th>'.br().'
	<th>Script</th>'.br().'
	<th colspan="2">'.$lang['comment'].'</th>'.br().'

	<th>'.$lang['fm_filedate'].'</th>'.br().'
	<th>Multipart</th>'.br().'
	<th>'.$lang['fm_tables'].' / '.$lang['fm_records'].'</th>'.br().'
	<th align="right" colspan="2">'.$lang['fm_filesize'].'</th>'.br().'
	<th align="right" >'.$lang['encoding'].'</th>'.br().'</tr>'.br();

	$checkindex=$arrayindex=$gesamt=0;
	$db_summary_anzahl=Array();
	if(count($files)>0)
	{
		for ($i=0; $i<sizeof($files); $i++)
		{
		    // Dateigr&ouml;&szlig;e
		    $size = filesize($fpath.$files[$i]['name']);
			$file_datum=date("d\.m\.Y H:i", filemtime($fpath.$files[$i]['name']));

			//statuszeile auslesen
			$sline='';

			if(substr($files[$i]['name'],-2)=="gz"){
				if($config['zlib']) {
				$fp = gzopen ($fpath.$files[$i]['name'], "r");
				$sline=gzgets($fp,40960);
				gzclose ($fp);
				}
			}else{
				$fp = fopen ($fpath.$files[$i]['name'], "r");
				$sline=fgets($fp,5000);
				fclose ($fp);
			}
			$statusline=ReadStatusline($sline);

			$but=ExtractBUT($files[$i]['name']);
			if ($but=="") $but=$file_datum;
			$dbn=$statusline['dbname'];

			//jetzt alle in ein Array packen
			if($statusline['part']=="MP_0" || $statusline['part']=="")
			{
				$db_backups[$arrayindex]['name']=$files[$i]['name'];
				$db_backups[$arrayindex]['db']=$dbn;
				$db_backups[$arrayindex]['size']=$size;
				$db_backups[$arrayindex]['date']=$but;
				$db_backups[$arrayindex]['sort']=sortierdatum($but);
				$db_backups[$arrayindex]['tabellen']=$statusline['tables'];
				$db_backups[$arrayindex]['eintraege']=$statusline['records'];
				$db_backups[$arrayindex]['multipart']=0;
				$db_backups[$arrayindex]['kommentar']=$statusline['comment'];
				$db_backups[$arrayindex]['script']=($statusline['script']!="") ? $statusline['script']."(".$statusline['scriptversion'].")" : "";
				$db_backups[$arrayindex]['charset']=$statusline['charset'];

				if(!isset($db_summary_last[$dbn])) $db_summary_last[$dbn]=$but;
				$db_summary_anzahl[$dbn]=(isset($db_summary_anzahl[$dbn])) ? $db_summary_anzahl[$dbn]+1 : 1;
				$db_summary_size[$dbn]=(isset($db_summary_size[$dbn])) ? $db_summary_size[$dbn]+$size : $size;
				if($but>$db_summary_last[$dbn])$db_summary_last[$dbn]=$but;
			}
			else
			{
				//multipart nur einmal
				$done=0;
				if(!isset($db_summary_size[$dbn])) $db_summary_size[$dbn]=0;
				for($j=0;$j<$arrayindex;$j++)
				{
					if(isset($db_backups[$j]))
					{
						if ( ($db_backups[$j]['date']==$but) && ($db_backups[$j]['db']==$dbn) )
						{
							$db_backups[$j]['multipart']++;
							$db_backups[$j]['size']+=$size;
							$db_summary_size[$dbn]+=$size;
							$done=1;
							break;
						}
					}
				}
				if ($done==1) $arrayindex--;

				if($done==0)
				{
					//Eintrag war noch nicht vorhanden
					$db_backups[$arrayindex]['name']=$files[$i]['name'];
					$db_backups[$arrayindex]['db']=$dbn;
					$db_backups[$arrayindex]['size']=$size;
					$db_backups[$arrayindex]['date']=$but;
					$db_backups[$arrayindex]['sort']=sortierdatum($but);
					$db_backups[$arrayindex]['tabellen']=$statusline['tables'];
					$db_backups[$arrayindex]['eintraege']=$statusline['records'];
					$db_backups[$arrayindex]['multipart']=1;
					$db_backups[$arrayindex]['kommentar']=$statusline['comment'];
					$db_backups[$arrayindex]['script']=($statusline['script']!="") ? $statusline['script']."(".$statusline['scriptversion'].")" : "";
					$db_backups[$arrayindex]['charset']=$statusline['charset'];

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
	if ( (isset($db_backups)) && (is_array($db_backups)) ) $db_backups=mu_sort($db_backups,'sort,name');

	// Hier werden die Dateinamen ausgegeben
	$rowclass=0;
	if($arrayindex>0) {
		for($i=$arrayindex;$i>=0;$i--) {
			//$cl= ($rowclass % 2) ? "dbrow" : "dbrow1";
			if(isset($db_backups[$i]['db']) && $db_backups[$i]['db']==$dbactiv)
			{
				$multi=($db_summary_anzahl[$dbactiv]>1 && $action=="files") ? 1 : 0;

				$fl.='<input type="hidden" name="multi" value="'.$multi.'">';
				if($db_backups[$i]['multipart']>0) {$dbn=NextPart($db_backups[$i]['name'],1);}else{$dbn=$db_backups[$i]['name'];}
				$fl.='<tr ';
				$fl.='class="'.(($rowclass % 2) ?  'dbrow"':'dbrow1"');
				$fl.='>'.br();
				$fl.='<td align="left" colspan="2" nowrap>'.br();
				if($multi==0)
				{
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]['multipart'].'"><input name="file[]" type="radio" class="radio" value="'.$dbn.'" onClick="Check('.$checkindex++.',0);">';
				}
				else
				{
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]['multipart'].'"><input name="file[]" type="checkbox" class="checkbox" value="'.$dbn.'" onClick="Check('.$checkindex++.',1);">';
				}
				$fl.=($db_backups[$i]['multipart']==0) ? '&nbsp;<a href="'.$fpath.$dbn.'" title="Backupfile: '.$dbn.'" style="font-size:8pt;" target="_blank">'.(($db_backups[$i]['db']=='unknown') ? $dbn : $db_backups[$i]['db']).'</a></td>'.br() : '&nbsp;<span style="font-size:8pt;">'.$db_backups[$i]['db'].'</span></td>'.br();

				$fl.='<td class="sm" nowrap align="center">'.((substr($dbn,-3)==".gz") ? '<img src="'.$config['files']['iconpath'].'gz.gif" alt="'.$lang['compressed'].'" width="16" height="16" border="0">' : "&nbsp;").'</td>';
				$fl.='<td class="sm" nowrap align="center">'.$db_backups[$i]['script'].'</td>';
				$fl.='<td class="sm" nowrap align="right">'.(($db_backups[$i]['kommentar']!="") ? '<img src="'.$config['files']['iconpath'].'rename.gif" alt="'.$db_backups[$i]['kommentar'].'" title="'.$db_backups[$i]['kommentar'].'" width="16" height="16" border="0">' : "&nbsp;").'</td>';
				$fl.='<td class="sm" nowrap align="left">'.(($db_backups[$i]['kommentar']!="") ? nl2br(wordwrap($db_backups[$i]['kommentar'],50)) : "&nbsp;").'</td>';

				$fl.='<td class="sm" nowrap>'.$db_backups[$i]['date'].'</td>'.br();
				$fl.='<td style="text-align:center">';
				$fl.=($db_backups[$i]['multipart']==0) ? $lang['no'] : '<a style="font-size:11px;" href="filemanagement.php?action=files&kind=0&dbactiv='.$dbactiv.'&expand='.$i.'">'.$db_backups[$i]['multipart'].' Files</a>'; //
				$fl.='</td>'.br().'<td  style="text-align:right;padding-right:12px;" nowrap>';
				$fl.=($db_backups[$i]['eintraege']!=-1) ? $db_backups[$i]['tabellen'].' / '.number_format($db_backups[$i]['eintraege'],0,",",".") :$lang['fm_oldbackup'];
				$fl.='</td>'.br();
				$fl.='<td align="right" colspan="2" style="font-size:8pt;">'.byte_output($db_backups[$i]['size']).'</td>'.br();
				$fl.='<td align="right" style="font-size:8pt;">'.$db_backups[$i]['charset'].'</td>'.br();
				$fl.='</tr>'.br();

				if($expand==$i) {
					$fl.='<tr '.(($dbactiv==$databases['db_actual']) ? 'class="dbrowsel"' : 'class="'.$cl.'"').'>'.br();
					$fl.='<td class="sm" valign="top">All Parts:</td><td  class="sm" colspan="11" align="left">'.PartListe($db_backups[$i]['name'],$db_backups[$i]['multipart']).'</td>';
				}
			$rowclass++;
			}
		}
	}

	$fl.='<tr>'.br().'<td colspan="11" align="left"><br><strong>'.$lang['fm_all_bu'].'</strong></td>'.br().'</tr>'.br();
	//Tableheader
	$fl.='<tr class="thead">'.br().'<th colspan="5" align="left">'.$lang['fm_dbname'].'</th>'.br().'
	<th align="left">'.$lang['fm_anz_bu'].'</th>'.br().'
	<th>'.$lang['fm_last_bu'].'</th>'.br().'
	<th colspan="5" style="text-align:right;">'.$lang['fm_totalsize'].'</th></tr>'.br();
	//die anderen Backups
	if(count($db_summary_anzahl)>0)
	{
		$i=0;
		while(list($key, $val) = each($db_summary_anzahl))
		{
			$cl= ($i++ % 2) ? "dbrow" : "dbrow1";
			$keyaus=($key=="unknown") ? '<em>'.$lang['no_msd_backupfile'].'</em>' : $key;
			$fl.='<tr class="'.$cl.'">'.br().'<td colspan="5" align="left"><a href="'.$href.'&dbactiv='.$key.'">'.$keyaus.'</a></td>'.br();
			$fl.='<td style="text-align:right">'.$val.'&nbsp;&nbsp;</td>'.br();
			$fl.='<td class="sm" nowrap>'.((isset($db_summary_last[$key])) ? $db_summary_last[$key] : "").'</td>'.br();
			$fl.='<td style="text-align:right;font-size:8pt;" colspan="5">'.byte_output($db_summary_size[$key]).'&nbsp;</td>'.br();
			$fl.='</tr>'.br(3);
		}
	}
	if (!is_array($files)) $fl.='<tr><td colspan="11">'.$lang['fm_nofilesfound'].'</td></tr>'.br();

	//--------------------------------------------------------
	//*** Ausgabe der Gesamtgr&ouml;&szlig;e aller Backupfiles ***
	//--------------------------------------------------------
	$space = MD_FreeDiskSpace();
	$fl.= '<tr>'.br();
	$fl.= '<td align="left" colspan="8"><b>'.$lang['fm_totalsize'].' ('.$Sum_Files.' files): </b> </td>'.br();
	$fl.= '<td style="text-align:right" colspan="4"><b>'.byte_output($gesamt).'</b></td>'.br();
	$fl.= '</tr>'.br();


	//--------------------------------------------------------
	//*** Ausgabe des freien Speicher auf dem Rechner ***
	//--------------------------------------------------------
	$fl.= '<tr>'.br();
	$fl.= '<td colspan="8" align="left">'.$lang['fm_freespace'].': </td>'.br();
	$fl.= '<td colspan="4"  style="text-align:right"><b>'.$space.'</b></td>'.br();
	$fl.= '</tr>'.br();
	$fl.= '</table></div>'.br();

	return $fl;
}

function read_statusline_from_file($filename)
{
	global $config;
	if(strtolower(substr($filename,-2))=='gz')
	{
		$fp = gzopen ($config['paths']['backup'].$filename, "r");
		if ($fp===false) die('Can\'t open file '.$filename);
		$sline=gzgets($fp,40960);
		gzclose ($fp);
	}
	else
	{
		$fp = fopen ($config['paths']['backup'].$filename, "r");
		if ($fp===false) die('Can\'t open file '.$filename);
		$sline=fgets($fp,5000);
		fclose ($fp);
	}
	$statusline=ReadStatusline($sline);
	return $statusline;
}
function PartListe($f,$nr)
{
	global $config;
	$dateistamm=substr($f,0,strrpos($f,"part_"))."part_";
	$dateiendung=(substr(strtolower($f),-2)=="gz")?".sql.gz":".sql";
	$s="";
	for($i=1;$i<=$nr;$i++) {
		if($i>1) $s.="<br>";
		$s.='<a href="'.$config['paths']['backup'].$dateistamm.$i.$dateiendung.'">'.$dateistamm.$i.$dateiendung.'</a>&nbsp;&nbsp;&nbsp;'.byte_output(@filesize($config['paths']['backup'].$dateistamm.$i.$dateiendung));
	}
	return $s;
}
function Converter($filesource,$filedestination,$cp) {
	global $config,$lang;

	$cps=(substr(strtolower($filesource),-2)=="gz") ? 1 : 0;
	echo "<h5>".sprintf($lang['convert_fileread'],$filesource).".....</h5><span style=\"font-size:10px;\">";
	if(file_exists($config['paths']['backup'].$filedestination)) unlink($config['paths']['backup'].$filedestination);
	$f = ($cps==1) ? gzopen($config['paths']['backup'].$filesource,"r") : fopen($config['paths']['backup'].$filesource,"r");
	$z=  ($cps==1)  ? gzopen($config['paths']['backup'].$filedestination,"w") : fopen($config['paths']['backup'].$filedestination,"w");
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
						$zeile="\n\r".MySQL_Ticks($zeile)."\n\r";
						break;
					}
				case "drop table":
					{
						$mode="drop";
						$zeile.="\n\r";
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
	echo "</span><h5>".sprintf($lang['convert_finished'],$filedestination)."</h5>";
}


?>
