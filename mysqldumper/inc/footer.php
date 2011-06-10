<?php
$config_array=(isset($config)) ? "<strong>CONFIG</strong><pre>".@print_r($config,true)."</pre>": "";
$database_array=(isset($database)) ? "<strong>DATABASE</strong><pre>".@print_r($database,true)."</pre>": "";
$dump_array=(isset($dump)) ? "<strong>DUMP</strong><pre>".@print_r($dump,true)."</pre>": "";
$restore_array=(isset($restore)) ? "<strong>RESTORE</strong><pre>".@print_r($restore,true)."</pre>" : "";

echo '<p align="center" class="small">'.$lang['authors'].':&nbsp;
<a class="small" href="http://www.daniel-schlichtholz.de" target="_blank">
Daniel Schlichtholz & Steffen Kamper</a> - Infoboard: 
<a class="small" href="'.$config['homepage'].'" target="_blank">'.
$config['homepage'].'</a></p>';

echo '</div></body></html>';

?>
