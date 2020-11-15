<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;

class TextTaggerTest extends TestCase
{
    private $textTagger;

    protected function setUp(): void
    {
        $this->textTagger = new TextTagger();
        $this->textTagger->addThemeTags('/mnt/d/wildCodeSchool/entretien/pure-php-test-skills/src/label/train');
        $this->textTagger->addThemeTags('/mnt/d/wildCodeSchool/entretien/pure-php-test-skills/src/label/walk');
        $this->textTagger->addThemeTags('/mnt/d/wildCodeSchool/entretien/pure-php-test-skills/src/label/bathroom.php');
        $this->textTagger->addThemeTags('/mnt/d/wildCodeSchool/entretien/pure-php-test-skills/src/label/school');
        $this->textTagger->addThemeTags('/mnt/d/wildCodeSchool/entretien/pure-php-test-skills/src/label/family.php');

    }

    public function testTextTaggerGetTagsBasic(): void
    {
        $str = "Cette après-midi je suis allé manger une glace avec mes parents et grand-parents au parc. 
        Puis nous avons fait une grande ballade au parc.";
        $tags = $this->textTagger->getTags($str);
        $this->assertEmpty(array_diff(["family", "walk"], $tags));
    }

    public function testNoDuplicateTags(): void
    {
        $str = "fils fille parent neveu";
        $tags = $this->textTagger->getTags($str);
        $this->assertCount(1,$tags);
        $str = "faute grammaire math livre";
        $tags = $this->textTagger->getTags($str);
        $this->assertCount(1,$tags);
        $str = "faute grammaire";
        $tags = $this->textTagger->getTags($str);
        $this->assertCount(1,$tags);
    }

    public function testNoTagIfOneMatch(): void
    {
        $str = "fille vacance";
        $tags = $this->textTagger->getTags($str);
        $this->assertEmpty($tags);
    }

    public function testDetectDuplicateWords(): void
    {
        $str = "fils fils";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);
    }

    public function testIgnoreCase(): void
    {
        $str = "Ballade TANTe lavaBO sorTie PARENT douche faute Grammaire";
        $tags = $this->textTagger->getTags($str);
        $this->assertEmpty(array_diff(["family", "walk", "bathroom", "school"], $tags));
    }

    public function testIgnoresPunctuation(): void
    {
        $str = "././/devoir-!::savoir;[enfant},oncle;ballade-;~promenade~#lavabo{pharmacie]='";
        $tags = $this->textTagger->getTags($str);
        $this->assertEmpty(array_diff(["family", "walk", "bathroom", "school"], $tags));
    }

    public function testDetectPlural(): void
    {
        $str = "parents  filles";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);
        $str = "neveux nièces";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);
        $str = "oraux cours";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["school"], $tags);
        $str = "travaux cahiers";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["school"], $tags);
        $str = "rails locomotives";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["train"], $tags);
    }

    public function testMultibyteString(): void
    {
        $str = "élève école";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["school"], $tags);
        $str = "leçon étude";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["school"], $tags);
    }

    public function testDetectMultipleWords(): void
    {
        $str = "porte-serviettes porte serviettes";
        $tags = $this->textTagger->getTags($str);
        $this->assertCount(1, $tags);
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
        $this->assertEmpty($tags);
    }

    public function testVariableMinMatch(): void
    {
        $str = "parents  filles";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);

        $str = "neveux";
        $tags = $this->textTagger->getTags($str);
        $this->assertEmpty($tags);

        $this->textTagger->setMinMatch(1);
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);

        $this->textTagger->setMinMatch(-1);
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(["family"], $tags);

        $this->textTagger->setMinMatch(2);
    }
}
