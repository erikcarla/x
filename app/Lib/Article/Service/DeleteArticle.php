<?php
namespace App\Lib\Article\Service;

use App\Lib\Article\ArticleRepository;
use App\Models\Article;
use App;

class DeleteArticle
{
    public function run($id)
    {
        $article = Article::byUser()->findOrFail($id);
        $article->delete();

        $articleRepo = App::make(ArticleRepository::class)->removeAllCache($id);
    }
}
