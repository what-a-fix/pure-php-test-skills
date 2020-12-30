<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Themes;

/**
 * @internal
 */
class ThemesTest extends TestCase
{
    /**
     * Themes class.
     *
     * @var Themes
     */
    private $themes;

    public function setUp(): void
    {
        $this->themes = new Themes();
    }

    public function testGenerateDataFromXML()
    {
        //Generate the Theme from the XML file
        $generation = $this->themes->generateDataFromXML(__DIR__.'/themes/testAnimaux.xml');
        //Get the theme name after the generation
        $this->assertSame('animaux', $generation->getThemeName());

        //Verify first XML file words
        $this->assertEquals($generation->getWords()[0], 'chien');
        $this->assertEquals($generation->getWords()[1], 'chat');
        $this->assertEquals($generation->getWords()[2], 'lapin');

        //Test the setter and getter of themeName
        $generation->setThemeName('Animaux');
        $this->assertEquals($generation->getThemeName(), 'Animaux');

        //Test the setter and getter of force
        $generation->setForce(1.0);
        $this->assertEquals($generation->getForce(), 1.0);

        //$this->assertSame(['école','professeur','enseignant','craie','tableau','récréation','travail','apprendre'], $generation->getWords());
    }
}
