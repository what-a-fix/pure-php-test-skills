<?php

namespace Test\Whatafix;

use Whatafix\TextTagger\Whatafix\TextTagger;
use PHPUnit\Framework\TestCase;

class TextTaggerTest extends TestCase
{
    private TextTagger $textTagger;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->textTagger = new TextTagger();
    }

    public function basicTest()
    {
        $text = "Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.";
        $result = [
            'family',
            'walk'
        ];
        $tags = $this->textTagger->getTags($text);
        $this->assertTrue(empty(array_diff($result, $tags)),
            'Expected : ["' . implode('", "', $result) . '"]' . PHP_EOL .
            'Returned : ["' . implode('", "', $tags) . '"]');;
    }
}
