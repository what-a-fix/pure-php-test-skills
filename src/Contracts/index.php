<?php

use Whatafix\TextTagger\Contracts\AnalysisTextControler;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

require ('./TextTaggerInterface.php');
require './AnalysisTextControler.php';
require './AnalysisTextLibrary.php';


$data = new AnalysisTextControler();
$data->split('');
var_dump($data);

