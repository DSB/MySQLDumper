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
// Download of a backup file wanted
$file = urldecode($_GET['f']);

// check for injected chars by removing allowed chars and check if the rest
// only contains alphanumerical chars
$search = array('-','.', '_');
$replace = array('', '', '');
$check = str_replace($search, $replace, $file);
if (ctype_alnum($check) && is_readable($config['paths']['backup'] . $file)) {
    $file = './' . $config['paths']['backup'] . $file;
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . (string) filesize($file));
    flush();
    $file = fopen($file, "rb");
    while (!feof($file)) {
        print fread($file, round(100 * 1024));
        flush();
    }
    fclose($file);
} else {
    die('Error: Couldn\'t open file: ' . $file);
}
die();