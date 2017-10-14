<?php
namespace App\Lib\Article\Service;

use App\Lib\Article\ArticleRepository;
use App\Models\Article;
use App\Models\User;

use Mockery;
use App;

class UpdateArticleTest extends \AbLibTest
{
    public function test_publishUnpublish()
    {
        $article = factory(Article::class)->create([
            'user_id' => $this->currentUser->id
        ]);
        $this->mockArticleRepo($article->id);

        $createMedia = new UpdateArticle();
        $result = $createMedia->publishUnpublish($article->id, true);

        $this->assertNotNull($result->publish_date);
        $this->assertTrue($result->published);
    }

    public function test_publishUnpublish_when_published_false()
    {
        $article = factory(Article::class)->create([
            'user_id' => $this->currentUser->id
        ]);
        $this->mockArticleRepo($article->id);

        $createMedia = new UpdateArticle();
        $result = $createMedia->publishUnpublish($article->id, false);

        $this->assertNull($result->publish_date);
        $this->assertFalse($result->published);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_publishUnpublish_when_delete_another_users_article()
    {
        $article = factory(Article::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $createMedia = new UpdateArticle();
        $result = $createMedia->publishUnpublish($article->id, true);
    }

    private function mockArticleRepo($id)
    {
        $articleRepo = Mockery::mock(ArticleRepository::class)->makePartial();
        $articleRepo->shouldReceive('removeAllCache')->with($id)->once();
        App::instance(ArticleRepository::class, $articleRepo);
    }
}
