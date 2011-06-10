<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1220 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
session_name('MySQLDumper');
session_start();
$install = true; // needed to load default values in runtime.php
include ('./inc/classes/helper/Html.php');
include ('./inc/classes/helper/File.php');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./inc/mysql.php');
if (!function_exists('arfsort')) {
    include ('./inc/functions/functions_global.php');
}
include_once ('./lib/template.php');
include_once ('./inc/mysql.php');

if (1 == get_magic_quotes_gpc()) {
    $_POST = Html::stripslashesDeep($_POST);
    $_GET = Html::stripslashesDeep($_GET);
}
$_POST = Html::trimDeep($_POST);
$_GET = Html::trimDeep($_GET);
if (!isset($config['language'])) {
    $config['language'] = 'en';
}
if (isset($_POST['language']) && is_dir('./language/' . $_POST['language'])) {
    $config['language'] = $_POST['language'];
}
if (isset($_GET['language']) && is_dir('./language/' . $_GET['language'])) {
    $config['language'] = $_GET['language'];
}
include ('./language/lang_list.php');
// make double sure that language files can be included -> otherwise fall back to english
if (!is_readable('./language/' . $config['language'] . '/lang.php')) {
    $config['language'] = 'en';
}
if (is_readable('./language/' . $config['language'] . '/lang.php')) {
    include ('./language/' . $config['language'] . '/lang.php');
} else {
    include ('./language/en/lang.php');
}
include ('./inc/define_icons.php');
//Variabeln
$phase = (isset($_POST['phase'])) ? intval($_POST['phase']) : 0;
if (isset($_GET['phase'])) $phase = intval($_GET['phase']);
header('content-type: text/html; charset=utf-8');
$tpl = new MSDTemplate();
$tpl->set_filenames(array('show' => 'tpl/install/header.tpl'));
$tpl->assign_vars(
    array(
        'LANGUAGE' => $config['language'] != 'de_du' ? $config['language'] : 'de',
        'ICON_OK' => $icon['ok'],
        'ICON_NOT_OK' => $icon['not_ok'],
        'MSD_VERSION' => MSD_VERSION . ' (' . MSD_VERSION_SUFFIX . ')'
    )
);
$tpl->pparse('show');
// Step 1: select language
if ($phase == 0) {
    // clean vars if they exist from previous runs
    if (isset($_SESSION['config'])) unset($_SESSION['config']);
    if (isset($_SESSION['databases'])) unset($_SESSION['databases']);
    // try to chmod Perl scripts correctly
    @chmod('./msd_cron/crondump.pl', 0755);
    @chmod('./msd_cron/perltest.pl', 0755);
    @chmod('./msd_cron/simpletest.pl', 0755);
    @chmod('./languages', 0777);
    $downloadPossible = true;
    // if function fsockopen is disabled by server configuration we can't connect to the download server
    if (!(false === strpos($config['disabled'], 'fsockopen'))) $downloadPossible = false;
    // todo-list of files to download if language pack should be installed.
    // if it exists from last run -> delete it
    if (isset($_SESSION['get_language'])) unset($_SESSION['get_language']);
    $tpl = new MSDTemplate();
    $tpl->set_filenames(array('show' => 'tpl/install/select_language.tpl'));
    $tpl->assign_vars(
        array(
            'SESSION_ID' => session_id(),
            'MSD_VERSION' => MSD_VERSION,
            'LANGUAGE' => $config['language'],
            'ICON_OK' => $icon['ok'],
            'ICON_NOT_OK' => $icon['not_ok'],
            'ICON_DOWNLOAD' => $icon['download'],
            'ICON_SAVE' => $icon['small']['save']
        )
    );
    if (!$downloadPossible) $tpl->assign_block_vars('FSOCKOPEN_DISABLED', array());
    // build list of downloadable languages
    $languages = array();
    foreach ($lang as $index => $val) {
        if ($index != 'languages' && substr($index, 0, 2) != 'L_') $languages[$index] = $val;
    }
    ksort($languages); //sort list alphabetically ascending
    $i = 1;
    foreach ($languages as $key => $val) {
        // walk through lang-files to get the language var for the button
        if (is_readable('./language/' . $key . '/lang.php')) {
            // language is installed
            include ('./language/' . $key . '/lang.php');
            $tpl->assign_block_vars(
                'LANG', array(
                            'NR' => $i,
                            'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                            'LANG' => $key,
                            'NAME' => $lang[$key],
                            'LANG_DOWNLOAD_LANGUAGE_PACK' => $lang['L_UPDATE'],
                            'DOWNLOAD_DISABLED' => Html::getDisabled($downloadPossible, false),
                            'INSTALL_BUTTON_VALUE' => str_replace('\'', '\\\'', $lang['L_SAVEANDCONTINUE'])
                        )
            );
            $tpl->assign_block_vars('LANG.INSTALLED', array('LANG_INSTALLED' => $lang['L_INSTALLED']));
        } else {
            // language is not installed
            $tpl->assign_block_vars(
                'LANG', array(
                            'NR' => $i,
                            'ROWCLASS' => $i % 2 ? 'dbrow' : 'dbrow1',
                            'LANG' => $key,
                            'NAME' => $lang[$key],
                            'LANG_DOWNLOAD_LANGUAGE_PACK' => $lang['L_DOWNLOAD_FILE'],
                            'RADIO_DISABLED' => Html::getDisabled(true, true),
                            'LANG_DOWNLOAD_LANGUAGE_PACK' => 'Download',
                            'DOWNLOAD_DISABLED' => Html::getDisabled($downloadPossible, false),
                            'INSTALL_BUTTON_VALUE' => 'Install'
                    )
            );
            $tpl->assign_block_vars('LANG.NOT_INSTALLED', array('LANG_NOT_INSTALLED' => 'Not installed'));
            $tpl->assign_block_vars('SET_OPACITY', array('NR' => $i));
        }
        $i++;
    }
    // reload language vars of selected language for installation screen.
    // Otherwise buttons would be set to the last loaded language in the list
    // This is needed because language vars are assigned dynamically in template class when calling pparse
    if (is_readable('./language/' . $config['language'] . '/lang.php')) {
        include ('./language/' . $config['language'] . '/lang.php');
    } else {
        include ('./language/en/lang.php');
    }
    $tpl->pparse('show');
}
// Step 2: check directories and their rights
if ($phase == 1) {
    // check directories
    $tpl = new MSDTemplate();
    $tpl->set_filenames(array('show' => 'tpl/install/check_directories.tpl'));
    $tpl->assign_vars(array('LANGUAGE' => $config['language'], 'SESSION_ID' => session_id()));
    $checkDirs = ARRAY('work/', 'work/config/', 'work/log/', 'work/backup/');
    $isWritable = array();
    if (1 == $config['safe_mode']) $tpl->assign_block_vars('SAFE_MODE_ON', array());
    $i = 0;
    foreach ($checkDirs as $dir) {
        clearstatcache();
        if (!is_dir($dir)) @mkdir($dir);
        clearstatcache();
        $check = file_exists($dir);
        $isWritable[$i] = File::isWritable($dir, 0777);
        $tpl->assign_vars(
            array(
                'LANGUAGE' => $config['language'],
                'ICON_OK' => $icon['ok']
            )
        );
        $tpl->assign_block_vars(
            'DIR', array(
                        'NAME' => $config['paths']['root'] . $dir,
                        'CHMOD' => File::getChmod($dir),
                        'ICON_EXISTS' => $check === true ? $icon['ok'] : $icon['not_ok'] . ' ' . $check,
                        'ICON_IS_WRITABLE' => $isWritable[$i] ? $icon['ok'] : $icon['not_ok']
                    )
        );
        $i++;
    }
    if (in_array(false, $isWritable)) {
        $tpl->pparse('show'); // something is wrong with the dirs -> show info
    } else {
        $phase = 2; // everything ok -> continue with db-param-input
    }
}
// Step 3: database parameters
if ($phase == 2) {
    $tpl = new MSDTemplate();
    $tpl->set_filenames(array('show' => 'tpl/install/db_parameter.tpl'));
    // default values
    if (!isset($config['dbhost'])) $config['dbhost'] = 'localhost';
    if (!isset($config['dbuser'])) $config['dbuser'] = 'root';
    if (!isset($config['dbpass'])) $config['dbpass'] = '';
    if (!isset($config['dbport'])) $config['dbport'] = '';
    if (!isset($config['dbsocket'])) $config['dbsocket'] = '';
    if (!isset($config['dbmanual'])) $config['dbmanual'] = '';
    $tpl->assign_vars(array('LANGUAGE' => $config['language'], 'ICON_SAVE' => $icon['small']['save']));
    if (isset($_POST['dbconnect'])) {
        // get inputs
        $config['dbhost'] = $_POST['dbhost'];
        $config['dbuser'] = $_POST['dbuser'];
        $config['dbpass'] = $_POST['dbpass'];
        $config['dbmanual'] = $_POST['dbmanual'];
        if ( (int) $_POST['dbport'] > 0) {
             $config['dbport'] = (int) $_POST['dbport'];
        } else {
            $config['dbport'] = 3306;
        }
        $config['dbsocket'] = $_POST['dbsocket'];
        include ('./inc/classes/db/MsdDbFactory.php');
        $dbo = MsdDbFactory::getAdapter(
            $config['dbhost'],
            $config['dbuser'],
            $config['dbpass'],
            $config['dbport'],
            $config['dbsocket']
        );
        $connectMsg = $dbo->dbConnect();
        if ($connectMsg === true) {
            if ($config['dbmanual'] > '') {
                $dbDetect = searchDatabases(1, $config['dbmanual']);
            } else {
                $dbDetect = searchDatabases(1);
            }
        } else {
            $tpl->assign_block_vars('CONNECTION_ERROR', array('MSG' => SQLError('', $connectMsg, true)));
            $dbDetect = false;
        }
        if (false !== $dbDetect) {
            $saveButton = str_replace('\'', '\\\'', $lang['L_SAVEANDCONTINUE']);
            $tpl->assign_block_vars(
                'CONTINUE', array(
                    'SAVE_AND_CONTINUE' => $saveButton)
            );
            $tpl->assign_block_vars('OK', array());
            $tpl->assign_block_vars('CONNECTION_OK', array('RESULT' => $dbDetect));
            if (count($databases) == 0) $tpl->assign_block_vars('CONNECTION_OK_BUT_NO_DB', array());
        }
    }
    $tpl->assign_vars(
        array(
            'SESSION_ID' => session_id(),
            'DB_HOST' => $config['dbhost'],
            'DB_USER' => $config['dbuser'],
            'DB_PASS' => $config['dbpass'],
            'DB_MANUAL' => $config['dbmanual'],
            'ICON_OK' => $icon['ok'])
    );
    $tpl->pparse('show');
}
$_SESSION['config'] = $config;
$_SESSION['databases'] = $databases;
// Step 4: normally not visible - save checked config-params and redirect to
// start page of MySQLDumper
if ($phase == 3) {
    // save configuration with checked db-parameters
    $configSaved = saveConfig();
    if (!$configSaved) {
        // Ouch, although we checked everything before we now couldn't save
        // the config -> should never happen
        echo '<h6>MySQLDumper - ' . $lang['L_CONFBASIC'] . '</h6>';
        echo '<p class="warnung">Fatal Error: couldn\'t save configuration!!</p>';
    } else {
        // Everything is done - redirect to start screen of MySQLDumper
        echo '<script type="text/javascript">';
        echo 'self.location.href="index.php?MySQLDumper=' . session_id() . '"';
        echo '</script>';
    }
}
?>
</div>
</div>
</body>
</html>