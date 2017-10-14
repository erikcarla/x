<?php
namespace Views;

use App\Models\Article;

class ReadTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create();
    }

    public function test_render()
    {
        $article = $this->article;
        $view = view('read', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.articles--readpage')->count());
    }
}
