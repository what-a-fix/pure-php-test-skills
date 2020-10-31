<?php

use Whatafix\TextTagger\Contracts\IAAnalysisTextControler;
use Whatafix\TextTagger\Contracts\IAAnalysisTextLibrary;

class Test {

    function testAnalyseText() {

        $library = new IAAnalysisTextLibrary;
        $this->library->assertEquals($library);

        return $library;
    }
}
