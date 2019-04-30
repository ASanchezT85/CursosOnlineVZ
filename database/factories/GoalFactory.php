<?php

use Faker\Generator as Faker;

use App\Goal;
use App\Course;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
        'goal' => $faker->sentence,
    ];
});
