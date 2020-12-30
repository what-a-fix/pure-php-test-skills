<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text.
 */
interface ThemesGeneratorInterface
{
    /**
     * Return array of themes.
     */
    public function generateThemes(array $words): array;
}
