<div id="content">
<h2>{L_FILE_MANAGE}</h2>
<form id="fm" method="post" action="index.php?p=files&amp;action=files&amp;dbactive={DB_ACTUAL}">
<div>
<input type="hidden" name="dbactive" value="{DB_ACTUAL}" />
<button class="Formbutton" name="delete" type="submit" onclick="if (!confirm('{L_FM_ASKDELETE1}\n' + GetSelectedFilename() + '\n\n{L_FM_ASKDELETE2}')) return false;">{ICON_DELETE} {L_FM_DELETE}</button>
<button class="Formbutton" name="deleteauto" type="submit" onclick="if (!confirm('{L_FM_ASKDELETE3}')) return false;">{ICON_DELETE} {L_FM_DELETEAUTO}</button>
<button class="Formbutton" name="deleteall" type="submit" onclick="if (!confirm('{L_FM_ASKDELETE4}')) return false;">{ICON_DELETE} {L_FM_DELETEALL}</button>
<!-- BEGIN DELETE_FILTER -->
	<button class="Formbutton" name="deleteallfilter" type="submit" onclick="if (!confirm('{L_FM_ASKDELETE5} {DB_ACTUAL}{L_FM_ASKDELETE5_2}')) return false;">{ICON_DELETE} {L_FM_DELETEALLFILTER} '{DB_ACTUAL}*'</button>
<!-- END DELETE_FILTER -->
</div>

<p class="autodel">
	{L_AUTODELETE}: {AUTODELETE_ENABLED}
	<!-- BEGIN AUTODELETE -->
		{AUTODELETE.MSG}<br />
	<!-- END AUTODELETE -->
	<br />
	{L_SELECTED_FILE}: <span id="gd">&nbsp;</span>
	<br />
</p>

<table class="bdr">
<tr class="thead">
    <th colspan="13">
        {L_FM_FILES1} {L_OF} `{DB_ACTUAL_OUTPUT}`:
    </th>
</tr>
<tr class="thead">
    <th class="left">{L_ACTION}</th>
    <th colspan="2" class="left">{L_DB}</th>
	<th class="left">{L_FM_FILEDATE}</th>
	<th>Multipart</th>
	<th class="left">{L_COMMENT}</th>
	<th class="right">{L_FM_TABLES}</th>
	<th class="right">{L_FM_RECORDS}</th>
	<th class="right">{L_FM_FILESIZE}</th>
	<th class="left">{L_ENCODING}</th>
	<th class="left">gz</th>
    <th class="left">Script</th>
    <th class="left">{L_MYSQL_VERSION}</th>
</tr>
<!-- BEGIN FILE -->
<tr class="{FILE.ROWCLASS}">
    <td>
        <!-- BEGIN NO_MULTIPART -->
            <a href="{BACKUP_PATH}{FILE.FILE_NAME_URLENCODED}" class="new-window">{ICON_VIEW}</a>
            <a href="index.php?p=files&amp;action=dl&amp;f={FILE.FILE_NAME_URLENCODED}" class="new-window">{ICON_DOWNLOAD}</a>
        <!-- END NO_MULTIPART -->
    </td>
	<td colspan="2" class="nowrap">
		<input type="hidden" name="multipart[]" value="{FILE.NR_OF_MULTIPARTS}" />
		<!-- BEGIN IS_MULTIPART -->
			<input name="file[]" id="file_{FILE.FILE_INDEX}" type="checkbox" value="{FILE.FILE_NAME}" onclick="SetSelectedFile({FILE.FILE_INDEX},1);" />
		<!-- END IS_MULTIPART -->

		<!-- BEGIN NO_MULTIPART -->
			<input name="file[]" id="file_{FILE.FILE_INDEX}" type="checkbox" value="{FILE.FILE_NAME}" onclick="SetSelectedFile({FILE.FILE_INDEX},1);" />
		<!-- END NO_MULTIPART -->
		<label for="file_{FILE.FILE_INDEX}" title="{L_SELECT_FILE}">{FILE.DB_NAME}</label>


	</td>
	<td class="nowrap">
		<label for="file_{FILE.FILE_INDEX}" title="{L_SELECT_FILE}">{FILE.FILE_CREATION_DATE}</label>
	</td>
	<td class="nowrap">
		<!-- BEGIN IS_MULTIPART -->
			<a style="font-size:11px;" href="#" onclick="mySlide('mp_filelist{FILE.FILE_INDEX}');">{ICON_VIEW} {FILE.NR_OF_MULTIPARTS} {FILE.IS_MULTIPART.FILES}</a>
		<!-- END IS_MULTIPART -->

		<!-- BEGIN NO_MULTIPART -->
			{L_NO}
		<!-- END NO_MULTIPART -->
	</td>
	<td>{FILE.COMMENT}</td>
	<td class="right">{FILE.NR_OF_TABLES}</td>
	<td class="right">{FILE.NR_OF_RECORDS}</td>
	<td class="right">{FILE.FILESIZE}</td>
	<td class="left">{FILE.FILE_CHARSET}</td>
	<td class="left">{FILE.ICON_COMPRESSED}</td>
    <td class="left">{FILE.SCRIPT_VERSION}</td>
    <td class="left">{FILE.MYSQL_VERSION}</td>
</tr>
	<!-- BEGIN EXPAND_MULTIPART -->
	<tr class="{FILE.EXPAND_MULTIPART.ROWCLASS}">
	<td colspan="13">
		<div id="mp_filelist{FILE.FILE_INDEX}" style="display:none">
			<table class="bdr" style="margin-left:16px;">
			<tr class="thead">
				<th class="right">#</th>
				<th>{L_FILE}</th>
				<th class="right">{L_FILESIZE}</th>
				<th>&nbsp;{L_ACTION}</th>
			</tr>
			<!-- BEGIN MP_FILE -->
				<tr class="{FILE.EXPAND_MULTIPART.MP_FILE.ROWCLASS}">
					<td class="right small">
						{FILE.EXPAND_MULTIPART.MP_FILE.NR}.
					</td>
					<td class="small">
						<label for="file_{FILE.FILE_INDEX}" title="{L_SELECT_FILE}">{FILE.EXPAND_MULTIPART.MP_FILE.FILE_NAME}</label>
					</td>
					<td class="right small">{FILE.EXPAND_MULTIPART.MP_FILE.FILE_SIZE}</td>
					<td>
						<a href="{BACKUP_PATH}{FILE.EXPAND_MULTIPART.MP_FILE.FILE_NAME_URLENCODED}" class="new-window">{ICON_VIEW}</a>
						<a href="index.php?p=files&amp;action=dl&amp;f={FILE.EXPAND_MULTIPART.MP_FILE.FILE_NAME_URLENCODED}" class="new-window">{ICON_DOWNLOAD}</a>
					</td>
				</tr>
			<!-- END MP_FILE -->
			</table>
		</div>
	</td>
	</tr>
	<!-- END EXPAND_MULTIPART -->

<!-- END FILE -->

<!-- BEGIN NO_FILE_FOUND -->
	<tr class="dbrow1"><td colspan="13"><span class="error" style="width:100%;display:block;">{DB_ACTUAL_OUTPUT}: {L_FM_NOFILESFOUND}</span></td></tr>
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
		<td class="left"><a href="index.php?p=files&amp;action=files&amp;dbactive={DB.DB_NAME_LINK}" style="display:block">{ICON_VIEW} {DB.DB_NAME}</a></td>
		<td class="right">{DB.NR_OF_BACKUPS}</td>
		<td class="right nowrap">{DB.LATEST_BACKUP}</td>
		<td class="right">{DB.SUM_SIZE}</td>
	</tr>
<!-- END DB -->

<tr class="dbrowsel">
	<td colspan="3"><strong>{L_FM_TOTALSIZE}:</strong></td>
	<td class="right" style="text-decoration:overline"><strong>{SUM_SIZE}</strong></td>
</tr>
</table>
</form>
<br />
<form action="index.php?p=files&amp;action=files&amp;dbactive={DB_ACTUAL}" method="post" enctype="multipart/form-data">
<table class="bdr">
<tr class="thead"><td colspan="2"><strong>{L_FM_FILEUPLOAD}:</strong></td></tr>
<tr>
	<td><input type="file" name="upfile" class="Formbutton" /></td>
	<td><input type="submit" name="upload" value="{L_FM_FILEUPLOAD}" class="Formbutton" /></td>
</tr>
<tr>
	<td colspan="2">{L_MAX_UPLOAD_SIZE}: <strong>{UPLOAD_MAX_SIZE}</strong></td>
</tr>
<tr>
	<td colspan="2">{L_MAX_UPLOAD_SIZE_INFO}</td>
</tr>
</table>
</form>

<br />
<h3>{L_TOOLS}</h3>
<div>
	<button onclick="document.location='index.php?p=files&amp;action=convert'" class="Formbutton">{L_CONVERTER}</button>
	<br /><br /><br />
</div>

<script type="text/javascript">
/*<![CDATA[*/
<!-- BEGIN EXPAND_MP_FILE -->
mySlideDown('mp_filelist{EXPAND_MP_FILE.FILEINDEX}');
<!-- END EXPAND_MP_FILE -->
/*]]>*/
</script>
</div>
<!-- BEGIN MESSAGE -->
	<script type="text/javascript">
	/*<![CDATA[*/
		var g = new Growler({location:"{NOTIFICATION_POSITION}", width:"650px"});
		g.growl("{MESSAGE.TEXT}", {header:"<strong>{L_MESSAGE}<\/strong>:", className:"message",life: 4, speedin: 1.2 });
	/*]]>*/
	</script>
<!-- END MESSAGE -->
