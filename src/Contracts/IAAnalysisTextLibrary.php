<?php


namespace Whatafix\TextTagger\Contracts;

//librairie
//tableau de mots
$word = ['Masculin','Fémiinin', 'Enfant'];
//tableau de tags
$tags = ['Men', 'Woman', 'family', 'child' ];

class IAAnalysisTextLibrary extends TextTaggerInterface
{
    public function analyseText($text)
    {
        $text = "Bonjour Madame, Bonjour Monsieur, que puis faire pour vous aider ?";
        $text = preg_replace("/\b(regex)\b/i", '<span style="background:#5fc9f6">\1</span>', $text);
        echo $text;
    }
}
