<?php
namespace Views\Components\Articles;

use App\Models\Article;

class ItemTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create();
    }

    public function test_render()
    {
        $article = $this->article;
        $view = view('components.articles.list.item', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.articles--list--item')->count());
        $this->assertEquals(route('home.read', ['id' => $article->id]), $crawler->filter('.articles--list--item__link')->attr('href'));
        $this->assertContains($article->media->filename, $crawler->filter('.articles--list--item__image')->attr('src'));
        $this->assertEquals($article->title, $crawler->filter('.articles--list--item__title')->text());
        $this->assertEquals($article->publish_date, $crawler->filter('.articles--list--item__publish-date')->text());
        $this->assertContains($article->user->name, $crawler->filter('.articles--list--item__author')->text());
    }
}
