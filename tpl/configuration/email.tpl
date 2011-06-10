<script type="text/javascript">
/*<![CDATA[*/
var emailfields=['email_recipient_name','email_recipient_address',
<!-- BEGIN EMAIL_RECIPIENT_CC -->
'email_recipient_cc_{EMAIL_RECIPIENT_CC.NR}_name','email_recipient_cc_{EMAIL_RECIPIENT_CC.NR}_address',
<!-- END EMAIL_RECIPIENT_CC -->

'email_sender_name','email_sender_address','attach_backup_1','attach_backup_2',
'use_mailer_0','use_mailer_1','use_mailer_2','sendmail_call','smtp_server','smtp_port','smtp_use_auth_1','smtp_use_auth_2',
'smtp_use_ssl_1','smtp_use_ssl_2'];
var smtpfields=['smtp_server','smtp_port','smtp_use_auth_1','smtp_use_auth_2','smtp_pop3_server','smtp_pop3_port',
'smtp_use_ssl_1','smtp_use_ssl_2','smtp_pop3_server','smtp_pop3_port'];
var smtp_auth_fields=['smtp_user','smtp_pass','smtp_pop3_server','smtp_pop3_port'];
var sendmailfields=['sendmail_call'];
function showMailDiv()
{
	if (document.getElementById('send_mail_1').checked)
	{
		objs_enable(emailfields);
		if (document.getElementById('use_mailer_1').checked)
		{
			mySlideDown('email_sendmail');
			mySlideUp('email_smtp');
		}
		if (document.getElementById('use_mailer_2').checked)
		{
			mySlideUp('email_sendmail');
			mySlideDown('email_smtp');
		}
	}
}
/*]]>*/
</script>

<div id="panel_email" class="panel" style="display:none">
	<fieldset>
		<legend>{L_CONFIG_EMAIL}</legend>
		<table>
		<tr>
			<td>{L_SEND_MAIL_FORM}:</td>
			<td colspan="5">
				<input type="radio" class="radio" value="1" name="send_mail" id="send_mail_1" onclick="showMailDiv();"{SEND_MAIL_ENABLED_SELECTED} /><label for="send_mail_1">{L_YES}</label>
				<input type="radio" class="radio" value="0" name="send_mail" id="send_mail_2"
					onclick="objs_disable(emailfields);mySlideUp('email_sendmail');mySlideUp('email_smtp');"{SEND_MAIL_DISABLED_SELECTED} /><label for="send_mail_2">{L_NO}</label>
			</td>
		</tr>
		<tr>
			<td>{L_EMAIL_SENDER}:</td>
			<td class="small">{L_NAME}:</td>
			<td>
				<input type="text" class="text inputsize-middle" name="email_sender_name" id="email_sender_name" value="{EMAIL_SENDER_NAME}" size="30"{EMAIL_DISABLED} />
			</td>
			<td class="small">{L_EMAIL_ADDRESS}:</td>
			<td colspan="2">
				<input type="text" class="text" name="email_sender_address" id="email_sender_address" value="{EMAIL_SENDER_ADDRESS}" size="30"{EMAIL_DISABLED} />
			</td>
		</tr>
		<tr>
			<td>{L_EMAIL_RECIPIENT}:</td>
			<td class="small">{L_NAME}:</td>
			<td>
				<input type="text" class="text inputsize-middle" name="email_recipient_name" id="email_recipient_name" value="{EMAIL_RECIPIENT_NAME}" size="30"{EMAIL_DISABLED} />
			</td>
			<td class="small">{L_EMAIL_ADDRESS}:</td>
			<td colspan="2">
				<input type="text" class="text" name="email_recipient_address" id="email_recipient_address" value="{EMAIL_RECIPIENT_ADDRESS}" size="30"{EMAIL_DISABLED} />
			</td>
		</tr>
		<tr>
			<td>{L_EMAIL_CC}:</td>
			<td colspan="5">
				<button class="Formbutton" type="submit" name="add_recipient_cc" onclick="$('config_form').action='index.php?p=config&amp;action=add_recipient_cc';$('config_form').submit();">{ICON_PLUS} {L_ADD_RECIPIENT}</button>
			</td>
		</tr>

		<!-- BEGIN EMAIL_RECIPIENT_CC -->
		<tr>
			<td>&nbsp;</td>
			<td class="small">{L_NAME}:</td>
			<td>
				<input type="text" class="text inputsize-middle" name="email_recipient_cc[{EMAIL_RECIPIENT_CC.NR}][name]" id="email_recipient_cc_{EMAIL_RECIPIENT_CC.NR}_name" value="{EMAIL_RECIPIENT_CC.EMAIL_RECIPIENT_CC_NAME}" size="30"{EMAIL_DISABLED} />
			</td>
			<td class="small">{L_EMAIL_ADDRESS}:</td>
			<td>
				<input type="text" class="text" name="email_recipient_cc[{EMAIL_RECIPIENT_CC.NR}][address]" id="email_recipient_cc_{EMAIL_RECIPIENT_CC.NR}_address" value="{EMAIL_RECIPIENT_CC.EMAIL_RECIPIENT_CC_ADDRESS}" size="30" maxlength="255"{EMAIL_DISABLED} />
			</td>
			<td>
				<button class="Formbutton" type="button" name="delete_recipient_cc" onclick="if (!confirm('{EMAIL_RECIPIENT_CC.CONFIRM_RECIPIENT_DELETE}')) return false; $('config_form').action='index.php?p=config&amp;action=delete_recipient_cc&amp;cc={EMAIL_RECIPIENT_CC.NR}';$('config_form').submit();">{ICON_DELETE} {L_REMOVE}</button>
			</td>
		</tr>
		<!-- END RECIPIENT_CC -->

		<tr>
			<td>{L_ATTACH_BACKUP}:</td>
			<td colspan="5">
				<input type="radio" class="radio" value="1" name="attach_backup" id="attach_backup_1" onclick="obj_toggle(this,['email_maxsize1','email_maxsize2'])"{ATTACH_BACKUP_ENABLED_SELECTED}{EMAIL_DISABLED} /><label for="attach_backup_1">{L_YES}</label>
				<input type="radio" class="radio" value="0" name="attach_backup" id="attach_backup_2" onclick="obj_toggle($('config_form').attach_backup_1,['email_maxsize1','email_maxsize2'])"{ATTACH_BACKUP_DISABLED_SELECTED}{EMAIL_DISABLED} /><label for="attach_backup_2">{L_NO}</label>
			</td>
		</tr>
		<tr>
			<td>{L_EMAIL_MAXSIZE}:</td>
			<td colspan="5">
				<input type="text" class="text right" name="email_maxsize1" id="email_maxsize1" size="3" maxlength="3" value="{EMAIL_MAXSIZE}"{MAXSIZE_DISABLED} />
				<select name="email_maxsize2" id="email_maxsize2"{MAXSIZE_DISABLED}>
					<option value="1"{EMAIL_UNIT_SIZE_KB_SELECTED}>{L_UNIT_KB}</option>
					<option value="2"{EMAIL_UNIT_SIZE_MB_SELECTED}>{L_UNIT_MB}</option>
				</select>
			</td>
			</tr>
			<tr>
				<td>{L_MAILPROGRAM}:</td>
				<td colspan="5">
					<input type="radio" class="radio" name="use_mailer" id="use_mailer_0" value="0" onclick="mySlideUp('email_sendmail');mySlideUp('email_smtp');objs_disable(smtpfields);objs_disable(sendmailfields);"{EMAIL_USE_PHPMAIL_SELECTED}{EMAIL_DISABLED} /><label for="use_mailer_0">{L_PHPMAIL}</label>
					<input type="radio" class="radio" name="use_mailer" id="use_mailer_1" value="1" onclick="mySlideDown('email_sendmail');mySlideUp('email_smtp');objs_disable(smtpfields);objs_enable(sendmailfields);"{EMAIL_USE_SENDMAIL_SELECTED}{EMAIL_DISABLED} /><label for="use_mailer_1">{L_SENDMAIL}</label>
					<input type="radio" class="radio" name="use_mailer" id="use_mailer_2" value="2" onclick="mySlideUp('email_sendmail');mySlideDown('email_smtp');objs_enable(smtpfields);objs_disable(sendmailfields)"{EMAIL_USE_SMTP_SELECTED}{EMAIL_DISABLED} /><label for="use_mailer_2">{L_SMTP}</label>
				</td>
			</tr>
		</table>
	</fieldset>

	<div id="email_sendmail" style="display:none"><br />
	<fieldset>
		<legend>{L_SENDMAIL}</legend>
		<table>
			<tr>
				<td>{L_CALL}:</td>
				<td>
					<input type="text" class="text" size="30" name="sendmail_call" id="sendmail_call" value="{SENDMAIL_CALL}"{EMAIL_DISABLED} />
				</td>
			</tr>
		</table>
	</fieldset>
	</div>

	<div id="email_smtp" style="display:none"><br />
	<fieldset>
		<legend>{L_SMTP}</legend>
		<table>
			<tr>
				<td>{L_SMTP_HOST}:</td>
				<td>
					<input type="text" class="text" size="30" name="smtp_server" id="smtp_server" value="{SMTP_SERVER}"{EMAIL_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_SMTP_PORT}:</td>
				<td>
					<input type="text" class="text" size="5" name="smtp_port" id="smtp_port" value="{SMTP_PORT}"{EMAIL_DISABLED} />
				</td>
			</tr>
			<tr>
				<td>{L_AUTHORIZE}:</td>
				<td>
					<input type="radio" class="radio" name="smtp_useauth" id="smtp_use_auth_1" value="1"{SMTP_AUTH_SELECTED}{EMAIL_DISABLED}
						onclick="objs_enable(smtp_auth_fields);mySlideDown('smtp_auth_div');" /><label for="smtp_use_auth_1">{L_YES}</label>
					<input type="radio" class="radio" name="smtp_useauth" id="smtp_use_auth_2" value="0"{SMTP_AUTH_NOT_SELECTED}{EMAIL_DISABLED}
						onclick="objs_disable(smtp_auth_fields);mySlideUp('smtp_auth_div');" /><label for="smtp_use_auth_2">{L_NO}</label>
						<div id="smtp_auth_div"
						<!-- BEGIN HIDE_SMTP_AUTH_FIELDS -->
							style="display:none"
						<!-- END HIDE_SMTP_AUTH_FIELDS -->
						>
							<table>
							<!--
							<tr>
								<td>{L_POP3_SERVER}:</td>
								<td>
									<input type="text" class="text" size="30" name="smtp_pop3_server" id="smtp_pop3_server" value="{SMTP_POP3_SERVER}"{EMAIL_DISABLED}{SMTP_AUTH_DISABLED} />
								</td>
							</tr>
							<tr>
								<td>{L_POP3_PORT}:</td>
								<td>
									<input type="text" class="text" size="5" name="smtp_pop3_port" id="smtp_pop3_port" value="{SMTP_POP3_PORT}"{EMAIL_DISABLED}{SMTP_AUTH_DISABLED} />
								</td>
							</tr>
							-->
							<tr>
								<td>{L_USERNAME}:</td>
								<td>
									<input type="text" class="text" size="30" name="smtp_user" id="smtp_user" value="{SMTP_USER}"{EMAIL_DISABLED}{SMTP_AUTH_DISABLED} />
								</td>
							</tr>
							<tr>
								<td>{L_PASSWORD}:</td>
								<td>
									<input type="password" class="text" size="30" name="smtp_pass" id="smtp_pass" value="{SMTP_PASS}"{EMAIL_DISABLED}{SMTP_AUTH_DISABLED} />
								</td>
							</tr>
							</table>
						</div>
				</td>
			</tr>
			<tr>
				<td>{L_USE_SSL}:</td>
				<td>
					<input type="radio" class="radio" name="smtp_usessl" id="smtp_use_ssl_1" value="1"{SMTP_SSL_SELECTED}{EMAIL_DISABLED} /><label for="smtp_use_ssl_1">{L_YES}</label>
					<input type="radio" class="radio" name="smtp_usessl" id="smtp_use_ssl_2" value="0"{SMTP_SSL_NOT_SELECTED}{EMAIL_DISABLED} /><label for="smtp_use_ssl_2">{L_NO}</label>
				</td>
			</tr>
		</table>
	</fieldset>
	</div>

	<br />
	<button class="Formbutton" type="submit" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>