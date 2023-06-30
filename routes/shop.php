<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products/{product}', [ProductsController::class , 'show'])->name('shop.products.show');
