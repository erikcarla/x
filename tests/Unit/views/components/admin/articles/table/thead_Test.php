<?php
namespace Views\Components\Admin\Articles;

class TheadTest extends \AbViewTest
{
    public function test_render()
    {
        $view = view('components.admin.articles.table.thead')
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(1, $crawler->filter('.admin--articles--table--thead')->count());
    }
}
