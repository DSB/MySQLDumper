<script type="text/javascript">
/*<![CDATA[*/
function check_tables()
{
	if (!$('table_form').getInputs('checkbox','table[]').pluck('checked').any())
	{
		alert('{L_SQL_NOTABLESSELECTED}');
		return false;
	}
	else return true;
}

function check_tables_with_prefix()
{
	var prefix=$('input_prefix').value;
	var elements=$('table_form').getInputs('hidden','tablename');
	var id='';

	elements.each(
		function(element)
		{
			if (element.value)
			{
				var check=element.value;
				check = check.substr(0,prefix.length);
				if (check==prefix)
				{
					id=element.id.substr(10,element.id.length-10);
					$('table_'+id).checked=true;
				}
			}
		}
	);
	$('select_by_prefix').fade({ duration: .2, from: 1, to: 0  });
	return false;
}

function show_prefix_div()
{
	$('select_by_prefix').appear({ duration: .2,
									afterFinish: function() {
										$('input_prefix').focus();
									}
									});
}

function hide_prefix_div()
{
    $('select_by_prefix').fade({ duration: .2, from: 1, to: 0  });
    return false;
}

function observeKeys()
{
    Event.observe(document, 'keypress', checkEsc);
}

function checkEsc(event)
{
    var code = event.keyCode;
    if(code == Event.KEY_ESC) hide_prefix_div();
}

function set_sort(column,sort_type)
{
	$('sort_by_column').value=column;
	if (sort_type=='S') // String
	{
		$('sort_direction').value= $('sort_direction').value=='d' ? 'a':'d';
	}
	else // number
	{
		$('sort_direction').value= $('sort_direction').value=='D' ? 'A':'D';
	}

	$('table_form').submit();
}

Event.observe(window, 'load', observeKeys, false);

/*]]>*/
</script>

<h4>{L_SQL_TABLESOFDB} `{DB_NAME}`</h4>

<form action="index.php?p=sql&amp;action=list_tables&amp;db={DB_NAME_URLENCODED}" id="table_form" method="post" onsubmit="return check_tables();">
<div>
<input type="hidden" name="sort_by_column" id="sort_by_column" value="{SORT_BY_COLUMN}" />
<input type="hidden" name="sort_direction" id="sort_direction" value="{SORT_DIRECTION}" />
<input type="hidden" name="do" id="do" value="" />

<!-- BEGIN NO_TABLE -->
<span class="error">{L_INFO_DBEMPTY}</span><br />
<!-- END NO_TABLE -->

<!-- BEGIN 1_TABLE -->
1 {L_TABLE}
<!-- END 1_TABLE -->

<!-- BEGIN MORE_TABLES -->
{TABLE_COUNT} {L_TABLES}
<!-- END MORE_TABLES -->
</div>
<table class="bdr"
	<!-- BEGIN NO_TABLE -->
		style="display:none"
	<!-- END NO_TABLE -->
>
<tr class="thead nowrap">
	<td class="middle left nowrap">
		<button class="Formbutton" type="button" onclick="javascript:show_prefix_div();" accesskey="p" >{ICON_PLUS} {L_PREFIX}</button>

		<div id="select_by_prefix" class="blend-in" style="display:none; position:absolute; margin-top:-24px;margin-left:-6px;padding:6px;">
			{L_PREFIX}:
			<input class="text" id="input_prefix" style="width:80px;" />
			<button class="Formbutton" onclick="check_tables_with_prefix();return false;">{ICON_OK} {L_SELECT}</button>
			<button class="Formbutton" onclick="return hide_prefix_div()">{ICON_CANCEL} {L_CANCEL}</button>
		</div>
	</td>
	<td colspan="13">
		<div class="middle" style="padding:6px 0 6px 0;">
			<button class="Formbutton" type="submit" onclick="setVal('do','optimize');">{ICON_OK} {L_OPTIMIZE}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','analyze')">{ICON_OK} {L_ANALYZE}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','check')">{ICON_OK} {L_CHECK}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','repair')">{ICON_OK} {L_REPAIR}</button>
			<button class="Formbutton" type="submit" onclick="if (!check_tables()) return false; if (!confirm('{CONFIRM_TRUNCATE_TABLES}')) return false;setVal('do','truncate');">{ICON_DELETE} {L_EMPTY}</button>
			<button class="Formbutton" type="submit" onclick="if (!check_tables()) return false; if (!confirm('{CONFIRM_DELETE_TABLES}')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>
</tr>
<tr class="thead nowrap">
	<th class="left">{L_ACTION}</th>
	<th class="right">
        <a href="javascript:checkAllCheckboxes('table_form',true)">{ICON_PLUS}</a>
        <a href="javascript:checkAllCheckboxes('table_form',false)">{ICON_MINUS}</a>
	</th>
	<th class="right">#</th>
	<th class="left">
		<a href="javascript:set_sort('name','S')">{SORT_NAME} {L_TABLE}</a>
	</th>
	<th class="right">
		<a href="javascript:set_sort('records','d')">{SORT_RECORDS} {L_INFO_RECORDS}</a>
	</th>
	<th class="right">
		<a href="javascript:set_sort('data_length','d')">{SORT_DATA_LENGTH} {L_INFO_SIZE}</a>
	</th>
	<th class="right">
			<a href="javascript:set_sort('index_length','d')">{SORT_INDEX_LENGTH} {L_TITLE_INDEX}</a>
	</th>
	<th class="right nowrap">
		<a href="javascript:set_sort('auto_increment','d')">{SORT_AUTO_INCREMENT}
		<span title="{L_NEXT_AUTO_INCREMENT}">{L_NEXT_AUTO_INCREMENT_SHORT}</span></a>
	</th>
	<th class="left">
		<a href="javascript:set_sort('data_free','d')">{SORT_DATA_FREE}	{L_INFO_OPTIMIZED}</a>
	</th>
	<th class="left">
		<a href="javascript:set_sort('update_time','S')">{SORT_UPDATE_TIME} {L_INFO_LASTUPDATE}</a>
	</th>
	<th class="left">
		<a href="javascript:set_sort('engine','S')">{SORT_ENGINE} {L_ENGINE}</a>
	</th>
	<th class="left">
		<a href="javascript:set_sort('collation','S')">{SORT_COLLATION} {L_COLLATION}</a>
	</th>
	<th class="left">
		<a href="javascript:set_sort('comment','S')">{SORT_COMMENT} {L_COMMENT}</a>
	</th>
</tr>

<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} nowrap">
	<td>
		<a href="index.php?p=sql&amp;db={DB_NAME_URLENCODED}&amp;tablename={ROW.TABLE_NAME_URLENCODED}&amp;action=show_tabledata">{ICON_VIEW}</a>
		<a href="index.php?p=sql&amp;db={DB_NAME_URLENCODED}&amp;tablename={ROW.TABLE_NAME_URLENCODED}&amp;action=edit_table">{ICON_EDIT}</a>
	</td>
	<td class="right small">
		<input type="checkbox" class="right" name="table[]" id="table_{ROW.NR}" value="{ROW.TABLE_NAME_URLENCODED}"
			<!-- BEGIN TABLE_CHECKED -->
				checked="checked"
			<!-- END TABLE_CHECKED -->
		 />
		<input type="hidden" name="tablename" id="tablename_{ROW.NR}" value="{ROW.TABLE_NAME}" />
	</td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.NR}.</label></td>
	<td class="small"><label for="table_{ROW.NR}">{ROW.TABLE_NAME}</label></td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.RECORDS}</label></td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.DATA_LENGTH}</label></td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.INDEX_LENGTH}</label></td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.AUTO_INCREMENT}</label></td>
	<td class="small">
        <label for="table_{ROW.NR}">
		<!-- BEGIN OPTIMIZED -->
			{ICON_OK}
		<!-- END OPTIMIZED -->

		<!-- BEGIN NOT_OPTIMIZED -->
			{ICON_NOT_OK} {ROW.NOT_OPTIMIZED.VALUE}
		<!-- END NOT_OPTIMIZED -->

        <!-- BEGIN OPTIMIZE_NOT_SUPPORTED -->
        -
        <!-- END OPTIMIZE_NOT_SUPPORTED -->

		</label>
	</td>
	<td class="small"><label for="table_{ROW.NR}">{ROW.LAST_UPDATE}</label></td>
	<td class="small"><label for="table_{ROW.NR}">{ROW.ENGINE}</label></td>

	<td class="small"><label for="table_{ROW.NR}">{ROW.COLLATION}</label></td>
	<td class="small">{ROW.COMMENT}</td>

</tr>
<!-- END ROW -->

<!-- BEGIN SUM -->
<tr class="dbrowsel nowrap">
	<td>&nbsp;</td>
	<td class="middle" colspan="2">
       <a href="javascript:checkAllCheckboxes('table_form',true)">{ICON_PLUS}</a>
        <a href="javascript:checkAllCheckboxes('table_form',false)">{ICON_MINUS}</a>
    </td>
	<td>{L_INFO_SUM}:</td>
	<td class="right">{SUM.RECORDS}</td>
	<td class="right">{SUM.DATA_LENGTH}</td>
	<td colspan="3">{SUM.INDEX_LENGTH}</td>
	<td>{SUM.LAST_UPDATE}</td>
	<td colspan="6">&nbsp;</td>
</tr>
<!-- END SUM -->

<tr class="thead nowrap">
	<td class="middle left">
		<button type="button" class="Formbutton" onclick="javascript:show_prefix_div();">{ICON_PLUS} {L_PREFIX}</button>
	</td>
	<td colspan="14">
		<div class="middle" style="padding:6px 0 6px 0;">
			<button class="Formbutton" type="submit" onclick="setVal('do','optimize');">{ICON_OK} {L_OPTIMIZE}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','analyze')">{ICON_OK} {L_ANALYZE}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','check')">{ICON_OK} {L_CHECK}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','repair')">{ICON_OK} {L_REPAIR}</button>
			<button class="Formbutton" type="submit" onclick="if (!check_tables()) return false; if (!confirm('{CONFIRM_TRUNCATE_TABLES}')) return false;setVal('do','truncate');">{ICON_DELETE} {L_EMPTY}</button>
			<button class="Formbutton" type="submit" onclick="if (!check_tables()) return false; if (!confirm('{CONFIRM_DELETE_TABLES}')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>
</tr>

</table>
</form>


<br /><br /><br />