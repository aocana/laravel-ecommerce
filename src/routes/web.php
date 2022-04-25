<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhookController;


Route::get('/', function () {
    return view('home.index');
})->name('home');


//shop
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/search', [ProductController::class, 'search'])->name('shop.search');


//orders
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware(['auth'])->name('orders.show');


//cart
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::post('/cart', [CartController::class, 'checkout'])->middleware(['auth'])->name('cart.checkout');
Route::get('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove', [CartController::class, 'removeCart']);
Route::get('/cart/delete/{product}', [CartController::class, 'deleteFromCart'])->name('cart.delete');


//stripe webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
