<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Blog\PostController;
use App\http\Controllers\Blog\Admin\BlogCategoryController;
use App\Http\Controllers\Blog\Admin\BlogPostController;
use App\Models\BlogCategories;
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

// BlogCategories
Route::prefix('blog/admin')->group(function () {
        Route::resource('category', BlogCategoryController::class)
                                        ->names('blog.admin.category')
                                        ->only('index', 'edit', 'store', 'update', 'create');


// BlogPosts
        Route::resource('posts', BlogPostController::class)
                                        ->except(['show']) //кроме
                                        ->names('blog.admin.posts');


        Route::patch('posts/{id}/restore', [BlogPostController::class, 'restore'])
                                                ->name('blog.admin.posts.restore');



        Route::get('posts/prepare-catalog', [BlogPostController::class, 'prepareCatalog'])
                                                ->name('testqueuechain');

});
 









require __DIR__.'/auth.php';
