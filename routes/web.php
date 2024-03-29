<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAboutController;
use App\Http\Controllers\DashboardPostsController;
use App\Http\Controllers\DashboardUsersController;

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

Route::get('/', function () {
    return view('homepage', [
        "title" => "Homepage"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "nama" => "Muhammad Rakhsha Nabil",
        "email" => "rakhshamuhammad@gmail.com",
        "image" => "foto saia.jpg"
    ]);
});


Route::get('/post', [PostController::class, 'index']);

Route::get('/post', function () {
    $blog_post = [
        
    ];

    return view('post', [
        "title" => "Post",
        "post" => $blog_post
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Route::middleware('role:admin')->get('/dashboard', function() {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware('role:admin')->get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('guest');


// Route::resource('/dashboard/posts', DashboardPostsController::class)->middleware('auth');
Route::resource('/dashboard/users', DashboardUsersController::class)->middleware('auth');
Route::resource('/dashboard/graphs', DashboardAboutController::class)->middleware('auth');


// Route::get('post/{slug}', function($slug) {
//     return view('posts', [   
//         "title" => "single post"
//     ]);
// });
