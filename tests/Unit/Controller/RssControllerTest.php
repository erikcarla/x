<?php
namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Builders\RssBuilder;
use App\Helpers\Helper;

use App\Models\Article;
use Mockery;
use App;

class RssControllerTest extends \AbControllerTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 3)->create();
    }

    public function test_index()
    {
        $mockArticle = Mockery::mock(ArticleRepository::class)->makePartial();
        $mockArticle->shouldReceive('getAllArticles')->once()->andReturn($this->articles);
        App::instance(ArticleRepository::class, $mockArticle);

        $mockRss = Mockery::mock(RssBuilder::class)->makePartial();
        $mockRss->shouldReceive('show')->once()->passthru();
        App::instance(RssBuilder::class, $mockRss);

        $path = route('rss');
        $response = $this->call('GET', $path);

        $response->assertHeader('Content-Type','text/xml; charset=utf-8');
    }
}
