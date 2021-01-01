<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
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
        //Test high related keywords (Plural words)
        $high = $this->themesGenerator->generateThemes(['chiens', 'chats', 'éléphants'], 'test');
        $this->assertContains('animaux', $high);

        //Test few related keywords
        $high = $this->themesGenerator->generateThemes(['Internet', 'et', 'le', 'HTML', 'sont', 'vraiment', 'formidables', 'C\'est', 'fou', 'comment', 'le', 'web', 'a', 'révolutionné', 'le', 'monde'], 'test');
        $this->assertContains('informatique', $high);

        //Test medium related keywords
        $medium = $this->themesGenerator->generateThemes(['Hier', 'je', 'suis', 'allé', 'au', 'parc', 'avec', 'mon', 'ordinateur', 'portable', 'ainsi', 'que', 'mon', 'chien', 'et', 'mon', 'chat'], 'test');
        $this->assertContains('animaux', $medium);
        $this->assertContains('informatique', $medium);

        //Test few related keywords
        $low = $this->themesGenerator->generateThemes(['J\'ai', 'vu', 'un', 'chat', 'assis', 'un', 'canapé', 'sur', 'internet'], 'test');
        $this->assertContains('animaux', $low);
        $this->assertContains('habitation', $low);
        $this->assertContains('informatique', $low);

        //No keyword found
        $this->assertSame([], $this->themesGenerator->generateThemes(['Il', 'est', 'impossible', 'de', 'voler'], 'test'));
    }
}
