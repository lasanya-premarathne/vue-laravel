<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// category API endpoints
Route::get('/category', [CategoryController::class, 'getCategories']);
Route::post('/category', [CategoryController::class, 'postCategory']);
Route::put('/category/{category}', [CategoryController::class, 'updateCategory']);
Route::delete('/category/{category}', [CategoryController::class, 'deleteCategory']);

// product API endpoints
Route::get('/product', [ProductController::class, 'getProducts']);
Route::post('/product', [ProductController::class, 'postProduct']);
Route::put('/product/{product}', [ProductController::class, 'updateProduct']);
Route::delete('/product/{product}', [ProductController::class, 'deleteProduct']);

// order API endpoints
Route::get('/order', [OrderController::class, 'getAllOrders']);
Route::post('/order', [OrderController::class, 'postOrder']);
Route::get('/order/{order}', [OrderController::class, 'getOrder']);
Route::put('/order/{order}', [OrderController::class, 'updateOrder']);
Route::delete('/order/{order}', [OrderController::class, 'deleteOrder']);