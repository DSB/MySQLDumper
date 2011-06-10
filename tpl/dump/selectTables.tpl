<div id="content">
<h2>{PAGETITLE}</h2>
<h3>{L_DB}: {DATABASE}</h3>
<form id="frm_tbl" action="index.php?p=dump&amp;action=do_dump&amp;MySQLDumper={SESSION_ID}" method="post">
<p>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',true);">{ICON_OK} {L_SELECTALL}</button>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',false);">{ICON_DELETE}
        {L_DESELECTALL}</button>
    <button type="submit" class="Formbutton" name="dump_tbl"
        onclick="if (!tablesChecked('frm_tbl')) { alert('{L_SQL_NOTABLESSELECTED}'); return false }">{ICON_DB}
        {L_STARTDUMP}
    </button>
</p>

<table class="bdr">
    <tr class="thead">
        <th>#</th>
        <th>{L_NAME}</th>
        <th>{L_DUMP}</th>
        <th>{L_INFO_RECORDS}</th>
        <th>{L_INFO_SIZE}</th>
        <th>{L_INFO_LASTUPDATE}</th>
        <th>{L_TABLE_TYPE}</th>

    </tr>
    <!-- BEGIN ROW -->
    <tr class="{ROW.CLASS}">
        <td class="right small">{ROW.NR}.</td>
        <td class="small"><label for="t{ROW.ID}">{ROW.TABLENAME}</label></td>
        <td class="sm" align="left"><input type="checkbox" class="checkbox" name="sel_tbl[]" id="t{ROW.ID}"
            value="{ROW.TABLENAME}" /> <!--
			<input type="checkbox" class="checkbox" name="chk_tbl_data" id="t_data{ROW.ID}" value="{ROW.TABLENAME}" />
			 --></td>
        <td class="right small">{ROW.RECORDS}</td>
        <td class="right small">{ROW.SIZE}</td>
        <td class="small">{ROW.LAST_UPDATE}</td>
        <td class="small">{ROW.TABLETYPE}</td>
    </tr>
    <!-- END ROW -->
</table>
<p>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',true);">{ICON_OK} {L_SELECTALL}</button>
    <button type="button" class="Formbutton" onclick="checkAllCheckboxes('frm_tbl',false);">{ICON_DELETE}
        {L_DESELECTALL}</button>
    <button type="submit" class="Formbutton" name="dump_tbl"
        onclick="if (!tablesChecked(frm_tbl)) { alert('{L_SQL_NOTABLESSELECTED}'); return false }">{ICON_DB}
        {L_STARTDUMP}
    </button>
</p>
</form>
</div>
