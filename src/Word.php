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

    private string $plurial;

    private int $plurialPositionMinus;

    public function setWordName(string $wordName): void
    {
        $this->wordName = $wordName;
    }

    public function getWordName(): string
    {
        return $this->wordName;
    }

    public function getPlurial(): string
    {
        return $this->plurial;
    }

    public function setPlurial(string $plurial): void
    {
        $this->plurial = $plurial;
    }

    public function getPlurialPositionMinus(): int
    {
        return $this->plurialPositionMinus;
    }

    public function setPlurialPositionMinus(int $plurialPositionMinus): void
    {
        $this->plurialPositionMinus = $plurialPositionMinus;
    }

    public function getPlurialGenerated(): string
    {
        if (0 == $this->getPlurialPositionMinus()) {
            if ('' !== $this->getPlurial()) {
                //ex: 'patate' will return 'patates'.
                return $this->getWordName().$this->getPlurial();
            }

            return '';
        }

        //ex substr_replace('animal','ux',-1) will return 'animaux'.
        return substr_replace($this->getWordName(), $this->getPlurial(), $this->getPlurialPositionMinus());
    }
}
