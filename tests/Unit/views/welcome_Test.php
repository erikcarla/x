<?php
namespace Views;

use App\Models\Article;

class WelcomeTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 4)->create();
    }

    public function test_render()
    {
        $article = $this->articles;
        $view = view('welcome', ['articles' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.articles--list')->count());
    }
}
