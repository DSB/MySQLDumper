<?php
//Start SQL-Box
	if(isset($_GET['readfile']) && $_GET['readfile']==1) {
		$aus.='<form action="'.$params.'" method="post" enctype="multipart/form-data"><table class="bordersmall" width="100%"><tr><td>';
		$aus.='SQL-File öffnen (auch gz möglich):</td><td><input type="file" name="upfile"></td>';
		$aus.='<td><input type="submit" class="SQLbutton" name="submit_openfile" value=" öffnen "></td><td>(max 2 MB)</td>';
		$aus.='<td><input type="hidden" name="MAX_FILE_SIZE" value="2500000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></form>';
	}
	if(isset($_POST['submit_openfile'])) {
		//open file
		if (!isset($_FILES['upfile']['name']) || empty($_FILES['upfile']['name'])) $aus.='<span class="error">'.$lang['fm_uploadfilerequest'].'</span>';
		else {
			$fn=$_FILES['upfile']['tmp_name'];
			if(strtolower(substr($_FILES['upfile']['name'],-3))==".gz")
				$read__user_sqlfile=gzfile($fn);
			else
				$read__user_sqlfile=file($fn);
			$aus.='<span>geladenes File: <strong>'.$_FILES['upfile']['name'].'</strong>&nbsp;&nbsp;&nbsp;'.byte_output(filesize($_FILES['upfile']['tmp_name'])).'</span>';
			$sql_loaded=implode("",$read__user_sqlfile);
		}
		
		
		
	}
	$aus.='<div id="mysqlbox"><form action="sql.php" method="post">';
	//Titelzeile
	$aus.='<div id="sqlheaderbox">';
	$aus.='<a href="#" onclick="resizeSQL(0);"><img src="'.$config['files']['iconpath'].'close.gif" width="16" height="16" alt="" border="0" vspace="0" hspace="0" align="bottom"></a>&nbsp;&nbsp;';
	$aus.='<a href="#" onclick="resizeSQL(1);"><img src="'.$config['files']['iconpath'].'arrowup.gif" width="16" height="16" alt="show less" border="0" vspace="0" hspace="0" align="bottom"></a>';
	$aus.='&nbsp;<a href="#" onclick="resizeSQL(2);"><img src="'.$config['files']['iconpath'].'arrowdown.gif" width="16" height="16" alt="show more" border="0" vspace="0" hspace="0" align="bottom"></a>&nbsp;&nbsp;&nbsp;';
	$aus.='<input class="SQLbutton" type="button" onclick="document.location.href=\''.$params.'&amp;context=1\'" value="'.$lang['sql_befehle'].'">'.SQL_ComboBox().'&nbsp;&nbsp;'.Table_ComboBox();
	$aus.='&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;<input class="SQLbutton" type="submit" name="execsql" value="'.$lang['sql_exec'].'">&nbsp;';
	
	if(!isset($_GET['readfile'])) $aus.= '&nbsp;&nbsp;<a href="'.$params.'&amp;readfile=1"  title="read file"><img src="'.$config['files']['iconpath'].'openfile.gif" width="16" height="16" alt="read file" border="0"></a>&nbsp;';
	$aus.='<a href="'.$mysql_help_ref.'" target="_blanc" title="Mysql-Hilfe"><img src="'.$config['files']['iconpath'].'help16.gif" width="16" height="16" alt="" border="0"></a>';
	$aus.='</div>';
	
	
	//Eingabebox
	$aus.='<div id="sbox2"><textarea rows="4" cols="10" style="height:'.$config['interface_sqlboxsize'].'px;" name="sqltextarea"  id="sqltextarea">'.((isset($sql_loaded)) ? $sql_loaded : $sql['sql_statement'].$sql['order_statement']).'</textarea>';
	$aus.='<br><div class="ssmall" align="center">'.$lang['sql_warning'].'</div></div>';

	$aus.='<input type="hidden" name="db" value="'.$db.'"><input type="hidden" name="tablename" value="'.$tablename.'">';
	$aus.='<input type="hidden" name="dbid" value="'.$dbid.'"></form></div><br>';


if(isset($_GET['mode']) && $context==0) {
	if(isset($_GET['recordkey'])) $rk=stripslashes(urldecode($_GET['recordkey']));
	if(isset($_GET['tablename'])) $tablename=$_GET['tablename'];
	
	if($_GET['mode']=="kill") {
		
		if($showtables==0) {
			$sqlk= "DELETE FROM `$tablename` WHERE ".$rk;
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			$aus.='<p class="success">'.$lang['sql_recorddeleted'].'</p>';
		} else {
			$sqlk= "Drop Table `$rk`";
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			$aus.='<p class="success">'.sprintf($lang['sql_recorddeleted'],$rk).'</p>';
		}
	}
	if($_GET['mode']=="empty") {
		
		if($showtables==0) {
			
		} else {
			$sqlk= "TRUNCATE `$rk`";
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			$aus.='<p class="success">'.sprintf($lang['sql_tableemptied'],$rk).'</p>';
		}
	}
	if($_GET['mode']=="emptyk") {
		
		if($showtables==0) {
			
		} else {
			$sqlk= "TRUNCATE `$rk`;";
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			$sqlk= "ALTER TABLE `$rk` AUTO_INCREMENT=1;";
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			$aus.='<p class="success">'.sprintf($lang['sql_tableemptiedkeys'],$rk).'</p>';
		}
	}
	if($_GET['mode']=="edit") {
		$aus.='<div id="sqleditbox"><p>'.$lang['sql_recordedit'].' '.$rk.'</p>';
		$sqledit="Select * from `$tablename` where $rk";
		
		$res=MSD_query($sqledit) or die(SQLError($sqledit,mysql_error()));
		$aus.='<form action="sql.php" method="post">';
		$aus.='<input type="hidden" name="recordkey" value="'.$rk.'">';
		$row=mysql_fetch_row($res); 
		$aus.='<table>';
		$feldnamen="";
		for($x=0; $x<count($row); $x++) { 
			$str = mysql_fetch_field($res,$x); 
			$feldnamen.=$str->name.'|';
			$aus.='<tr><td>'.$str->name.'</td><td>';
			if($str->type=='blob')
				$aus.='<textarea cols="60" rows="4" name="'.$str->name.'">'.$row[$x].'</textarea>';
			else
				$aus.='<input type="text" class="text" size="60" name="'.$str->name.'" value="'.$row[$x].'">';
			$aus.='</td>';	
			$aus.= '<td>&nbsp;</td></tr>'; //'.$str->type.'
		}
		
		$aus.='<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="'.substr($feldnamen,0,strlen($feldnamen)-1).'"><input class="SQLbutton" type="submit" name="update" value="update">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="Button" value="cancel edit" onclick="location.href=\'sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;tablename='.$tablename.'\';"></td></tr>';
		$aus.='</table>'.FormHiddenParams().'<input type="hidden" name="sql_statement" value="'.urlencode($sql['sql_statement']).'"></form></div>';
	}
	if($_GET['mode']=="new") {
		$aus.='<div id="sqlnewbox"><p>'.$lang['sql_recordnew'].'</p>';
		$sqledit="SHOW FIELDS FROM `$tablename`";
		$res=MSD_query($sqledit) or die(SQLError($sqledit,mysql_error()));
		$num=mysql_numrows($res); 
		$aus.='<form action="sql.php" method="post">';
		$aus.='<input type="hidden" name="recordkey" value="">';
		
		$aus.='<table>';
		$feldnamen="";
		for($x=0; $x<$num; $x++) { 
			$row=mysql_fetch_row($res); 
			$feldnamen.=$row[0].'|';
			$aus.='<tr><td>'.$row[0].'</td><td>';
			$type=strtoupper($row[1]);
			if($type=='BLOB' || $type=='TEXT')
				$aus.='<textarea cols="60" rows="4" name="'.$row[0].'">'.$row[4].'</textarea>';
			else
				$aus.='<input type="text" class="text" size="60" name="'.$row[0].'" value="'.$row[4].'">';
			$aus.='</td>';	
			$aus.='<td>&nbsp;</td></tr>'; //'.$str->type.'
		}
		$aus.='<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="'.substr($feldnamen,0,strlen($feldnamen)-1).'"><input class="SQLbutton" type="submit" name="insert" value="insert">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="submit" name="cancel" value="cancel insert"></td></tr>';
		$aus.='</table>'.FormHiddenParams().'<input type="hidden" name="sql_statement" value="'.urlencode($sql['sql_statement']).'"></form></div>';
		
	}
}
?>
