<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', [ProductController::class , 'all']);
Route::get('categories', [CategoryController::class , 'all']);

// auth
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('me', [UserController::class, 'fetch']);
    Route::post('me', [UserController::class, 'udateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('checkout', [TransactionController::class, 'checkout']);
});
