<?php
/**
 * @group Error
 */
class Msd_Application_Controller_InstallControllerTest
    extends ControllerTestCase
{
    public function testCanDispatchInstallPage()
    {
        $_GET['language'] = 'de';
        $this->dispatch('/install/index');
        $this->assertQueryContentContains('h3', 'Schritt 1: Sprache wählen (de)');
        $this->assertQueryCount('input[@id="lang-de"]', 1);
    }
}