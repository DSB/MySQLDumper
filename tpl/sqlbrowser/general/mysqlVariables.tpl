<h4>{L_MYSQLVARS}:</h4>
<form id="mysql_values" action="index.php?p=sql&amp;action=general_vars" method="post">
	<p>
		{L_FILTER_BY}:&nbsp; <select name="filter_selected" onchange="$('mysql_values').submit()">{SEL_FILTER}</select>
	</p>
</form>
<br />

<table class="bdr">
	<tr class="thead">
		<th class="right">#</th>
		<th><strong>{L_NAME}</strong></th>
		<th><strong>{L_VALUE}</strong></th>
	</tr>
	<!-- BEGIN ROW -->
		<tr class="{ROW.ROWCLASS}">
			<td class="small right">{ROW.NR}.</td>
			<td class="small">{ROW.VAR_NAME}</td>
			<td class="small">{ROW.VAR_VALUE}</td>
		</tr>
	<!-- END ROW -->
	<!-- BEGIN NO_VALUES -->
		<tr>
			<td colspan="3">{L_INFO_NOVARS}</td>
		</tr>
	<!-- END NO_VALUES -->
</table>
<br /><br /><br />