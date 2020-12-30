<?php
namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text
 */
interface ThemesGeneratorInterface
{
    /**
     * Return array of themes
     *
     * @return array
     */
    public function generateThemes(array $words): array;
}