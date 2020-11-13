<?php

namespace Whatafix\TextTagger\Test; // Ce namespace n'éxiste pas !!!

use PHPUnit\Framework\TestCase;

class SomethingToTest extends TestCase
{
    //test la fonction analyseText de la librairie
    public function testAnalyseText(): void
    {
        //$output = getTags('Bonjour');
       // $someExpectedString = 'Monsieur';
        /* Je ne comprends pas l'intérêt de tout cela...
        ob_start();
        include('AnalysisTextLibrary.php');
        $output = ob_get_fluch();
        */
        //c'est un example que j'ai trouvé sur internet et je pensait que sa testait ma fonction 
        $this->expectOutputString('Bonjour'); // Ca ne peut pas marcher, $someExpectedString n'est même pas défini
        print 'Bonjour';
    }
}
