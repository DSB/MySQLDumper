<div id="panel_general" class="panel" style="display:none">
	<fieldset><legend>{L_GENERAL}</legend>
	<table>
	<tr>
		<td>{L_MSD_MODE}:</td>
		<td>
			<input type="radio" class="radio" value="0" name="msd_mode" id="mode_easy"{MSD_MODE_EASY_SELECTED} /><label for="mode_easy">{L_MODE_EASY}</label>
			<input type="radio" class="radio" value="1" name="msd_mode" id="mode_expert"{MSD_MODE_EXPERT_SELECTED} /><label for="mode_expert">{L_MODE_EXPERT}</label>
		</td>
	</tr>
	<tr>
		<td>{L_LOGFILES}:</td>
		<td>
			<input type="checkbox" class="checkbox" value="1" name="logcompression" id="logcompression"{GZ_DISABLED}{LOG_GZ_SELECTED} />
			<label for="logcompression">{L_COMPRESSED}</label>
		</td>
	</tr>
	<tr>
		<td>{L_MAXSIZE}:</td>
		<td>
			<input type="text" class="text right" name="log_maxsize1" size="3" maxlength="3" value="{LOG_MAXSIZE1}" />
			<select name="log_maxsize2" class="select">
				<option value="1"{LOG_UNIT_KB_SELECTED}>{L_UNIT_KB}</option>
				<option value="2"{LOG_UNIT_MB_SELECTED}>{L_UNIT_MB}</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>{L_SPEED}:<br /><span class="small">({L_RECORDS_PER_PAGECALL})</span></td>
		<td>
			<input type="text" class="text right" size="6" name="minspeed" maxlength="6" value="{MIN_SPEED}" />
			{L_TO}
			<input type="text" class="text right" size="6" name="maxspeed" maxlength="9" style="text-align:right;" value="{MAX_SPEED}" />
		</td>
	</tr>
	</table>
</fieldset>
<br />
<fieldset>
	<legend>{L_DUMP}</legend>
	<table>
	<tr>
		<td>{L_GZIP}:</td>
		<td>
			<input type="radio" class="radio" value="1" name="compression" id="compression_1"{GZ_DISABLED}{DUMP_GZ_ENABLED_SELECTED} /><label for="compression_1">{L_ACTIVATED}</label>
			<input type="radio" class="radio" value="0" name="compression" id="compression_2"{DUMP_GZ_DISABLED_SELECTED} /><label for="compression_2">{L_NOT_ACTIVATED}</label>
		</td>
	</tr>
	<tr>
		<td>{L_MULTI_PART}:</td>
		<td>
			<input type="radio" class="radio" value="1" name="multi_part" id="multi_part_1" onclick="obj_enable('multipartgroesse1');obj_enable('multipartgroesse2');"{MULTIPART_ENABLED_SELECTED} /><label for="multi_part_1">{L_YES}</label>
			<input type="radio" class="radio" value="0" name="multi_part" id="multi_part_2" onclick="obj_disable('multipartgroesse1');obj_disable('multipartgroesse2');"{MULTIPART_DISABLED_SELECTED} /><label for="multi_part_2">{L_NO}</label>
		</td>
	</tr>
	<tr>
		<td>{L_MULTIPART_SIZE}:</td>
		<td>
			<input type="text" class="text right" id="multipartgroesse1" name="multipartgroesse1" size="3" maxlength="8" value="{MULTIPART_FILE_SIZE}"{MULTIPART_DISABLED} />
			<select class="select" id="multipartgroesse2" name="multipartgroesse2"{MULTIPART_FILE_SIZE_DISABLED}>
				<option value="1"{MULTIPART_FILE_UNIT_KB_SELECTED}>{L_UNIT_KB}</option>
				<option value="2"{MULTIPART_FILE_UNIT_MB_SELECTED}>{L_UNIT_MB}</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>{L_OPTIMIZE_TABLES}:</td>
		<td>
			<input type="radio" class="radio" value="1" id="optimize_tables_1" name="optimize_tables"{OPTIMIZE_TABLES_ENABLED_SELECTED} />
			<label for="optimize_tables_1">{L_YES}</label>
			<input type="radio" class="radio" value="0" id="optimize_tables_2" name="optimize_tables"{OPTIMIZE_TABLES_DISABLED_SELECTED} />
			<label for="optimize_tables_2">{L_NO}</label>
		</td>
	</tr>
</table>
</fieldset>
<br />
<fieldset>
	<legend>{L_RESTORE}</legend>
	<table>
	<tr>
		<td>{L_ERRORHANDLING_RESTORE}:</td>
		<td>
			<input type="radio" class="radio" name="stop_with_error" id="stop_on_error_1" value="0"{STOP_ON_ERROR_DISABLED_SELECTED} /><label for="stop_on_error_1">{L_EHRESTORE_CONTINUE}</label>
				<br />
			<input type="radio" class="radio" name="stop_with_error" id="stop_on_error_2" value="1"{STOP_ON_ERROR_ENABLED_SELECTED} /><label for="stop_on_error_2">{L_EHRESTORE_STOP}</label>
		</td>
	</tr>
	<!-- BEGIN MODE_EXPERT -->
	<tr>
		<td>{L_EMPTY_DB_BEFORE_RESTORE}:</td>
		<td>
			<input type="radio" class="radio" value="1" name="empty_db_before_restore" id="empty_db_before_restore_1"{TRUNCATE_DB_ENABLED_SELECTED} /><label for="empty_db_before_restore_1">{L_YES}</label>
			<input type="radio" class="radio" value="0" name="empty_db_before_restore" id="empty_db_before_restore_2"{TRUNCATE_DB_DISABLED_SELECTED} /><label for="empty_db_before_restore_2">{L_NO}</label>
		</td>
	</tr>
	<!-- END MODE_EXPERT -->
	</table>
</fieldset>

<br />
<button class="Formbutton" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>