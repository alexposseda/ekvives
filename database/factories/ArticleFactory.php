<?php

use Faker\Generator as Faker;
use App\Models\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'published_at' => $faker->dateTimeThisDecade(),
        'description' => $faker->text(300),
        'content' => $faker->text(1500)
    ];
});

$factory->state(Article::class, 'with_image', function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1440, 986))),
    ];
});
