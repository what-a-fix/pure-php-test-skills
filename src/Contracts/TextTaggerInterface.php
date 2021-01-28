<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text.
 */
interface TextTaggerInterface
{
    /**
     * Return the tags for a specific text.
     *
     * @return string[]
     */
    public function getTags(string $text): array;
}

class TextTagger implements TextTaggerInterface
{
    const Theme = [
        "family" => [
            "parents",
            "père",
            "papa",
            "mère",
            "maman",
            "grand-père",
            "grand-mère",
            "grands-parents",
            "pépé",
            "papi",
            "mami",
            "mémé",
            "famille",
            "cousin",
            "cousins",
            "cousine",
            "cousines",
            "oncle",
            "tonton",
            "tante",
            "tata",
            "fils",
            "soeur",
            "soeur",
            "frère",
        ],
    
        "walk" => [
            "balade",
            "promenade",
            "excursion",
            "expédition",
            "randonnée",
            "sortie"
        ],
    
        "bathroom" => [
            "bain",
            "baignoire",
            "douche",
            "laver"
        ],
    
        "leak" => [
            "fuite",
            "fissure",
            "écoulement",
            "trou",
    
        ]
    ];
    
    public function getTags(string $text): array
    {
        if(strlen($text) < 2){
            $tags = 'Erreur';
        }else{
            $words = explode(" ", $text);
            foreach(self::Theme as $theme){
                foreach($words as $word){
                    foreach ($theme as $tag){
                        if($word == $tag or $word == $tag."."){
                            array_push($tags , "family" );
                        }
                    }
                    
                }
            }
        }
        
        return $tags;
    }
}
