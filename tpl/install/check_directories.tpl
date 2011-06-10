<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
<tr class="dbrow">
	<td>{L_STEP} 1: <span class="small">{L_SELECT_LANGUAGE} ({LANGUAGE})</span> {ICON_OK}</td>
	<td>{L_STEP} 2: <span class="small">{L_CHECK_DIRS}</span></td>
	<td>{L_STEP} 3: <span class="small">{L_DBPARAMETER}</span>
	<!-- BEGIN OK -->
		{ICON_OK}
	<!-- END OK -->
	</td>
</tr>
</table>
<br />
<h3>{L_STEP} 2: {L_CREATEDIRS}</h3>

<form action="install.php?MySQLDumper={SESSION_ID}&amp;phase=1" method="post">

<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
<!-- BEGIN SAFE_MODE_ON -->
	<tr>
		<td colspan="4" style="padding:10px;"><br /><span class="error">{L_SAFEMODEDESC}</span><br /><br /></td>
	</tr>
<!-- END SAFE_MODE_ON -->
	<tr class="thead">
		<th>{L_DIR}</th>
		<th>{L_RECHTE}</th>
		<th>{L_EXISTS}</th>
		<th>{L_IS_WRITABLE}</th>
	</tr>
	<!-- BEGIN DIR -->
		<tr>
			<td><strong>{DIR.NAME}</strong></td>
			<td class="center">{DIR.CHMOD}</td>
			<td class="center">{DIR.ICON_EXISTS}</td>
			<td class="center">{DIR.ICON_IS_WRITABLE}</td>
		</tr>
	<!-- END DIR -->
	<tr>
		<td colspan="4" style="text-align:center;">
			<br />
			<input class="Formbutton" type="submit" name="dir_check" value=" {L_CHECK_DIRS} " />
			<br /><br />
		</td>
	</tr>
</table>
</form>
