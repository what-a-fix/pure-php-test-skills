<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

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
        $tags_Feminin =['Bonjour Madame'];

        $tags_Masculin = ['Bonjour Monsieur'];

        $tags_Enfant = ['Bonjour petit'];


        //tableau de mots associtif -> tags
        //$word = ['Masculin' => 'Bonjour Monsieur','Féminin' => 'Bonjour Madame', 'Enfants' => 'Bonjour petit'];
        //$data = mb_split('\s', $data);
        //$result = array_diff($word, $data, []);

        //return ($word);

        if ($data === $tags_Feminin){
            return['Femme'];
        }
        if ($data === $tags_Masculin){
            return ['Masculin'];
        }
        if ($data === $tags_Enfant){
            return ['Enfant'];
        } 
    }
}return;