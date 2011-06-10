<link rel="stylesheet" type="text/css" href="./js/highslide/highslide.css" />
<script type="text/javascript" src="./js/highslide/highslide-with-html.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
	hs.graphicsDir = './js/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
	hs.height='600';
	hs.width='1000';
/*]]>*/
</script>
<script type="text/javascript">
/*<![CDATA[*/
var scroll_log=true;
function doRestore()
{
	new Ajax.Request('ajax/restore_ajax.php?MySQLDumper={SESSION_ID}', { method:'get',
	  onSuccess: function(transport,json){
			if (!(transport.responseText.substr(0,22)=='{"restore_in_progress"'))
			{
				// unnormal error returned
				var g = new Growler({location:"{NOTIFICATION_POSITION}", width:"650px"});
				g.growl(transport.responseText, {header:"<strong>{L_ERROR}<\/strong>:", className:"message", sticky:true, speedin: 1.2 });
				$('ajaxload').fade();
			}
			else
			{
				var json = transport.responseText.evalJSON(true);
				parseRestoreResponse(json);
			}
	    },
		onFailure: function(){ alert('Something with the Ajax-Request went wrong...') }
	  });
}
  
function parseRestoreResponse(json) 
{
	// values that are only delivered at first page call and don't change in this run
	if (json['speed_min']) 
	{
		$('speed_min').innerHTML = json['speed_min'];
		$('speed_max').innerHTML = json['speed_max'];
		$('dump_encoding').innerHTML=json['dump_encoding'];
	}
	$('filename').innerHTML=json['filename'];
	$('filename2').innerHTML=json['filename'];
	if (json['part']) $('part').innerHTML=json['part'];
	$('tables_to_create').innerHTML=json['tables_to_create'];
	$('records_done').innerHTML=json['records_done'];
	$('actual_table').innerHTML=json['actual_table'];
	$('page_refreshs').innerHTML=json['page_refreshs'];
	$('elapsed_time').innerHTML=json['elapsed_time'];
	$('estimated_end').innerHTML=json['estimated_end'];
	$('progress_file_percent').innerHTML=json['progress_file_percent'];
	$('nr_of_notices').innerHTML= json['nr_of_notices'];
	$('nr_of_errors').innerHTML=json['nr_of_errors'];
	if (json['progress_overall_percent']) $('progress_overall_percent').innerHTML = json['progress_overall_percent'];
	
	// Logs
	if (json['actions']) {
		$('log').innerHTML+= json['actions']+'<br />';
	}
	if (json['errors']) $('log').innerHTML+= '<span class="error">'+json['errors']+'<\/span><br />';
	//scroll log to bottom
	if (scroll_log && (json['actions'] || json['errors'])) $('log').scrollTop = $('log').scrollHeight;

	// progressbars
	$('progressbar_file').morph( 'progressbar_file', {
		  style: 'width:'+json['progress_file_bar_width']+'px;',
		  duration: 0.3
	});		
	$('progressbar_overall').morph( 'progressbar_overall', {
		  style: 'width:'+json['progress_overall_bar_width']+'px;',
		  duration: 0.3
	});		
	
	$('speed').innerHTML=json['speed'];
	$('speedbar').morph( 'speedbar', {
		  style: 'width:'+json['speedbar_width']+'px;',
		  duration: 0.3
		});		
	$('log2').innerHTML=$('log').innerHTML;
	if (json['restore_in_progress']==1) doRestore(); // Restore not finished -> continue
	else self.location.href='index.php?p=restore&action=done&MySQLDumper={SESSION_ID}';
}
Event.observe(window, 'load', doRestore);
/*]]>*/
</script>
<div id="log-target"></div>
<div id="content">
<h2>{L_RESTORE}</h2>
<form action="index.php?p=restore&amp;MySQLDumper={SESSION_ID}" method="post"></form>

<h3>{DB_ON_SERVER}</h3>
<table class="bdr">
<tr class="dbrow">
	<td class="small">{L_FILE}:</td>
	<td class="small right"><span id="filename">{FILENAME}</span></td>
</tr>
<!-- BEGIN MULTIPART -->
<tr class="dbrow">
	<td class="small">{L_MULTIPART_ACTUAL_PART}:</td>
	<td class="small right"><span id="part">{MULTIPART.PART}</span></td>
</tr>
<!-- END MULTIPART -->
<tr class="dbrow1">
	<td class="small">{L_CHARSET}:</td>
	<td class="small right"><span id="dump_encoding">{CHARSET}</span></td>
</tr>
<tr class="dbrow">
	<td class="small" colspan="2"><span id="tables_to_create">{TABLES_TO_CREATE}</span></td>
</tr>
<tr class="dbrow1">
	<td class="small" colspan="2"><span id="records_done"></span></td>
</tr>

<tr class="dbrow">
	<td class="small" colspan="2"><span id="actual_table"></span></td>
</tr>
<tr class="dbrow1">
	<td class="small">{L_ERROR}:</td>
	<td class="small right">
		<span id="nr_of_errors">0</span>
	</td>
</tr>

<tr class="dbrow">
	<td class="small">{L_NOTICES}:</td>
	<td class="small right">
		<span id="nr_of_notices">0</span>
	</td>
</tr>

<tr class="dbrow1" style="line-height:12px;"><td colspan="2">&nbsp;</td></tr>
<tr class="dbrow">
	<td class="small nowrap">{L_PROGRESS_FILE}:</td>
	<td class="small right"><strong><span id="filename2"></span></strong></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<table style="width:400px">
			<tr>
				<td style="width:60px" class="small right nowrap"><span id="progress_file_percent">0</span> %</td>
				<td>
					<img src="{ICONPATH}progressbar_restore.gif" id="progressbar_file" alt="" width="0" height="16" />
				</td>
			</tr>
		</table>
	</td>
</tr>

<tr class="dbrow1" style="line-height:12px;"><td colspan="2">&nbsp;</td></tr>
<tr class="dbrow">
	<td class="small">{L_RECORDS_PER_PAGECALL}:</td>
	<td>
		<table style="width:400px">
		<tr>
			<td style="width:60px" valign="top" class="small right">
				<span id="speed"></span>
			</td>
			<td colspan="2">
				<img src="{ICONPATH}progressbar_speed.gif" id="speedbar" alt="" width="0" height="14" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="nowrap small"><span id="speed_min"></span></td>
			<td class="nowrap small right"><span id="speed_max"></span></td>
		</tr>
		</table>
	</td>
</tr>

<tr class="dbrow1" style="line-height:12px;"><td colspan="2">&nbsp;</td></tr>
<tr class="dbrow">
	<td class="small nowrap">{L_PROGRESS_OVER_ALL}:</td>
	<td>
		<table style="width:400px">
			<tr>
				<td style="width:60px" class="small right nowrap"><span id="progress_overall_percent">0</span> %</td>
				<td>
					<img src="{ICONPATH}progressbar_restore.gif" id="progressbar_overall" alt="" width="0" height="16" />
				</td>
			</tr>
		</table>
	</td>
</tr>


<tr class="dbrow1">
	<td class="small nowrap">{L_PAGE_REFRESHS}:</td>
	<td class="small right"><span id="page_refreshs">0</span></td>
</tr>
<tr class="dbrow">
	<td class="small nowrap">{L_DURATION}:</td>
	<td class="small right"><span id="elapsed_time"></span></td>
</tr>
<tr class="dbrow1">
	<td class="small nowrap">{L_ESTIMATED_END}:</td>
	<td class="small right"><span id="estimated_end"></span></td>
</tr>

</table>

<h3>{L_LOG}</h3>

<a class="Formbutton" onclick="return hs.htmlExpand(this, { headingText: '{L_LOG}' })">{L_LOG}{ICON_PLUS}</a>

<div id="log" style="height:100px;overflow:auto;" class="bdr small" onmouseover="scroll_log=false" onmouseout="scroll_log=true"></div>

<div class="highslide-maincontent" >
	<div id="log2" class="highslide-body"></div>
</div>

<br /><br />
</div>
