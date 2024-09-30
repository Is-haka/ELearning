<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\Enrollments;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the cart page with items and summary.
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        $userId = Auth::id();
        $cartItems = Carts::where('user_id', $userId)
                          ->with([
                            'courses'
                          ]) // Eager load related course data
                          ->get();

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->courses->price * $item->quantity;
        });

        $cat = Categories::all();

        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ], compact('cat'));
    }

    /**
     * Add a course to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            // Store intended URL in the session
            session()->put('redirect_to', route('cart.add', [
                'course_id' => $request->input('course_id')
            ]));
            $cat = Categories::all();

            // Redirect to login page
            return redirect()->route('login', compact('cat'));
        }

        $userId = Auth::id();
        $courseId = $request->input('course_id');

        // Debugging: Check the course ID
        Log::info('Course ID: ' . $courseId);

        $course = Courses::find($courseId);
        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        // Add course to cart
        $cartItem = Carts::updateOrCreate(
            ['course_id' => $courseId, 'user_id' => $userId],
            ['quantity' => $request->input('quantity', 1)]
        );

        Log::info('Cart Item Created/Updated: ' . $cartItem);

        $cat = Categories::all();

        return redirect()->route('cart', compact('cat'))->with('success', 'Course added to cart.');
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromCart($id)
    {
        $userId = Auth::id();
        Carts::where('id', $id)->where('user_id', $userId)->delete();

        $cat = Categories::all();

        return redirect()->route('cart', compact('cat'))->with('success', 'Item removed from cart.');
    }

    public function enroll(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();

        // Get all cart items for the user
        $cartItems = Carts::where('user_id', $userId)->get();

        // Enroll user in each course
        foreach ($cartItems as $item) {
            $courseId = $item->course_id;

            // Debugging: Check the course ID
            Log::info('Enrolling Course ID: ' . $courseId);

            $course = Courses::find($courseId);
            if (!$course) {
                continue;
            }

            // Check if the user is already enrolled in this course
            $enrollment = Enrollments::where('user_id', $userId)
                                     ->where('course_id', $courseId)
                                     ->first();

            if (!$enrollment) {
                // Create new enrollment
                Enrollments::create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'status' => 'enrolled'
                ]);
                Log::info('Enrolling User ID: ' . $userId . ' to Course ID: ' . $courseId);
            }
        }

        // Remove items from cart
        Carts::where('user_id', $userId)->delete();

        $cat = Categories::all();

        // Redirect to the course page (assuming you want to redirect to the first course)
        $firstCourseId = $cartItems->first()->course_id;
        return redirect()->route('course.view', ['course_id' => $firstCourseId])
               ->with('success', 'You have been enrolled in the course.')->with('cat', $cat);
    }

}
