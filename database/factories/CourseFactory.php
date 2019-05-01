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
    $type = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
            'fashion', 'people', 'nature', 'sports', 'technics', 'transport']);
    return [
        'teacher_id' => Teacher::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'level_id' => Level::all()->random()->id,
        'name' => $name,        
        'description' => $faker->paragraph,
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1.99, $max = 99.99),
        'slug' => str_slug($name, '-'),
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 500, 250, $type, false),
        'status_id' => $status,
        'previous_approved' => $status !== 1 ? false : true,
        'previous_rejected' => $status === 3 ? true : false,
    ];
});
