<?php
namespace App\Http\Requests;

use Tests\TestCase;

class PubUnpubRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->request = new PubUnpubRequest();
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
            'status' => 'required|boolean',
        ];
    }
}
