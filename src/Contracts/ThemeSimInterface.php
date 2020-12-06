<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

interface ThemeSimInterface
{
    public function sim(array $wordsBag): float;

    public function getTheme(): ThemeInterface;
}
