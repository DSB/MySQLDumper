<div id="content">
<h2>{L_HOME}</h2>
<!-- BEGIN DIRECTORY_WARNINGS -->
	{DIRECTORY_WARNINGS.MSD}
<!-- END DIRECTORY_WARNINGS -->
	<!-- BEGIN HTACCESS_EXISTS -->
		<a href="index.php?p=home&amp;action=edithtaccess" class="Formbutton">{ICON_EDIT} {L_HTACC_EDIT}</a>
		<a href="index.php?p=home&amp;action=deletehtaccess" class="Formbutton" onclick="if (!confirm('{L_DELETE_HTACCESS}?')) return false;">{ICON_DELETE} {L_DELETE_HTACCESS}</a>
	<!-- END HTACCESS_EXISTS -->

	<!-- BEGIN HTACCESS_DOESNT_EXISTS -->
		<span class="error">{L_HTACC_PROPOSED}:</span>
		<a href="index.php?p=home&amp;action=schutz" class="Formbutton">{ICON_EDIT} {L_HTACC_CREATE}</a>
	<!-- END HTACCESS_DOESNT_EXISTS -->
	<a href="inc/home/phpinfo.php" class="new-window Formbutton">{ICON_SEARCH} PHP-Info</a>
<br />
<h3>{L_VERSIONSINFORMATIONEN}</h3>
<img src="css/{THEME}/pics/loveyourdata.gif" style="float:right" alt="love your data" title="love your data" />
<p>
    {L_MSD_VERSION}: <strong>{MSD_VERSION}</strong>
<br />
{L_OS}: <strong>{OS}</strong> ({OS_EXT})
<br />
{L_MYSQL_VERSION}: <strong>{MYSQL_VERSION}</strong><br />
{L_MYSQL_CLIENT_VERSION}: <strong>{MYSQL_CLIENT_VERSION}</strong><br />
{L_PHP_VERSION}: <strong>{PHP_VERSION}</strong>&nbsp;&nbsp;{L_MEMORY}: <strong>{MEMORY}</strong>
<br />
{L_MAX_EXECUTION_TIME}: <strong>{MAX_EXECUTION_TIME} {L_SECONDS} ({MAX_EXEC_USED_BY_MSD} {L_SECONDS})</strong>
<br />
<!-- BEGIN ZLIBBUG -->
	<span class="error">{L_PHPBUG}</span>
	<br />
<!-- END ZLIBBUG -->

<!-- BEGIN NO_FTP -->
	<span class="error">{L_NOFTPPOSSIBLE}</span>
	<br />
<!-- END NO_FTP -->

<!-- BEGIN NO_ZLIB -->
	<span class="error">{L_NOGZPOSSIBLE}</span><br />
<!-- END NO_ZLIB -->

{L_PHP_EXTENSIONS}: <span class="small">{PHP_EXTENSIONS}</span>
<br />
<!-- BEGIN DISABLED_FUNCTIONS -->
	<br />
	{L_DISABLEDFUNCTIONS}: <span class="small">{DISABLED_FUNCTIONS.PHP_DISABLED_FUNCTIONS}</span>
<!-- END DISABLED_FUNCTIONS -->
</p>
<h3>{L_MSD_INFO}</h3>
<p>{L_INFO_LOCATION} "<b>{SERVER_NAME}</b>" ({MSD_PATH})<br />
{L_INFO_ACTDB}: <strong>{DB}</strong><br />
{L_BACKUPFILESANZAHL} <strong>{NR_OF_BACKUP_FILES}</strong>
{L_BACKUPS} (<strong>{SIZE_BACKUPS}</strong>)<br />
{L_FM_FREESPACE}: <strong>{FREE_DISKSPACE}</strong><br />
<!-- BEGIN LAST_BACKUP -->
	{L_LASTBACKUP} {L_VOM} <strong>{LAST_BACKUP.INFO}</strong>: <strong><a href="{LAST_BACKUP.LINK}" class="new-window">{LAST_BACKUP.NAME}</a> </strong>(<strong>{LAST_BACKUP.SIZE}</strong>)
<!-- END LAST_BACKUP -->
</p>

</div>