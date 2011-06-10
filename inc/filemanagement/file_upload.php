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

if (!defined('MSD_VERSION')) {
    die('No direct access.');
}
if (!isset($_FILES['upfile']['name'])
    || trim($_FILES['upfile']['name']) == '') {
    $msg .= Html::getErrorMsg(
        $lang['L_FM_UPLOADFILEREQUEST'] . '<br />' . $lang['L_FM_UPLOADFAILED']
    );
} else {
    if (!file_exists($config['paths']['backup'] . $_FILES['upfile']['name'])) {
        $extension = strrchr($_FILES['upfile']['name'], '.');
        $allowedExtensions = array('.gz', '.sql', 'txt');
        if (!in_array($extension, $allowedExtensions)) {
            $msg .= Html::getErrorMsg(
                $lang['L_FM_UPLOADNOTALLOWED1'] . '<br />'
                . $lang['L_FM_UPLOADNOTALLOWED2']
            );
            $msg .= Html::getErrorMsg($lang['L_FM_UPLOADFAILED']);
        } else {
            $upfile = $config['paths']['backup'] . $_FILES['upfile']['name'];
            if (@move_uploaded_file($_FILES['upfile']['tmp_name'], $upfile)) {
                @chmod($upfile, 0777);
                $msg = Html::getOkMsg(
                    sprintf(
                        $lang['L_FILE_UPLOAD_SUCCESSFULL'],
                        $_FILES['upfile']['name']
                    )
                );
            } else {
                $msg .= Html::getErrorMsg($lang['L_FM_UPLOADMOVEERROR']);
                $msg .= Html::getErrorMsg($lang['L_FM_UPLOADFAILED']);
            }
        }
    } else {
        $msg .= Html::getErrorMsg($lang['L_FM_UPLOADFILEEXISTS']);
        $msg .= Html::getErrorMsg($lang['L_FM_UPLOADFAILED']);
    }
}
