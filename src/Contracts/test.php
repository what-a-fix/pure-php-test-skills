<?php

namespace Whatafix\TextTagger\Contracts;



use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

class Test
{ 
    
    //test la fonction analyseText de la librairie 
    public function testAnalyseText() {

        $library = new AnalysisTextLibrary;
        $this->library->getTags('Bonjour Madame avez vous des enfants, êtes vous en famille');
        return $library;
    }
}