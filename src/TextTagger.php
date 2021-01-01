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
        //Replace punctuaction, characters, words with apostrophe.
        $text = str_replace(['c\'', 'd\'', 'n\'', 'qu\'', 'l\'', 't\'', 'm\'', 'j\'', 's\'', '.', '?', '”', '“', '\‘', '\'', ',', '!', ':', ';', '(', ')', '[', ']', '…', '/', '"', '+', '=', '^', '`', '|', '#', '~', '&', '<', '>', '*', '%', '£', '¨', '§', 'µ', '{', '}', '¤', '$', '€'], '', $text);
        //Put the words into an array of words.
        $Words = explode(' ', mb_strtolower($text, 'UTF-8'));
        //Generate the tags
        return $this->simulation->generateThemes($Words, $env);
        //Return the tags
    }
}
