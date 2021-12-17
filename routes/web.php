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

Route::get('/product', [ProductController::class, 'index'])->middleware(['auth', 'can:view'])->name('product');
Route::view('/product/create', 'product.create')->middleware(['auth', 'can:create']);
Route::post('/product/create', [ProductController::class, 'create'])->middleware(['auth', 'can:create'])->name('product.create');
Route::get('/product/{id}', [ProductController::class, 'get'])->middleware(['auth', 'can:update'])->name('product.get');
Route::put('/product/{id}', [ProductController::class, 'put'])->middleware(['auth', 'can:update']);
Route::delete('/product/{id}', [ProductController::class, 'delete'])->middleware(['auth', 'can:delete']);

Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'can:view'])->name('user');
Route::view('/user/create', 'user.create')->middleware(['auth', 'can:create']);
Route::post('/user/create', [UserController::class, 'create'])->middleware(['auth', 'can:create'])->name('user.create');
Route::get('/user/{id}', [UserController::class, 'get'])->middleware(['auth', 'can:update'])->name('user.get');
Route::put('/user/{id}', [UserController::class, 'put'])->middleware(['auth', 'can:update']);
Route::delete('/user/{id}', [UserController::class, 'delete'])->middleware(['auth', 'can:delete']);

require __DIR__.'/auth.php';
