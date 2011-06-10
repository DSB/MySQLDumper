<div id="panel_interface" class="panel" style="display:none">
	<fieldset><legend>{L_CONFIG_INTERFACE}</legend>
	<table>
		<tr>
			<td>{L_LANGUAGE}:</td>
			<td>
				<select name="language" class="select" onchange="correctFormAction();$('config_form').submit()">{SEL_LANGUAGES}</select>
				<input type="hidden" name="lang_old" value="{LANGUAGE}" />
				<input type="hidden" name="scaption_old" value="{SERVER_CAPTION}" />
			</td>
		</tr>

		<tr>
			<td>{L_THEME}:</td>
			<td>
				<select name="theme" class="select">{SEL_THEME}</select>
			</td>
		</tr>
		<tr>
			<td>{L_POSITION_NOTIFICATIONS}:</td>
			<td>
				<select name="notification_position" class="select">{SEL_NOTIFICATION_POSITION}</select>
			</td>
		</tr>
		<tr>
			<td>{L_SERVERCAPTION}:</td>
			<td>
				<input type="checkbox" class="checkbox" value="1" name="interface_server_caption" id="interface_server_caption" onclick="obj_toggle(this,['interface_server_caption_position_1','interface_server_caption_position_2']);"{INTERFACE_SERVER_CAPTION_ACTIVATED} />
				<label for="interface_server_caption">{L_ACTIVATED}</label><br />
				<input type="radio" class="radio" name="interface_server_caption_position" id="interface_server_caption_position_1" value="1"{SERVER_CAPTION_POS_MAINFRAME_SELECTED}{INTERFACE_SERVER_CAPTION_DISABLED} /><label for="interface_server_caption_position_1">{L_POSITION_TR}</label>
				<br />
				<input type="radio" class="radio" name="interface_server_caption_position" id="interface_server_caption_position_2" value="0"{SERVER_CAPTION_POS_MENUE_SELECTED}{INTERFACE_SERVER_CAPTION_DISABLED} /><label for="interface_server_caption_position_2">{L_POSITION_BL}</label>
			</td>
		</tr>
	</table>
</fieldset>
<br />
<fieldset>
	<legend>{L_SQL_BROWSER}</legend>
	<table>
	<tr>
		<td>{L_SQLBOXHEIGHT}:</td>
		<td>
			<input type="text" class="text right" name="sqlboxsize" value="{SQLBOX_HEIGHT}" size="3" maxlength="6" /> {L_UNIT_PIXEL}
		</td>
	</tr>
	<tr>
		<td>{L_SQLLIMIT}:</td>
		<td>
			<input type="text" class="text right" name="resultsPerPage" value="{RESULTS_PER_PAGE}" size="3" maxlength="6" />
		</td>
	</tr>
	<tr>
		<td>{L_SQLBOX}:</td>
		<td>
			<input type="radio" class="radio" name="interface_table_compact" id="interface_table_compact_1" value="0"{SQL_GRID_TYPE_NORMAL_SELECTED} /><label for="interface_table_compact_1">{L_SQL_VIEW_STANDARD}</label>
			<br />
			<input type="radio" class="radio" name="interface_table_compact" id="interface_table_compact_2" value="1"{SQL_GRID_TYPE_COMPACT_SELECTED} /><label for="interface_table_compact_2">{L_SQL_VIEW_COMPACT}</label>
		</td>
	</tr>
	<tr>
		<td>{L_REFRESHTIME_PROCESSLIST}:</td>
		<td>
			<input type="text" class="text right" name="refresh_processlist" value="{REFRESH_PROCESSLIST}" size="3" maxlength="2" /> {L_SECONDS}
		</td>
	</tr>
	</table>
</fieldset>

	<br />
	<button class="Formbutton" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>
