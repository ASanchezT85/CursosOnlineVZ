<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Course;
use App\Teacher;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(7);
        
        $swiperCategories = Category::orderBy('name', 'asc')->get();

        $courses = Course::withCount(['students'])
            ->with('category', 'teacher', 'reviews')
            ->where('status_id', Course::PUBLISHED)
            ->latest()
            ->paginate(9);

        return view('home', compact('categories', 'swiperCategories', 'courses'));
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {

        $categories = Category::orderBy('name', 'asc')->paginate(10);
        $swiperCategories = Category::orderBy('name', 'asc')->get();

        $courses = Course::withCount(['students'])
            ->with('category', 'teacher', 'reviews')
            ->where('status_id', Course::PUBLISHED)
            ->latest()
            ->paginate(9);

        $teachers = Teacher::all()->random()->paginate(10);
        
        return view('welcome.home', compact('categories', 'courses', 'teachers', 'swiperCategories'));
    }
}
