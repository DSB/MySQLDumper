<div id="content">
<h2>{L_CONVERTER}</h2>
<form action="index.php?p=files&amp;action=convert" method="post">
<table class="bdr">
    <tr class="thead"><th colspan="2">{L_CONVERT_TITLE}</th></tr>
    <tr class="dbrow">
        <td>{L_CONVERT_FILE}:</td>
        <td>
            <select name="selectfile">
                {SELECTBOX_FILE_LIST}
            </select>
        </td>
    </tr>
    <tr class="dbrow1">
        <td>
            <label for="destfile">{L_CONVERT_FILENAME}</label>:
        </td>
        <td>
            <input type="text" class="text" name="destfile" id="destfile" size="50" value="{NEW_FILE}" />
        </td>
    </tr>
    <tr class="dbrow">
        <td>
            <label for="compressed">{ICON_GZ} {L_COMPRESSED}:</label>
        </td>
        <td>
            <input type="checkbox" name="compressed" id="compressed" value="1"{NEW_FILE_COMPRESSED} />
        </td>
    </tr>
    <tr class="dbrow1">
        <td>&nbsp;</td>
        <td>
            <input type="submit" name="startconvert" value="{L_CONVERT_START}" class="Formbutton" />
        </td>
    </tr>
</table>
</form>
<br />

<!-- BEGIN AUTOSCROLL -->
<script type="text/javascript">
/*<![CDATA[*/
function pageScroll() {
    window.scrollBy(0,100);
    scrolldelay = setTimeout('pageScroll()',100);
}
scrolldelay = setTimeout('pageScroll()',100);
/*]]>*/
</script>
<!-- END AUTOSCROLL -->