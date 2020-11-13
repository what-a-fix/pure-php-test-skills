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
    public const TAGS_FEMALE = ['Bonjour Madame'];
    public const TAGS_MALE = ['Bonjour Monsieur'];
    public const TAGS_CHILD = ['Bonjour petit'];

    public function getTags(string $data): array
    {
        if ($data === self::TAGS_FEMALE){
            return['Femme'];
        }
        if ($data === self::TAGS_MALE){
            return ['Masculin'];
        }
        if ($data === self::TAGS_CHILD){
            return ['Enfant'];
        }

        return [];
    }
}
