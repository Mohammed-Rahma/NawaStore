<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/admin/products/trashed' , [ProductsController::class , 'trashed'])->name('products.trashed');
Route::put('/admin/products/restor/{product}' , [ProductsController::class  , 'restore'])->name('products.restore');
Route::delete('/admin/products/{product}/force' , [ProductsController::class , 'forceDelete'])->name('products.force-delete');
Route::resource('/admin/categories' , CategoriesController::class );
Route::resource('/admin/products' , ProductsController::class );