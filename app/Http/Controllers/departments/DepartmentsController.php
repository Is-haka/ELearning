<?php

namespace App\Http\Controllers\departments;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Courses;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function show($id) {
        // Find the category based on ID
        $category = Categories::findOrFail($id);

        // Fetch courses related to the specific category
        $courses = Courses::where('categories_id', $id) // Assuming you have a 'category_id' field in your 'courses' table
            ->with(['categories','instructor.user'])->get();
        // dd($courses);
        // Fetch all categories (for navigation or other purposes)
        $cat = Categories::all();

        // Pass the category, courses, and all categories to the view
        return view('departments.department', compact('category', 'courses', 'cat'));
    }
}
