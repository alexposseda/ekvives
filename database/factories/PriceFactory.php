<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Models\Price::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text('300'),
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(746, 1024))),
    ];
});
