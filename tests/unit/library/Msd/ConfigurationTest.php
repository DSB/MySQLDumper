<?php
/**
 * @group configuration
 */
class Msd_ConfigurationTest extends ControllerTestCase
{

    public static function setUpBeforeClass()
    {
        Testhelper::copyFile('mysqldumper.ini', CONFIG_PATH . DS .'mysqldumper.ini');
        Testhelper::copyFile('mysqldumper2.ini', CONFIG_PATH . DS .'mysqldumper2.ini');
    }

    public static function tearDownAfterClass()
    {
        Testhelper::removeFile(CONFIG_PATH . DS . 'mysqldumper2.ini');
    }

    public function setUp()
    {
        $this->loginUser();
    }

    public function testThrowsExceptionOnCloning()
    {
        $config = Msd_Configuration::getInstance();
        try {
            clone($config);
        } catch (Exception $e) {
            $this->assertInstanceof('Msd_Exception', $e);
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testCanSetValues()
    {
        $config = Msd_Configuration::getInstance();
        $config->set('config.testval', 999);
        $this->assertEquals(999, $config->get('config.testval'));
        $config->set('config.interface.testval2', 999);
        $this->assertEquals(999, $config->get('config.interface.testval2'));
    }

    /**
     * @expectedException Msd_Exception
     */
    public function testCanThrowExceptionOnSettingIllegalValue()
    {
        $config = Msd_Configuration::getInstance();
        $config->set('config.t.r.t.v', 999);
    }

    public function testCanReloadConfig()
    {
        $config = Msd_Configuration::getInstance();
        $config->set('config.general.dbDelete', 'y'); //defaults to 'n'
        $this->assertEquals('y', $config->get('config.general.dbDelete'));
        $config->reloadConfig();
        $this->assertEquals('n', $config->get('config.general.dbDelete'));
    }

    public function testCanGetValuesFromConfiguration()
    {
        $config = Msd_Configuration::getInstance();
        // get complete config-array
        $values = $config->get('config');
        $this->assertArrayHasKey('interface', $values);
        $this->assertArrayHasKey('dbuser', $values);
        $this->assertArrayHasKey('cronscript', $values);
        $this->assertArrayHasKey('cronscript', $values);
        $this->assertArrayHasKey('ftp', $values);
        $this->assertArrayHasKey('email', $values);
        $this->assertArrayHasKey('autodelete', $values);
        $this->assertArrayHasKey('general', $values);

        //check some nested keys in different levels
        $values = $config->get('config.general');
        $this->assertArrayHasKey('mode', $values);
        $this->assertArrayHasKey('title', $values);
        $this->assertArrayHasKey('optimize', $values);

        $value = $config->get('config.general.dbDelete');
        $this->assertEquals('n', $value);

        $values = $config->get('config.ftp.0');
        $this->assertArrayHasKey('use', $values);
        $this->assertArrayHasKey('server', $values);
        $this->assertArrayHasKey('user', $values);

        $value = $config->get('config.ftp.0.timeout');
        $this->assertEquals(10, $value);
    }

    public function testCanReturnNullOnNonExistantConfigKey()
    {
        $config = Msd_Configuration::getInstance();
        $value = $config->get('config.IDont.Exist');
        $this->assertEquals(null, $value);
    }

    public function testCanThrowExceptionOnSettingIncorrectValue()
    {
        $config = Msd_Configuration::getInstance();
        try {
            $config->set('testval', 999);
        } catch (Exception $e) {
            $this->assertInstanceof('Msd_Exception', $e);
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testCanThrowExceptionOnGettingIncorrectValue()
    {
        $config = Msd_Configuration::getInstance();
        try {
            $config->get('testval', 999);
        } catch (Exception $e) {
            $this->assertInstanceof('Msd_Exception', $e);
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testCanLoadConfigFromSessionOnSameRequest()
    {
        $config = Msd_Configuration::getInstance();
        $config->set('config.testval', 888);
        $config->saveConfigToSession();
        unset($config);

        $config = Msd_Configuration::getInstance();
        $config->loadConfigFromSession();
        $this->assertEquals(888, $config->get('config.testval'));

        // test constructor; should get filename and data from session
        Msd_Configuration::getInstance();
    }

    public function testCanLoadConfiguration()
    {
        $config = Msd_Configuration::getInstance('mysqldumper', true);
        $this->assertEquals('mysqldumper', $config->get('dynamic.configFile'));
        // load another configuration and set values to actual session
        $config->loadConfiguration('mysqldumper2', true);
        $this->assertEquals('mysqldumper2', $config->get('dynamic.configFile'));
    }

    public function testCanLoadConfigWithoutApplying()
    {
        $config = Msd_Configuration::getInstance('mysqldumper', true);
        $this->assertEquals('mysqldumper', $config->get('dynamic.configFile'));
        // load data from another config file but without using it
        $configData = $config->loadConfiguration('mysqldumper2', false);
        $this->assertInstanceOf('Zend_Config_Ini', $configData);
        $this->assertEquals(
            'MySQLDumper2',
            $configData->general->title
        );
        $this->assertEquals(
            'pl',
            $configData->cronscript->perlExtension
        );
        // make sure the actual config didn't change
        $this->assertEquals('mysqldumper', $config->get('dynamic.configFile'));
    }

    public function testThrowsExceptionOnLoadNonExistantConfigfile()
    {
        $config = Msd_Configuration::getInstance();
        try {
            $config->loadConfiguration('IDontExist');
        } catch (Exception $e) {
            $this->assertInstanceof('Msd_Exception', $e);
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testCanGetConfigTitle()
    {
        $config = Msd_Configuration::getInstance();
        $config->loadConfiguration('mysqldumper');
        $title = $config->getTitle();
        $this->assertEquals('MySQLDumper', $title);

        $config->loadConfiguration('mysqldumper2');
        $title = $config->getTitle();
        $this->assertEquals('MySQLDumper2', $title);
    }

    /**
     * @depends testCanLoadConfiguration
     */
    public function testCanSaveConfiguration()
    {
        $config = Msd_Configuration::getInstance();
        $config->loadConfiguration('mysqldumper2');
        // change a value
        $config->set('config.cronscript.Path', 'IAmAPath');
        $config->save('mysqldumper2');
        // reload it and check changed val
        $config->loadConfiguration('mysqldumper2');
        $this->assertEquals('IAmAPath', $config->get('config.cronscript.Path'));
        // change val again
        $config->set('config.cronscript.Path', 'IDiffer');
        // now save without giving the filename; should be taken from session
        $config->save();
        // reload it and again check changed val
        $config->loadConfiguration('mysqldumper2');
        $this->assertEquals('IDiffer', $config->get('config.cronscript.Path'));
        // reset val for further tests
        $config->set('config.cronscript.Path', '');
        $config->save();
    }

    /**
     * @depends testCanSaveConfiguration
     */
    public function testCanSaveConfigFromArray()
    {
        $config = Msd_Configuration::getInstance();
        $config->loadConfiguration('mysqldumper2');
        // change title and save as new file
        $config->set('config.general.title', 'MySQLDumper3');
        $configData =$config->get('config');
        $this->assertTrue(is_array($configData));
        $config->save('mysqldumper3', $configData);
        $configFile = $config->get('paths.config').'/mysqldumper3.ini';
        $this->assertFileExists($configFile);
        $config->loadConfiguration('mysqldumper3');
        $title = $config->get('config.general.title');
        $this->assertEquals('MySQLDumper3', $title);
        Testhelper::removeFile(CONFIG_PATH . DS . 'mysqldumper3.ini');
    }
}