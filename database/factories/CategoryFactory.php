<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text(200),
        'anchored' => $faker->boolean
    ];
});

$factory->state(Category::class, 'with_image', function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1440, 986))),
    ];
});
