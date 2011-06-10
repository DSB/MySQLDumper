<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once('GetConfigTitle.php');

/**
 * @group MsdViewHelper
 */
class GetConfigTitleTest extends PHPUnit_Framework_TestCase
{
    public function testCanReadConfigTitleFromConfigFile()
    {
        $expected='MySQLDumper';
        $viewHelper = new Msd_View_Helper_GetConfigTitle();
        $res = $viewHelper->getConfigTitle('mysqldumper');
        $this->assertEquals(true, is_string($res));
        $this->assertEquals($expected, $res);
    }

    public function testWillThrowExceptionOnInvalidConfigFile()
    {
        $viewHelper = new Msd_View_Helper_GetConfigTitle();
        try {
            $viewHelper->getConfigTitle('i_dont_exist');
        } catch (Msd_Exception $e) {
            $this->assertInstanceof('Msd_Exception', $e);
            $expected = 'Couldn\'t read configuration file';
            $this->assertEquals($expected, substr($e->getMessage(), 0, 32));
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

}

