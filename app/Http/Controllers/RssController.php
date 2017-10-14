<?php

namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Helpers\Helper;
use App\Builders\RssBuilder;

use Response;
use Validator;
use App;

class RssController extends Controller
{
    public function index()
    {
        $articles = App::make(ArticleRepository::class)->getAllArticles();

        $rssBuilder = App::make(RssBuilder::class)->show($articles);
        $view = view('feed.rss', $rssBuilder);

        return Response::make($view->render(), 200, ['Content-Type' => 'text/xml; charset=utf-8']);
    }

}
