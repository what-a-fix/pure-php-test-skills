<?php

declare(strict_types=1);

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;
use Whatafix\TextTagger\Contracts\ThemeInterface;

class ThemeTagger implements TextTaggerInterface
{
    private ThemeInterface $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
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
     * - sim(D) = 1 - (w¹, w², w³, ..., wⁿ) / n ; it is the simplified version when p=1
     *   where :
     *   - D is the text given in the getTagsMethod
     *   - wⁿ the weight of the tⁿ, where tⁿ is the n term defined by the w(tⁿ) equation
     *
     * - w(tⁿ) = tf(tⁿ) / ∑tD
     *   where :
     *   - ∑tD is the sum of therms in D
     *   - tf(tⁿ) is the number of time that therm occurs
     *
     * And perform this algorithm :
     *
     * - Split text in an array of therms, will refer to it as $therms where :
     *   $therms keys are the therms and $therms values are the number of times that therm occurs
     * - Set ∑tD, will refer to it as $totalOfTerms. $totalOfTerms can simply be defined with the summing of $therms values
     * - Calculate sim(D), will refer to it as $sim.
     *   Will perform the calculus of sim according to defined therms given by ThemeInterface passed in constructor
     *
     * - if $sim equal zero, then we can return an empty array
     * - else we can return an array, containing one key => value pair, containing for :
     *   - key : the tag defined in ThemeInterface
     *   - value : the $sim value
     *
     * @see https://en.wikipedia.org/wiki/Extended_Boolean_model
     * @see https://en.wikipedia.org/wiki/Tf%E2%80%93idf
     */
    public function getTags(string $text): array
    {
        // TODO: Implement getTags() method.
    }
}
