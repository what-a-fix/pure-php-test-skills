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
     * get the Theme Force (the Force is defined by the number of words recurrences in a given text that are defined in the Theme object)
     * Ex: The theme "Vacances" contains the words "mer", "soleil", "voyage".
     * The given text: "La semaine dernière j'ai fais un voyage à la mer"
     * The Force will be 2.
     */
    public function getForce(): float;

    /**
     * Define the object force.
     */
    public function setForce(float $force): void;

    /**
     * Define the Theme name
     * ex: "Vacances".
     */
    public function setThemeName(string $filename): void;
}
