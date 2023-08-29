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
use App\Http\Controllers\Admin\AuthController;
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

//Login user
Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class,'register']);
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



Route::get('password/request', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/request', [ForgotPasswordController::class,'ResetLinkEmail']);

Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/update', [ResetPasswordController::class,'resetPassword'])->name('password.update');


//Admin
//login

    Route::get('admin/login', [AuthController::class,'showLoginForm'])->name('admin.login'); // Hiển thị form đăng nhập
    Route::post('admin/login', [AuthController::class,'login']); // Xử lý đăng nhập
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('admin/password/request', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request'); // Hiển thị form quên mật khẩu
    Route::post('admin/password/request', [AuthController::class, 'sendResetLinkEmail']); // Gửi liên kết đặt lại mật khẩu
    Route::get('admin/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('admin.password.reset'); // Hiển thị form đặt lại mật khẩu
    Route::post('admin/password/update', [AuthController::class, 'resetPassword'])->name('admin.password.update'); // Xử lý đặt lại mật khẩu
//Role
Route::resource('roles',RoleController::class);
//user
Route::resource('users',UserController::class);
//category
Route::resource('categories',CategoryController::class);
//product
Route::resource('products',ProductController::class);
Route::post('/products/delete-selected', [ProductController::class,'deleteSelected'])->name('products.delete-selected');
Route::get('/products/{product}', [ProductController::class,'show'])->name('products.show');

//Home
//Search
Route::get('/', [HomeController::class,'index'])->name('client.home');
Route::post('/products/search', [HomeController::class,'search'])->name('product.search');
//detail
Route::match(['get', 'post'],'/product-detail/{id}',[\App\Http\Controllers\Client\ProductController::class,'show'])->name('product.show');
//Category
Route::post('/filtered-products', [\App\Http\Controllers\Client\ProductController::class,'filteredProducts'])->name('filtered.products');
//Cart
Route::post('add-to-cart', [\App\Http\Controllers\Client\CartController::class, 'store'])->name('client.carts.add');
