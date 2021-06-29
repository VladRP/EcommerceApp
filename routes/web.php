<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartitemsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/aboutus', [App\Http\Controllers\HomeController::class, 'aboutUs']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::put('/homeuser/update', [App\Http\Controllers\HomeController::class, 'updateAddress'])->name('user.updateaddress');
Route::get('/homeuser', [App\Http\Controllers\HomeController::class, 'showUserPage'])->name('user.page');

Route::get('/', [CategoriesController::class, 'index']);
Route::resource('/categories', CategoriesController::class);

Route::resource('/subcategories', SubcategoriesController::class,['except' => ['create']]);
Route::get('/subcategories/create/{id}', [SubcategoriesController::class, 'create'])->name('subcategories.create');

Route::resource('/products', ProductsController::class,['except' => ['create']]);
Route::get('/products/index/allproducts', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/create/{id}', [ProductsController::class, 'create'])->name('products.create');
Route::get('/products', [ProductsController::class, 'search'])->name('products.search');
Route::get('/products/addtocart/{id}', [ProductsController::class, 'addToCart'])->name('products.addToCart');
Route::put('product/addstock/{id}', [ProductsController::class, 'addStock'])->name('products.addstock');
Route::get('/products/deletefromcart/{id}', [ProductsController::class, 'deleteFromCart'])->name('products.deleteFromCart');

Route::group(['middleware' => 'auth'], function(){
Route::put('/products/addProduct/{id}', [CartitemsController::class, 'addProduct'])->name('cartitems.addProduct');
});
Route::put('/cartitems/increase/{id}', [CartitemsController::class, 'increaseQuantity'])->name('cartitems.increaseqty');
Route::delete('/cartitems/deletesoldout/{id}', [CartitemsController::class, 'deleteCartItemsSoldOut'])->name('cartitems.deletesoldout');
Route::put('/cartitems/decrease/{id}', [CartitemsController::class, 'decreaseQuantity'])->name('cartitems.decreaseqty');
Route::resource('/cartitems', CartitemsController::class);

Route::group([ 'middleware' => 'auth'], function () {
Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('success', [CheckoutController::class, 'success'])->name('success');
Route::get('cancel', [CheckoutController::class, 'cancel'])->name('cancel');
});

Route::resource('/comments', CommentController::class);

Route::get('/home', [OrdersController::class, 'showOrders'])->name('orders.show');
Route::get('orders/{id}', [OrdersController::class, 'showOrder'])->name('orders.showone');
Route::get('orders/order/{id}', [OrdersController::class, 'updateOrder'])->name('orders.update');
Route::delete('orders/delete/{id}', [OrdersController::class, 'delete'])->name('orders.delete');
