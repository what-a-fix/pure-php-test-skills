<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\AnalysisTextLibrary;
//cette fonction est pour récupérer la fonction de la librairie 
//création du contrôleur pour appeler la librairie

class AnalysisTextControler
{
    public function split(string $text)
    {

     $text = new AnalysisTextLibrary();
     $text->getTags('Bonjour Madame, Bonjour Monsieur');
     return $text;
    }
}