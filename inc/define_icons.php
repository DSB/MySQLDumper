<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

if (!defined('MSD_VERSION')) die('No direct access.');

//define icons
$icon['arrow_up'] = Html::getIcon('arrow_up.gif');
$icon['arrow_down'] = Html::getIcon('arrow_down.gif');
$icon['arrow_left'] = Html::getIcon(
    'arrowleft.gif', $lang['L_SQL_BACKDBOVERVIEW']
);
$icon['browse'] = Html::getIcon('browse.gif', $lang['L_TITLE_SHOW_DATA']);
$icon['cancel'] = Html::getIcon('delete.gif', $lang['L_CANCEL']);
$icon['edit'] = Html::getIcon('edit.gif', $lang['L_EDIT']);
$icon['delete'] = Html::getIcon('delete.gif', $lang['L_DELETE']);
$icon['db'] = Html::getIcon('db.gif', $lang['L_DBS']);
$icon['download'] = Html::getIcon('download.png');
$icon['close'] = Html::getIcon('close.gif', $lang['L_CLOSE']);
$icon['gz'] = Html::getIcon('gz.gif', $lang['L_COMPRESSED']);
$icon['index'] = Html::getIcon('index.gif', $lang['L_TITLE_INDEX']);
$icon['key_primary'] = Html::getIcon(
    'key_primary.gif', $lang['L_TITLE_KEY_PRIMARY']
);
$icon['key_fulltext'] = Html::getIcon(
    'key_fulltext.gif', $lang['L_TITLE_KEY_FULLTEXT']
);
$icon['key_unique'] = Html::getIcon(
    'key_unique.gif', $lang['L_TITLE_KEY_UNIQUE']
);
$icon['key_nokey'] = Html::getIcon('key_nokey.gif', $lang['L_TITLE_NOKEY']);
$icon['kill_process'] = Html::getIcon('delete.gif', $lang['L_KILL_PROCESS']);
$icon['minus'] = Html::getIcon('minus.gif');
$icon['mysql_help'] = Html::getIcon(
    'mysql_help.gif', $lang['L_TITLE_MYSQL_HELP']
);
$icon['not_ok'] = Html::getIcon('notok.gif');
$icon['ok'] = Html::getIcon('ok.gif');
$icon['open_file'] = Html::getIcon('openfile.gif', $lang['L_LOAD_FILE']);
$icon['plus'] = Html::getIcon('plus.gif');
$icon['restore'] = Html::getIcon('key_nokey.gif');
$icon['save'] = Html::getIcon('save.png', $lang['L_SAVE']);
$icon['search'] = Html::getIcon('search.gif', $lang['L_TITLE_SEARCH']);
$icon['table_truncate'] = Html::getIcon(
    'table_truncate.gif', $lang['L_EMPTY']
);
$icon['table_truncate_reset'] = Html::getIcon(
    'table_truncate_reset.gif', $lang['L_EMPTYKEYS']
);
$icon['truncate'] = Html::getIcon('truncate.gif', $lang['L_EMPTY']);
$icon['upload'] = Html::getIcon('openfile.gif', $lang['L_TITLE_UPLOAD']);
$icon['view'] = Html::getIcon('search.gif', $lang['L_VIEW']);

//other pics
$icon['logo'] = $config['theme'] . 'pics/h1_logo.gif';

// build smaller icons for ConfigButtons
$icon['small'] = array();
$icon['small']['edit'] = Html::getIcon('edit.gif', $lang['L_EDIT']);
$icon['small']['open_file'] = Html::getIcon('openfile.gif', $lang['L_LOAD_FILE']);
$icon['small']['save'] = Html::getIcon('save.png', $lang['L_SAVE']);
$icon['small']['view'] = Html::getIcon('search.gif', $lang['L_VIEW']);
