<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\Library;

/**
 * Class TextTaggerTest.
 *
 * @internal
 */
class TextTaggerTest extends TestCase
{
    public function testTextTaggerFileExists(): void
    {
        $this->assertFileExists(
            __DIR__ . '/../src/Library.php',
            'You should have a /src/Library.php file'
        );
    }

    /**
     * @depends testTextTaggerFileExists
     */
    public function testLibraryExists(): void
    {
        require_once __DIR__ . '/../src/Library.php';
        $this->assertTrue(
            class_exists('Whatafix\TextTagger\Library'),
            'You should have a Library class'
        );
    }

    /**
     * @depends testLibraryExists
     */
    public function testGetTagsExists(): void
    {
        $atm = new Library();
        $this->assertTrue(
            method_exists($atm, 'getTags'),
            'Your Library class should have a getTags method'
        );
    }

    /**
     * @depends testGetTagsExists
     */
    public function testEmptyTextGiven(): void
    {
        $atm = new Library();
        $this->assertSame(
            [],
            $atm->getTags(''),
            'given an empty text getTags method should return an empty array'
        );
    }

    /**
     * @depends testGetTagsExists
     */
    public function testFamilyWalk(): void
    {
        $atm = new Library();
        $this->assertSame(
            [
                'family',
                'walk',
            ],
            $atm->getTags('Cette après-midi je suis allé manger une glace avec mes parents au parc. Puis nous avons fait une grande ballade.'),
            'given a text about family and walk the method should return \'family\' and \'walk\''
        );
    }

    /**
     * @depends testGetTagsExists
     */
    public function testLeakBathroom(): void
    {
        $atm = new Library();
        $this->assertSame(
            [
                'leak',
                'bathroom',
            ],
            $atm->getTags('Une fuite dans mon appartement au niveau de ma baignoire, on dirait que cela vient de la bonde.'),
            'given a text about bathroom and  the methosd should return \'family\' and \'walk\''
        );
    }

    /**
     * @depends testGetTagsExists
     */
    public function testFamilyCinema(): void
    {
        $atm = new Library();
        $this->assertSame(
            [
                'cinema',
                'family',
            ],
            $atm->getTags('Hier je suis allée au cinéma avec ma soeur, c\'était un beau film'),
            'given a text about family and cinema the method should return \'family\' and \'cinema\''
        );
    }
}
