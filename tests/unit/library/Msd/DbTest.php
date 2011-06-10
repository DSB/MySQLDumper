<?php
/**
 * @group database
 */
class Msd_DbTest extends ControllerTestCase
{
    public function setUp()
    {
        $this->loginUser();
    }

    public function testCanGetMysqliInstance()
    {
        $dbo = Msd_Db::getAdapter();
        $this->assertInstanceOf('Msd_Db_Mysqli', $dbo);
    }

    public function testCanGetMysqlInstance()
    {
        $dbo = Msd_Db::getAdapter(null, true);
        $this->assertInstanceOf('Msd_Db_Mysql', $dbo);
    }

    public function testThrowsExceptionOnInvalidQuery()
    {
        $dbo = Msd_Db::getAdapter();
        try {
            $dbo->query('I am not a valid query');
        } catch (Exception $e) {
            $this->assertInstanceOf('Msd_Exception', $e);
            $this->assertEquals(1064, $e->getCode());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}