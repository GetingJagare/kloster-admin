<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', fn() => view('welcome'));
Route::get('/login', fn() => view('login'))->name('login');
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');

Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class)->only('index');
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn() => view('admin'));
    Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);
    Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);
});
