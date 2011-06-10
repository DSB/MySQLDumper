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
//add new cc-recipient
if ($action == 'add_recipient_cc') {
    $index = 0;
    if (isset($_POST['email_recipient_cc'])) {
        $index = count($_POST['email_recipient_cc']);
    }
    $_POST['email_recipient_cc'][$index]['name'] = '';
    $_POST['email_recipient_cc'][$index]['address'] = '';
    $_POST['save'] = true;
}

// delete cc-recipient
if ($action == 'delete_recipient_cc') {
    $index = (int) $_GET['cc'];
    unset($_POST['email_recipient_cc'][$index]);
    if (isset($config['email']['recipient_cc'][$index])) {
        unset($config['email']['recipient_cc'][$index]);
    }
    $_POST['save'] = true;
}

if (isset($_POST['save'])) {
    if (isset($_POST['send_mail'])) {
        $config['send_mail'] = (int) $_POST['send_mail'];
    }
    if (!is_array($config['email'])) {
        $config['email'] = array();
    }
    if (isset($_POST['email_recipient_address'])) {
        $config['email']['recipient_address'] =
            $_POST['email_recipient_address'];
    }
    if (isset($_POST['email_recipient_name'])) {
         $config['email']['recipient_name'] = $_POST['email_recipient_name'];
    }
    $config['email']['recipient_cc'] = array();
    if (isset($_POST['email_recipient_cc'])) {
        $i = 0;
        foreach ($_POST['email_recipient_cc'] as $key => $val) {
            $config['email']['recipient_cc'][$i] = array();
            $config['email']['recipient_cc'][$i]['name'] = $val['name'];
            $config['email']['recipient_cc'][$i]['address'] = $val['address'];
            $i++;
        }
    }
    if (isset($_POST['email_sender_name'])) {
        $config['email']['sender_name'] = $_POST['email_sender_name'];
    }
    if (isset($_POST['email_sender_address'])) {
        $config['email']['sender_address'] = $_POST['email_sender_address'];
    }
    if (isset($_POST['attach_backup'])) {
        $config['email']['sender_address'] = $_POST['attach_backup'];
    }
    if (isset($_POST['email_maxsize1'])) {
        $config['email_maxsize1'] = floatval($_POST['email_maxsize1']);
    }
    if (isset($_POST['email_maxsize2'])) {
        $config['email_maxsize2'] = $_POST['email_maxsize2'];
    }
    $config['email_maxsize'] = $config['email_maxsize1']
        * (($config['email_maxsize2'] == 1) ? 1024 : 1024 * 1024);
    if (isset($_POST['use_mailer'])) {
        $config['use_mailer'] = $_POST['use_mailer'];
    }
    if (isset($_POST['sendmail_call'])) {
        $config['sendmail_call'] = $_POST['sendmail_call'];
    }
    if (isset($_POST['smtp_server'])) {
        $config['smtp_server'] = $_POST['smtp_server'];
    }
    if (isset($_POST['smtp_user'])) {
        $config['smtp_user'] = $_POST['smtp_user'];
    }
    if (isset($_POST['smtp_pass'])) {
        $config['smtp_pass'] = $_POST['smtp_pass'];
    }
    if (isset($_POST['smtp_useauth'])) {
        $config['smtp_useauth'] = $_POST['smtp_useauth'];
    }
    if (isset($_POST['smtp_usessl'])) {
        $config['smtp_usessl'] = $_POST['smtp_usessl'];
    }
    if (isset($_POST['smtp_port'])) {
        $config['smtp_port'] = (int) $_POST['smtp_port'];
    }
    if (isset($_POST['smtp_pop3_server'])) {
        $config['smtp_pop3_server'] = (string) $_POST['smtp_pop3_server'];
    }
    if (isset($_POST['smtp_pop3_port'])) {
        $config['smtp_pop3_port'] = (int) $_POST['smtp_pop3_port'];
    }
}

// backwards compatibilty with older configurations
if (!isset($config['email_maxsize1'])) {
    $config['email_maxsize1'] = 0;
}
if (!isset($config['email_maxsize2'])) {
    $config['email_maxsize2'] = 1;
}
$tplConfigurationEmail = new MSDTemplate();
$tplConfigurationEmail->set_filenames(
    array('tplConfigurationEmail' => 'tpl/configuration/email.tpl')
);

$tplConfigurationEmail->assign_vars(
    array(
    'ICON_SAVE' => $icon['small']['save'],
    'ICON_PLUS' => $icon['plus'],
    'ICON_DELETE' => $icon['delete'],
    'SEND_MAIL_ENABLED_SELECTED' => Html::getChecked($config['send_mail'], 1),
    'EMAIL_DISABLED' => Html::getDisabled($config['send_mail'], 0),
    'SEND_MAIL_DISABLED_SELECTED' => Html::getChecked($config['send_mail'], 0),
    'EMAIL_RECIPIENT_NAME' =>
        Html::replaceQuotes($config['email']['recipient_name']),
    'EMAIL_RECIPIENT_ADDRESS' =>
        Html::replaceQuotes($config['email']['recipient_address']),
    'EMAIL_SENDER_NAME' => Html::replaceQuotes($config['email']['sender_name']),
    'EMAIL_SENDER_ADDRESS' =>
            Html::replaceQuotes($config['email']['sender_address']),
    'ATTACH_BACKUP_ENABLED_SELECTED' =>
            Html::getChecked($config['email']['attach_backup'], 1),
    'ATTACH_BACKUP_DISABLED_SELECTED' =>
            Html::getChecked($config['email']['attach_backup'], 0),
    'MAXSIZE_DISABLED' =>
            Html::getDisabled($config['email']['attach_backup'], 0),
    'EMAIL_MAXSIZE' => $config['email_maxsize1'],
    'EMAIL_UNIT_SIZE_KB_SELECTED' =>
            Html::getSelected($config['email_maxsize2'], 1),
    'EMAIL_UNIT_SIZE_MB_SELECTED' =>
            Html::getSelected($config['email_maxsize2'], 2),
    'EMAIL_USE_PHPMAIL_SELECTED' => Html::getChecked($config['use_mailer'], 0),
    'EMAIL_USE_SENDMAIL_SELECTED' => Html::getChecked($config['use_mailer'], 1),
    'EMAIL_USE_SMTP_SELECTED' => Html::getChecked($config['use_mailer'], 2),
    'SENDMAIL_CALL' => Html::replaceQuotes($config['sendmail_call']),
    'SMTP_SERVER' => $config['smtp_server'],
    'SMTP_USER' => $config['smtp_user'],
    'SMTP_PASS' => $config['smtp_pass'],
    'SMTP_AUTH_DISABLED' => Html::getDisabled($config['smtp_useauth'], 0),
    'SMTP_AUTH_SELECTED' => Html::getChecked($config['smtp_useauth'], 1),
    'SMTP_AUTH_NOT_SELECTED' => Html::getChecked($config['smtp_useauth'], 0),
    'SMTP_SSL_SELECTED' => Html::getChecked($config['smtp_usessl'], 1),
    'SMTP_SSL_NOT_SELECTED' => Html::getChecked($config['smtp_usessl'], 0),
    'SMTP_PORT' => $config['smtp_port'],
    'SMTP_POP3_SERVER' => $config['smtp_pop3_server'],
    'SMTP_POP3_PORT' => $config['smtp_pop3_port'])
);
if ($config['smtp_useauth'] == 0) {
    $tplConfigurationEmail->assign_block_vars('HIDE_SMTP_AUTH_FIELDS', array());
}
if (is_array($config['email']['recipient_cc'])
    && sizeof($config['email']['recipient_cc']) > 0) {
    foreach ($config['email']['recipient_cc'] as $key => $val) {
        $confirmRecDelete = sprintf(
            $lang['L_CONFIRM_RECIPIENT_DELETE'],
            $val['name'] . ' ' . $val['address']
        );
        $confirmRecDelete = Html::replaceQuotes($confirmRecDelete);

        $tplConfigurationEmail->assign_block_vars(
            'EMAIL_RECIPIENT_CC',
            array(
                'NR' => $key,
                'CONFIRM_RECIPIENT_DELETE' => $confirmRecDelete,
                'EMAIL_RECIPIENT_CC_NAME' => Html::replaceQuotes($val['name']),
                'EMAIL_RECIPIENT_CC_ADDRESS' =>
                    Html::replaceQuotes($val['address'])
            )
        );
    }
}