<?php
namespace Views;

use App\Models\Article;
use Carbon\Carbon;

class GenerateTest extends \AbViewTest
{
    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create([
            'publish_date' => Carbon::now()
        ]);
    }

    public function test_render()
    {
        $article = $this->article;
        $view = view('generate', ['article' => $article])
            ->render();

        $crawler = $this->toCrawler($view);

        $expectedDate = new Carbon($this->article->publish_date);
        $expectedDate = $expectedDate->toDateTimeString();
        $this->assertContains($this->article->media->filename, $crawler->html());
        $this->assertContains($this->article->title, $crawler->html());
        $this->assertContains($expectedDate, $crawler->html());
        $this->assertContains($this->article->user->name, $crawler->html());
        $this->assertContains($this->article->body, $crawler->html());
    }
}
