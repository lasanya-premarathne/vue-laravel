<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
