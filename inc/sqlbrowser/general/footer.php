<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @version         SVN: $rev: 1205 $
 * @author          $Author$
 * @lastmodified    $Date$
 */
if (!defined('MSD_VERSION')) die('No direct access.');

$tplSqlbrowserGeneralFooter = new MSDTemplate();
$tplSqlbrowserGeneralFooter->set_filenames(
    array(
        'tplSqlbrowserGeneralFooter' => 'tpl/sqlbrowser/general/footer.tpl')
);
