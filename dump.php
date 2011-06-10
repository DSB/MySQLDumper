<?
include_once("inc/functions_dump.php");
include_once($config["files"]["parameter"]); 
include_once("inc/mysql.php");
include_once("language/".$config["language"]."/lang.php");
include_once("language/".$config["language"]."/lang_dump.php");

$pageheader=MSDHeader();
$DumpFertig=0;
//Browserweiche
if($config["browser_switch"]==0) {
	$frames=(MSD_BROWSER_AGENT == "IE") ? 0 : 1;
} else $frames=$config["browser_switch"]-1;

$relativ_path=($frames==1) ? "../../" : "./";


//$_GET-Parameter lesen
$dump["kommentar"]=(isset($_GET['comment'])) ? urldecode($_GET['comment']): "";
$dump["backupdatei"]=(isset($_GET['backupdatei'])) ? $_GET['backupdatei'] :"";
$dump["backupdatei_structure"]= (isset($_GET['backupdateistructure'])) ? $_GET['backupdateistructure'] : ""; 
$cancel=(isset($_GET["cancel"])) ? 1 : 0;
$dump["part"]=(isset($_GET["part"])) ? $_GET["part"] : 1;
$dump["part_offset"]=(isset($_GET["part_offset"])) ? $_GET["part_offset"] : 0;
$dump["verbraucht"]=(isset($_GET["verbraucht"])) ? $_GET["verbraucht"] : 0;
$out=(file_exists($config["paths"]["log"]."out.tmp")) ? implode("\n",file($config["paths"]["log"]."out.tmp")) : "";
$dump["errors"]= (isset($_GET['err'])) ? $_GET['err'] : 0;
$dump["table_offset"]=(isset($_GET["table_offset"])) ? $_GET["table_offset"] : -1;
$dump["zeilen_offset"]= (isset($_GET['zeilen_offset'])) ? $_GET['zeilen_offset']:0;
$dump["filename_stamp"]= (isset($_GET['filename_stamp'])) ? $_GET['filename_stamp'] : "";
$dump["anzahl_zeilen"]= (isset($_GET["anzahl_zeilen"])) ? $_GET["anzahl_zeilen"] : (($config["minspeed"]>0) ? $config["minspeed"] : 50);
$dump["totalrecords"]=(isset($_GET["totalrecords"])) ? $_GET["totalrecords"] : 0;

$mp2=array("Bytes","Kilobytes","Megabytes","Gigabytes");
$cancelurl='dump.php?cancel=1&part='.$dump["part"].'&backupdatei='.urlencode($dump["backupdatei"]).'&backupdateistructure='.urlencode($dump["backupdatei_structure"]);
$aus2=$page_parameter=$debugausgabe=$a="";
$dump["tabellen_gesamt"]=0;


if($cancel==1) {
	//Abbruch durch Benutzer
	//Wildcard erzeugen
	$wildcard=substr($dump["backupdatei"],0,strlen($databases["db_actual"])+17);
	$wildcard2=$dump["backupdatei_structure"];
	echo "$pageheader<h1>Abruch durch Benutzer</h1>Der Backupvorgang wurde unterbrochen.<br><br>";
	echo "Folgende angefangene Backupdateien wurden gelöscht:<br><br>";
	echo $wildcard."*<br>".$wildcard2;
	echo '</div></body></html>';
	exit;
}


FillMultiDBArrays();

if($databases["db_actual_tableselected"]!="" && $config["multi_dump"]==0) {
	$dump["tblArray"]=explode("|",$databases["db_actual_tableselected"]);
	$tbl_sel=true;
	$msgTbl=" - mit ".count($dump["tblArray"])." selektierten Tabellen";
}

//Zeitzähler aktivieren
$dump["max_zeit"]=intval($config["max_execution_time"]*$config["time_buffer"]);
$dump["startzeit"]=time();

if (isset($_GET['xtime'])) 
{
	$xtime=$_GET['xtime']; 
} else {
	$xtime=time();
}
$dump["countdata"]= (!empty($_GET['countdata'])) ? $_GET['countdata'] : 0;
$dump["aufruf"]= (!empty($_GET['aufruf'])) ? $_GET['aufruf'] : 0;

MSD_mysql_connect(); 

$flipped = array_flip($databases["Name"]);
$dump["tables"]=Array();


for($ii=0;$ii<count($databases["multi"]);$ii++) {
	$dump["dbindex"]=$flipped[$databases["multi"][$ii]]; 
	$tabellen = mysql_list_tables($databases["Name"][$dump["dbindex"]],$config["dbconnection"]); 
	$num_tables = mysql_num_rows($tabellen); 
	// Array mit den gewünschten Tabellen zusammenstellen... wenn Präfix angegeben, werden die anderen einfach nicht übernommen
	if ($num_tables>0)
	{
		for ($i=0;$i<$num_tables;$i++) 
		{ 
			$erg=mysql_fetch_row($tabellen);
			if($config["optimize_tables_beforedump"]==1 && $dump["table_offset"]==-1) {
				//Tabelle optimieren
				mysql_query("OPTIMIZE `$erg[0]`");
			}
			if (isset($tbl_sel))
			{
				if (in_array($erg[0],$dump["tblArray"])) $dump["tables"][]=$databases["Name"][$dump["dbindex"]].".".$erg[0];
			}
			elseif ($databases["praefix"][$dump["dbindex"]]>"" && !isset($tbl_sel))
			{
				echo "$erg[0] - ".$databases["praefix"][$dump["dbindex"]]."<br>";
				if (substr($erg[0],0,strlen($databases["praefix"][$dump["dbindex"]]))==$databases["praefix"][$dump["dbindex"]]) $dump["tables"][]=$databases["Name"][$dump["dbindex"]].".".$erg[0];;
			}
			else $dump["tables"][]=$databases["Name"][$dump["dbindex"]].".".$erg[0];
		}
	}
	else $aus_error[]= '<p class="smallwarnung">'.$lang["error"].": ".sprintf($lang["dump_notables"],$databases["Name"][$dump["dbindex"]]).'</p>';
}

$num_tables=count($dump["tables"]);
if($config["optimize_tables_beforedump"]==1 && $dump["table_offset"]==-1) $out.='<span class="smallblue">'.$num_tables.' Tabellen wurden optimiert.</span><br>';

$dump["data"]=""; 
$dump["structure"]="";
$dump["dbindex"]=(isset($_GET["dbi"])) ? $_GET["dbi"] :$flipped[$databases["multi"][0]]; 



//Ausgaben-Header bauen
$aus_header[]= PicCache($relativ_path);
$aus_header[]= headline('Backup: '.(($config["multi_dump"]==1) ? "Multidump (".count($databases["multi"])." ".$lang["dbs"].")" : $lang["db"].': '.$databases["Name"][$dump["dbindex"]].(($databases["praefix"][$dump["dbindex"]]!="") ?' ('.$lang["withpraefix"].' <span class="blau">'.$databases["praefix"][$dump["dbindex"]].'</span>)' : '')));
if(isset($aus_error) && count($aus_error)>0) $aus_header=array_merge($aus_header,$aus_error);

$aus_header[]='Browser : <img src="'.$relativ_path.$BrowserIcon.'"> '.(($config["browser_switch"]==0) ? " (automatisch erkannt)" : ""); //.' / '.$frames;
if(count($dump["tables"])==0) {
	//keine Tabellen gefunden
	$aus[]='<p class="Warnung">'.sprintf($lang['dump_notables'],$databases["Name"][$dump["dbindex"]]).'</p>';
	if($config["multi_dump"]==1) {
	
	}
} else {

	if ($dump["table_offset"]==-1) {
		// File anlegen, da Erstaufruf
		new_file();
		$dump["table_offset"]=0; // jetzt kanns losgehen
		flush();
	} else {
	
	// SQl-Befehle ermitteln
	$dump["restzeilen"]=$dump["anzahl_zeilen"];
	WHILE ( ($dump["table_offset"] < $num_tables) && ($dump["restzeilen"]>0) ) 
	{ 
		$table = substr($dump["tables"][$dump["table_offset"]],strpos($dump["tables"][$dump["table_offset"]],".")+1); 
		$adbname=substr($dump["tables"][$dump["table_offset"]],0,strpos($dump["tables"][$dump["table_offset"]],"."));
		if($databases["Name"][$dump["dbindex"]]!=$adbname) {
			//neue Datenbank
			WriteLog("Dump '".$dump["backupdatei"]."' finished.");
			ExecuteCommand("a");
			if($config["multi_part"]==1) {
				$out.=$lang['finished'].'<br><div style="padding-left:20px;">';
				$dateistamm=substr($dump["backupdatei"],0,strrpos($dump["backupdatei"],"part_"))."part_";
				$dateiendung=($config["compression"]==1)?".sql.gz":".sql";
				for ($i=1;$i<($dump["part"]-$dump["part_offset"]);$i++) {
					$mpdatei=$dateistamm.$i.$dateiendung;
					clearstatcache();
					$sz=byte_output(@filesize($config["paths"]["backup"].$mpdatei));
					$out.= $lang["file"].' <a href="'.$config["paths"]["backup"].$mpdatei.'" class="smallblack">'.$mpdatei.' ('.$sz.')</a> '.$lang["dump_successful"].'<br>';
				}
				$out.='</div><br>';
			} else {
				clearstatcache();
				$out.=$lang['finished'].': <a href="'.$config["paths"]["backup"].$dump["backupdatei"].'" class="smallblack">'.$dump["backupdatei"].' ('.byte_output(filesize($config["paths"]["backup"].$dump["backupdatei"])).")</a><br>";
			}
			if ($config["send_mail"]==1) DoEmail();
			if($config["ftp_transfer"]==1) DoFTP();
			if(isset($flipped[$adbname])) $dump["dbindex"]=$flipped[$adbname];
			$dump["part_offset"]=$dump["part"]-1;
			
			new_file();
		}
		$aktuelle_tabelle=$dump["table_offset"]; 
	   	//echo "$adbname - $table<br>";
		if ($dump["zeilen_offset"]==0) 
		{
			if($config["minspeed"]>0) {
				$dump["anzahl_zeilen"]=$config["minspeed"];
				$dump["restzeilen"]=$config["minspeed"];
			}
			$dump["data"] .= get_def($adbname,$table); 
			$dump["structure"].=get_def($adbname,$table,0); 
		}
		WriteToDumpFile();
		
		get_content($adbname,$table);
		
		$dump["restzeilen"]--; 
		
		if($config["memory_limit"]>0 && strlen($dump["data"])>$config["memory_limit"]) {
			WriteToDumpFile();
		}
		
	} 
}
	/////////////////////////////////
	// Anzeige - Fortschritt
	/////////////////////////////////
	
	if($config["multi_dump"]==1) {
		$aus[]= '<div style="word-spacing:3mm; white-space:normal;">';
		for($i=0;$i<count($databases["multi"]);$i++) {
			$a.=$databases["multi"][$i];
			if($databases["Name"][$dump["dbindex"]]==$databases["multi"][$i]) 
				$aus[]= '<span style="color:red"><strong>'.$databases["multi"][$i].'</strong></span> ';
			else
				$aus[]= '<span style="color:green">'.$databases["multi"][$i].'</span> ';
			if(strlen($a)>60) {$aus[]='<br>';$a="";}
		}
		$aus[]= '</div>';
	}
	if($config["multi_part"]==1) $aus[]= '<h5>Multipart-Backup: '.$config["multipartgroesse1"].' '.$mp2[$config["multipartgroesse2"]].'</h5>';
	
	$aus[]= '<h4>'.$lang["dump_headline"].'</h4>';
	
	if($dump["kommentar"]) $aus[]= $lang['comment'].': <span style="color:green;">'.$dump["kommentar"].'</span><br>';
	if($config["multi_dump"]==1) $aus[]= $lang["db"].': <strong>'.$databases["Name"][$dump["dbindex"]].'</strong>'.(($databases["praefix"][$dump["dbindex"]]!="") ?' ('.$lang["withpraefix"].' <span style="color:blue">'.$databases["praefix"][$dump["dbindex"]].'</span>)' : '').'<br>';
	if(isset($tbl_sel)) $aus[]= $msgTbl.'<br><br>';

	
	
	if($config["multi_part"]==1)
	{
		$aus[]= '<span style="color:green;">Multipart-Backup File <strong>'.($dump["part"]-$dump["part_offset"]-1).'</strong></span><br>';
		$aus2=", ".($dump["part"]-1)." files";
	}
	$aus[]= $lang["dump_filename"]."<b>".$dump["backupdatei"]."</b>";
	$aus[]= '<br>'.$lang['filesize'].': <b>'.byte_output($dump["filesize"]).'</b><br><br>'.$lang["gzip_compression"].' <b>';
	$aus[]= ($config["compression"]==1) ? $lang["activated"] : $lang["not_activated"];
	$aus[]= '</b>.<br>';
	
	
	
	$table = @substr($dump["tables"][$dump["table_offset"]],strpos($dump["tables"][$dump["table_offset"]],".")+1); 
	$adbname=@substr($dump["tables"][$dump["table_offset"]],0,strpos($dump["tables"][$dump["table_offset"]],"."));
		
	$sql="SELECT COUNT(*) AS anzahl FROM `$table`";
	$res=mysql_query($sql);
	if ($res)
	{
		$row=mysql_fetch_object($res);
		$dump["zeilen_total"]=intval($row->anzahl);
		
		if ($dump["zeilen_total"]>0)
		{
			$fortschritt=round(((100*$dump["zeilen_offset"])/$dump["zeilen_total"]),0);
			if ($dump["anzahl_zeilen"]>=$dump["zeilen_total"]) $fortschritt=100;
		}
		else $fortschritt=100;
		//Debug-Ausgabe
		//$aus[]="Restzeilen: ".$dump["zeilen_total"]."  (".$dump["zeilen_offset"].")<br>";
		//$aus[]='<br><br>';
	
		$aus[]= $lang["saving_table"].'<b>'.($dump["table_offset"]+1).'</b> '.$lang["of"].'<b> '.sizeof($dump["tables"]).'</b><br>'
			.$lang["actual_table"].': <b>'.$table.'</b><br><br>'
			.$lang["progress_table"].':<br>';
		
		
		$aus[]= '<table border="0" width="380"><tr>'
			.'<td width="'.($fortschritt*3).'"><img src="'.$relativ_path.'images/fbd.gif" alt="" width="'.($fortschritt*3).'" height="16" border="0"></td>'
			.'<td width="'.((100-$fortschritt)*3).'">&nbsp;</td>'
			.'<td width="80" align="right">'.($fortschritt).'%</td>';
	
		if ($dump["anzahl_zeilen"]+$dump["zeilen_offset"]>=$dump["zeilen_total"]) 
		{
			$eintrag=$dump["zeilen_offset"]+1;
			$zeilen_gesamt=$dump["zeilen_total"];
			if ($zeilen_gesamt==0) $eintrag=0;
		}
		else 
		{
			$zeilen_gesamt=$dump["zeilen_offset"]+$dump["anzahl_zeilen"];
			$eintrag=$dump["zeilen_offset"]+1;
		}
	
		$aus[]= '</tr><tr>'
			.'<td colspan="3">'.$lang["entry"].' <b>'.number_format($eintrag,0,",",".").'</b> '.$lang["upto"].' <b>'
			.number_format(($zeilen_gesamt),0,",",".").'</b> '.$lang["of"].' <b>'
			.number_format($dump["zeilen_total"],0,",",".").'</b></td></tr></table>';
	
		$dump["tabellen_gesamt"]=(isset($dump["tables"])) ? count($dump["tables"]) : 0;
		//$noch_zu_speichern=$dump["tabellen_gesamt"]-$dump["table_offset"];
		//$prozent= ($dump["tabellen_gesamt"]>0) ? round(((100*$noch_zu_speichern)/$dump["tabellen_gesamt"]),0) : 100;
		$noch_zu_speichern=$dump["totalrecords"]-$dump["countdata"];
		$prozent= ($dump["totalrecords"]>0) ? round(((100*$noch_zu_speichern)/$dump["totalrecords"]),0) : 100;
		if ($noch_zu_speichern==0) $prozent=100;
	
		$aus[]= '<br>'.$lang["progress_over_all"].':'
			.'<table border="0" width="550" cellpadding="0" cellspacing="0"><tr>'
			.'<td width="'.(5*(100-$prozent)).'"><img src="'.$relativ_path.'images/fbd.gif" alt="" width="'.(5*(100-$prozent)).'" height="16" border="0"></td>'
			.'<td width="'.($prozent*5).'" align="center"></td>'
			.'<td width="50">'.(100-$prozent).'%</td></tr></table>';
			
		//Speed-Anzeige
		$fw=($config["maxspeed"]==$config["minspeed"]) ? 300 : round(($dump["anzahl_zeilen"]-$config["minspeed"])/($config["maxspeed"]-$config["minspeed"])*300,0);
		if($fw>300)$fw=300;
		$aus[]= '<br><table border="0" cellpadding="0" cellspacing="0"><tr nowrap>';
		$aus[]= '<td class="nomargin" width="60" valign="top" align="center" style="font-size:10px;" >';
		$aus[]= '<strong>Speed</strong><br>'.$dump["anzahl_zeilen"].'</td><td class="nomargin" width="300">';
		$aus[]= '<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr nowrap>';
		$aus[]= '<td class="nomargin" align="left"class="small" width="300" nowrap><img src="'.$relativ_path.'images/fbs.gif" alt="" width="'.$fw.'" height="14" border="0" vspace="0" hspace="0">';
		$aus[]= '</td></tr></table><table border="0" width="100%" cellpadding="0" cellspacing="0"><tr nowrap>';
		$aus[]= '<td class="nomargin" align="left" width="50%" nowrap style="font-size:10px;" >'.$config["minspeed"].'</td>';
		$aus[]= '<td class="nomargin" align="right" width="50%" nowrap style="font-size:10px;" >'.$config["maxspeed"].'</td>';
		$aus[]= '</tr></table></td></tr></table>';
		
		//Status-Text	
		$aus[]= '<p class="small">'.zeit_format(time()-$xtime).', '.$dump["aufruf"].' pages'.$aus2;  
		$aus[]= ($dump["errors"]>0) ? ', <span style="color:red;">'.$dump["errors"].' errors</span>' : '';
		$aus[]= '</p>';
		$aus[]= '<div style="position:absolute;width:600px;height:90px;overflow:auto;"><span class="smallgrey">'.$out.'</span></div></div>';
		
	}
	//////////////////////////////////////
	// Ende Anzeige
	//////////////////////////////////////
	
	WriteToDumpFile();
	
	flush();
	if(!isset($summe_eintraege)) $summe_eintraege=0;
	
	if ($dump["table_offset"]<=$dump["tabellen_gesamt"])
	{
		$dauer=time()-($xtime+$dump["verbraucht"]);
		$dump["verbraucht"]+=$dauer;
	   	$summe_eintraege+=$dump["anzahl_zeilen"];
		
		//Zeitanpassung
		if($config["direct_connection"]==1) {
			if ($dauer<$dump["max_zeit"]) $dump["anzahl_zeilen"]=$dump["anzahl_zeilen"]*$config["tuning_add"];
			else $dump["anzahl_zeilen"]=$dump["anzahl_zeilen"]*$config["tuning_sub"];
			$dump["anzahl_zeilen"]=round($dump["anzahl_zeilen"],0);
			if($config["minspeed"]>0) {if ($dump["anzahl_zeilen"]<$config["minspeed"]) $dump["anzahl_zeilen"]=$config["minspeed"];}
			if($config["maxspeed"]>0) {if($dump["anzahl_zeilen"]>$config["maxspeed"]) $dump["anzahl_zeilen"]=$config["maxspeed"];}
		}
		$dump["aufruf"]++; 
		// Selbstaufruf starten
		$page_parameter='table_offset='.$dump["table_offset"].'&zeilen_offset='.$dump["zeilen_offset"];
		$page_parameter.='&countdata='.$dump["countdata"].'&part='.$dump["part"].'&part_offset='.$dump["part_offset"];
		$page_parameter.='&backupdatei='.urlencode($dump["backupdatei"]).'&backupdateistructure='.urlencode($dump["backupdatei_structure"]);
		$page_parameter.='&xtime='.$xtime.'&aufruf='.$dump["aufruf"].'&filename_stamp='.$dump["filename_stamp"];
		$page_parameter.='&anzahl_zeilen='.$dump["anzahl_zeilen"].'&verbraucht='.$dump["verbraucht"].'&comment='.urlencode($dump["kommentar"]).'&dbi='.$dump["dbindex"].'&err='.$dump["errors"].'&totalrecords='.$dump["totalrecords"];
	}
	else 
	{
		//Backup fertig
		// Zeitmessung wird beendet 
		$dump["data"]="\n".$mysql_commentstring." EOB\n\n\n";
		WriteToDumpFile();
		ExecuteCommand("a");
	    if($config["multi_part"]==1) {
			$out.=$lang['finished'].'<br><div style="padding-left:20px;">';
			$dateistamm=substr($dump["backupdatei"],0,strrpos($dump["backupdatei"],"part_"))."part_";
			$dateiendung=($config["compression"]==1)?".sql.gz":".sql";
			clearstatcache();
			for ($i=1;$i<($dump["part"]-$dump["part_offset"]);$i++) {
				$mpdatei=$dateistamm.$i.$dateiendung;
				
				$sz=byte_output(@filesize($config["paths"]["backup"].$mpdatei));
				$out.= $lang["file"].' <a href="'.$config["paths"]["backup"].$mpdatei.'" class="smallblack">'.$mpdatei.' ('.$sz.')</a> '.$lang["dump_successful"].'<br>';
			}
			$out.='</div>';
		} else {
			$out.=$lang['finished'].': <a href="'.$config["paths"]["backup"].$dump["backupdatei"].'" class="smallblack">'.$dump["backupdatei"].' ('.byte_output(filesize($config["paths"]["backup"].$dump["backupdatei"])).")</a><br>";
		}
		$backup_ready=1;
	    $xtime=time()-$xtime; 
		$aus=Array();
		$aus[]= "<br>";
		if($config["multi_dump"]==1) {
			WriteLog("Dump '".$dump["backupdatei"]."' finished.");
			WriteLog("Multidump: ".count($databases["multi"])." Datenbases in ".zeit_format($xtime).".");
		} else {
			WriteLog("Dump '".$dump["backupdatei"]."' finished in ".zeit_format($xtime).".");
		}
		
		if ($config["send_mail"]==1) DoEmail();
		if($config["ftp_transfer"]==1) DoFTP();
		
		@unlink($config["paths"]["log"]."out.tmp");
			
		$aus[]= '<br><br><strong>'.$lang["done"]."</strong><br><br>";
		if($dump["errors"]>0) $aus[]='<p class="warnung">Es sind '.$dump["errors"].' Fehler aufgetreten: <a href="log.php?r=3">ansehen</a></p>';
		
		if($config["multi_dump"]==1) {
			$aus[]= sprintf($lang['multidump'],count($databases["multi"]))."<br>";
		}
		$aus[]= '<br>'.sprintf($lang["dump_endergebnis"],$num_tables,number_format($dump["countdata"],0,",",".")).'<br><br><span class="smallgrey">'.$out.'</span><br><br>'
			.'<p class="small">'.zeit_format($xtime).', '.$dump["aufruf"].' pages'.$aus2.'</p>' //.$dump["fileoperations"].' Schreibzugriffe'
			.str_repeat("&nbsp;",60).'<br>';
		$aus[]= "<br><br><input class=\"Formbutton\" type=\"button\" value=\"".$lang["back_to_control"]."\" onclick=\"self.location.href='".$relativ_path."filemanagement.php'\"></a>";
		$aus[]= "&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang["back_to_minisql"]."\" onclick=\"self.location.href='".$relativ_path."sql.php'\"></a>";
		$aus[]= "&nbsp;&nbsp;&nbsp;<input class=\"Formbutton\" type=\"button\" value=\"".$lang["back_to_overview"]."\" onclick=\"self.location.href='".$relativ_path."main.php?action=db&dbid=".$dump["dbindex"]."#dbid'\"></a>";
		
		$DumpFertig=1;
	}
}


//=====================================================================
//================= Anzeige ===========================================
//=====================================================================

//Seite basteln
$svice=(isset($_GET["svice"])) ? $_GET["svice"] : 0;
$config_array=(isset($config)) ? "<strong>CONFIG</strong><pre>".@print_r($config,true)."</pre>": "";
$database_array=(isset($database)) ? "<strong>DATABASE</strong><pre>".@print_r($database,true)."</pre>": "";
$dump_array=(isset($dump)) ? "<strong>DUMP</strong><pre>".@print_r($dump,true)."</pre>": "";

$aus=array_merge($aus_header,$aus);
//DEBUGGER
//$debugausgabe='<hr><table width="600"><tr><td>Aufruf:'.$dump["aufruf"].'&nbsp;&nbsp;&nbsp;Datensätze: '.$dump["countdata"].'&nbsp;&nbsp;&nbsp;Dateigrösse: '.$dump["filesize"].'<br><br><span class="small">'.$page_parameter.'</span></td></tr></table><hr>';
$manuell=0;
$pagefooter=($DumpFertig==1) ? '<p align="center" class="small">Autoren: <a class="small" href="http://www.daniel-schlichtholz.de" target="_new">Daniel Schlichtholz & Steffen Kamper</a> - Infoboard: <a class="small" href="'.$config["homepage"].'" target="_new">'.$config["homepage"].'</a></p>' : '';
if($svice==1) $pagefooter.='<table width="100%"><tr bgcolor="#808080"><td>'.$config_array.'</td></tr><tr bgcolor="#808080"><td>'.$database_array.'</td></tr><tr bgcolor="#808080"><td>'.$dump_array.'</td></tr><tr bgcolor="#808080"><td>'.$restore_array.'</td></tr></table>';
$pagefooter.='</div></BODY></HTML>';

if($frames==1) {
	
	$js_aufruf_automatisch=($page_parameter=="") ? ">" : "onload=\"restart_dump()\">";
	$js_aufruf_manuell=($page_parameter=="") ? ">" : '><input type="Button" value="weitermachen" onclick="restart_dump()"><br><br>';
	
	
	$s="\n<script type=\"text/javascript\">\n";
	$s.="function restart_dump()\n{\n";
	$s.="parent.msd_action.location.href=\"".$relativ_path."dump.php?".$page_parameter."\";\n";
	$s.="\n}\n";
	$s.="</script>";
	$pageheader='<html><head>'.$meta.'<title>MySqlDump</title><link rel="stylesheet" type="text/css" href="'.$relativ_path.'css/'.$config["theme"].'/style.css">'.$s.'</head>
	<body  bgcolor="#F5F5F5"  '.(($manuell==1) ? $js_aufruf_manuell : $js_aufruf_automatisch).headline();
	$complete_page=$pageheader.$debugausgabe.implode("\n",$aus).$pagefooter;
	// und raus
	WriteTempOut($out);
	$f=fopen("work/log/out.html","w");
	fwrite($f,$complete_page);
	fclose($f);
	flush();
	echo '<script type="text/javascript">parent.msd_ausgabe.location.href="./work/log/out.html";</script>';

} else {
	$js_aufruf_automatisch='<script language="javascript">self.location="dump.php?'.$page_parameter.'";</script>';
	$js_aufruf_manuell='<input type="Button" value="weitermachen" onclick="self.location.href=\'dump.php?'.$page_parameter.'\'">';
	$selbstaufruf=($page_parameter=="") ? "" : (($manuell==1) ? $js_aufruf_manuell : $js_aufruf_automatisch);
	$complete_page=$pageheader.implode("\n",$aus).$debugausgabe.$selbstaufruf.$pagefooter;
	// und raus
	WriteTempOut($out);
	echo $complete_page;
	flush();
}


?>