<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\ProductsController;
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


Auth::routes();

Route::get('/private', [App\Http\Controllers\HomeController::class, 'private']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/categories', CategoriesController::class);

Route::resource('/subcategories', SubcategoriesController::class,['except' => ['create']]);

Route::get('/subcategories/create/{id}', [SubcategoriesController::class, 'create'])->name('subcategories.create');

Route::resource('/products', ProductsController::class,['except' => ['create']]);

Route::get('/products/create/{id}', [ProductsController::class, 'create'])->name('products.create');

Route::get('/products', [ProductsController::class, 'search'])->name('products.search');

Route::get('/products/addtocart/{id}', [ProductsController::class, 'addToCart'])->name('products.addToCart');

