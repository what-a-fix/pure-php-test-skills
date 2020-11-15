<?php

/**
 * @author Florian Rowehy
 * @link https://github.com/Florian-Rowehy
 */

namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text.
 */
interface TextTaggerInterface
{
    /**
     * Return the tags for a specific text.
     *
     * @return string[]
     */
    public function getTags(string $text): array;
}
