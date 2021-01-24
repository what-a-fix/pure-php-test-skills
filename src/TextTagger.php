<?php

namespace Whatafix\TextTagger\Whatafix;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{
    const TAGS = [
        'family' => [
            'parents',
            'famille',
            'frère',
            'soeur',
            'enfants',
        ],
        'walk' => [
            'ballade',
            'promenade',
            'parc',
            'escapade',
        ],
        'bathroom' => [
            'baignoire',
            'évier',
            'robinet',
            'bain',
            'douche',
        ],
        'leak' => [
            'fuite',
            'bonde',
            'inondation',
            'flaque',
        ],
    ];

    public function getTags(string $text): array
    {
        $result = [];
        if (empty($text)) {
            return ["L'input ne peut être vide"];
        }
        foreach (self::TAGS as $tag => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($text, $keyword)) {
                    array_push($result, $tag);
                }
            }
        }
        sort($result);
        return $result;
        // TODO: Implement getTags() method.
    }
}