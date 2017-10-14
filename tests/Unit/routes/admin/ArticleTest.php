<?php
namespace Routes\Admin;

class ArticleTest extends \AbBaseRouteTest
{
    public function test_article_index()
    {
        $url = "$this->baseUrl/admin/article";
        $response = $this->call('GET', $url);

        $this->assertRouteName("admin.article.index");
        $this->assertRouteAction("Admin\ArticlesController@index");
    }

    public function test_article_create()
    {
        $url = "$this->baseUrl/admin/article/create";
        $response = $this->call('GET', $url);

        $this->assertRouteName("admin.article.create");
        $this->assertRouteAction("Admin\ArticlesController@create");
    }

    public function test_article_post()
    {
        $url = "$this->baseUrl/admin/article";
        $response = $this->call('POST', $url);

        $this->assertRouteName("admin.article.store");
        $this->assertRouteAction("Admin\ArticlesController@store");
    }

    public function test_article_destroy()
    {
        $url = "$this->baseUrl/admin/article/1/destroy";
        $response = $this->call('POST', $url);

        $this->assertRouteName("admin.article.destroy");
        $this->assertRouteAction("Admin\ArticlesController@destroy");
    }

    public function test_article_publish_unpublish()
    {
        $url = "$this->baseUrl/admin/article/1/publish_unpublish";
        $response = $this->call('POST', $url);

        $this->assertRouteName("admin.article.publish_unpublish");
        $this->assertRouteAction("Admin\ArticlesController@publishUnpublish");
    }
}
