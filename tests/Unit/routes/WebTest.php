<?php
namespace Routes;

class WebTest extends \AbBaseRouteTest
{
    public function test_rss()
    {
        $url = "$this->baseUrl/rss";
        $response = $this->call('GET', $url);

        $this->assertRouteName("rss");
        $this->assertRouteAction("RssController@index");
    }

}
