<link rel="stylesheet" type="text/css" href="./js/highslide/highslide.css" />
<script type="text/javascript" src="./js/highslide/highslide-with-html.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
	hs.graphicsDir = './js/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
	hs.height='400';
	hs.width='400';
/*]]>*/
</script>
<script type="text/javascript">
/*<![CDATA[*/
function check_fields()
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
function show_enum_set($id)
{
	$('select_by_prefix').appear({ duration: .2, 
									afterFinish: function() { 
										$('input_prefix').focus();
									}
									});
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
/*]]>*/
</script>
<h4>{L_FIELDS_OF_TABLE} `<a href='index.php?p=sql&amp;action=list_tables&amp;db={DB_ENCODED}'>{DB}</a>`
.<a href="index.php?p=sql&db={DB_ENCODED}&amp;tablename={TABLE_ENCODED}==&amp;action=show_tabledata">`{TABLE}`</a>
</h4>

<form action="index.php?p=sql&amp;action=edit_tables&amp;db={DB_NAME_URLENCODED}" id="table_form" method="post" onsubmit="return check_tables();">
<div>
    <input type="hidden" name="sort_by_column" id="sort_by_column" value="{SORT_BY_COLUMN}" />
    <input type="hidden" name="sort_direction" id="sort_direction" value="{SORT_DIRECTION}" />
    <input type="hidden" name="do" id="do" value="" />
</div>

<table class="bdr"
	<!-- BEGIN NO_TABLE -->
		style="display:none"
	<!-- END NO_TABLE -->
>
<tr class="thead nowrap">
	<td class="middle left nowrap">
		<button type="button" class="Formbutton" onclick="javascript:show_prefix_div();" accesskey="p" >{ICON_PLUS} {L_PREFIX}</button>

		<div id="select_by_prefix" class="blend-in" style="display:none; position:absolute; margin-top:-24px;margin-left:-6px;padding:6px;">
			{L_PREFIX}: 
			<input class="text" id="input_prefix" style="width:80px;" />
			<button class="Formbutton" onclick="check_tables_with_prefix();return false;">{ICON_OK} {L_SELECT}</button>
			<button class="Formbutton" onclick="$('select_by_prefix').fade({ duration: .2, from: 1, to: 0  });return false;">{ICON_CANCEL} {L_CANCEL}</button>
		</div>
	</td>
	<td colspan="9">
		<div class="middle" style="padding:6px 0 6px 0;">
			<button class="Formbutton" type="submit" onclick="if (!check_tables()) return false; if (!confirm('{L_CONFIRM_DELETE_TABLES}')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
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
		{L_FIELDS}
	</th>
	<th class="left">
		Type
	</th>
	<th class="left">
        Null
	</th>
	<th class="left">
		Key
	</th>
	<th class="left">
		Default
	</th>
	<th class="left">
		Extra
	</th>
	<th class="left">
		{L_COLLATION}
	</th>
</tr>
<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} nowrap">
	<td>
		<a href="ajax/show_table_field.php?p=sql&action=edit_field&db={DB_NAME_URLENCODED}&tablename={TABLE_NAME_URLENCODED}&fieldname={ROW.NAME}&key={ROW.RECORD_KEY}&ajax=1&do=edit"
        	onclick="return hs.htmlExpand(this, { 
        	objectType: 'ajax', cacheAjax: false, headingText:'{L_EDIT_ENTRY}' } )">
    		{ICON_EDIT}
		</a>
	</td>
	<td class="right">
		<input type="checkbox" class="right" name="table[]" id="table_{ROW.NR}" value="{ROW.TABLE_NAME_URLENCODED}"
			<!-- BEGIN TABLE_CHECKED -->
				checked="checked"
			<!-- END TABLE_CHECKED -->
		 />
		<input type="hidden" name="tablename" id="tablename_{ROW.NR}" value="{ROW.TABLE_NAME}" />
	</td>
	<td class="right small"><label for="table_{ROW.NR}">{ROW.NR}.</label></td>
	<td class="small"><label for="table_{ROW.NR}">{ROW.NAME}</label></td>
	<td class="small"><label for="table_{ROW.NR}">{ROW.TYPE}</label>
	<!-- BEGIN ENUM_SET -->
		<a href="#config_{ROW.ENUM_SET.NR}" onclick="mySlide('show_set_enum_{ROW.ENUM_SET.NR}');">{ROW.ENUM_SET.ICON_BROWSE}</a>
		<div id="show_set_enum_{ROW.ENUM_SET.NR}" style="padding:0;margin:0;display:none;">
			<select size="{ROW.ENUM_SET.SIZE}">
			<!-- BEGIN ENUM_SET_ELEMENT -->
			<option style="font-size: 9px;">{ROW.ENUM_SET.ENUM_SET_ELEMENT.ELEMENT}</option>
			<!-- END ENUM_SET_ELEMENT -->
			</select>
		<div>
	<!-- END ENUM_SET -->
	</td>
	<td class="left small"><label for="table_{ROW.NR}">{ROW.NULL}</label></td>
	<td class="left small"><label for="table_{ROW.NR}">{ROW.KEY}</label></td>
	<td class="left small"><label for="table_{ROW.NR}">{ROW.DEFAULT}</label></td>
	<td class="left small"><label for="table_{ROW.NR}">{ROW.EXTRA}</label></td>
	<td class="left small"><label for="table_{ROW.NR}">{ROW.SORTIERUNG}</label></td>
</tr>
<!-- END ROW -->

<tr class="dbrowsel nowrap">
	<td>&nbsp;</td>
	<td class="middle" colspan="2">
       <a href="javascript:checkAllCheckboxes('table_form',true)">{ICON_PLUS}</a>
       <a href="javascript:checkAllCheckboxes('table_form',false)">{ICON_MINUS}</a>
    </td>
	<td colspan="7"></td>
</tr>

<tr class="thead nowrap">
	<td class="middle left">
		<button type="button" class="Formbutton" onclick="javascript:show_prefix_div();">{ICON_PLUS} {L_PREFIX}</button>
	</td>
	<td colspan="9">
		<div class="middle" style="padding:6px 0 6px 0;">
			<button class="Formbutton" type="submit" onclick="if (!check_fields()) return false; if (!confirm('TODO: Delete Fields?')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>
</tr>

</table>
</form>