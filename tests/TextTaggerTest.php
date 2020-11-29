<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;
use Whatafix\TextTagger\Theme;
use Whatafix\TextTagger\ThemeSim;

/**
 * @internal
 */
class TextTaggerTest extends TestCase
{
    private TextTagger $textTagger;

    public function setUp(): void
    {
        $this->textTagger = new TextTagger(new ThemeSim(Theme::createFromXML(__DIR__.'/assets/basic_theme.xml')));
    }

    public function basicThemeDataProvider(): \Generator
    {
        yield [
            'text' => 'code is fun',
            'expectedTags' => [],
        ];

        yield [
            'text' => 'test not-present',
            'expectedTags' => ['test'],
        ];

        yield [
            'text' => 'the test is well written',
            'expectedTags' => ['test'],
        ];

        yield [
            'text' => 'testing code with phpunit is good test',
            'expectedTags' => ['test'],
        ];
    }

    /**
     * @dataProvider basicThemeDataProvider
     */
    public function testCaseBasicTheme(string $text, array $expectedTags)
    {
        if (empty($expectedTags)) {
            static::assertEmpty($this->textTagger->getTags($text));

            return;
        }

        foreach ($expectedTags as $tag) {
            static::assertArrayHasKey($tag, $this->textTagger->getTags($text));
        }
    }
}
