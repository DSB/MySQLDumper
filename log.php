<?php
include("inc/header.php");
echo headline();

if(isset($_POST["r"])){
	$r=$_POST["r"];
} else {
	$r=(isset($_GET["r"])) ? $_GET["r"] :0;
}


//löschen
if(isset($_POST["kill"])) {
	if($_POST["r"]==0 ) {
		DeleteLog();
	} elseif ($_POST["r"]==1 ) {
		@unlink($config["files"]["perllog"]);
	} elseif ($_POST["r"]==2 ) {
		@unlink($config["files"]["perllogcomplete"]);
	} elseif ($_POST["r"]==3 ) {
		@unlink($config["paths"]["log"]."error.log");
	}
	$r=0;
}

if($r==0) {
	$lfile=$config["files"]["log"];
	$lcap="PHP-Log";
	if(!file_exists($config["files"]["log"])){DeleteLog();}
	
} elseif ($r==1) {
	$lfile=$config["files"]["perllog"];
	$lcap="Perl-Log";
} elseif ($r==2) {
	$lfile=$config["files"]["perllogcomplete"];
	$lcap="Perl Complete Log";
} elseif ($r==3) {
	$lfile=$config["paths"]["log"]."error.log";
 	$lcap="PHP Error-Log";
}


echo "<h3>$lcap</h3>";

if(!is_writable($config["paths"]["log"])) die('<span class="warnung"><strong>ERROR !</strong><br>Logdir is not writable</span>');


//lesen
$td='<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">'; 
$errorbutton=$td.'<input type="Button" class="Menubutton" value="Error-Log" onclick="document.location.href=\'log.php?r=3\'"'.((!file_exists($config["paths"]["log"]."error.log")) ? ' disabled' : "").'></td>';
$perlbutton= $td.'<input type="Button" class="Menubutton" value="Perl-Log" onclick="document.location.href=\'log.php?r=1\'"'.((!file_exists($config["files"]["perllog"])) ? ' disabled' : "").'></td>';
$perlbutton2=$td.'<input type="Button" class="Menubutton" value="Perl-Log Complete" onclick="document.location.href=\'log.php?r=2\'" '.((!file_exists($config["files"]["perllogcomplete"])) ?  ' disabled' : "").'></td>' ;
//anzeigen
echo '<div align="center"><form action="log.php" method="post"><table border="1"><tr>';
echo $td.'<input type="Button" class="Menubutton" value="PHP-Log" onclick="document.location.href=\'log.php?r=0\'"></td>';
echo $errorbutton.$perlbutton.$perlbutton2;
echo $td.'<input type="hidden" name="r" value="'.$r.'"><input class="Menubutton" type="submit" name="kill" value="'.$lang["log_delete"].'">';
echo '</td></tr></table></form></div><br>';


if($r<2) {
	echo '<pre>';
	$zeilen = file($lfile );
	$zeilen=array_reverse($zeilen);
	foreach($zeilen as $zeile) echo $zeile;
	echo '</pre>';
} elseif ($r==2) {
	echo '<iframe width="100%" height="80%" src="'.$config["files"]["perllogcomplete"].'"></iframe>';
} elseif ($r==3) {
	echo '<pre>';
	$zeilen = file($lfile );
	foreach($zeilen as $zeile) echo $zeile;
	echo '</pre>';
}


include("inc/footer.php");
?>
 
