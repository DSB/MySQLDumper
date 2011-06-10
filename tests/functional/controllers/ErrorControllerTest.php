<?php
/**
 * @group Error
 */
class Msd_Application_Controller_ErrorControllerTest
    extends ControllerTestCase
{
    public function testErrorControllerCatchesInvalidPageCalls()
    {
        $this->dispatch('/invalid/page');
        $this->assertResponseCode(404);
        $this->assertQueryContentContains('h2', 'Page not found');
        $this->assertQueryContentContains('#controller', 'invalid');
        $this->assertQueryContentContains('#action', 'page');
        $this->assertQueryContentContains('#module', 'default');
    }
}