<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\WordInterface;

class Word implements WordInterface
{
    private string $wordName;

    private string $plural;

    private int $pluralPositionMinus;

    public function setWordName(string $wordName): void
    {
        $this->wordName = $wordName;
    }

    public function getWordName(): string
    {
        return $this->wordName;
    }

    public function getPlural(): string
    {
        return $this->plural;
    }

    public function setPlural(string $plural): void
    {
        $this->plural = $plural;
    }

    public function getPluralPositionMinus(): int
    {
        return $this->pluralPositionMinus;
    }

    public function setPluralPositionMinus(int $pluralPositionMinus): void
    {
        $this->pluralPositionMinus = $pluralPositionMinus;
    }

    public function getPluralGenerated(): string
    {
        if (0 == $this->getPluralPositionMinus()) {
            if ('' !== $this->getPlural()) {
                //ex: 'patate' will return 'patates'.
                return $this->getWordName().$this->getPlural();
            }

            return '';
        }

        //ex substr_replace('animal','ux',-1) will return 'animaux'.
        return substr_replace($this->getWordName(), $this->getPlural(), $this->getPluralPositionMinus());
    }
}
