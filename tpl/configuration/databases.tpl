<div id="panel_db" class="panel" style="display:none">
    <fieldset>
        <legend>{L_CONNECTIONPARS}</legend>
        <div id="connection-params" style="display:none;">
            <table style="width:100%">
                <tr class="dbrow">
                    <td>{L_DB_HOST}:</td>
                    <td><input class="text" type="text" name="dbhost" value="{DB_HOST}" /></td>
                </tr>
                <tr class="dbrow1">
                    <td>{L_DB_USER}:</td>
                    <td><input class="text" type="text" name="dbuser" value="{DB_USER}" size="20" /></td>
                </tr>
                <tr class="dbrow">
                    <td>{L_DB_PASS}:</td>
                    <td><input class="text" type="password" name="dbpass" value="{DB_PASS}" size="20" /></td>
                </tr>
                <tr class="dbrow1"><td colspan="2"><br /><strong>{L_EXTENDEDPARS}</strong></td></tr>
                <tr class="dbrow">
                    <td>{L_PORT}:</td>
                    <td><input class="text" type="text" name="dbport" value="{DB_PORT}" /></td>
                </tr>
                <tr class="dbrow1">
                    <td>{L_SOCKET}:</td>
                    <td><input class="text" type="text" name="dbsocket" value="{DB_SOCKET}" /></td>
                </tr>
                <tr class="dbrow">
                    <td>{L_ADD_DB_MANUALLY}:</td>
                    <td><input class="text" type="text" name="add_db_manual" value="" /></td>
                </tr>
                <!-- BEGIN MANUAL_DB_ADD -->
                <tr class="dbrow1">
                    <td colspan="2" class="error">{MANUAL_DB_ADD.MESSAGE}</td>
                </tr>
                <!-- END MANUAL_DB_ADD -->
                <tr class="dbrow">
                    <td>&nbsp;</td>
                    <td>
                        <p style="padding-left:8px;"> 
                            <button class="Formbutton" type="submit" name="save">{ICON_SAVE} {L_SAVE}</button>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div><button type="button" class="Formbutton" onclick="slide('#connection-params');">{ICON_EDIT} {L_FADE_IN_OUT}</button></div>
    </fieldset>
    <br />
    <fieldset>
        <legend>{L_DB_BACKUPPARS}</legend>
        <table style="width:100%">
            <!-- BEGIN DBS -->
            <tr class="thead">
                <th class="right">#</th>
                <th>{L_DB}</th>
                <th class="left">{L_DUMP}</th>
                <th>{L_PREFIX}</th>
                <th>{L_COMMAND_BEFORE_BACKUP}</th>
                <th>{L_COMMAND_AFTER_BACKUP}</th>
            </tr>
            <tr class="dbrow">
                <td colspan="2">&nbsp;</td>
                <td class="left" colspan="4">
                    <a href="javascript:SelectMD(true,'{DBS.DB_COUNT}')" class="small">{ICON_PLUS}</a>
                    <a href="javascript:SelectMD(false,'{DBS.DB_COUNT}')" class="small">{ICON_MINUS}</a>
                </td>
            </tr>
            <!-- BEGIN ROW -->		
            <tr class="{DBS.ROW.ROWCLASS}">
                <td class="right">{DBS.ROW.NR}.</td>
                <td><label for="db_multidump_{DBS.ROW.ID}" style="display:block">{DBS.ROW.DB_NAME}</label></td>
                <td><input type="checkbox" id="db_multidump_{DBS.ROW.ID}" name="db_multidump_{DBS.ROW.ID}" value="db_multidump_{DBS.ROW.ID}"{DBS.ROW.DB_MULTIDUMP_ENABLED} /></td>
                <td><input type="text" class="text" name="dbpraefix_{DBS.ROW.ID}" size="10" value="{DBS.ROW.DB_PREFIX}" /></td>
                <td>{DBS.ROW.COMMAND_BEFORE_BACKUP_COMBO}</td>
                <td>{DBS.ROW.COMMAND_AFTER_BACKUP_COMBO}</td>
            </tr>
            <!-- END ROW -->
            <tr class="dbrow">
                <td colspan="2">&nbsp;</td>
                <td class="left" colspan="4">
                    <a href="javascript:SelectMD(true,'{DBS.DB_COUNT}')" class="small">{ICON_PLUS}</a>
                    <a href="javascript:SelectMD(false,'{DBS.DB_COUNT}')" class="small">{ICON_MINUS}</a>
               </td>
            </tr>
            <!-- END DBS -->
            <!-- BEGIN NO_DB -->
                <tr><td>{L_NO_DB_FOUND}</td></tr>
            <!-- END NO_DB -->
        </table>
    </fieldset>
    <br />
    <button class="Formbutton" type="submit" name="save">{ICON_SAVE} {L_SAVE}</button>
</div>
