<?php

use Whatafix\TextTagger\Contracts\IAAnalysisTextControler;
use Whatafix\TextTagger\Contracts\IAAnalysisTextLibrary;


$data = new IAAnalysisTextControler();
$library = new IAAnalysisTextLibrary();
$data->getAnalyseText($library);