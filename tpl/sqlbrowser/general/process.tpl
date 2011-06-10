<h4>{L_PROZESSE}:</h4>

{L_REFRESHTIME}: {REFRESHTIME} {L_SECONDS}
<!-- BEGIN KILL_STARTED -->
	<p class="success">{L_PROCESSKILL1} {KILL_STARTED.KILL_ID} {L_PROCESSKILL2}</p>
<!-- END KILL_STARTED -->

<!-- BEGIN KILL_WAIT -->
	<p class="success">{L_ERRORPROCESSKILL3} {KILL_WAIT.WAITTIME} {L_PROCESSKILL4} {KILLWAIT.KILL_ID} {L_PROCESSKILL2}</p>
<!-- END KILL_WAIT -->

<!-- BEGIN KILL_ERROR -->
    <p class="error">{L_ERROR} {KILL_ERROR.MESSAGE}</p>
<!-- END KILL_ERROR -->

<table class="bdr">
	<tr class="thead">
		<th>{L_ACTION}</th>
		<th>#</th>
		<th>{L_PROCESS_ID}</th>
		<th>{L_DB_USER}</th>
		<th>{L_DB_HOST}</th>
		<th>{L_DB}</th>
		<th>{L_COMMAND}</th>
		<th>{L_TIME}</th>
		<th>{L_STATUS}</th>
		<th>Info</th>
	</tr>
	<!-- BEGIN ROW -->
		<tr class="{ROW.ROWCLASS}">
			<td>
				<!-- BEGIN KILL -->
				<a href="index.php?p=sql&amp;action=general_process&amp;killid={ROW.ID}">{ICON_DELETE}</a>
				<!-- END KILL -->
				&nbsp;
			</td>
			<td class="right">{ROW.NR}.</td>
			<td>{ROW.ID}</td>
			<td>{ROW.USER}</td>
			<td>{ROW.HOST}</td>
			<td>{ROW.DB}</td>
			<td>{ROW.QUERY}</td>
			<td>{ROW.TIME}</td>
			<td>{ROW.STATE}</td>
			<td>{ROW.INFO}</td>
		</tr>
	<!-- END ROW -->
	<!-- BEGIN NO_PROCESS -->
		<tr>
			<td colspan="2">{L_INFO_NOPROCESSES}</td>
		</tr>
	<!-- END NO_PROCESS -->
</table>

<script type="text/javascript">
/*<![CDATA[*/
window.setTimeout("self.location.href='index.php?p=sql&action=general_process'","{REFRESHTIME_MS}");
/*]]>*/
</script>
