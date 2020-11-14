<?php

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{

    const TAG_LIST = [
        'family'=>[
            'fils',
            'fille',
            'parent',
            'mère',
            'père',
            'maman',
            'papa',
            'grand-parent',
            'grand-mère',
            'grand-père',
            'tante',
            'oncle',
            'neveu',
            'nièce',
            'cousin',
            'cousine',
            'épouse',
            'mari',
            'beau-frère',
            'belle-soeur',
            'frère',
            'soeur',
            'enfant'
        ],
        'walk'=>[
            'ballade',
            'sortie',
            'promener',
            'promenade'
        ],
        'bathroom'=>[
            'lavabo',
            'baignoire',
            'douche',
            'toilette',
            'savon',
            'shampoing',
            'pharmacie',
            'porte-serviettes',
            'bain'
        ],
        'school'=>[
            'école',
            'faute',
            'grammaire',
            'éducation',
            'punition',
            'bulletin',
            'institutrice',
            'étude',
            'problème',
            'cours',
            'classe',
            'devoir',
            'élève',
            'instituteur',
            'leçon',
            'savoir',
            'science',
            'apprentissage',
            'cahier',
            'mot',
            'écolier',
            'parole',
            'récréation',
            'rentrée',
            'vacances',
            'exemple',
            'instruction',
            'livre',
            'page',
            'stylo',
            'math',
            'physique',
            'chimie',
            'collège',
            'lycée',
            'formation',
            'scolaire',
            'enseignement',
            'correction',
            'poésie',
            'poème',
            'dictionnaire',
            'rédaction',
            'note',
            'question',
            'examen',
            'oral',
            'travail'
        ],
        'train'=>[
            'rail'
        ]
    ];

    /**
     * Return the tags for a specific text
     * @param string $text
     * @return string[]
     */
    public function getTags(string $text): array
    {
        $tags = [];

        foreach ( self::TAG_LIST as $tag=>$values) {
            foreach ($values as $value) {
                //plural management
                $isException = preg_match('/ai?l\b/', $value);
                if ($isException) {
                    $value = preg_replace('/([a-z-]+)(ai?l)\b/', '$1($2s?|aux)', $value);
                } else {
                    $value .= '[xs]?';
                }

                //hyphen/space management
                $value = preg_replace('/[- ]/', '( |-)', $value);

                $regex = '/\b'.$value.'\b/iu';
                $hasMatched = preg_match($regex, $text);
                if ($hasMatched) {
                    $tags[] = $tag;
                    break;
                }
            }
        }
        return $tags;
    }
}
