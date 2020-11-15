<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{
    /**
     * tag array.
     *
     * @var array
     */
    private $tagList;

    /**
     * nb of minimum match.
     *
     * @var int
     */
    private $minMatch;

    public function __construct(array $tagList = [])
    {
        $this->tagList = $tagList;
        $this->minMatch = 2;
    }

    /**
     * Add labels list.
     */
    public function addThemeTags(string $filePath): void
    {
        $hasExtension = preg_match('/.php$/', $filePath);
        $fullPath = $hasExtension ? $filePath : $filePath.'.php';
        if (!file_exists($fullPath)) {
            return;
        }
        $fileContent = include $fullPath;
        if (!is_array($fileContent) || empty($fileContent)) {
            return;
        }
        $tag = basename($fullPath, '.php');
        $this->tagList[$tag] = $fileContent;
    }

    /**
     * Return the tags for a specific text.
     *
     * @return string[]
     */
    public function getTags(string $text): array
    {
        $tags = [];

        foreach ($this->tagList as $tag => $values) {
            $countMatch = 0;

            foreach ($values as $value) {
                //plural management
                $isException = preg_match('/ai?l\b/', $value);
                if ($isException) {
                    $value = preg_replace('/([a-z-]+)(ai?l)\b/', '$1($2s?|aux)', $value);
                } else {
                    $value .= '[xs]?';
                }

                //hyphen/space management
                $value = preg_replace('/[- ]/', '( |-)', $value);

                if (!is_string($value)) {
                    throw new \LogicException(sprintf('$value must be a string, %s given', gettype($value)));
                }
                $regex = '/\b'.$value.'\b/iu';
                $countMatch += preg_match_all($regex, $text);
                if ($countMatch >= $this->minMatch) {
                    $tags[] = $tag;

                    break;
                }
            }
        }

        return $tags;
    }

    /**
     * Set nb of minimum match to label the string.
     *
     * @return $this
     */
    public function setMinMatch(int $minMatch): self
    {
        if ($minMatch > 0) {
            $this->minMatch = $minMatch;
        }

        return $this;
    }
}
