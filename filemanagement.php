<?php

include("inc/header.php");

if($auto_delete==1)$msg=AutoDelete();

//--------------------------------------------------------
//*** Abfrage ob Dump ***
//--------------------------------------------------------
if (isset($_POST["dump"]))
{
	echo '<script language="JavaScript">parent.main.location.href="dump.php";</script>'; 
}

//--------------------------------------------------------
//*** Abfrage ob Restore ***
//--------------------------------------------------------
if (isset($_POST["restore"]))
{
   if (isset($_POST["file"]))
   {
		echo '<script language="JavaScript">parent.main.location.href="restore.php?filename='.$_POST["file"].'";</script>'; 
   }
   else
   $msg.= "<p class='fehler'>".$l["fm_nofile"]."</p>\n";
}

//--------------------------------------------------------
//*** Abfrage ob Delete ***
//--------------------------------------------------------
if (isset($_POST["delete"]) )
{
   if (isset($_POST["file"]))
   {
	$file=$_POST["file"];
   		if (@unlink($backup_path.$file)) {
    		$msg.= "<p class='meldung'>".$l["fm_delete1"].$file.$l["fm_delete2"]."</p>";
			WriteLog("deleted '$file'.");
		}else {
    	$msg.= "<p class='fehler'>".$l["fm_delete1"]. $file .$l["fm_delete3"]."</p>";
		}
    }
    else
    $msg.= "<p class='fehler'>".$l["fm_nofile"]."</p>\n";
}
if (isset($_POST["deleteauto"]) )
{
	
	//hier kommt autodelete rein
	$msg.=AutoDelete();
}
if (isset($_POST["deleteall"]) )
{
	//hier kommt alldelete rein
	$del=DeleteFiles($backup_path,"*.sql");
	if($del==0){
		//$msg.="Fehler beim löschen!";
	}else{
		for ($i=0; $i<sizeof($del); $i++) {
			$msg.="File '".$del[$i]."' gelöscht<br>";
			WriteLog("deleted '$del[$i]'.");
		}
	}
	$del=DeleteFiles($backup_path,"*.gz");
	if($del==0){
		//$msg.="Fehler beim löschen!";
	}else{
		for ($i=0; $i<sizeof($del); $i++) {
			$msg.="File '".$del[$i]."' gelöscht<br>";
			WriteLog("deleted '$del[$i]'.");
		}
	}
}

if (isset($_POST["deleteallfilter"]) )
{
	//hier kommt alldelete rein
	$del=DeleteFiles($backup_path,"$dbname*");
	if($del==0){
		//$msg.="Fehler beim löschen!";
	}else{
		for ($i=0; $i<sizeof($del); $i++) {
			$msg.="File '".$del[$i]."' gelöscht<br>";
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
   if (!isset($_FILES["upfile"]["name"])) echo "<font color=\"red\">".$l["fm_uploadfilerequest"]."</font><br><br>"; 
   else 
   { 
       if (!file_exists($backup_path.$_FILES["upfile"]["name"])) 
      { 
         // Extension ermitteln -strrpos fängt hinten an und ermittelt somit den letzten Punkt    
            $pos=strrpos($_FILES["upfile"]["name"],"."); 
            $endung=strtolower(substr($_FILES["upfile"]["name"],$pos,(strlen($_FILES["upfile"]["name"])-$pos))); 
            $erlaubt=ARRAY(".gz",".sql"); 
            if (!in_array($endung,$erlaubt)) 
            { 
              $msg.= "<font color=\"red\">".$l["fm_uploadnotallowed1"]; 
            $msg.= $l["fm_uploadnotallowed2"]."</font>"; 
            } 
            else 
            { 
            if (!$error) 
            { 
                if (move_uploaded_file($_FILES["upfile"]["tmp_name"],$backup_path.$_FILES["upfile"]["name"])) chmod($backup_path.$upfile_name,0755); 
               else $error.="<font color=\"red\">".$l["fm_uploadmoveerror"]."<br>"; 
            } 
              if ($error) $msg.= $error."<font color=\"red\">".$l["fm_uploadfailed"]."</font><br>"; 
          } 
      } 
      else $msg.= "<font color=\"red\">".$l["fm_uploadfileexists"]."</font><br>"; 
   } 
}


// -> und ab hier die normale Seite
//
//

?>
<script language="JavaScript">
	function GetSelectedFilename()
	{
		var a="";
		if(!document.fm.file.length) {
			if(document.fm.file.checked){a=document.fm.file.value;}
		} else {
		for (i=0; i<document.fm.file.length; i++)
		{
  			if(document.fm.file[i].checked){a=document.fm.file[i].value;}
		}
		}
		return a;
	}
	function Check(i)
	{
		if(!document.fm.file.length) document.all.gd.innerHTML=document.fm.file.value;
		else document.all.gd.innerHTML=document.fm.file[i].value;
	}
</script>
<?

//Seitenteile vordefinieren

$a1= '<form name="fm" id="fm" method="post" action="'.$PHP_SELF.'?action='.$_GET["action"].'">';
$a1.= '<div align="center"><table border="1"><tr>';

$td='<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">';

$ul= "<h4>".$l["fm_upload"]."</h4>";
$ul.= "<table>";
$ul.= "<form action=\"".$PHP_SELF."\" method=\"POST\" enctype=\"multipart/form-data\">\n";
$ul.= "<td align=\"center\" colspan=\"2\"><input type=\"file\" name=\"upfile\"></td>\n";
$ul.= "<td align=\"center\"><input type=\"submit\" name=\"upload\" value=\"".$l["fm_fileupload"]."\">\n";
$ul.= "</td></tr></table>\n";
$ul.= "</form>\n";
$ul.= "</table></div>\n";

//Fallunterscheidung
$action=$_GET["action"];
if($action=="")$action="files";
	
switch ($action) {
	case "dump":
		echo "<h3>".$l["dump"]."</h3>".$msg."<br>";
		echo $a1.$td.'<input class="Menubutton" name="dump" type="submit" value="'.$l["fm_startdump"].'">	</td>';
	
		echo '</tr></table>';
		echo '<hr width="75%">'.$l["fm_dumpsettings"].'<hr width="75%"></div></form>';
		echo '<br><h3>Cronjob</h3>'.$l["cron_adress"].'<br>';
		echo '<p class="desc">'.$l["cron_desc"].'<hr>';
		echo '<form action="http://'.$_SERVER["SERVER_NAME"].$rootdir.'/'.$config_path.'crondump.pl" method="get">';
		echo '<div align="center"><table border="1"><tr>'.$td.'<input class="Menubutton" style="width:200px;" type="submit" name="DoCronscript" value="'.$l["DoCronButton"].'"></td></tr></table></div></form>'.$l["cronperldesc"].' <em>\'http://'.$_SERVER["SERVER_NAME"].$rootdir.'/'.$config_path.'crondump.pl\'</em></p>';
		break;
	
	case "restore":
		echo "<h3>".$l["restore"]."</h3>".$msg."<br>";
		echo $a1.$td.'<input class="Menubutton" name="restore" type="submit" value="'.$l["fm_restore"].'" onclick="if (!confirm(\''.$l["fm_alertrestore1"].' `'.$dbname.'`  '.$l["fm_alertrestore2"].' `\' + GetSelectedFilename() + \'` '.$l["fm_alertrestore3"].'\')) return false;"></td>';
		
		echo '</tr></table></div>';
		echo FileList().'</form>';
		break;
	case "files":
		echo "<h3>".$l["file_manage"]."</h3><br>".$msg."<br>";
		echo '<span class="small">'.$l["autodelete"].": ";
		echo ($auto_delete==0) ? $l["not_activated"] : $l["activated"]." (".$l["age_of_files"]."=$del_files_after_days  ".$l["number_of_files_form"]."=$max_backup_files)</span><br>";
		echo $a1;
		echo $td.'<input class="Menubutton2" name="delete" type="submit" value="'.$l["fm_delete"].'"	onclick="if (!confirm(\''.$l["fm_askdelete1"].'\' + GetSelectedFilename() + \''.$l["fm_askdelete2"].'\')) return false;"></td>';
		echo $td.'<input class="Menubutton2" name="deleteauto" type="submit" value="'.$l["fm_deleteauto"].'"	onclick="if (!confirm(\''.$l["fm_askdelete3"].'\')) return false;"></td>';
		echo $td.'<input class="Menubutton2" name="deleteall" type="submit" value="'.$l["fm_deleteall"].'"	onclick="if (!confirm(\''.$l["fm_askdelete4"].'\')) return false;"></td>';
		echo $td.'<input class="Menubutton2" name="deleteallfilter" type="submit" value="'.$l["fm_deleteallfilter"].'"	onclick="if (!confirm(\''.$l["fm_askdelete5"].'\')) return false;"></td>';
		echo '</tr></table></div>';
		echo FileList().'</form>'.$ul;
		break;
}

echo "<br><br>\n";
include("inc/footer.php");

function FileList()
{
	global $backup_path,$l;
	//--------------------------------------------------------
	//*** Ausgabe der Dateien ***
	//--------------------------------------------------------
	
	$dh = opendir($backup_path);
	$fl="";
	while (false !== ($filename = readdir($dh)))
	{
	    if ($filename != "." && $filename != "..") $files[] = $filename;
	}
	$fl.='<div align="center"><h4>'.$l["fm_files"].'</h4>'.$l["choose_file"].'
		<span id="gd" style="color:#330099; font-weight:bold;"></span><br><br>
		<table border="1" rules="rows" align="center" width="80%" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="2" class="hd">'.$l["fm_filename"].'</td>
			<td align="right" colspan="2" class="hd">'.$l["fm_filesize"].'</td>
		</tr>';
	
	@rsort($files);
	for ($i=0; $i<sizeof($files); $i++)
	{
	    // Dateigröße
	    $size = filesize("$backup_path/$files[$i]");
	    // Gesamtgröße aller Backupfiles
	    $gesamt = $gesamt + $size;
	
	    // Hier werden die Dateinamen ausgegeben
		$fl.='<tr>
			<td align="left" colspan="2">
			<input name="file" type="radio" value="'.$files[$i].'" onClick="Check('.$i.');">
			&nbsp;<a href="'.$backup_path.$files[$i].'">'.$files[$i].'</a></td>
			<td align="right" colspan="2">'.round($size/1024).' kByte</td>
		</tr>';
	}
	if (!is_array($files)) $fl.='<tr><td colspan="4" bgcolor="#CCCCCC">'.$l["fm_nofilesfound"].'</td></tr>'."\n";
	
	//--------------------------------------------------------
	//*** Ausgabe der Gesamtgröße aller Backupfiles ***
	//--------------------------------------------------------
	$space = diskfreespace("../");
	$fl.= "<tr>\n";
	$fl.= "<td align='left' colspan='2'><b>".$l["fm_sizesum"].": </b></td>\n";
	$fl.= "<td align=\"right\" colspan=\"2\"><b>".round($gesamt/1024)." kByte</b></td>\n";
	$fl.= "</tr>\n";
	
	
	//--------------------------------------------------------
	//*** Ausgabe des freien Speicher auf dem Rechner ***
	//--------------------------------------------------------
	$fl.= '<tr class="hellblau">';
	$fl.= '<td colspan="3">'.$l["fm_freespace"].': </td>';
	$fl.= "<td align=\"right\"><b>".round(($space/(1024*1024*1024)),2)."</b> GByte</td>\n";
	$fl.= "</tr>\n";
	$fl.= "</table>\n";
	return $fl;
}

?>

