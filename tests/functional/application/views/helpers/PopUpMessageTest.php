<?php
/**
 * @group MsdViewHelper
 */
class PopUpMessageTest extends ControllerTestCase
{
    public function testcanAddPopUpMessage()
    {
        // force popUp by log in with wrong credentials
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

}

