<?php
/**
 * @group Index
 */
class Msd_Application_Controller_IndexControllerTest
    extends ControllerTestCase
{
    public static function setUpBeforeClass()
    {
        Testhelper::copyFile('mysqldumper2.ini', CONFIG_PATH . DS .'mysqldumper2.ini');
    }

    public static function tearDownAfterClass()
    {
        Testhelper::removeFile(CONFIG_PATH . DS . 'mysqldumper2.ini');
    }

    public function testRedirectsToLoginFormIfUserNotLoggedIn()
    {
        $this->dispatch('/index/phpinfo');
        //we should be redirected to the log in page
        $this->assertResponseCode('302');
        $this->assertRedirectTo('/index/login');
    }

    public function testCanLoginUser()
    {
        $this->loginUser();
        $this->dispatch('/');
        //make sure we are not redirected to the log in page
        $this->assertNotRedirect();

        // make sure we are on the home page now
        $this->assertQueryContentContains('h2', 'Home');
        // we should have one div with id username
        $this->assertQueryCount('#username', 1);
        // which contains the username
        $this->assertQueryContentContains('#username > p', 'tester');

        // now lets check if we can access a page without being redirected
        // to the log in page
        $this->clearRequest();
        $this->dispatch('/index/phpinfo');
        $this->assertNotRedirect();
        $this->assertQueryCount('#phpinfo', 1);
    }

    public function testWontLoginUserWithWrongCredentials()
    {
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'user' => 'tester',
                        'pass' => 'wrongPassword',
                        'autologin' => 0
                  )
              );
        $this->dispatch('/index/login');
        $this->assertNotRedirect();
        // make sure we see the login error message
        $this->assertQueryCount("//div[@id='login-message']", 1);
        $msg = "Diese Kombination von Benutzername und Passwort ist unbekannt.";
        $this->assertQueryContentContains('#login-message', $msg);
    }

    public function testCanRedirectToInstallIfUserFileIsBroken()
    {
        $path= APPLICATION_PATH . '/configs/';
        rename($path.'users.ini', $path.'users.bak');
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'user' => 'tester',
                        'pass' => 'test',
                        'autologin' => 0
                  )
              );
        $this->dispatch('/index/login');
        $this->assertResponseCode('302');
        rename($path.'users.bak', $path.'users.ini');
        $this->assertRedirect();
        $this->assertRedirectTo('/install');
    }

    /**
     * @depends testCanLoginUser
     */
    public function testCanLogoutUser()
    {
        $_COOKIE['msd_autologin'] =
            'ZC5UZ1xNHTfnaQN2FqIOCuA--:1ef26361573f7032cebe97cec16f0bd0';
        $this->dispatch('/index/logout');
        // now we should be redirected to login page
        $this->assertRedirectTo('/index/login');
        $this->assertResponseCode('302');
        $this->assertRedirect();
    }

    public function testCanAutoLoginUserByCookie()
    {
        $_COOKIE['msd_autologin'] =
            'ZC5UZ1xNHTfnaQN2FqIOCuA--:1ef26361573f7032cebe97cec16f0bd0';
        $this->dispatch('/index/phpinfo');
        $this->assertNotRedirect();
        // dom id #phpinfo is only shown on phpinfo page, so let's look for it
        $this->assertQueryCount('#phpinfo', 1);
    }

    /**
     * @outputBuffering enabled
     */
    public function testCanLoginWithAutoLogin()
    {
        $this->dispatch('/index/logout');
        $this->clearRequest();

        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'user' => 'tester',
                        'pass' => 'test',
                        'autologin' => 1
                  )
              );
        $this->dispatch('/index/login');
        // after successful login we should be redirected to the index page
        $this->assertResponseCode('302');
        $this->assertRedirectTo('/');
        $this->clearRequest();
    }

    public function testCanShowIndex()
    {
        $this->loginUser();
        $this->dispatch('/');
        $this->assertNotRedirect();
        // we are there if button PHP-Info is shown
        $this->assertQueryContentContains('#content', 'PHP-Info');
    }

    public function testCanShowPhpinfo()
    {
        $this->loginUser();
        $this->dispatch('/index/phpinfo');
        $this->assertNotRedirect();
        // dom id #phpinfo is only shown on phpinfo page, so let's look for it
        $this->assertQueryCount('#phpinfo', 1);
    }

    public function testCanRefreshDbListAndRedirectsToOldAction()
    {
        $this->loginUser();
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'lastAction' => 'phpinfo',
                        'lastController' => 'index'
                    )
              );
        $this->dispatch('/index/dbrefresh');
        $this->assertRedirectTo('/index/phpinfo');
    }

    public function testCanRefreshDbListWithInvalidActiveDb()
    {
        $this->loginUser();
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'lastAction' => 'phpinfo',
                        'lastController' => 'index'
                    )
              );
        $config = Msd_Configuration::getInstance();
        $config->set('dynamic.dbActual', -1);
        $this->dispatch('/index/dbrefresh');
        $this->assertRedirectTo('/index/phpinfo');
    }

    public function testCanSelectDb()
    {
        $this->loginUser();
        $config = Msd_Configuration::getInstance();
        // set invalid active db
        $config->set('dynamic.dbActual', -1);
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'lastAction' => 'phpinfo',
                        'lastController' => 'index',
                        'selectedDb' => base64_encode('information_schema')
                    )
              );
        $this->dispatch('/index/selectdb');
        $this->assertRedirectTo('/index/phpinfo');
        // check if actual db was switched
        $this->assertEquals(
            'information_schema',
            $config->get('dynamic.dbActual')
        );
    }

    public function testCanToggleMenuStatus()
    {
        $this->dispatch('index/ajax.Toggle.Menu');
        $menu = new Zend_Session_Namespace('menu');
        $this->assertEquals(1, $menu->showMenu);
        $this->dispatch('index/ajax.Toggle.Menu');
        $this->assertEquals(0, $menu->showMenu);
    }

    public function testCanSwitchConfiguration()
    {
        $this->loginUser();
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'lastAction' => 'phpinfo',
                        'lastController' => 'index',
                        'selectedConfig' => base64_encode('mysqldumper')
                    )
              );
        $this->dispatch('/index/switchconfig');
        $config = Msd_Configuration::getInstance();
        $this->assertEquals('mysqldumper', $config->get('dynamic.configFile'));
        // are we still on the phpinfo page?
        $this->assertQueryCount('#phpinfo', 1);

        // now lets switch to another configuration
        $this->clearRequest();
        $this->getRequest()
              ->setMethod('POST')
              ->setParams(
                  array(
                        'lastAction' => 'phpinfo',
                        'lastController' => 'index',
                        'selectedConfig' => base64_encode('mysqldumper2')
                    )
              );
        $this->dispatch('/index/switchconfig');
        $config = Msd_Configuration::getInstance();
        $this->assertEquals('mysqldumper2', $config->get('dynamic.configFile'));
        // are we still on the phpinfo page?
        $this->assertQueryCount('#phpinfo', 1);
    }

    public function testCanLoadConfigFromSession()
    {
        $_SESSION = unserialize($this->loadFixtureFile('sessions/sessionTester.txt'));
        $reflection = new ReflectionClass('Msd_Configuration');
        $property = $reflection->getProperty('_instance');
        $property->setAccessible(true);
        $oldInstance = $property->getValue(null);
        $property->setValue(null, null);
        Msd_Configuration::getInstance();
        $property->setValue(null, $oldInstance);
        $this->loginUser();
        $this->assertTrue(true);
    }

}