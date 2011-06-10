<div id="content">
<h2>{PAGETITLE}</h2>
<h3>{L_DB}: {DATABASE}</h3>

<form action="index.php?p=restore" id="frm_tbl" method="post">
<div>
	<button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',true);">{ICON_OK} {L_SELECTALL}</button>
	<button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',false);">{ICON_DELETE} {L_DESELECTALL}</button>
	<button type="submit" class="Formbutton" name="restore_tbl" onclick="if (!tablesChecked('frm_tbl')) { alert('{L_SQL_NOTABLESSELECTED}'); return false };if (!confirm('{CONFIRM_RESTORE}')) return false;">{ICON_RESTORE} {L_RESTORE}</button>
</div>

<table class="bdr">
	<tr class="thead">
		<th>#</th>
		<th>{L_NAME}</th>
		<th>{L_RESTORE}</th>
		<th>{L_INFO_RECORDS}</th>
		<th>{L_INFO_SIZE}</th>
		<th>{L_INFO_LASTUPDATE}</th>
		<th>{L_TABLE_TYPE}</th>
	</tr>
	<!-- BEGIN NO_MSD_BACKUP -->
	<tr>
		<td colspan="7">{L_NO_MSD_BACKUP}</td>
	</tr>
	<!-- END NO_MSD_BACKUP -->

	<!-- BEGIN ROW -->
	<tr class="{ROW.CLASS}">
		<td class="right small">{ROW.NR}.</td>
		<td class="small">
			<label for="t{ROW.ID}" style="display:block">{ROW.TABLENAME}</label>
		</td>
		<td>
			<input type="checkbox" class="checkbox" name="sel_tbl[]" id="t{ROW.ID}" value="{ROW.TABLENAME}" />
			<!--
			<input type="checkbox" class="checkbox" name="chk_tbl_data" id="t_data{ROW.ID}" value="{ROW.TABLENAME}" />
			 -->
		</td>
		<td  class="small right">
			<strong>{ROW.RECORDS}</strong>
		</td>
		<td  class="small right">{ROW.SIZE}</td>
		<td class="small">{ROW.LAST_UPDATE}</td>
		<td class="small">{ROW.TABLETYPE}</td>
	</tr>
	<!-- END ROW -->
</table>
<p>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',true);">{ICON_OK} {L_SELECTALL}</button>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',false);">{ICON_DELETE} {L_DESELECTALL}</button>
    <button type="submit" class="Formbutton" name="restore_tbl" onclick="if (!tablesChecked('frm_tbl')) { alert('{L_SQL_NOTABLESSELECTED}'); return false };if (!confirm('{CONFIRM_RESTORE}')) return false;">{ICON_RESTORE} {L_RESTORE}</button>
	<input type="hidden" name="filename" value="{FILENAME}" />
</p>
</form>
</div>