<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
  * http://www.mysqldumper.net
 *
 * @package       MySQLDumper
 * @subpackage    Languages
 * @version       $Rev$
 * @author        $Author$
 * @lastmodified  $Date$
  */
// ************************************************************************
// This file holds all available languages
// ************************************************************************

// Add language to array. Must match directory name of the language.
GetLanguageArray();

// Language name in its own language.
$lang['en']='English';
$lang['de']='Deutsch';
$lang['es']='Español';
$lang['fr']='Français';
$lang['it']='Italiano';
$lang['nl']='Nederlands';
$lang['sw']='Svenska';
$lang['de_du']='Deutsch (mit Anredeform "du")';
$lang['pt_br']='Portuguese - BR';
$lang['tr']='Türkçe';
$lang['da']='Dansk';
$lang['lu']='Luxemburg';
$lang['pl']='Polski';
$lang['ch']='Schweizer Deutsch';
$lang['ar']='Arabic';
$lang['vn']='Tiếng Việt';
$lang['el']='Ελληνικά';
$lang['ro']='Rumänisch';
$lang['sk']='Slovakia';
$lang['fa']='Persian (Farsi)';
$lang['ru']='Русский';
$lang['cs']='Czech';
$lang['si']='Slovenščina';
// ************************************************************************
// Language defaults to english.
if (!in_array($config['language'], $lang['languages'])) {
    $config['language']='en';
}