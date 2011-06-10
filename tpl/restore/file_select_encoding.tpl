<div id="content">
<h2>{PAGETITLE}</h2>
<h4>{L_DB}: {DATABASE}</h4>
<p>{L_CHOOSE_CHARSET}</p>
<form action="index.php?p=files&amp;action=restore" method="post">
<table>
	<tr>
		<td>{L_FM_CHOOSE_ENCODING}:</td>
		<td>
			<select name="sel_dump_encoding_restore">
				{ENCODING_SELECT}
			</select>
		</td>
		</tr>
		<tr>
			<td colspan="2">
				<br />
				<input type="submit" name="restore" class="Formbutton" value="{L_FM_RESTORE}" />
				<input type="hidden" name="file[0]" value="{FILE_NAME}" />
			</td>
		</tr>
	</table>
</form>
</div>
