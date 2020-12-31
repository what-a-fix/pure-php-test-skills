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
    public function getPlural(): string;

    /**
     * Undocumented function.
     */
    public function setPlural(string $plural): void;

    /**
     * Undocumented function.
     */
    public function getPluralPositionMinus(): int;

    /**
     * Undocumented function.
     */
    public function setPluralPositionMinus(int $pluralPositionMinus): void;

    /**
     * Undocumented function.
     */
    public function getPluralGenerated(): string;
}
