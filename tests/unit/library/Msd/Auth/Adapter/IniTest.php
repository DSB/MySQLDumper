<?php
/**
 * @group Auth
 */
class Msd_Auth_Adapter_IniTest extends PHPUnit_Framework_TestCase
{
    public $iniPath = null;
    public $userIni = null;

    public function setUp()
    {
        $this->iniPath = APPLICATION_PATH . DS .'configs';
        $this->userIni = $this->iniPath . DS . 'users.ini';
    }

    public function testThrowsExceptionIfInvokedWithNonExistantIniFile()
    {
        try {
            new Msd_Auth_Adapter_Ini(
                $this->iniPath . '/I_dont_exist.ini'
            );
        } catch (Msd_Exception $e) {
            $res = 'INI file with authentication information doesn\'t exists!';
            $this->assertEquals($res, $e->getMessage());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testThrowsExceptionIfUsernameIsNull()
    {
        $authAdapter = new Msd_Auth_Adapter_Ini($this->userIni);
        $authAdapter->setUsername(null);
        try {
            $authAdapter->authenticate();
        } catch (Msd_Exception $e) {
            $res = 'You must set the username and password first!';
            $this->assertEquals($res, $e->getMessage());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testCanFailAuthIfCredentialsAreWrong()
    {
        $authAdapter = new Msd_Auth_Adapter_Ini($this->userIni);
        $authAdapter->setUsername('iDontExist');
        $authAdapter->setPassword('iAmWrong');
        $authResult = $authAdapter->authenticate();
        $res = $authResult->getCode();
        $this->assertEquals($res, Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID);
    }
}