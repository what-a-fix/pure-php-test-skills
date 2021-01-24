<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;

final class TextTaggerTest extends TestCase
{
    private TextTagger $textTagger;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->textTagger = new TextTagger();
    }

    public function testTextTaggerGetTagsNoTags(): void
    {
        $string = "Aaa a aaaa a a aa aaaa a aaaa aa aaaaaaa a aa aaa aaa aaa aaaaa aaa a aaaaa aa a aa";
        $expectedResult = [];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsSimple1(): void
    {
        $string = "Cette après-midi je suis allé manger une glace avec mes parents au parc. 
        Puis nous avons fait une grande ballade.";
        $expectedResult = ["family", "walk"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsSimple2(): void
    {
        $string = "Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.";
        $expectedResult = ["bathroom", "leak"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsSeveralSameTags(): void
    {
        $string = "Une fuite dans ma baignoire au niveau de ma baignoire, on dirait que la fuite de cette baignoire est peut être liée à ma baignoire ou à la fuite";
        $expectedResult = ["bathroom", "leak"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsFourTags(): void
    {
        $string = "Une fuite dans ma famille au niveau de ma baignoire, on dirait une virée";
        $expectedResult = ["bathroom", "family", "leak", "walk"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsSeveralKeywordsForSameTag(): void
    {
        $string = "Une fuite de ma douche percée ou de ma baignoire à trou m'empeche de prendre un bain";
        $expectedResult = ["bathroom", "leak"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }

    public function testTextTaggerGetTagsLongText(): void
    {
        $string = "Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde. Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde. Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde. Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde. Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.";
        $expectedResult = ["bathroom", "leak"];
        $tags = $this->textTagger->getTags($string);
        $this->assertTrue(empty(array_diff($expectedResult, $tags)), 'Expected : ["' . implode('", "', $expectedResult) . '"]' . PHP_EOL . 'Returned : ["' . implode('", "', $tags) . '"]');
    }
}
