<?php

namespace App\Http\Controllers;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function course($id) {
        $courses = Courses::with([
            'categories:id,name',
            'instructor.user:id,name'
            ])->findOrFail($id);

        return view('Courses.course', compact('courses'));
    }
}
