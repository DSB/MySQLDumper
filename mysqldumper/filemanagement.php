<?php
include('./inc/header.php');
include_once('./language/'.$config['language'].'/lang.php');
include_once('./language/'.$config['language'].'/lang_filemanagement.php');
include_once('./language/'.$config['language'].'/lang_config_overview.php');
include_once('./language/'.$config['language'].'/lang_main.php');
include_once('./inc/functions_files.php');
include_once('./inc/functions_sql.php');

get_sql_encodings();
echo MSDHeader();

$dump=array();
$dirs=Array("","./","./inc/","./msd_cron/","./language/","./work/config/");
if($config['auto_delete']==1)$msg=AutoDelete();
if (file_exists("work/log/dump.html")) @unlink("work/log/dump.html");

//0=Datenbank  1=Struktur
$action=(isset($_GET['action'])) ? $_GET['action'] : "files";
$kind=(isset($_GET['kind'])) ? $_GET['kind'] : 0;
$expand=(isset($_GET['expand'])) ? $_GET['expand'] : -1;
$selectfile=(isset($_POST['selectfile'])) ? $_POST['selectfile'] : "";
$destfile=(isset($_POST['destfile'])) ? $_POST['destfile'] : "";
$compressed=(isset($_POST['compressed'])) ? $_POST['compressed'] : "";
$dump['select_dump_encoding']=(isset($_POST['select_dump_encoding'])) ? $_POST['select_dump_encoding'] : get_index($config['mysql_possible_character_sets'],$config['mysql_standard_character_set']);

$dump['dump_encoding']=$config['mysql_possible_character_sets'][$dump['select_dump_encoding']];

$toolboxstring="";

if($kind==0) $fpath=$config['paths']['backup']; else $fpath=$config['paths']['structure'];
$dbactiv=(isset($_GET['dbactiv'])) ? $_GET['dbactiv'] : $databases['db_actual'];
$msg="";

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
	$check_dirs=TestWorkDir();
	if (!$check_dirs===true) die($check_dirs);
	$databases['db_actual_tableselected']=substr($_POST['tbl_array'],0,strlen($_POST['tbl_array'])-1);
	WriteParams(1,$config,$databases);
	$dk=(isset($_POST['dumpKommentar'])) ? ((get_magic_quotes_gpc()) ? stripslashes($_POST['dumpKommentar']) : $_POST['dumpKommentar']) : "";
	$dump['fileoperations']=0;
	echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.urlencode($dk)
		.'&select_dump_encoding='.$dump['select_dump_encoding']
		.'";</script>';
	exit;
}

//--------------------------------------------------------
//*** Abfrage ob Dump ***
//--------------------------------------------------------
if (isset($_POST['dump']))
{
	$dk=(isset($_POST['dumpKommentar'])) ? ((get_magic_quotes_gpc()) ? stripslashes($_POST['dumpKommentar']) : $_POST['dumpKommentar']) : "";
	if(isset($_POST['tblfrage']) && $_POST['tblfrage']==1) {
	//Tabellenabfrage
	$tblfrage_refer="dump";
	include ("inc/tabellenabfrage.php");
	exit;
	} else {
		@$check_dir=TestWorkDir();
		if (!$check_dir===true) die($check_dir);
		$databases['db_actual_tableselected']="";
		WriteParams(1,$config,$databases);

		$dump['fileoperations']=0;
		echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="dump.php?comment='.($_POST['dumpKommentar'])
		.'&select_dump_encoding='.$dump['select_dump_encoding']
		.'";</script>';
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
		if(isset($_POST['tblfrage']) && $_POST['tblfrage']==1)
		{
			//Tabellenabfrage
			$tblfrage_refer="restore";
			$filename=urldecode($_POST['file'][0]);
			include ("inc/tabellenabfrage.php");
			exit;
		}
		else
		{
			$file=$_POST['file'][0];
			$statusline=read_statusline_from_file($file);
			if (isset($_POST['select_dump_encoding_restore']))
			{
				$encodingstring=$config['mysql_possible_character_sets'][$_POST['select_dump_encoding_restore']];
				$encoding=explode(' ',$encodingstring);
				$dump_encoding=$encoding[0];
			}
			else
			{
				if (!isset($statusline['charset']) || trim($statusline['charset'])=='?')
				{
					echo headline($lang['fm_restore'].': '.$file);

					// if we can't detect encoding ask user
					echo '<br>'.$lang['choose_charset'].'<br><br>';
					echo '<form action="filemanagement.php?action=restore&kind=0" method="POST">';
					echo '<table><tr><td>'.$lang['fm_choose_encoding'].':</td><td>';
					echo '<select name="select_dump_encoding_restore">';
					echo make_options($config['mysql_possible_character_sets'],$dump['select_dump_encoding']);
					echo '</select></td></tr><tr><td>';
					echo $lang['mysql_connection_encoding'].':</td><td><strong>'.$config['mysql_standard_character_set'].'</strong></td></tr>';

					echo '<tr><td colspan="2"><br><input type="submit" name="restore" class="Formbutton" value="'.$lang['fm_restore'].'">';
					echo '<input type="hidden" name="file[0]" value="'.$file.'">';
					echo '</td></tr></table></form></body></html>';
					exit();
				}
				else $dump_encoding=$statusline['charset'];
			}

			$databases['db_actual_tableselected']="";
			WriteParams(1,$config,$databases);
			echo '<script language="JavaScript">parent.MySQL_Dumper_content.location.href="restore.php?filename='.$file.'&dump_encoding='.$dump_encoding.'&kind='.$kind.'";</script>';
		}
   }
   else
   $msg.= '<p class="error">'.$lang['fm_nofile'].'</p>'.br();
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
               $msg.= '<p class="error">'.$lang['fm_delete1'].$fpath.$delfiles[$i].$lang['fm_delete3'].'</p>';
            } else {
               for ($j=0; $j<count($del); $j++) {
                  $msg.=$lang['fm_delete1'].$del[$j].$lang['fm_delete2'].'<br>';
                  WriteLog("deleted '$del[$j]'.");
               }
            }

         }
         $msg.='</p>';


      } else {

          if($_POST['multipart'][0]==0) {
            $delfiles[]=$_POST['file'][0];
              } else {
               $delfiles[]=substr($_POST['file'][0],0,strpos($_POST['file'][0],"_part_"))."*.*";
              }

         $del=DeleteFilesM($fpath,$delfiles[0]);
         if($del==0){
             $msg.= '<p class="error">'.$lang['fm_delete1'].$fpath.$_POST['file'][0].$lang['fm_delete3'].'</p>';
         } else {
            for ($j=0; $j<count($del); $j++) {
               $msg.=$lang['fm_delete1'].$del[$j].$lang['fm_delete2'].'<br>';
               WriteLog("deleted '$del[$j]'.");
            }
         }
      }
    }
    else
    $msg.= '<p class="error">'.$lang['fm_nofile'].'</p>'.br();
}
if (isset($_POST['deleteauto']) ) $msg.='<p class="small">'.AutoDelete().'</p>';

if (isset($_POST['deleteall']) )
{
   //hier kommt alldelete rein
   $del=DeleteFilesM($fpath,"*.sql");
   if($del==0){
      //$msg.="Fehler beim l&ouml;schen!";
   }else{
      for ($i=0; $i<sizeof($del); $i++) {
         $msg.='<p class="small">File \''.$del[$i].'\' gel&ouml;scht<br>';
         WriteLog("deleted '$del[$i]'.");
      }
	  $msg.='</p>';
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
         $msg.='<p class="small">File \''.$del[$i].'\' gel&ouml;scht<br>';
         WriteLog("deleted '$del[$i]'.");
      }
	  $msg.='</p>';
   }
}

//////////////////////////////////
// Upload
///////////////////////////////////
if (isset($_POST['upload']))
{
   $error=false;
   if (!isset($_FILES['upfile']['name'])) echo '<span class="error">'.$lang['fm_uploadfilerequest'].'</span><br><br>';
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




//$tbl_abfrage='&nbsp;';
if($config['multi_dump']==0)  $tbl_abfrage='<tr><td>'.$lang['fm_selecttables'].'</td><td><input type="checkbox" class="checkbox" name="tblfrage" value="1"></td></tr>';
$dk= (isset($_POST['dumpKommentar'])) ? htmlentities($_POST['dumpKommentar']):'';
$tbl_abfrage.='<tr><td>'.$lang['fm_comment'].':</td><td><input type="text" class="text" style="width:260px;" name="dumpKommentar" value="'.$dk.'"></td></tr>';

$autodel='<p class="autodel">'.$lang['autodelete'].": ";
$abue=($config['max_backup_files_each']==1)? $lang['max_backup_files_each2'] :$lang['max_backup_files_each1'];
$abue2=($config['del_files_after_days']>0) ? $lang['age_of_files']."=".$config['del_files_after_days'].", " : "";
$autodel.=($config['auto_delete']==0) ? $lang['not_activated'] : $lang['activated']." (".$abue2.$lang['number_of_files_form']."=".$config['max_backup_files']." -> ".$abue.")";
$autodel.='</p>'.br().br();

//Fallunterscheidung



switch ($action) {
	case "dump":
		//Variablen
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

		//Ausgabe
		echo headline($lang['fm_dump_header']);
		if(!is_writable($config['paths']['backup'])) die('<span class="error">'.sprintf($lang['wrong_rights'],'work/backup','777').'</span>');

		echo (isset($msg) && $msg!="")?"$msg<br>":"";
		echo $autodel;

		//Auswahl
		echo '<div align="center">
		<input type="button" value=" '.$lang['dump'].' PHP " class="Formbutton" onclick="document.getElementById(\'buperl\').style.display=\'none\';document.getElementById(\'buphp\').style.display=\'block\';">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value=" '.$lang['dump'].' PERL " class="Formbutton" onclick="document.getElementById(\'buphp\').style.display=\'none\';document.getElementById(\'buperl\').style.display=\'block\';">
		</div>';

		echo '<div id="buphp">';

		//Dumpsettings
		echo '<h6>'.$lang['dump'].' (PHP)</h6>';

		echo br(3).'<div><form name="fm" id="fm" method="post" action="'.$href.'">'.br();
		echo '<input class="Formbutton" name="dump" type="submit" value="';
		echo $lang['fm_startdump'].'">';

		echo '<table>'.$tbl_abfrage;
		echo '<tr><td>'.$lang['fm_choose_encoding'].':</td>';
		echo '<td><select name="select_dump_encoding">';
		echo make_options($config['mysql_possible_character_sets'],$dump['select_dump_encoding']);
		echo '</select></td></tr>';
		echo '<tr><td>'.$lang['mysql_connection_encoding'].':</td><td><strong>'.$config['mysql_standard_character_set'].'</strong></td></tr>';
		echo '</table></form></div>';


		echo '<h6>'.$lang['fm_dumpsettings'].' (PHP)</h6>';

		echo ''.$lang['db'].': <strong>'.
			(($config['multi_dump']==1) ?
				'<span title="'.$toolboxstring.'">Multidump ('.count($databases['multi']).' '.$lang['dbs'].')</span></strong>'
										:
			   $databases['db_actual'].'&nbsp;&nbsp;<span>('.$databases['Detailinfo']['tables']." Tables, ".$databases['Detailinfo']['records']." Records, ".byte_output($databases['Detailinfo']['size']).")</span>").'</strong>';
		echo '&nbsp;&nbsp;&nbsp;'.$lang['praefix'].': <strong>'.(($config['multi_dump']==1) ? '-' : $databases['praefix'][$databases['db_selected_index']]).'</strong>';
		echo '<br>'.$lang['gzip'].': <strong>'.(($config['compression']==1) ? $lang['activated'] : $lang['not_activated']).'</strong>';
		echo '&nbsp;&nbsp;&nbsp;'.$lang['multi_part'].': <strong>'.(($config['multi_part']==1) ? $lang['yes'] : $lang['no']).'';
		if($config['multi_part']==1) {
			echo '&nbsp;&nbsp;&nbsp;</strong>'.$lang['multi_part_groesse'].': <strong>'.byte_output($config['multipart_groesse']);
		}
		echo '</strong><br>'.$lang['backup_format'].': <strong>';
		$t='';
		if($config['backup_complete_inserts']==1) $t.=$lang['inserts_complete']." / ";
		if($config['backup_extended_inserts']==1) $t.=$lang['inserts_extended']." / ";
		if($config['backup_ignore_inserts']==1) $t.=$lang['inserts_ignore']." / ";
		if($config['backup_delayed_inserts']==1) $t.=$lang['inserts_delayed']." / ";
		if($config['backup_lock_tables']==1 && $config['backup_delayed_inserts']==0) $t.=$lang['lock_tables']." / ";
		$t=($t=="") ? $lang['normal'] : substr($t,0,strlen($t)-3);
		if($config['backup_downgrade']==1) $t.='&nbsp;&nbsp;&nbsp;'.htmlspecialchars($lang['downgrade']);

		echo $t.'</strong><br>';

		if($config['send_mail']==1) {
			$t=$config['email_recipient'].(($config['send_mail_dump']==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo ''.$lang['send_mail_form'].': <strong>'.(($config['send_mail']==1) ? $t : $lang['not_activated']);
		echo '</strong>';

		echo '<br>'.$lang['ftp_transfer'].': <strong>'.(($config['ftp_transfer']==1) ? $lang['activated'] : $lang['not_activated']);
		if($config['ftp_transfer']==1) {
			echo 'Host: '.$config['ftp_server'][$config['ftp_connectionindex']].' Port '.$config['ftp_port'][$config['ftp_connectionindex']].' User: '.$config['ftp_user'][$config['ftp_connectionindex']].' Dir: '.$config['ftp_dir'][$config['ftp_connectionindex']];
		}

		echo '</strong><div style="display:none"><img src="'.$config['files']['iconpath'].'progressbar_dump.gif" width="120" height="12" alt=""><br><img src="'.$config['files']['iconpath'].'progressbar_speed.gif" width="120" height="12" alt=""></div>';

		echo '</div><div id="buperl" style="display:none;">';

		//crondumpsettings
		echo '<h6>'.$lang['dump'].' (PERL)</h6>';

		echo '<p><input class="Formbutton" type="Button" name="DoCronscript" value="'.$lang['DoCronButton'].'" onclick="self.location.href=\''.$scriptref.'\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton" type="Button" name="DoPerlTest" value="'.$lang['DoPerlTest'].'" onclick="self.location.href=\''.$sfile.'\'">&nbsp;&nbsp;';
		echo '<input class="Formbutton" type="Button" name="DoSimpleTest" value="'.$lang['DoSimpleTest'].'" onclick="self.location.href=\''.$simplefile.'\'"></p>';

		//echo '<h6>'.$lang['fm_dumpsettings_cron'].' '.Help("","perl").'</h6>';
		echo '<h6>'.$lang['fm_dumpsettings'].' (PERL)</h6>';

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

		echo '<p>'.$lang['db'].': <strong>'.$cron_dbname.'</strong>';
		echo '&nbsp;&nbsp;&nbsp;'.$lang['praefix'].": $cron_dbpraefix";
		echo '<br>'.$lang['gzip'].": <strong>".(($config['cron_compression']==1)?$lang['activated']:$lang['not_activated']);
		echo '</strong>&nbsp;&nbsp;&nbsp;'.$lang['multi_part'].": <strong>".(($config['multi_part']==1)?$lang['yes']:$lang['no']);
		if($config['multi_part']==1) {
			echo '&nbsp;&nbsp;</strong>'.$lang['multi_part_groesse'].": <strong>".byte_output($config['multipart_groesse']);
		}
		echo '</strong><br>'.$lang['cron_printout'].': <strong>'.(($config['cron_printout']==1)?$lang['activated']:$lang['not_activated']).'</strong>';

		if($config['cron_mail']==1) {
			$t=$config['email_recipient'].(($config['cron_mail_dump']==1) ? $lang['withattach'] : $lang['withoutattach']);
		}
		echo '<br>'.$lang['send_mail_form'].": <strong>".(($config['cron_mail']==1)?$t:$lang['not_activated']).'</strong>';
		echo '<br>'.$lang['ftp_transfer'].": <strong>".(($config['cron_ftp']==1)?$lang['activated']:$lang['not_activated']);
		if($config['cron_ftp']==1) {
			echo ' (Host: '.$config['ftp_server'][$config['ftp_connectionindex']].' Port '.$config['ftp_port'][$config['ftp_connectionindex']].' User: '.$config['ftp_user'][$config['ftp_connectionindex']].' Dir: '.$config['ftp_dir'][$config['ftp_connectionindex']].')<br>';
		}
		echo '</strong></p>';

		//	Einträge für Perl
		echo '<p class="small">'.$lang['perloutput1'].':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$scriptentry.'</strong><br>';
		echo $lang['perloutput2'].':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$scriptref.'</strong><br>';
		echo $lang['perloutput3'].':<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$cronref.'</strong></p>';

		echo '</div>';

		break;

	case "restore":
		echo headline($lang['fm_restore_header'].$databases['db_actual'].$lang['fm_restore_header2']);
		echo (isset($msg) && $msg!="")?"$msg":"";
		echo $autodel;

		echo br(3).'<form name="fm" id="fm" method="post" action="'.$href.'">'.br();
		echo '<div align="center">'.br();
		echo '<input class="Formbutton" name="restore" type="submit" value="'.$lang['fm_restore'].'" onclick="if (!confirm(\''.$lang['fm_alertrestore1'].' `'.$databases['db_actual'].'`  '.$lang['fm_alertrestore2'].' `\' + GetSelectedFilename() + \'` '.$lang['fm_alertrestore3'].'\')) return false;">';
		echo FileList();
		echo '</div></form>'.br();

		break;
	case "files":
		$sysfedit=(isset($_POST['sysfedit'])) ? 1 : 0;
		$sysfedit=(isset($_GET['sysfedit'])) ? $_GET['sysfedit'] : $sysfedit;
		echo headline($lang['file_manage']);
		echo (isset($msg) && $msg!="") ? $msg.'<br>' : '';
		echo $autodel;

		echo ''.br();
		echo br(3).'<form name="fm" id="fm" method="post" action="'.$href.'">'.br();
		echo br().'<input class="Formbutton" name="delete" type="submit" value="'.$lang['fm_delete'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete1'].'`\' + GetSelectedFilename() + \'`'.$lang['fm_askdelete2'].'\')) return false;">'.br();
		echo br().'<input class="Formbutton" name="deleteauto" type="submit" value="'.$lang['fm_deleteauto'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete3'].'\')) return false;">'.br();
		echo br().'<input class="Formbutton" name="deleteall" type="submit" value="'.$lang['fm_deleteall'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete4'].'\')) return false;">'.br();
		echo br().'<input class="Formbutton" name="deleteallfilter" type="submit" value="'.$lang['fm_deleteallfilter'].$databases['db_actual'].$lang['fm_deleteallfilter2'].'"	onclick="if (!confirm(\''.$lang['fm_askdelete5'].$databases['db_actual'].$lang['fm_askdelete5_2'].'\')) return false;">'.br();

		echo FileList().'</form>'.br();

		echo '<h6>'.$lang['fm_fileupload'].'</h6>'.br();
		echo '<div align="left"><form action="'.$href.'" method="POST" enctype="multipart/form-data">'.br();
		echo '<input type="file" name="upfile" class="Formbutton" size="60">'.br();
		echo '<input type="submit" name="upload" value="'.$lang['fm_fileupload'].'" class="Formbutton">'.br();
		echo '<br>'.$lang['max_upload_size'].': <strong>'.$config['upload_max_filesize'].'</strong>';
		echo '<br>'.$lang['max_upload_size_info'];

		echo '</form></div>'.br();

		echo '<h6>Tools</h6><div align="left">';
		echo '<input type="Button" onclick="document.location=\'filemanagement.php?action=convert\'" class="Formbutton" value="'.$lang['converter'].'">';
		echo '</div>';

		break;
	case "convert":
		// Konverter
		echo headline($lang['converter']);
		echo '<br><br><form action="filemanagement.php?action=convert" method="post">';
		echo '<div align="center"><table class="border"><tr><th colspan="2">'.$lang['convert_title'].'</th></tr>';
		echo '<tr><td>'.$lang['convert_file'].'</td><td>'.FilelisteCombo($config['paths']['backup'],$selectfile).'</td></tr>';
		echo '<tr><td>'.$lang['convert_filename'].':</td><td><input type="text" name="destfile" size="50" value="'.$destfile.'"></td></tr>';
		echo '<tr><td><input type="checkbox" name="compressed" value="1" '.(($compressed==1) ? "checked" : "").'>'.$lang['compressed'].'</td>';
		echo '<td><input type="submit" name="startconvert" value=" '.$lang['convert_start'].' " class="Formbutton"></td></tr>';
		echo '</table></div></form><br>';
		if(isset($_POST['startconvert'])) {
			$destfile.=($compressed==1) ? ".sql.gz" : ".sql";
			echo $lang['converting']." $selectfile ==&gt; $destfile<br>";

			if($selectfile!="" && file_exists($config['paths']['backup'].$selectfile) && strlen($destfile)>2) {
				Converter($selectfile,$destfile,$compressed);
			}
			else echo $lang['convert_wrong_parameters'];
		}

}

echo ''.br(3);
echo MSDFooter();



?>

