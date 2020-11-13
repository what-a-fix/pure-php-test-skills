<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

class Test extends TestCase
{ 
    //test la fonction analyseText de la librairie 
    public function testAnalyseText(): void
    {
        $library = new AnalysisTextLibrary(['Bonjour', 'Madame', 'Monsieur','Enfant'], 44);
        $this->assertSame(
            $library->getTags('Hello', 'Feminin', 'Masculin','petit')
        );
       
       //$this->library->getTags('Bonjour Madame avez vous des enfants, êtes vous en famille');
       //print $library;
    }
}return;