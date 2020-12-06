<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Exception;
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
     *
     * @throws Exception
     */
    public function getTags(string $text): array
    {
        // TODO : The creation of wordsBag should be optimized
        // The creation of wordsBag is an important process. It impact performance and sim calculus
        $explodedString = preg_split('/[^\w-]+/', $text);
        if (!$explodedString) {
            return [];
        }
        $wordsBag = [];
        foreach ($explodedString as $word) {
            if (!isset($wordsBag[$word])) {
                $wordsBag[$word] = 1;
            } else {
                ++$wordsBag[$word];
            }
        }

        $tags = [];

        foreach ($this->themeSim as $themeSim) {
            if (0 == ($sim = $themeSim->sim($wordsBag))) {
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

    public function addTheme(ThemeSimInterface ...$themeSims): void
    {
        foreach ($themeSims as $themeSim) {
            if (!in_array($themeSim, $this->themeSim)) {
                $this->themeSim[] = $themeSim;
            }
        }
    }

    public function getThemes(): array
    {
        return $this->themeSim;
    }
}
