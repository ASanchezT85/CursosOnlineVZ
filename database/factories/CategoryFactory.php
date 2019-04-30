<?php

use Faker\Generator as Faker;

use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->randomElement(['PHP', 'JAVASCRIPT', 'JAVA', 'VUEJS', 'MYSQL', 'SQL', 'BIGDATA', 'AMAZON WEB SERVICES', 'HTML', 'LARAVEL', 'ANGULAR', 'CSS', ]);

    return [
        'name' => $name,
        'slug' => str_slug($name, $separator = '-'),
        'description' => $faker->sentence,
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/categories', 250, 82, 'abstract', false),
    ];

});
