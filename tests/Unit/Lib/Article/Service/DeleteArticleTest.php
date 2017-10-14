<?php
namespace App\Lib\Article\Service;

use App\Lib\Article\ArticleRepository;
use App\Models\Article;
use App\Models\User;
use Mockery;
use App;

class DeleteArticleTest extends \AbLibTest
{
    public function test_run()
    {
        $article = factory(Article::class)->create([
            'user_id' => $this->currentUser->id
        ]);
        $this->mockArticleRepo($article->id);

        $createMedia = new DeleteArticle();
        $result = $createMedia->run($article->id);

        $expected = Article::where('id', $article->id)->first();
        $this->assertNull($expected);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_run_when_delete_another_users_article()
    {
        $article = factory(Article::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $createMedia = new DeleteArticle();
        $result = $createMedia->run($article->id);
    }

    private function mockArticleRepo($id)
    {
        $articleRepo = Mockery::mock(ArticleRepository::class)->makePartial();
        $articleRepo->shouldReceive('removeAllCache')->with($id)->once();
        App::instance(ArticleRepository::class, $articleRepo);
    }
}
