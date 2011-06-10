<?php
error_reporting(E_ALL);
$download=( isset($_POST['f_export_submit']) && ( isset($_POST['f_export_sendresult']) && $_POST['f_export_sendresult'] == 1 ) );
include ( './inc/header.php' );
include ( 'language/' . $config['language'] . '/lang.php' );
include ( 'language/' . $config['language'] . '/lang_sql.php' );
include ( './inc/functions_sql.php' );
include ( './' . $config['files']['parameter'] );
include ( './inc/template.php' );
include ( './inc/define_icons.php' );

$key='';
if (isset($_GET['rk']))
{
	$rk=$config['magic_quotes_gpc'] ? stripslashes($_GET['rk']) : $_GET['rk'];
	$key=urldecode($rk);
	if (!$rk=@unserialize($key)) $rk=$key;
}
else
	$rk='';
$mode=isset($_GET['mode']) ? $_GET['mode'] : '';

if (isset($_REQUEST['recordkey']))
{
	$recordkey=$config['magic_quotes_gpc'] ? stripslashes($_REQUEST['recordkey']) : $_REQUEST['recordkey'];
	$key=urldecode($recordkey);
	if (!$recordkey=@unserialize(urldecode($key))) $recordkey=urldecode($key);
}

$context=( !isset($_GET['context']) ) ? 0 : $_GET['context'];
$context=( !isset($_POST['context']) ) ? $context : $_POST['context'];

if (!$download)
{
	echo MSDHeader();
	ReadSQL();
	echo '<script language="JavaScript" type="text/javascript">
		var auswahl = "document.getElementsByName(\"f_export_tables[]\")[0]";
		var msg1="' . $lang['sql_notablesselected'] . '";
		</script>';
}
//Variabeln
$mysql_help_ref='http://dev.mysql.com/doc/';
$mysql_errorhelp_ref='http://dev.mysql.com/doc/mysql/en/error-handling.html';
$no_order=false;
$tdcompact=( isset($_GET['tdc']) ) ? $_GET['tdc'] : $config['interface_table_compact'];
$db=( !isset($_GET['db']) ) ? $databases['db_actual'] : $_GET['db'];
$dbid=( !isset($_GET['dbid']) ) ? $databases['db_selected_index'] : $_GET['dbid'];
$context=( !isset($_GET['context']) ) ? 0 : $_GET['context'];
$context=( !isset($_POST['context']) ) ? $context : $_POST['context'];
$tablename=( !isset($_GET['tablename']) ) ? "" : $_GET['tablename'];
$limitstart=( isset($_POST['limitstart']) ) ? intval($_POST['limitstart']) : 0;
if (isset($_GET['limitstart'])) $limitstart=intval($_GET['limitstart']);
$orderdir=( !isset($_GET['orderdir']) ) ? '' : $_GET['orderdir'];
$order=( !isset($_GET['order']) ) ? '' : $_GET['order'];
$sqlconfig=( isset($_GET['sqlconfig']) ) ? 1 : 0;
$editkey=( !isset($_GET['editkey']) ) ? -1 : $_GET['editkey'];
$norder=( $orderdir == "DESC" ) ? 'ASC' : 'DESC';
$sql['order_statement']=( $order != '' ) ? ' ORDER BY ' . $order . ' ' . $norder : '';
$sql['sql_statement']=( isset($_GET['sql_statement']) ) ? stripslashes(urldecode($_GET['sql_statement'])) : '';
if (isset($_POST['sql_statement'])) $sql['sql_statement']=$_POST['sql_statement'];

$showtables=( !isset($_GET['showtables']) ) ? 0 : $_GET['showtables'];
$limit=$add_sql='';
$bb=( isset($_GET['bb']) ) ? $_GET['bb'] : -1;
if (isset($_POST['tablename'])) $tablename=$_POST['tablename'];
$search=( isset($_GET['search']) ) ? $_GET['search'] : 0;

//SQL-Statement geposted
if (isset($_POST['execsql']))
{
	$sql['sql_statement']=( isset($_POST['sqltextarea']) ) ? stripslashes($_POST['sqltextarea']) : "";
	$db=$_POST['db'];
	$dbid=$_POST['dbid'];
	$tablename=$_POST['tablename'];
	if ($tablename == '') $tablename=ExtractTablenameFromSQL($sql['sql_statement']);
}

if ($sql['sql_statement'] == '')
{
	if ($tablename != '' && $showtables == 0)
	{
		$sql['sql_statement']="SELECT * FROM `$tablename`";
	}
	else
	{
		$sql['sql_statement']="SHOW TABLE STATUS FROM `$db`";
		$showtables=1;
	}
}

//sql-type
$sql_to_display_data=0;
$Anzahl_SQLs=getCountSQLStatements($sql['sql_statement']);
$sql_to_display_data=sqlReturnsRecords($sql['sql_statement']);
if ($Anzahl_SQLs > 1) $sql_to_display_data=0;
if ($sql_to_display_data == 1)
{
	//nur ein SQL-Statement
	$limitende=( $limitstart + $config['sql_limit'] );
	
	//Darf editiert werden?
	$no_edit=( strtoupper(substr($sql['sql_statement'],0,6)) != "SELECT" || $showtables == 1 || preg_match('@^((-- |#)[^\n]*\n|/\*.*?\*/)*(UNION|JOIN)@im',$sql['sql_statement']) );
	if ($no_edit) $no_order=true;
	
	//Darf sortiert werden?
	$op=strpos(strtoupper($sql['sql_statement'])," ORDER ");
	if ($op > 0)
	{
		//is order by last ?
		$sql['order_statement']=substr($sql['sql_statement'],$op);
		if (strpos($sql['order_statement'],')') > 0) $sql['order_statement']='';
		else $sql['sql_statement']=substr($sql['sql_statement'],0,$op);
	}
}

if (isset($_POST['tableselect']) && $_POST['tableselect'] != "1") $tablename=$_POST['tableselect'];
MSD_mysql_connect();
mysql_select_db($db,$config['dbconnection']);

///*** EDIT / UPDATES / INSERTS ***///
///***                          ***///


//Datensatz editieren
if (isset($_POST['update']) || isset($_GET['update']))
{
	GetPostParams();
	$f=explode('|',$_POST['feldnamen']);
	$sqlu='UPDATE `' . $tablename . '` SET ';
	for ($i=0; $i < count($f); $i++)
	{
		$fkey=str_replace('.','_',$f[$i]);
		$sqlu.='`' . $f["$i"] . '`=\'' . convert_to_latin1($_POST[$fkey]) . '\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu) - 2) . ' WHERE ' . $recordkey;
	$res=MSD_query($sqlu);
	$msg='<p class="success">' . $lang['sql_recordupdated'] . '</p>';
	if (isset($mode) && $mode == 'searchedit') $search=1;
	$sql_to_display_data=1;
}
//Datensatz einfuegen
if (isset($_POST['insert']))
{
	GetPostParams();
	$f=explode('|',$_POST['feldnamen']);
	$sqlu='INSERT INTO `' . $tablename . '` SET ';
	for ($i=0; $i < count($f); $i++)
	{
		$sqlu.='`' . $f[$i] . '`=\'' . convert_to_latin1($_POST[$f[$i]]) . '\', ';
	}
	$sqlu=substr($sqlu,0,strlen($sqlu) - 2);
	$res=MSD_query($sqlu);
	$msg='<p class="success">' . $lang['sql_recordinserted'] . '</p>';
	$sql_to_display_data=1;
}

if (isset($_POST['cancel'])) GetPostParams();

//Tabellenansicht
$showtables=( substr(strtoupper($sql['sql_statement']),0,10) == "SHOW TABLE" ) ? 1 : 0;
$tabellenansicht=( substr(strtoupper($sql['sql_statement']),0,5) == "SHOW " ) ? 1 : 0;

if (!isset($limitstart)) $limitstart=0;
$limitende=$config['sql_limit'];
if (strtolower(substr($sql['sql_statement'],0,6)) == "select") $limit=' LIMIT ' . $limitstart . ', ' . $limitende . ';';

$params="sql.php?db=" . $db . "&amp;tablename=" . $tablename . "&amp;dbid=" . $dbid . '&amp;context=' . $context . '&amp;sql_statement=' . urlencode($sql['sql_statement']) . '&amp;tdc=' . $tdcompact . '&amp;showtables=' . $showtables;
if ($order != "") $params.="&amp;order=" . $order . "&amp;orderdir=" . $orderdir . '&amp;context=' . $context;
if ($bb > -1) $params.="&amp;bb=" . $bb;

$aus=headline($lang['sql_browser']);

// Kopfzeile -- Tools...
$aus.='<p class="sqlheadmenu"><a href="main.php?action=db&amp;dbid=' . $dbid . '#dbid" onclick="setMenuActive(\'m1\');">' . $icon['back2db_overview'] . '</a>&nbsp;&nbsp;';
$aus.='<a title="' . $lang['tools_toolbox'] . '" href="sql.php?db=' . $databases['db_actual'] . '&amp;dbid=' . $dbid . '&amp;context=3"><strong>[' . $lang['tools'] . ']</strong></a>&nbsp;&nbsp;<strong>' . $lang['db'] . '</strong>&nbsp;&nbsp;';

if ($context < 3)
{
	$aus.='`<a href="sql.php?db=' . $db . '&amp;dbid=' . $dbid . '" title="' . $lang['sql_tableview'] . '"><strong>' . $db . '</strong></a>`  ' . ( ( $tablename != "" ) ? '<strong>' . $lang['table'] . '</strong> `<a href="sql.php?db=' . $db . '&amp;dbid=' . $dbid . '&amp;tablename=' . $tablename . '"><strong>' . $tablename . '</strong></a>`' : '' ) . '';
}
else
	$aus.="(" . $lang['sql_selecdb'] . ")";
$aus.='</p>';

if ($search == 0 && !$download)
{
	echo $aus;
	$aus='';
	include ( './sqlbrowser/sqlbox.php' );
	
	if ($mode > '' && $context == 0)
	{
		if (isset($recordkey) && $recordkey > '') $rk=urldecode($recordkey);
		if (isset($_GET['tablename'])) $tablename=$_GET['tablename'];
		
		if ($mode == 'kill' || $mode == 'kill_view')
		{
			if ($showtables == 0)
			{
				if (strpos($rk,"|") != false)
				{
					$rk=str_replace('|',' AND ',$rk);
				}
				$sqlk="DELETE FROM `$tablename` WHERE " . $rk . " LIMIT 1";
				$res=MSD_query($sqlk);
				//echo "<br>".$sqlk;
				$aus.='<p class="success">' . $lang['sql_recorddeleted'] . '</p>';
			}
			else
			{
				$sqlk="DROP TABLE `$rk`";
				if ($mode == 'kill_view') $sqlk='DROP VIEW `' . $rk . '`';
				$res=MSD_query($sqlk);
				$aus.='<p class="success">' . sprintf($lang['sql_recorddeleted'],$rk) . '</p>';
			}
		}
		if ($mode == "empty")
		{
			
			if ($showtables == 0)
			{
			
			}
			else
			{
				$sqlk="TRUNCATE `$rk`";
				$res=MSD_query($sqlk);
				$aus.='<p class="success">' . sprintf($lang['sql_tableemptied'],$rk) . '</p>';
			}
		}
		if ($mode == "emptyk")
		{
			if ($showtables == 0)
			{
			
			}
			else
			{
				$sqlk="TRUNCATE `$rk`;";
				$res=MSD_query($sqlk);
				$sqlk="ALTER TABLE `$rk` AUTO_INCREMENT=1;";
				$res=MSD_query($sqlk);
				$aus.='<p class="success">' . sprintf($lang['sql_tableemptiedkeys'],$rk) . '</p>';
			}
		}
		if ($mode == "edit" || $mode == "searchedit")
		{
			$rk=str_replace('|',' AND ',$recordkey);
			$aus.='<div id="sqleditbox"><p>' . $lang['sql_recordedit'] . '</p>';
			$sqledit="SELECT * FROM `$tablename` WHERE " . $rk;
			
			$res=MSD_query($sqledit);
			$aus.='<form action="sql.php';
			if ($mode == "searchedit") $aus.='?mode=searchedit';
			$aus.='" method="post">';
			$aus.='<input type="hidden" name="recordkey" value="' . build_recordkey($rk) . '">';
			$row=mysql_fetch_row($res);
			$aus.='<table>';
			$feldnamen="";
			for ($x=0; $x < count($row); $x++)
			{
				$str=mysql_fetch_field($res,$x);
				$feldnamen.=$str->name . '|';
				$aus.='<tr><td>' . convert_to_utf8($str->name) . '</td><td>';
				if ($str->type == 'blob') $aus.='<textarea cols="60" rows="4" name="' . $str->name . '">' . convert_to_utf8($row[$x]) . '</textarea>';
				else $aus.='<input type="text" class="text" size="60" name="' . $str->name . '" value="' . htmlspecialchars($row[$x],ENT_QUOTES) . '">';
				$aus.='</td>';
				$aus.='<td>&nbsp;</td></tr>'; //'.$str->type.'
			}
			
			$aus.='<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="' . substr($feldnamen,0,strlen($feldnamen) - 1) . '">
					<input class="Formbutton" type="submit" name="update" value="update">&nbsp;&nbsp;&nbsp;
					<input class="Formbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;
					<input class="Formbutton" type="Button" value="cancel edit" onclick="location.href=\'sql.php?db=' . $db . '&amp;dbid=' . $dbid . '&amp;tablename=' . $tablename . '\';"></td></tr>';
			$aus.='</table>' . FormHiddenParams() . '<input type="hidden" name="sql_statement" value="' . urlencode($sql['sql_statement']) . '"></form></div>';
		}
		
		if ($mode == "new")
		{
			$aus.='<div id="sqlnewbox"><p>' . $lang['sql_recordnew'] . '</p>';
			$sqledit="SHOW FIELDS FROM `$tablename`";
			$res=MSD_query($sqledit);
			$num=mysql_numrows($res);
			$aus.='<form action="sql.php" method="post">';
			$aus.='<input type="hidden" name="recordkey" value="">';
			
			$aus.='<table>';
			$feldnamen="";
			for ($x=0; $x < $num; $x++)
			{
				$row=mysql_fetch_row($res);
				$feldnamen.=$row[0] . '|';
				$aus.='<tr><td>' . $row[0] . '</td><td>';
				$type=strtoupper($row[1]);
				if ($type == 'BLOB' || $type == 'TEXT') $aus.='<textarea cols="60" rows="4" name="' . $row[0] . '">' . $row[4] . '</textarea>';
				else $aus.='<input type="text" class="text" size="60" name="' . $row[0] . '" value="' . $row[4] . '">';
				$aus.='</td>';
				$aus.='<td>&nbsp;</td></tr>'; //'.$str->type.'
			}
			$aus.='<tr><td colspan="3" align="right"><input type="hidden" name="feldnamen" value="' . substr($feldnamen,0,strlen($feldnamen) - 1) . '"><input class="Formbutton" type="submit" name="insert" value="insert">&nbsp;&nbsp;&nbsp;<input class="Formbutton" type="reset" name="reset" value="reset">&nbsp;&nbsp;&nbsp;<input class="Formbutton" type="submit" name="cancel" value="cancel insert"></td></tr>';
			$aus.='</table>' . FormHiddenParams() . '<input type="hidden" name="sql_statement" value="' . urlencode($sql['sql_statement']) . '"></form></div>';
		
		}
	}
	
	if ($context == 0) include_once ( './sqlbrowser/sql_dataview.php' );
	if ($context == 1) include ( './sqlbrowser/sql_commands.php' );
	if ($context == 2) include ( './sqlbrowser/sql_tables.php' );
	if ($context == 3) include ( './inc/sql_tools.php' );
}
if ($context == 4) include ( './inc/sql_importexport.php' );
if ($search == 1) include ( './sqlbrowser/mysql_search.php' );

if (!$download)
{
	?>
<script language="JavaScript" type="text/javascript">
function BrowseInput(el)
{
	var txt=document.getElementsByName('imexta')[0].value;
	var win=window.open('about:blank','MSD_Output','resizable=1,scrollbars=yes');
	win.document.write(txt);
	win.document.close();
	win.focus();
}
</script>
<?php
	
	echo '<br><br><br>';
	echo MSDFooter();
}

function FormHiddenParams()
{
	global $db,$dbid,$tablename,$context,$limitstart,$order,$orderdir;
	
	$s='<input type="hidden" name="db" value="' . $db . '">';
	$s.='<input type="hidden" name="dbid" value="' . $dbid . '">';
	$s.='<input type="hidden" name="tablename" value="' . $tablename . '">';
	$s.='<input type="hidden" name="context" value="' . $context . '">';
	$s.='<input type="hidden" name="limitstart" value="' . $limitstart . '">';
	$s.='<input type="hidden" name="order" value="' . $order . '">';
	$s.='<input type="hidden" name="orderdir" value="' . $orderdir . '">';
	return $s;
}