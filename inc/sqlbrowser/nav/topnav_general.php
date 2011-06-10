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

$tplSqlbrowserTopnav = new MSDTemplate();
$tplSqlbrowserTopnav->set_filenames(
    array(
        'tplSqlbrowserTopnav' => 'tpl/sqlbrowser/nav/topnav_general.tpl'
    )
);
$tplSqlbrowserTopnav->assign_vars(
    array(
        'ICON_DB' => $icon['db'],
        'ICON_VIEW' => $icon['view'],
        'ICON_EDIT' => $icon['edit']
    )
);
