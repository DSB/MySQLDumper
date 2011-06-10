<br />
<p class="sqlheadmenu">
			<strong>{LANG_DB}:</strong> 
			`<a title="{LANG_DB}" href="sql.php?db={DB_URL_ENCODED}"><strong>{DB}</strong></a>`
			<!-- BEGIN TABLE_SELECTED -->
			&nbsp;<strong>{LANG_TABLE}:</strong> `<a href="sql.php?action=general_sqlbox&amp;db={DB_URL_ENCODED}&amp;tablename={TABLENAME_URLENCODED}" title="{LANG_SQL_TABLEVIEW}"><strong>{TABLENAME}</strong></a>`
			<!-- END TABLE_SELECTED -->
</p>
<br />
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
	<form action="sql.php?action=general_sqlbox" method="post">
		<div id="sqlheaderbox">
			<p class="Formbutton">
				<a href="#" onclick="resizeSQL(0);">{ICON_CLOSE}</a>
				<a href="#" onclick="resizeSQL(1);">{ICON_MINUS}</a>
				<a href="#" onclick="resizeSQL(2);">{ICON_PLUS}</a>
				<input class="Formbutton" type="button" onclick="document.location.href='{PARAMS}&amp;context=1'" value="{LANG_SQL_BEFEHLE}" />
				<!-- BEGIN SQLCOMBO -->
					{SQLCOMBO.SQL_COMBOBOX}
				<!-- END SQLCOMBO -->
				{TABLE_COMBOBOX}
				<input class="Formbutton" type="reset" name="reset" value="{LANG_RESET}" />
				<input class="Formbutton" type="submit" name="execsql" value="{LANG_SQL_EXEC}" />
				<a href="{PARAMS}&amp;readfile=1">{ICON_UPLOAD}</a>
				<a href="{PARAMS}&amp;search=1">{ICON_SEARCH}</a>
				<a href="{MYSQL_REF}" title="{MYSQL_HELP}" class="new-window">{ICON_MYSQL_HELP}</a>
			</p>
			<br class="clear" />
		</div>
		<div>
			<textarea style="height:{BOXSIZE}px;" name="sqltextarea" id="sqltextarea" rows="4" cols="10">{BOXCONTENT}</textarea>
			<div class="sqlbox-warning small center">{LANG_SQL_WARNING}</div>
			<input type="hidden" name="db" value="{DB}" />
			<input type="hidden" name="tablename" value="{TABLENAME}" />
			<input type="hidden" name="dbid" value="{DBID}" />
		</div>
	</form>
</div>
<br />
