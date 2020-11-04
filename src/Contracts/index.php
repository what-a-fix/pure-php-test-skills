<?php

use Whatafix\TextTagger\Contracts\AnalysisTextControler;
use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;
use Whatafix\TextTagger\Contracts\TextTaggerInterface;

$text = new TextTaggerInterface;
$text->getTags('Bonjour Madame');
