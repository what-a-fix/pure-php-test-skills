<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Themes;
use Whatafix\TextTagger\Word;

/**
 * @internal
 */
class ThemeTest extends TestCase
{
    /**
     * Theme class.
     *
     * @var Theme
     */
    private $theme;

    public function setUp(): void
    {
        $this->theme = new Themes();
    }

    public function testMethods()
    {
        //ex: 'patate' will return 'patates'.
        $theme = $this->theme;
        $theme->setThemeName('animaux');

        $word1 = new Word();
        $word1->setWordName('patate');
        $word1->setPlural('s');
        $word1->setPluralPositionMinus(0);
        $word2 = new Word();
        $word2->setWordName('patate');
        $word2->setPlural('s');
        $word2->setPluralPositionMinus(0);

        $theme->setWords([$word1, $word2]);

        $this->assertEquals('animaux', $theme->getThemeName());
        $this->assertCount(2, $theme->getWords());

        //matches() method, 2 words are matching from 'Animaux' XML file
        $theme->generateDataFromXML(__DIR__.'/themes/testAnimaux.xml');
        $this->assertSame([$theme, 2], $theme->matches(['chiens', 'chats']));
    }

    public function testGenerateDataFromXML()
    {
        //Generate the Theme from the XML file
        $generation = $this->theme->generateDataFromXML(__DIR__.'/themes/testAnimaux.xml');
        //Get the theme name after the generation

        $this->assertSame('chien', $generation->getWords()[0]->getWordName());
        $this->assertSame('s', $generation->getWords()[0]->getPlural());
        $this->assertSame(0, $generation->getWords()[0]->getPluralPositionMinus());

        $this->assertSame('animaux', $generation->getThemeName());

        //Verify first XML file words
        $this->assertEquals('chien', $generation->getWords()[0]->getWordName());
        $this->assertEquals('chat', $generation->getWords()[1]->getWordName());
        $this->assertEquals('lapin', $generation->getWords()[2]->getWordName());

        //Test the setter and getter of themeName
        $generation->setThemeName('Animaux');
        $this->assertEquals($generation->getThemeName(), 'Animaux');

        //Test the setter and getter for words
        $generation->setWords(['lapin', 'girafe', 'poulet', 'coq', 'chêvre']);
        $this->assertEquals($generation->getWords(), ['lapin', 'girafe', 'poulet', 'coq', 'chêvre']);

        //$this->assertSame(['école','professeur','enseignant','craie','tableau','récréation','travail','apprendre'], $generation->getWords());
    }
}
