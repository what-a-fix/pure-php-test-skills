<?php

/**
 * @author Florian Rowehy
 * @link https://github.com/Florian-Rowehy
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
