<?php

use Faker\Generator as Faker;
use App\Models\Gallery;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
    'title' => $faker->sentence(),
    'published_at' => $faker->dateTimeThisDecade(),
    'photos' => json_encode([$faker->imageUrl(), $faker->imageUrl(), $faker->imageUrl()])
    ];
});

$factory->state(Gallery::class, 'with_image', function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1440, 986))),
    ];
});
