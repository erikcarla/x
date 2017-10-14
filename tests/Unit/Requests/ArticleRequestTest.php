<?php
namespace App\Http\Requests;

use Tests\TestCase;

class ArticleRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->request = new ArticleRequest();
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
            'title' => 'required|max:100',
            'body' => 'required',
            'media' => 'required|mimes:jpeg,png,gif',
        ];
    }
}
