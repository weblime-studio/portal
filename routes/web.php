<?php

use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;



/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/
Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Illuminate\Support\Facades\Redirect::to('user/profile');  
    #return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/course/request', function () {
    //echo 'sdsdsd';
});*/

Route::post('/request', [App\Http\Controllers\RequestController::class, 'request']);
Route::post('/setmessage', [App\Http\Controllers\RequestController::class, 'setmessage']);
Route::get('/getmessage', [App\Http\Controllers\RequestController::class, 'getmessage']);


Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);
Route::get('/my-courses', [App\Http\Controllers\CourseController::class, 'mycourses']);

Route::middleware(['role:admin'])->prefix('myadmin')->group(function() {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);
    
    //Course
    Route::resource('course', App\Http\Controllers\Admin\CourseController::class);

    // Lesson
    Route::resource('lesson', App\Http\Controllers\Admin\LessonController::class);

    // User
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);

    // Subscribe
    Route::resource('subscribe', App\Http\Controllers\Admin\SubscribeController::class);

    // Blog

    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('post', App\Http\Controllers\Admin\PostController::class);


    
});


Route::group(['middleware' => ['role:admin|user|editor']], function () {
    Route::get('course/{slug}', [App\Http\Controllers\CourseController::class, 'course']);
    Route::get('lesson/{slug}', [App\Http\Controllers\LessonController::class, 'lesson']);
});








/*Route::get('/courses', function () {
    return view('courses');
});*/

/*Route::group(['middleware' => ['role:user']], function () {
    Route::get('/test', function () {
        return 'test';
    });
});*/

/*Route::get('course/{id}', function ($id) {
    return 'User '.$id;
});*/





