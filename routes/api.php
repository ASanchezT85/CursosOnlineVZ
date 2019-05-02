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

//Course
Route::apiResource('courses','Admin\CourseController');
Route::get('search/courses/{field}/{query}','Admin\CourseController@search');

//Category
Route::apiResource('categories','Api\CategoryController');
Route::get('search/categories/{field}/{query}','Api\CategoryController@search');

//Status
Route::apiResource('statuses','Api\StatusController');
Route::get('search/statuses/{field}/{query}','Api\StatusController@search');