<?php

declare(strict_types=1);

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\ThemeInterface;
use Whatafix\TextTagger\Contracts\ThemeSimInterface;

class ThemeSim implements ThemeSimInterface
{
    private ThemeInterface $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function getTheme(): ThemeInterface
    {
        return $this->theme;
    }

    /**
     * This method use the extended boolean model.
     *
     * The model is defined by the function sim(operator, document)
     * Available operator are AND & OR
     * Only AND is needed in our case
     *
     * So getTags method is defined by this set of equations :
     *
     * - sim(D) = 1 - (n - w¹ - w² - w³ - ... - wⁿ) / n ; it is the simplified version when p=1
     *   where :
     *   - D is the text given in the sim method in the form of a wordBag, structured as is :
     *     keys are a therm and values are the number of times that therm occurs
     *   - wⁿ the weight of the tⁿ, where tⁿ is the n term defined by the w(tⁿ) equation
     *
     * - w(tⁿ) = tf(tⁿ) / ∑tD
     *   where :
     *   - ∑tD is the sum of therms in D
     *   - tf(tⁿ) is the number of time that therm occurs
     *
     * And perform this algorithm :
     *
     * - Set ∑tD, will refer to it as $totalOfTerms. $totalOfTerms can simply be defined with the summing of D values
     * - Calculate each wⁿ, will refer to it as $wns
     * - Calculate sim(D), will refer to it as $sim.
     *   Will perform the calculus of sim according to defined therms given by ThemeInterface passed in constructor and choose to construct the sim request only when matching element are present
     *
     * - return sim
     *
     * @see https://en.wikipedia.org/wiki/Extended_Boolean_model
     * @see https://en.wikipedia.org/wiki/Tf%E2%80%93idf
     *
     * @param array<string, int> $wordsBag
     */
    public function sim(array $wordsBag): float
    {
        $totalOfTerms = array_sum($wordsBag);
        $sumWns = 0;
        $nbMatchedWord=0;
        foreach ($this->theme->getWords() as $word) {
            $tf = 0;
            foreach ($word->getValues() as $value) {
                /* TODO : Comparison here, is done with just an equality check, but some other path can be explored in parallel, and should be implemented, example :
                          - phonetic approach => see https://www.php.net/manual/fr/function.metaphone.php and https://www.php.net/manual/fr/function.soundex.php
                          - similarity approach => see https://www.php.net/manual/fr/function.similar-text.php
                          ...
                          Maybe when this kind of equality is done, it will be good to weighting the result with an arbitrary value
                 */
                if (key_exists($value, $wordsBag)) {
                    $tf += $wordsBag[$value];
                }
            }
            if (0 !== $tf) {
                $sumWns += $tf / $totalOfTerms;
                $nbMatchedWord++;
            }
        }

        //disjonctive request(&&)  1 - (($nbMatchedWord - $sumWns) / $nbMatchedWord)
        //conjonctive request(||) $sumWns / $nbMatchedWord
        return $nbMatchedWord === 0? 0 : $sumWns / $nbMatchedWord;
    }
}
