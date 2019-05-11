<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;
use App\Helpers\Helper;
use App\Http\Resources\Administration\CourseResource;
use App\Http\Resources\Administration\CourseCollection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderByRaw("CASE WHEN status_id ='2' THEN 1 ELSE 0 END DESC")
            ->orderBy( 'name', 'DESC' )
            ->paginate(12);

        return new CourseCollection($courses);
    }

    public function search($field, $query)
    {
        return new CourseCollection(Course::where($field,'LIKE',"%$query%")->latest()->paginate(12));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('maintenance', compact('course'));
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
            'status_id'           => 'required',
        ]);

        $course = Course::findOrfail($id);

        $course->update($request->only(['status_id']));

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
        
        //Eliminamos la imagen del servidor
        \Storage::delete('public/courses/' . $course->picture);
        
        $course->delete();

        return new CourseResource($course);
    }
}
