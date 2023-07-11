<?php

use App\Http\Controllers\Api\V1\AccessTokensController;
use App\Http\Controllers\Api\V1\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products' , ProductsController::class);

Route::post('/access-token' , [AccessTokensController::class , 'store'] )->middleware('guest:sanctum');//عشان يقدر يعمل توكن 

Route::delete('/access-token' ,[AccessTokensController::class , 'destroy'])->middleware('auth:sanctum');

Route::get('/access-token' ,[AccessTokensController::class , 'index'])->middleware('auth:sanctum');
