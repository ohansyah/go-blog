<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Web\Public\PostController as PublicPostController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('post', PostController::class);
    Route::resource('comment', CommentController::class)->only(['store', 'update', 'destroy']);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [PublicPostController::class, 'index'])->name('public-post.index');
    Route::get('/{id}/{slug}', [PublicPostController::class, 'show'])->name('public-post.show');
});
