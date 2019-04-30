<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CourseCollection(Course::orderBy('id','DESC')->paginate(10));
    }

    public function search($field, $query)
    {
        return new CourseCollection(Course::where($field,'LIKE',"%$query%")->latest()->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'teacher_id'        => 'required|numeric',
            'category_id'       => 'required|numeric',
            'level_id'          => 'required|numeric',
            'name'              => 'required',
            'slug'              => 'required|unique:courses',
            'picture'           => 'required',
        ]);

        $course = new Course();
        $course->teacher_id = $request->teacher_id;
        $course->category_id = $request->category_id;
        $course->level_id = $request->level_id;
        $course->name = $request->name;
        $course->slug = $request->slug;
        $course->picture = $request->picture;
        $course->save();

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CourseResource(Customer::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'teacher_id'        => 'required|numeric',
            'category_id'       => 'required|numeric',
            'level_id'          => 'required|numeric',
            'name'              => 'required',
            'slug'              => 'required|unique:courses,slug,'.$id,
            'picture'           => 'required',
        ]);

        $course = Course::findOrfail($id);
        $course->teacher_id = $request->teacher_id;
        $course->category_id = $request->category_id;
        $course->level_id = $request->level_id;
        $course->name = $request->name;
        $course->slug = $request->slug;
        $course->picture = $request->picture;
        $course->save();

        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrfail($id);
        $course->delete();
        return new CourseResource($course);
    }
}
