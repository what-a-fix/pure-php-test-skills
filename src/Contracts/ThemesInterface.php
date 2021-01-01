<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text.
 */
interface ThemesInterface
{
    /**
     * Return the theme name.
     */
    public function getThemeName(): string;

    /**
     * Return the words related to the theme.
     */
    public function getWords(): array;

    /**
     * Define the Theme name
     * ex: "Vacances".
     */
    public function setThemeName(string $filename): void;

    /**
     * Set an array of words.
     */
    public function setWords(array $words): void;

    /**
     * Return an array with a theme object and the number of words it matched. ex: [Themes, 3].
     */
    public function matches(array $words): array;
}
