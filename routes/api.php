<?php

use App\Http\Controllers\AddProduct\AddProductController;
use App\Http\Controllers\RemoveProduct\RemoveProductController;
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

Route::delete('/products/{id}', RemoveProductController::class);
Route::post('/products', AddProductController::class);

