<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Contracts;

interface ThemeInterface
{
    public static function createFromXML(string $filename): ThemeInterface;

    public function getLang(): string;

    public function getTag(): string;

    /**
     * @return ThemeWordInterface[]
     */
    public function getWords(): array;
}
