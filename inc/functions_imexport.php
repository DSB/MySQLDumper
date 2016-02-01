<?php

function CheckCSVOptions()
{
	global $sql;
	if (!isset($sql['export']['trenn'])) $sql['export']['trenn']=";";
	if (!isset($sql['export']['enc'])) $sql['export']['enc']="\"";
	if (!isset($sql['export']['esc'])) $sql['export']['esc']="\\";
	if (!isset($sql['export']['ztrenn'])) $sql['export']['ztrenn']="\\r\\n";
	if (!isset($sql['export']['null'])) $sql['export']['null']="NULL";
	if (!isset($sql['export']['namefirstline'])) $sql['export']['namefirstline']=0;
	if (!isset($sql['export']['format'])) $sql['export']['format']=0;
	if (!isset($sql['export']['sendfile'])) $sql['export']['sendfile']=0;
	if (!isset($sql['export']['tables'])) $sql['export']['tables']=Array();
	if (!isset($sql['export']['compressed'])) $sql['export']['compressed']=0;
	if (!isset($sql['export']['htmlstructure'])) $sql['export']['htmlstructure']=0;
	if (!isset($sql['export']['xmlstructure'])) $sql['export']['xmlstructure']=0;
	
	if (!isset($sql['import']['trenn'])) $sql['import']['trenn']=";";
	if (!isset($sql['import']['enc'])) $sql['import']['enc']="\"";
	if (!isset($sql['import']['esc'])) $sql['import']['esc']="\\";
	if (!isset($sql['import']['ztrenn'])) $sql['import']['ztrenn']="\\r\\n";
	if (!isset($sql['import']['null'])) $sql['import']['null']="NULL";
	if (!isset($sql['import']['namefirstline'])) $sql['import']['namefirstline']=0;
	if (!isset($sql['import']['format'])) $sql['import']['format']=0;

}

function ExportCSV()
{
	global $sql,$config;
	$t="";
	$time_start=time();
	if (!isset($config['dbconnection'])) MSD_mysql_connect();
	for ($table=0; $table < count($sql['export']['tables']); $table++)
	{
		$sqlt="SHOW Fields FROM `" . $sql['export']['db'] . "`.`" . $sql['export']['tables'][$table] . "`;";
		$res=MSD_query($sqlt);
		if ($res)
		{
			$numfields=mysqli_num_rows($res);
			if ($sql['export']['namefirstline'] == 1)
			{
				for ($feld=0; $feld < $numfields; $feld++)
				{
					$row=mysqli_fetch_row($res);
					if ($sql['export']['enc'] != "") $t.=$sql['export']['enc'] . $row[0] . $sql['export']['enc'] . ( ( $feld + 1 < $numfields ) ? $sql['export']['trenn'] : '' );
					else $t.=$row[0] . ( ( $feld + 1 < $numfields ) ? $sql['export']['trenn'] : '' );
				}
				$t.=$sql['export']['endline'];
				$sql['export']['lines']++;
			}
		}
		$sqlt="SELECT * FROM `" . $sql['export']['db'] . "`.`" . $sql['export']['tables'][$table] . "`;";
		$res=MSD_query($sqlt);
		if ($res)
		{
			$numrows=mysqli_num_rows($res);
			for ($data=0; $data < $numrows; $data++)
			{
				$row=mysqli_fetch_row($res);
				for ($feld=0; $feld < $numfields; $feld++)
				{
					if (!isset($row[$feld]) || is_null($row[$feld]))
					{
						$t.=$sql['export']['null'];
					}
					elseif ($row[$feld] == '0' || $row[$feld] != '')
					{
						if ($sql['export']['enc'] != "") $t.=$sql['export']['enc'] . str_replace($sql['export']['enc'],$sql['export']['esc'] . $sql['export']['enc'],$row[$feld]) . $sql['export']['enc'];
						else $t.=$row[$feld];
					}
					else
					{
						$t.='';
					}
					$t.=( $feld + 1 < $numfields ) ? $sql['export']['trenn'] : '';
				}
				$t.=$sql['export']['endline'];
				$sql['export']['lines']++;
				if (strlen($t) > $config['memory_limit'])
				{
					CSVOutput($t);
					$t="";
				}
				$time_now=time();
				if ($time_start >= $time_now + 30)
				{
					$time_start=$time_now;
					header('X-MSDPing: Pong');
				}
			}
		}
	}
	CSVOutput($t,1);
}

function CSVOutput($str, $last=0)
{
	global $sql,$config;
	if ($sql['export']['sendfile'] == 0)
	{
		//Display
		echo $str;
	}
	else
	{
		if ($sql['export']['header_sent'] == "")
		{
			if ($sql['export']['compressed'] == 1 & !function_exists('gzencode')) $sql['export']['compressed']=0;
			if ($sql['export']['format'] < 4)
			{
				$file=$sql['export']['db'] . ( ( $sql['export']['compressed'] == 1 ) ? ".csv.gz" : ".csv" );
			}
			elseif ($sql['export']['format'] == 4)
			{
				$file=$sql['export']['db'] . ( ( $sql['export']['compressed'] == 1 ) ? ".xml.gz" : ".xml" );
			}
			elseif ($sql['export']['format'] == 5)
			{
				$file=$sql['export']['db'] . ( ( $sql['export']['compressed'] == 1 ) ? ".html.gz" : ".html" );
			}
			$mime=( $sql['export']['compressed'] == 0 ) ? "x-type/subtype" : "application/x-gzip";
			
			header('Content-Disposition: attachment; filename="' . $file . '"');
			header('Pragma: no-cache');
			header('Content-Type: ' . $mime);
			header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
			$sql['export']['header_sent']=1;
		}
		if ($sql['export']['compressed'] == 1) echo gzencode($str);
		else echo $str;
	
	}
}

function DoImport()
{
	global $sql,$lang;
	$r='<span class="swarnung">';
	$zeilen=count($sql['import']['csv']) - $sql['import']['namefirstline'];
	$sql['import']['first_zeile']=explode($sql['import']['trenn'],$sql['import']['csv'][0]);
	$importfelder=count($sql['import']['first_zeile']);
	
	if ($sql['import']['tablecreate'] == 0)
	{
		$res=MSD_query("show fields FROM " . $sql['import']['table']);
		$tabellenfelder=mysqli_num_rows($res);
		if ($importfelder != $tabellenfelder)
		{
			$r.='<br>' . sprintf($lang['L_CSV_FIELDCOUNT_NOMATCH'],$tabellenfelder,$importfelder);
		}
		else
		{
			$ok=1;
		}
	}
	else
	{
		$ok=ImportCreateTable();
		if ($ok == 0)
		{
			$r.='<br>' . sprintf($lang['L_CSV_ERRORCREATETABLE'],$sql['import']['table']);
		}
	}
	if ($ok == 1)
	{
		$insert="";
		if ($sql['import']['emptydb'] == 1 && $sql['import']['tablecreate'] == 0)
		{
			MSD_DoSQL("TRUNCATE " . $sql['import']['table'] . ";");
		}
		$sql['import']['lines_imported']=0;
		$enc=( $sql['import']['enc'] == "" ) ? "'" : "";
		$zc="";
		for ($i=$sql['import']['namefirstline']; $i < $zeilen + $sql['import']['namefirstline']; $i++)
		{
			//Importieren
			$insert="INSERT INTO " . $sql['import']['table'] . " VALUES(";
			if ($sql['import']['createindex'] == 1) $insert.="'', ";
			$zc.=trim(rtrim($sql['import']['csv'][$i]));
			//echo "Zeile $i: $zc<br>";
			if ($zc != "")
			{ // && substr($zc,-1)==$enc) {
				$zeile=explode($sql['import']['trenn'],$zc);
				for ($j=0; $j < $importfelder; $j++)
				{
					$a=( $zeile[$j] == "" && $enc == "" ) ? "''" : $zeile[$j];
					$insert.=$enc . $a . $enc . ( ( $j == $importfelder - 1 ) ? ");\n" : "," );
				}
				MSD_DoSQL($insert);
				$sql['import']['lines_imported']++;
				$zc="";
			}
		
		}
		$r.=sprintf($lang['L_CSV_FIELDSLINES'],$importfelder,$sql['import']['lines_imported']);
	}
	
	$r.='</span>';
	return $r;

}

function ImportCreateTable()
{
	global $sql,$lang,$db,$config;
	$tbl=Array();
	$tabellen=mysqli_query($config['dbconnection'], "SHOW TABLES FROM $db");
	$num_tables=mysqli_num_rows($tabellen);
	for ($i=0; $i < $num_tables; $i++)
	{
		$tbl[]=strtolower(((mysqli_data_seek($tabellen, $i) && (($___mysqli_tmp = mysqli_fetch_row($tabellen)) !== NULL)) ? array_shift($___mysqli_tmp) : false));
	}
	$i=0;
	$sql['import']['table']=$sql['import']['table'] . $i;
	while (in_array($sql['import']['table'],$tbl))
	{
		$sql['import']['table']=substr($sql['import']['table'],0,strlen($sql['import']['table']) - 1) . ++$i;
	}
	$create="CREATE TABLE `" . $sql['import']['table'] . "` (" . ( ( $sql['import']['createindex'] == 1 ) ? '`import_id` int(11) unsigned NOT NULL auto_increment, ' : '' );
	if ($sql['import']['namefirstline'])
	{
		for ($i=0; $i < count($sql['import']['first_zeile']); $i++)
		{
			$create.='`' . $sql['import']['first_zeile'][$i] . '` VARCHAR(250) NOT NULL, ';
		}
	}
	else
	{
		for ($i=0; $i < count($sql['import']['first_zeile']); $i++)
		{
			$create.='`FIELD_' . $i . '` VARCHAR(250) NOT NULL, ';
		}
	}
	if ($sql['import']['createindex'] == 1) $create.='PRIMARY KEY (`import_id`) ';
	else $create=substr($create,0,strlen($create) - 2);
	
	$create.=') ' . ( ( MSD_NEW_VERSION ) ? 'ENGINE' : 'TYPE' ) . "=MyISAM COMMENT='imported at " . date("l dS of F Y H:i:s A") . "'";
	$res=mysqli_query($config['dbconnection'], $create) || die(SQLError($create,((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))));
	return 1;
}

function ExportXML()
{
	global $sql,$config;
	$tab="\t";
	$level=0;
	$t='<?xml version="1.0" encoding="UTF-8" ?>' . "\n" . '<database name="' . $sql['export']['db'] . '">' . "\n";
	$level++;
	$time_start=time();
	
	if (!isset($config['dbconnection'])) MSD_mysql_connect();
	for ($table=0; $table < count($sql['export']['tables']); $table++)
	{
		$t.=str_repeat($tab,$level++) . '<table name="' . $sql['export']['tables'][$table] . '">' . "\n";
		$sqlt="SHOW Fields FROM `" . $sql['export']['db'] . "`.`" . $sql['export']['tables'][$table] . "`;";
		$res=MSD_query($sqlt);
		if ($res)
		{
			$numfields=mysqli_num_rows($res);
			if ($sql['export']['xmlstructure'] == 1)
			{
				$t.=str_repeat($tab,$level++) . '<structure>' . "\n";
				for ($feld=0; $feld < $numfields; $feld++)
				{
					$row=mysqli_fetch_array($res);
					$t.=str_repeat($tab,$level++) . '<field no="' . $feld . '">' . "\n";
					$t.=str_repeat($tab,$level) . '<name>' . $row['Field'] . '</name>' . "\n";
					$t.=str_repeat($tab,$level) . '<type>' . $row['Type'] . '</type>' . "\n";
					$t.=str_repeat($tab,$level) . '<null>' . $row['Null'] . '</null>' . "\n";
					$t.=str_repeat($tab,$level) . '<key>' . $row['Key'] . '</key>' . "\n";
					$t.=str_repeat($tab,$level) . '<default>' . $row['Default'] . '</default>' . "\n";
					$t.=str_repeat($tab,$level) . '<extra>' . $row['Extra'] . '</extra>' . "\n";
					$t.=str_repeat($tab,--$level) . '</field>' . "\n";
				}
				$t.=str_repeat($tab,--$level) . '</structure>' . "\n";
			}
		}
		$t.=str_repeat($tab,$level++) . '<data>' . "\n";
		$sqlt="SELECT * FROM `" . $sql['export']['db'] . "`.`" . $sql['export']['tables'][$table] . "`;";
		$res=MSD_query($sqlt);
		if ($res)
		{
			$numrows=mysqli_num_rows($res);
			for ($data=0; $data < $numrows; $data++)
			{
				$t.=str_repeat($tab,$level) . "<row>\n";
				$level++;
				$row=mysqli_fetch_row($res);
				for ($feld=0; $feld < $numfields; $feld++)
				{
					$t.=str_repeat($tab,$level) . '<field no="' . $feld . '">' . $row[$feld] . '</field>' . "\n";
				}
				$t.=str_repeat($tab,--$level) . "</row>\n";
				$sql['export']['lines']++;
				if (strlen($t) > $config['memory_limit'])
				{
					CSVOutput($t);
					$t="";
				}
				$time_now=time();
				if ($time_start >= $time_now + 30)
				{
					$time_start=$time_now;
					header('X-MSDPing: Pong');
				}
			}
		}
		$t.=str_repeat($tab,--$level) . '</data>' . "\n";
		$t.=str_repeat($tab,--$level) . '</table>' . "\n";
	}
	$t.=str_repeat($tab,--$level) . '</database>' . "\n";
	CSVOutput($t,1);
}

function ExportHTML()
{
	global $sql,$config,$lang;
	$header='<html><head><title>MSD Export</title></head>';
	$footer="\n\n</body>\n</html>";
	$content="";
	$content.='<h1>' . $lang['L_DB'] . ' ' . $sql['export']['db'] . '</h1>';
	
	$time_start=time();
	
	if (!isset($config['dbconnection'])) MSD_mysql_connect();
	for ($table=0; $table < count($sql['export']['tables']); $table++)
	{
		$content.='<h2>Tabelle ' . $sql['export']['tables'][$table] . '</h2>' . "\n";
		$fsql="show fields from `" . $sql['export']['tables'][$table] . "`";
		$dsql="select * from `" . $sql['export']['tables'][$table] . "`";
		//Struktur
		$res=MSD_query($fsql);
		if ($res)
		{
			$field=$fieldname=$fieldtyp=Array();
			$structure="<table class=\"Table\">\n";
			$numfields=mysqli_num_rows($res);
			for ($feld=0; $feld < $numfields; $feld++)
			{
				$row=mysqli_fetch_row($res);
				$field[$feld]=$row[0];
				
				if ($feld == 0)
				{
					$structure.="<tr class=\"Header\">\n";
					for ($i=0; $i < count($row); $i++)
					{
						$str=(((($___mysqli_tmp = mysqli_fetch_field_direct($res, 0)) && is_object($___mysqli_tmp)) ? ( (!is_null($___mysqli_tmp->primary_key = ($___mysqli_tmp->flags & MYSQLI_PRI_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->multiple_key = ($___mysqli_tmp->flags & MYSQLI_MULTIPLE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->unique_key = ($___mysqli_tmp->flags & MYSQLI_UNIQUE_KEY_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->numeric = (int)(($___mysqli_tmp->type <= MYSQLI_TYPE_INT24) || ($___mysqli_tmp->type == MYSQLI_TYPE_YEAR) || ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? ($___mysqli_tmp->type == MYSQLI_TYPE_NEWDECIMAL) : 0)))) && (!is_null($___mysqli_tmp->blob = (int)in_array($___mysqli_tmp->type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) && (!is_null($___mysqli_tmp->unsigned = ($___mysqli_tmp->flags & MYSQLI_UNSIGNED_FLAG) ? 1 : 0)) && (!is_null($___mysqli_tmp->zerofill = ($___mysqli_tmp->flags & MYSQLI_ZEROFILL_FLAG) ? 1 : 0)) && (!is_null($___mysqli_type = $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = (($___mysqli_type == MYSQLI_TYPE_STRING) || ($___mysqli_type == MYSQLI_TYPE_VAR_STRING)) ? "type" : "")) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_INT24))) ? "int" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && in_array($___mysqli_type, array(MYSQLI_TYPE_FLOAT, MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_DECIMAL, ((defined("MYSQLI_TYPE_NEWDECIMAL")) ? constant("MYSQLI_TYPE_NEWDECIMAL") : -1)))) ? "real" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIMESTAMP) ? "timestamp" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_YEAR) ? "year" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (($___mysqli_type == MYSQLI_TYPE_DATE) || ($___mysqli_type == MYSQLI_TYPE_NEWDATE))) ? "date " : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_TIME) ? "time" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_SET) ? "set" : $___mysqli_tmp->type)) &&(!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_ENUM) ? "enum" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_GEOMETRY) ? "geometry" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_DATETIME) ? "datetime" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && (in_array($___mysqli_type, array(MYSQLI_TYPE_TINY_BLOB, MYSQLI_TYPE_BLOB, MYSQLI_TYPE_MEDIUM_BLOB, MYSQLI_TYPE_LONG_BLOB)))) ? "blob" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type && $___mysqli_type == MYSQLI_TYPE_NULL) ? "null" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->type = ("" == $___mysqli_tmp->type) ? "unknown" : $___mysqli_tmp->type)) && (!is_null($___mysqli_tmp->not_null = ($___mysqli_tmp->flags & MYSQLI_NOT_NULL_FLAG) ? 1 : 0)) ) : false ) ? $___mysqli_tmp : false);
						$fieldname[$i]=$str->name;
						$fieldtyp[$i]=$str->type;
						$structure.="<th>" . $str->name . "</th>\n";
					}
					$structure.="</tr>\n<tr>\n";
				}
				for ($i=0; $i < count($row); $i++)
				{
					$structure.="<td class=\"Object\">" . ( ( $row[$i] != "" ) ? $row[$i] : "&nbsp;" ) . "</td>\n";
				}
				$structure.="</tr>\n";
			}
			$structure.="</table>\n";
		}
		if ($sql['export']['htmlstructure'] == 1) $content.="<h3>Struktur</h3>\n" . $structure;
		//Daten
		

		$res=MSD_query($dsql);
		if ($res)
		{
			$anz=mysqli_num_rows($res);
			$content.="<h3>Daten ($anz Datens&auml;tze)</h3>\n";
			$content.="<table class=\"Table\">\n";
			for ($feld=0; $feld < count($field); $feld++)
			{
				if ($feld == 0)
				{
					$content.="<tr class=\"Header\">\n";
					for ($i=0; $i < count($field); $i++)
					{
						$content.="<th>" . $field[$i] . "</th>\n";
					}
					$content.="</tr>\n";
				}
			}
			for ($d=0; $d < $anz; $d++)
			{
				$row=mysqli_fetch_row($res);
				$content.="<tr>\n";
				for ($i=0; $i < count($row); $i++)
				{
					
					$content.='<td class="Object">' . ( ( $row[$i] != "" ) ? $row[$i] : "&nbsp;" ) . "</td>\n";
				}
				$content.="</tr>\n";
			}
		}
		$content.="</table>";
	}
	CSVOutput($header . $content . $footer);
}
