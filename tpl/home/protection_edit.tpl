<script type="text/javascript">
/*<![CDATA[*/
function insertHTA(s)
{
	var hta_content=document.getElementById('hta_content');
	if(s==1)ins="AddHandler php-fastcgi .php .php4\nAddhandler cgi-script .cgi .pl\nOptions +ExecCGI";
	if(s==101)ins="DirectoryIndex /cgi-bin/script.pl"
	if(s==102)ins="AddHandler cgi-script .cgi";
	if(s==103)ins="Options +ExecCGI";
	if(s==104)ins="Options +Indexes";
	if(s==105)ins="ErrorDocument 400 /errordocument.html";
	if(s==106)ins="# (macht aus http://domain.de/xyz.html ein\n# http://domain.de/main.php?xyz)\nRewriteEngine on\nRewriteBase  /\nRewriteRule  ^([a-z]+)\.html$ /main.php?$1 [R,L]";
	if(s==107)ins="Deny from IPADRESS\nAllow from IPADRESS";
	if(s==108)ins="Redirect /service http://foo2.bar.com/service";
	if(s==109)ins="ErrorLog /path/logfile"
	hta_content.value+="\n"+ins;
}
/*]]>*/
</script>
<div id="content">
<h2>{L_HTACC_EDIT}</h2>
<form action="index.php?p=home&amp;action=edithtaccess" method="post" id="protection_edit">

<p>
	<a class="Formbutton" href="index.php?p=home">{ICON_ARROW_LEFT} {L_HOME}</a>
	<br class="clear" />
	{L_HTACC_WARNING}<br />
	<br />
</p>
	<table class="bdr">
	<!-- BEGIN HTA_SAVED_SUCCESSFULLY -->
		<tr><td colspan="2"><p class="success">{L_FILE_SAVED_SUCCESSFULLY}</td></tr>
	<!-- END HTA_SAVED_SUCCESSFULLY -->
	
	<!-- BEGIN HTA_SAVED_UNSUCCESSFULLY -->
		<tr><td colspan="2"><p class="error">{L_FILE_SAVED_UNSUCCESSFULLY}</td></tr>
	<!-- END HTA_SAVED_UNSUCCESSFULLY -->

	<!-- BEGIN ERROR_OPENING_HTACCESS -->
		<tr><td colspan="2"><p class="error">{L_FILE_OPEN_ERROR}</p></td></tr>
	<!-- END ERROR_OPENING_HTACCESS -->
	
	<tr>
		<td style="width:70%;">
			<textarea rows="25" cols="40" class="hta_content" name="hta_content" id="hta_content">{HTA_CONTENT}</textarea>
		</td>
		<td valign="top">
			<h3>Presets</h3>
			<strong>{L_PROVIDER}</strong>
			<a class="Formbutton" href="javascript:insertHTA(1)">{ICON_ARROW_LEFT} all-inkl</a><br />

			<p><strong>{L_GENERAL}</strong></p>
			<a href="javascript:insertHTA(101)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_SCRIPT_EXEC}</a><br /><br />
			<a href="javascript:insertHTA(102)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_ADD_HANDLER}</a><br /><br />
			<a href="javascript:insertHTA(103)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_MAKE_EXECUTABLE}</a><br /><br />
			<a href="javascript:insertHTA(104)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_DIR_LISTING}</a><br /><br />
			<a href="javascript:insertHTA(105)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_ERROR_DOC}</a><br /><br />
			<a href="javascript:insertHTA(106)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_ACTIVATE_REWRITE_ENGINE}</a><br /><br />
			<a href="javascript:insertHTA(107)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_DENY_ALLOW}</a><br /><br />
			<a href="javascript:insertHTA(108)" class="Formbutton">{ICON_ARROW_LEFT} {L_HTACC_REDIRECT}</a><br /><br />
			<a href="javascript:insertHTA(109)" class="Formbutton">{ICON_ARROW_LEFT} {L_ERROR_LOG}</a><br /><br />
			<a href="http://httpd.apache.org/docs/2.0/mod/directives.html" class="Formbutton new-window">{ICON_SEARCH} {L_HTACC_EXAMPLES}</a>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<br />
				<a href="#" class="Formbutton" onclick="$('protection_edit').submit();" name="save">{ICON_SAVE} {L_SAVE}</a>
				<a href="#" class="Formbutton" onclick="$('protection_edit').reset();">{ICON_DELETE} {L_RESET}</a>
				<a href="#" class="Formbutton" onclick="self.location.href='index.php?p=home&amp;action=edithtaccess'">{ICON_OPEN_FILE} {L_RELOAD}</a>
			<br /><br />
		</td>
	</tr>
	</table>
	</form>
</div>
