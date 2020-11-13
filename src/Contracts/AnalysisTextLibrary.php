<?php

namespace Whatafix\TextTagger\Contracts;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

//création de la librairie 

//implementation de l'interface TextTagerInterface en utilisant toute ses méthodes    

class AnalysisTextLibrary implements TextTaggerInterface
{   
    public const TAG_FEMALE = ['Bonjour Madame'];

    public const TAG_MALE = ['Bonjour Monsieur'];

    public const TAG_CHILD = ['Bonjour petit'];

    //cette méthode analyse le texte en découpant les phrases mot par mot 
    //en vérifiant que ses mots sont associés dans mon tableau associatif à mes tags
    //une fois cette analyse faite ma fonction à pour but de resortir les tags associés à ces mots
   
    public function getTags(string $data):array
    { 
        
        if ($data === TAG_FEMALE){
            return['Femme'];
        }
        if ($data === TAG_MALE){
            return ['Masculin'];
        }
        if ($data === TAG_CHILD){
            return ['Enfant'];
        } 
    }
}
