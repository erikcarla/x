<?php
namespace App\Lib\Media\Service;

use App\Models\Media;

class CreateMediaTest extends \AbLibTest
{
    public function test_run()
    {
        $filename = md5(rand());

        $createMedia = new CreateMedia();
        $result = $createMedia->run($filename);

        $media = Media::orderBy('created_at', 'DESC')->first();
        $this->assertEquals($media->filename, $result->filename);
    }
}
