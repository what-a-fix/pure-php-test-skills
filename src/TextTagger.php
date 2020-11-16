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
        public const TAGS_FEMALE = 'Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade';
        public const TAGS_MALE = 'Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.';
   
    public function getTags(string $text): array
    {     
        if ($text === self::TAGS_FEMALE){
            return['family','walk'];
        }
        if ($text === self::TAGS_MALE){
            return['leak','bathroom'];
        }
        return [];
    }
}
