<?php
namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\ThemesGenerator;

class ThemesGeneratorTest extends TestCase
{
    /**
     * TextTagger class
     *
     * @var ThemesGenerator
     */
    private $themesGenerator;

    public function setUp(): void
    {
        $this->themesGenerator=new ThemesGenerator();
    }

    public function testThemeGeneration()
    {
        //ACCURACY_LOW
        $this->assertSame(['animaux','habitation','informatique'], $this->themesGenerator->generateThemes(['J\'ai','vu','un','chat','assis','un','canapé','sur','internet'],'test'));

        
        //ACCURACY_HIGH
        $this->assertSame(['informatique'], $this->themesGenerator->generateThemes(['Internet','et', 'le', 'HTML', 'sont' ,'vraiment', 'formidables', 'C\'est' ,'fou', 'comment', 'le' ,'web' ,'a' ,'révolutionné' ,'le','monde'],'test'));

        //ACCURACY_MEDIUM
        $this->assertSame(['animaux','informatique'], $this->themesGenerator->generateThemes(['Hier', 'je', 'suis', 'allé', 'au', 'parc', 'avec', 'mon', 'ordinateur', 'portable', 'ainsi', 'que', 'mon', 'chien', 'et', 'mon', 'chat'],'test'));
        

        //No keyword found
        $this->assertSame(['Impossible to find a theme, too few words in our database or sentence not accurate enough.'], $this->themesGenerator->generateThemes(['Il','est','impossible','de','voler'],'test'));
    }
}