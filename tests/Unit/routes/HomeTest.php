<?php
namespace Routes;

class HomeTest extends \AbBaseRouteTest
{
    public function test_home_index()
    {
        $url = "$this->baseUrl";
        $response = $this->call('GET', $url);

        $this->assertRouteName("home.index");
        $this->assertRouteAction("HomeController@index");
    }

    public function test_home_read()
    {
        $url = "$this->baseUrl/1";
        $response = $this->call('GET', $url);

        $this->assertRouteName("home.read");
        $this->assertRouteAction("HomeController@read");
    }

    public function test_home_generate()
    {
        $url = "$this->baseUrl/1/generate";
        $response = $this->call('GET', $url);

        $this->assertRouteName("home.generate");
        $this->assertRouteAction("HomeController@generate");
    }

}
