<script type="text/javascript">
/*<![CDATA[*/
function check_databases()
{
	if (!$('database_form').getInputs('checkbox','database[]').pluck('checked').any()) 
	{
		alert('{L_NO_DB_SELECTED}');
		return false;
	}
	else return true;
}
/*]]>*/
</script>

<button type="button" class="Formbutton" onclick="location.href='index.php?p=sql&amp;dbrefresh=true'">{ICON_DB} {L_LOAD_DATABASE}</button>
<!--
<button type="button" class="Formbutton" onclick="location.href='index.php?p=sql&amp;action=new_db'">{ICON_EDIT} {L_CREATE_DATABASE}</button>
-->
<br class="clear" />

<h4>{L_INFO_DATABASES}:</h4>

<form action="index.php?p=sql&amp;action=list_databases" id="database_form" method="post" onsubmit="return check_databases();">
<table class="bdr">

<tr class="thead nowrap">
    <td>&nbsp;</td>
	<td colspan="5">
		<div class="middle" style="padding:6px 0 6px 0;">
			<button class="Formbutton" type="submit" onclick="if (!check_databases()) return false; if (!confirm('{CONFIRM_TRUNCATE_DATABASES}')) return false;setVal('do','db_truncate');">{ICON_DELETE} {L_EMPTY}</button>
			<button class="Formbutton" type="submit" onclick="if (!check_databases()) return false; if (!confirm('{CONFIRM_DROP_DATABASES}')) return false;setVal('do','db_delete');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>
</tr>

<tr class="thead nowrap">
    <th>{L_ACTION}</th>
	<th>
        <a href="javascript:checkAllCheckboxes('database_form',true)">{ICON_PLUS}</a>
        <a href="javascript:checkAllCheckboxes('database_form',false)">{ICON_MINUS}</a>
	</th>
	<th>#
		<input type="hidden" name="db" id="db" value="" />
		<input type="hidden" name="do" id="do" value="" />
	</th>
	<th>{L_DBS}</th>
	<th colspan="2">{L_TABLES}</th>
</tr>

<!-- BEGIN DB_NOT_FOUND -->
	<tr class="{DB_NOT_FOUND.ROWCLASS}">
		<td class="right">{DB_NOT_FOUND.NR}.</td>
		<td>{DB_NOT_FOUND.DB_NAME}</td>
		<td colspan="4">{L_INFO_NODB}</td>
	</tr>
<!-- END DB_NOT_FOUND -->

<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} nowrap">
    <td>
        <a href="index.php?p=sql&amp;action=list_tables&amp;db={ROW.DB_ID}">{ICON_VIEW}</a>
        <a href="index.php?p=sql&amp;truncate_db={ROW.DATABASE_NAME_URLENCODED}" onclick="if (!confirm('{CONFIRM_TRUNCATE_DATABASES}')) return false;">{ICON_TRUNCATE}</a>
        <a href="index.php?p=sql&amp;drop_db={ROW.DATABASE_NAME_URLENCODED}" onclick="if (!confirm('{CONFIRM_DROP_DATABASES}')) return false;">{ICON_DELETE}</a>
    </td>
	<td class="right small">
		<input type="checkbox" class="right" name="database[]" id="database_{ROW.NR}" value="{ROW.DATABASE_NAME_URLENCODED}"
			<!-- BEGIN DATABASE_CHECKED -->
				checked="checked"
			<!-- END DATABASE_CHECKED -->
		 />
		<input type="hidden" name="databasename" id="databasename_{ROW.NR}" value="{ROW.DB_NAME}" />
	</td>
	<td class="right small"><label for="database_{ROW.NR}">{ROW.NR}.</label></td>
	<td class="small">
		<label for="database_{ROW.NR}">{ROW.DB_NAME}</label>
	</td>
	<td class="right small"><label for="database_{ROW.NR}">{ROW.TABLE_COUNT}</label></td>	
	<td class="small">
	   <label for="database_{ROW.NR}">
			<!-- BEGIN TABLE -->
				{L_TABLE}
			<!-- END TABLE -->
			<!-- BEGIN TABLES -->
				{L_TABLES}
			<!-- END TABLES -->
		</label>
	</td>
</tr>
<!-- END ROW -->

<tr class="thead nowrap">
    <th>&nbsp;</th>
    <th>
        <a href="javascript:checkAllCheckboxes('database_form',true)">{ICON_PLUS}</a>
        <a href="javascript:checkAllCheckboxes('database_form',false)">{ICON_MINUS}</a>
    </th>
    <th colspan="4">&nbsp;</th>
</tr>

<tr class="thead nowrap">
    <td>&nbsp;</td>
    <td colspan="5">
        <div class="middle" style="padding:6px 0 6px 0;">
            <button class="Formbutton" type="submit" onclick="if (!check_databases()) return false; if (!confirm('{CONFIRM_TRUNCATE_DATABASES}')) return false;setVal('do','db_truncate');">{ICON_DELETE} {L_EMPTY}</button>
            <button class="Formbutton" type="submit" onclick="if (!check_databases()) return false; if (!confirm('{CONFIRM_DROP_DATABASES}')) return false;setVal('do','db_delete');">{ICON_DELETE} {L_DELETE}</button>
        </div>
    </td>
</tr>
</table>
</form>
<br class="clear" />