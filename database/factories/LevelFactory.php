<?php

use Faker\Generator as Faker;

use App\Level;

$factory->define(Level::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => str_slug($name, $separator = '-'),
        'description' => $faker->sentence,
    ];
});
