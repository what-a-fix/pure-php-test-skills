<?php

namespace Whatafix\TextTagger\Tests;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\TextTaggerInterface;
use Whatafix\TextTagger\TextTagger;

class TextTaggerTest extends TestCase
{
    private TextTaggerInterface $textTagger;

    public function setUp(): void
    {
        /**
         * Potentiellement il s'agit de la seule méthode où tu es autorisé à changer du code,
         * mais tu n'as pas besoin de le faire concentre toi uniquement sur l'implémentation de TextTagger
         */
        $this->textTagger = new TextTagger();
    }

    public function textAndTagProvider(): \Generator
    {
        yield [
            'text' => 'Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade',
            'tags' => [
                'family',
                'walk',
            ],
        ];

        yield [
            'text' => 'Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.',
            'tags' => [
                'leak',
                'bathroom',
            ],
        ];
    }

    /**
     * @dataProvider textAndTagProvider
     * @param string $text
     * @param array $tags
     */
    public function testTagMatchText(string $text, array $tags): void
    {
        $this->assertEquals(
            $this->textTagger->getTags($text),
            $tags
        );
    }
}
