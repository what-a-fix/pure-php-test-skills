<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
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
