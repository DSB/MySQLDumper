<?php
include_once('./inc/header.php');
include_once('language/'.$config['language'].'/lang.php');
include_once('language/'.$config['language'].'/lang_sql.php');

include_once('./inc/functions_sql.php');
include_once('./inc/mysql.php');
include_once('./inc/functions.php');
include_once('./'.$config['files']['parameter']);

$download=(isset($_POST['f_export_submit']) && (isset($_POST['f_export_sendresult']) && $_POST['f_export_sendresult']==1));
if(!$download)  {
	echo MSDHeader(0,"");
	ReadSQL();
	echo '<script language="JavaScript" type="text/javascript">
var auswahl = "document.getElementsByName(\"f_export_tables[]\")[0]";
var msg1="'.$lang['sql_notablesselected'].'";
</script>';
}

//Variabeln

$tdcompact=(isset($_GET['tdc'])) ? $_GET['tdc'] : $config['interface_table_compact'];

$mysql_help_ref='http://dev.mysql.com/doc/mysql/'.$config['language'].'/index.html';
$mysql_errorhelp_ref='http://dev.mysql.com/doc/mysql/'.$config['language'].'/error-handling.html';

$no_order=false;
$db=(!isset($_GET['db'])) ? $databases['db_actual'] : $_GET['db'];
$dbid=(!isset($_GET['dbid'])) ? $databases['db_selected_index'] : $_GET['dbid'];
$context=(!isset($_GET['context'])) ? 0 : $_GET['context'];
$context=(!isset($_POST['context'])) ? $context : $_POST['context'];
$tablename=(!isset($_GET['tablename'])) ? "" : $_GET['tablename'];
$limitstart=(!isset($_GET['limitstart'])) ? 0 : $_GET['limitstart'];
$orderdir=(!isset($_GET['orderdir'])) ? "" : $_GET['orderdir'];
$order=(!isset($_GET['order'])) ? "" : $_GET['order'];
$sqlconfig=(isset($_GET['sqlconfig'])) ? 1 : 0;
$editkey=(!isset($_GET['editkey'])) ? -1 : $_GET['editkey'];
$norder=($orderdir==" DESC") ? " ASC" : " DESC";
$sql['order_statement']=($order!="") ? " ORDER BY ".$order.$norder : "";
$sql['sql_statement']=(isset($_GET['sql_statement'])) ? stripslashes(urldecode($_GET['sql_statement'])) : "";
$showtables=(!isset($_GET['showtables'])) ? 0 : $_GET['showtables'];
$limit=$add_sql="";
$bb=(isset($_GET['bb'])) ? $_GET['bb'] : -1;
if(isset($_POST['tablename'])) $tablename=$_POST['tablename'];


//SQL-Statement geposted
if(isset($_POST['execsql']))
{
	$sql['sql_statement']=(isset($_POST['sqltextarea'])) ? stripslashes($_POST['sqltextarea']) : "";

	$db=$_POST['db'];
	$dbid=$_POST['dbid'];
	$tablename=$_POST['tablename'];
	if($tablename=='') $tablename=ExtractTablename($sql['sql_statement']);

}


if($sql['sql_statement']==""){
	if($tablename!="" && $showtables==0) {
		$sql['sql_statement']="SELECT * FROM `$tablename`";
	} else {
		$sql['sql_statement']="SHOW TABLE STATUS FROM `$db`";
		$showtables=1;
	}
}

//sql-type
$sql_to_display_data=0;
$Anzahl_SQLs=substr_count(substr($sql['sql_statement'],0,strlen($sql['sql_statement'])-1),";");

if($Anzahl_SQLs==0 && (substr(strtoupper($sql['sql_statement']),0,6)=="SELECT" || substr(strtoupper($sql['sql_statement']),0,4)=="SHOW" ))
	$sql_to_display_data=1;
//if($Anzahl_SQLs>0) $sql_to_display_data=0;

if($sql_to_display_data==1) {
	//nur ein SQL-Statement
	$limitende=($limitstart+$config['sql_limit']);

	//Darf editiert werden?
	$no_edit=(strtoupper(substr($sql['sql_statement'],0,6))!="SELECT" || $showtables==1
	|| preg_match('@^((-- |#)[^\n]*\n|/\*.*?\*/)*(UNION|JOIN)@im', $sql['sql_statement']));

	if($no_edit)$no_order=true;

	//Darf sortiert werden?
	$op=strpos(strtoupper($sql['sql_statement']),"ORDER");
	if($op>0) {
		$sql['order_statement']=substr($sql['sql_statement'],$op);
		$sql['sql_statement']=substr($sql['sql_statement'],0,$op);
	}

}

if(isset($_POST['tableselect']) && $_POST['tableselect']!="1") $tablename=$_POST['tableselect'];

//MySQL verbinden
MSD_mysql_connect();

mysql_select_db($db,$config['dbconnection']);


///*** EDIT / UPDATES / INSERTS ***///
///***                          ***///

//Datensatz editieren
if(isset($_POST['update'])) {
	GetPostParams();
	$f=explode("|",$_POST['feldnamen']);
	$sqlu='Update `'.$tablename.'` Set ';
	for($i=0;$i<count($f);$i++) {
		$sqlu.='`'.$f[$i].'`=\''.$_POST[$f[$i]].'\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu)-2).' WHERE '.stripslashes(urldecode($_POST['recordkey']));
	$res=MSD_query($sqlu) or die(SQLError($sqlu,mysql_error()));
	$msg= '<p class="success">'.$lang['sql_recordupdated'].'</p>';
}
//Datensatz einfügen
if(isset($_POST['insert'])) {
	GetPostParams();
	$f=explode("|",$_POST['feldnamen']);
	$sqlu='Insert into `'.$tablename.'` Set ';
	for($i=0;$i<count($f);$i++) {
		$sqlu.='`'.$f[$i].'`=\''.$_POST[$f[$i]].'\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu)-2);
	$res=MSD_query($sqlu) or die(SQLError($sqlu,mysql_error()));
	$msg= '<p class="success">'.$lang['sql_recordinserted'].'</p>';
}

if(isset($_POST['cancel'])) GetPostParams();




//Tabellenansicht
$showtables=(substr(strtoupper($sql['sql_statement']),0,5)=="SHOW ") ? 1 : 0;
$tabellenansicht=(substr(strtoupper($sql['sql_statement']),0,10)=="SHOW TABLE") ? 1 : 0;


if(strtolower(substr($sql['sql_statement'],0,6))=="select") $limit=' LIMIT '.$limitstart.', '.$limitende.';';
$params="sql.php?db=".$db."&amp;tablename=".$tablename."&amp;dbid=".$dbid.'&amp;context='.$context.'&amp;sql_statement='.urlencode($sql['sql_statement']).'&amp;tdc='.$tdcompact.'&amp;showtables='.$showtables;
if($order!="") $params.="&amp;order=".$order."&amp;orderdir=".$orderdir.'&amp;context='.$context;
if($bb>-1) $params.="&amp;bb=".$bb;

$aus=headline($lang['sql_browser']);

$aus.='<p class="sqlheadmenu"><a href="main.php?action=db&amp;dbid='.$dbid.'#dbid" onclick="setMenuActive(\'m1\');"><img src="'.$config['files']['iconpath'].'arrowleft.gif" width="16" height="16" alt="'.$lang['sql_backdboverview'].'" border="0"></a>&nbsp;&nbsp;';
$aus.='<a title="'.$lang['tools_toolbox'].'" href="sql.php?db='.$databases['db_actual'].'&amp;dbid='.$dbid.'&amp;context=3"><strong>['.$lang['tools'].']</strong></a>&nbsp;&nbsp;<strong>'.$lang['db'].'</strong>&nbsp;&nbsp;';

if($context<3) {
	$aus.='`<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'" title="'.$lang['sql_tableview'].'"><strong>'.$db.'</strong></a>`  '.(($tablename!="") ? '<strong>'.$lang['table'].'</strong> `<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;tablename='.$tablename.'"><strong>'.$tablename.'</strong></a>`' : '').'';
} else $aus.="(".$lang['sql_selecdb'].")";
$aus.='</p><p>&nbsp;</p>';

if($context==0) {
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
}

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


if($context==0){
	//Data-View
	echo $aus.'<h4>'.(($showtables==1)?$lang['sql_tableview']:$lang['sql_dataview']).'</h4><p>';
	if($showtables==0){
		$p='sql.php?sql_statement='.urlencode($sql['sql_statement']).'&amp;db='.$db.'&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;limitstart='.$limitstart.'&amp;order='.$order.'&amp;orderdir='.$orderdir.'&amp;tdc='.$tdcompact;
		echo '<a href="'.$p.'&amp;mode=new">'.$lang['sql_recordnew'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;tablename='.$tablename.'&amp;context=2">Tabellenstruktur bearbeiten</a>';
	} else {
		$p='sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;context=2';
		echo '<a href="'.$p.'">'.$lang['sql_tablenew'].'</a>';
	}
	//Statuszeile
	echo '</p><p>&nbsp;'.ExtractTablenameFromSQL($sql['sql_statement']).'</p><p align="left">';
	if(isset($msg))echo $msg;

	//SQL ausführen
	if($sql_to_display_data==0) {
		//mehrere SQL-Statements
		$numrowsabs=$numrows=0;
		MSD_DoSQL($sql['sql_statement']);
		echo SQLOutput($out);

	} else {
		$numrowsabs=$numrows=0;
		$res=MSD_query($sql['sql_statement']) or die(SQLError($sql['sql_statement'],mysql_error()));

		$numrowsabs=mysql_num_rows($res);
		$res=MSD_query($sql['sql_statement'].$sql['order_statement'].$limit) or die(SQLError($sql['sql_statement'].$sql['order_statement'].$limit,mysql_error()));
		$numrows=mysql_num_rows($res);
		if($limitende>$numrowsabs)$limitende=$numrowsabs;
	}


	if($numrowsabs>0 && $Anzahl_SQLs<=1) {
		if($showtables==0) {
			$command_line=$lang['info_records']." ".($limitstart+1)." - $limitende ".$lang['sql_vonins']." $numrowsabs &nbsp;&nbsp;&nbsp;";
			$command_line.=($limitstart>0) ? '<a href="'.$params.'&amp;limitstart=0">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&lt;&lt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitstart>0) ? '<a href="'.$params.'&amp;limitstart='.(($limitstart-$config['sql_limit']<0) ? 0 : $limitstart-$config['sql_limit']).'">&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&lt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitende<$numrowsabs) ? '<a href="'.$params.'&amp;limitstart='.($limitstart+$config['sql_limit']).'">&gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&gt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitende<($numrowsabs-$config['sql_limit'])) ? '<a href="'.$params.'&amp;limitstart='.($numrowsabs-$config['sql_limit']).'">&gt;&gt;</a>' : '&gt;&gt;';
			echo $command_line;
		} else {
			echo $numrowsabs." ".$lang['tables'];
		}
		echo '</p>';
		//Datentabelle
		echo '<table class="bordersmall">';

		$t=$d="";
		$fdesc=Array();
		$key=-1;
		if ($numrows>0){
			//Infos und Header holen
			//1.Datensatz für Feldinfos
			$row= mysql_fetch_row($res);
			//Kompaktmodus-Switcher
			$t='<td colspan="'.(count($row)+1).'" align="left"><a href="sql.php?db='.$db.'&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;order='.$order.'&amp;orderdir='.$orderdir.'&amp;limitstart='.$limitstart.'&amp;sql_statement='.urlencode($sql['sql_statement']).'&amp;tdc='.(($tdcompact==0) ? '1' : '0').'">'.(($tdcompact==0) ? $lang['sql_view_normal'] : $lang['sql_view_compact']).'</a>';
			$t.='&nbsp;&nbsp;&nbsp;'.$lang['sql_queryentry'].' '.count($row).' '.$lang['sql_columns'];
			$t.='</td></tr><tr class="thead">';
			$t.='<th>&nbsp;</th>';
			for($x=0; $x<count($row); $x++) {
				$str = mysql_fetch_field($res,$x);
				$t.='<th align="left">';
				$pic="";
				$fdesc[$x]['name']=$str->name;
				$fdesc[$x]['table']=$str->table;
				$fdesc[$x]['max_length']=$str->max_length;
				$fdesc[$x]['not_null']=$str->not_null;
				$fdesc[$x]['primary_key']=$str->primary_key;
				$fdesc[$x]['unique_key']=$str->unique_key;
				$fdesc[$x]['multiple_key']=$str->multiple_key;
				$fdesc[$x]['numeric']=$str->numeric;
				$fdesc[$x]['blob']=$str->blob;
				$fdesc[$x]['type']=$str->type;
				$fdesc[$x]['unsigned']=$str->unsigned;
				$fdesc[$x]['zerofill']=$str->zerofill;

				$tt="Name: ".$fdesc[$x]['name']."\nType: ".$fdesc[$x]['type']."\nMax Length: ".$fdesc[$x]['max_length']."\nUnsigned: ".$fdesc[$x]['unsigned']."\nzerofill: ".$fdesc[$x]['zerofill'];
				$pic='<img src="images/blank.gif" alt="" width="1" height="1" border="0">';
				if($str->primary_key==1 || $str->unique_key==1) {
					if($key==-1) $key=$x;
					if($str->primary_key==1) $pic='<img src="'.$config['files']['iconpath'].'key.gif" alt="primary key" width="14" height="16" border="0">';
					elseif($str->unique_key==1) $pic='<img src="'.$config['files']['iconpath'].'key.gif" alt="unique key" width="14" height="16" border="0">';
				}

				if($bb==-1)
				$bb_link=($str->type=="blob") ? '&nbsp;&nbsp;&nbsp;<a style="font-size:10px;color:blue;" title="use BB-Code for this field" href="sql.php?db='.$db.'&amp;bb='.$x.'&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;order='.$order.'&amp;orderdir='.$orderdir.'&amp;limitstart='.$limitstart.'&amp;sql_statement='.urlencode($sql['sql_statement']).'&amp;tdc='.$tdcompact.'">[BB]</a>' : '';
				else
				$bb_link=($str->type=="blob") ? '&nbsp;&nbsp;&nbsp;<a title="use BB-Code for this field" href="sql.php?db='.$db.'&amp;bb=-1&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;order='.$order.'&amp;orderdir='.$orderdir.'&amp;limitstart='.$limitstart.'&amp;sql_statement='.urlencode($sql['sql_statement']).'&amp;tdc='.$tdcompact.'">[no BB]</a>' : '';
				if($no_order==false && $showtables==0)
					$t.=$pic.'&nbsp;<a title="'.$tt.'" href="sql.php?db='.$db.'&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;order='.$str->name.'&amp;orderdir='.$norder.'&amp;sql_statement='.urlencode($sql['sql_statement']).'&amp;tdc='.$tdcompact.'">'.$str->name.'</a>'.$bb_link;
				else
					$t.=$pic.'&nbsp;<span title="'.$tt.'" >'.$str->name.'</span>'.$bb_link;

				$arname=($orderdir==" ASC") ? "arup.gif" : "ardown.gif";
				if($str->name==$order)$t.='&nbsp;&nbsp;<img src="'.$config['files']['iconpath'].$arname.'" alt="" width="12" height="13" border="0">';
				$t.='</th>';

				//echo "<h5>DOING HEADERS</h5>$t";
			}

			//und jetzt Daten holen
			mysql_data_seek ($res, 0);

			for ($i=0;$i<$numrows;$i++) {
				$row= mysql_fetch_row($res);
				$cl= ($i % 2) ? "dbrow" : "dbrow1";
				for($x=0; $x<count($row); $x++) {
					if($x==0) {
						//edit-pics
						$d.=$nl.'<td valign="top" nowrap class="small">&nbsp;'.$nl;
						$p='sql.php?sql_statement='.urlencode($sql['sql_statement']).'&amp;db='.$db.'&amp;tablename='.$tablename.'&amp;dbid='.$dbid.'&amp;limitstart='.$limitstart.'&amp;order='.$order.'&amp;orderdir='.$orderdir.'&amp;editkey='.$key.'&amp;tdc='.$tdcompact;
						if($key==-1) {
							$rk="";
							for($il=0;$il<count($row);$il++) {
								$rk.="`".$fdesc[$il]['name']."`='".$row[$il]."' and ";
							}
							$p.='&amp;recordkey='.urlencode(substr($rk,0,strlen($rk)-5));
						} else {
							//Key vorhanden
							$p.='&amp;recordkey='.urlencode("`".$fdesc[$key]['name']."`='".$row[$key]."'");
						}
						if($showtables==1) $p.='&amp;recordkey='.$row[0];
						if(!$no_edit) {
							if($showtables==0) {
								$d.='<a href="'.$p.'&amp;mode=edit"><img src="'.$config['files']['iconpath'].'edit.gif" alt="edit" width="12" height="13" border="0"></a>&nbsp;';
							}
						}
						if($showtables==0) {
							$d.='<a href="'.$p.'&amp;mode=kill" onclick="if(!confirm(\''.$lang['askdeleterecord'].'\')) return false;"><img src="'.$config['files']['iconpath'].'delete.gif" alt="delete" width="11" height="13" border="0"></a>';
						} else {
							if($tabellenansicht==1) {
								$d.='<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;tablename='.$row[0].'&amp;context=2"><img src="'.$config['files']['iconpath'].'edit.gif" width="12" height="13" alt="'.$lang['edit'].'" title="'.$lang['edit'].'" border="0"></a>&nbsp;'.$nl.$nl;
								$d.='<a href="'.$p.'&amp;mode=empty" onclick="if(!confirm(\''.sprintf($lang['asktableempty'],$row[0]).'\')) return false;"><img src="'.$config['files']['iconpath'].'empty.gif" alt="'.$lang['empty'].'" title="'.$lang['empty'].'" width="11" height="13" border="0"></a>&nbsp;'.$nl.$nl;
								$d.='<a href="'.$p.'&amp;mode=emptyk" onclick="if(!confirm(\''.sprintf($lang['asktableemptykeys'],$row[0]).'\')) return false;"><img src="'.$config['files']['iconpath'].'emptykeys.gif" alt="'.$lang['emptykeys'].'" title="'.$lang['emptykeys'].'" width="11" height="13" border="0"></a>&nbsp;'.$nl.$nl;
								$d.='<a href="'.$p.'&amp;mode=kill" onclick="if(!confirm(\''.sprintf($lang['askdeletetable'],$row[0]).'\')) return false;"><img src="'.$config['files']['iconpath'].'delete.gif" alt="'.$lang['delete'].'" title="'.$lang['delete'].'" width="11" height="13" border="0"></a>&nbsp;'.$nl.$nl;
							}
						}
						$d.='</td>';
					}
					$d.='<td valign="top" class="small">';
					$divstart='<div'.(($tdcompact==1) ? ' class="tdcompact"' : ' class="tdnormal"').'>';
					$divend='</div>';
					if($bb==$x){
						$data=simple_bbcode_conversion($row[$x]);
					} else
						$data=(($fdesc[$x]['type']=='string' || $fdesc[$x]['type']=='blob') ? strip_tags($row[$x]) : $row[$x]);
					$d.=($tabellenansicht==1 && $x==0) ? "$divstart<a href=\"sql.php?db=$db&amp;tablename=$row[0]&amp;dbid=$dbid\" title=\"$data\">$data</a>$divend" : $divstart.$data.$divend;
					$d.='</td>';
				}
				if($i==0) echo '<tr>'.$t.'</tr>';
				echo "\n\n".'<tr class="'.$cl.'">'.$d.'</tr>'."\n\n";
				$d="";
			}
		}
		echo '</table>';
		if($showtables==0) echo '<br>'.$command_line;
	} else echo '<p class="success">'.$lang['sql_nodata'].'</p>';
} elseif ($context==1) {
	//SQL-Strings
	echo $aus.='<h4>'.$lang['sql_befehle'].' ('.count($SQL_ARRAY).')</h4>';
	echo '<a href="'.$params.'&amp;sqlconfig=1&amp;new=1">'.$lang['sql_befehlneu'].'</a><br><br>';
	if(isset($_POST['sqlnewupdate'])) {
		$ind=count($SQL_ARRAY);
		if(count($SQL_ARRAY)>0)
			array_push($SQL_ARRAY,$_POST['sqlname'.$ind]."|".$_POST['sqlstring'.$ind]);
		else $SQL_ARRAY[0]=$_POST['sqlname0']."|".$_POST['sqlstring0'];
		WriteSQL();
		echo '<p>'.$lang['sql_befehlsaved1'].' \''.$_POST['sqlname'.$ind].'\' '.$lang['sql_befehlsaved2'].'</p>';
	}
	echo '<form name="sqlform" action="sql.php" method="post">
	<input type="hidden" name="context" value="1">
	<input type="hidden" name="sqlconfig" value="1">
	<input type="hidden" name="tablename" value="'.$tablename.'">
	<input type="hidden" name="dbid" value="'.$dbid.'">';
	echo '<table class="border"><tr class="thead"><th>Position</th><th>Name</th><th>SQL</th><th>'.$lang['command'].'</th></tr>';
	$i=0;
	if(count($SQL_ARRAY)>0) {
		for($i=0;$i<count($SQL_ARRAY);$i++) {
			if(isset($_POST['sqlupdate'.$i])) {

				echo '<p class="success">'.$lang['sql_befehlsaved1'].' \''.$_POST['sqlname'.$i].'\' '.$lang['sql_befehlsaved3'].'</p>';
				$SQL_ARRAY[$i]=$_POST['sqlname'.$i]."|".$_POST['sqlstring'.$i];
				WriteSQL();
			}
			if(isset($_POST['sqlmove'.$i])) {
				echo '<p class="success">'.$lang['sql_befehlsaved1'].' \''.$_POST['sqlname'.$i].'\' '.$lang['sql_befehlsaved4'].'</p>';
				$a[]=$SQL_ARRAY[$i];
				array_splice($SQL_ARRAY,$i,1);
				$SQL_ARRAY=array_merge($a,$SQL_ARRAY);
				WriteSQL();
			}
			if(isset($_POST['sqldelete'.$i])) {
				echo '<p class="success">'.$lang['sql_befehlsaved1'].' \''.$_POST['sqlname'.$i].'\' '.$lang['sql_befehlsaved5'].'</p>';
				array_splice($SQL_ARRAY,$i,1);
				WriteSQL();
			}
		}
		for($i=0;$i<count($SQL_ARRAY);$i++) {
			$cl= ($i % 2) ? "dbrow" : "dbrow1";
			echo '<tr class="'.$cl.'"><td>'.($i+1).'</td><td>';
			echo '<input type="text" class="text" name="sqlname'.$i.'" value="'.SQL_Name($i).'"></td>';
			echo '<td><textarea rows="3" cols="40" name="sqlstring'.$i.'">'.stripslashes(SQL_String($i)).'</textarea></td>';
			echo '<td><input class="SQLbutton" style="width:80px;" type="submit" name="sqlupdate'.$i.'" value="save"><br>
			<input class="SQLbutton" style="width:80px;" type="submit" name="sqlmove'.$i.'" value="move up"><br>
			<input class="SQLbutton" style="width:80px;"  type="submit" name="sqldelete'.$i.'" value="delete"></td></tr>';
		}
	}
	if(isset($_GET['new'])) {
		$cl= ($i % 2) ? "dbrow" : "dbrow1";
		echo '<tr class="'.$cl.'"><td>'.($i+1).'</td><td>';
		echo '<input type="text" class="text" name="sqlname'.$i.'" id="sqlname'.$i.'" value="SQL '.($i+1).'"><br><div class="small" align="center">'.$lang['sql_library'].'<br>';
		echo '<select id="sqllib" name="sqllib" onChange="InsertLib('.$i.');" class="small">';
		echo '<option value=""></option>';
		$og=false;
		for($j=0;$j<count($sqllib);$j++) {
			if($sqllib[$j]['sql']=="trenn") {
				if($og) echo '</optgroup>';
				echo '<optgroup label="'.$sqllib[$j]['name'].'">';
				$og=true;
			} else {
				echo '<option value="'.$sqllib[$j]['sql'].'">'.$sqllib[$j]['name'].'</option>';
			}
		}
		if($og) echo '</optgroup>';
		echo '</select></div></td>
		<td><textarea rows="3" cols="40" name="sqlstring'.$i.'" id="sqlstring'.$i.'">SELECT * FROM</textarea></td>
		<td><input class="SQLbutton" style="width:80px;" type="submit" name="sqlnewupdate" value="save"></td></tr>';
	}
	echo '</table></form>';

} elseif ($context==2) {
	//Tabellen
	echo $aus.'<h6>'.$lang['sql_tablesofdb'].' `'.$databases['Name'][$dbid].'` '.$lang['sql_edit'].'</h6>';
	if(isset($_GET['kill'])) {
		if($_GET['anz']==1)
			echo '<p class="error">'.$lang['sql_nofielddelete'].'</p>';
		else {
			$sql_alter="ALTER TABLE `".$databases['Name'][$dbid]."`.`".$_GET['tablename']."` DROP COLUMN `".$_GET['kill']."`";
			MSD_DoSQL($sql_alter);
			echo '<div align="left" id="sqleditbox" style="font-size: 11px;width:90%;padding=6px;">';
			echo '<p class="success">'.$lang['sql_fielddelete1'].' `'.$_GET['kill'].'` '.$lang['sql_deleted'].'.</p>'.highlight_sql($out).'</div>';
		}
	}
	if(isset($_POST['tablecopysubmit'])) {
		$table_edit_name=$_GET['tablename'];
		if($_POST['tablecopyname']=="") {
			echo '<p class="error">'.$lang['sql_nodest_copy'].'</p>';
		} elseif(Table_Exists($databases['Name'][$dbid],$_POST['tablecopyname'])) {
			echo '<p class="error">'.$lang['sql_desttable_exists'].'</p>';
		} else {
			Table_Copy("`".$databases['Name'][$dbid]."`.`".$table_edit_name."`",$_POST['tablecopyname'],$_POST['copyatt']);
			echo '<div align="left" id="sqleditbox">';
			echo ($_POST['copyatt']==0) ? '<p class="success">'.sprintf($lang['sql_scopy'],$table_edit_name,$_POST['tablecopyname']).'.</p>' : '<p class="success">'.sprintf($lang['sql_tcopy'],$table_edit_name,$_POST['tablecopyname']).'</p>';
			echo highlight_sql($out).'</div>';
			$tablename=$_POST['tablecopyname'];
		}
	}
	if(isset($_POST['newtablesubmit'])) {
		if($_POST['newtablename']=="") {
			echo '<p class="error">'.$lang['sql_tablenoname'].'</p>';
		} else {
			$sql_alter="CREATE TABLE `".$databases['Name'][$dbid]."`.`".$_POST['newtablename']."` (`id` int(11) unsigned not null AUTO_INCREMENT PRIMARY KEY ) ".((MSD_NEW_VERSION) ? "ENGINE" : "TYPE")."=MyISAM;";
			MSD_DoSQL($sql_alter);
			echo SQLOutput($out,$lang['table'].' `'.$_POST['newtablename'].'` '.$lang['sql_created']);
		}
	}
	if(isset($_POST['t_edit_submit'])) {
		$sql_alter="ALTER TABLE `".$databases['Name'][$dbid]."`.`".$_POST['table_edit_name']."` ";
		if($_POST['t_edit_name']=="")
			echo '<p class="error">'.$lang['sql_tblnameempty'].'</p>';
		elseif(MSD_NEW_VERSION && $_POST['t_edit_collate']!="" && substr($_POST['t_edit_collate'],0,strlen($_POST['t_edit_charset']))!=$_POST['t_edit_charset'])
			echo '<p class="error">'.$lang['sql_collatenotmatch'].'</p>';
		else {
			if($_POST['table_edit_name']!=$_POST['t_edit_name']) {
				$sql_alter.="RENAME TO `".$_POST['t_edit_name']."`, ";
				$table_edit_name=$_POST['t_edit_name'];
			} else $table_edit_name=$_POST['table_edit_name'];
			if($_POST['t_edit_engine']!="")  $sql_alter.=((MSD_NEW_VERSION) ? "ENGINE=" : "TYPE=").$_POST['t_edit_engine'].", ";
			if($_POST['t_edit_rowformat']!="")  $sql_alter.="ROW_FORMAT=".$_POST['t_edit_rowformat'].", ";
			if(MSD_NEW_VERSION && $_POST['t_edit_charset']!="")  $sql_alter.="DEFAULT CHARSET=".$_POST['t_edit_charset'].", ";
			if(MSD_NEW_VERSION && $_POST['t_edit_collate']!="")  $sql_alter.="COLLATE ".$_POST['t_edit_collate'].", ";
			$sql_alter.="COMMENT='".$_POST['t_edit_comment']."' ";

			MSD_DoSQL($sql_alter);
			echo SQLOutput($out,$lang['table'].' `'.$_POST['table_edit_name'].'` '.$lang['sql_changed']);
		}
	} else {
		if(!isset($table_edit_name) || $table_edit_name=="") {
			$table_edit_name=(isset($_GET['tablename'])) ? $_GET['tablename'] : "";
			if(isset($_POST['tableselect'])) $table_edit_name=$_POST['tableselect'];
			if(isset($_POST['newtablesubmit'])) $table_edit_name=$_POST['newtablename'];
		}
	}
	if(isset($_POST['newfield_posted'])) {
		//build sql for alter
		if($_POST['f_name']=="") {
			echo '<p class="error">'.$lang['sql_fieldnamenotvalid'].' ('.$_POST['f_name'].')</p>';
			$field_fehler=1;
		} else {
			//alter Key
			$oldkeys[0]=$_POST['f_primary'];
			$oldkeys[1]=$_POST['f_unique'];
			$oldkeys[2]=$_POST['f_index'];
			$oldkeys[3]=$_POST['f_fulltext'];
			//neuer Key
			$newkeys[0]=($_POST['f_index_new']=="primary")? 1 : 0;
			$newkeys[1]=($_POST['f_index_new']=="unique")? 1 : 0;
			$newkeys[2]=($_POST['f_index_new']=="index")? 1 : 0;
			$newkeys[3]=(isset($_POST['f_indexfull'])) ? 1 : 0;

			$add_sql.=ChangeKeys($oldkeys,$newkeys,$_POST['f_name'],$_POST['f_size'],"drop_only");

			$sql_stamm="ALTER TABLE `".$databases['Name'][$dbid]."`.`$table_edit_name` ";
			$sql_alter=$sql_stamm.((isset($_POST['editfield'])) ? "CHANGE COLUMN `".$_POST['fieldname']."` `".$_POST['f_name']."` " : "ADD COLUMN `".$_POST['f_name']."` ");
			$sql_alter.=$_POST['f_type'];
			$wl=stripslashes($_POST['f_size']);
			if($wl!="" && !preg_match('@^(DATE|DATETIME|TIME|TINYBLOB|TINYTEXT|BLOB|TEXT|MEDIUMBLOB|MEDIUMTEXT|LONGBLOB|LONGTEXT)$@i', $_POST['f_type'])) {
				$sql_alter.="($wl) ";
			} elseif ($_POST['f_size']=="" && preg_match('@^(VARCHAR)$@i', $_POST['f_type'])) {
				$sql_alter.="("."255".") ";
			} else $sql_alter.=" ";
			$sql_alter.=$_POST['f_attribut']." ";
			$sql_alter.=$_POST['f_null']." ";
			$sql_alter.=($_POST['f_default']!="") ? "DEFAULT '".$_POST['f_default']."' " :"";

			if(MSD_NEW_VERSION && $_POST['f_collate']!="") $sql_alter.="COLLATE ".$_POST['f_collate']." ";

			if($_POST['f_extra']=="AUTO_INCREMENT") {
				$sql_alter.=" AUTO_INCREMENT ";
			}
			if($newkeys[0]==1) $sql_alter.=" PRIMARY KEY ";
			if($newkeys[1]==1) $sql_alter.=" UNIQUE INDEX ";
			if($newkeys[2]==1) $sql_alter.=" INDEX ";
			if($newkeys[3]==1) $sql_alter.=" FULLTEXT INDEX ";

			$sql_alter.=$_POST['f_position']." ;";

			if($add_sql!="") {
				$add_sql=$sql_stamm.$add_sql;
				$sql_alter="$sql_alter;\n$add_sql;\n";
			}
			MSD_DoSQL($sql_alter);

			echo '<div align="left" id="sqleditbox" style="font-size: 11px;width:90%;padding=6px;">';
			echo '<p class="success"> `'.$_POST['f_name'].'` '.((isset($_POST['editfield'])) ? $lang['sql_changed'] : $lang['sql_created']).'.</p>';
			echo highlight_sql($out).'</div>';
			$fields_infos=FillFieldinfos($databases['Name'][$dbid],$table_edit_name);
		}
	}
	mysql_select_db($databases['Name'][$dbid]);
	$sqlt="SHOW TABLE STATUS FROM `".$databases['Name'][$dbid]."` ;";
	$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
	$anz_tabellen=mysql_numrows($res);
	$p="sql.php?db=".$databases['Name'][$dbid]."&amp;dbid=$dbid&amp;tablename=$table_edit_name&amp;context=2";

	echo '<form action="sql.php?db='.$databases['Name'][$dbid].'&amp;dbid='.$dbid.'&amp;tablename='.$table_edit_name.'&amp;context=2" method="post">';
	echo '<table class="border"><tr class="dbrow"><td>'.$lang['new'].' '.$lang['sql_createtable'].': </td><td colspan="2"><input type="text" class="text" name="newtablename" size="30" maxlength="150"></td><td><input type="submit" name="newtablesubmit" value="'.$lang['sql_createtable'].'" class="SQLbutton"></td></tr>';
	echo '<tr class="dbrow1"><td>'.$lang['sql_copytable'].': </td><td><input type="text" class="text" name="tablecopyname" size="20" maxlength="150"></td><td><select name="copyatt"><option value="0">'.$lang['sql_structureonly'].'</option>'.((MSD_NEW_VERSION) ? '<option value="1">'.$lang['sql_structuredata'].'</option>' : '').'</select></td><td><input type="submit" class="SQLbutton" name="tablecopysubmit" value="'.$lang['sql_copytable'].'" '.(($table_edit_name=="") ? "disabled=\"disabled\"":"").'></td></tr></table>';

	echo '<table>';

	if($anz_tabellen==0) {
		echo '<tr><td>'.$lang['sql_notablesindb'].' `'.$databases['Name'][$dbid].'`</td></tr>';
	} else {


		echo '<tr><td>'.$lang['sql_selecttable'].':&nbsp;&nbsp;&nbsp;</td>';
		echo '<td><select name="tableselect" onchange="this.form.submit()"><option value="1" SELECTED></option>';
		for($i=0;$i<$anz_tabellen;$i++) {
			$row=mysql_fetch_array($res);
			echo '<option value="'.$row['Name'].'">'.$row['Name'].'</option>';
		}
		echo '</select>&nbsp;&nbsp;</td>';
		echo '<td><input type="button" class="SQLbutton" value="'.$lang['sql_showdatatable'].'" onclick="location.href=\'sql.php?db='.$databases['Name'][$dbid].'&amp;dbid='.$dbid.'&amp;tablename='.$tablename.'\'"></td></tr>';
	}
	echo '</table></form><p>&nbsp;</p>';
	if($table_edit_name!="") {

		$sqlf="SHOW FULL FIELDS FROM `".$databases['Name'][$dbid]."`.`$table_edit_name` ;";
		$res=MSD_query($sqlf) or die(SQLError($sqlf,mysql_error()));
		$anz_fields=mysql_num_rows($res);

		//Array füllen

		$fields_infos=FillFieldinfos($databases['Name'][$dbid],$table_edit_name);

		if(MSD_NEW_VERSION)
			$t_engine=(isset($fields_infos['_tableinfo_']['ENGINE'])) ? $fields_infos['_tableinfo_']['ENGINE'] : "MyISAM";
		else
			$t_engine=(isset($fields_infos['_tableinfo_']['TYPE'])) ? $fields_infos['_tableinfo_']['TYPE'] : "MyISAM";
		$t_charset=(isset($fields_infos['_tableinfo_']['DEFAULT CHARSET'])) ? $fields_infos['_tableinfo_']['DEFAULT CHARSET'] : "";
		$t_collation=isset($row['Collation']) ? $row['Collation'] : "";  //(isset($fields_infos['_tableinfo_']['COLLATE'])) ? $fields_infos['_tableinfo_']['COLLATE'] : "";
		$t_comment=(isset($fields_infos['_tableinfo_']['COMMENT'])) ? substr($fields_infos['_tableinfo_']['COMMENT'],1,strlen($fields_infos['_tableinfo_']['COMMENT'])-2) : "";
		$t_rowformat=(isset($fields_infos['_tableinfo_']['ROW_FORMAT'])) ? $fields_infos['_tableinfo_']['ROW_FORMAT'] : "";

		echo "<h6>Tabelle `$table_edit_name`</h6>";
		$td='<td valign="top" nowrap class="small">';


		//Tabelleneigenschaften
		echo '<form action="'.$p.'" method="post"><input type="hidden" name="table_edit_name" value="'.$table_edit_name.'"><table class="border">';
		echo '<tr class="sqlNew"><td colspan="4" style="font-size:10pt;font-weight:bold;">'.$lang['sql_tblpropsof'].' `'.$table_edit_name.'` ('.$anz_fields.' '.$lang['fields'].')</td>';
		echo '<td class="small" colspan="2" align="center">Name<br><input type="text" class="text" name="t_edit_name" value="'.$table_edit_name.'" size="30" maxlength="150" style="font-size:11px;"></td></tr>';
		echo '<tr class="sqlNew">';
		echo '<td class="small" align="center">Engine<br><select name="t_edit_engine"  style="font-size:11px;">'.EngineCombo($t_engine).'</select></td>';
		echo '<td class="small" align="center">Row Format<br><select name="t_edit_rowformat"  style="font-size:11px;">'.GetOptionsCombo($feldrowformat,$t_rowformat).'</select></td>';
		echo '<td class="small" align="center">'.$lang['charset'].'<br><select name="t_edit_charset"  style="font-size:11px;">'.CharsetCombo($t_charset).'</select></td>';
		echo '<td class="small" align="center">'.$lang['collation'].'<br><select name="t_edit_collate"  style="font-size:11px;">'.CollationCombo($t_collation).'</select></td>';
		echo '<td class="small" align="center">'.$lang['comment'].'<br><input type="text" class="text" name="t_edit_comment" value="'.$t_comment.'" size="30" maxlength="100" style="font-size:11px;"></td>';
		echo '<td class="small" align="center">&nbsp;<br><input type="submit" name="t_edit_submit" value="'.$lang['change'].'" class="SQLbutton"></td></tr>';
		echo '</table></form><p>&nbsp;</p>';

		$field_fehler=0;
		echo '<h6>Felder der Tabelle `'.$table_edit_name.'`</h6>';

		if(isset($_GET['newfield']) || isset($_GET['editfield']) || $field_fehler>0 || isset($_POST['newfield_posted'])) {
			if(isset($_GET['editfield'])) $id=$_GET['editfield'];
			$d_name=(isset($_GET['editfield'])) ? $fields_infos[$id]['name'] : "";
			$d_type=(isset($_GET['editfield'])) ? $fields_infos[$id]['type'] : "";
			$d_size=(isset($_GET['editfield'])) ? $fields_infos[$id]['size'] : "";
			$d_null=(isset($_GET['editfield'])) ? $fields_infos[$id]['null'] : "";
			$d_attribute=(isset($_GET['editfield'])) ? $fields_infos[$id]['attribut'] : "";
			$d_default=(isset($_GET['editfield'])) ? substr($fields_infos[$id]['default'],1,strlen($fields_infos[$id]['default'])-2) : "";
			$d_extra=(isset($_GET['editfield'])) ? $fields_infos[$id]['extra'] : "";
			$d_primary=$d_unique=$d_index=$d_fulltext=0;
			$d_collate=(isset($_GET['editfield'])) ? $fields_infos[$id]['collate'] : "";
			$d_comment=(isset($_GET['editfield'])) ? $fields_infos[$id]['comment'] : "";
			$d_privileges=(isset($_GET['editfield'])) ? $fields_infos[$id]['privileges'] : "";

			if(isset($_GET['editfield'])) {
				$d_primary=(isset($fields_infos['_primarykey_']) && $fields_infos['_primarykey_']==$fields_infos[$id]['name']) ? 1 : 0;
				if(isset($fields_infos['_key_'])) {
					for($i=0;$i<count($fields_infos['_key_']);$i++) {
						if($fields_infos['_key_'][$i]['name']==$fields_infos[$id]['name']) {
							$d_index=1;
							break;
						}
					}
				}
				if(isset($fields_infos['_fulltextkey_'])) {
					for($i=0;$i<count($fields_infos['_fulltextkey_']);$i++) {
						if($fields_infos['_fulltextkey_'][$i]['name']==$fields_infos[$id]['name']) {
							$d_fulltext=1;
							break;
						}
					}
				}
				if(isset($fields_infos['_uniquekey_'])) {
					for($i=0;$i<count($fields_infos['_uniquekey_']);$i++) {
						if($fields_infos['_uniquekey_'][$i]['name']==$fields_infos[$id]['name']) {
							$d_unique=1;
							break;
						}
					}
				}
			}
			echo '<form action="'.$p.'" method="post" id="smallform"><input type="hidden" name="newfield_posted" value="1">';
			if (isset($_GET['editfield'])) echo '<input type="hidden" name="editfield" value="'.$id.'"><input type="hidden" name="fieldname" value="'.$d_name.'">';
			if(isset($_POST['newtablesubmit'])) echo '<input type="hidden" name="newtablename" value="'.$_POST['newtablename'].'">';
			echo '<input type="hidden" name="f_primary" value="'.$d_primary.'"><input type="hidden" name="f_unique" value="'.$d_unique.'">';
			echo '<input type="hidden" name="f_index" value="'.$d_index.'"><input type="hidden" name="f_fulltext" value="'.$d_fulltext.'">';
			echo '<table class="bordersmall"><tr class="thead"><th colspan="6" align="center">'.((isset($_GET['editfield'])) ? $lang['sql_editfield']." `".$d_name."`" : $lang['sql_newfield']).'</th></tr>';
			echo '<tr><td class="small">Name<br><input type="text" class="text" value="'.$d_name.'" name="f_name" size="30"></td>';
			echo '<td>Type<br><select name="f_type">'.GetOptionsCombo($feldtypen,$d_type).'</select></td>';
			echo '<td>Size&nbsp;<img src="'.$config['files']['iconpath'].'help16.gif" alt="'.$lang['sql_enumsethelp'].'" title="'.$lang['sql_enumsethelp'].'" width="12" height="12" border="0"><br><input type="text" class="text" value="'.$d_size.'" name="f_size" size="3" maxlength="80"></td>';
			echo '<td>NULL<br><select name="f_null">'.GetOptionsCombo($feldnulls,$d_null).'</select></td>';
			echo '<td align="center">Default<br><input type="text" class="text" name="f_default" value="'.$d_default.'" size="10"></td>';
			echo '<td align="center">Extra<br><select name="f_extra">'.GetOptionsCombo($feldextras,$d_extra).'</select></td>';

			echo '</tr><tr><td align="center">'.$lang['sql_indexes'].'<br>';
			echo '<img src="'.$config['files']['iconpath'].'nokey.gif" width="12" height="13" border="0" alt="No Index"><input type="radio" class="radio" name="f_index_new" value="no" '.(($d_primary+$d_unique+$d_index+$d_fulltext==0) ? "checked" : "").'>&nbsp;';
			echo '<img src="'.$config['files']['iconpath'].'primary.gif" width="12" height="13" border="0" alt="Primary Key"><input type="radio" class="radio" name="f_index_new" value="primary" '.(($d_primary==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="'.$config['files']['iconpath'].'unique.gif" width="13" height="12" border="0" alt="Unique Index"><input type="radio" class="radio" name="f_index_new" value="unique" '.(($d_unique==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="'.$config['files']['iconpath'].'key.gif" width="13" height="12" border="0" alt="Index"><input type="radio" class="radio" name="f_index_new" value="index" '.(($d_index==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="'.$config['files']['iconpath'].'fulltext.gif" width="13" height="12" border="0" alt="Fulltext Index"><input type="checkbox" class="checkbox" name="f_indexfull" value="1" '.(($d_fulltext==1) ? "checked" : "" ).'>&nbsp;</td>';

			echo '<td align="center" colspan="2" >'.$lang['collation'].'<br><select name="f_collate">'.CollationCombo($d_collate).'</select></td>';
			echo '<td align="center">'.$lang['sql_attributes'].'<br><select name="f_attribut">'.AttributeCombo($d_attribute).'</select></td>';
			echo '<td align="center">'.$lang['sql_atposition'].':<br><select name="f_position"><option value=""></option><option value="FIRST">'.$lang['sql_first'].'</option>';
			if($anz_fields>0) {
				for($i=0;$i<$anz_fields;$i++) {
					echo '<option value="AFTER `'.$fields_infos[$i]['name'].'`">'.$lang['sql_after'].' `'.$fields_infos[$i]['name'].'`</option>';
				}
			}
			echo '</select></td><td align="center"><input type="submit" name="newfieldsubmit" value="'.((isset($_GET['editfield'])) ? $lang['sql_changefield'] : $lang['sql_insertfield']).'" class="SQLbutton"></td></tr></table></form><p>&nbsp;</p>';
		} else
			echo '<a style="font-size:8pt;padding-bottom:8px;" href="'.$p.'&amp;newfield=1">'.$lang['sql_insertnewfield'].'</a><br><br>';

		//Felder ausgeben
		echo '<table class="bordersmall">';
		for($i=0;$i<$anz_fields;$i++) {
			$cl= ($i % 2) ? "dbrow" : "dbrow1";
			if($i==0) echo '<tr class="thead"><th>&nbsp;</th><th>Field</th><th>Type</th><th>Size</th><th>NULL</th><th>Key</th><th>Attribute</th><th>Default</th><th>Extra</th><th>Sortierung</th></tr>';
			echo '<tr class="'.$cl.'"><td>';
			echo '<a href="'.$p.'&amp;editfield='.$i.'"><img src="'.$config['files']['iconpath'].'edit.gif" alt="edit field" width="12" height="13" border="0"></a>&nbsp;&nbsp;';
			echo '<a href="'.$p.'&amp;kill='.$fields_infos[$i]['name'].'&amp;anz='.$anz_fields.'" onclick="if(!confirm(\''.$lang['askdeletefield'].'\')) return false;"><img src="'.$config['files']['iconpath'].'delete.gif" alt="delete field" width="11" height="13" border="0"></a>&nbsp;&nbsp;';

			echo '</td><td><strong>'.$fields_infos[$i]['name'].'</strong></td><td>'.$fields_infos[$i]['type'].'</td><td>'.$fields_infos[$i]['size'].'</td>';
			echo '<td>'.$fields_infos[$i]['null'].'</td><td>';
			//key
			if($fields_infos['_primarykey_']==$fields_infos[$i]['name']) echo '<img src="'.$config['files']['iconpath'].'primary.gif" width="12" height="13" alt="Primary Key" border="0">';
			if(isset($fields_infos['_fulltextkey_'])) {
				for($ii=0;$ii<count($fields_infos['_fulltextkey_']);$ii++) {
					if($fields_infos['_fulltextkey_'][$ii]['name']==$fields_infos[$i]['name']) {
						echo '<img src="'.$config['files']['iconpath'].'fulltext.gif" width="13" height="12" alt="Fulltext Index" border="0">'; break;
					}
				}
			}
			if(isset($fields_infos['_uniquekey_'])) {
				for($ii=0;$ii<count($fields_infos['_uniquekey_']);$ii++) {
			 		if($fields_infos['_uniquekey_'][$ii]['name']==$fields_infos[$i]['name']) {
						echo '<img src="'.$config['files']['iconpath'].'unique.gif" width="13" height="12" alt="Unique Index" border="0">'; break;
					}
				}
			}
			if(isset($fields_infos['_key_'])) {
				 for($ii=0;$ii<count($fields_infos['_key_']);$ii++) {
				 	//echo "<h5>".$fields_infos['_key_'][$ii]['columns']."</h5>";
				 	if($fields_infos['_key_'][$ii]['name']==$fields_infos[$i]['name']) {
						echo '<img src="'.$config['files']['iconpath'].'key.gif" width="13" height="12" alt="Index" border="0">'; break;
					}
				 }
			}
			echo '</td><td>'.$fields_infos[$i]['attribut'].'</td>';
			echo '<td>'.$fields_infos[$i]['default'].'</td>'.$td.$fields_infos[$i]['extra'].'</td>';
			echo '<td>'.((MSD_NEW_VERSION) ? $fields_infos[$i]['collate'] : "&nbsp;").'</td></tr>';
		}
		echo '</table><br>';

		echo '<h6>'.$lang['sql_tableindexes'].' `'.$table_edit_name.'`</h6>';
		echo '<table class="border"><tr><th>&nbsp;</th><th>Index-Name</th>'.((MSD_NEW_VERSION) ? '<th>Typ</th>' : '').'<th>'.$lang['sql_allowdups'].'</th><th>'.$lang['sql_cardinality'].'</th><th>Spalten</th></tr>';
		$sqlk="SHOW KEYS FROM `".$databases['Name'][$dbid]."`.`$table_edit_name`;";
		$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
		$num=mysql_numrows($res);
		if($num==0) {
			echo '<tr><td colspan="6">'.$lang['sql_tablenoindexes'].'</td></tr>';
		} else {
			for($i=0;$i<$num;$i++) {
				$row=mysql_fetch_array($res);
				$cl= ($i % 2) ? "dbrow" : "dbrow1";
				//Images
				echo '<tr class="'.$cl.'"><td><img src="'.$config['files']['iconpath'].'edit.gif" width="12" height="13" alt="" border="0">&nbsp;&nbsp;<img src="'.$config['files']['iconpath'].'delete.gif" width="12" height="13" alt="" border="0"></td>';
				echo '<td>'.$row['Key_name'].'</td>';
				if(MSD_NEW_VERSION) echo '<td>'.$row['Index_type'].'</td>';
				echo '<td align="center">'.(($row['Non_unique']==1) ? $lang['yes']: $lang['no']).'</td>';
				echo '<td>'.(($row['Cardinality']>=0) ? $row['Cardinality'] : "keine").'</td>';
				echo '<td>'.$row['Column_name'].'</td>';
				echo '</tr>';
			}
		}
		echo '</table><br><input type="Button" value="'.$lang['sql_createindex'].'" onclick="location.href=\''.$p.'\'" disabled="disabled" class="SQLbutton">';

		/*echo "<hr>";
		echo '<br><pre>';print_r($fields_infos);echo '</pre>';*/
	}

} elseif ($context==3) {
	//Datenbanken
	if(isset($_GET['dbrefresh'])) SetDefault();

	echo $aus."<h4>Tools</h4>";
	if(isset($_POST['dbdosubmit'])) {
		$newname=$_POST['newname'];
		$db_index=$_POST['db_index'];
		$db_action=$_POST['db_action'];
		$changed=false;$ausgabe=$out="";
		switch($db_action) {
			case "drop":
				MSD_DoSQL("DROP DATABASE `".$databases['Name'][$db_index]."`");
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$databases['Name'][$db_index].'` wurde gelöscht.</p>');
				$changed=true;
				break;
			case "empty":
				EmptyDB($databases['Name'][$db_index]);
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$databases['Name'][$db_index].'` '.$lang['sql_wasemptied'].'.</p>');
				break;
			case "rename":
				$dbold=$databases['Name'][$db_index];
				DB_Copy($dbold,$newname,1);
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$dbold.'` '.$lang['sql_renamedto'].' `'.$newname.'`.</p>');
				$changed=true;
				break;
			case "copy":
				$dbold=$databases['Name'][$db_index];
				DB_Copy($dbold,$newname);
				$changed=true;
				echo SQLOutput($out,'<p class="success">'.sprintf($lang['sql_dbcopy'],$dbold,$newname).'</p>');
			break;
			case "structure":
				DB_Copy($databases['Name'][$db_index],$newname,0,0);
				$changed=true;
				echo SQLOutput($out,'<p class="success">'.sprintf($lang['sql_dbscopy'],$databases['Name'][$db_index],$newname).'</p>');
			break;
			case "rights":
			break;
		}


		if($changed=true) {
			SetDefault();
			include ($config['files']['parameter']);
			echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';

		}
	}
	if(isset($_POST['dbwantaction'])) {
		if(isset($_POST['db_createnew'])) {
			$newname=$_POST['db_create'];
			if(!empty($newname)) {
				$col=(MSD_NEW_VERSION) ? $_POST['db_collate'] : "";
				if($col!="") {
					$r=explode("|",$col);
					$sqlc="CREATE DATABASE `$newname` DEFAULT CHARACTER SET $r[0] COLLATE $r[1]";
				} else $sqlc="CREATE DATABASE `$newname`";
				MSD_query($sqlc) or die(SQLError($sqlc,mysql_error()));
				echo $lang['db']." `$newname` ".$lang['sql_wascreated'].".<br>";
				SetDefault();
				include ($config['files']['parameter']);
				echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';

			}
		}
		$db_action=$newname="";$db_index=-1;
		for($i=0;$i<count($databases['Name']);$i++) {
			if(isset($_POST['db_do_'.$i])) {
				$newname=$_POST['db_rename'.$i];
				$db_index=$i;
				$db_action=$_POST['db_do_action_'.$i];
				break;
			}
		}
		if($db_action!="") {
			echo '<div align="center"><div align="left" id="sqleditbox">';
			echo '<form action="sql.php?context=3" method="post"><input type="hidden" name="db_action" value="'.$db_action.'"><input type="hidden" name="newname" value="'.$newname.'"><input type="hidden" name="db_index" value="'.$db_index.'">';
			switch($db_action) {
				case "drop":
				echo '<strong>'.sprintf($lang['askdbdelete'],$databases['Name'][$i]).'</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'" class="SQLbutton">';
				break;
				case "empty":
				echo '<strong>'.sprintf($lang['askdbempty'],$databases['Name'][$i]).'</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'" class="SQLbutton">';
				break;
				case "rename":
				echo '<strong>'.$lang['sql_renamedb'].' `'.$databases['Name'][$db_index].'` '.$lang['in'].' `'.$newname.'`</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'" class="SQLbutton">';
				break;
				case "copy":
					echo '<strong>'.sprintf($lang['askdbcopy'],$databases['Name'][$db_index],$newname).'</strong><br><br>';
					if($newname=="") echo '<p class="error">'.$lang['sql_namedest_missing'].'</p>'; else {
					echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'" class="SQLbutton">';

					}
				break;
				case "structure":
					echo '<strong>'.$lang['fm_askdbcopy1'].'`'.$databases['Name'][$db_index].'`'.$lang['fm_askdbcopy2'].'`'.$newname.'`'.$lang['fm_askdbcopy3'].'</strong><br><br>';
					if($newname=="") echo '<p class="error">'.$lang['sql_namedest_missing'].'</p>'; else {
					echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'" class="SQLbutton">';

					}
				break;
				case "rights":
				break;
			}
			echo "</form></div></div><br>";


		}
	}

	echo '<br><form action="sql.php?context=3" method="post"><input type="hidden" name="dbwantaction" value="1">';
	echo '<div align="center"><table class="border">';
	echo '<tr><td colspan="3" align="center"><strong>'.$lang['create_database'].'</strong></td></tr>';
	echo '<tr><td colspan="3">Name:&nbsp;<input type="text" class="text" name="db_create" size="20">';
	echo '&nbsp;&nbsp;'.$lang['collation'].':&nbsp;<select name="db_collate">'.CollationCombo('',1).'</select>&nbsp;&nbsp;';
	echo '<input type="submit" name="db_createnew" value="'.$lang['create'].'" class="SQLbutton"></td></tr></table>';

	echo '<p>&nbsp;</p><table class="border">';
	echo '<tr class="thead"><th>'.$lang['dbs'].'</th><th>'.$lang['sql_actions'].'</th></tr>';
	for($i=0;$i<count($databases['Name']);$i++) {
		$cl= ($i % 2) ? "dbrow" : "dbrow1";
		echo ($i==$databases['db_selected_index']) ? '<tr class="dbrowsel">' : '<tr class="'.$cl.'">';
		echo '<td><a href="sql.php?db='.$databases['Name'][$i].'&amp;dbid='.$i.'">'.$databases['Name'][$i].'</a></td>';
		echo '<td nowrap><input type="text" class="text" name="db_rename'.$i.'" size="20">';
		echo '&nbsp;&nbsp;<select name="db_do_action_'.$i.'" onchange="db_do_'.$i.'.disabled=false;">';
		echo '<option value="">-- '.$lang['sql_chooseaction'].' --</option>';
		echo '<option value="drop">'.$lang['sql_deletedb'].'</option>';
		echo '<option value="empty">'.$lang['sql_emptydb'].'</option>';
		if(MSD_NEW_VERSION) echo '<option value="rename">'.$lang['sql_renamedb'].'</option>';
		if(MSD_NEW_VERSION) echo '<option value="copy">'.$lang['sql_copydatadb'].'</option>';
		echo '<option value="structure">'.$lang['sql_copysdb'].'</option>';

		echo '</select>';
		echo "\n\n".'&nbsp;&nbsp;<input type="submit" name="db_do_'.$i.'" value="'.$lang['do'].'" disabled="disabled" class="SQLbutton">';

		echo '&nbsp;&nbsp;<input type="Button" value="'.$lang['sql_imexport'].'" onclick="location.href=\'sql.php?db='.$databases['Name'][$i].'&amp;dbid='.$i.'&amp;context=4\'" class="SQLbutton"></td></tr>';
	}

	echo '</table></div></form>';


} elseif ($context==4) {
	//Im-/Export
	$import=(isset($_GET['import'])) ? 1 : 0;
	if($import==1) {
		//IMPORT
		CheckcsvOptions();
		if(isset($_POST['f_import_csvtrenn'])) $sql['import']['trenn']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_import_csvtrenn']) : $_POST['f_import_csvtrenn'];
		if(isset($_POST['f_import_csvenc'])) $sql['import']['enc']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_import_csvenc']) : $_POST['f_import_csvenc'];
		if(isset($_POST['f_import_csvesc'])) $sql['import']['esc']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_import_csvesc']) : $_POST['f_import_csvesc'];
		if (empty($sql['import']['endline'])) {
          		$sql['import']['endline']=$nl;
      		} else {
            $sql['import']['endline']= str_replace('\\r', "\015",$sql['import']['endline']);
            $sql['import']['endline'] = str_replace('\\n', "\012",$sql['import']['endline']);
            $sql['import']['endline']= str_replace('\\t', "\011",$sql['import']['endline']);
        }
      	$sql['import']['endline']= str_replace('\\t', "\011",$sql['import']['endline']);
		if(isset($_POST['f_import_csvnull'])) $sql['import']['null']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_import_csvnull']) : $_POST['f_import_csvnull'];
		$sql['import']['namefirstline']=(isset($_POST['f_import_namefirstline'])) ? $_POST['f_import_namefirstline'] : 0;
		$sql['import']['emptydb']=(isset($_POST['import_emptydb'])) ? 1:0;
		$sql['import']['createindex']=(isset($_POST['import_createindex'])) ? 1:0;
		$sql['import']['table']=(isset($_POST['import_table'])) ? $_POST['import_table'] : "";
 		$sql['import']['import_source']=isset($_POST['import_source']) ? $_POST['import_source'] : 0;
		$sql['import']['text']=isset($_POST['import_text']) ? (($config['magic_quotes_gpc']) ? stripslashes($_POST['import_text']) : $_POST['import_text']) : "";
		$sql['import']['csv']="";

		if(isset($_POST['do_import'])) {

			$sql['import']['tablecreate']=0;
			if($sql['import']['table']=="new") {
				$sql['import']['table']="import_";
				$sql['import']['tablecreate']=1;
			}
			if($sql['import']['table']=="") {
				$aus.='<span class="error">'.$lang['import_notable'].'</span>';
			} else {
				if($_POST['import_source']==0) {
					//Import aus textbox
					$sql['import']['csv']=explode($sql['import']['endline'],$sql['import']['text']);

				} else {
					if (!isset($_FILES['upfile']['name']) || empty($_FILES['upfile']['name'])) {
						$aus.='<span class="error">'.$lang['fm_uploadfilerequest'].'</span>';
					} else {
						$fn=$_FILES['upfile']['tmp_name'];

						$sql['import']['csv']=(substr($_FILES['upfile']['name'],-3)==".gz") ? gzfile($fn) : file($fn);
						$sql['import']['text']=implode("",$sql['import']['csv']);
						$aus.='<span>'.$lang['sql_uploadedfile'].'<strong>'.$_FILES['upfile']['name'].'</strong>&nbsp;&nbsp;&nbsp;'.byte_output(filesize($_FILES['upfile']['tmp_name'])).'</span>';

					}
				}
				if(is_array($sql['import']['csv']))
					$aus.=DoImport();
				else
					$aus.='<br><span class="error">'.$lang['csv_nodata'].'</span>';

			}
		}
		$impaus=$aus;

		$impaus.='<form action="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;context=4&amp;import=1" method="post" enctype="multipart/form-data">'.$nl;
		$impaus.= '';
		$impaus.= '<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;context=4">'.$lang['export'].'</a>';
		$impaus.= '<h6>'.sprintf($lang['sql_import'],$databases['Name'][$dbid]).'</h6>';
		$impaus.= '<table class="bordersmall"><tr class="thead"><th>'.$nl;
		$impaus.= $lang['importoptions'].'</th><th>'.$lang['csvoptions'].'</th></tr>'.$nl;

		$impaus.= '<tr><td valign="top">'.$nl;
		$impaus.= '<table cellpadding="0" cellspacing="0">'.$nl;
		$impaus.= '<tr><td>'.$lang['importtable'].'</td><td><select name="import_table">'.TableComboBox($sql['import']['table']).'<option value="new" '.(($sql['import']['table']=="import_") ? 'selected' : '').'>== '.$lang['newtable'].' ==</option></select></td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['importsource'].'</td>'.$nl;
		$impaus.= '<td><input type="radio" class="radio" name="import_source" value="0" '.(($sql['import']['import_source']==0) ? 'checked' : '').' onclick="check_csvdivs(1); return true">'.$lang['fromtextbox'].'<br>'.$nl;
		$impaus.= '<input type="radio" class="radio" id="radio_csv0" name="import_source" value="1" '.(($sql['import']['import_source']==1) ? 'checked' : '').' onclick="check_csvdivs(1); return true">'.$lang['fromfile'].'</td></tr>'.$nl;
		$impaus.= '<tr><td colspan="2"><input type="checkbox" class="checkbox" name="import_emptydb" value="1" '.(($sql['import']['emptydb']==1) ? 'checked' : '').'>'.$lang['emptytablebefore'].'</td></tr>'.$nl;
		$impaus.= '<tr><td colspan="2"><input type="checkbox" class="checkbox" name="import_createindex" value="1" '.(($sql['import']['createindex']==1) ? 'checked' : '').'>'.$lang['createautoindex'].'</td></tr>'.$nl;
		$impaus.= '</table>'.$nl;


		$impaus.= '</td><td valign="top">'.$nl;

		$impaus.= '<table cellpadding="0" cellspacing="0">'.$nl;
		$impaus.= '<tr><td colspan="2"><input type="checkbox" class="checkbox" name="f_import_namefirstline0" value="1" '.(($sql['import']['namefirstline']==1) ? "checked" : "").'>'.$lang['csv_namefirstline'].'</td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['csv_fieldseperate'].'</td><td><input type="text" class="text" name="f_import_csvtrenn" size="4" maxlength="12" value="'.$sql['import']['trenn'].'"></td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['csv_fieldsenclosed'].'</td><td><input type="text" class="text" name="f_import_csvenc" size="4" maxlength="12" value="'.htmlspecialchars($sql['import']['enc']).'"></td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['csv_fieldsescape'].'</td><td><input type="text" class="text" name="f_import_csvesc" size="4" maxlength="12" value="'.$sql['import']['esc'].'"></td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['csv_eol'].'</td><td><input type="text" class="text" name="f_import_csvztrenn" size="4" maxlength="12" value="'.$sql['import']['ztrenn'].'"></td></tr>'.$nl;
		$impaus.= '<tr><td>'.$lang['csv_null'].'</td><td><input type="text" class="text" name="f_import_csvnull" size="4" maxlength="12" value="'.$sql['import']['null'].'"></td></tr>'.$nl;
  		$impaus.= '</table>'.$nl;

		$impaus.= '</td></tr>';

		$impaus.='<tr><td colspan="2"><div id="csv0">'.$lang['csv_fileopen'].':&nbsp;&nbsp;
		<input type="file" name="upfile" accept="application/gzip">';
		$impaus.='<input type="hidden" name="MAX_FILE_SIZE" VALUE="2500000"></div></td></tr>';

		$impaus.='<tr><td colspan="2" align="right"><input class="Formbutton" type="submit" name="do_import" value=" '.$lang['importieren'].' "></td></tr>';

		$impaus.= '</table>'.$nl;



		$impaus.= '<p>&nbsp;</p>'.$lang['import'].':<br><textarea name="import_text" wrap="OFF" style="width:760px;height:400px;font-size=11px;">';
		//$impaus.=$sql['import']['text'];
		$impaus.= '</textarea></form>'.$nl;

		$impaus.= '<script language="JavaScript">check_csvdivs(1);</script>'.$nl;

		echo $impaus.$nl;

	} else {
		//EXPORT
		$tables=0;$tblstr="";
		$sql['export']['db']=$db;

		if(isset($_POST['f_export_submit'])) {
			//echo '<pre>'.print_r($_POST,true).'</pre><hr>';
			$sql['export']['header_sent']="";
			$sql['export']['lines']=0;
			$sql['export']['format']=$_POST['f_export_format'];
			$sql['export']['ztrenn']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_export_csvztrenn']) : $_POST['f_export_csvztrenn'];
			$sql['endline']['ztrenn']=$sql['export']['ztrenn'];
			if($sql['export']['format']==0) {
				//CSV
				$format=0;
				$sql['export']['trenn']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_export_csvtrenn']) : $_POST['f_export_csvtrenn'];
				$sql['export']['enc']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_export_csvenc']) : $_POST['f_export_csvenc'];
				$sql['export']['esc']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_export_csvesc']) : $_POST['f_export_csvesc'];
				if (empty($sql['export']['endline'])) {
            		$sql['export']['endline']=$nl;
        		} else {
		            $sql['export']['endline']= str_replace('\\r', "\015",$sql['export']['endline']);
		            $sql['export']['endline'] = str_replace('\\n', "\012",$sql['export']['endline']);
		            $sql['export']['endline']= str_replace('\\t', "\011",$sql['export']['endline']);
		        }
        		$sql['export']['endline']= str_replace('\\t', "\011",$sql['export']['endline']);
			} elseif($sql['export']['format']==1) {
				//EXCEL
				$format=1;
				$sql['export']['trenn']=",";
				$sql['export']['enc']='"';
				$sql['export']['esc']='"';
				$sql['export']['endline']="\015\012";
			} elseif($sql['export']['format']==3) {
				//EXCEL 2003
				$format=1;
				$sql['export']['trenn']=";";
				$sql['export']['enc']='"';
				$sql['export']['esc']='"';
				$sql['export']['endline']="\015\012";
			} elseif($sql['export']['format']==4) {
				//XML
				$format=4;
				CheckcsvOptions();
			} elseif($sql['export']['format']==5) {
				//HTML
				$format=5;
				CheckcsvOptions();
			}
			if($format<3) $sql['export']['null']=($config['magic_quotes_gpc']) ? stripslashes($_POST['f_export_csvnull'.$format]) : $_POST['f_export_csvnull'.$format];
			$sql['export']['namefirstline']=(isset($_POST['f_export_namefirstline'.$format])) ? $_POST['f_export_namefirstline'.$format] : 0;

			$sql['export']['sendfile']=$_POST['f_export_sendresult'];
			$sql['export']['compressed']=(isset($_POST['f_export_compressed'])) ? $_POST['f_export_compressed'] : 0;

			$sql['export']['exportfile']="";
			$sql['export']['xmlstructure']=(isset($_POST['f_export_xmlstructure'])) ? $_POST['f_export_xmlstructure'] : 0;
			$sql['export']['htmlstructure']=(isset($_POST['f_export_htmlstructure'])) ? $_POST['f_export_htmlstructure'] : 0;

			//ausgewählte Tabellen
			if(isset($_POST['f_export_tables']))
				$sql['export']['tables']=$_POST['f_export_tables'];

		} else CheckcsvOptions();

		//Tabellenliste
		$sqlt="SHOW TABLE STATUS FROM `$db`";
		$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
		if($res) {
			$sql['export']['tablecount']=mysql_numrows($res);
			$sql['export']['recordcount']=0;
			for($i=0;$i<$sql['export']['tablecount'];$i++) {
				$row = mysql_fetch_array($res);
				$tblstr.='<option value="'.$row['Name'].'" '.((isset($sql['export']['tables']) && in_array($row['Name'],$sql['export']['tables'])) ? "selected" : "").'>'.$row['Name'].' ('.$row['Rows'].')</option>'."\n";
				$sql['export']['recordcount']+=$row['Rows'];
			}
		}

		$exaus=$aus.'<h4>'.sprintf($lang['sql_export'],$databases['Name'][$dbid]).'</h4>';

		$exaus.='<form action="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;context=4" method="post">'.$nl;
		$exaus.= '<a href="sql.php?db='.$db.'&amp;dbid='.$dbid.'&amp;context=4&amp;import=1">'.$lang['import'].'</a>';
		$exaus.= '<h6>'.sprintf($lang['sql_export'],$databases['Name'][$dbid]).'</h6>';
		$exaus.= '<table class="bordersmall"><tr class="thead"><th>'.$lang['tables'].'</th>'.$nl;
		$exaus.= '<th>'.$lang['exportoptions'].'</th>';
		$exaus.= '<th>'.$lang['export'].'</th></tr><tr>';
		$exaus.= '';

		$exaus.= '<td><span class="ssmall"><strong>'.$sql['export']['tablecount'].'</strong> '.$lang['tables'].', <strong>'.$sql['export']['recordcount'].'</strong> '.$lang['records'].'</span>';
		$exaus.= '&nbsp;&nbsp;&nbsp;<a class="ssmall" href="#" onclick="SelectTableList(true);">'.$lang['all'].'</a>&nbsp;&nbsp;<a class="ssmall" href="#" onclick="SelectTableList(false);">'.$lang['none'].'</a>'.$nl;

		$exaus.= '<br><select name="f_export_tables[]" size="12" multiple>'.$tblstr.'</select><br>'.$nl;
		$exaus.= '</td><td>'.$nl;
		$exaus.= ''.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_format" id="radio_csv0" value="0" '.(($sql['export']['format']==0) ? "checked" : "").' onclick="check_csvdivs(0); return true">'."CSV".'&nbsp;&nbsp;&nbsp;'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_format" id="radio_csv1" value="1" '.(($sql['export']['format']==1) ? "checked" : "").' onclick="check_csvdivs(0); return true">'."Excel".'&nbsp;&nbsp;&nbsp;'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_format" id="radio_csv2" value="3" '.(($sql['export']['format']==3) ? "checked" : "").' onclick="check_csvdivs(0); return true">'.$lang['excel2003'].'<br>'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_format" id="radio_csv4" value="4" '.(($sql['export']['format']==4) ? "checked" : "").' onclick="check_csvdivs(0); return true">'."XML".'&nbsp;&nbsp;&nbsp;'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_format" id="radio_csv5" value="5" '.(($sql['export']['format']==5) ? "checked" : "").' onclick="check_csvdivs(0); return true">'."HTML".'<br><br>'.$nl;
		$exaus.= '<div id="csv0"><fieldset><legend>CSV-Optionen</legend><table cellpadding="0" cellspacing="0"><tr><td colspan="2">'.$nl;
		$exaus.= '<input type="checkbox" class="checkbox" name="f_export_namefirstline0" value="1" '.(($sql['export']['namefirstline']==1) ? "checked" : "").'>'.$lang['csv_namefirstline'].'</td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_fieldseperate'].'</td><td><input type="text" class="text" name="f_export_csvtrenn" size="4" maxlength="12" value="'.$sql['export']['trenn'].'"></td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_fieldsenclosed'].'</td><td><input type="text" class="text" name="f_export_csvenc" size="4" maxlength="12" value="'.htmlspecialchars($sql['export']['enc']).'"></td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_fieldsescape'].'</td><td><input type="text" class="text" name="f_export_csvesc" size="4" maxlength="12" value="'.$sql['export']['esc'].'"></td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_eol'].'</td><td><input type="text" class="text" name="f_export_csvztrenn" size="4" maxlength="12" value="'.$sql['export']['ztrenn'].'"></td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_null'].'</td><td><input type="text" class="text" name="f_export_csvnull0" size="4" maxlength="12" value="'.$sql['export']['null'].'"></td></tr>'.$nl;
  		$exaus.= '</table></fieldset></div>'.$nl;

		$exaus.= '<div id="csv1"><fieldset><legend>Excel-Optionen</legend><table cellpadding="0" cellspacing="0"><tr><td colspan="2">';
		$exaus.= '<input type="checkbox" class="checkbox" name="f_export_namefirstline1" value="1"'.(($sql['export']['namefirstline']==1) ? "checked" : "").'>'.$lang['csv_namefirstline'].'</td></tr>'.$nl;
		$exaus.= '<tr><td>'.$lang['csv_null'].'</td><td><input type="text" class="text" name="f_export_csvnull1" size="4" maxlength="12" value="'.$sql['export']['null'].'"></td></tr>'.$nl;
  		$exaus.= '</table></fieldset></div>'.$nl;

		$exaus.= '<div id="csv4"><fieldset><legend>XML-Optionen</legend><table>';
		$exaus.= '<tr><td><input type="checkbox" name="f_export_xmlstructure" value="1" class="checkbox" '.(($sql['export']['xmlstructure']==1) ? 'checked' : '').'> mit Struktur</td></tr>';
		$exaus.= '</table></fieldset></div>'.$nl;

		$exaus.= '<div id="csv5"><fieldset><legend>HTML-Optionen</legend><table>';
		$exaus.= '<tr><td><input type="checkbox" name="f_export_htmlstructure" value="1" class="checkbox" '.(($sql['export']['htmlstructure']==1) ? 'checked' : '').'> mit Struktur</td></tr>';
		$exaus.= '</table></fieldset></div>'.$nl;

		$exaus.= '</td><td>'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_sendresult" value="0" '.(($sql['export']['sendfile']==0) ? "checked" : "").' onclick="check_csvdivs(0); return true">'.$lang['showresult'].'<br>'.$nl;
		$exaus.= '<input type="radio" class="radio" name="f_export_sendresult" id="radio_csv3" value="1" '.(($sql['export']['sendfile']==1) ? "checked" : "").' onclick="check_csvdivs(0); return true">'.$lang['sendresultasfile'].'<br>'.$nl;
		$exaus.= '<div id="csv3"><input type="checkbox" class="checkbox" name="f_export_compressed" value="1" '.(($sql['export']['compressed']==1) ? "checked" : "").'>'.$lang['compressed'].'</div><br>'.$nl;

		$exaus.= '<img src="images/blank.gif" width="60" height="130" border="0"><br><input class="Formbutton" type="submit" name="f_export_submit" value="'.$lang['export'].'" onclick="if(SelectedTableCount()==0) {alert(msg1);return false;}">'.$nl;
		$exaus.= '</td></tr></table></form>'.$nl;

		$exaus.= '<script language="JavaScript">check_csvdivs(0);</script>'.$nl;

		if(!$download) echo $exaus.$nl;
		if(isset($_POST['f_export_submit']) && isset($sql['export']['tables'])) {
			if(!$download) echo '<br><br><table width="90%"><tr><td>'.$lang['export'].':</td><td align="right"><a href="javascript:BrowseInput(\'imexta\');">zeige in neuem Fenster</a></td></tr></table><textarea id="imexta" wrap="OFF" style="width:760px;height:400px;font-size=11px;">'.$nl;
				if($format<3) ExportCSV();
				elseif($format==4) ExportXML();
				elseif($format==5) ExportHTML();
			if(!$download) {
				echo '</textarea><br>'.$nl;
				echo '<span style="color:blue;">'.$lang['exportfinished'].'</span>&nbsp;&nbsp;'.sprintf($lang['exportlines'],$sql['export']['lines']).$nl;
			} else exit();
		}
	}
}
?>
<script language="JavaScript" type="text/javascript">
function BrowseInput(el) {
	var txt=document.getElementsByName('imexta')[0].value;
	var win=window.open('about:blank','MSD_Output','resizable=1,scrollbars=yes');
	win.document.write(txt);
	win.document.close();
	win.focus();
}
</script>
<?php
echo '<br><br><br>';
echo MSDFooter();

function FormHiddenParams()
{
	global $db,$dbid,$tablename,$context,$limitstart,$order,$orderdir;

	$s='<input type="hidden" name="db" value="'.$db.'">';
	$s.='<input type="hidden" name="dbid" value="'.$dbid.'">';
	$s.='<input type="hidden" name="tablename" value="'.$tablename.'">';
	$s.='<input type="hidden" name="context" value="'.$context.'">';
	$s.='<input type="hidden" name="limitstart" value="'.$limitstart.'">';
	$s.='<input type="hidden" name="order" value="'.$order.'">';
	$s.='<input type="hidden" name="orderdir" value="'.$orderdir.'">';

	return $s;

}


?>
