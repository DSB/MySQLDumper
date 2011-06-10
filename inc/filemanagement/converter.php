<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
if (!defined('MSD_VERSION')) die('No direct access.');
@ini_set('max_execution_time', 0);

// first output menu to show it while converting.
// Otherwise it would only be shwon after the conversion is finished
include ('./inc/menu.php');
$tplGlobalHeader->pparse('tplGlobalHeader');
$tplMenu->pparse('tplMenu');

// Konverter
$selectfile = (isset($_POST['selectfile'])) ? $_POST['selectfile'] : '';
$destfile = (isset($_POST['destfile'])) ? $_POST['destfile'] : '';
$compressed = (isset($_POST['compressed'])) ? $_POST['compressed'] : '';
include ('./inc/define_icons.php');
$doConversion = false;
if ($selectfile != '' & file_exists($config['paths']['backup'] . $selectfile)
    && strlen($destfile) > 2) {
    $doConversion = true;
}

$tpl = new MSDTemplate();
$tpl->set_filenames(array('show' => 'tpl/filemanagement/converter.tpl'));

$tpl->assign_vars(
    array(
        'SELECTBOX_FILE_LIST' => getFilelisteCombo($selectfile),
        'NEW_FILE' => Html::replaceQuotes($destfile),
        'NEW_FILE_COMPRESED' => $compressed == 1 ? ' checked="checked"' : '',
        'ICON_GZ' => $icon['gz']
    )
);

if ($doConversion) {
    $tpl->assign_block_vars('AUTOSCROLL', array());
}

$tpl->pparse('show');
flush();
if (isset($_POST['startconvert'])) {
    echo $lang['L_CONVERTING'] . '  ' . $selectfile
        . ' ==&gt; ' . $destfile . '.sql';
    if ($compressed == 1) {
        echo '.gz';
    }
    if ($doConversion) {
        convert($selectfile, $destfile, $compressed);
    } else {
        echo '<br /><p class="error">' . $lang['L_CONVERT_WRONG_PARAMETERS']
            . '</p>';
    }
}

if ($doConversion) {
    ?>
<script type="text/javascript">
        /*<![CDATA[*/
        setTimeout('clearTimeout(scrolldelay)',2000);
        /*]]>*/
    </script>
    <?php
}
?>
</div>
</body>
</html>
<?php
die(); // menu is shown - nothing more to do;
