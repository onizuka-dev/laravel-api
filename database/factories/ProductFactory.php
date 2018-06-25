<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'code' => $faker->domainWord. ' ' . rand(1, 100),
        'active' => $faker->boolean(),
        'description' => $faker->realText,
        'price' => $faker->randomFloat(2, 100, 9999)
    ];
});
