<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test\Custom;

use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Whatafix\TextTagger\Test\Custom\Constraint\ArrayEqualsByValue;

/**
 * @internal
 */
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
