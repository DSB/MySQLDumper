<?php
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
?>
