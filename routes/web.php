<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserControllwer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth', 'verified' )->group(function () {
    Route::get('/dashboard', [BidderController::class,'dashboard'])->name('dashboard');
    Route::get('/product/bidder/{productId}', [BidderController::class,'showBidderForm'])->name('product.placeBidder');
    Route::post('/product/bidder/{productId}', [BidderController::class, 'placeBidder'])->name('product.placeBidder.submit');

    // msg
    Route::get('/message', [MessageController::class,'dashboard'])->name('message.dashboard');
     //eventmsg
     Route::post('send-message', [MessageController::class, 'sendMessage'])->name('send-message');

    
});
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
    
    // usersapi
    Route::get('/user', [UserControllwer::class, 'index'])->name('user.dashboard');
    Route::get('/admin/users/create', [UserControllwer::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UserControllwer::class, 'store'])->name('admin.users.store');
     Route::get('/user/show/{id}', [UserControllwer::class, 'show'])->name('admin.users.show');
     Route::get('/user/edit/{id}', [UserControllwer::class, 'edit'])->name('admin.users.edit');
     Route::put('/user/update/{id}', [UserControllwer::class, 'update'])->name('admin.users.update');
     Route::delete('/user/destroy/{id}', [UserControllwer::class, 'destroy'])->name('admin.users.destroy');
  
    //products api
    Route::get('/product', [ProductController::class, 'index'])->name('product.dashboard');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
     Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
     Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
     Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
     Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});








require __DIR__.'/auth.php';
