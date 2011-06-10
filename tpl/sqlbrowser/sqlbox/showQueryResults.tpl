<h2>{L_SQL_OUTPUT}</h2>
<div id="sqloutbox">
    {L_SQL_OUT1} <strong>{COUNT_DROP}</strong> 
    <span style="color:#990099;font-weight:bold;">DROP</span>-, 
    <strong>{COUNT_CREATE}</strong> 
    <span style="color:#990099;font-weight:bold;">DELETE</span>-, 
    <strong>{COUNT_DELETE}</strong> 
    <span style="color:#990099;font-weight:bold;">CREATE</span>-, 
    <strong>{COUNT_INSERT}</strong> 
    <span style="color:#990099;font-weight:bold;">INSERT</span>-, 
    <strong>{COUNT_UPDATE}</strong> 
    <span style="color:#990099;font-weight:bold;">UPDATE</span>-
    <strong>{COUNT_SELECT}</strong> 
    <span style="color:#990099;font-weight:bold;">SELECT</span>-
    {L_SQL_OUT2}.<br /><br />
    <!-- BEGIN SQL_COMMAND -->
        <pre>{SQL_COMMAND.NR}. {SQL_COMMAND.EXEC_TIME}: {SQL_COMMAND.SQL}</pre>
    <!-- END SQL_COMMAND -->
</div>

    <script type="text/javascript">
        var error = new Growler({location:"{NOTIFICATION_POSITION}", width:"650px"});
<!-- BEGIN ERROR -->
        error.growl('{ERROR.TEXT}', {header:"<strong>{L_ERROR}<\/strong>:", className:"message",sticky:true, speedin: 1.2 });
<!-- END ERROR -->
    </script>