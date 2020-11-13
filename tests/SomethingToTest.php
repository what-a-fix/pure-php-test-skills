<?php

namespace Whatafix\TextTagger\Test; // Ce namespace n'éxiste pas !!!

use PHPUnit\Framework\TestCase;

class SomethingToTest extends TestCase
{
    //test la fonction analyseText de la librairie
    public function testAnalyseText(): void
    {
        $data['Bonjour'] = 'Bonjour';
        /* Je ne comprends pas l'intérêt de tout cela...
        ob_start();
        include('AnalysisTextLibrary.php');
        $output = ob_get_fluch();
        */
        $this->assertContains($someExpectedString, $output); // Ca ne peut pas marcher, $someExpectedString n'est même pas défini
    }
}
