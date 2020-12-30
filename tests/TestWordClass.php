<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Word;

/**
 * @internal
 */
class TextWordClass extends TestCase
{
    /**
     * Word class.
     *
     * @var Word
     */
    private $word;

    public function setUp(): void
    {
        $this->word = new Word();
    }

    public function testMethods()
    {
        //ex: 'patate' will return 'patates'.
        $word1 = $this->word;
        $word1->setWordName('patate');
        $word1->setPlurial('s');
        $word1->setPlurialPositionMinus(0);
        $this->assertEquals('patate', $word1->getWordName());
        $this->assertEquals('s', $word1->getPlurial());
        $this->assertEquals(0, $word1->getPlurialPositionMinus());

        $word1->getPlurialGenerated();
        $this->assertEquals('patates', $word1->getPlurialGenerated());

        //ex substr_replace('animal','ux',-1) will return 'animaux'.
        $word2 = $this->word;
        $word2->setWordName('animal');
        $word2->setPlurial('ux');
        $word2->setPlurialPositionMinus(-1);
        $this->assertEquals('animal', $word2->getWordName());
        $this->assertEquals('ux', $word2->getPlurial());
        $this->assertEquals(-1, $word2->getPlurialPositionMinus());

        $word2->getPlurialGenerated();
        $this->assertEquals('animaux', $word2->getPlurialGenerated());
    }
}
