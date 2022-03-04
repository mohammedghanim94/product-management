<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login',[AdminController::class,'Login'])->name('login');
Route::get('/dashboard',[AdminController::class,'Index'])->middleware(['auth:sanctum', 'verified'])->name('dashboard');
Route::get('/admin/logout',[AdminController::class,'Logout'])->middleware(['auth:sanctum', 'verified'])->name('admin.logout');


//User Management

Route::group(['prefix'=>'user','middleware'=>['auth:sanctum']],function(){
    Route::get('/list',[UserController::class,'ListUsers'])->name('users.list');
    Route::get('/add',[UserController::class,'AddUser'])->name('user.add');
    Route::post('/store',[UserController::class,'StoreUser'])->name('user.store');
    Route::get('/edit/{id}',[UserController::class,'EditUser'])->name('user.edit');
    Route::post('/update/{id}',[UserController::class,'UpdateUser'])->name('user.update');
    Route::get('/delete/{id}',[UserController::class,'DeleteUser'])->name('user.delete');
});


//Categories Management

Route::group(['prefix'=>'category','middleware'=>['auth:sanctum']],function(){
    Route::get('/list',[CategoryController::class,'ListCategories'])->name('categories.list');
    Route::get('/add',[CategoryController::class,'AddCategory'])->name('category.add');
    Route::post('/store',[CategoryController::class,'StoreCategory'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'EditCategory'])->name('category.edit');
    Route::post('/update/{id}',[CategoryController::class,'UpdateCategory'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'DeleteCategory'])->name('category.delete');
});


//Products Management

Route::group(['prefix'=>'product','middleware'=>['auth:sanctum']],function(){
    Route::get('/list',[ProductController::class,'ListProducts'])->name('products.list');
    Route::get('/add',[ProductController::class,'AddProduct'])->name('product.add');
    Route::post('/store',[ProductController::class,'StoreProduct'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'EditProduct'])->name('product.edit');
    Route::post('/update/{id}',[ProductController::class,'UpdateProduct'])->name('product.update');
    Route::get('/delete/{id}',[ProductController::class,'DeleteProduct'])->name('product.delete');
});


//Manage Profile    

Route::group(['prefix'=>'profile','middleware'=>['auth:sanctum']],function(){
    Route::get('/view',[ProfileController::class,'ViewProfile'])->name('view.profile');
    Route::get('/edit',[ProfileController::class,'EditProfile'])->name('edit.profile');
    Route::post('/update/{id}',[ProfileController::class,'UpdateProfile'])->name('update.profile');
    Route::get('/changepassword',[ProfileController::class,'ChangePassword'])->name('profile.changepassword');
    Route::post('/updatepassword',[ProfileController::class,'UpdatePassword'])->name('update.password');
});

