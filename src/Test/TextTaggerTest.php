<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;

class TextTaggerTest extends TestCase
{
    private TextTagger $textTagger;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->textTagger = new TextTagger();
    }

    /**
     * @test
     */
    public function testTextTagger(): void
    {
        $text = "Cet après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.";
        $result = [
            'family',
            'walk'
        ];
        $tags = $this->textTagger->getTags($text);
        $this->assertTrue(empty(array_diff($result, $tags)), 'Expected : [' . implode(', ', $result) . ']' . PHP_EOL . 'Returned : ' . implode(', ', $tags) . ']');
    }
}
