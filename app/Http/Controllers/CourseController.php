<?php

namespace App\Http\Controllers;
use App\Models\Courses;
use App\Models\Lessons;
use App\Models\LessonType;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function course($id) {
        $courses = Courses::with([
            'categories:id,name',
            'instructor.user:id,name'
            ])->findOrFail($id);

        // If you want to load lessons separately
        $lessons = Lessons::where('course_id', $id)->with('lessonTypes')->get();

        // Separate the first lesson
        $firstLesson = $lessons->first();  // Get the first lesson
        $remainingLessons = $lessons->slice(1); // Get all remaining lessons after the first one

        // If you want to load lesson types separately
        $lessonTypes = LessonType::whereHas('lesson', function($query) use ($id) {
            $query->where('course_id', $id);
        })->get();

        // Count total lessons for this course
        $totalLessons = $lessons->count();

        // // Count total lesson types for this course
        $totalLessonTypes = $lessonTypes->count();

        return view('Courses.course', compact('courses', 'lessons', 'lessonTypes', 'totalLessons', 'totalLessonTypes', 'firstLesson', 'remainingLessons'));
    }
}
