<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserControllwer;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
   
    
    // Other routes only accessible by admins
});

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/user', [UserControllwer::class, 'index'])->name('user.dashboard');
 

     Route::get('/user/show/{id}', [UserControllwer::class, 'show'])->name('admin.users.show');
     Route::get('/user/edit/{id}', [UserControllwer::class, 'edit'])->name('admin.users.edit');
     Route::get('/user/destroy/{id}', [UserControllwer::class, 'destroy'])->name('admin.users.destroy');
  
    // Other routes only accessible by admins
});






Route::group(['middleware' => ['permission:edit articles']], function () {
    Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    // Other routes that require specific permissions
});

require __DIR__.'/auth.php';
