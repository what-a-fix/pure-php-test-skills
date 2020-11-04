<?php

namespace Whatafix\TextTagger\Contracts;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

class Test extends TestCase
{ 
    
    //test la fonction analyse Text de la librairie 
    public function testAnalyseText() {

        $library = new AnalysisTextLibrary;
        $this->library->getTags('Bonjour Madame avez vous des enfants, êtes vous en famille');

        return $library;
    }
}
