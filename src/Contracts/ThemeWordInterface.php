<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

interface ThemeWordInterface
{
    /**
     * @return string[]
     */
    public function getValues(): array;

    public function getWeight(): float;
}
