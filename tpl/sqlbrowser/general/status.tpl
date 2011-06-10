<h4>{L_STATUS}:</h4>

<!-- BEGIN FILTER -->
<form id="mysql_status" action="index.php?p=sql&amp;action=general_status" method="post">
	<p>
		{L_FILTER_BY}:&nbsp; <select name="filter_selected" onchange="$('mysql_status').submit()">{FILTER.SEL_FILTER}</select>
	</p>
</form>
<br />
<!-- END FILTER -->

<table class="bdr">
	<tr class="thead">
		<th class="right">#</th>
		<th><strong>{L_NAME}</strong></th>
		<th><strong>{L_VALUE}</strong></th>
	</tr>
	<!-- BEGIN ROW -->
		<tr class="{ROW.ROWCLASS}">
			<td class="right">{ROW.NR}.</td>
			<td class="small">{ROW.VAR_NAME}</td>
			<td  class="small right">{ROW.VAR_VALUE}</td>
		</tr>
	<!-- END ROW -->
	<!-- BEGIN NO_STATUS -->
		<tr>
			<td colspan="3">{L_INFO_NOSTATUS}</td>
		</tr>
	<!-- END NO_STATUS -->
</table>
<br /><br /><br />