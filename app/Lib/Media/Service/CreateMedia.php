<?php
namespace App\Lib\Media\Service;

use App\Models\Media;

class CreateMedia
{
    public function run($filename)
    {
        $media = new Media();
        $media->filename = $filename;
        $media->save();

        return $media;
    }
}
