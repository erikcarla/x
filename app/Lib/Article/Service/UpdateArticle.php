<?php
namespace App\Lib\Article\Service;

use App\Lib\Article\ArticleRepository;
use App\Models\Article;
use Carbon\Carbon;
use App;

class UpdateArticle
{
    public function publishUnpublish($id, $status = false)
    {
        $article = App::make(Article::class)->byUser()->findOrFail($id);
        if($status) {
            $article->publish_date = Carbon::now();
        } else {
            $article->publish_date = null;
        }
        $article->published = $status;

        $article->save();

        $articleRepo = App::make(ArticleRepository::class)->removeAllCache($id);
        return $article;
    }
}
