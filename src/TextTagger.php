<?php

namespace Whatafix\TextTagger;

use Whatafix\TextTagger\Contracts\TextTaggerInterface;

class TextTagger implements TextTaggerInterface
{

    /**
     * tag array
     * @var array
     */
    private $tagList;

    public function __construct(array $tagList = [])
    {
        $this->tagList = $tagList;
    }

    /**
     * Get file content by filename in src/label/
     * @param string $fileName
     */
    public function fetchTagList(string $fileName): void
    {
        $this->tagList = include __DIR__ . '/label/' . $fileName;
    }

    /**
     * Return the tags for a specific text
     * @param string $text
     * @return string[]
     */
    public function getTags(string $text): array
    {
        $tags = [];

        foreach ( $this->tagList as $tag=>$values) {
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

                $regex = '/\b'.$value.'\b/iu';
                $countMatch += preg_match_all($regex, $text);
                if ($countMatch>1) {
                    $tags[] = $tag;
                    break;
                }
            }
        }
        return $tags;
    }
}
