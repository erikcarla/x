<?php
namespace Views\Admin\Articles;

use App\Models\Article;

class CreateTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 4)->create();
    }

    public function test_render()
    {
        $article = $this->articles;
        $view = view('admin.article.create', [
            'articles' => $article,
            'errors' => []
        ])->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.admin--articles--form')->count());
    }
}
