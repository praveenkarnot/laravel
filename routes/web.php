<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::post('/addtocart/{uuid}', [Controllers\CartController::class, 'addToCart'])->name('addtocart');
Route::resource('products', Controllers\ProductController::class);

Route::post('order-place', [Controllers\OrderController::class, 'orderplace'])->name('order.place');
Route::get('orders', [Controllers\OrderController::class, 'index'])->name('orders.index');
