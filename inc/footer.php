<?php
if (!defined('MSD_VERSION')) die('No direct access.');
echo '<p align="center" class="footer">
    ' . $lang['authors'] . ': <a href="http://www.mysqldumper.de" target="_blank">Daniel Schlichtholz &amp; Steffen Kamper</a> | Infoboard: 
<a href="' . $config['homepage'] . '" target="_blank">' . $config['homepage'] . '</a></p>';
echo '</div></body></html>';
