<script type="text/javascript" src="./js/highslide/highslide-with-html.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
	hs.graphicsDir = './js/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
	hs.height='400';
	hs.width='400';
    hs.cacheAjax = false;
/*]]>*/
</script>
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

function set_sort(column)
{
	$('sort_by_column').value = column;
	$('sort_direction').value = $('sort_direction').value == 'd' ? 'a' : 'd';
	$('table_get_form').submit();
}

/*]]>*/
</script>

<!-- BEGIN POSTED_MYSQL_QUERY -->
    <h4>{L_EXECUTED_QUERY}</h4>
    <div class="small">
	   {POSTED_MYSQL_QUERY.QUERY}
    </div><br/>
    {POSTED_MYSQL_QUERY.ROWS_AFFECTED} {L_ROWS_AFFECTED}
    <p>&nbsp;</p>
<!-- END POSTED_MYSQL_QUERY -->

<!-- BEGIN MYSQL_ERROR -->
    <h4>{L_QUERY_FAILED}</h4>
    <div class="small">{MYSQL_ERROR.QUERY}</div>
    <div class='error'>
	   {MYSQL_ERROR.ERROR}
    </div>
    <p>&nbsp;</p>
<!-- END MYSQL_ERROR -->



<h4>{L_SQL_DATAOFTABLE} `<a href='index.php?p=sql&amp;action=list_tables&amp;db={DB_NAME_URLENCODED}'>{DB_NAME}</a>`.`{TABLE_NAME}`</h4>

<div class="highslide-html-content" id="highslide-maincontent" style="width: 700px">
    <div class="highslide-body"></div>
</div>

<!-- The following Form is used to change sorting, page, amount of entries shown and something like that -->
<form action="index.php?p=sql&amp;action=show_tabledata" id="table_get_form" method="POST">
	<div>
		<input type='hidden' name='db' 				id='dbname'				value='{DB_NAME_URLENCODED}' />
		<input type='hidden' name='tablename' 		id='tablename'			value='{TABLE_NAME_URLENCODED}' />
		<input type='hidden' name='sort_by_column' 	id='sort_by_column' 	value='{SORT_BY_COLUMN}' />
		<input type='hidden' name='sort_direction' 	id='sort_direction'		value='{SORT_DIRECTION}' />
		<input type='submit' class ="Formbutton"    value='{L_SHOW}' />
		<input type='text'   name='limit_max_entries' id = 'limit_max_entries' value ='{MAX_ENTRIES}' class ='text' /> {L_ENTRIES_PER_PAGE}
		{L_STARTING_WITH}
		<input type='text' name='limit_start' id='limit_start' value='{LIMIT_START}' class ='text' /><br class='clear' />
		<input type='submit' name='pager' class ="Formbutton"  value='&lt;&lt;' />
		<input type='submit' name='pager' class ="Formbutton"  value='&lt;' />
		<input type='submit' name='pager' class ="Formbutton"  value='&gt;' />
		<input type='submit' name='pager' class ="Formbutton"  value='&gt;&gt;' />
	</div>
</form>

<table class="bdr"
	<!-- BEGIN NO_TABLE -->
		style="display:none"
	<!-- END NO_TABLE -->
>
<tr class="thead nowrap">
	<td colspan="{BUTTONBAR_COLSPAN}">
		<div class="middle" style="padding:6px 0 6px 0;">
			<a class='Formbutton' href="ajax/show_tabledata_entry.php?p=sql&amp;action=show_tabledata_entry&amp;db={DB_NAME_URLENCODED}&amp;tablename={TABLE_NAME_URLENCODED}&amp;ajax=1&amp;do=new&amp;sort_by_column={SORT_BY_COLUMN}&amp;sort_direction={SORT_DIRECTION}&amp;limit_max_entries={MAX_ENTRIES}&amp;limit_start={LIMIT_START}"
        		onclick="return hs.htmlExpand(this, {
        		objectType: 'ajax', cacheAjax: false, headingText:'{L_NEW_ENTRY}' } )">
    			{ICON_EDIT} {L_NEW}
			</a>

			<button class="Formbutton" type="submit" onclick="setVal('do','edit');">{ICON_EDIT} {L_EDIT}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','export')">{ICON_OK} {L_EXPORT}</button>
			<button class="Formbutton" type="submit" onclick="if (!confirm('{L_CONFIRM_DELETE_TABLES}')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>
</tr>
<tr class="thead nowrap">
    <th class = "right">{L_ACTION}</th>
	<th class="right">
        <a href="javascript:checkAllCheckboxes('table_post_form',true)">{ICON_PLUS}</a>
        <a href="javascript:checkAllCheckboxes('table_post_form',false)">{ICON_MINUS}</a>
    </th>
	<th class="right">#</th>
	<!-- BEGIN COL_HEADER -->
	<th>
		<a href="javascript:set_sort('{COL_HEADER.NAME}')" title='{COL_HEADER.COMMENT}'>{COL_HEADER.SORT} {COL_HEADER.LABEL}</a>
	</th>
	<!-- END COL_HEADER -->

</tr>

<!-- BEGIN ROW -->
<tr class="{ROW.ROW_CLASS} nowrap">
	<td class="small">
		<a href="ajax/show_tabledata_entry.php?p=sql&amp;action=show_tabledata_entry&amp;db={DB_NAME_URLENCODED}&amp;tablename={TABLE_NAME_URLENCODED}&amp;key={ROW.RECORD_KEY_ENCODED}&amp;ajax=1&amp;do=view&amp;sort_by_column={SORT_BY_COLUMN}&amp;sort_direction={SORT_DIRECTION}&amp;limit_max_entries={MAX_ENTRIES}&amp;limit_start={LIMIT_START}"
        	onclick="return hs.htmlExpand(this, {
        	objectType: 'ajax', cacheAjax: false, headingText:'{L_VIEW_ENTRY}' } )">
    		{ICON_VIEW}
		</a>
		<a href="ajax/show_tabledata_entry.php?p=sql&amp;action=show_tabledata_entry&amp;db={DB_NAME_URLENCODED}&amp;tablename={TABLE_NAME_URLENCODED}&amp;key={ROW.RECORD_KEY_ENCODED}&amp;ajax=1&amp;do=edit&amp;sort_by_column={SORT_BY_COLUMN}&amp;sort_direction={SORT_DIRECTION}&amp;limit_max_entries={MAX_ENTRIES}&amp;limit_start={LIMIT_START}"
        	onclick="return hs.htmlExpand(this, {
        	objectType: 'ajax', cacheAjax: false, headingText:'{L_EDIT_ENTRY}' } )">
    		{ICON_EDIT}
		</a>
	</td>
	<td class="right small">
		<input type="checkbox" class="right" name="table[]" id="entry_{ROW.NR}" value="{ROW.RECORD_KEY_ENCODED}"
			<!-- BEGIN TABLE_CHECKED -->
				checked="checked"
			<!-- END TABLE_CHECKED -->
		 />
	</td>
	<td class="right small"><label for="entry_{ROW.NR}">{ROW.NR}.</label></td>

	<!-- BEGIN COL -->
	<td class="small{ROW.COL.CLASS}">
		<label for="entry_{ROW.NR}">{ROW.COL.VAL}</label>
	</td>
	<!-- END COL -->
</tr>
<!-- END ROW -->

<tr class="thead nowrap">
	<td colspan="{BUTTONBAR_COLSPAN}">
		<div class="middle" style="padding:6px 0 6px 0;">
			<a class='Formbutton' href="ajax/show_tabledata_entry.php?p=sql&amp;action=show_tabledata_entry&amp;db={DB_NAME_URLENCODED}&amp;tablename={TABLE_NAME_URLENCODED}&amp;ajax=1&amp;do=new&amp;sort_by_column={SORT_BY_COLUMN}&amp;sort_direction={SORT_DIRECTION}&amp;limit_max_entries={MAX_ENTRIES}&amp;limit_start={LIMIT_START}"
        		onclick="return hs.htmlExpand(this, {
        		objectType: 'ajax', cacheAjax: false, headingText:'{L_NEW_ENTRY}' } )">
    			{ICON_EDIT} {L_NEW}
			</a>

			<button class="Formbutton" type="submit" onclick="setVal('do','edit');">{ICON_EDIT} {L_EDIT}</button>
			<button class="Formbutton" type="submit" onclick="setVal('do','export')">{ICON_OK} {L_EXPORT}</button>
			<button class="Formbutton" type="submit" onclick="if (!confirm('{L_CONFIRM_DELETE_TABLES}')) return false;setVal('do','drop');">{ICON_DELETE} {L_DELETE}</button>
		</div>
	</td>

</tr>

</table>
</form>

<br /><br /><br />