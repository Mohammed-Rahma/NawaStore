<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController as ControllersProductsController;
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

Route::get('/', [HomeController::class , 'index'])->name('home');

Route::get('/products/{product}', [ControllersProductsController::class , 'show'])->name('shop.products.show');

Route::get('/admin/products/trashed' , [ProductsController::class , 'trashed'])->name('products.trashed');
Route::put('/admin/products/restor/{product}' , [ProductsController::class  , 'restore'])->name('products.restore');
Route::delete('/admin/products/{product}/force' , [ProductsController::class , 'forceDelete'])->name('products.force-delete');
Route::resource('/admin/categories' , CategoriesController::class );
Route::resource('/admin/products' , ProductsController::class );