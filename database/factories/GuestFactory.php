<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Guest::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'token' => str_random(10),
    ];
});
