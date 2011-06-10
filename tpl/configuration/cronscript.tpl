<div id="panel_cronscript" class="panel" style="display:none">
	<fieldset>
		<legend>{L_CONFIG_CRONPERL}</legend>
		<table>
			<tr>
				<td>{L_CRON_EXTENDER}:&nbsp;</td>
				<td>
					<input type="radio" class="radio" value="0" name="cron_extender" id="cron_extender_1"{EXTENSION_PL_SELECTED} /><label for="cron_extender_1">.pl</label>
					<input type="radio" class="radio" value="1" name="cron_extender" id="cron_extender_2"{EXTENSION_CGI_SELECTED} /><label for="cron_extender_2">.cgi</label>
				</td>
			</tr>
			<tr>
				<td>{L_CRON_EXECPATH}:</td>
				<td>
					<input type="text" class="text" size="30" name="cron_execution_path" value="{EXEC_PATH}" />
				</td>
			</tr>
			<tr>
				<td>{L_CRON_PRINTOUT}:</td>
				<td>
					<input type="radio" class="radio" value="1" name="cron_printout" id="cron_printout_1"{CRON_PRINTOUT_ENABLED_SELECTED} /><label for="cron_printout_1">{L_YES}</label>
					<input type="radio" class="radio" value="0" name="cron_printout" id="cron_printout_2"{CRON_PRINTOUT_DISABLED_SELECTED} /><label for="cron_printout_2">{L_NO}</label>
				</td>
			</tr>
			<tr>
				<td>{L_CRON_COMPLETELOG}:</td>
				<td>
					<input type="radio" class="radio" value="1" name="cron_completelog" id="cron_completelog_1"{CRON_COMPLETELOG_ENABLED_SELECTED} /><label for="cron_completelog_1">{L_YES}</label>
					<input type="radio" class="radio" value="0" name="cron_completelog" id="cron_completelog_2"{CRON_COMPLETELOG_DISABLED_SELECTED} /><label for="cron_completelog_2">{L_NO}</label>
				</td>
			</tr>
			<tr>
				<td>{L_CRON_COMMENT}:</td>
				<td>
					<input type="text" class="text" name="cron_comment" size="30" maxlength="100" value="{CRON_COMMENT}" />
				</td>
			</tr>
		</table>
	</fieldset>
	<br />
	<button type="submit" class="Formbutton" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>
	