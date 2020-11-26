<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;
use Whatafix\TextTagger\Contracts\ThemeSimInterface;

class TextTagger implements TextTaggerInterface
{
    /**
     * @var ThemeSimInterface[]
     */
    private array $themeSim;

    public function __construct(ThemeSimInterface ...$themeSim)
    {
        $this->themeSim = $themeSim;
    }

    /**
     * Start by creating a wordBag from $text, formatted like expected and described in sim method of ThemeSim.
     */
    public function getTags(string $text): array
    {
        // TODO : The creation of wordsBag should be optimized
        // The creation of wordsBag is an important process. It impact performance and sim calculus
        // First replace all punctuations with space
        $text = preg_replace('#\.|\?|,|;|:|\(|\)|\[|\]#', ' ', $text); // TODO add more punctuation sign here
        // Replace any whitespace with an unique space for future split
        $text = preg_replace('#\s+#', ' ', $text);
        $explodedString = explode(' ', $text);
        $wordsBad = [];
        foreach ($explodedString as $word) {
            if (!isset($wordsBad[$word])) {
                $wordsBad[$word] = 1;
            } else {
                ++$wordsBad[$word];
            }
        }

        $tags = [];

        foreach ($this->themeSim as $themeSim) {
            if (0 == ($sim = $themeSim->sim($wordsBad))) {
                continue;
            }

            if (!isset($tags[$themeSim->getTheme()->getTag()])) {
                $tags[$themeSim->getTheme()->getTag()] = $sim;

                continue;
            }

            if ($tags[$themeSim->getTheme()->getTag()] < $sim) {
                $tags[$themeSim->getTheme()->getTag()] = $sim;
            }
        }

        return $tags;
    }
}
