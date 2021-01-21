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
     * {@inheritdoc}
     */
    public function getTags(string $text): array
    {
        return [];
    }
}
