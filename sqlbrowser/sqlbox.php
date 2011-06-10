<?php
if (!defined('MSD_VERSION')) die('No direct access.');
//Start SQL-Box
$tpl=new MSDTemplate();
$tpl->set_filenames(array(
						
						'show' => $config['paths']['root'] . 'sqlbrowser/templates/sqlbox.tpl'
));

if (isset($_GET['readfile']) && $_GET['readfile'] == 1)
{
	$tpl->assign_block_vars('SQLUPLOAD',array(
											
											'POSTTARGET' => $params, 
											'LANG_OPENSQLFILE' => $lang['sql_openfile'], 
											'LANG_OPENSQLFILE_BUTTON' => $lang['sql_openfile_button'], 
											'LANG_SQL_MAXSIZE' => $lang['max_upload_size'], 
											'MAX_FILESIZE' => $config['upload_max_filesize']
	));

}

if (isset($_POST['submit_openfile']))
{
	//open file
	if (!isset($_FILES['upfile']['name']) || empty($_FILES['upfile']['name'])) $aus.='<span class="error">' . $lang['fm_uploadfilerequest'] . '</span>';
	else
	{
		$fn=$_FILES['upfile']['tmp_name'];
		if (strtolower(substr($_FILES['upfile']['name'],-3)) == ".gz") $read__user_sqlfile=gzfile($fn);
		else $read__user_sqlfile=file($fn);
		$aus.='<span>geladenes File: <strong>' . $_FILES['upfile']['name'] . '</strong>&nbsp;&nbsp;&nbsp;' . byte_output(filesize($_FILES['upfile']['tmp_name'])) . '</span>';
		$sql_loaded=implode("",$read__user_sqlfile);
	}
}

// Sind SQL-Befehle in der SQLLib vorhanden?
$sqlcombo=SQL_ComboBox();
if ($sqlcombo > '') $tpl->assign_block_vars('SQLCOMBO',array(
															
															'SQL_COMBOBOX' => $sqlcombo
));

$tpl->assign_vars(array(
						
						'LANG_SQL_WARNING' => $lang['sql_warning'], 
						'ICONPATH' => $config['files']['iconpath'], 
						'MYSQL_REF' => $mysql_help_ref, 
						'BOXSIZE' => $config['interface_sqlboxsize'], 
						'BOXCONTENT' => ( ( isset($sql_loaded) ) ? $sql_loaded : $sql['sql_statement'] . $sql['order_statement'] ), 
						'LANG_SQL_BEFEHLE' => $lang['sql_befehle'], 
						'TABLE_COMBOBOX' => Table_ComboBox(), 
						'LANG_SQL_EXEC' => $lang['sql_exec'], 
						'PARAMS' => $params, 
						'DB' => $db, 
						'DBID' => $dbid, 
						'TABLENAME' => $tablename, 
						'ICON_SEARCH' => $icon['search'], 
						'ICON_UPLOAD' => $icon['upload'], 
						'ICON_MYSQL_HELP' => $icon['mysql_help'], 
						'MYSQL_HELP' => $lang['title_mysql_help']
));
$tpl->pparse('show');