<div id="panel_autodelete" class="panel" style="display:none">
	<fieldset><legend>{L_CONFIG_AUTODELETE}</legend>
	<table>
		<tr>
			<td>{L_AUTODELETE}:</td>
			<td>
				<input type="radio" class="radio" value="1" name="auto_delete" id="auto_delete_1" onclick="obj_enable('max_backup_files')"{AUTODELETE_ENABLED_SELECTED} /><label for="auto_delete_1">{L_ACTIVATED}</label>
				<input type="radio" class="radio" value="0" name="auto_delete" id="auto_delete_2" onclick="obj_disable('max_backup_files')"{AUTODELETE_DISABLED_SELECTED} /><label for="auto_delete_2">{L_NOT_ACTIVATED}</label>
			</td>
		</tr>
		<tr>
			<td>{L_NUMBER_OF_FILES_FORM}:</td>
			<td>
				<input type="text" class="text" size="3" name="max_backup_files" id="max_backup_files" value="{MAX_BACKUP_FILES}"{MAX_BACKUP_FILES_DISABLED} /> 
			</td>
		</tr>
	</table>
	</fieldset>
	<br />
	<button class="Formbutton" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>