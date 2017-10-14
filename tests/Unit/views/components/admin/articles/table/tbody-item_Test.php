<?php
namespace Views\Components\Admin\Articles;

use App\Models\Article;

class TbodyItemTest extends \AbViewTest
{
    public function test_render()
    {
        $article = factory(Article::class)->create();
        $view = view('components.admin.articles.table.tbody-item', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.admin--articles--table--tbody--item')->count());
        $this->assertContains($article->media->filename, $crawler->filter('.admin--articles--table--tbody--item__image img')->attr('src'));
        $this->assertContains($article->title, $crawler->filter('.admin--articles--table--tbody--item__title')->text());
        $this->assertEquals(1, $crawler->filter('.admin--articles--table--tbody--item__button-publish')->count());
        $this->assertEquals(1, $crawler->filter('.admin--articles--table--tbody--item__button-delete')->count());
    }

    public function test_render_when_article_publish()
    {
        $article = factory(Article::class)->create([
            'published' => true
        ]);
        $view = view('components.admin.articles.table.tbody-item', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.admin--articles--table--tbody--item__button-unpublish')->count());
    }
}
