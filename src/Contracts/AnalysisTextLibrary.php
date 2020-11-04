<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

//création de la librairie

//tableau de mots associtif -> tags
$words = ['Masculin' => 'Bonjour Monsieur','Féminin' => 'Bonjour Madame', 'Enfants' => 'Bonjour petit'];

//utilisation de l'interface
class AnalysisTextLibrary extends TextTaggerInterface
{
    public function analyseText($text)
    {
        if ($words = $text->getTags("Bonjour Madame, Bonjour Monsieur, Bonjour pett que puis faire pour vous aider vous et vos enfants ?")){
            return $words;
        }
    }
}
