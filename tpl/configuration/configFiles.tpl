<div id="panel_configfiles" class="panel" style="display:none">
	<fieldset>
		<legend>{L_CONFIGFILES}</legend>
		<table>
			<tr class="dbrow">
				<td style="vertical-align:middle">{L_CREATE_CONFIGFILE}:</td>
				<td style="vertical-align:middle">
					<input type="text" class="text" style="width:300px;" name="new_configurationfile" value="" />
				</td>
				<td colspan="2">
					<button class="Formbutton" type="button" name="create_new_configfile" onclick="$('config_form').action='index.php?p=config&amp;create_new_configfile=1';correctFormAction();$('config_form').submit();">{ICON_SAVE} {L_SAVE}</button>
				</td>
			</tr>
		</table>
		
		<br />
		<table class="bdr" style="width:100%">
			<tr class="thead">
				<th class="right">#</th>
				<th class="left">{L_CONFIGFILE} / {L_MYSQL_DATA}</th>
				<th class="left">{L_CONFIGURATIONS}</th>
				<th class="left">{L_ACTION}</th>
			</tr>
			<!-- BEGIN ROW -->
			<tr class="{ROW.ROWCLASS}">
				<td class="right">
					<a name="config{ROW.CONFIG_ID}" style="text-decoration:none;">{ROW.NR}.</a>
				</td>
				<td>
					<table>
						<tr>
							<td>{L_NAME}:</td>
							<td><strong>{ROW.CONFIG_NAME}</strong></td>
						</tr>
						<tr>
							<td>{L_DB_HOST}:</td>
							<td><strong>{ROW.DB_HOST}</strong></td>
						</tr>
						<tr>
							<td>{L_DB_USER}:</td>
							<td><strong>{ROW.DB_USER}</strong></td>
						</tr>
						<tr>
							<td>{L_DBS}:</td>
							<td>
								<a href="#config{ROW.CONFIG_ID}" onclick="mySlide('show_db{ROW.CONFIG_ID}');">
								{ICON_SEARCH} <strong>{ROW.NR_OF_DATABASES}</strong></a>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div id="show_db{ROW.CONFIG_ID}" style="padding:0;margin:0;display:none;">
								<table  class="bdr">
								<!-- BEGIN LIST_DBS -->
									<tr class="{ROW.LIST_DBS.ROWCLASS}">
										<td style="text-align:right;">
											{ROW.LIST_DBS.NR}.&nbsp;
										</td>
										<td>
											<a href="index.php?p=sql&amp;action=list_tables&amp;db={ROW.LIST_DBS.DB_NAME_URLENCODED}">{ROW.LIST_DBS.DB_NAME}</a>
										</td>
									</tr>
								<!-- END LIST_DBS -->
								</table>
								</div>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<table>
						<tr>
							<td>{L_BACKUP_DBS}:</td>
							<td><strong>{ROW.DBS_TO_BACKUP}</strong></td>
						</tr>
						<!-- BEGIN USE_MULTIPART -->
						<tr>
							<td>{L_MULTI_PART}:</td>
							<td><strong>{L_FILESIZE} {ROW.USE_MULTIPART.MULTIPART_FILESIZE}</strong></td>
						</tr>
						<!-- END USE_MULTIPART -->

						<!-- BEGIN SEND_EMAIL -->
						<tr>
							<td>{L_SEND_MAIL_FORM}:</td>
							<td class="small">
								{L_EMAIL_RECIPIENT}: <strong>{ROW.SEND_EMAIL.RECIPIENT}</strong><br />
								{L_EMAIL_CC}: <strong>{ROW.SEND_EMAIL.RECIPIENT_CC}</strong><br />
								{L_ATTACH_BACKUP}<br />
								<!-- BEGIN EMAIL_MAX_SIZE -->
									{L_MAX_UPLOAD_SIZE}: <strong>{ROW.SEND_EMAIL.EMAIL_MAX_SIZE.SIZE}</strong>
								<!-- END EMAIL_MAX_SIZE -->
							</td>
						</tr>
						<!-- END SEND_EMAIL -->

						<!-- BEGIN SEND_FTP -->
						<tr>
							<td>{L_FTP}:</td>
							<td class="small">{ROW.SEND_FTP.FTP_SETTINGS}</td>
						</tr>
						<!-- END USE_MULTIPART -->
						
					</table>
				</td>
				
				<td>
					<a href="index.php?p=config&amp;config={ROW.CONFIG_NAME_URLENCODED}&amp;sel=configs#configfiles">{ICON_EDIT}</a>
					<!-- BEGIN DELETE_CONFIG -->
						<a href="index.php?p=config&amp;config_delete={ROW.CONFIG_NAME_URLENCODED}&amp;sel=configs#configfiles" onclick="if(!confirm('{ROW.DELETE_CONFIG.CONFIRM_DELETE}')) return false;">{ICON_DELETE}</a>
					<!-- END DELETE_CONFIG -->
				</td>			
			</tr>
			<!-- END ROW -->
		</table>
	</fieldset>
</div>
						