<?php

namespace App\Http\Controllers;

use App\Lib\Article\ArticleRepository;
use App\Helpers\Helper;

use Validator;
use App;

class HomeController extends Controller
{
    public function index()
    {
        $articles = App::make(ArticleRepository::class)->getAllArticles();

        return view('welcome', [
            'articles' => $articles
        ]);
    }

    public function read($id)
    {
        $article = App::make(ArticleRepository::class)->getArticle($id);

        return view('read', [
            'article' => $article
        ]);
    }

    public function generate($id)
    {
        $article = App::make(ArticleRepository::class)->getArticle($id);

        $html = view('generate', [
            'article' => $article
        ]);

        App::make(Helper::class)->generatePdf($html);
    }
}
