<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Theme;
use Whatafix\TextTagger\ThemeTagger;
use Whatafix\TextTagger\ThemeWord;

/**
 * @internal
 */
class ThemeTest extends TestCase
{
    public function testCreateFromXML()
    {
        $theme = Theme::createFromXML(__DIR__.'/assets/basic_theme.xml');

        $this->assertEquals('test', $theme->getTag());
        $this->assertEquals('fr', $theme->getLang());
        $this->assertEquals(
            [
                new ThemeWord(['phpunit']),
                new ThemeWord(['test', 'testing']),
                new ThemeWord(['error'], 0.5),
            ],
            $theme->getWords()
        );
    }
}
