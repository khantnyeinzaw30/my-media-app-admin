<?php

use App\Http\Controllers\API\ActionLogController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login', [AuthController::class, 'loginApi']);
Route::post('user/register', [AuthController::class, 'registerApi']);
// Route::get('/categories', [AuthController::class, 'categoryApi'])->middleware('auth:sanctum');

// posts api
Route::get('/posts', [PostController::class, 'getAllPosts']);
Route::post('/search/posts', [PostController::class, 'searchPosts']);
Route::post('/post/details', [PostController::class, 'getSinglePost']);

// categories api
Route::get('/categories', [CategoryController::class, 'getAllCategories']);
Route::post('/search/categories', [CategoryController::class, 'filterWithCategory']);

// action log
Route::post('/post/action', [ActionLogController::class, 'actionLog']);
