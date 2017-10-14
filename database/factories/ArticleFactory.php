<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Article::class, function (Faker $faker) {
    $user = App\Models\User::first();
    $media = App\Models\Media::first();
    return [
        'title' => $faker->text(100),
        'body' => $faker->paragraph(3, true),
        'user_id' => $user->id,
        'media_id' => $media->id,
    ];
});
