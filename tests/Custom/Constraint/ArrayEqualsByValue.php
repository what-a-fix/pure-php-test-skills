<?php

declare(strict_types=1);

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test\Custom\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ArrayEqualsByValue extends Constraint
{
    /**
     * @var array
     */
    private $expected;

    public function __construct(array $expected)
    {
        $this->expected = $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        if (!$this->matches($other) || count($other) !== count($this->expected)) {
            if ($returnResult) {
                return false;
            }

            $this->fail($other, $description);
        }

        $isSame = empty(array_diff($other, $this->expected));

        if (!$isSame) {
            if ($returnResult) {
                return false;
            }

            $this->fail($other, $description);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return 'arrays has same values';
    }

    protected function matches($other): bool
    {
        return is_array($other);
    }
}
