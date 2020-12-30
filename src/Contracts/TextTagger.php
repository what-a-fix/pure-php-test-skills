<?php


namespace Whatafix\TextTagger\Contracts;

class TextTagger implements TextTaggerInterface
{
       
        public const TAGS_FAMILY = ['femme', 'enfant', 'parents', 'mari', 'famille', 'fils', 'fille','père', 'mère', 'papa', 'maman', 
        'oncle', 'tante', 'cousin', 'cousine', 'soeur', 'frère', 'nièce', 'neveu', 'belle-soeur', 'beau-fils', 'grand-mère',
        'grand-père', 'filiation', 'lignée', 'descendance', 'parenté', 'lignage', 'généalogie', 'souche', 'clan', 'maison', 'tribu', 'consanguinité']; 


        public const TAGS_WALK = ['ballade', 'cours', 'progression', 'évolution', 'progrès', 'avancement', 'train', 'allure', 'démarche', 'cheminement',
        'mouvement', 'pas', 'tour', 'trajet'];   


        public const TAGS_LEAK = ['fuite', 'appartement', 'tuyau', 'bonde', 'eau', 'trou', 'chambre', 'debit', 'évier'];
          

        public const TAGS_BATHROOM = ['salle', 'bain', 'baignoire', 'douche', 'toilette', 'lavabo'];                      

        
    public function getTags(string $text): array
    {

        $response = [];                                                 
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;  


        foreach (self::TAGS_FAMILY as $words) {

           
            if( (substr_count($text, $words) >= 1) && ($count1 == 0)){ 
                $count1++;              
                 array_push($response,'family');                       
            }
        }
        
        foreach (self::TAGS_WALK as $words) {

            if( (substr_count($text, $words)  >= 1) && ($count2 == 0) ){    
                $count2++;     
                array_push($response,'walk');
           }
        }
    
        foreach (self::TAGS_LEAK as $words) {
    
            if( (substr_count($text, $words)  >= 1) && ($count3 == 0)){      
                $count3++;    
                array_push ($response,'leak');
           }
        }
           
        foreach (self::TAGS_BATHROOM as $words) {
    
            if((substr_count($text, $words)  >= 1) && ($count4 == 0)){         
                $count4++;       
                array_push($response,'bathroom');         
           }
        }    
  
        return $response;                  
    }
       
        
          
 }