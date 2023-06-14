<?php

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

// Route::get('/user/{first}/{last?}' , [UserController::class , 'index']);

// Route::get('/admin/product' ,[ProductsController::class , 'index'] );
// Route::get('/admin/product/create' ,[ProductsController::class , 'create'] );
// Route::post('/admin/product' ,[ProductsController::class , 'store'] );
// Route::get('/admin/product/{id}' ,[ProductsController::class , 'show'] );
// Route::get('/admin/product/{id}/edit' ,[ProductsController::class , 'edit'] );
// Route::put('/admin/product/{id}' ,[ProductsController::class , 'update'] );
// Route::delete('/admin/product/{id}' ,[ProductsController::class , 'destory'] );

 Route::resource('/admin/products' , ProductsController::class );