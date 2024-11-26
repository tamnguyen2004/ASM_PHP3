<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController; 
use Illuminate\Support\Facades\Route;

// Route cho admin với middleware auth và checkauth
Route::middleware(['auth', 'checkauth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    
    // Route resource cho danh mục
    Route::resource('categories', CategoryController::class);

    // Route resource cho sản phẩm
    Route::resource('products', ProductController::class);

    // Route resource cho người dùng
    Route::resource('users', UserController::class);

    Route::resource('users', UserController::class)->middleware('auth');
});

// Route cho client
Route::get('/', [ClientController::class, 'index'])->name('client.home');
Route::get('/product/{id}', [ClientController::class, 'show'])->name('product.show');
Route::get('/category/{id}', [ClientController::class, 'category'])->name('category.show');
Route::post('/product/{id}/comments', [ClientController::class, 'storeComment'])->name('comments.store');

// Route cho đăng nhập và đăng ký
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postlogin');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

// Sửa đổi route logout để sử dụng POST
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
