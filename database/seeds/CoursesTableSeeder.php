<?php

use Illuminate\Database\Seeder;

use App\Course;
use App\Goal;
use App\Requirement;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Course::class, 100)
            ->create()
            ->each(function (Course $course){
                $course->goals()->saveMany(factory(Goal::class, 2)->create());
                $course->goals()->saveMany(factory(Requirement::class, 4)->create());
            }
        );
    }
}
