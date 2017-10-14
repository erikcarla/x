<?php
namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Helpers\Helper;

use App\Models\Article;
use Mockery;
use App;

class RssControllerTest extends \AbControllerTest
{
    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create();
    }

    public function test_index()
    {
        $mockArticle = Mockery::mock(ArticleRepository::class)->makePartial();
        $mockArticle->shouldReceive('getAllArticles')->once()->andReturn(collect());
        App::instance(ArticleRepository::class, $mockArticle);

        $path = route('rss');
        $response = $this->call('GET', $path);

        $response->assertHeader('Content-Type','text/xml; charset=utf-8');
    }
}
