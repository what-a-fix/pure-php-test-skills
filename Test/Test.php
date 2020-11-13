<?php

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;
class Test extends TestCase
{ 
    //test la fonction analyseText de la librairie 
    public function testAnalyseText(): void
    {
        $data['Bonjour'] = 'Bonjour';
        ob_start();
        include('AnalysisTextLibrary.php');
        $output = ob_get_fluch();
        $this->assertContains($someExpectedString, $output);
    }
}
