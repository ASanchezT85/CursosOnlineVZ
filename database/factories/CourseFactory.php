<?php

use Faker\Generator as Faker;

use App\Course;
use App\Teacher;
use App\Category;
use App\Level;
use App\Status;

$factory->define(Course::class, function (Faker $faker) {
    $name = $faker->sentence;
    $status = Status::all()->random()->id;
    return [
        'teacher_id' => Teacher::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'level_id' => Level::all()->random()->id,
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'description' => $faker->paragraph,
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 600, 350, 'business', false),
        'status_id' => $status,
        'previous_approved' => $status !== 1 ? false : true,
        'previous_rejected' => $status === 3 ? true : false,
    ];
});
