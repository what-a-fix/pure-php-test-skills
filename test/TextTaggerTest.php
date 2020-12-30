<?php    

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\TextTagger;

class TextTaggerTest extends TestCase {

    public function testTestAreWorking () {

        $text1 = 'Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.';   
        $text2 = 'Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.';
        
        $textTagger = new TextTagger();
        
        $tags1 = $textTagger->getTags($text1);        
        $tags2 = $textTagger->getTags($text2);    
                           
        $this->assertEquals($tags1, [ 'family', 'walk']);        
        $this->assertEquals($tags2, [ 'leak', 'bathroom' ]);                                                                   
        
    }    
  
}   