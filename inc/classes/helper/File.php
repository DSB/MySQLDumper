<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Helper
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 * @lastmodified    $Date$
 */

/**
 * File-Helper Class
 *
 * Class offers some methods for file handling
 */
class File
{
    /**
     * Get CHMOD of a file
     *
     * @param string $file The file to get chmod for
     *
     * @return int
     */
    public static function getChmod($file)
    {
        clearstatcache();
        return @substr(decoct(fileperms($file)), -3);
    }

    /**
     * Detects if file or directory is writable and trys to chmod it.
     *
     * Returns if file or directory is writable after chmodding.
     *
     * @param string $path
     * @param string $chmod
     *
     * @return bool
     */
    public static function isWritable($path, $chmod)
    {
        if (!is_writable($path)) {
            @chmod($path, $chmod);
        }
        return is_writable($path);
    }

}
