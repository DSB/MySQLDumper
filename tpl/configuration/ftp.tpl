<script type="text/javascript">
/*<![CDATA[*/
var ftpfields=['ftp_mode','ftp_timeout','ftp_useSSL','ftp_server','ftp_port','ftp_user','ftp_pass','ftp_dir','testFTP'];
function toggle_ftp(obj,id)
{
	var fields=[];
	for (i=0;i<ftpfields.length;i++)
	{
		fields[i]=ftpfields[i]+id;
	}
	obj_toggle(obj,fields);
}
/*]]>*/
</script>
<div id="panel_ftp" class="panel" style="display:none">
	<fieldset>
		<legend>{L_CONFIG_FTP}</legend>
		<button type="submit" name="ftp_add_new_connection" class="Formbutton">
		{ICON_ADD} {L_FTP_ADD_CONNECTION}</button><br />

		<!-- BEGIN FTP -->
		<br />
		<fieldset><legend>{L_FTP_CONNECTION} {FTP.NR}&nbsp;</legend>
		<table>
			<tr>
				<td>{L_FTP_TRANSFER}:</td>
				<td>
					<input type="radio" class="radio" value="1" name="ftp[{FTP.ID}][transfer]" id="ftp_transfer{FTP.ID}_1" onclick="toggle_ftp(this,{FTP.ID})"{FTP.FTP_DISABLED}{FTP.FTP_ENABLED_SELECTED} /><label for="ftp_transfer{FTP.ID}_1">{L_ACTIVATED}</label>
					<input type="radio" class="radio" value="0" name="ftp[{FTP.ID}][transfer]" id="ftp_transfer{FTP.ID}_2" onclick="toggle_ftp($('config_form').ftp_transfer{FTP.ID}_1,{FTP.ID})"{FTP.FTP_DISABLED_SELECTED} /><label for="ftp_transfer{FTP.ID}_2">{L_NOT_ACTIVATED}</label>
				</td>
			</tr>
			<tr>
				<td>{L_FTP_TIMEOUT}:</td>
				<td>
					<input type="text" class="text" size="2" name="ftp[{FTP.ID}][timeout]" id="ftp_timeout{FTP.ID}" value="{FTP.FTP_TIMEOUT}"{FTP.FTP_FIELDS_DISABLED} />{L_SECONDS}
				</td>
			</tr>
			<tr>
				<td>{L_FTP_CHOOSE_MODE}:</td>
				<td>
					<input type="checkbox" class="checkbox"  name="ftp[{FTP.ID}][mode]" id="ftp_mode{FTP.ID}" value="1"{FTP.FTP_PASSIVE_MODE_SELECTED}{FTP.FTP_FIELDS_DISABLED} />
					<label for="ftp_mode{FTP.ID}">{L_FTP_PASSIVE}</label>
				</td>
			</tr>
			<tr>
				<td>{L_FTP_SSL}:</td>
				<td>
					<input type="checkbox" class="checkbox" name="ftp[{FTP.ID}][ssl]" id="ftp_useSSL{FTP.ID}" value="1"{FTP.FTP_SSL_DISABLED}{FTP.FTP_SSL_ENABLED_SELECTED}{FTP.FTP_FIELDS_DISABLED} />
					<label for="ftp_useSSL{FTP.ID}">{L_FTP_USESSL}</label>
				</td>
			</tr>
			<tr>
				<td>{L_FTP_SERVER}:</td>
				<td>
					<input class="text" type="text" size="60" name="ftp[{FTP.ID}][server]" id="ftp_server{FTP.ID}" value="{FTP.FTP_SERVER}"{FTP.FTP_FIELDS_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_FTP_PORT}:</td>
				<td>
					<input class="text" type="text" size="2" name="ftp[{FTP.ID}][port]" id="ftp_port{FTP.ID}" value="{FTP.FTP_PORT}"{FTP.FTP_FIELDS_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_FTP_USER}:</td>
				<td>
					<input class="text" type="text" size="60" name="ftp[{FTP.ID}][user]" id="ftp_user{FTP.ID}" value="{FTP.FTP_USER}"{FTP.FTP_FIELDS_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_FTP_PASS}:</td>
				<td>
					<input class="text" type="password" size="60" name="ftp[{FTP.ID}][pass]" id="ftp_pass{FTP.ID}" value="{FTP.FTP_PASSWORD}"{FTP.FTP_FIELDS_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_FTP_DIR}:</td>
				<td>
					<input class="text" type="text" size="60" name="ftp[{FTP.ID}][dir]" id="ftp_dir{FTP.ID}" value="{FTP.FTP_DIRECTORY}"{FTP.FTP_FIELDS_DISABLED} />
				</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>
					<p style="padding-left:8px;">
						<input type="submit" name="ftp[{FTP.ID}][test]" id="testFTP{FTP.ID}" value="{L_TESTCONNECTION}"{FTP.FTP_FIELDS_DISABLED} class="Formbutton" />
						<button type="button" class="Formbutton" onclick="$('config_form').action='index.php?p=config#ftp';$('config_form').submit();">{ICON_SAVE} {L_SAVE}</button>
						<button type="button" class="Formbutton" onclick="if (!confirm('{FTP.FTP_CONFIRM_DELETE}')) return false; $('config_form').action='index.php?p=config&amp;del_ftp={FTP.ID}#ftp';$('config_form').submit();">{ICON_DELETE} {L_FTP_CONNECTION_DELETE}</button>
						<!-- BEGIN CHECK -->
							<br /><br />
							<span class="small">{FTP.CHECK.RESULT}</span>
						<!-- END CHECK -->
					</p>
				</td>
			</tr>
		</table>
		</fieldset>
	<!-- END FTP -->
	</fieldset>
	<br />
</div>