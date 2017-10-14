<?php
namespace App\Builders;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Article;

class RssBuilderTest extends TestCase
{
    public function test_show()
    {
        $articles = factory(Article::class, 2)->create();

        $rssBuilder = new RssBuilder();
        $result = $rssBuilder->show($articles);

        $data = $this->generateData($articles);
        $this->assertEquals($data, $result);
    }

    private function generateData($articles)
    {
        foreach($articles as $article)
        {
            $dataArticles[] = [
                'title' => $article->title,
                'link' => route('home.read', ['id' => $article->id]),
                'pubDate' => $article->publish_date,
                'author' => $article->user->name,
                'guid' => $article->id,
                'description' => $article->body,
                'mediaUrl' => url('/images'). '/' .$article->media->filename
            ];
        }
        return [
            'title' => 'Crossover RSS',
            'link' => getenv('APP_URL'),
            'description' => 'Crossover RSS update every 10 minutes',
            'lastBuildDate' => Carbon::now()->toDateTimeString(),
            'articles' => $dataArticles
        ];
    }
}
