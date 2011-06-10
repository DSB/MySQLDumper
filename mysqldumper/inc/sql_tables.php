<?php
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
		echo '<br><pre>';print_r($fields_infos);echo '</pre>';*/
	}
?>
