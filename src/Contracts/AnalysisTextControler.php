<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;

//création du contrôleur pour appeler la librairie
class AnalysisTextControler
{
    //cette fonction est pour récupérer la fonction de la librairie 

    public function split(string $text){

     $text = new AnalysisTextLibrary();
     $text->getTags('');
     return $text;
    }
}