<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Theme;
use Whatafix\TextTagger\ThemeWord;

/**
 * @internal
 */
class ThemeTest extends TestCase
{
    public function testCreateFromXML()
    {
        $theme = Theme::createFromXML(__DIR__.'/assets/basic_theme.xml');

        static::assertEquals('test', $theme->getTag());
        static::assertEquals('fr', $theme->getLang());
        static::assertEquals(
            [
                new ThemeWord(['phpunit']),
                new ThemeWord(['test', 'testing']),
                new ThemeWord(['error'], 0.5),
            ],
            $theme->getWords()
        );
    }
}
