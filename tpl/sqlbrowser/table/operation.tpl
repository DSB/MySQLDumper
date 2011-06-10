<h4>{ACTION}:</h4>

<table class="bdr">
<tr class="thead nowrap">
	<td class="right">#</td>
	<th class="left">{L_TABLE}</th>
	<th class="left">{L_ACTION}</th>
	<th class="left">{L_MESSAGE_TYPE}</th>
	<th colspan="2" class="left">{L_MESSAGE}</th>
</tr>

<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} nowrap">
	<td class="small right">{ROW.NR}.</td>
	<td class="small">{ROW.TABLENAME}</td>
	<td class="small">{ROW.ACTION}</td>
	<td class="small">{ROW.TYPE}</td>
	<td class="small">{ROW.MESSAGE}</td>
	<td class="small right">{ICON_OK}</td>
</tr>
<!-- END ROW -->

<!-- BEGIN ERROR -->
<tr class="{ERROR.ROWCLASS} nowrap">
	<td class="small right">{ERROR.NR}.</td>
	<td class="small">{ERROR.TABLENAME}</td>
	<td class="small">{ERROR.QUERY}</td>
	<td class="small"><strong>{L_ERROR}</strong></td>
	<td class="small error">{ERROR.ERROR}</td>
	<td class="small right">{ICON_NOTOK}</td>
</tr>
<!-- END ERROR -->

</table>
