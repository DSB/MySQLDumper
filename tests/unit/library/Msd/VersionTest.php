<?php
/**
 * @group configuration
 */
class Msd_VersionTest extends PHPUnit_Framework_TestCase
{
    public $version = null;

    public function setUp()
    {
        $this->version = new Msd_Version();
        $options = array(
                        'requiredPhpVersion'   => '99.99.99',
                        'requiredMysqlVersion' => '99.99.99'
                   );
        $this->oldVersion = new Msd_Version($options);
    }

    public function testCanGetRequiredPhpVersion()
    {
        $this->assertEquals('5.2.0', $this->version->getRequiredPhpVersion());
    }

    public function testCanDetectOldPhpVersion()
    {
        $this->assertEquals(false, $this->oldVersion->checkPhpVersion());
    }

    public function testCanGetRequiredMysqlVersion()
    {
        $this->assertEquals('4.1.2', $this->version->getRequiredMysqlVersion());
    }

    public function testCanDetectOldMysqlVersion()
    {
        $this->assertEquals(false, $this->oldVersion->checkMysqlVersion());
    }
}