<div id="sidebar">

<a href="http://www.mysqldumper.net" class="new-window" title="{L_VISIT_HOMEPAGE} {CONFIG_HOMEPAGE}"><img src="css/{CONFIG_THEME}/pics/h1_logo.gif" alt="MySQLDumper - Homepage" /></a>

<div id="version">
	<a href="index.php" title="{L_HOME}">
		<span class="version-line">Version {MSD_VERSION}</span>
		<!-- BEGIN MSD_MODE_EASY -->
			<img src="css/{CONFIG_THEME}/pics/navi_bg.jpg" alt="" />
		<!-- END MSD_MODE_EASY -->
		<!-- BEGIN MSD_MODE_EXPERT -->
			<img src="css/{CONFIG_THEME}/pics/navi_bg_expert.jpg" alt="" />
		<!-- END MSD_MODE_EXPERT -->
	</a>
</div>

<div id="menu">
	<ul class="menu">
		<li{HOME_ACTIVE}><a href="index.php?p=home">{L_HOME}</a></li>
		<li{CONFIG_ACTIVE}><a href="index.php?p=config">{L_CONFIG}</a></li>
		<!-- BEGIN MAINTENANCE -->
		<li{DUMP_ACTIVE}><a href="index.php?p=dump">{L_DUMP}</a></li>
		<li{RESTORE_ACTIVE}><a href="index.php?p=files&amp;action=restore">{L_RESTORE}</a></li>
		<li{FILES_ACTIVE}><a href="index.php?p=files">{L_FILE_MANAGE}</a></li>
		<li{SQL_ACTIVE}><a	href="index.php?p=sql&amp;action=list_tables">{L_SQL_BROWSER}</a></li>
		<li{LOG_ACTIVE}><a href="index.php?p=log">{L_LOG}</a></li>
		<!-- END MAINTENANCE -->
		<li><a href="http://www.mysqldumper.net/credits/">{L_CREDITS}</a></li>
	</ul>
</div>

<div id="selectConfig">
	<form action="index.php?p={PAGE}{ACTION_SET}" method="post">
	<fieldset id="configSelect"><legend>{L_CONFIG}:</legend>
		<select name="selected_config" style="width: 157px;" onchange="this.form.submit()">{GET_FILELIST}</select></fieldset>
	</form>
	<br />
	<form action="index.php?p={PAGE}{ACTION_SET}" method="post">
		<fieldset id="dbSelect"><legend>{L_CHOOSE_DB}:</legend>
			<!-- BEGIN DB_LIST -->
				<select name="dbindex" style="width:157px;" onchange="this.form.submit()">
				<!-- BEGIN DB_ROW -->
					<option value="{DB_LIST.DB_ROW.ID}"{DB_LIST.DB_ROW.SELECTED}>{DB_LIST.DB_ROW.NAME}</option>
				<!-- END DB_ROW -->
				</select>
			<!-- END DB_LIST -->
			<!-- BEGIN NO_DB_FOUND -->
				{L_NO_DB_FOUND}
			<!-- END NO DB_FOUND --> 
			<a href="index.php?p={PAGE}&amp;dbrefresh=true{ACTION_SET}">{L_LOAD_DATABASE}</a>
		</fieldset>
	</form>
	<br />
	<!-- BEGIN PAYPAL_DEUTSCH -->
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<p style="text-align:center">
			<input type="image" src="./images/paypal-de.gif?{TIMESTAMP}" name="submit" alt="Donation MySQLDumper/ Spende an MySQLDumper" />
			<input type="hidden" name="cmd" value="_s-xclick" />
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
			<img alt="" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1" />
		</p>
		</form>
	<!-- END PAYPAL_DEUTSCH -->
	<!-- BEGIN PAYPAL_ENGLISH -->
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<p style="text-align:center">
				<input type="image" src="./images/paypal-en.gif?{TIMESTAMP}" name="submit" alt="Donation MySQLDumper/ Spende an MySQLDumper" />
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
				<img alt="" src="https://www.paypal.com/en_EN/i/scr/pixel.gif" width="1" height="1" />
			</p>
		</form>
	<!-- END PAYPAL_ENGLISH -->
</div>

</div>

<!-- BEGIN SHOW_SERVER_CAPTION -->
	<div id="server{SHOW_SERVER_CAPTION.KIND}">
		{L_SERVER}: <a class="new-window server" href="{SHOW_SERVER_CAPTION.LINK}" title="{SHOW_SERVER_CAPTION.NAME}">
		{SHOW_SERVER_CAPTION.NAME}</a>
	</div>
<!-- END SHOW_SERVER_CAPTION -->
