<?php
namespace App\Http\Controllers\Admin;

use App\Lib\Article\Service\CreateArticle;
use App\Lib\Article\Service\UpdateArticle;
use App\Lib\Article\Service\DeleteArticle;
use App\Lib\Article\ArticleRepository;
use App\Lib\Media\Service\CreateMedia;

use App\Helpers\Helper;

use App\Models\Article;
use App\Models\Media;

use Mockery;
use Auth;
use App;

class ArticlesControllerTest extends \AbControllerTest
{
    public function setup()
    {
        parent::setup();
        $this->article = factory(Article::class)->create();
        $this->media = factory(Media::class)->create();
    }

    public function test_index()
    {
        $mockArticle = Mockery::mock(ArticleRepository::class)->makePartial();
        $mockArticle->shouldReceive('getArticleByUser')->once()->andReturn(collect());
        App::instance(ArticleRepository::class, $mockArticle);

        $path = route('admin.article.index');
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $response->assertViewHas('articles');
        $this->assertEquals('admin.article.show', $response->original->getName());
    }

    public function test_create()
    {
        $path = route('admin.article.create');
        $response = $this->call('GET', $path);

        $response->assertStatus(200);
        $this->assertEquals('admin.article.create', $response->original->getName());
    }

    public function test_store()
    {
        $validInputs = array_except($this->article->getAttributes(), ['updated_at', 'created_at']);
        $validInputs['media'] = $this->fakeUploadedFile();
        $validInputs['user_id'] = Auth::user()->id;

        $mockHelper = Mockery::mock(Helper::class)->makePartial();
        $mockHelper->shouldReceive('uploadImage')->once()->andReturn('filename');
        App::instance(Helper::class, $mockHelper);

        $mockMedia = Mockery::mock(CreateMedia::class)->makePartial();
        $mockMedia->shouldReceive('run')->once()->with('filename')->andReturn($this->media);
        App::instance(CreateMedia::class, $mockMedia);

        $mockArticle = Mockery::mock(CreateArticle::class)->makePartial();
        $mockArticle->shouldReceive('run')->once();
        App::instance(CreateArticle::class, $mockArticle);

        $path = route('admin.article.store');
        $response = $this->call('POST', $path, $validInputs, [], [], ['media' => $validInputs['media']]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.article.index'));
    }

    public function test_store_when_not_valid_input()
    {
        $path = route('admin.article.store');
        $response = $this->call('POST', $path, []);

        $mockArticle = Mockery::mock(CreateArticle::class)->makePartial();
        $mockArticle->shouldReceive('run')->never();
        App::instance(CreateArticle::class, $mockArticle);

        $response->assertStatus(302);
    }

    public function test_destroy()
    {
        $mockArticle = Mockery::mock(DeleteArticle::class)->makePartial();
        $mockArticle->shouldReceive('run')->with($this->article->id)->once();
        App::instance(DeleteArticle::class, $mockArticle);

        $path = route('admin.article.destroy', [$this->article->id]);
        $response = $this->call('POST', $path, []);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.article.index'));
    }

    public function test_publishUnpublish()
    {
        $validInputs['status'] = true;

        $mockArticle = Mockery::mock(UpdateArticle::class)->makePartial();
        $mockArticle->shouldReceive('publishUnpublish')->with($this->article->id, true)->once();
        App::instance(UpdateArticle::class, $mockArticle);

        $path = route('admin.article.publish_unpublish', ['id' => $this->article->id]);
        $response = $this->call('POST', $path, $validInputs);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.article.index'));
    }

    public function test_publishUnpublish_when_not_valid_status()
    {
        $mockArticle = Mockery::mock(UpdateArticle::class)->makePartial();
        $mockArticle->shouldReceive('publishUnpublish')->never();
        App::instance(UpdateArticle::class, $mockArticle);

        $path = route('admin.article.publish_unpublish', ['id' => $this->article->id]);
        $response = $this->call('POST', $path, []);

        $response->assertStatus(302);
    }
}
