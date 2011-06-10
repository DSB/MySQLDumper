<?php
if (!defined('MSD_VERSION')) die('No direct access.');
include ('./language/'.$config['language'].'/lang_sql.php');
echo MSDHeader();
echo headline($lang['L_HTACC_EDIT']);

$htaccessdontexist=0;

if ((isset($_GET['create'])&&$_GET['create']==1)||(isset($_POST['create'])&&$_POST['create']==1))
{
	$fp=fopen($hta_dir.'.htaccess','w');
	fwrite($fp,"# created by MySQLDumper ".MSD_VERSION."\n");
	fclose($fp);
}
if (isset($_POST['newload']))
{
	$hta_dir=(isset($_POST['newhtadir'])) ? $_POST['newhtadir'] : '';
}
else
	$hta_dir=(isset($_POST['hta_dir'])) ? $_POST['hta_dir'] : '';
if ($hta_dir!=''&substr($hta_dir,-1)!='/') $hta_dir.='/';

if (isset($_POST['submit'])&&isset($_POST['thta']))
{
	$fp=fopen($hta_dir.'.htaccess','w');
	fwrite($fp,$_POST['thta']);
	fclose($fp);
}
if (file_exists($hta_dir.'.htaccess'))
{
	$htaccess_exist=file($hta_dir.'.htaccess');
}
else
{
	$htaccessdontexist=1;
}

echo $lang['L_HTACCESS32'];
echo '<form name="ehta" action="main.php?action=edithtaccess" method="post">File: <input type="text" name="newhtadir" value="'.$hta_dir.'" style="text-align:right;">.htaccess&nbsp;&nbsp;&nbsp;<input type="submit" name="newload" value=" '.$lang['L_HTACCESS19'].' " class="Formbutton">';
if ($htaccessdontexist!=1)
{
	echo '<table class="bdr"><tr><td style="width:70%;"><textarea rows="25" cols="40" name="thta" id="thta">'.htmlspecialchars(implode("",$htaccess_exist)).'</textarea><br><br>';
	echo '</td><td valign="top">';
	//Presets
	echo '<h6>Presets</h6><p><strong>'.$lang['L_HTACCESS30'].'</strong><p>
		<a href="javascript:insertHTA(1,document.ehta.thta)">all-inkl</a><br>

		<br><p><strong>'.$lang['L_HTACCESS31'].'</strong></p>
		<a href="javascript:insertHTA(101,document.ehta.thta)">'.$lang['L_HTACCESS20'].'</a><br>
		<a href="javascript:insertHTA(102,document.ehta.thta)">'.$lang['L_HTACCESS21'].'</a><br>
		<a href="javascript:insertHTA(103,document.ehta.thta)">'.$lang['L_HTACCESS22'].'</a><br>
		<a href="javascript:insertHTA(104,document.ehta.thta)">'.$lang['L_HTACCESS23'].'</a><br>
		<a href="javascript:insertHTA(105,document.ehta.thta)">'.$lang['L_HTACCESS24'].'</a><br>
		<a href="javascript:insertHTA(106,document.ehta.thta)">'.$lang['L_HTACCESS25'].'</a><br>
		<a href="javascript:insertHTA(107,document.ehta.thta)">'.$lang['L_HTACCESS26'].'</a><br>
		<a href="javascript:insertHTA(108,document.ehta.thta)">'.$lang['L_HTACCESS27'].'</a><br>
		<a href="javascript:insertHTA(109,document.ehta.thta)">'.$lang['L_HTACCESS28'].'</a><br>
		<br><a href="http://httpd.apache.org/docs/2.0/mod/directives.html" target="_blank">'.$lang['L_HTACCESS29'].'</a>';
	echo '</td></tr><tr><td colspan="2">'.$lang['L_HTACCESS18'].'<input type="text" name="hta_dir" size="60" value="'.$hta_dir.'"></td></tr><tr><td colspan="2">';
	echo '<input type="submit" class="Formbutton" name="submit" value=" '.$lang['L_SAVE'].' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
	echo '<input type="reset" class="Formbutton" name="reset" value=" '.$lang['L_RESET'].' " class="Formbutton">&nbsp;&nbsp;&nbsp;';
	echo '</td></tr></table></form>';
}
else
{
	echo '<p class="warnung">'.$hta_dir.'.htaccess existiert nicht. Soll sie erstellt werden ?</p>';
	echo '<form action="" method="post"><input type="hidden" name="hta_dir" value="'.$hta_dir.'"><input type="hidden" name="create" value="1"><input type="submit" name="createhtaccess" value="erstellen"></form>';
}
echo '<br><a href="main.php">'.$lang['L_BACK'].'</a>';
ob_end_flush();
exit();