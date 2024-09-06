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
Route::prefix('course')->group( function () {
    Route::get('categories/ict', [IctController::class, 'ict'])->name('categories.ict');
    Route::get('course/{id}', [CourseController::class, 'course'])->name('course');
});

//Cart routes
Route::prefix('cart')->group( function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});
