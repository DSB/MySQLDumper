		<a onclick="return get_log('p=log&amp;log={LOG_TYPE}&amp;revers={SORT_ORDER}&amp;offset=0');" href="index.php?p=log&amp;log={LOG_TYPE}&amp;revers={SORT_ORDER}&amp;offset=0" class="Formbutton" accesskey="s">{ICON_SORT}</a>
		<a onclick="return get_log('p=log&amp;log={LOG_TYPE}&amp;revers={REVERS}&amp;offset={OFFSET_BACKWARD}');" href="index.php?p=log&amp;log={LOG_TYPE}&amp;revers={REVERS}&amp;offset={OFFSET_BACKWARD}" accesskey="c" class="Formbutton">&lt;&lt;</a>
		<a onclick="return get_log('p=log&amp;log={LOG_TYPE}&amp;revers={REVERS}&amp;offset={OFFSET_FOREWARD}');" href="index.php?p=log&amp;log={LOG_TYPE}&amp;revers={REVERS}&amp;offset={OFFSET_FOREWARD}" accesskey="v" class="Formbutton">&gt;&gt;</a>
		{PAGINATION_ENTRIES}
		<br />

		<table id="table_log" class="bdr">
			<tr class="thead">
				<th class="left">#</th>
				<th class="left">{L_TIMESTAMP}</th>
				<th class="left">{L_MESSAGE}</th>
			</tr>
		<!-- BEGIN LINE -->
			<tr class="{LINE.ROWCLASS}">
				<td class="small right">{LINE.NR}.</td>
				<td class="small nowrap">{LINE.TIMESTAMP}</td>
				<td class="small">{LINE.MSG}</td>
			</tr>
		<!-- END LINE -->
		</table>