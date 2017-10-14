<?php

namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Helpers\Helper;

use Carbon\Carbon;
use Response;
use Validator;
use App;

class RssController extends Controller
{
    public function index()
    {
        $articles = App::make(ArticleRepository::class)->getAllArticles();

        $view = view('feed.rss', $this->prepareParams($articles));

        return Response::make($view->render(), 200, ['Content-Type' => 'text/xml; charset=utf-8']);
    }

    /** private **/
    private function prepareParams($articles)
    {
        $dataArticles = [];
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
