<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendingPostController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirectiflogin')->group(function () {
    Route::redirect('/', 'user-login');
    Route::get('/user-login', [AuthController::class, 'loginView'])->name('auth.login');
    Route::get('/user-register', [AuthController::class, 'registerView'])->name('auth.register');
});

Route::middleware('auth')->group(function () {
    // admin profile
    Route::prefix('/admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('admin.editProfile');
        Route::get('/password', [ProfileController::class, 'changePasswordPage'])->name('admin.changePasswordPage');
        Route::post('/change/password/{id}', [ProfileController::class, 'changePassword'])->name('admin.changePassword');
        // admin list
        Route::get('/list', [ListController::class, 'index'])->name('admin.list');
        Route::get('/list/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin.deleteAccount');
    });

    // category
    Route::prefix('/category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('category.list');
        Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/update/{id}', [CategoryController::class, 'updatePage'])->name('category.updatePage');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    // blog post
    Route::prefix('posts')->group(function () {
        Route::get('/list', [PostController::class, 'index'])->name('posts.list');
        Route::post('/create', [PostController::class, 'create'])->name('posts.create');
        Route::get('/details/{id}', [PostController::class, 'details'])->name('posts.details');
        Route::get('/update/{id}', [PostController::class, 'updatePage'])->name('posts.updatePage');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::get('/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
    });
    Route::get('/trending-posts', [TrendingPostController::class, 'index'])->name('admin.trendingPosts');
});
