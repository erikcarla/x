<?php
namespace Views\Components\Admin\Articles;


class FormTest extends \AbViewTest
{
    public function test_render()
    {
        $view = view('components.admin.articles.form')
            ->render();

        $crawler = $this->toCrawler($view);

        $this->assertEquals(route('admin.article.store'), $crawler->filter('.admin--articles--form')->attr('action'));
        $this->assertEquals(1, $crawler->filter('.admin--articles--form__image input[type=file]')->count());
        $this->assertEquals(1, $crawler->filter('.admin--articles--form__title input[type=text]')->count());
        $this->assertEquals(1, $crawler->filter('.admin--articles--form__content textarea[name=body]')->count());
        $this->assertEquals(1, $crawler->filter('.admin--articles--form__published input[type=checkbox]')->count());
        $this->assertEquals(1, $crawler->filter('.admin--articles--form__btn-save')->count());
    }
}
