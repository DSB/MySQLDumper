<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      PHPUnit
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * Abstract class to extend PHPUnit tests with custom assertions.
 *
 * @package         MySQLDumper
 * @subpackage      PHPUnit
 */
abstract class Msd_PHPUnit_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Assertion to test that an array has at least a structure.
     *
     * @param array  $structure Excepted structure of the array.
     * @param array  $array     Array to test.
     * @param string $message   Additional information about the test.
     *
     * @return void
     */
    public static function assertArrayHasStructure($structure, $array, $message = '')
    {
        self::assertThat($array, self::arrayHasStructure($structure, $message));
    }

    /**
     * Returns the constraint for the assertion.
     *
     * @param array $structure Excepted structure of the array.
     *
     * @return Msd_PHPUnit_Constraint_ArrayHasStructure
     */
    public static function arrayHasStructure($structure)
    {
        return new Msd_PHPUnit_Constraint_ArrayHasStructure($structure);
    }
}
