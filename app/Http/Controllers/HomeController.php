<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Courses;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Courses::with('categories', 'instructor')->get();

        // Pass the data to the view
        return view('index', compact('courses'));
    }
}

