<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product}', [ProductsController::class , 'show'])->name('shop.products.show');
Route::get('/cart' , [CartController::class ,'index'])->name('cart');
Route::post('/cart' , [CartController::class , 'store']);
Route::delete('/cart/{id}' , [CartController::class , 'destroy'])->name('cart.destroy');