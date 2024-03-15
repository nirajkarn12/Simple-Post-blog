<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SwaggerController;






Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//posts
Route::get('/admin/post/list', [PostController::class, 'view'])->name('post.view');
Route::get('/admin/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/admin/post/create', [PostController::class, 'store'])->name('post.store');
Route::get('/admin/post/edit/{postid}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/admin/post/edit/{postid}', [PostController::class, 'update'])->name('post.update');
Route::delete('/admin/post/delete/{postid}', [PostController::class, 'destroy'])->name('post.destroy');
Route::get('/admin/post/comment/{postid}', [PostController::class, 'comment'])->name('post.comment');

});

require __DIR__.'/auth.php';

Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.index');
});

Route::get('/api/documentation', [SwaggerController::class, 'index']);
