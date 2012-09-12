<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      PHPUnit_Constraint
 * @version         SVN: $Rev$
 * @author          $Author$
 */
/**
 * PHPUnit constraint to check an array for the given structure.
 *
 * @package         MySQLDumper
 * @subpackage      PHPUnit_Constraint
 */
class Msd_PHPUnit_Constraint_ArrayHasStructure extends PHPUnit_Framework_Constraint
{
    /**
     * Expected array structure.
     *
     * @var array
     */
    private $_structure;

    /**
     * Class constructor, sets the expected array structure.
     *
     * @param array $structure Array containing the expected array structure.
     *
     * @return Msd_PHPUnit_Constraint_ArrayHasStructure
     */
    public function __construct($structure)
    {
        $this->_structure = $structure;
    }

    /**
     * Checks an array against the expected structure.
     *
     * @param mixed $other     Array to check.
     * @param null  $structure Expected structure (used fpr recursion).
     *
     * @return bool|int
     */
    protected function matches($other, $structure = null)
    {
        if ($structure === null) {
            $structure = $this->_structure;
        }

        $isValid = true;
        foreach ($structure as $key => $value) {
            if (is_array($value)) {
                $isValid = $isValid && isset($other[$key]);
                if (isset($other[$key])) {
                    $isValid = $isValid & $this->matches($other[$key], $value);
                }
                continue;
            }

            $isValid = $isValid && isset($other[$value]);
        }

        return $isValid;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return 'has the structure' . PHPUnit_Util_Type::export($this->_structure);
    }

    /**
     * Returns the failure message.
     *
     * @param mixed $other Checked array.
     *
     * @return string
     */
    protected function failureDescription($other)
    {
        return 'an array ' . $this->toString();
    }
}
