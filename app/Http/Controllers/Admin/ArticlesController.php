<?php
namespace App\Http\Controllers\Admin;


use App\Lib\Article\Service\CreateArticle;
use App\Lib\Article\Service\UpdateArticle;
use App\Lib\Article\Service\DeleteArticle;
use App\Lib\Article\ArticleRepository;
use App\Lib\Media\Service\CreateMedia;

use App\Http\Requests\PubUnpubRequest;
use App\Http\Requests\ArticleRequest;

use App\Helpers\Helper;

use App\Models\Article;
use App\Models\Media;

use Carbon\Carbon;
use Auth;
use App;

class ArticlesController extends AdminController
{
    public function index()
    {
        $articles = App::make(ArticleRepository::class)->getArticleByUser();

        return $this->renderView('article.show', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return $this->renderView('article.create');
    }

    public function store(ArticleRequest $request)
    {
        $image = $request->file('media');

        $filename = App::make(Helper::class)->uploadImage($image);
        $media = App::make(CreateMedia::class)->run($filename);

        $params = $this->params([
            'media_id' => $media->id,
            'user_id' => Auth::user()->id
        ]);
        $article = App::make(CreateArticle::class)->run($params);

        return $this->redirectToHome();
    }

    public function destroy($id)
    {
        $article = App::make(DeleteArticle::class);
        $article->run($id);

        return $this->redirectToHome();
    }

    public function publishUnpublish(PubUnpubRequest $request, $id)
    {
        $article = App::make(UpdateArticle::class);
        $article->publishUnpublish($id, $request->get('status'));

        return $this->redirectToHome();
    }

    /** private **/

    private function redirectToHome()
    {
        return redirect(route('admin.article.index'));
    }

    private function renderView($view, $params = [])
    {
        return view(static::getViewDir().$view, $params);
    }

    private function params($params = [])
    {
        return request()->only([
            'title',
            'body',
            'published'
        ]) + $params;
    }

}
