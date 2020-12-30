<?php


namespace Whatafix\TextTagger\Contracts;

/**
 * This is the main interface to implement that return tags for a specific text
 */
interface TextTaggerInterface
{
    /**
     * Return the tags for a specific text
     *
     * @param string $text
     * @return string[]
     */
    public function getTags(string $text): array;
}