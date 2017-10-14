<?php
namespace Views\Admin\Articles;

use App\Models\Article;

class ShowTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 4)->create();
    }

    public function test_render()
    {
        $article = $this->articles;
        $view = view('admin.article.show', ['articles' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(route('admin.article.create'), $crawler->filter('#create-article')->attr('href'));
        $this->assertEquals(1, $crawler->filter('.admin--articles--table')->count());
    }
}
