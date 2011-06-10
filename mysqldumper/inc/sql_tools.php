<?php
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
?>
