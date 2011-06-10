<div id="content">
<h2>{PAGETITLE}</h2>
<form id="fm" method="post" action="index.php?p=files&amp;action=restore">
<p>
	<button class="Formbutton" name="restore" type="submit" onclick="if (!confirm('{L_FM_ALERTRESTORE1} `{DB_ACTUAL}`  {L_FM_ALERTRESTORE2} `'+GetSelectedFilename()+'` {L_FM_ALERTRESTORE3}')) return false;">
	 {ICON_RESTORE} {L_FM_RESTORE}
	</button>
	<button class="Formbutton" name="restore" onclick="$('select_tables').value=1;$('fm').submit();">
	  {ICON_RESTORE} {L_RESTORE_OF_TABLES}
	</button>
	<input type="hidden" id="select_tables" name="select_tables" value="0" />
    <br /><span class="small">{L_SELECTED_FILE}: <span id="gd">&nbsp;</span></span>
</p>

<table class="bdr">
<tr class="thead">
    <th colspan="12">{L_FM_FILES1} {L_OF} `{DB_ACTIVE}`:</th>
</tr>
<tr class="thead">
	<th colspan="3" class="left">{L_DB}</th>
	<th class="left">{L_FM_FILEDATE}</th>
	<th>{L_MULTI_PART}</th>
	<th class="left">{L_COMMENT}</th>
	<th class="right">{L_FM_TABLES}</th>
	<th class="right">{L_FM_RECORDS}</th>
	<th class="right">{L_FM_FILESIZE}</th>
	<th class="right">{L_ENCODING}</th>
	<th class="right">gz</th>
	<th class="right">Script</th>
</tr>
<!-- BEGIN FILE -->
<tr class="{FILE.ROWCLASS}">
	<td colspan="3" class="nowrap">
		<input type="hidden" name="multipart[]" value="{FILE.NR_OF_MULTIPARTS}" />
		<!-- BEGIN IS_MULTIPART -->
			<input name="file[]" id="file_{FILE.FILE_INDEX}" type="radio" value="{FILE.FILE_NAME}" onclick="SetSelectedFile({FILE.FILE_INDEX},0);" />
		<!-- END IS_MULTIPART -->

		<!-- BEGIN NO_MULTIPART -->
			<input name="file[]" id="file_{FILE.FILE_INDEX}" type="radio" value="{FILE.FILE_NAME}" onclick="SetSelectedFile({FILE.FILE_INDEX},1);" />
		<!-- END NO_MULTIPART -->
		<label for="file_{FILE.FILE_INDEX}" title="{L_SELECT_FILE}">{FILE.DB_NAME}</label>
	</td>
	<td class="nowrap">
		<label for="file_{FILE.FILE_INDEX}" title="{L_SELECT_FILE}">{FILE.FILE_CREATION_DATE}</label>
	</td>
	<td>
		<!-- BEGIN IS_MULTIPART -->
			<a style="font-size: 11px;" href="index.php?p=files&amp;action=files&amp;dbactive={FILE.DB_EXPAND_LINK}&amp;expand={FILE.FILE_INDEX}">{ICON_VIEW} {FILE.NR_OF_MULTIPARTS} {FILE.IS_MULTIPART.FILES}</a>
		<!-- END IS_MULTIPART -->

		<!-- BEGIN NO_MULTIPART -->
			{L_NO}
		<!-- END NO_MULTIPART -->
	</td>
	<td>{FILE.COMMENT}</td>
	<td class="right">{FILE.NR_OF_TABLES}</td>
	<td class="right">{FILE.NR_OF_RECORDS}</td>
	<td class="right">{FILE.FILESIZE}</td>
	<td class="right">{FILE.FILE_CHARSET}</td>
	<td class="right">{FILE.ICON_COMPRESSED}</td>
	<td class="right">{FILE.SCRIPT_VERSION}</td>
</tr>
<!-- END FILE -->

<!-- BEGIN NO_FILE_FOUND -->
	<tr class="dbrow1"><td colspan="12"><span class="error" style="width: 100%; display: block;">{DB_ACTUAL}: {L_FM_NOFILESFOUND}</span></td></tr>
<!-- END NO_FILE_FOUND -->
</table>

<table class="bdr">
<tr class="thead">
    <th colspan="4">{L_FM_ALL_BU}:</th>
</tr>
<tr class="thead">
	<th class="left">{L_FM_DBNAME}</th>
	<th class="right">{L_FM_ANZ_BU}</th>
	<th class="right">{L_FM_LAST_BU}</th>
	<th class="right">{L_FM_TOTALSIZE}</th>
</tr>

<!-- BEGIN DB -->
	<tr class="{DB.ROWCLASS}">
		<td class="left"><a href="index.php?p=files&amp;action=restore&amp;dbactive={DB.DB_NAME_LINK}" style="display: block">{ICON_VIEW} {DB.DB_NAME}</a></td>
		<td class="right">{DB.NR_OF_BACKUPS}</td>
		<td class="right nowrap">{DB.LATEST_BACKUP}</td>
		<td class="right">{DB.SUM_SIZE}</td>
	</tr>
<!-- END DB -->

<tr class="dbrowsel {DB.ROWCLASS}">
	<td colspan="3"><strong>{L_FM_TOTALSIZE}:</strong></td>
	<td class="right" style="text-decoration: overline"><strong>{SUM_SIZE}</strong></td>
</tr>
</table>
</form>
<br /><br /><br />
</div>
	<!-- BEGIN MESSAGE -->
	<script type="text/javascript">
	/*<![CDATA[*/
		var g = new Growler({location:"{NOTIFICATION_POSITION}", width:"650px"});
		g.growl("{MESSAGE.TEXT}", {header:"<strong>{L_MESSAGE}<\/strong>:", className:"message",life: 4, speedin: 1.2 });
	/*]]>*/
	</script>
	<!-- END MESSAGE -->
