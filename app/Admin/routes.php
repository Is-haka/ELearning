<?php

use App\Admin\Controllers\CategoriesController;
use App\Admin\Controllers\CoursesController;
use App\Admin\Controllers\InstructorController;
use App\Admin\Controllers\LessonsController;
use App\Admin\Controllers\LessonTypeController;
use App\Admin\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use OpenAdmin\Admin\Facades\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('instructors', InstructorController::class);
    $router->resource('categories', CategoriesController::class);
    $router->resource('courses', CoursesController::class);
    $router->resource('lessons', LessonsController::class);
    $router->resource('lesson-types', LessonTypeController::class);


});
