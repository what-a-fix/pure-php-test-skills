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
        $tags = [];
        foreach (self::TAGS as $tag => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword)) {
                    $tags[] = $tag;
                }
            }
        }
        sort($tags);
        return $tags;
    }
}
