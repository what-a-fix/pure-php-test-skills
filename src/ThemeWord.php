<?php

declare(strict_types=1);

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\ThemeWordInterface;

class ThemeWord implements ThemeWordInterface
{
    private array $values;
    private float $weight;

    public function __construct(array $values, float $weight = 1.0)
    {
        $this->values = $values;
        $this->weight = $weight;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}
