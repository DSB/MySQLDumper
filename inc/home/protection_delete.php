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
@unlink($config['paths']['root'] . '.htaccess');
@unlink($config['paths']['root'] . '.htpasswd');
$action = 'status';

//TODO -> give user info about success or failure of deleting action