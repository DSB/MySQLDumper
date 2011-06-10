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

$dba = $htaDir = $overwrite = $msg = '';
$error = array();
$type = 0; // default encryption type set to crypt()
if (strtoupper(substr(MSD_OS, 0, 3)) == 'WIN') {
    $type = 2; // we are on a Win-System; pre-select encryption type
}
if (isset($_POST['type'])) {
    $type = (int) $_POST['type'];
}
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$userpassOne = (isset($_POST['userpass1'])) ? $_POST['userpass1'] : '';
$userpassConfirm = (isset($_POST['userpass2'])) ? $_POST['userpass2'] : '';

$tplHomeProtectionCreate = new MSDTemplate();
$tplHomeProtectionCreate->set_filenames(
    array('tplHomeProtectionCreate' => 'tpl/home/protection_create.tpl')
);
$tplHomeProtectionCreate->assign_vars(array('THEME' => $config['theme']));

if (isset($_POST['username'])) {
    // Form submitted
    if ($username == '') {
        $error[] = $lang['L_HTACC_NO_USERNAME'];
    }
    if (($userpassOne != $userpassConfirm) || ($userpassOne == '')) {
        $error[] = $lang['L_PASSWORDS_UNEQUAL'];
    }

    if (sizeof($error) == 0) {
        $realm = 'MySQLDumper';
        $htaccess = "AuthName \"" . $realm
            . "\"\nAuthType Basic\nAuthUserFile \""
            . $config['paths']['root'] . ".htpasswd\"\nrequire valid-user\n";
        switch ($type)
        {
            // Crypt
            case 0:
                $userpass = crypt($userpassOne);
                break;
                // MD5
            case 1:
                $userpass = md5($username . ':' . $realm . ':' . $userpassOne);
                break;
                // Win - no encryption
            case 2:
                $userpass = $userpassOne;
                break;
                // SHA
            case 3:
                if (version_compare(PHP_VERSION, '5.0.0', '>=')) {
                    $userpass = '{SHA}' . base64_encode(sha1($userpassOne, TRUE));
                } else {
                    $userpass = '{SHA}' . base64_encode(sha1($userpassOne));
                }
                break;
        }
        $htpasswd = $username . ':' . $userpass;
        @chmod($config['paths']['root'], 0777);

        $saved = true;
        // save .htpasswd
        if ($f = @fopen('.htpasswd', 'w')) {
            $saved = fputs($f, $htpasswd);
            fclose($f);
        }

        // save .htaccess
        if (false !== $saved) {
            $f = @fopen('.htaccess', 'w');
            if ($f) {
                $saved = fputs($f, $htaccess);
                fclose($f);
            } else {
                $saved = false;
            }
        }

        if (false !== $saved) {
            $msg = $lang['L_HTACC_CREATED'];
            $tplHomeProtectionCreate->assign_block_vars(
                'CREATE_SUCCESS',
                array(
                    'HTACCESS' => nl2br(Html::replaceQuotes($htaccess)),
                    'HTPASSWD' => nl2br(Html::replaceQuotes($htpasswd))
                )
            );
            @chmod($config['paths']['root'], 0755);
        } else {
            $tplHomeProtectionCreate->assign_block_vars(
                'CREATE_ERROR',
                array(
                    'HTACCESS' => Html::replaceQuotes($htaccess),
                    'HTPASSWD' => Html::replaceQuotes($htpasswd)
                )
            );
        }
    }
}

if (sizeof($error) > 0 || !isset($_POST['username'])) {
    $tplHomeProtectionCreate->assign_vars(
        array(
            'PASSWORDS_UNEQUAL' =>
                Html::getJsQuote($lang['L_PASSWORDS_UNEQUAL']),
            'HTACC_CONFIRM_DELETE' =>
                Html::getJsQuote($lang['L_HTACC_CONFIRM_DELETE'])
        )
    );

    $tplHomeProtectionCreate->assign_block_vars(
        'INPUT',
        array(
            'USERNAME' => Html::replaceQuotes($username),
            'USERPASS1' => Html::replaceQuotes($userpassOne),
            'USERPASS2' => Html::replaceQuotes($userpassConfirm),
            'TYPE0_CHECKED' => Html::getChecked($type, 0),
            'TYPE1_CHECKED' => Html::getChecked($type, 1),
            'TYPE2_CHECKED' => Html::getChecked($type, 2),
            'TYPE3_CHECKED' => Html::getChecked($type, 3)
        )
    );
}

if (!empty($error)) {
    $msg = '<span class="error">' . implode('<br />', $error) . '</span>';
}
if ($msg > '') {
    $tplHomeProtectionCreate->assign_block_vars(
        'MSG', array('TEXT' => $msg)
    );
}
