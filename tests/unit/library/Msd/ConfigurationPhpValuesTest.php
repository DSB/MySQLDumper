<?php
/**
 * @group configuration
 */
class Msd_ConfigurationPhpValuesTest extends PHPUnit_Framework_TestCase
{
    public function testCanFallbackTo30SecondsExecutionTime()
    {
        ini_set('max_execution_time', 31);
        $dynamicValues = Msd_ConfigurationPhpValues::getDynamicValues();
        $this->assertEquals(30, $dynamicValues->maxExecutionTime);
    }

    public function testCanFallbackTo16MbRam()
    {
        $activeValue = ini_get('memory_limit');
        ini_set('memory_limit', '15M');
        $dynamicValues = Msd_ConfigurationPhpValues::getDynamicValues();
        // reset value to not break tests
        ini_set('memory_limit', $activeValue);
        $this->assertEquals(16, $dynamicValues->phpRam);
    }
}