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

    /**
     * Used to compare every theme and find the one that matches the most words, 'force' will be 3 if it matches 3 words from a theme.
     */
    private float $force;

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

    public function getForce(): float
    {
        return $this->force;
    }

    public function setForce(float $force): void
    {
        $this->force = $force;
    }

    public function setThemeName(string $filename): void
    {
        $this->themeName = $filename;
    }

    public function generateDataFromXML(string $filename): self
    {
        $this->force = 0;

        $xmlDoc = new DOMDocument('1.0', 'utf-8');
        $xmlDoc->load($filename);

        $tag = $xmlDoc->getElementsByTagName('theme');
        $words = $xmlDoc->getElementsByTagName('word');

        $this->setThemeName($tag[0]->textContent);

        foreach ($words as $word) {
            array_push($this->words, mb_strtolower($word->nodeValue, 'UTF-8'));
        }

        return $this;
    }
}
