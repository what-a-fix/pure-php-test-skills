<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Themes;
use Whatafix\TextTagger\ThemesGenerator;

/**
 * @internal
 */
class ThemesGeneratorTest extends TestCase
{
    /**
     * TextTagger class.
     *
     * @var ThemesGenerator
     */
    private $themesGenerator;

    public function setUp(): void
    {
        $this->themesGenerator = new ThemesGenerator();
    }

    public function testThemeGeneration()
    {
        //ACCURACY_HIGH
        $high = $this->themesGenerator->generateThemes(['Internet', 'et', 'le', 'HTML', 'sont', 'vraiment', 'formidables', 'C\'est', 'fou', 'comment', 'le', 'web', 'a', 'révolutionné', 'le', 'monde'], 'test');
        $this->assertContains('informatique', $high);

        //ACCURACY_HIGH with Plural nouns
        $high = $this->themesGenerator->generateThemes(['chiens', 'chats', 'éléphants'], 'test');
        $this->assertContains('animaux', $high);

        $medium = $this->themesGenerator->generateThemes(['Hier', 'je', 'suis', 'allé', 'au', 'parc', 'avec', 'mon', 'ordinateur', 'portable', 'ainsi', 'que', 'mon', 'chien', 'et', 'mon', 'chat'], 'test');
        //ACCURACY_HIGH with Plural hemesGenerator->generateThemes(['Hier', 'je', 'suis', 'allé', 'au', 'parc', 'avec', 'mon', 'ordinateur', 'portable', 'ainsi', 'que', 'mon', 'chien', 'et', 'mon', 'chat'], 'test');
        $this->assertContains('animaux', $medium);
        $this->assertContains('informatique', $medium);

        //ACCURACY_LOW
        $low = $this->themesGenerator->generateThemes(['J\'ai', 'vu', 'un', 'chat', 'assis', 'un', 'canapé', 'sur', 'internet'], 'test');
        $this->assertContains('animaux', $low);
        $this->assertContains('habitation', $low);
        $this->assertContains('informatique', $low);

        //No keyword found
        $this->assertSame(['Impossible to find a theme, too few words in our database or sentence not accurate enough.'], $this->themesGenerator->generateThemes(['Il', 'est', 'impossible', 'de', 'voler'], 'test'));
    }

    /*
    public function testGetThemesByAccuracy()
    {
        $ThemeAnimaux=New Themes();
        $ThemeAnimaux->setThemeName('animaux');
        $ThemeAnimaux->setWords(['lapin','girafe','poulet','coq','chêvre']);
        $ThemeAnimaux->setForce(2);

        $ThemeInformatique=New Themes();
        $ThemeInformatique->setThemeName('informatique');
        $ThemeInformatique->setWords(['ordinateur','pc','téléphone','internet','clavier']);
        $ThemeInformatique->setForce(2);

        $this->assertSame('toto',$this->themesGenerator->getThemesByAccuracy([$ThemeAnimaux,$ThemeInformatique],2.0));
    }

    public function testGetSameForceTags()
    {

    }*/
}
