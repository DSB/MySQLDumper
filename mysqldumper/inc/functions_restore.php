<?php
include_once('./inc/functions_global.php');
include_once('./inc/runtime.php');
define('DEBUG',0);

function AnzahlTabellenfelder($s,$debug=0)
{
	/******* Diese Funktion wird nur in der develop.php gebraucht *******/
	// ermittelt die Anzahl der Spalten einer Tabelle aus einer CREATE-Anweisung
	$anz=$anz_delimter=$rit=$klammerstart=$klammerauf=$klammerzu=0;
	$s=strtoupper($s);
	$i=strpos($s,"(")+1;
	$s=substr($s,$i);
	$tb=explode(',',$s);

	$defaultstart=false;
	for ($i=0;$i<count($tb);$i++){
		$tb[$i]=trim($tb[$i]);
		$klammerstart+=substr_count($tb[$i], "(")-substr_count($tb[$i], ")");
		if($i==count($tb)-1) $klammerstart+=1;
		$anz_delimter+=substr_count($tb[$i], "'");
		if($anz_delimter % 2 ==0) $anz_delimter=0;
		//kommt ein Index???
		if(substr($tb[$i],0,4)=='KEY ' ||
		   substr($tb[$i],0,7)=='UNIQUE ' ||
		   substr($tb[$i],0,12)=='PRIMARY KEY ' ||
		   substr($tb[$i],0,13)=='FULLTEXT KEY '
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

function get_sqlbefehl()
{
	global $restore,$config,$databases,$lang;

	//Init
	$restore['fileEOF']=false;
	$restore['EOB']=false;
	$complete_sql='';
	$sqlparser_status=0;
	if(!isset($restore['eintraege_ready'])) $restore['eintraege_ready']=0;

	//Parsen
	WHILE ($sqlparser_status!=100 && !$restore['fileEOF'] && !$restore['EOB'] )
	{
		//nächste Zeile lesen
		$zeile= ($restore['compressed']) ? gzgets($restore['filehandle']) : fgets($restore['filehandle']);

		/******************* Setzen des Parserstatus *******************/
		// herausfinden um was für einen Befehl es sich handelt
		IF ($sqlparser_status==0)
		{

			//Vergleichszeile, um nicht bei jedem Vergleich strtoupper ausführen zu müssen
			$zeile2=strtoupper(trim($zeile));

			// Am Ende eines MySQLDumper-Backups angelangt?
			if(substr($zeile2,0,6)=='-- EOB' || substr($zeile2,0,5)=='# EOB')
			{
				$restore['EOB']=true;
				$zeile='--';$zeile2='--';
				$sqlparser_status=100;
			}

			// Kommenatr?
			if ( (substr($zeile2,0,2)=='--') || (substr($zeile2,0,1)=='#') )
			{
				$zeile='';$zeile2=''; $sqlparser_status=0;
			}

			//Einfache Anweisung finden die mit Semikolon beendet werden
			if(substr($zeile2,0,11)=='LOCK TABLES') $sqlparser_status=5;
			if(substr($zeile2,0,6)=='COMMIT') $sqlparser_status=5;
			if(substr($zeile2,0,5)=='BEGIN') $sqlparser_status=5;
			if(substr($zeile2,0,13)=='UNLOCK TABLES') $sqlparser_status=5;
			if(substr($zeile2,0,4)=='SET ') $sqlparser_status=5;
			if(substr($zeile2,0,6)=='START ') $sqlparser_status=5;
			if(substr($zeile2,0,3)=='/*!') $sqlparser_status=5; //MySQL-Condition oder Kommentar

			if(substr($zeile2,0,12)=='CREATE TABLE') $sqlparser_status=2; //Createaktion
			if(substr($zeile2,0,12)=='CREATE INDEX') $sqlparser_status=4; //Indexaktion

			//Kommentar
			if ( ($sqlparser_status!=5) && (substr($zeile2,0,2)=='/*')) $sqlparser_status=6;

			// Befehle, die nicht ausgeführt werden sollen
			if (substr($zeile2,0,4)=='USE ') $sqlparser_status=7;
			if (substr($zeile2,0,14)=='DROP DATABASE ') $sqlparser_status=7;
			if(substr($zeile2,0,10)=='DROP TABLE') $sqlparser_status=1; //Löschaktion

			if (substr($zeile2,0,7)=='INSERT ')
			{
				$sqlparser_status=3; //Datensatzaktion
				//$restore['actual_table']=strtolower(get_tablename_aus_insert($zeile));
				$restore['actual_table']=get_tablename_aus_insert($zeile);

				// Pruefen ob die Spaltenanzahl bekannt ist und wenn nicht setzen
				if(!isset($restore['num_table_fields'][$restore['actual_table']]))
				{
					$restore['num_table_fields'][$restore['actual_table']]=get_num_rows($restore['actual_table']);
				}
			}
			// Fortsetzung von erweiterten Inserts
			if ($restore['flag']==1) $sqlparser_status=3;

			if ( ($sqlparser_status==0) && (trim($complete_sql)>'') && ($restore['flag']==-1) )
			{
				// Unbekannten Befehl entdeckt
				v($restore);
				echo "<br>Sql: ".$complete_sql;
				echo "<br>Erweiterte Inserts: ".$restore['erweiterte_inserts'];
				die('<br>'.$lang['unknown_sqlcommand'].': '.$zeile);
			}
		/******************* Ende von Setzen des Parserstatus *******************/
		}

		$last_char=substr(rtrim($zeile),-1);
		// Zeilenumbrüche erhalten - sonst werden Schlüsselwörter zusammengefügt
		// z.B. 'null' und in der nächsten Zeile 'check' wird zu 'nullcheck'
		$complete_sql.=$zeile."\n";

		if($sqlparser_status==1)
		{ //Löschaktion
			if($last_char==';') $sqlparser_status=100;	//Befehl komplett
		}

		if($sqlparser_status==2)
		{
			// Createanweisung ist beim Finden eines ; beendet
			if($last_char==';' )
			{
					if($config['minspeed']>0) $restore['anzahl_zeilen']=$config['minspeed'];

					//Spaltenanzahl fuer diese Tabelle merken
					$restore['actual_table']=get_tablename($complete_sql);

					$complete_sql=del_inline_comments($complete_sql); //Inline-Kommentare entfernen

					//Create ausfuehren und Anzahl der Spalten speichern
					$restore['actual_fieldcount']=submit_create_action($complete_sql);
					$restore['num_table_fields'][$restore['actual_table']]=$restore['actual_fieldcount'];

					// Zeile verwerfen und naechsten Befehl suchen
					$complete_sql='';
					$sqlparser_status=0;
			}
		}

		if($sqlparser_status==3)
		{
			//INSERT
			// Anzahl der Felder ermitteln wenn unbekannt
			if(!isset($restore['num_table_fields'][$restore['actual_table']]))
			{
				$restore['num_table_fields'][$restore['actual_table']]=get_num_rows($restore['actual_table']);
			}


			$AnzahlFelder=SQL_Is_Complete($complete_sql,$restore['num_table_fields'][$restore['actual_table']],DEBUG);

			// einen vollständigen Insert ermittelt
			if($AnzahlFelder==$restore['num_table_fields'][$restore['actual_table']])
			{
				$sqlparser_status=100;
				$complete_sql=trim($complete_sql);

				// letzter Ausdruck des erweiterten Inserts erreicht?
				if(substr($complete_sql,-2)==');')
				{
					$restore['flag']=-1;
				}

				// Wenn am Ende der Zeile ein Klammer Komma -> erweiterter Insert-Modus -> Steuerflag setzen
				if(substr($complete_sql,-2)=='),')
				{
					// letztes Komme gegen Semikolon tauschen
					$complete_sql=substr($complete_sql,0,-1).';';
					$restore['erweiterte_inserts']=1;
					$restore['flag']=1;
				}

				if (substr($complete_sql,0,7)!='INSERT ')
				{
					$complete_sql=$restore['insert_syntax'].' VALUES '.$complete_sql.';';
				}
				else
				{
					// INSERT Syntax ermitteln und merken
					$ipos=strpos(strtoupper($complete_sql),'VALUES');
					if (!$ipos===false) $restore['insert_syntax']=substr($complete_sql,0,$ipos);
					else $restore['insert_syntax']='INSERT INTO `'.$restore['actual_table'].'`';
				}

				if($AnzahlFelder>$restore['num_table_fields'][$restore['actual_table']] && $restore['erweiterte_inserts']==0)
				{
					if(!isset($restore['table_create'][$restore['actual_table']]))
					{
						global $lang;
						include('./inc/functions_sql.php');
						$restore['table_create'][$restore['actual_table']]=GetCreateTable($databases['db_actual'],$restore['actual_table']);
					}

					echo '<form action="main.php?action=extinfo" method="post">';
					echo '<p class="warnung">Parser-Fehler : zuviele gezählt in Tabelle '.$restore["actual_table"].' ('.$AnzahlFelder.' statt '.$restore["num_table_fields"][$restore["actual_table"]].')';
					echo '<br>Aktuelle Tabelle: '.$restore['actual_table'];
					echo '<h4>CREATE-Anweisung</h4><textarea name="create_sql" style="width:90%;height:200px;">'.$restore["table_create"][$restore["actual_table"]].'</textarea>';
					echo '<h4>INSERT-Anweisung</h4><textarea name="insert_sql" style="width:90%;height:200px;">'.$complete_sql.'</textarea></p><br>';
					echo '<br><br><input type="submit" name="tell_error" value="Fehlerbericht"></form>'.$zeile;
					die;
				}
			}
		}

		// Index
		if($sqlparser_status==4)
		{ //Createindex
			if($last_char==';' )
			{
					if($config['minspeed']>0) {$restore['anzahl_zeilen']=$config['minspeed'];}
					$complete_sql=del_inline_comments($complete_sql);
					$sqlparser_status=100;	//Befehl komplett
			}
		}

		// Kommentar oder Condition
		if($sqlparser_status==5)
		{ //Anweisung
			if($last_char==';' )
			{
					if($config['minspeed']>0) {$restore['anzahl_zeilen']=$config['minspeed'];}
					$complete_sql=del_inline_comments($complete_sql);
					$sqlparser_status=100;	//Befehl komplett
			}
		}

		// Mehrzeiliger oder Inline-Kommentar
		if($sqlparser_status==6)
		{
			if(!strrpos($zeile,'*/')===false)
			{
					$complete_sql=trim(del_inline_comments($complete_sql));
					$sqlparser_status=0;
			}
		}

		// Befehle, die verworfen werden sollen
		if($sqlparser_status==7)
		{ //Anweisung
			if($last_char==';' )
			{
					if($config["minspeed"]>0) {$restore["anzahl_zeilen"]=$config["minspeed"];}
					$complete_sql='';
					$sqlparser_status=0;
			}
		}

		if ( ($restore['compressed']) && (gzeof($restore['filehandle'])) ) $restore['fileEOF']=true;
		if ( (!$restore['compressed']) && (feof($restore['filehandle'])) ) $restore['fileEOF']=true;

	}
	return trim($complete_sql);
}

function submit_create_action($sql)
{
	//Führt eine Create-Anweisung durch und ermittelt danach die Anzahl der aktuellen Spalten
	// und legt diese im Array ab
	global $restore;
	$tablename=get_tablename($sql);
	if (DEBUG)
	{
		echo "<br>Tabellenname: ".$tablename;
		echo "<br>Create: ".$sql;
	}
	$res=mysql_query($sql);
	if (!$res===false)
	{
		if (DEBUG) echo "<br>Create-Anweisung erfolgreich ausgeführt.";
		$restore['actual_table']=$tablename;
		$restore['table_ready']++;
	}
	else
	{
		//erster Versuch die Tabelle anzulegen hat nicht geklappt
		// versuchen wir es mal mit der alten Syntax
		$res=mysql_query(downgrade($sql));
		if (!$res===false)
		{
			if (DEBUG) echo "<br>Create-Anweisung nach Downgrade erfolgreich ausgeführt.";
			$restore['actual_table']=$tablename;
			$restore['table_ready']++;
		}
		else
		{
			SQLError($sql,'Couldn\'t create table: '.$tablename);
			die();
		}
	}
	return get_num_rows($tablename);
}

function get_num_rows($tablename)
{
	//Anzahl der Tabellenspalten ermitteln
	$sql='SHOW COLUMNS FROM `'.$tablename.'`';
	$res=mysql_query($sql);
	if ($res)
	{
		$num_rows=mysql_num_rows($res);
	}
	else
	{
		global $restore;
		v($restore);
		die('Couldn\'t read rowcount for table '.$tablename.'!<br>Restore:'.$restore['actual_table']);
	}
	return $num_rows;
}

function del_inline_comments($sql)
{
	$sql=str_replace("\n",'<br>',$sql);

	//Inline-Kommentare entfernen
	preg_match_all("/(\/\*(.+)\*\/)/U",$sql,$array);
	if (is_array($array[0]))
	{
		if (DEBUG)
		{
			v($array);
			echo"<br><hr>vorher:<br>".$sql."<br><hr>";
		}
		$sql=str_replace($array[0],'',$sql);
		if (DEBUG) echo"Nachher: :<br>".$sql."<br><hr>";
	}
	$sql=trim(str_replace('<br>',"\n",$sql));
	//Wenn nach dem Entfernen nur noch ein ; übrigbleibt -> entfernen
	if ($sql==';') $sql='';
	return $sql;
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

function stri_replace($original,$patterns)
{
	$finalremove=$original;
	$piece_front='';
	$piece_back='';
	$piece_replace='';

	for ($x=0; $x < count($patterns); $x++)
	{
		$safety=0;
       	while(strstr(strtolower($finalremove),strtolower($patterns[$x])))
		{
	    	$safety=$safety+1;
	    	if ($safety >= 100000) { break; }

	    	$occ=strpos(strtolower($finalremove),strtolower($patterns[$x]));
	    	$piece_front=substr($finalremove,0,$occ);
	    	$piece_back=substr($finalremove,($occ+strlen($patterns[$x])));
	    	$finalremove=$piece_front . $piece_replace . $piece_back;
       }
   }
	return $finalremove;
}


// extrahiert auf einfache Art den Tabellennamen aus dem "Create"-Befehl
function get_tablename($t)
{
	global $restore;
	$ersetzen=array('CREATE TABLE','IF NOT EXISTS');
	$t=trim(stri_replace($t,$ersetzen));
	$t=trim(str_replace('(',' ',$t));
	$w=explode(' ',$t);
	$tn=$w[0];
	if(substr($tn,0,1)=='`') $tn=substr($tn,1,strlen($tn)-2);
	return $tn;
}

// extrahiert auf einfache Art den Tabellennamen aus dem "Insert"-Befehl
function get_tablename_aus_insert($t)
{
	$t=substr($t,strpos(strtolower($t), 'into ')+5);
	$w=explode(' ',$t);
	$tn=$w[0];
	if(substr($tn,0,1)=='`') $tn=substr($tn,1,strlen($tn)-2);
	return $tn;
}

function SQL_Is_Complete($s,$expected=0,$debug=0)
{
	global $restore;
	if ($debug) echo "<br>Zu analysieren:".$s."<br>";
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