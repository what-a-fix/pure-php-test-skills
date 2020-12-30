<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

interface WordInterface
{
    /**
     * Undocumented function.
     */
    public function setWordName(string $wordName): void;

    /**
     * Undocumented function.
     */
    public function getWordName(): string;

    /**
     * Undocumented function.
     */
    public function getPlurial(): string;

    /**
     * Undocumented function.
     */
    public function setPlurial(string $plurial): void;

    /**
     * Undocumented function.
     */
    public function getPlurialPositionMinus(): int;

    /**
     * Undocumented function.
     */
    public function setPlurialPositionMinus(int $plurialPositionMinus): void;

    /**
     * Undocumented function.
     */
    public function getPlurialGenerated(): string;
}
