<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;
use Whatafix\TextTagger\Contracts\TextTaggerInterface;

//création du contrôleur pour appeler la librairie
class AnalysisTextControler extends TextTaggerInterface
{

    public function getAnalyseText(AnalysisTextLibrary $analysisTextLibrary)
    {

        $data = $analysisTextLibrary->analyseText('Bonjour Madame');
        $text = new TextTaggerInterface;
        $text->getTags('Bonjour Madame');

        var_dump($data);

        return $data;
    }
}
