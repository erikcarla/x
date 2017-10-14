<?php

use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;

abstract class AbControllerTest extends TestCase
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

    protected static function appRootPath()
    {
        return realpath(__DIR__.'/../../../../');
    }

    protected static function rootPath()
    {
        return static::appRootPath().'/www/tests';
    }

    protected static function fakeUploadedFile()
    {
        $filepath = static::rootPath() . '/_data/images.jpg';

        $dupFilename = 'dup-' . sha1(microtime()) . basename($filepath);
        $dupFilepath = '/tmp/' . $dupFilename;
        $copy_result = copy($filepath, $dupFilepath);

        $filesize = filesize($dupFilepath);
        return new UploadedFile($dupFilepath, 'images.jpg', 'image/jpeg', $filesize, null, true);
    }
}
