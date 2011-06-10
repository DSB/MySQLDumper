<?php
include("inc/header.php");
if(!file_exists($log_file)){DeleteLog();}

echo "<h3>Log</h3>";

//löschen
if(isset($_POST["kill"])) {DeleteLog();}

//anzeigen
echo '<div align="center"><form action="log.php" method="post"><table border="1"><tr>';
echo '<td class="tableheads_off" onmouseover="this.className=\'tableheads_on\'" onmouseout="this.className=\'tableheads_off\'" align="center">';
echo '<input class="Menubutton" type="submit" name="kill" value="'.$l["log_delete"].'">';
echo '</td></tr></table></form></div><br><pre>';
include($log_file);
echo '</pre>';

include("inc/footer.php");
?>
 
