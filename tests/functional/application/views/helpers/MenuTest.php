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
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        $dynamicConfig->setParam('dbActual', -1);
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

    public function testCanFallbackToDefaultDbIfActualDbIsInvalid()
    {
        $this->loginUser();
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        $dynamicConfig->setParam('dbActual', 'i_dont_exist');
        $config = Msd_Registry::getConfig();
        $config->set('dbuser.defaultDb', 'information_schema');
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

    public function testCanFallbackToFirstDbIfActualAndDefaultDbsAreInvalid()
    {
        $this->loginUser();
        $dynamicConfig = Msd_Registry::getDynamicConfig();
        $dynamicConfig->setParam('dbActual', 'i_dont_exist');
        $config = Msd_Registry::getConfig();
        $config->setParam('dbuser.defaultDb', 'I_dont_exist');
        $this->dispatch('/');
        $this->assertQueryContentContains('#selectedDb', 'information_schema');
    }

}

