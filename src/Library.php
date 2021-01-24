<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

require __DIR__.'/../vendor/autoload.php';

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

/**
 * Class Library.
 */
class Library implements TextTaggerInterface
{
    const SCOPE_TAGS = [
        'bathroom' => ['bain', 'baignoire', 'toilette', 'douche', 'lavabo'],
        'leak' => ['fuite', 'tuyau', 'bonde'],
        'family' => ['parent', 'enfant', 'fils', 'fille', 'frère', 'soeur', 'père', 'mère', 'cousin'],
        'walk' => ['ballade', 'promenade', 'randonnée', 'tour', 'forêt'],
        'cinema' => ['cinéma', 'film', 'affiche', 'acteur', 'actrice'],
        ];

    /**
     * {@inheritdoc}
     */
    public function getTags(string $text): array
    {
        $text = preg_replace("/(?:['-])\\p{P}/u", '', $text);
        $words = explode(' ', $text);
        $tagFrequencies = [];
        foreach ($words as $word) {
            foreach (self::SCOPE_TAGS as $tag => $scopeWords) {
                foreach ($scopeWords as $scopeWord) {
                    if (str_contains($word, $scopeWord)) {
                        if (!array_key_exists($tag, $tagFrequencies)) {
                            $tagFrequencies[$tag] = 1;
                        } else {
                            ++$tagFrequencies[$tag];
                        }
                    }
                }
            }
        }
        arsort($tagFrequencies);
        $tags = array_keys($tagFrequencies);

        return array_slice($tags, 0, 2);
    }
}
