<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], static function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/posts/create', [App\Http\Controllers\HomeController::class, 'create'])->name('posts.create');
    Route::post('/posts/create', [App\Http\Controllers\HomeController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [App\Http\Controllers\HomeController::class, 'show'])->name('posts.show');
    Route::get('/posts/edit/{post}', [App\Http\Controllers\HomeController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/edit/{post}', [App\Http\Controllers\HomeController::class, 'update'])->name('posts.update');
    Route::delete('/posts/destroy/{post}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('posts.destroy');
});
