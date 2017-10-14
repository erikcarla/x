<?php
namespace App\Lib\Article;

use App\Models\Article;
use Auth;
use Cache;
use App;

class ArticleRepository
{
    public function getArticleByUser($id = null)
    {
        return App::make(Article::class)
            ->byUser($id)
            ->orderByPublished()
            ->with('media', 'user')
            ->get();
    }

    public function getAllArticles($limit = 10)
    {
        $key = 'GetAllArticles::' . $limit;
        $cacheTags = Cache::tags('allArticle');
        if($cacheTags->has($key)) {
            return $cacheTags->get($key);
        }
        $article = App::make(Article::class)
                ->published()
                ->orderByPublished()
                ->with('media', 'user')
                ->limit($limit)
                ->get();
        $cacheTags->put($key, $article, 10);
        return $article;
    }

    public function getArticle($id)
    {
        $key = 'GetArticle::' . $id;
        if(Cache::has($key)) {
            return Cache::get($key);
        }
        $article = App::make(Article::class)
                ->published()
                ->findOrFail($id);
        Cache::put($key, $article, 10);
        return $article;
    }

    public function removeAllCache($id)
    {
        Cache::tags('allArticle')->flush();
        Cache::forget('GetArticle::'. $id);
    }
}
