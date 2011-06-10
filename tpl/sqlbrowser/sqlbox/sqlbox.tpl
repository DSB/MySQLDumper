<script type="text/javascript">
/*<![CDATA[*/
//Extracts the tablename from the select box, sets query and submits the form
function tableSelected()
{
    var select=$('tableSelect');
    var val=select.options[select.selectedIndex].innerHTML;
    var table =  /`(.*)`/i.exec(val)
    $('sqlbox').sqltextarea.value='SELECT * FROM '+table[0];
    $('sqlbox').execsql.click();
}
/*]]>*/
</script>

<h4>{L_DB} `<a href='index.php?p=sql&amp;action=list_tables&amp;db={DB_ENCODED}'>{DB}</a>`
<!-- BEGIN SHOW_TABLENAME -->
.<a href="index.php?p=sql&amp;db={DB_ENCODED}&amp;tablename={SHOW_TABLENAME.TABLE_ENCODED}&amp;action=show_tabledata">`{SHOW_TABLENAME.TABLE}`</a>
<!-- END SHOW_TABLENAME -->
</h4>


<!-- BEGIN SQLUPLOAD -->
	<form action="{SQLUPLOAD.POSTTARGET}" method="post" enctype="multipart/form-data">
	<table class="bordersmall">
	<tr>
		<td>{SQLUPLOAD.LANG_OPENSQLFILE}</td>
		<td><input type="file" name="upfile" class="Formbutton" /></td>
		<td><input type="submit" class="Formbutton" name="submit_openfile" value="{SQLUPLOAD.LANG_OPENSQLFILE_BUTTON}" /></td>
		<td>{SQLUPLOAD.LANG_SQL_MAXSIZE}: <b>{SQLUPLOAD.MAX_FILESIZE}</b></td>
	</tr>
	</table>
	</form>
<!-- END SQLUPLOAD -->

<div id="ymysqlbox">
	<form action="index.php?p=sql&amp;action=general_sqlbox" method="post" id="sqlbox">
		<div id="sqlheaderbox">
			<p class="Formbutton">
				<a href="#" onclick="resizeSQL(0);">{ICON_CLOSE}</a>
				<a href="#" onclick="resizeSQL(1);">{ICON_MINUS}</a>
				<a href="#" onclick="resizeSQL(2);">{ICON_PLUS}</a>
				<input class="Formbutton" type="button" onclick="" value="{LANG_SQL_BEFEHLE}" />
				<!-- BEGIN SQLCOMBO -->
					{SQLCOMBO.SQL_COMBOBOX}
				<!-- END SQLCOMBO -->
				<select class="SQLCombo" name="tablecombo" id="tableSelect" onchange="tableSelected();">
				{TABLE_COMBOBOX}
				</select>
				<input class="Formbutton" type="reset" name="reset" value="{LANG_RESET}" />
				<input class="Formbutton" type="submit" name="execsql" value="{LANG_SQL_EXEC}" />
                <!--
				    <a href="{PARAMS}&amp;search=1">{ICON_SEARCH}</a>
                -->
				<a href="{MYSQL_REF}" title="{MYSQL_HELP}" class="new-window">{ICON_MYSQL_HELP}</a>
			</p>
			<br class="clear" />
		</div>
		<div>
			<textarea style="height:{BOXSIZE}px;" name="sqltextarea" id="sqltextarea" rows="4" cols="10">{BOXCONTENT}</textarea>
			<div class="sqlbox-warning small center">{LANG_SQL_WARNING}</div>
			<input type="hidden" name="db" value="{DB}" />
			<input type="hidden" name="tablename" value="{TABLE}" />
		</div>
	</form>
</div>
<br />
