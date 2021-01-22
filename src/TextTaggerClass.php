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

    /**
     * @var array
     */
    private $scopeTags;

    public function __construct()
    {
        $this->scopeTags = [
            'bathroom' => ['bain','baignoire','toilette','douche','lavabo'],
            'leak'=> ['fuite','tuyau','bonde'],
            'family' => ['parent','enfant','fils','frère','soeur','père','mère','cousin'],
            'walk' => ['ballade','promenade','randonnée','tour','forêt'],
            'cinema' => ['cinéma','film','affiche','acteur','actrice'],
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function getTags(string $text): array
    {
        return [];
    }
}
