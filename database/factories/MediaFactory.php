<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Media::class, function (Faker $faker) {

    return [
        'filename' => $faker->word. '.jpg',
    ];
});
