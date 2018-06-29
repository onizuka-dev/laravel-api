<?php

use Faker\Generator as Faker;

$factory->define(App\Tax::class, function (Faker $faker) {
    return [
        'description' => $faker->word,
        'percentage' => rand(5, 10)
    ];
});
