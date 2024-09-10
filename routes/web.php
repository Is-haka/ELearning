<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IctController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

//Course routes
Route::prefix('courses')->group( function () {
    Route::get('/categories/ict', [IctController::class, 'ict'])->name('categories.ict');
    Route::get('/course/{id}', [CourseController::class, 'course'])->name('course');
    Route::get('/course/{course_id}', [CourseController::class, 'view'])->name('course.view');
    Route::post('/course/enroll/{course_id}', [CourseController::class, 'enrollCourse'])->name('course.enroll');
});

//Cart routes
Route::prefix('cart')->group( function () {
    // Route to add item to cart
    Route::get('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    // Route to view the cart
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    //ROute to remove item from cart
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    //Route to add user to the enrollment table for the specific course
    Route::post('/cart/enroll', [CartController::class, 'enroll'])->name('cart.enroll');
});
