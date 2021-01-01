<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use DirectoryIterator;
use Whatafix\TextTagger\Contracts\ThemesGeneratorInterface;

class ThemesGenerator implements ThemesGeneratorInterface
{
    /**
     * Generate theme(s) for a given list of words.
     */
    public function generateThemes(array $words, string $env = 'prod'): array
    {
        $Themes = [];
        //Change path for tests
        if ('prod' === $env) {
            $path = __DIR__.'/themes/';
        } else {
            $path = './tests/themes/';
        }

        //Finds every file in the directory themes.
        foreach (new DirectoryIterator($path) as $file) {
            if ($file->isFile()) {
                $Theme = new Themes();

                //We generate the object with the data filled in the XML file.
                $Theme->generateDataFromXML($path.$file->getFilename());

                $Theme = $Theme->matches($words);

                //We place every theme in an array
                array_push($Themes, $Theme);
            }
        }

        return $this->getMostMatchesThemes($Themes);
    }

    private function getMostMatchesThemes(array $Themes): array
    {
        //Sort the "Themes" array on the attribute force to get the strongest force at the end of the array and the weakest force at the beginning.
        usort($Themes, function ($a, $b) {
            return $a[1] <=> $b[1];
        });

        $strongestTheme = end($Themes);
        if ($strongestTheme[0] instanceof Themes) {
            $strongestTheme = $strongestTheme[1];
        }

        if ($strongestTheme > 0) {
            return $this->getSameForceTags($Themes, $strongestTheme);
        }

        return [];
    }

    //To find if there is themes with the same force
    private function getSameForceTags(array $Themes, int $strongestTheme): array
    {
        $themesWithSameForce = 0;
        foreach ($Themes as $theme) {
            if ($theme[1] === $strongestTheme) {
                ++$themesWithSameForce;
            }
        }

        //All the Themes with the same number of words matched
        $finalArray = array_slice($Themes, -$themesWithSameForce, $themesWithSameForce, true);

        $tags = [];
        foreach ($finalArray as $Theme) {
            array_push($tags, $Theme[0]->getThemeName());
        }

        return $tags;
    }
}
