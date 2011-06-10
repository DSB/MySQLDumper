<?php
class Testhelper
{
    /**
     * Prepare tests
     */
    public static function setUp()
    {
        Testhelper::copyFile(
            'users.ini', APPLICATION_PATH . DS . 'configs' . DS .'users.ini'
        );
    }

    /**
     * Copy a fixture to destination
     *
     * @param string $source      Filename of source in fixture folder
     * @param string $destination Filename of destination
     * @throws Exception
     * @return void
     */
    public static function copyFile($source, $destination)
    {
        $fixturePath = realpath(dirname(__FILE__) . DS . 'fixtures');
        $source = realpath($fixturePath . DS . $source);
        // delete target file if it exists
        if (file_exists($destination)) {
            if (!unlink($destination)) {
                throw new Exception(
                    'Error: Couldn\'t delete file "' . $destination .'"!'
                );
            }
        }
        if (!copy($source, $destination)) {
            throw new Exception(
                'Error: Couldn\'t copy file "' . $source . '" to "'
                . $destination .'"!'
            );
        };
        chmod($destination, 0755);
    }

    /**
     * Remove a file
     *
     * @throws Exception
     * @param string $file File to remove
     * @return void
     */
    public function removeFile($file)
    {
        if (!file_exists($file)) {
            return;
        }
        if (!unlink($file)) {
            throw new Exception(
                'Error: Couldn\'t remove file "' . $file .'"'
            );
        }
    }
}
