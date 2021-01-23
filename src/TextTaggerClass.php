<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

/**
 * Class TextTaggerClass.
 */
class TextTaggerClass implements TextTaggerInterface
{
    const SCOPE_TAGS = [
        'bathroom' => ['bain', 'baignoire', 'toilette', 'douche', 'lavabo'],
        'leak' => ['fuite', 'tuyau', 'bonde'],
        'family' => ['parent', 'enfant', 'fils', 'frère', 'soeur', 'père', 'mère', 'cousin'],
        'walk' => ['ballade', 'promenade', 'randonnée', 'tour', 'forêt'],
        'cinema' => ['cinéma', 'film', 'affiche', 'acteur', 'actrice'],
        ];

    /**
     * {@inheritdoc}
     */
    public function getTags(string $text): array
    {
        $text = preg_replace("/(?!['-])\p{P}/u", "", $text);
        $tags = [];
        $words = explode(' ', $text);
        foreach ($words as $word) {
            foreach (self::SCOPE_TAGS as $tag => $scopeWords) {
                foreach ($scopeWords as $scopeWord) {
                    if ($scopeWord === $word) {
                        $tags[] = $tag;
                    }
                }
            }
        }
        return $words;
    }
}
