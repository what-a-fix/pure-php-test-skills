<?php

namespace Whatafix\TextTagger\Contracts;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{ 
    //test la fonction analyseText de la librairie 
    public function testAnalyseText() 
    {
        $this->assertEqual(
            ['Bonjour', 'Madame', 'Monsieur','Enfant'],
            ['Hello', 'Feminin', 'Masculin','petit']
        );
       // $library = new AnalysisTextLibrary;
        //$this->library->getTags('Bonjour Madame avez vous des enfants, êtes vous en famille');
        //print $library;
    }
}