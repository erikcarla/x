<?php
namespace App\Http\Requests;

use Tests\TestCase;

class ActivateRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->request = new ActivateRequest();
    }

    public function test_rules()
    {
        $expected = $this->rules();
        $result = $this->request->rules();
        $this->assertEquals($expected, $result);
    }

    private function rules()
    {
        return [
            'password' => 'required|string|min:6|confirmed'
        ];
    }
}
