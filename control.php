<?php
include_once("inc/functions.php");
$h='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>MySQLDumper</title><link rel="stylesheet" type="text/css" href="styles.css"></head><body class="control">';
?>
<script language="JavaScript">
function SwitchDiv(d)
{

}
</script>
<?php
$t='Hallo Service !&nbsp;&nbsp;&nbsp;<a href="control.php?showpars=1">pars</a>&nbsp;&nbsp;&nbsp;<a href="control.php?showvars=1">vars</a>&nbsp;&nbsp;&nbsp;';
$f='</body></html>';

echo $h.$t;
echo '<div id="aus" style="display:none">&nbsp;</div>';
if(isset($_GET["showpars"])) {
	$au=file(Realpath("./")."/work/config/parameter.php");
	$sp='<br><strong>Parameter</strong><pre>'.print_r($au,true).'</pre>';
	echo '<script language="JavaScript">getElementById("aus").innerHTML=\''.$sp.'\';</script>';
}
echo $f;

?>
