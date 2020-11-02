<?php

use Whatafix\TextTagger\Contracts\IAAnalysisTextControler;
use Whatafix\TextTagger\Contracts\IAAnalysisTextLibrary;

class Test {
    
    //test de la fonction analyse Text de la librairie 
    public function testAnalyseText() {

        $library = new IAAnalysisTextLibrary;
        $this->library->expectOutputString('Word');

        print 'wiz';
    }
}
