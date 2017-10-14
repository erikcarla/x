<?php
namespace Views\Components\Articles;

use App\Models\Article;

class ListTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 3)->create();
    }

    public function test_render()
    {
        $view = view('components.articles.list', ['articles' => $this->articles])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.articles--list')->count());
        $this->assertEquals(3, $crawler->filter('.articles--list--item')->count());
    }

    public function test_render_when_doesnt_have_article()
    {
        $view = view('components.articles.list')
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(0, $crawler->filter('.articles--list')->count());
    }
}
