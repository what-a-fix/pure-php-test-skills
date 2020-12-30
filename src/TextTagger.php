<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{
    private ThemesGenerator $simulation;

    public function __construct()
    {
        $this->simulation = new ThemesGenerator();
    }

    public function getTags(string $text, string $env = 'prod'): array
    {
        //Separate the text in arrays, set the text in lowercase (using UTF-8 to avoid missing accents) and remove any punctuation
        $Words = explode(' ', mb_strtolower(trim($text, '(\.|\,|\;|\:|\!|\?)'), 'UTF-8'));
        //Generate the tags
        return $this->simulation->generateThemes($Words, $env);
        //Return the tags
    }
}
