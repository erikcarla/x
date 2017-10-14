<?php

use Tests\TestCase;

abstract class AbBaseRouteTest extends TestCase
{
    protected $baseUrl = null;

    public function setUp()
    {
        parent::setUp();
        $this->baseUrl = getenv('APP_URL');
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function assertRouteName($name)
    {
        $this->assertEquals($name, Route::currentRouteName(), "Current route name mismatch");
    }

    protected function assertRouteAction($action)
    {
        $namespace = 'App\Http\Controllers';
        if (!(strpos($action, '\\') === 0)) $action = $namespace.'\\'.$action;
        $this->assertEquals($action, Route::currentRouteAction(), "Current route action mismatch");
    }
}
