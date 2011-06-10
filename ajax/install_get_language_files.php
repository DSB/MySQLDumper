<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1212 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
$updateUrl = 'http://update.mysqldumper.de/index.php';
session_name('MySQLDumper');
session_start();
$languageToLoad = isset($_GET['l']) ? trim($_GET['l']) : '';
$version = isset($_GET['v']) ? floatval(trim($_GET['v'])) : '';
$path = './language/' . $languageToLoad;
$error = false;
if (session_id() != $_GET['MySQLDumper']) {
    $error[] = 'Invalid Session';
}
chdir('./../');
include ('./inc/functions/functions.php');
include ('./inc/runtime.php');
include ('./lib/json.php');
include ('./inc/functions/functions_global.php');
include ('./inc/mysql.php');
include ('./inc/classes/helper/Html.php');
include ('./inc/classes/helper/File.php');
header('Pragma: no-cache');
header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
header('Expires: -1'); // Datum in der Vergangenheit
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
header('Content-Type: text/html; charset=UTF-8');
$message = array();
$inProgress = 1;
clearstatcache();
$filesToLoad = array('lang');
if (!isset($_SESSION['get_language'])) {
    // try to create sub-dir for language if it does not exists
    if (!is_dir($path)) {
        $res = @mkdir($path, 0755);
        if (true === $res) {
            $msg = 'Directory \'' . $path . '\' created successfully';
            $message[] = Html::getOkMsg($msg);
        } else {
            $msg = 'Fatal error: Couldn\'t create directory \'' . $path;
            $msg .= '\'! You need to create it using your FTP-Programm and ';
            $msg .= 'grant rights 0777!';
            $message[] = Html::getErrorMsg($msg);
        }
    } else {
        $message[] = Html::getOkMsg('Directory \'' . $path . '\' exists.');
    }
    // try to chmod
    if (!File::isWritable($path, 0755)) {
        if (File::isWritable($path, 0777)) {
            $msg = 'Directory \'' . $path . '\' is writable.';
            $message[] =Html::getOkMsg($msg);
        } else {
            $msg = 'Fatal error: Directory \'' . $path;
            $msg .= '\' is not writable for me! Make it writable using your ';
            $msg .= 'FTP-Programm!';
            $message[] = Html::getErrorMsg($msg);
        }
    } else {
        $message[] = Html::getOkMsg('Directory \'' . $path . '\' is writable.');
        $_SESSION['get_language'] = $filesToLoad;
    }
} else {
    // get next file to download
    if (count($_SESSION['get_language']) > 0) {
        $file = $_SESSION['get_language'][count($_SESSION['get_language']) - 1];
        $call = '?a=get_language_file&v=' . $version . '&l=' . $languageToLoad ;
        $call .= '&f=' . $file;
        $fileData = getFileDataFromURL($updateUrl . $call);
        if (false === $fileData || $fileData == '') {
            $msg = 'Fatal error: error downloading file \'' . $file . '\'!';
            $msg .= ' Please try again.';
            $message[] = Html::getErrorMsg($msg);
        } else {
            // save file to disk
            $file = $path . '/' . $file . '.php';
            $fp = @fopen($file, 'wb');
            if ($fp) {
                fwrite($fp, $fileData);
                fclose($fp);
                if (!File::isWritable($file, 0644)) {
                    File::isWritable($file, 0777);
                }
                $msg = ' File \'' . $file . '\' saved succesfully.';
                $message[] = Html::getOkMsg($msg);
                // remove file from todo list
                $fileIndex = count($_SESSION['get_language']) - 1;
                unset($_SESSION['get_language'][$fileIndex]);
            } else {
                $msg = 'Fatal error: couldn\'t write file \'' . $file;
                $msg .= '\' to \'' . $path . '\'';
                $message[] = Html::getErrorMsg($msg);
            }
        }
    } else {
        $inProgress = 0;
        $msg = 'Finished installing language \'' . $languageToLoad;
        $msg .= '\' successfully.';
        $message[] = Html::getOkMsg($msg);
    }
}
$json = new Services_JSON();
$r = array();
$r['in_progress'] = $inProgress; // finished? 0=no
$r['error'] = 0;
if ($error) {
    if (!empty($_SESSION['get_language'])) {
        $msg = 'Incomplete installation of language pack: ';
        $msg .= 'removing incomplete files.';
        $message[] = Html::getErrorMsg($msg);
        // now we need to delete the language files
        foreach ($filesToLoad as $file) {
            if (file_exists($path . '/' . $file . '.php')) {
                if (@unlink($path . '/' . $file . '.php')) {
                    $msg = 'Deleted file \'' . $file . '\' successfully.';
                    $message[] = Html::getOkMsg($msg);
                } else {
                    $msg = 'Error deleting file \'' . $file;
                    $msg .= '\'! Remove it using your FTP-Programm!';
                    $message[] = Html::getErrorMsg($msg);
                }
            }
        }
        if (!in_array($languageToLoad, array('en', 'de'))) {
            if (@rmdir($path)) {
                $msg = 'Directory \'' . $languageToLoad;
                $msg .= '\' deleted successfully.';
                $message[] = Html::getOkMsg($msg);
            } else {
                $msg = 'Error deleting directory \'' . $path . '\'!';
                $message[] = Html::getErrorMsg($msg);
            }
        }
    }
    $r['error'] = 1; // inidcate that an error occured to stop further actions
    $r['in_progress'] = 0;
}
$r['message'] = implode('', $message);
if ($r['in_progress'] == 0) {
    unset($_SESSION['get_language']);
}
echo $json->encode($r);
