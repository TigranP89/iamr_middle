<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SystemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
  Route::apiResource('posts', PostController::class);
  Route::apiResource('categories', CategoryController::class);
  Route::get('/categories/withCategory/{category}', [CategoryController::class, 'showPostWithCategory']);
  Route::get('/posts/slug/{slug}', [PostController::class, 'showPostWithSlug']);

});

Route::post("/login",[SystemController::class,'login'])->name('api.login');
Route::post("/register",[SystemController::class,'register'])->name('api.register');