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
    private Accuracy $accuracy;

    public function __construct()
    {
        $this->accuracy = new Accuracy();
    }

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

                //We place every theme in an array
                array_push($Themes, $Theme);
            }
        }

        //For each word of the text
        foreach ($words as $word) {
            //For each theme
            foreach ($Themes as $theme) {
                //We retrieve every word from the theme
                $themeWords = $theme->getWords();
                //for each word in the theme
                foreach ($themeWords as $themeWord) {
                    //If the current text's word matches the current theme word

                    if ($word == $themeWord->getWordName() || $word == $themeWord->getPluralGenerated()) {
                        //return [$themeWord->getPluralGenerated()];
                        //Get the current force
                        $currentThemeForce = $theme->getForce();

                        //We add 1 to the current theme force
                        $theme->setForce($currentThemeForce + 1);
                    }
                }
            }
        }

        return $this->getThemesByAccuracy($Themes);
    }

    private function getThemesByAccuracy(array $Themes): array
    {
        //Sort the "Themes" array on the attribute force to get the strongest force at the end of the array and the weakest force at the beginning.
        usort($Themes, function ($a, $b) {
            return $a->getForce() <=> $b->getForce();
        });

        $strongestTheme = end($Themes);
        if ($strongestTheme instanceof Themes) {
            $strongestTheme = $strongestTheme->getForce();
        }

        //Eventually return the accuracy
        if ($strongestTheme >= $this->accuracy::ACCURACY_HIGH) {
            return $this->getSameForceTags($Themes, $strongestTheme);
        }

        if ($strongestTheme === $this->accuracy::ACCURACY_MEDIUM) {
            return $this->getSameForceTags($Themes, $strongestTheme);
        }

        if ($strongestTheme === $this->accuracy::ACCURACY_LOW) {
            return $this->getSameForceTags($Themes, $strongestTheme);
        }

        return [];
    }

    //To find if there is themes with the same force
    private function getSameForceTags(array $Themes, float $strongestTheme): array
    {
        $themesWithSameForce = 0;
        foreach ($Themes as $theme) {
            if ($theme->getForce() === $strongestTheme) {
                ++$themesWithSameForce;
            }
        }
        //All the Themes with the same number of words matched
        $finalArray = array_slice($Themes, -$themesWithSameForce, $themesWithSameForce, true);

        $tags = [];
        foreach ($finalArray as $Theme) {
            array_push($tags, $Theme->getThemeName());
        }

        return $tags;
    }
}
