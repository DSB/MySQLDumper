<?php
/**
 * @group login
 */
class Msd_UserTest extends ControllerTestCase
{
    public function testCanLoginUserByCookie()
    {
        $_COOKIE['msd_autologin'] =
            'ZC5UZ1xNHTfnaQN2FqIOCuA--:1ef26361573f7032cebe97cec16f0bd0';
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $request->setParam('msd_autologin', $_COOKIE['msd_autologin']);

        $user = new Msd_User();
        $this->assertTrue($user->isLoggedIn());
        // make sure auth session is set after log in
        $this->assertEquals(
            'tester',
            $_SESSION['Zend_Auth']['storage']['name']
        );
    }

    public function testCanDetectInvalidLoginCookie()
    {
        $_COOKIE['msd_autologin'] =
            'C5UZ1xNHTfnaQN2FqIOCuA--:1ef26361573f7032cebe97cec16f0bd0';
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $request->setParam('msd_autologin', $_COOKIE['msd_autologin']);

        $user = new Msd_User();
        $this->assertFalse($user->isLoggedIn());
    }

    public function testCanDetectNonExistantUsersFile()
    {
        Testhelper::removeFile(
            APPLICATION_PATH . DS . 'configs' . DS . 'users.ini'
        );
        $user = new Msd_User();
        $loginResult = $user->login('tester', 'test');
        $this->assertEquals(Msd_User::NO_USER_FILE, $loginResult);
        Testhelper::copyFile(
            'users.ini', APPLICATION_PATH . DS . 'configs' . DS .'users.ini');
    }

    public function testCanDetectEmptyUsersFile()
    {
        // overwrite users.ini with en empty file
        Testhelper::copyFile('usersEmpty.ini',
            APPLICATION_PATH . DS . 'configs' . DS .'users.ini');
        $user = new Msd_User();
        $loginResult = $user->login('tester', 'test');
        $this->assertEquals(Msd_User::NO_VALID_USER, $loginResult);
        // restore users.ini file
        Testhelper::copyFile(
            'users.ini', APPLICATION_PATH . DS . 'configs' . DS .'users.ini');
    }
}