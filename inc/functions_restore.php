<?php
include_once("inc/functions_global.php");
include_once("inc/runtime.php");

function get_sqlbefehl()
{
	global $restore,$config,$databases;
	
	//Init
	$restore["fileEOF"]=false;
	$complete_sql="";
	$sqlparser_status=0;
	if(!isset($restore["eintraege_ready"])) $restore["eintraege_ready"]=0;
	//Parsen
	WHILE ($sqlparser_status!=100 && !$restore["fileEOF"] && !isset($restore["EOB"]) )
	{
		//Zeile lesen
		$zeile= ($restore["compressed"]) ? gzgets($restore["filehandle"]) : fgets($restore["filehandle"]); 
		if($sqlparser_status==0) 
		{
			//hier folgt der Anfang eines SQL-Befehls
			if(substr($zeile,0,1)=="#" or substr($zeile,0,2)=="--")
			{
				// Ende ?
				if(substr($zeile,0,6)=="-- EOB" || substr($zeile,0,5)=="# EOB") {
					$restore["EOB"]=1;
				}
				//Kommentar
				$zeile="";
				
			} 
			else 
			{
				// was beginnt hier ?
				if(strtoupper(substr($zeile,0,10))=="DROP TABLE")
				{
					$sqlparser_status=1; //Löschaktion
					//Neue Tabelle beginnt - überprüfen, obs gewünscht ist
					$restore["do_it"]=false;
					//prüfen ob gewünscht
					if(isset($tbl_sel)) 
					{
						if(in_array($tbl_name,$tblArray)) $restore["do_it"]=true; 
					} 
					else  
					{
						$restore["do_it"]=true; 
					}
				}
				
				if(strtoupper(substr($zeile,0,12))=="CREATE TABLE") $sqlparser_status=2; //Createaktion
				if(strtoupper(substr($zeile,0,12))=="CREATE INDEX") $sqlparser_status=4; //Createaktion
				if(substr($zeile,0,3)=="/*!") $sqlparser_status=5; //Anweisung
				if(strtoupper(substr($zeile,0,11))=="LOCK TABLES") $sqlparser_status=5; //Anweisung
				if(strtoupper(substr($zeile,0,13))=="UNLOCK TABLES") $sqlparser_status=5; //Anweisung
				if(strtoupper(substr($zeile,0,6))=="INSERT" || ($restore["erweiterte_inserts"]==1 && substr($zeile,0,1)=="("))
				{
					$sqlparser_status=3; //Datensatzaktion
					$restore["eintraege_ready"]++;
					if($restore["erweiterte_inserts"]==0 || ($restore["erweiterte_inserts"]==1 && strtoupper(substr($zeile,0,11))=="INSERT INTO")) {
						$restore["actual_table"]=strtolower(get_tablename_aus_insert($zeile)); // aktuellen Tabellennamen aus der INSERT-Anweisung extrahieren
						if(!isset($restore["num_table_fields"][$restore["actual_table"]])) {
							$restore["num_table_fields"][$restore["actual_table"]]=$restore["actual_fieldcount"];
						}
					} 
				}
			}
		}
		
		$last_char=substr(rtrim($zeile),-1);
		$complete_sql.=$zeile;
		$complete_sql=trim(rtrim($complete_sql));
					
		if($sqlparser_status==1) 
		{ //Löschaktion
			if($last_char==";" ) $sqlparser_status=100;	//Befehl komplett
		}
			
		if($sqlparser_status==2) 
		{ //Createaktion
			if($last_char==";" ) 
			{
					if($config["minspeed"]>0) {$restore["anzahl_zeilen"]=$config["minspeed"];}
					$restore["actual_table"]=strtolower(get_tablename($complete_sql));
					//Tabellenfelderanzahl ermitteln
					$restore["actual_fieldcount"]=AnzahlTabellenfelder($complete_sql);
					$restore["num_table_fields"][$restore["actual_table"]]=$restore["actual_fieldcount"];
					//DEFAULT CHARSET HACK
					if((GetMySQLVersion()-4.1)<0) {
						$ll=strpos(strtoupper($complete_sql)," DEFAULT CHARSET");  
						if($ll) {
							$ll2=strpos($complete_sql," ",$ll+12);
							if($ll2)
								$complete_sql=substr($complete_sql,0,$ll).substr($complete_sql,$ll2);
							else
								$complete_sql=substr($complete_sql,0,$ll).';';
						}
					}
					//Hack für Import MySQL>4.1 auf kleineren Versionen
					$complete_sql=DownGrade($complete_sql);
					
					$restore["table_create"][$restore["actual_table"]]=$complete_sql;
					$sqlparser_status=100;	//Befehl komplett
			}
		}	
		
		if($sqlparser_status==3) 
		{ //Datensatzaktion
			if(!isset($restore["num_table_fields"][$restore["actual_table"]])) 
				$restore["num_table_fields"][$restore["actual_table"]]=$restore["actual_fieldcount"];
			
			if($zeile!="" && (substr(rtrim($zeile),-2)==");" || substr(rtrim($zeile),-2)=="),"))
			{
				if($restore["flag"]==-1 && substr(rtrim($zeile),-2)=="),") {
					$restore["erweiterte_inserts"]=1;
					$restore["flag"]=1;
				} elseif($restore["flag"]==-1 && substr(rtrim($zeile),-2)==");") {
					$restore["flag"]=0;
				}
				//scheinbar ein Ende erreicht
				$AnzahlFelder=SQL_Is_Complete($complete_sql,$restore["num_table_fields"][$restore["actual_table"]]);
				if($AnzahlFelder==$restore["num_table_fields"][$restore["actual_table"]])
				{
					$sqlparser_status=100;
					if(substr(rtrim($zeile),-2)==")," || ($restore["erweiterte_inserts"]==1 && substr(rtrim($zeile),-2)==");")) {
						if($complete_sql!="" && substr($complete_sql,0,1)=="(") {
							$complete_sql="INSERT INTO `".$restore["actual_table"]."` VALUES ".$complete_sql;
						}
						if(substr($complete_sql,-1)==",") $complete_sql=substr($complete_sql,0,strlen($complete_sql)-1);
					}
						
				}
				if($AnzahlFelder>$restore["num_table_fields"][$restore["actual_table"]] && $restore["erweiterte_inserts"]==0) 
				{
					if(!isset($restore["table_create"][$restore["actual_table"]])) {
						include("inc/functions_sql.php");
						$restore["table_create"][$restore["actual_table"]]=GetCreateTable($databases["db_actual"],$restore["actual_table"]);
					}
					echo '<form action="main.php?action=extinfo" method="post">';
					echo '<p class="warnung">Parser-Fehler : zuviele gezählt in Tabelle '.$restore["actual_table"].' ('.$AnzahlFelder.' statt '.$restore["num_table_fields"][$restore["actual_table"]].')';
					echo '<h4>CREATE-Anweisung</h4><textarea name="create_sql" style="width:90%;height:200px;">'.$restore["table_create"][$restore["actual_table"]].'</textarea>';
					echo '<h4>INSERT-Anweisung</h4><textarea name="insert_sql" style="width:90%;height:200px;">'.$complete_sql.'</textarea></p><br>';
					echo '<br><br><input type="submit" name="tell_error" value="Fehlerbericht"></form>'.$zeile;
					die;
				}
			}
		}
		if($sqlparser_status==4) 
		{ //Createindex
			if($last_char==";" ) 
			{
					if($config["minspeed"]>0) {$restore["anzahl_zeilen"]=$config["minspeed"];}
					$sqlparser_status=100;	//Befehl komplett
			} 
		}		
		if($sqlparser_status==5) 
		{ //Anweisung
			if($last_char==";" ) 
			{
					if($config["minspeed"]>0) {$restore["anzahl_zeilen"]=$config["minspeed"];}
					$sqlparser_status=100;	//Befehl komplett
			} 
		}		
		
		if ( ($restore["compressed"]) && (gzeof($restore["filehandle"])) ) $restore["fileEOF"]=true;
		if ( (!$restore["compressed"]) && (feof($restore["filehandle"])) ) $restore["fileEOF"]=true;
		
		
	}
	
	return $complete_sql ;
}

function lock_table()
{
	global $config,$restore;
	if ($config["lock_tables"]==1 &&  (isset($restore["actual_table"])) && ($restore["actual_table"]<>"unbekannt") )
	{
		$sql="LOCK TABLES `".$restore["actual_table"]."` WRITE";
		$res=MSD_query($sql) || die(SQLError("Kein Lock ausgeführt!",mysql_error()));
	}
}

// extrahiert auf einfache Art den Tabellennamen aus dem "Create"-Befehl
function get_tablename($t)
{
	global $restore;
	$t=trim(str_replace("CREATE TABLE","",strtoupper($t)));
	$t=trim(str_replace("("," ",$t));
	$w=explode(" ",$t);
	$tn=$w[0];
	$restore["table_ready"]++;
	if(substr($tn,0,1)=="`") $tn=substr($tn,1,strlen($tn)-2);
	return $tn;
}

// extrahiert auf einfache Art den Tabellennamen aus dem "Create"-Befehl
function get_tablename_aus_insert($t)
{
	$t=substr(strtolower($t),strpos(strtolower($t), "into ")+5);
	$w=explode(" ",$t);
	$tn=$w[0];
	if(substr($tn,0,1)=="`") $tn=substr($tn,1,strlen($tn)-2);
	return $tn;
}

function AnzahlTabellenfelder($s,$debug=0)
{
	// ermittelt die Anzahl der Spalten einer Tabelle aus einer CREATE-Anweisung
	$anz=$anz_delimter=$rit=$klammerstart=$klammerauf=$klammerzu=0;
	$s=strtoupper($s);
	$i=strpos($s,"(")+1;
	$s=substr($s,$i);
	$tb=explode(",",$s);
	
	$defaultstart=false;
	for ($i=0;$i<count($tb);$i++){
		$tb[$i]=trim($tb[$i]);
		$klammerstart+=substr_count($tb[$i], "(")-substr_count($tb[$i], ")");
		if($i==count($tb)-1) $klammerstart+=1;
		$anz_delimter+=substr_count($tb[$i], "'");
		if($anz_delimter % 2 ==0) $anz_delimter=0;		
		//kommt ein Index???
		if(substr($tb[$i],0,4)=="KEY " || 
		   substr($tb[$i],0,7)=="UNIQUE " || 
		   substr($tb[$i],0,12)=="PRIMARY KEY " ||
		   substr($tb[$i],0,13)=="FULLTEXT KEY " 
		   ) {
		   	$rit=1;
		} else { 
			if($klammerstart==0 && $anz_delimter==0) {
				if($rit==0) $anz++;
				$rit=0;
			}
		}
		if($debug==1) echo "$i: $tb[$i]".'  <font color="#0000FF">'.$anz."</font> [offene Klammern: $klammerstart]  --$rit<br>";
		
	}
	return $anz;
}

function SQL_Is_Complete($s,$expected=0,$debug=0)
{
	global $restore;
	$anz=$f_begin=$f_end=$restore["erw_anz"]=0;
	$Backslash=chr(92);
	$s=trim(strtoupper(($s)));
	if(substr($s,-2)==");" || substr($s,-2)=="),") $s=substr($s,0,strlen($s)-2);
	if(substr($s,-1)==")") $s=substr($s,0,strlen($s)-1);
	if(strpos($s," VALUES")) {
		$i=strpos($s," VALUES")+7;
		$s=substr($s,$i);
	}
	$i=strpos($s,"(")+1;
	$s=substr($s,$i);
	
	$tb=explode(",",$s);
	for ($i=0;$i<count($tb);$i++){
		$first=$B_Esc=$B_Ticks=$B_Dashes=0;
		$v=trim(rtrim($tb[$i]));
		
		//erweitert ?
		if($anz==0 && $restore["erweiterte_inserts"]==1 && substr($v,0,1)=="(") $v=substr($v,1);
		if($expected>0 && $anz==$expected-1 && substr($v,-1)==")") {
			$v=substr($v,0,strlen($v)-1);  // ) entfernen
			//if($i+1<count($tb)) $tb[$i+1]=substr(trim(rtrim($tb[$i+1])),1);
			if($restore["erweiterte_inserts"]==0) {
				$restore["erweiterte_inserts"]=1;
				$restore["flag"]=1;
			}
			
		}
		
		//Ticks + Dashes zählen
		for($cpos=2;$cpos<=strlen($v);$cpos++)
		{if(substr($v,(-1*$cpos),1)=="'") {$B_Ticks++;} else {break;}}
		for($cpos=2;$cpos<=strlen($v);$cpos++)
		{if(substr($v,(-1*$cpos),1)=='"') {$B_Dashes++;} else {break;}}
		
		//Backslashes zählen
		for($cpos=2+$B_Ticks;$cpos<=strlen($v);$cpos++)
		{if(substr($v,(-1*$cpos),1)=="\\") {$B_Esc++;} else {break;}}
		
		
		
		if($v=="NULL" && $f_begin==0){$f_begin=1;$f_end=1;}
		if($f_begin==0 && is_numeric($v)){$f_begin=1;$f_end=1;}
		 //blob fix von PHPMyAdmin Dump
		if($f_begin==0 && substr($v,0,2)=="0X" && strpos($v," ")==false){$f_begin=1;$f_end=1;}
		if($f_begin==0 && is_object($v)){$f_begin=1;$f_end=1;}
		
		if(substr($v,0,1)=="'"  && $f_begin==0) {$f_begin=1;if(strlen($v)==1)$first=1;$DELIMITER="'";}
		if(substr($v,0,1)=='"'  && $f_begin==0) {$f_begin=1;if(strlen($v)==1)$first=1;$DELIMITER='"';}
		if($f_begin==1 && $f_end!=1 && $first==0){
			if (substr($v,-1)==$DELIMITER){
				$B_Delimiter=($DELIMITER=="'") ? $B_Ticks : $B_Dashes;
					//ist Delimiter maskiert?
				if (($B_Esc % 2)==1 && ($B_Delimiter % 2)==1  && strlen($v)>2) {
					
					$f_end=1;
				} elseif (($B_Delimiter % 2)==1 && strlen($v)>2) {
					//ist mit `'` maskiert
					$f_end=0;
				} elseif(($B_Esc % 2)==1) {
					//ist mit Backslash maskiert
					$f_end=0; 
				} else {
					
					$f_end=1;
				}
			}
		}
		if($debug==1) echo "<font color='#0000FF'>$f_begin/$f_end</font> Feld $i: ".htmlspecialchars($tb[$i])."<font color=#008000>- $anz  ($B_Ticks / $B_Esc)</font><br>";
		if($f_begin==1 && $f_end==1) {
			$anz++;
			$f_begin=$f_end=0;
			if($anz==$expected) {
				$restore["erw_anz"]++;
				if($debug==1) echo "<h5>".$restore["erw_anz"].".Insert - (".$anz." Felder)</h5>";
				$anz=0;
			}
		}
		
	}
	if($anz==0 && $expected>0 && $restore["erw_anz"]>0) $anz=$expected;
	
	return $anz;
}



?>