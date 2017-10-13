<?php

use Tests\TestCase;
use App\Models\User;

abstract class ControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->currentUser = factory(User::class)->create();
        $this->actingAs($this->currentUser);

        Session::start();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
