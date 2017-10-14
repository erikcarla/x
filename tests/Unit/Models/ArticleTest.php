<?php
namespace App\Models;

use Carbon\Carbon;

class ArticleTest extends \AbModelTest
{
    public function test_scopeByUser()
    {
        $user = factory(User::class)->create();
        $containArticle = factory(Article::class)->create([
            'user_id' => $user->id
        ]);
        $notContainArticle = factory(Article::class)->create();

        $articleIds = Article::byUser($user->id)->pluck('id');

        $this->assertContains($containArticle->id, $articleIds);
        $this->assertNotContains($notContainArticle->id, $articleIds);
    }

    public function test_scopePublished()
    {
        $containArticle = factory(Article::class)->create([
            'published' => true,
        ]);
        $notContainArticle = factory(Article::class)->create();

        $articleIds = Article::published()->pluck('id');

        $this->assertContains($containArticle->id, $articleIds);
        $this->assertNotContains($notContainArticle->id, $articleIds);
    }

    public function test_scopeOrderByPublished()
    {
        Article::where('publish_date', '>', Carbon::now())->delete();
        $firstArticle = factory(Article::class)->create([
            'published' => true,
            'publish_date' => Carbon::now()->addYear(2)
        ]);
        $secondArticle = factory(Article::class)->create([
            'published' => true,
            'publish_date' => Carbon::now()->addYear()
        ]);

        $articleIds = Article::orderByPublished()->pluck('id');

        $this->assertEquals($firstArticle->id, $articleIds[0]);
        $this->assertEquals($secondArticle->id, $articleIds[1]);
    }
}
