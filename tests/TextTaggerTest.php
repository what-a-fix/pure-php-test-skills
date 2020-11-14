<?php
namespace Whatafix\Test;
use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;
use Whatafix\TextTagger\TextTaggerV2;

class TextTaggerTest extends TestCase
{
    private $textTagger;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->textTagger = new TextTaggerV2();
    }

    public function testInstance(): void
    {
        $class = get_class($this->textTagger);
        $this->assertEquals("Whatafix\TextTagger\TextTaggerV2", $class);
    }

    public function testTextTaggerGetTagsBasic(): void
    {
        $str = "Cette après-midi je suis allé manger une glace avec mes parents au parc. 
        Puis nous avons fait une grande ballade.";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk"], $tags)));
    }

    public function testNoDuplicateTags(): void
    {
        $str = "fils fille parent neveu";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "faute grammaire math livre";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "parent";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "faute grammaire";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
    }

    public function testIgnoreCase(): void
    {
        $str = "Ballade lavaBO PARENT faute";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }

    public function testIgnoresPunctuation(): void
    {
        $str = "././/devoir-!::;[enfant},;ballade-;~~#lavabo{]='";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }

    //detect exact word or should accept radical matching?

    /*
    public function testIgnoresNumbers(): void
    {
        $str = "1345classe145465enfant15489ballade464879lavabo";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }*/

    public function testDetectPlural(): void
    {
        $str = "parents";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["family"]==$tags);
        $str = "neveux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["family"]==$tags);
        $str = "oraux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
        $str = "travaux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
    }

    public function testMultibyteString(): void
    {
        $str = "élève";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
        $str = "leçon";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
    }

    public function testDetectMultipleWords(): void
    {
        $str = "porte-serviettes";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "porte serviettes";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
    }

    public function testReturnEmptyArray(): void
    {
        $str = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Praesent eu sem at justo dapibus dignissim in in nunc. 
        Morbi et tortor nec metus finibus placerat. 
        Morbi ornare eget lectus non ultrices. 
        Curabitur risus augue, aliquet faucibus magna eu, porttitor rhoncus velit. 
        Donec finibus, tortor eu varius maximus, leo orci dignissim dolor, eu commodo nisl quam id orci. 
        Suspendisse vulputate urna quis metus euismod sagittis. Curabitur vel euismod diam. 
        Integer id justo tellus. Mauris dictum, sapien quis bibendum interdum, nisl leo tristique tellus, id posuere tortor ligula ut eros. 
        Mauris commodo fermentum consequat. 
        Nunc bibendum vestibulum volutpat. 
        Ut quis maximus purus. 
        Curabitur scelerisque condimentum fermentum. 
        In porttitor ligula ac dolor consequat egestas. 
        Duis sed justo scelerisque, malesuada erat ut, porttitor mi. 
        Duis molestie nibh at molestie fringilla.";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty($tags));
    }
}
