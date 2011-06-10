<?php
//TODO security -> implement whitelist of characters for langId
$country = str_replace(
    array('..', "\x00"),
    '',
    $_GET['langId']
);

$languageDir = realpath(dirname(__FILE__) . '/../application/language');

header('Content-Type: image/gif');

define('DS', DIRECTORY_SEPARATOR);
$image = $languageDir . DS . $country . DS . 'flag.gif';

readfile(realpath($image));