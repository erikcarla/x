<?php
namespace Routes;

class TaskTest extends \BaseRouteTest
{
    public function test_post_task()
    {
        $url = "$this->baseUrl/task";
        $response = $this->call('POST', $url);

        $this->assertRouteName("task.store");
        $this->assertRouteAction("HomeController@store");
    }

    public function test_delete_task()
    {
        $url = "$this->baseUrl/task/1";
        $response = $this->call('DELETE', $url);

        $this->assertRouteName("task.destroy");
        $this->assertRouteAction("HomeController@destroy");
    }
}
