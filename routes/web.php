<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/set_language/{lang}', 'Controller@setLanguage')->name( 'set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/images/{path}/{attachment}', function($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if(File::exists($file)) {
        return Image::make($file)->response();
    }
});

Route::get('listcategories', 'Admin\CategoryController@getCategories');

Route::middleware(['auth', 'verified'])->group(function() {

    //Interfaz
    Route::get('home', 'HomeController@index')->name('home');

    Route::middleware(['permission:settings'])->group(function() {

        //Category
        Route::resource('categories', 'Admin\CategoryController');
        Route::get('list-categories', 'Admin\CategoryController@getCategories');
        //Courses
        Route::get('/courses','CourseController')->name('courses');
        //Status
        Route::get('/statuses','StatusController')->name('statuses');
        //Level
        Route::get('/levels','LevelController')->name('levels');
    });
    
    
});

