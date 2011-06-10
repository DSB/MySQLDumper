<?php
/**
 * @group Files
 */
class Msd_FileTest extends PHPUnit_Framework_TestCase
{
    public function testCanGetChmodValueOfFile()
    {
        $valid = array('0644', '664', '666', '0755', '0777');
        $res = Msd_File::getChmod(CONFIG_PATH . '/mysqldumper.ini');
        $this->assertTrue(in_array($res, $valid));
    }

    public function testCanGetConfigurationNames()
    {
        $configNames = Msd_File::getConfigNames();
        $this->assertNotEmpty($configNames);
        $this->assertTrue(in_array('mysqldumper', $configNames));
    }

    public function testRetrunsEmptyArrayIfPathIsNotReadable()
    {
        $config = Msd_Configuration::getInstance();
        $oldPath = $config->get('paths.config');
        $config->set('paths.config', '/I/Dont/Exist');
        $configNames = Msd_File::getConfigNames();
        $config->set('paths.config', $oldPath);
        $this->assertTrue(is_array($configNames));
        $this->assertEmpty($configNames);
    }

}