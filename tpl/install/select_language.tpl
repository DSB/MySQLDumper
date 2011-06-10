<script type="text/javascript">
/*<![CDATA[*/
var selected_language='{LANGUAGE}';
function set_button(selected_lang,reload_page) {
	switch(selected_lang)
	{
		<!-- BEGIN LANG -->
			case "{LANG.LANG}":
				document.getElementById("install_button1").innerHTML = '{LANG.INSTALL_BUTTON_VALUE}';
				document.getElementById("install_button2").innerHTML = '{LANG.INSTALL_BUTTON_VALUE}';
				document.getElementById("lang_"+selected_lang).checked = true;
				selected_language=selected_lang;
				break;
		<!-- END LANG -->
	}
	if (reload_page==true) window.document.location.href='install.php?MySQLDumper={SESSION_ID}&language='+selected_language;
}

function download_language_files(language)
{
	$('download').appear({ duration: 0.2 });
	$('download-messages').innerHTML='';
    $('language').innerHTML=language;
	get_language_files(language);
}

function get_language_files(language)
{
	$('ajax_loader').style.display='inline';
	new Ajax.Request('ajax/install_get_language_files.php?MySQLDumper={SESSION_ID}&l='+language+'&v={MSD_VERSION}', { method:'get',
	  onSuccess: function(transport,json){
			var json = transport.responseText.evalJSON(true);
			parseResponse(json,language);
	    },
		onFailure: function(){ alert('Something with the Ajax-Request went wrong...') }
	  });
}

function parseResponse(json,language)
{
 	if (json['message']) $('download-messages').innerHTML+= json['message'];
	if (json['in_progress']) get_language_files(language);
	else
	{
		$('ajax_loader').style.display='none';
		if (json['error']==1)
		{
			$('close_button').style.visibility='visible';
		}
		else
		{
			set_button(language);
			window.document.location.href='install.php?MySQLDumper={SESSION_ID}&language='+selected_language;
		}
	}
	$('download-messages').scrollTop = $('download-messages').scrollHeight;
}
/*]]>*/
</script>
<table class="bdr" cellpadding="0" cellspacing="0" style="width:700px;">
<tr class="dbrow">
	<td>{L_STEP} 1: <span class="small">{L_SELECT_LANGUAGE} ({LANGUAGE})</span> {ICON_OK}</td>
	<td>{L_STEP} 2: <span class="small">{L_CHECK_DIRS}</span></td>
	<td>{L_STEP} 3: <span class="small">{L_DBPARAMETER}</span></td>
</tr>
</table>

<br />
<h3>{L_STEP} 1: {L_SELECT_LANGUAGE} ({LANGUAGE})</h3>
<form action="install.php?MySQLDumper={SESSION_ID}&amp;phase=1" method="post" id="langform">
	<table class="bdr" style="width:700px;" cellpadding="0" cellspacing="0">
		<tr class="thead">
			<td colspan="5" style="text-align:center;">
				<button style="margin:12px;" type="submit" name="submit" class="Formbutton">
					{ICON_SAVE} <span id="install_button1">Install</span>
				</button>
					<!-- BEGIN FSOCKOPEN_DISABLED -->
						<br /><p class="message"><strong>{L_MESSAGE}:</strong>
						<br />{L_INFO_FSOCKOPEN_DISABLED}</p>
						<br />
					<!-- END FSOCKOPEN_DISABLED -->
			</td>
		</tr>
		<tr class="thead">
			<th class="right">#</th>
			<th>{L_LANGUAGE}</th>
			<th colspan="2">{L_STATUS}</th>
			<th>{L_ACTION}</th>
		</tr>
		<!-- BEGIN LANG -->
		<tr class="{LANG.ROWCLASS}">
			<td class="right">{LANG.NR}.</td>
			<td class="nowrap">
				<div id="lang_line_{LANG.NR}">
				<input type="radio" class="radio" name="language" id="lang_{LANG.LANG}" value="{LANG.LANG}"
					onclick="set_button('{LANG.LANG}',true);"{LANG.RADIO_DISABLED} />
					<label for="lang_{LANG.LANG}">
						<img src="language/flags/{LANG.LANG}.gif" alt="" width="25" height="15" style="padding:6px 12px 0 2px;" />{LANG.NAME}
					</label>
				</div>
			</td>

			<!-- BEGIN INSTALLED -->
				<td style="padding-top:6px;">{ICON_OK}</td>
				<td>{LANG.INSTALLED.LANG_INSTALLED}</td>
			<!-- END INSTALLED -->

			<!-- BEGIN NOT_INSTALLED -->
				<td>{ICON_NOT_OK}</td>
				<td>Not installed</td>
			<!-- END NOT_INSTALLED -->

			<td>
				<button type="button" class="Formbutton"{LANG.DOWNLOAD_DISABLED}
					onclick="if (!confirm('Download language pack for language \'{LANG.LANG}\'?')) return false;download_language_files('{LANG.LANG}')">
				{ICON_DOWNLOAD} {LANG.LANG_DOWNLOAD_LANGUAGE_PACK}
				</button>
			</td>
		</tr>
		<!-- END LANG -->
		<tr class="thead">
			<td colspan="5" style="text-align:center;">
				<button style="margin:12px;" type="submit" name="submit" class="Formbutton">
					{ICON_SAVE} <span id="install_button2">Install</span>
				</button>
			</td>
		</tr>
	</table>
</form>
<div id="download" style="text-align:left;display:none;">
	Downloading language files for language '<span id="language"></span>':
	<span style="float:right" id="ajax_loader"><img src="./css/msd/icons/ajax-loader.gif" title="" alt="" /></span>
	<br /><br />
	<div id="download-messages" style="overflow:auto"></div>
	<div id="close_button" style="visibility:hidden;">
		<button class="Formbutton" onclick="$('download').fade({ duration: 0.5, from: 1, to: 0 });">{ICON_CLOSE} Close</button>
	</div>
</div>

<script type="text/javascript">
/*<![CDATA[*/
	set_button("{LANGUAGE}",false);
	<!-- BEGIN SET_OPACITY -->
		new Effect.Opacity('lang_line_{SET_OPACITY.NR}', {duration:1.2, from:1, to:0.4});
	<!-- END SET_OPACITY -->
/*]]>*/
</script>

