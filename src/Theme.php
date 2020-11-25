<?php

declare(strict_types=1);

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use DOMDocument;
use Whatafix\TextTagger\Contracts\ThemeInterface;

class Theme implements ThemeInterface
{
    private string $tag;
    private string $lang;
    private array $words;

    public function __construct(string $tag, string $lang, array $words)
    {
        $this->tag = $tag;
        $this->lang = $lang;
        $this->words = $words;
    }

    public static function createFromXML(string $filename): ThemeInterface
    {
        $xml = new DOMDocument();
        $xml->load($filename);
        $tag = $xml->getElementsByTagName('tag')[0]->nodeValue;
        $lang = $xml->getElementsByTagName('lang')[0]->nodeValue;
        $words = [];
        foreach ($xml->getElementsByTagName('word') as $word) {
            $values = [];
            foreach ($word->getElementsByTagName('value') as $value) {
                $values[] = $value->nodeValue;
            }
            $weight = 1.0;
            if ($word->hasAttribute('weight')) {
                $weight = (float) $word->getAttribute('weight');
            }
            $words[] = new ThemeWord($values, $weight);
        }

        return new self($tag, $lang, $words);
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getWords(): array
    {
        return $this->words;
    }
}
