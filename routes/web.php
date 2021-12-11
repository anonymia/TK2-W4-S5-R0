<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::redirect('/', '/product')->middleware(['auth'])->name('home');

Route::get('/product', [ProductController::class, 'index'])->middleware(['auth'])->name('product');
Route::view('/product/create', 'product.create')->middleware(['auth']);
Route::post('/product/create', [ProductController::class, 'create'])->middleware(['auth'])->name('product.create');
Route::get('/product/{id}', [ProductController::class, 'get'])->middleware(['auth'])->name('product.get');
Route::put('/product/{id}', [ProductController::class, 'put'])->middleware(['auth']);
Route::delete('/product/{id}', [ProductController::class, 'delete'])->middleware(['auth']);

Route::get('/user', [UserController::class, 'index'])->middleware(['auth'])->name('user');
Route::view('/user/create', 'user.create')->middleware(['auth']);
Route::post('/user/create', [UserController::class, 'create'])->middleware(['auth'])->name('user.create');
Route::get('/user/{id}', [UserController::class, 'get'])->middleware(['auth'])->name('user.get');
Route::put('/user/{id}', [UserController::class, 'put'])->middleware(['auth']);
Route::delete('/user/{id}', [UserController::class, 'delete'])->middleware(['auth']);

require __DIR__.'/auth.php';
