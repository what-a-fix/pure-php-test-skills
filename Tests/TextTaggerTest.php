<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;

final class TextTaggerTest extends TestCase
{
    public function testEmpty(): void
    {
        $input = "";
        $textTagger = new TextTagger();
        $tag = $textTagger->getTags($input);
        $this->assertEquals([], $tag);
    }

    public function testSimple(): void
    {
        $input = "I love how my kitchen is decorated. My dog loves it too.";
        $textTagger = new TextTagger();
        $tag = $textTagger->getTags($input);
        $this->assertEquals([
            'animal',
            'house',
        ], $tag);
    }

    public function testSimple2(): void
    {
        $input = "I need a new television in my living-room";
        $textTagger = new TextTagger();
        $tag = $textTagger->getTags($input);
        $this->assertEquals([
            'house',
            'technology',
        ], $tag);
    }



}
