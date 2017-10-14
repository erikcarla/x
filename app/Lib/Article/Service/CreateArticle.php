<?php
namespace App\Lib\Article\Service;

use App\Models\Article;
use Carbon\Carbon;

class CreateArticle
{
    public function run(array $params = [])
    {
        $article = new Article;
        $article->fill($params);
        if(isset($params['published']) && $params['published']) {
            $article->publish_date = Carbon::now();
        } else {
            $article->publish_date = null;
        }
        $article->save();

        return $article;
    }
}
