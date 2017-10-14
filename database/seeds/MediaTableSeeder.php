<?php

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('medias')->truncate();

        factory(Media::class)->create([
            'filename' => 'images.jpg'
        ]);
    }

}
