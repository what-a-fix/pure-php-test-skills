<?php
namespace Whatafix\TextTagger;

use DOMDocument;
use Whatafix\TextTagger\Contracts\ThemesInterface;

class Themes implements ThemesInterface
{
    private string $themeName;

    private array $words;

    /**
     * Used to compare every theme and find the one that matches the most words, 'force' will be 3 if it matches 3 words from a theme.
     */
    private float $force;

    public function __construct()
    {
        $this->words = [];
    }

    public function getThemeName():string
    {
        return $this->themeName;
    }

    public function getWords():array
    {
        return $this->words;
    }

    public function getForce():float
    {
        return $this->force;
    }

    public function setForce(float $force):void
    {
        $this->force = $force;
    }

    public function setThemeName($filename):void
    {
        $this->themeName=$filename;
    }

    public function generateDataFromXML($filename):self
    {
        $this->force = 0;
        
        $xmlDoc = new DOMDocument("1.0", "utf-8"); // Parameters here are overwritten anyway when using loadXML(), and are not really relevant
        //$testXML = file_get_contents("./themes/enseignement.xml");//themes/$filename.xml
        $xmlDoc->load($filename);  
        $tag = $xmlDoc->getElementsByTagName('theme');
        $words=$xmlDoc->getElementsByTagName('word');
       
        $this->setThemeName($tag[0]->textContent);
        //$accented_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c','è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o','ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        foreach($words as $word)
        {
            //array_push($this->words,strtr(mb_strtolower($word->nodeValue,'UTF-8'),$accented_array));
            array_push($this->words,mb_strtolower($word->nodeValue,'UTF-8'));
        }
        return $this;
    }
}