<?php

use Tests\TestCase;
use App\Models\User;

abstract class AbLibTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->currentUser = User::first();
        $this->actingAs($this->currentUser);

        Session::start();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
