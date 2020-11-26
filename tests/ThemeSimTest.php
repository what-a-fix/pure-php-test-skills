<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Theme;
use Whatafix\TextTagger\ThemeSim;

/**
 * @internal
 */
class ThemeSimTest extends TestCase
{
    public function testCaseBasicTheme()
    {
        $sim = new ThemeSim(Theme::createFromXML(__DIR__.'/assets/basic_theme.xml'));

        static::assertEquals(0, $sim->sim([
            'code' => 1,
            'is' => 1,
            'fun' => 1,
        ]));

        static::assertEquals(1, $sim->sim([
            'test' => 1,
        ]));

        static::assertEquals(0.5, $sim->sim([
            'test' => 1,
            'not-present' => 1,
        ]));

        static::assertEquals(0.2, $sim->sim([
            'the' => 1,
            'test' => 1,
            'is' => 1,
            'well' => 1,
            'written' => 1,
        ]));

        static::assertEquals(0.32, round($sim->sim([
            'testing' => 5,
            'code' => 1,
            'with' => 1,
            'phpunit' => 1,
            'is' => 1,
            'good' => 1,
            'test' => 1,
        ]), 2));
    }
}
