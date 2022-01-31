<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

// indexページ
Route::get('/', [ProductsController::class, 'index']);
// 商品詳細ページ
Route::get('product/{id}', [ProductsController::class, 'show'])->name('show');
// カートページ
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
// カートに入れるボタン
Route::get('add-cart/{id}', [ProductsController::class, 'addCart'])->name('add.cart');
// ajax
Route::patch('update-cart', [ProductsController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove.from.cart');