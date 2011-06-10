<div id="content">
<h2>{L_LOG}</h2>
<button class="Formbutton" type="button" onclick="location.href='index.php?p=log&amp;log=1&amp;revers={REVERS}'">{ICON_VIEW} PHP-Log</button>
<button class="Formbutton" type="button" onclick="location.href='index.php?p=log&amp;log=4&amp;revers={REVERS}'"{ERRORLOG_DISABLED}>{ICON_VIEW} {L_ERROR_LOG}</button>
<button class="Formbutton" type="button" onclick="location.href='index.php?p=log&amp;log=2&amp;revers={REVERS}'"{PERLLOG_DISABLED}>{ICON_VIEW} {L_PERL_LOG}</button>
<button class="Formbutton" type="button" onclick="location.href='index.php?p=log&amp;log=3&amp;revers={REVERS}'"{PERLCOMPLETELOG_DISABLED}>{ICON_VIEW} {L_PERL_COMPLETELOG}</button>
<br />

<div class="left">
<table class="bdr">
<tr>
	<td>
		<table>
		<tr>
			<td align="right">
				<a href="{LOGPATH}{PHPLOG}" class="new-window">{ICON_OPEN_FILE} {PHPLOG}</a> <br />

				<!-- BEGIN ERRORLOG -->
					<a href="{LOGPATH}{ERRORLOG.ERRORLOG}" class="new-window">{ICON_OPEN_FILE} {ERRORLOG.ERRORLOG}</a><br />
				<!-- END ERRORLOG -->

				<!-- BEGIN PERLLOG -->
					<a href="{LOGPATH}{PERLLOG.FILE_NAME}" class="new-window">{ICON_OPEN_FILE} {PERLLOG.FILE_NAME}</a><br />
				<!-- END PERLLOG -->

				<!-- BEGIN PERLCOMPLETELOG -->
					<a href="{LOGPATH}{PERLCOMPLETELOG.FILE_NAME}" class="new-window">{ICON_OPEN_FILE} {PERLCOMPLETELOG.FILE_NAME}</a><br />
				<!-- END PERLCOMPLETELOG -->
				<strong>{L_INFO_SUM}:</strong>
			</td>

			<td class="right">
			{PHPLOG_SIZE}<br />

				<!-- BEGIN ERRORLOG -->
					{ERRORLOG.SIZE}<br />
				<!-- END ERRORLOG -->

				<!-- BEGIN PERLLOG -->
					{PERLLOG.SIZE}<br />
				<!-- END ERRORLOG -->

				<!-- BEGIN PERLCOMPLETELOG -->
					{PERLCOMPLETELOG.SIZE}<br />
				<!-- END PERLCOMPLETELOG -->

			<strong><span style="text-decoration:overline">{LOGSIZE_TOTAL}</span></strong>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div class="left" style="width:100%">
	<a class="Formbutton" href="index.php?p=log&amp;delete_log=1&amp;log={LOG_TYPE}">{ICON_DELETE} {L_LOG_DELETE}</a>
	<a class="Formbutton" href="index.php?p=log&amp;log={LOG_TYPE}&amp;revers=0">{ICON_ARROW_UP} {L_NOREVERSE}</a>
	<a class="Formbutton" href="index.php?p=log&amp;log={LOG_TYPE}&amp;revers=1">{ICON_ARROW_DOWN} {L_REVERSE}</a>
	<br  />
	<h3>{L_LOG} "{LOG}": <img alt="Loading..." title="Loading..." style="display: none;" class="ajax-reload" src="css/msd/icons/ajax-loader.gif" /></h3>

        <script type="text/javascript">
        /*<![CDATA[*/
            jQuery(document).ready(function() {get_log('p=log&log={LOG_TYPE}&revers={REVERS}');});
        /*]]>*/
        </script>
	<div id="ilog" class="small">

	</div>
</div>
</div>
