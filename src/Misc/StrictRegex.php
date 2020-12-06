<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Misc;

use Exception;

class StrictRegex
{
    /**
     * Same as pcre preg_replace but just with strings and never return null, throw an error on unexpected result (null).
     *
     * @throws Exception
     */
    public static function pregReplace(string $pattern, string $replacement, string $subject, int $limit = -1, int &$count = null): string
    {
        $text = preg_replace($pattern, $replacement, $subject, $limit, $count);

        if (is_null($text)) {
            throw new Exception(sprintf(
                "An error occurred during the replacement operation.\n\nOriginal text : %s\n\nPattern : %s\n\nReplacement : %s",
                $subject,
                $pattern,
                $replacement,
            ));
        }

        return $text;
    }
}
