<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Blog\PostController;
use App\http\Controllers\Blog\Admin\BlogCategoryController;
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
});


Route::prefix('blog')->group(function () {
        Route::resource('posts', PostController::class)->names('blog.posts');

});

//админка
Route::prefix('admin/blog')->group(function () {
        Route::resource('categories', BlogCategoryController::class)
                                    ->names('blog.admin.categories')
                                    ->only('index', 'edit', 'store', 'update', 'create');

});


// Route::resource('restTest', RestTestController::class);

require __DIR__.'/auth.php';
