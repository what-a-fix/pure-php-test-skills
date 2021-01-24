<?php

namespace Whatafix\TextTagger;

class TextTagger implements Contracts\TextTaggerInterface
{

    const THEMATIC_TAGS = [
        'house' => ['bathroom', 'kitchen', 'bedroom', 'toilet', 'living-room', 'tv-room', 'laudry-room'],
        'animal' => ['dog', 'mouse', 'cat', 'pig', 'horse', 'goat', 'cow'],
        'technology' => ['computer', 'television', 'phone'],
        'food' => ['apple', 'bread', 'cooking', 'snack', 'meat', 'cereals']
    ];

    /**
     * @inheritDoc
     */
    public function getTags(string $text): array
    {
        if ($text === "") {
            return [];
        }

        $sentenceWords = explode(" ", $text);
        $tags = [];
        foreach ($sentenceWords as $sentenceWord) {
            foreach (self::THEMATIC_TAGS as $tag => $thematics ) {
                foreach ($thematics as $thematicWord) {
                    if ((strcasecmp($sentenceWord, $thematicWord) == 0)) {
                        $tags[] = $tag;
                    } else {
                        continue;
                    }
                }
            }
        }
        sort($tags);
        foreach ($tags as $tag) {
            $result[] = $tag;
        }
        return $result;
    }
}
