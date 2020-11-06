<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;
require './TextTaggerInterface.php';
//création de la librairie 

//implementation de l'interface TextTagerInterface en utilisant toute ses méthodes 
//problème  avec l'implementation de l'interface 
class AnalysisTextLibrary implements TextTaggerInterface
{
    //cette méthode analyse le texte en découpant les phrases mot par mot 
    //en vérifiant que ses mots sont associés dans mon tableau associatif à mes tags
    //une fois cette analyse faite ma fonction à pour but de resortir les tags associés à ces mots

        public function getTags(string $data):array
        { 
            //tableau de mots associtif -> tags
            $word = ['Masculin' => 'Bonjour Monsieur','Féminin' => 'Bonjour Madame', 'Enfants' => 'Bonjour petit'];

            $data = mb_split('\s', $data);
            $result = array_diff($word, $data, []);
            print_r($result);

            if ($word === $data) {
                return $result;
            }
                return ($word > $data)? 1:-1;
        }
}      