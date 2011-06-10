<?php

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
			$s.='<option value=\''.stripslashes(SQL_String($i)).'\'>'.SQL_Name($i).'</option>'.$nl;
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
	$s=$nl.$nl.'<select class="SQLCombo" name="tablecombo" onchange="this.form.tb_sql.value=this.options[this.selectedIndex].value;">'.$nl.'<option value="" selected>                 </option>'.$nl;
	for($i=0;$i<$num_tables;$i++) {
		$t=mysql_tablename($tabellen,$i);
		$s.='<option value="SELECT * FROM `'.$t.'`">'.$lang['table'].' `'.$t.'`</option>'.$nl;
	}
	$s.='</select>'.$nl.$nl;
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
	$allSQL=explode("\n",$sqlcommands);
	$sql_queries=count($allSQL);
	if(!isset($allSQL[$sql_queries-1])) $sql_queries--;
	if($sql_queries==1) {
		SQLParser($allSQL[0]);
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
					$result =MSD_query($sqlcommand) or die(SQLError($sqlcommand,mysql_error()));
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
	
	//Was ist das für eine Anfrage ?
	if(substr($s,0,1)=="#" || substr($s,0,2)=="--") {
		$sql["parser"]["comment"]++;
	} elseif(substr($s,0,5)=="DROP ") {
		$sql["parser"]["drop"]++;
	} elseif(substr($s,0,7)=="CREATE ") {
		//Hier nur die Anzahl der Klammern zählen
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
			//Ticks + Dashes zählen
			for($cpos=2;$cpos<=strlen($v);$cpos++)
			{if(substr($v,(-1*$cpos),1)=="'") {$B_Ticks++;} else {break;}}
			for($cpos=2;$cpos<=strlen($v);$cpos++)
			{if(substr($v,(-1*$cpos),1)=='"') {$B_Dashes++;} else {break;}}
			
			//Backslashes zählen
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
	global $SQL_ARRAY,$nl,$databases;
	
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
			$s=SQL_String($i);
			$r.='<option value=\''.stripslashes($s).'\' '.(($csql==stripslashes($s)) ? "selected" : "").'>'.SQL_Name($i).'</option>'.$nl;
		}
	}
	
	$r.='</select>';
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

function CollationCombo($default="")
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
			$s.='<option value="'.$r[$i]["Collation"].'" '.(($r[$i]["Collation"]==$default) ? "selected" : "").'>'.$r[$i]["Collation"].'</option>';
		}
		return $s; 
	}
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

function DefaultFieldVals()
{
	$dfv=Array();
	$dfv["VARCHAR"]["defaultsize"]=255;
	$dfv["VARCHAR"]["maxsize"]=255;
	
	$dfv["TINYINT"]["defaultsize"]=255;
	$dfv["TINYINT"]["maxsize"]=255; 
	
	$dfv["TEXT"]["defaultsize"]="";
	$dfv["TEXT"]["maxsize"]=65535; 
	
	
	$dfv["DATE"]["defaultsize"]=255;
	$dfv["DATE"]["maxsize"]=255; 
	
	$dfv["SMALLINT"]["defaultsize"]=255;
	$dfv["SMALLINT"]["maxsize"]=255; 
	
	$dfv["MEDIUMINT"]["defaultsize"]=255;
	$dfv["MEDIUMINT"]["maxsize"]=255; 
	
	$dfv["INT"]["defaultsize"]=11;
	$dfv["INT"]["maxsize"]=16; 
	
	$dfv["BIGINT"]["defaultsize"]=255;
	$dfv["BIGINT"]["maxsize"]=255; 
	
	$dfv["FLOAT"]["defaultsize"]=255;
	$dfv["FLOAT"]["maxsize"]=255; 
	
	$dfv["DOUBLE"]["defaultsize"]=255;
	$dfv["DOUBLE"]["maxsize"]=255; 
	
	$dfv["DECIMAL"]["defaultsize"]=255;
	$dfv["DECIMAL"]["maxsize"]=255; 
	
	$dfv["DATETIME"]["defaultsize"]=255;
	$dfv["DATETIME"]["maxsize"]=255; 
	
	$dfv["TIMESTAMP"]["defaultsize"]=255;
	$dfv["TIMESTAMP"]["maxsize"]=255; 
	
	$dfv["TIME"]["defaultsize"]=255;
	$dfv["TIME"]["maxsize"]=255; 
	
	$dfv["YEAR"]["defaultsize"]=255;
	$dfv["YEAR"]["maxsize"]=255; 
	
	$dfv["CHAR"]["defaultsize"]=255;
	$dfv["CHAR"]["maxsize"]=255; 
	
	$dfv["TINYBLOB"]["defaultsize"]=255;
	$dfv["TINYBLOB"]["maxsize"]=255; 
	
	$dfv["TINYTEXT"]["defaultsize"]=255;
	$dfv["TINYTEXT"]["maxsize"]=255; 
	
	$dfv["BLOB"]["defaultsize"]=255;
	$dfv["BLOB"]["maxsize"]=255; 
	
	$dfv["MEDIUMBLOB"]["defaultsize"]=255;
	$dfv["MEDIUMBLOB"]["maxsize"]=255; 
	
	$dfv["MEDIUMTEXT"]["defaultsize"]=255;
	$dfv["MEDIUMTEXT"]["maxsize"]=255; 
	
	$dfv["LONGBLOB"]["defaultsize"]=255;
	$dfv["LONGBLOB"]["maxsize"]=255; 
	
	$dfv["LONGTEXT"]["defaultsize"]=255;
	$dfv["LONGTEXT"]["maxsize"]=255; 
	
	$dfv["ENUM"]["defaultsize"]=255;
	$dfv["ENUM"]["maxsize"]=255; 
	
	$dfv["SET"]["defaultsize"]=255;
	$dfv["SET"]["maxsize"]=255; 
	
	return $dfv;
}
function FillFieldinfos($db,$tabelle)
{
	global $config;
	
	$t=GetCreateTable($db,$tabelle);
	$fields_infos=Array();
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
			$fields_infos[$flds]["atrribut"]="";
			$fields_infos[$flds]["collate"]="";
			$s++;
			while($s<count($att)) {
				if(isset($att[$s+1]) && strtolower($att[$s].$att[$s+1])=="unsignedzerofill") {
					$fields_infos[$flds]["extra"]="unsigned zerofill";
					$s+=2;
				} elseif(strtolower($att[$s])=="unsigned") {
					$fields_infos[$flds]["atrribut"]="unsigned";
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
					echo "not identified: $att[$s]<br>";
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

function ChangeKeys($ok,$nk,$fld,$size)
{
	if($ok[0]==$nk[0] && $ok[1]==$nk[1] && $ok[2]==$nk[2] && $ok[3]==$nk[3])
		return "";
	else {
		$s=""; //"$ok[0] | $ok[1] | $ok[2] | $ok[3] *** $nk[0] | $nk[1] |$nk[2] | $nk[3]<br>";
			
		if($ok[0]==0 && $nk[0]==1) {
			$s.="ADD PRIMARY KEY (`$fld`), ";
		} elseif ($ok[0]==1 && $nk[0]==0) {	
			$s.="DROP PRIMARY KEY, "; 
		}
		if($ok[1]==0 && $nk[1]==1) {
			$s.="ADD UNIQUE INDEX `$fld` (`$fld`), ";
		} elseif ($ok[1]==1 && $nk[1]==0) {	
			$s.="DROP INDEX `$fld`, "; 
		}	
		if($ok[2]==0 && $nk[2]==1) {
			$s.="ADD INDEX `$fld` (`$fld`), ";
		} elseif ($ok[2]==1 && $nk[2]==0) {	
			$s.="DROP INDEX `$fld`, "; 
		}
		if($ok[3]==0 && $nk[3]==1) {
			$s.="ADD FULLTEXT INDEX `$fld` (`$fld`($size)), ";
		} elseif ($ok[3]==1 && $nk[3]==0) {	
			$s.="DROP FULLTEXT INDEX `$fld`, "; 
		}
	}
	if($s!="") $s=substr($s,0,strlen($s)-2);
	return $s;
}
?>