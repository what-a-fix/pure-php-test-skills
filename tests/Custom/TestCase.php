<?php


namespace Whatafix\TextTagger\Test\Custom;

use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Whatafix\TextTagger\Test\Custom\Constraint\ArrayEqualsByValue;

class TestCase extends PHPUnitTestCase
{
    public static function assertArrayHasSameValues($expected, $actual, string $message = '')
    {
        $constraint = new ArrayEqualsByValue($expected);

        static::assertThat($actual, $constraint, $message);
    }

    public static function assertArrayHasNotSameValues($expected, $actual, string $message = '')
    {
        $constraint = new LogicalNot(new ArrayEqualsByValue($expected));

        static::assertThat($actual, $constraint, $message);
    }
}
