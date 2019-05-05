<?php

use Faker\Generator as Faker;

use App\User;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->jobTitle,
    ];
});
