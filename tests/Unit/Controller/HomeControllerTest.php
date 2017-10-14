<?php
namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Helpers\Helper;

use App\Models\Article;
use Mockery;
use App;

class HomeControllerTest extends \AbControllerTest
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

        $path = route('home.index');
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $response->assertViewHas('articles');
        $this->assertEquals('welcome', $response->original->getName());
    }

    public function test_read()
    {
        $mockArticle = Mockery::mock(ArticleRepository::class)->makePartial();
        $mockArticle->shouldReceive('getArticle')->with($this->article->id)->once()->andReturn($this->article);
        App::instance(ArticleRepository::class, $mockArticle);

        $path = route('home.read', ['id' => $this->article->id]);
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $response->assertViewHas('article');
        $this->assertEquals('read', $response->original->getName());
    }

    public function test_generate()
    {
        $mockArticle = Mockery::mock(ArticleRepository::class)->makePartial();
        $mockArticle->shouldReceive('getArticle')->with($this->article->id)->once()->andReturn($this->article);
        App::instance(ArticleRepository::class, $mockArticle);

        $mockHelper = Mockery::mock(Helper::class)->makePartial();
        $mockHelper->shouldReceive('generatePdf')->once()->andReturn('generate');
        App::instance(Helper::class, $mockHelper);

        $path = route('home.generate', ['id' => $this->article->id]);
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
    }
}
