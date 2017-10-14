<?php
namespace App\Lib\Article;

use App\Models\Article;
use App\Models\User;

use Mockery;
use Cache;
use App;

class ArticleRepositoryTest extends \AbLibTest
{
    public function test_getArticleByUser()
    {
        $article = Mockery::mock(Article::class)->makePartial();
        $article->shouldReceive('byUser->orderByPublished->with->get')->once();
        App::instance(Article::class, $article);

        $repo = new ArticleRepository();
        $repo->getArticleByUser();
    }

    public function test_getAllArticles_when_key_not_exists()
    {
        $article = Mockery::mock(Article::class)->makePartial();
        $article->shouldReceive('published->orderByPublished->with->limit->get')->once()->andReturn('article');
        App::instance(Article::class, $article);

        Cache::shouldReceive('tags->has')->once()->andReturn(false);
        Cache::shouldReceive('tags->put')->with(Mockery::any(), 'article', 10)->once();

        $repo = new ArticleRepository();
        $repo->getAllArticles();
    }

    public function test_getAllArticles_when_key_exists()
    {
        $article = Mockery::mock(Article::class)->makePartial();
        $article->shouldReceive('published->orderByPublished->with->limit->get')->never();
        App::instance(Article::class, $article);

        Cache::shouldReceive('tags->has')->once()->andReturn(true);
        Cache::shouldReceive('tags->get')->once();

        $repo = new ArticleRepository();
        $repo->getAllArticles();
    }

    public function test_getArticle_when_key_not_exists()
    {
        $article = Mockery::mock(Article::class)->makePartial();
        $article->shouldReceive('published->findOrFail')->once()->andReturn('article');
        App::instance(Article::class, $article);

        Cache::shouldReceive('has')->once()->andReturn(false);
        Cache::shouldReceive('put')->with(Mockery::any(), 'article', 10)->once();

        $repo = new ArticleRepository();
        $repo->getArticle(10);
    }

    public function test_getArticle_when_key_exists()
    {
        $article = Mockery::mock(Article::class)->makePartial();
        $article->shouldReceive('published->findOrFail')->never();
        App::instance(Article::class, $article);

        Cache::shouldReceive('has')->once()->andReturn(true);
        Cache::shouldReceive('get')->once();

        $repo = new ArticleRepository();
        $repo->getArticle(10);
    }

    public function test_removeAllCache()
    {
        Cache::shouldReceive('tags->flush')->once();
        Cache::shouldReceive('forget')->with('GetArticle::4')->once();

        $repo = new ArticleRepository();
        $repo->removeAllCache(4);
    }
}
