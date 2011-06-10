<?php
include("inc/header.php");
include_once("language/".$config['language']."/lang.php");
include_once("language/".$config['language']."/lang_filemanagement.php");
include_once("language/".$config['language']."/lang_config_overview.php");
include("inc/functions_files.php");

echo MSDHeader();

$dirs=Array("","./","./inc/","./msd_cron/","./language/","./work/config/");
if($config['auto_delete']==1)$msg=AutoDelete();
if (file_exists("work/log/dump.html")) @unlink("work/log/dump.html");
@unlink($config['paths']['log']."out.tmp");
@unlink($config['paths']['log']."out.html");

//0=Datenbank  1=Struktur
$action=(isset($_GET['action'])) ? $_GET['action'] : "files";
$kind=(isset($_GET['kind'])) ? $_GET['kind'] : 0;
$expand=(isset($_GET['expand'])) ? $_GET['expand'] : -1;
$selectfile=(isset($_POST['selectfile'])) ? $_POST['selectfile'] : "";
$destfile=(isset($_POST['destfile'])) ? $_POST['destfile'] : "";
$compressed=(isset($_POST['compressed'])) ? $_POST['compressed'] : "";

$toolboxstring="";
$svice=0;
if(isset($_GET['svice']))$svice=$_GET['svice'];
if(isset($_POST['svice']))$svice=$_POST['svice'];

if($kind==0) $fpath=$config['paths']['backup']; else $fpath=$config['paths']['structure'];
$dbactiv=(isset($_GET['dbactiv'])) ? $_GET['dbactiv'] : $databases['db_actual'];
$msg="";

//Browserweiche
if($config['browser_switch']==0) {
	$frames=(MSD_BROWSER_AGENT == "IE") ? 0 : 1;
} else $frames=$config['browser_switch']-1;


if($config['multi_dump']==1) {
	$databases['multi']=Array();
	if($databases['multisetting']==""){
		$databases['multi'][0]=$databases['db_actual'];
	} else {	
		$databases['multi']=explode(";",$databases['multisetting']);
		$toolboxstring="Datenbanken\n------------------\n\n".str_replace(";","\n",$databases['multisetting']);
	}
} else $databases['multi'][0]=$databases['db_actual'];

//--------------------------------------------------------
//*** Abfrage ob Dump nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST['dump_tbl']))
{
	@TestWorkDir();
	$databases['db_actual_tableselected']=substr($_POST['tbl_array'],0,strlen($_POST['tbl_array'])-1);
	WriteParams(1,$config,$databases);
	@unlink($config['paths']['log']."out.tmp");
	$dk=(isset($_POST['dumpKommentar'])) ? $_POST['dumpKommentar'] : "";
	$dump['fileoperations']=0;
	if ($frames==1)
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=dump&comment='.urlencode($dk).'";</script>'; 
	else
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.urlencode($dk).'";</script>'; 
	
	exit;
}

//--------------------------------------------------------
//*** Abfrage ob Dump ***
//--------------------------------------------------------
if (isset($_POST['dump']))
{
	
	if(isset($_POST['tblfrage']) && $_POST['tblfrage']==1) {
	//Tabellenabfrage
	$tblfrage_refer="dump";
	include ("inc/tabellenabfrage.php");
	exit;
	} else {
		@TestWorkDir();
		$databases['db_actual_tableselected']="";
		WriteParams(1,$config,$databases);
		
		$dk=(isset($_POST['dumpKommentar'])) ? $_POST['dumpKommentar'] : "";
		$dump['fileoperations']=0;
		if ($frames==1)
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=dump&comment='.urlencode($_POST['dumpKommentar']).'";</script>'; 
		else
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.urlencode($_POST['dumpKommentar']).'";</script>'; 
	}
}

//--------------------------------------------------------
//*** Abfrage ob Restore nach Tabellenaufruf ***
//--------------------------------------------------------
if (isset($_POST['restore_tbl']))
{
	$databases['db_actual_tableselected']=substr($_POST['tbl_array'],0,strlen($_POST['tbl_array'])-1);
	WriteParams(1,$config,$databases);
	
	echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=restore&filename='.$_POST['filename'].'&kind='.$kind.'";</script>'; 
	
	exit;
}
//--------------------------------------------------------
//*** Abfrage ob Restore ***
//--------------------------------------------------------
if (isset($_POST['restore']))
{
   if (isset($_POST['file']))
   {
	   	if(file_exists($config['paths']['log']."restore.tmp")) @unlink($config['paths']['log']."restore.tmp");
		if(isset($_POST['tblfrage']) && $_POST['tblfrage']==1) {
			//Tabellenabfrage
			$tblfrage_refer="restore";
			$filename=urldecode($_POST['file'][0]);
			include ("inc/tabellenabfrage.php");
			exit;
		} else {
			$databases['db_actual_tableselected']="";
			WriteParams(1,$config,$databases);
			if($frames==1)
				echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="frameset.php?action=restore&filename='.$_POST['file'][0].'&kind='.$kind.'";</script>'; 
			else
				echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="restore.php?filename='.$_POST['file'][0].'&kind='.$kind.'";</script>'; 
			
		}
   }
   else
   $msg.= '<p class="fehler">'.$lang['fm_nofile'].'</p>'.br();
}

//--------------------------------------------------------
//*** Abfrage ob Delete ***
//--------------------------------------------------------
if (isset($_POST['delete']) )
{
   $msg="";
   if (isset($_POST['file']))
   {
	$file=$_POST['file'];
   		//hier muss die Abfrage checkbox/radiobox rein
		if($_POST['multi']==1) {
			$delfiles=Array();
			$msg.= '<p>';
			for($i=0;$i<count($_POST['file']);$i++)
			{
				if($_POST['multipart'][$i]==0) {
					$delfiles[]=$_POST['file'][$i];
				} else {
					$delfiles[]=substr($_POST['file'][$i],0,strpos($_POST['file'][$i],"_part_"))."*.*";
				}
				
			}
			for($i=0;$i<count($delfiles);$i++) {
				$del=DeleteFilesM($fpath,$delfiles[$i]);
				if($del==0){
					$msg.= '<p class="fehler">'.$lang['fm_delete1'].$fpath.$delfiles[$i].$lang['fm_delete3'].'</p>';
				} else {
					for ($j=0; $j<count($del); $j++) {
						$msg.=$lang['fm_delete1'].$del[$j].$lang['fm_delete2'].'<br>';
						WriteLog("deleted '$del[$j]'.");
					}
				}
				
			}
			$msg.='</p>';
			
			
		} else {
			if (DeleteFilesM($fpath,$_POST['file'][0])) {
	    		$msg.= '<p class="meldung">'.$lang['fm_delete1'].$fpath.$_POST['file'][0].$lang['fm_delete2'].'</p>';
				WriteLog("deleted '".$_POST['file'][0]."'.");
			} else {
	    		$msg.= '<p class="fehler">'.$lang['fm_delete1'].$fpath.$_POST['file'][0].$lang['fm_delete3'].'</p>';
			}
		}
    }
    else
    $msg.= '<p class="fehler">'.$lang['fm_nofile'].'</p>'.br();
}
if (isset($_POST['deleteauto']) ) $msg.=AutoDelete();

if (isset($_POST['deleteall']) )
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

if (isset($_POST['deleteallfilter']) )
{
	//hier kommt alldelete rein
	$del=DeleteFilesM($fpath,$databases['db_actual']."*");
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
if (isset($_POST['upload'])) 
{ 
   $error=false; 
   if (!isset($_FILES['upfile']['name'])) echo '<span class="warnung">'.$lang['fm_uploadfilerequest'].'</span><br><br>'; 
   else 
   { 
       if (!file_exists($fpath.$_FILES['upfile']['name'])) 
      { 
         // Extension ermitteln -strrpos f&auml;ngt hinten an und ermittelt somit den letzten Punkt    
            $endung=strrchr($_FILES['upfile']['name'],"."); 
            $erlaubt=ARRAY(".gz",".sql"); 
            if (!in_array($endung,$erlaubt)) 
            { 
              	$msg.= "<font color=\"red\">".$lang['fm_uploadnotallowed1']."<br>"; 
            	$msg.= $lang['fm_uploadnotallowed2']."</font>"; 
            } 
            else 
            { 
            if (!$error) 
            { 
                if (move_uploaded_file($_FILES['upfile']['tmp_name'],$fpath.$_FILES['upfile']['name'])) @chmod($fpath.$upfile_name,0755); 
               else $error.="<font color=\"red\">".$lang['fm_uploadmoveerror']."<br>"; 
            } 
              if ($error) $msg.= $error."<font color=\"red\">".$lang['fm_uploadfailed']."</font><br>"; 
          } 
      } 
      else $msg.= "<font color=\"red\">".$lang['fm_uploadfileexists']."</font><br>"; 
   } 
}


//Seitenteile vordefinieren
$href='filemanagement.php?action='.$action.'&kind='.$kind;
$a1= br(3).'<form name="fm" id="fm" method="post" action="'.$href.'">'.br();
$a1.= '<div align="center">'.br().'<table border="0">'.br().'<tr>'.br();

$td='<td>';
$ul= '<h4>'.$lang['fm_fileupload'].'</h4>'.br();
$ul.= '<form action="'.$href.'" method="POST" enctype="multipart/form-data">'.br();
$ul.= '<table>'.br();
$ul.= '<tr>'.br().'<td align="center" colspan="2">'.br().'<input type="file" name="upfile"></td>'.br();
$ul.= '<td align="center"><input type="submit" name="upload" value="'.$lang['fm_fileupload'].'">'.br();
$ul.= '</td>'.br().'</tr>'.br().'</table>'.br();
$ul.= '</table>'.br();
$ul.= '</form>'.br();

$tbl_abfrage='<td>&nbsp;';
if($config['multi_dump']==0)  $tbl_abfrage.='<input type="checkbox" class="checkbox" name="tblfrage" value="1">'.$lang['fm_selecttables'];
$tbl_abfrage.='</td><td>&nbsp;&nbsp;&nbsp;</td><td>'.$lang['fm_comment'].':&nbsp;&nbsp;<input type="text" name="dumpKommentar"></td>'.br();

$autodel='<span class="small">'.$lang['autodelete'].": ";
$abue=($config['max_backup_files_each']==1)? $lang['max_backup_files_each2'] :$lang['max_backup_files_each1'];
$abue2=($config['del_files_after_days']>0) ? $lang['age_of_files']."=".$config['del_files_after_days'].", " : "";
$autodel.=($config['auto_delete']==0) ? $lang['not_activated'] : $lang['activated']." (".$abue2.$lang['number_of_files_form']."=".$config['max_backup_files']." -> ".$abue.")";
$autodel.='</span><br><br>'.br().br();

//Fallunterscheidung

switch ($action) {
	case "dump":
		//Perlscript
		if($config['multi_dump']==0) DBDetailInfo($databases['db_selected_index']);
		$cext=($config['cron_extender']==0) ? "pl" : "cgi";
		$actualUrl=substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
		if(substr($actualUrl,-1)!="/") $actualUrl.="/";
		if(substr($actualUrl,0,1)!="/") $actualUrl="/$actualUrl";
		$refdir=(substr($config['cron_execution_path'],0,1)=="/") ? "" : $actualUrl;
		$scriptdir=$config['cron_execution_path'].'crondump.'.$cext;
		$sfile=$config['cron_execution_path']."perltest.$cext";
		$simplefile=$config['cron_execution_path']."simpletest.$cext";
		$scriptentry=Realpfad("./").$config['paths']['config'];
		$cronabsolute=(substr($config['cron_execution_path'],0,1)=="/") ? $_SERVER['DOCUMENT_ROOT'].$scriptdir : Realpfad("./").$scriptdir;
		$confabsolute=$config['cron_configurationfile'];
		$scriptref="http://".$_SERVER['SERVER_NAME'].$refdir.$config['cron_execution_path'].'crondump.'.$cext."?config=".$confabsolute;
		$cronref="perl ".$cronabsolute." config=".$confabsolute;
		echo headline($lang['fm_dump_header']);
		if(!is_writable($config['paths']['backup'])) die('<span class="warnung"><strong>ERROR !</strong><br>Backupdir is not writable</span>');

		echo (isset($msg) && $msg!="")?"$msg<br>":"";
		
		echo $autodel;
		
		echo $a1.'<td><input class="Formbutton" name="dump" type="submit" value="';
		echo $lang['fm_startdump'].'"></td>';
		echo $tbl_abfrage; 
		
		echo '</tr></table>';
		
		
		echo '</form></div>';
		
		echo '<h6>'.$lang['fm_dumpsettings'].'</h6><table><tr valign="top"><td width="50%">';
		
		echo '<table><tr><td>'.$lang['db'].':</td><td class="dumppars"><strong>'.
			(($config['multi_dump']==1) ? 
				'<div title="'.$toolboxstring.'">Multidump ('.count($databases['multi']).' '.$lang['dbs'].')</div>' 
										: 
			   $databases['db_actual'].'&nbsp;<span class="smallgreen">('.$databases['Detailinfo']['tables']." Tables, ".$databases['Detailinfo']['records']." Records, ".byte_output($databases['Detailinfo']['size']).")</span>").'</strong></td></tr>';
		echo '<tr><td>'.$lang['praefix'].':</td><td class="dumppars">'.(($config['multi_dump']==1) ? '-' : $databases['praefix'][$databases['db_selected_index']]).'</td></tr>';
		echo '<tr><td>'.$lang['gzip'].':</td><td class="dumppars">'.(($config['compression']==1) ? $lang['activated'] : $lang['not_activated']).'</td></tr>';
		echo '<tr><td valign="top">'.$lang['multi_part'].':</td><td class="dumppars">'.(($config['multi_part']==1) ? $lang['yes'] : $lang['no']);
		if($config['multi_part']==1) {
			echo '<br>'.$lang['multi_part_groesse'].': '.byte_output($config['multipart_groesse']);
		} 
		echo '</td></tr>';
		echo '<tr><td>'.$lang['backup_format'].':</td><td class="smallgreen">';
		$t="";
		if($config['backup_complete_inserts']==1) $t.=$lang['inserts_complete']." / "; 
		if($config['backup_extended_inserts']==1) $t.=$lang['inserts_extended']." / "; 
		if($config['backup_ignore_inserts']==1) $t.=$lang['inserts_ignore']." / "; 
		if($config['backup_delayed_inserts']==1) $t.=$lang['inserts_delayed']." / "; 
		if($config['backup_lock_tables']==1 && $config['backup_delayed_inserts']==0) $t.=$lang['lock_tables']." / "; 
		$t=($t=="") ? $t=$lang['normal'] : substr($t,0,strlen($t)-3);
		if($config["backup_downgrade"]==1) $t.='<br>'.htmlspecialchars($lang["downgrade"]);
		
		echo $t.'</td></tr>';
		echo '</table></td><td width="50%"><table>';
		
		if($config['send_mail']==1) {
			$t=$config['email_recipient'].(($config['send_mail_dump']==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo '<tr><td valign="top">'.$lang['send_mail_form'].':</td><td class="dumppars">'.(($config['send_mail']==1) ? $t : $lang['not_activated']);
		echo '</td></tr> ';
		
		echo '<tr><td valign="top">'.$lang['ftp_transfer'].':</td><td class="dumppars">'.(($config['ftp_transfer']==1) ? $lang['activated'] : $lang['not_activated']);
		if($config['ftp_transfer']==1) {
			echo '<br>Host: '.$config['ftp_server'][$config['ftp_connectionindex']].' Port '.$config['ftp_port'][$config['ftp_connectionindex']].'<br>User: '.$config['ftp_user'][$config['ftp_connectionindex']].' Dir: '.$config['ftp_dir'][$config['ftp_connectionindex']];
		} 
		echo '<br><div style="display:none"><img src="images/fbd.gif" width="120" height="12" alt=""><br><img src="images/fbs.gif" width="120" height="12" alt=""></div></td></tr> ';
		
		echo '</table></td></tr></table>';
		
		
		//crondumpsettings
		echo '<h6 style="white-space: nowrap;">'.$lang['fm_dumpsettings_cron'].' '.Help("","perl").'</h6>';
		echo '<span class="smallgreen">'.$lang['perloutput1'].': <strong>'.$scriptentry.'</strong><br>';
		echo $lang['perloutput2'].': <strong>'.$scriptref.'</strong><br>';
		echo $lang['perloutput3'].': <strong>'.$cronref.'</strong></span>';
		
		echo '<table><tr valign="top"><td>';
		if($databases['db_actual_cronindex']==-3) {
			$cron_dbname=$lang['multidumpall']; 
			$cron_dbpraefix = "";
		} elseif($databases['db_actual_cronindex']==-2) {
			$cron_dbname='Multidump ('.count($databases['multi']).' '.$lang['dbs'].')'; 
			$cron_dbpraefix = "";
		} else {
			if($config['cron_samedb']==0) {
				$cron_dbname=$databases['db_actual']; 
				$cron_dbpraefix = $databases['praefix'][$databases['db_selected_index']]; 
			}else {
				$cron_dbname=$databases['Name'][$databases['db_actual_cronindex']];
				$cron_dbpraefix = $databases['db_actual_cronpraefix']; 
			}
		}
		
		echo "<table><tr><td>".$lang['db'].":</td><td class='crondumppars'><strong>$cron_dbname</strong></td></tr>";
		echo "<tr><td>".$lang['praefix'].":</td><td class='crondumppars'>$cron_dbpraefix</td></tr> ";
		echo "<tr><td>".$lang['gzip'].":</td><td class='crondumppars'>".(($config['cron_compression']==1)?$lang['activated']:$lang['not_activated'])."</td></tr> ";
		echo "<tr><td valign=\"top\">".$lang['multi_part'].":</td><td class='crondumppars'>".(($config['multi_part']==1)?$lang['yes']:$lang['no']);
		if($config['multi_part']==1) {
			echo "<br>".$lang['multi_part_groesse'].": ".byte_output($config['multipart_groesse']);
		} 
		echo '</td></tr>';
		echo '<tr><td>'.$lang['cron_printout'].':</td><td class="crondumppars">'.(($config['cron_printout']==1)?$lang['activated']:$lang['not_activated']).'</td></tr>';
		
		
		echo "</table></td><td><table>";
		
		if($config['cron_mail']==1) {
			$t=$config['email_recipient'].(($config['cron_mail_dump']==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo "<tr><td valign=\"top\">".$lang['send_mail_form'].":</td><td class='crondumppars'>".(($config['cron_mail']==1)?$t:$lang['not_activated']);
		 
		echo "</td></tr> ";
		
		echo "<tr><td valign=\"top\">".$lang['ftp_transfer'].":</td><td class='crondumppars'>".(($config['cron_ftp']==1)?$lang['activated']:$lang['not_activated']);
		if($config['cron_ftp']==1) {
			echo "<br>Host: ".$config['ftp_server'][$config['ftp_connectionindex']]." Port ".$config['ftp_port'][$config['ftp_connectionindex']]."<br>User: ".$config['ftp_user'][$config['ftp_connectionindex']]." Dir: ".$config['ftp_dir'][$config['ftp_connectionindex']];
		} 
		echo "</td></tr>";
		echo '<tr><td colspan="2"><input class="Formbutton_small" type="Button" name="DoCronscript" value="'.$lang['DoCronButton'].'" onclick="self.location.href=\''.$scriptref.'\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton_small" type="Button" name="DoPerlTest" value="'.$lang['DoPerlTest'].'" onclick="self.location.href=\''.$sfile.'\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton_small" type="Button" name="DoSimpleTest" value="'.$lang['DoSimpleTest'].'" onclick="self.location.href=\''.$simplefile.'\'"></td></tr>';
		
		echo "</table></td></tr></table><br>";
		
		//echo '<div class="verysmall" style="color:green;">'.$lang['phpcrondesc'].'</div>';
		break;
	
	case "restore":
		echo headline($lang['fm_restore_header'].$databases['db_actual'].$lang['fm_restore_header2']);
		echo (isset($msg) && $msg!="")?"$msg<br>":"";
		echo $autodel;
		echo $a1.$td.'<input class="Formbutton" name="restore" type="submit" value="'.$lang['fm_restore'].'" onclick="if (!confirm(\''.$lang['fm_alertrestore1'].' `'.$databases['db_actual'].'`  '.$lang['fm_alertrestore2'].' `\' + GetSelectedFilename() + \'` '.$lang['fm_alertrestore3'].'\')) return false;"></td>';
		
		//echo '</tr></table>'.$tbl_abfrage.'</div>';
		echo '</tr></table></div><br>';
		echo FileList().'</form>';
		break;
	case "files":
		$sysfedit=(isset($_POST['sysfedit'])) ? 1 : 0;
		$sysfedit=(isset($_GET['sysfedit'])) ? $_GET['sysfedit'] : $sysfedit;
		echo headline($lang['file_manage']);
		echo (isset($msg) && $msg!="") ? $msg.'<br>' : '';
		echo $autodel;
		echo $a1.'<input type="hidden" name="svice" value="'.$svice.'">';
		echo $td.br().'<input class="Formbutton" name="delete" type="submit" value="'.$lang['fm_delete'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete1'].'`\' + GetSelectedFilename() + \'`'.$lang['fm_askdelete2'].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Formbutton" name="deleteauto" type="submit" value="'.$lang['fm_deleteauto'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete3'].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Formbutton" name="deleteall" type="submit" value="'.$lang['fm_deleteall'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete4'].'\')) return false;"></td>'.br();
		echo $td.br().'<input class="Formbutton" name="deleteallfilter" type="submit" value="'.$lang['fm_deleteallfilter'].$databases['db_actual'].$lang['fm_deleteallfilter2'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete5'].$databases['db_actual'].$lang['fm_askdelete5_2'].'\')) return false;"></td>'.br();
		if(isset($svice) && $svice==1) echo $td.br().'<input class="Menubutton2" name="sysfedit" type="submit" value="Service"></td>'.br();
		echo '</tr>'.br().'</table>'.br().'<br>'.br();
		
		if($sysfedit==0) echo FileList().'</form></div>'.br().$ul.'<br>'.br().'<br>'.br();
		else {
			echo '</form></div>'.br().'<br>'.br();
			$dir=0;$fname="";
			if(isset($_GET['dir'])) $dir=$_GET['dir'];
			if(isset($_GET['filename'])) $fname=$_GET['filename'];
			
			if(isset($_POST['fedit_save'])) {
				$savetext=($config['magic_quotes_gpc']==1) ? stripslashes($_POST['editor']) : $_POST['editor'];
				$savefile=$dirs[$_POST['dir']].$_POST['edit_filename'];
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
		echo '<a href="filemanagement.php?action=convert">'.$lang["converter"].'</a>';
		break;
	case "convert":
		// Konverter
		echo headline($lang["converter"]);
		echo '<br><br><form action="filemanagement.php?action=convert" method="post">';
		echo '<table border="1" rules="all"><tr><td colspan="2" class="hd">'.$lang["convert_title"].'</td></tr>';
		echo '<tr><td>'.$lang["convert_file"].'</td><td>'.FilelisteCombo($config["paths"]["backup"],$selectfile).'</td></tr>';
		echo '<tr><td>'.$lang["convert_filename"].':</td><td><input type="text" name="destfile" size="50" value="'.$destfile.'"></td></tr>';
		echo '<tr><td><input type="checkbox" name="compressed" value="1" '.(($compressed==1) ? "checked" : "").'>'.$lang["compressed"].'</td><td><input type="submit" name="startconvert" value=" Konvertierung starten "></td></tr>';
		echo '</table></form><br>';	
		if(isset($_POST["startconvert"])) {
			$destfile.=($compressed==1) ? ".sql.gz" : ".sql";
			echo $lang["converting"]." $selectfile ==&gt; $destfile<br>";
			
			if($selectfile!="" && file_exists($config["paths"]["backup"].$selectfile) && strlen($destfile)>7) {
				Converter($selectfile,$destfile,$compressed);
			}
			else echo $lang["convert_wrong_parameters"];
		}

}

echo '<br><br>'.br(3);
echo MSDFooter();



?>

