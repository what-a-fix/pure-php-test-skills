<?php

/**
 * @author Dev applicant
 * @link https://github.com/what-a-fix/pure-php-test-skills
 */

namespace Whatafix\TextTagger\Test;

use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;

/**
 * @internal
 */
class TextTaggerTest extends TestCase
{
    /**
     * TextTagger class.
     *
     * @var TextTagger
     */
    private $textTagger;

    public function setUp(): void
    {
        $this->textTagger = new TextTagger();
    }

    public function testTextTaggerResponse()
    {
        //Test few related keywords
        $low = $this->textTagger->getTags('J\'ai vu un chat assis sur un canapé sur internet', 'test');
        $this->assertContains('animaux', $low);
        $this->assertContains('habitation', $low);
        $this->assertContains('informatique', $low);

        //Test medium related keywords
        $medium = $this->textTagger->getTags('Hier je suis allé au parc avec mon ordinateur portable ainsi que mon chien et mon chat', 'test');
        $this->assertContains('animaux', $medium);
        $this->assertContains('informatique', $medium);

        //Test high related keywords
        $high = $this->textTagger->getTags('Internet et le HTML sont vraiment formidables! C\'est fou comment le web a révolutionné le monde.', 'test');
        $this->assertContains('informatique', $high);

        //No keyword found
        $this->assertSame([], $this->textTagger->getTags('Il est impossible de voler.', 'test'));
    }
}
