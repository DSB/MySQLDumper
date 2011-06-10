<form action="index.php?p=sql&amp;action=general_sqlbox_show_results" method="post">
<div>
    <input type="hidden" name="sort_by_column" id="sort_by_column" value="{SORT_BY_COLUMN}" />
    <input type="hidden" name="sort_direction" id="sort_direction" value="{SORT_DIRECTION}" />
    <!-- BEGIN PAGER -->
        <button type="submit" name="page_full_back" class="Formbutton"{PAGER.PAGE_BACK_DISABLED}>&lt;&lt;</button>
        <button type="submit" name="page_back" class="Formbutton"{PAGER.PAGE_BACK_DISABLED}>&lt;</button>
        <button type="submit" name="page_forward" class="Formbutton"{PAGER.PAGE_FORWARD_DISABLED}>&gt;</button>
        <button type="submit" name="page_full_forward" class="Formbutton"{PAGER.PAGE_FORWARD_DISABLED}>&gt;&gt;</button>
        {PAGER.SHOWING_ENTRY_X_OF_Y}
    <!-- END PAGER -->
</div>
<table class="bdr">
<!-- BEGIN HEADLINE -->
    <tr class="thead nowrap">
        <th>#</th>
        <!-- BEGIN FIELDS -->
        <th>
            
            <a href="index.php?p=sql&amp;action=general_sqlbox_show_results&amp;order_by_field={HEADLINE.FIELDS.FIELD_ENCODED}&amp;order_direction={HEADLINE.FIELDS.DIRECTION}">
            <!-- BEGIN ICON_UP -->
                {ICON_UP}
            <!-- END ICON_UP -->
            <!-- BEGIN ICON_DOWN -->
                {ICON_DOWN}
            <!-- END ICON_DOWN -->
            
                {HEADLINE.FIELDS.NAME}</a>
            
            </th>
        <!-- END FIELDS -->
    </tr>
<!-- END HEADLINE -->

<!-- BEGIN ROW -->
<tr class="{ROW.ROWCLASS} small nowrap">
    <td class="right small">{ROW.NR}.</td>
    <!-- BEGIN FIELD -->
    <td class="small
        <!-- BEGIN NUMERIC -->
        right
        <!-- END NUMERIC -->
    ">{ROW.FIELD.VAL}</td>
    <!-- END FIELD -->
</tr>
<!-- END ROW -->
</table>
</form>

<!-- BEGIN MESSAGE -->
    <script type="text/javascript">
    /* <![CDATA[ */
        var g = new Growler({location:"{MESSAGE.NOTIFICATION_POSITION}", width:"650px"});
        g.growl('{MESSAGE.TEXT}', {header:"<strong>{L_ERROR}<\/strong>:", className:"message",sticky:true, speedin: 1.2 });
    /*]]>*/
    </script>
<!-- END MESSAGE -->