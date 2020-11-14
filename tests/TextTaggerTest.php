<?php
namespace Whatafix\Test;
use PHPUnit\Framework\TestCase;
use Whatafix\TextTagger\TextTagger;
use Whatafix\TextTagger\TextTaggerV1;

class TextTaggerTest extends TestCase
{
    private $textTagger;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->textTagger = new TextTagger();
    }

    public function testInstance(): void
    {
        $class = get_class($this->textTagger);
        $this->assertEquals("Whatafix\TextTagger\TextTagger", $class);
    }

    public function testTextTaggerGetTagsBasic(): void
    {
        $str = "Cette après-midi je suis allé manger une glace avec mes parents au parc. 
        Puis nous avons fait une grande ballade.";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk"], $tags)));
    }

    public function testNoDuplicateTags(): void
    {
        $str = "fils fille parent neveu";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "faute grammaire math livre";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "parent";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "faute grammaire";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
    }

    public function testIgnoreCase(): void
    {
        $str = "Ballade lavaBO PARENT faute";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }

    public function testIgnoresPunctuation(): void
    {
        $str = "././/devoir-!::;[enfant},;ballade-;~~#lavabo{]='";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }

    //detect exact word or should accept radical matching?

    /*
    public function testIgnoresNumbers(): void
    {
        $str = "1345classe145465enfant15489ballade464879lavabo";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty(array_diff(["family", "walk", "bathroom", "school"], $tags)));
    }*/

    public function testDetectPlural(): void
    {
        $str = "parents";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["family"]==$tags);
        $str = "neveux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["family"]==$tags);
        $str = "oraux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
        $str = "travaux";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
        $str = "rails";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["train"]==$tags);
    }

    public function testMultibyteString(): void
    {
        $str = "élève";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
        $str = "leçon";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(["school"]==$tags);
    }

    public function testDetectMultipleWords(): void
    {
        $str = "porte-serviettes";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
        $str = "porte serviettes";
        $tags = $this->textTagger->getTags($str);
        $this->assertEquals(1,sizeof($tags));
    }

    public function testReturnEmptyArray(): void
    {
        $str = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Praesent eu sem at justo dapibus dignissim in in nunc. 
        Morbi et tortor nec metus finibus placerat. 
        Morbi ornare eget lectus non ultrices. 
        Curabitur risus augue, aliquet faucibus magna eu, porttitor rhoncus velit. 
        Donec finibus, tortor eu varius maximus, leo orci dignissim dolor, eu commodo nisl quam id orci. 
        Suspendisse vulputate urna quis metus euismod sagittis. Curabitur vel euismod diam. 
        Integer id justo tellus. Mauris dictum, sapien quis bibendum interdum, nisl leo tristique tellus, id posuere tortor ligula ut eros. 
        Mauris commodo fermentum consequat. 
        Nunc bibendum vestibulum volutpat. 
        Ut quis maximus purus. 
        Curabitur scelerisque condimentum fermentum. 
        In porttitor ligula ac dolor consequat egestas. 
        Duis sed justo scelerisque, malesuada erat ut, porttitor mi. 
        Duis molestie nibh at molestie fringilla.";
        $tags = $this->textTagger->getTags($str);
        $this->assertTrue(empty($tags));
    }

    public function testHugeFile(): void
    {
        $start = time();
        $str = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse quis interdum elit. Phasellus laoreet consequat purus, non pulvinar orci sagittis eget. Nullam posuere est a mauris pretium, aliquam consectetur lectus volutpat. Nunc quis justo porta, convallis dolor eget, congue nisi. Aliquam sodales purus id auctor tincidunt. Vestibulum pretium lectus ac augue finibus placerat. Phasellus cursus malesuada augue a mollis. Fusce elementum risus nec imperdiet tempus. Vestibulum aliquam sapien aliquet leo tempus, sed mollis magna volutpat. Vivamus ultrices arcu vitae augue fermentum mattis.
        Sed vel vulputate ex. Donec vel dignissim metus. Nunc mollis vel ex vitae eleifend. Vestibulum sed hendrerit nisi, nec laoreet diam. Nullam sodales erat at ligula fringilla tincidunt. Maecenas sollicitudin pellentesque erat sit amet vehicula. Quisque vitae vehicula metus. Nunc sagittis sit amet ex in varius. Nullam congue erat sed quam ornare, sed ultrices ex molestie. Suspendisse viverra sit amet odio ultrices iaculis. Quisque feugiat venenatis mi, eu vulputate metus.
        Donec neque justo, ultricies ut mollis vel, commodo non lectus. Vestibulum in tincidunt urna. Proin vestibulum sed turpis nec posuere. Duis non sapien quis nisl vehicula tincidunt non sit amet mi. Aenean sollicitudin ultricies nulla, sed dictum libero egestas a. Morbi faucibus urna a purus semper, nec venenatis neque accumsan. Vestibulum in ultrices neque, quis sodales felis. Suspendisse eleifend magna ante, ac varius nisl fringilla non. Mauris molestie orci non tristique sollicitudin.
        Etiam mauris erat, bibendum sed vehicula sit amet, tristique sit amet purus. Nam aliquet imperdiet pellentesque. Aenean odio metus, sagittis a massa eu, lacinia facilisis justo. Vestibulum velit leo, mollis ac est efficitur, scelerisque convallis justo. Vivamus eu metus volutpat, pretium purus ut, bibendum orci. Vivamus commodo volutpat porttitor. In ut felis condimentum, placerat sapien in, maximus arcu. Donec rutrum ultricies convallis. Curabitur feugiat sollicitudin nisl, nec luctus nulla dictum sit amet. Nam bibendum id risus at sollicitudin.
        Pellentesque justo odio, efficitur rhoncus velit in, egestas posuere leo. Cras augue tellus, faucibus sit amet convallis ultrices, scelerisque at ipsum. Pellentesque id tortor mauris. Nulla ultrices, urna non dignissim accumsan, risus diam tristique lorem, ac pellentesque lacus turpis id sem. Morbi ultricies tellus vitae risus auctor scelerisque. Duis purus turpis, aliquam quis ex eget, posuere aliquam nisi. Integer varius suscipit imperdiet. Nulla congue ipsum at hendrerit viverra.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec bibendum nisi sit amet mi elementum mollis eget et purus. Praesent elementum risus at urna commodo tempus. Ut hendrerit ultricies orci, id mollis libero gravida fringilla. Vivamus ornare nec neque ac aliquet. Nunc aliquam, nulla et cursus ultrices, mauris dolor venenatis quam, eget facilisis risus lectus a erat. Donec malesuada imperdiet dui vel laoreet. Vivamus ipsum arcu, interdum posuere lacinia mattis, commodo vel ipsum.
        Nulla facilisi. Sed nisi ligula, vehicula a quam at, blandit rhoncus massa. Nulla tempor viverra congue. Suspendisse nec euismod sapien. Donec sagittis nibh nisl, et elementum justo eleifend lobortis. Nam interdum congue risus, id tempus ex accumsan a. Phasellus porttitor laoreet ornare. Ut quam urna, tincidunt eu enim et, vestibulum aliquet odio. Etiam id auctor tellus, vel euismod odio.
        Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis convallis commodo magna sit amet accumsan. Etiam vel elementum dui, vel ultricies urna. Curabitur hendrerit eros eget nisi accumsan ullamcorper. Etiam sed luctus ex. Quisque varius dictum fermentum. Sed elementum justo leo, sit amet euismod mi semper pretium. Phasellus varius rutrum dolor, at dapibus erat lacinia quis.
        Nullam dignissim ipsum egestas lacus vulputate rutrum. Mauris quis magna semper lorem aliquet suscipit mollis malesuada lorem. Integer suscipit tristique purus, at tempor dui condimentum quis. Vestibulum metus mauris, consectetur ac lectus sit amet, maximus fermentum nisi. Sed vulputate justo ut convallis egestas. Curabitur fringilla fringilla porta. Praesent et viverra neque, sed tempor nibh. Integer volutpat nibh et est venenatis consequat. Phasellus pretium commodo ligula. Duis nec ipsum nec lorem blandit blandit eu eu libero. Integer auctor quam non erat molestie maximus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas sed semper lorem, vel interdum sapien. Donec a fringilla neque, eget porttitor arcu.
        Integer interdum varius orci, nec molestie nisl. Aliquam ac tincidunt ligula, id mollis leo. Etiam dapibus dolor eget arcu laoreet, nec ullamcorper arcu pretium. Phasellus commodo scelerisque laoreet. Ut ac mauris at magna dignissim vulputate. Sed venenatis lorem eget nulla lacinia, at elementum magna efficitur. Ut quis neque urna. Sed elementum ex et fringilla interdum. Duis ac risus mauris. Pellentesque quis velit elit. Nam convallis vehicula libero vel eleifend.
        Nam sit amet ante quis augue consequat tempor. Praesent maximus lacinia nisl, a gravida dui finibus non. Fusce hendrerit volutpat rhoncus. Ut ut molestie leo. Quisque ac turpis eget ex vestibulum molestie. Quisque vitae turpis vitae eros placerat lacinia. Vestibulum ut ipsum vulputate, pharetra lacus id, scelerisque sapien. Nullam dapibus maximus aliquam. Sed tristique pellentesque maximus. Nunc eget ipsum malesuada, condimentum orci sed, iaculis odio. Pellentesque aliquam eros ac eros fringilla eleifend sit amet quis turpis. Pellentesque vitae nunc aliquam, dignissim ex ac, molestie ligula. Sed sem mi, viverra a neque et, dictum molestie eros. Praesent commodo pulvinar orci, a feugiat leo euismod vel. Mauris at enim vehicula ante commodo congue sit amet quis ante. In non massa risus.
        Aliquam sit amet purus purus. Curabitur elementum diam vitae neque laoreet dignissim. Proin imperdiet nisl ac dui feugiat cursus. Fusce fringilla lectus id arcu lacinia luctus. Cras libero risus, posuere ut cursus vel, accumsan id nulla. Pellentesque tempor enim at lorem luctus, at egestas purus imperdiet. Ut suscipit est vel tempor tempor.
        Mauris a magna auctor, facilisis lectus quis, feugiat odio. Vivamus elementum sit amet mi et auctor. In ullamcorper suscipit ex quis rutrum. Suspendisse a tellus odio. Aliquam ex purus, fringilla sed velit tempus, vestibulum sagittis sapien. Nunc a nibh faucibus, accumsan lectus at, pretium eros. Quisque at lobortis erat, at porttitor nisi. Suspendisse venenatis varius blandit. Ut porta malesuada dapibus. Duis convallis molestie eleifend. Ut bibendum, libero at lacinia ultrices, quam libero facilisis neque, vel dictum lectus tortor et nisi.
        Quisque vitae mi blandit erat iaculis imperdiet. Duis sit amet vulputate felis. Sed laoreet velit felis, et tincidunt ex posuere ac. In facilisis ligula elit, vel eleifend odio porttitor laoreet. Nullam efficitur ligula massa, suscipit volutpat diam posuere nec. Nulla vel lacus egestas, iaculis neque ut, vehicula mi. Pellentesque non felis malesuada, hendrerit tellus et, dapibus orci. Nulla magna augue, commodo sit amet rutrum sit amet, fringilla id sem. Pellentesque purus turpis, volutpat quis neque ut, fringilla consequat elit.
        Aenean sit amet magna laoreet magna aliquet blandit. Quisque ligula risus, sagittis at porttitor sit amet, commodo nec ligula. Integer sed tempor ex. Nullam in nisi ut tellus iaculis semper. Morbi ut efficitur arcu, eu porta turpis. Vestibulum sit amet risus massa. In sit amet mi quis lectus cursus rutrum. Duis non lobortis est.
        Maecenas volutpat iaculis enim, eget suscipit quam semper a. Etiam posuere lobortis vestibulum. Integer id orci sapien. Phasellus lobortis pellentesque metus, sit amet ultricies mauris cursus non. Nulla fermentum, ante quis aliquet blandit, lectus est imperdiet quam, in pellentesque lacus nulla sed sapien. Integer sed auctor velit. Proin luctus sed quam et bibendum. Mauris at imperdiet turpis. Praesent et sem vel tellus viverra porta. Vivamus aliquam imperdiet lobortis.
        In dictum hendrerit velit, ornare posuere dolor sodales ut. Phasellus accumsan id augue quis fringilla. Sed at est nulla. Donec at interdum neque, non lacinia eros. Nullam tristique nisl a erat eleifend, congue euismod purus semper. Vestibulum et sapien magna. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In arcu turpis, laoreet nec dapibus id, faucibus quis ante. Proin quis pretium nisi, ut luctus est. Curabitur sit amet velit at tellus laoreet laoreet sed sit amet lorem. Integer eu gravida enim, eu bibendum orci. Nullam eu ligula lorem. Sed a orci vel lorem congue feugiat sed at nunc. Ut non tellus tempus, fermentum ante tristique, molestie ligula. Ut posuere efficitur iaculis. Nulla auctor quam mauris, sed facilisis mauris vehicula venenatis.
        Sed consequat quam ipsum, nec mattis lectus malesuada non. Aliquam facilisis lectus in arcu gravida, ornare tristique tortor aliquet. Nullam nec pretium diam, nec efficitur nisl. Suspendisse suscipit lacinia imperdiet. Aenean rutrum convallis scelerisque. Nulla iaculis non arcu in convallis. Aenean dui urna, varius eu urna accumsan, finibus fringilla ex. Aenean et ex quis nunc blandit volutpat sed a dui. Nam tristique tincidunt tincidunt. Aenean vel velit quis nunc rutrum malesuada. Vivamus finibus sed enim at faucibus. Quisque nunc mi, varius at ipsum vel, accumsan iaculis enim.
        Pellentesque sollicitudin, diam vel fringilla cursus, dolor orci porta turpis, ullamcorper mollis turpis orci non mauris. Aliquam in ligula quis mi efficitur imperdiet quis quis augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas quis purus id libero euismod fringilla id quis magna. Morbi cursus interdum augue. Etiam egestas nibh non lectus luctus, quis elementum massa iaculis. Aliquam ultrices ut urna nec sagittis. Aliquam finibus lectus sed metus venenatis sollicitudin. Integer mattis urna vitae viverra feugiat. Vestibulum egestas lacus ac nulla dapibus egestas. Etiam placerat tellus euismod tellus venenatis lacinia.
        Sed mi sapien, fringilla at metus vel, pretium ornare leo. Vestibulum dictum ante at odio commodo, in vulputate elit consequat. Maecenas nibh ante, mollis ut euismod nec, lacinia eu arcu. Sed pulvinar quis tellus in pulvinar. Integer efficitur iaculis massa in imperdiet. In hac habitasse platea dictumst. Curabitur eu libero mauris. Vivamus ac facilisis sem. Aliquam ac varius diam. Curabitur vel mattis ligula, eget gravida sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam eu elementum tortor. Proin eget vestibulum magna, non porttitor metus. Mauris est odio, lacinia vitae faucibus et, laoreet non arcu. Nulla rutrum leo vel velit iaculis ultrices. Nullam bibendum fermentum augue, eget lacinia ante egestas at.
        Suspendisse urna velit, congue in blandit ac, elementum ac velit. Phasellus placerat mauris vel dolor posuere sodales. Pellentesque in est ut sem ultrices posuere mattis nec ipsum. Ut semper quam dolor. Nunc rutrum condimentum dui, quis faucibus nisi molestie eget. Aenean at purus eu nisi pretium porta quis non ante. Ut et aliquam turpis, quis egestas mauris. Proin metus lacus, sollicitudin ut bibendum ac, hendrerit vel diam. Donec eget dapibus tellus.
        
        Morbi quis tortor auctor, pellentesque nulla et, convallis elit. Nam tincidunt suscipit mi vitae tempus. Etiam quis commodo tellus. Sed vel ornare mauris. Nunc viverra dictum ante, nec vulputate arcu sagittis in. Sed auctor interdum erat, quis porttitor leo. Suspendisse consectetur pretium nibh non commodo. Fusce iaculis ultrices neque, sit amet molestie orci mollis eget. Nam nec malesuada neque. Praesent placerat id felis at luctus. Integer molestie at velit nec fringilla. Nullam eu mauris euismod, lacinia dolor quis, ullamcorper turpis. Vestibulum eget ullamcorper tortor, quis luctus ex. Donec eleifend nulla ac odio mollis, ut luctus enim pharetra. Nulla dapibus turpis sit amet augue finibus feugiat.
        Aliquam varius, eros eget rhoncus condimentum, ante tortor mollis risus, ac dapibus erat urna vitae sapien. Phasellus placerat orci dapibus neque egestas pellentesque. Proin porta at arcu mollis accumsan. Aliquam pretium ullamcorper dapibus. Mauris eu massa eget sem egestas euismod. Proin vitae risus ac magna vehicula ornare. Duis pretium viverra ex, eget gravida sapien vehicula sit amet. Sed porta ultricies lectus, in venenatis enim venenatis in. Nam in tellus id massa vehicula venenatis id nec mi. Suspendisse potenti. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque pharetra urna vestibulum euismod eleifend.
        Nulla facilisi. Integer malesuada purus sed est luctus, et facilisis dui faucibus. Ut vestibulum nisl metus, in vestibulum ipsum pellentesque in. Pellentesque et nulla tincidunt, congue tortor eget, interdum ante. Etiam posuere id lectus at egestas. Vestibulum a interdum lectus. Fusce dignissim pharetra lectus sit amet sollicitudin. Curabitur non est ornare, vulputate enim vel, rhoncus urna. Integer quis purus vel nisi tincidunt posuere. Morbi laoreet justo et molestie sodales. Nulla sit amet metus dictum, semper massa sed, ornare massa.
        Duis aliquet bibendum commodo. Morbi vitae velit lorem. Donec iaculis massa at quam interdum lobortis. In pulvinar nisl lectus, et ultrices libero accumsan ac. Morbi vulputate enim sit amet nunc dignissim aliquam. Duis convallis mollis nisl, eu fringilla est scelerisque in. Aliquam eget pretium elit. Donec vitae tortor sit amet nisi finibus luctus. Aliquam tincidunt molestie urna vitae lobortis. Praesent vitae blandit nulla, ac venenatis odio.
        Sed feugiat sagittis felis a maximus. Suspendisse eu massa ut dui facilisis laoreet at a velit. Aenean tempor sapien vel sem lacinia interdum. Donec rhoncus mollis mi at vulputate. Aenean eget pretium tellus. Maecenas et pellentesque odio. Etiam vel lectus ut ex aliquet mollis. Duis rhoncus arcu eget molestie egestas. Pellentesque eleifend erat eget pharetra feugiat. Integer vel venenatis dolor. Praesent ullamcorper posuere blandit. Pellentesque blandit lectus suscipit enim lacinia luctus. Etiam dignissim enim vel tortor finibus elementum. Suspendisse consequat nisl non condimentum iaculis. Phasellus at ipsum aliquam, porttitor ex quis, convallis felis. Fusce rutrum scelerisque vestibulum.
        Vestibulum scelerisque tellus in ipsum dignissim maximus. Donec nec bibendum mi. Nulla eu diam est. Sed consequat enim lorem, quis elementum felis commodo scelerisque. Phasellus dolor ex, eleifend et arcu iaculis, tristique interdum velit. Vivamus in venenatis orci. In feugiat posuere purus et mattis. Fusce et scelerisque enim. Vestibulum lobortis aliquet metus eget faucibus.
        Sed commodo, ipsum id vestibulum tristique, massa nunc luctus erat, vitae condimentum metus ex tristique nisl. Aliquam pretium turpis eget dui posuere, eget molestie magna sollicitudin. Duis dignissim pulvinar maximus. Sed eu nisl ex. Integer turpis justo, mollis eu lacus at, mollis vehicula tellus. Pellentesque eget mauris ipsum. Sed non convallis arcu, ut convallis urna. Proin sed laoreet orci, eget feugiat purus. Integer quis sodales nisi. Integer in nisl bibendum, accumsan lorem sed, placerat nulla. Nulla blandit erat id magna scelerisque congue.
        
        Aenean vulputate gravida ullamcorper. Maecenas eros ipsum, porttitor et metus at, tincidunt faucibus enim. Aliquam erat volutpat. Pellentesque in quam ut leo feugiat convallis vitae nec lacus. Donec quis facilisis enim. Nam quam velit, porta non ultricies ac, convallis rhoncus leo. Quisque ullamcorper sapien in vulputate vulputate. Etiam faucibus quam at lorem malesuada, vel porttitor libero efficitur.
        Aenean tempus sollicitudin leo, eu scelerisque dolor volutpat nec. Sed vitae fermentum eros. Fusce mollis, elit vitae eleifend molestie, felis tellus mattis nulla, et luctus nibh velit sed justo. Integer in mollis risus. Pellentesque egestas egestas sem, ut accumsan erat dictum ac. Nullam vehicula consequat cursus. Ut id pellentesque eros, at accumsan nisi. Vestibulum ornare mattis lorem, id fermentum lacus. Duis lobortis rhoncus augue eu molestie. Aliquam sem orci, consectetur non ultricies sit amet, pellentesque sed dui. Quisque in blandit tortor. Nullam fringilla vitae tortor in imperdiet. Sed magna leo, condimentum sit amet rutrum quis, venenatis quis leo. Fusce venenatis pretium magna sit amet sodales. Suspendisse odio justo, suscipit quis eleifend ut, blandit sed sem. Maecenas luctus velit sit amet orci lobortis, ac dictum quam suscipit.
        Maecenas lectus justo, hendrerit nec bibendum ac, rutrum ac quam. Vestibulum eu ligula vitae risus accumsan dictum vel non ipsum. Nullam risus nulla, sagittis pellentesque libero at, pharetra hendrerit felis. Phasellus non felis in sem ornare tincidunt. Pellentesque et urna sapien. Proin nec aliquam ligula, eget pulvinar lorem. Duis dapibus dolor ac euismod faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin ac nulla eget mi ullamcorper pretium quis et nisi.
        Pellentesque consequat sollicitudin metus, in aliquet velit tempus ut. Nulla nunc dui, blandit sit amet blandit id, aliquet in ante. Etiam elementum, mauris non suscipit laoreet, tellus neque bibendum neque, quis suscipit sem lacus sit amet lectus. Duis porta posuere libero, id blandit lorem maximus nec. Maecenas volutpat enim nec libero venenatis finibus. Sed consequat, mi at dignissim vestibulum, metus orci pulvinar urna, nec tempus nulla elit eu metus. Suspendisse non est in magna pellentesque mattis at eget elit.
        Etiam pharetra orci nec dolor malesuada, a interdum magna semper. Proin vel libero sapien. Integer ac nisi in elit condimentum tincidunt. Morbi molestie dapibus lobortis. Nullam ipsum urna, pretium id imperdiet in, volutpat at arcu. Maecenas at ligula lorem. In in nunc in ligula auctor iaculis eu non purus. Sed maximus hendrerit diam, in tincidunt mauris pharetra at. Integer vel placerat erat. Nam id sollicitudin arcu. Praesent blandit enim in iaculis tempor. Suspendisse id magna eu velit posuere suscipit. Ut vestibulum, ante ut hendrerit convallis, nibh turpis viverra diam, at fringilla velit metus eu mi. Nam ligula odio, vehicula a lectus vel, vehicula viverra dui. Donec quis efficitur diam, nec venenatis lorem.
        Quisque placerat pharetra risus nec convallis. Nunc et orci scelerisque, sollicitudin felis ac, posuere dui. Duis ornare odio ac felis dignissim, non pellentesque metus vulputate. Nam a eros at ipsum rhoncus hendrerit. Duis volutpat leo eu nunc pellentesque, non suscipit ipsum fermentum. Curabitur volutpat pharetra porta. Donec id felis commodo, consectetur elit at, varius quam. Quisque varius enim quis velit pretium porta. Quisque porttitor at purus vitae commodo. Curabitur ac nulla dapibus, convallis orci eget, gravida enim. In libero eros, rhoncus a ante porttitor, ornare blandit lectus. Nullam eleifend erat ante, a iaculis massa semper vel. Nunc cursus eget quam non posuere. Nam at fringilla augue. Sed ac consectetur ipsum. Aenean varius risus eu tellus imperdiet, non pretium elit porta.
        Etiam a augue dolor. Phasellus malesuada, massa quis volutpat efficitur, lorem felis lobortis nulla, eget lacinia erat diam eget lectus. Vivamus lectus lorem, rhoncus efficitur diam nec, lacinia viverra justo. Maecenas mollis interdum nulla. Morbi molestie faucibus velit, id commodo ante tempus et. Curabitur vitae turpis et mauris iaculis cursus vel elementum nibh. Maecenas semper feugiat erat eu semper. Aliquam luctus sagittis tincidunt. Quisque vitae neque fermentum, lacinia dui sed, ultricies sem.
        Nullam rhoncus nibh arcu, a tempor est finibus in. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi ut elementum nisl. Nulla at pellentesque velit. Proin sodales odio at arcu mattis molestie. Sed a leo ac ipsum porta tincidunt eget sed eros. Vivamus eu neque eu metus porta pulvinar. Suspendisse ut mauris sed ligula elementum commodo. Sed volutpat convallis erat, sit amet convallis orci accumsan vel. Aliquam posuere metus ac nisi iaculis, sed gravida leo malesuada. Morbi consequat elementum eros. Integer diam arcu, imperdiet in odio vel, laoreet aliquam diam. Aliquam porttitor vel sapien maximus imperdiet. Praesent iaculis vehicula tincidunt. Maecenas non sollicitudin lectus.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi lacinia massa at interdum maximus. In tempus, turpis sit amet dapibus rutrum, massa sem luctus augue, in pulvinar nibh nunc et dui. Maecenas suscipit a nisi quis egestas. Praesent aliquam odio ut sodales luctus. Mauris sed massa nec nunc tincidunt feugiat. Sed a purus arcu. Cras in mauris ante. Curabitur non semper elit. Nullam orci sapien, dapibus id augue dictum, rhoncus consectetur magna. Phasellus rhoncus varius lacinia.
        Aliquam varius, massa a elementum pellentesque, mauris justo tempor enim, sit amet porttitor ipsum lorem ut urna. Nulla a magna sed dolor imperdiet condimentum. Vivamus fermentum massa id nulla sagittis, ut ornare sem fringilla. Mauris efficitur neque nibh. Aenean ut convallis arcu, eget hendrerit arcu. Curabitur feugiat diam a sollicitudin eleifend. Praesent odio ligula, consectetur et ultricies sit amet, vulputate pellentesque urna.
        Suspendisse posuere tristique cursus. Nullam ut orci a nulla posuere efficitur at sit amet velit. Integer finibus vulputate mi. Praesent ipsum magna, convallis at fringilla nec, convallis vel diam. Morbi at purus a nisi gravida vehicula sit amet vehicula tortor. Sed ultrices augue id tortor dapibus pharetra. Donec quis elementum justo. In imperdiet tincidunt libero vel sollicitudin. Cras sem elit, venenatis a rhoncus nec, scelerisque id ante. Maecenas consectetur, neque eget bibendum consequat, diam odio dignissim odio, convallis pretium magna est ac nibh. Quisque interdum id nisi eget sagittis. Duis commodo elit lorem, non posuere eros pharetra at. Mauris vitae congue tortor.
        Maecenas vulputate placerat dictum. Suspendisse finibus placerat nulla, in volutpat urna tempor at. Praesent vitae neque egestas, aliquet ipsum et, congue tellus. Vestibulum orci magna, commodo accumsan pretium eget, gravida eget tortor. Curabitur congue augue sed orci vestibulum cursus. Integer magna mauris, eleifend sit amet enim et, commodo elementum tortor. Duis eu blandit mauris, dictum luctus sem. Morbi rutrum, neque sed dignissim sagittis, augue felis mattis augue, non congue mi massa non odio. Phasellus quis turpis eu mauris aliquet consequat. Aenean bibendum aliquam risus ut ullamcorper. Suspendisse potenti. Nullam commodo ipsum id ipsum congue, eget fringilla nulla pulvinar. Phasellus efficitur mi eu scelerisque malesuada.
        Maecenas condimentum condimentum urna, vitae hendrerit ex tincidunt at. Curabitur semper eget risus sit amet tempor. Nullam eu leo eget metus laoreet consequat. Aenean enim massa, ultrices eu dolor posuere, efficitur blandit libero. In scelerisque tristique mauris, eu cursus libero volutpat quis. Cras ante odio, fermentum quis erat non, posuere mollis ipsum. Cras at tristique lorem.
        Nam vitae molestie diam. Duis purus dui, vulputate vitae velit quis, accumsan iaculis orci. Sed fermentum imperdiet vestibulum. Sed porttitor magna eu condimentum cursus. Morbi maximus at augue et pharetra. Vestibulum vitae rhoncus ligula. In vulputate libero non libero porta vehicula. Aenean nibh tellus, hendrerit eget eleifend at, porta quis ipsum. Sed quis nunc iaculis, fermentum tortor eu, tempus dui. Sed aliquam tempus orci, in fringilla massa. Morbi ac tortor et risus dapibus dignissim.
        Cras tempor consequat arcu id commodo. Curabitur vulputate risus quis nibh convallis, ut eleifend mauris rhoncus. Donec laoreet aliquet neque, vitae vestibulum erat dignissim eget. Phasellus diam est, efficitur ac tristique id, euismod quis ipsum. Nullam a orci placerat, cursus dui id, suscipit enim. Sed rhoncus nisl sed eros tincidunt efficitur. Curabitur a lorem nibh. Suspendisse lacinia nulla sed luctus accumsan. Nam euismod pellentesque neque, at tristique ipsum varius sit amet. Fusce mollis quam eu urna bibendum, in imperdiet justo faucibus. Aliquam erat volutpat. Suspendisse potenti.
        Suspendisse commodo, nisl quis dictum vestibulum, est enim venenatis nisl, sed iaculis turpis ipsum at massa. Aliquam tincidunt posuere tincidunt. In hac habitasse platea dictumst. Sed semper cursus purus et cursus. Curabitur gravida sit amet leo sed dignissim. Maecenas magna quam, cursus in dui id, porta faucibus tortor. Pellentesque mollis lobortis massa, quis egestas tellus posuere maximus. In hac habitasse platea dictumst. Integer mattis sem a sapien lobortis vulputate. Donec varius, turpis vitae auctor auctor, enim diam rutrum justo, a rutrum purus ipsum in ligula. Ut tempor erat a nulla condimentum tempus. Mauris posuere commodo justo. Praesent in ante nec quam hendrerit fermentum. Nulla vel gravida sem. Pellentesque varius nibh nulla, id tempor nunc porta id.
        Curabitur augue augue, efficitur a nunc nec, pellentesque vehicula mauris. Vestibulum velit mauris, commodo sit amet ex quis, ornare pellentesque sapien. Donec ut sapien id ligula commodo dignissim. Praesent sit amet tincidunt sapien, ut auctor tortor. Nulla ut sem pellentesque, ultricies metus vitae, feugiat mauris. Proin nec quam sit amet justo mollis interdum et rhoncus nibh. Ut tempor in dui a volutpat. Nunc pulvinar quam nec ante porta, viverra dignissim nulla condimentum. Nulla placerat vitae libero rutrum tincidunt. Sed magna sapien, rhoncus vel justo quis, efficitur luctus arcu. Proin volutpat est eu pharetra congue. Proin nec sem non nunc pretium sollicitudin. Nulla nec efficitur ipsum, vitae posuere dui. Integer ut feugiat purus, viverra aliquet dolor. Donec orci lacus, viverra ut ipsum et, tristique volutpat mauris. Praesent scelerisque purus nibh, a venenatis ante pharetra sed.
        Ut tristique euismod est, eget ullamcorper quam. Aliquam erat volutpat. Phasellus rutrum ipsum non urna dictum, volutpat tempus metus varius. Nam tristique malesuada tincidunt. Aenean porttitor, purus eu lacinia imperdiet, diam purus egestas eros, vitae varius sem dolor at sapien. Sed ut arcu quis justo imperdiet porttitor vitae vitae nisi. Pellentesque interdum aliquet eleifend. In mattis semper porta. Vivamus congue orci sapien. Proin id egestas lacus. Praesent risus arcu, iaculis a sodales quis, pulvinar in metus. Etiam turpis nisl, efficitur vitae nisi id, bibendum fringilla felis. Nam posuere orci et ipsum fermentum, et pharetra sapien viverra. Aliquam facilisis non sem at finibus. Morbi et odio at ante efficitur posuere. Nunc et semper tellus.
        Quisque in erat justo. Praesent eu cursus lectus. Nunc ut egestas mi. Cras venenatis elit eget mi dictum congue. Nam nec venenatis sem. Ut imperdiet metus elementum nisl tincidunt tempus. Vivamus aliquet justo id vestibulum sagittis. Aliquam iaculis consectetur libero. In volutpat, eros at tempor ullamcorper, risus eros viverra libero, nec ultricies metus nibh id ex. Sed tincidunt lacus sollicitudin odio vulputate tincidunt. Duis non sapien et justo egestas facilisis accumsan id diam. Quisque ultrices porttitor dolor a luctus. Quisque vitae est id ligula consequat ultrices. In dolor odio, hendrerit non imperdiet quis, viverra quis arcu.
        Ut efficitur lacus ac dui volutpat pellentesque. Pellentesque semper ultrices est ac rhoncus. Morbi auctor vitae leo a pellentesque. Pellentesque malesuada nisi eget enim luctus, at volutpat leo aliquam. Sed et neque tempus, fringilla dui eu, ornare velit. Donec vitae lorem vitae tellus consectetur pharetra id quis orci. Ut interdum vulputate odio sit amet vulputate. Nulla id ipsum nulla. Curabitur in lacinia urna. Mauris vitae ultrices diam. Pellentesque in ornare quam. Nullam vehicula, diam non ultrices mollis, nibh diam ornare quam, vel auctor odio enim in tellus. Nullam mattis nulla et enim imperdiet mollis.
        Duis odio mauris, ullamcorper eget sapien eu, volutpat porta velit. Nullam vel cursus lorem, at facilisis urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam maximus sed arcu in viverra. Etiam maximus tellus ut nisl tristique euismod. Etiam imperdiet, mi vitae tempor tempus, dolor turpis faucibus lacus, condimentum consequat quam magna eget mauris. Phasellus eget dignissim odio. Fusce et fermentum urna. Ut aliquam ex nec diam tincidunt imperdiet.
        Sed vel leo id sem semper ornare eget congue tortor. Quisque lacinia consectetur lorem vitae hendrerit. Proin faucibus tellus sed augue laoreet ultricies. Nam a mattis neque. Vestibulum hendrerit, magna non bibendum mattis, mi mauris ullamcorper elit, sit amet maximus nisl arcu vitae sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer in neque quis tortor accumsan commodo. Integer pharetra convallis nulla, sit amet hendrerit purus pretium et. Donec volutpat et dui nec venenatis. Pellentesque ullamcorper leo sit amet enim fermentum dictum. Ut elementum aliquet nisi fringilla hendrerit. Integer vestibulum dolor sit amet sem hendrerit, eu facilisis ante rutrum. Nunc nec pellentesque ante.";

        for($i=0; $i<1500; $i++){
            $tags = $this->textTagger->getTags($str);
        }
        $diffTime = time()-$start;
        $this->assertTrue($diffTime<=6);
    }
}
