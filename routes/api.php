<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Category
Route::apiResource('categories','Api\Admin\CategoryController');
Route::get('search/categories/{field}/{query}','Api\Admin\CategoryController@search');

//Status
Route::apiResource('statuses','Api\Admin\StatusController');
Route::get('search/statuses/{field}/{query}','Api\Admin\StatusController@search');

//Status
Route::apiResource('levels','Api\Admin\LevelController');
Route::get('search/levels/{field}/{query}','Api\Admin\LevelController@search');

//Course
Route::apiResource('courses','Api\Admin\CourseController');
Route::get('search/courses/{field}/{query}','Api\Admin\CourseController@search');

//Student
Route::apiResource('students','Api\Admin\StudentController');
Route::get('search/students/{field}/{query}','Api\Admin\StudentController@search');

//Student
Route::apiResource('teachers','Api\Admin\TeachersController');
Route::get('search/teachers/{field}/{query}','Api\Admin\TeachersController@search');

Route::middleware(['permission:teacher'])->group(function() {
    Route::apiResource('teacher','Api\Teacher\TeacherController');
    Route::get('search/teachers/{field}/{query}','Api\Teacher\TeacherController@search');
});