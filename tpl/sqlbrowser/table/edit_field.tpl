<form>
	<table>
	<!-- BEGIN FIELD_EDIT -->
		<tr>
			<td title = '{FIELD_EDIT.KEY_COMMENT}'>{FIELD_EDIT.KEY}:</td>
			<td><input type='text' class='text' name='{FIELD_EDIT.KEY}' value='{FIELD_EDIT.VALUE}' /></td>
		</tr>
	<!-- END FIELD_EDIT -->
	<!-- BEGIN FIELD_VIEW -->
		<tr>
			<td title = '{FIELD_VIEW.KEY_COMMENT}'>{FIELD_VIEW.KEY}:</td>
			<td>{FIELD_VIEW.VALUE}</td>
		</tr>
	<!-- END FIELD_VIEW -->
	</table>
	
	<!-- BEGIN FOOTER_EDIT -->
		<input type='submit' value='ok' /> <input type='reset' value='reset' />
	<!-- END FOOTER_EDIT -->

	<!-- BEGIN FOOTER_NEW -->
	<input type='submit' value='ok' /> <input type='reset' value='reset' />
	<!-- END FOOTER_NEW -->

	<!-- BEGIN FOOTER_VIEW -->
	<!-- END FOOTER_VIEW -->
</form>