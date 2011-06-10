<?php
include_once("inc/header.php");
include_once("inc/functions_sql.php");
include_once("inc/mysql.php");
echo headline();
ReadSQL();	

//Variabeln
$no_order=false;
$db=(!isset($_GET['db'])) ? $databases["db_actual"] : $_GET['db'];
$dbid=(!isset($_GET['dbid'])) ? $databases["db_selected_index"] : $_GET['dbid'];
$context=(!isset($_GET['context'])) ? 0 : $_GET['context'];
$context=(!isset($_POST['context'])) ? $context : $_POST['context'];
$tablename=(!isset($_GET['tablename'])) ? "" : $_GET['tablename'];
$limitstart=(!isset($_GET['limitstart'])) ? 0 : $_GET['limitstart'];
$orderdir=(!isset($_GET['orderdir'])) ? "" : $_GET['orderdir'];
$order=(!isset($_GET['order'])) ? "" : $_GET['order'];
$sqlconfig=(isset($_GET['sqlconfig'])) ? 1 : 0;
$editkey=(!isset($_GET['editkey'])) ? -1 : $_GET['editkey'];
$norder=($orderdir==" DESC") ? " ASC" : " DESC"; 
$sql["order_statement"]=($order!="") ? " ORDER BY ".$order.$norder : "";
$sql["sql_statement"]=(isset($_GET['sql_statement'])) ? stripslashes(urldecode($_GET['sql_statement'])) : "";
$showtables=(!isset($_GET['showtables'])) ? 0 : $_GET['showtables'];
$limit="";
$bb=(isset($_GET["bb"])) ? $_GET["bb"] : -1;
if(isset($_POST['tablename'])) $tablename=$_POST['tablename'];



//SQL-Statement geposted
if(isset($_POST['execsql'])) 
{
	$sql["sql_statement"]=(isset($_POST['tb_sql'])) ? stripslashes($_POST['tb_sql']) : "";
	
	$db=$_POST['db'];
	$dbid=$_POST['dbid'];
	$tablename=$_POST['tablename'];
	
}



if($sql["sql_statement"]==""){
	if($tablename!="" && $showtables==0) {
		$sql["sql_statement"]="SELECT * FROM `$tablename`";
	} else {
		$sql["sql_statement"]="SHOW TABLE STATUS FROM `$db`";
		$showtables=1;
	}
}

//sql-type
$sql_to_display_data=0;
$Anzahl_SQLs=substr_count(substr($sql["sql_statement"],0,strlen($sql["sql_statement"])-1),";");

if($Anzahl_SQLs==0 && (substr(strtoupper($sql["sql_statement"]),0,6)=="SELECT" || substr(strtoupper($sql["sql_statement"]),0,4)=="SHOW" ))
	$sql_to_display_data=1;
if($Anzahl_SQLs>0) $sql_to_display_data=0;

if($sql_to_display_data==1) {
	//nur ein SQL-Statement 
	$limitende=($limitstart+$config["sql_limit"]);
	//Darf sortiert werden?
	$op=strpos($sql["sql_statement"],"ORDER");
	if($op>0) {
		$sql["order_statement"]=substr($sql["sql_statement"],$op);
		$sql["sql_statement"]=substr($sql["sql_statement"],0,$op);
		if(strpos($rest,",")>0) $no_order=true;
	}
	//Darf editiert werden?
	$no_edit=(strtoupper(substr($sql["sql_statement"],0,6))!="SELECT" || $showtables==1);

	if($no_edit)$no_order=true;
}

if(isset($_POST["tableselect"])) $tablename=$_POST["tableselect"];

//MySQL verbinden
MSD_mysql_connect();

mysql_select_db($db,$config["dbconnection"]);


///*** EDIT / UPDATES / INSERTS ***///
///***                          ***///

//Datensatz editieren
if(isset($_POST["update"])) {
	GetPostParams();
	$f=explode("|",$_POST["feldnamen"]);
	$sqlu='Update `'.$tablename.'` Set ';
	for($i=0;$i<count($f);$i++) {
		$sqlu.='`'.$f[$i].'`=\''.$_POST[$f[$i]].'\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu)-2).' WHERE '.stripslashes(urldecode($_POST["recordkey"]));
	$res=MSD_query($sqlu) or die(SQLError($sqlu,mysql_error()));
	$msg= '<p class="green">'.$lang['sql_recordupdated'].'</p>';
}
//Datensatz einfügen
if(isset($_POST["insert"])) {
	GetPostParams();
	$f=explode("|",$_POST["feldnamen"]);
	$sqlu='Insert into `'.$tablename.'` Set ';
	for($i=0;$i<count($f);$i++) {
		$sqlu.='`'.$f[$i].'`=\''.$_POST[$f[$i]].'\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu)-2);
	$res=MSD_query($sqlu) or die(SQLError($sqlu,mysql_error()));
	$msg= '<p class="green">'.$lang['sql_recordinserted'].'</p>';
}

if(isset($_POST["cancel"])) GetPostParams();




//Tabellenansicht
$showtables=(substr(strtoupper($sql["sql_statement"]),0,5)=="SHOW ") ? 1 : 0;
$tabellenansicht=(substr(strtoupper($sql["sql_statement"]),0,10)=="SHOW TABLE") ? 1 : 0;


if(strtolower(substr($sql["sql_statement"],0,6))=="select") $limit=' LIMIT '.$limitstart.', '.$limitende.';';
$params="sql.php?db=".$db."&tablename=".$tablename."&dbid=".$dbid.'&context='.$context.'&sql_statement='.urlencode($sql["sql_statement"]).'&showtables='.$showtables;
if($order!="") $params.="&order=".$order."&orderdir=".$orderdir.'&context='.$context;
if($bb>-1) $params.="&bb=".$bb;


echo '<h3>Mini-SQL</h3>';
echo '<a href="main.php?action=db&dbid='.$dbid.'#dbid"><img src="images/arrowleft.gif" width="16" height="16" alt="'.$lang['sql_backdboverview'].'"></a>&nbsp;&nbsp;';
echo '<a title="'.$lang["database_overview"].'" href=sql.php?db='.$databases["db_actual"].'&dbid='.$dbid.'&context=3"><strong>'.$lang['db'].'</strong></a>&nbsp;&nbsp;';
if($context==0 || $context==2) {
	echo '`<a href="sql.php?db='.$db.'&dbid='.$dbid.'" style="color:blue;"><strong>'.$db.'</strong></a>`  '.(($tablename!="") ? '<strong>'.$lang['table'].'</strong> `<a href="sql.php?db='.$db.'&dbid='.$dbid.'&tablename='.$tablename.'&context=2" style="color:blue;"><strong>'.$tablename.'</a>`' : '').'</strong>'; 
} else echo "(".$lang['sql_selecdb'].")";
echo '<br><br>';
if($context==0) {
//Start SQL-Box
if(isset($_GET["readfile"]) && $_GET["readfile"]==1) {
	echo '<form action="'.$params.'" method="post" enctype="multipart/form-data"><table cellpadding="0" cellspacing="0" border="1" rules="rows" width="100%"><tr bgcolor="#F8FD99"><td>';
	echo 'SQL-File öffnen (auch gz möglich):</td><td><input type="file" name="upfile"></td>';
	echo '<td><input type="submit" name="submit_openfile" value=" öffnen "></td><td>(max 2 MB)</td>';
	echo '<td><INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="2500000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></form>';
}
if(isset($_POST["submit_openfile"])) {
	//open file
	if (!isset($_FILES["upfile"]["name"]) || empty($_FILES["upfile"]["name"])) echo '<span class="swarnung">'.$lang["fm_uploadfilerequest"].'</span>';
	else {
		$fn=$_FILES["upfile"]["tmp_name"];
		if(strtolower(substr($_FILES["upfile"]["name"],-3))==".gz")
			$read__user_sqlfile=gzfile($fn);
		else
			$read__user_sqlfile=file($fn);
		echo '<span class="">geladenes File: <strong>'.$_FILES["upfile"]["name"].'</strong>&nbsp;&nbsp;&nbsp;'.byte_output(filesize($_FILES["upfile"]["tmp_name"])).'</span>';
	}
}
echo '<div class="sqlbox" id="mysqlbox"><form action="sql.php" method="post">';
//Titelzeile
echo '<div class="wtitle">';
echo '<a href="#" onclick="resizeSQL(0);"><img src="images/close.gif" width="16" height="16" alt="" vspace="0" hspace="0" align="bottom"></a>&nbsp;&nbsp;';
echo '<a href="#" onclick="resizeSQL(1);"><img src="images/arrowup.gif" width="16" height="16" alt="show less" vspace="0" hspace="0" align="bottom"></a>';
echo '&nbsp;<a href="#" onclick="resizeSQL(2);"><img src="images/arrowdown.gif" width="16" height="16" alt="show more" vspace="0" hspace="0" align="bottom"></a>&nbsp;&nbsp;&nbsp;';
echo '<input class="SQLbutton" type="button" onclick="document.location.href=\''.$params.'&context=1\'" value="'.$lang["sql_befehle"].'">'.SQL_ComboBox().'&nbsp;&nbsp;'.Table_ComboBox();
echo '&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;<input class="SQLbutton" type="submit" name="execsql" value="'.$lang['sql_exec'].'">&nbsp;';

if(!isset($_GET["readfile"])) echo '&nbsp;&nbsp;<a href="'.$params.'&readfile=1"  title="read file"><img src="images/openfile.gif" width="16" height="16" alt="read file"></a>';

echo '</div>';
//Eingabebox
echo '<div class="sbox2" id="sbox2"><textarea class="sqleingabe" style="height:'.$config["interface_sqlboxsize"].'px;" name="tb_sql"  id="tb_sql">'.((isset($read__user_sqlfile)) ? implode("",$read__user_sqlfile) : $sql["sql_statement"].$sql["order_statement"]).'</textarea>';
echo '<br><span class="verysmall" style="color:green;">'.$lang['sql_warning'].'</span></div>';
}
echo '<input type="hidden" name="db" value="'.$db.'"><input type="hidden" name="tablename" value="'.$tablename.'">';
echo '<input type="hidden" name="dbid" value="'.$dbid.'"></form></div><br>';


if(isset($_GET["mode"]) && $context==0) {
	if(isset($_GET["recordkey"])) $rk=stripslashes(urldecode($_GET["recordkey"]));
	if(isset($_GET['tablename'])) $tablename=$_GET['tablename'];
	
	if($_GET["mode"]=="kill") {
		
		if($showtables==0) {
			$sqlk= "DELETE FROM `$tablename` WHERE ".$rk;
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			echo '<p class="green">'.$lang['sql_recorddeleted'].'</p>';
		} else {
			$sqlk= "Drop Table `$rk`";
			$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
			echo '<p class="green">'.$lang['sql_tabledeleted1'].$rk.$lang['sql_tabledeleted2'].'</p>';
		}
	}
	if($_GET["mode"]=="edit") {
		echo '<div class="sqleditbox"><span style="font-size:12px;"><strong>'.$lang['sql_recordedit'].' '.$rk.'</strong></span>';
		$sqledit="Select * from $tablename where $rk";
		
		$res=MSD_query($sqledit) or die(SQLError($sqledit,mysql_error()));
		echo '<form action="sql.php" method="post">';
		echo '<input type="hidden" name="recordkey" value="'.$rk.'">';
		$row=mysql_fetch_row($res); 
		echo '<table>';
		$feldnamen="";
		for($x=0; $x<count($row); $x++) { 
			$str = mysql_fetch_field($res,$x); 
			$feldnamen.=$str->name.'|';
			echo '<tr><td class="sqletbl">'.$str->name.'</td><td>';
			if($str->type=='blob')
				echo '<textarea cols="60" rows="4" name="'.$str->name.'">'.$row[$x].'</textarea>';
			else
				echo '<input type="text" size="60" name="'.$str->name.'" value="'.$row[$x].'">';
			echo '</td>';	
			echo '<td class="sqletbl">&nbsp;</td></tr>'; //'.$str->type.'
		}
		
		echo '<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="'.substr($feldnamen,0,strlen($feldnamen)-1).'"><input class="SQLbutton" type="submit" name="update" value="update">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="Button" value="cancel edit" onclick="location.href=\'sql.php?db='.$db.'&dbid='.$dbid.'&tablename='.$tablename.'\';"></td></tr>';
		echo '</table>'.FormHiddenParams().'<input type="hidden" name="sql_statement" value="'.urlencode($sql["sql_statement"]).'"></form></div>';
	}
	if($_GET["mode"]=="new") {
		echo '<div class="sqlnewbox"><span style="font-size:12px;"><strong>'.$lang['sql_recordnew'].'</strong></span>';
		$sqledit="SHOW FIELDS FROM $tablename";
		$res=MSD_query($sqledit) or die(SQLError($sqledit,mysql_error()));
		$num=mysql_numrows($res); 
		echo '<form action="sql.php" method="post">';
		echo '<input type="hidden" name="recordkey" value="">';
		
		echo '<table>';
		$feldnamen="";
		for($x=0; $x<$num; $x++) { 
			$row=mysql_fetch_row($res); 
			$feldnamen.=$row[0].'|';
			echo '<tr><td class="sqletbl">'.$row[0].'</td><td>';
			$type=strtoupper($row[1]);
			if(strpos($type,'BLOB') || strpos($type,'TEXT'))
				echo '<textarea cols="60" rows="4" name="'.$row[0].'">'.$row[4].'</textarea>';
			else
				echo '<input type="text" size="60" name="'.$row[0].'" value="'.$row[4].'">';
			echo '</td>';	
			echo '<td class="sqletbl">&nbsp;</td></tr>'; //'.$str->type.'
		}
		echo '<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="'.substr($feldnamen,0,strlen($feldnamen)-1).'"><input class="SQLbutton" type="submit" name="insert" value="insert">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;<input class="SQLbutton" type="submit" name="cancel" value="cancel insert"></td></tr>';
		echo '</table>'.FormHiddenParams().'<input type="hidden" name="sql_statement" value="'.urlencode($sql["sql_statement"]).'"></form></div>';
		
	}
}


if($context==0){
	//Data-View
	echo '<h4>'.(($showtables==1)?$lang['sql_tableview']:$lang['sql_dataview']).'</h4>';
	if($showtables==0){
		$p='sql.php?sql_statement='.urlencode($sql["sql_statement"]).'&db='.$db.'&tablename='.$tablename.'&dbid='.$dbid.'&limitstart='.$limitstart.'&order='.$order.'&orderdir='.$orderdir;
		echo '<a class="ul" style="font-size:8pt;padding-bottom:8px;" href="'.$p.'&mode=new">'.$lang['sql_recordnew'].'</a>';
	} else {
		$p='sql.php?db='.$db.'&dbid='.$dbid.'&context=2';
		echo '<a class="ul" style="font-size:8pt;padding-bottom:8px;" href="'.$p.'">'.$lang['sql_tablenew'].'</a>';
	}
	//Statuszeile
	echo '<p align="left">';
	if(isset($msg))echo $msg;
	
	//SQL ausführen
	if($sql_to_display_data==0) {
		//mehrere SQL-Statements
		$numrowsabs=$numrows=0;
		MSD_DoSQL($sql["sql_statement"]);
		echo SQLOutput($out);
		
	} else {
		$numrowsabs=$numrows=0;
		$res=MSD_query($sql["sql_statement"]) or die(SQLError($sql["sql_statement"],mysql_error()));
		
		$numrowsabs=mysql_num_rows($res);
		$res=MSD_query($sql["sql_statement"].$sql["order_statement"].$limit) or die(SQLError($sql["sql_statement"].$sql["order_statement"].$limit,mysql_error()));
		$numrows=mysql_num_rows($res);
		if($limitende>$numrowsabs)$limitende=$numrowsabs;
	}
	
	
	if($numrowsabs>0 && $Anzahl_SQLs<=1) {
		if($showtables==0) {
			$command_line=$lang['info_records']." ".($limitstart+1)." - $limitende ".$lang['sql_vonins']." $numrowsabs &nbsp;&nbsp;&nbsp;";
			$command_line.=($limitstart>0) ? '<a href="'.$params.'&limitstart=0">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&lt;&lt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitstart>0) ? '<a href="'.$params.'&limitstart='.(($limitstart-$config["sql_limit"]<0) ? 0 : $limitstart-$config["sql_limit"]).'">&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&lt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitende<$numrowsabs) ? '<a href="'.$params.'&limitstart='.($limitstart+$config["sql_limit"]).'">&gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;' : '&gt;&nbsp;&nbsp;&nbsp;&nbsp;';
			$command_line.=($limitende<($numrowsabs-$config["sql_limit"])) ? '<a href="'.$params.'&limitstart='.($numrowsabs-$config["sql_limit"]).'">&gt;&gt;</a>' : '&gt;&gt;';
			echo $command_line;
		} else {
			echo $numrowsabs." ".$lang['tables'];
		}
		echo '</p>';
		//Datentabelle
		echo '<table border="1">';
	
		$t=$d="";		
		$fdesc=Array();
		$key=-1;
		if ($numrows>0){
			//Infos und Header holen
			//1.Datensatz für Feldinfos
			$row= mysql_fetch_row($res); 
			$t='<td colspan="'.(count($row)+1).'" align="left">'.$lang['sql_queryentry'].' '.count($row).' '.$lang['sql_columns'].'</td></tr><tr>';
			$t.='<td class="hd">&nbsp;</td>';
			for($x=0; $x<count($row); $x++) { 
				$str = mysql_fetch_field($res,$x); 
				$t.='<td class="hd" align="left">';
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
					if($str->primary_key==1) $pic='<img src="images/key.gif" alt="primary key" width="14" height="16" border="0">';
					elseif($str->unique_key==1) $pic='<img src="images/key.gif" alt="unique key" width="14" height="16" border="0">';
				}
				
				if($bb==-1)
				$bb_link=($str->type=="blob") ? '&nbsp;&nbsp;&nbsp;<a style="font-size:10px;color:blue;" title="use BB-Code for this field" href="sql.php?db='.$db.'&bb='.$x.'&tablename='.$tablename.'&dbid='.$dbid.'&order='.$order.'&orderdir='.$orderdir.'&limitstart='.$limitstart.'&sql_statement='.urlencode($sql["sql_statement"]).'">[BB]</a>' : '';
				else
				$bb_link=($str->type=="blob") ? '&nbsp;&nbsp;&nbsp;<a style="font-size:10px;color:blue;" title="use BB-Code for this field" href="sql.php?db='.$db.'&bb=-1&tablename='.$tablename.'&dbid='.$dbid.'&order='.$order.'&orderdir='.$orderdir.'&limitstart='.$limitstart.'&sql_statement='.urlencode($sql["sql_statement"]).'">[no BB]</a>' : '';
				if($no_order==false && $showtables==0) 
					$t.=$pic.'&nbsp;<a title="'.$tt.'" href="sql.php?db='.$db.'&tablename='.$tablename.'&dbid='.$dbid.'&order='.$str->name.'&orderdir='.$norder.'&sql_statement='.urlencode($sql["sql_statement"]).'">'.$str->name.'</a>'.$bb_link;
				else
					$t.=$pic.'&nbsp;<span title="'.$tt.'" >'.$str->name.'</span>'.$bb_link;
				
				$arname=($orderdir==" ASC") ? "arup.gif" : "ardown.gif"; 
				if($str->name==$order)$t.='&nbsp;&nbsp;<img src="images/'.$arname.'" alt="" width="12" height="13" border="0">';
				$t.='</td>';
					
				//echo "<h5>DOING HEADERS</h5>$t";
			}
			
			//und jetzt Daten holen
			mysql_data_seek ($res, 0); 
			
			for ($i=0;$i<$numrows;$i++) {
				$row= mysql_fetch_row($res); 
				for($x=0; $x<count($row); $x++) { 
					if($x==0) {
						//edit-pics
						$d.='<td valign="top" nowrap class="small">&nbsp;';
						$p='sql.php?sql_statement='.urlencode($sql["sql_statement"]).'&db='.$db.'&tablename='.$tablename.'&dbid='.$dbid.'&limitstart='.$limitstart.'&order='.$order.'&orderdir='.$orderdir.'&editkey='.$key;
						if($key==-1) {
							$rk="";
							for($il=0;$il<count($row);$il++) {
								$rk.="`".$fdesc[$il]['name']."`='".$row[$il]."' and ";
							}
							$p.='&recordkey='.urlencode(substr($rk,0,strlen($rk)-5));
						} else {
							//Key vorhanden
							$p.='&recordkey='.urlencode("`".$fdesc[$key]['name']."`='".$row[$key]."'");
						}
						if($showtables==1) $p.='&recordkey='.$row[0];
						if(!$no_edit) {
							if($showtables==0) {
								$d.='<a href="'.$p.'&mode=edit"><img src="images/edit.gif" alt="edit" width="12" height="13" border="0"></a>&nbsp;';
							}
						}
						if($showtables==0) {
							$d.='<a href="'.$p.'&mode=kill" onclick="if(!confirm(\''.$lang['sql_askdelete'].'\')) return false;"><img src="images/delete.gif" alt="delete" width="11" height="13" border="0"></a>';
						} else {
							if($tabellenansicht==1) {
								$d.='<a href="sql.php?db='.$db.'&dbid='.$dbid.'&tablename='.$row[0].'&context=2"><img src="images/edit.gif" width="12" height="13" alt="edit table"></a>&nbsp;&nbsp;';
								$d.='<a href="'.$p.'&mode=kill" onclick="if(!confirm(\''.$lang['sql_askdeletetable1'].$row[0].$lang['sql_askdeletetable2'].'\')) return false;"><img src="images/delete.gif" alt="delete table" width="11" height="13" border="0"></a>&nbsp;&nbsp;';
							}
						}
						$d.='</td>';
					}
					$d.='<td valign="top" class="small">';
					if($bb==$x){
						$data=simple_bbcode_conversion($row[$x]);
					} else
						$data=($fdesc[$x]['type']=='string' || $fdesc[$x]['type']=='blob') ? strip_tags($row[$x]) : $row[$x]; 
					$d.=($tabellenansicht==1 && $x==0) ? "<a href=\"sql.php?db=$db&tablename=$row[0]&dbid=$dbid\">$data</a>" : $data;
					$d.='&nbsp;</td>';
				}
				if($i==0) echo '<tr>'.$t.'</tr>';	
				echo '<tr>'.$d.'</tr>';	
				$d="";
			}
		}	
		echo '</table>';
		if($showtables==0) echo '<br>'.$command_line;
	} else echo '<p class="meldung">'.$lang['sql_nodata'].'</p>';
} elseif ($context==1) {
	//SQL-Strings
	echo '<h4>'.$lang['sql_befehle'].' ('.count($SQL_ARRAY).')</h4>';
	echo '<a href="'.$params.'&sqlconfig=1&new=1">'.$lang['sql_befehlneu'].'</a>';
	if(isset($_GET["sqlnewupdate"])) {
		$ind=count($SQL_ARRAY);
		if(count($SQL_ARRAY)>0)
			array_push($SQL_ARRAY,$_GET["sqlname".$ind]."|".$_GET["sqlstring".$ind]);
		else $SQL_ARRAY[0]=$_GET["sqlname0"]."|".$_GET["sqlstring0"];
		WriteSQL();
		echo '<p class="green">'.$lang['sql_befehlsaved1'].' \''.$_GET["sqlname".$ind].'\' '.$lang['sql_befehlsaved2'].'<p>';
	}
	echo '<form action="sql.php" method="get">
	<input type="hidden" name="context" value="1">
	<input type="hidden" name="sqlconfig" value="1"><table border="1" width="90%">
	<input type="hidden" name="tablename" value="'.$tablename.'">
	<input type="hidden" name="dbid" value="'.$dbid.'">';
	echo '<tr><td class="hd">Position</td><td class="hd">Name</td><td class="hd">SQL</td><td class="hd">Befehl</td></tr>';
	$i=0;	
	if(count($SQL_ARRAY)>0) {
		for($i=0;$i<count($SQL_ARRAY);$i++) {
			if(isset($_GET["sqlupdate".$i])) {
				//echo "SQLUPDATE $i<br>";
				echo '<p class="green">'.$lang['sql_befehlsaved1'].' \''.$_GET["sqlname".$i].'\' '.$lang['sql_befehlsaved3'].'<p>';
				$SQL_ARRAY[$i]=$_GET["sqlname".$i]."|".$_GET["sqlstring".$i];
				WriteSQL();
			}
			if(isset($_GET["sqlmove".$i])) {
				echo '<p class="green">'.$lang['sql_befehlsaved1'].' \''.$_GET["sqlname".$i].'\' '.$lang['sql_befehlsaved4'].'</p>';
				$a[]=$SQL_ARRAY[$i];
				array_splice($SQL_ARRAY,$i,1);
				$SQL_ARRAY=array_merge($a,$SQL_ARRAY);
				WriteSQL();
			}
			if(isset($_GET["sqldelete".$i])) {
				echo '<p class="green">'.$lang['sql_befehlsaved1'].' \''.$_GET["sqlname".$i].'\' '.$lang['sql_befehlsaved5'].'<p>';
				array_splice($SQL_ARRAY,$i,1);
				WriteSQL();
			}
		}
		for($i=0;$i<count($SQL_ARRAY);$i++) {
			echo '<tr><td>'.($i+1).'</td><td>';
			echo '<input type="text" name="sqlname'.$i.'" value="'.SQL_Name($i).'"></td>';
			echo '<td><textarea rows="3" cols="40" name="sqlstring'.$i.'">'.stripslashes(SQL_String($i)).'</textarea></td>';
			echo '<td><input class="SQLbutton" style="width:80px;" type="submit" name="sqlupdate'.$i.'" value="save"><br>
			<input class="SQLbutton" style="width:80px;" type="submit" name="sqlmove'.$i.'" value="move up"><br>
			<input class="SQLbutton" style="width:80px;"  type="submit" name="sqldelete'.$i.'" value="delete"></td></tr>';
		}
	}
	if(isset($_GET["new"])) {
		echo '<tr><td>'.($i+1).'</td><td>';
		echo '<input type="text" name="sqlname'.$i.'" value="SQL '.($i+1).'"></td>
		<td><textarea rows="3" cols="40" name="sqlstring'.$i.'">SELECT * FROM</textarea></td>
		<td><input class="SQLbutton" style="width:80px;" type="submit" name="sqlnewupdate" value="save"><br>';
	}
	echo '</table></form>';
	
} elseif ($context==2) {
	//Tabellen
	echo '<h4>'.$lang['sql_tablesofdb'].' `'.$databases["Name"][$dbid].'` '.$lang['sql_edit'].'</h4>';
	if(isset($_GET["kill"])) {
		if($_GET["anz"]==1)
			echo '<p class="Warnung">'.$lang['sql_nofielddelete'].'</p>';
		else {
			$sql_alter="ALTER TABLE `".$databases["Name"][$dbid]."`.`".$_GET["table"]."` DROP COLUMN `".$_GET["kill"]."`";
			MSD_DoSQL($sql_alter);
			echo '<div align="left" class="sqleditbox" style="font-size: 11px;width:90%;padding=6px;">';
			echo '<p class="success">'.$lang['sql_fielddelete1'].' `'.$_GET["kill"].'` '.$lang['sql_deleted'].'.</p>'.highlight_sql($out).'</div>';
		}
	}
	if(isset($_POST["tablecopysubmit"])) {
		$table_edit_name=$_GET["tablename"];
		if($_POST["tablecopyname"]=="") {
			echo '<p class="Warnung">'.$lang['sql_nodest_copy'].'</p>';
		} elseif(Table_Exists($databases["Name"][$dbid],$_POST["tablecopyname"])) {
			echo '<p class="Warnung">'.$lang['sql_desttable_exists'].'</p>';
		} else {
			Table_Copy("`".$databases["Name"][$dbid]."`.`".$table_edit_name."`",$_POST["tablecopyname"],$_POST["copyatt"]);
			echo '<div align="left" class="sqleditbox" style="font-size: 11px;width:90%;padding=6px;">';
			echo ($_POST["copyatt"]==0) ? '<p class="success">'.$lang['sql_scopy1'].' `'.$table_edit_name.'` '.$lang['sql_scopy2'].' `'.$_POST["tablecopyname"].'` '.$lang['sql_scopy3'].'.</p>' : '<p class="success">'.$lang['table'].' `'.$table_edit_name.'` '.$lang['sql_copy1'].' `'.$_POST["tablecopyname"].'` '.$lang['sql_copied'].'.</p>';
			echo highlight_sql($out).'</div>';
			$tablename=$_POST["tablecopyname"];
		}
	}
	if(isset($_POST["newtablesubmit"])) {
		if($_POST["newtablename"]=="") {
			echo '<p class="Warnung">'.$lang['sql_tablenoname'].'</p>';
		} else {
			$sql_alter="CREATE TABLE `".$databases["Name"][$dbid]."`.`".$_POST["newtablename"]."` (`id` int(6) unsigned not null) ".((MSD_NEW_VERSION) ? "ENGINE" : "TYPE")."=MyISAM;";
			MSD_DoSQL($sql_alter);
			echo SQLOutput($out,$lang['table'].' `'.$_POST["newtablename"].'` '.$lang['sql_created']);
		}
	}
	if(isset($_POST["t_edit_submit"])) {
		$sql_alter="ALTER TABLE `".$databases["Name"][$dbid]."`.`".$_POST["table_edit_name"]."` ";
		if($_POST["t_edit_name"]=="")
			echo '<p class="warnung">'.$lang['sql_tblnameempty'].'</p>';
		elseif(MSD_NEW_VERSION && $_POST["t_edit_collate"]!="" && substr($_POST["t_edit_collate"],0,strlen($_POST["t_edit_charset"]))!=$_POST["t_edit_charset"])
			echo '<p class="warnung">'.$lang['sql_collatenotmatch'].'</p>';
		else {
			if($_POST["table_edit_name"]!=$_POST["t_edit_name"]) {
				$sql_alter.="RENAME TO `".$_POST["t_edit_name"]."`, ";
				$table_edit_name=$_POST["t_edit_name"];
			} else $table_edit_name=$_POST["table_edit_name"];
			if($_POST["t_edit_engine"]!="")  $sql_alter.=((MSD_NEW_VERSION) ? "ENGINE=" : "TYPE=").$_POST["t_edit_engine"].", ";
			if($_POST["t_edit_rowformat"]!="")  $sql_alter.="ROW_FORMAT=".$_POST["t_edit_rowformat"].", ";
			if(MSD_NEW_VERSION && $_POST["t_edit_charset"]!="")  $sql_alter.="DEFAULT CHARSET=".$_POST["t_edit_charset"].", ";
			if(MSD_NEW_VERSION && $_POST["t_edit_collate"]!="")  $sql_alter.="COLLATE ".$_POST["t_edit_collate"].", ";
			$sql_alter.="COMMENT='".$_POST["t_edit_comment"]."' ";
			
			MSD_DoSQL($sql_alter);
			echo SQLOutput($out,$lang['table'].' `'.$_POST["table_edit_name"].'` '.$lang['sql_changed']);
		}
	} else {
		if(!isset($table_edit_name) || $table_edit_name=="") {
			$table_edit_name=(isset($_GET["tablename"])) ? $_GET["tablename"] : "";
			if(isset($_POST["tableselect"])) $table_edit_name=$_POST["tableselect"];
			if(isset($_POST["newtablesubmit"])) $table_edit_name=$_POST["newtablename"];
		}
	}
	if(isset($_POST["newfield_posted"])) {
		//build sql for alter
		$def_fieldvals=DefaultFieldVals();
		if($_POST["f_name"]=="") {
			echo '<p class="Warnung">'.$lang['sql_fieldnamenotvalid'].' ('.$_POST["f_name"].')</p>';
			$field_fehler=1;
		} else {
			$sql_stamm="ALTER TABLE `".$databases["Name"][$dbid]."`.`$table_edit_name` ";
			$sql_alter=$sql_stamm.((isset($_POST["editfield"])) ? "CHANGE COLUMN `".$_POST["fieldname"]."` `".$_POST["f_name"]."` " : "ADD COLUMN `".$_POST["f_name"]."` ");
			$sql_alter.=$_POST["f_type"];
			$size=($_POST["f_size"]!="") ? $_POST["f_size"] : $def_fieldvals[strtoupper($_POST["f_type"])]["maxsize"];
			$sql_alter.="(".$size.") ";
			$sql_alter.=$_POST["f_null"]." ";
			$sql_alter.=($_POST["f_default"]!="") ? "DEFAULT '".$_POST["f_default"]."' " :"";
			
			if(MSD_NEW_VERSION && $_POST["f_collate"]!="") $sql_alter.="COLLATE ".$_POST["f_collate"]." ";
			
			$sql_alter.=$_POST["f_position"]." ;";
			
			//alter Key
			$oldkeys[0]=$_POST["f_primary"];
			$oldkeys[1]=$_POST["f_unique"];
			$oldkeys[2]=$_POST["f_index"];
			$oldkeys[3]=$_POST["f_fulltext"];
			//neuer Key
			$newkeys[0]=($_POST["f_index_new"]=="primary")? 1 : 0;
			$newkeys[1]=($_POST["f_index_new"]=="unique")? 1 : 0;
			$newkeys[2]=($_POST["f_index_new"]=="index")? 1 : 0;
			$newkeys[3]=(isset($_POST["f_indexfull"])) ? 1 : 0;
			
			//$s="$oldkeys[0] | $oldkeys[1] | $oldkeys[2] | $oldkeys[3] *** $newkeys[0] | $newkeys[1] |$newkeys[2] | $newkeys[3]";
			$add_sql=ChangeKeys($oldkeys,$newkeys,$_POST["f_name"],$size);
			if($add_sql!="") {
				$add_sql=$sql_stamm.$add_sql;
				$sql_alter=$sql_alter."\n".$add_sql." ;";
			}
			MSD_DoSQL($sql_alter);
				
			echo '<div align="left" class="sqleditbox" style="font-size: 11px;width:90%;padding=6px;">';
			echo '<p class="success"> `'.$_POST["f_name"].'` '.((isset($_POST["editfield"])) ? $lang['sql_changed'] : $lang['sql_created']).'.</p>';
			echo highlight_sql($out).'</div>';
			$fields_infos=FillFieldinfos($databases["Name"][$dbid],$table_edit_name);
		}
	}
	mysql_select_db($databases["Name"][$dbid]);
	$sqlt="SHOW TABLE STATUS FROM `".$databases["Name"][$dbid]."` ;";
	$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
	$anz_tabellen=mysql_numrows($res);
	$p="sql.php?db=".$databases["Name"][$dbid]."&dbid=$dbid&tablename=$table_edit_name&context=2";
		
	echo '<form action="sql.php?db='.$databases["Name"][$dbid].'&dbid='.$dbid.'&tablename='.$table_edit_name.'&context=2" method="post">';
	echo '<table border="1" rules="rows" cellpadding="0" cellspacing="0"><tr bgcolor="#F8FD99"><td>'.$lang['new'].' '.$lang['sql_createtable'].': </td><td colspan="2"><input type="text" name="newtablename" size="30" maxlength="150"></td><td><input type="submit" name="newtablesubmit" value="'.$lang['sql_createtable'].'"></td></tr>';
	echo '<tr bgcolor="#F8FD99"><td>'.$lang['sql_copytable'].': </td><td><input type="text" name="tablecopyname" size="20" maxlength="150"></td><td><select name="copyatt"><option value="0">'.$lang['sql_structureonly'].'</option>'.((MSD_NEW_VERSION) ? '<option value="1">'.$lang['sql_structuredata'].'</option>' : '').'</select></td><td><input type="submit" name="tablecopysubmit" value="'.$lang['sql_copytable'].'" '.(($table_edit_name=="") ? "disabled=\"disabled\"":"").'></td></tr></table>';
	
	echo '<table>';
	
	if($anz_tabellen==0) {
		echo '<tr><td>'.$lang['sql_notablesindb'].' `'.$databases["Name"][$dbid].'`</td></tr>';
	} else {
		
		
		echo '<tr><td>'.$lang['sql_selecttable'].':&nbsp;&nbsp;&nbsp;</td>';
		echo '<td><select name="tableselect" onchange="this.form.submit()"><option value="1" SELECTED></option>';
		for($i=0;$i<$anz_tabellen;$i++) {
			$row=mysql_fetch_array($res);
			echo '<option value="'.$row["Name"].'">'.$row["Name"].'</option>';
		}
		echo '</select>&nbsp;&nbsp;</td>';
		echo '<td><input type="Button" value="'.$lang['sql_showdatatable'].'" onclick="location.href=\'sql.php?db='.$databases["Name"][$dbid].'&dbid='.$dbid.'&tablename='.$tablename.'\'"></td></tr>';
	}
	echo '</table></form>';
	if($table_edit_name!="") {
		
		$sqlf="SHOW FIELDS FROM `".$databases["Name"][$dbid]."`.`$table_edit_name` ;";
		$res=MSD_query($sqlf) or die(SQLError($sqlf,mysql_error()));
		$anz_fields=mysql_numrows($res);
		
		
		
		//Array füllen
		
		$fields_infos=FillFieldinfos($databases["Name"][$dbid],$table_edit_name);
		if(MSD_NEW_VERSION)
			$t_engine=(isset($fields_infos["_tableinfo_"]["ENGINE"])) ? $fields_infos["_tableinfo_"]["ENGINE"] : "MyISAM";
		else
			$t_engine=(isset($fields_infos["_tableinfo_"]["TYPE"])) ? $fields_infos["_tableinfo_"]["TYPE"] : "MyISAM";
		$t_charset=(isset($fields_infos["_tableinfo_"]["DEFAULT CHARSET"])) ? $fields_infos["_tableinfo_"]["DEFAULT CHARSET"] : "";
		$t_collation=(isset($fields_infos["_tableinfo_"]["COLLATE"])) ? $fields_infos["_tableinfo_"]["COLLATE"] : "";
		$t_comment=(isset($fields_infos["_tableinfo_"]["COMMENT"])) ? substr($fields_infos["_tableinfo_"]["COMMENT"],1,strlen($fields_infos["_tableinfo_"]["COMMENT"])-2) : "";
		$t_rowformat=(isset($fields_infos["_tableinfo_"]["ROW_FORMAT"])) ? $fields_infos["_tableinfo_"]["ROW_FORMAT"] : "";
		
		echo "<h4>Tabelle `$table_edit_name`</h4>";
		$td='<td valign="top" nowrap class="small">';
		
		
		//Tabelleneigenschaften
		echo '<form action="'.$p.'" method="post"><table border="1" rules="rows" cellpadding="0" cellspacing="0">';
		echo '<tr bgcolor="#F8FD99"><td colspan="4" style="font-size:10pt;font-weight:bold;">'.$lang['sql_tblpropsof'].' `'.$table_edit_name.'` ('.$anz_fields.' '.$lang['fields'].')</td>';
		echo '<td class="small" colspan="2" align="center">Name<br><input type="text" name="t_edit_name" value="'.$table_edit_name.'" size="30" maxlength="150" style="font-size:11px;"></td></tr>';
		echo '<tr bgcolor="#F8FD99"><tr bgcolor="#F8FD99"><input type="hidden" name="table_edit_name" value="'.$table_edit_name.'">';
		echo '<td class="small" align="center">Engine<br><select name="t_edit_engine"  style="font-size:11px;">'.EngineCombo($t_engine).'</select></td>';
		echo '<td class="small" align="center">Row Format<br><select name="t_edit_rowformat"  style="font-size:11px;">'.GetOptionsCombo($feldrowformat,$t_rowformat).'</select></td>';
		echo '<td class="small" align="center">'.$lang['charset'].'<br><select name="t_edit_charset"  style="font-size:11px;">'.CharsetCombo($t_charset).'</select></td>';
		echo '<td class="small" align="center">'.$lang['collation'].'<br><select name="t_edit_collate"  style="font-size:11px;">'.CollationCombo($t_collation).'</select></td>';
		echo '<td class="small" align="center">'.$lang['comment'].'<br><input type="text" name="t_edit_comment" value="'.$t_comment.'" size="30" maxlength="100" style="font-size:11px;"></td>';
		echo '<td class="small" align="center">&nbsp;<br><input type="submit" name="t_edit_submit" value="'.$lang['change'].'"  style="font-size:11px;"></td></tr>';
		echo '</table></form><br><br>';
		
		$field_fehler=0;
		
		if(isset($_GET["newfield"]) || isset($_GET["editfield"]) || $field_fehler>0) {
			if(isset($_GET["editfield"])) $id=$_GET["editfield"];
			$d_name=(isset($_GET["editfield"])) ? $fields_infos[$id]["name"] : "";
			$d_type=(isset($_GET["editfield"])) ? $fields_infos[$id]["type"] : "";
			$d_size=(isset($_GET["editfield"])) ? $fields_infos[$id]["size"] : "";
			$d_null=(isset($_GET["editfield"])) ? $fields_infos[$id]["null"] : "";
			$d_default=(isset($_GET["editfield"])) ? substr($fields_infos[$id]["default"],1,strlen($fields_infos[$id]["default"])-2) : "";
			$d_extra=(isset($_GET["editfield"])) ? $fields_infos[$id]["extra"] : "";
			$d_primary=$d_unique=$d_index=$d_fulltext=0;	
			if(isset($_GET["editfield"])) {
				$d_primary=(isset($fields_infos["_primarykey_"]) && $fields_infos["_primarykey_"]==$fields_infos[$id]["name"]) ? 1 : 0;
				if(isset($fields_infos["_key_"])) {
					for($i=0;$i<count($fields_infos["_key_"]);$i++) {
						if($fields_infos["_key_"][$i]["name"]==$fields_infos[$id]["name"]) {
							$d_index=1;
							break;
						}
					}
				}
				if(isset($fields_infos["_fulltextkey_"])) {
					for($i=0;$i<count($fields_infos["_fulltextkey_"]);$i++) {
						if($fields_infos["_fulltextkey_"][$i]["name"]==$fields_infos[$id]["name"]) {
							$d_fulltext=1;
							break;
						}
					}
				}
				if(isset($fields_infos["_uniquekey_"])) {
					for($i=0;$i<count($fields_infos["_uniquekey_"]);$i++) {
						if($fields_infos["_uniquekey_"][$i]["name"]==$fields_infos[$id]["name"]) {
							$d_unique=1;
							break;
						}
					}
				}
			}
			echo '<form action="'.$p.'" method="post"><input type="hidden" name="newfield_posted" value="1">';
			if (isset($_GET["editfield"])) echo '<input type="hidden" name="editfield" value="'.$id.'"><input type="hidden" name="fieldname" value="'.$d_name.'">';
			if(isset($_POST["newtablesubmit"])) echo '<input type="hidden" name="newtablename" value="'.$_POST["newtablename"].'">';
			echo '<input type="hidden" name="f_primary" value="'.$d_primary.'"><input type="hidden" name="f_unique" value="'.$d_unique.'"><input type="hidden" name="f_index" value="'.$d_index.'"><input type="hidden" name="f_fulltext" value="'.$d_fulltext.'">';
			echo '<table border="1" rules="rows" cellpadding="0" cellspacing="2"><tr bgcolor="#F8FD99"><td colspan="6" align="center" style="font-size:10pt;font-weight:bold;">'.((isset($_GET["editfield"])) ? $lang['sql_editfield']." `".$d_name."`" : $lang['sql_newfield']).'</td></tr><tr bgcolor="#F8FD99">';
			echo '<td class="small" align="center">Name<br><input type="text" value="'.$d_name.'" name="f_name" size="30" style="font-size:11px;"></td>';
			echo '<td class="small" align="center">Type<br><select name="f_type" style="font-size:11px;">'.GetOptionsCombo($feldtypen,$d_type).'</select></td>';
			echo '<td class="small" align="center">Size<br><input type="text" value="'.$d_size.'" name="f_size" size="3" maxlength="3" style="font-size:11px;"></td>';
			echo '<td class="small" align="center">NULL<br><select name="f_null" style="font-size:11px;">'.GetOptionsCombo($feldnulls,$d_null).'</select></td>';
			echo '<td class="small" align="center">Default<br><input type="text" name="f_default" value="'.$d_default.'" size="10" style="font-size:11px;"></td>';
			echo '<td class="small" align="center">Extra<br><select name="f_extra" style="font-size:11px;">'.GetOptionsCombo($feldextras,$d_extra).'</select></td>';
			
			echo '</tr><tr bgcolor="#F8FD99"><td class="small" align="center">'.$lang['sql_indexes'].'<br>';
			echo '<img src="images/nokey.gif" width="12" height="13" alt="No Index"><input type="radio" name="f_index_new" value="no" '.(($d_primary+$d_unique+$d_index+$d_fulltext==0) ? "checked" : "").'>&nbsp;';
			echo '<img src="images/primary.gif" width="12" height="13" alt="Primary Key"><input type="radio" name="f_index_new" value="primary" '.(($d_primary==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="images/unique.gif" width="13" height="12" alt="Unique Index"><input type="radio" name="f_index_new" value="unique" '.(($d_unique==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="images/key.gif" width="13" height="12" alt="Index"><input type="radio" name="f_index_new" value="index" '.(($d_index==1) ? "checked" : "" ).'>&nbsp;';
			echo '<img src="images/fulltext.gif" width="13" height="12" alt="Fulltext Index"><input type="checkbox" name="f_indexfull" value="1" '.(($d_fulltext==1) ? "checked" : "" ).'>&nbsp;';
			
			
			echo '</td><td class="small" align="center">'.$lang['collation'].'<br><select name="f_collate" style="font-size:11px;">'.CollationCombo().'</select></td>';
			echo '<td colspan="2" class="small" align="center">'.$lang['sql_atposition'].':<br><select name="f_position" style="font-size:11px;"><option value=""></option><option value="FIRST">'.$lang['sql_first'].'</option>';
			if($anz_fields>0) {
				for($i=0;$i<$anz_fields;$i++) {
					echo '<option value="AFTER `'.$fields_infos[$i]["name"].'`">'.$lang['sql_after'].' `'.$fields_infos[$i]["name"].'`</option>';
				}
			}	
			echo '</select></td><td colspan="2" align="center"><input type="submit" name="newfieldsubmit" value="'.((isset($_GET["editfield"])) ? $lang['sql_changefield'] : $lang['sql_insertfield']).'"></td></tr></table></form>';
		} else 
			echo '<a class="ul" style="font-size:8pt;padding-bottom:8px;" href="'.$p.'&newfield=1">'.$lang['sql_insertnewfield'].'</a><br><br>';
		
		//Felder ausgeben
		echo '<table width="90%" cellpadding="0" cellspacing="0" border="1" rules="rows">';
		for($i=0;$i<$anz_fields;$i++) {
			if($i==0) echo '<tr><td class="hdl">&nbsp;</td><td class="hdl">Field</td><td class="hdl">Type</td><td class="hdl">Size</td><td class="hdl">NULL</td><td class="hdl">Key</td><td class="hdl">Default</td><td class="hdl">Extra</td><td class="hdl">Sortierung</td></tr>';
			echo '<tr><td>';
			echo '<a href="'.$p.'&editfield='.$i.'"><img src="images/edit.gif" alt="edit field" width="12" height="13" border="0"></a>&nbsp;&nbsp;';
			echo '<a href="'.$p.'&kill='.$fields_infos[$i]["name"].'&anz='.$anz_fields.'" onclick="if(!confirm(\''.$lang['sql_askdeletefield'].'\')) return false;"><img src="images/delete.gif" alt="delete field" width="11" height="13" border="0"></a>&nbsp;&nbsp;';
			
			echo '</td>'.$td.'<strong>'.$fields_infos[$i]["name"].'</strong></td>'.$td.$fields_infos[$i]["type"].'</td>'.$td.$fields_infos[$i]["size"].'</td>';
			echo $td.$fields_infos[$i]["null"].'</td>'.$td;
			//key
			if($fields_infos["_primarykey_"]==$fields_infos[$i]["name"]) echo '<img src="images/primary.gif" width="12" height="13" alt="Primary Key">';
			if(isset($fields_infos["_fulltextkey_"])) {
				for($ii=0;$ii<count($fields_infos["_fulltextkey_"]);$ii++) {
					if($fields_infos["_fulltextkey_"][$ii]["name"]==$fields_infos[$i]["name"]) {
						echo '<img src="images/fulltext.gif" width="13" height="12" alt="Fulltext Index">'; break;
					}
				}
			}
			if(isset($fields_infos["_uniquekey_"])) {
				for($ii=0;$ii<count($fields_infos["_uniquekey_"]);$ii++) {
			 		if($fields_infos["_uniquekey_"][$ii]["name"]==$fields_infos[$i]["name"]) {
						echo '<img src="images/unique.gif" width="13" height="12" alt="Unique Index">'; break;
					}
				}
			}
			if(isset($fields_infos["_key_"])) {
				 for($ii=0;$ii<count($fields_infos["_key_"]);$ii++) {
				 	//echo "<h5>".$fields_infos["_key_"][$ii]["columns"]."</h5>";
				 	if($fields_infos["_key_"][$ii]["name"]==$fields_infos[$i]["name"]) {
						echo '<img src="images/key.gif" width="13" height="12" alt="Index">'; break;
					}
				 }
			}
			echo '</td>'.$td.$fields_infos[$i]["default"].'</td>'.$td.$fields_infos[$i]["extra"].'</td>';
			echo '</td>'.$td.$fields_infos[$i]["collate"].'</td></tr>';
		}
		echo '</table><br>';
		
		echo '<h6>'.$lang['sql_tableindexes'].' `'.$table_edit_name.'`</h6>';
		echo '<table border="1" rules="rows"><tr><td class="hd">&nbsp;</td><td class="hd">Index-Name</td>'.((MSD_NEW_VERSION) ? '<td class="hd">Typ</td>' : '').'<td class="hd">'.$lang['sql_allowdups'].'</td><td class="hd">'.$lang['sql_cardinality'].'</td><td class="hd">Spalten</td></tr>';
		$sqlk="SHOW KEYS FROM `".$databases["Name"][$dbid]."`.`$table_edit_name`;";
		$res=MSD_query($sqlk) or die(SQLError($sqlk,mysql_error()));
		$num=mysql_numrows($res);
		if($num==0) {
			echo '<tr><td colspan="6">'.$lang['sql_tablenoindexes'].'</td></tr>';
		} else {
			for($i=0;$i<$num;$i++) {
				$row=mysql_fetch_array($res);
				//Images
				echo '<tr><td><img src="images/edit.gif" width="12" height="13" alt="">&nbsp;&nbsp;<img src="images/delete.gif" width="12" height="13" alt=""></td>';
				echo '<td>'.$row["Key_name"].'</td>';
				if(MSD_NEW_VERSION) echo '<td>'.$row["Index_type"].'</td>';
				echo '<td align="center">'.(($row["Non_unique"]==1) ? $lang["yes"]: $lang["no"]).'</td>';
				echo '<td>'.(($row["Cardinality"]>=0) ? $row["Cardinality"] : "keine").'</td>';
				echo '<td>'.$row["Column_name"].'</td>';
				echo '</tr>';
			}
		}
		echo '</table><br><input type="Button" value="'.$lang['sql_createindex'].'" onclick="location.href=\''.$p.'\'" disabled="disabled">';
		
		/*echo "<hr>";
		echo '<br><pre>';print_r($fields_infos);echo '</pre>';*/
	}
	
} elseif ($context==3) {
	//Datenbanken
	if(isset($_GET["dbrefresh"])) SetDefault(true);
	
	echo "<h4>".$lang['dbs']."</h4>";
	if(isset($_POST["dbdosubmit"])) {
		$newname=$_POST["newname"];
		$db_index=$_POST["db_index"];
		$db_action=$_POST["db_action"];
		$changed=false;$ausgabe=$out="";
		switch($db_action) {
			case "drop":
				MSD_DoSQL("DROP DATABASE `".$databases["Name"][$db_index]."`");
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$databases["Name"][$db_index].'` wurde gelöscht.</p>');
				$changed=true;
				break;
			case "empty":
				DB_Empty($databases["Name"][$db_index]);
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$databases["Name"][$db_index].'` '.$lang['sql_wasemptied'].'.</p>');
				break;
			case "rename":
				$dbold=$databases["Name"][$db_index];
				DB_Copy($dbold,$newname,1);
				echo SQLOutput($out,'<p class="success">'.$lang['db'].' `'.$dbold.'` '.$lang['sql_renamedto'].' `'.$newname.'`.</p>');
				$changed=true;
				break;
			case "copy":
				$dbold=$databases["Name"][$db_index];
				DB_Copy($dbold,$newname);
				$changed=true;
				echo SQLOutput($out,'<p class="success">'.$lang['sql_dbcopy1'].' `'.$dbold.'` '.$lang['sql_dbcopy2'].' `'.$newname.'` '.$lang['sql_copied'].'.</p>');
			break;
			case "structure":
				DB_Copy($databases["Name"][$db_index],$newname,0,0);
				$changed=true;
				echo SQLOutput($out,'<p class="success">'.$lang['sql_dbscopy1'].' `'.$databases["Name"][$db_index].'` '.$lang['sql_dbcopy2'].' `'.$newname.'` '.$lang['sql_copied'].'.</p>');
			break;
			case "rights":
			break;
		}
		
		
		if($changed=true) {
			SetDefault(true);
			include ($config["files"]["parameter"]);
			echo '<script language="JavaScript">parent.MySQL_Dumper_menu.location.href="menu.php?action=dbrefresh";</script>';
			
		}
	}
	if(isset($_POST["dbwantaction"])) {
		if(isset($_POST["db_createnew"])) {
			$newname=$_POST["db_create"];
			if(!empty($newname)) {
				$sqlc="CREATE DATABASE `$newname`";
				MSD_query($sqlc) or die(SQLError($sqlc,mysql_error()));
				echo $lang['db']." `$newname` ".$lang['sql_wascreated'].".<br>";
				SetDefault(true);
			}
		}
		$db_action=$newname="";$db_index=-1;
		for($i=0;$i<count($databases["Name"]);$i++) {
			if(isset($_POST["db_do_$i"])) {
				$newname=$_POST["db_rename$i"];
				$db_index=$i;
				$db_action=$_POST["db_do_action_$i"];
				break;
			}
		}
		if($db_action!="") {
			echo '<div align="center"><div align="left" class="sqleditbox" style="width:90%;height:80px;padding=6px;">';
			echo '<form action="sql.php?context=3" method="post"><input type="hidden" name="db_action" value="'.$db_action.'"><input type="hidden" name="newname" value="'.$newname.'"><input type="hidden" name="db_index" value="'.$db_index.'">';
			switch($db_action) {
				case "drop":
				echo '<strong>'.$lang["fm_askdbdelete1"].'`'.$databases["Name"][$i].'`'.$lang["fm_askdbdelete2"].'</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'">';
				break;
				case "empty":
				echo '<strong>'.$lang["fm_askdbempty1"].'`'.$databases["Name"][$i].'`'.$lang["fm_askdbempty2"].'</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'">';
				break;
				case "rename":
				echo '<strong>'.$lang['sql_renamedb'].' `'.$databases["Name"][$db_index].'` '.$lang['in'].' `'.$newname.'`</strong><br><br>';
				echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'">';
				break;
				case "copy":
					echo '<strong>'.$lang["fm_askdbcopy1"].'`'.$databases["Name"][$db_index].'`'.$lang["fm_askdbcopy2"].'`'.$newname.'`'.$lang["fm_askdbcopy3"].'</strong><br><br>';
					if($newname=="") echo '<p class="Warnung">'.$lang['sql_namedest_missing'].'</p>'; else {
					echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'">';
				
					}
				break;
				case "structure":
					echo '<strong>'.$lang["fm_askdbcopy1"].'`'.$databases["Name"][$db_index].'`'.$lang["fm_askdbcopy2"].'`'.$newname.'`'.$lang["fm_askdbcopy3"].'</strong><br><br>';
					if($newname=="") echo '<p class="Warnung">'.$lang['sql_namedest_missing'].'</p>'; else {
					echo '<input type="submit" name="dbdosubmit" value="'.$lang['do_now'].'">';
				
					}
				break;
				case "rights":
				break;
			}
			echo "</form></div></div><br>";
			
			
		}
	}
	
	echo '<br><form action="sql.php?context=3" method="post"><input type="hidden" name="dbwantaction" value="1">';
	echo '<div align="center"><table border="1" rules="rows" width="80%" cellpadding="0" cellspacing="0">';
	echo '<tr bgcolor="#F8FD99"><td>neue Datenbank:</td><td><input type="text" name="db_create" size="20">&nbsp;&nbsp;<input type="submit" name="db_createnew" value="anlegen"></td></tr>';
	echo '<tr><td class="hd">'.$lang["dbs"].'</td><td class="hd">'.$lang['sql_actions'].'</td></tr>';
	for($i=0;$i<count($databases["Name"]);$i++) {
		echo ($i==$databases["db_selected_index"]) ? '<tr bgcolor="#ccffff">' : '<tr bgcolor="'.(($i % 2)  ? 'white' : '#e1e1e1').'">';
		echo '<td><a href="sql.php?db='.$databases["Name"][$i].'&dbid='.$i.'">'.$databases["Name"][$i].'</a></td>';
		echo '<td><input type="text" name="db_rename'.$i.'" size="20">';
		echo '&nbsp;&nbsp;<select name="db_do_action_'.$i.'" onchange="db_do_'.$i.'.disabled=false;">';
		echo '<option value="">-- '.$lang['sql_chooseaction'].' --</option>';
		echo '<option value="drop">'.$lang['sql_deletedb'].'</option>';
		echo '<option value="empty">'.$lang['sql_emptydb'].'</option>';
		if(MSD_NEW_VERSION) echo '<option value="rename">'.$lang['sql_renamedb'].'</option>';
		if(MSD_NEW_VERSION) echo '<option value="copy">'.$lang['sql_copydatadb'].'</option>';
		echo '<option value="structure">'.$lang['sql_copysdb'].'</option>';
		
		echo '</select>';
		echo "\n\n".'&nbsp;&nbsp;<input type="submit" name="db_do_'.$i.'" value="'.$lang['do'].'" disabled="disabled">';
	
		echo '</td></tr>';
	}
	
	echo '</table></div></form>';
	
	
} elseif ($context==4) {
	//Tabellen
	
}

echo '<br><br><br>';



include("inc/footer.php");


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
