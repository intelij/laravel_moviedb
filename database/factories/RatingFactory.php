<?php

use Faker\Generator as Faker;

$factory->define(App\Rating::class, function (Faker $faker) {
    return [
        'rating' => $faker->numberBetween(1,5),
        'user_id' => $faker->numberBetween(1,13),
        'movie_id' => $faker->numberBetween(3,88),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
