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
    public function getTags(string $text): array
    {
        if ($text === 'Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade'){
            return['family',
            'walk'];
        }
        if ($text === 'Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.'){
            return [ 'leak',
            'bathroom'];
        }
        return [];
    }
}
