<script type="text/javascript">
/*<![CDATA[*/
function show_perl_output(perlsource)
{
	$('perloutput_div').appear();
	$('perloutput').src=perlsource;
}

Event.observe(window, 'load', loadTabs, false);
function loadTabs()
{
  var tabs = new tabset('headnavi');
  tabs.autoActivate($('tab_php'));
}
/*]]>*/
</script>

<div id="content">
<h2>{L_DUMP}</h2>

<div id="headnavi">
	<ul class="Formbutton" id="tabnav">
		<li><a href="#tab_php" id="tab_php" class="tab Formbutton">{L_DUMP} PHP</a></li>
		<li><a href="#tab_perl" id="tab_perl" class="tab Formbutton">{L_DUMP} Perl</a></li>
	</ul>
</div>

<div>
<h3>{L_FM_DUMPSETTINGS} ({L_CONFIG_HEADLINE}: {CONFIG_FILE})</h3>
<table class="bdr">
	<tr class="dbrow">
		<td class="small">{L_DBS}:</td>
		<td class="small right">
			{NR_OF_DBS}<br />
			{DBS_TO_BACKUP}</td>
	</tr>
	<tr class="dbrow1">
		<td class="small">{L_TABLES}:</td>
		<td class="small right">{TABLES_TOTAL}</td>
	</tr>
	<tr class="dbrow">
		<td class="small">{L_RECORDS}:</td>
		<td class="small right">{RECORDS_TOTAL}</td>
	</tr>
	<tr class="dbrow1">
		<td class="small">{L_DATASIZE}:</td>
		<td class="small right">{DATASIZE_TOTAL}<br />
		</td>
	</tr>
	<tr class="dbrow1">
		<td colspan="2" class="small">
			&nbsp;&nbsp;<span class="small right">({L_DATASIZE_INFO}.)</span>
		</td>
	</tr>
	
	<tr class="dbrow">
		<td class="small">{L_GZIP}:</td>
		<td class="small right">
				<!-- BEGIN GZIP_ACTIVATED -->
					{L_YES}
				<!-- END GZIP_ACTIVATED -->

				<!-- BEGIN GZIP_NOT_ACTIVATED -->
					{L_NO}
				<!-- END GZIP_NOT_ACTIVATED -->
		</td>
	</tr>

	<!-- BEGIN NO_MULTIPART -->
	<tr class="dbrow1">
		<td class="small">{L_MULTI_PART}:</td>
		<td class="small right" colspan="2">{L_NO}</td>
	</tr>
	<!-- END NO_MULTIPART -->

	<!-- BEGIN MULTIPART -->
	<tr class="dbrow1">
		<td class="small">{L_MULTI_PART}:</td>
		<td class="small right">{L_YES}</td>
	</tr>
	<tr>
		<td class="small">&nbsp;&nbsp;{L_MULTIPART_SIZE}:</td>
		<td class="small right">{MULTIPART.SIZE}</td>
	</tr>
	<!-- END MULTIPART -->

	<tr class="dbrow">
		<td class="small">{L_SEND_MAIL_FORM}:</td>
		<td class="small right">
			<!-- BEGIN NO_SEND_MAIL -->
				{L_NO}
			<!-- END NO_SEND_MAIL -->
			
			<!-- BEGIN SEND_MAIL -->
				<table style="width:100%">
					<!-- BEGIN ATTACH_BACKUP -->
						<tr class="dbrow">
							<td class="small" colspan="2">{L_ATTACH_BACKUP}</td>
						</tr>
						<tr class="dbrow1">
							<td class="small">{L_MAX_UPLOAD_SIZE}:</td>
							<td class="small right">{SEND_MAIL.ATTACH_BACKUP.SIZE}</td>
						</tr>					
					<!-- END ATTACH_BACKUP -->

					<!-- BEGIN DONT_ATTACH_BACKUP -->
						<tr class="dbrow">
							<td class="small" colspan="2">{L_DONT_ATTACH_BACKUP}</td>
						</tr>
					<!-- END DONT_ATTACH_BACKUP -->

					<tr class="dbrow">
						<td class="small">{L_EMAIL_RECIPIENT}:</td>
						<td class="small right">{SEND_MAIL.RECIPIENT}</td>
					</tr>

					<!-- BEGIN CC -->
					<tr class="dbrow1">
						<td class="small">{L_EMAIL_CC}:</td>
						<td class="small right">{SEND_MAIL.CC.EMAIL_ADRESS}</td>
					</tr>
					<!-- END CC -->

				</table>				
			<!-- END SEND_MAIL -->
		</td>
	</tr>

	<!-- BEGIN FTP -->
	<tr class="{FTP.ROWCLASS}">
		<td class="small">{L_FTP_TRANSFER} {FTP.NR}:</td>
		<td class="small">
			<table style="width:100%">
				<!-- BEGIN CONNECTION -->
				<tr class="dbrow">
					<td class="small">{L_FTP_SERVER}, {L_FTP_PORT}:</td>
					<td class="small right">{FTP.CONNECTION.SERVER}:{FTP.CONNECTION.PORT}</td>
				</tr>
				<tr class="dbrow1">
					<td class="small">{L_FTP_DIR}:</td>
					<td class="small right">{FTP.CONNECTION.DIR}</td>
				</tr>
				<!-- END CONNECTION -->
			</table>
		</td>
	</tr>
	<!-- END FTP -->
</table>
</div>

<div id="panel_php" class="panel" style="display:none">
		<form id="fm" method="post" action="index.php?p=dump&amp;action=select_tables">
		<h3>{L_DUMP} PHP ({L_CONFIG_HEADLINE}: {CONFIG_FILE})</h3>
		<div>
			<button class="Formbutton" name="dump" type="submit">{L_FM_STARTDUMP}</button>
		</div>
		
		<div>
			<table class="bdr">
				<!-- BEGIN TABLESELECT -->
				<tr class="dbrow1">
					<td><label for="tableselect">{L_FM_SELECTTABLES}:</label></td>
					<td><input type="checkbox" class="checkbox noleftmargin" name="tableselect" id="tableselect" value="1" /></td>
				</tr>
				<!-- END TABLESELECT -->
				<!-- BEGIN MODE_EXPERT -->
				<tr class="dbrow1">
					<td><label for="backup_using_updates">Update (REPLACE Command):</label></td>
					<td><input type="checkbox" class="checkbox noleftmargin" name="backup_using_updates" id="backup_using_updates" value="1" /></td>
				</tr>
				<!-- END MODE_EXPERT -->
				<tr class="dbrow">
					<td><label for="comment">{L_FM_COMMENT}:</label></td>
					<td>
						<input type="text" class="text noleftmargin" style="width:260px;" id ="comment" name="comment" value="{TABLESELECT.COMMENT}" />
					</td>
				</tr>
				<tr class="dbrow1">
					<td>
						<label for="sel_dump_encoding">{L_FM_CHOOSE_ENCODING}:</label>
					</td>
					<td>
						<select name="sel_dump_encoding" id="sel_dump_encoding">
							{POSSIBLE_DUMP_ENCODINGS}
						</select>
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>

<div id="panel_perl" class="panel" style="display:none">
	<h3>{L_DUMP} PERL ({L_CONFIG_HEADLINE}: {CONFIG_FILE})</h3>
			<button class="Formbutton" name="DoCronscript" onclick="show_perl_output('{PERL_HTTP_CALL}')">{L_DOCRONBUTTON}</button>
			<button class="Formbutton" name="DoSimpleTest" onclick="show_perl_output('{PERL_TEST}')">{L_DOSIMPLETEST}</button>
			<button class="Formbutton" name="DoPerlTest" onclick="show_perl_output('{PERL_MODULTEST}')">{L_DOPERLTEST}</button>
			<br />
				
		<table class="bdr" style="width:90%">
			<tr class="dbrow1">
				<td>{L_PERLOUTPUT2}:</td>
				<td style="width:60%"><input class="text" style="width:95%" type="text" value="{PERL_HTTP_CALL}" /></td>
			</tr>
			<tr class="dbrow">
				<td>{L_PERLOUTPUT3}:</td>
				<td><input class="text" style="width:95%" type="text" value="{PERL_CRONTAB_CALL}" /></td>
			</tr>
			<tr class="dbrow">
				<td>{L_PERLOUTPUT1}:</td>
				<td><input class="text" style="width:95%" type="text" value="{PERL_ABSOLUTE_PATH_OF_CONFIGDIR}" /></td>
			</tr>
		</table>
		<br />		
	<div id="perloutput_div" style="width:100%;height:200px;overflow:hidden;display:none;">
		<iframe id="perloutput" style="width:100%;height:100%;"></iframe>
	</div>
</div>
	

</div>
