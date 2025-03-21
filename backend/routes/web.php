<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// to make it render the vues and not blades
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

// category blades
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');

// category crud
Route::get('/category/getAll', [CategoryController::class, 'getCategories']);
Route::post('/category/postCategory', [CategoryController::class, 'postCategory'])->name('category.postCategory');
Route::put('/category/{category}/updateCategory', [CategoryController::class, 'updateCategory'])->name('category.updateCategory');
Route::delete('/category/{category}/deleteCategory', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');
