<?php
include("inc/header.php");

echo headline();
$dirs=Array("","./","./inc/","./msd_cron/","./language/","./work/config/");
if($config["auto_delete"]==1)$msg=AutoDelete();
if (file_exists("work/log/dump.html")) @unlink("work/log/dump.html");

//0=Datenbank  1=Struktur
$action=(isset($_GET["action"])) ? $_GET["action"] : "files";
$kind=(isset($_GET["kind"])) ? $_GET["kind"] : 0;
$expand=(isset($_GET["expand"])) ? $_GET["expand"] : -1;
$toolboxstring="";
if(isset($_GET["svice"]))$svice=$_GET["svice"];
if(isset($_POST["svice"]))$svice=$_POST["svice"];

if($kind==0) $fpath=$config["paths"]["backup"]; else $fpath=$config["paths"]["structure"];
$dbactiv=(isset($_GET["dbactiv"])) ? $_GET["dbactiv"] : $databases["db_actual"];
$msg="";

if($config["multi_dump"]==1) {
	$databases["multi"]=Array();
	if($databases["multisetting"]==""){
		$databases["multi"][0]=$databases["db_actual"];
	} else {	
		$databases["multi"]=explode(";",$databases["multisetting"]);
		$toolboxstring="Datenbanken\n------------------\n\n".str_replace(";","\n",$databases["multisetting"]);
	}
} else $databases["multi"][0]=$databases["db_actual"];

//--------------------------------------------------------
//*** Abfrage ob Dump nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST["dump_tbl"]))
{
	$databases["db_actual_tableselected"]=substr($_POST["tbl_array"],0,strlen($_POST["tbl_array"])-1);
	WriteParams(1,$config,$databases);
	@unlink($config["paths"]["log"]."out.tmp");
	$dk=(isset($_POST["dumpKommentar"])) ? $_POST["dumpKommentar"] : "";
	$dump["fileoperations"]=0;
	if ($config["interface_browser_ie"])
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=dump&comment='.urlencode($dk).'";</script>'; 
	else
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.urlencode($dk).'";</script>'; 
	
	exit;
}

//--------------------------------------------------------
//*** Abfrage ob Dump ***
//--------------------------------------------------------
if (isset($_POST["dump"]))
{
	
	if(isset($_POST["tblfrage"]) && $_POST["tblfrage"]==1) {
	//Tabellenabfrage
	$tblfrage_refer="dump";
	include ("inc/tabellenabfrage.php");
	exit;
	} else {
		$databases["db_actual_tableselected"]="";
		WriteParams(1,$config,$databases);
		@unlink($config["paths"]["log"]."out.tmp");
		$dk=(isset($_POST["dumpKommentar"])) ? $_POST["dumpKommentar"] : "";
		$dump["fileoperations"]=0;
		if ($config["interface_browser_ie"])
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=dump&comment='.urlencode($_POST["dumpKommentar"]).'";</script>'; 
		else
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.urlencode($_POST["dumpKommentar"]).'";</script>'; 
	}
}

//--------------------------------------------------------
//*** Abfrage ob Restore nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST["restore_tbl"]))
{
	$databases["db_actual_tableselected"]=substr($_POST["tbl_array"],0,strlen($_POST["tbl_array"])-1);
	WriteParams(1,$config,$databases);
	
	echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=restore&filename='.$_POST["filename"].'&kind='.$kind.'";</script>'; 
	
	exit;
}
//--------------------------------------------------------
//*** Abfrage ob Restore ***
//--------------------------------------------------------
if (isset($_POST["restore"]))
{
   if (isset($_POST["file"]))
   {
	   	if(file_exists($config["paths"]["log"]."restore.tmp")) @unlink($config["paths"]["log"]."restore.tmp");
		if(isset($_POST["tblfrage"]) && $_POST["tblfrage"]==1) {
			//Tabellenabfrage
			$tblfrage_refer="restore";
			$filename=urldecode($_POST["file"][0]);
			include ("inc/tabellenabfrage.php");
			exit;
		} else {
			$databases["db_actual_tableselected"]="";
			WriteParams(1,$config,$databases);
			if($config["interface_browser_ie"])
				echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=restore&filename='.$_POST["file"][0].'&kind='.$kind.'";</script>'; 
			else
				echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="restore.php?filename='.$_POST["file"][0].'&kind='.$kind.'";</script>'; 
			
		}
   }
   else
   $msg.= '<p class="fehler">'.$lang["fm_nofile"].'</p>'.br();
}

//--------------------------------------------------------
//*** Abfrage ob Delete ***
//--------------------------------------------------------
if (isset($_POST["delete"]) )
{
   $msg="";
   if (isset($_POST["file"]))
   {
	$file=$_POST["file"];
   		//hier muss die Abfrage checkbox/radiobox rein
		if($_POST["multi"]==1) {
			$delfiles=Array();
			$msg.= '<p>';
			for($i=0;$i<count($_POST["file"]);$i++)
			{
				if($_POST["multipart"][$i]==0) {
					$delfiles[]=$_POST["file"][$i];
				} else {
					$delfiles[]=substr($_POST["file"][$i],0,strpos($_POST["file"][$i],"_part_"))."*.*";
				}
				
			}
			for($i=0;$i<count($delfiles);$i++) {
				$del=DeleteFilesM($fpath,$delfiles[$i]);
				if($del==0){
					$msg.= '<p class="fehler">'.$lang["fm_delete1"].$fpath.$delfiles[$i].$lang["fm_delete3"].'</p>';
				} else {
					for ($j=0; $j<count($del); $j++) {
						$msg.=$lang["fm_delete1"].$del[$j].$lang["fm_delete2"].'<br>';
						WriteLog("deleted '$del[$j]'.");
					}
				}
				
			}
			$msg.='</p>';
			
			
		} else {
			if (DeleteFilesM($fpath,$_POST["file"][0])) {
	    		$msg.= '<p class="meldung">'.$lang["fm_delete1"].$fpath.$_POST["file"][0].$lang["fm_delete2"].'</p>';
				WriteLog("deleted '".$_POST["file"][0]."'.");
			} else {
	    		$msg.= '<p class="fehler">'.$lang["fm_delete1"].$fpath.$_POST["file"][0].$lang["fm_delete3"].'</p>';
			}
		}
    }
    else
    $msg.= '<p class="fehler">'.$lang["fm_nofile"].'</p>'.br();
}
if (isset($_POST["deleteauto"]) )
{
	
	//hier kommt autodelete rein
	$msg.=AutoDelete();
}
if (isset($_POST["deleteall"]) )
{
	//hier kommt alldelete rein
	$del=DeleteFilesM($fpath,"*.sql");
	if($del==0){
		//$msg.="Fehler beim l&ouml;schen!";
	}else{
		for ($i=0; $i<sizeof($del); $i++) {
			$msg.="File '".$del[$i]."' gel&ouml;scht<br>";
			WriteLog("deleted '$del[$i]'.");
		}
	}
	$del=DeleteFilesM($fpath,"*.gz");
	
}

if (isset($_POST["deleteallfilter"]) )
{
	//hier kommt alldelete rein
	$del=DeleteFilesM($fpath,$databases["db_actual"]."*");
	if($del==0){
		//$msg.="Fehler beim l&ouml;schen!";
	}else{
		for ($i=0; $i<sizeof($del); $i++) {
			$msg.="File '".$del[$i]."' gel&ouml;scht<br>";
			WriteLog("deleted '$del[$i]'.");
		}
	}
}

////////////////////////////////// 
// Upload 
/////////////////////////////////// 
if (isset($_POST["upload"])) 
{ 
   $error=false; 
   if (!isset($_FILES["upfile"]["name"])) echo '<span class="warnung">'.$lang["fm_uploadfilerequest"].'</span><br><br>'; 
   else 
   { 
       if (!file_exists($fpath.$_FILES["upfile"]["name"])) 
      { 
         // Extension ermitteln -strrpos f&auml;ngt hinten an und ermittelt somit den letzten Punkt    
            $endung=strrchr($_FILES["upfile"]["name"],"."); 
            $erlaubt=ARRAY(".gz",".sql"); 
            if (!in_array($endung,$erlaubt)) 
            { 
              	$msg.= "<font color=\"red\">".$lang["fm_uploadnotallowed1"]."<br>"; 
            	$msg.= $lang["fm_uploadnotallowed2"]."</font>"; 
            } 
            else 
            { 
            if (!$error) 
            { 
                if (move_uploaded_file($_FILES["upfile"]["tmp_name"],$fpath.$_FILES["upfile"]["name"])) chmod($fpath.$upfile_name,0755); 
               else $error.="<font color=\"red\">".$lang["fm_uploadmoveerror"]."<br>"; 
            } 
              if ($error) $msg.= $error."<font color=\"red\">".$lang["fm_uploadfailed"]."</font><br>"; 
          } 
      } 
      else $msg.= "<font color=\"red\">".$lang["fm_uploadfileexists"]."</font><br>"; 
   } 
}

if(isset($_POST[""])) {


}
/*

<script language="JavaScript">
	function GetSelectedFilename()
	function Check(i)
</script>

*/

//Seitenteile vordefinieren
$href='filemanagement.php?action='.$action.'&kind='.$kind;
$a1= br(3).'<form name="fm" id="fm" method="post" action="'.$href.'">'.br();
$a1.= '<div align="center">'.br().'<table border="1" rules="rows">'.br().'<tr>'.br();

$td='<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">'.br();

$ul= '<h4>'.$lang["fm_fileupload"].'</h4>'.br();
$ul.= '<form action="'.$href.'" method="POST" enctype="multipart/form-data">'.br();
$ul.= '<table>'.br();
$ul.= '<tr>'.br().'<td align="center" colspan="2">'.br().'<input type="file" name="upfile"></td>'.br();
$ul.= '<td align="center"><input type="submit" name="upload" value="'.$lang["fm_fileupload"].'">'.br();
$ul.= '</td>'.br().'</tr>'.br().'</table>'.br();
$ul.= '</table>'.br();
$ul.= '</form>'.br();

$tbl_abfrage='<td>&nbsp;';
if($config["multi_dump"]==0)  $tbl_abfrage.='<input type="checkbox" name="tblfrage" value="1">'.$lang['fm_selecttables'];
$tbl_abfrage.='</td><td>&nbsp;&nbsp;&nbsp;</td><td>'.$lang['fm_comment'].':&nbsp;&nbsp;<input type="text" name="dumpKommentar"></td>'.br();

$autodel='<span class="small">'.$lang["autodelete"].": ";
$abue=($config["max_backup_files_each"]==1)? $lang["max_backup_files_each2"] :$lang["max_backup_files_each1"];
$abue2=($config["del_files_after_days"]>0) ? $lang["age_of_files"]."=".$config["del_files_after_days"].", " : "";
$autodel.=($config["auto_delete"]==0) ? $lang["not_activated"] : $lang["activated"]." (".$abue2.$lang["number_of_files_form"]."=".$config["max_backup_files"]." -> ".$abue.")";
$autodel.='</span><br><br>'.br().br();

//Fallunterscheidung

switch ($action) {
	case "dump":
		//Perlscript
		if($config["multi_dump"]==0) DBDetailInfo($databases["db_selected_index"]);
		$cext=($config["cron_extender"]==0) ? "pl" : "cgi";
		$refdir=(substr($config["cron_execution_path"],0,1)=="/") ? "" : substr($_SERVER["PATH_INFO"],0,strrpos($_SERVER["PATH_INFO"],"/")+1);
		$scriptdir=$config["cron_execution_path"].'crondump.'.$cext;
		$sfile=$config["cron_execution_path"]."perltest.$cext";
		$simplefile=$config["cron_execution_path"]."simpletest.$cext";
	
		$cronabsolute=Realpfad("./").$scriptdir;
		$confabsolute=$config["cron_configurationfile"];
		$scriptref="http://".$_SERVER["SERVER_NAME"].$refdir.$config["cron_execution_path"].'crondump.'.$cext."?config=".$confabsolute;
		$cronref="perl ".$cronabsolute." config=".$confabsolute;
		echo '<h3>'.$lang["fm_dump_header"].'</h3>';
		if(!is_writable($config["paths"]["backup"])) die('<span class="warnung"><strong>ERROR !</strong><br>Backupdir is not writable</span>');

		echo (isset($msg) && $msg!="")?"$msg<br>":"";
		
		echo $autodel;
		
		echo $a1.$td.'<input class="Menubutton" name="dump" type="submit" value="';
		echo $lang["fm_startdump"].'"></td>';
		echo $tbl_abfrage; 
		
		echo '</tr></table>';
		
		
		echo '</form></div>';
		
		echo '<h6>'.$lang["fm_dumpsettings"].'</h6><table><tr valign="top"><td>';
		
		echo '<table><tr><td>'.$lang["db"].':</td><td class="dumppars"><strong>'.
			(($config["multi_dump"]==1) ? 
				'<div title="'.$toolboxstring.'">Multidump ('.count($databases["multi"]).' '.$lang['dbs'].')</div>' 
										: 
			   $databases["db_actual"].'&nbsp;<span class="smallgreen">('.$databases["Detailinfo"]["tables"]." Tables, ".$databases["Detailinfo"]["records"]." Records, ".byte_output($databases["Detailinfo"]["size"]).")</span>").'</strong></td></tr>';
		echo '<tr><td>'.$lang["praefix"].':</td><td class="dumppars">'.(($config["multi_dump"]==1) ? '-' : $databases["praefix"][$databases["db_selected_index"]]).'</td></tr>';
		echo '<tr><td>'.$lang["gzip"].':</td><td class="dumppars">'.(($config["compression"]==1) ? $lang["activated"] : $lang["not_activated"]).'</td></tr>';
		echo '<tr><td valign="top">'.$lang["multi_part"].':</td><td class="dumppars">'.(($config["multi_part"]==1) ? $lang["yes"] : $lang["no"]);
		if($config["multi_part"]==1) {
			echo '<br>'.$lang["multi_part_groesse"].': '.byte_output($config["multipart_groesse"]);
		} 
		echo '</td></tr>';
		
		echo '</table></td><td><table>';
		
		if($config["send_mail"]==1) {
			$t=$config["email_recipient"].(($config["send_mail_dump"]==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo '<tr><td valign="top">'.$lang["send_mail_form"].':</td><td class="dumppars">'.(($config["send_mail"]==1) ? $t : $lang["not_activated"]);
		echo '</td></tr> ';
		
		echo '<tr><td valign="top">'.$lang["ftp_transfer"].':</td><td class="dumppars">'.(($config["ftp_transfer"]==1) ? $lang["activated"] : $lang["not_activated"]);
		if($config["ftp_transfer"]==1) {
			echo '<br>Host: '.$config["ftp_server"][$config["ftp_connectionindex"]].' Port '.$config["ftp_port"][$config["ftp_connectionindex"]].'<br>User: '.$config["ftp_user"][$config["ftp_connectionindex"]].' Dir: '.$config["ftp_dir"][$config["ftp_connectionindex"]];
		} 
		echo '<br><div style="display:none"><img src="images/fbd.gif" width="120" height="12" alt=""><br><img src="images/fbs.gif" width="120" height="12" alt=""></div></td></tr> ';
		echo '</table></td></tr></table>';
		
		//crondumpsettings
		echo '<h6 style="white-space: nowrap;">'.$lang["fm_dumpsettings_cron"].'<br>';
		echo '<span class="verysmall">Aufruf im Browser: '.$scriptref.'<br>';
		echo '<span class="verysmall">Aufruf in der Shell: '.$cronref.'</span></h6><table><tr valign="top"><td>';
		if($databases["db_actual_cronindex"]==-3) {
			$cron_dbname=$lang['multidumpall']; 
			$cron_dbpraefix = "";
		} elseif($databases["db_actual_cronindex"]==-2) {
			$cron_dbname='Multidump ('.count($databases["multi"]).' '.$lang['dbs'].')'; 
			$cron_dbpraefix = "";
		} else {
			if($config["cron_samedb"]==0) {
				$cron_dbname=$databases["db_actual"]; 
				$cron_dbpraefix = $databases["praefix"][$databases["db_selected_index"]]; 
			}else {
				$cron_dbname=$databases["Name"][$databases["db_actual_cronindex"]];
				$cron_dbpraefix = $databases["db_actual_cronpraefix"]; 
			}
		}
		
		echo "<table><tr><td>".$lang["db"].":</td><td class='crondumppars'><strong>$cron_dbname</strong></td></tr>";
		echo "<tr><td>".$lang["praefix"].":</td><td class='crondumppars'>$cron_dbpraefix</td></tr> ";
		echo "<tr><td>".$lang["gzip"].":</td><td class='crondumppars'>".(($config["cron_compression"]==1)?$lang["activated"]:$lang["not_activated"])."</td></tr> ";
		echo "<tr><td valign=\"top\">".$lang["multi_part"].":</td><td class='crondumppars'>".(($config["multi_part"]==1)?$lang["yes"]:$lang["no"]);
		if($config["multi_part"]==1) {
			echo "<br>".$lang["multi_part_groesse"].": ".byte_output($config["multipart_groesse"]);
		} 
		echo '</td></tr>';
		echo '<tr><td>'.$lang["cron_printout"].':</td><td class="crondumppars">'.(($config["cron_printout"]==1)?$lang["activated"]:$lang["not_activated"]).'</td></tr>';
		
		
		echo "</table></td><td><table>";
		
		if($config["cron_mail"]==1) {
			$t=$config["email_recipient"].(($config["cron_mail_dump"]==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo "<tr><td valign=\"top\">".$lang["send_mail_form"].":</td><td class='crondumppars'>".(($config["cron_mail"]==1)?$t:$lang["not_activated"]);
		 
		echo "</td></tr> ";
		
		echo "<tr><td valign=\"top\">".$lang["ftp_transfer"].":</td><td class='crondumppars'>".(($config["cron_ftp"]==1)?$lang["activated"]:$lang["not_activated"]);
		if($config["cron_ftp"]==1) {
			echo "<br>Host: ".$config["ftp_server"][$config["ftp_connectionindex"]]." Port ".$config["ftp_port"][$config["ftp_connectionindex"]]."<br>User: ".$config["ftp_user"][$config["ftp_connectionindex"]]." Dir: ".$config["ftp_dir"][$config["ftp_connectionindex"]];
		} 
		echo "</td></tr><tr></tr> ";
		echo '<tr><td colspan="2"><input class="Formbutton3" type="Button" name="DoCronscript" value="'.$lang["DoCronButton"].'" onclick="self.location.href=\''.$scriptref.'\'"></td></tr>';
		echo '<tr><td colspan="2"><input class="Formbutton3" type="Button" name="DoPerlTest" value="'.$lang["DoPerlTest"].'" onclick="self.location.href=\''.$sfile.'\'"></td></tr>';
		echo '<tr><td colspan="2"><input class="Formbutton3" type="Button" name="DoSimpleTest" value="'.$lang["DoSimpleTest"].'" onclick="self.location.href=\''.$simplefile.'\'"></td></tr>';
		
		echo "</table></td></tr></table><br>";
		
		//echo '<div class="verysmall" style="color:green;">'.$lang["phpcrondesc"].'</div>';
		break;
	
	case "restore":
		echo '<h3>'.$lang["fm_restore_header"].$databases["db_actual"].$lang["fm_restore_header2"].'</h3>';
		echo (isset($msg) && $msg!="")?"$msg<br>":"";
		echo $autodel;
		echo $a1.$td.'<input class="Menubutton" name="restore" type="submit" value="'.$lang["fm_restore"].'" onclick="if (!confirm(\''.$lang["fm_alertrestore1"].' `'.$databases["db_actual"].'`  '.$lang["fm_alertrestore2"].' `\' + GetSelectedFilename() + \'` '.$lang["fm_alertrestore3"].'\')) return false;"></td>';
		
		//echo '</tr></table>'.$tbl_abfrage.'</div>';
		echo '</tr></table></div><br>';
		echo FileList().'</form>';
		break;
	case "files":
		$sysfedit=(isset($_POST["sysfedit"])) ? 1 : 0;
		$sysfedit=(isset($_GET["sysfedit"])) ? $_GET["sysfedit"] : $sysfedit;
		echo "<h3>".$lang["file_manage"]."</h3>";
		echo (isset($msg) && $msg!="") ? $msg.'<br>' : '';
		echo $autodel;
		echo $a1.'<input type="hidden" name="svice" value="1">';
		echo $td.br().'<input class="Menubutton2" name="delete" type="submit" value="'.$lang["fm_delete"].'"	onclick="if (!confirm(\''.$lang["fm_askdelete1"].'`\' + GetSelectedFilename() + \'`'.$lang["fm_askdelete2"].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Menubutton2" name="deleteauto" type="submit" value="'.$lang["fm_deleteauto"].'"	onclick="if (!confirm(\''.$lang["fm_askdelete3"].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Menubutton2" name="deleteall" type="submit" value="'.$lang["fm_deleteall"].'"	onclick="if (!confirm(\''.$lang["fm_askdelete4"].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Menubutton2" name="deleteallfilter" type="submit" value="'.$lang["fm_deleteallfilter"].$databases["db_actual"].$lang["fm_deleteallfilter2"].'"	onclick="if (!confirm(\''.$lang["fm_askdelete5"].$databases["db_actual"].$lang["fm_askdelete5_2"].'\')) return false;"></td>'.br();
		if(isset($svice) && $svice==1) echo $td.br().'<input class="Menubutton2" name="sysfedit" type="submit" value="Service"></td>'.br();
		echo '</tr>'.br().'</table>'.br().'<br>'.br();
		if($sysfedit==0) echo FileList().'</form></div>'.br().$ul.'<br>'.br().'<br>'.br();
		else {
			echo '</form></div>'.br().'<br>'.br();
			$dir=0;$fname="";
			if(isset($_GET["dir"])) $dir=$_GET["dir"];
			if(isset($_GET["filename"])) $fname=$_GET["filename"];
			
			if(isset($_POST["fedit_save"])) {
				$savetext=($config["magic_quotes_gpc"]==1) ? stripslashes($_POST["editor"]) : $_POST["editor"];
				$savefile=$dirs[$_POST["dir"]].$_POST["edit_filename"];
				echo '<h5>Save: '.$savefile.' - Länge '.strlen($savetext).'</h5>';
				if(!is_writable($savefile)) echo "Kann nicht speichern !"; else {
					if ($fp=fopen($savefile, "wb"))
					{ 
						fwrite($fp,$savetext);
						fclose($fp);
					}
				}
			}
			echo SYS_editor($dir,$fname);
		}
		break;
}

echo '<br><br>'.br(3);
include("inc/footer.php");

function FileList($multi=0)
{
	global $config,$kind,$fpath,$lang,$databases,$href,$dbactiv,$action,$expand;
	
	$files=Array();
	if($kind==0){
		//Backup-Dateien
		$Theader=$lang["fm_files1"].' '.$lang['of'].' '.$dbactiv;
		$Wheader=$lang["fm_files2"];
		$akind=1;
	} else {
		//Struktur-Dateien
		$Theader=$lang["fm_files2"];
		$Wheader=$lang["fm_files1"];
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
	$fl.='<div align="center">'.br().$lang["fm_choose_file"].br();
	$fl.='<span id="gd" style="color:#330099; font-weight:bold;">&nbsp;</span>'.br().'<br><br>';
	
	$fl.='<table border="1" rules="rows" align="center" width="80%" cellpadding="0" cellspacing="0">'.br();
	$fl.='<tr>'.br().'<td colspan="7" align="left"><strong>'.$Theader.'</strong></td>'.br().'<td colspan="3" align="right"><a href="filemanagement.php?action='.$action.'&kind='.$akind.'" class="small">'.$Wheader.'</a></td>'.br().'</tr>'.br();
	
	//Tableheader
	$fl.='<tr>'.br().'<td colspan="2" class="hd">'.$lang['db'].'</td>'.br().'
	<td class="hd">gz</td>'.br().'
	<td class="hd">Script</td>'.br().'
	<td class="hd">'.$lang['comment'].'</td>'.br().'
	
	<td class="hd">'.$lang["fm_filedate"].'</td>'.br().'
	<td class="hd">Multipart</td>'.br().'
	<td class="hd">'.$lang["fm_tables"].' / '.$lang["fm_records"].'</td>'.br().'
	<td align="right" colspan="2" class="hd">'.$lang["fm_filesize"].'</td>'.br().'</tr>'.br();
	
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
				if($config["zlib"]) {
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
				$db_backups[$arrayindex]["name"]=$files[$i];
				$db_backups[$arrayindex]["db"]=$dbn;
				$db_backups[$arrayindex]["size"]=$size;
				$db_backups[$arrayindex]["date"]=$but;
				$db_backups[$arrayindex]["tabellen"]=$tabellenanzahl;
				$db_backups[$arrayindex]["eintraege"]=$eintraege;
				$db_backups[$arrayindex]["multipart"]=0;
				$db_backups[$arrayindex]["kommentar"]=$kommentar;
				$db_backups[$arrayindex]["script"]=(!empty($sline[4]) && !empty($sline[5])) ? $sline[4]."(".$sline[5].")" : "";
				
				if(!isset($db_summary_last[$dbn])) $db_summary_last[$dbn]=$but;
				$db_summary_anzahl[$dbn]=(isset($db_summary_anzahl[$dbn])) ? $db_summary_anzahl[$dbn]+1 : 1;
				$db_summary_size[$dbn]=(isset($db_summary_size[$dbn])) ? $db_summary_size[$dbn]+$size : $size;
				if($but>$db_summary_last[$dbn])$db_summary_last[$dbn]=$but;
				
			} else {
				//multipart nur einmal
				$done=0;
				for($j=0;$j<$arrayindex;$j++) {
					if(isset($db_backups[$j])) {
						if($db_backups[$j]["date"]==$but) {
							$db_backups[$j]["multipart"]++;
							$db_backups[$j]["size"]+=$size;
							$db_summary_size[$dbn]+=$size;
							$done=1;
							break;
						}
					}
				}
				if($done==0) {
					//Eintrag war noch nicht vorhanden
					$db_backups[$arrayindex]["name"]=$files[$i];
					$db_backups[$arrayindex]["db"]=$dbn;
					$db_backups[$arrayindex]["size"]=$size;
					$db_backups[$arrayindex]["date"]=$but;
					$db_backups[$arrayindex]["tabellen"]=$tabellenanzahl;
					$db_backups[$arrayindex]["eintraege"]=$eintraege;
					$db_backups[$arrayindex]["multipart"]=1;
					$db_backups[$arrayindex]["kommentar"]=$kommentar;
					$db_backups[$arrayindex]["script"]=$sline[4]."(".$sline[5].")";
				
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
			if(isset($db_backups[$i]["db"]) && $db_backups[$i]["db"]==$dbactiv) {
				$multi=($db_summary_anzahl[$dbactiv]>1 && $action=="files") ? 1 : 0;
				$fl.='<input type="hidden" name="multi" value="'.$multi.'">';
				if($db_backups[$i]["multipart"]>0) {$dbn=NextPart($db_backups[$i]["name"],1);}else{$dbn=$db_backups[$i]["name"];}
				$fl.='<tr '.(($dbactiv==$databases["db_actual"]) ? 'bgcolor="#e6e6e6"' : '').'>'.br();
				$fl.='<td align="left" colspan="2">'.br();
				if($multi==0){
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]["multipart"].'"><input name="file[]" type="radio" value="'.$dbn.'" onClick="Check('.$checkindex++.',0);">';
				} else {
					$fl.='<input type="hidden" name="multipart[]" value="'.$db_backups[$i]["multipart"].'"><input name="file[]" type="checkbox" value="'.$dbn.'" onClick="Check('.$checkindex++.',1);">';
				}
				$fl.=($db_backups[$i]["multipart"]==0) ? '&nbsp;<a href="'.$fpath.$dbn.'" title="Backupfile: '.$dbn.'" style="font-size:8pt;">'.$db_backups[$i]["db"].'</a></td>'.br() : '&nbsp;<span style="font-size:8pt;">'.$db_backups[$i]["db"].'</span></td>'.br();
				
				$fl.='<td class="sm" nowrap align="center"><span style="color:red;">'.((substr($dbn,-3)==".gz") ? '<img src="images/gz.gif" alt="'.$lang['compressed'].'" width="16" height="16" border="0">' : "&nbsp;").'</span></td>';
				$fl.='<td class="sm" nowrap align="center"><span style="color:green;">'.$db_backups[$i]["script"].'</span></td>';
				$fl.='<td class="sm" nowrap align="center">'.(($db_backups[$i]["kommentar"]!="") ? '<img src="images/rename.gif" alt="'.$db_backups[$i]["kommentar"].'" width="16" height="16" border="0">' : "&nbsp;").'</span></td>';
				
				
				$fl.='<td class="sm" nowrap><font color="#0000FF">'.$db_backups[$i]["date"].'</font></td>'.br();
				$fl.='<td align="center" style="font-size:8pt;">';
				$fl.=($db_backups[$i]["multipart"]==0) ? $lang["no"] : '<a style="color:red;font-size:11px;" href="filemanagement.php?action=files&kind=0&dbactiv='.$dbactiv.'&expand='.$i.'">'.$db_backups[$i]["multipart"].' Files</a>'; //
				$fl.='</td>'.br().'<td align="center" style="font-size:8pt;" nowrap>';
				$fl.=($db_backups[$i]["eintraege"]!=-1) ? $db_backups[$i]["tabellen"].' / '.number_format($db_backups[$i]["eintraege"],0,",",".") :$lang["fm_oldbackup"];
				$fl.='</td>'.br();
				$fl.='<td align="right" colspan="2" style="font-size:8pt;">'.byte_output($db_backups[$i]["size"]).'</td>'.br();
				$fl.='</tr>'.br();
				
				if($expand==$i) {
					$fl.='<tr '.(($dbactiv==$databases["db_actual"]) ? 'bgcolor="#e6e6e6"' : '').'>'.br();
					$fl.='<td class="sm" valign="top"><span style="color:blue;">All Parts:</span></td><td  class="sm" colspan="9">'.PartListe($db_backups[$i]["name"],$db_backups[$i]["multipart"]).'</td>';
				}
			}
		}
	}
		
	$fl.='<tr>'.br().'<td colspan="10">&nbsp;&nbsp;&nbsp;<strong>'.$lang['fm_all_bu'].'</strong></td>'.br().'</tr>'.br();
	//Tableheader
	$fl.='<tr>'.br().'<td class="hd" colspan="4">'.$lang["db"].'</td>'.br().'
	<td class="hd">'.$lang['fm_anz_bu'].'</td>'.br().'
	<td class="hd">'.$lang['fm_last_bu'].'</td>'.br().'
	<td class="hd" colspan="2">'.$lang['fm_totalsize'].'</td>'.br().'
	<td align="right" colspan="2" class="hd">&nbsp;</td>'.br().'</tr>'.br(3);
	//die anderen Backups
	if(count($db_summary_anzahl)>0) {
	while(list($key, $val) = each($db_summary_anzahl)) 
	{
		$keyaus=($key=="") ? "<em>[unknown]</em>" : $key;
		$fl.='<tr>'.br().'<td colspan="4"><a href="'.$href.'&dbactiv='.$key.'">'.$keyaus.'</a></td>'.br();
		$fl.='<td align="right">'.$val.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>'.br();
		$fl.='<td class="sm" nowrap><font color="#0000FF">'.((isset($db_summary_last[$key])) ? $db_summary_last[$key] : "").'</font></td>'.br();
		$fl.='<td align="right" style="font-size:8pt;" colspan="2">'.byte_output($db_summary_size[$key]).'&nbsp;</td>'.br();
		$fl.='<td align="right" colspan="2" style="font-size:8pt;">&nbsp;</td>'.br(); //.'<td>&nbsp;</td>'.br();
		$fl.='</tr>'.br(3);
		
	}
	}
	if (!is_array($files)) $fl.='<tr><td colspan="10" bgcolor="#CCCCCC">'.$lang["fm_nofilesfound"].'</td></tr>'.br();
	
	//--------------------------------------------------------
	//*** Ausgabe der Gesamtgr&ouml;&szlig;e aller Backupfiles ***
	//--------------------------------------------------------
	$space = MD_FreeDiskSpace();
	$fl.= '<tr>'.br();
	$fl.= '<td align="left" colspan="7"><b>'.$lang["fm_sizesum"].'('.$Sum_Files.' files): </b> </td>'.br();
	$fl.= '<td align="right" colspan="3"><b>'.byte_output($gesamt).'</b></td>'.br();
	$fl.= '</tr>'.br();
	
	
	//--------------------------------------------------------
	//*** Ausgabe des freien Speicher auf dem Rechner ***
	//--------------------------------------------------------
	$fl.= '<tr class="hellblau">'.br();
	$fl.= '<td colspan="7">'.$lang["fm_freespace"].': </td>'.br();
	$fl.= '<td colspan="3" align="right"><b>'.$space.'</b></td>'.br();
	$fl.= '</tr>'.br();
	$fl.= '</table>'.br();
	
	/*
	echo '<hr><pre>';
	print_r($db_backups);
	echo '</pre><hr>';
	*/
	
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
		$s.='<a href="'.$config["paths"]["backup"].$dateistamm.$i.$dateiendung.'" style="font-size:8pt;">'.$dateistamm.$i.$dateiendung.'</a>&nbsp;&nbsp;&nbsp;&nbsp;'.byte_output(@filesize($config["paths"]["backup"].$dateistamm.$i.$dateiendung));
	}
	return $s;
}
?>

