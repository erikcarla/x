<?php
namespace Views\Components\Admin\Articles;

use App\Models\Article;

class TbodyTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->articles = factory(Article::class, 5)->create();
    }

    public function test_render()
    {
        $view = view('components.admin.articles.table.tbody', ['articles' => $this->articles])
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.admin--articles--table--tbody')->count());
        $this->assertEquals(5, $crawler->filter('.admin--articles--table--tbody--item')->count());
    }
}
