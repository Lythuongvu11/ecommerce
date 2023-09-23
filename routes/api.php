<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//login
Route::post('/admin/login', [\App\Http\Controllers\Admin\AuthController::class,'login']);
Route::post('/admin/password/request', [\App\Http\Controllers\Admin\AuthController::class, 'sendResetLinkEmail']);
//user
Route::get('/data/users', [\App\Http\Controllers\Admin\UserController::class,'showdata']);
Route::post('/data/users-create', [\App\Http\Controllers\Admin\UserController::class,'store']);
Route::get('/data/{id}/users-edit', [\App\Http\Controllers\Admin\UserController::class,'edit']);
Route::put('/data/{id}/users', [\App\Http\Controllers\Admin\UserController::class,'update']);
Route::delete('/data/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);

//product
Route::get('/data/products', [\App\Http\Controllers\Admin\ProductController::class,'showdata']);
Route::post('/data/products-create', [\App\Http\Controllers\Admin\ProductController::class,'store']);
Route::get('/data/{id}/products-edit', [\App\Http\Controllers\Admin\ProductController::class,'edit']);
Route::put('/data/{id}/products', [\App\Http\Controllers\Admin\ProductController::class,'update']);
Route::delete('/data/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy']);
Route::post('/data/products/delete-selected', [\App\Http\Controllers\Admin\ProductController::class,'deleteSelected']);
//category
Route::get('/data/categories', [\App\Http\Controllers\Admin\CategoryController::class,'showdata']);
Route::post('/data/categories-create', [\App\Http\Controllers\Admin\CategoryController::class,'store']);
Route::get('/data/{id}/categories-edit', [\App\Http\Controllers\Admin\CategoryController::class,'edit']);
Route::put('/data/{id}/categories', [\App\Http\Controllers\Admin\CategoryController::class,'update']);
Route::delete('/data/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy']);


Route::get('/data/roles', [\App\Http\Controllers\Admin\RoleController::class,'showdata']);
