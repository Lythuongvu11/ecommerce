<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Http\Request;
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

//Route::get('/', [HomeController::class,'index'])->name('client.home');

Route::get('/admin/dashboard',function (){
    return view('admin.dashboard.index');
})->name('dashboard');
Route::get('/detail',function (){
    return view('client.products.detail');
});

//Login
Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class,'register']);
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');
//Role
Route::resource('roles',RoleController::class);

//user
Route::resource('users',UserController::class);
//category
Route::resource('categories',CategoryController::class);
//product
Route::resource('products',ProductController::class);
//Search
Route::get('/', [HomeController::class,'index'])->name('client.home');
Route::post('/products/search', [HomeController::class,'search'])->name('product.search');
//detail
Route::match(['get', 'post'],'/product-detail/{id}',[\App\Http\Controllers\Client\ProductController::class,'show'])->name('product.show');
//Cart
Route::post('add-to-cart', [\App\Http\Controllers\Client\CartController::class, 'store'])->name('client.carts.add');
