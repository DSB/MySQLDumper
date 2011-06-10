<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Menu.php';

/**
 * @group MsdViewHelper
 */
class MenuTest extends ControllerTestCase
{
    public function testWontRenderMenuAtLoginAction()
    {
        $this->dispatch('/index/login');
        $this->assertQueryCount('form', 1);
        $this->assertQueryCount('#user', 1);
        $this->assertQueryCount('#pass', 1);
        $this->assertQueryCount('#autologin', 1);
        $this->assertQueryCount('#send', 1);
    }

    public function testCanRenderMenuWithInvalidActualDatabase()
    {
        $this->loginUser();
        $config = Msd_Configuration::getInstance();
        $config->set('dynamic.dbActual', -1);
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

    public function testCanFallbackToDefaultDbIfActualDbIsInvalid()
    {
        $this->loginUser();
        $config = Msd_Configuration::getInstance();
        $config->set('dynamic.dbActual', 'i_dont_exist');
        $config->set('config.dbuser.defaultDb', 'information_schema');
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

    public function testCanFallbackToFirstDbIfActualAndDefaultDbsAreInvalid()
    {
        $this->loginUser();
        $config = Msd_Configuration::getInstance();
        $config->set('dynamic.dbActual', 'i_dont_exist');
        $config->set('config.dbuser.defaultDb', 'I_dont_exist');
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

}

