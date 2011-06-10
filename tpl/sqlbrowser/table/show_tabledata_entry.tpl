<form method = 'post' action = "index.php?p=sql&action=show_tabledata&db={DB_NAME_URLENCODED}&tablename={TABLE_NAME_URLENCODED}&sort_by_column={SORT_BY_COLUMN}&sort_direction={SORT_DIRECTION}&limit_start{LIMIT_START}&limit_max_entries={MAX_ENTRIES}">
	<table>
	<!-- BEGIN FIELD_EDIT -->
		<tr>
			<td title = '{FIELD_EDIT.KEY_COMMENT}'>{FIELD_EDIT.NAME}:</td>
			<td><input type='text' class='text' name='field_{FIELD_EDIT.KEY}' value='{FIELD_EDIT.VALUE}' /></td>
		</tr>
	<!-- END FIELD_EDIT -->
	<!-- BEGIN FIELD_VIEW -->
		<tr>
			<td title = '{FIELD_VIEW.KEY_COMMENT}'>{FIELD_VIEW.NAME}:</td>
			<td>{FIELD_VIEW.VALUE}</td>
		</tr>
	<!-- END FIELD_VIEW -->
	</table>
	
	<!-- BEGIN FOOTER_EDIT -->
		<input type='hidden' name='key' value='{FOOTER_EDIT.RECORD_KEY}' />
		<input type='hidden' name='action' value='edit' />
		<input type='submit' value='ok' class='Formbutton' /> <input type='reset' value='reset' class='Formbutton' />
	<!-- END FOOTER_EDIT -->

	<!-- BEGIN FOOTER_NEW -->
		<input type='hidden' name='action' value='new' />
		<input type='submit' class='Formbutton' value='ok' /> <input type='reset' value='reset' class='Formbutton'/>
	<!-- END FOOTER_NEW -->

	<!-- BEGIN FOOTER_VIEW -->
	<!-- END FOOTER_VIEW -->
</form>