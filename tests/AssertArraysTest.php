<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use Whatafix\TextTagger\Test\Custom\TestCase;

/**
 * @internal
 */
class AssertArraysTest extends TestCase
{
    public function testOrderedArray()
    {
        self::assertArrayHasSameValues(['one', 'two'], ['one', 'two']);
    }

    public function testUnOrderedArray()
    {
        self::assertArrayHasSameValues(['one', 'two'], ['two', 'one']);
    }

    public function testHasNotSameValues()
    {
        self::assertArrayHasNotSameValues(['one', 'two', 'three'], ['two', 'one']);
    }
}
