<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use DOMDocument;
use Whatafix\TextTagger\Contracts\ThemesInterface;

class Themes implements ThemesInterface
{
    private string $themeName;

    private array $words;

    public function __construct()
    {
        $this->words = [];
    }

    public function getThemeName(): string
    {
        return $this->themeName;
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function setWords(array $words): void
    {
        $this->words = $words;
    }

    public function setThemeName(string $filename): void
    {
        $this->themeName = $filename;
    }

    public function generateDataFromXML(string $filename): self
    {
        $xmlDoc = new DOMDocument('1.0', 'utf-8');
        $xmlDoc->load($filename);

        $tag = $xmlDoc->getElementsByTagName('theme');
        $words = $xmlDoc->getElementsByTagName('word');

        $this->setThemeName($tag[0]->textContent);

        foreach ($words as $word) {
            $values = [];
            $children = $word->childNodes;

            foreach ($children as $child) {
                array_push($values, $child->nodeValue);
            }

            $word = new Word();
            $word->setWordName($values[0]);
            $word->setPlural($values[1]);
            $word->setPluralPositionMinus(intval($values[2]));

            array_push($this->words, $word/*mb_strtolower($word->nodeValue, 'UTF-8')*/);
        }

        return $this;
    }

    public function matches(array $words): array
    {
        $currentForce = 0;

        foreach ($words as $word) {
            $themeWords = $this->getWords();

            //for each word in the theme
            foreach ($themeWords as $themeWord) {
                //If the current text's word matches the current theme word
                if ($word == $themeWord->getWordName() || $word == $themeWord->getPluralGenerated()) {
                    $currentForce = $currentForce + 1;
                }
            }
        }

        return [$this, $currentForce];
    }
}
