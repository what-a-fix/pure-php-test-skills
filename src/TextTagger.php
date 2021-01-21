<?php

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{

    const TAGS = [
        'family' => [
            'parents',
            'enfants',
            'famille',
        ],
        'walk' => [
            'ballade',
            'virée',
            'marche',
        ],
        'leak' => [
            'fuite',
            'percée',
            'trou',
        ],
        'bathroom' => [
            'bain',
            'baignoire',
            'douche',
        ],
    ];

    public function getTags(string $text): array
    {
        return ['family', 'walk'];
    }
}
