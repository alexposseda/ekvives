<?php

use Faker\Generator as Faker;
use App\Models\Slide;

$factory->define(Slide::class, function (Faker $faker) {
    return [
        'label' => $faker->sentence(),
        'title' => $faker->sentence(),
        'description' => $faker->sentence(),
    ];
});

$factory->state(Slide::class, 'with_image', function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1440, 580))),
    ];
});
