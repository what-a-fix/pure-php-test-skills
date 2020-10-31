<?php


namespace Whatafix\TextTagger\Contracts;


const TAGS_POLITESSE_FEMININ = ['Courtoisie', 'Fémiinin'];
const TAGS_POLITESSE_MASCULIN = ['Courtois', 'Masculin'];
const TAGS_POLITESSE_ENFANT = ['Familier', 'Enfant'];
const TAGS_POLITESSE_UNDIFIND = ['Phrase trop complexe'];

class IAAnalysisTextLibrary
{
    public function analyseText($text)
    {
        if ($text == 'Bonjour Madame') {
            return TAGS_POLITESSE_FEMININ;
        } elseif ($text == 'Bonjour Monsieur') {
            return TAGS_POLITESSE_MASCULIN;
        } elseif ($text == 'Salut gamin') {
            return TAGS_POLITESSE_ENFANT;
        } elseif ($text == '') {
            return TAGS_POLITESSE_UNDIFIND;
        }
    }
}
