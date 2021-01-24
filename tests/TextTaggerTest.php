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
    public function testEmptyTextTagger(): void
    {
        $text = '';
        $result = [
            'L\'input ne peut pas être vide'
        ];
        $tags = $this->textTagger->getTags($text);
        $this->assertTrue(empty(array_diff($result, $tags)),
            'Expected : [' . implode(', ', $result) . ']' . PHP_EOL . 'Returned : [' . implode(', ', $tags) . ']');
    }

    /**
     * @test
     */
    public function testNoMatchTextTagger(): void
    {
        $text = 'Il faut beau aujourd\'hui';
        $result = [];
        $tags = $this->textTagger->getTags($text);
        $this->assertTrue(empty(array_diff($result, $tags)),
            'Expected : [' . implode(', ', $result) . ']' . PHP_EOL . 'Returned : [' . implode(', ', $tags) . ']');
    }

    /**
     * @test
     */
    public function testSimpleTextTagger(): void
    {
        $text = 'Cet après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.';
        $result = [
            'family',
            'walk',
        ];
        $tags = $this->textTagger->getTags($text);
        $this->assertTrue(empty(array_diff($result, $tags)),
            'Expected : [' . implode(', ', $result) . ']' . PHP_EOL . 'Returned : [' . implode(', ', $tags) . ']');
    }
}
