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
Route::apiResource('categories','Api\CategoryController');
Route::get('search/categories/{field}/{query}','Api\CategoryController@search');

//Status
Route::apiResource('statuses','Api\StatusController');
Route::get('search/statuses/{field}/{query}','Api\StatusController@search');

//Status
Route::apiResource('levels','Api\LevelController');
Route::get('search/levels/{field}/{query}','Api\LevelController@search');

//Course
Route::apiResource('courses','Api\CourseController');
Route::get('search/courses/{field}/{query}','Api\CourseController@search');