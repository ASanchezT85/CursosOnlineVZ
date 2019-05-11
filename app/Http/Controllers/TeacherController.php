<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\Http\Resources\Teacher\CoursesCollection;

class TeacherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('teacher.index');
    }

    public function list(){

        $teacher_id = auth()->id();

        $courses = Course::where('teacher_id', $teacher_id)
            ->latest()
            ->paginate(12);
       
        return new CoursesCollection($courses);
    }
}
