<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::controller(App\Http\Controllers\HomeController::class)->group(function () {

    Route::get('/', 'index');
    Route::get('/home', 'index');
    Route::get('/user-posts/{user_id}', 'userPosts');

});



Route::controller(App\Http\Controllers\PostController::class)->group(function () {

    Route::get('/add-post', 'create');
    Route::get('/edit-post/{post_id}', 'edit');
    Route::get('/posts/{post_id}', 'index');
    Route::get('/posts/{post_id}/edit', 'edit');
    Route::get('/posts/{post_id}/delete', 'destroy');
    Route::post('posts/create', 'store');
    Route::put('posts/{post_id}/update', 'update');

});





Route::controller(App\Http\Controllers\CommentController::class)->group(function () {

    Route::post('comments/create', 'store');
    Route::put('comments/{comment_id}/update', 'update');
    Route::get('comments/{comment_id}/delete', 'destroy');

});
