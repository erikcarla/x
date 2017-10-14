<?php
namespace App\Lib\Article\Service;

use App\Models\Article;

class CreateArticleTest extends \AbLibTest
{
    public function test_run()
    {
        $article = factory(Article::class)->make();
        $params = $article->getAttributes();

        $createMedia = new CreateArticle();
        $result = $createMedia->run($params);

        $this->assertEquals($article->title, $result->title);
        $this->assertNull($result->publish_date);
    }

    public function test_run_when_published_true()
    {
        $article = factory(Article::class)->make();
        $params = $article->getAttributes();
        $params['published'] = true;

        $createMedia = new CreateArticle();
        $result = $createMedia->run($params);

        $this->assertNotNull($result->publish_date);
    }
}
