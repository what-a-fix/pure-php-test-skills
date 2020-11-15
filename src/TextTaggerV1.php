<?php
namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTaggerV1 implements TextTaggerInterface
{
    const TAG_MATCHES = ['fils'=>'family',
        'fille'=>'family',
        'parent'=>'family',
        'mère'=>'family',
        'père'=>'family',
        'maman'=>'family',
        'papa'=>'family',
        'grand-parent'=>'family',
        'grand-mère'=>'family',
        'grand-père'=>'family',
        'tante'=>'family',
        'oncle'=>'family',
        'neveu'=>'family',
        'nièce'=>'family',
        'cousin'=>'family',
        'cousine'=>'family',
        'épouse'=>'family',
        'mari'=>'family',
        'beau-frère'=>'family',
        'belle-soeur'=>'family',
        'frère'=>'family',
        'soeur'=>'family',
        'enfant'=>'family',
        'ballade'=>'walk',
        'sortie'=>'walk',
        'promener'=>'walk',
        'promenade'=>'walk',
        'lavabo'=>'bathroom',
        'baignoire'=>'bathroom',
        'douche'=>'bathroom',
        'toilette'=>'bathroom',
        'savon'=>'bathroom',
        'shampoing'=>'bathroom',
        'pharmacie'=>'bathroom',
        'porte-serviettes'=>'bathroom',
        'bain'=>'bathroom',
        'école'=>'school',
        'faute'=>'school',
        'grammaire'=>'school',
        'éducation'=>'school',
        'punition'=>'school',
        'bulletin'=>'school',
        'institutrice'=>'school',
        'étude'=>'school',
        'problème'=>'school',
        'cours'=>'school',
        'classe'=>'school',
        'devoir'=>'school',
        'élève'=>'school',
        'instituteur'=>'school',
        'leçon'=>'school',
        'savoir'=>'school',
        'science'=>'school',
        'apprentissage'=>'school',
        'cahier'=>'school',
        'mot'=>'school',
        'écolier'=>'school',
        'parole'=>'school',
        'récréation'=>'school',
        'rentrée'=>'school',
        'vacances'=>'school',
        'exemple'=>'school',
        'instruction'=>'school',
        'livre'=>'school',
        'page'=>'school',
        'stylo'=>'school',
        'math'=>'school',
        'physique'=>'school',
        'chimie'=>'school',
        'collège'=>'school',
        'lycée'=>'school',
        'formation'=>'school',
        'scolaire'=>'school',
        'enseignement'=>'school',
        'correction'=>'school',
        'poésie'=>'school',
        'poème'=>'school',
        'dictionnaire'=>'school',
        'rédaction'=>'school',
        'note'=>'school',
        'question'=>'school',
        'examen'=>'school',
        'oral'=>'school',
        'travail'=>'school',
    ];

    /**
     * Return the tags for a specific text
     * @param string $text
     * @return string[]
     */
    public function getTags(string $text): array
    {
        $tags = array();
        $usedTags = array();

        $words = preg_split('/[\s\.?!]+/', $text);
        $nbWord = count($words);

        for ($i=0; $i<$nbWord; $i++) {
            $word = strtolower($words[$i]);
            $wordLength = strlen($word);
            if ($wordLength<3) {
                continue;
            }

            $tag = self::TAG_MATCHES[$word]?? null;

            //check plural
            $lastChar = $word[$wordLength-1];
            $isPlural = $lastChar === 's' || $lastChar === 'x';

            if (!$tag && $isPlural) {
                $wordSingular = substr($word, 0, -1);
                $tag = self::TAG_MATCHES[$wordSingular]?? null;
            }

            if ($tag && !isset($usedTags[$tag])) {
                $tags[] = $tag;
                $usedTags[$tag] = true;
            }
        }
        return $tags;
    }
}
