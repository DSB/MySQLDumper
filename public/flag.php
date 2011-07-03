<?php
$language = isset($_GET['langId']) ? $_GET['langId'] : '';

if (preg_match('/^[A-Z0-9_]+\z/i', $language)) {
    define('DS', DIRECTORY_SEPARATOR);
    $languageDir = realpath(dirname(__FILE__) . '/../application/language');
    $image = $languageDir . DS . $language . DS . 'flag.gif';

    if (file_exists($image)) {
        header('Content-Type: image/gif');
        readfile(realpath($image));
    }
}