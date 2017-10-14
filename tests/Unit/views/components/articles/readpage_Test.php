<?php
namespace Views\Components\Articles;

use App\Models\Article;

class ReadPageTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create();
    }

    public function test_render()
    {
        $article = $this->article;
        $view = view('components.articles.readpage', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.articles--readpage')->count());
        $this->assertContains($article->media->filename, $crawler->filter('.articles--readpage__image')->attr('src'));
        $this->assertEquals($article->title, $crawler->filter('.articles--readpage__title')->text());
        $this->assertEquals($article->publish_date, $crawler->filter('.articles--readpage__publish-date')->text());
        $this->assertContains($article->user->name, $crawler->filter('.articles--readpage__author')->text());
        $this->assertEquals($article->body, $crawler->filter('.articles--readpage__body')->text());
        $this->assertEquals(route('home.generate', ['id' => $article->id]), $crawler->filter('.articles--readpage__generate')->attr('href'));
    }
}
