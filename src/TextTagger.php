<?php

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

/**
 * This class implement the TextTaggerInterface interface
 *
 * C'est la seule classe que tu dois modifier
 */
class TextTagger implements TextTaggerInterface
{            
    public const TAGS_FAMILY = ['parent','enfant'];
    public const TAGS_WALK = ['balade']; 
    public const TAGS_LEAK = ['fuite'];
    public const TAGS_BATHROOM = ['baignoire'];
   


public function getTags(string $text): array
{
    $response = [];
    
    foreach (self::TAGS_FAMILY as $words) {

        if(substr_count($text, $words) > 1){
             return[array_push($response,'family')];
        }
    } 

    foreach (self::TAGS_WALK as $words) {

        if(substr_count($text, $words)  > 1 ){
            return[array_push($response,'walk')];
       }
    }
    
    foreach (self::TAGS_LEAK as $words) {

        if(substr_count($text, $words) > 1){
            return[array_push ($response,'leak')];
       }
    }

    foreach (self::TAGS_BATHROOM as $words) {

        if(substr_count($text, $words) > 1){
            return[array_push($response,'bathroom')];
       }
    }
    return [$response];
    }
}
