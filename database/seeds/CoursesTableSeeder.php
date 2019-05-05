<?php

use Illuminate\Database\Seeder;

use App\Goal;
use App\Course;
use App\Student;
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
        factory(Course::class, 25)
            ->create()
            ->each(function (Course $course){
                $course->goals()->saveMany(factory(Goal::class, 2)->create());
                $course->goals()->saveMany(factory(Requirement::class, 4)->create());
                $course->students()->attach(App\User::all()->random()->id);
            }
        );
    }
}
