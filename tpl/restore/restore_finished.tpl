<div id="content">
<h2>{L_RESTORE}</h2>
<button class="Formbutton" onclick="self.location.href='index.php?p=files'">{ICON_OPEN_FILE} {L_FILE_MANAGE}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=sql&amp;action=list_databases'">{ICON_VIEW} {L_BACK_TO_OVERVIEW}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=log'">{ICON_VIEW} {L_LOG}</button>
<br />

<p class="small">{TIME_ELAPSED}, {PAGE_REFRESHS} {L_PAGE_REFRESHS}</p>

<br />
<h4>{L_DONE}</h4>

{TABLES_CREATED}<br />
{RECORDS_INSERTED}<br /><br />

<!-- BEGIN ERRORS -->
<h3>{L_ERROR}:</h3>
<div class="small" style="max-height:200px;overflow:auto">
	<table class="bdr">
		<tr class="thead">
			<th>#</th>
			<th>{L_TIMESTAMP}</th>
			<th>{L_ERROR}</th>
		</tr>
		 
		<!-- BEGIN ERROR -->
		<tr class="{ERRORS.ERROR.ROWCLASS} small">
			<td class="right small nowrap">{ERRORS.ERROR.NR}.</td>
			<td class="right small nowrap">{ERRORS.ERROR.TIMESTAMP}</td>
			<td class="small">{ERRORS.ERROR.MSG}</td>
		</tr>
		<!-- END ERROR -->
	</table>
</div>
<br />
<!-- END ERRORS -->

<h3>{L_LOG}:</h3>
<div class="small" style="max-height:300px;overflow:auto">
	<table class="bdr">
		<tr class="thead">
			<th>#</th>
			<th>{L_TIMESTAMP}</th>
			<th>{L_ACTION}</th>
		</tr>
		 
		<!-- BEGIN ACTION -->
		<tr class="{ACTION.ROWCLASS} small">
			<td class="right small nowrap">{ACTION.NR}.</td>
			<td class="small nowrap">{ACTION.TIMESTAMP}</td>
			<td class="small">{ACTION.ACTION}</td>
		</tr>
		<!-- END ACTION -->
	</table>
</div>

<!-- BEGIN NOTICES -->
<br />
<h3>{L_NOTICE}:</h3>
<div class="small" style="max-height:200px;overflow:auto">
	<table class="bdr">
		<tr class="thead">
			<th>#</th>
			<th>{L_TIMESTAMP}</th>
			<th>{L_NOTICE}</th>
		</tr>
		 
		<!-- BEGIN NOTICE -->
		<tr class="{NOTICES.NOTICE.ROWCLASS} small">
			<td class="right small nowrap">{NOTICES.NOTICE.NR}.</td>
			<td class="right small nowrap">{NOTICES.NOTICE.TIMESTAMP}</td>
			<td class="small">
					{NOTICES.NOTICE.NOTICE}
			</td>
		</tr>
		<!-- END NOTICE -->
	</table>
</div>
<br />
<!-- END NOTICES -->

<br />
<button class="Formbutton" onclick="self.location.href='index.php?p=files'">{ICON_OPEN_FILE} {L_FILE_MANAGE}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=sql&amp;action=list_databases'">{ICON_VIEW} {L_BACK_TO_OVERVIEW}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=log'">{ICON_VIEW} {L_LOG}</button>
<br />
</div>