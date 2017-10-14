<?php
namespace Routes;

class ActivateTest extends \AbBaseRouteTest
{
    public function test_activate()
    {
        $url = "$this->baseUrl/activate/234sdfsf";
        $response = $this->call('GET', $url);

        $this->assertRouteName("activate");
        $this->assertRouteAction("Auth\ActivateController@index");
    }

    public function test_activate_post()
    {
        $url = "$this->baseUrl/activate";
        $response = $this->call('POST', $url);

        $this->assertRouteName("activate.store");
        $this->assertRouteAction("Auth\ActivateController@store");
    }
}
