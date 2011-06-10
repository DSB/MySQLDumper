<?php

if (!defined('MSD_VERSION')) die('No direct access.');

//Feldspezifikationen
$feldtypen=Array("VARCHAR","TINYINT","TEXT","DATE","SMALLINT","MEDIUMINT","INT","BIGINT","FLOAT","DOUBLE","DECIMAL","DATETIME","TIMESTAMP","TIME","YEAR","CHAR","TINYBLOB","TINYTEXT","BLOB","MEDIUMBLOB","MEDIUMTEXT","LONGBLOB","LONGTEXT","ENUM","SET");
$feldattribute=ARRAY("","BINARY","UNSIGNED","UNSIGNED ZEROFILL");
$feldnulls=Array("NOT NULL","NULL");
$feldextras=Array("","AUTO_INCREMENT");
$feldkeys=Array("","PRIMARY KEY","UNIQUE KEY", "FULLTEXT");
$feldrowformat=Array("","FIXED","DYNAMIC","COMPRESSED");

$rechte_daten=Array("SELECT","INSERT","UPDATE","DELETE","FILE");
$rechte_struktur=Array("CREATE","ALTER","INDEX","DROP","CREATE TEMPORARY TABLES");
$rechte_admin=Array("GRANT","SUPER","PROCESS","RELOAD","SHUTDOWN","SHOW DATABASES","LOCK TABLES","REFERENCES","EXECUTE","REPLICATION CLIENT","REPLICATION SLAVE");
$rechte_resourcen=Array("MAX QUERIES PER HOUR","MAX UPDATES PER HOUR","MAX CONNECTIONS PER HOUR");

$sql_keywords=array(  'ALTER', 'AND', 'ADD', 'AUTO_INCREMENT','BETWEEN', 'BINARY', 'BOTH', 'BY', 'BOOLEAN','CHANGE', 'CHARSET','CHECK','COLLATE', 'COLUMNS', 'COLUMN', 'CROSS','CREATE',	'DATABASES', 'DATABASE', 'DATA', 'DELAYED', 'DESCRIBE', 'DESC',  'DISTINCT', 'DELETE', 'DROP', 'DEFAULT','ENCLOSED', 'ENGINE','ESCAPED', 'EXISTS', 'EXPLAIN','FIELDS', 'FIELD', 'FLUSH', 'FOR', 'FOREIGN', 'FUNCTION', 'FROM','GROUP', 'GRANT','HAVING','IGNORE', 'INDEX', 'INFILE', 'INSERT', 'INNER', 'INTO', 'IDENTIFIED','JOIN','KEYS', 'KILL','KEY','LEADING', 'LIKE', 'LIMIT', 'LINES', 'LOAD', 'LOCAL', 'LOCK', 'LOW_PRIORITY', 'LEFT', 'LANGUAGE', 'MEDIUMINT', 'MODIFY','MyISAM','NATURAL', 'NOT', 'NULL', 'NEXTVAL','OPTIMIZE', 'OPTION', 'OPTIONALLY', 'ORDER', 'OUTFILE', 'OR', 'OUTER', 'ON','PROCEEDURE','PROCEDURAL', 'PRIMARY','READ', 'REFERENCES', 'REGEXP', 'RENAME', 'REPLACE', 'RETURN', 'REVOKE', 'RLIKE', 'RIGHT','SHOW', 'SONAME', 'STATUS', 'STRAIGHT_JOIN', 'SELECT', 'SETVAL', 'TABLES', 'TEMINATED', 'TO', 'TRAILING','TRUNCATE', 'TABLE', 'TEMPORARY', 'TRIGGER', 'TRUSTED','UNIQUE', 'UNLOCK', 'USE', 'USING', 'UPDATE', 'UNSIGNED','VALUES', 'VARIABLES', 'VIEW','WITH', 'WRITE', 'WHERE','ZEROFILL','XOR','ALL', 'ASC', 'AS','SET','IN', 'IS', 'IF');
$mysql_doc=Array("Feldtypen" => "http://dev.mysql.com/doc/mysql/de/Column_types.html");

$mysql_SQLhasRecords=array('SELECT','SHOW','EXPLAIN');


function MSD_mysql_connect($encoding='utf8')
{
	global $config,$databases;

	$port=(isset($config['dbport']) && !empty($config['dbport'])) ? ':'.$config['dbport'] : '';
	$socket=(isset($config['dbsocket']) && !empty($config['dbsocket'])) ? ':'.$config['dbsocket'] : '';
	$config['dbconnection'] = mysql_connect($config['dbhost'].$port.$socket,$config['dbuser'],$config['dbpass']) or die(SQLError("Database connection error: ",mysql_error()));
	if(!defined('MSD_MYSQL_VERSION')) GetMySQLVersion();
	mysql_query('SET NAMES '.$encoding,$config['dbconnection']);
	return $config['dbconnection'];
}

function GetMySQLVersion()
{
	$res=MSD_query("select version()");
	$row = mysql_fetch_array($res);
	$version=$row[0];
	$new=(substr($version,0,3)>=4.1);
	if(!defined('MSD_MYSQL_VERSION')) define('MSD_MYSQL_VERSION', $version);
	if(!defined('MSD_NEW_VERSION')) define('MSD_NEW_VERSION',$new);
	return $version;
}

function MSD_query($query)
{
	global $config;
	if(!isset($config['dbconnection']))  MSD_mysql_connect();
	return @mysql_query($query, $config['dbconnection']);

}

function MSD_mysql_error()
{
	global $config,$databases;

}

function SQLError($sql,$error)
{
	global $lang,$mysql_errorhelp_ref,$config;
	echo '<div align="center"><table style="border:1px solid #ff0000" cellspacing="0">
<tr bgcolor="#ff0000"><td style="color:white;font-size:16px;"><strong>MySQL-ERROR</strong>&nbsp;&nbsp;<a href="'.$mysql_errorhelp_ref.'" target="_blank">
<img src="'.$config['files']['iconpath'].'help16.gif" alt="'.$lang['MySQLErrorDoc'].'" title="'.$lang['MySQLErrorDoc'].'" width="16" height="16" border="0"></a></td></tr>
<tr><td style="width:80%;overflow: auto;">'.$lang['sql_error1'].'<br><br>'.Highlight_SQL($sql).'</td></tr>
<tr><td width="600">'.$lang['sql_error2'].'<br><br><span style="color:red;">'.$error.'</span></td></tr>
</table>
</div>';

}

function Highlight_SQL($sql)
{
	global $sql_keywords;

	$end="";
	$tickstart=false;
	$a=@token_get_all("<?$sql?>");
	foreach($a as $token) {
		if(!is_array($token)) {
			if($token=="`") $tickstart=!$tickstart;
			$end.=$token;
		} else {
			if($tickstart) $end.=$token[1]; else {
				switch(token_name($token[0])) {
					case "T_STRING":
					case "T_AS":
					case "T_FOR":

						$end.=(in_array(strtoupper($token[1]),$sql_keywords)) ? "<span style=\"color:#990099;font-weight:bold;\">".$token[1]."</span>": $token[1];
						break;
					case "T_IF":
					case "T_LOGICAL_AND":
					case "T_LOGICAL_OR":
					case "T_LOGICAL_XOR":
						$end.=(in_array(strtoupper($token[1]),$sql_keywords)) ? "<span style=\"color:#0000ff;font-weight:bold;\">".$token[1]."</span>": $token[1];
						break;
					case "T_CLOSE_TAG":
					case "T_OPEN_TAG":
						break;
					default:
						$end.=$token[1];
				}
			}
		}
	}
	$end=preg_replace("/`(.*?)`/si", "<span style=\"color:red;\">`$1`</span>", $end);
	return $end;
}

function Fieldlist($db,$tbl)
{
	$fl='';
	$res=MSD_query("SHOW FIELDS FROM `$db`.`$tbl`;");
	if($res) {
		$fl='(';
		for($i=0;$i<mysql_num_rows($res);$i++) {
			$row=mysql_fetch_row($res);
			$fl.='`'.$row[0].'`,';
		}
		$fl=substr($fl,0,strlen($fl)-1).')';
	}
	return $fl;
}
?>
