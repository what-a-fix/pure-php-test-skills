<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\IAAnalysisTextLibrary;


class IAAnalysisTextControler
{

    public function getAnalyseText(IAAnalysisTextLibrary $iaAnalysisTextLibrary){
            
        $data = $iaAnalysisTextLibrary->analyseText('Bonjour Madame');
        var_dump($data);

    }
}