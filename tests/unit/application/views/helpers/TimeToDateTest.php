<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'TimeToDate.php';

/**
 * @group MsdViewHelper
 */
class TimeToDateTest extends PHPUnit_Framework_TestCase
{
    public function testTimeToDate()
    {
        $expected='27.08.2010 00:49:48';
        $viewHelper = new Msd_View_Helper_TimeToDate();
        $res = $viewHelper->timeToDate('2010-08-27T00:49:48+02:00');
        $this->assertEquals($expected, $res);
    }

    public function testInvalidTimeToDate()
    {
        $viewHelper = new Msd_View_Helper_TimeToDate();
        $res = $viewHelper->timeToDate('an invalid date timestamp');
        $this->assertEquals(
            'No date part in \'an invalid date timestamp\' found.', $res
        );
    }
}

