<?php

//SQL-Library laden
include("inc/sqllib.php");


if(!isset($config["sql_limit"])) $config["sql_limit"]=30;
if(!isset($config["bb_width"])) $config["bb_width"]=300;
if(!isset($config["bb_textcolor"])) $config["bb_textcolor"]="#990033";


function ReadSQL()
{
	global $SQL_ARRAY,$config;
	$sf=$config["paths"]["config"].'sql_statements';
	if(!is_file($sf)){
		$fp=fopen($sf,"w+");
		fclose($fp);
		@chmod($sf,0775); 
	}
	if(count($SQL_ARRAY)==0 && filesize($sf)>0) {
		$SQL_ARRAY=file($sf);
	}
}
function WriteSQL()
{
	global $SQL_ARRAY,$config;
	$sf=$config["paths"]["config"].'sql_statements';
	$str="";
	for($i=0;$i<count($SQL_ARRAY);$i++) {
		$str.=$SQL_ARRAY[$i];
		if(substr($str,-1)!="\n" && $i!=(count($SQL_ARRAY)-1)) $str.="\n";
		
	}
	$fp=fopen($sf,"wb");
	fwrite($fp,$str);
	fclose($fp);
	
}
function SQL_Name($index)
{
	global $SQL_ARRAY;
	$s=explode("|",$SQL_ARRAY[$index]);
	return $s[0];
}
function SQL_String($index)
{
	global $SQL_ARRAY;
	if(isset($SQL_ARRAY[$index]) && !empty($SQL_ARRAY[$index])) {
		$s=explode("|",$SQL_ARRAY[$index]);
		return (isset($s[1])) ? $s[1] : "";
	}
}
function SQL_ComboBox()
{
	global $SQL_ARRAY,$tablename,$nl;
	$s=$nl.$nl.'<select class="SQLCombo" name="sqlcombo" onchange="this.form.tb_sql.value=this.options[this.selectedIndex].value;">'.$nl;
	$s.='<option value="" selected>                  </option>'.$nl;
	if(count($SQL_ARRAY)>0) {
		for($i=0;$i<count($SQL_ARRAY);$i++) {
			$s.='<option value="'.stripslashes(SQL_String($i)).'">'.SQL_Name($i).'</option>'.$nl;
		}
	}
	$s.='</select>'.$nl.$nl;
	return $s;
}

function Table_ComboBox()
{
	global $db,$config,$lang,$nl;
	$tabellen = mysql_list_tables($db,$config["dbconnection"]); 
	$num_tables = mysql_num_rows($tabellen); 
	$s=$nl.$nl.'<select class="SQLCombo" name="tablecombo" onchange="this.form.tb_sql.value=this.options[this.selectedIndex].value;this.form.execsql.click();">'.$nl.'<option value="" selected>                 </option>'.$nl;
	for($i=0;$i<$num_tables;$i++) {
		$t=mysql_tablename($tabellen,$i);
		$s.='<option value="SELECT * FROM `'.$t.'`">'.$lang['table'].' `'.$t.'`</option>'.$nl;
	}
	$s.='</select>'.$nl.$nl;
	return $s;
}
function TableComboBox($default="")
{
	global $db,$config,$lang,$nl;
	$tabellen = mysql_list_tables($db,$config["dbconnection"]); 
	$num_tables = mysql_num_rows($tabellen); 
	$s='<option value="" '.(($default=="") ? 'selected' : '').'>                 </option>'.$nl;
	for($i=0;$i<$num_tables;$i++) {
		$t=mysql_tablename($tabellen,$i);
		$s.='<option value="`'.$t.'`"'.(($default=='`'.$t.'`') ? 'selected' : '').'>`'.$t.'`</option>'.$nl;
	}
	return $s;
}
function DB_Exists($db)
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$erg=false;
	$dbs=mysql_list_dbs($config["dbconnection"]); 
	while ($row = mysql_fetch_object($dbs)) {
   		if(strtolower($row->Database)==strtolower($db)) {
			$erg=true;break;
		}
	}
	return $erg;
}
function Table_Exists($db,$table)
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$erg=false;
	$sqlt="SHOW TABLES FROM `$db`";
	$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
	
   	if($res) {
		$row = mysql_fetch_row($res);
		if(strtolower($row[0])==strtolower($table)) {
			$erg=true;
		}
	} else die("ERROR");
	return $erg;
}

function DB_Empty($dbn)
{
	$r="DROP DATABASE `$dbn`;\nCREATE DATABASE `$dbn`;";
	MSD_DoSQL($r);
	
}

function DB_Copy($source,$destination,$drop_source=0,$insert_data=1)
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$SQL_Array=$t="";
	if(!DB_Exists($destination)) $SQL_Array.="CREATE DATABASE `$destination` ;\n";
	$SQL_Array.="USE `$destination` ;\n";
	$tabellen = mysql_list_tables($source,$config["dbconnection"]); 
	$num_tables = mysql_num_rows($tabellen); 
	for($i=0;$i<$num_tables;$i++) {
		$table=mysql_tablename($tabellen,$i);
		$sqlt="SHOW CREATE TABLE `$source`.`$table`";
		$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
		$row=mysql_fetch_row($res);
		$c=$row[1]; if(substr($c,-1)==";") $c=substr($c,0,strlen($c)-1);
		$SQL_Array.=($insert_data==1) ? "$c SELECT * FROM `$source`.`$table` ;\n" : "$c ;\n";
	}
	if($drop_source==1) $SQL_Array.="DROP DATABASE `$source` ;";
	
	mysql_select_db($destination);
	MSD_DoSQL($SQL_Array);
	
}
function Table_Copy($source,$destination,$insert_data,$destinationdb="")
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$SQL_Array=$t="";
	$sqlc="SHOW CREATE TABLE $source";
	$res=MSD_query($sqlc) or die(SQLError($sqlc,mysql_error()));
	$row=mysql_fetch_row($res);
	$c=$row[1]; 
	$a1=strpos($c,"`");
	$a2=strpos($c,"`",$a1+1);
	$c=substr($c,0,$a1+1).$destination.substr($c,$a2);
	if(substr($c,-1)==";") $c=substr($c,0,strlen($c)-1);
	$SQL_Array.=($insert_data==1) ? "$c SELECT * FROM $source ;\n" : "$c ;\n";
	//echo "<h5>$SQL_Array</h5>";
	MSD_DoSQL($SQL_Array);
	
}
function MSD_DoSQL($sqlcommands,$limit="")
{
	
	global $config,$out,$numrowsabs,$numrows,$num_befehle,$time_used,$sql;
	
	if(!isset($sql["parser"]["sql_commands"])) $sql["parser"]["sql_commands"]=0;
	if(!isset($sql["parser"]["sql_errors"])) $sql["parser"]["sql_errors"]=0;
	
	$sql["parser"]["time_used"]=getmicrotime();
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$out=$sqlcommand="";
	$allSQL=explode(";\\n",$sqlcommands);
	$sql_queries=count($allSQL);
	if(!isset($allSQL[$sql_queries-1])) $sql_queries--;
	if($sql_queries==1) {
		SQLParser($allSQL[0].";");
		$sql["parser"]["sql_commands"]++;
		$out.=Stringformat(($sql["parser"]["sql_commands"]),4).": ". $allSQL[0]."\n";
		$result =MSD_query($allSQL[0]) or die(SQLError($allSQL[0],mysql_error()));
		
	} else {
		
		for($i=0;$i<$sql_queries; $i++) {
			$allSQL[$i]=trim(rtrim($allSQL[$i]));
			if($allSQL[$i]!="") {
				$sqlcommand.=$allSQL[$i];
				SQLParser($sqlcommand);
				if($sql["parser"]["start"]==0 && $sql["parser"]["end"]==0) {
					//sql complete
					$sql["parser"]["sql_commands"]++;
					$out.=Stringformat(($sql["parser"]["sql_commands"]),4).": ". $sqlcommand."\n";
					$result =MSD_query($sqlcommand.";") or die(SQLError($sqlcommand.";",mysql_error()));
					$sqlcommand="";
				}
			}
		}
	}
	$sql["parser"]["time_used"]=getmicrotime()-$sql["parser"]["time_used"];
}

function SQLParser($s,$debug=0)
{
	global $sql;
	$sql["parser"]["start"]=$sql["parser"]["end"]=0;
	$sql["parser"]["sqlparts"]=0;
	if(!isset($sql["parser"]["drop"])) $sql["parser"]["drop"]=0;
	if(!isset($sql["parser"]["create"])) $sql["parser"]["create"]=0;
	if(!isset($sql["parser"]["insert"])) $sql["parser"]["insert"]=0;
	if(!isset($sql["parser"]["update"])) $sql["parser"]["update"]=0;
	if(!isset($sql["parser"]["comment"])) $sql["parser"]["comment"]=0;
	$Backslash=chr(92);
	$s=rtrim(trim(strtoupper(($s))));
	
	//Was ist das f�r eine Anfrage ?
	if(substr($s,0,1)=="#" || substr($s,0,2)=="--") {
		$sql["parser"]["comment"]++;
	} elseif(substr($s,0,5)=="DROP ") {
		$sql["parser"]["drop"]++;
	} elseif(substr($s,0,7)=="CREATE ") {
		//Hier nur die Anzahl der Klammern z�hlen
		$sql["parser"]["start"]=1;
		$kl1=substr_count($s,"(");
		$kl2=substr_count($s,")");
		if($kl2-$kl1==0) {
			$sql["parser"]["start"]=0;
			$sql["parser"]["create"]++;
		}
	} elseif(substr($s,0,7)=="INSERT " || substr($s,0,7)=="UPDATE ") {
		
		if(substr($s,0,7)=="INSERT ") $sql["parser"]["insert"]++; else $sql["parser"]["update"]++;
		$i=strpos($s," VALUES")+7;
		$s=substr($s,$i);
		$i=strpos($s,"(")+1;
		$s=substr($s,$i);
		$s=substr($s,0,strlen($s)-2);
		
		$tb=explode(",",$s);
		for ($i=0;$i<count($tb);$i++){
			$first=$B_Esc=$B_Ticks=$B_Dashes=0;
			$v=trim($tb[$i]);
			//Ticks + Dashes z�hlen
			for($cpos=2;$cpos<=strlen($v);$cpos++)
			{if(substr($v,(-1*$cpos),1)=="'") {$B_Ticks++;} else {break;}}
			for($cpos=2;$cpos<=strlen($v);$cpos++)
			{if(substr($v,(-1*$cpos),1)=='"') {$B_Dashes++;} else {break;}}
			
			//Backslashes z�hlen
			for($cpos=2+$B_Ticks;$cpos<=strlen($v);$cpos++)
			{if(substr($v,(-1*$cpos),1)=="\\") {$B_Esc++;} else {break;}}
			
			if($v=="NULL" && $sql["parser"]["start"]==0){$sql["parser"]["start"]=1;$sql["parser"]["end"]=1;}
			if($sql["parser"]["start"]==0 && is_numeric($v)){$sql["parser"]["start"]=1;$sql["parser"]["end"]=1;}
			if($sql["parser"]["start"]==0 && substr($v,0,2)=="0X" && strpos($v," ")==false){$sql["parser"]["start"]=1;$sql["parser"]["end"]=1;}
			if($sql["parser"]["start"]==0 && is_object($v)){$sql["parser"]["start"]=1;$sql["parser"]["end"]=1;}
			
			if(substr($v,0,1)=="'"  && $sql["parser"]["start"]==0) {$sql["parser"]["start"]=1;if(strlen($v)==1)$first=1;$DELIMITER="'";}
			if(substr($v,0,1)=='"'  && $sql["parser"]["start"]==0) {$sql["parser"]["start"]=1;if(strlen($v)==1)$first=1;$DELIMITER='"';}
			if($sql["parser"]["start"]==1 && $sql["parser"]["end"]!=1 && $first==0){
				if (substr($v,-1)==$DELIMITER){
					$B_Delimiter=($DELIMITER=="'") ? $B_Ticks : $B_Dashes;
						//ist Delimiter maskiert?
					if (($B_Esc % 2)==1 && ($B_Delimiter % 2)==1  && strlen($v)>2) {
						
						$sql["parser"]["end"]=1;
					} elseif (($B_Delimiter % 2)==1 && strlen($v)>2) {
						//ist mit `'` maskiert
						$sql["parser"]["end"]=0;
					} elseif(($B_Esc % 2)==1) {
						//ist mit Backslash maskiert
						$sql["parser"]["end"]=0; 
					} else {
						
						$sql["parser"]["end"]=1;
					}
				}
			}
			if($debug==1) echo "<font color='#0000FF'>".$sql["parser"]["start"]."/".$sql["parser"]["end"]."</font> Feld $i: ".htmlspecialchars($tb[$i])."<font color=#008000>- ".$sql["parser"]["sqlparts"]."  ($B_Ticks / $B_Esc)</font><br>";
			if($sql["parser"]["start"]==1 && $sql["parser"]["end"]==1) {
				$sql["parser"]["sqlparts"]++;
				
				$sql["parser"]["start"]=$sql["parser"]["end"]=0;
			}
		}
	}
}

function SQLOutput($sqlcommand,$meldung="")
{	
	global $sql,$lang;
	$s= '<div align="left" class="sqloutbox" style="font-size: 11px;width:90%;padding=6px;">';
	if($meldung!="") $s.='<p class="success" align="left">'.$meldung.'</p>';
	$s.='<h5 align="center">'.$lang['sql_output'].'</h5>';
	$s.='<strong>'.$sql["parser"]["sql_commands"].'</strong>'.$lang['sql_commands_in'].round($sql["parser"]["time_used"],4).$lang['sql_commands_in2'].'<br><br>';
	$s.=$lang['sql_out1'].'<strong>'.$sql["parser"]["drop"].'</strong> <span style="color:#990099;font-weight:bold;">DROP</span>-, ';
	$s.='<strong>'.$sql["parser"]["create"].'</strong> <span style="color:#990099;font-weight:bold;">CREATE</span>-, ';
	$s.='<strong>'.$sql["parser"]["insert"].'</strong> <span style="color:#990099;font-weight:bold;">INSERT</span>-, ';
	$s.='<strong>'.$sql["parser"]["update"].'</strong> <span style="color:#990099;font-weight:bold;">UPDATE</span>-'.$lang['sql_out2'].'<br>';
	$s.=$lang['sql_out3'].'<strong>'.$sql["parser"]["comment"].'</strong> '.$lang['sql_out4'].'<br>';
	if($sql["parser"]["sql_commands"]<5000) 
		$s.='<pre style="line-height: 60%;">'.highlight_sql($sqlcommand).'</pre></div>';
	else $s.=$lang['sql_out5']."</div>";
	return $s;
}



function GetCreateTable($db,$tabelle)
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	$res=mysql_query("SHOW CREATE TABLE `$db`.`$tabelle`");
	if($res) {
		$row=mysql_fetch_array($res);
		return $row["Create Table"];
	} else return mysql_error();
	
}

function KindSQL($sql)
{
	if (preg_match('@^((-- |#)[^\n]*\n|/\*.*?\*/)*(DROP|CREATE)[[:space:]]+(IF EXISTS[[:space:]]+)?(TABLE|DATABASE)[[:space:]]+(.+)@im', $sql)) {
        return 2;
    } elseif (preg_match('@^((-- |#)[^\n]*\n|/\*.*?\*/)*(DROP|CREATE)[[:space:]]+(IF EXISTS[[:space:]]+)?(TABLE|DATABASE)[[:space:]]+(.+)@im', $sql)) {
        return 1;
	}
}




function GetPostParams()
{
	global $db,$dbid,$tablename,$context,$limitstart,$order,$orderdir,$sql;
	$db=$_POST["db"];
	$dbid=$_POST["dbid"];
	$tablename=$_POST["tablename"];
	$context=$_POST["context"];
	$limitstart=$_POST["limitstart"];
	$order=$_POST["order"];
	$orderdir=$_POST["orderdir"];
	$sql["sql_statement"]=(isset($_POST["sql"])) ? stripslashes(urldecode($_POST["sql"])) : "SELECT * FROM `$tablename`";
	
}

function ComboCommandDump($when,$index)
{
	global $SQL_ARRAY,$nl,$databases,$lang;
	
	if(count($SQL_ARRAY)==0) {
		$r='<a href="sql.php?context=1" class="uls">'.$lang["sql_befehle"].'</a>';
		if($when==0)
			$r.='<input type="hidden" name="command_before_'.$index.'" value="">';
		else
			$r.='<input type="hidden" name="command_after_'.$index.'" value="">';
	} else {
		if($when==0) {
			$r='<select class="SQLCombo" name="command_before_'.$index.'">';
			$csql=$databases["command_before_dump"][$index];
		} else {
			$r='<select class="SQLCombo" name="command_after_'.$index.'">';
			$csql=$databases["command_after_dump"][$index];
		}
		
		$r.='<option value="" '.(($csql=="") ? "selected" : "").'>&nbsp;</option>';
		if(count($SQL_ARRAY)>0) {
			for($i=0;$i<count($SQL_ARRAY);$i++) {
				$s=str_replace('"',"'",SQL_String($i));
				$r.='<option value="'.$s.'" '.(($csql==$s) ? "selected" : "").'>'.SQL_Name($i).'</option>'.$nl;
			}
		}
		
		$r.='</select>';
	}
	return $r;
}

function EngineCombo($default="")
{
	global $config;
	if(!$config["dbconnection"]) MSD_mysql_connect(); 
	
	$r='<option value="" '.(($default=="") ? "selected" : "").'></option>';
	if(!MSD_NEW_VERSION) {
	//BDB | HEAP | ISAM | InnoDB | MERGE | MRG_MYISAM | MYISAM
		$r.='<option value="BDB" '.(("BDB"==$default) ? "selected" : "").'>BDB</option>';
		$r.='<option value="HEAP" '.(("HEAP"==$default) ? "selected" : "").'>HEAP</option>';
		$r.='<option value="ISAM" '.(("ISAM"==$default) ? "selected" : "").'>ISAM</option>';
		$r.='<option value="InnoDB" '.(("InnoDB"==$default) ? "selected" : "").'>InnoDB</option>';
		$r.='<option value="MERGE" '.(("MERGE"==$default) ? "selected" : "").'>MERGE</option>';
		$r.='<option value="MRG_MYISAM" '.(("MRG_MYISAM"==$default) ? "selected" : "").'>MRG_MYISAM</option>';
		$r.='<option value="MYISAM" '.(("MyISAM"==$default) ? "selected" : "").'>MyISAM</option>';
	} else {
		$res=mysql_query("SHOW ENGINES");
		$num = mysql_num_rows($res); 
		for($i=0;$i<$num;$i++) {
			$row=mysql_fetch_array($res);
			$r.='<option value="'.$row["Engine"].'" '.(($row["Engine"]==$default) ? "selected" : "").'>'.$row["Engine"].'</option>';
		}
	}
	return $r;
}

function CharsetCombo($default="")
{
	global $config;
	if(!MSD_NEW_VERSION) { return "";
	} else {
		if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
		$res=mysql_query("SHOW Charset");
		$num = mysql_num_rows($res); 
		$r='<option value="" '.(($default=="") ? "selected" : "").'></option>';
		for($i=0;$i<$num;$i++) {
			$row=mysql_fetch_array($res);
			$r.='<option value="'.$row["Charset"].'" '.(($row["Charset"]==$default) ? "selected" : "").'>'.$row["Charset"].'</option>';
		}
		return $r; 
	}
}

function GetCollationArray()
{
	global $config;
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 

	$res=mysql_query("SHOW Collation");
	$num = mysql_num_rows($res); 
	$r=Array();
	for($i=0;$i<$num;$i++) {
		$row=mysql_fetch_array($res);
		$r[$i]["Collation"]=$row["Collation"];
		$r[$i]["Charset"]=$row["Charset"];
		$r[$i]["Id"]=$row["Id"];
		$r[$i]["Default"]=$row["Default"];
		$r[$i]["Compiled"]=$row["Compiled"];
		$r[$i]["Sortlen"]=$row["Sortlen"];
	}
	return $r; 
}

function CollationCombo($default="",$withcharset=0)
{
	if(!MSD_NEW_VERSION) {
		return "";
	} else {
		$r=GetCollationArray();
		sort($r);
		$s="";
		$s='<option value="" '.(($default=="") ? "selected" : "").'></option>';
		$group="";
		for($i=0;$i<count($r);$i++) {
			$gc=$r[$i]["Charset"];
			if($gc!=$group) {
				$group=$gc;
				$s.='<optgroup label="'.$group.'">';
			}
			$s.='<option value="'.(($withcharset==1) ? $group.'|' : '').$r[$i]["Collation"].'" '.(($r[$i]["Collation"]==$default) ? "selected" : "").'>'.$r[$i]["Collation"].'</option>';
		}
		return $s; 
	}
}
function AttributeCombo($default="")
{
	$s='<option value="" '.(($default=="") ? "selected" : "").'></option>';
	$s.='<option value="unsigned" '.(($default=="unsigned") ? "selected" : "").'>unsigned</option>';
	$s.='<option value="unsigned zerofill" '.(($default=="unsigned zerofill") ? "selected" : "").'>unsigned zerofill</option>';
	return $s;

}

function simple_bbcode_conversion($a)
{
	global $config;
	$tag_start='<div style="color:'.$config["bb_textcolor"].';width:'.$config["bb_width"].'px;">';
	$tag_end='</div>';
	
	//replacements
	$a=nl2br($a);
	
	$a=preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/si","<a class=\"small\"  href=\"$1\" target=\"blank\">$2</a>",$a);	
	$a=preg_replace("/\[urltargetself=(.*?)\](.*?)\[\/urltargetself\]/si","<a class=\"small\"  href=\"$1\" target=\"blank\">$2</a>",$a);	
	$a=preg_replace("/\[url\](.*?)\[\/url\]/si","<a class=\"small\"  href=\"$1\" target=\"blank\">$1</a>",$a);	
	$a=preg_replace("/\[ed2k=\+(.*?)\](.*?)\[\/ed2k\]/si","<a class=\"small\"  href=\"$1\" target=\"blank\">$2</a>",$a);	
	$a=preg_replace("/\[ed2k=(.*?)\](.*?)\[\/ed2k\]/si","<a class=\"small\"  href=\"$1\" target=\"blank\">$2</a>",$a);	
	
	$a=preg_replace("/\[center\](.*?)\[\/center\]/si", "<div align=\"center\">$1</div>", $a);
	$a=preg_replace("/\[size=([1-2]?[0-9])\](.*?)\[\/size\]/si", "<span style=\"font-size=$1px;\">$2</span>", $a);
	$a=preg_replace("/\[size=([1-2]?[0-9]):(.*?)\](.*?)\[\/size(.*?)\]/si", "<span style=\"font-size=$1px;\">$3</span>", $a);
	$a=preg_replace("/\[font=(.*?)\](.*?)\[\/font\]/si", "<span style=\"font-family:$1;\">$2</span>", $a);
	$a=preg_replace("/\[color=(.*?)\](.*?)\[\/color\]/si", "<span style=\"color=$1;\">$2</span>", $a);
	$a=preg_replace("/\[color=(.*?):(.*?)\](.*?)\[\/color(.*?)\]/si", "<span style=\"color=$1;\">$3</span>", $a);
	$a=preg_replace("/\[img\](.*?)\[\/img\]/si", "<img src=\"$1\" vspace=4 hspace=4>", $a);
	$a=preg_replace("/\[b\](.*?)\[\/b\]/si", "<strong>$1</strong>", $a);
	$a=preg_replace("/\[b(.*?)\](.*?)\[\/b(.*?)\]/si", "<strong>$2</strong>", $a);
	$a=preg_replace("/\[u\](.*?)\[\/u\]/si", "<u>$1</u>", $a);
	$a=preg_replace("/\[u(.*?)\](.*?)\[\/u(.*?)\]/si", "<u>$2</u>", $a);
	$a=preg_replace("/\[i\](.*?)\[\/i\]/si", "<em>$1</em>", $a);
	$a=preg_replace("/\[i(.*?)\](.*?)\[\/i(.*?)\]/si", "<em>$2</em>", $a);
	$a=preg_replace("/\[quote\](.*?)\[\/quote\]/si", "<p align=\"left\" style=\"border: 2px solid silver;padding:4px;\">$1</p>", $a);
	$a=preg_replace("/\[quote:(.*?)\](.*?)\[\/quote(.*?)\]/si", "<p align=\"left\" style=\"border: 2px solid silver;padding:4px;\">$2</p>", $a);
	$a=preg_replace("/\[code:(.*?)\](.*?)\[\/code(.*?)\]/si", "<p align=\"left\" style=\"border: 2px solid red;color:green;padding:4px;\">$2</p>", $a);
	$a=preg_replace("/\[hide\](.*?)\[\/hide\]/si", "<div style=\"background-color:#ccffcc;\">$1</div>", $a);
	
	$a=preg_replace("/[[:space:]]http:\/\/(.*?)[[:space:]]/si","<a class=\"small\" href=\"http://$1\" target=\"blank\">$1</a>",$a);	
	
	
	
	
	return $tag_start.$a.$tag_end;
	
}

function ExtractTablename($q)
{
	$offset=0;
	$p=strtoupper($q);
	$i=strpos($p,"FROM")+5;
	$p=substr($p,$i);
	if(substr($p,0,1)=="("){
		$offset=2;
		echo "$offset<br>";
	}
	if(strpos($p," ",$offset)) {
		$j=strpos($p," ",$offset);
		$p=substr($p,$offset,$j);
	}
	$t=substr($q,$i+$offset,strlen($p)-$offset);
	if(substr($t,-1)==",") {
		//Achtung, keine eindeutige Tabelle
		$t='';
	}
	if(substr($t,0,1)=="`" && substr($t,-1)=="`") $t=substr($t,1,strlen($t)-2);
	return $t;	
}

function GetOptionsCombo($arr,$default)
{
	global $feldtypen,$feldattribute,$feldnull,$feldextras,$feldkeys,$feldrowformat;
	$r="";
	foreach ($arr as $s) {
		$r.='<option value="'.$s.'" '.((strtoupper($default)==strtoupper($s)) ? "selected" : "" ).'>'.$s.'</option>'."\n";
	}
	return $r;
}


function FillFieldinfos($db,$tabelle)
{
	global $config;
	
	$fields_infos=Array();
	
	$t=GetCreateTable($db,$tabelle);
	$sqlf="SHOW FULL FIELDS FROM `$db`.`$tabelle`;";
	$res=MSD_query($sqlf) or die(SQLError($sqlf,mysql_error()));
	$anz_fields=mysql_num_rows($res);
	
	for($i=0;$i<$anz_fields;$i++) {
		$row=mysql_fetch_array($res);
		if(MSD_NEW_VERSION) $fields_infos[$i]["collate"]=$row["Collation"];
		if(MSD_NEW_VERSION) $fields_infos[$i]["comment"]=$row["Comment"];
		$fields_infos[$i]["privileges"]=$row["Privileges"];
	}
	$fields_infos["_primarykey_"]="";
	$flds=$keys=$ukeys=$fkeys=0;
	$fields_infos["_createtable_"]=$t;
	$tmp=explode("\n",$t);
	for($i=1;$i<count($tmp)-1;$i++) {
		$t=trim($tmp[$i]);
		if(substr($t,-1)==",") $t=substr($t,0,strlen($t)-1);
		//echo $t."<br>";
		 
		if(substr($t,0,12)=="PRIMARY KEY ") {
			$t=str_replace("`","",$t);
			$fields_infos["_primarykey_"]=substr($t,strpos($t,"(")+1,strpos($t,")")-strpos($t,"(")-1);
		} elseif (substr($t,0,4)=="KEY ") {
			$t=str_replace("`","",$t);
			$att=explode(" ",$t);
			$fields_infos["_key_"][$keys]["name"]=$att[1];
			$att[2]=str_replace("(","",$att[2]);
			$att[2]=str_replace(")","",$att[2]);
			$fields_infos["_key_"][$keys]["columns"]=$att[2];
			$keys++;
		} elseif (substr($t,0,11)=="UNIQUE KEY ") {
			$t=str_replace("`","",$t);
			$att=explode(" ",$t);
			$fields_infos["_uniquekey_"][$ukeys]["name"]=$att[2];
			$att[3]=str_replace("(","",$att[3]);
			$att[3]=str_replace(")","",$att[3]);
			$fields_infos["_uniquekey_"][$ukeys]["columns"]=$att[3];
			$ukeys++;
		} elseif (substr($t,0,13)=="FULLTEXT KEY ") {
			$t=str_replace("`","",$t);
			$att=explode(" ",$t);
			$fields_infos["_fulltextkey_"][$fkeys]["name"]=$att[2];
			$att[3]=str_replace("(","",$att[3]);
			$att[3]=str_replace(")","",$att[3]);
			$fields_infos["_fulltextkey_"][$fkeys]["columns"]=$att[3];
			$fkeys++;
		} else {
			
			$att=explode(" ",$t);
			
			if(substr($att[0],0,1)=="`" && substr($att[0],-1)=="`") {
				$fields_infos[$flds]["name"]=str_replace("`","",$att[0]);
				$s=1;
			} else {
				$fields_infos[$flds]["name"]=str_replace("`","",$att[0])." ";
				for($ii=1;$i<count($att);$i++) {
					if(substr($att[$ii],-1)!="`") {
						$fields_infos[$flds]["name"].=$att[$ii];
					} else {
						$fields_infos[$flds]["name"].=str_replace("`","",$att[$ii]);
						$s=$ii+1;
						break;
					}
				}
			}
			
			$fields_infos[$flds]["type"]=(strpos($att[$s],"(")) ? substr($att[$s],0,strpos($att[$s],"(")) : $att[$s];
			$fields_infos[$flds]["size"]=(strpos($att[$s],"(")) ? substr($att[$s],strpos($att[$s],"(")+1,strpos($att[$s],")")-strpos($att[$s],"(")-1) : "";
			$fields_infos[$flds]["default"]="";
			$fields_infos[$flds]["null"]="";
			$fields_infos[$flds]["extra"]="";
			$fields_infos[$flds]["attribut"]="";
			
			$s++;
			while($s<count($att)) {
				if(isset($att[$s+1]) && strtolower($att[$s].$att[$s+1])=="unsignedzerofill") {
					$fields_infos[$flds]["attribut"]="unsigned zerofill";
					$s+=2;
				} elseif(strtolower($att[$s])=="unsigned") {
					$fields_infos[$flds]["attribut"]="unsigned";
					$s++;
				} elseif(isset($att[$s+1]) && strtolower($att[$s].$att[$s+1])=="notnull") {
					$fields_infos[$flds]["null"]="NOT NULL";
					$s+=2;
				}  elseif(strtolower($att[$s])=="null") {
					$fields_infos[$flds]["null"]="NULL";
					$s++;
				}  elseif(strtolower($att[$s])=="auto_increment") {
					$fields_infos[$flds]["extra"]="auto_increment";
					$s++;
				}  elseif(strtolower($att[$s])=="collate") {
					$fields_infos[$flds]["collate"]=$att[$s+1];
					$s+=2;
				}  elseif(strtolower($att[$s])=="character") {
					$fields_infos[$flds]["character set"]=$att[$s+2];
					$s+=3;
				}  elseif(strtolower($att[$s])=="default") {
					//if(strpos(strtolower($fields_infos[$flds]["type"]),"text")===false && strtolower($fields_infos[$flds]["type"])!="varchar")
					$d="";$ii=$s+1;
					if(substr($att[$ii],0,1)=="'" && substr($att[$ii],-1)=="'") {
						$fields_infos[$flds]["default"]=$att[$ii];
						$s+=2;
					} else {
						if(substr($att[$ii],0,1)=="'") {
							$fields_infos[$flds]["default"]=$att[$ii]." ".$att[$ii+1];
							$s+=3;
						} else {
							$fields_infos[$flds]["default"]=$att[$ii];
							$s+=2;
						}
					}
				} else {
					//echo "not identified: $att[$s]<br>";
					$s++;
				}
			}
			
			$flds++;
		}
	}
	//echo substr($tmp[count($tmp)-1],2)."<br>";
	$ext=explode(" ",substr($tmp[count($tmp)-1],2));
	$s="";$haltchar="=";	
	for($i=0;$i<count($ext);$i++) {
		if(!strpos($ext[$i],$haltchar)) {
			$s.=$ext[$i]." ";
		} else {
			if($haltchar=="'") {
				$fields_infos["_tableinfo_"]["COMMENT"]=$s.$ext[$i];
				$s="";$haltchar="=";
			} else {
				$s.=substr($ext[$i],0,strpos($ext[$i],$haltchar));
				if(strtoupper($s)=="COMMENT") {
					$s=substr($ext[$i],strpos($ext[$i],$haltchar)+1);
					if(substr($s,-1)=="'") {
						$fields_infos["_tableinfo_"]["COMMENT"]=$s;
						$s="";
					} else {
						$s.=" ";
						$haltchar="'";
				    }
				} else {
					$fields_infos["_tableinfo_"][strtoupper($s)]=substr($ext[$i],strpos($ext[$i],$haltchar)+1);
					$s="";
				}
			}
		}
	}
	return $fields_infos;
}

function ChangeKeys($ok,$nk,$fld,$size,$restriction="")
{
	if($ok[0]==$nk[0] && $ok[1]==$nk[1] && $ok[2]==$nk[2] && $ok[3]==$nk[3])
		return "";
	else {
		$s=""; //"$ok[0] | $ok[1] | $ok[2] | $ok[3] *** $nk[0] | $nk[1] |$nk[2] | $nk[3]<br>";
			
		if($ok[0]==0 && $nk[0]==1) {
			if($restriction!="drop_only") $s.="ADD PRIMARY KEY (`$fld`), ";
		} elseif ($ok[0]==1 && $nk[0]==0) {	
			$s.="DROP PRIMARY KEY, "; 
		}
		if($ok[1]==0 && $nk[1]==1) {
			if($restriction!="drop_only") $s.="ADD UNIQUE INDEX `$fld` (`$fld`), ";
		} elseif ($ok[1]==1 && $nk[1]==0) {	
			$s.="DROP INDEX `$fld`, "; 
		}	
		if($ok[2]==0 && $nk[2]==1) {
			if($restriction!="drop_only") $s.="ADD INDEX `$fld` (`$fld`), ";
		} elseif ($ok[2]==1 && $nk[2]==0) {	
			$s.="DROP INDEX `$fld`, "; 
		}
		if($ok[3]==0 && $nk[3]==1) {
			if($restriction!="drop_only") $s.="ADD FULLTEXT INDEX `$fld` (`$fld`($size)), ";
		} elseif ($ok[3]==1 && $nk[3]==0) {	
			$s.="DROP FULLTEXT INDEX `$fld`, "; 
		}
	}
	if($s!="") $s=substr($s,0,strlen($s)-2);
	return $s;
}

function CheckCSVOptions()
{
	global $sql;
	if(!isset($sql["export"]["trenn"])) $sql["export"]["trenn"]=";";
	if(!isset($sql["export"]["enc"])) $sql["export"]["enc"]="\"";
	if(!isset($sql["export"]["esc"])) $sql["export"]["esc"]="\\";
	if(!isset($sql["export"]["ztrenn"])) $sql["export"]["ztrenn"]="\\r\\n";
	if(!isset($sql["export"]["null"])) $sql["export"]["null"]="NULL";
	if(!isset($sql["export"]["namefirstline"])) $sql["export"]["namefirstline"]=0;
	if(!isset($sql["export"]["format"])) $sql["export"]["format"]=0;
	if(!isset($sql["export"]["sendfile"])) $sql["export"]["sendfile"]=0;
	if(!isset($sql["export"]["tables"])) $sql["export"]["tables"]=Array();
	if(!isset($sql["export"]["compressed"])) $sql["export"]["compressed"]=0;
	
	if(!isset($sql["import"]["trenn"])) $sql["import"]["trenn"]=";";
	if(!isset($sql["import"]["enc"])) $sql["import"]["enc"]="\"";
	if(!isset($sql["import"]["esc"])) $sql["import"]["esc"]="\\";
	if(!isset($sql["import"]["ztrenn"])) $sql["import"]["ztrenn"]="\\r\\n";
	if(!isset($sql["import"]["null"])) $sql["import"]["null"]="NULL";
	if(!isset($sql["import"]["namefirstline"])) $sql["import"]["namefirstline"]=0;
	if(!isset($sql["import"]["format"])) $sql["import"]["format"]=0;
	
}	

function ExportCSV() {
	global $sql,$config;
	$t="";
	$time_start = time();
	if(!isset($config["dbconnection"])) MSD_mysql_connect(); 
	for($table=0;$table<count($sql["export"]["tables"]);$table++) {
		$sqlt="SHOW Fields FROM `".$sql["export"]["db"]."`.`".$sql["export"]["tables"][$table]."`;";
		$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
		if($res) {
			$numfields=mysql_numrows($res);
			if($sql["export"]["namefirstline"]==1) {
				for($feld=0;$feld<$numfields;$feld++) {
					$row=mysql_fetch_row($res);
					if($sql["export"]["enc"]!="") 
						$t.=$sql["export"]["enc"].$row[0].$sql["export"]["enc"].(($feld+1<$numfields) ? $sql["export"]["trenn"] : '');
					else
						$t.=$row[0].(($feld+1<$numfields) ? $sql["export"]["trenn"] : '');
				}
				$t.=$sql["export"]["endline"];
				$sql["export"]["lines"]++;
			}
		}
		$sqlt="SELECT * FROM `".$sql["export"]["db"]."`.`".$sql["export"]["tables"][$table]."`;";
		$res=MSD_query($sqlt) or die(SQLError($sqlt,mysql_error()));
		if($res) {
			$numrows=mysql_numrows($res);
			for($data=0;$data<$numrows;$data++) {
				$row=mysql_fetch_row($res);
				for($feld=0;$feld<$numfields;$feld++) {
					if(!isset($row[$feld]) || is_null($row[$feld])) {
						$t.=$sql["export"]["null"];
					} elseif($row[$feld]=='0' || $row[$feld]!='') {
						if($sql["export"]["enc"]!="") 
							$t.=$sql["export"]["enc"].str_replace($sql["export"]["enc"],$sql["export"]["esc"].$sql["export"]["enc"],$row[$feld]).$sql["export"]["enc"];
						else
							$t.=$row[$feld];
					} else {
						$t.='';
					}
					$t.=($feld+1<$numfields) ? $sql["export"]["trenn"] : '';
				}
				$t.=$sql["export"]["endline"];
				$sql["export"]["lines"]++;
				if(strlen($t)>$config["memory_limit"]) {
					CSVOutput($t);
					$t="";
				}
				$time_now = time();
            	if ($time_start >= $time_now + 30) {
                	$time_start = $time_now;
                	header('X-MSDPing: Pong');
            	}
			}
		}
	}
	CSVOutput($t,1);
}

function CSVOutput($str,$last=0) 
{
	global $sql,$config;
	if($sql["export"]["sendfile"]==0) {
		//Display
		echo $str;
	} else {
		if($sql["export"]["header_sent"]=="") {
			if($sql["export"]["compressed"]==1 & !function_exists('gzencode')) $sql["export"]["compressed"]=0;
			$file=$sql["export"]["db"].(($sql["export"]["compressed"]==1) ? ".csv.gz" : ".csv");
			$mime=($sql["export"]["compressed"]==0) ? "text/x-csv" : "application/x-gzip";
			header('Content-Type: '.$mime);
        	header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	        if (MSD_BROWSER_AGENT == 'IE') {
	            header('Content-Disposition: inline; filename="' . $file . '"');
	            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	            header('Pragma: public');
	        } else {
	            header('Content-Disposition: attachment; filename="' . $file . '"');
	            header('Pragma: no-cache');
	        }
			$sql["export"]["header_sent"]=="1";
		}
		if($sql["export"]["compressed"]==1) 
			echo gzencode($str);
		else
			echo $str;
		
	}	
}

function DoImport() {
	global $sql,$lang;
	$r='<span class="swarnung">';
	$zeilen=count($sql["import"]["csv"])-$sql["import"]["namefirstline"];
	$sql["import"]["first_zeile"]=explode($sql["import"]["trenn"],$sql["import"]["csv"][0]);
	$importfelder=count($sql["import"]["first_zeile"]);
	
	if($sql["import"]["tablecreate"]==0) {
		$res=MSD_query("show fields FROM ".$sql["import"]["table"]);
		$tabellenfelder=mysql_num_rows($res);
		if($importfelder!=$tabellenfelder) {
			$r.='<br>'.sprintf($lang["csv_fieldcount_nomatch"],$tabellenfelder,$importfelder);
		} else {
			$ok=GetImportFields();
		}
	} else {
		$ok=ImportCreateTable();
		if($ok==0) {
			$r.='<br>'.sprintf($lang["csv_errorcreatetable"],$sql["import"]["table"]);
		} 
	}	
	if($ok==1) {
		$insert="";
		if($sql["import"]["emptydb"]==1 && $sql["import"]["tablecreate"]==0) {
			MSD_DoSQL("TRUNCATE ".$sql["import"]["table"].";");
		}
		$sql["import"]["lines_imported"]=0;
		for($i=$sql["import"]["namefirstline"];$i<$zeilen+$sql["import"]["namefirstline"];$i++) {
			//Importieren
			$insert="INSERT INTO ".$sql["import"]["table"]." VALUES(";
			if($sql["import"]["createindex"]==1) $insert .="'', ";
			$zc=trim(rtrim($sql["import"]["csv"][$i]));
			if($zc!="") {
				$zeile=explode($sql["import"]["trenn"],$zc);
				$enc=($sql["import"]["enc"]=="") ? "'" : "";
				for($j=0;$j<$importfelder;$j++) {
					$a=($zeile[$j]=="" && $enc=="") ? $zeile[$j] : "''";
					$insert.=$enc.$a.$enc.(($j==$importfelder-1) ? ");\n" : ",");
				}
				MSD_DoSQL($insert);
				$sql["import"]["lines_imported"]++;
			}
		}
		$r.=sprintf($lang["csv_fieldslines"],$importfelder,$sql["import"]["lines_imported"]);
	}
	
	$r.='</span>';
	return $r;
	
}

function ImportCreateTable() {
	global $sql,$lang,$db,$config;
	$tbl=Array();
	$tabellen = mysql_list_tables($db,$config["dbconnection"]); 
	$num_tables = mysql_num_rows($tabellen); 
	for($i=0;$i<$num_tables;$i++) {
		$tbl[]=strtolower(mysql_tablename($tabellen,$i));
	}
	$i=0;
	$sql["import"]["table"]=$sql["import"]["table"].$i;
	while(in_array($sql["import"]["table"],$tbl)) { 
		$sql["import"]["table"]=substr($sql["import"]["table"],0,strlen($sql["import"]["table"])-1).++$i; 
	}
	$create="CREATE TABLE `".$sql["import"]["table"]."` (".(($sql["import"]["createindex"]==1) ? '`import_id` int(11) unsigned NOT NULL auto_increment, ' : '');
	if($sql["import"]["namefirstline"]) {
		for($i=0;$i<count($sql["import"]["first_zeile"]);$i++) {
			$create.='`'.$sql["import"]["first_zeile"][$i].'` VARCHAR(250) NOT NULL, ';
		}
	} else {
		for($i=0;$i<count($sql["import"]["first_zeile"]);$i++) {
			$create.='`FIELD_'.$i.'` VARCHAR(250) NOT NULL, ';
		}
	}
	if($sql["import"]["createindex"]==1)
		$create.='PRIMARY KEY (`import_id`) ';
	else
		$create=substr($create,0,strlen($create)-2);
	
	$create.=') '.((MSD_NEW_VERSION) ? 'ENGINE' : 'TYPE')."=MyISAM COMMENT='imported at ".date("l dS of F Y h:i:s A")."'";
	$res=mysql_query($create,$config["dbconnection"]) || die(SQLError($create,mysql_error()));
	return 1;
}

function GetImportFields() {
	global $sql,$lang;
	
}
?>