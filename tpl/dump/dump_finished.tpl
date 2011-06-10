<div id="content">
<h2>{L_DUMP}</h2>
<p class="Formbutton">
<button class="Formbutton" onclick="self.location.href='index.php?p=files'">{ICON_OPEN_FILE} {L_FILE_MANAGE}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=sql&amp;action=list_databases'">{ICON_VIEW}
{L_BACK_TO_OVERVIEW}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=log'">{ICON_VIEW} {L_LOG}</button>
</p>
<h3>{L_DONE}</h3>
<p class="small">{TIME_ELAPSED}, {PAGE_REFRESHS} {L_PAGE_REFRESHS}<br />
{MSG}</p>
<!-- BEGIN MULTIDUMP -->
    {MULTIDUMP.MSG}.<br />
<!-- END MULTIDUMP -->
<br />

<h3>{L_FILES}:</h3>
<div class="small" style="max-height: 200px; overflow: auto">
<table class="bdr">
    <tr class="thead">
        <th>#</th>
        <th>{L_FILE}</th>
        <th colspan="2">{L_FILESIZE}</th>
    </tr>

    <!-- BEGIN FILE -->
    <tr class="{FILE.ROWCLASS} small">
        <td class="right">{FILE.NR}.</td>
        <td class="small"><a href="{BACKUPPATH}{FILE.FILENAME}" class="new-window">{FILE.FILENAME}</a></td>
        <td class="small"><a href="index.php?p=files&amp;action=dl&amp;f={FILE.FILENAME_URLENCODED}">{ICON_OPEN_FILE}</a>
        </td>
        <td class="small right">{FILE.FILESIZE}</td>
    </tr>
    <!-- END FILE -->
</table>
</div>
<br />
<!-- BEGIN ERROR -->
<h3>{L_ERROR}:</h3>
<div class="small" style="max-height: 200px; overflow: auto">
<table class="bdr">
    <tr class="thead">
        <th>{L_TIMESTAMP}</th>
        <th>{L_ERROR}</th>
    </tr>

    <!-- BEGIN ERRORMSG -->
    <tr class="{ERROR.ERRORMSG.ROWCLASS} small">
        <td class="right small nowrap">{ERROR.ERRORMSG.TIMESTAMP}</td>
        <td class="small nowrap">{ERROR.ERRORMSG.MSG}</td>
    </tr>
    <!-- END MSG -->
</table>
</div>
<br />
<!-- END ERROR -->
<h3>{L_LOG}:</h3>
<div class="small" style="height: 300px; overflow: auto">
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
<br />
<button class="Formbutton" onclick="self.location.href='index.php?p=files'">{ICON_OPEN_FILE} {L_FILE_MANAGE}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=sql&amp;action=list_databases'">{ICON_VIEW}
{L_BACK_TO_OVERVIEW}</button>
<button class="Formbutton" onclick="self.location.href='index.php?p=log'">{ICON_VIEW} {L_LOG}</button>
</div>