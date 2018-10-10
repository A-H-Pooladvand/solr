<?php

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(rand(50, 100)),
        'summary' => $faker->realText(rand(200, 500)),
        'body' => $faker->realText(rand(5000, 9000))
    ];
});
