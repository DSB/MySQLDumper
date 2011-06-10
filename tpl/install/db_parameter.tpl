<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
<tr class="dbrow">
	<td>{L_STEP} 1: <span class="small">{L_SELECT_LANGUAGE} ({LANGUAGE})</span> {ICON_OK}</td>
	<td>{L_STEP} 2: <span class="small">{L_CHECK_DIRS}</span> {ICON_OK}</td>
	<td>{L_STEP} 3: <span class="small">{L_DBPARAMETER}</span>
	<!-- BEGIN OK -->
		{ICON_OK}
	<!-- END OK -->
	</td>
</tr>
</table>

<h3>{L_STEP} 3: {L_DBPARAMETER}</h3>
<form action="install.php?MySQLDumper={SESSION_ID}&amp;phase=2" method="post">
<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
	<!-- BEGIN CONTINUE -->
		<tr class="thead">
			<td colspan="5" style="text-align:center;">
				<br />
				<a class="Formbutton" href="install.php?MySQLDumper={SESSION_ID}&amp;phase=3">
					{ICON_SAVE} {CONTINUE.SAVE_AND_CONTINUE}
				</a><br class="clear" /><br />
			</td>
		</tr>
	<!-- END CONTINUE -->
	
	<tr class="dbrow">
		<td>{L_DB_HOST}:</td>
		<td>
			<input class="text" type="text" name="dbhost" value="{DB_HOST}" style="width:250px" maxlength="100" />
		</td>
	</tr>
	<tr class="dbrow1">
		<td>{L_DB_USER}:</td>
		<td><input class="text" type="text" name="dbuser" value="{DB_USER}" style="width:250px" maxlength="100" /></td>
	</tr>
	<tr class="dbrow">
		<td>{L_DB_PASS}:</td>
		<td><input class="text" type="password" name="dbpass" value="{DB_PASS}" style="width:250px" maxlength="100" /></td>
	</tr>
	<tr class="dbrow1">
		<td>* {L_DB}:<p class="small">({L_ENTER_DB_INFO})</p></td>
		<td><input class="text" type="text" name="dbmanual" value="{DB_MANUAL}" style="width:250px" maxlength="100" /></td>
	</tr>
	<tr class="dbrow">
		<td>{L_PORT}:
			<br /><span class="small">{L_INSTALL_HELP_PORT}</span>
		</td>
		<td><input class="text" type="text" name="dbport" value="{DB_PORT}" style="width:50px" maxlength="5" /></td>
	</tr>
	<tr class="dbrow1">
		<td>{L_SOCKET}:
			<br /><span class="small">{L_INSTALL_HELP_SOCKET}</span>
		</td>
		<td><input class="text" type="text" name="dbsocket" value="{DB_SOCKET}" style="width:250px" maxlength="255" />
		</td>
	</tr>
	<tr class="dbrow">
		<td>{L_TESTCONNECTION}:</td>
		<td><input type="submit" name="dbconnect" value="{L_CONNECTTOMYSQL}" class="Formbutton" /></td>
	</tr>
</table>
</form>

<br />
<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
	<!-- BEGIN CONNECTION_ERROR -->
		<tr>
			<td colspan="5">
				<br />{CONNECTION_ERROR.MSG}<br />
			</td>
		</tr>				
	<!-- END CONNECTION_ERROR -->
			
	<!-- BEGIN CONNECTION_OK -->
		<tr class="thead">
			<th colspan="5">{ICON_OK} {L_DBCONNECTION}</th>
		</tr>
		<tr class="dbrow">
			<td colspan="5" class="small success">{CONNECTION_OK.RESULT}</td>
		</tr>
	<!-- END CONNECTION_OK -->

	<!-- BEGIN CONNECTION_OK_BUT_NO_DB -->
		<tr><td colspan="5">{ICON_OK} {L_NO_DB_FOUND_INFO}</td></tr>
		<tr>
			<td colspan="5" style="text-align:center">
				<form action="install.php?MySQLDumper={SESSION_ID}&amp;phase=3" method="post">
					<button type="submit" name="submit" class="Formbutton">{ICON_OK} {L_SAVEANDCONTINUE}</button>
				</form>
			</td>
		</tr>
	<!-- END CONNECTION_OK_BUT_NO_DB -->

	<!-- BEGIN CONTINUE -->
		<tr class="thead">
			<td colspan="5" style="text-align:center;">
				<br />
				<a class="Formbutton" href="install.php?phase=3&amp;MySQLDumper={SESSION_ID}">
					{ICON_SAVE} {CONTINUE.SAVE_AND_CONTINUE}
				</a><br class="clear" /><br />
			</td>
		</tr>
	<!-- END CONTINUE -->

</table>
<br />
	