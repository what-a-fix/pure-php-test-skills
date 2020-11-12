<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

class Test extends TestCase
{ 
    //test la fonction analyseText de la librairie 
    public function testAnalyseText() 
    {
        $library = new AnalysisTextLibrary(['Bonjour', 'Madame', 'Monsieur','Enfant'],32);
        $this->assertSame(
            $library->getTags('Bonjour')
        );
       //$this->library->getTags('Bonjour Madame avez vous des enfants, êtes vous en famille');
        print $library;
    }
}