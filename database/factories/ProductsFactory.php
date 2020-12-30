<?php

use Faker\Generator as Faker;
use App\Models\Category;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'article' => $faker->sentence(),
        'title' => $faker->sentence(),
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'content' => $faker->text(500)
    ];
});

$factory->state(Product::class, 'with_image', function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents($faker->imageUrl(1440, 986))),
    ];
});
