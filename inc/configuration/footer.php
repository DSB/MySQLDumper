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

// special div selected? DIV with this id will be shown e.g after pressing
// the save button
$sel = (isset($_POST['sel'])) ? $_POST['sel'] : 'db';
if (isset($_GET['sel'])) $sel = $_GET['sel'];

$tplConfigurationFooter = new MSDTemplate();
$tplConfigurationFooter->set_filenames(
    array('tplConfigurationFooter' => 'tpl/configuration/footer.tpl')
);

$tplConfigurationFooter->assign_vars(
    array(
        'SELECTED_DIV' => $sel,
        'NOTIFICATION_POSITION' => $config['notification_position']
    )
);

//output notification message if we have one
if ($msg > '') {
    $tplConfigurationFooter->assign_block_vars(
        'MESSAGE', array('TEXT' => Html::getJsQuote($msg, true))
    );
}
// if something went wrong with the change of a user or no database was found
// -> blend in connection params and let the user correct it
if ( (isset($blendInConnectionParams) && $blendInConnectionParams)
    || count($databases) == 0) {
        $tplConfigurationFooter->assign_block_vars(
            'SWITCH_TO_CONNECTION_PARAMETER', array()
        );
}