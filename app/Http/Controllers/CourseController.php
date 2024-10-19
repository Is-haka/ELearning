<?php

namespace App\Http\Controllers;
use App\Models\Courses;
use App\Models\Categories;
use App\Models\Enrollments;
use App\Models\Lessons;
use App\Models\LessonType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{

    public function course($id) {
        // Fetch the course with related data
        $courses = Courses::with([
            'categories:id,name',
            'instructor.user:id,name'
        ])->findOrFail($id);

        // Fetch lessons for the course
        $lessons = Lessons::where('course_id', $id)->with('lessonTypes')->get();

        // Get the first lesson and remaining lessons
        $firstLesson = $lessons->first();
        $remainingLessons = $lessons->slice(1);

        // Fetch lesson types
        $lessonTypes = LessonType::whereHas('lesson', function($query) use ($id) {
            $query->where('course_id', $id);
        })->get();

        // Count total lessons and lesson types
        $totalLessons = $lessons->count();
        $totalLessonTypes = $lessonTypes->count();

        // Check if the user is enrolled
        $enrolled = null;
        if (Auth::check()) {
            $userId = Auth::id();
            $enrolled = Enrollments::where('user_id', $userId)->where('course_id', $id)->first();
        }
        $cat = Categories::all();
        // Pass data to the view, including enrollment status
        return view('Courses.course', compact(
            'courses',
            'lessons',
            'lessonTypes',
            'totalLessons',
            'totalLessonTypes',
            'firstLesson',
            'remainingLessons',
            'enrolled',
            'cat'
        ));
    }


    public function enrollCourse(Request $request, $course_id) {
        if (!Auth::check()) {
            // Store the intended URL to session
            $redirectUrl = route('course.enroll.link', ['course_id' => $course_id]);
            Log::info('Storing redirect URL: ' . $redirectUrl);
            session()->put('redirect_to', $redirectUrl);

            // Redirect to login
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $course = Courses::find($course_id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Check if the user is already enrolled
        $enrollment = Enrollments::where('user_id', $userId)
                                ->where('course_id', $course_id)
                                ->first();

        if (!$enrollment) {
            // Enroll the user
            Enrollments::create([
                'user_id' => $userId,
                'course_id' => $course_id,
                'status' => 'enrolled'
            ]);
        }

        // Fetch enrollment status and categories to pass to the view
        $enrolled = Enrollments::where('user_id', $userId)
                            ->where('course_id', $course_id)
                            ->first();
        $cat = Categories::all();

        // Pass data with `with()`
        return redirect()->route('course.view', ['course_id' => $course_id])
                        ->with('success', 'You have been enrolled in the course.')
                        ->with('enrolled', $enrolled)
                        ->with('cat', $cat);
    }


    public function view($course_id)
    {
        // Fetch the course by ID
        $course = Courses::find($course_id);

        // Check if the course exists
        if (!$course) {
            return redirect()->route('cart')->with('error', 'Course not found.');
        }

        $cat = Categories::all();
        // Return the view with course details
        return view('course.course', [
            'course' => $course
        ], compact('cat'));
    }
}
