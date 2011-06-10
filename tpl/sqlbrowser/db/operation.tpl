<h4>{ACTION}:</h4>

<table class="bdr">
<tr class="thead nowrap">
	<td class="right">#</td>
	<th class="left">{L_DB}</th>
	<th class="left">{L_ACTION}</th>
	<th colspan="3" class="left">{L_SQL_OUTPUT}</th>
</tr>

<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} nowrap">
	<td class="small right">{ROW.NR}.</td>
	<td class="small right">{ROW.DBNAME}</td>
	<td class="small">{ROW.ACTION}</td>
	<td class="small right">{ICON_OK}</td>
	<td colspan="2" class="small">{ROW.QUERY}</td>
</tr>
<!-- END ROW -->

<!-- BEGIN ERROR -->
<tr class="{ERROR.ROWCLASS}">
	<td class="right">{ERROR.NR}.</td>
	<td class="small">{ERROR.DBNAME}</td>
	<td class="small">{ERROR.ACTION}</td>
	<td>{ERROR.QUERY}</td>
	<td class="right">{ICON_NOTOK}</td>
	<td class="error">{L_ERROR}: {ERROR.ERROR}</td>
</tr>
<!-- END ERROR -->

</table>
